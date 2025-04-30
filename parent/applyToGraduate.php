<div class="dashboard-content-one">
    <div class="container-fluid py-4">
        <div class="stepForm">
            <!-- Step 1 -->
            <div class="step1">
                <div class="card shadow-sm p-4">
                    <div class="text-center">
                        <h2 class="fw-bold"  style="color: #456fb6;">Instructions</h2>
                    </div>
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item border-0">
                            Student must have <span class='text-danger fw-bold'>22 hours</span> of High School coursework to graduate in Tennessee. 
                            This can be accomplished within 3 years and students may take High School credit classes in their 8th grade year.
                            <small class="d-block mt-2 text-muted">(1 CREDIT = A full year of study or 150 Hours - 0.5 Credit is one semester or 75hours)</small>
                        </li>
                        <li class="list-group-item border-0">Please do not apply for graduation if your student has not yet completed the <span class='text-danger fw-bold'>22 hours</span>.</li>
                        <li class="list-group-item border-0">Student must be at least 15 years of age to apply to graduate.</li>
                        <li class="list-group-item border-0">Upon receipt of this graduation application, one of our Graduation Specialists will contact you to set up a brief 10-to-15-minute phone call. During this call, we will review the student’s current transcript with the parent to ensure it is complete and ready for graduation.</li>
                        <li class="list-group-item border-0">Please note, although not required, taking the ACT or SAT in the student’s Junior or Senior year is strongly advised as most colleges and universities require this for admission.</li>
                        <li class="list-group-item border-0 text-danger">In order to graduate the student must be registered at Graduates Academy during the current academic year for which they are applying.</li>
                    </ol>

                    <div class="mt-4">
                        <a href="https://graduatesacademy.com/high-school-guide" class="btn blue-btn" target="_blank"> 
                            <i class="fas fa-eye me-2"></i>View Graduation Plan Options
                        </a>
                    </div>

                    <div class="mt-4">
                        <h5 class="fw-bold">Students for which this applies</h5>
                        <div class="card-body bg-light rounded">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="fas fa-circle me-2 text-primary"></i>
                                    We offer a Modified Diploma for high school students that are unable to complete their classes at a high school level (Special Needs Students). These are students who are expected to eventually live independently and be employed if they choose to. When entering class titles in your online parent portal please add the word "modified" to the start of the course name. For example, "Modified English 1".
                                </li>
                                <li>
                                    <i class="fas fa-circle me-2 text-primary"></i>
                                    We offer a Certificate of Completion for high school students that are unable to complete their classes at a high school level (Special Needs Students). These are students who are not expected to live independently or be employed. When entering class titles in your online parent portal please add the word "certificate" to the start of the course name. For example, "Certificate English 1".
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary px-4 py-2 back" onclick="window.history.back()">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </button>
                        <button class="btn btn-primary px-4 py-2 next_to_graduate_form">
                            Next <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="step2 hide">
                <div class="card shadow-sm p-4">
                    <div class="text-center">
                        <h2 class="fw-bold" style="color: #456fb6;">Student Information</h2>
                    </div>
                    <div class="parent_1" id="studentGraduationForm">
                        <input type="hidden" name="parent_email" id="parent_email" value="">
                        <input type="hidden" name="student_id" id="student_id" value="">
                        <div class="mb-4">
                            <div class="card bg-light" id="studentProfileCard">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="position-relative" style="width: 120px; height: 120px;">
                                            <img src="<?php echo plugin_dir_url(dirname(__FILE__))  . 'img/profile_default.jpg'; ?>"
                                                 id="studentProfileImage"
                                                 class="rounded-circle w-100 h-100 object-fit-cover border border-3 border-white shadow"
                                                 alt="Student Photo">
                                        </div>
                                        <div>
                                            <h4 class="card-title mb-1" id="studentNameDisplay"> <i class="fas fa-graduation-cap me-2"></i></h4>
                                            <p class="text-muted mb-0">
                                            <i class="fa-solid fa-book me-2"></i>Grade Level: <span id="studentGradeDisplay">N/A</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded" id="ageVerificationSection">
                                <select class="form-select graduate_ans1" id="studentAgeSelect" style="width: 100px">
                                    <option value="-1">Select</option>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                                <label class="form-label mb-0" for="studentAgeSelect">Is the student 15 years of age or older?</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded" id="courseWorkSection">
                                <select class="form-select graduate_ans2" id="courseWorkSelect" style="width: 100px">
                                    <option value="-1">Select</option>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                                <div>
                                    <label class="form-label mb-0" for="courseWorkSelect">Has the student completed 22 hours of High School coursework as required by the state of Tennessee to graduate?</label>
                                    <div class="text-danger fw-bold mt-1" id="gradesWarning">All Grades Must be Reported Before Applying to Graduate</div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="p-3 bg-light rounded" id="specialRequirementsSection">
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input check1" id="specialNeeds">
                                    <label class="form-check-label" for="specialNeeds">
                                        Please select if this student requires a Modified Diploma or Certificate of Completion. (Special Needs Students)
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input check2" id="allowChanges">
                                    <label class="form-check-label" for="allowChanges">
                                        Please select if you would like to allow us to make minor changes to the transcript to fix potential errors or issues.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded" id="enrollmentSection">
                                <select class="form-select graduate_ans3" id="enrollmentSelect" style="width: 100px">
                                    <option value="-1">Select</option>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                                <label class="form-label fw-bold mb-0" for="enrollmentSelect">Has the student been enrolled with us since the 9th grade or before?</label>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-primary btn-lg px-5 back_step1">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </button>
                            <button class="btn btn-primary btn-lg next_to_graduate_payment px-5" id="graduationNextBtn">
                                Next <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="step3 hide">
                <div class="card shadow-sm p-4">
                    <div class="text-center">
                        <h3 class="fw-bold"  style="color: #456fb6;">Payment Details</h3>
                    </div>

                    <!-- Mobile View Summary -->
                    <div class="d-block d-md-none mb-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        <strong>Graduation Application Fee</strong>
                                        <strong class="text-primary graduationAmount">$0.00</strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        <span class="text-success">Promo Code Discount</span>
                                        <span class="text-success discountAmount">-$0.00</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        <div class="form-check">
                                            <input class="form-check-input rushAmountMobile" type="checkbox" id="rushOrderMobile">
                                            <label class="form-check-label" for="rushOrderMobile">
                                                Rush Order (+$25)
                                                <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Orders will be processed within 12 hours"></i>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                        <strong>Total (USD)</strong>
                                        <strong class="text-primary totalAmount">$0.00</strong>
                                    </li>
                                </ul>

                                <!-- Promo Code Input -->
                                <div class="mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Enter promo code" id="coupon_code1">
                                        <button class="btn btn-primary applyCoupon">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop View Summary -->
                    <div class="d-none d-md-block mb-4">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="table-light">
                                    <tr>
                                        <th>Registration Details</th>
                                        <th>Student Name</th>
                                        <th>Cost</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-success">Promo code Discount</td>
                                        <td></td>
                                        <td></td>
                                        <td class="discountAmount text-success">-$0.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="input-group" style="max-width: 400px;">
                                                <input type="text" class="form-control" placeholder="Enter promo code" id="coupon_code">
                                                <button class="btn btn-primary applyCoupon">Apply Code</button>
                                            </div>
                                        </td>
                                        <td colspan="2">
                                            <div class="bg-light p-3 rounded">
                                                <span class="fw-bold">Total: </span>
                                                <span class="float-end totalAmount fw-bold text-primary">$0.00</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <div class="form-check">
                                                <input class="form-check-input rushAmountDesktop" type="checkbox" id="rushOrderDesktop">
                                                <label class="form-check-label" for="rushOrderDesktop">
                                                    Add Rush Processing (+$25)
                                                    <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Orders will be processed within 12 hours"></i>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center text-primary">
                        <h4>Make Payment</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Credit Card Form -->
                            <div class="card p-4 h-100">
                                <h5 class="mb-4 text-center text-primary">Pay with Stripe</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="">First Name<span style="color: red">*</span></label>
                                        <input type="text" id="firstNameStripe" name="firstName" placeholder="Enter your first name"
                                            class="form-control" style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Last Name<span style="color: red">*</span></label>
                                        <input type="text" id="lastNameStripe" name="lastName" placeholder="Enter your last name"
                                            class="form-control" style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="">Address<span style="color: red">*</span></label>
                                        <input type="text" id="addressStripe" name="address" placeholder="Enter your address"
                                            class="form-control" style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="">City<span style="color: red">*</span></label>
                                        <input type="text" id="cityStripe" name="city" placeholder="Enter your city"
                                            class="form-control" style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">State<span style="color: red">*</span></label>
                                        <input type="text" id="stateStripe" name="state" placeholder="Enter your state"
                                            class="form-control" style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Zip Code<span style="color: red">*</span></label>
                                        <input type="text" name="zip" class="form-control" id="zipStripe" placeholder="Enter your zip code"
                                            style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                            onKeyDown="if(this.value.length==5 && event.keyCode!=8) return false;" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="">Credit/Debit Card Number<span style="color: red">*</span></label>
                                        <div id="card_number" class="field"></div>
                                        <img src="<?php echo plugin_dir_url(dirname(__FILE__))  . 'img/cards.png'; ?>"
                                            style="border: none;" alt="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Expiration Date<span style="color: red">*</span></label>
                                        <div id="card_expiry" class="field"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">CVV or CVC<span style="color: red">*</span></label>
                                        <div id="card_cvc" class="field"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- PayPal Form -->
                            <div class="card p-4 h-100 d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <h5 class="mb-4 text-primary">Pay with PayPal</h5>
                                    <div id='paypal' class="mt-3 btn-primary"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn btn-primary btn-lg px-5 back_step2">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </button>
                        <button class="btn btn-primary btn-lg payOrder px-5">
                          Pay Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="Controllers/graduate.php" method="POST" id="graduationFrom" class='hide'>
        <input type="hidden" name="paypalId" id="paypalId" value="null">
        <input type="hidden" name="paidAmount" id="paidAmount" value="0">
        <input type="hidden" name="setAmountForCoupon" id="setAmountForCoupon" value="0">
        <input type="hidden" name="student_id" id="student_id">
        <input type="hidden" name="data" id="data">
        <input type="hidden" name='save' value="save">
    </form>
