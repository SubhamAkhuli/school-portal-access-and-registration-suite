<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-sm-12 text-center">
            <div class="mt-4">
                <!-- Renew Registration Card -->
                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#renewModal">
                    <div class="card mb-4 rounded-4 shadow" style="background-color: #456fb6;">
                        <div class="card-body">
                            <h2 class="card-title text-white mb-0">RENEW REGISTRATION</h2>
                            <p class="card-text text-white mb-1">(For the Next School Year)</p>
                        </div>
                    </div>
                </a>
                
                <!-- Renew Registration Modal -->
                <div class="modal fade" id="renewModal" tabindex="-1" aria-labelledby="renewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #456fb6; color: white;">
                                <h5 class="modal-title" id="renewModalLabel"><i class="fas fa-user-graduate me-2"></i>Select Students for Registration Renewal</h5>
                                <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="student-renew-list">
                                    <!-- Student items with checkboxes -->
                                    <div class="student-item d-flex align-items-center mb-3">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="renewSelection" value="" id="renewStudent1">
                                        </div>
                                        <img src="<?php echo plugin_dir_url(dirname(__FILE__))  . 'img/new_male_default.png'; ?>" class="rounded-circle me-3" style="width: 50px; height: 50px; border: 2px solid #456fb6;">
                                        <label class="form-check-label" for="renewStudent1">
                                            <div>
                                                <h6 class="mb-0">Student Name</h6>
                                                <small>Current Grade: 11</small>
                                            </div>
                                        </label>
                                    </div>
                                    <!-- Add more student items dynamically -->
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button class="btn blue-btn" data-bs-dismiss="modal">Close</button>
                                    <button class="btn blue-btn" id="renewRegistration" onclick="renewRegistration()" aria-label="Renew registration button">Renew Registration</button>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>

                <!-- Add New Student Card -->
                <a href="/add-new-student" class="text-decoration-none">
                    <div class="card mb-4 rounded-4 shadow" style="background-color: #456fb6;">
                        <div class="card-body">
                            <h2 class="card-title text-white mb-0">ADD NEW STUDENT</h2>
                            <p class="card-text text-white mb-1">(For Current School Year)</p>
                        </div>
                    </div>
                </a>

                <!-- Graduate Card -->
                <!-- Graduate Card with Modal -->
                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#graduateModal">
                    <div class="card mb-4 rounded-4 shadow" style="background-color: #456fb6;">
                        <div class="card-body">
                            <h2 class="card-title text-white mb-0">APPLY TO GRADUATE</h2>
                            <p class="card-text text-white mb-1">(Only for Grade 11th and 12th Students)</p>
                        </div>
                    </div>
                </a>

                <!-- Graduate Modal -->
                <div class="modal fade" id="graduateModal" tabindex="-1" aria-labelledby="graduateModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #456fb6; color: white;">
                                <h5 class="modal-title" id="graduateModalLabel">Select Students for Graduation</h5>
                                <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="student-graduate-list">
                                    <!-- Student items with checkboxes -->
                                    <div class="student-item d-flex align-items-center mb-3">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="studentSelection" value="" id="student1">
                                        </div>
                                        <img src="<?php echo plugin_dir_url(dirname(__FILE__))  . 'img/new_male_default.png'; ?>" class="rounded-circle me-3" style="width: 50px; height: 50px; border: 2px solid #456fb6;">
                                        <label class="form-check-label" for="student1">
                                            <div>
                                                <h6 class="mb-0">Student Name</h6>
                                                <small>Grade: 12</small>
                                            </div>
                                        </label>
                                    </div>
                                    <!-- Add more student items dynamically -->
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button class="btn blue-btn" data-bs-dismiss="modal">Close</button>
                                    <button class="btn blue-btn" id="applyForGraduation" onclick="applyForGraduation()" aria-label="Apply for graduation button">Apply for Graduation</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- AJAX JS -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>ajax/link_ajax_function.js"></script>