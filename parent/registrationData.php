<div class="container">
    <div class="header mb-4 pt-3" id="header">
        <div class="container" id="header-container">
            <div class="bg-white rounded-3 shadow p-4">
                <!-- Student Profile Summary -->
                <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
                    <div class="d-flex align-items-center gap-4 flex-column flex-md-row">
                        <div class="position-relative" style="width: 100px; height: 100px;">
                            <img src="<?php echo plugin_dir_url(dirname(__FILE__))  . 'img/profile_default.jpg'; ?>" 
                                 alt="Student Photo"
                                 class="w-100 h-100 rounded-circle object-fit-cover border border-3 border-white shadow-sm">
                        </div>
                        <div>
                            <h2 id="student_name" class="fs-4 fw-semibold text-dark mb-2">Student Name</h2>
                            <div class="d-flex align-items-center gap-3 text-secondary justify-content-center justify-content-md-start">
                                <span class="d-flex align-items-center gap-2">
                                    <i class="fas fa-graduation-cap text-gray-600"></i>
                                    Grade: <span id="student_grade">8</span>
                                </span>
                                <span class="text-gray-300">•</span>
                                <span class="d-flex align-items-center gap-2">
                                    <i class="fas fa-user text-gray-600"></i>
                                    Parent: <span id="parent_name">Parent Name</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 mt-md-0">
                        <button class="btn btn-primary d-flex align-items-center gap-2">
                            <i class="fas fa-eye"></i>
                            View Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- tabs -->
    <div class="tabs-bg">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-parent1-tab" data-bs-toggle="tab" data-bs-target="#nav-parent1"
                    type="button" role="tab" aria-controls="nav-parent1" aria-selected="true">Parent #1</button>
                <button class="nav-link" id="nav-parent2-tab" data-bs-toggle="tab" data-bs-target="#nav-parent2"
                    type="button" role="tab" aria-controls="nav-parent2" aria-selected="false">Parent #2</button>
                <button class="nav-link" id="nav-add-info-tab" data-bs-toggle="tab" data-bs-target="#nav-add-info"
                    type="button" role="tab" aria-controls="nav-add-info" aria-selected="false">Additional
                    Information</button>
                <button class="nav-link" id="nav-stud-app-tab" data-bs-toggle="tab" data-bs-target="#nav-stud-app"
                    type="button" role="tab" aria-controls="nav-stud-app" aria-selected="false">Student Application</button>
                <button class="nav-link" id="nav-address-tab" data-bs-toggle="tab" data-bs-target="#nav-address"
                    type="button" role="tab" aria-controls="nav-address" aria-selected="false">Address</button>
                <button class="nav-link" id="nav-digital-signature-tab" data-bs-toggle="tab" data-bs-target="#nav-digital-signature"
                    type="button" role="tab" aria-controls="nav-digital-signature" aria-selected="false">Digital Signature</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-parent1" role="tabpanel" aria-labelledby="nav-parent1-tab"
                tabindex="0">
                <div class="row" id="parent1-details">
                    <div class="d-flex align-items-center mb-4 justify-content-between">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-user-circle fs-2 text-primary me-3 mt-1"></i>
                            <h5 class="mb-0">Parent #1 Information</h5>
                        </div>
                        <button class="btn btn-light rounded-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#edit-parent1">
                            <i class="fas fa-edit text-primary"></i>
                        </button>
                    </div>

                    <div class="card border-0 bg-light rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-id-card text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Role</p>
                                            <p class="mb-0 fw-medium" id="p1_role"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-user text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Name</p>
                                            <p class="mb-0 fw-medium" id="p1_full_name"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-phone text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Contact</p>
                                            <p class="mb-0 fw-medium" id="p1_contact"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Email</p>
                                            <p class="mb-0 fw-medium" id="p1_email"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-calendar text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">School Year</p>
                                            <p class="mb-0 fw-medium" id="p1_school_year"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-info-circle text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">How did you hear about us?</p>
                                            <p class="mb-0 fw-medium" id="p1_heard_about_us"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-bell text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Message Authorization</p>
                                            <p class="mb-0 fw-medium" id="p1_msg_authorization"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-gavel text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Legal Custody</p>
                                            <p class="mb-0 fw-medium" id="p1_legal_custody"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-certificate text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">High School Diploma/GED</p>
                                            <p class="mb-0 fw-medium" id="p1_high_school_diploma"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-graduation-cap text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Education Level</p>
                                            <p class="mb-0 fw-medium" id="p1_education_level"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-home text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Lives with Student</p>
                                            <p class="mb-0 fw-medium" id="p1_lives_with_student"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-flag text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">US Citizen</p>
                                            <p class="mb-0 fw-medium" id="p1_us_citizen"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-parent2" role="tabpanel" aria-labelledby="nav-parent2-tab" tabindex="0">
                <div class="row" id="parent2-details">
                    <div class="d-flex align-items-center mb-4 justify-content-between">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-user-circle fs-2 text-primary me-3 mt-1"></i>
                            <h5 class="mb-0">Parent #2 Information</h5>
                        </div>
                        <button class="btn btn-light rounded-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#edit-parent2">
                            <i class="fas fa-edit text-primary"></i>
                        </button>
                    </div>

                    <div class="card border-0 bg-light rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-id-card text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Role</p>
                                            <p class="mb-0 fw-medium" id="p2_role"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-user text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Name</p>
                                            <p class="mb-0 fw-medium" id="p2_full_name"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-phone text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Contact</p>
                                            <p class="mb-0 fw-medium" id="p2_contact"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Email</p>
                                            <p class="mb-0 fw-medium" id="p2_email"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-calendar text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">School Year</p>
                                            <p class="mb-0 fw-medium" id="p2_school_year"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-bell text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Message Authorization</p>
                                            <p class="mb-0 fw-medium" id="p2_msg_authorization"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-certificate text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">High School Diploma/GED</p>
                                            <p class="mb-0 fw-medium" id="p2_high_school_diploma"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-graduation-cap text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Education Level</p>
                                            <p class="mb-0 fw-medium" id="p2_education_level"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-home text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Lives with Student</p>
                                            <p class="mb-0 fw-medium" id="p2_lives_with_student"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-flag text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">US Citizen</p>
                                            <p class="mb-0 fw-medium" id="p2_us_citizen"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-add-info" role="tabpanel" aria-labelledby="nav-add-info-tab"
                tabindex="0">
                <div class="row" id="additional-info">
                    <div class="d-flex align-items-center mb-4 justify-content-between">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-info-circle fs-2 text-primary me-3 mt-1"></i>
                            <h5 class="mb-0">Additional Information</h5>
                        </div>
                        <button class="btn btn-light rounded-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#additionalModal">
                            <i class="fas fa-edit text-primary"></i>
                        </button>
                    </div>

                    <div class="card border-0 bg-light rounded-3">
                        <div class="card-body">
                            <p class="mb-0"><strong>Q1:</strong> Actively on Probation?</p>
                            <p class="mb-3" id="additional_q1"> <strong>Answer:</strong> No</p>
                            <p class="mb-0"><strong>Q2:</strong> Currently Being Investigated for Abuse or Neglect (Physical or Educational)?</p>
                            <p class="mb-3" id="additional_q2"><strong>Answer:</strong></p>
                            
                            <p class="mb-0"><strong>Q3:</strong> Currently Being Investigated And/Or Charged With a Misdemeanor of Felony?</p>
                            <p class="mb-3" id="additional_q3"><strong>Answer:</strong></p>
                            
                            <p class="mb-0"><strong>Q4:</strong> Currently Involved in an Open Criminal Court Case that Could Lead to a Misdemeanor of Felony?</p>
                            <p class="mb-3" id="additional_q4"><strong>Answer:</strong></p>
                            
                            <p class="mb-0"><strong>Q5:</strong> Does the Student Have a History of Truancy or Expulsion issues?</p>
                            <p class="mb-3" id="additional_q5"><strong>Answer:</strong></p>

                            <div class="mb-0" id="additional_explanation_div">
                            <p class="mb-0"><strong>Explanation:</strong></p>
                            <textarea class="mb-3" id="additional_explanation" disabled></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-stud-app" role="tabpanel" aria-labelledby="nav-stud-app-tab" tabindex="0">
                <div class="row" id="student-application">
                    <div class="d-flex align-items-center mb-4 justify-content-between">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-user-graduate fs-2 text-primary me-3 mt-1"></i>
                            <h5 class="mb-0">Student Application</h5>
                        </div>
                        <button class="btn btn-light rounded-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#applicationModal">
                            <i class="fas fa-edit text-primary"></i>
                        </button>
                    </div>

                    <div class="card border-0 bg-light rounded-3">
                        <div class="card-body">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="ch1">
                                <label class="form-check-label" for="ch1">
                                    Currently involved in an open custody case of an enrolling student
                                </label>
                                </div>
                                <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="ch2">
                                <label class="form-check-label" for="ch2">
                                    Currently a foster parent(s) of an enrolling student
                                </label>
                                </div>
                                <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="ch3">
                                <label class="form-check-label" for="ch3">
                                    Currently have Power of Attorney for an enrolling student 
                                </label>
                                </div>
                                <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="ch4">
                                <label class="form-check-label" for="ch4">
                                    Currently are in the process of adoption of an enrolling student 
                                </label>
                                </div>
                                <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="ch5">
                                <label class="form-check-label" for="ch5">
                                    Other unique family situation
                                </label>
                                </div>
                                <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="ch6">
                                <label class="form-check-label" for="ch6">
                                    None of the above
                                </label>
                                </div>
                                <div class="form-check mb-3" id="application_description_text_div">
                                <label for="application_description_text">Description:</label>
                                    <textarea class="form-control" id="application_description_text" name="application_description_text" disabled></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab" tabindex="0">
                <div class="row" id="parent-address">
                    <div class="d-flex align-items-center mb-4 justify-content-between">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-home fs-2 text-primary me-3 mt-1"></i>
                            <h5 class="mb-0">Address Information</h5>
                        </div>
                        <button class="btn btn-light rounded-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#addressModal">
                            <i class="fas fa-edit text-primary"></i>
                        </button>
                    </div>

                    <div class="card border-0 bg-light rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Street Address</p>
                                            <p class="mb-0 fw-medium" id="street_address"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-city text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">City</p>
                                            <p class="mb-0 fw-medium" id="city"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-flag-usa text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">State</p>
                                            <p class="mb-0 fw-medium" id="parent_state"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-mail-bulk text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Zip Code</p>
                                            <p class="mb-0 fw-medium" id="zip"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-building text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">County</p>
                                            <p class="mb-0 fw-medium" id="county"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-phone text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Emergency Contact</p>
                                            <p class="mb-0 fw-medium" id="emg_contact_phone"></p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user-circle text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Emergency Contact Name</p>
                                            <p class="mb-0 fw-medium" id="emg_contact_name"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-digital-signature" role="tabpanel" aria-labelledby="nav-digital-signature-tab" tabindex="0">
                <div class="row" id="digital-signature">
                    <div class="d-flex align-items-center mb-4 justify-content-between">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-signature fs-2 text-primary me-3 mt-1"></i>
                            <h5 class="mb-0">Digital Signature</h5>
                        </div>
                        <!-- <button class="btn btn-light rounded-circle shadow-sm" data-bs-toggle="modal" data-bs-target="#signatureModal">
                            <i class="fas fa-edit text-primary"></i>
                        </button> -->
                    </div>

                    <div class="card border-0 bg-light rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-signature text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Parent #1 Signature</p>
                                            <img id="signature_image" src="<?php echo plugin_dir_url(dirname(__FILE__))  . 'img/signature_placeholder.png'; ?>" 
                                                 alt="Parent #1 Signature"
                                                 class="img-fluid rounded-3 shadow-sm">
                                        </div>
                                    </div> -->
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-user text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Name</p>
                                            <p class="mb-0 fw-medium" id="signature_name"></p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-calendar text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Date</p>
                                            <p class="mb-0 fw-medium" id="signature_date"></p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-check-square text-primary me-3"></i>
                                        <div>
                                            <p class="text-muted mb-0 small">Agreement</p>
                                            <p class="mb-0 fw-medium" id="signature_check">Agreed to Terms & Conditions</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <!-- tabs end --> 
