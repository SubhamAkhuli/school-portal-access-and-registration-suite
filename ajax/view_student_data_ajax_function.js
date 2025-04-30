// show Student Data
jQuery(document).ready(function(){

    // console.log('view_student_data_ajax_function.js loaded');
    // form url get parameter
    const urlParams = new URLSearchParams(window.location.search);
    const registration_id = urlParams.get('rid');

    if (!registration_id) {
        $('.container').html('<div class="alert alert-danger text-center">No Data Found</div>');
        return;
    }

    jQuery.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action':'get_students_data_by_registration_id',
            'registration_id': registration_id
        },
        success: function(data){
            // console.log(data);

            student_data = data.data.student_data;
            
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
                            ? formatPhoneNumber( JSON.parse(student.student_transfer).school_number_country_code, phoneNumber)
                            : '';
                        studentcard = `
                            <div class="card mt-3 shadow-sm hover-shadow" id="student-card_${student_id}">
                                <div class="card-body p-4">
                                    <div class="d-flex gap-4 position-relative">
                                        <!-- Student Photo Section -->
                                        <div class="student-photo-wrapper">
                                            <div class="student-image rounded-circle border border-2 border-primary p-1" id="student-photo_${student_id}">
                                                ${
                                                    student.student_profile_pic
                                                        ? `<img src="${student.student_profile_pic}" alt="${fullName}" 
                                                            class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">`
                                                        : '<i class="fa-solid fa-user-circle fa-4x text-primary"></i>'
                                                }
                                            </div>
                                        </div>

                                        <!-- Student Info Section -->
                                        <div class="student-info flex-grow-1" id="student-info_${student_id}">
                                            <h3 class="mb-2 text-primary" id="fullName_${student_id}">
                                                <i class="fa-solid fa-graduation-cap me-2"></i>${fullName}
                                            </h3>
                                            <h6 class="text-muted mb-3" id="gradeLevel_${student_id}">
                                                <i class="fa-solid fa-book me-2"></i>Grade Level: ${student.grade}
                                            </h6>
                                            ${
                                                student.student_transfer !== "[]"
                                                    ? `<button class="btn btn-primary rounded-pill px-4 py-2 shadow-sm" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#transferModal" 
                                                        id="viewTransferDetailsBtn_${student_id}"
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

                                        <!-- Action Buttons -->
                                        <div class="action-buttons d-flex gap-2">
                                            <div>
                                                <a href="/edit-student/?sid=${student_id}" class="btn btn-sm text-white rounded-circle shadow-sm" title="Edit" style="background-color: #456fb6 !important;">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <button class="btn text-white btn-sm rounded-circle shadow-sm" title="Delete" style="background-color: #456fb6 !important;" data-student-id="${student_id}"
                                                onclick="deleteStudent(${student_id})">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn text-white btn-sm rounded-circle shadow-sm"  style="background-color: #456fb6 !important;" data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-ellipsis"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                                    <li><a class="dropdown-item py-2" href="/view-class/?sid=${student_id}">
                                                        <i class="fa-solid fa-chalkboard me-2"></i>Classes
                                                    </a></li>
                                                    <li><a class="dropdown-item py-2" href="/view-transcript/?sid=${student_id}">
                                                        <i class="fa-solid fa-file-alt me-2"></i>Transcripts
                                                    </a></li>
                                                    <li><a class="dropdown-item py-2" href="/view-attendance/?sid=${student_id}">
                                                        <i class="fa-solid fa-calendar-check me-2"></i>Attendance
                                                    </a></li>
                                                </ul>
                                            </div>
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
            } else {
                $('#student-container').html('<div class="alert alert-danger text-center">No student data found</div>');
            }
        }
    });

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

    // automatically calculate age from dob
    $('#dob').on('change', function() {
        // console.log('dob:', $(this).val());
        var dobValue = $(this).val(); // Gets YYYY-MM-DD format
        var dob = new Date(dobValue);
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();
        var m = today.getMonth() - dob.getMonth();

        // // Check if date is valid
        // if (!dobValue || dob == "Invalid Date") {
        //     console.log("Invalid date:", dobValue);
        //     swal("", "Please enter a valid date", "error");
        //     $(this).val('');
        //     $('.addStudentForm #age').val('');
        //     return;
        // }

        // Check if date is in future
        if (dob > today) {
            // console.log("Future date entered:", dobValue);
            swal("", "Date of birth cannot be in the future!", "error");
            $(this).val('');
            $('.addStudentForm #age').val('');
            return;
        }

        // Check if age is too high  
        // if (age > 100) {
        //     console.log("Invalid age calculated:", age);
        //     swal("", "Please enter a valid date of birth!", "error");
        //     $(this).val('');
        //     $('.addStudentForm #age').val('');
        //     return;
        // }

        // Adjust age if birthday hasn't occurred this year
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        // Set the age value
        $('.addStudentForm #age').val(age);

        // Update input class for styling
        $(this).toggleClass('has-value', dobValue !== '');
    });

    // Set default image
    $('.addStudentForm #gender').on('change', function() {
        const gender = $(this).val();
        const imgElement = $('#preview-profile-img');
         if (gender === 'male') {
            imgElement.attr('src', ajax_object.base_url + 'img/new_male_default.png');
            // $('.show_immunization_file_name').html(``);
        } else if (gender === 'female') {
            imgElement.attr('src', ajax_object.base_url + 'img/new_female_default.png');
            // $('.show_immunization_file_name').html(``);
        } else {
            imgElement.attr('src', ajax_object.base_url + 'img/new_profile_default.png');
            // $('.show_immunization_file_name').html(``);
        }
    });

    // Show please_describe field
    $('.addStudentForm .ans1').on('change', function() {
        let ansValue = $(this).val();
        if(ansValue === 'no') {
            swal("", "We cannot accept the application at this time.", "info").then(() => {
                $(this).val('-1').trigger('change');
                $('.addStudentForm .please_describe').addClass('hide');
                $('.addStudentForm #please_describe').val('');
            });
        } else if(ansValue === 'not applicable') {
            $('.addStudentForm .please_describe').removeClass('hide');
        }
        else {
            $('.addStudentForm .please_describe').addClass('hide');
            $('.addStudentForm #please_describe').val('');
        }
    });

    // Show Student Transfer fields
    $('.addStudentForm .ans3').on('change', function() {
        let ansValue = $(this).val();
        if(ansValue === 'yes') {
            $('.addStudentForm .transfer-details').removeClass('hide');
        } else {
            $('.addStudentForm .transfer-details').addClass('hide');
            $('.addStudentForm .transfer-details input').val('');
        }
    });

    // Save Student Data
    $('.save_student').on('click', function(e) {
        e.preventDefault();

        // Get basic student info
        let first_name = $('#student_f_name').val();
        let middle_name =  $('#student_m_name').val(); 
        let last_name = $('#student_l_name').val();
        let dob = $('#dob').val();
        let state = $('.addStudentForm #state').val();
        let county = $('.addStudentForm #county').val();
        let age = $('#age').val();
        let grade = $('#student_grade').val();
        let gender = $('#gender').val();
        let year_paying = $('#study_year').val();
        let ans1 = $('#parental_agreement').val();
        let please_describe = $('#please_describe').val();
        let ans2 = $('#truancy').val();
        let ans3 = $('#transfer_student').val();
        let student_profile_pic = $('#preview-profile-img').attr('src'); 
        let immunization_file_name = $('#immunization_file').prop('files')[0]?.name || '';
        let immunization_file_url = $('#immunization_file_url').val();

        // transfer details
        let school_type = $('#add_student_school_type').val();
        let school_name = $('#add_student_schoolName').val();
        let school_phone = $('#add_student_schoolPhone').val();
        let school_country_code = $('#add_student_school_country_code').val();
        let school_email = $('#add_student_schoolEmail').val();
        let school_address = $('#add_student_schoolAddress').val();
        let school_city = $('#add_student_schoolCity').val();
        let school_state = $('.transfer-details #state').val();
        let school_county = $('.transfer-details #county').val();
        let school_zip_code = $('#add_student_schoolZipCode').val();
        let last_date_of_study = $('#add_student_lastDateOfStudy').val();
        let student_transfer = JSON.stringify({});

        school_phone = NumberremoveFormat(school_phone);

        // Validate required fields
        if (!first_name || !last_name || state === '-1' || 
            county === '-1' || !grade || gender === '-1' || age === '' || dob === '') {
            swal("Error", "Please fill in all required fields", "error");
            return;
        }else if (year_paying === '-1' || ans1 == '-1' || ans2 == '-1' || ans3 == '-1') {
            swal("", "Please Select your Answer!", "error");
            return;
        } else if (ans2 == 'yes') {
            swal("", "We are Unable to Accept This Application at This Time", "error");
            return;
        }

        // Get transfer details if applicable
        if (ans3 === 'yes') {

            if (!school_type || !school_name || !school_phone || !school_country_code || !school_email || !school_address || !school_city || !school_state || !school_county || !school_zip_code || !last_date_of_study) {
                
                swal("Error", "Please fill in all transfer details", "error");
                return;
            } else if (!isValidPhoneNumber(school_phone)) {
                swal("Error", "Please enter a valid phone number", "error");
                return;
            } else if (!isValidEmail(school_email)) {
                swal("Error", "Please enter a valid email address", "error");
                return;
            } else {
                student_transfer = JSON.stringify(
                {
                    "school_type": school_type,
                    "school_name": school_name,
                    "school_number": school_phone, // corrected variable name
                    'school_number_country_code': school_country_code, // corrected variable name
                    "school_email": school_email,
                    "school_address": school_address,
                    "school_city": school_city,
                    "school_zip_code": school_zip_code,
                    "school_state": school_state,
                    "school_county": school_county,
                    "school_last_date": last_date_of_study, // corrected variable name
                    'school_email_is_double_check': true
                });
            }
        }


        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'save_new_student_data',
                registration_id: registration_id,
                first_name: first_name,
                middle_name: middle_name,
                last_name: last_name,
                dob: dob,
                state: state,
                county: county,
                age: age,
                grade: grade,
                gender: gender,
                year_paying: year_paying,
                answer_3: ans3, 
                questions: JSON.stringify({
                    q1: {
                        q: 'Are both parents (when applicable) in agreement to homeschooling this student and registering them with Graduates Academy?',
                        ans1
                    },
                    q2: {
                        q: 'Truancy/Expulsion - Does this Student have prior truancy, expulsion, suspension, or misdemeanor issues?',
                        ans2
                    },
                    q3: {
                        q: 'Is this Student transferring from another school or umbrella program?',
                        ans3
                    },
                    please_describe
                }),
                student_profile_pic: student_profile_pic,
                immunization_file_name: immunization_file_name,
                immunization_file_url: immunization_file_url,
                student_transfer: student_transfer
            },
            success: function(response) {
                if (response.success) {
                    swal("Success", "Student saved successfully", "success")
                    .then(() => {
                        $('#addStudentModal').modal('hide');
                        location.reload();
                    });
                } else {
                    swal("Error", "Failed to save student", "error");
                }
            },
            error: function() {
                swal("Error", "Server error occurred", "error");
            }
        });
    });
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

// Delete Student
function deleteStudent(student_id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this student data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            jQuery.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    'action':'delete_student',
                    'student_id': student_id
                },
                success: function(data){
                    // console.log(data);

                    if(data.success){
                        $(`#student-card_${student_id}`).remove();
                        swal("Student has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Oops! Something went wrong", {
                            icon: "error",
                        });
                    }
                }
            });
        }
    });
}

