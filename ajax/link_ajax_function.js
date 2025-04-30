jQuery(document).ready(function($){

    // set students options in model
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            action: 'get_students_data'
        },
        success: function(response){
        //   console.log(response);
          // Filter students in 11th or 12th grade only
          let graduateStudentData = response.data.student_data.filter(student => 
             (student.grade === '10TH GRADE' || student.grade === '11TH GRADE' || student.grade === '12TH GRADE') && student.graduation_status === 'NOT GRADUATED'
          );
        //   console.log(graduateStudentData);
          // set student list for graduation modal
          $('.student-graduate-list').html('');
          if (graduateStudentData.length == 0) {
            $('.student-graduate-list').append(`
                <div class="student-item text-center mb-3"> 
                    <div>
                        <h6 class="mb-0">No students eligible for graduation</h6>
                        <small>Students must be in 10th, 11th, or 12th grade to apply for graduation</small>
                    </div>
                </div>
            `);
            // disable apply for graduation button
            $('#applyForGraduation').prop('disabled', true);
            } else {
                graduateStudentData.forEach(student => {
                    $('.student-graduate-list').append(`
                        <div class="student-item d-flex align-items-center mb-3">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="studentSelect" value="${student.id}" id="student${student.id}">
                            </div>
                            <img src="${student.student_profile_pic}" class="rounded-circle me-3" style="width: 50px; height: 50px; border: 2px solid #456fb6;">
                            <label class="form-check-label" for="student${student.id}">
                                <div>
                                    <h6 class="mb-0">${student.student_name}</h6>
                                    <small>Grade: ${student.grade}</small>
                                </div>
                            </label>
                        </div>
                    `);
                });
            }

            // Set student list for renewal modal
            // $('.student-renew-list').html('');
            // if (response.data.student_data.length === 0) {
            //     $('.student-renew-list').append(`
            //         <div class="student-item text-center mb-3"> 
            //             <div>
            //                 <h6 class="mb-0">No students available for renewal</h6>
            //                 <small>There are no registered students in the system</small>
            //             </div>
            //         </div>
            //     `);
            //     // disable renew registration button
            //     $('#renewRegistration').prop('disabled', true);
            // } else {
            //     response.data.student_data.forEach(student => {
            //         $('.student-renew-list').append(`
            //             <div class="student-item d-flex align-items-center mb-3">
            //                 <div class="form-check me-3">
            //                     <input class="form-check-input" type="radio" name="renewSelection" value="${student.id}" id="renewStudent${student.id}">
            //                 </div>
            //                 <img src="${student.student_profile_pic}" class="rounded-circle me-3" style="width: 50px; height: 50px; border: 2px solid #456fb6;">
            //                 <label class="form-check-label" for="renewStudent${student.id}">
            //                     <div>
            //                         <h6 class="mb-0">${student.student_name}</h6>
            //                         <small>Grade: ${student.grade}</small>
            //                     </div>
            //                 </label>
            //             </div>
            //         `);
            //     });
            // }
        }   
    });
});

// apply for gradute modal
function applyForGraduation(){
    let studentId = $('input[name="studentSelect"]:checked').val();
    if(studentId){
        // redirect to apply for graduation page
        window.location.href = '/apply-to-graduate/?sid=' + studentId;
    }else{
        swal("Please select a student to apply for graduation", {
            icon: "error",
        });   
    }
}

//Apply for renew Modal
// function renewRegistration(){
//     let studentId = $('input[name="renewSelection"]:checked').val();
//     if(studentId){
//         // redirect to apply for graduation page
//         window.location.href = '/student-renewal/?sid=' + studentId;
//     }else{
//         swal("Please select a student to renew registration", {
//             icon: "error",
//         });   
//     } 
// }