let course = [];
let student_data = '';
let student_name = '';
let studentGrade = '';
let student_year = ''; 
let student_course = [];
$(document).ready(function () {

    // form url get parameter
    const urlParams = new URLSearchParams(window.location.search);
    const studentId = urlParams.get('sid');

    // // console.log('studentId', studentId);

    // Get Class Data
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'get_student_course_by_id',
            'student_id': studentId,
        },
        success: function (data) {
            if (data.success) {
                if (data.data.student_data) {
                    if (studentId) {
                        // Only process data for the specific student
                        student_data = data.data.student_data.find(s => s.id.toString() === studentId);
                        if (student_data) {
                            student_data = [student_data]; // Convert to array
                        } else {
                            student_data = []; // Ensure it's an empty array if no student is found
                        }
                        // // console.log('student', typeof(student_data));
                        // // console.log('student_data', student_data);
                    }
                    else {
                        student_data = data.data.student_data;
                        // // console.log('student', typeof(student_data));
                        // // console.log('student_data', student_data);
                    }

                    if (Array.isArray(student_data) && student_data.length > 0) {
                        // First create badges for all students
                        const studentBadgesContainer = $("<div>", {
                            class: "student-badges"
                        });

                        student_data.forEach(student => {
                            const fullName = student.first_name + " " + student.middle_name + " " + student.last_name;
                            const badge = $("<span>", {
                                class: "badge student-badge p-2",
                                style: "cursor: pointer; background-color: #6c757d; color: white; padding: 8px; font-size: 14px;",
                                "data-student-id": student.id,
                                html: `${fullName}`
                            });
                            studentBadgesContainer.append(badge);
                        });

                        // Add badges to student-names div
                        $(".student-names").html(studentBadgesContainer);

                        // Initially hide the container
                        $("#student-course-container").empty();

                        // Add click handler for student badges
                        $(".student-badge").click(function() {
                            const selectedStudentId = $(this).data("student-id");
                            
                            // Update badge states
                            $(".student-badge").each(function() {
                                $(this).css({
                                    'background-color': '#6c757d',
                                    'color': 'white'
                                });
                            });
                            $(this).css({
                                'background-color': '#456fb6',
                                'color': 'white',
                                'transition': 'all 0.3s ease'
                            });
                            
                            $("#student-course-container").empty();

                            const selectedStudent = student_data.find(s => s.id.toString() === selectedStudentId.toString());
                            
                            if (selectedStudent) {
                                student_year = selectedStudent.year_paying;
                                studentGrade = selectedStudent.grade;
                                const fullName = selectedStudent.first_name + " " + selectedStudent.middle_name + " " + selectedStudent.last_name;

                                // Get current year and generate last 10 years
                                const currentYear = new Date().getFullYear();
                                const allYears = Array.from({length: 10}, (_, i) => {
                                    const startYear = currentYear - i;
                                    return `${startYear}-${startYear + 1}`;
                                });

                                // Get years from student course data
                                let courseYears = [];
                                if (selectedStudent.student_course && selectedStudent.student_course !== "[]") {
                                    const studentCourses = JSON.parse(selectedStudent.student_course);
                                    courseYears = [...new Set(studentCourses.map(course => course.year))].filter(Boolean);
                                }

                                // Sort years in descending order
                                allYears.sort((a, b) => {
                                    const yearA = parseInt(a.split('-')[0]);
                                    const yearB = parseInt(b.split('-')[0]);
                                    return yearB - yearA;
                                });

                                let studentCourseCard = `
                                    <div class="card mt-3" id="student-card_${selectedStudentId}">
                                        <div class="d-flex align-items-center gap-3 flex-wrap mb-2">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="user student-image" id="student-photo_${selectedStudentId}">
                                                    ${
                                                        selectedStudent.student_profile_pic
                                                            ? `<img src="${selectedStudent.student_profile_pic}" alt="${fullName}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">`
                                                            : '<i class="fas fa-user fa-3x"></i>'
                                                    }
                                                </div>
                                                <h4 id="student-name_${selectedStudentId}" class="mb-0">
                                                  ${fullName}
                                                </h4>
                                            </div>
                                            <div class="ms-auto">
                                                <button class="btn blue-btn" id="add_course" onclick="addCourse('${selectedStudentId}', '${fullName}', '${studentGrade}')">
                                                    <i class="fa-solid fa-circle-plus me-1"></i>Add Course
                                                </button>
                                                <button onclick="window.location='/view-transcript/?sid=${selectedStudentId}'" class="btn blue-btn">
                                                    <i class="fa-solid fa-folder-plus me-1"></i>Report Card
                                                </button>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-start mb-2">
                                            <div class="d-flex align-items-center me-4">
                                                <span class="me-2"><i class="fas fa-calendar-alt me-1"></i>School Year:</span>
                                                <select class="form-select year-filter" style="width: auto;" onchange="filterCoursesByYear('${selectedStudentId}', this.value)">
                                                    ${allYears.map(year => `
                                                        <option value="${year}" ${year === student_year ? 'selected' : ''}>
                                                            ${year}
                                                        </option>
                                                    `).join('')}
                                                </select>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="me-2"><i class="fa-solid fa-graduation-cap me-1"></i> Current Grade Level:</span>
                                                <span>${studentGrade}</span> 
                                            </div>
                                        </div>

                                        <div class="add_course">
                                            <div class="form-card">
                                                <div class="row">
                                                    <div class="reg_add_course_area" id='reg_add_course_area_${selectedStudentId}'>
                                                        <table class='table add-c-table modern-table'>
                                                            <thead>
                                                                <tr>
                                                                    <th>Course</th>
                                                                    <th>Semester</th>
                                                                    <th>Grade</th>
                                                                    <th>Credit</th>
                                                                    <th>Additional</th>
                                                                    <th>Description</th>
                                                                    <th>Schedule</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                               <!-- <div class="container mt-5 text-center">
                                                <div class="summary-title fw-bold h5">CUMULATIVE SUMMARY</div>
                                                <div class="table add-c-table modern-table">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th>Total Credits</th>
                                                                <th>GPA Credits</th>
                                                                <th>GPA Points</th>
                                                                <th>Cumulative GPA</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input type="text" value="" readonly></td>
                                                                <td><input type="text" value="" readonly></td>
                                                                <td><input type="text" value="" readonly></td>
                                                                <td><input type="text" value="" readonly></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div> -->
                                            <div class="d-flex justify-content-center gap-4 align-items-center mt-3">
                                                <button class="btn blue-btn save_course" onclick="saveCourse('${selectedStudentId}')"><i class="fas fa-save me-2"></i>Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                `;

                                $("#student-course-container").html(studentCourseCard);

                                course = [];
                                
                                if (selectedStudent.student_course !== "[]") {
                                    let studentCourse = JSON.parse(selectedStudent.student_course);
                                    if (studentCourse) {
                                        studentCourse.forEach(student_course_data => {
                                            course.push({
                                                student_id: selectedStudentId || '',
                                                student_name: fullName || '',
                                                studentGrade: student_course_data.studentGrade || studentGrade,
                                                courseName: student_course_data.courseName || '',
                                                publisher: student_course_data.publisher || '',
                                                semester: student_course_data.semester || '',
                                                year: student_course_data.year || student_year,
                                                grade: student_course_data.grade || '', 
                                                credit: student_course_data.credit || '',
                                                description: student_course_data.description || '',
                                                additional: student_course_data.additional || '',
                                                schedule: student_course_data.schedule || '',
                                                notes: student_course_data.notes || []
                                            });
                                        });
                                    }
                                    
                                    renderCourse(selectedStudentId);
                                }
                                else {
                                    $(`#reg_add_course_area_${selectedStudentId} tbody`).append('<tr><td colspan="8" class="text-center">No Course Added Yet</td></tr>')
                                    $('.save_course').css('display', 'none');
                                }
                            }
                        });

                        if(student_data.length > 0) {
                            $(".student-badge").first().click();
                        }
                    }
                    else {
                        $("#student-names").html('');
                        $("#student-course-container").html('<div class="alert alert-danger text-center">No Classes records found!</div>');
                    }
                }
            }
            else{
                // // console.log('No student data found');
                swal("", "No student data found!", "error");
            }
        }
    });

    let fall = '';
    let spring = '';
    let summer = '';

    $('.chooseSemester').on("click", function () {
        let id = $(this).attr('data-id')
        let calenderSlot = $('#' + id).find('.schedule-class select').val()
        let semester = '';

        if ($(this).find('.a').hasClass("badge-primary")) {
            fall = 'fall'
        } else {
            fall = ''
        }

        if ($(this).find('.b').hasClass("badge-primary")) {
            spring = 'spring'
        } else {
            spring = ''
        }

        if ($(this).find('.c').hasClass("badge-primary")) {
            summer = 'summer'
        } else {
            summer = ''
        }

        semester = fall + "," + spring + "," + summer

        if (fall) {
            // $('#' + id + ' .credit select').val('0.50').trigger('change');
            $('#' + id + ' .credit input').val('0.50');
        }
        if(spring){
            // $('#' + id + ' .credit select').val('0.50').trigger('change');
            $('#' + id + ' .credit input').val('0.50');
        }
        if (fall && spring) {
            // $('#' + id + ' .credit select').val('1.00').trigger('change');
            $('#' + id + ' .credit input').val('1.00');
        }
        if (summer) {
            // $('#' + id + ' .credit select').val('1.00').trigger('change');
            $('#' + id + ' .credit input').val('1.00');
        }
        if (!fall && !spring && !summer) {
            // $('#' + id + ' .credit select').val('0.0').trigger('change');
            $('#' + id + ' .credit input').val('0.0');
        }
    })

    $('.chooseSemester .badge').on("click", function () {

        if ($(this).hasClass("badge-primary")) {
            $(this).removeClass("badge-primary");
            $(this).addClass("badge-secondary");
        } else if ($(this).hasClass("badge-secondary")) {
            $(this).addClass("badge-primary");
            $(this).removeClass("badge-secondary");
        }

    })
});

