jQuery(document).ready(function(){
    // Get all graduates
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'get_all_school_graduates',
        },
        success: function(response) {
            // console.log(response);
            if(response.success){
                if (response.data.graduate_students.length > 0) {
                    let tableBody = '';
                    response.data.graduate_students.forEach(graduate => {
                        // Modified table row code:
                        // Store timestamp for proper sorting
                        const submittedDate = new Date(graduate.submitted_at);
                        tableBody += `
                            <tr>
                                <td class="text-center">
                                    <a href="/view-registration-details/?rid=${graduate.registration_id}" 
                                       class="fw-bold" style="color: #456fb6;"
                                       title="View Registration Details">
                                       ${graduate.parent_name}
                                    </a>
                                </td>
                                <td class="text-center">${graduate.student_name}</td>
                                <td class="text-center">
                                    <button class="btn btn-light btn-sm rounded-circle me-2 shadow-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#view-graduate-data"
                                            data-graduate-data="${encodeURIComponent(JSON.stringify(graduate.graduate_data))}"
                                            title="View Graduate Data">
                                        <i class="fas fa-eye" style="color: #456fb6;"></i>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <a href="/view-attendance/?sid=${graduate.student_id}" 
                                        class="btn btn-light btn-sm rounded-circle me-2 shadow-sm"
                                        title="View Attendance Records">
                                        <i class="fas fa-calendar-alt" style="color: #456fb6;"></i>
                                    </a>
                                    <a href="/view-class/?sid=${graduate.student_id}" 
                                       class="btn btn-light btn-sm rounded-circle me-2 shadow-sm"
                                       title="View Class Information">
                                        <i class="fas fa-chalkboard" style="color: #456fb6;"></i>
                                    </a>
                                </td>`

                                // <td class="text-center">
                                //     <a href="#" class="btn btn-light btn-sm rounded me-2 shadow-sm" title="Download Official Transcript as PDF" onclick="DownloadTranscriptPdf(${graduate.student_id})">
                                //         <i class="fa-solid fa-file-alt me-1"  style="color: #456fb6;"></i> Pdf
                                //     </a>
                                //     <a href="#" class="btn btn-light btn-sm rounded me-2 shadow-sm" title="Download Official Transcript as Excel" onclick="DownloadTranscriptExcel(${graduate.student_id})">
                                //         <i class="fa-solid fa-file-excel me-1"  style="color: #456fb6;"></i> Excel
                                //     </a>
                                // </td>
                                +
                                `
                                <td class="text-center">
                                    <a href="/transcript-editor/?sid=${graduate.student_id}"
                                       class="btn btn-light btn-sm rounded me-2 shadow-sm"
                                       title="View/Edit Transcript">
                                       <i class="fas fa-eye" style="color: #456fb6;"></i> Preview
                                    </a>
                                </td>
                                <td class="text-center">
                                    ${graduate.status?.toLowerCase() === "approved" ? 
                                      ' <button class="btn btn-success btn-sm rounded shadow-sm"><i class="fas fa-check"></i> Approved</button>' : 
                                      (graduate.status?.toLowerCase() === "rejected" ? 
                                       `<button class="btn btn-danger btn-sm rounded shadow-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#rejection-reason-modal" 
                                                data-rejection-reason="${graduate.reject_reason || 'No reason provided'}" 
                                                title="View Rejection Reason">
                                           <i class="fas fa-ban me-1"></i> Rejected
                                        </button>` :
                                       `<div class="d-inline-flex gap-2">
                                          <button class="btn btn-success btn-sm rounded shadow-sm approve-graduate-btn" 
                                                  data-student-id="${graduate.student_id}" 
                                                  title="Approve Graduate" onclick="approveGraduate(${graduate.student_id})">
                                              <i class="fas fa-check"></i> Approve
                                          </button>
                                          <button class="btn btn-danger btn-sm rounded shadow-sm reject-graduate-btn" 
                                                  data-student-id="${graduate.student_id}" 
                                                  title="Reject Graduate" onclick="rejectGraduate(${graduate.student_id})">
                                              <i class="fas fa-times"></i> Reject
                                          </button>
                                       </div>`
                                      )
                                    }
                                </td>
                                <td class="text-center" data-sort="${submittedDate.getTime()}" title="Submission Date and Time">
                                    ${submittedDate.toLocaleDateString('en-US', {
                                        month: '2-digit', 
                                        day: '2-digit',
                                        year: 'numeric',
                                        hour: '2-digit',
                                        minute: '2-digit',
                                        hour12: true 
                                    }).replace(',', ', ')}
                                </td>
                            </tr>
                        `;
                    });
                    $('.graduates-table tbody').html(tableBody);

                    // Initialize DataTable with enhanced styling
                    $('.graduates-table').DataTable({
                        responsive: true,
                        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                        pageLength: 10,
                        dom: '<"d-flex justify-content-between align-items-center mb-3"lf>' +
                             '<"row"<"col-sm-12"tr>>' +
                             '<"row align-items-center"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search Graduates...",
                            lengthMenu: "_MENU_ records per page",
                            info: "Showing _START_ to _END_ of _TOTAL_ graduates",
                            paginate: {
                                first: '<i class="fas fa-angle-double-left"></i>',
                                last: '<i class="fas fa-angle-double-right"></i>',
                                next: '<i class="fas fa-angle-right"></i>',
                                previous: '<i class="fas fa-angle-left"></i>'
                            }
                        },
                        columnDefs: [
                            { orderable: true, targets: [0, 1, 6] },
                            { orderable: false, targets: [2, 3, 4, 5] },
                            { className: "align-middle", targets: "_all" }
                        ],
                        order: [[6, 'desc']], // Sort by submitted date
                        autoWidth: false,
                        drawCallback: function() {
                            $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                            $('.graduates-table thead th').css({
                            'background-color': '#bc9f5e',
                            'color': 'white'
                            });
                        },
                        stateSave: true,
                        processing: true,
                        scrollCollapse: true,
                        initComplete: function() {
                            $('.dataTables_filter input').addClass('form-control');
                            $('.dataTables_length select').addClass('form-select');
                            $('.dataTables_length').addClass('d-flex align-items-center');
                            $('.graduates-table thead th').css({
                                'background-color': '#bc9f5e',
                                'color': 'white'
                                });
                        }
                    });
                    
                } else {
                    $('.graduates-table tbody').html('<tr><td colspan="5" class="text-center">No graduate students found</td></tr>');
                }
            } else {
                swal('Error', response.data.message, 'error');
            }
        },
        error: function() {
            swal('Error', 'An unexpected error occurred.', 'error');
        }
    });

});


