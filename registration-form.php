<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/form.css'; ?>">

<?php 
$settings_page_id = 380; 
?>

<!-- <style>
    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 18px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;

    }

    /* Hide the browser's default checkbox */
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border: 2px solid;
        border-radius: 15px;
    }

    /* On mouse-over, add a grey background color */
    .student_application .container:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .student_application .container input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .student_application .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .student_application .container input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .student_application .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .image-upload>input {
        display: none;
    }

    .image-frame {
        border: 2px solid #dee2e6;
        padding: 5px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: inline-block;
    }

    .ask_reg_year_box button {
    border: none;
    width:100%;
    margin: 10px 0;
    font-family: montserrat;
    font-size: 13px;
    padding: 10px 3px;
    text-align: center;
    transition: 0.5s;
    color: #FFF;
    background-color: #456fb6;
    border-radius: 10px;
    /* box-shadow: 0px 20px 18px -17px rgba(0,0,0,1); */
    cursor: pointer;
    border-radius: 8px;
    font-weight: 800;
    border: 1px solid #456fb6;
    }
    .ask_reg_year_box button:hover{
        background-color:#fff!important ;
    color: #456fb6;
    border: 1px solid #456fb6;
    }

    /* Tooltip in Student img */
    .custom-tooltip .tooltip-inner {
        background-color: #333;
        color: #fff;
        font-size: 14px;
        border-radius: 5px;
    }
    .custom-tooltip.bs-tooltip-top .tooltip-arrow::before {
        border-top-color: #333;
    }
  .add-c-table tr td{
    min-width:200px;
  }
</style> -->

