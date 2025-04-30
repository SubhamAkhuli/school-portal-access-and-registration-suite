<?php


require 'paypal/vendor/autoload.php'; // Load PayPal SDK

use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

// PayPal API Credentials
define('PAYPAL_CLIENT_ID', 'AThplX_3c5-sjOFDwieZVD74zDI16D1UrLPUMfGbR85kjJ1j04NiPO3J_gt51-YiVQqgtugZOmRkfy-I');
define('PAYPAL_SECRET', 'EMYIe6LFRHhWf5QS-IZ6NteR-vhcVSCqe0ofVk5qJ29sN1mFA70Qrtu-apYfC0rpFO99tHLGGwsPbrVR');

$apiContext = new ApiContext(
    new OAuthTokenCredential(PAYPAL_CLIENT_ID, PAYPAL_SECRET)
);
$apiContext->setConfig(['mode' => 'sandbox']); // Use 'live' for production


// Register the AJAX action in WordPress
add_action('wp_ajax_process_paypal_payment', 'process_paypal_payment');
add_action('wp_ajax_nopriv_process_paypal_payment', 'process_paypal_payment'); // For guest users

function process_paypal_payment() {
    header('Content-Type: application/json');

    // Validate amount
    if (!isset($_POST['amount']) || !is_numeric($_POST['amount']) || $_POST['amount'] <= 0) {
        echo json_encode(['success' => false, 'error' => 'Valid amount is required']);
        wp_die();
    }

    // Validate currency (optional, default to USD)
    $currency = isset($_POST['currency']) ? strtoupper($_POST['currency']) : 'USD';

    // PayPal Payment Setup
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');

    $amount = new Amount();
    $formatted_amount = number_format((float)$_POST['amount'], 2, '.', '');
    $amount->setTotal($formatted_amount);
    $amount->setCurrency($currency);

    $transaction = new Transaction();

    // Default description
    $description = "Payment for Order";
    // $custom = [];

    // // Custom fields
    // $type = isset($_POST['type']) ? $_POST['type'] : '';
    // // Ensure transactionItems is always an array, then encode as JSON
    // $transactionItems = [];
    // if (isset($_POST['transactionItems'])) {
    //     if (is_array($_POST['transactionItems'])) {
    //         $transactionItems = $_POST['transactionItems'];
    //     } else {
    //         // Try to decode JSON string to array
    //         $decoded = json_decode($_POST['transactionItems'], true);
    //         if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
    //             $transactionItems = $decoded;
    //         } else {
    //             // fallback: wrap as single item if not valid JSON
    //             $transactionItems = [$_POST['transactionItems']];
    //         }
    //     }
    // }

    // if ($type === 'student_registration') {
    //     $description = isset($_POST['description']) ? $_POST['description'] : 'Graduates Academy - Registration';
    //     $custom = [
    //         'type' => $type,
    //         'rushfee' => $_POST['rushfee'] ?? '',
    //         'addNewStudent' => $_POST['addNewStudent'] ?? 'no',
    //         'coupon_code' => $_POST['coupon_code'] ?? '',
    //         'transactionItems' => $transactionItems
    //     ];
    // } elseif ($type === 'student_renewal') {
    //     $description = isset($_POST['description']) ? $_POST['description'] : 'Graduates Academy - Renew Registration';
    //     $custom = [
    //         'type' => $type,
    //         'rushfee' => $_POST['rushfee'] ?? '',
    //         'coupon_code' => $_POST['coupon_code'] ?? '',
    //         'student_data' => $_POST['student_data'] ?? '',
    //         'parentId' => $_POST['parentId'] ?? '',
    //         'f_name' => $_POST['f_name'] ?? '',
    //         'm_name' => $_POST['m_name'] ?? '',
    //         'l_name' => $_POST['l_name'] ?? '',
    //         'country_code' => $_POST['country_code'] ?? '',
    //         'phone' => $_POST['phone'] ?? '',
    //         'email' => $_POST['email'] ?? '',
    //         'addressId' => $_POST['addressId'] ?? '',
    //         'street_address' => $_POST['street_address'] ?? '',
    //         'city' => $_POST['city'] ?? '',
    //         'zip_code' => $_POST['zip_code'] ?? '',
    //         'state' => $_POST['state'] ?? '',
    //         'county' => $_POST['county'] ?? '',
    //         'emergency_name' => $_POST['emergency_name'] ?? '',
    //         'emergency_country_code' => $_POST['emergency_country_code'] ?? '',
    //         'emergency_number' => $_POST['emergency_number'] ?? '',
    //         'privacy_check' => $_POST['privacy_check'] ?? '',
    //         'signature_f_name' => $_POST['signature_f_name'] ?? '',
    //         'signature_l_name' => $_POST['signature_l_name'] ?? '',
    //         'signature_date' => $_POST['signature_date'] ?? '',
    //         'transactionItems' => $transactionItems
    //     ];
    // } elseif ($type === 'student_graduation') {
    //     $description = isset($_POST['description']) ? $_POST['description'] : 'Graduates Academy - Apply to Graduate';
    //     $custom = [
    //         'type' => $type,
    //         'rushfee' => $_POST['rushfee'] ?? '',
    //         'coupon_code' => $_POST['coupon_code'] ?? '',
    //         'student_id' => $_POST['student_id'] ?? '',
    //         'transactionItems' => $_POST['transactionItems'] ?? ''
    //     ];
    // }
    
    $transaction->setAmount($amount);
    $transaction->setDescription($description);
    // if (!empty($custom)) {
    //     // Encode transactionItems as JSON inside $custom
    //     if (isset($custom['transactionItems']) && is_array($custom['transactionItems'])) {
    //         $custom['transactionItems'] = json_encode($custom['transactionItems']);
    //     }
    //     $transaction->setCustom(json_encode($custom));
    // }

    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl(site_url() . "/thank-you")
                 ->setCancelUrl(site_url() . "/payment-cancel");

    $payment = new Payment();
    $payment->setIntent("sale")
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

    global $apiContext;
    try {
        $payment->create($apiContext);

        $paymentId = $payment->getId();
        $current_user_id = get_current_user_id();

        if ($current_user_id) {
            update_field('paypal_token', $paymentId, 'user_' . $current_user_id);
        }

        echo json_encode([
            'success' => true,
            'redirect_url' => $payment->getApprovalLink(),
            'transaction_id' => $paymentId,
            'user_id' => $current_user_id
        ]);
        wp_die();

    } catch (\PayPal\Exception\PayPalConnectionException $ex) {
        $data = json_decode($ex->getData(), true);
        $error = $data['message'] ?? $ex->getMessage();
        echo json_encode(['success' => false, 'error' => $error]);
        wp_die();
    } catch (Exception $ex) {
        echo json_encode(['success' => false, 'error' => $ex->getMessage()]);
        wp_die();
    }
}


// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'process_paypal_payment') {
//     $payer = new Payer();
//     $payer->setPaymentMethod('paypal');

//     $amount = new Amount();
//     $amount->setTotal($_POST['amount']); // Get amount from AJAX request
//     $amount->setCurrency('USD');

//     $transaction = new Transaction();
//     $transaction->setAmount($amount);
//     $transaction->setDescription("Payment for Order");

//     $redirectUrls = new RedirectUrls();
//     $redirectUrls->setReturnUrl(site_url(). "/thank-you") // Redirect after success
//                   ->setCancelUrl(site_url(). "/payment-cancel"); // Redirect if canceled

//     $payment = new Payment();
//     $payment->setIntent("sale")
//             ->setPayer($payer)
//             ->setTransactions([$transaction])
//             ->setRedirectUrls($redirectUrls);    

//     try {
//         $payment->create($apiContext);
//         // Get Transaction Details
//         $paymentId = $payment->getId();
//         $current_user_id = get_current_user_id();

//         if (is_user_logged_in()) {
//             $user_id = get_current_user_id();
//             echo "Logged-in User ID: " . $user_id;
//         } else {
//             echo "User is not logged in.";
//         }

//         echo json_encode(['success' => true, 'redirect_url' => $payment->getApprovalLink(), 'transaction_id' => $paymentId, 'user_id' => $current_user_id]);
//         die();

//     } catch (Exception $ex) {
//         echo json_encode(['success' => false, 'error' => $ex->getMessage()]);
//         die();

//     }
// }
?>
