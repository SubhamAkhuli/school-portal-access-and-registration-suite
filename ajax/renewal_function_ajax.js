let renewalStudentData = [];
let data = [];
let renewalStudentId = []
let EachStudentPayBelow_8 = 50;
let EachStudentPayAfter_8 = 75;
let annualRegistrationFee = 0; // Processing Fee
let transferFee = 0;
let renewal_app_fee = 0;
let reinstatement_fess = 0;
let transactionItems = [];
$(document).ready(function () {

    // form url get parameter
    const urlParams = new URLSearchParams(window.location.search);
    const studentId = urlParams.get('sid');  

    // if (!studentId) {
        // $('.container-fluid').html('<div class="alert alert-danger text-center">No Student Found</div>');
        // return;
        
        // Get All Students data
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'action': 'get_all_renew_student_data',
            },
            success: function (response) {
                // console.log(response);
                // let data = JSON.parse(response);
                if (response.success) {
                    let students = response.student_data; // Updated to handle multiple students
                    let address = response.address;
                    let parent = response.parent_data;

                    let feeData = response.fee_data; // Added to retrieve fee data

                    EachStudentPayBelow_8 = feeData.each_student_pay_below_8; // Updated reference
                    EachStudentPayAfter_8 = feeData.each_student_pay_after_8; // Updated reference
                    annualRegistrationFee = feeData.processing_fee; // Processing Fee
                    transferFee = feeData.transfer_fee; // Transfer Fee
                    reinstatement_fess = feeData.reinstatement_fees; // Updated reference
                    renewal_app_fee = feeData.renewal_app_fee; // Updated reference
                    
                    // console.log(student);

                    // Process the students array
                    if (students && students.length > 0) {
                        let students = response.student_data;

                        // add a Select All checkbox
                        let selectAllHtml = `
                        <div class="d-flex align-items-center p-3 mb-4 bg-light rounded-3 shadow-sm border border-light-subtle">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="select_all" onclick="selectAllStudents(this)">
                                <label class="form-check-label fw-semibold text-primary ms-2" for="select_all">Select All Students</label>
                            </div>
                            <div class="ms-auto text-muted small fw-semibold">Select All Students For Renewal</div>
                        </div>`;
                        
                        // Create a container for student selection
                        let studentListHtml = '<div class="student-list-container">';
                        studentListHtml += selectAllHtml;
                        
                        // Loop through each student and create a card with the provided design
                        students.forEach(student => {
                            let student_name = student.first_name + ' ' + (student.middle_name ? student.middle_name + ' ' : '') + student.last_name;
                            let studentGrade = student.grade || '-1';
                            let profilePic = student.student_profile_pic || ajax_object.base_url + 'img/new_male_default.png';
                            
                            // Define function to get next grade level
                            const getNextGrade = (currentGrade) => {
                                const gradeProgression = [
                                    "Kindergarten",
                                    "1ST GRADE",
                                    "2ND GRADE",
                                    "3RD GRADE",
                                    "4TH GRADE",
                                    "5TH GRADE",
                                    "6TH GRADE",
                                    "7TH GRADE", 
                                    "8TH GRADE",
                                    "9TH GRADE",
                                    "10TH GRADE",
                                    "11TH GRADE",
                                    "12TH GRADE"
                                ];
                                
                                // If it's a special needs category or invalid grade, return the same grade
                                if (currentGrade === "HS SPECIAL NEEDS" || currentGrade === "-1") {
                                    return currentGrade;
                                }
                                // If it's a special case, return the next grade
                                if(currentGrade === "K8 SPECIAL NEEDS" || currentGrade === "8TH WITH HS CREDIT"){
                                    currentGrade = "9TH GRADE";
                                    return currentGrade;
                                }
                                
                                // Find the current grade in the progression
                                const currentIndex = gradeProgression.indexOf(currentGrade);
                                
                                // If found and not the last grade, return the next grade
                                if (currentIndex !== -1 && currentIndex < gradeProgression.length - 1) {
                                    return gradeProgression[currentIndex + 1];
                                }
                                
                                // Otherwise return the same grade (for 12th grade or if not found)
                                return currentGrade;
                            };
                            
                            // Get the promoted grade level
                            const promotedGrade = getNextGrade(studentGrade);
                            
                            studentListHtml += `
                            <div class="card border-0 shadow-sm rounded-3 mb-2 bg-light">
                                <div class="card-body p-4">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="form-check">
                                                <input class="form-check-input student_check" type="checkbox" 
                                                   data-name="${student_name}" 
                                                   data-current_grade="${studentGrade}"
                                                   data-promoted_grade="${promotedGrade}" 
                                                   data-account_expire="${student.account_expire}"
                                                   value="${student.id}" 
                                                   id="select_${student.id}" 
                                                   onclick="selectStudent(this)">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="rounded-circle bg-white shadow-sm p-1 d-flex align-items-center justify-content-center">
                                                <img src="${profilePic}" 
                                                   alt="${student_name}" 
                                                   class="rounded-circle" 
                                                   id="student_photo_${student.id}"
                                                   style="width: 80px; height: 80px; object-fit: cover;">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5 class="fw-bold text-primary mb-2 student_name">${student_name}</h5>
                                            <div class="mt-3">
                                                <label class="form-label fw-semibold text-muted small mb-2">Select grade for upcoming school year:</label>
                                                <div class="input-group input-group-sm">
                                                    <select class="form-select form-select-sm border border-light-subtle shadow-sm rounded-3 py-2 student_grade" 
                                                            id="grade_${student.id}" 
                                                            data-student_id="${student.id}"
                                                            name="grade_${student.id}"
                                                            style="max-width: 250px; background-color: rgba(248, 249, 250, 0.8);"
                                                            onchange="selectGrade(this)">
                                                        <option value="-1" disabled>Select</option>
                                                        <option value="Kindergarten" ${promotedGrade === 'Kindergarten' ? 'selected' : ''}>Kindergarten</option>
                                                        <option value="1ST GRADE" ${promotedGrade === '1ST GRADE' ? 'selected' : ''}>1ST GRADE</option>
                                                        <option value="2ND GRADE" ${promotedGrade === '2ND GRADE' ? 'selected' : ''}>2ND GRADE</option>
                                                        <option value="3RD GRADE" ${promotedGrade === '3RD GRADE' ? 'selected' : ''}>3RD GRADE</option>
                                                        <option value="4TH GRADE" ${promotedGrade === '4TH GRADE' ? 'selected' : ''}>4TH GRADE</option>
                                                        <option value="5TH GRADE" ${promotedGrade === '5TH GRADE' ? 'selected' : ''}>5TH GRADE</option>
                                                        <option value="6TH GRADE" ${promotedGrade === '6TH GRADE' ? 'selected' : ''}>6TH GRADE</option>
                                                        <option value="7TH GRADE" ${promotedGrade === '7TH GRADE' ? 'selected' : ''}>7TH GRADE</option>
                                                        <option value="8TH GRADE" ${promotedGrade === '8TH GRADE' ? 'selected' : ''}>8TH GRADE</option>
                                                        <option value="8TH WITH HS CREDIT" ${promotedGrade === '8TH WITH HS CREDIT' ? 'selected' : ''}>8TH WITH HS CREDIT</option>
                                                        <option value="9TH GRADE" ${promotedGrade === '9TH GRADE' ? 'selected' : ''}>9TH GRADE</option>
                                                        <option value="10TH GRADE" ${promotedGrade === '10TH GRADE' ? 'selected' : ''}>10TH GRADE</option>
                                                        <option value="11TH GRADE" ${promotedGrade === '11TH GRADE' ? 'selected' : ''}>11TH GRADE</option>
                                                        <option value="12TH GRADE" ${promotedGrade === '12TH GRADE' ? 'selected' : ''}>12TH GRADE</option>
                                                        <option value="K8 SPECIAL NEEDS" ${promotedGrade === 'K8 SPECIAL NEEDS' ? 'selected' : ''}>K8 SPECIAL NEEDS</option>
                                                        <option value="HS SPECIAL NEEDS" ${promotedGrade === 'HS SPECIAL NEEDS' ? 'selected' : ''}>HS SPECIAL NEEDS</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>`;

                        });
                        
                        studentListHtml += '</div>';
                        
                        // console.log(studentListHtml);
                        // Replace the container content with our student list
                        $('.student-selection-container').html(studentListHtml);
                        // console.log(studentListHtml);
                        
                        // // Event handler for grade changes
                        // $('.student_grade').on('change', function() {
                        //     let studentId = this.id.replace('grade_', '');
                        //     let checkbox = $('#select_' + studentId);
                        //     checkbox.attr('data-promoted_grade', $(this).val());
                        // });
                    }
                    
                    // Set parent/contact information if available
                    if (parent) {
                        $('.contact_information #f_name').val(parent.first_name || '');
                        $('.contact_information #m_name').val(parent.middle_name || '');
                        $('.contact_information #l_name').val(parent.last_name || '');
                        $('.contact_information #country_code').val(parent.country_code || '+1');
                        $('.contact_information #contact').val(formatPhoneNumber(parent.phone, parent.country_code ) || '');
                        $('.contact_information #email').val(parent.email || '');
                    }

                    // Set address information if available
                    if (address) {
                        $('.address_box #street_address').val(address.address || '');
                        $('.address_box #city').val(address.city || '');
                        $('.address_box #zip_code').val(address.zip || '');
                        $('.address_box #state').val(address.state || '-1');
                        $(".address_box #state").change(()=>{ drop_down_list('address_box') });
                        $('.address_box #state').trigger('change'); 
                        $('.address_box #county').val(address.county || '-1');
                        $('.address_box #emg_country_code').val(address.country_code || '+1');
                        $('.address_box #emergency_number').val(formatPhoneNumber(address.emg_contact_phone, address.country_code) || '');
                        $('.address_box #emergency_name').val(address.emg_contact_name || '');
                    }
                    
                    // set all id 
                    // $("#Student_id").val(student.id);
                    $("#Parent_id").val(parent.id);
                    $("#Address_id").val(address.id);
                } else {
                    $('.container-fluid').html('<div class="alert alert-danger text-center">Failed to load student data</div>');
                }
            }
        });

    // } else {
    //     // console.log(studentId);
    //     // Get Student data
    //     $.ajax({
    //         type: 'POST',
    //         url: ajax_object.ajax_url,
    //         data: {
    //             'action': 'get_renew_student_data',
    //             'student_id': studentId
    //         },
    //         success: function (response) {
    //             // console.log(response);
    //             // let data = JSON.parse(response);
    //             if (response.success) {
    //                 let student = response.student_data;
    //                 let address = response.address;
    //                 let parent = response.parent_data;

    //                 let feeData = response.fee_data;

    //                 EachStudentPayBelow_8 = feeData.each_student_pay_below_8; // Updated reference
    //                 EachStudentPayAfter_8 = feeData.each_student_pay_after_8; // Updated reference
    //                 annualRegistrationFee = feeData.processing_fee; // Processing Fee
    //                 transferFee = feeData.transfer_fee; // Transfer Fee
    //                 reinstatement_fess = feeData.reinstatement_fees; // Updated reference
    //                 renewal_app_fee = feeData.renewal_app_fee; // Updated reference
                    
    //                 // console.log(student);
                    
    //                 let student_name = student.first_name + ' ' + student.middle_name + ' ' + student.last_name;
    //                 let student_grade = student.grade;
                    
    //                 // Fill in the student's display name
    //                 $('.student_name').text(student_name || 'Student Name');

    //                 // Define function to get next grade level
    //                 const getNextGrade = (currentGrade) => {
    //                     const gradeProgression = [
    //                         "Kindergarten",
    //                         "1ST GRADE",
    //                         "2ND GRADE",
    //                         "3RD GRADE",
    //                         "4TH GRADE",
    //                         "5TH GRADE",
    //                         "6TH GRADE",
    //                         "7TH GRADE", 
    //                         "8TH GRADE",
    //                         "9TH GRADE",
    //                         "10TH GRADE",
    //                         "11TH GRADE",
    //                         "12TH GRADE"
    //                     ];
                        
    //                     // If it's a special needs category or invalid grade, return the same grade
    //                     if (currentGrade === "HS SPECIAL NEEDS" || currentGrade === "-1") {
    //                         return currentGrade;
    //                     }
    //                     // If it's a special case, return the next grade
    //                     if(currentGrade === "K8 SPECIAL NEEDS" || currentGrade === "8TH WITH HS CREDIT"){
    //                         currentGrade = "9TH GRADE";
    //                         return currentGrade;
    //                     }
                        
    //                     // Find the current grade in the progression
    //                     const currentIndex = gradeProgression.indexOf(currentGrade);
                        
    //                     // If found and not the last grade, return the next grade
    //                     if (currentIndex !== -1 && currentIndex < gradeProgression.length - 1) {
    //                         return gradeProgression[currentIndex + 1];
    //                     }
                        
    //                     // Otherwise return the same grade (for 12th grade or if not found)
    //                     return currentGrade;
    //                 };
                    
    //                 // Get the promoted grade level
    //                 const promotedGrade = getNextGrade(student_grade);


    //                 // Set the checkbox attributes with student data
    //                 $('.student_check')
    //                     .val(student.id)
    //                     .attr('data-name', student_name || 'Student Name')
    //                     .attr('data-account_expire', student.account_expire || '')
    //                     .attr('id', `select_${student.id}`)
    //                     .attr('data-current_grade', student_grade || '')
    //                     .attr('data-promoted_grade', promotedGrade || '');

    //                 // Load student photo if available
    //                 if (student.student_profile_pic) {
    //                     $('#student_photo').attr('src', student.student_profile_pic);
    //                 }

    //                 // Pre-select the student's current grade if available
    //                 if (student.grade) {
    //                     $('.student_grade').val(promotedGrade);
    //                     // Populate the student grade select dropdown
    //                     $('.student_grade').attr({
    //                         'id': `grade_${student.id}`,
    //                         'data-student_id': student.id,
    //                         'name': `grade_${student.id}`
    //                     });
    //                 }

    //                 // Set parent/contact information if available
    //                 if (parent) {
    //                     $('.contact_information #f_name').val(parent.first_name || '');
    //                     $('.contact_information #m_name').val(parent.middle_name || '');
    //                     $('.contact_information #l_name').val(parent.last_name || '');
    //                     $('.contact_information #country_code').val(parent.country_code || '+1');
    //                     $('.contact_information #contact').val(formatPhoneNumber(parent.phone, parent.country_code ) || '');
    //                     $('.contact_information #email').val(parent.email || '');
    //                 }

    //                 // Set address information if available
    //                 if (address) {
    //                     $('.address_box #street_address').val(address.address || '');
    //                     $('.address_box #city').val(address.city || '');
    //                     $('.address_box #zip_code').val(address.zip || '');
    //                     $('.address_box #state').val(address.state || '-1');
    //                     $(".address_box #state").change(()=>{ drop_down_list('address_box') });
    //                     $('.address_box #state').trigger('change'); 
    //                     $('.address_box #county').val(address.county || '-1');
    //                     $('.address_box #emg_country_code').val(address.country_code || '+1');
    //                     $('.address_box #emergency_number').val(formatPhoneNumber(address.emg_contact_phone, address.country_code) || '');
    //                     $('.address_box #emergency_name').val(address.emg_contact_name || '');
    //                 }
                    
    //                 // Store expiration date if needed for renewal logic
    //                 // if (student.account_expire) {
    //                 //     // Set expiration to August 10th of next year
    //                 //     let currentExpireYear = new Date(student.account_expire).getFullYear();
    //                 //     let nextYear = currentExpireYear + 1;
    //                 //     let expireDate = `${nextYear}-08-10`;
    //                 //     window.expireDate = expireDate;
    //                 //     $('#account_expire').val(expireDate);
    //                 // }
                    
    //                 // set all id 
    //                 $("#Student_id").val(student.id);
    //                 $("#Parent_id").val(parent.id);
    //                 $("#Address_id").val(address.id);
    //             } else {
    //                 $('.container-fluid').html('<div class="alert alert-danger text-center">Failed to load student data</div>');
    //             }
    //         }
    //     });
    // }

    // set country code in phone number
    $(".country_code").html(`
        <select name="country_code" id="country_code" class="form-control">
            <option data-countryCode="DZ" value="+213">Algeria (+213)</option>
            <option data-countryCode="AD" value="+376">Andorra (+376)</option>
            <option data-countryCode="AO" value="+244">Angola (+244)</option>
            <option data-countryCode="AI" value="+1264">Anguilla (+1264)</option>
            <option data-countryCode="AG" value="+1268">Antigua &amp; Barbuda (+1268)</option>
            <option data-countryCode="AR" value="+54">Argentina (+54)</option>
            <option data-countryCode="AM" value="+374">Armenia (+374)</option>
            <option data-countryCode="AW" value="+297">Aruba (+297)</option>
            <option data-countryCode="AU" value="+61">Australia (+61)</option>
            <option data-countryCode="AT" value="+43">Austria (+43)</option>
            <option data-countryCode="AZ" value="+994">Azerbaijan (+994)</option>
            <option data-countryCode="BS" value="+1242">Bahamas (+1242)</option>
            <option data-countryCode="BH" value="+973">Bahrain (+973)</option>
            <option data-countryCode="BD" value="+880">Bangladesh (+880)</option>
            <option data-countryCode="BB" value="+1246">Barbados (+1246)</option>
            <option data-countryCode="BY" value="+375">Belarus (+375)</option>
            <option data-countryCode="BE" value="+32">Belgium (+32)</option>
            <option data-countryCode="BZ" value="+501">Belize (+501)</option>
            <option data-countryCode="BJ" value="+229">Benin (+229)</option>
            <option data-countryCode="BM" value="+1441">Bermuda (+1441)</option>
            <option data-countryCode="BT" value="+975">Bhutan (+975)</option>
            <option data-countryCode="BO" value="+591">Bolivia (+591)</option>
            <option data-countryCode="BA" value="+387">Bosnia Herzegovina (+387)</option>
            <option data-countryCode="BW" value="+267">Botswana (+267)</option>
            <option data-countryCode="BR" value="+55">Brazil (+55)</option>
            <option data-countryCode="BN" value="+673">Brunei (+673)</option>
            <option data-countryCode="BG" value="+359">Bulgaria (+359)</option>
            <option data-countryCode="BF" value="+226">Burkina Faso (+226)</option>
            <option data-countryCode="BI" value="+257">Burundi (+257)</option>
            <option data-countryCode="KH" value="+855">Cambodia (+855)</option>
            <option data-countryCode="CM" value="+237">Cameroon (+237)</option>
            <option data-countryCode="CA" value="+1c">Canada (+1)</option>
            <option data-countryCode="CV" value="+238">Cape Verde Islands (+238)</option>
            <option data-countryCode="KY" value="+1345">Cayman Islands (+1345)</option>
            <option data-countryCode="CF" value="+236">Central African Republic (+236)</option>
            <option data-countryCode="CL" value="+56">Chile (+56)</option>
            <option data-countryCode="CN" value="+86">China (+86)</option>
            <option data-countryCode="CO" value="+57">Colombia (+57)</option>
            <option data-countryCode="KM" value="+269">Comoros (+269)</option>
            <option data-countryCode="CG" value="+242">Congo (+242)</option>
            <option data-countryCode="CK" value="+682">Cook Islands (+682)</option>
            <option data-countryCode="CR" value="+506">Costa Rica (+506)</option>
            <option data-countryCode="HR" value="+385">Croatia (+385)</option>
            <option data-countryCode="CU" value="+53">Cuba (+53)</option>
            <option data-countryCode="CY" value="+90392">Cyprus North (+90392)</option>
            <option data-countryCode="CY" value="+357">Cyprus South (+357)</option>
            <option data-countryCode="CZ" value="+42">Czech Republic (+42)</option>
            <option data-countryCode="DK" value="+45">Denmark (+45)</option>
            <option data-countryCode="DJ" value="+253">Djibouti (+253)</option>
            <option data-countryCode="DM" value="+1809">Dominica (+1809)</option>
            <option data-countryCode="DO" value="+1809">Dominican Republic (+1809)</option>
            <option data-countryCode="EC" value="+593">Ecuador (+593)</option>
            <option data-countryCode="EG" value="+20">Egypt (+20)</option>
            <option data-countryCode="SV" value="+503">El Salvador (+503)</option>
            <option data-countryCode="GQ" value="+240">Equatorial Guinea (+240)</option>
            <option data-countryCode="ER" value="+291">Eritrea (+291)</option>
            <option data-countryCode="EE" value="+372">Estonia (+372)</option>
            <option data-countryCode="ET" value="+251">Ethiopia (+251)</option>
            <option data-countryCode="FK" value="+500">Falkland Islands (+500)</option>
            <option data-countryCode="FO" value="+298">Faroe Islands (+298)</option>
            <option data-countryCode="FJ" value="+679">Fiji (+679)</option>
            <option data-countryCode="FI" value="+358">Finland (+358)</option>
            <option data-countryCode="FR" value="+33">France (+33)</option>
            <option data-countryCode="GF" value="+594">French Guiana (+594)</option>
            <option data-countryCode="PF" value="+689">French Polynesia (+689)</option>
            <option data-countryCode="GA" value="+241">Gabon (+241)</option>
            <option data-countryCode="GM" value="+220">Gambia (+220)</option>
            <option data-countryCode="GE" value="+7880">Georgia (+7880)</option>
            <option data-countryCode="DE" value="+49">Germany (+49)</option>
            <option data-countryCode="GH" value="+233">Ghana (+233)</option>
            <option data-countryCode="GI" value="+350">Gibraltar (+350)</option>
            <option data-countryCode="GR" value="+30">Greece (+30)</option>
            <option data-countryCode="GL" value="+299">Greenland (+299)</option>
            <option data-countryCode="GD" value="+1473">Grenada (+1473)</option>
            <option data-countryCode="GP" value="+590">Guadeloupe (+590)</option>
            <option data-countryCode="GU" value="+671">Guam (+671)</option>
            <option data-countryCode="GT" value="+502">Guatemala (+502)</option>
            <option data-countryCode="GN" value="+224">Guinea (+224)</option>
            <option data-countryCode="GW" value="+245">Guinea - Bissau (+245)</option>
            <option data-countryCode="GY" value="+592">Guyana (+592)</option>
            <option data-countryCode="HT" value="+509">Haiti (+509)</option>
            <option data-countryCode="HN" value="+504">Honduras (+504)</option>
            <option data-countryCode="HK" value="+852">Hong Kong (+852)</option>
            <option data-countryCode="HU" value="+36">Hungary (+36)</option>
            <option data-countryCode="IS" value="+354">Iceland (+354)</option>
            <option data-countryCode="IN" value="+91">India (+91)</option>
            <option data-countryCode="ID" value="+62">Indonesia (+62)</option>
            <option data-countryCode="IR" value="+98">Iran (+98)</option>
            <option data-countryCode="IQ" value="+964">Iraq (+964)</option>
            <option data-countryCode="IE" value="+353">Ireland (+353)</option>
            <option data-countryCode="IL" value="+972">Israel (+972)</option>
            <option data-countryCode="IT" value="+39">Italy (+39)</option>
            <option data-countryCode="JM" value="+1876">Jamaica (+1876)</option>
            <option data-countryCode="JP" value="+81">Japan (+81)</option>
            <option data-countryCode="JO" value="+962">Jordan (+962)</option>
            <option data-countryCode="KZ" value="+7k">Kazakhstan (+7)</option>
            <option data-countryCode="KE" value="+254">Kenya (+254)</option>
            <option data-countryCode="KI" value="+686">Kiribati (+686)</option>
            <option data-countryCode="KP" value="+850">Korea North (+850)</option>
            <option data-countryCode="KR" value="+82">Korea South (+82)</option>
            <option data-countryCode="KW" value="+965">Kuwait (+965)</option>
            <option data-countryCode="KG" value="+996">Kyrgyzstan (+996)</option>
            <option data-countryCode="LA" value="+856">Laos (+856)</option>
            <option data-countryCode="LV" value="+371">Latvia (+371)</option>
            <option data-countryCode="LB" value="+961">Lebanon (+961)</option>
            <option data-countryCode="LS" value="+266">Lesotho (+266)</option>
            <option data-countryCode="LR" value="+231">Liberia (+231)</option>
            <option data-countryCode="LY" value="+218">Libya (+218)</option>
            <option data-countryCode="LI" value="+417">Liechtenstein (+417)</option>
            <option data-countryCode="LT" value="+370">Lithuania (+370)</option>
            <option data-countryCode="LU" value="+352">Luxembourg (+352)</option>
            <option data-countryCode="MO" value="+853">Macao (+853)</option>
            <option data-countryCode="MK" value="+389">Macedonia (+389)</option>
            <option data-countryCode="MG" value="+261">Madagascar (+261)</option>
            <option data-countryCode="MW" value="+265">Malawi (+265)</option>
            <option data-countryCode="MY" value="+60">Malaysia (+60)</option>
            <option data-countryCode="MV" value="+960">Maldives (+960)</option>
            <option data-countryCode="ML" value="+223">Mali (+223)</option>
            <option data-countryCode="MT" value="+356">Malta (+356)</option>
            <option data-countryCode="MH" value="+692">Marshall Islands (+692)</option>
            <option data-countryCode="MQ" value="+596">Martinique (+596)</option>
            <option data-countryCode="MR" value="+222">Mauritania (+222)</option>
            <option data-countryCode="YT" value="+269">Mayotte (+269)</option>
            <option data-countryCode="MX" value="+52">Mexico (+52)</option>
            <option data-countryCode="FM" value="+691">Micronesia (+691)</option>
            <option data-countryCode="MD" value="+373">Moldova (+373)</option>
            <option data-countryCode="MC" value="+377">Monaco (+377)</option>
            <option data-countryCode="MN" value="+976">Mongolia (+976)</option>
            <option data-countryCode="MS" value="+1664">Montserrat (+1664)</option>
            <option data-countryCode="MA" value="+212">Morocco (+212)</option>
            <option data-countryCode="MZ" value="+258">Mozambique (+258)</option>
            <option data-countryCode="MN" value="+95">Myanmar (+95)</option>
            <option data-countryCode="NA" value="+264">Namibia (+264)</option>
            <option data-countryCode="NR" value="+674">Nauru (+674)</option>
            <option data-countryCode="NP" value="+977">Nepal (+977)</option>
            <option data-countryCode="NL" value="+31">Netherlands (+31)</option>
            <option data-countryCode="NC" value="+687">New Caledonia (+687)</option>
            <option data-countryCode="NZ" value="+64">New Zealand (+64)</option>
            <option data-countryCode="NI" value="+505">Nicaragua (+505)</option>
            <option data-countryCode="NE" value="+227">Niger (+227)</option>
            <option data-countryCode="NG" value="+234">Nigeria (+234)</option>
            <option data-countryCode="NU" value="+683">Niue (+683)</option>
            <option data-countryCode="NF" value="+672">Norfolk Islands (+672)</option>
            <option data-countryCode="NP" value="+670">Northern Marianas (+670)</option>
            <option data-countryCode="NO" value="+47n">Norway (+47)</option>
            <option data-countryCode="OM" value="+968">Oman (+968)</option>
            <option data-countryCode="PW" value="+680">Palau (+680)</option>
            <option data-countryCode="PA" value="+507">Panama (+507)</option>
            <option data-countryCode="PG" value="+675">Papua New Guinea (+675)</option>
            <option data-countryCode="PY" value="+595">Paraguay (+595)</option>
            <option data-countryCode="PE" value="+51">Peru (+51)</option>
            <option data-countryCode="PH" value="+63">Philippines (+63)</option>
            <option data-countryCode="PL" value="+48">Poland (+48)</option>
            <option data-countryCode="PT" value="+351">Portugal (+351)</option>
            <option data-countryCode="PR" value="+1787">Puerto Rico (+1787)</option>
            <option data-countryCode="QA" value="+974">Qatar (+974)</option>
            <option data-countryCode="RE" value="+262">Reunion (+262)</option>
            <option data-countryCode="RO" value="+40">Romania (+40)</option>
            <option data-countryCode="RU" value="+7">Russia (+7)</option>
            <option data-countryCode="RW" value="+250">Rwanda (+250)</option>
            <option data-countryCode="SM" value="+378">San Marino (+378)</option>
            <option data-countryCode="ST" value="+239">Sao Tome &amp; Principe (+239)</option>
            <option data-countryCode="SA" value="+966">Saudi Arabia (+966)</option>
            <option data-countryCode="SN" value="+221">Senegal (+221)</option>
            <option data-countryCode="CS" value="+381">Serbia (+381)</option>
            <option data-countryCode="SC" value="+248">Seychelles (+248)</option>
            <option data-countryCode="SL" value="+232">Sierra Leone (+232)</option>
            <option data-countryCode="SG" value="+65">Singapore (+65)</option>
            <option data-countryCode="SK" value="+421">Slovak Republic (+421)</option>
            <option data-countryCode="SI" value="+386">Slovenia (+386)</option>
            <option data-countryCode="SB" value="+677">Solomon Islands (+677)</option>
            <option data-countryCode="SO" value="+252">Somalia (+252)</option>
            <option data-countryCode="ZA" value="+27">South Africa (+27)</option>
            <option data-countryCode="ES" value="+34">Spain (+34)</option>
            <option data-countryCode="LK" value="+94">Sri Lanka (+94)</option>
            <option data-countryCode="SH" value="+290">St. Helena (+290)</option>
            <option data-countryCode="KN" value="+1869">St. Kitts (+1869)</option>
            <option data-countryCode="SC" value="+1758">St. Lucia (+1758)</option>
            <option data-countryCode="SD" value="+249">Sudan (+249)</option>
            <option data-countryCode="SR" value="+597">Suriname (+597)</option>
            <option data-countryCode="SZ" value="+268">Swaziland (+268)</option>
            <option data-countryCode="SE" value="+46">Sweden (+46)</option>
            <option data-countryCode="CH" value="+41">Switzerland (+41)</option>
            <option data-countryCode="SI" value="+963">Syria (+963)</option>
            <option data-countryCode="TW" value="+886">Taiwan (+886)</option>
            <option data-countryCode="TJ" value="+7">Tajikstan (+7)</option>
            <option data-countryCode="TH" value="+66">Thailand (+66)</option>
            <option data-countryCode="TG" value="+228">Togo (+228)</option>
            <option data-countryCode="TO" value="+676">Tonga (+676)</option>
            <option data-countryCode="TT" value="+1868">Trinidad &amp; Tobago (+1868)</option>
            <option data-countryCode="TN" value="+216">Tunisia (+216)</option>
            <option data-countryCode="TR" value="+90">Turkey (+90)</option>
            <option data-countryCode="TM" value="+7">Turkmenistan (+7)</option>
            <option data-countryCode="TM" value="+993">Turkmenistan (+993)</option>
            <option data-countryCode="TC" value="+1649">Turks &amp; Caicos Islands (+1649)</option>
            <option data-countryCode="TV" value="+688">Tuvalu (+688)</option>
            <option data-countryCode="UG" value="+256">Uganda (+256)</option>
            <option data-countryCode="GB" value="+44">UK (+44)</option>
            <option data-countryCode="UA" value="+380">Ukraine (+380)</option>
            <option data-countryCode="AE" value="+971">United Arab Emirates (+971)</option>
            <option data-countryCode="UY" value="+598">Uruguay (+598)</option>
            <option data-countryCode="US" value="+1" Selected >USA (+1)</option>
            <option data-countryCode="UZ" value="+7">Uzbekistan (+7)</option>
            <option data-countryCode="VU" value="+678">Vanuatu (+678)</option>
            <option data-countryCode="VA" value="+379">Vatican City (+379)</option>
            <option data-countryCode="VE" value="+58">Venezuela (+58)</option>
            <option data-countryCode="VN" value="+84">Vietnam (+84)</option>
            <option data-countryCode="VG" value="+84">Virgin Islands - British (+1284)</option>
            <option data-countryCode="VI" value="+84">Virgin Islands - US (+1340)</option>
            <option data-countryCode="WF" value="+681">Wallis &amp; Futuna (+681)</option>
            <option data-countryCode="YE" value="+969">Yemen (North)(+969)</option>
            <option data-countryCode="YE" value="+967">Yemen (South)(+967)</option>
            <option data-countryCode="ZM" value="+260">Zambia (+260)</option>
            <option data-countryCode="ZW" value="+263">Zimbabwe (+263)</option>
        </select>
    `);


    $('.payOrder').on("click", function () {
        let checkPayment = $('#paypalId').val() || 'null';
        // console.log(checkPayment);
        let checkPaymentAmount = $('#paidAmount').val();
        // let checkPaymentAmount = $('.totalAmount').html();
        // console.log(checkPaymentAmount);
        let checkUsedCouponCode = $('#coupon_code').val() || $('#coupon_code1').val();
        // check the Rushfeeoption
        let rushfee = $(".rushAmountDesktop input[type='checkbox']").is(":checked") || $(".rushAmountMobile input[type='checkbox']").is(":checked") ? "high" : "low";
        let transactionItems = [];
        $('.transactionItems input').each(function() {
            let items = JSON.parse($(this).val());
            items.forEach(item => {
            transactionItems.push(item);
            });
        });

        // Set data 
        // let studentId = $("#Student_id").val();
        // let studentGrade = $('.student_grade').val();

        let student_data =  [];
        $('.renewalStudentData input').each(function() {
            let student = JSON.parse($(this).val());
            student_data.push(student);
        });

        let parentId = $("#Parent_Id").val();
        let f_name = $('.contact_information #f_name').val()
        let m_name = $('.contact_information #m_name').val()
        let l_name = $('.contact_information #l_name').val()
        let country_code = $('.contact_information #country_code').val()
        let phone = $('.contact_information #parent_phone').val()
        let email = $('.contact_information #email').val()

        let addressId = $("#Address_id").val();
        let street_address = $('.address_box #street_address').val();
        let city = $('.address_box #city').val();
        let zip_code = $('.address_box #zip_code').val();
        let state = $('.address_box #state').val();
        let county = $('.address_box #county').val();
        let emergency_name = $('.address_box #emergency_name').val();
        let emergency_country_code = $('.address_box #emg_country_code').val();
        let emergency_number = $('.address_box #emergency_phoneNumber').val();

        let privacy_check = $("#acceptAllPolicies").is(":checked");
        let signature_f_name = $("#signature_f_name").val();
        let signature_l_name = $("#signature_l_name").val();
        let signature_date = $("#signature_date").val();
        // let account_expire = $("#account_expire").val();
        // console.log(checkPayment, checkPaymentAmount, checkUsedCouponCode);
        if (checkPayment == 'null') {
            if (checkPaymentAmount != '0.00') {
                createToken();
            } else if (checkUsedCouponCode && checkPaymentAmount == '0.00') {
                 // final submit 
                 $.ajax({
                     type: 'POST',
                     url: ajax_object.ajax_url,
                     data: {
                        action: 'ajax_handle_renewal_submit', // Required for WordPress AJAX
                        transaction_id: '',
                        rushfee: rushfee,
                        description: 'Graduates Academy - Renew Registration',
                        paidAmount: checkPaymentAmount,
                        coupon_code: checkUsedCouponCode,
                        // studentId: studentId,
                        // studentGrade: studentGrade,
                        student_data: JSON.stringify(student_data),
                        parentId: parentId,
                        // account_expire : account_expire,
                        f_name: f_name,
                        m_name: m_name,
                        l_name: l_name,
                        country_code: country_code,
                        phone: phone,
                        email: email,
                        addressId: addressId,
                        street_address: street_address,
                        city: city,
                        zip_code: zip_code,
                        state: state,
                        county: county,
                        emergency_name: emergency_name,
                        emergency_country_code: emergency_country_code,
                        emergency_number: emergency_number,
                        privacy_check: privacy_check,
                        signature_f_name: signature_f_name,
                        signature_l_name: signature_l_name,
                        signature_date: signature_date,
                        transactionItems: JSON.stringify(transactionItems),
                        type: 'final_submit',
                    },
                    success: function (response) {
                        try {
                            // console.log(response);  
                            const data = typeof response === 'string' ? JSON.parse(response) : response;
                            if (data && data.data && data.data.success) {
                                $("body").removeClass("loading");
                                swal('', data.data?.message || 'Registration successful', "success").then(() => {
                                    window.location.href = '/students/';
                                });
                            } else {
                                $("body").removeClass("loading");
                                swal('', data.data?.message || 'Registration failed', "error");
                            }
                        } catch (error) {
                            $("body").removeClass("loading");
                            swal('', 'Registration processing error', "error");
                        }
                    },
                });
                // $('#studentsForm').submit();
            } else {
                swal('', 'Please Enter Valid Amount', "error");
            }
        } else {
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                   action: 'ajax_handle_renewal_submit', // Required for WordPress AJAX
                   transaction_id: '',
                   rushfee: rushfee,
                   description: 'Graduates Academy - Renew Registration',
                   paidAmount: checkPaymentAmount,
                   coupon_code: checkUsedCouponCode,
                //    studentId: studentId,
                //    studentGrade: studentGrade,
                   student_data: JSON.stringify(student_data),
                   parentId: parentId,
                //    account_expire : account_expire,
                   f_name: f_name,
                   m_name: m_name,
                   l_name: l_name,
                   country_code: country_code,
                   phone: phone,
                   email: email,
                   addressId: addressId,
                   street_address: street_address,
                   city: city,
                   zip_code: zip_code,
                   state: state,
                   county: county,
                   emergency_name: emergency_name,
                   emergency_country_code: emergency_country_code,
                   emergency_number: emergency_number,
                   privacy_check: privacy_check,
                   signature_f_name: signature_f_name,
                   signature_l_name: signature_l_name,
                   signature_date: signature_date,
                   transactionItems: JSON.stringify(transactionItems),
                   type: 'final_submit',
               },
               success: function (response) {
                   try {
                       // console.log(response);  
                       const data = typeof response === 'string' ? JSON.parse(response) : response;
                       if (data && data.data && data.data.success) {
                           $("body").removeClass("loading");
                           swal('', data.data?.message || 'Registration successful', "success").then(() => {
                               window.location.href = '/students/';
                           });
                       } else {
                           $("body").removeClass("loading");
                           swal('', data.data?.message || 'Registration failed', "error");
                       }
                   } catch (error) {
                       $("body").removeClass("loading");
                       swal('', 'Registration processing error', "error");
                   }
               },
           });
        }

    })


    $('#studentsForm').submit(function (e) {

        let checkPayment = $('#paypalId').val();
        let checkUsedCouponCode = $('#usedCouponCode').val();

        if (checkPayment == 'null' && !checkUsedCouponCode) {
            e.preventDefault();
            swal('', "Please Pay Registration Fees", "error");
        }

    })


    $('#msform').submit(function (e) {
        e.preventDefault();
    })

    // Select Student #############
    $('.next_to_payment_btn').click(function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        renewalStudentId = []
        // renewalStudentData = []
        data = []
        let checkedCounter = 0;
        // Process all selected students from renewalStudentData array
        if (renewalStudentData.length > 0) {
            // Loop through each selected student
            renewalStudentData.forEach((student, index) => {
                // Add to the renewalStudentId array for tracking
                renewalStudentId.push(student.id);
                
                // Push to data array for payment calculations
                data.push({
                    id: student.id, 
                    name: student.name, 
                    grade: student.grade,
                    oldAccountExpire: student.old_account_expire,
                    newAccountExpire: student.new_account_expire,
                });
                
                // Add hidden inputs to the form for each student
                $('#studentsForm').prepend(`<input type="text" name="renewalData[${checkedCounter}][id]" value="${student.id}">`);
                $('#studentsForm').prepend(`<input type="text" name="renewalData[${checkedCounter}][grade]" value="${student.grade}">`);
                $('#studentsForm').prepend(`<input type="text" name="renewalData[${checkedCounter}][name]" value="${student.name}">`);
                
                if (student.account_expire) {
                    $('#studentsForm').prepend(`<input type="text" name="renewalData[${checkedCounter}][account_expire]" value="${student.account_expire}">`);
                }
                
                checkedCounter += 1;
            });
            
            // console.log('Selected Students:', renewalStudentData);
            // console.log('Student IDs for renewal:', renewalStudentId);
        }

        if (renewalStudentId.length > 0) {
            setPayment();
            $('#renewalIds').remove()
            $('#studentsForm').prepend(`<input type="text" name="renewalIds" id="renewalIds" value="${renewalStudentId.toString()}">`)
            $('.step_2').removeClass('hide'); 
            $('.step_1').addClass('hide');
        } else {
            swal('', "Please Select at Least One Student", "error");
        }
    });
    // Select Student #############

    $('.next_to_agreement').click(function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        let f_name = $('.contact_information #f_name').val()
        let m_name = $('.contact_information #m_name').val()
        let l_name = $('.contact_information #l_name').val()
        let country_code = $('.contact_information #country_code').val()
        let phone = $('.contact_information #contact').val()
        let email = $('.contact_information #email').val()

        let street_address = $('.address_box #street_address').val();
        let city = $('.address_box #city').val();
        let zip_code = $('.address_box #zip_code').val();
        let state = $('.address_box #state').val();
        let county = $('.address_box #county').val();
        let emergency_name = $('.address_box #emergency_name').val();
        let emergency_country_code = $('.address_box #emg_country_code').val();
        let emergency_number = $('.address_box #emergency_number').val();

        let phoneChange = NumberremoveFormat(phone);
        let emergencyPhoneChange = NumberremoveFormat(emergency_number);

        contact_user = {
            f_name,
            m_name,
            l_name,
            country_code,
            phoneChange,
            email
        }
        address = {
            street_address,
            city,
            zip_code,
            state,
            county,
            emergency_name,
            emergency_country_code,
            emergencyPhoneChange
        }

        // console.log("contact_user:", contact_user);
        // console.log("address:", address);
        if (!street_address || !city || !zip_code || state == "-1" || county == "-1" || !emergency_name || !emergency_number) {
            swal("", "Please Fill All Fields", "error");
            return false;
        } else if (!emergencyPhoneChange && emergency_number.length != 10) {
            swal("", "Please Enter Correct Emergency", "error");
            return false;
        } else if (!phoneChange && phone.length != 10) {
            swal("", "Please Enter Correct Phone", "error");
            return false;
        } else {
           
            $('#studentsForm').prepend(`<input type="text" name="contactInfo[f_name]" value="${f_name}">`)
            $('#studentsForm').prepend(`<input type="text" name="contactInfo[m_name]" value="${m_name}">`)
            $('#studentsForm').prepend(`<input type="text" name="contactInfo[l_name]" value="${l_name}">`)
            $('#studentsForm').prepend(`<input type="text" name="contactInfo[country_code]" value="${country_code}">`)
            $('#studentsForm').prepend(`<input type="text" name="contactInfo[phone]" value="${phoneChange}">`)
            $('#studentsForm').prepend(`<input type="text" name="contactInfo[email]" value="${email}">`)

            $('#studentsForm').prepend(`<input type="text" name="addressInfo[street_address]" value="${street_address}">`)
            $('#studentsForm').prepend(`<input type="text" name="addressInfo[city]" value="${city}">`)
            $('#studentsForm').prepend(`<input type="text" name="addressInfo[zip_code]" value="${zip_code}">`)
            $('#studentsForm').prepend(`<input type="text" name="addressInfo[state]" value="${state}">`)
            $('#studentsForm').prepend(`<input type="text" name="addressInfo[county]" value="${county}">`)
            $('#studentsForm').prepend(`<input type="text" name="addressInfo[country_code]" value="${emergency_country_code}">`)
            $('#studentsForm').prepend(`<input type="text" name="addressInfo[emergency_name]" value="${emergency_name}">`)
            $('#studentsForm').prepend(`<input type="text" name="addressInfo[emergency_number]" value="${emergencyPhoneChange}">`)

            $('.contact_information #parent_phone').val(phoneChange);
            $('.address_box #emergency_phoneNumber').val(emergencyPhoneChange);
            
            $('.step_2').addClass('hide');
            $('.step_3').removeClass('hide');
        }


    });

    $('.previous_student_summery').click(function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        $('.step_1').removeClass('hide');
        $('.step_2').addClass('hide');
    })

    $('.next_to_checkout').click(function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        let privacy_check = $("#acceptAllPolicies").is(":checked");
        let signature_f_name = $("#signature_f_name").val();
        let signature_l_name = $("#signature_l_name").val();
        let signature_date = $("#signature_date").val();

        digital_signature = {
            check: privacy_check,
            f_name: signature_f_name,
            l_name: signature_l_name,
            date: signature_date,
        }

        // console.log("digital_signature:", digital_signature);
        if (!privacy_check) {
            swal("Something is Missing!", "Please Read and Accept Policies", "error");
            return false;
        } else if (!signature_f_name || !signature_l_name || !signature_date) {
            swal("Something is Missing!", "Please Fill Signature Field", "error");
            return false;
        } else if (!isDate(signature_date)) {
            swal("", "Please Insert Valid Date!", "error");
            return false;
        } else {

            $('.step_3').addClass('hide');
            $('.step_4').removeClass('hide');

            $('#studentsForm').prepend(`<input type="text" name="agreementData[f_name]" value="${signature_f_name}">`)
            $('#studentsForm').prepend(`<input type="text" name="agreementData[l_name]" value="${signature_l_name}">`)
            $('#studentsForm').prepend(`<input type="text" name="agreementData[signature_date]" value="${signature_date}">`)

            // clear previous data
            $('.renewalStudentData input').remove();

            // set data from renewal students
            $('.renewalStudentData').prepend(`<input type="text" name="renewalStudentData" value='${JSON.stringify(renewalStudentData)}'>`)

            // setPayment()
            // setStudentData()

            // console.log("Renewal Student Data:", renewalStudentData);
        }

    });

    $('.previous_step_2').click(function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        $('.step_2').removeClass('hide');
        $('.step_3').addClass('hide');
    });

    $('.previous_step_3').click(function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        $('.step_4').addClass('hide');
        $('.step_3').removeClass('hide');
    });

    $('.submitOrder').click(function () {
        $('#studentsForm').submit();
    })

    // $('.backFromSubmit').click(function () {
    //     $('.step_2').hide()
    //     $('.step_1').show()
    // })

    // ######### Rush Amount
    $('.rushAmountDesktop').change(function () {

        if ($(".rushAmountDesktop input[type='checkbox']").is(":checked")) {
            // $('.totalAmount').html(Number($('.totalAmount').html()) + 25);
            // $('.setAmountForCoupon').val(Number($('.totalAmount').html()) + 25 + '.00');
            $new_total = Number($('.totalAmount').html()) + 25;
            // console.log(parseFloat($new_total).toFixed(2));
            $('.totalAmount').html(parseFloat($new_total).toFixed(2));
            // $('.setAmountForCoupon').val($new_total + '.00');
            $('#paidAmount').val(parseFloat($new_total).toFixed(2));
             // Remove hidden input with stringified transactionItems array
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
            // $('.totalAmount').html(($('.totalAmount').html() - 25).toFixed(2));
            // $('.setAmountForCoupon').val($('.totalAmount').html() - 25 + '.00');
            $new_total = ($('.totalAmount').html() - 25);
            // console.log(parseFloat($new_total).toFixed(2));
            $('.totalAmount').html(parseFloat($new_total).toFixed(2));
            // $('.setAmountForCoupon').val($new_total + '.00');
            $('#paidAmount').val(parseFloat($new_total).toFixed(2));
            // Remove hidden input with stringified transactionItems array
            jQuery('.transactionItems input').remove();

            // Store in a json format
            transactionItems = transactionItems.filter(item => item.itemName !== 'Rush Fee');

            // Add hidden input with stringified transactionItems array
            jQuery('.transactionItems').append(`<input type="hidden" name="item" value='${JSON.stringify(transactionItems)}'>`);
        }
    })
    $('.rushAmountMobile').change(function () {

        if ($(".rushAmountMobile input[type='checkbox']").is(":checked")) {
            $new_total = Number($('.totalAmount').html()) + 25;
            $('.totalAmount').html(parseFloat(parseFloat($new_total).toFixed(2)));
            $('.setAmountForCoupon').val(parseFloat($new_total).toFixed(2));
            $('#paidAmount').val(parseFloat($new_total).toFixed(2));

            // Remove hidden input with stringified transactionItems array
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
            $new_total = ($('.totalAmount').html() - 25);
            $('.totalAmount').html(parseFloat($new_total).toFixed(2));
            $('.setAmountForCoupon').val(parseFloat($new_total).toFixed(2));
            $('#paidAmount').val(parseFloat($new_total).toFixed(2));
            
            jQuery('.transactionItems input').remove();

            transactionItems = transactionItems.filter(item => item.itemName !== 'Rush Fee');

            jQuery('.transactionItems').append(`<input type="hidden" name="item" value='${JSON.stringify(transactionItems)}'>`);
        }
    })
    // ######### Rush Amount

    // ##################### Coupon Code #####################
    let coupon_discount_amount = 0;
    let total_amount_after_discount = 0;
    $('.applyCoupon').on("click", function () {
        // console.log('click');
        // Clear any existing error messages
        $('.error-message').remove();
        let error = 0;
        let code = $('#coupon_code').val() || $('#coupon_code1').val()
        // console.log(code)
        if (!code) {
           
            var errorMessagePhone = '<span class="error-message" style="color: red; padding-left: 5px;">Please Enter Coupon Code</span>';
            $('.showMessagePhone').after(errorMessagePhone);

            var errorMessageDesktop = '<br><span class="error-message" style="color: red; padding-left: 115px;">Please Enter Coupon Code</span>';
            $('.showMessageDestop').append(errorMessageDesktop);
            error = 1;
            // return swal('', "Please Enter Code", "error");
        }
        if (error == 1) {
            return false;
        }
        let totalAmount = $('.setAmountForCoupon').val();

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
                    // swal('', "oops! This code is invalid", "error");
                    var errorMessagePhone = '<span class="error-message" style="color: red; padding-left: 5px;">oops! This code is invalid</span>';
                    $('.showMessagePhone').after(errorMessagePhone);
        
                    var errorMessageDesktop = '<br><span class="error-message" style="color: red; padding-left: 115px;">oops! This code is invalid</span>';
                    $('.showMessageDestop').append(errorMessageDesktop);

                    return false;
                } else if (data.data.type == '2') {
                    // swal('', "oops! This code is already used", "error");
                    var errorMessagePhone = '<span class="error-message" style="color: red; padding-left: 5px;">oops! This code is already used</span>';
                    $('.showMessagePhone').after(errorMessagePhone);
        
                    var errorMessageDesktop = '<br><span class="error-message" style="color: red; padding-left: 115px;">oops! This code is already used</span>';
                    $('.showMessageDestop').append(errorMessageDesktop);

                    return false;
                } else if (data.data.type == '3') {
                    // swal('', "oops! This code is expired", "error");
                    var errorMessagePhone = '<span class="error-message" style="color: red; padding-left: 5px;">oops! This code is expired</span>';
                    $('.showMessagePhone').after(errorMessagePhone);
        
                    var errorMessageDesktop = '<br><span class="error-message" style="color: red; padding-left: 115px;">oops! This code is expired</span>';
                    $('.showMessageDestop').append(errorMessageDesktop);
                } else {
                    if (data.data.amount < 0) {
                        return swal('', "Your Total Amount Lower than Discount", "error");
                    } else {
                        let rush_amount_after_remove_coupon = $(".rushAmountDesktop input[type='checkbox']").is(":checked") || $(".rushAmountMobile input[type='checkbox']").is(":checked") ? 25 : 0;
                        swal('', "Success", "success");
                        coupon_discount_amount = "$" + data.data.discount;
                        total_amount_without_rush_after_discount = data.data.amount;
                        total_amount_after_discount = eval(data.data.amount + "+" + rush_amount_after_remove_coupon);
                        $('.totalAmount').text(total_amount_after_discount.toFixed(2))
                        $('.discountAmount').html('-' + coupon_discount_amount + ` <i class="far fa-times-circle remove_coupon_code" style="color: #ad7070;cursor: pointer;"></i>`)

                        $("#usedCouponCodeDiscountAmount").remove();
                        $("#studentsForm").prepend(`<input type="text" name="usedCouponCodeDiscountAmount" id="usedCouponCodeDiscountAmount" value="${coupon_discount_amount}">`);

                        $("#paidAmount").remove();
                        $("#paidAmount").val(total_amount_after_discount);
                        $("#studentsForm").prepend(`<input type="text" name="paidAmount" id="paidAmount" value="${total_amount_after_discount}">`);

                        $("#usedCouponCode").remove();
                        $("#studentsForm").prepend(`<input type="text" name="usedCouponCode" id="usedCouponCode" value="${code}">`);

                        appendTrasactionItems('Coupon Code - ' + code, 1, coupon_discount_amount);

                    }
                }
            },
        })
    })

    $('body').on("click", '.remove_coupon_code', function () {

        let rush_amount_after_remove_coupon = $(".rushAmountDesktop input[type='checkbox']").is(":checked") || $(".rushAmountMobile input[type='checkbox']").is(":checked") ? 25 : 0;
        let total_after_remove_coupon = parseFloat(coupon_discount_amount.replace('$', '')) + total_amount_without_rush_after_discount + rush_amount_after_remove_coupon;

        $('.totalAmount').text(total_after_remove_coupon.toFixed(2))

        $('.discountAmount').empty();

        $("#usedCouponCodeDiscountAmount").remove();

        $("#paidAmount").remove();
        $("#paidAmount").val(total_after_remove_coupon);
        $("#studentsForm").prepend(`<input type="text" name="paidAmount" id="paidAmount" value="${total_after_remove_coupon}">`);

        $("#usedCouponCode").remove();

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

    function setPayment() {
        $('.setAmount .setStudentRow').remove()
        $('.transactionItems input').remove();

        let kindergarten = 0;
        let grade_1 = 0;
        let grade_2 = 0;
        let grade_3 = 0;
        let grade_4 = 0;
        let grade_5 = 0;
        let grade_6 = 0;
        let grade_7 = 0;
        let grade_8 = 0;
        let hs_credit_8 = 0;
        let grade_9 = 0;
        let grade_10 = 0;
        let grade_11 = 0;
        let grade_12 = 0;
        let special_need_k8 = 0;
        let special_need_hs = 0;
        // let EachStudentPayBelow_8 = 50;
        // let EachStudentPayAfter_8 = 75;
        // let annualRegistrationFee = 0; // Processing Fee
        // let transferFee = 0;
        let addTransferFee = 0;
        // let renewal_app_fee = 0;
        // let reinstatement_fess = 0;
        let reinstatement_fess_count = 0;

        // console.log('data', data);
        data.map(function (item) {
            if (item.grade == 'Kindergarten') {
                kindergarten += 1;
            }
            if (item.grade == '1ST GRADE') {
                grade_1 += 1;
            }
            if (item.grade == '2ND GRADE') {
                grade_2 += 1;
            }
            if (item.grade == '3RD GRADE') {
                grade_3 += 1;
            }
            if (item.grade == '4TH GRADE') {
                grade_4 += 1;
            }
            if (item.grade == '5TH GRADE') {
                grade_5 += 1;
            }
            if (item.grade == '6TH GRADE') {
                grade_6 += 1;
            }
            if (item.grade == '7TH GRADE') {
                grade_7 += 1;
            }
            if (item.grade == '8TH GRADE') {
                grade_8 += 1;
            }
            if (item.grade == '9TH GRADE') {
                grade_9 += 1;
            }
            if (item.grade == '10TH GRADE') {
                grade_10 += 1;

                // if (item.questions.q3.ans3 == 'yes') {
                //     addTransferFee += 1
                // }
            }
            if (item.grade == '11TH GRADE') {
                grade_11 += 1;

                // if (item.questions.q3.ans3 == 'yes') {
                //     addTransferFee += 1
                // }
            }
            if (item.grade == '12TH GRADE') {
                grade_12 += 1;

                // if (item.questions.q3.ans3 == 'yes') {
                //     addTransferFee += 1
                // }
            }
            if (item.grade == '8TH WITH HS CREDIT') {
                hs_credit_8 += 1;
            }
            if (item.grade == 'K8 SPECIAL NEEDS') {
                special_need_k8 += 1;
            }
            if (item.grade == 'HS SPECIAL NEEDS') {
                special_need_hs += 1;
            }

            var checkExpireDate = moment(item.oldAccountExpire).format('YYYY-MM-DD');

            if (checkExpireDate != 'Invalid date') {
                let expireDateMoment = moment(checkExpireDate, "YYYY-MM-DD");
                let currentDate = moment().startOf('day');
                let daysDifference = moment.duration(currentDate.diff(expireDateMoment)).asDays();
                // console.log("daysDifference:", daysDifference);
                if (daysDifference > 30) {
                    reinstatement_fess_count += 1;
                }
            }
        })



        // ################## Set Renewal Application fee
        appendCartItem('Renewal Application Fee', 1, renewal_app_fee);
        appendTrasactionItems('Renewal Application Fee', 1, renewal_app_fee);
        // ################## Set Renewal Application fee



        // ################## Set Annual Registration fee
        // appendTrasactionItems('Annual Registration Fee',1,annualRegistrationFee);
        appendCartItem('Processing Fee', 1, annualRegistrationFee);
        appendTrasactionItems('Processing Fee', 1, annualRegistrationFee);

        // ################## Set Annual Registration fee


        // ################## Set Transfer Fee
        if (addTransferFee > 0) {
            appendCartItem('Transfer Fee', addTransferFee, transferFee);
            appendTrasactionItems('Transfer Fee', addTransferFee, transferFee);
        }
        // ################## Set Transfer Fee

        // ################## Set Reinstatement_fess Fee
        // var checkExpireDate = moment(expireDate).format('YYYY-MM-DD');

        // if (checkExpireDate != 'Invalid date') {
        //     let expireDateMoment = moment(expireDate, "YYYY-MM-DD");
        //     let currentDate = moment().startOf('day');

        //     //Difference in number of days
        //     let daysDifference = moment.duration(expireDateMoment.diff(currentDate)).asDays();

        //     // console.log('daysDifference', daysDifference);
        //     if (daysDifference > 30) {
        //         appendCartItem('Reinstatement Fee', 1, reinstatement_fess);
        //         appendTrasactionItems('Reinstatement Fee', 1, reinstatement_fess);
        //     }
        // }

        if (reinstatement_fess_count > 0) {
            appendCartItem('Reinstatement Fee', reinstatement_fess_count, reinstatement_fess);
            appendTrasactionItems('Reinstatement Fee', reinstatement_fess_count, reinstatement_fess);
        }
        // ################## Set Reinstatement_fess Fee

        if (special_need_hs) {
            appendCartItem('HS SPECIAL NEEDS', special_need_hs, EachStudentPayAfter_8);
            appendTrasactionItems('HS SPECIAL NEEDS', special_need_hs, EachStudentPayAfter_8);
        }
        if (special_need_k8) {
            appendCartItem('K-8 SPECIAL NEEDS', special_need_k8, EachStudentPayBelow_8);
            appendTrasactionItems('K-8 SPECIAL NEEDS', special_need_k8, EachStudentPayBelow_8);
        }
        if (grade_12) {
            appendCartItem('12TH GRADE', grade_12, EachStudentPayAfter_8);
            appendTrasactionItems('12TH GRADE', grade_12, EachStudentPayAfter_8);
        }

        if (grade_11) {
            appendCartItem('11TH GRADE', grade_11, EachStudentPayAfter_8);
            appendTrasactionItems('11TH GRADE', grade_11, EachStudentPayAfter_8);
        }
        if (grade_10) {
            appendCartItem('10TH GRADE', grade_10, EachStudentPayAfter_8);
            appendTrasactionItems('10TH GRADE', grade_10, EachStudentPayAfter_8);
        }
        if (grade_9) {
            appendCartItem('9TH GRADE', grade_9, EachStudentPayAfter_8);
            appendTrasactionItems('9TH GRADE', grade_9, EachStudentPayAfter_8);
        }
        if (hs_credit_8) {
            appendCartItem('8TH WITH HS CREDIT', hs_credit_8, EachStudentPayAfter_8);
            appendTrasactionItems('8TH WITH HS CREDIT', hs_credit_8, EachStudentPayAfter_8);
        }
        if (grade_8) {
            appendCartItem('8TH GRADE', grade_8, EachStudentPayBelow_8);
            appendTrasactionItems('8TH GRADE', grade_8, EachStudentPayBelow_8);
        }
        if (grade_7) {
            appendCartItem('7TH GRADE', grade_7, EachStudentPayBelow_8);
            appendTrasactionItems('7TH GRADE', grade_7, EachStudentPayBelow_8);
        }

        if (grade_6) {
            appendCartItem('6TH GRADE', grade_6, EachStudentPayBelow_8);
            appendTrasactionItems('6TH GRADE', grade_6, EachStudentPayBelow_8);
        }


        if (grade_5) {
            appendCartItem('5TH GRADE', grade_5, EachStudentPayBelow_8);
            appendTrasactionItems('5TH GRADE', grade_5, EachStudentPayBelow_8);
        }
        if (grade_4) {
            appendCartItem('4TH GRADE', grade_4, EachStudentPayBelow_8);
            appendTrasactionItems('4TH GRADE', grade_4, EachStudentPayBelow_8);
        }

        if (grade_3) {
            appendCartItem('3RD GRADE', grade_3, EachStudentPayBelow_8);
            appendTrasactionItems('3RD GRADE', grade_3, EachStudentPayBelow_8);
        }

        if (grade_2) {
            appendCartItem('2ND GRADE', grade_2, EachStudentPayBelow_8);
            appendTrasactionItems('2ND GRADE', grade_2, EachStudentPayBelow_8);
        }

        if (grade_1) {
            appendCartItem('1ST GRADE', grade_1, EachStudentPayBelow_8);
            appendTrasactionItems('1ST GRADE', grade_1, EachStudentPayBelow_8);
        }

        if (kindergarten) {
            appendCartItem('Kindergarten GRADE', kindergarten, EachStudentPayBelow_8);
            appendTrasactionItems('Kindergarten GRADE', kindergarten, EachStudentPayBelow_8);
        }

        let Total_1 = (kindergarten + grade_1 + grade_2 + grade_3 + grade_4 + grade_5 + grade_6 + grade_7 + grade_8 + special_need_k8) * EachStudentPayBelow_8
        let Total_2 = (hs_credit_8 + grade_9 + grade_10 + grade_11 + grade_12 + special_need_hs) * EachStudentPayAfter_8
        // console.log('Total_1', Total_1);
        // console.log('Total_2', Total_2);
        let Total = Total_1 + Total_2;
        // console.log('Total', Total);
        // console.log('renewal_app_fee', renewal_app_fee);
        // console.log('annualRegistrationFee', annualRegistrationFee);
        // console.log('transferFee', transferFee);
        Total += parseInt(renewal_app_fee) + parseInt(annualRegistrationFee) + parseInt(reinstatement_fess) + parseInt(transferFee * addTransferFee);
        // console.log('Total', Total);

        // $('.setAmountForCoupon').val(`${Total}`);
        if (Total > 195) {

            $(`
            <tr class="setStudentRow" style="background-color: #ffeb3b4f;">
                <td>Exceeded $195 Maximum Amount</td>
                <td>-</td>
                <td>-</td>
                <td>-$${(Total - 195)}.00</td>
            </tr>
            `).insertAfter($('.setAmount tbody .setStudentRow').last())

            $(`
            <li class="list-group-item d-flex justify-content-between lh-condensed setStudentRow" style="background-color: #ffeb3b4f;">
                <div>
                    <h6 class="my-0">Exceeded $195 Maximum Amount</h6>
                    <small class="text-muted">-</small>
                </div>
                <span class="text-muted">-$${(Total - 195)}.00</span>
            </li>
            `).insertAfter($('.setAmount .mobileReg  .setStudentRow').last())
            // Exceed Limit End

            $(`
            <tr class="setStudentRow">
                <td>Sub Total</td>
                <td>-</td>
                <td>-</td>
                <td>$${Total}.00</td>
            </tr>
            `).insertAfter($('.setAmount tbody .setStudentRow').last())
            $(`
            <li class="list-group-item d-flex justify-content-between lh-condensed setStudentRow">
                <div>
                    <h6 class="my-0">Sub Total</h6>
                    <small class="text-muted">-</small>
                </div>
                <span class="text-muted">$${Total}.00</span>
            </li>
            `).insertAfter($('.setAmount .mobileReg  .setStudentRow').last());
            // Subtotal End



            Total = 195;

        }

        $('.totalAmount').html(`${Total}.00`);
        $(".setAmountForCoupon").remove();
        $("#paidAmount").remove();
        jQuery("#studentsForm").prepend(`<input type="text" name="paidAmount" id="paidAmount" value="${Total}">`);
        jQuery(".appendCouponAmonnt").prepend(`<input type="hidden" class="setAmountForCoupon" value="${Total}"></input> `);

    }

});
// select student for renewal
function selectStudent(element) {
    if ($(element).is(':checked')) {
        let old_account_expire = $(element).data('account_expire');
        let new_account_expire = "";
        if (old_account_expire) {
            let currentExpireYear = new Date(old_account_expire).getFullYear();
            let nextYear = currentExpireYear + 1;
            new_account_expire = `${nextYear}-08-10`;
        }
        renewalStudentData.push({ 
            id: parseInt($(element).val()),
            grade: $(element).data('promoted_grade'),
            name: $(element).data('name'),
            new_account_expire: new_account_expire,
            old_account_expire: old_account_expire
        });
        // console.log('renewalStudentData in selectStudent:', renewalStudentData);

        // Check if all student checkboxes are now checked
        if ($('.student_check').length === $('.student_check:checked').length) {
            $('#select_all').prop('checked', true);
        }
    } else {    
        renewalStudentData = renewalStudentData.filter(student => student.id !== parseInt($(element).val()));
        $('#select_all').prop('checked', false);
        // console.log('renewalStudentData in selectStudent:', renewalStudentData);
    }
}