<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-10 col-lg-10 text-center p-0 mt-3 mb-2">
            <h2><strong>REGISTRATION</strong></h2>
            <div class="card px-0 pb-0 mt-3 shadow bg-body rounded">
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <div id="msform">
                            
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active" id="account">
                                        <div>
                                            <img src="<?php echo plugin_dir_url(__FILE__) . 'img/Parent_Info_Complete.png'; ?>" alt="">
                                        </div>
                                        <strong>Parent / Guardian</strong>
                                    </li>
                                    <li id="personal">
                                        <div>
                                            <img src="<?php echo plugin_dir_url(__FILE__) . 'img/Progress Bar Students 2 Incomplete.png'; ?>" alt="">
                                        </div>
                                        <strong>Student</strong>
                                    </li>
                                    <li id="payment">
                                        <div>
                                            <img src="<?php echo plugin_dir_url(__FILE__) . 'img/Progress Bar  Agreement 3 Incomplete.png'; ?>" alt="">
                                        </div>
                                        <strong>Agreement</strong>
                                    </li>
                                    <li id="confirm">
                                        <div>
                                            <img src="<?php echo plugin_dir_url(__FILE__) . 'img/Progress Bar  Payment 4 Incomplete.png'; ?>" alt="">
                                        </div>
                                        <strong>Payment</strong>
                                    </li>
                                </ul> <!-- fieldsets -->
                                <fieldset>
                                    <!-- <button id="applyCoupon">Coupon</button> -->
                                    <!--################### Ask Registration Year ########################  -->
                                        <div class="ask_reg_year_box mt-5 mb-5">
                                            <div class="form-card">
                                                <h2 class="fs-title text-center">Please Select Which Year You Would Like To Register For!</h2>
                                                <div class="mt-5">
                                                    <div class="row mb-25">
                                                        <div class="col-md-6">
                                                            <button type="button" class="select_register_year_btn" data-current-year="1"><?php echo get_field('registration_page_button1', $settings_page_id); ?></button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="button" class="select_register_year_btn" data-current-year="2"><?php echo get_field('registration_page_button2', $settings_page_id); ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!--################### Ask Registration Year ########################  -->
                                    
                                    
                                    <!--################### Parent 1 Start ########################  -->
                                    <div class="parent_1 hide">
                                        <div class="form-card">
                                            <h2 class="fs-title text-center">Parent/Guardian # 1 <span
                                                    style="font-size: 13px;">(Parent
                                                    with Legal Custody of Child)</span></h2>
                                            <div class="row mb-25">
                                                <div class="col-md-6">
                                                    <label for="">Parent Category <span style="color: red">*</span></label>
                                                    <br>
                                                    <select name="role" id="role" class="form-select">
                                                        <option value="mother">Mother</option>
                                                        <option value="father">Father</option>
                                                        <option value="step-mother">Step-Mother</option>
                                                        <option value="step-father">Step-Father</option>
                                                        <option value="grand-father">Grandfather</option>
                                                        <option value="grand-mother">Grandmother</option>
                                                        <option value="guardian">Guardian</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Email Address <span style="color: red">*</span></label>
                                                    <input type="text" name="email" id="parent_email" class="form-control"  />
                                                </div>
                                            </div>

                                            <div class="row mb-25">
                                                <div class="col-md-6">
                                                    <label for="">Phone Number <span style="color: red">*</span></label>
                                                    <div class="row">
                                                        <div class="col-md-4 country_code pe-0">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="contact" id="parent_contact" autocomplete="off"
                                                                class="form-control"
                                                                onkeyup="validateNumber(this.value,'.parent_1 #parent_contact')" 
                                                                 />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-25">
                                                <div class="col-md-4">
                                                    <label for="">First Name <span style="color: red">*</span></label>
                                                    <input type="text" name="f_name" id="parent_f_name" class="form-control"  value='' />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Middle Name</label>
                                                    <input type="text" name="m_name" id="parent_m_name" class="form-control"  value='' />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Last Name <span style="color: red">*</span></label>
                                                    <input type="text" name="l_name" id="parent_l_name" class="form-control"  value='' />
                                                </div>
                                            </div>

                                            <div class="row mb-25">
                                                <div class="col-md-6">
                                                    <label for="">Academic Year to Enroll</label>
                                                    <!-- <input type="text" class="form-control payingYear">-->
                                                    <!-- <select class="form-control payingYear"></select> -->
                                                    <input type="text" class="form-control payingYear" readonly>
                                                </div>
                                        
                                                <div class="col-md-6">
                                                    <label for="heard_about_us">How did you hear about us?</label>
                                                    
                                                    <textarea cols="5" rows="1" name="heard_about_us" id="heard_about_us" class="form-control" placeholder="Please describe" ></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select ans1 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q1">
                                                    <label for="">Do You Have Legal Custody of the Child? <span style="color: red">*</span></label>
                                                </div>
                                                
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select ans2 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes" selected>YES</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q2">
                                                    <label for="">Do You Authorize SMS/Text Messages for Important
                                                        Notifications? <span style="color: red">*</span></label>
                                                </div>
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select ans3 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q3">
                                                    <label for="">Does this Parent/Guardian Have a High School Diploma
                                                        or
                                                        GED? <span style="color: red">*</span></label>
                                                </div>
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select select_center ans4">
                                                        <option value="-1">SELECT</option>
                                                        <option value="High School Diploma/GED">High School Diploma/GED
                                                        </option>
                                                        <option value="Associate">Associate's</option>
                                                        <option value="Bachelor">Bachelor's</option>
                                                        <option value="Master">Master's</option>
                                                        <option value="Doctorate/PHD">Doctorate/PHD</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q4">
                                                    <label for="">Highest Level of Education? <span style="color: red">*</span></label>
                                                </div>
                                                
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select ans5 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q5">
                                                    <label for="">Does this Parent/Guardian Live in the Same Home as the
                                                        Student?  <span style="color: red">*</span></label>
                                                </div>
                                                
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select ans6 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q6">
                                                    <label for="">Are you a United States Citizen? <span style="color: red">*</span></label>
                                                </div>
                                                
                                            </div>
                                        </div>
                                            <button  class=" btn save-btn next_to_parent_2">Save and Continue</button>
                                        <!-- <img src="<?php echo plugin_dir_url(__FILE__) . 'img/Save and Continue Button.png'; ?>"
                                            class="next_to_parent_2" alt=""> -->
                                    </div>
                                    <!--################### Parent 1 End ########################  -->

                                    <!--################### Parent 2 Start ########################  -->
                                    <div class="parent_2 hide">
                                        <div class="form-card">
                                            <h2 class="fs-title text-center">Parent/Guardian # 2  <span style="font-size: 13px;">(Not
                                                    Required)</span></h2>
                                            <div class="row mb-25">
                                                <div class="col-md-6">
                                                    <label for="">Parent Category <span style="color: red">*</span></label>
                                                    <br>
                                                    <select name="role" id="role" class="form-select">
                                                        <option value="father">Father</option>
                                                        <option value="mother">Mother</option>
                                                        <option value="step-mother">Step-Mother</option>
                                                        <option value="step-father">Step-Father</option>
                                                        <option value="grand-father">Grandfather</option>
                                                        <option value="grand-mother">Grandmother</option>
                                                        <option value="guardian">Guardian</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Email Address <span style="color: red">*</span></label>
                                                    <input type="text" name="email" id="email" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row mb-25">
                                                <div class="col-md-6">
                                                    <label for="">Phone Number <span style="color: red">*</span></label>
                                                    <div class="row">
                                                        <div class="col-md-4 country_code pe-0">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="contact" id="contact" class="form-control"
                                                                onkeyup="validateNumber(this.value,'.parent_2 #contact')"
                                                                 />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-25">
                                                <div class="col-md-4">
                                                    <label for="">First Name <span style="color: red">*</span></label>
                                                    <input type="text" name="f_name" id="f_name" class="form-control" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Middle Name</label>
                                                    <input type="text" name="m_name" id="m_name" class="form-control" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Last Name <span style="color: red">*</span></label>
                                                    <input type="text" name="l_name" id="l_name" class="form-control" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row reg_1 ">
                                                <div class="col-md-2">
                                                    <select class="form-select ans1 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes" selected>YES</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q1">
                                                    <label for="">Do You Authorize SMS/Text Messages for Important
                                                        Notifications? <span style="color: red">*</span></label>
                                                </div>
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select ans2 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q2">
                                                    <label for="">Does this Parent/Guardian Have a High School Diploma
                                                        or GED? <span style="color: red">*</span></label>
                                                </div>
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select select_center ans3">
                                                        <option value="-1">SELECT</option>
                                                        <option value="High School Diploma/GED">High School Diploma/GED 
                                                        </option>
                                                        <option value="Associate">Associate's</option>
                                                        <option value="Bachelor">Bachelor's</option>
                                                        <option value="Master">Master's</option>
                                                        <option value="Doctorate/PHD">Doctorate/PHD</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q3">
                                                    <label for="">Highest Level of Education? <span style="color: red">*</span></label>
                                                </div>
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select ans4 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q4">
                                                    <label for="">Does this Parent/Guardian Live in the Same Home as the
                                                        Student? <span style="color: red">*</span> </label>
                                                </div>
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select ans5 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q5">
                                                    <label for="">Are You a United States Citizen? <span style="color: red">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-md-flex justify-content-md-center gap-4 align-items-md-center">
                                            <button class="btn save-btn parent2_back_btn">Back</button>
                                            <button class="btn save-btn next_to_additional_info">Save and Continue</button>
                                        </div>
                                        <!-- <img style="margin-top: -4px;" class='parent2_back_btn'
                                            src="<?php echo plugin_dir_url(__FILE__) . 'img/Back Button.png'; ?>" alt="">
                                        <img src="<?php echo plugin_dir_url(__FILE__) . 'img/Save and Continue Button.png'; ?>"
                                            class="next_to_additional_info" alt=""> -->
                                    </div>
                                
                                    <!-- <div style="text-align:right;width:94.5%;"> -->

                                    <!-- <a type="button" class="update_1 action-button">Save & Continue <i
                                            class="fas fa-arrow-right"></i></a> -->
                                    <!-- <a type="button" name="previous" class="previous hide" value="Previous"a> </a>  -->

                                    <!-- <a type="button" name="next" class="hide next step_1 action-button ">Save & Continue
                                        <i class="fas fa-arrow-right"></i></a> -->
                                    <!-- </div> -->
                                    <!--################### Parent 2 End ########################  -->


                                    <!--################### Aditional Info Start ########################  -->
                                    <div class="additional_info hide">
                                        <div class="form-card">
                                            <h2 class="fs-title text-center">Additional Information</h2>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4 class="show-message">Do Any of the Following Apply to Any Parent
                                                        or Student?</h4>
                                                </div>
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select ans1 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q1">
                                                    <label for="">Actively on Probation? <span style="color: red">*</span></label>
                                                </div>
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select ans2 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q2">
                                                    <label for="">Currently Being Investigated for Abuse or Neglect
                                                        (Physical or Educational)? <span style="color: red">*</span></label>
                                                </div>
                                               
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select ans3 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q3">
                                                    <label for="">Currently Being Investigated And/Or Charged With a
                                                        Misdemeanor of Felony? <span style="color: red">*</span></label>
                                                </div>
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select ans4 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q4">
                                                    <label for="">Currently Involved in an Open Criminal Court Case that
                                                        Could Lead to a Misdemeanor of Felony?<span style="color: red">*</span></label>
                                                </div>

                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-2">
                                                    <select class="form-select ans5 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-10 q5">
                                                    <label for="">Does Any Student Have a History of Truancy or
                                                        Expulsion issues?<span style="color: red">*</span></label>
                                                </div>
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-12 explanation hide" >
                                                    <b style="font-size: 16px;color:black">
                                                        Please list which student(s) this applies to and describe your
                                                        current situation:
                                                    </b>
                                                    <textarea cols="10" rows="5" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <input type="button" name="previous" class="previous hide action-button-previous" value="Previous" />  -->
                                        <!-- <img style="margin-top: -4px;" class='additional_info_back_btn'
                                            src="<?php echo plugin_dir_url(__FILE__) . 'img/Back Button.png'; ?>" alt="">
                                        <img class='additional_info_btn' src="<?php echo plugin_dir_url(__FILE__) . 'img/Save and Continue Button.png'; ?>"
                                            alt=""> -->
                                            <div class="d-md-flex justify-content-md-center gap-4 align-items-md-center">
                                            <button class="btn save-btn additional_info_back_btn">Back</button>
                                            <button class="btn save-btn additional_info_btn">Save and Continue</button>
                                        </div>
                                    </div>
                                    <!--################### Aditional Info End ########################  -->


                                    <!--################### Student Application Start ########################  -->
                                    <div class="student_application hide">
                                        <div class="form-card">
                                            <h2 class="fs-title text-center">Student Application</h2>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                <h2 class="show-message fs-title">
                                                    <span style="font-size: 16px;">With many family
                                                        situations and arrangements, please select all the following
                                                        statements that apply in regards to the student(s) involved in this
                                                        application.
                                                    </span>
                                                </h2>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="container mb-4">Currently involved in an open custody case
                                                        of an enrolling student
                                                        <input type="checkbox" class='check1'>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="container mb-4">Currently a foster parent(s) of an
                                                        enrolling student
                                                        <input type="checkbox" class='check2'>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="container mb-4">Currently have Power of Attorney for an
                                                        enrolling student
                                                        <input type="checkbox" class='check3'>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="container mb-4">Currently are in the process of adoption of
                                                        an enrolling student
                                                        <input type="checkbox" class='check4'>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="container mb-4">Other unique family situation
                                                        <input type="checkbox" class='check5'>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="container mb-4">None of the above
                                                        <input type="checkbox" class='check6'>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-12 description hide">
                                                    <b style="font-size: 16px;color:black">
                                                        Please list which student(s) this applies to and describe your
                                                        current situation:
                                                    </b>
                                                    <textarea cols="10" rows="5" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-md-flex justify-content-md-center gap-4 align-items-md-center">
                                            <button class="btn save-btn student_application_back_btn">Back</button>
                                            <button class="btn save-btn student_application_next_btn">Save and Continue</button>
                                        </div>
                                        <!-- <img style="margin-top: -8px;" class='student_application_back_btn'
                                            src="<?php echo plugin_dir_url(__FILE__) . 'img/Back Button.png'; ?>" alt="">
                                        <img src="<?php echo plugin_dir_url(__FILE__) . 'img/Save and Continue Button.png'; ?>"
                                            class="student_application_next_btn" alt=""> -->
                                    </div>
                                    <!--################### Student Application End ########################  -->


                                    <!--################### Legal Document Start ########################  -->
                                    <div class="legal_document hide">
                                        <div class="form-card">
                                            <h2 class="fs-title text-center">LEGAL DOCUMENT</h2>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label> Please
                                                        send any necessary legal documents including parenting plans,
                                                        adoption paperwork court orders, or guardianship documents.
                                                    </label>
                                                </div>
                                                <div class="col-md-12">
                                                    <div>
                                                        <label>We request birth certificates for the protection of you
                                                            and your students.</label>
                                                        <label> Birth certificates are only required in the following
                                                            instances</label>
                                                        <ul style="padding-left: 18px;">
                                                            <li><label for="">The student has been adopted</label></li>
                                                            <li><label for="">The applicant has legal guardianship of
                                                                    the student(s)</label></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label>Please email file(s) to: <span
                                                            style="color:#6891a7">records@graduatesacademy.com</span>
                                                    </label><br>
                                                    <label>Or please feel free to mail us a copy</label><br>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="d-md-flex justify-content-md-center gap-4 align-items-md-center">
                                            <button class="btn save-btn legal_document_back_btn">Back</button>
                                            <button class="btn save-btn legal_document_next_btn">Save and Continue</button>
                                        </div>
                                        <!-- <img style="margin-top: -8px;" class='legal_document_back_btn'
                                            src="<?php echo plugin_dir_url(__FILE__) . 'img/Back Button.png'; ?>" alt="">
                                        <img src="<?php echo plugin_dir_url(__FILE__) . 'img/Save and Continue Button.png'; ?>"
                                            class="legal_document_next_btn" alt=""> -->
                                    </div>
                                    <!--################### Legal Document End ########################  -->

                                    <!--################### Address Start ########################  -->
                                    <div class="address_box hide">
                                        <div class="form-card">
                                            <h2 class="fs-title text-center">Address</h2>
                                            <!-- <hr> -->
                                            <div class="row mb-25">
                                                <div class="row mb-25">
                                                    <div class="col-md-6">
                                                        <label for="">Street Address<span style="color: red">*</span></label>
                                                        <input type="text" id='street_address' class="form-control" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">City<span style="color: red">*</span></label>
                                                        <input type="text" id='city' class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="row mb-25">
                                                    <div class="col-md-6">
                                                        <label for="">Zip Code<span style="color: red">*</span></label>
                                                        <input type="number" id='zip_code' class="form-control"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                            onKeyDown="if(this.value.length==5 && event.keyCode!=8) return false;" />
                                                    </div>
                                            
                                                    <div class="col-md-6">
                                                        <label for="">State<span style="color: red">*</span></label>
                                                        <select id="state" name="state" class="form-select">
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

                                                            <option value='WY'>Wyoming</option>                                                  </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-25">
                                                    <div class="col-md-6">
                                                        <label for="">County<span style="color: red">*</span></label>
                                                        <select id="county" name="county" class="form-control">
                                                            <option value="-1">County..</option>
                                                        </select>
                                                    </div>
                                                
                                                    <div class="col-md-6">
                                                        <label for="">Emergency Contact Name<span style="color: red">*</span></label>
                                                        <input type="text" id='emergency_name' class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="row mb-25">
                                                    <div class="col-md-6">
                                                        <label for="">Emergency Contact Number<span style="color: red">*</span></label>
                                                        <div class="row">
                                                            <div class="col-md-4 country_code">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id='emergency_number' class="form-control numberFormat"      autoComplete="off"                                                           onkeyup="validateNumber(this.value,'.address_box #emergency_number')"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <input type="button" name="previous" class="previous hide studentSummaryPrevious action-button-previous" value="Previous" />  -->
                                        <!-- <img style="margin-top: -4px;" class='address_back_btn'
                                            src="<?php echo plugin_dir_url(__FILE__) . 'img/Back Button.png'; ?>" alt="">
                                        <img class='next_to_add_student' src="<?php echo plugin_dir_url(__FILE__) . 'img/Save and Continue Button.png'; ?>"
                                            alt=""> -->
                                            <div class="d-md-flex justify-content-md-center gap-4 align-items-md-center">
                                            <button class="btn save-btn address_back_btn">Back</button>
                                            <button class="btn save-btn next_to_add_student">Save and Continue</button>
                                        </div>
                                    </div>

                                    <!-- to progress the bar -->
                                    <a type="button" name="next" class="hide next step_1 action-button ">Save & Continue
                                    <i class="fas fa-arrow-right"></i></a>
                                    <!--################### Address End ########################  -->

                                </fieldset>

                            
                                <fieldset class='bgChange'>
                                    <!--################### Add Student ########################  -->
                                    <div class='add_student hide'>
                                        <div class="form-card show addStudent">
                                            <h2 class="fs-title text-center">Student</h2>
                                            <!-- <hr> -->
                                            <div class="row mb-25">
                                                <div class="col-md-4">
                                                    <label for="">First Name<span style="color: red">*</span></label>
                                                    <input type="text" id='student_f_name' name="uname"
                                                        autoComplete='off' class="form-control" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Middle Name</label>
                                                    <input type="text" id='student_m_name' name="pwd" autoComplete='off'
                                                        class="form-control" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Last Name<span style="color: red">*</span></label>
                                                    <input type="text" id='student_l_name' name="cpwd"
                                                        autoComplete='off' class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row mb-25">
                                                <div class="col-md-4">
                                                    <label for="">Date of Birth<span style="color: red">*</span></label>
                                                    <br>
                                                    <input type="date" id='dob' name="" 
                                                        class="form-control dob" 
                                                        max="<?php echo date('Y-m-d'); ?>"
                                                        onchange="this.className=(this.value!=''?'form-control dob has-value':'form-control dob')" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">State Student Resides In<span style="color: red">*</span></label>
                                                    <br>
                                                    <select id="state" name="state" class="form-select">
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
                                                    <label for="">County<span style="color: red">*</span></label>
                                                    <select id="county" name="county" class="form-select">
                                                        <option value="-1">County...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-25">
                                                <div class="col-md-4 hide">
                                                    <label for="">Country Student Resides In And/Or Is Zoned
                                                        For<span style="color: red">*</span></label>
                                                    <select id="country" name="country" class="form-select">
                                                        <option value="USA">USA</option>
                                                    </select>
                                                </div>
                                        
                                                <div class="col-md-4">
                                                    <label for="">Age <span style="color: red">*</span></label>
                                                    
                                                    <!-- <select name="" id="age" class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                    </select> -->
                                                    <input type="number" id='age' name="" 
                                                        class="form-control" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Grade<span style="color: red">*</span></label>
                                                    
                                                    <select name="" id="student_grade" class="form-select">
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
                                                        <option value="8TH WITH HS CREDIT">8TH WITH HS CREDIT</option>
                                                        <option value="9TH GRADE">9TH GRADE</option>
                                                        <option value="10TH GRADE">10TH GRADE</option>
                                                        <option value="11TH GRADE">11TH GRADE</option>
                                                        <option value="12TH GRADE">12TH GRADE</option>
                                                        <option value="K8 SPECIAL NEEDS">K-8 SPECIAL NEEDS</option>
                                                        <option value="HS SPECIAL NEEDS">HS SPECIAL NEEDS</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Gender<span style="color: red">*</span></label>
                                                    <br>
                                                    <select name="" id="gender" class="form-select">
                                                        <option selected value="-1">Select</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option value="n/a">Prefer Not to Provide</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <div class="row mb-25">
                                                <div class="col-md-4">
                                                </div>
                                            </div> -->
                                            <div class="row mb-25">
                                                <div class="col-md-12 text-end mb-3">
                                                <button onclick="window.open('https://graduatesacademy.com/coming-soon/', '_blank')" class="btn" style="background-color: #456fb6; color: #fff;">
                                                    <i class="fas fa-map-marker-alt"></i> View Co-op Map Near You
                                                </button>
                                                </div>
                                                <div class="form-group">
                                                    <label for="coop_name">Please specify the name of the co-op this child will attend this year<span style="color: red">*</span> <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="We collect this information in order to better serve our students and the various homeschool co-ops they attend."></i></label>
                                                    <input type="text" id="coop_name" name="coop_name" class="form-control" placeholder="Type 'N/A' if not applicable or 'Don't Know' if unsure.">
                                                </div>
                                            </div>
                                            <!-- <br> -->
                                            <div class="row reg_1">
                                            
                                                <div class="col-md-10">
                                                    <label class="q1"for="">Are both parents (when applicable) in agreement to
                                                        homeschooling this student and registering them with Graduates Academy?<span style="color: red">*</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-2 pl-1">
                                                    <select class="form-select ans1 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                        <option value="not applicable">Not Applicable</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-12 please_describe hide">
                                                        <label for="please_describe"><span style="color: red">*</span>Please Describe:</label>
                                                        <input type="text" id="please_describe" name="please_describe" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row reg_1">
                                                
                                                <div class="col-md-10">
                                                    <label class="q2" for="">Truancy/Expulsion - Does this Student have prior
                                                        truancy, expulsion, suspension, or misdemeanor issues? <span style="color: red">*</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-2 pl-1">
                                                    <select class="form-select ans2 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row reg_1">
                                                <div class="col-md-10">
                                                    <label class="q3" for="">
                                                        Is this Student transferring from another school or umbrella
                                                        program?<span style="color: red">*</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-2 pl-1">
                                                    <select class="form-select ans3 select_center">
                                                        <option value="-1">SELECT</option>
                                                        <option value="no">NO</option>
                                                        <option value="yes">YES</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                 <!-- Student Profile Photo Column -->
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-start bg-light p-3 rounded border gap-3" style="height: 150px;">
                                                        <!-- Profile Image Preview -->
                                                        <div class="mb-2">
                                                            <img id="preview-profile-img" onclick="document.getElementById('student-profile').click();"
                                                                    src="<?php echo plugin_dir_url(dirname(__FILE__))  . 'img/new_male_default.png'; ?>" 
                                                                    alt="Profile Preview"
                                                                    class="rounded-circle border p-1"
                                                                    style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;">
                                                        </div>
                                                            
                                                        <!-- Text Content with Upload Button -->
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <h6 class="mb-0 me-2">Student Profile Photo</h6>
                                                                <i style="cursor: pointer; color: #456fb6;" 
                                                                    class="fa fa-info-circle" 
                                                                    data-bs-toggle="tooltip" 
                                                                    data-bs-placement="right" 
                                                                    title="If you prefer, please upload an optional close-up picture of your child.">
                                                                </i>
                                                            </div>
                                                            
                                                            <input type="file" id="student-profile" accept="image/*" class="d-none">
                                                            <button type="button" 
                                                                    onclick="document.getElementById('student-profile').click();" 
                                                                    class="btn save-btn">
                                                                <i class="fas fa-camera me-1"></i> Upload
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Immunization Records Column -->
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex align-items-start bg-light p-3 rounded border gap-3" style="height: 150px;">
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-0 me-2">Immunization Records <span class="text-muted small">(not required)</span></h6>
                                                            
                                                            <input type="file" id="immunization_file" class="d-none">
                                                            <button type="button" 
                                                                    onclick="document.getElementById('immunization_file').click();" 
                                                                    class="btn save-btn mt-2">
                                                                <i class="fas fa-file-upload me-1"></i> Upload
                                                            </button>
                                                            
                                                            <!-- File Name Display -->
                                                            <div class="show_immunization_file_name mt-2">
                                                                <small class="text-muted"></small>
                                                            </div>
                                                            <input id="immunization_file_url" type="hidden">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- to save student id  -->
                                            <input type="hidden" id="student_id" value="0">
                                            <br>
                                            <div class="d-md-flex justify-content-md-center gap-4 align-items-md-center">
                                            <button class="btn save-btn add_student_back_btn">Back</button>
                                            <button class="btn save-btn next_to_student">Save and Continue</button>
                                        </div>
                                            <!-- <div class="row">
                                                <div class="col-md-6">
                                                    <img style="margin-top: 12px;height: 87px;"
                                                        class='add_student_back_btn' src="<?php echo plugin_dir_url(__FILE__) . 'img/Back Button.png'; ?>" alt="">
                                                </div>
                                                <div class="col-md-6">
                                                    <img style="float:right" class="next_to_student"
                                                        src="<?php echo plugin_dir_url(__FILE__) . 'img/Save and Continue Button.png'; ?>" alt="">
                                                </div>
                                            </div> -->
                                        </div>
                                        <!-- <img style="margin-top: -4px;" name="previous" class='previous back_to_step_2'
                                            src="<?php echo plugin_dir_url(__FILE__) . 'img/Back Button.png'; ?>" alt="">
                                        <img style="margin-top: 6px;" name="next" class="addStudentButton"
                                            src="img/Add a Student Button.png" alt="">
                                        <img name="next" class="hide step_2 showSummary addStudent"
                                            src="img/Save and Continue Button.png" alt=""> -->

                                    </div>
                                    <!--################### Add Student ########################  -->


                                    <!--################### Student Transfer ########################  -->
                                    <div class="student_transfer hide">
                                        <div class="form-card">
                                            <h2 class="fs-title text-center">Student Transfer Page
                                                <span class='for_additional hide'>- Additional Student</span>
                                            </h2>
                                            <!-- <hr> -->
                                            <div class="row">
                                                <div class="col-md-12 for_additional hide mb-25">
                                                    <label for="">Information Same As Previous Student</label>
                                                    <select name="" id="set_additional_values" class="form-select">
                                                        <option value="no">No</option>
                                                        <option value="yes">Yes</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Type of School Transferring From?<span style="color: red">*</span> </label>
                                                    <select name="" id="school_type" class="form-select">
                                                        <option value="public school">Public School</option>
                                                        <option value="private school">Private School</option>
                                                        <option value="online program">Online Program</option>
                                                        <option value="umbrella school">Umbrella School</option>
                                                        <option value="homeschooled through county/district office">
                                                            Homeschooled Through County/District Office
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row mb-25">
                                                <div class="col-md-6">
                                                    <label for="">School Name<span style="color: red">*</span> </label>
                                                    <input type="text" id='school_name' autoComplete='off'
                                                        class="form-control" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">School Phone Number<span style="color: red">*</span> </label>
                                                    <div class="row">
                                                        <div class="col-md-4 country_code">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" id='school_number' class="form-control numberFormat"      autoComplete="off"                                                           onkeyup="validateNumber(this.value,'.student_transfer #school_number')"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-25">
                                                <div class="col-md-6">
                                                    <label for="">School Email Address<span style="color: red">*</span></label>
                                                    <input type="email" id='school_email' autoComplete='off'
                                                        class="form-control" />
                                                </div>
                                        
                                                <div class="col-md-6">
                                                    <label for="">School Street Address<span style="color: red">*</span></label>
                                                    <input type="text" id='school_address' autoComplete='off'
                                                        class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row mb-25">
                                                <div class="col-md-6">
                                                    <label for="">City<span style="color: red">*</span></label>
                                                    <input type="text" id='school_city' autoComplete='off'
                                                        class="form-control" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Zip Code<span style="color: red">*</span></label>
                                                    <input type="number" id='school_zip_code' autoComplete='off'
                                                        class="form-control"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                        onKeyDown="if(this.value.length==5 && event.keyCode!=8) return false;" />
                                                </div>
                                            </div>
                                            <div class="row mb-25">
                                                <div class="col-md-6 mb-3">
                                                    <label for="">State<span style="color: red">*</span></label>
                                                    <select id="state" name="state" class="form-select">
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
                                                <div class="col-md-6 mb-3">
                                                    <label for="">County<span style="color: red">*</span></label>
                                                    <select id="county" name="county" class="form-select">
                                                        <option value="-1">County...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-25">
                                                <div class="col-md-6">
                                                    <label for="">Date Last Attended<span style="color: red">*</span></label>
                                                    <input type="date" id='school_last_date' name="" 
                                                        class="form-control dob" 
                                                        max="<?php echo date('Y-m-d'); ?>"
                                                        onchange="this.className=(this.value!=''?'form-control dob has-value':'form-control dob')" />
                                                </div>
                                            </div>
                                            <div class="row mb-25">
                                                <div class="col-md-8">
                                                    <label class="checkbox-inline studentTranferEmailCheckBox" style="display: inline-flex;align-items:center;width: 100%;">
                                                        <input style="width: 30px;height: 20px;margin-right: 10px; margin-bottom:0px;" type="checkbox" value="">
                                                        Please Confirm Email is Correct
                                                        <i style="cursor: pointer; color: #456fb6; margin-left: 10px;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Confirm this email is correct. It’s essential for contacting the previous school to transfer your child's records."></i>
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-md-flex justify-content-md-center gap-4 align-items-md-center">
                                            <button class="btn save-btn student_transfer_back_btn">Back</button>
                                            <button class="btn save-btn next_to_add_course">Save and Continue</button>
                                        </div>
                                        <!-- <img style="float:right" class="next_to_add_course"
                                            src="<?php echo plugin_dir_url(__FILE__) . 'img/Save and Continue Button.png'; ?>" alt="">
                                        <img style="margin-top: 11px;float: right;" class='student_transfer_back_btn'
                                            src="<?php echo plugin_dir_url(__FILE__) . 'img/Back Button.png'; ?>" alt=""> -->
                                    </div>
                                    <!--################### Student Transfer ########################  -->


                                    <!--################### Add Course ########################  -->
                                    <div class="add_course hide">
                                        <div class="form-card" style="background-color:#f1f1f1">
                                            <h2 class="fs-title text-center" style="margin-top: 20px;">Add Course</h2>
                                            <hr>
                                            <div class="row singleStudentSummary d-flex align-items-center" style='border-bottom:none'>
                                                <div class="col-md-1 pl-0">
                                                    <div class="image-frame">
                                                        <img id="student_image" src="<?php echo plugin_dir_url(__FILE__) . 'img/fallback.png'; ?>"
                                                            alt="Student Name"
                                                            srcset="" class="img-fluid rounded border shadow-sm">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div>
                                                        <strong id='student_name'></strong>
                                                        <br>
                                                        <label id='student_grade' for=""></label>
                                                        <br>
                                                        <label id='student_message' for="">Courses Below are Considered High
                                                            School Credit and Must Be Entered as Traditional High School
                                                            Classes</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 text-center">
                                                    <h5 class="fs-title text-center">Area For (<span class="courseYearPaying"></span>)</h5>
                                                    <button class="btn save-btn"  id="add_course_plus_icon">Add Course &nbsp<i class='fa fa-plus'></i></button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- <div class="col-md-12"
                                                    style="background-color: #adadad80;padding-top: 5px;padding-bottom: 5px;">
                                                    <div>
                                                        Add Courses Area For (<span class="courseYearPaying"></span>)
                                                        <i class='fa fa-plus' id="add_course_plus_icon"
                                                            style="color: #0b66a0;"></i>
                                                    </div>
                                                </div> -->

                                                <div class="" id='reg_add_course_area'>
                                                    <table class='table add-c-table modern-table'>
                                                        <thead>
                                                            <tr>
                                                                <th>Course</th>
                                                                <th>Semester</th>                                                                </th>
                                                                <th>Grade</th>
                                                                <th>Credit</th>
                                                                <th>Additional</th>
                                                                <th>Description</th>
                                                                <th>Schedule</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                            </div>

                                        </div>
                                        <!-- <div class="container">
                                            <div class="summary-title fw-bold h5">CUMULATIVE SUMMARY</div>
                                            <div class="table-container add-c-table modern-table">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>Total Credits</th>
                                                            <th>GPA Credits</th>
                                                            <th>GPA Points</th>
                                                            <th>Cumulative GPA</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input type="text" value="25.25" readonly></td>
                                                            <td><input type="text" value="25.25" readonly></td>
                                                            <td><input type="text" value="107.375" readonly></td>
                                                            <td><input type="text" value="4.25" readonly></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> -->
                                        <div class="d-md-flex justify-content-md-center gap-4 align-items-md-center">
                                            <button class="btn save-btn course_back_btn">Back</button>
                                            <button class="btn save-btn next_to_student_summary">Save and Continue</button>
                                        </div>
                                        <!-- <img style="float:right" class="next_to_student_summary"
                                            src="<?php echo plugin_dir_url(__FILE__) . 'img/Save and Continue Button.png'; ?>" alt=""> -->
                                        <!-- <img style="margin-top: 6px;float:right" name="next" class="add_student_btn"
                                            src="img/Add a Student Button.png" alt=""> -->
                                        <!-- <img style="margin-top: 14px;float: right;" class='course_back_btn'
                                            src="<?php echo plugin_dir_url(__FILE__) . 'img/Back Button.png'; ?>" alt=""> -->
                                    </div>
                                    <!--################### Add Course ########################  -->


                                    <!--################### Student Summary ########################  -->
                                    <div class="student_summary hide">
                                        <div class="form-card studentSummaryBox">
                                            <h2 class="fs-title text-center">STUDENTS SUMMARY</h2>
                                            <hr>
                                        </div>
                                        <div class="d-md-flex justify-content-md-center gap-4 align-items-md-center">
                                            <button class="btn save-btn add_student_btn"><i class="fa-solid fa-user-plus"></i> &nbsp Add a Student</button> 
                                            <button class="btn save-btn next_to_agreement_btn">Save and Continue</button>
                                        </div>
                                        <!-- <img style="margin-top: -4px;" class='studentSummaryBackBtn'
                                            src="<?php echo plugin_dir_url(__FILE__) . 'img/Back Button.png'; ?>" alt=""> -->
                                        <!-- <img style="margin-top: 6px;" name="next" class="add_student_btn"
                                            src="<?php echo plugin_dir_url(__FILE__) . 'img/Add a Student Button.png'; ?>" alt=""> -->
                                        <!-- <img class="next_to_agreement_btn" src="<?php echo plugin_dir_url(__FILE__) . 'img/Save and Continue Button.png'; ?>"
                                            alt=""> -->
                                    </div>
                                    <!--################### Student Summary ########################  -->

                                    <input type="button" name="previous"
                                        class="previous hide action-button-previous back_to_parent" value="Previous" />
                                    <img name="next" class="next hide next_to_agreement"
                                        src="<?php echo plugin_dir_url(__FILE__) . 'img/Save and Continue Button.png'; ?>" alt="">
                                    <!-- <a type="button" name="next" class="next action-button studentSummaryBtn">Save &
                                        Continue <i class="fas fa-arrow-right"></i></a> -->
                                </fieldset>


                                <fieldset>
                                    <!--################### Agreement Start ########################  -->
                                    <div class="form-card arrangementPage">
                                        <h2 class="fs-title text-center">Agreement</h2>
                                        <div style="display: flex; justify-content-center" class='agreementBox'>
                                            <p style="
                                            /* padding: 9px 0 0 30px; */
                                            color: black;
                                            /* font-size: 14px; */
                                            font-weight: 500;
                                            letter-spacing: 0.5px;" class="text1">Please Scroll Down to View All
                                                Policies</p>
                                        </div>
                                        <div class="card">
                                            <div class="card-body" style="
                                            background-color: white;
                                            color: black;
                                            max-height: 230px;
                                            overflow: scroll; ">
                                                <?php echo get_field('agreement_page_privacy_policy_text', $settings_page_id); ?>

                                                <!-- <p>
                                                    1. At least one parent/guardian must possess a high school diploma or GED to serve as the primary learning facilitator.
                                                </p>
                                                <p> 
                                                    2. At Graduates Academy, we empower parents/guardians with the flexibility to choose the curriculum that best suits their child's unique learning needs. While we provide guidance and support, the selection and implementation of an educational plan remain the parent's responsibility.
                                                </p>
                                                <p>
                                                    3. Parents/Guardians are responsible to fulfill their state's homeschooling laws. Tennessee families must complete a minimum of 180 instructional days with at least 6.5 hours per day and submit attendance records by January 15th and June 15th. Families in other states should report attendance according to their local regulations.
                                                </p>
                                                <p>
                                                    4. Families must comply with their state's immunization policies. For Tennessee residents, submission of immunization proof or the Tennessee Immunization Religious or Medical Exemption Form is now optional.
                                                </p>
                                                <p>
                                                    5. Graduates Academy is a Category IV Private School in Tennessee. While we currently provide legal homeschooling coverage only in Tennessee, many homeschooling families across the U.S. choose to register with us for the exceptional support and resources we offer. Families residing outside of Tennesssee must independently fulfill their state's homeschool requirements (when applicable).
                                                </p>
                                                <p>
                                                    6. Enrollment with Graduates Academy fulfills compulsory attendance requirements for Tennessee families. Students in other states must register through their county/state homeschooling office to meet legal requirements.
                                                </p>
                                                <p>
                                                    7. To ensure communication, families must maintain an active email address and phone number for important updates.
                                                </p>
                                                <p>
                                                    8. Families are required to submit grades and attendance by January 15th and June 15th.
                                                </p>
                                                <p>
                                                    9. Both parents or legal guardians (when applicable) must consent to homeschooling and registration with Graduates Academy.
                                                </p>
                                                <p>
                                                    10. To ensure a seamless transition from year to year, families should complete the re-enrollment process before the school year begins in their respective state or by August 10th.
                                                </p>
                                                <p>
                                                    11. Graduates Academy supports parents in ensuring their child meets all high school credit requirements. Families are responsible for verifying specific college admission or program prerequisites to prepare their student for future opportunities.
                                                </p>
                                                <p>
                                                    12. While standardized testing is not required, we highly recommend high school students to take the SAT or ACT as a valuable step toward college admission and scholarship opportunities. Families should check their local homeschooling laws to determine if standardized testing is required in their state.
                                                </p>
                                                <p>
                                                    13. Graduates Academy provides online record-keeping services; however, parents/guardians are responsible for maintaining their own backup copies of student records. Personal and academic information collected during registration and enrollment will be used solely for educational purposes and will not be shared with third parties unless requested by the parent/guardian or required by law.
                                                </p>
                                                <p>
                                                    14. General policy at Graduates Academy is we are unable to process enrollment under certain circumstances such as truancy, suspension, expulsion, misdemeanors, felonies, and unresolved court cases.
                                                </p>
                                                <p>
                                                    15. The re-enrollment period runs from April 1st to August 10th each year. Families may withdraw at any time; however, annual registration fees are non-refundable as they cover administrative processing. To support a smooth transition, we assist with record transfers and provide official documentation, making the process of enrolling in another school as seamless as possible.
                                                </p>
                                                <p>
                                                    16. To ensure accurate transcripts, families must provide official AP/CLEP exam scores for these courses to be recorded. For dual enrollment courses, an official college transcript is required.
                                                </p>
                                                <p>
                                                    17. All annual family registration fees are non-refundable.
                                                </p> -->
                                            </div>
                                        </div>
                                        <br>
                                        <label class="checkbox-inline privacyBox"
                                            style="display: inline-flex;width: 20%;">
                                            <input style="width: 20%;height: 20px;margin-left: -10px;" type="checkbox"
                                                value="">I Accept All
                                        </label>
                                        <p class="mb-0">I agree to all the above policies</p>
                                        <p style="">By entering your name below you agree this is an
                                            electronic signature</p>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" id='signature_f_name' name="" autoComplete='off' class="form-control" placeholder="First Name" />
                                                </div>
                                                <div class="col-md-4">
                                                    <input  type="text" id='signature_l_name' name="" autoComplete='off' class="form-control" placeholder="Last Name" />
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" id='signature_date' name="signature_date"
                                                        class="form-control" value="<?php echo date('m-d-Y'); ?>"
                                                        readonly />
                                                </div>
                                            </div>

                                        <!-- <div class="row">
                                            <section class="signature-component">
                                                <h2>Signature Pad</h2>
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <canvas id="signature-pad"></canvas>
                                                        <div class="button-group">
                                                            <button class="btn save-btn" id="save">Save</button>
                                                            <button class="btn save-btn" id="clear">Clear</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 " id="signature-image-box" style="display: none;">
                                                        <img decoding="async" id="signature-image" src="" alt="Signature Image">
                                                        <div class="button-group text-center">
                                                            <button class="btn" style="background-color: #bc9f5e; color: #fff; margin: 10px 0; font-family: montserrat;"><i class="fa-solid fa-eye"></i>&nbsp; Signature Preview</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="error-message" style="display: none; color: #dc3545; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 4px; padding: 10px; margin: 10px 0; font-size: 14px; text-align: center;">
                                                    <i class="fas fa-exclamation-circle"></i> Please Provide a Signature in the Signature Pad
                                                </div>
                                            </section>
                                        </div> -->
                                    
                                    </div>
                                    <!-- <div class=" d-flex justify-content-center gap-4 align-items-center"> -->
                                        <button class="btn save-btn previous backToStudentSummary">Back</button>
                                        <button class="btn save-btn next_to_step_4">Save and Continue</button>
                                        <button class="btn save-btn step_4 hide next">Save and Continue</button>
                                    <!-- </div> -->
                                    
                                    <!-- <img name="previous" class='previous backToStudentSummary' src="<?php echo plugin_dir_url(__FILE__) . 'img/Back Button.png'; ?>" alt="">
                                    <img class="next_to_step_4" src="<?php echo plugin_dir_url(__FILE__) . 'img/Save and Continue Button.png'; ?>" alt="">
                                    <img name="make_payment" class="step_4 hide next"
                                        src="<?php echo plugin_dir_url(__FILE__) . 'img/Save and Continue Button.png'; ?>" alt=""> -->

                                    <!-- <a type="button" name="make_payment" class="next action-button step_4 hide next">Save & Continue <i class="fas fa-arrow-right"></i></a> -->
                                    <!--################### Agreement End ########################  -->
                                </fieldset>
                            

                            <fieldset>
                                <!--################### Payment Start ########################  -->
                                <div class="form-card payment setAmount">
                                    <div>
                                        <!-- <h2 class="fs-title text-center">Order Summary</h2> -->
                                         <h2 class="fs-title text-center">Payment</h2>
                                    </div>

                                    <div class="row mobileView"
                                        style="background-color: white;padding-bottom: 20px;">
                                        <div class="col-md-4 order-md-2 mb-4">
                                            <br>
                                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="text-muted"><i class="fas fa-bars"></i>
                                                    Registrations</span>
                                                <!-- <span class="badge badge-secondary badge-pill">3</span> -->
                                            </h4>
                                            <ul class="list-group mb-3 mobileReg">

                                                <li class="list-group-item d-flex justify-content-between bg-light">
                                                    <div class="text-success">
                                                        <h6 class="my-0">Promo code</h6>
                                                        <!-- <small>EXAMPLECODE</small> -->
                                                    </div>
                                                    <span class="text-success discountAmount">0</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between bg-light">
                                                    <label class="checkbox-inline rushAmountMobile"
                                                        style="display: inline-flex;width: 100%;">
                                                        <input style="width: 6%;height: 20px;margin-right: 7px;"
                                                            type="checkbox" value="">Add $25 Rush
                                                    </label>
                                                    <!-- <span style="color:#007bff" data-toggle="popover"
                                                        data-trigger="hover" data-placement="bottom"
                                                        data-original-title="" data-content="If selected, rush orders will be processed within 12 hours"
                                                        aria-describedby="tooltip">
                                                        <i class="fas fa-info-circle"></i>
                                                    </span> -->
                                                    <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="If selected, rush orders will be processed within 12 hours"></i>
                                                </li>

                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Total (USD)</span>
                                                    $<strong class="totalAmount">0.00</strong>
                                                </li>
                                            </ul>
                                            <div class="card p-2">
                                                <div class="input-group">
                                                    <input type="text" class="form-control showMessagePhone" placeholder="Promo code"
                                                        id="coupon_code1">
                                                    <div class="input-group-append" style="margin: auto;">
                                                        <button class="btn save-btn applyCoupon">Apply Code</button>
                                                        <!-- <button type="submit"
                                                            class="btn btn-secondary">Redeem</button> -->
                                                        <!-- <img class="applyCoupon" src="<?php echo plugin_dir_url(__FILE__) . 'img/Apply Code Button.png'; ?>" alt=""> -->
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
                                                        <td colspan="2" class="showMessageDestop">
                                                            Promotion Code
                                                            <input type="text" id="coupon_code"
                                                                style="font-size: 12px;padding: 8px 15px;width: 30%;border: none;background-color: #e8e8e8;border-radius: 8px;">
                                                            <button  id="applyCoupon" class=" btn save-btn applyCoupon"
                                                                style="padding: 6px 10px;">
                                                                <i class="fas fa-arrow-left"></i>
                                                                Apply Code
                                                            </button>
                                                            <!-- <img id="applyCoupon" class="applyCoupon"
                                                                src="<?php echo plugin_dir_url(__FILE__) . 'img/Apply Code Button.png'; ?>" alt=""> -->

                                                        </td>
                                                        <td colspan="2">
                                                            <div style=" font-weight: bold;">
                                                                Total
                                                                $<span style="float: right;"
                                                                    class="totalAmount">0.00</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=''>
                                                            <div class="d-flex mt-4">
                                                            <label class="checkbox-inline rushAmountDesktop"
                                                                style="display: inline-flex;width: 100%;">
                                                                <input
                                                                    style="width: 6%;height: 20px;margin-right: 7px;"
                                                                    type="checkbox" value="" />Add $25 Rush
                                                            </label>
                                                            <!-- <span style="color:#007bff" data-toggle="popover"
                                                                data-trigger="hover" data-placement="bottom"
                                                                data-original-title=""
                                                                data-content="If selected, rush orders will be processed within 12 hours"
                                                                aria-describedby="tooltip">
                                                                <i class="fas fa-info-circle"></i>
                                                            </span> -->
                                                            <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="If selected, rush orders will be processed within 12 hours"></i>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12">
                                            <h6>Personal Information</h6>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="col-md-8">
                                            <div class="row mb-25">
                                                <div class="col-md-4">
                                                    <label for="">First Name<span style="color: red">*</span></label>
                                                    <input
                                                        style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;"
                                                        type="text" id="firstNameStripe" name="firstName" placeholder="Enter your first name"
                                                        class="form-control" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Last Name<span style="color: red">*</span></label>
                                                    <input
                                                        style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;"
                                                        type="text" id="lastNameStripe" name="lastName" placeholder="Enter your last name"
                                                        class="form-control" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Address<span style="color: red">*</span></label>
                                                    <input
                                                        style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;"
                                                        type="text" id="addressStripe" name="address" placeholder="Enter your address"
                                                        class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row mb-25">
                                                <div class="col-md-4">
                                                    <label for="">City<span style="color: red">*</span></label>
                                                    <input
                                                        style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;"
                                                        type="text" id="cityStripe" name="city" placeholder="Enter your city"
                                                        class="form-control" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">State<span style="color: red">*</span></label>
                                                    <input 
                                                        style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;"
                                                        type="text" id="stateStripe" name="state" placeholder="Enter your state"
                                                        class="form-control" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Zip Code<span style="color: red">*</span></label>
                                                    <input
                                                        style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;"
                                                        type="text" name="zip" class="form-control" id="zipStripe" placeholder="Enter your zip code"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                        onKeyDown="if(this.value.length==5 && event.keyCode!=8) return false;" />
                                                </div>
                                            </div>
                                            <div class="row mb-25">
                                                <div class="col-md-4">
                                                    <label for="">Credit/Debit Card Number<span style="color: red">*</span></label>
                                                    <div id="card_number" class="field"></div>
                                                    <!-- <input
                                                        style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;"
                                                        type="text" name="uname" class="form-control" /> -->
                                                    <img src="<?php echo plugin_dir_url(__FILE__) . 'img/cards.png'; ?>"
                                                     style="width: 170px;border: none;margin-top: -35px;margin-left: 6px;" alt="">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Expiration Date<span style="color: red">*</span></label>
                                                    <div id="card_expiry" class="field"></div>
                                                    <!-- <input
                                                        style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;"
                                                        type="text" id="expiry" name="cpwd" class="form-control" 
                                                        onKeyDown="if(this.value.length==5 && event.keyCode!=8) return false;"
                                                        onkeypress="return onlyNumberKey(event)"  /> -->
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">CVV or CVC<span style="color: red">*</span></label>
                                                    <div id="card_cvc" class="field"></div>
                                                    <!-- <input
                                                        style="font-size: 12px;padding: 8px 15px;border: none;background-color: #e8e8e8;border-radius: 8px;"
                                                        type="text" name="pwd" class="form-control" /> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 text-center" id=payBox>
                                            <h5><span></span> Pay with PayPal</h5>
                                            <!-- <img class="paymentBox" src="img/Proceed to PayPal Button.png" alt=""> -->
                                            <!-- <a type="button" id='paypal'
                                                style="padding: 10px 10px;font-size: 12px;letter-spacing: 1px;"
                                                class="action-button">Proceed to Paypal</a> -->

                                                <button type="submit" id="paypal" style="padding: 10px 10px;font-size: 12px;letter-spacing: 1px;"
                                                class="action-button">Pay with PayPal</button>
                                            
                                            <div id="paypal-button-container"></div>
                                            <div id="payment-status"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="d-flex justify-content-center gap-4 align-items-center"> -->
                                        <button class="btn save-btn previous backFromSubmit">Back</button>
                                        <button class="btn save-btn payOrder">Submit Order</button>
                                        <!-- <button class="btn save-btn payNow">Continue</button> -->
                                    <!-- </div> -->
                                <!-- <img name="previous" class='previous backFromSubmit' src="<?php echo plugin_dir_url(__FILE__) . 'img/Back Button.png'; ?>" alt="">
                                <img class="payOrder" style="margin-top: 8px;" src="<?php echo plugin_dir_url(__FILE__) . 'img/Submit Order Button.png'; ?>" alt="">

                                <img class="submitOrder hide" style="margin-top: 8px;"
                                    src="<?php echo plugin_dir_url(__FILE__) . 'img/Submit Order Button.png'; ?>" alt=""> -->

                                <!-- <a type="button" class="action-button submitOrder">Submit Order
                                    <i class="fas fa-arrow-right"></i></a> -->
                                <!--################### Payment End ########################  -->
                            </fieldset>
                        </div>

                        <div class='appendCouponAmonnt'>
                        </div>
                        <input type="hidden" class="setAmountForCoupon">
                        <div style='display:none'>
                            <form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" id='studentsForm'
                                enctype="multipart/form-data">
                                <input type="text" name="paypalId" id="paypalId" value="null">
                                <input type="text" name="paidAmount" id="paidAmount" value="0">
                                <input type="text" name="type" id="type" value="final_submit">
                                <div class='studentsInput'>

                                </div>

                                <div class='studentsFile'>

                                </div>

                                <div class="transactionItems">

                                </div>
                                <input type="submit" name='save'>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Edit Modal HTML -->
    <!-- <div id="editStudent" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>First Name</label>
                        <input id='edit_f_name' type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input id='edit_m_name' type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input id='edit_l_name' type="text" class="form-control" required>
                    </div>
                    <select name="" id="edit_student_grade" class="form-control">
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
                    </select>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" id='close_update_student'
                        value="Cancel">
                    <input type="submit" class="btn btn-success" value="Update" id='update_student'>
                </div>
            </div>
        </div>
    </div> -->
