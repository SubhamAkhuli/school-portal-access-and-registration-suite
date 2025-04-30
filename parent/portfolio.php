<div class="container">
    <!-- Button to open upload modal -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div id="portfolio-heading" class="d-flex gap-2">
            <!-- Content for portfolio heading can go here -->
        </div>
        <div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="fas fa-upload"></i> Upload Documents
            </button>
        </div>
    </div>
            
    <!-- <div class="d-flex justify-content-end mb-4" id="portfolio-heading">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
            <i class="fas fa-upload"></i> Upload Documents
        </button>
    </div> -->

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-modal="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header" style="background-color: #456fb6;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-upload fs-4 text-white me-2"></i>
                        <h5 class="modal-title text-white mb-0" id="uploadModalLabel">Upload Documents</h5>
                    </div>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <form method="post" enctype="multipart/form-data" id="portfolio-upload-form">
                        <?php wp_nonce_field('portfolio_upload', 'portfolio_nonce'); ?>
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium" for="student_select">
                                        <i class="fas fa-user me-2"></i>Select Student
                                    </label>
                                    <select class="form-select border-0 shadow-sm rounded-3 student-select" 
                                            id="student_select" name="student_select" required>
                                        <option value="-1">Select a Student</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium" for="document_type">
                                        <i class="fas fa-file me-2"></i>Document Type
                                    </label>
                                    <select class="form-select border-0 shadow-sm rounded-3" 
                                            id="document_type" name="document_type" required>
                                        <option value="-1">Select Document Type</option>
                                        <option value="academic_records">Academic Records</option>
                                        <option value="achievements">Achievements</option>
                                        <option value="certificates">Certificates</option>
                                        <option value="other_documents">Other Documents</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium" for="document_title">
                                        <i class="fas fa-heading me-2"></i>Title
                                    </label>
                                    <input type="text" class="form-control border-0 shadow-sm rounded-3" 
                                           id="document_title" name="document_title" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium" for="document_description">
                                        <i class="fas fa-align-left me-2"></i>Description
                                    </label>
                                    <textarea class="form-control border-0 shadow-sm rounded-3" 
                                              id="document_description" name="document_description" rows="3">
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium" for="document_file">
                                        <i class="fas fa-upload me-2"></i>Upload File
                                    </label>
                                    <input type="file" class="form-control border-0 shadow-sm rounded-3" 
                                           id="document_file" name="document_file" required>
                                    <small class="text-muted">
                                        Supported formats: PDF, DOC, DOCX, JPG, PNG
                                    </small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-center gap-2 mt-4 ">
                                    <button id="upload_btn" class="btn blue-btn px-4 rounded-3 shadow-sm">
                                        <i class="fas fa-save me-2"></i>Upload Documents
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio View Section -->
    <div class="card">
        <div class="accordion" id="portfolioAccordion">
            <h2 class="text-primary text-center mb-4">Student Portfolio</h2>
            <!-- Current Year -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#year2023">
                        2023 Documents
                    </button>
                </h2>
                <div id="year2023" class="accordion-collapse collapse" data-bs-parent="#portfolioAccordion">
                    <div class="accordion-body">
                        <div class="row g-3">
                            <!-- Example Document Card -->
                            <div class="col-md-4">
                                <div class="card h-100 shadow-sm rounded-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="me-3">
                                                <i class="fas fa-file-pdf fs-2 text-danger"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-2 text-truncate fw-bold text-primary">
                                                    document_name.pdf
                                                </h6>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <p class="fw-bold text-primary mb-2">
                                                <i class="fas fa-circle-dot me-2"></i>First Term Report Card
                                            </p>
                                            <div class="mb-1 d-flex align-items-center gap-2 text-nowrap text-secondary">
                                                <small>
                                                    <i class="fas fa-folder-open me-1"></i>Academic Records
                                                </small>
                                                <small>
                                                    <i class="fas fa-user me-1"></i>John Doe
                                                </small>
                                            </div>
                                            <p class="text-muted small">
                                                <i class="fas fa-align-left me-2"></i>Student's first term report card 
                                                for the academic year 2023.
                                            </p>
                                            <div class="text-muted small">
                                                <i class="far fa-calendar-alt me-2"></i> 
                                                June 15, 2023 | 2:30 PM
                                            </div>
                                        </div>

                                        <div class="d-flex gap-2 justify-content-end">
                                            <button class="btn btn-outline-primary btn-sm view_document" 
                                                    data-bs-toggle="tooltip" title="View Details">
                                                <i class="fas fa-eye me-1"></i>View
                                            </button>
                                            <button class="btn btn-outline-success btn-sm download_document" 
                                                    data-bs-toggle="tooltip" title="Download">
                                                <i class="fas fa-download me-1"></i>Download
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm delete_document" 
                                                    data-bs-toggle="tooltip" title="Delete">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more document cards here if needed -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Previous Year -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#year2022">
                        2022 Documents
                    </button>
                </h2>
                <div id="year2022" class="accordion-collapse collapse" data-bs-parent="#portfolioAccordion">
                    <div class="accordion-body">
                        <div class="row g-3">
                            <!-- Previous year documents would go here -->
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <!-- View Portfolio Documents Modal -->
    <div class="modal fade" id="viewDocumentModal" tabindex="-1" aria-labelledby="viewDocumentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header" style="background-color: #456fb6;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file-alt fs-4 text-white me-2"></i>
                        <h5 class="modal-title text-white mb-0" id="viewDocumentModalLabel">Document Details</h5>
                    </div>
                    <button  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <!-- Document Details Section -->
                        <div class="col-md-5">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="fw-bold text-primary mb-3">
                                        <i class="fas fa-info-circle me-2"></i>Document Information
                                    </h6>
                                    <div class="mb-3">
                                        <label class="text-muted small">Student Name:</label>
                                        <p class="fw-medium" id="view_student_name"></p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-muted small">Document Type:</label>
                                        <p class="fw-medium" id="view_document_type"></p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-muted small">Title:</label>
                                        <p class="fw-medium" id="view_title"></p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-muted small">Description:</label>
                                        <p class="fw-medium" id="view_description"></p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-muted small">Document Name:</label>
                                        <p class="fw-medium" id="view_document_name"></p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-muted small">Submitted Date:</label>
                                        <p class="fw-medium" id="view_submitted_at"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Document Preview Section -->
                        <div class="col-md-7">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="fw-bold text-primary mb-3 text-center">
                                        <i class="fas fa-eye me-2"></i>Document Preview
                                    </h6>
                                    <div class="document-preview-container" style="height: 500px;">
                                        <!-- PDF Preview -->
                                        <div id="pdf_preview" style="height: 100%; display: none;">
                                            <embed src="" type="application/pdf" width="100%" height="100%" id="pdf_viewer">
                                        </div>
                                        <!-- Image Preview -->
                                        <div id="image_preview" style="height: 100%; display: none;">
                                            <img src="" id="image_viewer" class="img-fluid h-100 w-100 object-fit-contain">
                                        </div>
                                        <!-- Doc/Docx Preview -->
                                        <div id="doc_preview" style="height: 100%; display: none;">
                                            <iframe src="" width="100%" height="100%" id="doc_viewer"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="download_document" onclick="downloadFile('${doc.document_url}', '${doc.document_name}')" class="btn btn-primary btn-sm">
                        <i class="fas fa-download me-2"></i>Download Document
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Make sure the JS file has properly closed conditionals -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>ajax/portfolio_ajax_function.js"></script>
