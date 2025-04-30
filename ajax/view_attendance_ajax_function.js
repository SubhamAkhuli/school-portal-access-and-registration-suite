// jQuery is already loaded in WordPress, so we can use it directly
let total_attendance_data = [];
let student_attendance = [];
let student_data = [];

// handle the student_attendance_create modal
jQuery(document).ready(function($) {

    // form url get parameter
    const urlParams = new URLSearchParams(window.location.search);
    const studentId = urlParams.get('sid');
    // Show the attendance data in the table 
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'get_student_attendance_data',
        },
        success: function(response) {
            if(response.success){
                total_attendance_data = response.data;

                if (studentId) {
                    // Only process data for the specific student
                    student_data = total_attendance_data.find(student => student.student_id == studentId);
                    if (student_data) {
                        student_data = [student_data]; // Convert to array
                    }
                }
                else {
                    student_data = total_attendance_data;
                }

                if (student_data) {
                    // First create badges for all students
                    const studentBadgesContainer = $("<div>", {
                        class: "student-badges d-flex flex-wrap gap-2 mb-3"
                    });

                    student_data.forEach(student => {
                        const fullName = student.student_name;
                        const badge = $("<span>", {
                            class: "badge student-badge p-2",
                            style: "cursor: pointer; background-color: #6c757d; color: white; padding: 8px; font-size: 14px;",
                            "data-student-id": student.student_id,
                            html: `${fullName}`
                        });
                        studentBadgesContainer.append(badge);
                    });

                    // Add badges to student-names div
                    $(".student-names").html(studentBadgesContainer);

                    // Initially hide the container
                    $("#student_attendance_container").empty();

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

                        // Filter and display selected student's attendance
                        const selectedStudent = student_data.find(s => s.student_id == selectedStudentId);
                        if (selectedStudent) {
                            const studentCard = createStudentCard(selectedStudent);
                            $("#student_attendance_container").html(studentCard);
                            
                            // Initialize DataTable after the table is added to the DOM
                            if($.fn.DataTable) {
                                $('.attendance-table table').DataTable({
                                    responsive: true,
                                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                                    pageLength: 10,
                                    dom: '<"d-flex justify-content-between align-items-center mb-3"lf>' +
                                         '<"row"<"col-sm-12"tr>>' +
                                         '<"row align-items-center"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                                    language: {
                                        search: "_INPUT_",
                                        searchPlaceholder: "Search Attendance...",
                                        lengthMenu: "_MENU_ records per page",
                                        info: "Showing _START_ to _END_ of _TOTAL_ attendance records",
                                        paginate: {
                                            first: '<i class="fas fa-angle-double-left"></i>',
                                            last: '<i class="fas fa-angle-double-right"></i>',
                                            next: '<i class="fas fa-angle-right"></i>',
                                            previous: '<i class="fas fa-angle-left"></i>'
                                        }
                                    },
                                    columnDefs: [
                                        { orderable: true, targets: [0, 4] },
                                        { orderable: false, targets: [5] },
                                        { className: "align-middle", targets: "_all" }
                                    ],
                                    order: [[0, 'desc']], // Sort by year
                                    autoWidth: false,
                                    drawCallback: function() {
                                        $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                                        $('.attendance-table thead th').css({
                                            'background-color': '#bc9f5e',
                                            'color': 'white'
                                        });
                                    },
                                    stateSave: true,
                                    processing: true,
                                    scrollCollapse: true,
                                    initComplete: function() {
                                        $('.dataTables_filter input').addClass('form-control');
                                        $('.dataTables_length select').addClass('form-select form-select-sm').css({
                                            'min-width': '50px',
                                            'width': 'auto'
                                        });
                                        $('.attendance-table thead th').css({
                                            'background-color': '#bc9f5e',
                                            'color': 'white'
                                        });
                                    }
                                });
                            }
                        }
                    });

                    // Automatically click first badge if data exists
                    if(student_data.length > 0) {
                        $(".student-badge").first().click();
                    }
                } else {
                    $("#student_attendance_container").html('<div class="alert alert-danger text-center">No attendance records found!</div>');
                }
            } else {
                swal('Error', response.data.message, 'error');
            }
        },
        error: function() {
            swal('Error', 'An unexpected error occurred.', 'error');
        }
    });

    // handle the create modal
    $('#student_attendance_create').on('click', function (e) {
    e.preventDefault();
    
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'action': 'add_student_attendance',
                // 'registration_id': rid,
                'student_id': $('#student_id').val(),
                'registration_id': $('#registration_id').val(),
                'student_attendance_year': $('#student_attendance_year').val(),
                'semester_1': $('#semester_1').val(),
                'semester_2': $('#semester_2').val(),
                'semester_3': $('#semester_3').val(),
            },
            success: function(response) {
                // console.log(response);
                if(response.success){
                    const modal = bootstrap.Modal.getInstance(document.querySelector('#add-attendance'));
                    modal.hide();
                    swal('Success', 'Student attendance created successfully!', 'success').then(function() {
                        // $('#add-attendance').modal('hide');
                        // location.reload();
                        const studentId = $('#student_id').val();
                        // Refresh the student attendance data
                        refreshStudentAttendance(studentId);
                    });
                } else {
                    swal('Error', response.data.message, 'error');
                }
            },
            error: function() {
                swal('Error', 'An unexpected error occurred.', 'error');
            }
        });
    });

    // Set modal data for editing
    const editAttendanceModal = new bootstrap.Modal(document.getElementById('edit-attendance'));
    editAttendanceModal._element.addEventListener('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        // console.log('Button:', button);
        
        // Get data directly from button attributes
        const attendanceId = button.data('attendance-id');
        const studentId = button.data('student-id');
        const year = button.data('year');
        const fall = button.data('fall');
        const spring = button.data('spring');
        const summer = button.data('summer');

        // Set values in the form
        $('#edit_attendance_id').val(attendanceId);
        $('#edit_student_id').val(studentId);
        $('#edit_student_attendance_year').html(`<option value="${year}">${year}</option>`);
        $('#edit_semester_1').val(fall);
        $('#edit_semester_2').val(spring);
        $('#edit_semester_3').val(summer);
    });
 
    // handle the edit modal
    $('#student_attendance_edit').on('click', function (e) {
        e.preventDefault();
        
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'action': 'update_student_attendance',
                'attendance_id': $('#edit_attendance_id').val(),
                'student_attendance_year': $('#edit_student_attendance_year').val(),
                'semester_1': $('#edit_semester_1').val(),
                'semester_2': $('#edit_semester_2').val(),
                'semester_3': $('#edit_semester_3').val(),
            },
            success: function(response) {
                // console.log(response);
                if(response.success){
                    const modal = bootstrap.Modal.getInstance(document.querySelector('#edit-attendance'));
                    modal.hide();
                    swal('Success', 'Student attendance updated successfully!', 'success').then(function() {
                        // $('#edit-attendance').modal('hide');
                        // location.reload();
                        const studentId = $('#edit_student_id').val();
                        // Refresh the student attendance data
                        refreshStudentAttendance(studentId);
                    });
                } else {
                    swal('Error', response.data.message, 'error');
                }
            },
            error: function() {
                swal('Error', 'An unexpected error occurred.', 'error');
            }
        });
    });
});

