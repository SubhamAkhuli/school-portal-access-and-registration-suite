<div class="container">
  
    <!-- Header buttons container -->
    <div class="d-flex justify-content-between mb-2">
      <!-- Back Button -->
      <button onclick="window.history.back();" class="btn blue-btn"><i class="fa fa-arrow-left"></i> Back</button>
      <!-- Add Student Button -->
      <button class="btn blue-btn" data-bs-toggle="modal" data-bs-target="#addStudentModal" title="For Current School Year"><i class="fa-solid fa-user-plus"></i> &nbsp Add Student</button>
    </div>
    
    <!-- Student Details Container -->
    <div id="student-container">
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 rounded-4 shadow">
          <div class="modal-header" style="background-color: #456fb6;">
            <div class="d-flex align-items-center">
              <i class="fas fa-user-plus fs-4 text-white me-2"></i>
              <h5 class="modal-title text-white mb-0">Add New Student</h5>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4 bg-light addStudentForm">
            <form id="addStudentForm">

              <!-- Student Information Section -->
              <h4 class="text-secondary fw-medium text-center mb-5">Student Information</h4>
              <div class="row g-4">
                <div class="col-md-4">
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">First Name<span style="color: red">*</span></label>
                    <input type="text" id="student_f_name" class="form-control border-0 shadow-sm rounded-3" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">Middle Name</label>
                    <input type="text" id="student_m_name" class="form-control border-0 shadow-sm rounded-3">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">Last Name<span style="color: red">*</span></label>
                    <input type="text" id="student_l_name" class="form-control border-0 shadow-sm rounded-3" required>
                  </div>
                </div>
              </div>

              <div class="row g-4">
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">Date of Birth<span style="color: red">*</span></label>
                    <input type="date" id="dob" class="form-control border-0 shadow-sm rounded-3 dob" 
                        max="<?php echo date('Y-m-d'); ?>" required >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">State Student Resides In<span style="color: red">*</span></label>
                    <select id="state" class="form-select border-0 shadow-sm rounded-3" required>
                      <option value="-1">Select State</option>
                      <!-- State options -->
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
                </div>
              </div>

              <!-- Additional fields -->
              <div class="row g-4">
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">County<span style="color: red">*</span></label>
                    <select id="county" class="form-select border-0 shadow-sm rounded-3" required>
                      <option value="-1">County...</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">Age<span style="color: red">*</span></label>
                    <input type="number" id="age" class="form-control border-0 shadow-sm rounded-3">
                  </div>
                </div>
              </div>

              <div class="row g-4">
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">Grade<span style="color: red">*</span></label>
                    <select id="student_grade" class="form-select border-0 shadow-sm rounded-3" required>
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
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">Gender<span style="color: red">*</span></label>
                    <select id="gender" class="form-select border-0 shadow-sm rounded-3" required>
                      <option value="-1">Select</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="n/a">Prefer Not to Provide</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Study Year -->
              <div class="row g-4 mt-2">
                <div class="col-md-10">
                  <label class="form-label text-secondary fw-medium">Please Select Which Year You Would Like To Register For<span style="color: red">*</span></label>
                </div>
                <div class="col-md-2">
                  <select id="study_year" class="form-select border-0 shadow-sm rounded-3 ans1" required>
                    <option value="-1">SELECT</option>
                    <?php
                    $currentYear = date('Y');
                    $nextYear = $currentYear + 1;
                    $nextNextYear = $nextYear + 1;

                    echo "<option value='" . $currentYear . "-" . $nextYear . "'>" . $currentYear . "-" . $nextYear . "</option>";
                    echo "<option value='" . $nextYear . "-" . $nextNextYear . "'>" . $nextYear . "-" . $nextNextYear . "</option>";
                    ?>
                  </select>
                </div>
              </div>

              <!-- Parental Agreement Section -->
              <div class="row g-4 mt-2">
                <div class="col-md-10">
                  <label class="form-label text-secondary fw-medium">Are both parents (when applicable) in agreement to homeschooling this student and registering them with Graduates Academy?<span style="color: red">*</span></label>
                </div>
                <div class="col-md-2">
                  <select id="parental_agreement" class="form-select border-0 shadow-sm rounded-3 ans1" required>
                    <option value="-1">SELECT</option>
                    <option value="no">NO</option>
                    <option value="yes">YES</option>
                    <option value="not applicable">Not Applicable</option>
                  </select>
                </div>
              </div>

              <div class="row g-4 mt-2">
                <div class="col-md-12 please_describe hide">
                  <label class="form-label text-secondary fw-medium"><span style="color: red">*</span>Please Describe:</label>
                  <input type="text" id="please_describe" class="form-control border-0 shadow-sm rounded-3">
                </div>
              </div>

              <div class="row g-4 mt-2">
                <div class="col-md-10">
                  <label class="form-label text-secondary fw-medium">Truancy/Expulsion - Does this Student have prior truancy, expulsion, suspension, or misdemeanor issues?<span style="color: red">*</span></label>
                </div>
                <div class="col-md-2">
                  <select id="truancy" class="form-select border-0 shadow-sm rounded-3 ans2" required>
                    <option value="-1">SELECT</option>
                    <option value="no">NO</option>
                    <option value="yes">YES</option>
                  </select>
                </div>
              </div>

              <div class="row g-4 mt-2">
                <div class="col-md-10">
                  <label class="form-label text-secondary fw-medium">Is this Student transferring from another school or umbrella program?</label>
                </div>
                <div class="col-md-2">
                  <select id="transfer_student" class="form-select border-0 shadow-sm rounded-3 ans3" required>
                    <option value="-1">SELECT</option>
                    <option value="no">NO</option>
                    <option value="yes">YES</option>
                  </select>
                </div>
              </div>
 
              <!-- Profile Image Upload -->
              <div class="row mt-4">
                <div class="col-6">
                  <div class="form-group">
                    <label class="form-label text-secondary fw-medium">Student Photo (Optional)</label>
                    <input type="file" id="student-profile" class="form-control border-0 shadow-sm rounded-3" 
                        accept="image/*" onchange="previewImage(this);">
                    <div class="mt-2 student_image hide">
                    <img id="preview-profile-img" src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'img/profile_default.jpg'; ?>" 
                        alt="Profile Preview" style="max-width: 100px; display: block;">
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label class="form-label text-secondary fw-medium">Immunization Record (Optional)</label>
                    <input type="file" id="immunization_file" class="form-control border-0 shadow-sm rounded-3" 
                        accept=".pdf, .doc, .docx, .jpg, .jpeg, .png" onchange="SetImmunization(this);">
                    <input type="hidden" id="immunization_file_url">
                  </div> 
                </div>
              </div> 

              <!-- Transfer Details Section -->
              <div class="row g-4 mt-2 transfer-details hide">
                <hr>
                <h4 class="text-secondary fw-medium text-center">Transfer Details</h4>
                <div class="col-lg-6">
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">School Type</label>
                      <select name="" id="add_student_school_type" class="form-select border-0 shadow-sm rounded-3">
                          <option value="public school">Public School</option>
                          <option value="private school">Private School</option>
                          <option value="online program">Online Program</option>
                          <option value="umbrella school">Umbrella School</option>
                          <option value="homeschooled through county/district office">
                              Homeschooled Through County/District Office
                          </option>
                      </select>
                  </div>
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">School Phone</label>
                    <div class="input-group shadow-sm rounded-3 overflow-hidden">
                        <select class="form-select border-0 country_code" id="add_student_school_country_code" name="school_country_code" required style="max-width: 120px;">
                        </select>
                        <input type="tel" class="form-control border-0" id="add_student_schoolPhone" name="schoolPhone" onkeyup="validateNumber(this.value, '#add_student_schoolPhone')"
                        required>
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">School Address</label>
                    <input type="text" id="add_student_schoolAddress" class="form-control border-0 shadow-sm rounded-3" >
                  </div>
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">School State</label>
                    <select id="state" class="form-select border-0 shadow-sm rounded-3" >
                        <option value="-1">Select State</option>
                        <!-- State options -->
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
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">School Zip Code</label>
                    <input type="text" id="add_student_schoolZipCode" class="form-control border-0 shadow-sm rounded-3" >
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">School Name</label>
                    <input type="text" id="add_student_schoolName" class="form-control border-0 shadow-sm rounded-3" >
                  </div>
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">School Email</label>
                    <input type="email" id="add_student_schoolEmail" class="form-control border-0 shadow-sm rounded-3" >
                  </div>
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">School City</label>
                    <input type="text" id="add_student_schoolCity" class="form-control border-0 shadow-sm rounded-3" >
                  </div>
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">School County</label>
                    <select id="county" class="form-select border-0 shadow-sm rounded-3" >
                      <option value="-1">Select County</option>
                      <!-- County options would go here -->
                    </select>
                  </div>
                  <div class="form-group mb-3">
                    <label class="form-label text-secondary fw-medium">Last Date of Study</label>
                    <input type="date" id="add_student_lastDateOfStudy" class="form-control border-0 shadow-sm rounded-3" max="<?php echo date('Y-m-d'); ?>" >
                  </div>
                </div>
              </div>

              <!-- Submit Button -->
              <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-primary save_student"><i class="fas fa-save me-2"></i>Save Student</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Transfer Details Modal -->
    <div class="modal fade" id="transferModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow">
          <div class="modal-header" style="background-color: #456fb6;">
            <div class="d-flex align-items-center">
              <i class="fas fa-exchange-alt fs-4 text-white me-2"></i>
              <h5 class="modal-title text-white mb-0">School Transfer Details</h5>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4 bg-light">
            <div class="row g-4">
              <div class="col-lg-6">
                <div class="form-group mb-3">
                  <label class="form-label text-secondary fw-medium"><i class="fas fa-school me-2"></i>School Type</label>
                  <input type="text" id="schoolType" class="form-control border-0 shadow-sm rounded-3" readonly>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label text-secondary fw-medium"><i class="fas fa-building me-2"></i>School Name</label>
                  <input type="text" id="schoolName" class="form-control border-0 shadow-sm rounded-3" readonly>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label text-secondary fw-medium"><i class="fas fa-phone me-2"></i>School Phone</label>
                  <input type="text" id="schoolPhone" class="form-control border-0 shadow-sm rounded-3" readonly>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label text-secondary fw-medium"><i class="fas fa-envelope me-2"></i>School Email</label>
                  <input type="email" id="schoolEmail" class="form-control border-0 shadow-sm rounded-3" readonly>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label text-secondary fw-medium"><i class="fas fa-calendar-alt me-2"></i>Last Date of Study</label>
                  <input type="text" id="lastDateOfStudy" class="form-control border-0 shadow-sm rounded-3" readonly>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group mb-3">
                  <label class="form-label text-secondary fw-medium"><i class="fas fa-map-marker-alt me-2"></i>School Address</label>
                  <input type="text" id="schoolAddress" class="form-control border-0 shadow-sm rounded-3" readonly>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label text-secondary fw-medium"><i class="fas fa-city me-2"></i>School City</label>
                  <input type="text" id="schoolCity" class="form-control border-0 shadow-sm rounded-3" readonly>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label text-secondary fw-medium"><i class="fas fa-flag me-2"></i>School State</label>
                  <input type="text" id="schoolState" class="form-control border-0 shadow-sm rounded-3" readonly>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label text-secondary fw-medium"><i class="fas fa-map me-2"></i>School County</label>
                  <input type="text" id="schoolCounty" class="form-control border-0 shadow-sm rounded-3" readonly>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label text-secondary fw-medium"><i class="fas fa-mail-bulk me-2"></i>School Zip Code</label>
                  <input type="text" id="schoolZipCode" class="form-control border-0 shadow-sm rounded-3" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- View Immunization File Modal -->
    <div class="modal fade" id="viewImmunizationModal" tabindex="-1" aria-labelledby="viewImmunizationModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
          <div class="modal-header" style="background-color: #456fb6;">
            <div class="d-flex align-items-center">
              <i class="fas fa-syringe fs-4 text-white me-2"></i>
              <h5 class="modal-title text-white mb-0" id="viewImmunizationModalLabel">Immunization Record</h5>
            </div>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <div class="row">
              <div class="col-md-12">
                <div class="card shadow-sm h-100">
                  <div class="card-body">
                    <h6 class="fw-bold text-primary mb-3 text-center">
                      <i class="fas fa-eye me-2"></i>Document Preview
                    </h6>
                    <div class="document-preview-container" style="height: 500px;">
                      <div id="immunization_pdf_preview" style="height: 100%; display: none;">
                        <embed src="" type="application/pdf" width="100%" height="100%" id="immunization_pdf_viewer">
                      </div>
                      <div id="immunization_image_preview" style="height: 100%; display: none;">
                        <img src="" id="immunization_image_viewer" class="img-fluid h-100 w-100 object-fit-contain">
                      </div>
                      <div id="immunization_doc_preview" style="height: 100%; display: none;">
                        <iframe src="" width="100%" height="100%" id="immunization_doc_viewer"></iframe>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-center">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="download_immunization" class="btn btn-primary">
              <i class="fas fa-download me-2"></i>Download Record
            </button>
          </div>
        </div>
      </div>
    </div>

