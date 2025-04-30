<div class="container mt-4">
    <!-- Student list -->
    <div class="student-list">
        <div class="row mb-3 student-names">
        </div>
    </div>
    <!-- Student Attendance Container -->
    <div id="student_attendance_container">
    </div>
</div>

<!-- Add attendance modal -->
<div class="modal fade" id="add-attendance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0  text-white p-4" style="background-color: #456fb6;">
                <h1 class="modal-title fs-4 fw-bold" id="exampleModalLabel">
                    <i class="fas fa-calendar-check me-2"></i>Add Attendance
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="">
                <input type="hidden" id="student_id" value="">
                <input type="hidden" id="registration_id" value="">
                    <div class="form-group mb-4">
                        <label for="student_attendance_year" class="form-label fw-bold">Academic Year</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <select class="form-select form-select-lg" id="student_attendance_year">
                                <?php
                                $currentYear = date('Y');
                                $startYear = $currentYear - 5;
                                $endYear = $currentYear + 1;
                                
                                while ($startYear <= $endYear) {
                                    $academicYear = $startYear . '-' . ($startYear + 1);
                                    $selected = ($startYear == $currentYear) ? 'selected' : '';
                                    echo "<option value='$academicYear' $selected>$academicYear</option>";
                                    $startYear++;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <label class="form-label fw-bold mb-3">Fall Semester</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        <input type="number" id="semester_1" class="form-control form-control-lg" min="0" max="365" value="0" placeholder="Enter fall attendance days">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <label class="form-label fw-bold mb-3">Spring Semester</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        <input type="number" id="semester_2" class="form-control form-control-lg" min="0" max="365" value="0" placeholder="Enter spring attendance days">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <label class="form-label fw-bold mb-3">Summer Semester</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        <input type="number" id="semester_3" class="form-control form-control-lg" min="0" max="365" value="0" placeholder="Enter summer attendance days">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn blue-btn me-2" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn blue-btn btn-lg px-4" id="student_attendance_create">
                            <i class="fas fa-save me-2"></i>Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- edit attendance -->
<div class="modal fade" id="edit-attendance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0  text-white p-4" style="background-color: #456fb6;">
                <h1 class="modal-title fs-4 fw-bold" id="exampleModalLabel">
                    <i class="fas fa-edit me-2"></i>Edit Attendance
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="">
                    <input type="hidden" id="edit_attendance_id" value="">
                    <div class="form-group mb-4">
                        <label for="edit_student_attendance_year" class="form-label fw-bold">Academic Year</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <select class="form-select form-select-lg" id="edit_student_attendance_year" disabled>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <label class="form-label fw-bold mb-3">Fall Semester</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        <input type="number" id="edit_semester_1" class="form-control form-control-lg" min="0" max="365" value="0" placeholder="Enter fall attendance days">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <label class="form-label fw-bold mb-3">Spring Semester</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        <input type="number" id="edit_semester_2" class="form-control form-control-lg" min="0" max="365" value="0" placeholder="Enter spring attendance days">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <label class="form-label fw-bold mb-3">Summer Semester</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        <input type="number" id="edit_semester_3" class="form-control form-control-lg" min="0" max="365" value="0" placeholder="Enter summer attendance days">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn blue-btn me-2" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn blue-btn btn-lg px-4" id="student_attendance_edit">
                            <i class="fas fa-save me-2"></i>Update 
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include the AJAX handler file -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>ajax/attendance_ajax_function.js"></script>