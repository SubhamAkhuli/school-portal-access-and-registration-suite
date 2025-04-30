let typeMap = {
    academic_records: "Academic Records",
    achievements: "Achievements",
    certificates: "Certificates",
    other_documents: "Other Documents"
};

jQuery(document).ready(function($){

    // Get portfolio data and display the data and set Options in modal
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            action: 'get_portfolio_data',
        },
        success: function(response){
            // console.log(response);
            let select = document.querySelector('.student-select');

            response.data.student_data.forEach(student => {
                let fullName = `${student.student_name}`.trim();
                let option = document.createElement('option');
                option.value = student.id + '-' + fullName;
                option.textContent = fullName;
                select.appendChild(option);
            });
            
            if (response.data.student_data.length === 0) {
                let option = document.createElement('option');
                option.textContent = 'No students available';
                option.disabled = true;
                select.appendChild(option);
            }
 
            // Display portfolio documents
            if (response.data.student_data.length > 0) {
                // Create portfolio header with upload button
                const portfolioContainer = document.querySelector('#portfolioAccordion');
                portfolioContainer.innerHTML = `
                    <h2 class="text-primary text-center m-0 mb-4">Student Portfolio</h2>
                    <div id="portfolio-content"></div>
                `;

                const badgesContainer = document.querySelector('#portfolio-heading');
                // Set first student in select dropdown
                const firstStudent = response.data.student_data[0];
                document.querySelector('.student-select').value = `${firstStudent.id}-${firstStudent.student_name}`;

                // Create badges for each student with new default style
                response.data.student_data.forEach((student, index) => {
                    const badge = document.createElement('button');
                    badge.className = 'btn rounded-pill px-4 py-2';
                    // Set first student's badge to active style
                    badge.style.backgroundColor = index === 0 ? '#456fb6' : '#6c757d';
                    badge.style.color = 'white';
                    badge.innerHTML = `${student.student_name}`;
                    badge.onclick = (e) => {
                        showStudentPortfolio(student.id, response.data.portfolio_data, e);
                    };
                    badgesContainer.appendChild(badge);

                    // Auto-click first student's badge
                    if (index === 0) {
                        badge.click();
                    }
                });

                // Function to display student portfolio
                function showStudentPortfolio(studentId, portfolioData, event) {
                    // Reset all badges to default style
                    document.querySelectorAll('#portfolio-heading .btn').forEach(btn => {
                        btn.style.backgroundColor = '#6c757d';
                        btn.style.color = 'white';
                    });
                    // Set active badge style
                    if (event) {
                        event.currentTarget.style.backgroundColor = '#456fb6';
                        event.currentTarget.style.color = 'white';
                    }

                    const studentDocs = portfolioData.filter(doc => doc.student_id === studentId);
                    const portfolioContent = document.querySelector('#portfolio-content');

                    if (studentDocs.length === 0) {
                        portfolioContent.innerHTML = '<div class="alert alert-warning text-center">No documents found for this student</div>';
                        return;
                    }

                    // Group documents by year
                    const documentsByYear = studentDocs.reduce((acc, doc) => {
                        const year = new Date(doc.submitted_at).getFullYear();
                        if (!acc[year]) acc[year] = [];
                        acc[year].push(doc);
                        return acc;
                    }, {});

                    // Create accordion for years
                    let accordionHtml = '<div class="accordion" id="yearAccordion">';
                    Object.keys(documentsByYear).sort((a, b) => b - a).forEach(year => {
                        accordionHtml += `
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#year${year}">
                                        ${year} Documents (${documentsByYear[year].length})
                                    </button>
                                </h2>
                                <div id="year${year}" class="accordion-collapse collapse" data-bs-parent="#yearAccordion">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            ${documentsByYear[year].map(doc => `
                                                <div class="col-md-4">
                                                    <div class="card h-100 shadow-sm rounded-4">
                                                        <div class="card-body p-1">
                                                            <div class="d-flex align-items-center mb-3">
                                                                <div class="me-3">
                                                                    <i class="fas fa-file-${getFileIcon(doc.document_name)} fs-2 text-danger"></i>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-2 fw-bold text-primary">${doc.document_name}</h6>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <p class="fw-bold text-primary mb-2">
                                                                    <i class="fa-solid fa-circle-dot me-2"></i>${doc.title}
                                                                </p>
                                                                <div class="mb-1 text-secondary">
                                                                    <small><i class="fas fa-folder-open me-1"></i>${typeMap[doc.document_type] || doc.document_type}</small>
                                                                </div>
                                                                <p class="text-muted small"><i class="fas fa-align-left me-2"></i>${doc.description}</p>
                                                                <div class="text-muted small">
                                                                    <i class="far fa-calendar-alt me-2"></i>${new Date(doc.submitted_at).toLocaleString('en-US', { 
                                                                        month: '2-digit',
                                                                        day: '2-digit',
                                                                        year: 'numeric',
                                                                        hour: 'numeric',
                                                                        minute: '2-digit',
                                                                        hour12: true
                                                                    }).replace(',', '')}
                                                                </div>
                                                            </div>
                                                            <div class="d-flex gap-2 justify-content-end">
                                                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewDocumentModal" 
                                                                        onclick='viewDocument(${JSON.stringify(doc).replace(/'/g, "\\'")})'>
                                                                    <i class="fas fa-eye me-1"></i>View
                                                                </button>
                                                                <button onclick="downloadFile('${doc.document_url}', '${doc.document_name}')" 
                                                                        class="btn btn-outline-success btn-sm">
                                                                    <i class="fas fa-download me-1"></i>Download
                                                                </button>
                                                                <button class="btn btn-outline-danger btn-sm delete_document" data-id="${doc.id}">
                                                                    <i class="fas fa-trash me-1"></i>Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `).join('')}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    accordionHtml += '</div>';
                    portfolioContent.innerHTML = accordionHtml;
                }

                // Helper function to get file icon
                function getFileIcon(filename) {
                    const ext = filename.split('.').pop().toLowerCase();
                    return ext === 'pdf' ? 'pdf' : 
                           ['doc', 'docx'].includes(ext) ? 'word' : 
                           ['jpg', 'jpeg', 'png'].includes(ext) ? 'image' : 'file';
                }
            } else {
                const portfolioContainer = document.querySelector('#portfolioAccordion');
                portfolioContainer.innerHTML = '<div class="alert alert-warning text-center">No students found</div>';
            }
        },
        error: function(status, error) {
            console.error("AJAX Error: ", status, error);
        }
    });

    // Save portfolio data
    $('#upload_btn').on('click', function(e){
        e.preventDefault();
        
        // Get form elements
        const form = $('#portfolio-upload-form')[0];
        const studentSelect = $('#student_select').val();
        const documentType = $('#document_type').val();
        const title = $('#document_title').val();
        const description = $('#document_description').val();
        const fileInput = $('#document_file')[0];

        // Validation checks
        if (studentSelect == '-1') {
            swal("Please select student", "", "error");
            return;
        }
        if (documentType == '-1') {
            swal("Please select document type", "", "error");
            return;
        }
        if (!title.trim()) {
            swal("Please enter title", "", "error");
            return;
        }
        if (!description.trim()) {
            swal("Please enter description", "", "error");
            return;
        }
        if (fileInput.files.length === 0) {
            swal("Please select file(s) to upload", "", "error");
            return;
        }

        // File type validation
        const allowedTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'image/jpeg',
            'image/png'
        ];
        if (!allowedTypes.includes(fileInput.files[0].type)) {
            swal("Invalid file type", "Please upload only pdf, doc, docx, jpg, png files", "error");
            return;
        }

        // Prepare form data
        let formData = new FormData();
        formData.append('action', 'save_portfolio_data');
        formData.append('portfolio_nonce', $('[name="portfolio_nonce"]').val());
        formData.append('student_id', studentSelect.split('-')[0]);
        formData.append('student_name', studentSelect.split('-')[1]);
        formData.append('document_type', documentType);
        formData.append('title', title);
        formData.append('description', description);
        formData.append('file_name', fileInput.files[0].name);
        formData.append('file', fileInput.files[0]);
        
        // AJAX call
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                if(response.success){
                    form.reset();
                    swal("Document uploaded successfully", "", "success");
                    location.reload();
                } else {
                    swal("Error uploading documents", response.data, "error");
                }
            },
            error: function(status, error){
                console.error("AJAX Error: ", status, error);
                swal("Error uploading documents", "Please try again.", "error");
            }
        });
    });
});

// Download file
function downloadFile(url, fileName) {
    const secureUrl = url.replace('http://', 'https://');
    fetch(secureUrl)
        .then(response => response.blob())
        .then(blob => {
            const blobUrl = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = blobUrl;
            a.download = fileName;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(blobUrl);
            a.remove();
        })
        .catch(error => console.error('Error downloading file:', error));
}

// View document
function viewDocument(doc) {
    document.getElementById("view_student_name").textContent = doc.student_name;
    document.getElementById("view_document_type").textContent = typeMap[doc.document_type] || doc.document_type;
    document.getElementById("view_title").textContent = doc.title;
    document.getElementById("view_description").textContent = doc.description;
    document.getElementById("view_document_name").textContent = doc.document_name;
    document.getElementById("view_submitted_at").textContent = new Date(doc.submitted_at).toLocaleString('en-US', {
        month: '2-digit',
        day: '2-digit', 
        year: 'numeric',
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
    }).replace(',', '');

    const downloadLink = document.getElementById("download_document");
    downloadLink.setAttribute("onclick", `downloadFile('${doc.document_url}', '${doc.document_name}')`);

    const pdfPreview = document.getElementById("pdf_preview");
    const imagePreview = document.getElementById("image_preview");
    const docPreview = document.getElementById("doc_preview");

    pdfPreview.style.display = "none";
    imagePreview.style.display = "none";
    docPreview.style.display = "none";

    const extension = doc.document_name.split(".").pop().toLowerCase();
    // Get WordPress site URL from ajax_object if available, or fallback to window.location.origin
    const siteUrl = (typeof ajax_object !== 'undefined' && ajax_object.site_url) 
        ? ajax_object.site_url 
        : window.location.origin;

    // Ensure URL is absolute and uses HTTPS
    const secureUrl = doc.document_url.startsWith('http') 
        ? doc.document_url.replace('http://', 'https://') 
        : siteUrl + doc.document_url;
        if (["jpg", "jpeg", "png"].includes(extension)) {
            // For images, show image preview
            imagePreview.style.display = "block";
            const imgViewer = document.getElementById("image_viewer");
            imgViewer.src = secureUrl;
            imgViewer.onerror = () => {
                imagePreview.innerHTML = '<div class="alert alert-warning">Unable to load image. Please download to view.</div>';
            };
        } else if (extension === "pdf") {
            // For PDFs, show PDF preview
            pdfPreview.style.display = "block";
            pdfPreview.innerHTML = `<iframe src="${secureUrl}" width="100%" height="500px" frameborder="0"></iframe>`;
        } else if (["doc", "docx"].includes(extension)) {
         // For Word documents, show an icon and download message
         docPreview.style.display = "block";
         docPreview.innerHTML = `
             <div class="text-center p-5">
                 <i class="fas fa-file-word fa-5x text-primary mb-3"></i>
                 <h4>Word Document</h4>
                 <p>Word documents cannot be previewed directly. Please use the download button to view this file.</p>
                 <button onclick="downloadFile('${secureUrl}', '${doc.document_name}')" class="btn btn-primary">
                     <i class="fas fa-download me-2"></i>Download to View
                 </button>
             </div>`;
        }
}

// delete document
jQuery(document).on('click', '.delete_document', function(e){
    e.preventDefault();
    let document_id = jQuery(this).data('id');
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this document!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            jQuery.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    action: 'delete_document',
                    document_id: document_id,
                },
                success: function(response){
                    if(response.success){
                        swal("Document deleted successfully", "", "success");
                        location.reload();
                    } else {
                        swal("Error deleting document", response.data, "error");
                    }
                },
                error: function(status, error){
                    console.error("AJAX Error: ", status, error);
                    swal("Error deleting document", "Please try again.", "error");
                }
            });
        }
    });
});