</div>

<!-- Bootstrap Modal for Parent #1 -->
<div class="modal fade" id="edit-parent1" tabindex="-1" role="dialog" aria-labelledby="parent1ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header" style="background-color: #456fb6; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-edit fs-4 text-white me-2"></i>
                    <h5 class="modal-title text-white mb-0" id="exampleModalLabel">Edit Parent Details</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <form id="parent1-form">
                    <div class="row g-4">
                        <!-- Original fields -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p1_edit_role" class="form-label text-secondary fw-medium">Role:</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="p1_edit_role" name="p1_edit_role" required>
                                    <option value="mother">Mother</option>
                                    <option value="father">Father</option>
                                    <option value="step-mother">Step-Mother</option>
                                    <option value="step-father">Step-Father</option>
                                    <option value="grand-father">Grandfather</option>
                                    <option value="grand-mother">Grandmother</option>
                                    <option value="guardian">Guardian</option>
                                </select>
                            </div>
                        </div>

                        <!-- All existing fields kept with updated styling -->
                        <!-- Names -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p1_edit_f_name" class="form-label text-secondary fw-medium">First Name</label> 
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="p1_edit_f_name" name="p1_edit_f_name" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p1_edit_m_name" class="form-label text-secondary fw-medium">Middle Name</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="p1_edit_m_name" name="p1_edit_m_name" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p1_edit_l_name" class="form-label text-secondary fw-medium">Last Name</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="p1_edit_l_name" name="p1_edit_l_name" required>
                            </div>
                        </div>

                        <!-- Contact and Email -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p1_edit_contact" class="form-label text-secondary fw-medium">Contact:</label>
                                <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                    <select class="form-select border-0 country_code" id="p1_edit_country_code" name="p1_edit_country_code" required style="max-width: 120px;">
                                    </select>
                                    <input type="text" class="form-control border-0" id="p1_edit_contact" name="p1_edit_contact" 
                                    onkeyup="validateNumber(this.value,'#p1_edit_contact', $('#p1_edit_country_code').val())" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p1_edit_email" class="form-label text-secondary fw-medium">Email:</label>
                                <input type="email" class="form-control border-0 shadow-sm rounded-3" id="p1_edit_email" name="p1_edit_email" required>
                            </div>
                        </div>

                        <!-- Additional fields missing from original -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p1_edit_msg_authorization" class="form-label text-secondary fw-medium">Msg Authorization:</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="p1_edit_msg_authorization" name="p1_edit_msg_authorization" required>
                                    <option value="no">NO</option>
                                    <option value="yes">YES</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p1_edit_legal_custody" class="form-label text-secondary fw-medium">Legal Custody:</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="p1_edit_legal_custody" name="p1_edit_legal_custody" required>
                                    <option value="no">NO</option>
                                    <option value="yes">YES</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p1_edit_high_school_diploma" class="form-label text-secondary fw-medium">High School Diploma/GED:</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="p1_edit_high_school_diploma" name="p1_edit_high_school_diploma" required>
                                    <option value="no">NO</option>
                                    <option value="yes">YES</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p1_edit_education_level" class="form-label text-secondary fw-medium">Education Level:</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="p1_edit_education_level" name="p1_edit_education_level" required>
                                    <option value="High School Diploma/GED">High School Diploma/GED</option>
                                    <option value="Associate">Associate's</option>
                                    <option value="Bachelor">Bachelor's</option>
                                    <option value="Master">Master's</option>
                                    <option value="Doctorate/PHD">Doctorate/PHD</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p1_edit_lives_with_student" class="form-label text-secondary fw-medium">Lives with Student:</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="p1_edit_lives_with_student" name="p1_edit_lives_with_student" required>
                                    <option value="no">NO</option>
                                    <option value="yes">YES</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p1_edit_us_citizen" class="form-label text-secondary fw-medium">US Citizen:</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="p1_edit_us_citizen" name="p1_edit_us_citizen" required>
                                    <option value="no">NO</option>
                                    <option value="yes">YES</option>
                                </select>
                            </div>
                        </div>

                        <!-- Existing fields with updated styling -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p1_edit_school_year" class="form-label text-secondary fw-medium">School Year:</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="p1_edit_school_year" name="p1_edit_school_year" readonly>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p1_edit_heard_about_us" class="form-label text-secondary fw-medium">How did you hear about us?</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="p1_edit_heard_about_us" name="p1_edit_heard_about_us" required>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="col-12">
                            <div class="d-flex justify-content-center gap-2 mt-4">
                                <!-- <button class="btn blue-btn px-4 rounded-3 shadow-sm" data-bs-dismiss="modal">Cancel</button> -->
                                <button class="btn blue-btn px-4 rounded-3 shadow-sm" id="parent_1_submit" >Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Modal for Parent #2 -->