// Add this function to handle year filtering
function filterCoursesByYear(studentId, selectedYear) {
    // console.log('selectedYear', selectedYear);
    // console.log('studentId', studentId);

    studentId = Number(studentId);
    // Filter courses for this specific student
    let studentCourses = course.filter(c => c.student_id === studentId);

    // Filter by selected year if not "all"
    let filteredCourses = selectedYear === 'all' 
        ? studentCourses // Show all years
        : studentCourses.filter(c => (!c.year || c.year === selectedYear)); // Filter by year

    // Clear current courses display
    $(`#reg_add_course_area_${studentId} tbody`).empty();
    
    // Re-render courses with filtered data
    if (filteredCourses.length > 0) {
        // Temporarily update course array with filtered data
        let originalCourses = [...course]; // Save original
        course = filteredCourses;
        
        // console.log('filteredCourses', filteredCourses);
        renderCourse(studentId);
        
        // Restore original course array
        course = originalCourses;
    } else {
        $(`#reg_add_course_area_${studentId} tbody`).append('<tr><td colspan="8" class="text-center">No courses found for selected year</td></tr>');
        $('.save_course').css('display', 'none');
    }
}

// Add Course
function addCourse(student_id , student_name , studentGrade) {
    // console.log('Course before add', course);
    let checkCourseStudentTitle = student_name;
    let checkCourseStudentGrade = studentGrade;
    let credit;
    let additional;

    if (checkCourseStudentGrade == '8TH WITH HS CREDIT' || checkCourseStudentGrade == '9TH GRADE' || checkCourseStudentGrade == '10TH GRADE' || checkCourseStudentGrade == '11TH GRADE' || checkCourseStudentGrade == '12TH GRADE') {
        credit = '0.50';
    } else {
        credit = '';
    }

    if (checkCourseStudentGrade == '8TH WITH HS CREDIT') {
        additional = 'Standard Course';
    } else {
        additional = '';
    }

    if (checkCourseStudentTitle) {
        let emptyIndex = course.findIndex(c => 
            !c.student_id &&
            !c.student_name &&
            !c.studentGrade &&
            !c.year &&
            !c.courseName && 
            !c.publisher && 
            !c.semester && 
            !c.grade && 
            !c.credit && 
            !c.description && 
            !c.additional &&
            !c.schedule &&
            !c.notes
        );

        student_year = $('.year-filter').val();
        // console.log('student_year', student_year);
        // // console.log('student_id:', student_id);
        // // console.log('typeof:', typeof(student_id));
        student_id = Number(student_id);
        // // console.log('student_id:', student_id);
        // // console.log('typeof:', typeof(student_id));
        if (emptyIndex !== -1) {
            course[emptyIndex] = {
                student_id: student_id,
                student_name: student_name,
                studentGrade: studentGrade,
                year: student_year,
                courseName: '',
                publisher: 'Book Publisher/Online Course', 
                semester: '',
                grade: 'In Progress',
                credit,
                description: 'Description',
                additional,
                schedule: '',
                notes: []
            };
        } else {
            course.push({
                student_id: student_id,
                student_name: student_name,
                studentGrade: studentGrade,
                year: student_year,
                courseName: '',
                publisher: 'Book Publisher/Online Course',
                semester: '',
                grade: 'In Progress', 
                credit,
                description: 'Description',
                additional,
                schedule: '',
                notes: []
            });
        }

        // console.log('Course after add', course);
        $(`#reg_add_course_area_${student_id}  tbody tr`).remove();
        renderCourse(student_id);
    }
}

