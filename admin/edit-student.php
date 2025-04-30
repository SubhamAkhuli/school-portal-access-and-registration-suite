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
        <div class='add_student'>
            <div class="form-card show addStudent">
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
                <div class="row mb-25">
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
                        <div class="d-flex align-items-start bg-light p-3 rounded border gap-3">
                            <!-- Profile Image Preview -->
                            <div class="mb-2">
                                <img id="preview-profile-img" onclick="document.getElementById('student-profile').click();"
                                        src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'img/new_male_default.png'; ?>" 
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
                    <button type="button" class="btn save-btn" id="saveChangesButton"><i class="fas fa-save"></i> Save Changes</button>
                </div>
            </div>
        </div>
    </fieldset>
</form>

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
<!-- <script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__); ?>js/drop_down.js"></script>  -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>js/drop_down.js"></script>

<!-- Ajax -->
<!-- <script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__); ?>ajax/edit_student_ajax_function.js"></script> -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>ajax/edit_student_ajax_function.js"></script>