<div class="modal fade" id="edit-parent2" tabindex="-1" role="dialog" aria-labelledby="parent2ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header" style="background-color: #456fb6; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-edit fs-4 text-white me-2"></i>
                    <h5 class="modal-title text-white mb-0" id="parent2ModalLabel">Edit Parent Details</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <form id="parent2-form">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p2_edit_role" class="form-label text-secondary fw-medium">Role:</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="p2_edit_role" name="p2_edit_role" required>
                                    <option value="mother">Mother</option>
                                    <option value="father">Father</option>
                                    <option value="step-mother">Step-Mother</option>
                                    <option value="step-father">Step-Father</option>
                                    <option value="grand-father">Grandfather</option>
                                    <option value="grand-mother">Grandmother</option>
                                    <option value="guardian">Guardian</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p2_edit_f_name" class="form-label text-secondary fw-medium">First Name</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="p2_edit_f_name" name="p2_edit_f_name" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p2_edit_m_name" class="form-label text-secondary fw-medium">Middle Name</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="p2_edit_m_name" name="p2_edit_m_name" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p2_edit_l_name" class="form-label text-secondary fw-medium">Last Name</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="p2_edit_l_name" name="p2_edit_l_name" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p2_edit_contact" class="form-label text-secondary fw-medium">Contact:</label>
                                <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                    <select class="form-select border-0 country_code" id="p2_edit_country_code" name="p2_edit_country_code" required style="max-width: 120px;">
                                    </select>
                                    <input type="text" class="form-control border-0" id="p2_edit_contact" name="p2_edit_contact" onkeyup="validateNumber(this.value,'#p2_edit_contact', $('#p2_edit_country_code').val())" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p2_edit_email" class="form-label text-secondary fw-medium">Email:</label>
                                <input type="email" class="form-control border-0 shadow-sm rounded-3" id="p2_edit_email" name="p2_edit_email" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p2_edit_msg_authorization" class="form-label text-secondary fw-medium">Msg Authorization:</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="p2_edit_msg_authorization" name="p2_edit_msg_authorization" required>
                                    <option value="no">NO</option>
                                    <option value="yes">YES</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p2_edit_high_school_diploma" class="form-label text-secondary fw-medium">High School Diploma/GED:</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="p2_edit_high_school_diploma" name="p2_edit_high_school_diploma" required>
                                    <option value="no">NO</option>
                                    <option value="yes">YES</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p2_edit_education_level" class="form-label text-secondary fw-medium">Education Level:</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="p2_edit_education_level" name="p2_edit_education_level" required>
                                    <option value="High School Diploma/GED">High School Diploma/GED</option>
                                    <option value="Associate">Associate's</option>
                                    <option value="Bachelor">Bachelor's</option>
                                    <option value="Master">Master's</option>
                                    <option value="Doctorate/PHD">Doctorate/PHD</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p2_edit_lives_with_student" class="form-label text-secondary fw-medium">Lives with Student:</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="p2_edit_lives_with_student" name="p2_edit_lives_with_student" required>
                                    <option value="no">NO</option>
                                    <option value="yes">YES</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p2_edit_us_citizen" class="form-label text-secondary fw-medium">US Citizen:</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="p2_edit_us_citizen" name="p2_edit_us_citizen" required>
                                    <option value="no">NO</option>
                                    <option value="yes">YES</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="p2_edit_school_year" class="form-label text-secondary fw-medium">School Year:</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="p2_edit_school_year" name="p2_edit_school_year" readonly>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="col-12">
                            <div class="d-flex justify-content-center gap-2 mt-4">
                                <!-- <button class="btn blue-btn px-4 rounded-3 shadow-sm" data-bs-dismiss="modal">Cancel</button> -->
                                <button class="btn blue-btn px-4 rounded-3 shadow-sm" id="parent_2_submit" >Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Modal for Additional Information -->