// Save Course
function saveCourse(student_id) {

     // Clear any existing error messages
     $('.error-message').remove();
     let error = 0;

    let move_to_next = true;
    // let description_message = false;
    let publisher_message = false;
    
    $(".publisher").each(function () {
        let input = $(this).html();
        if (input.includes(' Book Publisher/Online Course')) {
            move_to_next = false;
        }
    });

    // $(".description input").each(function () {
    //     let input = $(this).val();
    //     if (!input) {
    //         move_to_next = false;
    //     }
    // });

    if ($(`#reg_add_course_area_${student_id} tbody tr`).length === 0) {
        swal("", "Please Add At Least One Course!", "error");
        return;
    }

    $(`#reg_add_course_area_${student_id} tbody tr`).each(function () {
        let checkCourseStudentGrade = studentGrade;
        // console.log('checkCourseStudentGrade', checkCourseStudentGrade);
        // let not_show_description = ['9TH GRADE', '10TH GRADE', '11TH GRADE', '12TH GRADE', '8TH WITH HS CREDIT'];
        // Get row identifier for error placement
        let rowClass = $(this).attr('class');
        
        // Extract and clean publisher value
        let publisher = $(this).find('.publisher').html().replace(/&nbsp;/g, '').trim();
        
        // Extract and clean description value
        // let description = $(this).find('.description input').val() || '';
        // let isDefaultDescription = description === 'Description';
        
        // Check for various error conditions
        if (publisher === ' Book Publisher/Online Course' || publisher === '') {
            publisher_message = true;
            move_to_next = false;
            errorPublisherClass = '.' + rowClass + ' .selectCourse';
            $(errorPublisherClass).append('<span class="error-message" style="color: red;">Please Fill Publisher!</span>');
            error = 1;
        }
        
        // if (isDefaultDescription || description.trim() === '') {
        //     if (!not_show_description.includes(checkCourseStudentGrade)) {
        //         description_message = true;
        //         move_to_next = false;
        //         errorDescriptionClass = '.' + rowClass + ' .description';
        //         $(errorDescriptionClass).append('<span class="error-message text-nowrap" style="color: red;">Please Fill Description!</span>');
        //         error = 1;
        //     }
        // }
    });

    if (error === 1) {
        return false;
    }

    student_year = $('.year-filter').val();
    // console.log('student_year', student_year);

    student_id = Number(student_id);
    if (move_to_next) {
        let course_data = [];
        // Filter courses for this specific student
        let student_course = course.filter(c => c.student_id === student_id);
        // console.log('student_course in the save function:', student_course);
        student_course.forEach(courseItem => {
            const isEmptyCourse =   !courseItem.student_id &&
                                    !courseItem.student_name &&
                                    !courseItem.studentGrade &&
                                    !courseItem.notes.length &&
                                    !courseItem.courseName && 
                                    !courseItem.publisher &&
                                    !courseItem.semester &&
                                    !courseItem.grade &&
                                    !courseItem.credit &&
                                    !courseItem.description &&
                                    !courseItem.additional &&
                                    !courseItem.schedule;
                                    
            if (!isEmptyCourse) {
                course_data.push({
                    student_id: courseItem.student_id || '',
                    student_name: courseItem.student_name || '',
                    studentGrade: courseItem.studentGrade || '',
                    courseName: courseItem.courseName || '',
                    publisher: courseItem.publisher ? courseItem.publisher.replace(/<span[^>]*>(.*?)<\/span>/g, '$1').trim() : '',
                    semester: courseItem.semester || '',
                    grade: courseItem.grade || '',
                    credit: courseItem.credit || '',
                    description: courseItem.description || '', 
                    additional: courseItem.additional || '',
                    schedule: courseItem.schedule || '',
                    year: courseItem.year || student_year,
                    notes: courseItem.notes || []
                });
            }
        });

        // console.log('course_data before ajax call:', course_data);
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'action': 'save_student_course_by_admin',
                'student_id': student_id,
                'student_course': JSON.stringify(course_data),
            },
            success: function (response) {
                if (response.success) {
                    swal("", "Course Updated Successfully!", "success");
                    location.reload();
                } else {
                    swal("", "Sorry, Something went wrong!", "error");
                }
            }
        });
    } else {
        if (publisher_message) {
            swal("", "Please Fill Publisher!", "error");
        } 
        // else if (description_message) {
        //     swal("", "Please Fill Description!", "error");
        // }
    }
}

