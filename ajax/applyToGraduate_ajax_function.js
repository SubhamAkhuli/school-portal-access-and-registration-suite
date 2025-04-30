let student_id = '';
let student_name = '';
let graduate_price = 0;
let old_student_graduate_price = 0;
let new_student_graduate_price = 0;
let transactionItems = [];

$(document).ready(function () {
     // form url get parameter
     const urlParams = new URLSearchParams(window.location.search);
     const studentId = urlParams.get('sid');  

    if (!studentId) {
        $('.dashboard-content-one').html('<div class="alert alert-danger text-center">No Student Found</div>');
        return;
    }
 
    // Get Student data
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'ajax_handle_get_student_details',
            'student_id': studentId
        },
        success: function (response) {
            // console.log(response);
            // console.log(response.data.parent_email);
            // let data = JSON.parse(response);
            old_student_graduate_price = response.data.fee_data.old_student_graduate_price;
            // console.log(old_student_graduate_price);
            new_student_graduate_price = response.data.fee_data.new_student_graduate_price;
            // console.log(new_student_graduate_price);
            if (response.success) {
                let student = response.data.student;
                // console.log(student);
                student_id = student.id;
                student_name = student.first_name + ' ' + student.middle_name + ' ' + student.last_name;
                let student_grade = student.grade;

                // add Parent Email
                $('#parent_email').val(response.data.parent_email);

                // Add Student ID to
                $('#student_id').val(student_id);

                // Update student profile display
                $('#studentNameDisplay').html(`<i class="fas fa-graduation-cap me-2"></i>${student_name}`);
                $('#studentGradeDisplay').text(student_grade);

                // Set student photo if available
                if (student.student_profile_pic) {
                    $('#studentProfileImage').attr('src', student.student_profile_pic);
                }

                // Set student Graduate data
                let graduate_data = response.data.graduate_data;
                if (graduate_data.length > 0){
                    // console.log(graduate_data);
                    let graduateData = JSON.parse(graduate_data[0].graduate_data);
                    let questions = graduateData.questions;

                    // Pre-select the answered options
                    $('#studentAgeSelect').val(questions.q1.ans);
                    $('#courseWorkSelect').val(questions.q2.ans);
                    $('#enrollmentSelect').val(questions.q5.ans);

                    // Set checkboxes
                    if (questions.q3.ans) {
                        $('.check1').prop('checked', true);
                    }
                    if (questions.q4.ans) {
                        $('.check2').prop('checked', true);
                    }

                    // Update graduate price based on enrollment answer
                    if (questions.q5.ans === 'yes') {
                        graduate_price = old_student_graduate_price;
                    } else {
                        graduate_price = new_student_graduate_price;
                    }

                    // Disable form fields as they're already submitted
                    // $('#studentAgeSelect, #courseWorkSelect, #enrollmentSelect').prop('disabled', true);
                    // $('.check1, .check2').prop('disabled', true);

                    // Add a note that this application is already submitted
                    // $('.step1').prepend('<div class="alert alert-info alert-dismissible fade show">' +
                    //     'This graduation application has already been submitted. Status: ' + graduate_data[0].status +
                    //     '<button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    //     '</div>');
                } 
            } else {
                $('.dashboard-content-one').html('<div class="alert alert-danger text-center">No Student Found</div>');
            }
        }
    });

    // Back to Step-1
    $('.back_step1').click(function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        $('.step2').addClass('hide');
        $('.step1').removeClass('hide');
    })

    let graduate_data = {};

    $('.next_to_graduate_form').click(function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        $('.step1').addClass('hide');
        $('.step2').removeClass('hide');
    })


    $('.next_to_graduate_payment').click(function () {

        let localStudentId = student_id;
        let localStudentName = student_name;
        let ans1 = $('#studentAgeSelect').val();
        let ans2 = $('#courseWorkSelect').val();
        let ans3 = $('#enrollmentSelect').val();
        let check1 = $('.check1').is(":checked");
        let check2 = $('.check2').is(":checked");
        // graduate_price = 125;

        graduate_data = {
            student_id: localStudentId,
            student_name: localStudentName,
            questions: {
                q1: {
                    q: 'Is the student 15 years of age or older?',
                    ans:ans1
                },
                q2: {
                    q: 'Has the student completed 22 hours of High School coursework as required by the state of Tennessee to graduate? All Grades Must be Reported Before Applying to Graduate',
                    ans:ans2
                },
                q3: {
                    q: 'Please select if this student requires a Modified Diploma or Certificate of Completion. (Special Needs Students)',
                    ans:check1
                },
                q4: {
                    q: 'Please select if you would like to allow us to make minor change to the transcript to fix potential errors Or issues.',
                    ans:check2
                },
                q5: {
                    q: 'Has the student been enrolled with us since the 9th grade or before? If Yes, the Graduation Fee is $50, if No (10th grade or higher) the fee iS $125.',
                    ans:ans3
                }
            },
        }

        if(ans1 == '-1'|| ans2 == '-1'|| ans3 == '-1'){
            swal("", "Please Select Option", "error");
            return false;
        }
        
        if(ans3 == 'yes'){
            graduate_price = old_student_graduate_price; 
        } else {
            graduate_price = new_student_graduate_price; 
        }
        // console.log(graduate_data);

        appendTrasactionItems('Graduation Application Fee', 1, graduate_price);

        // save Graduate data
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'action': 'ajax_handle_save_graduate_data',
                'student_id': student_id,
                'student_name': student_name,
                'graduate_data': JSON.stringify(graduate_data)
            },
            success: function (response) {
                // console.log(response);
                if (response.success) {
                    // console.log(response.data);
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    $('.step2').addClass('hide');
                    $('.step3').removeClass('hide');

                    // Add graduation amount row
                    $('.graduationAmount').html(``);
                    
                    // For desktop view (table)
                    if ($('.table tbody tr:contains("Graduation Application Fee")').length === 0) {
                        $('.table tbody').prepend(` 
                            <tr>
                                <td>Graduation Application Fee</td>
                                <td>${student_name}</td>
                                <td>$${graduate_price}.00</td>
                                <td>$${graduate_price}.00</td>
                            </tr>
                        `);
                    } else {
                        // Update existing row if it already exists
                        $('.table tbody tr:contains("Graduation Application Fee")').html(`
                            <td>Graduation Application Fee</td>
                            <td>${student_name}</td>
                            <td>$${graduate_price}.00</td>
                            <td>$${graduate_price}.00</td>
                        `);
                    }

                    // For mobile view (list)
                    $('.graduationAmount').html(`$${graduate_price}.00`);
                    
                    // Set form values
                    $('#student_id').val(`${student_id}`);
                    $('#data').val(`${JSON.stringify(graduate_data)}`);

                    // Update total amount displays
                    $('.totalAmount').html(`$${graduate_price}.00`);

                    // set Coupon Code Amount
                    $('#setAmountForCoupon').val(graduate_price);
                    
                    // Update hidden amount field
                    $("#paidAmount").val();
                    $("#graduationFrom").prepend(`<input type="text" name="paidAmount" id="paidAmount" value="${graduate_price}">`);
                } else {
                    swal("", "Something Went Wrong", "error");
                }
            },
            error: function (xhr, status, error) {
                const errorMessage = xhr.status === 500 ? "Internal server error. Please try again later." : 
                                   "Error: " + error + " (" + xhr.status + ")";
                console.error("Ajax error:", status, error);
                swal("", errorMessage, "error");
            }
        });
    });

    // Back to Step-2
    $('.back_step2').click(function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        $('.step3').addClass('hide');
        $('.step2').removeClass('hide');
    })

    // ######### Rush Amount
    $('#rushOrderDesktop').change(function () {

        // console.log('Rush Order Desktop');
        if ($(this).is(":checked")) {
            // let currentAmount = graduate_price;
            // $new_total = currentAmount + 25;
            // // console.log($new_total);
            // $('.totalAmount').html(`$${$new_total}.00`);
            // $('#setAmountForCoupon').val($new_total);
            // $('#paidAmount').val($new_total + '.00');

            let currentAmount = $('.totalAmount').html().replace('$', '').replace('.00', '');
            $new_total = Number(currentAmount) + 25;
            $('.totalAmount').html(`$${parseFloat($new_total).toFixed(2)}`); 
            $('#paidAmount').val(parseFloat($new_total).toFixed(2));
             jQuery('.transactionItems input').remove();

             // Store in a json format
             transactionItems.push({
                 itemName: 'Rush Fee',
                 quantity: 1,
                 price: 25
             });
 
             // Add hidden input with stringified transactionItems array
             jQuery('.transactionItems').append(`<input type="hidden" name="item" value='${JSON.stringify(transactionItems)}'>`);
        } else {
            let currentAmount = $('.totalAmount').html().replace('$', '').replace('.00', '');
            $new_total = Number(currentAmount) - 25;
            // console.log($new_total);
            // $('.totalAmount').html(`$${$new_total}.00`); // Ensure .html() method returns correct format
            // $('#setAmountForCoupon').val($new_total);
            // $('#paidAmount').val($new_total + '.00');

            $('.totalAmount').html(`$${parseFloat($new_total).toFixed(2)}`); 
            $('#paidAmount').val(parseFloat($new_total).toFixed(2));

            jQuery('.transactionItems input').remove();

            // Store in a json format
            transactionItems = transactionItems.filter(item => item.itemName !== 'Rush Fee');

            // Add hidden input with stringified transactionItems array
            jQuery('.transactionItems').append(`<input type="hidden" name="item" value='${JSON.stringify(transactionItems)}'>`);

        }
    })

    $('#rushOrderMobile').change(function () {

        if ($(this).is(":checked")) {
            // console.log('Rush Order Mobile');
            // let currentAmount = graduate_price;
            // $new_total = currentAmount + 25;
            // console.log($new_total);
            // $('.totalAmount').html(`$${$new_total}.00`); // Ensure .html() method returns correct format
            // $('#setAmountForCoupon').val($new_total);
            // $('#paidAmount').val($new_total + '.00');
            let currentAmount = $('.totalAmount').html().replace('$', '').replace('.00', '');
            $new_total = Number(currentAmount) + 25;
            $('.totalAmount').html(`$${parseFloat($new_total).toFixed(2)}`); 
            $('#paidAmount').val(parseFloat($new_total).toFixed(2));
             jQuery('.transactionItems input').remove();

             // Store in a json format
             transactionItems.push({
                 itemName: 'Rush Fee',
                 quantity: 1,
                 price: 25
             });
 
             // Add hidden input with stringified transactionItems array
             jQuery('.transactionItems').append(`<input type="hidden" name="item" value='${JSON.stringify(transactionItems)}'>`);
        } else {
            let currentAmount = $('.totalAmount').html().replace('$', '').replace('.00', '');
            $new_total = Number(currentAmount) - 25;
            // console.log($new_total);
            // $('.totalAmount').html(`$${$new_total}.00`); // Ensure .html() method returns correct format
            // $('#setAmountForCoupon').val($new_total);
            // $('#paidAmount').val($new_total + '.00');

            $('.totalAmount').html(`$${parseFloat($new_total).toFixed(2)}`); 
            $('#paidAmount').val(parseFloat($new_total).toFixed(2));

            jQuery('.transactionItems input').remove();

            // Store in a json format
            transactionItems = transactionItems.filter(item => item.itemName !== 'Rush Fee');

            // Add hidden input with stringified transactionItems array
            jQuery('.transactionItems').append(`<input type="hidden" name="item" value='${JSON.stringify(transactionItems)}'>`);
        }
    })
    // ######### Rush Amount


    // ######### Coupon Code
    let coupon_discount_amount = 0;
    let total_amount_after_discount = 0;
    $('.applyCoupon').on("click", function () {
        let code = $('#coupon_code').val() || $('#coupon_code1').val();
        if (!code) {
            return swal('', "Please Enter Code", "error");
        }
        let totalAmount = $('#setAmountForCoupon').val();

        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'action': 'ajax_handle_use_coupon_code',
                // 'registration_id': rid,
                'code': code,
                'amount': totalAmount
            },
            success: function (data) {
                // console.log(data)
                if (data.data.type == '1') {
                    swal('', "oops! This code is invalid", "error");
                } else if (data.data.type == '2') {
                    swal('', "oops! This code is already used", "error");
                } else if (data.data.type == '3') {
                    swal('', "oops! This code is expired", "error");
                }
                 else {

                    if (data.data.amount < 0) {
                        return swal('', "Your Total Amount Lower than Discount", "error");
                    } else {
                        let rush_amount_after_remove_coupon = $("#rushOrderDesktop").is(":checked") || $('#rushOrderMobile').is(":checked") ? 25 : 0;
                        swal('', "Success", "success");
                        coupon_discount_amount = "$" + data.data.discount;
                        total_amount_without_rush_after_discount = data.data.amount;
                        total_amount_after_discount = eval(data.data.amount + "+" + rush_amount_after_remove_coupon);
                        $('.totalAmount').text("$" + total_amount_after_discount.toFixed(2));
                        $('.discountAmount').html('-' + coupon_discount_amount + ` <i class="far fa-times-circle remove_coupon_code" style="color: #ad7070;cursor: pointer;"></i>`)

                        $("#paidAmount").val(total_amount_after_discount);
                        appendTrasactionItems('Coupon Code - ' + code, 1, data.data.discount);
                    }
                }
            },
        })
    })

    
    $('body').on("click", '.remove_coupon_code', function () {

        let rush_amount_after_remove_coupon = $("#rushOrderDesktop").is(":checked") || $('#rushOrderMobile').is(":checked") ? 25 : 0;
        let total_after_remove_coupon = parseFloat(coupon_discount_amount.replace('$', '')) + total_amount_without_rush_after_discount + rush_amount_after_remove_coupon;

        $('.totalAmount').text("$" + total_after_remove_coupon.toFixed(2));

        $('.discountAmount').html('-$0.00');
        
        $("#paidAmount").val(total_after_remove_coupon);

        if ($('#coupon_code').val())
        {
            $('#coupon_code').val('');
        }
        else{
            $('#coupon_code1').val('');
        }

        jQuery('.transactionItems input').remove();

        // remove coupon code from transaction items
        transactionItems = transactionItems.filter(transaction => !transaction.itemName.startsWith("Coupon Code - "));

        // Add hidden input with stringified transactionItems array
        jQuery('.transactionItems').append(`<input type="hidden" name="item" value='${JSON.stringify(transactionItems)}'>`);
        
    })
    
    // ##################### Coupon Code #####################

    $('.payOrder').on("click", function () {
        let checkPayment = $('#paypalId').val() || 'null';
        // console.log(checkPayment);
        let checkPaymentAmount = $('#paidAmount').val();
        // let checkPaymentAmount = $('.totalAmount').html().replace('$', '');
        // console.log(checkPaymentAmount);
        let checkUsedCouponCode = $('#coupon_code').val() || $('#coupon_code1').val();
        // check the Rushfeeoption
        let rushfee = $("#rushOrderDesktop").is(":checked") || $('#rushOrderMobile').is(":checked") ? "high" : "low";
        let transactionItems = [];
        $('.transactionItems input').each(function() {
            let items = JSON.parse($(this).val());
            items.forEach(item => {
            transactionItems.push(item);
            });
        });

        // Set data 
        let studentId = $("#student_id").val();

        // console.log("Rush Fee: ", rushfee);
        // console.log("Student ID: ", studentId);
        // console.log("Payment: ", checkPayment);
        // console.log("Payment Amount: ", checkPaymentAmount);
        // console.log("Coupon Code: ", checkUsedCouponCode);

        // // console.log(checkPayment, checkPaymentAmount, checkUsedCouponCode);
        if (checkPayment == 'null') {
            if (checkPaymentAmount != '0.00') {
                createToken();
            } else if (checkUsedCouponCode && checkPaymentAmount == '0.00') {
                 // final submit 
                 $.ajax({
                     type: 'POST',
                     url: ajax_object.ajax_url,
                     data: {
                        action: 'ajax_handle_apply_graduate_submit', // Required for WordPress AJAX
                        transaction_id: '',
                        rushfee: rushfee,
                        description: 'Graduates Academy - Apply to Graduate',
                        paidAmount: checkPaymentAmount,
                        coupon_code: checkUsedCouponCode,
                        transactionItems: JSON.stringify(transactionItems),
                        student_id: studentId,
                        type: 'final_submit',
                    },
                    success: function (response) {
                        try {
                            // console.log(response);  
                            // console.log(response.success);
                            if (response.success) {
                                $("body").removeClass("loading");
                                swal('', response.message || 'Application successful', "success").then(() => {
                                    window.location.href = '/students/';
                                });
                            } else {
                                $("body").removeClass("loading");
                                swal('', response.message || 'Application failed', "error");
                            }
                        } catch (error) {
                            $("body").removeClass("loading");
                            swal('', 'Application processing error', "error");
                        }
                    },
                });
            } else {
                swal('', 'Please Enter Valid Amount', "error");
            }
        } else {
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                   action: 'ajax_handle_apply_graduate_submit', // Required for WordPress AJAX
                   transaction_id: '',
                   rushfee: rushfee,
                   description: 'Graduates Academy - Apply to Graduate',
                   paidAmount: checkPaymentAmount,
                   coupon_code: checkUsedCouponCode,
                   student_id: studentId,
                   transactionItems: JSON.stringify(transactionItems),
                   type: 'final_submit',
                   student_id: $("#student_id").val(),
               },
               success: function (response) {
                   try {
                        // console.log(response);  
                        // console.log(response.success);
                       if (response.success) {
                           $("body").removeClass("loading");
                           swal('', response.message || 'Application successful', "success").then(() => {
                               window.location.href = '/students/';
                           });
                       } else {
                           $("body").removeClass("loading");
                           swal('', response.message || 'Application failed', "error");
                       }
                   } catch (error) {
                       $("body").removeClass("loading");
                       swal('', 'Application processing error', "error");
                   }
               },
           });
        }

    })


    $('#graduationFrom').submit(function (e) {
        let checkPayment = $('#paypalId').val();
        if (checkPayment == 'null') {
            e.preventDefault();
            swal('', "Please Pay Registration Fees", "error");
        }
    })


})

function appendTrasactionItems(item, quantity, price) {

    // Clear existing transaction items inputs
    jQuery('.transactionItems input').remove();

    // If item starts with "Coupon Code - ", remove any existing coupon code items
    if (item.startsWith("Coupon Code - ")) {
        transactionItems = transactionItems.filter(transaction => !transaction.itemName.startsWith("Coupon Code - "));
    }

    // if item starts with "Graduation Application Fee", remove any existing Graduation Application Fee items
    if (item.startsWith("Graduation Application Fee")) {
        transactionItems = transactionItems.filter(transaction => !transaction.itemName.startsWith("Graduation Application Fee"));
    }

    // Store in a json format
    transactionItems.push({
        itemName: item, 
        quantity: quantity,
        price: price
    });

    // Add hidden input with stringified transactionItems array
    jQuery('.transactionItems').append(`<input type="hidden" name="item" value='${JSON.stringify(transactionItems)}'>`);
    
    // Log transaction items for debugging
    // console.log('Submitting transaction items:', transactionItems);
}

