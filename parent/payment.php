<style>
    .payment-method-option {
        position: relative;
    }

    .payment-method-input {
        position: absolute;
        opacity: 0;
    }

    .payment-method-label {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        font-size: 16px;
        color: #444;
        background: #fff;
        border: 2px solid #ddd;
        border-radius: 30px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .radio-circle {
        width: 20px;
        height: 20px;
        border: 2px solid #ddd;
        border-radius: 50%;
        display: inline-block;
        position: relative;
        transition: all 0.3s ease;
    }

    .payment-method-input:checked + .payment-method-label {
        border-color: #456fb6;
        background: #f8fff8;
    }

    .payment-method-input:checked + .payment-method-label .radio-circle {
        border-color: #456fb6;
    }

    .payment-method-input:checked + .payment-method-label .radio-circle:after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 10px;
        height: 10px;
        background: #456fb6;
        border-radius: 50%;
    }

    .payment-method-label:hover {
        border-color: #456fb6;
        box-shadow: 0 2px 8px rgba(76, 175, 80, 0.1);
    }
</style>

<div class="form-card PaymentPage hide">
    <div>
        <h2 class="fs-title text-center">Payment</h2>
    </div>
    <div class="payment-summary alert alert-info">
        <h4>Payment Details</h4>
        <p><strong>Amount:</strong><span id="showAmount"></span></p>
    </div>
    <div class="payment-options d-flex justify-content-center gap-5 align-items-center mb-4">
        <div class="payment-method-option">
            <input class="payment-method-input" type="radio" name="paymentMethod" id="paypalOption" value="paypal">
            <label class="payment-method-label" for="paypalOption">
                <span class="radio-circle"></span>
                PayPal
            </label>
        </div>
        <div class="payment-method-option">
            <input class="payment-method-input" type="radio" name="paymentMethod" id="stripeOption" value="stripe">
            <label class="payment-method-label" for="stripeOption">
                <span class="radio-circle"></span>
                Stripe
            </label>
        </div>
    </div>
    <!-- Stripe Payment -->
    <div class="col-md-8 stripe-payment hide mx-auto">
        <h5 class="mb-4 text-center">Pay with Stripe</h5>
        <input type="hidden" name="parent_email" class="parent_email" value="">
        <div class="row">
            <div class="col-md-6 mb-3 text-start">
                <label for="stripe_item_name" class="form-label">Item Name:</label>
                <input class="form-control bg-light" type="text" name="item_name" value="Graduates Academy - Registration" id="stripe_item_name" required>
            </div>
            <div class="col-md-6 mb-3 text-start">
                <label for="stripe_amount" class="form-label">Amount (USD):</label>
                <input class="form-control bg-light" type="text" name="amount" value="0.00" id="stripe_amount" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="firstNameStripe" class="form-label">First Name</label>
                <input type="text" id="firstNameStripe" name="firstName"
                    class="form-control" placeholder="Enter your first name" required />
            </div>
            <div class="col-md-6 mb-3">
                <label for="lastNameStripe" class="form-label">Last Name</label>
                <input type="text" id="lastNameStripe" name="lastName"
                    class="form-control" placeholder="Enter your last name" required />
            </div>
            <div class="col-md-12 mb-3">
                <label for="addressStripe" class="form-label">Address</label>
                <input type="text" id="addressStripe" name="address"
                    class="form-control" placeholder="1234 Main St" required />
            </div>
            <div class="col-md-4 mb-3">
                <label for="cityStripe" class="form-label">City</label>
                <input type="text" id="cityStripe" name="city"
                    class="form-control" placeholder="City" required />
            </div>
            <div class="col-md-4 mb-3">
                <label for="stateStripe" class="form-label">State</label>
                <input type="text" id="stateStripe" name="state"
                    class="form-control" placeholder="State" required />
            </div>
            <div class="col-md-4 mb-3">
                <label for="zipStripe" class="form-label">Zip Code</label>
                <input type="text" name="zip" id="zipStripe" class="form-control"
                    placeholder="Zip Code" required
                    oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                    onKeyDown="if(this.value.length==5 && event.keyCode!=8) return false;" />
            </div>
            <input type="hidden" id="countryStripe" name="country" class="form-control" value="US" />
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="card_number">Credit/Debit Card Number</label>
                <div id="card_number" placeholder="Card Number"></div>
                <img src="<?php echo plugin_dir_url(dirname(__FILE__))  . 'img/cards.png'; ?>"
                    style="width: 100%; margin-top: -30px;" alt="">
            </div>
            <div class="col-md-4 mb-3">
                <label for="card_expiry">Expiration Date</label>
                <div id="card_expiry" placeholder="MM/YY"></div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="card_cvc">CVV or CVC</label>
                <div id="card_cvc" placeholder="CVC"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <button class="btn save-btn payOrder">Pay Now with Stripe</button>
            </div>
        </div>
    </div>
    <!-- PayPal Payment -->
    <div class="col-md-8 paypal-payment mx-auto hide text-center">
        <h5 class="mb-4">Pay with PayPal</h5>
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="frmPaypal">
            <input type="hidden" name="parent_email" class="parent_email" value="">
            <div class="row">
                <div class="col-md-6 mb-3 text-start">
                    <label for="paypal_item_name" class="form-label">Item Name:</label>
                    <input class="form-control bg-light" type="text" name="item_name" value="Graduates Academy - Registration" id="paypal_item_name" required>
                </div>
                <div class="col-md-6 mb-3 text-start">
                    <label for="paypal_amount" class="form-label">Amount (USD):</label>
                    <input class="form-control bg-light" type="text" name="amount" value="120.00" id="paypal_amount" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3 text-start">
                    <label for="paypal_first_name" class="form-label">First Name</label>
                    <input type="text" id="paypal_first_name" name="first_name" class="form-control bg-light" placeholder="Enter your first name" required>
                </div>
                <div class="col-md-6 mb-3 text-start">
                    <label for="paypal_last_name" class="form-label">Last Name</label>
                    <input type="text" id="paypal_last_name" name="last_name" class="form-control bg-light" placeholder="Enter your last name" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3 text-start">
                    <label for="paypal_email" class="form-label">Email</label>
                    <input type="email" id="paypal_email" name="email" class="form-control bg-light" placeholder="Enter your email" required>
                </div>
            </div>
            <input type="hidden" name="return" value="<?php echo site_url(); ?>/payment-success">
            <input type="hidden" name="cancel_return" value="<?php echo site_url(); ?>/payment-cancelled">
            <button type="submit" class="btn save-btn" id="btnPaypal">Pay Now with PayPal</button>
        </form>
    </div>

    <div class="d-flex justify-content-center gap-4 align-items-center mt-4">
        <button class="btn save-btn backToOrderSummary">
            <i class="fa-solid fa-arrow-left me-1"></i> Go Back
        </button>
    </div>
