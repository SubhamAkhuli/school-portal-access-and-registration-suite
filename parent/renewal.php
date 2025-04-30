<?php 
// get the aggerment page details
    $settings_page_id = 380; 
?>

<div class="container-fluid" id="grad1">
    <div class="card mt-3">
        <div class="row">
            <div class="col-md-12 mx-0">
                <form id="msform">
                    <fieldset class='bgChange step_1'>
                        <input type="hidden" id="Student_id" value="" />
                        <input type="hidden" id="Parent_id" value="" />
                        <input type="hidden" id="Address_id" value="" />
                        <input type="hidden" id="account_expire" value="" />
                        <!--################### Student Summary ########################  -->
                        <div class="student_summary">
                            <div class="card-body">
                                <p class="lead mb-3 text-primary  fw-bold">
                                    Please select the grade level this student will be in for the upcoming school year:
                                </p>
                                <h4 class="card-title border-bottom pb-2 text-primary  fw-bold"><i class="fas fa-user-graduate me-2"></i>Student Summary</h4>
                                <div class="student-list">
                                    <div class="card border-0 shadow-sm rounded-3 mb-4 bg-light">
                                        <div class="card-body p-4">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="form-check">
                                                        <input class="form-check-input student_check" type="checkbox" checked data-name="student_name" data-grade="" value="" id="student_name">
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="rounded-circle bg-white shadow-sm p-1 d-flex align-items-center justify-content-center">
                                                        <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'img/new_male_default.png'; ?>"  
                                                             alt="Student Photo" 
                                                             class="rounded-circle" 
                                                             id="student_photo"
                                                             style="width: 80px; height: 80px; object-fit: cover;">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h5 class="fw-bold text-primary mb-2 student_name">Student Name</h5>
                                                    <div class="mt-3">
                                                        <label class="form-label fw-semibold text-muted small mb-2">Select grade for upcoming school year:</label>
                                                        <div class="input-group input-group-sm">
                                                            <select class="form-select form-select-sm border border-light-subtle  shadow-sm rounded-3 py-2 student_grade" style="max-width: 250px; background-color: rgba(248, 249, 250, 0.8);">
                                                                <option value="-1">Select</option>
                                                                <option value="Kindergarten">Kindergarten</option>
                                                                <option value="1ST GRADE">1ST GRADE</option>
                                                                <option value="2ND GRADE">2ND GRADE</option>
                                                                <option value="3RD GRADE">3RD GRADE</option>
                                                                <option value="4TH GRADE">4TH GRADE</option>
                                                                <option value="5TH GRADE">5TH GRADE</option>
                                                                <option value="6TH GRADE">6TH GRADE</option>
                                                                <option value="7TH GRADE">7TH GRADE</option>
                                                                <option value="8TH GRADE">8TH GRADE</option>
                                                                <option value="9TH GRADE">9TH GRADE</option>
                                                                <option value="10TH GRADE">10TH GRADE</option>
                                                                <option value="11TH GRADE">11TH GRADE</option>
                                                                <option value="12TH GRADE">12TH GRADE</option>
                                                                <option value="8TH WITH HS CREDIT">8TH WITH HS CREDIT</option>
                                                                <option value="K8 SPECIAL NEEDS">K8 SPECIAL NEEDS</option>
                                                                <option value="HS SPECIAL NEEDS">HS SPECIAL NEEDS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button class="btn btn-primary me-3" onclick="window.history.back();">
                                        <i class="fas fa-arrow-left me-1"></i> Back
                                    </button> 
                                    <button class="btn btn-primary next_to_payment_btn">
                                        Save and Continue <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--################### Student Summary ########################  -->
                    </fieldset>
                    <fieldset class='step_2 hide'>
                        <div class="card rounded-3 border-0 shadow-sm mb-4 contact_information">
                            <div class="card-body p-4">
                                <h2 class="fs-4 text-primary  mb-3 fw-bold">
                                    <i class="fas fa-user-circle me-2"></i>Contact Information
                                </h2>
                                <hr class="mb-4">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="f_name" class="form-label text-muted small fw-semibold">First Name</label>
                                        <input type="text" name="f_name" id="f_name" class="form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2"
                                            value='' />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="m_name" class="form-label text-muted small fw-semibold">Middle Name</label>
                                        <input type="text" name="m_name" id="m_name" class="form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2"
                                            value='' />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="l_name" class="form-label text-muted small fw-semibold">Last Name</label>
                                        <input type="text" name="l_name" id="l_name" class="form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2"
                                            value='' />
                                    </div>
                                </div>
                                
                                <div class="row g-3 mt-2">
                                    <div class="col-md-4">
                                        <label for="email" class="form-label text-muted small fw-semibold">Email Address</label>
                                        <input type="email" name="email" id="email" class="form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2"
                                        value='' required />
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <label for="contact" class="form-label text-muted small fw-semibold">Phone Number</label>
                                        <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                            <select class="form-select border-0 country_code" id="country_code" name="country_code" style="max-width: 150px;">
                                            </select>
                                            <input type="tel" class="form-control border-0" id="contact" name="contact" 
                                                onkeyup="validateNumber(this.value,'#contact', $('#country_code').val())" 
                                                required>
                                            <input type="hidden" id="parent_phone" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card rounded-3 border-0 shadow-sm mb-4 address_box">
                            <div class="card-body p-4">
                                <h2 class="fs-4 text-primary  mb-3 fw-bold">
                                    <i class="fas fa-map-marker-alt me-2"></i>Address
                                </h2>
                                <hr class="mb-4">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="street_address" class="form-label text-muted small fw-semibold">Street Address*</label>
                                        <input value="" type="text" id='street_address' 
                                            class="form-control form-control-sm rounded-3 shadow-sm border-light-subtle py-2" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="city" class="form-label text-muted small fw-semibold">City*</label>
                                        <input value="" type="text" id='city' 
                                            class="form-control form-control-sm rounded-3 shadow-sm border-light-subtle py-2" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="zip_code" class="form-label text-muted small fw-semibold">Zip Code*</label>
                                        <input type="number" id='zip_code' 
                                            class="form-control form-control-sm rounded-3 shadow-sm border-light-subtle py-2"
                                            value="" 
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                            onKeyDown="if(this.value.length==5 && event.keyCode!=8) return false;" />
                                    </div>
                                </div>
                                
                                <div class="row g-3 mt-2 renewal_address_box">
                                    <div class="col-md-4">
                                        <label for="state" class="form-label text-muted small fw-semibold">State*</label>
                                        <select id="state" name="state" class="form-select form-select-sm rounded-3 shadow-sm border-light-subtle py-2">
                                            <option value='-1'>Select State</option>
                                            <option value='AL'>Alabama</option>
                                            <option value='AK'>Alaska</option>
                                            <option value='AZ'>Arizona</option>
                                            <option value='AR'>Arkansas</option>
                                            <option value='CA'>California</option>
                                            <option value='CO'>Colorado</option>
                                            <option value='CT'>Connecticut</option>
                                            <option value='DE'>Delaware</option>
                                            <option value='DC'>District of Columbia</option>
                                            <option value='FL'>Florida</option>
                                            <option value='GA'>Georgia</option>
                                            <option value='HI'>Hawaii</option>
                                            <option value='ID'>Idaho</option>
                                            <option value='IL'>Illinois</option>
                                            <option value='IN'>Indiana</option>
                                            <option value='IA'>Iowa</option>
                                            <option value='KS'>Kansas</option>
                                            <option value='KY'>Kentucky</option>
                                            <option value='LA'>Louisiana</option>
                                            <option value='ME'>Maine</option>
                                            <option value='MD'>Maryland</option>
                                            <option value='MA'>Massachusetts</option>
                                            <option value='MI'>Michigan</option>
                                            <option value='MN'>Minnesota</option>
                                            <option value='MS'>Mississippi</option>
                                            <option value='MO'>Missouri</option>
                                            <option value='MT'>Montana</option>
                                            <option value='NE'>Nebraska</option>
                                            <option value='NV'>Nevada</option>
                                            <option value='NH'>New Hampshire</option>
                                            <option value='NJ'>New Jersey</option>
                                            <option value='NM'>New Mexico</option>
                                            <option value='NY'>New York</option>
                                            <option value='NC'>North Carolina</option>
                                            <option value='ND'>North Dakota</option>
                                            <option value='OH'>Ohio</option>
                                            <option value='OK'>Oklahoma</option>
                                            <option value='OR'>Oregon</option>
                                            <option value='PA'>Pennsylvania</option>
                                            <option value='RI'>Rhode Island</option>
                                            <option value='SC'>South Carolina</option>
                                            <option value='SD'>South Dakota</option>
                                            <option value='TN'>Tennessee</option>
                                            <option value='TX'>Texas</option>
                                            <option value='UT'>Utah</option>
                                            <option value='VT'>Vermont</option>
                                            <option value='VA'>Virginia</option>
                                            <option value='WA'>Washington</option>
                                            <option value='WV'>West Virginia</option>
                                            <option value='WI'>Wisconsin</option>
                                            <option value='WY'>Wyoming</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="county" class="form-label text-muted small fw-semibold">County*</label>
                                        <select id="county" name="county" class="form-select form-select-sm rounded-3 shadow-sm border-light-subtle py-2">
                                            <option value="-1">Select County...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="emergency_name" class="form-label text-muted small fw-semibold">Emergency Contact Name*</label>
                                        <input value="" type="text" id='emergency_name' 
                                            class="form-control form-control-sm rounded-3 shadow-sm border-light-subtle py-2" />
                                    </div>
                                </div>
                                
                                <div class="row g-3 mt-2">
                                    <div class="col-md-6">
                                        <label for="emergency_number" class="form-label text-muted small fw-semibold">Emergency Contact Phone*</label>
                                        <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                            <select class="form-select border-0 country_code" id="emg_country_code" name="emg_country_code" style="max-width: 150px;">
                                            </select>
                                            <input type="tel" class="form-control border-0" id="emergency_number" name="emergency_number" 
                                                onkeyup="validateNumber(this.value,'#emergency_number', $('#emg_country_code').val())" 
                                                required>
                                                <input type="hidden" id="emergency_phoneNumber" value="">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <button name="previous" class='btn btn-primary previous_student_summery'>
                                <i class="fas fa-arrow-left me-2"></i> Back
                            </button>
                            <button class="btn btn-primary next_to_agreement">
                                Save and Continue <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </fieldset>
                    <fieldset class='step_3 hide'>
                        <div class="agreement">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h2 class="fs-4 text-primary fw-bold">
                                        <i class="fas fa-file-signature me-2"></i>Agreement
                                    </h2>
                                    <p class="text-muted small fw-semibold mb-0">
                                        Please scroll down to view all policies
                                    </p>
                                </div>
                                <hr class="mb-4">
                                <div class="card bg-light border-0 mb-4">
                                    <div class="card-body p-4" style="max-height: 350px; overflow-y: auto;">
                                        <!-- Get Agreement -->
                                        <?php echo get_field('agreement_page_privacy_policy_text', $settings_page_id); ?>
                                    </div>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="acceptAllPolicies">
                                    <label class="form-check-label fw-bold" for="acceptAllPolicies">
                                        I Accept All - I agree to all the above policies
                                    </label>
                                </div>
                                
                                <p class="text-muted small fw-semibold mb-3">By entering your name below you agree this is an electronic signature</p>
                                
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <input type="text" id="signature_f_name" class="form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2" placeholder="First Name" />
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="signature_l_name" class="form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2" placeholder="Last Name" />
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="signature_date" class="form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2 dob" placeholder="mm/dd/yyyy" value="<?php echo date('m-d-Y'); ?>"
                                        readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button name="previous" class="btn btn-primary previous_step_2">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </button>
                                <button class="btn btn-primary next_to_checkout">
                                    Save and Continue <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class='step_4 hide'>
                        <div class="form-card payment setAmount">
                            <div>
                                <h2 class="fs-4 text-primary fw-bold"><i class="fas fa-credit-card me-2"></i>Payment</h2>
                            </div>

                            <div class="row mobileView hide" style="background-color: white;padding-bottom: 20px;">
                                <div class="col-md-4 order-md-2 mb-4">
                                    <br>
                                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-muted"><i class="fas fa-bars"></i>
                                            Registrations</span>
                                    </h4>
                                    <ul class="list-group mb-3 mobileReg">

                                        <li class="list-group-item d-flex justify-content-between bg-light">
                                            <div class="text-success">
                                                <h6 class="my-0">Promo code</h6>
                                            </div>
                                            <span class="text-success discountAmount">0</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between bg-light">
                                            <label class="checkbox-inline rushAmountMobile" style="display: inline-flex;width: 100%;">
                                                <input style="width: 6%;height: 20px;margin-right: 7px;" type="checkbox" value="">Add $25 Rush
                                            </label>
                                            <i style="cursor: pointer; color: #007bff;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="If selected, rush orders will be processed within 12 hours"></i>
                                        </li>

                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Total (USD)</span>
                                            $<strong class="totalAmount">0.00</strong>
                                        </li>
                                    </ul>
                                    <div class="card p-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control showMessagePhone" placeholder="Promo code" id="coupon_code1">
                                            <div class="input-group-append" style="margin: auto;">
                                                <button class="applyCoupon btn-primary" id="applyCoupon1">Apply Coupon</button>
                                                <!-- <img class="applyCoupon" src="img/Apply Code Button.png" alt=""> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row " style="background-color: white;padding-bottom: 20px;">
                                <div class="col-md-12 table-responsive OtherThanMobileView">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"><i class="fas fa-bars"></i> Registration
                                                    Fees</th>
                                                <th scope="col">Number of Students</th>
                                                <th scope="col">Cost</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-success">Promo code Discount</td>
                                                <td></td>
                                                <td></td>
                                                <td class="discountAmount text-success"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"  class="showMessageDestop">
                                                    Promotion Code
                                                    <input type="text" id="coupon_code" style="font-size: 12px;padding: 8px 15px;width: 30%;border: none;background-color: #e8e8e8;border-radius: 8px;">
                                                    <button class="applyCoupon btn-primary" id="applyCoupon2"> <i class="fas fa-arrow-left me-2"></i>Apply Coupon</button>
                                                </td>
                                                <td colspan="2">
                                                    <div style="background-color: #c4c4c4;
                                                    padding: 7px 10px 7px 13px;
                                                    border-radius: 10px;
                                                    font-weight: bold;">
                                                        Total
                                                        $<span style="float: right;" class="totalAmount">0.00</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex mt-2">
                                                        <label class="checkbox-inline rushAmountDesktop" style="display: inline-flex;width: 100%;">
                                                            <input style="width: 10%;margin-right: 7px;" type="checkbox" value="">Add $25 Rush
                                                        </label>
                                                        <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="If selected, rush orders will be processed within 12 hours" data-bs-original-title="If selected, rush orders will be processed within 12 hours"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <h6 class="fs-4 text-primary fw-bold" >Personal Information</h6>
                                </div>
                                <br>
                                <br>
                                <div class="col-md-8">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="firstNameStripe" class="form-label text-muted small fw-semibold">First Name<span style="color: red">*</span></label>
                                            <input type="text" 
                                                id="firstNameStripe" 
                                                name="firstName" 
                                                placeholder="Enter your first name"
                                                class="form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2" />
                                        </div>
                                        <div class="col-md-4">
                                            <label for="lastNameStripe" class="form-label text-muted small fw-semibold">Last Name<span style="color: red">*</span></label>
                                            <input type="text" 
                                                id="lastNameStripe" 
                                                name="lastName" 
                                                placeholder="Enter your last name"
                                                class="form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2" />
                                        </div>
                                        <div class="col-md-4">
                                            <label for="addressStripe" class="form-label text-muted small fw-semibold">Address<span style="color: red">*</span></label>
                                            <input type="text" 
                                                id="addressStripe" 
                                                name="address" 
                                                placeholder="Enter your address"
                                                class="form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="cityStripe" class="form-label text-muted small fw-semibold">City<span style="color: red">*</span></label>
                                            <input type="text" 
                                                id="cityStripe" 
                                                name="city" 
                                                placeholder="Enter your city"
                                                class="form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2" />
                                        </div>
                                        <div class="col-md-4">
                                            <label for="stateStripe" class="form-label text-muted small fw-semibold">State<span style="color: red">*</span></label>
                                            <input type="text" 
                                                id="stateStripe" 
                                                name="state" 
                                                placeholder="Enter your state"
                                                class="form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2" />
                                        </div>
                                        <div class="col-md-4">
                                            <label for="zipStripe" class="form-label text-muted small fw-semibold">Zip Code<span style="color: red">*</span></label>
                                            <input type="text" 
                                                name="zip" 
                                                id="zipStripe" 
                                                placeholder="Enter your zip code"
                                                class="form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                onKeyDown="if(this.value.length==5 && event.keyCode!=8) return false;" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="card_number" class="form-label text-muted small fw-semibold">Credit/Debit Card Number<span style="color: red">*</span></label>
                                            <div id="card_number" class="field form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2"></div>
                                            <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'img/cards.png'; ?>"
                                                style="width: 170px; border: none; margin-top: 8px;" alt="Accepted cards">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="card_expiry" class="form-label text-muted small fw-semibold">Expiration Date<span style="color: red">*</span></label>
                                            <div id="card_expiry" class="field form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="card_cvc" class="form-label text-muted small fw-semibold">CVV or CVC<span style="color: red">*</span></label>
                                            <div id="card_cvc" class="field form-control form-control-sm shadow-sm rounded-3 border-light-subtle py-2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 text-center" id=payBox>
                                    <h5 class="fs-4 text-primary fw-bold" >Pay with PayPal</h5>
                                    <a id='paypal'
                                        style="padding: 10px 10px;font-size: 12px;letter-spacing: 1px;"
                                        class="action-button">Proceed to Paypal</a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button name="previous" class="btn btn-primary previous_step_3">
                                <i class="fas fa-arrow-left me-2"></i> Back
                            </button>
                            <button class="btn btn-primary payOrder">
                                Pay Now <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                        <button name="submitOrder" class="submitOrder hide"></button>
                    </fieldset>
                </form>

                <div class='appendCouponAmonnt'>
                </div>
                <input type="hidden" class="setAmountForCoupon">
                <div style='display:none'>
                    <form action="" method="post" id='studentsForm' enctype="multipart/form-data">
                        <input type="text" name="paypalId" id="paypalId" value="null">
                        <input type="text" name="paidAmount" id="paidAmount" value="0">

                        <div class="transactionItems">

                        </div>
                        <input type="text" name='save' value='save'>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Drop Down JS -->