// validate phone number
function validateNumber(phone, id) {
    // Get the selected country code
    let countryCode = $(id).closest('.row').find('#add_student_school_country_code').val();
    
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
        // if(phone.length > 12) {
        //     phone= phone.substring(0, 12);
        // }
        if(phone.length > 10) {
            phone= phone.substring(0, 10);
        }
    }

    $(id).val(phone);
}

// Format phone number
function NumberremoveFormat(phone) {
    return phone.replace(/[^\d]/g, '');
}

// Format phone number function
function formatPhoneNumber(country, phone) {
    if (country === '+1') {
        // format US phone number as (XXX) XXX-XXXX
            return `${country} (${phone.slice(0,3)}) ${phone.slice(3,6)}-${phone.slice(6)}`;
    }else if (country === '+1c') {
        country = '+1';
        // format US phone number as (XXX) XXX-XXXX
            return `${country} (${phone.slice(0,3)}) ${phone.slice(3,6)}-${phone.slice(6)}`;
    }else {
        // For non-US numbers, format as XXX-XXX-XXXX
        // return `${country} ${phone.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3')}`;
        return `${country} ${phone}`;
    }   
}

// Function to check phone number is valid or not
function isValidPhoneNumber(phone) {
    // Enhanced phone pattern
    var phonePattern = /^[0-9]{10}$/;

    // Check if phone matches the pattern
    if (!phonePattern.test(phone)) {
        return false;
    }

    // check length of phone number
    if (phone.length !== 10) {
        return false;
    }

    // If all checks pass
    return true;
}

// Function to check email is valid or not
function isValidEmail(email) {
    // Enhanced email pattern
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Check if email matches the pattern
    if (!emailPattern.test(email)) {
        return false;
    }

    // Check for excessive length
    if (email.length > 254) {
        return false;
    }

    // Check for double dots in domain
    if (email.includes('..')) {
        return false;
    }

    // Check for starting or ending with a dot or hyphen
    if (/^[.-]|[.-]$/.test(email)) {
        return false;
    }

    // Check for valid domain format
    var domain = email.split('@')[1];
    if (!domain || domain.split('.').some(part => part.length > 63)) {
        return false;
    }

    // If all checks pass
    return true;
}

// Set Data in Immunization modal
function viewImmunizationFile(e) {
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
            .catch(error => console.error('Error downloading file:', error));
    };
}