</div> 

<form id="paypalForm" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="rumni@shreesols.in">
    <input type="hidden" name="item_name" value="Graduates Academy - Registration">
    <input type="hidden" name="amount" value="120.00">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="return" value="<?php echo site_url(); ?>/payment-success">
    <input type="hidden" name="cancel_return" value="<?php echo site_url(); ?>/payment-cancel">
</form>

<script src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>js/jquery-3.3.1.min.js"></script>

<script>
    // onchecked stripe payment
    $('input[name="paymentMethod"]').change(function () {
        if (this.value == 'stripe') {
            $('.stripe-payment').removeClass('hide');
            $('.paypal-payment').addClass('hide');
        } else {
            $('.stripe-payment').addClass('hide');
            $('.paypal-payment').removeClass('hide');
        }
    });

    $("#btnPaypal").on('click', function(){
        $("#paypalForm").submit();
        console.log('hits - n2');
        
    })

</script>

<!-- #################### STRIPE PAYMENT Start ####################### -->
<!-- Stripe JS library -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Create an instance of the Stripe object
    // Set your publishable API key
    // var stripe = Stripe(
    //     'pk_live_51NrlbjFIRs0H14H1CesuF6LJLc8swwWNz7TO5zumXm87lzNz9RYCWFf4VkOJRjPORYoywC2WAYcFZkANuv1g4EdK00F3bhUuKt'
    // );

    // Testing key
    var stripe = Stripe(
        'pk_test_51BTUDGJAJfZb9HEBwDg86TN1KNprHjkfipXmEDMb0gSCassK5T3ZfxsAbcgKVmAIXF7oZ6ItlZZbXO6idTHE67IM007EwQ4uN3'
    );

    // Create an instance of elements
    var elements = stripe.elements();

    var style = {
        base: {
            fontWeight: '400',
            fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
            fontSize: '12px',
            color: '#555',
            backgroundColor: '#e8e8e8',
            padding: '10px',
            '::placeholder': {
                color: '#888',
            },
        },
        invalid: {
            color: '#eb1c26',
        }
    };

    var cardElement = elements.create('cardNumber', {
        style: style
    });
    cardElement.mount('#card_number');

    var exp = elements.create('cardExpiry', {
        'style': style
    });
    exp.mount('#card_expiry');

    var cvc = elements.create('cardCvc', {
        'style': style
    });
    cvc.mount('#card_cvc');

    // Validate input of the card elements
    var resultContainer = document.getElementById('paymentResponse');
    cardElement.addEventListener('change', function (event) {
        if (event.error) {
            swal('', result.error.message, "error");
            // resultContainer.innerHTML = '<p>' + event.error.message + '</p>';
        } else {
            // resultContainer.innerHTML = '';
        }
    });




    // Create single-use token to charge the user
    function createToken() {
        stripe.createToken(cardElement).then(function (result) {
            if (result.error) {
                // Inform the user if there was an error
                swal('', result.error.message, "error");
                // resultContainer.innerHTML = '<p>' + result.error.message + '</p>';
            } else {
                // Send the token to your server
                // console.log(result);
                stripeTokenHandler(result.token);
            }
        });
    }

    // Callback to handle the response from stripe
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        //    console.log(token.id)
        $("body").addClass("loading");
        // $(".payOrder").addClass("loading");
        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                action: 'process_stripe_payment', // Required for WordPress AJAX
                stripeToken: token.id,
                name: $("#firstNameStripe").val() + ' ' + $("#lastNameStripe").val(),
                email: $('.PaymentPage .parent_email').val(),
                address: $("#addressStripe").val(),
                city: $("#cityStripe").val(),
                state: $("#stateStripe").val(),
                country: $("#countryStripe").val(),
                zip: $("#zipStripe").val(),
                amount: $('.totalAmount').html(),
                currency: 'usd',
                description: 'TEST',
            },
            success: function (response) {
                try {
                    // console.log(response);  
                    const data = typeof response === 'string' ? JSON.parse(response) : response;
                    if (data && data.data && data.data.payment_status === 'succeeded') {
                        $("body").addClass("loading");
                        swal('', data.data.message || 'Payment successful', "success");
                        $("#paypalId").remove();

                        // get rid vlaue form the url
                            // var params = new window.URLSearchParams(window.location.search);
                            // var registration_id = params.get('rid');

                        // check the Rushfeeoption
                        let rushfee = $(".rushAmountDesktop input[type='checkbox']").is(":checked") ? "high" : "low";

                        // final submit 
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            data: {
                                action: 'ajax_handle_final_submit', // Required for WordPress AJAX
                                // registration_id: registration_id,
                                rushfee: rushfee,
                                transaction_id: data.data.transaction_id,
                                description: 'Graduates Academy - Registration',
                                paidAmount: data.data.amount,
                                coupon_code: $('#coupon_code').val() || $('#coupon_code1').val(),
                                type: 'final_submit',
                            },
                            success: function (response) {
                                try {
                                    console.log(response);  
                                    const data = typeof response === 'string' ? JSON.parse(response) : response;
                                    if (data && data.data && data.data.success) {
                                        $("body").removeClass("loading");
                                        swal('', data.data?.message || 'Registration successful', "success").then(() => {
                                            window.location.href = '/students/';
                                        });
                                    } else {
                                        $("body").removeClass("loading");
                                        swal('', data.data?.message || 'Registration failed', "error").then(() => {
                                            window.location.reload();
                                        });
                                    
                                    }
                                } catch (error) {
                                    $("body").removeClass("loading");
                                    swal('', 'Registration processing error', "error").then(() => {
                                            window.location.reload();
                                        });
                                }
                            },
                        });

                        // if (jQuery("#studentsForm").length) {
                        //     jQuery("#studentsForm").prepend(
                        //         `<input type="text" name="paypalId" id="paypalId" value="${data.data.transaction_id}">
                        //         <input type="text" name="paidAmount" id="paidAmount" value="${$(data.data.amount)}">`

                        //     );
                        //     $('#studentsForm').submit();
                        // }

                        // if (jQuery("#graduationFrom").length) {
                        //     jQuery("#graduationFrom").prepend(
                        //         `<input type="text" name="paypalId" id="paypalId" value="${data.data.transaction_id}">`
                        //     );
                        //     // $('#graduationFrom').submit();
                        // }
                    } else {
                        $("body").removeClass("loading");
                        swal('', data.data?.message || 'Payment failed', "error");
                    }
                } catch (error) {
                    $("body").removeClass("loading");
                    swal('', 'Payment processing error', "error");
                }
            },
        })
    }