function scheduleSlotOptionsHtml(selectedItem) {

    let calendarSlots = ['M-F', 'M-W-F', 'M-W', 'T-Thur', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    let html = `<select>`    
    
    for (let i = 0; i < calendarSlots.length; i++) {
        html += `<option ${calendarSlots[i] == selectedItem && "selected"} value="${calendarSlots[i]}">${calendarSlots[i]}</option>`
    }
    
    html += `</select>`;
    
    return html;
}

function renderCourse(student_id) {

    student_id = Number(student_id);
    // console.log('student_id', student_id);

    student_year = $('.year-filter').val();
    // console.log('student_year', student_year);
    // Filter courses for this specific student
    let student_course = course.filter(c => c.student_id === student_id && c.year === student_year);
    // console.log('student_course', student_course);
    // let student_course = course;
    if (student_course.length > 0) {

        let CustomCouse = ['Math', 'Science', 'English', 'History', 'Physical Education', 'Religious Studies', 'Foreign Language', 'Social Studies', 'Art', 'Music'];
        let checkCourseStudentGrade = student_course[0].studentGrade;
        // let not_show_description = ['9TH GRADE', '10TH GRADE', '11TH GRADE', '12TH GRADE', '8TH WITH HS CREDIT'];
        let not_show_credit = ['Kindergarten', '1ST GRADE', '2ND GRADE', '3RD GRADE', '4TH GRADE', '5TH GRADE', '6TH GRADE', '7TH GRADE', '8TH GRADE'];
        let show_additional = ['9TH GRADE', '10TH GRADE', '11TH GRADE', '12TH GRADE', '8TH WITH HS CREDIT'];

        // console.log('student_course', student_course);
        // make the save button display block
        $('.save_course').css('display', 'block');
        student_course.map(function (item, index) {
            $(`#reg_add_course_area_${student_id} tbody`).append(` 
            <tr class="${index}" onClick="editCourse(${index}, '${student_id}', '${item.student_name}', '${item.studentGrade}')">
                <td class="selectCourse">
                <div style="display:flex;width: 250px;">
                <input style="margin-bottom:0" type='${CustomCouse.includes(item.courseName) ? 'hidden' : item.courseName === '' ? 'hidden' : 'text'}' value="${item.courseName}"/>
                <select name="" id="" class="" style="width: 95%;">
                    <option ${item.courseName === '' ? "selected" : ""} value="" style="display:none">Main Subject Area</option>
                    <option ${!CustomCouse.includes(item.courseName) && item.courseName !== '' ? "selected" : ""} value="Custom">Custom</option>
                    <option ${item.courseName === 'Math' ? "selected" : ""} value="Math">Math</option>
                    <option ${item.courseName === 'Science' ? "selected" : ""} value="Science">Science</option>
                    <option ${item.courseName === 'English' ? "selected" : ""} value="English">English</option>
                    <option ${item.courseName === 'History' ? "selected" : ""} value="History">History</option>
                    <option ${item.courseName === 'Physical Education' ? "selected" : ""} value="Physical Education">Physical Education</option>
                    <option ${item.courseName === 'Religious Studies' ? "selected" : ""} value="Religious Studies">Religious Studies</option>
                    <option ${item.courseName === 'Foreign Language' ? "selected" : ""} value="Foreign Language">Foreign Language</option>
                    <option ${item.courseName === 'Social Studies' ? "selected" : ""} value="Social Studies">Social Studies</option>
                    <option ${item.courseName === 'Art' ? "selected" : ""} value="Art">Art</option>
                    <option ${item.courseName === 'Music' ? "selected" : ""} value="Music">Music</option>
                </select>
                &nbsp;<span class="tooltip-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="Select the general subject area for this course">
                <i class="fas fa-info-circle" style="cursor: pointer; color: #456fb6;"></i>
                </span>

                </div>
                    <p style="display: inline-block;max-width: 225px;width: 89%;border-bottom: 1px solid #ccc;background: transparent;outline: none; padding-top: 10px; padding-left: 10px;" onclick="emptyVal(${index},'${item.student_id}','publisher')" class="publisher" contenteditable="true"> ${item.publisher}</p>
                    &nbsp;<span class="tooltip-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="List the specific course name">
                <i class="fas fa-info-circle" style="cursor: pointer; color: #456fb6;"></i>
                </span>

                </td>
                <td class=" text-center">
                <div style="width: 180px;">
                <span onClick="chooseSemester(${index},'${item.student_id}','fall','sem1')" class="sem1 badge badge-pill ${item.semester.includes("fall") ? 'badge-primary' : 'badge-secondary'}">Fall</span>
                <span onClick="chooseSemester(${index},'${item.student_id}','spring','sem2')" class="sem2 badge badge-pill ${item.semester.includes("spring") ? 'badge-primary' : 'badge-secondary'}">Spring</span>
                <span onClick="chooseSemester(${index},'${item.student_id}','summer','sem3')" class="sem3 badge badge-pill ${item.semester.includes("summer") ? 'badge-primary' : 'badge-secondary'}">Summer</span>
                &nbsp; <span class="tooltip-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="Select which semester(s) this course will be taught. If this course will be taught year-round select all 3 semesters">
                <i class="fas fa-info-circle" style="cursor: pointer; color: #456fb6;"></i>
                </span>
                </div>
                </td> 
                <td class="grade">
                    <div style="display: flex;">
                        <select name="" id="" >
                            <option value="" style="display:none">Grade</option>
                            <option ${item.grade === 'In Progress' ? "selected" : ""} value="In Progress">In Progress</option>
                            <option ${item.grade === "A+" ? "selected" : ""} value="A+">A+</option>
                            <option ${item.grade === 'A' ? "selected" : ""} value="A">A</option>
                            <option ${item.grade === 'A-' ? "selected" : ""} value="A-">A-</option>
                            <option ${item.grade === 'B+' ? "selected" : ""} value="B+">B+</option>
                            <option ${item.grade === 'B' ? "selected" : ""} value="B">B</option>
                            <option ${item.grade === 'B-' ? "selected" : ""} value="B-">B-</option>
                            <option ${item.grade === 'C+' ? "selected" : ""} value="C+">C+</option>
                            <option ${item.grade === 'C' ? "selected" : ""} value="C">C</option>
                            <option ${item.grade === 'C-' ? "selected" : ""} value="C-">C-</option>
                            <option ${item.grade === 'D+' ? "selected" : ""} value="D+">D+</option>
                            <option ${item.grade === 'D' ? "selected" : ""} value="D">D</option>
                            <option ${item.grade === 'D-' ? "selected" : ""} value="D-">D-</option>
                            <option ${item.grade === 'F' ? "selected" : ""} value="F">F</option>
                            <option ${item.grade === 'Pass' ? "selected" : ""} value="Pass">Pass</option>
                            <option ${item.grade === 'Incomplete' ? "selected" : ""} value="Incomplete">Incomplete</option>
                            <option ${item.grade === 'Excellent' ? "selected" : ""} value="Excellent">Excellent</option>
                            <option ${item.grade === 'Satisfactory' ? "selected" : ""} value="Satisfactory">Satisfactory</option>
                            <option ${item.grade === 'Needs Improvement' ? "selected" : ""} value="Needs Improvement">Needs Improvement</option>
                        </select>
                        &nbsp;<span class="tooltip-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="Leave course grade as In Progress. You will be able to assign grades for each course within your parent portal account">
                            <i class="fas fa-info-circle" style="cursor: pointer; color: #456fb6;"></i>
                        </span>
                    </div>
                </td>

                ${!not_show_credit.includes(checkCourseStudentGrade) ? `<td class="credit">
                <div style="display:flex;">
                <input style="min-width: 100px;" type="text" onclick="emptyVal(${index},'${item.student_id}','credit')" value="${item.credit ? item.credit : 'Credit'}"/>
                        &nbsp;
                        <span class="tooltip-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="1 credit = 1 full year of study. 0.5 credit = one semester of study.">
                            <i class="fas fa-info-circle" style="cursor: pointer; color: #456fb6;"></i>
                        </span>
                </div>
                </td>`: `<td class=""></td>`}

                ${show_additional.includes(checkCourseStudentGrade) ? `<td class='additional'>
                <div style="display:flex;">
                <select name="" id="" onchange="chooseAdditional(${index},'${item.student_id}', this.value)">
                    <option ${item.additional === "Standard Course" ? "selected" : ""} value="Standard Course">Standard Course</option>
                    <option ${item.additional === "AP" ? "selected" : ""} value="AP">AP</option>
                    <option ${item.additional === "CLEP" ? "selected" : ""} value="CLEP">CLEP</option>
                    <option ${item.additional === "Dual Enrollment" ? "selected" : ""} value="Dual Enrollment">Dual Enrollment</option>
                    <option ${item.additional === "Honors" ? "selected" : ""} value="Honors">Honors</option>
                    <option ${item.additional === "IB" ? "selected" : ""} value="IB">IB</option>
                </select>&nbsp;<span class="tooltip-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="For all regular/standard high school courses select Standard Course. If this high school course qualifies for AP/CLEP/Dual Enrollment select the appropriate option. Official exam results/transcripts are required to list the course appropriately on the student's transcript.">
                <i class="fas fa-info-circle" style="cursor: pointer; color: #456fb6;"></i>
                </span>
                </div>
                </td>`: `<td class=''></td>`}

                <td class="description">
                    <div style="display:flex;">
                    <input class="mb-2" style="min-width: 120px;" type="text" onclick="emptyVal(${index},'${item.student_id}','description')" value="${item.description ? item.description : 'Description'}"/>
                    &nbsp;<span class="tooltip-icon" data-bs-toggle="tooltip" data-bs-placement="right" title="List the specific book or online course you are utilizing and/or describe how this course will be taught.">
                    <i class="fas fa-info-circle" style="cursor: pointer; color: #456fb6;"></i>
                    </span>
                    </div>
                </td>

                <td class="schedule">
                ${scheduleSlotOptionsHtml(item.schedule)}
                </td>

                <td class="text-center">
                    <span class="dropdownBox">
                        <a class="dropdown-item add_note" href="#courseNotesModal" 
                        data-index="${index}" 
                        data-bs-toggle="modal" 
                        data-bs-target="#courseNotesModal" 
                        onclick="openNoteModal(${index}, '${student_id}')"
                        title="Course Notes">
                            <i class="far fa-sticky-note" style="cursor: pointer;"></i>
                        </a>
                        <a class="dropdown-item delete_course" 
                        href="#delete" 
                        data-index="${index}"
                        data-bs-toggle="tooltip"
                        title="Delete Course"
                        onClick="deleteCourse(${index}, '${student_id}')">
                            <i class="far fa-trash-alt" style="cursor: pointer;"></i>
                        </a>
                        <a class="dropdown-item copy_course" 
                        href="#copy" 
                        data-index="${index}"
                        data-bs-toggle="tooltip"
                        title="Duplicate Course"
                        onclick="cloneCourse(${index}, '${student_id}')">
                            <i class="far fa-clone" style="cursor: pointer;"></i>
                        </a>
                    </span>
                </td>
            </tr>
            `)
        })

        // Initialize Bootstrap 5 tooltips with both hover and click trigger
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(tooltipTriggerEl => {
            new bootstrap.Tooltip(tooltipTriggerEl, {
                trigger: 'hover click',
                html: true
            });
        });

        // Remove any old event listeners from popovers
        $('[data-bs-toggle="popover"]').popover('dispose');
        
        // Initialize any Bootstrap 5 popovers
        const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        popoverTriggerList.forEach(popoverTriggerEl => {
            new bootstrap.Popover(popoverTriggerEl);
        });
        
        // Close popovers when clicking outside
        document.addEventListener('click', function (e) {
            if (!e.target.closest('[data-bs-toggle="popover"]')) {
                const popovers = document.querySelectorAll('.popover');
                popovers.forEach(popover => {
                    bootstrap.Popover.getInstance(popover)?.hide();
                });
            }
        });
    } else {
        $(`#reg_add_course_area_${student_id} tbody`).append('<tr><td colspan="8" class="text-center">No Course Added Yet</td></tr>')
        $('.save_course').css('display', 'none');
    }
}

function chooseSemester(index, student_id, semester, sem) {
    // console.log('index', index);
    // console.log('student_id', student_id);
    // console.log('semester', semester);
    // console.log('sem', sem);
    var all_semester = [];
    if ($(`#reg_add_course_area_${student_id} .${index} .${sem}`).hasClass("badge-primary")) {
        $(`#reg_add_course_area_${student_id} .${index} .${sem}`).removeClass("badge-primary");
        $(`#reg_add_course_area_${student_id} .${index} .${sem}`).addClass("badge-secondary");
    } else if ($(`#reg_add_course_area_${student_id} .${index} .${sem}`).hasClass("badge-secondary")) {
        $(`#reg_add_course_area_${student_id} .${index} .${sem}`).addClass("badge-primary");
        $(`#reg_add_course_area_${student_id} .${index} .${sem}`).removeClass("badge-secondary");
    }
    $(`#reg_add_course_area_${student_id} .${index} .badge-primary`).each(function () {
        all_semester.push($(this).html());
    });

    if (all_semester.indexOf("Fall") > -1) {
        // $(`#reg_add_course_area_${student_id} .${index} .credit select`).val('0.50').trigger('change');
        $(`#reg_add_course_area_${student_id} .${index} .credit input`).val('0.50');
    }
    if (all_semester.indexOf("Spring") > -1) {
        // $(`#reg_add_course_area_${student_id} .${index} .credit select`).val('0.50').trigger('change');
        $(`#reg_add_course_area_${student_id} .${index} .credit input`).val('0.50');
    }
    if (all_semester.indexOf("Summer") > -1) {
        // $(`#reg_add_course_area_${student_id} .${index} .credit select`).val('1.00').trigger('change'); 
        $(`#reg_add_course_area_${student_id} .${index} .credit input`).val('1.00');
    }
    if (all_semester.indexOf("Fall") > -1 && all_semester.indexOf("Spring") > -1) {
        // $(`#reg_add_course_area_${student_id} .${index} .credit select`).val('1.00').trigger('change');
        $(`#reg_add_course_area_${student_id} .${index} .credit input`).val('1.00');
    }
    if (!(all_semester.indexOf("Fall") > -1) && !(all_semester.indexOf("Spring") > -1) && !(all_semester.indexOf("Summer") > -1)) {
        // $(`#reg_add_course_area_${student_id} .${index} .credit select`).val('0.0').trigger('change');
        $(`#reg_add_course_area_${student_id} .${index} .credit input`).val('0.0');
    }
}

function editCourse(index, student_id, student_name, studentGrade) {
    // console.log('course before edit', course);

    student_id = Number(student_id);
    let student_year = $('.year-filter').val();
    // Filter courses for this specific student and specific year
    let student_course = course.filter(c => c.student_id === student_id && c.year === student_year);
    let current_student_course = course.filter(c => c.student_id === student_id);

    // console.log('student_course before edit', student_course);
    // Ensure the student_course array has an object at this index
    if (!student_course[index]) {
        student_course[index] = {};
    }

    let name = $(`#reg_add_course_area_${student_id} .${index} .selectCourse select`).val();
    let publisher = $(`#reg_add_course_area_${student_id} .${index} .publisher`).html();
    let grade = $(`#reg_add_course_area_${student_id} .${index} .grade select`).val();
    // let credit = $(`#reg_add_course_area_${student_id} .${index} .credit select`).val();
    let credit = $(`#reg_add_course_area_${student_id} .${index} .credit input`).val();
    let description = $(`#reg_add_course_area_${student_id} .${index} .description input`).val();
    let additional = $(`#reg_add_course_area_${student_id} .${index} .additional select`).val();
    let schedule = $(`#reg_add_course_area_${student_id} .${index} .schedule select`).val();
    // console.log('student_year', student_year);
    
    var all_semester = [];

    $(`#reg_add_course_area_${student_id} .${index} .badge-primary`).each(function () {
        all_semester.push($(this).html().toLowerCase());
    });

    if (name == 'Custom') {
        $(`#reg_add_course_area_${student_id} .${index} .selectCourse input`).attr('type', 'text')
        name = $(`#reg_add_course_area_${student_id} .${index} .selectCourse input`).val();
    } else {
        $(`#reg_add_course_area_${student_id} .${index} .selectCourse input`).attr('type', 'hidden')
    }

    // Update student_course object properties
    Object.assign(student_course[index], {
        student_id: student_id,
        student_name: student_name,
        studentGrade: studentGrade,
        courseName: name || '',
        publisher: publisher || '',
        semester: all_semester.toString(),
        grade: grade || '', 
        credit: credit || '',
        description: description || '',
        additional: additional || '',
        schedule: schedule || '',
        year: student_year // Keep track of the year for this course
    });

    // console.log('student_course after edit', student_course);
    // Update this student_course in the main course array
    course = current_student_course.filter(c => c.student_id == student_id && c.year !== student_year);
    // console.log('course after filter', course);
    course = course.concat(student_course);

    // console.log('course after edit', course);

    // Auto save course
    autoSaveCourse(student_id);
}

// Auto save course
function autoSaveCourse(student_id) {
    // console.log('course before auto save', course);
    let course_data = [];
    student_id = Number(student_id);
    let student_year = $('.year-filter').val();
    // console.log('student_year', student_year);
    // Filter courses for this specific student
    let student_course = course.filter(c => c.student_id === student_id);
    // console.log('student_course before auto save', student_course);
    student_course.forEach(courseItem => {
        const isEmptyCourse =   !courseItem.student_id &&
                                !courseItem.student_name &&
                                !courseItem.studentGrade &&
                                !courseItem.notes.length &&
                                !courseItem.courseName && 
                                !courseItem.publisher &&
                                !courseItem.semester &&
                                !courseItem.grade &&
                                !courseItem.credit &&
                                !courseItem.description &&
                                !courseItem.additional &&
                                !courseItem.schedule;
                                
        if (!isEmptyCourse) {
            course_data.push({
                student_id: courseItem.student_id || '',
                student_name: courseItem.student_name || '',
                studentGrade: courseItem.studentGrade || '',
                courseName: courseItem.courseName || '',
                publisher: courseItem.publisher ? courseItem.publisher : '',
                semester: courseItem.semester || '',
                grade: courseItem.grade || '',
                credit: courseItem.credit || '',
                description: courseItem.description || '', 
                additional: courseItem.additional || '',
                schedule: courseItem.schedule || '',
                year: courseItem.year || student_year,
                notes: courseItem.notes || []
            });
        }
    });

    // console.log('course_data before ajax call:', course_data);
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'save_student_course_by_admin',
            'student_id': student_id,
            'student_course': JSON.stringify(course_data),
        },
        success: function (response) {
            if (response.success) {
                // swal("", "Course Updated Successfully!", "success");
                // location.reload();
            } else {
                // swal("", "Sorry, Something went wrong!", "error");
            }
        }
    });
}


