<link rel="stylesheet" href="<?php echo plugin_dir_url(dirname(__FILE__))  . 'css/bootstrap.min.css'; ?>">

<div class="container-fluid">   
    <!-- Student names -->
    <div class="row mb-3 student-names">
    </div>

    <!-- Student Course Container -->
    <div id="student-course-container"></div>
   
    <!-- Add and view note Modal -->
    <div class="modal fade" id="courseNotesModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #456fb6; color: white;">
                    <h5 class="modal-title"><i class="fa-solid fa-note-sticky"></i> Course Notes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <!-- Notes View Toggle -->
                    <button class="btn btn-outline-primary mb-3 w-100" type="button" data-bs-toggle="collapse" data-bs-target="#viewNotesSection">
                        <i class="fa-solid fa-eye"></i> View Existing Notes
                    </button>
                    
                    <div class="collapse mb-4" id="viewNotesSection">
                        <div class="card">
                            <div class="card-body bg-light">
                                <div id="existingNotes" class="list-group">
                                    <!-- Notes will be dynamically populated here -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add New Note Form -->
                    <form id="addNoteForm" enctype="multipart/form-data">
                        <input type="hidden" name="student_id" id="note_student_id">
                        <input type="hidden" name="course_id" id="note_course_id">
                        
                        <div class="mb-3">
                            <label class="form-label"><i class="fa-solid fa-pen"></i> Course Note</label>
                            <textarea name="note" class="form-control" rows="6" placeholder="Enter your note here..."></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label"><i class="fa-solid fa-paperclip"></i> Attach File</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                    </form>
                </div>
                
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button form="addNoteForm" class="btn blue-btn">
                        <i class="fa-solid fa-save"></i> Save Notes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->
<!-- Include the AJAX handler file -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>ajax/class_ajax_function.js"></script>

<style type="text/css">
    .modern-table {
        width: 100%;
        border-collapse: collapse;
        /* overflow: hidden; */
    }

    .modern-table thead {
        background-color: #bc9f5e !important;
        color: white !important;
        text-align: left;
    }

    .modern-table th, .modern-table td {
        padding: 12px 15px;
        text-align: left;
    }

    .modern-table tbody tr:nth-child(odd) {
        background-color: #f2f2f2;
    }

    .modern-table tbody tr:nth-child(even) {
        background-color: #fff;
    }

    .modern-table tbody tr:hover {
        background-color: #d7e3fc;
        cursor: pointer;
    }

    .modern-table th {
        font-weight: bold;
        text-transform: uppercase;
        background-color: #bc9f5e !important;
        color: #fff;
    }
    .reg_add_course_area .grade select {
        width: 170px;
    }
    .reg_add_course_area .credit  select {
        width: 80px;
    }
    .reg_add_course_area .additional  select {
        width: 150px;
    }
    .reg_add_course_area .schedule  select {
        width: 120px;
    }
    .modern-table select {
        padding: 0.5rem 0.5rem;
    }
    .modern-table .badge {
        font-size: 80%;
        font-weight: 400;
    }
    .form-card {
        background-color:#f1f1f1; 
        overflow: auto;
    }
    .titlebar .dropdown-menu {
        left: -180px;
    }
</style>