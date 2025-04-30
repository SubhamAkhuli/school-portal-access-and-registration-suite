<!-- <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/form.css'; ?>">
<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/bootstrap.min.css'; ?>"> -->
<link rel="stylesheet" href="<?php echo plugin_dir_url(dirname(__FILE__)) . 'css/form.css'; ?>">
<link rel="stylesheet" href="<?php echo plugin_dir_url(dirname(__FILE__)) . 'css/bootstrap.min.css'; ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<!-- Back Button -->
<button onclick="window.history.back();" class="btn blue-btn"><i class="fa fa-arrow-left"></i> Back</button>
    <form id="msform">
        <fieldset class='bgChange'>
            <!--################### Add Student ########################  -->
            <div class='add_student'>
                <div class="form-card show addStudent">
                    <h2 class="fs-title text-center">Student</h2>
                    <!-- <hr> -->
                    <div class="row mb-25">
                        <input type="hidden" id="parent_email" value="">
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
                            <label for="">Age<span style="color: red">*</span></label>
                            
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
                        <button onclick="window.open('/coming-soon', '_blank')" class="btn" style="background-color: #456fb6; color: #fff;">
                            <i class="fas fa-map-marker-alt"></i> View Co-op Map Near You
                        </button>
                        </div>
                        <div class="form-group">
                            <label for="coop_name">Please specify the name of the co-op this child will attend this year<span style="color: red">*</span> <i style="cursor: pointer; color: #007bff;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="We collect this information in order to better serve our students and the various homeschool co-ops they attend."></i></label>
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
                                program?
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
                            <div class="d-flex align-items-start bg-light p-3 rounded border gap-3">
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
                            <div class="d-flex align-items-start bg-light p-3 rounded border gap-3">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Immunization Records <span class="text-muted small">(not required)</span></h6>
                                    
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
                    <div class="d-flex justify-content-center gap-4 align-items-center">
                    <!-- cancel Button -->
                    <button type="button" onclick="window.history.back();" class="btn blue-btn">Cancel</button>
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
                    <hr>
                    <div class="row mb-25">
                        <div class="col-md-12 for_additional hide">
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
                                Please Check Email is Correct
                                <i style="cursor: pointer; color: #007bff; margin-left: 10px;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Confirm this email is correct. It’s essential for contacting the previous school to transfer your child's records."></i>
                            </label>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center gap-4 align-items-center">
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
                    <div class="row singleStudentSummary" style='border-bottom:none'>
                        <div class="col-md-1 pl-0">
                            <div class="image-frame">
                                <img id="student_image" src="<?php echo plugin_dir_url(dirname(__FILE__))  . 'img/fallback.png'; ?>"
                                    alt="Student Name"
                                    srcset="" class="img-fluid rounded border shadow-sm">
                            </div>
                        </div>
                        <div class="col-md-8 d-flex align-items-center">
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
                                        <th>Semester &nbsp; 
                                            <span data-toggle="popover" data-placement="bottom" data-original-title="" data-content="Select which semester(s) this course will be taught. If this course will be taught year-round select all 3 semesters" aria-describedby="tooltip">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                        </th>
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
                <div class="d-flex justify-content-center gap-4 align-items-center">
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
                <div class="d-flex justify-content-center gap-4 align-items-center">
                    <button class="btn save-btn add_student_btn"><i class="fa-solid fa-user-plus"></i> &nbsp Add a Student</button> 
                    <button class="btn save-btn next_to_agreement_btn">Save and Continue</button>
                </div>

                <input type="button" name="previous"
                class="previous hide action-button-previous back_to_parent" value="Previous" />
                <img name="next" class="next hide next_to_agreement"
                    src="<?php echo plugin_dir_url(dirname(__FILE__))  . 'img/Save and Continue Button.png'; ?>" alt="">
            </div>
            <!--################### Student Summary ########################  -->

            <!--################### Payment Start ########################  -->
            <div class="form-card payment setAmount hide">
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
                                <i style="cursor: pointer; color: #007bff;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="If selected, rush orders will be processed within 12 hours"></i>
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
                                        <i style="cursor: pointer; color: #007bff;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="If selected, rush orders will be processed within 12 hours"></i>
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
                                <img src="<?php echo plugin_dir_url(dirname(__FILE__))  . 'img/cards.png'; ?>"
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
                        <a type="button" id='paypal'
                            style="padding: 10px 10px;font-size: 12px;letter-spacing: 1px;"
                            class="action-button">Proceed to Paypal</a>
                    </div>
                </div>
                <div class="mt-5 d-flex justify-content-center gap-4 align-items-center">
                    <button class="btn save-btn previous backFromSubmit">Back</button>
                    <button class="btn save-btn payOrder">Submit Order</button>
                    <!-- <button class="btn save-btn payNow">Pay Now</button> -->
                </div>
            </div>
            <!--################### Payment End ########################  -->
        </fieldset>
    </form>

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

<!-- #################### JAVASCRIPT Start ####################### -->
<script type="text/javascript" src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>ajax/addNewStudent_ajax_function.js"></script>
<script src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>js/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script> -->
<!-- Bootbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


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
<script type="text/javascript" src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>js/drop_down.js"></script> 
<!-- Popper js -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>js/popper.min.js"></script>

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
        var email = $('#parent_email').val();
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
            $('#parent_email').after('<span class="error-message" style="color: red;">Please enter your email</span>');
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
                email: $('#parent_email').val(),
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

<!-- #################### JAVASCRIPT End ####################### -->
<div class="overlay"></div> 