function deleteCourse(index , student_id) {
    swal({
        text: "Delete this course?",
        icon: "warning", 
        buttons: {
            cancel: "Cancel",
            confirm: {
                text: "Delete",
                value: true,
                className: "swal-button--danger"
            }
        }
    }).then((willDelete) => {
        if (willDelete) {
            $(`#reg_add_course_area_${student_id} .${index}`).remove();
            // console.log('course before delete', course);
            student_year = $('.year-filter').val();
            student_id = Number(student_id);
            // console.log('student_id', student_id);
            // console.log('index:', index);
            // filter all courses for this specific student
            let total_course = course.filter(c => c.student_id === student_id);
            // Filter courses for this specific student for selected year
            let student_course = course.filter(c => c.student_id === student_id && c.year === student_year);

            // Remove item from array 
            student_course.splice(index, 1);

            // console.log("Student Course after delete:", student_course);
            total_course = total_course.filter(c => c.year !== student_year);
            total_course = total_course.concat(student_course);
            // update this student_course in the main course array
            course = course.filter(c => c.student_id !== student_id);
            course = course.concat(total_course);
            // console.log("Total Course:", total_course);
            // console.log('course after delete', course);
            // Re-render course list
            // renderCourse();

            // save the course 
            saveCourse(student_id);

        }
        else {
            return false;
        }
    });
}