<div class="modal fade" id="additionalModal" tabindex="-1" role="dialog" aria-labelledby="additionalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header" style="background-color: #456fb6; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle fs-4 text-white me-2"></i>
                    <h5 class="modal-title text-white mb-0" id="additionalModalLabel">Edit Additional Information</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <form id="additional-form">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="additional_edit_q1" class="form-label text-secondary fw-medium">Actively on Probation?</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="additional_edit_q1" name="additional_q1" required>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="additional_edit_q2" class="form-label text-secondary fw-medium">Being Investigated for Abuse or Neglect?</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="additional_edit_q2" name="additional_q2" required>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="additional_edit_q3" class="form-label text-secondary fw-medium">Being Investigated for Misdemeanor/Felony?</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="additional_edit_q3" name="additional_q3" required>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="additional_edit_q4" class="form-label text-secondary fw-medium">Involved in Open Criminal Court Case?</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="additional_edit_q4" name="additional_q4" required>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="additional_edit_q5" class="form-label text-secondary fw-medium">History of Truancy/Expulsion Issues?</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="additional_edit_q5" name="additional_q5" required>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12" id="additional_edit_explanation_div">
                            <div class="form-group">
                                <label for="additional_edit_explanation" class="form-label text-secondary fw-medium">Explanation:</label>
                                <textarea class="form-control border-0 shadow-sm rounded-3" id="additional_edit_explanation" name="additional_explanation" rows="4" required></textarea>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="col-12">
                            <div class="d-flex justify-content-center gap-2 mt-4">
                                <!-- <button class="btn blue-btn px-4 rounded-3 shadow-sm" data-bs-dismiss="modal">Cancel</button> -->
                                <button class="btn blue-btn px-4 rounded-3 shadow-sm" id="additional_submit">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Modal for Student Application -->