</script>
<!-- #################### STRIPE PAYMENT End ####################### -->

<!-- #################### PAYPAL PAYMENT Start ####################### -->
<!-- paypal script -->
<!-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> -->
<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })

    // Render the PayPal button into #paypal-button-container
    /* paypal.Button.render({
        // Configure environment
        env: 'sandbox', // for production
        client: {
            sandbox: 'AXWTwwnFD9B_xK_YZo2i39rHS8SPxiFviS-mJqfRiJb-E6cN_QE9dqf-rQerIvk52DjF37tu8IyyWbsr',
            production: 'AX7RWj2K2yVLd_sER2h_QZpjM9MMGgYYpw5RWX4ybqfQsH2vjNWVGuGdluZka61hjlhaD_bXcbfIpm0g'
        },

        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
            layout: 'horizontal',
            fundingicons: 'true',
        },

        // Set up a payment
        payment: function (data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: $("#paidAmount").val(),
                        // total: '100',
                        currency: 'USD'
                    }
                }]
            });
        },

        // Execute the payment
        onAuthorize: function (data, actions) {
            return actions.payment.execute().then(function () {
                // Show a confirmation message to the buyer
                bootbox.alert('Thank you for your purchase!');
                // console.log(data);
                // $("#paypalId").val(details.id);
                $("#paypalId").remove();

                // get rid vlaue form the url
                // var params = new window.URLSearchParams(window.location.search);
                // var registration_id = params.get('rid');
                var paidAmount = $("#paidAmount").val();
                var transaction_id = data.paymentID;
                var coupon_code = $('#coupon_code').val() || $('#coupon_code1').val();

                // check the Rushfeeoption
                let rushfee = $(".rushAmountDesktop input[type='checkbox']").is(":checked") ? "high" : "low";

                // final submit 
                $.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    data: {
                        action: 'ajax_handle_final_submit', // Required for WordPress AJAX
                        // registration_id: registration_id,
                        rushfee: rushfee,
                        transaction_id: transaction_id,
                        paidAmount: paidAmount,
                        coupon_code: coupon_code,
                        description: 'Graduates Academy - Registration',
                        type: 'final_submit',
                    },
                    success: function (response) {
                        try {
                            // console.log(response);  
                            const data = typeof response === 'string' ? JSON.parse(response) : response;
                            if (data && data.data && data.data.success) {
                                $("body").removeClass("loading");
                                swal('', data.data?.message || 'Registration successful', "success").then(() => {
                                    window.location.href = '/students/';
                                });
                            } else {
                                $("body").removeClass("loading");
                                swal('', data.data?.message || 'Registration failed', "error").then(() => {
                                            window.location.reload();
                                        });
                            }
                        } catch (error) {
                            $("body").removeClass("loading");
                            swal('', 'Registration processing error', "error").then(() => {
                                            window.location.reload();
                                        });
                        }
                    },
                });

                // if (jQuery("#studentsForm")) {
                //     jQuery("#studentsForm").prepend(
                //         `<input type="text" name="paypalId" id="paypalId" value="${data.paymentID}">`
                //     );
                //     // $('#studentsForm').submit();

                //     // $('.payOrder').addClass('hide');
                //     // $('.submitOrder').removeClass('hide');
                // }

                // if (jQuery("#graduationFrom")) {
                //     jQuery("#graduationFrom").prepend(
                //         `<input type="text" name="paypalId" id="paypalId" value="${data.paymentID}">`
                //     );
                //     $('#graduationFrom').submit();
                // }
                // $("#studentsForm #paypalId").val(data.paymentID);
                // $("#paidAmount").val($("#setAmount").val());
                // console.log("Success===>",data.paymentID);
                // console.log("Success===>",data);
                // $("#submit").click();
            });
        },

        onCancel: function (data, actions) {
            // console.log(data);
            // Show a cancel page or return to cart
            bootbox.alert("Payment failed to capture.");
        },

        onError: function (err) {
            // console.log("ERROR===>",err);
            // Show an error page here, when an error occurs
            bootbox.alert("Payment failed to capture.");
        }
    }, '#paypal');
    */
</script>
<!-- #################### PAYPAL PAYMENT End ####################### -->