function emptyVal(id, student_id, clas) {
    // // console.log('student_id', student_id);
    // // console.log('html', $(`#reg_add_course_area_${student_id} .${id} .${clas}`).html());
    if (clas == 'publisher') {
        if ($(`#reg_add_course_area_${student_id} .${id} .${clas}`).html() == ' Book Publisher/Online Course') {
            $(`#reg_add_course_area_${student_id} .${id} .${clas}`).html('');
        }
    }

    if (clas == 'description') {
        if ($(`#reg_add_course_area_${student_id} .${id} .${clas} input`).val() == 'Description') {
            $(`#reg_add_course_area_${student_id} .${id} .${clas} input`).val('');
        }
    }

    if (clas == 'credit') {
        if ($(`#reg_add_course_area_${student_id} .${id} .${clas} input`).val() == 'Credit') {
            $(`#reg_add_course_area_${student_id} .${id} .${clas} input`).val('');
        }
    }
}

function cloneCourse(index , student_id) {
    // console.log('course before clone', course);
    student_year = $('.year-filter').val();
    // console.log('student_year', student_year);
    student_id = Number(student_id);
    // console.log('student_id', student_id);
    // Filter courses for this specific student
    let student_course = course.filter(c => c.student_id === student_id && c.year === student_year);
    const originalItem = student_course[index];
    if (!originalItem) return;
    const newItem = JSON.parse(JSON.stringify(originalItem));
    course.push(newItem);
    // console.log('course after clone', course);
    $(`#reg_add_course_area_${student_id}  tbody tr`).remove();
    renderCourse(student_id);
}


