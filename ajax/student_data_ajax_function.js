let student_official_data = '';
// show Student Data
jQuery(document).ready(function(){

     // form url get parameter
     const urlParams = new URLSearchParams(window.location.search);
     const studentId = urlParams.get('sid');
 
        jQuery.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'action':'get_student_data_by_registration_id'
            },
            success: function(data){
                // console.log(data);
                let studentData = data.data;
                let user_role = data.data.user_role;
                if (studentId) {
                    // Only process data for the specific student
                    student_data = studentData.student_data.filter(student => student.id == studentId);
                } else {
                    // Process all students
                    student_data = studentData.student_data;
                    
                }

                if(student_data.length !== 0){
                    student_data.forEach(student => {
                        const student_id = student.id;
                        const fullName = `${student.first_name} ${student.middle_name} ${student.last_name}`;
                        const phoneNumber = student.student_transfer && JSON.parse(student.student_transfer).school_number
                            ? JSON.parse(student.student_transfer).school_number
                            : '';
                        const formattedPhoneNumber =
                            student.student_transfer &&
                            JSON.parse(student.student_transfer).school_number_country_code
                                ? (JSON.parse(student.student_transfer).school_number_country_code === '+1c' ? '+1' : JSON.parse(student.student_transfer).school_number_country_code) +
                                    ' ' + showNumberFormat(phoneNumber, JSON.parse(student.student_transfer).school_number_country_code === '+1c' ? '+1' : JSON.parse(student.student_transfer).school_number_country_code)
                                : '';
                                studentcard = `
                                    <div class="card mt-3"
                                        id="student-card_${student_id}">
                                        <div class="d-flex gap-3 justify-content-between gap-3 flex-wrap">
                                            <div class="d-flex gap-3 flex-wrap">
                                                <div class="text-center">
                                                    <div class="user student-image" id="student-photo_${student_id}">
                                                        ${
                                                            student.student_profile_pic
                                                                ? `<img src="${student.student_profile_pic}" alt="${fullName}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">`
                                                                : '<i class="fa-solid fa-user-circle fa-3x"></i>'
                                                        }
                                                    </div>
                                                </div>
                                                <div class="user-inf-sec" id="student-info_${student_id}" style="flex-grow: 1;">
                                                    <h3  class="text-primary" id="fullName_${student_id}"><i class="fa-solid fa-graduation-cap me-2"></i>${fullName}</h3>
                                                    <h6 class="text-muted" id="gradeLevel_${student_id}"><i class="fa-solid fa-book me-2"></i>Grade Level: ${student.grade}</h6>
                                                    ${
                                                        student.student_transfer !== "[]"
                                                            ? `<button class="btn btn-primary rounded-pill px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#transferModal" id="viewTransferDetailsBtn_${student_id}"
                                                            data-school-type="${JSON.parse(student.student_transfer).school_type.charAt(0).toUpperCase() + JSON.parse(student.student_transfer).school_type.slice(1)}"
                                                            data-school-name="${JSON.parse(student.student_transfer).school_name}"
                                                            data-school-address="${JSON.parse(student.student_transfer).school_address}"
                                                            data-school-city="${JSON.parse(student.student_transfer).school_city}"
                                                            data-school-state="${JSON.parse(student.student_transfer).school_state}"
                                                            data-full-school-state="${getFullStateName(JSON.parse(student.student_transfer).school_state)}"
                                                            data-school-county="${JSON.parse(student.student_transfer).school_county}"
                                                            data-school-zip-code="${JSON.parse(student.student_transfer).school_zip_code}"
                                                            data-school-phone="${formattedPhoneNumber}"
                                                            data-school-email="${JSON.parse(student.student_transfer).school_email}"
                                                            data-last-date-of-study="${new Date(JSON.parse(student.student_transfer).school_last_date).toLocaleDateString('en-US', {month:'2-digit', day:'2-digit', year:'numeric'})}"
                                                            >
                                                                <i class="fa-solid fa-exchange-alt me-2"></i>View Transfer Details
                                                            </button>`
                                                            : ""
                                                    }
                                                    ${
                                                        student.immunization_file_url
                                                            ? `<button class="btn btn-primary rounded-pill px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#viewImmunizationModal" id="viewImmunizationBtn_${student_id}"
                                                            data-student-id="${student_id}"
                                                            data-immunization-file-url="${student.immunization_file_url}"
                                                            data-immunization-file-name="${student.immunization_file_name}"
                                                            onclick="viewImmunizationFile(this)"
                                                            >
                                                                <i class="fa-solid fa-syringe me-2"></i>View Immunization
                                                            </button>`
                                                            : ""
                                                    }
                                                </div>
                                            </div> 
                                            <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex align-items-center gap-2">
                                            `
                                                // <a href="/student-renewal/?sid=${student_id}" class="btn blue-btn btn-sm" title="For the Next School Year"><i class="fa-solid fa-sync me-1"></i>Renew</a>
                                              +`  
                                                <a href="/student-renewal/" class="btn blue-btn btn-sm" title="For the Next School Year"><i class="fa-solid fa-sync me-1"></i>Renew</a>
                                                ${
                                                    student.grade === '10TH GRADE' || student.grade === '11TH GRADE' || student.grade === '12TH GRADE'
                                                    ? (() => {
                                                        // Find if student has graduation application
                                                        const graduationData = studentData.graduate_data ? 
                                                            studentData.graduate_data.find(g => g.student_id === student_id) : null;
                                                        
                                                        if (!graduationData || graduationData.status === 'pending') {
                                                            // No graduation data or pending - show Apply button
                                                            return `<a href="/apply-to-graduate/?sid=${student_id}" class="btn blue-btn btn-sm" title="Apply to Graduate"><i class="fa-solid fa-graduation-cap me-1"></i> Apply Graduate</a>`;
                                                        } else if (graduationData.status === 'applied') {
                                                            // Application is being processed - show muted button
                                                            return `<button class="btn grey-btn btn-sm" data-bs-toggle="modal" data-bs-target="#graduationStatusModal" data-status="applied" data-graduation-data='${JSON.stringify(graduationData).replace(/'/g, "&#39;")}'>
                                                                <i class="fa-solid fa-hourglass-half me-1"></i> See Application</button>`;
                                                        } else if (graduationData.status === 'approved') {
                                                            // Graduate is approved - show gold button
                                                            // Get graduation year (current year + 1 as fallback)
                                                            const gradYear = new Date().getFullYear() + 1;
                                                            return `<button class="btn gold-btn btn-sm"
                                                                data-bs-toggle="modal" data-bs-target="#graduationStatusModal" data-status="approved" data-graduation-data='${JSON.stringify(graduationData).replace(/'/g, "&#39;")}'>
                                                                <i class="fa-solid fa-award me-1"></i>Class of ${gradYear}</button>`;
                                                        } else if (graduationData.status === 'rejected') {
                                                            // Application rejected - show red button
                                                            return `<button class="btn red-btn btn-sm" data-bs-toggle="modal" data-bs-target="#graduationStatusModal" 
                                                                data-status="rejected" data-graduation-data='${JSON.stringify(graduationData).replace(/'/g, "&#39;")}'>
                                                                <i class="fa-solid fa-times-circle me-1"></i>Rejected</button>`;
                                                        } else {
                                                            // Default to Apply button for any other status
                                                            return `<a href="/apply-to-graduate/?sid=${student_id}" class="btn blue-btn btn-sm" title="Apply to Graduate"><i class="fa-solid fa-graduation-cap me-1"></i>Apply Graduate</a>`;
                                                        }
                                                    })()
                                                    : ''
                                                }
                                                
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle dp-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="/class/?sid=${student_id}" data-student-id="${student_id}"><i class="fa-solid fa-chalkboard me-2"></i>Classes</a></li>
                                                        <li><a class="dropdown-item" href="/transcripts/?sid=${student_id}" data-student-id="${student_id}"><i class="fa-solid fa-file-alt me-2"></i>Transcripts</a></li>
                                                        <li><a class="dropdown-item" href="/attendance/?sid=${student_id}" data-student-id="${student_id}"><i class="fa-solid fa-calendar-check me-2"></i>Attendance</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                

                        // Append the card to a container (example: #student-container)
                        $('#student-container').append(studentcard);
                        
                        // Add click event listener to the transfer button
                        $(`#viewTransferDetailsBtn_${student_id}`).on('click', function(e) {
                            SetStudentTransferData(e);
                        });
                    });
                    
                    // Set up event listener for graduation status modal
                    $('#graduationStatusModal').on('show.bs.modal', function(e) {
                        const button = $(e.relatedTarget);
                        const status = button.data('status');
                        const graduationData = button.data('graduation-data');
                        
                        setGraduationModalData(status, graduationData);
                    });
                    
                } else {
                    $('.container').html('<div class="alert alert-danger text-center">No student data found</div>');
                }
            }
        });

        // Set Data in Student Transfer modal
        function SetStudentTransferData(e) {
            const button = e.currentTarget;
            // Set modal data
            $('#schoolType').val(`${$(button).data('school-type')}`);
            $('#schoolName').val(`${$(button).data('school-name')}`);
            $('#schoolAddress').val(`${$(button).data('school-address')}`);
            $('#schoolCity').val(`${$(button).data('school-city')}`);
            $('#schoolState').val(`${$(button).data('full-school-state')}`);
            $('#schoolCounty').val(`${$(button).data('school-county')}`);
            $('#schoolZipCode').val(`${$(button).data('school-zip-code')}`);
            $('#schoolPhone').val(`${$(button).data('school-phone')}`);
            $('#schoolEmail').val(`${$(button).data('school-email')}`);
            $('#lastDateOfStudy').val(`${$(button).data('last-date-of-study')}`);
            
            // Show the modal
            $('#transferModal').modal('show');
        }

        // Get Full state name
        function getFullStateName(stateCode) {
            const states = {
                'AL': 'Alabama', 'AK': 'Alaska', 'AZ': 'Arizona', 'AR': 'Arkansas',
                'CA': 'California', 'CO': 'Colorado', 'CT': 'Connecticut', 'DE': 'Delaware',
                'FL': 'Florida', 'GA': 'Georgia', 'HI': 'Hawaii', 'ID': 'Idaho',
                'IL': 'Illinois', 'IN': 'Indiana', 'IA': 'Iowa', 'KS': 'Kansas',
                'KY': 'Kentucky', 'LA': 'Louisiana', 'ME': 'Maine', 'MD': 'Maryland',
                'MA': 'Massachusetts', 'MI': 'Michigan', 'MN': 'Minnesota', 'MS': 'Mississippi',
                'MO': 'Missouri', 'MT': 'Montana', 'NE': 'Nebraska', 'NV': 'Nevada',
                'NH': 'New Hampshire', 'NJ': 'New Jersey', 'NM': 'New Mexico', 'NY': 'New York',
                'NC': 'North Carolina', 'ND': 'North Dakota', 'OH': 'Ohio', 'OK': 'Oklahoma',
                'OR': 'Oregon', 'PA': 'Pennsylvania', 'RI': 'Rhode Island', 'SC': 'South Carolina',
                'SD': 'South Dakota', 'TN': 'Tennessee', 'TX': 'Texas', 'UT': 'Utah',
                'VT': 'Vermont', 'VA': 'Virginia', 'WA': 'Washington', 'WV': 'West Virginia',
                'WI': 'Wisconsin', 'WY': 'Wyoming', 'DC': 'District of Columbia'
            };
            return states[stateCode.toUpperCase()] || stateCode;
        }

        // show Number In Format
        function showNumberFormat(phoneNumber, countryCode) {
            if (countryCode ==='+1' || countryCode === '+1c') {
                // US phone number (555) 123-4567
                return phoneNumber.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            } else {

                // return phoneNumber.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
                return phoneNumber;
            }
        }

        // Set Data in Graduation modal
        function setGraduationModalData(status, graduateData) {
            // Handle when function is called from event handler
            if (typeof status === 'object' && status.currentTarget) {
                const button = $(status.currentTarget);
                status = button.data('status');
                graduateData = button.data('graduation-data');
            }

            // console.log('Graduation Status:', status);
            // console.log('Graduation Data:', graduateData);
            
            // Ensure graduateData is an object
            if (!graduateData || typeof graduateData !== 'object') {
                // console.error('Invalid graduation data:', graduateData);
                return;
            }
            
            // Helper function for safe date parsing and formatting
            const formatDate = (dateStr, format = {month: 'long', day: 'numeric', year: 'numeric'}) => {
                if (!dateStr) return '';
                try {
                    return new Date(dateStr).toLocaleDateString('en-US', format);
                } catch (e) {
                    // console.error('Date parsing error:', e);
                    return '';
                }
            };
            
            // Helper function to get value from multiple possible field names
            const getDataValue = (fieldNames) => {
                for (const name of fieldNames) {
                    if (graduateData[name] !== undefined) return graduateData[name];
                }
                return null;
            };
            
            // Clear any existing timeline content
            $('#graduationTimeline').empty();
            
            // Set status badge with appropriate styling
            const $statusBadge = $('#graduationStatus');
            $statusBadge.removeClass('bg-success bg-warning bg-danger bg-secondary');
            
            switch (status) {
                case 'approved':
                    $statusBadge.addClass('bg-success').text('Approved');
                    break;
                case 'applied':
                    $statusBadge.addClass('bg-warning').text('Processing');
                    break;
                case 'rejected':
                    $statusBadge.addClass('bg-danger').text('Rejected');
                    break;
                default:
                    $statusBadge.addClass('bg-secondary').text('Unknown');
            }
            
            // Set last updated date
            const lastUpdateDate = getDataValue(['updated_at', 'created_at']) || new Date();
            $('#lastUpdateDate').text(formatDate(lastUpdateDate));
            
            // Create timeline steps with appropriate status
            const createdDate = getDataValue(['created_at']) || new Date();
            const updatedDate = getDataValue(['updated_at']) || new Date();
            
            // Define base timeline steps
            const timelineSteps = [
                {
                    date: createdDate,
                    title: 'Application Submitted',
                    status: 'completed',
                    icon: 'fa-paper-plane'
                },
                {
                    date: status === 'applied' ? null : updatedDate,
                    title: 'Application Processing',
                    status: status === 'applied' ? 'active' : 'completed',
                    icon: 'fa-hourglass-half'
                }
            ];
            
            // Add appropriate final step based on status
            if (status === 'rejected') {
                timelineSteps.push({
                    date: updatedDate,
                    title: 'Application Rejected',
                    status: 'rejected',
                    icon: 'fa-times-circle'
                });
            } else {
                timelineSteps.push({
                    date: status === 'approved' ? updatedDate : null,
                    title: 'Application Approved',
                    status: status === 'approved' ? 'completed' : 'pending',
                    icon: 'fa-check-circle'
                });
            }
            
            // Add timeline styling if not already present
            if ($('#timelineStyles').length === 0) {
                $('head').append(`
                    <style id="timelineStyles">
                        .modern-timeline {
                            position: relative;
                            padding: 20px 0;
                        }
                        .modern-timeline:before {
                            content: '';
                            position: absolute;
                            left: 18px;
                            top: 0;
                            bottom: 0;
                            width: 2px;
                            background: #e9ecef;
                            z-index: 1;
                        }
                        .timeline-item {
                            position: relative;
                            margin-bottom: 25px;
                            padding-left: 45px;
                            transition: all 0.3s ease;
                        }
                        .timeline-item:hover {
                            transform: translateX(3px);
                        }
                        .timeline-item:last-child {
                            margin-bottom: 0;
                        }
                        .timeline-icon {
                            position: absolute;
                            left: 0;
                            top: 2px;
                            width: 36px;
                            height: 36px;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            z-index: 2;
                            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
                        }
                        .timeline-icon i {
                            font-size: 1rem;
                        }
                        .timeline-content {
                            background: #fff;
                            border-radius: 8px;
                            padding: 15px;
                            border: 1px solid #e9ecef;
                            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
                            transition: all 0.3s ease;
                        }
                        .timeline-content:hover {
                            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
                        }
                        .timeline-title {
                            font-weight: 600;
                            margin-bottom: 5px;
                            font-size: 1rem;
                        }
                        .timeline-date {
                            font-size: 0.85rem;
                            opacity: 0.85;
                            display: flex;
                            align-items: center;
                            gap: 4px;
                        }
                        .status-completed {
                            background-color: #28a745;
                            color: white;
                        }
                        .status-active {
                            background-color: #007bff;
                            color: white;
                        }
                        .status-pending {
                            background-color: #6c757d;
                            color: white;
                        }
                        .status-rejected {
                            background-color: #dc3545;
                            color: white;
                        }
                    </style>
                `);
            }
            
            // Clear any existing timeline content
            $('#graduationTimeline').empty().addClass('modern-timeline');
            
            // Add timeline items to the DOM
            timelineSteps.forEach(step => {
                let statusClass, dateDisplay, dateIcon;
                
                if (step.status === 'completed') {
                    statusClass = 'status-completed';
                    dateDisplay = formatDate(step.date, {month: 'short', day: 'numeric', year: 'numeric'});
                    dateIcon = 'fa-calendar-check';
                } else if (step.status === 'active') {
                    statusClass = 'status-active';
                    dateDisplay = 'In Progress';
                    dateIcon = 'fa-spinner fa-pulse';
                } else if (step.status === 'rejected') {
                    statusClass = 'status-rejected';
                    dateDisplay = formatDate(step.date, {month: 'short', day: 'numeric', year: 'numeric'});
                    dateIcon = 'fa-calendar-times';
                } else {
                    statusClass = 'status-pending';
                    dateDisplay = 'Pending';
                    dateIcon = 'fa-calendar';
                }
                
                const timelineItem = `
                    <div class="timeline-item">
                        <div class="timeline-icon ${statusClass}">
                            <i class="fas ${step.icon}"></i>
                        </div>
                        <div class="timeline-content">
                            <h5 class="timeline-title">${step.title}</h5>
                            <div class="timeline-date">
                                <i class="fas ${dateIcon}"></i>
                                ${dateDisplay}
                            </div>
                        </div>
                    </div>
                `;
                
                $('#graduationTimeline').append(timelineItem);
            });
            
            // Handle section visibility based on status
            // a. Rejection section
            const $rejectionSection = $('#rejectionSection');
            const $rejectionContact = $('#rejectionContact');
            
            if (status === 'rejected') {
                $rejectionSection.removeClass('d-none');
                $rejectionContact.removeClass('d-none');
                
                // Get rejection reason from various possible paths
                let rejectReason = '';
                if (graduateData.reject_reason) {
                    rejectReason = graduateData.reject_reason;
                } else if (graduateData.comment) {
                    rejectReason = graduateData.comment;
                } else if (typeof graduateData.graduate_data === 'string') {
                    try {
                        const parsedData = JSON.parse(graduateData.graduate_data);
                        if (parsedData.reject_reason) {
                            rejectReason = parsedData.reject_reason;
                        }
                    } catch (e) {
                        // console.error('Error parsing graduate data:', e);
                    }
                }
                
                $('#rejectionCause').text(rejectReason || 'No specific reason provided');
            } else {
                $rejectionSection.addClass('d-none');
                $rejectionContact.toggleClass('d-none', status !== 'approved' && status !== 'applied');
            }

            // b. Application section
            const $applicationSection = $('#applicationSection');
            
            if (status === 'applied') {
                $applicationSection.removeClass('d-none');
                    $rejectionContact.addClass('d-none');
                
                // Parse graduate_data if it's a string
                let graduateInfo = graduateData;
                if (typeof graduateData.graduate_data === 'string') {
                    try {
                        graduateInfo = JSON.parse(graduateData.graduate_data);
                    } catch(e) {
                        // console.error('Error parsing graduate data:', e);
                        graduateInfo = graduateData;
                    }
                }
                
                // Access the questions from the nested structure
                const questions = graduateInfo.questions || (graduateInfo.graduate_data ? graduateInfo.graduate_data.questions : {});
                
                // Set form values
                $('#studentAgeSelect').val(questions.q1?.ans === 'yes' ? 'yes' : 'no');
                $('#courseWorkSelect').val(questions.q2?.ans === 'yes' ? 'yes' : 'no');
                $('#enrollmentSelect').val(questions.q5?.ans === 'yes' ? 'yes' : 'no');
                
                // Set checkboxes
                $('#specialNeeds').prop('checked', questions.q3?.ans === true || questions.q3?.ans === 'yes');
                $('#allowChanges').prop('checked', questions.q4?.ans === true || questions.q4?.ans === 'yes');
                
                // Show/hide grades warning
                $('#gradesWarning').toggle(questions.q2?.ans === 'no');
            } 
            else {
                $applicationSection.addClass('d-none');
            }

            // c. Graduate certification section
            const $certSection = $('#graduateCertificationSection');
            
            if (status === 'approved') {
                $certSection.removeClass('d-none');
                 $rejectionContact.addClass('d-none');
                // Show loading state
                $('#graduateCertificationDetails').html(
                    '<div class="text-center py-4">' +
                    '<div class="spinner-border text-primary mb-3" role="status"></div>' +
                    '<p class="text-muted">Generating official transcript...</p>' +
                    '</div>'
                );

                // Get student ID from graduation data
                const studentId = graduateData.student_id || graduateData.id;
                
                // Create a container for the PDF viewer that will be shown after generation
                const pdfContainer = $('<div>', {
                    id: 'transcript-pdf-container',
                    class: 'mt-3'
                });
                
                // Add container to the certificate details area
                $('#graduateCertificationDetails').append(pdfContainer);
                
                // Use the existing function to generate transcript
                GetOfficialTranscript(studentId);
                
            } else {
                $certSection.addClass('d-none');
            }
        }

});

