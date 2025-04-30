let student_data = [];
// Load Data for Transcript Page
jQuery(document).ready(function($) {

    // form url get parameter
    const urlParams = new URLSearchParams(window.location.search);
    const studentId = urlParams.get('sid');

    // console.log('Transcript Page Loaded');
    let yearlyAttendance = {};
    
    // load data for transcript page
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'get_student_transcript_data',
        },
        success: function(response) {
            // console.log(response);

            // console.log('Response:', response); // Debug log
            if (response && response.data) {
                const students = Array.isArray(response.data) ? response.data : [response.data];
                if (studentId) {
                    // Only process data for the specific student
                    student_data = students.find(s => s.student_id.toString() === studentId);
                    if (student_data) {
                        student_data = [student_data]; // Convert to array
                    }
                    // console.log('student', typeof(student_data));
                    // console.log('student_data', student_data);
                }else {
                    student_data = students;
                    // console.log('student', typeof(student_data));
                    // console.log('student_data', student_data);
                }

                // console.log('Student Data:', student_data); // Debug log
                if (student_data) {
                    // Check if there are any students
                    if (student_data.length === 0) {
                        swal('Info', 'No student data available.', 'info');
                        return;
                    }
                    // Create student badges initially
                    const studentBadgesHTML = `
                        <div class="student-badges mb-3">
                            ${student_data.map((student, index) => `
                                <span class="badge badge-primary student-badge m-1" 
                                      style="cursor: pointer; padding: 8px; font-size: 14px;" 
                                      data-index="${index}">
                                    ${student.student_name}
                                </span>
                            `).join('')}
                        </div>`;

                    function loadStudent(index) {
                        const student = student_data[index];
                        
                        // Calculate yearly attendance
                        if (Array.isArray(student.attendance) && student.attendance.length > 0) {
                            student.attendance.forEach(record => {
                                // console.log('Record:', record); // Debug log
                                yearlyAttendance[record.year] = 0;
                                // const yearCourses = student.course_data.filter(course => course.year === record.year);
                                // const presentSemesters = [...new Set(yearCourses.map(course => course.semester.toLowerCase()))];
                                
                                // if (presentSemesters.includes('fall')) {
                                //     yearlyAttendance[record.year] += parseInt(record.fall);
                                // }
                                // if (presentSemesters.includes('spring')) {
                                //     yearlyAttendance[record.year] += parseInt(record.spring);
                                // }
                                // if (presentSemesters.includes('summer')) {
                                //     yearlyAttendance[record.year] += parseInt(record.summer);
                                // }

                                // Calculate total attendance days for the year
                                yearlyAttendance[record.year] = parseInt(record.fall) + parseInt(record.spring) + parseInt(record.summer);
                                // console.log('Yearly Attendance:', yearlyAttendance);
                            });
                        } else {
                            // console.log('No attendance records found for student:', student.student_name); // Debug log
                            yearlyAttendance = {};
                        }

                        // Create entries info
                        const entriesInfo = `
                            <div class="entries-info mt-2">
                                Showing Student ${index + 1} of ${student_data.length}
                            </div>`;

                        // Create base container structure
                        const transcriptHTML = `
                                ${studentBadgesHTML}
                                <form class="transcript-filter-form">
                                    <div class="row filter-row" style="gap:0px !important;">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="year" class="font-weight-bold">Academic Year:</label>
                                                <select name="year" class="form-control form-control" id="year">
                                                    <option value="null" selected disabled>Select Academic Year</option>
                                                    <option value="all">All Years</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="semester" class="font-weight-bold">Semester:</label>
                                                <select name="semester" class="form-control form-control" id="semester">
                                                    <option value="null" selected disabled>Select Semester</option>
                                                    <option value="all">All Semesters</option>
                                                    <option value="fall">Fall</option>
                                                    <option value="spring">Spring</option>
                                                    <option value="summer">Summer</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <br>
                                <div class="table-responsive text-center student-section card" id="student-transcript-container">
                                    <table class="form table display text-nowrap transcriptTable table-borderless transcript_data" id="student-transcript-table">
                                        <tbody>
                                            <tr class="student-header">
                                                <td id="student-name-box">
                                                    <span id="student-image"><img src="${student.photo}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;"></span>
                                                    <h2 class="student-name">${student.student_name}</h2>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr class="student-info">
                                                <td id="student-dob">Date of Birth: <span class="dob-value">${new Date(student.dob).toLocaleDateString('en-US', {month: '2-digit', day: '2-digit', year: 'numeric'})}</span></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr class="transcript-header">
                                                <td class="column-classes text-start">CLASSES</td>
                                                <td></td>
                                                <td class="column-grade StyleForPDF">GRADE</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <button id="download-container-pdf-btn" class="btn btn-primary mb-2" onclick="Getpdf()">
                                            <i class="fa-solid fa-circle-down"></i> Download PDF File
                                        </button>
                                    </div>
                                </div>
                                ${entriesInfo}`;

                        // Replace existing content
                        $('.transcript-container').html(transcriptHTML);

                        // Highlight active student badge
                        $('.student-badge').removeClass('active').css({
                            'background-color': '#6c757d',
                            'color': 'white'
                        });
                        $(`.student-badge[data-index="${index}"]`).addClass('active').css({
                            'background-color': '#456fb6',
                            'color': 'white'
                        });

                        // Bind click events to student badges
                        $('.student-badge').click(function() {
                            const clickedIndex = $(this).data('index');
                            loadStudent(clickedIndex);
                        });

                        if (!student.course_data || student.course_data.length === 0) {
                            $('#student-transcript-table tbody').append(`
                                <tr><td colspan="3" style="text-align: center; font-weight: bold;">No courses found</td></tr>
                            `);
                            $('#download-pdf-btn').hide();
                            return;
                        }
                        // Process courses
                        const coursesByYear = {};
                        const uniqueYears = new Set();

                        // First, collect all course data by year and track unique years
                        student.course_data.forEach(course => {
                            if (!coursesByYear[course.year]) {
                                coursesByYear[course.year] = [];
                                uniqueYears.add(course.year);
                            }
                            coursesByYear[course.year].push(course);
                        });

                        // Sort years in descending order (newest to oldest) for "YYYY-YYYY" format
                        const sortedYears = Array.from(uniqueYears).sort((a, b) => {
                            // Extract the first year from each string (e.g., "2024" from "2024-2025")
                            const yearA = parseInt(a.split('-')[0]);
                            const yearB = parseInt(b.split('-')[0]);
                            return yearB - yearA; // Descending order (newest first)
                        });
                        // console.log('Sorted Years:', sortedYears); // Debug log

                        // Add years to dropdown in sorted order
                        sortedYears.forEach(year => {
                            $('select[name="year"]').append(`<option value="${year}">${year}</option>`);
                        });

                        // Render courses by year
                        Object.keys(coursesByYear).sort().reverse().forEach(year => {
                            // console.log('Yearly Attendance:', yearlyAttendance);
                            const attendanceDays = yearlyAttendance[year] || "0";
                            const yearHeader = `
                                <tr class="academic-year-header text-start" data-year="${year}">
                                    <td style="background-color: #58595b;" class="text-white"><b>${year} | ATTENDANCE: <span class="attendance-days">${attendanceDays? attendanceDays : '0'}</span> Days</b></td>
                                    <td style="background-color: #58595b;"></td>
                                    <td></td>
                                </tr>
                            `;

                            let yearContent = '';
                            coursesByYear[year].forEach(course => {
                                yearContent += `
                                    <tr class="course-row" data-year="${year}">
                                        <td class="course-info  text-start">
                                            <span class="course-grade">${course.courseName}</span>
                                            <p class="mb-0">${course.publisher}</p>
                                            `
                                            // <p class="mb-0 semester">${course.semester.charAt(0).toUpperCase() + course.semester.slice(1)}</p>
                                            +`
                                        </td>
                                        <td class="course-data">
                                            
                                        </td>
                                        <td class="course-grade">
                                            ${['8TH WITH HS CREDIT', '9TH GRADE', '10TH GRADE', '11TH GRADE', '12TH GRADE'].includes(course.studentGrade) 
                                                ? `${course.grade}(+${course.credit || 0})`
                                                : course.grade || ''}
                                        </td>
                                    </tr>
                                `;
                            });

                            $('#student-transcript-table tbody').append(yearHeader + yearContent);
                        });
                    }

                    // Load the first student
                    loadStudent(0);
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
        
    // Filter Courses by Year and Semester
    function filterByYearAndSemester(selectedYear, selectedSemester) {
        // console.log("Filtering for Year:", selectedYear, "Semester:", selectedSemester); // Debugging
    
        // Remove any previous "No courses found" row
        $('#student-transcript-table tbody #no-data-row').remove();
    
        // Show all rows if both "All Years" and "All Semesters" are selected
        if (selectedYear === 'all' && selectedSemester === 'all') {
            $('.academic-year-header, .course-row').show();
            return;
        }
    
        // Hide all rows initially
        $('.academic-year-header, .course-row').hide();
    
        let matchingRows = $('.course-row');
    
        // Filter by Year if it's not "all"
        if (selectedYear !== 'all') {
            matchingRows = matchingRows.filter(function () {
                const rowYear = $(this).data('year'); 
                return rowYear && rowYear.toString() === selectedYear;
            });
        }
    
        // Filter by Semester if it's not "all"
        if (selectedSemester !== 'all') {
            matchingRows = matchingRows.filter(function () {
                // console.log("Matching Rows:", matchingRows); // Debugging
                // console.log("selectedSemester:", selectedSemester); // Debugging
                const semesterText = $(this).find('.semester').text().trim().toLowerCase();
                // console.log("Checking Semester:", semesterText); // Debugging
                // Convert to lowercase and trim any extra whitespace and unwanted text
                const cleanedSemesterText = semesterText.replace(/semester/gi, '').trim();
                // console.log("Cleaned Semester:", cleanedSemesterText); // Debugging
                return cleanedSemesterText === selectedSemester;
            });
        }
    
        // Show matching course rows and their corresponding year headers
        let visibleYears = new Set();
        matchingRows.show().each(function () {
            const year = $(this).data('year');
            visibleYears.add(year);
        });
    
        // Show headers for years that have at least one matching row
        visibleYears.forEach(year => {
            $(`.academic-year-header[data-year="${year}"]`).show();
        });
    
        // If no matching rows, show "No courses found"
        if (matchingRows.length === 0) {
            $('#student-transcript-table tbody').append(`
                <tr id="no-data-row">
                    <td colspan="3" style="text-align: center; font-weight: bold;">No courses found</td>
                </tr>
            `);
        }
    }
    
    // Listen for Year changes
    $(document).on('change', 'select[name="year"]', function () {
        const selectedYear = $(this).val() || 'all';
        const selectedSemester = $('select[name="semester"]').val() || 'all';
        // console.log("Year Changed:", selectedYear); // Debugging
        // console.log("Semester:", selectedSemester); // Debugging
        filterByYearAndSemester(selectedYear, selectedSemester);
    });
    
    // Listen for Semester changes
    $(document).on('change', 'select[name="semester"]', function () {
        const selectedYear = $('select[name="year"]').val() || 'all';
        const selectedSemester = $(this).val() || 'all';
        // console.log("Year Changed:", selectedYear); // Debugging
        // console.log("Semester:", selectedSemester); // Debugging
        filterByYearAndSemester(selectedYear, selectedSemester);
    });
       
});

// Create the PDF for transcript
function Getpdf(){ 
    // console.log('Download PDF clicked');
    const studentName = $('.student-name').text().trim();
    const fileName = `${studentName.replace(/\s+/g, '_')}_transcript.pdf`;

    const container = document.querySelector('#student-transcript-table tbody');
    const originalWidth = container.offsetWidth;
    const originalBg = container.style.backgroundColor;
    container.style.backgroundColor = '#ffffff';

    html2canvas(container, {
        scale: 3,
        useCORS: true,
        logging: false,
        backgroundColor: '#ffffff'
    }).then(canvas => {
        const doc = new jsPDF('p', 'mm', 'a4');
        const pageWidth = doc.internal.pageSize.width;
        const imgWidth = pageWidth - 20;
        const imgHeight = canvas.height * imgWidth / canvas.width;
        const x = (pageWidth - imgWidth) / 2;

        doc.addImage(canvas.toDataURL('image/jpeg', 1.0), 'JPEG', x, 10, imgWidth, imgHeight);
        doc.save(fileName);
        container.style.backgroundColor = originalBg;

        // Reset container width
        container.style.width = originalWidth + 'px';
        container.style.margin = '';
    }).catch(error => {
        container.style.backgroundColor = originalBg;
        container.style.width = originalWidth + 'px';
        container.style.margin = '';
        swal('Error', `Failed to generate PDF: ${error.message}`, 'error');
    });
}



function GetpdfNew(user_role = '') {
    // Get the currently displayed student
    const studentIndex = $('.student-badge.active').data('index') || 0;
    const student = student_data[studentIndex];
    // console.log('Generating PDF for Student:', student); // Debug log
    
    // Basic student info
    const studentId = student.student_id;
    const studentName = student.student_name;
    const firstName = student.first_name;
    const middleName = student.middle_name;
    const lastName = student.last_name;
    const dob = new Date(student.dob).toLocaleDateString('en-US', {month: '2-digit', day: '2-digit', year: 'numeric'});
    const gender = student.gender[0].toUpperCase();
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
    // Show loading indicator with modern styling
    const loadingOverlay = $('<div>', {
        css: {
            position: 'fixed',
            top: 0,
            left: 0,
            width: '100%',
            height: '100%',
            backgroundColor: 'rgba(0,0,0,0.5)',
            backdropFilter: 'blur(5px)',
            zIndex: 9999,
            display: 'flex',
            justifyContent: 'center',
            alignItems: 'center'
        }
    }).append($('<div>', {
        css: { 
            background: 'linear-gradient(145deg, #ffffff, #f6f6f6)',
            padding: '30px 40px',
            borderRadius: '12px',
            boxShadow: '0 10px 25px rgba(0,0,0,0.15)',
            display: 'flex',
            flexDirection: 'column',
            alignItems: 'center',
            gap: '15px'
        }
    }).append(
        $('<div>', {
            class: 'spinner',
            css: {
                width: '40px',
                height: '40px',
                border: '4px solid rgba(69, 111, 182, 0.3)',
                borderRadius: '50%',
                borderTop: '4px solid #456fb6',
                animation: 'spin 1s linear infinite'
            }
        }),
        $('<style>', {
            text: '@keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }'
        }),
        $('<div>', {
            text: 'Generating PDF...',
            css: {
                fontSize: '18px',
                fontWeight: '600',
                color: '#333'
            }
        }),
        $('<div>', {
            text: 'Please wait while we prepare your transcript',
            css: {
                fontSize: '14px',
                color: '#666',
                marginTop: '5px'
            }
        })
    ));
    
    $('body').append(loadingOverlay);

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
            // console.log('Server Response:', response);
            if (response.success) {
                // Create a download link for direct download of the PDF
                if (response.data.pdf_url) {
                    // Server has generated the PDF, we just need to download it
                    const link = document.createElement('a');
                    link.href = response.data.pdf_url;
                    link.download = `${studentName.replace(/\s+/g, '_')}_transcript.pdf`;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    loadingOverlay.remove();
                } else if (response.data.html) {
                    // We need to generate the PDF from HTML
                    const iframe = document.createElement('iframe');
                    iframe.style.visibility = 'hidden';
                    iframe.style.position = 'fixed';
                    iframe.style.right = '0';
                    iframe.style.bottom = '0';
                    iframe.style.width = '100%';
                    iframe.style.height = '100%';
                    document.body.appendChild(iframe);
                    
                    // Create document content using DOM methods instead of write()
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
                    
                    /*
                    // Create style
                    const style = iframeDoc.createElement('style');
                    style.textContent = `
                        body { 
                            font-family: Arial, sans-serif; 
                            margin: 0 auto; 
                            padding: 0px;
                            box-sizing: border-box;
                            max-width: 750px;
                            text-align: center;
                            display: flex;
                            justify-content: center;
                        }
                        table { 
                            width: 100%; 
                            border-collapse: collapse; 
                            table-layout: fixed;
                            margin: 0 auto;
                        }
                        td { 
                            padding: 0px; 
                            font-size: 10pt;
                            vertical-align: middle;
                            word-wrap: break-word;
                        }
                        .student-header td { 
                            padding: 0px; 
                            text-align: center;
                        }
                        .academic-year-header td { 
                            background-color: #58595b; 
                            color: white; 
                            font-weight: bold;
                            padding: 0px;
                            font-size: 10pt;
                            text-align: center;
                        }
                        .course-row td {
                            border-bottom: 1px solid #eee;
                        }
                        .course-info {
                            text-align: left;
                        }
                        p { margin: 2px 0; }
                        img {
                            max-width: 40px;
                            max-height: 40px;
                            border-radius: 50%;
                            display: inline-block;
                        }
                        .content-wrapper {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                            width: 100%;
                            margin: 0 auto;
                            page-break-inside: avoid;
                        }
                        
                    `;
                    // head.appendChild(style); 
                    */ // commented
                    
                    // Create content wrapper and add HTML content
                    const contentWrapper = iframeDoc.createElement('div');
                    contentWrapper.className = 'content-wrapper';
                    contentWrapper.innerHTML = response.data.html;
                    body.appendChild(contentWrapper);

                    console.log(response.data.html);   
                    
                    // Add elements to document
                    html.appendChild(head);
                    html.appendChild(body);
                    iframeDoc.appendChild(html);
                    // console.log("PDF:", iframeDoc.head.innerHTML, iframeDoc.body.innerHTML);   

                    iframeDoc.close();
                    
                    // Wait for content to load and render properly
                    setTimeout(() => {
                        const element = iframeDoc.body;
                        const filename = `${studentName.replace(/\s+/g, '_')}_transcript.pdf`;
                        
                        const opt = {
                            // margin: [15, 15, 15, 15],
                            filename: filename,
                            image: { type: 'jpeg', quality: 0.98 },
                            html2canvas: { 
                                scale: 2, 
                                useCORS: true,
                                letterRendering: true,
                                scrollY: 0,
                                windowWidth: 850, // Fixed width for consistency
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
                            .catch(error => {
                                console.error('PDF Generation Error:', error);
                                loadingOverlay.remove();
                                alert('Error generating PDF. Please try again.');
                            });
                    }, 1500);
                } else {
                    loadingOverlay.remove();
                    alert('Failed to generate PDF. Invalid response format.');
                }
            } else {
                loadingOverlay.remove();
                alert('Failed to generate PDF: ' + (response.data || 'Unknown error'));
                console.error('Server Response Error:', response);
            }
        },
        error: function(xhr, status, error) {
            loadingOverlay.remove();
            alert('Failed to generate PDF. Network or server error.');
            console.error('Ajax Error:', status, error);
        }
    });
} 