// // Generate Official Transcript (PDF or Excel)
// function GetOfficialTranscript(student_id = '', format = '') {
//     if (!student_id) {
//         swal('Error', `Failed to generate transcript: No Student found`, 'error');
//         return;
//     }

//     // Show loading indicator with modern styling
//     const loadingOverlay = $('<div>', {
//         css: {
//             position: 'fixed',
//             top: 0,
//             left: 0,
//             width: '100%',
//             height: '100%',
//             backgroundColor: 'rgba(0,0,0,0.5)',
//             backdropFilter: 'blur(5px)',
//             zIndex: 9999,
//             display: 'flex',
//             justifyContent: 'center',
//             alignItems: 'center'
//         }
//     }).append($('<div>', {
//         css: { 
//             background: 'linear-gradient(145deg, #ffffff, #f6f6f6)',
//             padding: '30px 40px',
//             borderRadius: '12px',
//             boxShadow: '0 10px 25px rgba(0,0,0,0.15)',
//             display: 'flex',
//             flexDirection: 'column',
//             alignItems: 'center',
//             gap: '15px'
//         }
//     }).append(
//         $('<div>', {
//             class: 'spinner',
//             css: {
//                 width: '40px',
//                 height: '40px',
//                 border: '4px solid rgba(69, 111, 182, 0.3)',
//                 borderRadius: '50%',
//                 borderTop: '4px solid #456fb6',
//                 animation: 'spin 1s linear infinite'
//             }
//         }),
//         $('<style>', {
//             text: '@keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }'
//         }),
//         $('<div>', {
//             text: `Generating ${format.toUpperCase()}...`,
//             css: {
//                 fontSize: '18px',
//                 fontWeight: '600',
//                 color: '#333'
//             }
//         }),
//         $('<div>', {
//             text: 'Please wait while we prepare your transcript',
//             css: {
//                 fontSize: '14px',
//                 color: '#666',
//                 marginTop: '5px'
//             }
//         })
//     ));
    
//     $('body').append(loadingOverlay);

//     // Fetch student data
//     $.ajax({
//         type: 'POST',
//         url: ajax_object.ajax_url,
//         data: {
//             'student_id': student_id,
//             'action': 'get_student_official_transcript_data',
//         },
//         success: function(response) {
//             if (response && response.data) {
//                 const students = Array.isArray(response.data) ? response.data : [response.data];
//                 if (students.length === 0) {
//                     loadingOverlay.remove();
//                     swal('Info', 'No student data available.', 'info');
//                     return;
//                 }
                