<!-- Edit Modal HTML -->
</div>

<!-- #################### JAVASCRIPT Start ####################### -->
<script src="<?php echo plugin_dir_url(__FILE__); ?>js/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Progress Bar -->
<script src="<?php echo plugin_dir_url(__FILE__); ?>js/form.js"></script>
<script src="<?php echo plugin_dir_url(__FILE__); ?>ajax/registration_ajax_function.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script> -->
<!-- Bootbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.js"></script>

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

<!-- Drop Down JS -->
<script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__); ?>js/drop_down.js"></script> 
<!-- Popper js -->
<script src="<?php echo plugin_dir_url(__FILE__); ?>js/popper.min.js"></script>
<!-- Signature JS
<script>
    // set data in agreement onload page
    $(document).ready(function () {
    // Get today's date
    const today = new Date();
    const formattedDate = `${String(today.getMonth() + 1).padStart(2, '0')}/${String(today.getDate()).padStart(2, '0')}/${today.getFullYear()}`;
    
    // Set the value of the input field
    document.getElementById('signature_date').value = formattedDate;
    });
</script> -->


<!-- #################### PAYPAL PAYMENT Start ####################### -->

<!-- AThplX_3c5-sjOFDwieZVD74zDI16D1UrLPUMfGbR85kjJ1j04NiPO3J_gt51-YiVQqgtugZOmRkfy-I -->