// set student grade and name
function selectGrade(element) {
    let grade = $(element).val();
    let student_id = $(element).data('student_id');

    // Find and update student grade in renewalStudentData array
    let student = renewalStudentData.find(student => student.id === student_id);
    if (student) {
        student.grade = grade;
    } else {
        // If student is not in array yet (checkbox not checked), create new entry
        let studentName = $(`#select_${student_id}`).data('name');
        let old_account_expire = $(`#select_${student_id}`).data('account_expire');
        let new_account_expire = "";
        if (old_account_expire) {
            let currentExpireYear = new Date(old_account_expire).getFullYear();
            let nextYear = currentExpireYear + 1;
            new_account_expire = `${nextYear}-08-10`;
        }
        // mark checked if not checked
        $(`#select_${student_id}`).prop('checked', true);
        renewalStudentData.push({
            id: student_id,
            grade: grade,
            name: studentName,
            old_account_expire: old_account_expire,
            new_account_expire: new_account_expire
        });
        
        // Check if all student checkboxes are now checked
        if ($('.student_check').length === $('.student_check:checked').length) {
            $('#select_all').prop('checked', true);
        }
    }
    // Also update the data-promoted_grade attribute on the checkbox for consistency
    $(`#select_${student_id}`).attr('data-promoted_grade', grade);
    // console.log('renewalStudentData in selectGrade:', renewalStudentData);
}