</div>

<script>
    // Initialize all tooltips
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl, {
                customClass: 'custom-tooltip'
            })
        })
    })
</script> 
 
<script type="text/javascript" src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>ajax/applyToGraduate_ajax_function.js"></script>

<!-- #################### PAYPAL PAYMENT Start ####################### -->

<!-- paypal script -->
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })

    // Render the PayPal button into #paypal-button-container
    paypal.Button.render({
        // Configure environment
        env: 'production', // for production
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
                        total:$('.totalAmount').html().replace('$', ''),
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
                var paidAmount =$('.totalAmount').html().replace('$', '');
                var transaction_id = data.paymentID;
                var coupon_code = $('#coupon_code').val() || $('#coupon_code1').val();

                // check the Rushfeeoption
                let rushfee = $(".rushAmountDesktop input[type='checkbox']").is(":checked") ? "high" : "low";

                let student_id = $('#student_id').val();
                // final submit 
                $.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    data: {
                        action: 'ajax_handle_apply_graduate_submit', // Required for WordPress AJAX
                        rushfee: rushfee,
                        transaction_id: transaction_id,
                        paidAmount: paidAmount,
                        coupon_code: coupon_code,
                        description: 'Graduates Academy - Apply to Graduate',
                        student_id: student_id,
                        type: 'final_submit',
                    },
                    success: function (response) {
                        try {
                            console.log(response);  
                            console.log(response.success);
                            if (response.success) {
                                $("body").removeClass("loading");
                                swal('', response.message || 'Application successful', "success").then(() => {
                                    window.location.href = '/students/';
                                });
                            } else {
                                $("body").removeClass("loading");
                                swal('', response.message || 'Application failed', "error").then(() => {
                                            window.location.reload();
                                        });
                            }
                        } catch (error) {
                            $("body").removeClass("loading");
                            swal('', 'Application processing error', "error").then(() => {
                                            window.location.reload();
                                        });
                        }
                    },
                });
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
</script>
<!-- #################### PAYPAL PAYMENT End ####################### -->


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
            lineHeight: '1.5',
            color: '#495057',
            backgroundColor: '#e8e8e8',
            padding: '8px 15px',
            borderRadius: '8px',
            '::placeholder': {
                color: '#6c757d',
            },
        },
        invalid: {
            color: '#dc3545',
        }
    };

    // Add custom styles for the stripe elements wrapper
    const stripeElementsStyle = `
        .StripeElement {
            background-color: #e8e8e8;
            border-radius: 8px;
            padding: 8px 15px;
            width: 100%;
            min-height: 35px;
        }
        .StripeElement--focus {
            outline: 0;
        }
        .StripeElement--invalid {
            border-color: #dc3545;
        }
    `;

    // Add the styles to the document
    const styleSheet = document.createElement("style");
    styleSheet.innerText = stripeElementsStyle;
    document.head.appendChild(styleSheet);

    var cardElement = elements.create('cardNumber', {
        style: style,
        placeholder: 'Enter card number'
    });
    cardElement.mount('#card_number');

    var exp = elements.create('cardExpiry', {
        style: style,
        placeholder: 'MM/YY'
    });
    exp.mount('#card_expiry');

    var cvc = elements.create('cardCvc', {
        style: style,
        placeholder: 'CVC'
    });
    cvc.mount('#card_cvc');

    // Validate input of the card elements
    var resultContainer = document.getElementById('paymentResponse');
    cardElement.addEventListener('change', function (event) {
        if (event.error) {
            swal('', event.error.message, "error");
        }
    });




    // Create single-use token to charge the user
    function createToken() {
        // Clear any existing error messages
        $('.error-message').remove();
        let error = 0;

        // get all data
        var f_name = $("#firstNameStripe").val();
        var l_name = $("#lastNameStripe").val();
        var name = $("#firstNameStripe").val() + ' ' + $("#lastNameStripe").val();
        var email = $('#parent_email').val();
        var address = $("#addressStripe").val();
        var city = $("#cityStripe").val();
        var state = $("#stateStripe").val();
        var zip = $("#zipStripe").val();
        var amount = $('.totalAmount').html().replace('$', '');
        var currency = 'usd';
        var description = 'Payment';

        if(f_name == ''){
            error = 1;
            $("#firstNameStripe").after('<span class="error-message" style="color: red;">Please enter your first name</span>');
        }

        if(l_name == ''){
            error = 1;
            $("#lastNameStripe").after('<span class="error-message" style="color: red;">Please enter your last name</span>');
        }

        if( address == ''){
            error = 1;
            $("#addressStripe").after('<span class="error-message" style="color: red;">Please enter your address</span>');
        }

        if( city == ''){
            error = 1;
            $("#cityStripe").after('<span class="error-message" style="color: red;">Please enter your city</span>');
        }

        if( state == ''){
            error = 1;
            $("#stateStripe").after('<span class="error-message" style="color: red;">Please enter your state</span>');
        }

        if( zip == ''){
            error = 1;
            $("#zipStripe").after('<span class="error-message" style="color: red;">Please enter your zip code</span>');
        }

        if( amount == ''){
            error = 1;
            $("#paidAmount").after('<span class="error-message" style="color: red;">Please enter your amount</span>');
        }

        if (error === 1) {
            return;
        }

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
                action: 'process_stripe_payment', 
                stripeToken: token.id,
                name: $("#firstNameStripe").val() + ' ' + $("#lastNameStripe").val(),
                email: $('#parent_email').val(),
                address: $("#addressStripe").val(),
                city: $("#cityStripe").val(),
                state: $("#stateStripe").val(),
                zip: $("#zipStripe").val(),
                amount:$('.totalAmount').html().replace('$', ''),
                currency: 'usd',
                description: 'Payment',
            },
            success: function (response) {
                try {
                    // console.log(response);  
                    const data = typeof response === 'string' ? JSON.parse(response) : response;
                    if (data && data.data && data.data.payment_status === 'succeeded') {
                        $("body").addClass("loading");
                        swal('', data.data.message || 'Payment successful', "success");
                        $("#paypalId").remove();

                        // check the Rushfee option
                        let rushfee = $(".rushAmountDesktop").is(":checked") ? "high" : "low";

                        let student_id = $('#student_id').val();
                        // finalize submission 
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            data: {
                                action: 'ajax_handle_apply_graduate_submit', // Required for WordPress AJAX
                                student_id: student_id,
                                rushfee: rushfee,
                                transaction_id: data.data.transaction_id,
                                description: 'Graduates Academy - Apply to Graduate',
                                paidAmount: data.data.amount,
                                coupon_code: $('#coupon_code').val() || $('#coupon_code1').val(),
                                type: 'final_submit',
                            },
                            success: function (response) {
                                try {
                                    // console.log(response);  
                                    if (response.success) {
                                        $("body").removeClass("loading");
                                        swal('', response.message || 'Application successful', "success").then(() => {
                                            window.location.href = '/students/';
                                        });
                                    } else {
                                        $("body").removeClass("loading");
                                        swal('', response.message || 'Application failed', "error").then(() => {
                                            window.location.reload();
                                        });
                                    
                                    }
                                } catch (error) {
                                    $("body").removeClass("loading");
                                    swal('', 'Application processing error', "error").then(() => {
                                            window.location.reload();
                                        });
                                }
                            },
                        });
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