<!-- EMYIe6LFRHhWf5QS-IZ6NteR-vhcVSCqe0ofVk5qJ29sN1mFA70Qrtu-apYfC0rpFO99tHLGGwsPbrVR -->

<!-- paypal script -->
<!-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> -->
<!-- <script src="https://www.paypal.com/sdk/js?client-id=AThplX_3c5-sjOFDwieZVD74zDI16D1UrLPUMfGbR85kjJ1j04NiPO3J_gt51-YiVQqgtugZOmRkfy-I&currency=USD&intent=capture"></script> -->

<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })

    // Render the PayPal button into #paypal-button-container
    // paypal.Button.render({
    //     // Configure environment
    //     // env: 'production', // for production
    //     env: 'sandbox', // for production
    //     client: {
    //         sandbox: 'AXWTwwnFD9B_xK_YZo2i39rHS8SPxiFviS-mJqfRiJb-E6cN_QE9dqf-rQerIvk52DjF37tu8IyyWbsr',
    //         production: 'AX7RWj2K2yVLd_sER2h_QZpjM9MMGgYYpw5RWX4ybqfQsH2vjNWVGuGdluZka61hjlhaD_bXcbfIpm0g'
    //     },

    //     // Customize button (optional)
    //     locale: 'en_US',
    //     style: {
    //         size: 'small',
    //         color: 'gold',
    //         shape: 'pill',
    //         layout: 'horizontal',
    //         fundingicons: 'true',
    //     },

    //     // Set up a payment
    //     payment: function (data, actions) {
    //         return actions.payment.create({
    //             transactions: [{
    //                 amount: {
    //                     total: $("#paidAmount").val(),
    //                     // total: '100',
    //                     currency: 'USD'
    //                 }
    //             }]
    //         });
    //     },

    //     // Execute the payment
    //     onAuthorize: function (data, actions) {
    //         return actions.payment.execute().then(function () {
    //             // Show a confirmation message to the buyer
    //             bootbox.alert('Thank you for your purchase!');
    //             // console.log(data);
    //             // $("#paypalId").val(details.id);
    //             $("#paypalId").remove();

    //             // get rid vlaue form the url
    //             // var params = new window.URLSearchParams(window.location.search);
    //             // var registration_id = params.get('rid');
    //             var paidAmount = $("#paidAmount").val();
    //             var transaction_id = data.paymentID;
    //             var coupon_code = $('#coupon_code').val() || $('#coupon_code1').val();

    //             // check the Rushfeeoption
    //             let rushfee = $(".rushAmountDesktop input[type='checkbox']").is(":checked") ? "high" : "low";

    //             // final submit 
    //             $.ajax({
    //                 type: 'POST',
    //                 url: '<?php echo admin_url('admin-ajax.php'); ?>',
    //                 data: {
    //                     action: 'ajax_handle_final_submit', // Required for WordPress AJAX
    //                     // registration_id: registration_id,
    //                     rushfee: rushfee,
    //                     addNewStudent: 'no',
    //                     transaction_id: transaction_id,
    //                     paidAmount: paidAmount,
    //                     coupon_code: coupon_code,
    //                     description: 'Graduates Academy - Registration',
    //                     type: 'final_submit',
    //                 },
    //                 success: function (response) {
    //                     try {
    //                         // console.log(response);  
    //                         const data = typeof response === 'string' ? JSON.parse(response) : response;
    //                         if (data && data.data && data.data.success) {
    //                             $("body").removeClass("loading");
    //                             swal('', data.data?.message || 'Registration successful', "success");
    //                             window.location.href = '/students/';
    //                         } else {
    //                             $("body").removeClass("loading");
    //                             swal('', data.data?.message || 'Registration failed', "error");
    //                             window.location.reload();      
    //                         }
    //                     } catch (error) {
    //                         $("body").removeClass("loading");
    //                         swal('', 'Registration processing error', "error");
    //                         window.location.reload();
    //                     }
    //                 },
    //             });

    //             // if (jQuery("#studentsForm")) {
    //             //     jQuery("#studentsForm").prepend(
    //             //         `<input type="text" name="paypalId" id="paypalId" value="${data.paymentID}">`
    //             //     );
    //             //     // $('#studentsForm').submit();

    //             //     // $('.payOrder').addClass('hide');
    //             //     // $('.submitOrder').removeClass('hide');
    //             // }

    //             // if (jQuery("#graduationFrom")) {
    //             //     jQuery("#graduationFrom").prepend(
    //             //         `<input type="text" name="paypalId" id="paypalId" value="${data.paymentID}">`
    //             //     );
    //             //     $('#graduationFrom').submit();
    //             // }
    //             // $("#studentsForm #paypalId").val(data.paymentID);
    //             // $("#paidAmount").val($("#setAmount").val());
    //             // console.log("Success===>",data.paymentID);
    //             // console.log("Success===>",data);
    //             // $("#submit").click();
    //         });
    //     },

    //     onCancel: function (data, actions) {
    //         // console.log(data);
    //         // Show a cancel page or return to cart
    //         bootbox.alert("Payment failed to capture.");
    //     },

    //     onError: function (err) {
    //         // console.log("ERROR===>",err);
    //         // Show an error page here, when an error occurs
    //         bootbox.alert("Payment failed to capture.");
    //     }
    // }, '#paypal');
