/**
 * Get student ID from URL query string
 * @returns {string}
 */
function getStudentIdFromUrl() {
    const urlParams = new URLSearchParams(window.location.search);
    const sid = urlParams.get('sid');
    return sid;
}

/**
 * Fetch student data and render transcript HTML
 * @param {string} student_id
 */
function fetchStudentTranscript(student_id) {
    if (!student_id) {
        swal('Error', 'No student ID found in URL.', 'error');
        return;
    }

    // Show loading overlay
    const loadingOverlay = $('<div>', {
        css: {
            position: 'fixed',
            top: 0,
            left: 0,
            width: '100%',
            height: '100%',
            backgroundColor: 'rgba(0,0,0,0.5)',
            zIndex: 9999,
            display: 'flex',
            justifyContent: 'center',
            alignItems: 'center'
        }
    }).append($('<div>', {
        text: 'Loading student transcript...',
        css: {
            background: '#fff',
            padding: '30px 40px',
            borderRadius: '12px',
            fontSize: '18px',
            fontWeight: '600',
            color: '#333'
        }
    }));
    $('body').append(loadingOverlay);

    // Fetch student data via AJAX
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            action: 'get_student_official_transcript_data',
            student_id: student_id
        },
        success: function(response) {
            loadingOverlay.remove();
            if (response && response.data) {
                const student = Array.isArray(response.data) ? response.data[0] : response.data;
                if (!student) {
                    swal('Info', 'No student data available.', 'info');
                    return;
                }
                
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
                
                // Format course data
                const Student_courses = [];
                
                // Check if course data exists
                if (student.course_data && student.course_data.length > 0) {
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
                    })
                }

                // Set Student Name
                $('#student_name').val(firstName + '_' + middleName + '_' + lastName);
                //  Generate PDF
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
                            // Create a download link for direct download of the PDF
                            if (response.data.html) {
                                // console.log('HTML content received for PDF generation:', response.data.html);
                                $('#transcript').html(response.data.html);
                            }
                        } else {
                            swal('Error', 'Failed to generate PDF. Please try again.', 'error');
                        }
                    }
                });
                
            } else {
                swal('Error', 'No student records found!', 'error');
            }
        },
        error: function() {
            loadingOverlay.remove();
            swal('Error', 'An unexpected error occurred while fetching student data.', 'error');
        }
    });
}

// Usage: On page load
$(document).ready(function() {
    const student_id = getStudentIdFromUrl();
    fetchStudentTranscript(student_id);

    document.getElementById('downloadPdfBtn').addEventListener('click', function() {
        const transcript = document.getElementById('transcript');
        const student_name = document.getElementById('student_name').value;
        const studentName = student_name.replace(/_/g, ' ');
        const loadingOverlay = $('<div>', {
            css: {
                position: 'fixed',
                top: 0,
                left: 0,
                width: '100%',
                height: '100%',
                backgroundColor: 'rgba(0,0,0,0.5)',
                zIndex: 9999,
                display: 'flex',
                justifyContent: 'center',
                alignItems: 'center'
            }
        }).append($('<div>', {
            text: 'Generating PDF...',
            css: {
                background: '#fff',
                padding: '30px 40px',
                borderRadius: '12px',
                fontSize: '18px',
                fontWeight: '600',
                color: '#333'
            }
        }));
        $('body').append(loadingOverlay);

        const iframe = document.createElement('iframe');
        iframe.style.visibility = 'hidden';
        iframe.style.position = 'fixed';
        iframe.style.right = '0';
        iframe.style.bottom = '0';
        iframe.style.width = '100%';
        iframe.style.height = '100%';
        document.body.appendChild(iframe);

        const iframeDoc = iframe.contentWindow.document;
        iframeDoc.open();

        const html = iframeDoc.createElement('html');
        const head = iframeDoc.createElement('head');
        const body = iframeDoc.createElement('body');

        const title = iframeDoc.createElement('title');
        title.textContent = `${studentName} Transcript`;
        head.appendChild(title);

        // Copy stylesheets from parent document
        Array.from(document.styleSheets).forEach(sheet => {
            if (sheet.href) {
                const link = iframeDoc.createElement('link');
                link.rel = 'stylesheet';
                link.href = sheet.href;
                head.appendChild(link);
            }
        });

        const contentWrapper = iframeDoc.createElement('div');
        contentWrapper.className = 'content-wrapper';
        contentWrapper.innerHTML = transcript.innerHTML;
        body.appendChild(contentWrapper);

        html.appendChild(head);
        html.appendChild(body);
        iframeDoc.appendChild(html);

        iframeDoc.close();

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

            html2pdf().from(element).set(opt).save()
                .then(() => {
                    document.body.removeChild(iframe);
                    loadingOverlay.remove();
                })
                .catch(() => {
                    loadingOverlay.remove();
                    alert('Error generating PDF. Please try again.');
                });
        }, 1500);
    });
});
