<div class="container mt-4">
    <!-- Student names and Back Button -->
    <div class="row mb-3">
        <div class="col-6">
            <button onclick="window.history.back();" class="btn blue-btn"><i class="fa fa-arrow-left"></i> Back</button>
        </div>
        <div class="col-6 student-names d-flex align-items-center justify-content-end">
            <!-- Student names will be populated here -->
        </div>
    </div>
    <!-- Student Attendance Container -->
    <div id="student_attendance_container">
    </div>
</div>

<!-- Add attendance modal -->
<div class="modal fade" id="add-attendance" tabindex="-1" aria-labelledby="addAttendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white py-2">
                <h5 class="modal-title" id="addAttendanceModalLabel">
                    <i class="fas fa-calendar-check"></i> Add Attendance
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <form>
                    <input type="hidden" id="student_id" value="">
                    <input type="hidden" id="registration_id" value="">
                    
                    <div class="mb-3">
                        <label for="student_attendance_year" class="form-label fw-bold small">Academic Year</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <select class="form-select form-select-sm" id="student_attendance_year">
                                <?php
                                $currentYear = date('Y');
                                $startYear = $currentYear; // Start with next year
                                $endYear = $currentYear - 10;   // Go back at least 11 years
                                
                                for ($year = $startYear; $year >= $endYear; $year--) {
                                    $academicYear = $year . '-' . ($year + 1);
                                    $selected = ($year == $currentYear) ? 'selected' : '';
                                    echo "<option value='$academicYear' $selected>$academicYear</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <label class="form-label fw-bold small">Fall Semester</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            <input type="number" id="semester_1" class="form-control" min="0" max="365" value="0">
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <label class="form-label fw-bold small">Spring Semester</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            <input type="number" id="semester_2" class="form-control" min="0" max="365" value="0">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Summer Semester</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            <input type="number" id="semester_3" class="form-control" min="0" max="365" value="0">
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <button  class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-sm btn-primary" id="student_attendance_create">
                            <i class="fas fa-save"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- edit attendance -->
<div class="modal fade" id="edit-attendance" tabindex="-1" aria-labelledby="editAttendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white py-2">
                <h5 class="modal-title" id="editAttendanceModalLabel">
                    <i class="fas fa-edit me-1"></i> Edit Attendance
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <form>
                    <input type="hidden" id="edit_attendance_id" value="">
                    <input type="hidden" id="edit_student_id" value="">
                    <div class="mb-3">
                        <label for="edit_student_attendance_year" class="form-label fw-bold small">Academic Year</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <select class="form-select" id="edit_student_attendance_year" disabled>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <label class="form-label fw-bold small">Fall Semester</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            <input type="number" id="edit_semester_1" class="form-control" min="0" max="365" value="0">
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <label class="form-label fw-bold small">Spring Semester</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            <input type="number" id="edit_semester_2" class="form-control" min="0" max="365" value="0">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Summer Semester</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            <input type="number" id="edit_semester_3" class="form-control" min="0" max="365" value="0">
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <button class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-sm btn-primary" id="student_attendance_edit">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include the AJAX handler file -->
<!-- <script src="<?php echo plugin_dir_url(__FILE__); ?>ajax/view_attendance_ajax_function.js"></script> -->

<!-- Make sure DataTables is included before our script -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">


<!-- Include the AJAX handler file -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>ajax/view_attendance_ajax_function.js"></script>