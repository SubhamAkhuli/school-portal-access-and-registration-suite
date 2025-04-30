<div class="container">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <div>
                <table class="table table-hover table-striped graduates-table border w-100">
                    <thead class="text-white">
                        <tr>
                            <th class="text-center py-3">Parent Name</th>
                            <th class="text-center py-3">Student Name</th>
                            <th class="text-center py-3">Graduation Data</th>
                            <th class="text-center py-3">Student Details</th>
                            <th class="text-center py-3">Official Transcript</th>
                            <th class="text-center py-3">Actions</th>
                            <th class="text-center py-3">Submit Date</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- View Graduate Data modal -->
    <div class="modal fade" id="view-graduate-data" tabindex="-1" aria-labelledby="viewGraduateDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header"  style="background-color: #456fb6;">
                    <div class="d-flex align-items-center">
                        <h5 class="modal-title text-white mb-0 " id="viewGraduateDataLabel">View Graduate Data</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="graduateDataForm">
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded" id="ageVerificationSection">
                                <select class="form-select graduate_ans1" id="studentAgeSelect" style="width: 100px" disabled>
                                    <option value="-1">Select</option>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                                <label class="form-label mb-0" for="studentAgeSelect">Is the student 15 years of age or older?</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded" id="courseWorkSection">
                                <select class="form-select graduate_ans2" id="courseWorkSelect" style="width: 100px" disabled>
                                    <option value="-1">Select</option>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                                <div>
                                    <label class="form-label mb-0" for="courseWorkSelect">Has the student completed 22 hours of High School coursework as required by the state of Tennessee to graduate?</label>
                                    <div class="text-danger fw-bold mt-1" id="gradesWarning">All Grades Must be Reported Before Applying to Graduate</div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="p-3 bg-light rounded" id="specialRequirementsSection">
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input check1" id="specialNeeds" disabled>
                                    <label class="form-check-label fw-bold text-dark" for="specialNeeds">
                                        Please select if this student requires a Modified Diploma or Certificate of Completion. (Special Needs Students)
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input check2" id="allowChanges" disabled>
                                    <label class="form-check-label fw-bold text-dark" for="allowChanges">
                                        Please select if you would like to allow us to make minor changes to the transcript to fix potential errors or issues.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded" id="enrollmentSection">
                                <select class="form-select graduate_ans3" id="enrollmentSelect" style="width: 100px" disabled>
                                    <option value="-1">Select</option>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                                <label class="form-label fw-bold mb-0" for="enrollmentSelect">Has the student been enrolled with us since the 9th grade or before?</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn blue-btn px-4 rounded-3 shadow-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Rejection Reason -->
    <!-- View Rejection Reason Modal -->
    <div class="modal fade" id="rejection-reason-modal" tabindex="-1" aria-labelledby="rejectionReasonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #456fb6;">
                    <div class="d-flex align-items-center">
                        <h5 class="modal-title text-white mb-0" id="rejectionReasonModalLabel">Rejection Reason</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-3 bg-light rounded">
                        <h6 class="fw-bold mb-2">Reason for Rejection:</h6>
                        <p id="rejection-reason-text" class="mb-0"></p>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn blue-btn px-4 rounded-3 shadow-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="<?php echo plugin_dir_url(__FILE__); ?>ajax/graduateData_ajax_function.js"></script> -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>ajax/graduateData_ajax_function.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>