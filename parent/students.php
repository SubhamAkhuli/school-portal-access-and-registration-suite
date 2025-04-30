<div class="container">
    <!-- <div class="card mb-4"> -->
        <div class="d-flex justify-content-center justify-content-lg-end gap-2 flex-wrap">
            
            <a href="/add-new-student/" class="btn blue-btn" title="For Current School Year"><i class="fa-solid fa-user-plus"></i> &nbsp Add New Student</a>
            
        </div>
    <!-- </div> -->
    
    <!-- Student Details Container -->
    <div id="student-container">
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
<!-- Include the AJAX handler file -->
<script type="text/javascript"  src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>ajax/student_data_ajax_function.js"></script>
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
</script>