<div class="modal fade" id="applicationModal" tabindex="-1" role="dialog" aria-labelledby="applicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header" style="background-color: #456fb6; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-graduate fs-4 text-white me-2"></i>
                    <h5 class="modal-title text-white mb-0" id="applicationModalLabel">Edit Student Application</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <form id="application-form">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="application_q1" class="form-label text-secondary fw-medium">Q1: Currently involved in an open custody case of an enrolling student</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="application_q1" name="application_q1" required>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="application_q2" class="form-label text-secondary fw-medium">Q2: Currently a foster parent(s) of an enrolling student</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="application_q2" name="application_q2" required>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="application_q3" class="form-label text-secondary fw-medium">Q3: Currently have Power of Attorney for an enrolling student</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="application_q3" name="application_q3" required>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="application_q4" class="form-label text-secondary fw-medium">Q4: Currently are in the process of adoption of an enrolling student</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="application_q4" name="application_q4" required>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="application_q5" class="form-label text-secondary fw-medium">Q5: Other unique family situation</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="application_q5" name="application_q5" required>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>   
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="application_q6" class="form-label text-secondary fw-medium">Q6: None of the above</label>
                                <select class="form-select border-0 shadow-sm rounded-3" id="application_q6" name="application_q6" required>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12" id="edit_application_description_text_div">
                            <div class="form-group">
                                <label for="application_description" class="form-label text-secondary fw-medium">Description:</label>
                                <textarea class="form-control border-0 shadow-sm rounded-3" id="application_description" name="application_description" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-center gap-2 mt-4">
                                <button class="btn blue-btn px-4 rounded-3 shadow-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                <button  class="btn blue-btn px-4 rounded-3 shadow-sm" id="application_submit">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Modal for Address -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header" style="background-color: #456fb6; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-home fs-4 text-white me-2"></i>
                    <h5 class="modal-title text-white mb-0" id="addressModalLabel">Edit Address</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light edit_parent_address">
                <form id="address-form">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_street_address" class="form-label text-secondary fw-medium">Street Address:</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="edit_street_address" name="edit_street_address" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_city" class="form-label text-secondary fw-medium">City:</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="edit_city" name="edit_city" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="state" class="form-label text-secondary fw-medium">State:</label>
                                <select id="state" class="form-select border-0 shadow-sm rounded-3">
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
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="county" class="form-label text-secondary fw-medium">County:</label>
                                <select id="county" class="form-select border-0 shadow-sm rounded-3">
                                    <option value='-1'>Select County</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_zip" class="form-label text-secondary fw-medium">Zip:</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="edit_zip" name="edit_zip" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_emg_contact_phone" class="form-label text-secondary fw-medium">Emergency Contact Phone:</label>
                                <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                    <select class="form-select border-0 country_code" id="edit_emg_country_code" name="edit_emg_country_code" required style="max-width: 120px;">
                                    </select>
                                    <input type="tel" class="form-control border-0" id="edit_emg_contact_phone" name="edit_emg_contact_phone" onkeyup="validateNumber(this.value,'#edit_emg_contact_phone', $('#edit_emg_country_code').val())"
                                    required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_emg_contact_name" class="form-label text-secondary fw-medium">Emergency Contact Name:</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="edit_emg_contact_name" name="edit_emg_contact_name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-center gap-2 mt-4">
                                <!-- <button class="btn blue-btn px-4 rounded-3 shadow-sm" data-bs-dismiss="modal">Cancel</button> -->
                                <button class="btn blue-btn px-4 rounded-3 shadow-sm" id="address_submit">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Include the AJAX handler file -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>ajax/registration_details_ajax_function.js"></script>

<!-- Drop Down JS -->
<script type="text/javascript" src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>js/drop_down.js"></script> 