</script>

<script>
$(document).ready(function() {
    $('#paypal').on("click", function(e) {
        e.preventDefault(); // Prevent default form submission

        $("body").addClass("loading");
        // check the Rushfeeoption
        let rushfee = $(".rushAmountDesktop input[type='checkbox']").is(":checked") || $(".rushAmountMobile input[type='checkbox']").is(":checked") ? "high" : "low";
        let transactionItems = [];
        $('.transactionItems input').each(function() {
            let items = JSON.parse($(this).val());
            items.forEach(item => {
            transactionItems.push(item);
            });
        });

        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>", // Backend PHP file to create payment
            type: "POST",
            data: {
                action: 'process_paypal_payment', 
                amount: $("#paidAmount").val(),
                currency: 'usd',
                rushfee: rushfee,
                addNewStudent: 'no',
                description: 'Graduates Academy - Registration',
                coupon_code: $('#coupon_code').val() || $('#coupon_code1').val(),
                transactionItems: JSON.stringify(transactionItems),
                type: 'student_registration',
            },
            dataType: "json",
            success: function(response) {
                console.log(response);

                if (response.success) {
                    window.location.href = response.redirect_url; // Redirect to PayPal
                } else {
                    $("body").removeClass("loading");
                    $('#payment-status').html('<p style="color:red;">' + response.error + '</p>');
                }
            }
        });
    });
});
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
        // Clear any existing error messages
        $('.error-message').remove();
        let error = 0;

        // get all data
        var f_name = $("#firstNameStripe").val();
        var l_name = $("#lastNameStripe").val();
        var name = $("#firstNameStripe").val() + ' ' + $("#lastNameStripe").val();
        var email = $('.parent_1 #parent_email').val();
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
                email: $('.parent_1 #parent_email').val(),
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
                        // swal('', data.data.message || 'Payment successful', "success");
                        $("#paypalId").remove();

                        // get rid vlaue form the url
                            // var params = new window.URLSearchParams(window.location.search);
                            // var registration_id = params.get('rid');

                        // check the Rushfeeoption
                        let rushfee = $(".rushAmountDesktop input[type='checkbox']").is(":checked") || $(".rushAmountMobile input[type='checkbox']").is(":checked") ? "high" : "low";
                        let transactionItems = [];
                        $('.transactionItems input').each(function() {
                            let items = JSON.parse($(this).val());
                            items.forEach(item => {
                            transactionItems.push(item);
                            });
                        });

                        // final submit 
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            data: {
                                action: 'ajax_handle_final_submit', // Required for WordPress AJAX
                                // registration_id: registration_id,
                                rushfee: rushfee,
                                addNewStudent: 'no',
                                transaction_id: data.data.transaction_id,
                                description: 'Graduates Academy - Registration',
                                paidAmount: $("#paidAmount").val(),
                                coupon_code: $('#coupon_code').val() || $('#coupon_code1').val(),
                                transactionItems: JSON.stringify(transactionItems),
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

<!-- #################### JAVASCRIPT End ####################### -->
<div class="overlay"></div> 


<!-- <script>
    const canvas = document.getElementById('signature-pad');
    const ctx = canvas.getContext('2d');
    const clearButton = document.getElementById('clear');
    const saveButton = document.getElementById('save');
    const errorMessage = document.getElementById('error-message');
    const signatureImage = document.getElementById('signature-image');
    const signatureImageBox = document.getElementById('signature-image-box');
    // console.log(signatureImage.src)

    // Set canvas size explicitly
    function resizeCanvas() {
        const canvasContainer = canvas.parentElement; // Parent container for the canvas
        // console.log(canvasContainer.offsetWidth)
        // console.log('width ', parseInt(window.getComputedStyle(canvas).width))
        // console.log(parseInt(window.getComputedStyle(canvas).height))
        // canvas.width = canvasContainer.offsetWidth; // Set width dynamically based on container width
        canvas.width = 500 // Set width dynamically based on container width
        canvas.height = parseInt(window.getComputedStyle(canvas).height); // Use the defined height in CSS
    }

    // Resize the canvas on page load
    window.addEventListener('load', resizeCanvas);
    // Resize canvas on window resize
    window.addEventListener('resize', resizeCanvas);

    let isDrawing = false;

    // Drawing events
    canvas.addEventListener('mousedown', (event) => {
        isDrawing = true;
        ctx.beginPath();
        ctx.moveTo(getX(event), getY(event));
    });

    canvas.addEventListener('mouseup', () => {
        isDrawing = false;
        ctx.closePath();
    });

    canvas.addEventListener('mousemove', (event) => {
        if (isDrawing) {
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.strokeStyle = 'black';
            ctx.lineTo(getX(event), getY(event));
            ctx.stroke();
        }
    });

    // Clear the canvas
    clearButton.addEventListener('click', () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        errorMessage.style.display = 'none';
        signatureImageBox.style.display = 'none';
        signatureImage.src = '';    
    });

    // Submit the signature
    saveButton.addEventListener('click', () => {
        const isEmpty = ctx.getImageData(0, 0, canvas.width, canvas.height).data.every((pixel) => pixel === 0);

        if (isEmpty) {
            errorMessage.style.display = 'block';
            setTimeout(() => {
                errorMessage.style.display = 'none';                
            }, 5000);
        } else {
            errorMessage.style.display = 'none';
            const dataURL = canvas.toDataURL();
            signatureImage.src = dataURL;
            signatureImageBox.style.display = 'block';
            // alert('Signature submitted successfully!');
            // swal('', 'Signature saved successfully!', "success");
        }
    });

    // Utility to get X and Y coordinates
    function getX(event) {
        const rect = canvas.getBoundingClientRect();
        return event.clientX - rect.left;
    }

    function getY(event) {
        const rect = canvas.getBoundingClientRect();
        return event.clientY - rect.top;
    }
</script>

<style>
    #signature-pad {
        border: 2px solid #000;
        border-radius: 5px;
        width: 100%;
        max-width: 500px;
        height: 200px;
        cursor: crosshair;
        margin: 20px 0;
        background-color: white;
    }
    #signature-image {
        border: 2px solid #000;
        border-radius: 5px;
        width: 100%;
        max-width: 500px;
        height: 200px;
        cursor: pointer;
        background-color: white;
    }
    .button-group {
        margin: 10px 0;
    }
    .button-group button {
        margin-right: 10px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
    }
</style> -->