//                 const student = students[0];
                
//                 // Basic student info
//                 const studentId = student.student_id;
//                 const studentName = student.student_name;
//                 const firstName = student.first_name;
//                 const middleName = student.middle_name;
//                 const lastName = student.last_name;
//                 const dob = new Date(student.dob).toLocaleDateString('en-US', {month: '2-digit', day: '2-digit', year: 'numeric'});
//                 const gender = student.gender;
//                 const parent_email = student.parent_email;
//                 const address = student.address;
//                 const parent_phone = student.parent_phone;
//                 const country_code = student.country_code;
                
//                 // Format course data
//                 const Student_courses = [];
                
//                 // Check if course data exists
//                 if (student.course_data && student.course_data.length > 0) {
//                     student.course_data.forEach(course => {
//                         // Check for weighted grades
//                         let weightAdjustment = 0;
//                         const courseInfo = (course.additional || '').toLowerCase();

//                         // Only apply weighting to letter grades
//                         if (/^[A-F][+-]?$/.test(course.grade)) {
//                             if (courseInfo.includes('honor') || courseInfo.includes('honours')) {
//                                 // Honors course - add 0.5 points
//                                 weightAdjustment = 0.5;
//                             } else if (
//                                 courseInfo.includes('ap ') || 
//                                 courseInfo.includes('advanced placement') || 
//                                 courseInfo.includes('ib ') || 
//                                 courseInfo.includes('international baccalaureate') || 
//                                 courseInfo.includes('de ') || 
//                                 courseInfo.includes('dual enrollment')
//                             ) {
//                                 // AP, IB, or DE course - add 1.0 point
//                                 weightAdjustment = 1.0;
//                             }
//                         }

//                         // CLEP or non-letter grade assignments such as "Pass" do not have a GPA impact
//                         if (course.additional === 'CLEP' || course.grade === 'Pass') {
//                             weightAdjustment = 0;
//                         }

//                         Student_courses.push({
//                             year: course.year,
//                             course_name: course.courseName,
//                             publisher: course.publisher,
//                             semester: course.semester,
//                             grade: course.grade,
//                             weight_adjustment: weightAdjustment,
//                             credit: course.credit,
//                             additional: course.additional,
//                             student_grade: course.studentGrade
//                         });
//                     });
//                 }

//                 // Generate the requested format (PDF or Excel)
//                 if (format.toLowerCase() === 'excel') {
//                     // Generate Excel
//                     jQuery.ajax({
//                         url: ajax_object.ajax_url,
//                         type: 'POST',
//                         data: {
//                             action: 'generate_transcript_excel',
//                             student_id: studentId,
//                             student_name: studentName,
//                             first_name: firstName,
//                             middle_name: middleName,
//                             last_name: lastName,
//                             gender: gender,
//                             dob: dob,
//                             parent_email: parent_email,
//                             parent_phone: parent_phone,
//                             country_code: country_code,
//                             courses: JSON.stringify(Student_courses),
//                             address: JSON.stringify(address),
//                         },
//                         success: function(response) {
//                             loadingOverlay.remove();
                            
//                             if (response.success && response.data.excel_url) {
//                                 // Create a download link for the Excel file
//                                 const link = document.createElement('a');
//                                 link.href = response.data.excel_url;
                                
//                                 // Use the server-provided filename with .csv extension
//                                 const fileName = `${studentName.replace(/\s+/g, '_')}_transcript.csv`;
                                
//                                 link.download = fileName;
//                                 document.body.appendChild(link);
//                                 link.click();
//                                 document.body.removeChild(link);
//                             } else {
//                                 swal('Error', response.data || 'Failed to generate Excel file', 'error');
//                             }
//                         },
//                         error: function() {
//                             loadingOverlay.remove();
//                             swal('Error', 'An unexpected error occurred while generating the Excel file.', 'error');
//                         }
//                     });
//                 } else {
//                     // Generate PDF
//                     jQuery.ajax({
//                         url: ajax_object.ajax_url,
//                         type: 'POST',
//                         data: {
//                             action: 'generate_transcript_pdf',
//                             student_id: studentId,
//                             student_name: studentName,
//                             first_name: firstName,
//                             middle_name: middleName,
//                             last_name: lastName,
//                             gender: gender,
//                             dob: dob,
//                             parent_email: parent_email,
//                             parent_phone: parent_phone,
//                             country_code: country_code,
//                             courses: JSON.stringify(Student_courses),
//                             address: JSON.stringify(address),
//                         },
//                         success: function(response) {
//                             if (response.success) {
//                                 // Create a download link for direct download of the PDF
//                                 if (response.data.html) {