// Show the add attendance modal
function showAddModal(student_id, registration_id) {
    $('#student_id').val(student_id);
    $('#registration_id').val(registration_id);
}

// Delete the attendance record
function deleteAttendance(attendance_id, student_id) {
    swal({
        title: 'Are you sure?',
        text: 'Once deleted, you will not be able to recover this record!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if(willDelete) {
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    'action': 'delete_student_attendance',
                    'attendance_id': attendance_id,
                },
                success: function(response) {
                    if(response.success){
                        swal('Success', 'Attendance record deleted successfully!', 'success').then(function() {

                            // location.reload();
                            // Refresh the student attendance data
                            refreshStudentAttendance(student_id);
                        });
                    } else {
                        swal('Error', response.data.message, 'error');
                    }
                },
                error: function() {
                    swal('Error', 'An unexpected error occurred.', 'error');
                }
            });
        }
    });
}

// Refresh the student attendance data
function refreshStudentAttendance(studentId) {
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'get_student_attendance_data',
        },
        success: function(response) {
            if(response.success){
                total_attendance_data = response.data;
                
                // Find the specific student data
                const specificStudent = total_attendance_data.find(student => student.student_id == studentId);
                
                if (specificStudent) {
                    // Update the student card with the refreshed data
                    const studentCard = createStudentCard(specificStudent);
                    $("#student_attendance_container").html(studentCard);
                    
                    // Update the selected badge style
                    $(".student-badge").each(function() {
                        const badgeStudentId = $(this).data("student-id");
                        if (badgeStudentId == studentId) {
                            $(this).css({
                                'background-color': '#456fb6',
                                'color': 'white',
                                'transition': 'all 0.3s ease'
                            });
                        } else {
                            $(this).css({
                                'background-color': '#6c757d',
                                'color': 'white'
                            });
                        }
                    });
                    
                    // Reinitialize DataTable for the updated content
                    if($.fn.DataTable) {
                        // Destroy existing DataTable instance if it exists
                        if ($.fn.DataTable.isDataTable('.attendance-table table')) {
                            $('.attendance-table table').DataTable().destroy();
                        }
                        
                        // Only initialize DataTable if there are records to show
                        if(specificStudent.attendance.length > 0) {
                            // Initialize new DataTable
                            $('.attendance-table table').DataTable({
                                responsive: true,
                                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                                pageLength: 10,
                                dom: '<"d-flex justify-content-between align-items-center mb-3"lf>' +
                                    '<"row"<"col-sm-12"tr>>' +
                                    '<"row align-items-center"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                                language: {
                                    search: "_INPUT_",
                                    searchPlaceholder: "Search Attendance...",
                                    lengthMenu: "_MENU_ records per page",
                                    info: "Showing _START_ to _END_ of _TOTAL_ attendance records",
                                    paginate: {
                                        first: '<i class="fas fa-angle-double-left"></i>',
                                        last: '<i class="fas fa-angle-double-right"></i>',
                                        next: '<i class="fas fa-angle-right"></i>',
                                        previous: '<i class="fas fa-angle-left"></i>'
                                    }
                                },
                                columnDefs: [
                                    { orderable: true, targets: [0, 4] },
                                    { orderable: false, targets: [5] },
                                    { className: "align-middle", targets: "_all" }
                                ],
                                order: [[0, 'desc']], // Sort by year
                                autoWidth: false,
                                drawCallback: function() {
                                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                                    $('.attendance-table thead th').css({
                                        'background-color': '#bc9f5e',
                                        'color': 'white'
                                    });
                                },
                                stateSave: true,
                                processing: true,
                                scrollCollapse: true,
                                initComplete: function() {
                                    $('.dataTables_filter input').addClass('form-control');
                                    $('.dataTables_length select').addClass('form-select form-select-sm').css({
                                        'min-width': '50px',
                                        'width': 'auto'
                                    });
                                    $('.attendance-table thead th').css({
                                        'background-color': '#bc9f5e',
                                        'color': 'white'
                                    });
                                }
                            });
                        }
                    }
                } else {
                    $("#student_attendance_container").html('<div class="alert alert-danger text-center">No attendance records found!</div>');
                }
            } else {
                swal('Error', response.data.message, 'error');
            }
        },
        error: function() {
            swal('Error', 'An unexpected error occurred.', 'error');
        }
    });
}