function chooseAdditional(index, student_id, value) {
    if (value == "Honors"){
        $(`#reg_add_course_area_${student_id} .${index} .credit input`).val('0.50');
    } else if (value == "AP" || value == "IB" || value == "Dual Enrollment") {
        $(`#reg_add_course_area_${student_id} .${index} .credit input`).val('1.00');
    } else {
        $(`#reg_add_course_area_${student_id} .${index} .credit input`).val('0.00');
    }
}


function openNoteModal(idx, student_id) {
    // console.log("course == >", course[idx]);

    student_year = $('.year-filter').val();
    // console.log('student_year', student_year);
    student_id = Number(student_id);
    // console.log('student_id', student_id);
    // Filter courses for this specific student
    let student_course = course.filter(c => c.student_id === student_id && c.year === student_year);

    // console.log('student_course ==>', student_course);

    // Show modal with any existing notes
    $('#courseNotesModal').modal('show');

    // Add Course index to modal
    $('#note_course_id').val(idx);

    // Add Student ID to modal
    $('#note_student_id').val(student_id);

    // Clear existing notes display
    $('#existingNotes').empty();

    // Initialize notes array if it doesn't exist
    if (!student_course[idx].notes) {
        student_course[idx].notes = [];
    }

    // Display existing notes if any
    if (student_course[idx].notes && student_course[idx].notes.length > 0) {
        student_course[idx].notes.forEach((noteItem, i) => {
        let noteHtml = `
        <div class="list-group-item border-0 rounded-3 shadow-sm mb-3 overflow-hidden">
            <div class="row g-0">
            <div class="col-md-12">
                <div class="text-end">
                <small class="text-muted">
                    <i class="far fa-clock me-1"></i>
                    ${new Date(noteItem.dateAdded).toLocaleString('en-US', { 
                    month: '2-digit',
                    day: '2-digit', 
                    year: 'numeric',
                    }).replace(',', '')}
                </small>
                </div>
                
                <div class="note-content p-3 bg-light border-bottom"> 
                <p class="text-bold">Course Note: </p>
                ${noteItem.note ? 
                    `<p class="mb-0 text-dark">${noteItem.note}</p>` : 
                    '<div class="text-muted fst-italic">No note content</div>'
                }
                </div>

                <div class="note-attachment p-3 bg-light border-top">
                Attachment:<br>
                ${noteItem.file ? 
                    (() => {
                    // Get WordPress site URL from ajax_object if available, or fallback to window.location.origin
                    const siteUrl = (typeof ajax_object !== 'undefined' && ajax_object.site_url) 
                        ? ajax_object.site_url 
                        : window.location.origin;

                    // Ensure URL is absolute and uses HTTPS
                    const fileUrl = noteItem.file.startsWith('http')
                        ? noteItem.file.replace('http://', 'https://')
                        : siteUrl + noteItem.file;
                    // console.log('fileUrl:', fileUrl);
                    const ext = fileUrl.split('.').pop().toLowerCase();
                    if(['jpg','jpeg','png'].includes(ext)) {
                        return `
                        <div class="text-center">
                        <img src="${fileUrl}" class="img-fluid mb-2" style="max-height: 200px">
                        <br>
                        <button class="btn btn-sm" style="background-color: #456fb6; color: white"  
                           onclick="downloadFile('${fileUrl}', '${ext}')">
                            <i class="fas fa-download me-1"></i>Download Image
                        </button>
                        </div>`;
                    }
                    else if(ext === 'pdf') {
                        return `
                        <div class="text-center">
                            <div class="pdf-container" style="width: 100%; height: 200px; ">
                                <object 
                                    data="${fileUrl}#toolbar=0&navpanes=0"
                                    type="application/pdf"
                                    style="width: 100%; height: 100%;"
                                >
                                    <div class="fallback">
                                        <p>Unable to display PDF file. <a href="${fileUrl}" target="_blank">Click here to view it</a></p>
                                    </div>
                                </object>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-sm" style="background-color: #456fb6; color: white" 
                                    onclick="downloadFile('${fileUrl}', 'pdf')">
                                    <i class="fas fa-download me-1"></i>Download PDF
                                </button>
                            </div>
                        </div>`;
                    }
                    else if(['doc','docx'].includes(ext)) {
                        return `
                        <div class="text-center">
                        <i class="fas fa-file-word fa-3x mb-2" style="color: #456fb6">
                         <p style="font-size: medium;">Word documents cannot be previewed directly. Please use the download button to view this file.</p></i>
                        <br>
                        <button class="btn btn-sm" style="background-color: #456fb6; color: white" 
                           onclick="downloadFile('${fileUrl}', '${ext}')">
                            <i class="fas fa-download me-1"></i>Download Document
                        </button>
                        </div>`;
                    }
                    else {
                        return `
                        <button class="btn btn-sm" style="background-color: #456fb6; color: white" 
                           onclick="downloadFile('${fileUrl}', '${ext}')">
                        <i class="fas fa-download me-1"></i>Download Attachment
                        </button>`;
                    }
                    })() : 
                    '<div class="text-muted text-center">' +
                    '<i class="fas fa-info-circle me-1"></i>' +
                    'No file attached' +
                    '</div>'
                }
                </div>
            </div>
            </div>
        </div>
        `;
        $('#existingNotes').append(noteHtml);
        });
    } else {
        $('#existingNotes').append('<div class="list-group-item text-center">No notes added yet</div>');
    }
}