//                                     // console.log('HTML content received for PDF generation:', response.data.html);
//                                     // We need to generate the PDF from HTML
//                                     const iframe = document.createElement('iframe');
//                                     iframe.style.visibility = 'hidden';
//                                     iframe.style.position = 'fixed';
//                                     iframe.style.right = '0';
//                                     iframe.style.bottom = '0';
//                                     iframe.style.width = '100%';
//                                     iframe.style.height = '100%';
//                                     document.body.appendChild(iframe);
                                    
//                                     // Create document content using DOM methods instead of write()
//                                     const iframeDoc = iframe.contentWindow.document;
//                                     iframeDoc.open();
                                    
//                                     // Create HTML structure
//                                     const html = iframeDoc.createElement('html');
//                                     const head = iframeDoc.createElement('head');
//                                     const body = iframeDoc.createElement('body');
                                    
//                                     // Create title
//                                     const title = iframeDoc.createElement('title');
//                                     title.textContent = `${studentName} Transcript`;
//                                     head.appendChild(title);
                                    
//                                     // Create content wrapper and add HTML content
//                                     const contentWrapper = iframeDoc.createElement('div');
//                                     contentWrapper.className = 'content-wrapper';
//                                     contentWrapper.innerHTML = response.data.html;
//                                     body.appendChild(contentWrapper);
                                    
//                                     // Add elements to document
//                                     html.appendChild(head);
//                                     html.appendChild(body);
//                                     iframeDoc.appendChild(html);

//                                     iframeDoc.close();
                                    
//                                     // Wait for content to load and render properly
//                                     setTimeout(() => {
//                                         const element = iframeDoc.body;
//                                         const filename = `${studentName.replace(/\s+/g, '_')}_transcript.pdf`;
                                        
//                                         const opt = { 
//                                             filename: filename,
//                                             image: { type: 'jpeg', quality: 0.98 },
//                                             html2canvas: { 
//                                                 scale: 2, 
//                                                 useCORS: true,
//                                                 letterRendering: true,
//                                                 scrollY: 0,
//                                                 windowWidth: 850,
//                                                 x: 0,
//                                                 y: 0
//                                             },
//                                             jsPDF: { 
//                                                 unit: 'mm', 
//                                                 format: 'a4', 
//                                                 orientation: 'portrait',
//                                                 compress: true,
//                                                 hotfixes: ["px_scaling"]
//                                             },
//                                             pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
//                                         };
                                        
//                                         html2pdf().from(element).set(opt).save()
//                                             .then(() => {
//                                                 document.body.removeChild(iframe);
//                                                 loadingOverlay.remove();
//                                             })
//                                             .catch(error => {
//                                                 // console.error('PDF Generation Error:', error);
//                                                 loadingOverlay.remove();
//                                                 alert('Error generating PDF. Please try again.');
//                                             });
//                                     }, 1500);
//                                 } else {
//                                     loadingOverlay.remove();
//                                     alert('Failed to generate PDF. Invalid response format.');
//                                 }
//                             } else {
//                                 loadingOverlay.remove();
//                                 alert('Failed to generate PDF: ' + (response.data || 'Unknown error'));
//                             }
//                         },
//                         error: function(xhr, status, error) {
//                             loadingOverlay.remove();
//                             alert('Failed to generate PDF. Network or server error.');
//                             // console.error('Ajax Error:', status, error);
//                         }
//                     });
//                 }
//             } else {
//                 loadingOverlay.remove();
//                 swal('Error', 'No student records found!', 'error');
//             }
//         },
//         error: function() {
//             loadingOverlay.remove();
//             swal('Error', 'An unexpected error occurred while fetching student data.', 'error');
//         }
//     });
// }

// // Function to download Excel transcript
// function DownloadTranscriptExcel(student_id) {
//     GetOfficialTranscript(student_id, 'excel');
// }

// // Function to download PDF transcript
// function DownloadTranscriptPdf(student_id) {
//     GetOfficialTranscript(student_id, 'pdf');
// }