// Helper function to create student card
function createStudentCard(student) {
    const fullName = student.student_name;
    const student_id = student.student_id;
    const registration_id = student.registration_id;

    return `
    <div class="card shadow-sm rounded-3 p-4 mt-3" id="student-card_${student_id}">
        <div class="d-flex align-items-center gap-4 flex-wrap mb-3">
            <div class="d-flex align-items-center gap-3">
                <div class="user student-image position-relative" id="student-photo_${student_id}">
                    <img src="${student.student_picture}" alt="${fullName}" 
                            class="rounded-circle" 
                            style="width: 70px; height: 70px; object-fit: cover;">
                </div>
                <h4 id="student-name_${student_id}" class="mb-0 fw-bold " style="color: #456fb6;">${fullName}</h4>
            </div>
            <div class="ms-auto">
                <button class="btn btn-primary rounded-pill px-4 py-2 shadow-sm" 
                        data-bs-toggle="modal" data-bs-target="#add-attendance" 
                        onclick="showAddModal('${student_id}', '${registration_id}')">
                    <i class="fa-solid fa-plus me-2"></i>Add Attendance
                </button>
            </div>
        </div>
        <div class="attendance-table mt-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center fw-bold">Year</th>
                            <th class="text-center fw-bold">Fall</th>
                            <th class="text-center fw-bold">Spring</th>
                            <th class="text-center fw-bold">Summer</th>
                            <th class="text-center fw-bold">Year Total</th>
                            <th class="text-center fw-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${student.attendance.map(record => {
                            const total = parseInt(record.fall_semester) + 
                                        parseInt(record.spring_semester) + 
                                        parseInt(record.summer_semester);
                            return `
                                <tr>
                                    <td class="text-center fw-semibold">${record.year}</td>
                                    <td class="text-center">${record.fall_semester} days</td>
                                    <td class="text-center">${record.spring_semester} days</td>
                                    <td class="text-center">${record.summer_semester} days</td>
                                    <td class="text-center fw-bold " style="color: #456fb6;">${total} days</td>
                                    <td class="text-center">
                                        <button class="btn btn-light btn-sm rounded-pill me-2" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#edit-attendance" 
                                                data-attendance-id="${record.id}"
                                                data-student-id="${student_id}"
                                                data-year="${record.year}"
                                                data-fall="${record.fall_semester}"
                                                data-spring="${record.spring_semester}"
                                                data-summer="${record.summer_semester}">
                                            <i class="fas fa-edit " style="color: #456fb6;"></i>
                                        </button>
                                        <button class="btn btn-light btn-sm rounded-pill" 
                                                onclick="deleteAttendance(${record.id}, ${student_id})">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        }).join('')}
                        ${student.attendance.length === 0 ? `
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-calendar-times fs-4 mb-3 d-block"></i>
                                    No attendance records found
                                </td>
                            </tr>` : ''}
                    </tbody>
                </table>
            </div> 
        </div>
    </div>`;
}