<script type="text/javascript" src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>js/drop_down.js"></script> 
<script type="text/javascript" src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>ajax/renewal_function_ajax.js"></script>
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

                // Set data 
                let studentId = $("#Student_id").val();
                let studentGrade = $('.student_grade').val();
                let parentId = $("#Parent_Id").val();
                let f_name = $('.contact_information #f_name').val()
                let m_name = $('.contact_information #m_name').val()
                let l_name = $('.contact_information #l_name').val()
                let country_code = $('.contact_information #country_code').val()
                let phone = $('.contact_information #parent_phone').val()
                let email = $('.contact_information #email').val()

                let addressId = $("#Address_id").val();
                let street_address = $('.address_box #street_address').val();
                let city = $('.address_box #city').val();
                let zip_code = $('.address_box #zip_code').val();
                let state = $('.address_box #state').val();
                let county = $('.address_box #county').val();
                let emergency_name = $('.address_box #emergency_name').val();
                let emergency_country_code = $('.address_box #emg_country_code').val();
                let emergency_number = $('.address_box #emergency_phoneNumber').val();

                let privacy_check = $("#acceptAllPolicies").is(":checked");
                let signature_f_name = $("#signature_f_name").val();
                let signature_l_name = $("#signature_l_name").val();
                let signature_date = $("#signature_date").val();
                let account_expire = $("#account_expire").val();
                // final submit 
                $.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    data: {
                        action: 'ajax_handle_renewal_submit', // Required for WordPress AJAX
                        // registration_id: registration_id,
                        rushfee: rushfee,
                        transaction_id: data.data.transaction_id,
                        description: 'Graduates Academy - Renew Registration',
                        paidAmount: data.data.amount,
                        coupon_code: $('#coupon_code').val() || $('#coupon_code1').val(),
                        studentId: studentId,
                        studentGrade: studentGrade,
                        parentId: parentId,
                        account_expire : account_expire,
                        f_name: f_name,
                        m_name: m_name,
                        l_name: l_name,
                        country_code: country_code,
                        phone: phone,
                        email: email,
                        addressId: addressId,
                        street_address: street_address,
                        city: city,
                        zip_code: zip_code,
                        state: state,
                        county: county,
                        emergency_name: emergency_name,
                        emergency_country_code: emergency_country_code,
                        emergency_number: emergency_number,
                        privacy_check: privacy_check,
                        signature_f_name: signature_f_name,
                        signature_l_name: signature_l_name,
                        signature_date: signature_date,
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
            color: '#555',
            // backgroundColor: '#e8e8e8',
            padding: '10px',
            '::placeholder': {
                // color: '#888',
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
        // $('.error-message').remove();
        // console.log(event);
        if (event.error) {
            // if(event.elementType == 'cardNumber'){
            //     $("#card_number").after('<span class="error-message" style="color: red;">'+event.error.message+'</span>');
            // } else if(event.elementType == 'cardExpiry'){
            //     $("#card_expiry").after('<span class="error-message" style="color: red;">'+event.error.message+'</span>');
            // } else if(event.elementType == 'cardCvc'){
            //     $("#card_cvc").after('<span class="error-message" style="color: red;">'+event.error.message+'</span>');
            // }
            swal('', result.error.message, "error");
            // resultContainer.innerHTML = '<p>' + event.error.message + '</p>';
        } else {

            // $('.error-message').remove();
            // resultContainer.innerHTML = '';
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
        var email = $('.contact_information #email').val();
        var address = $("#addressStripe").val();
        var city = $("#cityStripe").val();
        var state = $("#stateStripe").val();
        var country = $("#countryStripe").val();
        var zip = $("#zipStripe").val();
        var amount = $('.totalAmount').html();
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

        if( email == ''){
            error = 1;
            $('.parent_1 #parent_email').after('<span class="error-message" style="color: red;">Please enter your email</span>');
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

        if( country == ''){
            error = 1;
            $("#countryStripe").after('<span class="error-message" style="color: red;">Please enter your country</span>');
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
                email: $('.contact_information #email').val(),
                address: $("#addressStripe").val(),
                city: $("#cityStripe").val(),
                state: $("#stateStripe").val(),
                country: $("#countryStripe").val(),
                zip: $("#zipStripe").val(),
                amount: $("#paidAmount").val(),
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

                        // get rid vlaue form the url
                            // var params = new window.URLSearchParams(window.location.search);
                            // var registration_id = params.get('rid');

                        // check the Rushfeeoption
                        let rushfee = $(".rushAmountDesktop input[type='checkbox']").is(":checked") ? "high" : "low";

                        // Set data 
                        let studentId = $("#Student_id").val();
                        let studentGrade = $('.student_grade').val();
                        let parentId = $("#Parent_Id").val();
                        let f_name = $('.contact_information #f_name').val()
                        let m_name = $('.contact_information #m_name').val()
                        let l_name = $('.contact_information #l_name').val()
                        let country_code = $('.contact_information #country_code').val()
                        let phone = $('.contact_information #parent_phone').val()
                        let email = $('.contact_information #email').val()

                        let addressId = $("#Address_id").val();
                        let street_address = $('.address_box #street_address').val();
                        let city = $('.address_box #city').val();
                        let zip_code = $('.address_box #zip_code').val();
                        let state = $('.address_box #state').val();
                        let county = $('.address_box #county').val();
                        let emergency_name = $('.address_box #emergency_name').val();
                        let emergency_country_code = $('.address_box #emg_country_code').val();
                        let emergency_number = $('.address_box #emergency_phoneNumber').val();

                        let privacy_check = $("#acceptAllPolicies").is(":checked");
                        let signature_f_name = $("#signature_f_name").val();
                        let signature_l_name = $("#signature_l_name").val();
                        let signature_date = $("#signature_date").val();
                        let account_expire = $("#account_expire").val();
                        // final submit 
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            data: {
                                action: 'ajax_handle_renewal_submit', // Required for WordPress AJAX
                                // registration_id: registration_id,
                                rushfee: rushfee,
                                transaction_id: data.data.transaction_id,
                                description: 'Graduates Academy - Renew Registration',
                                paidAmount: data.data.amount,
                                coupon_code: $('#coupon_code').val() || $('#coupon_code1').val(),
                                studentId: studentId,
                                studentGrade: studentGrade,
                                parentId: parentId,
                                account_expire : account_expire,
                                f_name: f_name,
                                m_name: m_name,
                                l_name: l_name,
                                country_code: country_code,
                                phone: phone,
                                email: email,
                                addressId: addressId,
                                street_address: street_address,
                                city: city,
                                zip_code: zip_code,
                                state: state,
                                county: county,
                                emergency_name: emergency_name,
                                emergency_country_code: emergency_country_code,
                                emergency_number: emergency_number,
                                privacy_check: privacy_check,
                                signature_f_name: signature_f_name,
                                signature_l_name: signature_l_name,
                                signature_date: signature_date,
                                type: 'final_submit',
                            },
                            success: function (response) {
                                try {

                                    // console.log(response);  
                                    const data = typeof response === 'string' ? JSON.parse(response) : response;
                                    if (data && data.data && data.data.success) {
                                        $("body").removeClass("loading");
                                        swal('', 'Renew Registration successful', "success");
                                        window.location.href = '/students/';
                                    } else {
                                        $("body").removeClass("loading");
                                        swal('', 'Renew Registration failed', "error");
                                        window.location.reload();      
                                    }
                                } catch (error) {
                                    $("body").removeClass("loading");
                                    swal('', 'Renew Registration processing error', "error");
                                    window.location.reload();
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

<!-- #################### JAVASCRIPT End ####################### -->
<div class="overlay"></div> 