// set data to view graduate data modal
const viewGraduateDataModal = document.getElementById('view-graduate-data');
viewGraduateDataModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const rawData = button.getAttribute('data-graduate-data');
    let graduateData = JSON.parse(decodeURIComponent(rawData)) || {};
    if (typeof graduateData === 'string') {
        graduateData = JSON.parse(graduateData);
    }
    // console.log(graduateData);
    // console.log("Type of graduateData:", typeof graduateData); // Debug log
    const modal = $(this);
    const questions = graduateData && graduateData.questions ? graduateData.questions : {};
    // console.log("Questions data:", questions); // Debug log
    // Get the questions directly from parsed data
    if (graduateData && graduateData.questions) {
        // const questions = graduateData.questions;
        // console.log("Questions data:", questions); // Debug log
        
        // Set values for age verification
        if (questions.q1 && questions.q1.ans) {
            modal.find('#studentAgeSelect').val(questions.q1.ans.toLowerCase());
        }
        
        // Set values for course work completion  
        if (questions.q2 && questions.q2.ans) {
            modal.find('#courseWorkSelect').val(questions.q2.ans.toLowerCase());
        }
        
        // Set values for special requirements checkboxes
        if (questions.q3 && 'ans' in questions.q3) {
            modal.find('#specialNeeds').prop('checked', Boolean(questions.q3.ans));
        }
        if (questions.q4 && 'ans' in questions.q4) {
            modal.find('#allowChanges').prop('checked', Boolean(questions.q4.ans));
        }
        
        // Set values for enrollment
        if (questions.q5 && questions.q5.ans) {
            modal.find('#enrollmentSelect').val(questions.q5.ans.toLowerCase());
        }
    }   
});

// Function to approve graduate
function approveGraduate(student_id) {
    if (!student_id) {
        swal('Error', 'Failed to approve graduate: No Student found', 'error');
        return;
    }

    // Show alert for confirmation
    swal({
        title: "Are you sure?",
        text: "You are about to approve this graduate.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willApprove) => {
        if (willApprove) {

            console.log('Graduate approved:', student_id);
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: { 
                    student_id: student_id,
                    action: 'approve_graduate_student'
                 },
                success: function(response) {
                    swal('Success', 'Graduate approved successfully!', 'success');
                    location.reload(); // Reload the page to reflect changes
                },
                error: function(xhr, status, error) {
                    swal('Error', 'Failed to approve graduate. Please try again.', 'error');
                    // console.error('Ajax Error:', status, error);
                }
            });

        } else {
            // console.log('Approval canceled');
        }
    });
}

// Function to reject graduate
function rejectGraduate(student_id) {
    if (!student_id) {
        swal('Error', 'Failed to reject graduate: No Student found', 'error');
        return;
    }

    // Show alert for confirmation
    swal({
        title: "Are you sure?",
        text: "You are about to reject this graduate.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willReject) => {
        if (willReject) {
            // Show another prompt asking for the reason
            swal({
                title: "Provide Rejection Reason",
                text: "Please enter a reason for rejecting this graduate:",
                content: {
                    element: "input",
                    attributes: {
                        placeholder: "Enter rejection reason",
                        type: "text",
                    },
                },
                buttons: {
                    cancel: "Cancel",
                    confirm: "Submit",
                },
            }).then((reason) => {
                if (reason === null) {
                    // User clicked the cancel button
                    return;
                }
                
                if (reason.trim() === "") {
                    swal("Error", "Please provide a reason for rejection", "error");
                    return;
                }
                
                $.ajax({
                    type: 'POST',
                    url: ajax_object.ajax_url,
                    data: { 
                        student_id: student_id,
                        action: 'reject_graduate_student',
                        rejection_reason: reason
                    },
                    success: function(response) {
                        swal('Success', 'Graduate rejected successfully!', 'success');
                        location.reload(); // Reload the page to reflect changes
                    },
                    error: function(xhr, status, error) {
                        swal('Error', 'Failed to reject graduate. Please try again.', 'error');
                        // console.error('Ajax Error:', status, error);
                    }
                });
            });
            // console.log('Graduate rejected:', student_id);
        } else {
            // console.log('Rejection canceled');
        }
    });
}

// Function to show rejection reason in modal
document.addEventListener('DOMContentLoaded', function() {
    const rejectionModal = document.getElementById('rejection-reason-modal');
    if (rejectionModal) {
        rejectionModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const rejectionReason = button.getAttribute('data-rejection-reason');
            document.getElementById('rejection-reason-text').textContent = rejectionReason;
        });
    }
});