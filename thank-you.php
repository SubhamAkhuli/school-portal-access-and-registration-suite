<?php
require 'paypal/vendor/autoload.php';

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

define('PAYPAL_CLIENT_ID', 'your_client_id');
define('PAYPAL_SECRET', 'your_secret');

$apiContext = new ApiContext(
    new OAuthTokenCredential(PAYPAL_CLIENT_ID, PAYPAL_SECRET)
);
$apiContext->setConfig(['mode' => 'sandbox']); // Change to 'live' when ready

if (isset($_GET['paymentId']) && isset($_GET['PayerID'])) {
    $paymentId = $_GET['paymentId'];
    $payerId = $_GET['PayerID'];

    try {
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        $result = $payment->execute($execution, $apiContext);

        // Get custom field data from the transaction
        $transactions = $payment->getTransactions();
        $customData = [];
        if (!empty($transactions) && method_exists($transactions[0], 'getCustom')) {
            $customField = $transactions[0]->getCustom();
            if (!empty($customField)) {
                $customData = json_decode($customField, true);
            }
        }

        // Separate logic based on 'type'
        // $type = isset($customData['type']) ? $customData['type'] : '';
        // if ($type === 'student_registration') {
        //     // Handle student registration
        //     // Extract data from $customData
        //     $rushfee = isset($customData['rushfee']) ? $customData['rushfee'] : '';
        //     $addNewStudent = isset($customData['addNewStudent']) ? $customData['addNewStudent'] : '';
        //     $coupon_code = isset($customData['coupon_code']) ? $customData['coupon_code'] : '';
        //     $transactionItems = isset($customData['transactionItems']) ? $customData['transactionItems'] : [];

        //     // Prepare data for AJAX call
        //     $ajaxData = [
        //     'action' => 'ajax_handle_final_submit',
        //     'rushfee' => $rushfee,
        //     'addNewStudent' => $addNewStudent,
        //     'transaction_id' => $paymentId,
        //     'description' => 'Graduates Academy - Registration',
        //     'paidAmount' => $result->getTransactions()[0]->getAmount()->getTotal(),
        //     'coupon_code' => $coupon_code,
        //     'transactionItems' => json_encode($transactionItems),
        //     'type' => 'final_submit',
        //     ];

        //     // Make server-side POST request to WordPress AJAX handler
        //     $adminAjaxUrl = (function_exists('admin_url') ? admin_url('admin-ajax.php') : '/wp-admin/admin-ajax.php');
        //     $ch = curl_init();
        //     curl_setopt($ch, CURLOPT_URL, $adminAjaxUrl);
        //     curl_setopt($ch, CURLOPT_POST, 1);
        //     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($ajaxData));
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     $response = curl_exec($ch);
        //     curl_close($ch);

        //     // Handle the response similar to JS logic
        //     $responseData = json_decode($response, true);
        //     if (isset($responseData['data']['success']) && $responseData['data']['success']) {
        //         // Registration successful
        //         // Optionally, redirect or show a message
        //         header('Location: /students/');
        //         exit;
        //     } else {
        //         // Registration failed
        //         // Optionally, handle error or reload
        //         header('Location: /registration/');
        //     }
        // } elseif ($type === 'student_renewal') {
        //     // Extract data from $customData
        //     $rushfee = isset($customData['rushfee']) ? $customData['rushfee'] : '';
        //     $coupon_code = isset($customData['coupon_code']) ? $customData['coupon_code'] : '';
        //     $student_data = isset($customData['student_data']) ? $customData['student_data'] : '';
        //     $parentId = isset($customData['parentId']) ? $customData['parentId'] : '';
        //     $f_name = isset($customData['f_name']) ? $customData['f_name'] : '';
        //     $m_name = isset($customData['m_name']) ? $customData['m_name'] : '';
        //     $l_name = isset($customData['l_name']) ? $customData['l_name'] : '';
        //     $country_code = isset($customData['country_code']) ? $customData['country_code'] : '';
        //     $phone = isset($customData['phone']) ? $customData['phone'] : '';
        //     $email = isset($customData['email']) ? $customData['email'] : '';
        //     $addressId = isset($customData['addressId']) ? $customData['addressId'] : '';
        //     $street_address = isset($customData['street_address']) ? $customData['street_address'] : '';
        //     $city = isset($customData['city']) ? $customData['city'] : '';
        //     $zip_code = isset($customData['zip_code']) ? $customData['zip_code'] : '';
        //     $state = isset($customData['state']) ? $customData['state'] : '';
        //     $county = isset($customData['county']) ? $customData['county'] : '';
        //     $emergency_name = isset($customData['emergency_name']) ? $customData['emergency_name'] : '';
        //     $emergency_country_code = isset($customData['emergency_country_code']) ? $customData['emergency_country_code'] : '';
        //     $emergency_number = isset($customData['emergency_number']) ? $customData['emergency_number'] : '';
        //     $privacy_check = isset($customData['privacy_check']) ? $customData['privacy_check'] : '';
        //     $signature_f_name = isset($customData['signature_f_name']) ? $customData['signature_f_name'] : '';
        //     $signature_l_name = isset($customData['signature_l_name']) ? $customData['signature_l_name'] : '';
        //     $signature_date = isset($customData['signature_date']) ? $customData['signature_date'] : '';
        //     $transactionItems = isset($customData['transactionItems']) ? $customData['transactionItems'] : [];

        //     $ajaxData = [
        //         'action' => 'ajax_handle_renewal_submit',
        //         'rushfee' => $rushfee,
        //         'transaction_id' => $paymentId,
        //         'description' => 'Graduates Academy - Renew Registration',
        //         'paidAmount' => $result->getTransactions()[0]->getAmount()->getTotal(),
        //         'coupon_code' => $coupon_code,
        //         'student_data' => is_array($student_data) ? json_encode($student_data) : $student_data,
        //         'parentId' => $parentId,
        //         'f_name' => $f_name,
        //         'm_name' => $m_name,
        //         'l_name' => $l_name,
        //         'country_code' => $country_code,
        //         'phone' => $phone,
        //         'email' => $email,
        //         'addressId' => $addressId,
        //         'street_address' => $street_address,
        //         'city' => $city,
        //         'zip_code' => $zip_code,
        //         'state' => $state,
        //         'county' => $county,
        //         'emergency_name' => $emergency_name,
        //         'emergency_country_code' => $emergency_country_code,
        //         'emergency_number' => $emergency_number,
        //         'privacy_check' => $privacy_check,
        //         'signature_f_name' => $signature_f_name,
        //         'signature_l_name' => $signature_l_name,
        //         'signature_date' => $signature_date,
        //         'transactionItems' => is_array($transactionItems) ? json_encode($transactionItems) : $transactionItems,
        //         'type' => 'final_submit',
        //     ];

        //     // Make server-side POST request to WordPress AJAX handler
        //     $adminAjaxUrl = (function_exists('admin_url') ? admin_url('admin-ajax.php') : '/wp-admin/admin-ajax.php');
        //     $ch = curl_init();
        //     curl_setopt($ch, CURLOPT_URL, $adminAjaxUrl);
        //     curl_setopt($ch, CURLOPT_POST, 1);
        //     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($ajaxData));
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     $response = curl_exec($ch);
        //     curl_close($ch);

        //     // Handle the response similar to JS logic
        //     $responseData = json_decode($response, true);
        //     if (isset($responseData['data']['success']) && $responseData['data']['success']) {
        //         header('Location: /students/');
        //         exit;
        //     } else {
        //         header('Location: /student-renewal/');
        //         exit;
        //     }
        // } elseif ($type === 'student_graduation') {
        //     // Handle student graduation
        //     $rushfee = isset($customData['rushfee']) ? $customData['rushfee'] : '';
        //     $coupon_code = isset($customData['coupon_code']) ? $customData['coupon_code'] : '';
        //     $student_id = isset($customData['student_id']) ? $customData['student_id'] : '';
        //     $transactionItems = isset($customData['transactionItems']) ? $customData['transactionItems'] : [];

        //     $ajaxData = [
        //         'action' => 'ajax_handle_apply_graduate_submit',
        //         'student_id' => $student_id,
        //         'rushfee' => $rushfee,
        //         'transaction_id' => $paymentId,
        //         'description' => 'Graduates Academy - Apply to Graduate',
        //         'paidAmount' => $result->getTransactions()[0]->getAmount()->getTotal(),
        //         'coupon_code' => $coupon_code,
        //         'transactionItems' => json_encode($transactionItems),
        //         'type' => 'final_submit',
        //     ];

        //     // Make server-side POST request to WordPress AJAX handler
        //     $adminAjaxUrl = (function_exists('admin_url') ? admin_url('admin-ajax.php') : '/wp-admin/admin-ajax.php');
        //     $ch = curl_init();
        //     curl_setopt($ch, CURLOPT_URL, $adminAjaxUrl);
        //     curl_setopt($ch, CURLOPT_POST, 1);
        //     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($ajaxData));
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     $response = curl_exec($ch);
        //     curl_close($ch);

        //     // Handle the response similar to JS logic
        //     $responseData = json_decode($response, true);
        //     if (isset($responseData['success']) && $responseData['success']) {
        //         header('Location: /students/');
        //         exit;
        //     } else {
        //         header('Location: /apply-to-graduate/?sid=' . $student_id);
        //         exit;
        //     }
        // }

        echo '
            <h2 style="color: green; text-align: center;">🎉 Registration Successful! 🎉</h2>
            <p style="text-align: center;">Congratulations! Your student account has been successfully created.</p>';

    } catch (Exception $ex) {
        echo "<h2 style='color: red; text-align: center;'>Payment failed:</h2>";
        echo "<p style='text-align: center;'>" . $ex->getMessage() . "</p>";
    }
} else {
    echo "<h2 style='color: red; text-align: center;'>Payment failed or cancelled.</h2>";
}