// Select all student for renewal
function selectAllStudents(element) {
    if ($(element).is(':checked')) {
        $('.student_check').prop('checked', true);
        // Reset the array to avoid duplicates
        renewalStudentData = [];
        $('.student_check').each(function() {
            let old_account_expire = $(this).data('account_expire');
            let new_account_expire = "";
            if (old_account_expire) {
                let currentExpireYear = new Date(old_account_expire).getFullYear();
                let nextYear = currentExpireYear + 1;
                new_account_expire = `${nextYear}-08-10`;
            }
            renewalStudentData.push({ 
                id: parseInt($(this).val()),
                grade: $(this).data('promoted_grade'),
                name: $(this).data('name'),
                new_account_expire: new_account_expire,
                old_account_expire: old_account_expire
            });
        });
        // console.log('renewalStudentData in selectAllStudents:', renewalStudentData);
    } else {
        $('.student_check').prop('checked', false);
        renewalStudentData = [];
        // console.log('renewalStudentData in selectAllStudents:', renewalStudentData);
    }
}

function appendTrasactionItems(item, quantity, price) {
    // Clear existing transaction items inputs
    jQuery('.transactionItems input').remove();

    // If item starts with "Coupon Code - ", remove any existing coupon code items
    if (item.startsWith("Coupon Code - ")) {
        transactionItems = transactionItems.filter(transaction => !transaction.itemName.startsWith("Coupon Code - "));
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

function appendCartItem(grade, studenClass, studentPayClass) {

    $('.setAmount tbody').prepend(`
    <tr class="setStudentRow">
        <td>${grade}</td>
        <td>${studenClass}</td>
        <td>$${studentPayClass}.00</td>
        <td>$${studenClass * studentPayClass}.00</td>
    </tr>
    `)

    $('.setAmount .mobileReg').prepend(`
    <li class="list-group-item d-flex justify-content-between lh-condensed setStudentRow">
        <div>
            <h6 class="my-0">${grade}</h6>
            <small class="text-muted">${studenClass} x ${studentPayClass}</small>
        </div>
        <span class="text-muted">$${studenClass * studentPayClass}.00</span>
    </li>
    `)
}

function isDate(txtDate) {
    var currVal = txtDate;
    if (currVal == '')
        return false;

    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; //Declare Regex
    var dtArray = currVal.match(rxDatePattern); // is format OK?

    if (dtArray == null)
        return false;

    //Checks for mm/dd/yyyy format.
    dtMonth = dtArray[1];
    dtDay = dtArray[3];
    dtYear = dtArray[5];

    if (dtMonth < 1 || dtMonth > 12)
        return false;
    else if (dtDay < 1 || dtDay > 31)
        return false;
    else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31)
        return false;
    else if (dtMonth == 2) {
        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
        if (dtDay > 29 || (dtDay == 29 && !isleap))
            return false;
    }
    return true;
}

function validateNumber(phone, id, countryCode) {

    // Remove all non-digit characters
    phone = phone.replace(/[^\d]/g, '');

    // For US/Canada (+1)
    if (countryCode === '+1' || countryCode === '+1c') {
        if (phone.length > 0) {
            // Format as (XXX) XXX-XXXX
            if (phone.length <= 3) {
                phone = '(' + phone;
            } else if (phone.length <= 6) {
                phone = '(' + phone.substring(0,3) + ') ' + phone.substring(3);
            } else if (phone.length <= 14) {
                phone = '(' + phone.substring(0,3) + ') ' + phone.substring(3,6) + '-' + phone.substring(6);
            }
            
            // Limit to 10 digits total
            if (phone.length > 14) {
                phone = phone.substring(0, 14);
            }
        }
    } else {
        // For other country codes, just add dashes
        // if (phone.length > 3 && phone.length <= 6) {
        //     phone = phone.substring(0,3) + '-' + phone.substring(3);
        // } else if (phone.length > 6) {
        //     phone = phone.substring(0,3) + '-' + phone.substring(3,6) + '-' + phone.substring(6);
        // }

        // Limit to 10 digits total
        if(phone.length > 10) {
            phone= phone.substring(0, 10);
        }
    }

    $(id).val(phone);
}

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function formatPhoneNumber(phone, country) {
    if (country === '+1' || country === '+1c') {
        // format US phone number as (XXX) XXX-XXXX
            return `(${phone.slice(0,3)}) ${phone.slice(3,6)}-${phone.slice(6)}`;
    } else {
        // For non-US numbers, format as XXX-XXX-XXXX
        // return phone.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
        return phone;
    }   
}

function NumberremoveFormat(phone) {
    return phone.replace(/[^\d]/g, '');
}