jQuery(document).ready(function($){

    // console.log('renewal_expire_function_ajax.js loaded');

    // set students options in model
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            action: 'get_students_renewal_data'
        },
        success: function(response){
        //   console.log(response);

          $('#expiry-date').html(
            `<i class="fas fa-exclamation-triangle me-2"></i>
            Expired on: <strong>${response.data.registration_data.account_expire}</strong>`
          )

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