// Download file
function downloadFile(url, ext) {
    const a = document.createElement('a');
    a.href = url;
    a.download = `attachment.${ext}`;
    a.target = '_blank';
    a.click();
}


// Handle Note Form Submission
$('#addNoteForm').on('submit', function(e) {
    e.preventDefault();

    // // console.log('course before note added', course);
    // Get form data
    let currentStudentId = $('#note_student_id').val();
    // // console.log('currentStudentId', currentStudentId);
    let currentNoteIndex = $('#note_course_id').val();
    const noteText = $(this).find('textarea[name="note"]').val();
    const fileInput = $(this).find('input[type="file"]')[0];
    const file = fileInput.files[0];

    currentStudentId = Number(currentStudentId);
    currentNoteIndex = Number(currentNoteIndex);

    student_year = $('.year-filter').val();
    // console.log('student_year', student_year);
    // Filter courses for this specific student
    let student_course = course.filter(c => c.student_id === currentStudentId && c.year === student_year);
    // console.log('student_course', student_course);

    // Handle file upload to WordPress media library
    if (file) {
        let formData = new FormData();
        formData.append('file', file);
        formData.append('action', 'ajax_handle_fileUpload');

        // Make AJAX call to upload file
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    // Store the media URL returned from WordPress
                    fileUrl = response.data.media_url;

                        // Create new note object
                    const newNote = {
                        note: noteText,
                        file: fileUrl ? fileUrl : null,
                        dateAdded: new Date().toISOString()
                    };

                    // // console.log("student_course before note added == >", student_course[currentNoteIndex]);
                    // Add note to student_course notes array
                    student_course[currentNoteIndex].notes.push(newNote);

                    let current_course = course.filter(c => c.student_id === currentStudentId && c.year !== student_year);
                    // console.log('student_course after filter', current_course);

                    // Update this student_course in the main course array
                    student_course = current_course.concat(student_course);


                    // Update course object in database
                    $.ajax({
                        type: 'POST',
                        url: ajax_object.ajax_url,
                        data: {
                            'action': 'save_student_course_by_admin',
                            'student_id': currentStudentId,
                            'student_course': JSON.stringify(student_course),
                        },
                        success: function (response) {
                            if (response.success) {
                                swal("", "Note added successfully!", "success");
                                // Clear form
                                $(this).find('textarea[name="note"]').val('');
                                fileInput.value = '';


                                // update this student_course in the main course array
                                course = course.filter(c => c.student_id !== currentStudentId);
                                course = course.concat(student_course);

                                // // console.log("student_course after note added== >", student_course[currentNoteIndex]);
                                // // console.log('course after note added', course);


                                // Refresh notes display
                                $('#existingNotes').empty();
                                
                                // Display existing notes if any
                                openNoteModal(currentNoteIndex, currentStudentId);

                                // Close modal
                                $('#courseNotesModal').modal('hide');
                                
                                // Reset form
                                $(this).trigger('reset');
                            } else {
                                swal("", "Sorry, Something went wrong!", "error");
                            }
                        }
                    });

                } else {
                    swal("", "File upload failed!", "error");
                    fileUrl = null;
                }
            },
            error: function() {
                swal("", "File upload failed!", "error");
                fileUrl = null;
            }
        });
    }
});

// Handle Note Modal Close
$('#courseNotesModal').on('hidden.bs.modal', function () {
    // Clear the form
    $('#addNoteForm').trigger('reset');

    // Clear existing notes display
    $('#existingNotes').empty();

    // Collapse the notes section
    $('#viewNotesSection').removeClass('show');
});