</div>

<!-- Drop Down JS -->
<!-- <script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__); ?>js/drop_down.js"></!-->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>js/drop_down.js"></script>

<!-- Include the AJAX handler file -->
<!-- <script type="text/javascript"  src="<?php echo plugin_dir_url(__FILE__); ?>ajax/view_student_data_ajax_function.js"></script> -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>ajax/view_student_data_ajax_function.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.querySelector(".dp-btn");
    const dropdownMenu = document.querySelector(".dropdown-menu");

    // Toggle the dropdown menu on button click
    toggleButton.addEventListener("click", function () {
      dropdownMenu.classList.toggle("show");
    });

    // Close the dropdown menu when clicking outside
    document.addEventListener("click", function (event) {
      if (!toggleButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.remove("show");
      }
    });
  });

  // Function to preview the profile image
  function previewImage(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('.student_image').removeClass('hide');
        document.getElementById('preview-profile-img').src = e.target.result;

        // Handle file upload to WordPress media library
        let formData = new FormData();
        formData.append('file', input.files[0]);
        formData.append('action', 'ajax_handle_fileUpload');

        $.ajax({
          url: ajax_object.ajax_url,
          type: 'POST', 
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            if (response.success) {
              // Store the media URL returned from WordPress
              const fileUrl = response.data.media_url;
              document.getElementById('preview-profile-img').src = fileUrl;
            }
          }
        });
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  // Function to set the immunization file URL
  function SetImmunization(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {

        // Handle file upload to WordPress media library
        let formData = new FormData();
        formData.append('file', input.files[0]);
        formData.append('action', 'ajax_handle_fileUpload');

        $.ajax({
          url: ajax_object.ajax_url,
          type: 'POST', 
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            if (response.success) {
              // Store the media URL returned from WordPress
              const fileUrl = response.data.media_url;
              document.getElementById('immunization_file_url').value = fileUrl;
            }
          }
        });
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>