// Set Data in Immunization modal
function viewImmunizationFile(e) {
    // console.log('Immunization File URL:', e);
    const fileUrl = $(e).data('immunization-file-url');
    const fileName = $(e).data('immunization-file-name');
    const extension = fileName.split('.').pop().toLowerCase();

    const pdfPreview = document.getElementById('immunization_pdf_preview');
    const imagePreview = document.getElementById('immunization_image_preview');
    const docPreview = document.getElementById('immunization_doc_preview');

    pdfPreview.style.display = 'none';
    imagePreview.style.display = 'none';
    docPreview.style.display = 'none';

    const siteUrl = (typeof ajax_object !== 'undefined' && ajax_object.site_url) 
        ? ajax_object.site_url 
        : window.location.origin;

    const secureUrl = fileUrl.startsWith('http') 
        ? fileUrl.replace('http://', 'https://') 
        : siteUrl + fileUrl;

    if (['jpg', 'jpeg', 'png'].includes(extension)) {
        imagePreview.style.display = 'block';
        document.getElementById('immunization_image_viewer').src = secureUrl;
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
            </div>`;
        }
    document.getElementById('download_immunization').onclick = () => {
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
            // .catch(error => console.error('Error downloading file:', error));
    };
}

let student_data = [];

function GetOfficialTranscript(student_id = '') {
    if(student_id == '') {
        swal('Error', `Failed to generate PDF: No Student found`, 'error');
    }

    const studentId = student_id;
    // console.log('Transcript Page Loaded');
    let yearlyAttendance = {};

    // load data for transcript page
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'student_id': studentId,
            'action': 'get_student_official_transcript_data',
        },
        success: function(response) {
            // console.log(response);

            // console.log('Response:', response); // Debug log
            if (response && response.data) {
                const students = Array.isArray(response.data) ? response.data : [response.data];
                // console.log('students', students);
                // console.log('studentId', studentId)
                if (studentId) {
                    // Only process data for the specific student
                    // student_official_data = students.find(s => s.student_id.toString() === studentId);
                    // if (student_official_data) {
                    //     student_official_data = [student_official_data]; // Convert to array
                    // }
                    // console.log('student', typeof(student_data));
                    student_official_data = students;
                    // console.log('student_data', student_official_data);
                }else {
                    student_official_data = students;
                    // console.log('student', typeof(student_data));
                    // console.log('student_data', student_data);
                }

                // console.log('Student Data:', student_data); // Debug log
                if (student_official_data) {
                    // Check if there are any students
                    if (student_official_data.length === 0) {
                        swal('Info', 'No student data available.', 'info');
                        return;
                    }
                    // Create student badges initially
                    
                    GetOfficialpdfNew();
                    
                } else {
                    // No student data found
                    $(".transcript-container").html('<div class="alert alert-danger text-center">No student records found!</div>');
                }
            } else {
                // No student data found
                $(".transcript-container").html('<div class="alert alert-danger text-center">No student records found!</div>');
            }
        },
        error: function() {
            swal('Error', 'An unexpected error occurred.', 'error');
        }
    });
        

}

function GetOfficialpdfNew(user_role = '') {
    // Get the currently displayed student
    const student = student_official_data[0];
    
    // Basic student info
    const studentId = student.student_id;
    const studentName = student.student_name;
    const firstName = student.first_name;
    const middleName = student.middle_name;
    const lastName = student.last_name;
    const dob = new Date(student.dob).toLocaleDateString('en-US', {month: '2-digit', day: '2-digit', year: 'numeric'});
    const gender = student.gender;
    const parent_email = student.parent_email;
    const address = student.address;
    const parent_phone = student.parent_phone;
    const country_code = student.country_code;
    // Gather course data directly from the JSON
    const Student_courses = [];
    
    // Check if course data exists
    if (student.course_data && student.course_data.length > 0) {
        // Get courses from the JSON data
        student.course_data.forEach(course => {
            // Check for weighted grades
            let weightAdjustment = 0;
            const courseInfo = (course.additional || '').toLowerCase();

            // Only apply weighting to letter grades
            if (/^[A-F][+-]?$/.test(course.grade)) {
                if (courseInfo.includes('honor') || courseInfo.includes('honours')) {
                    // Honors course - add 0.5 points
                    weightAdjustment = 0.5;
                } else if (
                    courseInfo.includes('ap ') || 
                    courseInfo.includes('advanced placement') || 
                    courseInfo.includes('ib ') || 
                    courseInfo.includes('international baccalaureate') || 
                    courseInfo.includes('de ') || 
                    courseInfo.includes('dual enrollment')
                ) {
                    // AP, IB, or DE course - add 1.0 point
                    weightAdjustment = 1.0;
                }
            }

            // CLEP or non-letter grade assignments such as "Pass" do not have a GPA impact
            if (course.additional === 'CLEP' || course.grade === 'Pass') {
                weightAdjustment = 0;
            }

            Student_courses.push({
                year: course.year,
                course_name: course.courseName,
                publisher: course.publisher,
                semester: course.semester,
                grade: course.grade,
                weight_adjustment: weightAdjustment,
                credit: course.credit,
                additional: course.additional,
                student_grade: course.studentGrade
            });
        });
    }
    
    // Show loading indicator in the graduateCertificationDetails div
    $('#graduateCertificationDetails').html(`
        <div class="text-center p-4">
            <div class="spinner-border text-primary mb-3" role="status"></div>
            <p>Generating official transcript...</p>
        </div>
    `);

    jQuery.ajax({
        url: ajax_object.ajax_url,
        type: 'POST',
        data: {
            action: 'generate_transcript_pdf',
            student_id: studentId,
            student_name: studentName,
            first_name: firstName,
            middle_name: middleName,
            last_name: lastName,
            gender: gender,
            dob: dob,
            parent_email: parent_email,
            parent_phone: parent_phone,
            country_code: country_code,
            courses: JSON.stringify(Student_courses),
            address: JSON.stringify(address),
        },
        success: function(response) {
            if (response.success) {
                if (response.data.pdf_url) {
                    // Display the PDF using an iframe inside the div
                    $('#graduateCertificationDetails').html(`
                        <div class="text-center mb-3">
                            <h5 class="mb-3">Official Transcript</h5>
                            <div class="btn-group mb-3">
                                <a href="${response.data.pdf_url}" download="${studentName.replace(/\s+/g, '_')}_transcript.pdf" class="btn btn-primary">
                                    <i class="fa-solid fa-download me-2"></i>Download
                                </a>
                                <a href="${response.data.pdf_url}" target="_blank" class="btn btn-outline-primary">
                                    <i class="fa-solid fa-external-link-alt me-2"></i>Open in New Tab
                                </a>
                            </div>
                        </div>
                        <div class="pdf-container" style="height: 500px; border: 1px solid #dee2e6; border-radius: 4px; overflow: hidden;">
                            <iframe src="${response.data.pdf_url}" width="100%" height="100%" frameborder="0"></iframe>
                        </div>
                    `);
                } else if (response.data.html) {
                    // We'll generate the PDF from HTML but display it in the div
                    const iframe = document.createElement('iframe');
                    iframe.style.visibility = 'hidden';
                    iframe.style.position = 'fixed';
                    iframe.style.right = '0';
                    iframe.style.bottom = '0';
                    iframe.style.width = '0';
                    iframe.style.height = '0';
                    document.body.appendChild(iframe);
                    
                    // Create document content
                    const iframeDoc = iframe.contentWindow.document;
                    iframeDoc.open();
                    
                    // Create HTML structure
                    const html = iframeDoc.createElement('html');
                    const head = iframeDoc.createElement('head');
                    const body = iframeDoc.createElement('body');
                    
                    // Create title
                    const title = iframeDoc.createElement('title');
                    title.textContent = `${studentName} Transcript`;
                    head.appendChild(title);
                    
                    // Create content wrapper and add HTML content
                    const contentWrapper = iframeDoc.createElement('div');
                    contentWrapper.className = 'content-wrapper';
                    contentWrapper.innerHTML = response.data.html;
                    body.appendChild(contentWrapper);
                    
                    // Add elements to document
                    html.appendChild(head);
                    html.appendChild(body);
                    iframeDoc.appendChild(html);
                    iframeDoc.close();
                    
                    // Wait for content to load and render properly
                    setTimeout(() => {
                        const element = iframeDoc.body;
                        const filename = `${studentName.replace(/\s+/g, '_')}_transcript.pdf`;
                        
                        const opt = { 
                            filename: filename,
                            image: { type: 'jpeg', quality: 0.98 },
                            html2canvas: { 
                                scale: 2, 
                                useCORS: true,
                                letterRendering: true,
                                scrollY: 0,
                                windowWidth: 850,
                                x: 0,
                                y: 0
                            },
                            jsPDF: { 
                                unit: 'mm', 
                                format: 'a4', 
                                orientation: 'portrait',
                                compress: true,
                                hotfixes: ["px_scaling"]
                            },
                            pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
                        };
                        
                        // Generate PDF but instead of saving, get the blob to display
                        html2pdf().from(element).set(opt).outputPdf('blob')
                            .then((pdfBlob) => {
                                // Remove the hidden iframe
                                document.body.removeChild(iframe);
                                
                                // Create a URL for the blob
                                const blobUrl = URL.createObjectURL(pdfBlob);
                                
                                // Display the PDF in the div
                                $('#graduateCertificationDetails').html(`
                                    <div class="text-center mb-3">
                                        <h5 class="mb-3">Official Transcript</h5>
                                        <div class="mb-3">
                                            <a href="${blobUrl}" download="${filename}" class="btn btn-primary">
                                                <i class="fa-solid fa-download me-2"></i>Download
                                            </a>
                                            <a href="${blobUrl}" target="_blank" class="btn btn-primary">
                                                <i class="fa-solid fa-external-link-alt me-2"></i>Open in New Tab
                                            </a>
                                        </div>
                                    </div>
                                    <div class="pdf-container" style="height: 500px; border: 1px solid #dee2e6; border-radius: 4px; overflow: hidden;">
                                        <object data="${blobUrl}" type="application/pdf" width="100%" height="100%">
                                            <p>Your browser does not support PDFs. <a href="${blobUrl}" download="${filename}">Download the PDF</a> instead.</p>
                                        </object>
                                    </div>
                                `);
                            })
                            .catch(error => {
                                // console.error('PDF Generation Error:', error);
                                $('#graduateCertificationDetails').html(`
                                    <div class="alert alert-danger">
                                        <i class="fa-solid fa-exclamation-triangle me-2"></i>
                                        Error generating PDF. Please try again.
                                    </div>
                                `);
                            });
                    }, 1500);
                } else {
                    $('#graduateCertificationDetails').html(`
                        <div class="alert alert-danger">
                            <i class="fa-solid fa-exclamation-triangle me-2"></i>
                            Failed to generate PDF. Invalid response format.
                        </div>
                    `);
                }
            } else {
                $('#graduateCertificationDetails').html(`
                    <div class="alert alert-danger">
                        <i class="fa-solid fa-exclamation-triangle me-2"></i>
                        Failed to generate PDF: ${response.data || 'Unknown error'}
                    </div>
                `);
                // console.error('Server Response Error:', response);
            }
        },
        error: function(xhr, status, error) {
            $('#graduateCertificationDetails').html(`
                <div class="alert alert-danger">
                    <i class="fa-solid fa-exclamation-triangle me-2"></i>
                    Failed to generate PDF. Network or server error.
                </div>
            `);
            // console.error('Ajax Error:', status, error);
        }
    });
}