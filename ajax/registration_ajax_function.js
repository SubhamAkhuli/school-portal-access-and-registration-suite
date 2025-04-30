let course = []
let edit_course = []
let user_id = '';
let student_id = '';
let studentArr = [];
let transactionItems = [];


let EachStudentPayBelow_8_price = 50;
let EachStudentPayAfter_8_price = 75;
let annualRegistrationFee_price = 0; // Processing Fee
let transferFee_price = 0; // Transfer Fee
let addTransferFee_price = 0;
let family_app_fee_price = 50;

$(document).ready(function () {

    let parent_1 = {};
    let parent_2 = {};
    let additional_information = {};
    let address = {};
    let student_tranfer = {};
    let student = {};
    let student_application = {};
    let digital_signature = {};
    let data = [];
    let edit_flag = false;
    let edit_data_index = null;
    let add_student_btn = false;
    let immunization_file_name = '';
    let immunization_file = '';
    let student_profile_pic = '';
    
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

    // set the ask Registration year page 
    const currentYear = new Date().getFullYear();
    const nextYear = currentYear + 1;

    // Get User ID
    // function getUrlData() {
    //     var params = new window.URLSearchParams(window.location.search);
    //     return params.get('rid');
    // }

    // from the url get rid 
    // let rid = getUrlData();

    // if (rid==null) {
    //     swal('Please Register first!', '','error').then(function() {
    //         window.location.href = '/login';
    //     });
    // }
    // else {
        $("body").addClass("loading");
        // get all data
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'action': 'get_registration_data',
                // 'registration_id': rid
            },
            success: function (data) {
                // console.log(data)

                if (data.success) {
                    response = data.data;
                    // console.log("response", response);  
                    EachStudentPayBelow_8_price = response.each_student_pay_below_8;
                    EachStudentPayAfter_8_price = response.each_student_pay_after_8;
                    annualRegistrationFee_price = response.processing_fee; // Processing Fee
                    transferFee_price = response.transfer_fee; // Transfer Fee
                    family_app_fee_price = response.family_app_fee;

                    if (data.data.status == 'complete') {
                        swal('Registration already completed.', '', 'success');
                        window.location.href = '/login';
                    }
                    else if (data.data.message == 'Registration not found.') {
                        swal('Registration not found.', '', 'error');
                        window.location.href = '/login';
                    }
                    else if(data.data.status == 'Not Started') {
                        $('.parent_1 #parent_email').val(data.data.email);
                    }
                    else {
                        // let studentArr = [];
                        if (data.data.parent_1_data) {
                            $('.parent_1 #role').val(data.data.parent_1_data.role).trigger('change');
                            $('.parent_1 #parent_f_name').val(data.data.parent_1_data.first_name)
                            $('.parent_1 #parent_m_name').val(data.data.parent_1_data.middle_name)
                            $('.parent_1 #parent_l_name').val(data.data.parent_1_data.last_name)
                            $('.parent_1 #parent_email').val(data.data.parent_1_data.email)
                            $('.parent_1 #country_code').val(data.data.parent_1_data.country_code).trigger('change');
                            let phone = data.data.parent_1_data.phone;
                            // console.log(phone);
                            if(phone) {
                                phone = formatPhoneNumber(phone, data.data.parent_1_data.country_code);
                            }
                            $('.parent_1 #parent_contact').val(phone);
                            // console.log(phone);
                            // $('.parent_1 .payingYear').val(`${data.data.parent_1_data.yearPaying}`);
                            $('.parent_1 #heard_about_us').val(data.data.parent_1_data.heard_about_us);
                            let parent1Questions = JSON.parse(data.data.parent_1_data.questions).questions;
                            $('.parent_1 .reg_1 .ans1').val(parent1Questions.q1.ans1).trigger('change');
                            $('.parent_1 .reg_1 .ans2').val(parent1Questions.q2.ans2).trigger('change');
                            $('.parent_1 .reg_1 .ans3').val(parent1Questions.q3.ans3).trigger('change');
                            $('.parent_1 .reg_1 .ans4').val(parent1Questions.q4.ans4).trigger('change');
                            $('.parent_1 .reg_1 .ans5').val(parent1Questions.q5.ans5).trigger('change');
                            $('.parent_1 .reg_1 .ans6').val(parent1Questions.q6.ans6).trigger('change');
                        }

                        if (data.data.parent_2_data) {
                            $('.parent_2 #role').val(data.data.parent_2_data.role).trigger('change');
                            $('.parent_2 #f_name').val(data.data.parent_2_data.first_name)
                            $('.parent_2 #m_name').val(data.data.parent_2_data.middle_name)
                            $('.parent_2 #l_name').val(data.data.parent_2_data.last_name)
                            $('.parent_2 #email').val(data.data.parent_2_data.email)
                            $('.parent_2 #country_code').val(data.data.parent_2_data.country_code).trigger('change');
                            let phone = data.data.parent_2_data.phone;
                            if(phone) {
                                phone = formatPhoneNumber(phone, data.data.parent_2_data.country_code);
                            }
                            $('.parent_2 #contact').val(phone);
                            let parent2Questions = JSON.parse(data.data.parent_2_data.questions).questions;
                            $('.parent_2 .reg_1 .ans1').val(parent2Questions.q1.ans1).trigger('change');
                            $('.parent_2 .reg_1 .ans2').val(parent2Questions.q2.ans2).trigger('change');
                            $('.parent_2 .reg_1 .ans3').val(parent2Questions.q3.ans3).trigger('change');
                            $('.parent_2 .reg_1 .ans4').val(parent2Questions.q4.ans4).trigger('change');
                            $('.parent_2 .reg_1 .ans5').val(parent2Questions.q5.ans5).trigger('change');
                        }

                        if (data.data.additional_info_data) {
                            let additionalQuestions = JSON.parse(data.data.additional_info_data.questions).questions;
                            $('.additional_info .reg_1 .ans1').val(additionalQuestions.q1.ans1).trigger('change');
                            $('.additional_info .reg_1 .ans2').val(additionalQuestions.q2.ans2).trigger('change');
                            $('.additional_info .reg_1 .ans3').val(additionalQuestions.q3.ans3).trigger('change');
                            $('.additional_info .reg_1 .ans4').val(additionalQuestions.q4.ans4).trigger('change');
                            $('.additional_info .reg_1 .ans5').val(additionalQuestions.q5.ans5).trigger('change');
                            $('.additional_info .reg_1 .explanation textarea').val(additionalQuestions.explanation);

                        }

                        if (data.data.parent_address_data) {
                            $('.address_box #city').val(data.data.parent_address_data.city);
                            $('.address_box #zip_code').val(data.data.parent_address_data.zip);
                            $('.address_box #street_address').val(data.data.parent_address_data.address);
                            $('.address_box #state').val(data.data.parent_address_data.state).trigger('change');
                            $('.address_box #county').val(data.data.parent_address_data.county).trigger('change');
                            $('.address_box #emergency_name').val(data.data.parent_address_data.emg_contact_name);
                            $('.address_box #country_code').val(data.data.parent_address_data.country_code).trigger('change');
                            let phone = data.data.parent_address_data.emg_contact_phone;
                            if(phone) {
                                phone = formatPhoneNumber(phone, data.data.parent_address_data.country_code);
                            }
                            $('.address_box #emergency_number').val(phone);
                        }

                        if (data.data.student_application_data) {
                            let studentApplicationQuestions = JSON.parse(data.data.student_application_data.questions);
    
                            if (studentApplicationQuestions.q1.ans === true) {
                                $('.student_application .description').removeClass('hide');
                                $('.student_application .check1').prop("checked", true);
                            }
                            if (studentApplicationQuestions.q2.ans === true) {
                                $('.student_application .description').removeClass('hide');
                                $('.student_application .check2').prop("checked", true);
                            }
                            if (studentApplicationQuestions.q3.ans === true) {
                                $('.student_application .description').removeClass('hide');
                                $('.student_application .check3').prop("checked", true);
                            }
                            if (studentApplicationQuestions.q4.ans === true) {
                                $('.student_application .description').removeClass('hide');
                                $('.student_application .check4').prop("checked", true);
                            }
                            if (studentApplicationQuestions.q5.ans === true) {
                                $('.student_application .check5').prop("checked", true);
                            }
                            if (studentApplicationQuestions.q6.ans === true) {
                                $('.student_application .check6').prop("checked", true);
                            }
                            if (studentApplicationQuestions.description) {
                                $('.student_application .description textarea').html(studentApplicationQuestions.description);
                            }
                        }

                        if (data.data.student_data) {
                            data.data.student_data.forEach(student => {
                                $('#student_id').val(student.id);
                                // Parse JSON strings
                                let studentQuestions = JSON.parse(student.questions);
                                let studentTransfer = student.student_transfer !== "[]" ? JSON.parse(student.student_transfer) : null;
                                let studentCourse = student.student_course !== null ? JSON.parse(student.student_course) : [];

                                // Format phone number if exists in transfer data
                                if (studentTransfer && studentTransfer.school_number) {
                                    studentTransfer.school_number = studentTransfer.school_number.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
                                }

                                // Create student object in desired format
                                let studentObj = {
                                    student_id: student.id,
                                    student: student.student,
                                    f_name: student.first_name,
                                    m_name: student.middle_name,
                                    l_name: student.last_name,
                                    dob: student.dob,
                                    age: student.age,
                                    yearPaying: student.year_paying,
                                    grade: student.grade,
                                    country: student.country || null,
                                    county: student.county,
                                    state: student.state,
                                    gender: student.gender,
                                    coop_name: student.coop_name,
                                    course: studentCourse.map(course => ({
                                        studentGrade: course.studentGrade,
                                        courseName: course.courseName,
                                        publisher: course.publisher,
                                        semester: course.semester,
                                        grade: course.grade,
                                        credit: course.credit,
                                        description: course.description,
                                        additional: course.additional,
                                        schedule: course.schedule
                                    })),
                                    immunization_file_name: student.immunization_file_name,
                                    immunization_file: student.immunization_file_url,
                                    student_profile_pic: student.student_profile_pic,
                                    questions: studentQuestions,
                                    transfer: studentTransfer
                                        ? {
                                            school_type: studentTransfer.school_type,
                                            school_name: studentTransfer.school_name,
                                            school_number: studentTransfer.school_number,
                                            school_number_country_code: studentTransfer.school_number_country_code,
                                            school_email: studentTransfer.school_email,
                                            school_address: studentTransfer.school_address,
                                            school_city: studentTransfer.school_city,
                                            school_zip_code: studentTransfer.school_zip_code,
                                            school_state: studentTransfer.school_state,
                                            school_county: studentTransfer.school_county,
                                            school_last_date: studentTransfer.school_last_date
                                        }
                                        : null
                                };

                                // save student in array
                                studentArr.push(studentObj);
                                // data = studentArr;

                                // Populate form fields with data
                                $('.add_student #student_f_name').val(student.first_name);
                                $('.add_student #student_m_name').val(student.middle_name);
                                $('.add_student #student_l_name').val(student.last_name);
                                $('.add_student #dob').val(student.dob);
                                $('.add_student #age').val(student.age);
                                $('.add_student #student_grade').val(student.grade);
                                $('.add_student #country').val(student.country);
                                $('.add_student #state').val(student.state).trigger('change');
                                $('.add_student #county').val(student.county).trigger('change');
                                $('.add_student #gender').val(student.gender);
                                $('.add_student #coop_name').val(student.coop_name);
                                $('.add_student .reg_1 .ans1').val(studentQuestions.q1.ans1).trigger('change');
                                $('.add_student .reg_1 #please_describe').val(studentQuestions.please_describe);
                                $('.add_student .reg_1 .ans2').val(studentQuestions.q2.ans2).trigger('change');
                                $('.add_student .reg_1 .ans3').val(studentQuestions.q3.ans3).trigger('change');

                                // Set profile image and immunization file if they exist
                                if (student.student_profile_pic && student.immunization_file_name && student.immunization_file_url) {
                                    let img_url = student.student_profile_pic.replace('http://', 'https://');
                                    $('#preview-profile-img').attr('src', img_url);
                                    $('#immunization_file_url').val(student.immunization_file_url);

                                    $('.show_immunization_file_name').html(`
                                        <span>${student.immunization_file_name}</span>
                                        <i class="far fa-times-circle pl-3 pt-1 delete_file text-danger"></i>
                                    `);
                                }
                                else{
                                    // $('#preview-profile-img').attr('src', ajax_object.base_url + 'img/new_profile_default.png');
                                    if (student.gender=='male'){
                                        $('#preview-profile-img').attr('src', ajax_object.base_url + 'img/new_male_default.png');
                                    } else if (student.gender == 'female'){
                                        $('#preview-profile-img').attr('src', ajax_object.base_url + 'img/new_female_default.png');
                                    } else {
                                        $('#preview-profile-img').attr('src', ajax_object.base_url + 'img/new_profile_default.png');
                                    }
                                    $('.show_immunization_file_name').html(``);
                                    $('#immunization_file_url').val('');
                                }

                                // Set transfer data if exists
                                if (studentTransfer) {
                                    $('.student_transfer #school_type').val(studentTransfer.school_type).trigger('change');
                                    $('.student_transfer #school_name').val(studentTransfer.school_name);
                                    $('.student_transfer #country_code').val(studentTransfer.school_number_country_code).trigger('change');
                                    if(studentTransfer.school_number_country_code) {
                                        phone = formatPhoneNumber(studentTransfer.school_number, studentTransfer.school_number_country_code);
                                    }
                                    $('.student_transfer #school_number').val(phone);
                                    $('.student_transfer #school_email').val(studentTransfer.school_email);
                                    $('.student_transfer #school_address').val(studentTransfer.school_address);
                                    $('.student_transfer #school_city').val(studentTransfer.school_city);
                                    $('.student_transfer #school_zip_code').val(studentTransfer.school_zip_code);
                                    $('.student_transfer #state').val(studentTransfer.school_state).trigger('change');
                                    $('.student_transfer #county').val(studentTransfer.school_county).trigger('change');
                                    $('.student_transfer #school_last_date').val(studentTransfer.school_last_date);
                                    if (studentTransfer.school_email_is_double_check) {
                                        $(".studentTranferEmailCheckBox input[type='checkbox']").prop("checked", true);
                                    }
                                } else{
                                    $('.student_transfer #school_type').val('').trigger('change');
                                    $('.student_transfer #school_name').val('');
                                    $('.student_transfer #country_code').val('').trigger('change');
                                    $('.student_transfer #school_number').val('');
                                    $('.student_transfer #school_email').val('');
                                    $('.student_transfer #school_address').val('');
                                    $('.student_transfer #school_city').val('');
                                    $('.student_transfer #school_zip_code').val('');
                                    $('.student_transfer #state').val('-1').trigger('change');
                                    $('.student_transfer #county').val('-1').trigger('change');
                                    $('.student_transfer #school_last_date').val('');
                                    $(".studentTranferEmailCheckBox input[type='checkbox']").prop("checked", false);
                                }

                                // Set course data and render if exists
                                if (studentCourse.length > 0) {
                                    course = studentCourse.map(c => ({
                                        studentGrade: c.studentGrade,
                                        courseName: c.courseName,
                                        publisher: c.publisher,
                                        semester: c.semester,
                                        grade: c.grade,
                                        credit: c.credit,
                                        description: c.description,
                                        additional: c.additional,
                                        schedule: c.schedule
                                    }));
                                    renderCourse();
                                } else {
                                    renderCourse();
                                }

                                // Set digital signature if exists
                                if (student.digital_signature !== null) {
                                    let digitalSignatureData = JSON.parse(student.digital_signature);
                                    $('#signature_f_name').val(digitalSignatureData.f_name);
                                    $('#signature_l_name').val(digitalSignatureData.l_name);
                                    $('#signature_date').val(digitalSignatureData.date);
                                    // $('#signature-image').attr('src', digitalSignatureData.image);
                                    // $('#signature-image-box').css('display', 'block');
                                    if (digitalSignatureData.check) {
                                        $(".privacyBox input[type='checkbox']").prop("checked", true);
                                    }
                                }
                                
                            });
                        }
                        // let data = studentArr;     
                        // console.log(studentArr); 
                        // data = studentArr;    
                        // setTimeout(() => {
                        //     $("body").removeClass("loading");
                        //     // console.log('all load')
                        // }, 1000);
                    }
                    setTimeout(() => {
                        $("body").removeClass("loading");
                        // console.log('all load')
                    }, 1000);
                }
                else{
                    $("body").removeClass("loading");
                }
            }
        })           
    // }

    // console.log(data);
    // ############## SET IMMUNIZATION FILE Start ####################
    $('#immunization_file').on("change", function () {

        var formData = new FormData();
        formData.append('action', 'ajax_handle_fileUpload');
        formData.append('file', $('#immunization_file')[0].files[0]);
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            contentType: false,
            processData: false,
            data: formData,
            success: function (data) {
                // console.log(data);
                // console.log(data.data.media_url);
                // $('#preview-profile-img').attr('src', data.data.media_url);
                immunization_file_name = $('#immunization_file')[0].files[0].name;
                immunization_file = data.data.media_url;
                $('#immunization_file_url').val(data.data.media_url);
                // student_profile_pic = data.data.media_url;
                
                $('.show_immunization_file_name').html(`
            <span>
                ${$('#immunization_file')[0].files[0].name}
            </span>
            <i class="far fa-times-circle pl-3 pt-1 delete_file text-danger"></i>`)
            },
        })
    })
    $('body').on('click', ".delete_file", function () {
        // previousSrc = ajax_object.base_url +  'img/new_profile_default.png';
        // $('#preview-profile-img').attr('src', previousSrc);
        $('.show_immunization_file_name').html(``);
        $('#immunization_file_url').val('');
        immunization_file_name = '';
        immunization_file = '' ;
    })
    // ############## SET IMMUNIZATION FILE End ####################

    // ############## SET PROFILE IMAGE Start ####################
    $('#student-profile').on("change", function () {
        // console.log("Clicked:" )
        var formData = new FormData();
        formData.append('action', 'ajax_handle_fileUpload');
        formData.append('file', $('#student-profile')[0].files[0]);
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            contentType: false,
            processData: false,
            data: formData,
            success: function (data) {
                // console.log(data);
                // console.log(data.data.media_url);
                $('#preview-profile-img').attr('src', data.data.media_url);
                student_profile_pic = data.data.media_url;
            },
        })
    })
    // ############## SET PROFILE IMAGE End ####################

    // console.log(studentArr);
    // $('.modal-backdrop ').hide();

    // $('#expiry').on('input', function (e) {
    //     if ($(this).val().length == 2) {
    //         $(this).val($(this).val() + '/');
    //     }
    // });
    // $('.paymentBox').click(function () {
    //     alert()
    //     $('#paypal').click();
    // })


    $('.payOrder').on("click", function () {
        let checkPayment = $('#paypalId').val() || 'null';
        // console.log(checkPayment);
        // let checkPaymentAmount = $('#paidAmount').val();
        let checkPaymentAmount = $('.totalAmount').html();
        // console.log(checkPaymentAmount);
        let checkUsedCouponCode = $('#coupon_code').val() || $('#coupon_code1').val();
        let transactionItems = [];
        $('.transactionItems input').each(function() {
            let items = JSON.parse($(this).val());
            items.forEach(item => {
            transactionItems.push(item);
            });
        });


        // console.log(checkPayment, checkPaymentAmount, checkUsedCouponCode);
        if (checkPayment == 'null') {
            if (checkPaymentAmount != '0.00') {
                createToken();
            } else if (checkUsedCouponCode && checkPaymentAmount == '0.00') {

                // check the Rushfeeoption
                let rushfee = $(".rushAmountDesktop input[type='checkbox']").is(":checked") || $(".rushAmountMobile input[type='checkbox']").is(":checked") ? "high" : "low";
                // final submit 
                $.ajax({
                    type: 'POST',
                    url: ajax_object.ajax_url,
                    data: {
                        action: 'ajax_handle_final_submit', // Required for WordPress AJAX
                        transaction_id: '',
                        rushfee: rushfee,
                        addNewStudent: 'no',
                        description: 'Graduates Academy - Registration',
                        paidAmount: checkPaymentAmount,
                        coupon_code: checkUsedCouponCode,
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
            // $('#studentsForm').submit();
              // check the Rushfeeoption
              let rushfee = $(".rushAmountDesktop input[type='checkbox']").is(":checked") || $(".rushAmountMobile input[type='checkbox']").is(":checked") ? "high" : "low";
            // final submit 
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    action: 'ajax_handle_final_submit', // Required for WordPress AJAX
                    transaction_id: '',
                    rushfee: rushfee,
                    addNewStudent: 'no',
                    description: 'Graduates Academy - Registration',
                    paidAmount: checkPaymentAmount,
                    coupon_code: checkUsedCouponCode,
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

        let checkPayment = $('#paypalId').val() || 'null';
        let checkUsedCouponCode = $('#usedCouponCode').val();

        if (checkPayment == 'null' && !checkUsedCouponCode) {
            e.preventDefault();
            swal('', "Please Pay Registration Fees", "error");
        }

    })


    $('.zeroOnClick').on("click", function () {
        let check = parseInt($(this).html()) == 0;
        if (check) {
            $(this).html(' ')
        }
    })

    // let inputCount = 0;
    // let flag_for_file = 0;
    // let last_count_for_file = 0;

    // $('.fileInput').click(function () {
    //     if (flag_for_file == 0) {
    //         inputCount += 1;
    //         last_count_for_file = inputCount;
    //         $('.studentsFile').append(`<input type='file' name='immunization[]' id='fileInput${inputCount}' style="display:none">`)
    //         $('#fileInput' + inputCount).click();
    //         flag_for_file = 1;
    //     } else {
    //         $('#fileInput' + last_count_for_file).click();
    //     }
    // })


    $('#msform').submit(function (e) {
        e.preventDefault();
    })


    $('.addClassBtn').click(function () {
        let recCount = $('#recCount').val()
        if (recCount <= 30) {
            $('#addClass form').submit();
        }
        // else {
        //     swal('', "You Can Add Only 8", "error");
        // }

        // var params = new window.URLSearchParams(window.location.search);
        // if(!params.get('q')){
        //     swal('', "Please Select Student!", "error");
        // }
    })

    // ################ Date Format Return ################

    $(".dob").keyup(function (e) {
        let code = e.keyCode || e.which;

        if (code == 37 || code == 39 || code == 8) {
            return true;
        }
        if ($(this).val().length == 2 || $(this).val().length == 5) {
            $(this).val($(this).val() + "/");
        }
        if ($(this).val().length == 10) {
            isDate($(this).val())
        }

    });

    // ################ Date Format Return ################


    // ################### Parent 1 Start ########################  -->


    // $('.parent_1 .reg_1 span').on('click', function () {
    //     let check = $(this).attr("data-ans");
    //     if (check == 'yes') {
    //         $(this).attr("data-ans", 'no');
    //         $(this).html('NO');
    //         $(this).removeClass('highlight');
    //     } else if (check == 'no') {
    //         $(this).attr("data-ans", 'yes');
    //         $(this).html('YES');
    //         $(this).addClass('highlight');
    //     }
    // })

    $('.parent_1 .reg_1 .ans1').on('change', function() {
        if ($(this).val() === 'no') {
               //  Remove any existing error messages
                $('.parent_1 .reg_1 .error_1').remove();
                // Create an error message element
                var errorMessage = $('<span class="error-message error_1 mt-1" style="color: red;">Parent/Guardian #1 Must have legal custody</span>');

                // Insert the error message after the input field
                $('.parent_1 .reg_1 .q1').after(errorMessage);
                error = 1;
        } else if ($(this).val() === 'yes') {
            // Remove any existing error messages
            $('.parent_1 .reg_1 .error_1').remove();  
        }
    });

    $('.parent_1 .reg_1 .ans3').on('change', function() {
        if ($(this).val() === 'no') {
            //  Remove any existing error messages
            $('.parent_1 .reg_1 .error_3').remove();  
             // Create an error message element
            var errorMessage = $('<span class="error-message error_3 mt-1" style="color: red;">Parent Guardian #1 is the primary parent-teacher and must have a High School Diploma.</span>');
            // swal("", "Parent Guardian #1 is the primary parent-teacher and must have a High School Diploma.", "info");
            // Insert the error message after the input field
            $('.parent_1 .reg_1 .q3').after(errorMessage);
            $(this).val('-1').trigger('change');
        } else if ($(this).val() === 'yes') {
            //  Remove any existing error messages
            $('.parent_1 .reg_1 .error_3').remove();  
        }
    });

    $('.parent_1 .reg_1 .ans5').on('change', function() {
        if ($(this).val() === 'no') {
               //  Remove any existing error messages
                $('.parent_1 .reg_1 .error_5').remove();
                // Create an error message element
                var errorMessage = $('<span class="error-message error_5 mt-1" style="color: red;">Parent who is legal guardian must live in the same home as student</span>');

                // Insert the error message after the input field
                $('.parent_1 .reg_1 .q5').after(errorMessage);
                error = 1;
        } else if ($(this).val() === 'yes') {
            //  Remove any existing error messages
            $('.parent_1 .reg_1 .error_5').remove();  
        }
    });



    $('.select_register_year_btn').click(function () {
        // Get the button text which contains the year range
        let buttonText = $(this).text();
        
        // Extract year range from button text (format: "REGISTER FOR XXXX SCHOOL YEAR (YYYY-ZZZZ)")
        let yearMatch = buttonText.match(/\((\d{4}-\d{4})\)/);
        if (yearMatch && yearMatch[1]) {
            // Set the year value to the extracted year range (e.g., "2024-2025")
            $('.parent_1 .payingYear').val(yearMatch[1]);
        } else {
            // If no match found, set the year value to an empty string
            $('.parent_1 .payingYear').val('No Year Selected');
        }
        
        // Show parent_1 section and hide year selection box
        $('.parent_1').removeClass('hide');
        $('.ask_reg_year_box').addClass('hide');
    })

    $('.next_to_parent_2').click(function () {
        // set Student data into data
        data = studentArr;  
        // console.log("data At load",data);
        let error = 0;

        let role = $('.parent_1 #role').val()
        let f_name = $('.parent_1 #parent_f_name').val()
        let m_name = $('.parent_1 #parent_m_name').val()
        let l_name = $('.parent_1 #parent_l_name').val()
        let email = $('.parent_1 #parent_email').val()
        let country_code = $('.parent_1 #country_code').val();
        let phone = $('.parent_1 #parent_contact').val()
        let yearPaying = $('.parent_1 .payingYear').val()
        let heard_about_us = $('.parent_1 #heard_about_us').val()
        let ans1 = $('.parent_1 .reg_1 .ans1').val();
        let ans2 = $('.parent_1 .reg_1 .ans2').val();
        let ans3 = $('.parent_1 .reg_1 .ans3').val();
        let ans4 = $('.parent_1 .reg_1 .ans4').val();
        let ans5 = $('.parent_1 .reg_1 .ans5').val();
        let ans6 = $('.parent_1 .reg_1 .ans6').val();

        
        // let phoneChange = $.isNumeric(parseInt(phone.split('-').join('')))
        // let phoneChange = parseInt(phone.split('-').join(''))
        let phoneChange = NumberremoveFormat(phone);
        // console.log(phoneChange);

        // let validatEmail = validateEmail(email);
        // console.log(phoneChange.length);

        // Clear any existing error messages
        $('.error-message').remove();

        if(f_name == '') {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">First Name is required.</span>');

            // Insert the error message after the input field
            $('.parent_1 #parent_f_name').after(errorMessage);
            error = 1;
        }

        if(l_name == '') {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Last Name is required.</span>');

            // Insert the error message after the input field
            $('.parent_1 #parent_l_name').after(errorMessage);
            error = 1;
        }

        if(email == '') {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Email is required.</span>');

            // Insert the error message after the input field
            $('.parent_1 #parent_email').after(errorMessage);
            error = 1;
        } else if (!validateEmail(email)) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please enter a valid email address.</span>');

            // Insert the error message after the input field
            $('.parent_1 #parent_email').after(errorMessage);
            error = 1;
        }

        if(phone == '') {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Phone Number is required.</span>');

            // Insert the error message after the input field
            $('.parent_1 #parent_contact').after(errorMessage);
            error = 1;
        } else if (!phoneChange || phoneChange.length != 10) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please enter a valid phone number.</span>');

            // Insert the error message after the input field
            $('.parent_1 #parent_contact').after(errorMessage);
            error = 1;
        }

        if (heard_about_us == '') {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please Tell us how you heard about us.</span>');

            // Insert the error message after the input field
            $('.parent_1 #heard_about_us').after(errorMessage);
            error = 1;
        }

        if (ans1 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message mt-1" style="color: red;">Please Select your Answer!</span>');

            // Insert the error message after the input field
            $('.parent_1 .reg_1 .q1').after(errorMessage);
            error = 1;
        } 
        // else if (ans1 == 'no') {
        //     // Create an error message element
        //     var errorMessage = $('<span class="error-message mt-1" style="color: red;">Parent/Guardian #1 Must have legal custody</span>');

        //     // Insert the error message after the input field
        //     $('.parent_1 .reg_1 .q1').after(errorMessage);
        //     error = 1;
        // }

        if (ans2 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message mt-1" style="color: red;">Please Select your Answer!</span>');

            // Insert the error message after the input field
            $('.parent_1 .reg_1 .q2').after(errorMessage);
            error = 1;
        }

        if (ans3 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message mt-1" style="color: red;">Please Select your Answer!</span>');


            // Insert the error message after the input field
            $('.parent_1 .reg_1 .q3').after(errorMessage);
            error = 1;
        }

        if (ans4 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message mt-1" style="color: red;">Please Select your Answer!</span>');

            // Insert the error message after the input field
            $('.parent_1 .reg_1 .q4').after(errorMessage);
            error = 1;
        }

        if (ans5 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message mt-1" style="color: red;">Please Select your Answer!</span>');

            // Insert the error message after the input field
            $('.parent_1 .reg_1 .q5').after(errorMessage);
            error = 1;
        } 
        // else if (ans5 == 'no') {
        //     // Create an error message element
        //     var errorMessage = $('<span class="error-message mt-1" style="color: red;">Parent who is legal guardian must live in the same home as student</span>');

        //     // Insert the error message after the input field
        //     $('.parent_1 .reg_1 .q5').after(errorMessage);
        //     error = 1;
        // }

        if (ans6 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message mt-1" style="color: red;">Please Select your Answer!</span>');

            // Insert the error message after the input field
            $('.parent_1 .reg_1 .q6').after(errorMessage);
            error = 1;
        }

        if(error == 1) {
            return false;
        }

        
        // console.log(yearPaying)
        parent_1 = {
            // rid,
            // role,
            // f_name,
            // m_name,
            // l_name,
            // phone,
            // email,
            // yearPaying: yearPaying.split("-"),
            questions: {
                q1: {
                    q: 'Do You Have Legel Custody of the Child?',
                    ans1
                },
                q2: {
                    q: 'Do You Authorize SMS/Text Messages for Important Notifications?',
                    ans2
                },
                q3: {
                    q: 'Does this Parent/Guardian Have a High School Dilpoma or GED?',
                    ans3
                },
                q4: {
                    q: 'Highest Level of Education?',
                    ans4
                },
                q5: {
                    q: 'Does this Parent/Guardian Live in the Same Home as the Student?',
                    ans5
                },
                q6: {
                    q: 'Are you a United States Citizen?',
                    ans6
                }
            },
        }


        // if (!role || !f_name || !l_name || !phone || !email || !yearPaying || !heard_about_us) {
        //     swal("", "Please Filled All Fields!", "error");
        // } else if (ans1 == '-1' || ans2 == '-1' || ans3 == '-1' || ans4 == '-1' || ans5 == '-1' || ans6 == '-1') {
        //     swal("", "Please Select your Answer!", "error");
        // } else if (ans1 == 'no') {
        //     swal("", "Parent/Guardian #1 Must have legal custody - Registration Cannot Continue", "error");
        // } else if (ans5 == 'no') {
        //     swal("", "Parent who is legal guardian must live in the same home as student - Registration Cannot Continue!", "error");
        // } else if (!validatEmail) {
        //     swal("", "Please Enter Correct Email!", "error");
        // } else if (!phoneChange && phone.length != 10) {
        //     swal("", "Please Enter Correct Phone", "error");
        // } else {
        
            // console.log(parent_1);

            var formData = new FormData();
            formData.append('action', 'ajax_handle_parent_registration');
            // formData.append('registration_id', rid);
            formData.append('type', 'parent_1');
            formData.append('role', role);
            formData.append('f_name', f_name);
            formData.append('m_name', m_name);
            formData.append('l_name', l_name);
            formData.append('phone', phoneChange);
            formData.append('country_code', country_code);
            formData.append('yearPaying', yearPaying);
            formData.append('heardAboutUs', heard_about_us);
            formData.append('parent_data', JSON.stringify(parent_1));
            formData.append('email', email);

            $.ajax({
                type: 'POST',
                url:  ajax_object.ajax_url,
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    // console.log(data);
                    if (data.success) {
                        // window.scrollTo({ top: 0, behavior: 'smooth' });
                        $('.parent_1').addClass('hide');
                        $('.parent_2').removeClass('hide', 1000);
                        $('.add_course .courseYearPaying').html(yearPaying);
                    }
                    else{ 

                        swal("", "Sorry, Something went wrong!", "error");
                    }
                },
            });
        // }


    });

    // ################### Parent 1 End ########################  -->


    // ################### Parent 2 Start ########################  -->

    $('.parent_2 .reg_1 .ans1').on('change', function() {
        if ($(this).val() === 'no') {
                // Remove any existing error messages
                $('.parent_2 .reg_1 .error_1').remove();
                // Create an error message element
                var errorMessage = $('<span class="error-message error_1 mt-1" style="color: red;">Parent/Guardian #2 Must have legal custody</span>');

                // Insert the error message after the input field
                $('.parent_2 .reg_1 .q1').after(errorMessage);
                error = 1;
        } else if ($(this).val() === 'yes') {
            // Remove any existing error messages
            $('.parent_2 .reg_1 .error_1').remove();  
        }
    });

    $('.parent_2 .reg_1 .ans2').on('change', function() {
        if ($(this).val() === 'no' && $('.parent_1 .reg_1 .ans3').val() === 'no') {

            // remove any existing error messages
            $('.parent_2 .reg_1 .error_3').remove();
             // Create an error message element
            var errorMessage = $('<span class="error-message error_3 mt-1" style="color: red;">One Parent is Required to Have a High School Diploma or GED to Register</span>');
            // Insert the error message after the input field
            $('.parent_2 .reg_1 .q2').after(errorMessage);
            $(this).val('-1').trigger('change');
        } else if ($(this).val() === 'yes') {
            // Remove any existing error messages
            $('.parent_2 .reg_1 .error_3').remove();  
        }
    });

    $('.parent_2 .reg_1 .ans5').on('change', function() {
        if ($(this).val() === 'no') {

               // Remove any existing error messages
                $('.parent_2 .reg_1 .error_5').remove();  
                // Create an error message element
                var errorMessage = $('<span class="error-message error_5 mt-1" style="color: red;">Parent who is legal guardian must live in the same home as student - Registration Cannot Continue!</span>');

                // Insert the error message after the input field
                $('.parent_2 .reg_1 .q5').after(errorMessage);
                error = 1;
        } else if ($(this).val() === 'yes') {
            //  Remove any existing error messages
            $('.parent_2 .reg_1 .error_5').remove();  
        }
    });

    $('.next_to_additional_info').click(function () {

        // Clear any existing error messages
        $('.error-message').remove();

        let error = 0;

        let role = $('.parent_2 #role').val()
        let f_name = $('.parent_2 #f_name').val()
        let m_name = $('.parent_2 #m_name').val()
        let l_name = $('.parent_2 #l_name').val()
        let phone = $('.parent_2 #contact').val()
        let country_code = $('.parent_2 #country_code').val();
        let yearPaying = $('.parent_1 .payingYear').val() 
        let ans1 = $('.parent_2 .reg_1 .ans1').val();
        let ans2 = $('.parent_2 .reg_1 .ans2').val();
        let ans3 = $('.parent_2 .reg_1 .ans3').val();
        let ans4 = $('.parent_2 .reg_1 .ans4').val();
        let ans5 = $('.parent_2 .reg_1 .ans5').val();
        let email = $('.parent_2 #email').val()

        let validatEmail = validateEmail(email);

        let parent1_ans3 = $('.parent_1 .reg_1 .ans3').val();
        let parent1_ans2 = $('.parent_1 .reg_1 .ans2').val();

        // let phoneChange = $.isNumeric(parseInt(phone.split('-').join('')))
        // let phoneChange = parseInt(phone.split('-').join(''))
        let phoneChange = NumberremoveFormat(phone);

        parent_2 = {
            // role,
            // f_name,
            // m_name,
            // l_name,
            // phone,
            // email,
            questions: {
                q1: {
                    q: 'Do You Authorize SMS/Text Messages for Important Notifications?',
                    ans1
                },
                q2: {
                    q: 'Does this Parent/Guardian Have a High School Diploma or GED?',
                    ans2
                },
                q3: {
                    q: 'Highest Level of Education?',
                    ans3
                },
                q4: {
                    q: 'Does this Parent/Guardian Live in the Same Home as the Student?',
                    ans4
                },
                q5: {
                    q: 'Are You a United States Citizen?',
                    ans5
                },
            },
        }

        if (f_name == '' && l_name == '' && email == '' && phone == '' && ans1 == 'yes' && ans2 == '-1' && ans3 == '-1' && ans4 == '-1' && ans5 == '-1') {
            $('.additional_info').removeClass('hide');
            $('.parent_2').addClass('hide');
        } else {

            if(f_name == '') {
                // Create an error message element
                var errorMessage = $('<span class="error-message" style="color: red;">First Name is required.</span>');

                // Insert the error message after the input field
                $('.parent_2 #f_name').after(errorMessage);
                error = 1;
            }

            if(l_name == '') {
                // Create an error message element
                var errorMessage = $('<span class="error-message" style="color: red;">Last Name is required.</span>');

                // Insert the error message after the input field
                $('.parent_2 #l_name').after(errorMessage);
                error = 1;
            }

            if(email == '') {
                // Create an error message element
                var errorMessage = $('<span class="error-message" style="color: red;">Email is required.</span>');

                // Insert the error message after the input field
                $('.parent_2 #email').after(errorMessage);
                error = 1;
            } else if (!validateEmail(email)) {
                // Create an error message element
                var errorMessage = $('<span class="error-message" style="color: red;">Please enter a valid email address.</span>');

                // Insert the error message after the input field
                $('.parent_2 #parent_email').after(errorMessage);
                error = 1;
            }

            if(phone == '') {
                // Create an error message element
                var errorMessage = $('<span class="error-message" style="color: red;">Phone Number is required.</span>');

                // Insert the error message after the input field
                $('.parent_2 #contact').after(errorMessage);
                error = 1;
            } else if (!phoneChange || phoneChange.length != 10) {
                // Create an error message element
                var errorMessage = $('<span class="error-message" style="color: red;">Please enter a valid phone number.</span>');

                // Insert the error message after the input field
                $('.parent21 #contact').after(errorMessage);
                error = 1;
            }

            if (ans1 == '-1' ) {
                // Create an error message element
                var errorMessage = $('<span class="error-message" style="color: red;">Please Select your Answer!</span>');

                // Insert the error message after the input field
                $('.parent_2 .reg_1 .q1').after(errorMessage);
                error = 1;
            } 
            // else if (ans1 == 'no') {
            //     // Create an error message element
            //     var errorMessage = $('<span class="error-message" style="color: red;">Parent/Guardian #2 Must have legal custody - Registration Cannot Continue</span>');

            //     // Insert the error message after the input field
            //     $('.parent_2 .reg_1 .q1').after(errorMessage);
            //     error = 1;
            // }

            if (ans2 == '-1' ) {
                // Create an error message element
                var errorMessage = $('<span class="error-message" style="color: red;">Please Select your Answer!</span>');

                // Insert the error message after the input field
                $('.parent_2 .reg_1 .q2').after(errorMessage);
                error = 1;
            } 
            // else if (ans2 == 'no' && parent1_ans3 == 'no') {
            //     // Create an error message element
            //     var errorMessage = $('<span class="error-message" style="color: red;">One Parent is Required to Have a High School Diploma or GED to Register</span>');

            //     // Insert the error message after the input field
            //     $('.parent_2 .reg_1 .q2').after(errorMessage);
            //     error = 1;
            // }

            if (ans3 == '-1' ) {
                // Create an error message element
                var errorMessage = $('<span class="error-message" style="color: red;">Please Select your Answer!</span>');


                // Insert the error message after the input field
                $('.parent_2 .reg_1 .q3').after(errorMessage);
                error = 1;
            }

            if (ans4 == '-1' ) {
                // Create an error message element
                var errorMessage = $('<span class="error-message" style="color: red;">Please Select your Answer!</span>');

                // Insert the error message after the input field
                $('.parent_2 .reg_1 .q4').after(errorMessage);
                error = 1;
            }

            if (ans5 == '-1' ) {
                // Create an error message element
                var errorMessage = $('<span class="error-message" style="color: red;">Please Select your Answer!</span>');

                // Insert the error message after the input field
                $('.parent_2 .reg_1 .q5').after(errorMessage);
                error = 1;
            } else if (ans5 == 'no') {
                // Create an error message element
                var errorMessage = $('<span class="error-message" style="color: red;">Parent who is legal guardian must live in the same home as student - Registration Cannot Continue!</span>');

                // Insert the error message after the input field
                $('.parent_2 .reg_1 .q5').after(errorMessage);
                error = 1;
            }

            if(error == 1) {
                return false;
            }


            // save data into database
            var formData = new FormData();
            formData.append('action', 'ajax_handle_parent_registration');
            // formData.append('registration_id', rid);
            formData.append('type', 'parent_2');
            formData.append('role', role);
            formData.append('f_name', f_name);
            formData.append('m_name', m_name);
            formData.append('l_name', l_name);
            formData.append('phone', phoneChange);
            formData.append('country_code', country_code);
            formData.append('yearPaying', yearPaying);
            formData.append('parent_data', JSON.stringify(parent_2));
            formData.append('email', email);

            $.ajax({
                type: 'POST',
                url:  ajax_object.ajax_url,
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    // console.log(data)
                    if (data.success) {
                        // window.scrollTo({ top: 0, behavior: 'smooth' });
                        $('.additional_info').removeClass('hide');
                        $('.parent_2').addClass('hide');
                    }
                    else{

                        swal("", "Sorry, Something went wrong!", "error");
                    }
                },
            })
        }


        // if (ans1 == 'no' && parent1_ans2 == 'no') {
        //     swal("", "One Parent/Guardian Must Have Legal Custody - Registration Cannot Continue", "error");
        // } else 
        // unlock
        // if (f_name !== '' && l_name !== '' && (ans1 == '-1' || ans2 == '-1' || ans3 == '-1' || ans4 == '-1' || ans5 == '-1')) {
        //     swal("", "Please Select your Answer!", "error");
        // } else if (ans2 == 'no' && parent1_ans3 == 'no') {
        //     swal("", "One Parent is Required to Have a High School Diploma or GED to Register", "error");
        // } else if (phone && !phoneChange && phone.length != 10) {
        //     swal("", "Please Enter Correct Phone#", "error");
        // } else if (email) {
        //     if (!validatEmail) {
        //         swal("", "Please Enter Correct Email!", "error");
        //     } else {

        //         var formData = new FormData();
        //         formData.append('action', 'ajax_handle_parent_registration');
        //         // formData.append('registration_id', rid);
        //         formData.append('type', 'parent_2');
        //         formData.append('role', role);
        //         formData.append('f_name', f_name);
        //         formData.append('m_name', m_name);
        //         formData.append('l_name', l_name);
        //         formData.append('phone', phoneChange);
        //         formData.append('country_code', country_code);
        //         formData.append('yearPaying', yearPaying);
        //         formData.append('parent_data', JSON.stringify(parent_2));
        //         formData.append('email', email);

        //         $.ajax({
        //             type: 'POST',
        //             url:  ajax_object.ajax_url,
        //             data: formData,
        //             contentType: false,
        //             processData: false,
        //             success: function (data) {
        //                 // console.log(data)
        //                 if (data.success) {
        //                     $('.additional_info').removeClass('hide');
        //                     $('.parent_2').addClass('hide');
        //                 }
        //                 else{

        //                     swal("", "Sorry, Something went wrong!", "error");
        //                 }
        //             },
        //         })

        //     }
        // } else {
        //     // $.ajax({
        //     //     type: 'POST',
        //     //     url:  ajax_object.ajax_url,
        //     //     data: formData,
        //     //     contentType: false,
        //     //     processData: false,
        //     //     success: function (data) {
        //     //         // console.log(data)
        //     //         if (data.success) {
        //                 $('.additional_info').removeClass('hide');
        //                 $('.parent_2').addClass('hide');
        //         //     }
        //         //     else{
        //         //         swal("", "Sorry, Something went wrong!", "error");
        //         //     }
        //         // },
        //     // })
        // }
    });


    $('.parent2_back_btn').click(function () {
        // window.scrollTo({ top: 0, behavior: 'smooth' });
        $('.parent_1').removeClass('hide');
        $('.parent_2').addClass('hide');
    });

    // ################### Parent 2 End ########################  -->


    // ################### Aditional Info Start ########################  -->

    $('.additional_info .reg_1 .ans5').on('change', function() {
        if ($(this).val() === 'yes') {
            $('.additional_info .reg_1 .explanation').removeClass('hide');
        } else {
            $('.additional_info .reg_1 .explanation').addClass('hide');
            $('.additional_info .reg_1 .explanation textarea').val('');
        }
    });

    $('.additional_info .reg_1 select').on('change', function() {
        // Remove any existing error messages
        $('.error-message').remove();
    });

    $('.additional_info_btn').on('click', function () {

        // Clear any existing error messages
        $('.error-message').remove();

        let error = 0;
        let ans1 = $('.additional_info .reg_1 .ans1').val();
        let ans2 = $('.additional_info .reg_1 .ans2').val();
        let ans3 = $('.additional_info .reg_1 .ans3').val();
        let ans4 = $('.additional_info .reg_1 .ans4').val();
        let ans5 = $('.additional_info .reg_1 .ans5').val();
        let explanation = $('.additional_info .reg_1 .explanation textarea').val();


        additional_information = {
            questions: {
                q1: {
                    q: 'Actively on Probation?',
                    ans1
                },
                q2: {
                    q: 'Currently Being Investigated for Abuse or Neglect (Physical or Educational)?',
                    ans2
                },
                q3: {
                    q: 'Currently Being Investigated And/Or Charged With a Misdemeanor of Felony?',
                    ans3
                },
                q4: {
                    q: 'Currently Involved in an Open Criminal Court Case that Could Lead to a Misdemeanor of Felony?',
                    ans4
                },
                q5: {
                    q: 'Does Any Student Have a History of Truancy or Expulsion issues?',
                    ans5
                },
                explanation
            },
        }

        if (ans1 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please Select your Answer!</span>');
            
            // Insert the error message after the input field
            $('.additional_info .reg_1 .q1').after(errorMessage);
            error = 1;
        }

        if (ans2 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please Select your Answer!</span>');

            // Insert the error message after the input field
            $('.additional_info .reg_1 .q2').after(errorMessage);
            error = 1;
        }

        if (ans3 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please Select your Answer!</span>');


            // Insert the error message after the input field
            $('.additional_info .reg_1 .q3').after(errorMessage);
            error = 1;
        }

        if (ans4 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please Select your Answer!</span>');

            // Insert the error message after the input field
            $('.additional_info .reg_1 .q4').after(errorMessage);
            error = 1;
        }

        if (ans5 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please Select your Answer!</span>');

            // Insert the error message after the input field
            $('.additional_info .reg_1 .q5').after(errorMessage);
            error = 1;
        }

        if (ans5 == 'yes' && explanation == '') {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please Enter Explanation!</span>');

            // Insert the error message after the input field
            $('.additional_info .reg_1 .explanation').after(errorMessage);
            error = 1;
        }

        if (ans1 == 'yes' || ans2 == 'yes' || ans3 == 'yes' || ans4 == 'yes') {
            // create an error message element
            var errorMessage = $('<span class="error-message d-flex justify-content-center mb-25" style="color: red;">We are Unable to Accept This Application at This Time</span>');

            // Insert the error message after the input field
            $('.additional_info .show-message').after(errorMessage);
            error = 1;
        }

        if (error == 1) {
            return false;
        }

        // if (ans1 == '-1' || ans2 == '-1' || ans3 == '-1' || ans4 == '-1' || ans5 == '-1') {
        //     swal("", "Please Select your Answer!", "error");
        // } else if (ans1 == 'yes' || ans2 == 'yes' || ans3 == 'yes' || ans4 == 'yes') {
        //     swal("", "We are Unable to Accept This Application at This Time", "error");
        // } else {
            var formData = new FormData();
            formData.append('action', 'ajax_handle_additional_info');
            // formData.append('registration_id', rid);
            formData.append('type', 'additional_info');
            formData.append('additional_info_data', JSON.stringify(additional_information));

            $.ajax({
                type: 'POST',
                url:  ajax_object.ajax_url,
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    // console.log(data)
                    if (data.success) {
                        // window.scrollTo({ top: 0, behavior: 'smooth' });
                        $('.additional_info').addClass('hide');
                        // $('.address_box').removeClass('hide');
                        $('.student_application').removeClass('hide');
                    }
                    else{
                        swal("", "Sorry, Something went wrong!", "error");
                    }
                },
            })
        // }


    });


    $('.additional_info_back_btn').click(function () {
        // window.scrollTo({ top: 0, behavior: 'smooth' });
        // $('.back_to_parent').click();
        $('.parent_2').removeClass('hide');
        $('.additional_info').addClass('hide');
    });

    // ################### Aditional Info End  ########################  -->





    // ################### Student Application Start ####################

    $('.student_application input[type="checkbox"]').on('change', function() {
        // Remove any existing error messages
        $('.error-message').remove();
    });

    $('.student_application_next_btn').on('click', function () {
        let check1 = $('.student_application .check1').is(":checked");
        let check2 = $('.student_application .check2').is(":checked");
        let check3 = $('.student_application .check3').is(":checked");
        let check4 = $('.student_application .check4').is(":checked");
        let check5 = $('.student_application .check5').is(":checked");
        let check6 = $('.student_application .check6').is(":checked");
        let description = $('.student_application .description textarea').val();

        student_application = {
            q1: {
                q: 'Currently involved in an open custody case of an enrolling student',
                ans: check1
            },
            q2: {
                q: 'Currently a foster parent(s) of an enrolling student',
                ans: check2
            },
            q3: {
                q: 'Currently have Power of Attorney for an enrolling student',
                ans: check3
            },
            q4: {
                q: 'Currently are in the process of adoption of an enrolling student',
                ans: check4
            },
            q5: {
                q: 'Other unique family situation',
                ans: check5
            },
            q6: {
                q: 'None of the above',
                ans: check6
            },
            description
        };


        // Clear any existing error messages
        $('.error-message').remove();

        let error = 0;

        if (!(check1 || check2 || check3 || check4 || check5 || check6)) {
            // create an error message element
            var errorMessage = $('<span class="error-message d-flex justify-content-center mb-25" style="color: red;">At least one checkbox must be checked.</span>');
            
            // Insert the error message after the input field
            $('.student_application .show-message').after(errorMessage);
            error = 1;
        }

        if ((check1 || check2 || check3 || check4 || check5) && !description) {
            // create an error message element 
            var errorMessage = $('<span class="error-message" style="color: red;">Written response is required to proceed forward</span>');
            
            // Insert the error message after the input field
            $('.student_application .description').after(errorMessage);
            error = 1;
        }

        if (error === 0) {

            formData = new FormData();
            formData.append('action', 'ajax_handle_student_application');

            formData.append('type', 'student_application');
            formData.append('student_application', JSON.stringify(student_application));
            $.ajax({
                type: 'POST',
                url:  ajax_object.ajax_url,
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {

                    if (data.success) {
                        // window.scrollTo({ top: 0, behavior: 'smooth' });
                        $('.student_application').addClass('hide');
                        $('.legal_document').removeClass('hide');
                    }
                    else{
                        // window.scrollTo({ top: 0, behavior: 'smooth' });
                        swal("", "Sorry, Something went wrong!", "error");
                    }
                },
            });
        } else {
            return false;
        }
        // if((check1 || check2 || check3 || check4) && check6){
        //     swal("", "Please Enter Correct Detail", "error");
        // }else if(description && !check6){
        //     $('.student_application').addClass('hide');
        //     $('.legal_document').removeClass('hide');
        // }else 
        // unlock form here
        // if ((check1 || check2 || check3 || check4 || check5) && description) {
        //     formData = new FormData();
        //     formData.append('action', 'ajax_handle_student_application');
        //     // formData.append('registration_id', rid);
        //     formData.append('type', 'student_application');
        //     formData.append('student_application', JSON.stringify(student_application));
        //     $.ajax({
        //         type: 'POST',
        //         url:  ajax_object.ajax_url,
        //         data: formData,
        //         contentType: false,
        //         processData: false,
        //         success: function (data) {
        //             // console.log(data)
        //             if (data.success) {
        //                 $('.student_application').addClass('hide');
        //                 $('.legal_document').removeClass('hide');
        //             }
        //             else{
        //                 swal("", "Sorry, Something went wrong!", "error");
        //             }
        //         },
        //     })
        // } else if ((check1 || check2 || check3 || check4 || check5) && !description) {
        //     swal("", "Written response is required to proceed forward", "error");
        // } else if (check6) {
        //     formData = new FormData();
        //     formData.append('action', 'ajax_handle_student_application');
        //     // formData.append('registration_id', rid);
        //     formData.append('type', 'student_application');
        //     formData.append('student_application', JSON.stringify(student_application));
        //     $.ajax({
        //         type: 'POST',
        //         url:  ajax_object.ajax_url,
        //         data: formData,
        //         contentType: false,
        //         processData: false,
        //         success: function (data) {
        //             // console.log(data)
        //             if (data.success) {
        //                 $('.student_application').addClass('hide');
        //                 $('.legal_document').removeClass('hide');
        //             }
        //             else{
        //                 swal("", "Sorry, Something went wrong!", "error");
        //             }
        //         },
        //     })
        // } else {
        //     swal("", "Please Enter Correct Detail", "error");
        // }
    })

    $('.student_application .container').on('click', function() {
        let check1 = $('.student_application .check1');
        let check2 = $('.student_application .check2'); 
        let check3 = $('.student_application .check3');
        let check4 = $('.student_application .check4');
        let check5 = $('.student_application .check5');
        let check6 = $('.student_application .check6');

        // If check6 is checked
        if (check6.is(":checked")) {
            // Uncheck all other checkboxes
            check1.prop("checked", false); 
            check2.prop("checked", false);
            check3.prop("checked", false);
            check4.prop("checked", false);
            check5.prop("checked", false);
            // Hide description box
            $('.student_application .description').addClass('hide');
        }

        // If any of first 4 boxes are checked
        if (check1.is(":checked") || check2.is(":checked") || 
            check3.is(":checked") || check4.is(":checked") || check5.is(":checked")) {
            // Uncheck check6
            check6.prop("checked", false);
            // Show description box
            $('.student_application .description').removeClass('hide');
        } else {
            $('.student_application .description').addClass('hide');
        }
    })


    $('.student_application_back_btn').click(function () {
        // window.scrollTo({ top: 0, behavior: 'smooth' });
        $('.additional_info').removeClass('hide');
        $('.student_application').addClass('hide');
    });
    // ################### Student Application End ####################



    // ################### Legal Document Start #########################


    $('.legal_document_next_btn').on('click', function () {
        // window.scrollTo({ top: 0, behavior: 'smooth' });
        $('.legal_document').addClass('hide');
        $('.address_box').removeClass('hide');
    })

    // Back Btn
    $('.legal_document_back_btn').click(function () {
        // window.scrollTo({ top: 0, behavior: 'smooth' });
        $('.student_application').removeClass('hide');
        $('.legal_document').addClass('hide');
    });
    // ################### Legal Document End #########################



    // ################### Address Start ########################  -->

    $('.next_to_add_student').on('click', function () {
        // console.log("data Before Student page:",data);
        // console.log(studentArr)

        // Clear any existing error messages
        $('.error-message').remove();

        let error = 0;

        let street_address = $('.address_box #street_address').val();
        let city = $('.address_box #city').val();
        let zip_code = $('.address_box #zip_code').val();
        let state = $('.address_box #state').val();
        let county = $('.address_box #county').val();
        let emergency_name = $('.address_box #emergency_name').val();
        let emergency_number = $('.address_box #emergency_number').val();
        let country_code = $('.address_box #country_code').val();

        // let phoneChange = $.isNumeric(parseInt(emergency_number.split('-').join('')))
        // let phoneChange = emergency_number.split('-').join('')
        // let phoneChange = parseInt(emergency_number.split('-').join(''))
        let phoneChange = NumberremoveFormat(emergency_number);

        address = {
            street_address,
            city,
            zip_code,
            state,
            county,
            emergency_name,
            emergency_number,
            country_code
        }

        if (!street_address) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Street Address is required.</span>');

            // Insert the error message after the input field
            $('.address_box #street_address').after(errorMessage);
            error = 1;
        }

        if (!city) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">City is required.</span>');

            // Insert the error message after the input field
            $('.address_box #city').after(errorMessage);
            error = 1;
        }

        if (!zip_code) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Zip Code is required.</span>');

            // Insert the error message after the input field
            $('.address_box #zip_code').after(errorMessage);
            error = 1;  
        }

        if (state == '-1') {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">State is required.</span>');

            // Insert the error message after the input field
            $('.address_box #state').after(errorMessage);
            error = 1;
        }

        if (county == '-1') {
            // create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">County is required.</span>');

            // Insert the error message after the input field
            $('.address_box #county').after(errorMessage);
            error = 1;
        }

        if (emergency_name == '') {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Emergency Contact Name is required.</span>');

            // Insert the error message after the input field
            $('.address_box #emergency_name').after(errorMessage);
            error = 1;
        }

        if (emergency_number == '') {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Emergency Contact Number is required.</span>');

            // Insert the error message after the input field
            $('.address_box #emergency_number').after(errorMessage);
            error = 1;
        } else if (!phoneChange || phoneChange.length != 10) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please enter a valid phone number.</span>');

            // Insert the error message after the input field
            $('.address_box #emergency_number').after(errorMessage);
            error = 1;
        }

        if (error == 1) {
            return false;
        }

        // if (!street_address || !city || !zip_code || state == "-1" || county == "-1" || !emergency_name || !emergency_number) {
        //     swal("", "Please Fill All Fields", "error");
        // } else if (emergency_number && !phoneChange && phone.length != 10) {
        //     swal("", "Please Enter Correct Phone#", "error");
        // } else {

            var formData = new FormData();
            formData.append('action', 'ajax_handle_parent_address');
            // formData.append('registration_id', rid);
            formData.append('type', 'parent_address');
            formData.append('street_address', street_address);
            formData.append('city', city);
            formData.append('zip_code', zip_code);
            formData.append('state', state);
            formData.append('county', county);
            formData.append('emergency_name', emergency_name);
            formData.append('emergency_number', phoneChange);
            formData.append('country_code', country_code);

            $.ajax({
                type: 'POST',
                url:  ajax_object.ajax_url,
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // console.log(response)
                    if (response.success) {
                            // window.scrollTo({ top: 0, behavior: 'smooth' });
                            $('.address_box').addClass('hide');
                            $('.add_student').removeClass('hide');
                            $('.step_1').click();
                    }
                    else{
                        // window.scrollTo({ top: 0, behavior: 'smooth' });
                        swal("", "Sorry, Something went wrong!", "error");
                    }
                },
            })

        // }
    });


    $('.address_back_btn').click(function () {
        // window.scrollTo({ top: 0, behavior: 'smooth' });
        // $('.student_application').removeClass('hide');
        $('.legal_document').removeClass('hide');
        $('.address_box').addClass('hide');
    });

    // ################### Address End ########################  -->



    // ################### Add Student Start ########################  -->

    // Age Calculation
// $('#dob').change(function() {
//     console.log("Date of birth changed:", $(this).val());
// });


    $('#dob').on('change', function() {
        var dobValue = $(this).val(); // Gets YYYY-MM-DD format
        var dob = new Date(dobValue);
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();
        var m = today.getMonth() - dob.getMonth();

        // Check if date is valid
        // if (!dobValue || dob == "Invalid Date") {
        //     // swal("", "Please enter a valid date", "error");
        //     $(this).after('<span class="error-message" style="color: red;">Please enter a valid date</span>');
        //     $(this).val('');
        //     $('.add_student #age').val('');
        //     return;
        // }

        // Check if date is in future
        if (dob > today) {
            // swal("", "Date of birth cannot be in the future!", "error");
            $(this).after('<span class="error-message" style="color: red;">Date of birth cannot be in the future!</span>');
            $(this).val('');
            $('.add_student #age').val('');
            return;
        }

        // Check if age is too high  
        // if (age > 100) {
        //     // swal("", "Please enter a valid date of birth!", "error");
        //     $(this).after('<span class="error-message" style="color: red;">Please enter a valid date of birth</span>');
        //     $(this).val('');
        //     $('.add_student #age').val('');
        //     return;
        // }

        // Adjust age if birthday hasn't occurred this year
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        // Set the age value
        $('.add_student #age').val(age);

        // Update input class for styling
        $(this).toggleClass('has-value', dobValue !== '');
    });

    // Set default image
    $('.add_student #gender').on('change', function() {
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
    $('.add_student .reg_1 .ans1').on('change', function() {
        let ansValue = $(this).val();
        if(ansValue === 'no') {
            // console.log(ansValue);
            $('.error-message').remove();
            $('.add_student .reg_1 .q1').after('<span class="error-message mt-1" style="color: red;">We cannot accept the application at this time.</span>');

            // swal("", "We cannot accept the application at this time.", "info").then(() => {
                $(this).val('-1');
                $('.add_student .reg_1 .please_describe').addClass('hide');
                $('.add_student .reg_1 #please_describe').val('');
            // });
        } else if(ansValue === 'not applicable') {
            // console.log(ansValue);
            $('.error-message').remove();
            $('.add_student .reg_1 .please_describe').removeClass('hide');
        }
        else {
            // console.log(ansValue);
            $('.error-message').remove();
            $('.add_student .reg_1 .please_describe').addClass('hide');
            $('.add_student .reg_1 #please_describe').val('');
        }
    });

    // ans2 check 
    $('.add_student .reg_1 .ans2').on('change', function() {
        let ansValue = $(this).val();
        if(ansValue  == 'yes') {
            // Create an error message element
            var errorMessage = $('<span class="error-message mt-1" style="color: red;"><br>We are Unable to Accept This Application at This Time</span>');

            // Insert the error message after the input field
            $('.add_student .q2').after(errorMessage);
        } else if (ansValue == 'no') {
            $('.error-message').remove();
        }
    });

    $('.next_to_student').on('click', function () {

        // Clear any existing error messages
        $('.error-message').remove();
        let error = 0;

        let f_name = $('.add_student #student_f_name').val()
        let m_name = $('.add_student #student_m_name').val()
        let l_name = $('.add_student #student_l_name').val()
        let dob = $('.add_student #dob').val()
        let age = $('.add_student #age').val()
        let grade = $('.add_student #student_grade').val()
        let country = $('.add_student #country').val()
        let county = $('.add_student #county').val()
        let state = $('.add_student #state').val()
        let gender = $('.add_student #gender').val()
        let coop_name = $('.add_student #coop_name').val()
        let ans1 = $('.add_student .reg_1 .ans1').val();
        let ans2 = $('.add_student .reg_1 .ans2').val();
        let ans3 = $('.add_student .reg_1 .ans3').val();
        let please_describe = $('.add_student .reg_1 #please_describe').val();
        let yearPaying = $('.parent_1 .payingYear').val();
        let student_id = $('#student_id').val();

        // console.log(f_name + m_name + l_name + dob + age + grade + country + county + state + gender + ans1 + ans2 + ans3)

        let not_show_description = ['9TH GRADE', '10TH GRADE', '11TH GRADE', '12TH GRADE', '8TH WITH HS CREDIT'];

        student_profile_pic = $('#preview-profile-img').attr('src');
        immunization_file_name = $('.show_immunization_file_name span').text();
        immunization_file = $('#immunization_file_url').val();

        let img_url = student_profile_pic.replace('http://', 'https://');
 

        if (not_show_description.includes(grade)) {
            $('#student_message').show();
        } else {
            $('#student_message').hide();
        }

        if (f_name == '' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">First Name is required.</span>');

            // Insert the error message after the input field
            $('.add_student #student_f_name').after(errorMessage);
            error = 1;
        }

        if (l_name == '' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Last Name is required.</span>');

            // Insert the error message after the input field
            $('.add_student #student_l_name').after(errorMessage);
            error = 1;
        }

        if (dob == '' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Date of Birth is required.</span>');

            // Insert the error message after the input field
            $('.add_student #dob').after(errorMessage);
            error = 1;
        }

        if (age == '' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Age is required.</span>');

            // Insert the error message after the input field
            $('.add_student #age').after(errorMessage);
            error = 1;
        }

        if (grade == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Grade is required.</span>');

            // Insert the error message after the input field
            $('.add_student #student_grade').after(errorMessage);
            error = 1;
        }

        if(state == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">State is required.</span>');

            // Insert the error message after the input field
            $('.add_student #state').after(errorMessage);
            error = 1;
        }

        if (country == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Country is required.</span>');

            // Insert the error message after the input field
            $('.add_student #country').after(errorMessage);
            error = 1;
        }
        
        if (gender == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Gender is required.</span>');

            $('.add_student #gender').after(errorMessage);
            error = 1;
        }

        if (coop_name == '' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Co-op Name is required.</span>');


            $('.add_student #coop_name').after(errorMessage);
            error = 1;
        }
        
        if (ans1 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message mt-1" style="color: red;"><br>Please Select your Answer!</span>');
            
            $('.add_student .q1').after(errorMessage);
            error = 1;
        } else if (ans1 == 'not applicable' && !please_describe) {
            // create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please Describe!</span>');

            // Insert the error message after the input field
            $('.add_student #please_describe').after(errorMessage);
            error = 1;
        }

        if (ans2 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;"> <br>Please Select your Answer!</span>');

            $('.add_student .q2').after(errorMessage);
            error = 1;
        } 
        // else if (ans2 == 'yes') {
        //     // Create an error message element
        //     var errorMessage = $('<span class="error-message mt-1" style="color: red;">We are Unable to Accept This Application at This Time</span>');

        //     // Insert the error message after the input field
        //     $('.add_student .q2').after(errorMessage);
        //     error = 1;
        // }

        if (ans3 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message mt-1" style="color: red;"> <br>Please Select your Answer!</span>');

            $('.add_student .q3').after(errorMessage);
            error = 1;
        }

        if (error == 1) {
            return false;
        }

        
        // console.log("add_student_btn", add_student_btn);
        // console.log("At frist Data:", data);
        if (add_student_btn && data.length > 0 && !f_name && !l_name) {
            $('.add_student').addClass('hide');
            $('.student_transfer').addClass('hide'); 
            $('.add_course').addClass('hide');
            $('.student_summary').removeClass('hide');
            $('.bgChange').css('background-color', '#f1f1f1');
            add_student_btn = false;
            // window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        // }else if (!f_name || !l_name || !dob || state == '-1' || county == '-1' || country == '-1' || grade == '-1' || county=='-1' || state=='-1'|| gender == '-1' || !coop_name) {
        //     swal("", "Please Fill All Fields", "error");
        // } 
        // not
        // else if (!isDate(dob)) {
        //     swal("", "Please Insert Valid Date!", "error");
        // } 
        // go
        // else if (ans1 == '-1' || ans2 == '-1' || ans3 == '-1') {
        //     swal("", "Please Select your Answer!", "error");
        // } else if (ans2 == 'yes') {
        //     swal("", "We are Unable to Accept This Application at This Time", "error");
        // } else if (ans1 == 'not applicable' && !please_describe) {
        //     swal("", "Please Describe!", "error");
        // }
         else if (edit_flag) {
            // console.log("Edit Flag:", edit_flag);
            data[edit_data_index] = {
                student_id,
                f_name,
                m_name,
                l_name,
                dob,
                age,
                yearPaying,
                grade,
                country,
                county,
                state,
                gender,
                coop_name,
                course,
                immunization_file_name,
                immunization_file,
                student_profile_pic,
                questions: {
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
                },
                transfer: ans3 == 'yes' ? student_tranfer : null
            }

            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    'action': 'ajax_handle_student_reg',
                    'type': 'student_registration',
                    // 'registration_id': registration_id,
                    // 'registration_id': rid,
                    'student_id': student_id,
                    'first_name': f_name,
                    'middle_name': m_name,
                    'last_name': l_name,
                    'dob': dob,
                    'age': age,
                    'yearPaying': yearPaying,
                    'grade': grade,
                    'country': country,
                    'county': county,
                    'state': state,
                    'gender': gender,
                    'coop_name': coop_name,
                    'immunization_file_name': immunization_file_name,
                    'immunization_file': immunization_file,
                    'student_profile_pic': student_profile_pic,
                    'answer_3': ans3,
                    'questions': JSON.stringify({
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
                },
                success: function (response) {
                    // console.log(response)
                    if (response.success) {
                        if (ans3 == 'yes') {
                            $('.add_student').addClass('hide');
                            $('.student_transfer').removeClass('hide');
                           student_id = response.data.student_id;
                            // console.log("Student ID:", student_id);
                            $('#student_id').val(student_id);
                        } else if (ans3 == 'no') {
                            edit_flag = false
                            $('.add_student').addClass('hide');
                            $('.student_transfer').addClass('hide');
                            $('.add_course').removeClass('hide');
                            $('.bgChange').css('background-color', '#f1f1f1');
                           student_id = response.data.student_id;
                            $('#student_id').val(student_id);
                        }
                        $('.add_course #student_image').attr('src', img_url)    
                        $('.add_course #student_name').html(f_name + ' ' + m_name + ' ' + l_name)
                        $('.add_course #student_grade').html(grade)
                        // window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                else{
                    swal("", "Something Went Wrong!", "error");
                }
            }
            });

        } else {
            $('.add_course #student_image').attr('src', img_url)
            $('.add_course #student_name').html(f_name + ' ' + m_name + ' ' + l_name)
            $('.add_course #student_grade').html(grade)
            student = {
                student_id,
                f_name,
                m_name,
                l_name,
                dob,
                age,
                yearPaying,
                grade,
                country,
                county,
                state,
                gender,
                coop_name,
                course,
                immunization_file_name,
                immunization_file,
                student_profile_pic,
                questions: {
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
                },
                transfer: ans3 == 'yes' ? student_tranfer : null
            }

            // console.log("Student Data:", student);
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    'action': 'ajax_handle_student_reg',
                    'type': 'student_registration',
                    // 'registration_id': registration_id,
                    // 'registration_id': rid,
                    'student_id': student_id,
                    'first_name': f_name,
                    'middle_name': m_name,
                    'last_name': l_name,
                    'dob': dob,
                    'age': age,
                    'yearPaying': yearPaying,
                    'grade': grade,
                    'country': country,
                    'county': county,
                    'state': state,
                    'gender': gender,
                    'coop_name': coop_name,
                    'immunization_file_name': immunization_file_name,
                    'immunization_file': immunization_file,
                    'student_profile_pic': student_profile_pic,
                    'answer_3': ans3,
                    'questions': JSON.stringify({
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
                },
                success: function (response) {
                    // console.log(response)
                    if (response.success) {
                        if (ans3 == 'yes') {
                            $('.add_student').addClass('hide');
                            $('.student_transfer').removeClass('hide');
                           student_id = response.data.student_id;
                            // console.log("Student ID:", student_id);
                            $('#student_id').val(student_id);
                            // Find student in existing data array by student_id
                            let existingStudentIndex = data.findIndex(s => s.student_id === student_id);

                            if (existingStudentIndex !== -1) {
                                // Update existing student data
                                data[existingStudentIndex] = student;
                                data[existingStudentIndex].student_id = student_id.toString();
                            } else {
                                // Add new student 
                                student.student_id = student_id.toString();
                                data.push(student);
                            }
                            // window.scrollTo({ top: 0, behavior: 'smooth' });
                        } else if (ans3 == 'no') {
                            $('.add_student').addClass('hide');
                            $('.student_transfer').addClass('hide');
                            $('.add_course').removeClass('hide');
                            $('.bgChange').css('background-color', '#f1f1f1');
                           student_id = response.data.student_id;
                            $('#student_id').val(student_id);
                            // Find student in existing data array by student_id
                            let existingStudentIndex = data.findIndex(s => s.student_id === student_id);

                            if (existingStudentIndex !== -1) {
                                // Update existing student data
                                data[existingStudentIndex] = student;
                                data[existingStudentIndex].student_id = student_id.toString();;
                            } else {
                                // Add new student 
                                student.student_id = student_id.toString();;
                                data.push(student);
                            }
                            }
                            // window.scrollTo({ top: 0, behavior: 'smooth' });
                        }
                    else{
                        swal("", "Something Went Wrong!", "error");
                    }
                }
            });
        }
        $("#reg_add_course_area tbody tr").remove();
        renderCourse()
        // console.log(data)
        // console.log("Data After Student page:", data);
    });

    $('.add_student_btn').click(function () {

        edit_flag = false
        $('#student_id').val('0');

        $("#reg_add_course_area tbody tr").remove();

        $('.add_course').addClass('hide');
        $('.student_summary').addClass('hide');
        $('.add_student').removeClass('hide');

        if (data.length >= 1) {
            $('.for_additional').removeClass('hide');
            $('.for_additional #set_additional_values').val('no').trigger('change');
        } else {
            $('.for_additional').addClass('hide');
            $('.for_additional #set_additional_values').val('no').trigger('change');
        }

        $('.student_transfer #school_type').val('');
        $('.student_transfer #school_name').val('');
        $('.student_transfer #country_code').val('+1');
        $('.student_transfer #school_number').val('');
        $('.student_transfer #school_email').val('');
        $('.student_transfer #school_address').val('');
        $('.student_transfer #school_city').val('');
        $('.student_transfer #school_zip_code').val('');
        $('.student_transfer #state').val('-1').trigger('change');   
        $('.student_transfer #country').val('-1').trigger('change');
        $('.student_transfer #school_last_date').val('');
        $(".studentTranferEmailCheckBox input[type='checkbox']").prop("checked", false);


        $('.add_student #student_f_name').val('')
        $('.add_student #student_m_name').val('')
        $('.add_student #student_l_name').val('')
        $('.add_student #dob').val('')
        // $('.add_student #age option[value=1]').attr('selected', 'selected');
        $('.add_student #age').val('')
        $('.add_student #student_grade').val('-1').trigger('change');
        $('.add_student #county option[value=-1]').attr('selected', 'selected');
        $('.add_student #state option[value=-1]').attr('selected', 'selected');
        $('.add_student #gender').val('-1').trigger('change');
        $('.add_student #coop_name').val('')
        $('.add_student .reg_1 .ans1').val('-1').trigger('change');
        $('.add_student .reg_1 .please_describe').addClass('hide');
        $('.add_student .reg_1 #please_describe').val('');
        $('.add_student .reg_1 .ans2 option[value=-1]').attr('selected', 'selected');
        $('.add_student .reg_1 .ans3 option[value=-1]').attr('selected', 'selected');

        $('.show_immunization_file_name').html(``);
        $('#immunization_file_url').val('');
        $('#preview-profile-img').attr('src', ajax_object.base_url + 'img/new_profile_default.png');
        immunization_file_name = '';
        student_profile_pic = '';
        immunization_file = '';

        // $('#edit_student_grade option').filter(function () {
        //     return ($(this).text() == grade); //To select Blue
        // }).prop('selected', true);
        add_student_btn = true; 
        course = []
    })

    $('.add_student_back_btn').click(function () {
        // window.scrollTo({ top: 0, behavior: 'smooth' });
        $('.back_to_parent').click();
        $("#personal img").attr("src", ajax_object.base_url + "img/Progress Bar Students 2 Incomplete.png");
        $('.address_box').removeClass('hide');
        $('.add_student').addClass('hide');
    });


    // ################### Add Student End ########################  -->

    // ################### Student Transfer Start  ########################  -->

    $('.student_transfer #set_additional_values').on("change", function () {
        // Get selected value
        let check_information = $(this).val();

        // If "yes" is selected, populate fields with previous values
        if (check_information === 'yes') {
            // console.log(student_tranfer);
            // Only populate if student_transfer object exists and has values
            if (student_tranfer) {
                $('.student_transfer #school_type').val(student_tranfer.school_type);
                $('.student_transfer #school_name').val(student_tranfer.school_name);
                $('.student_transfer #country_code').val(student_tranfer.school_number_country_code);
                $('.student_transfer #school_number').val(student_tranfer.school_number);
                $('.student_transfer #school_email').val(student_tranfer.school_email);
                $('.student_transfer #school_address').val(student_tranfer.school_address);
                $('.student_transfer #school_city').val(student_tranfer.school_city);
                $('.student_transfer #school_zip_code').val(student_tranfer.school_zip_code);
                $('.student_transfer #state').val(student_tranfer.school_state).trigger('change');
                $('.student_transfer #county').val(student_tranfer.school_county).trigger('change'); 
                $('.student_transfer #school_last_date').val(student_tranfer.school_last_date);
                $(".studentTranferEmailCheckBox input[type='checkbox']").prop("checked", false);
            }
        } else {
            // Clear all fields if "no" is selected
            $('.student_transfer #school_type').val('');
            $('.student_transfer #school_name').val('');
            $('.student_transfer #country_code').val('+1');
            $('.student_transfer #school_number').val('');
            $('.student_transfer #school_email').val('');
            $('.student_transfer #school_address').val('');
            $('.student_transfer #school_city').val('');
            $('.student_transfer #school_zip_code').val('');
            $('.student_transfer #state').val('-1').trigger('change');
            $('.student_transfer #school_county').val('-1').trigger('change');
            $('.student_transfer #school_last_date').val('');
            $(".studentTranferEmailCheckBox input[type='checkbox']").prop("checked", false);
        }
    });


    $('.next_to_add_course').on('click', function () {

        // Clear any existing error messages
        $('.error-message').remove();
        let error = 0;
        // console.log('new data before == >', data);
        let school_type = $('.student_transfer #school_type').val()
        let school_name = $('.student_transfer #school_name').val()
        let school_number = $('.student_transfer #school_number').val()
        let school_number_country_code = $('.student_transfer #country_code').val()
        let school_email = $('.student_transfer #school_email').val()
        let school_address = $('.student_transfer #school_address').val()
        let school_city = $('.student_transfer #school_city').val()
        let school_zip_code = $('.student_transfer #school_zip_code').val()
        let school_state = $('.student_transfer #state').val()
        let school_county = $('.student_transfer #county').val()
        let school_last_date = $('.student_transfer #school_last_date').val()
        let school_email_is_double_check = $(".studentTranferEmailCheckBox input[type='checkbox']").is(":checked");
        let student_id = $('#student_id').val();

        // let phoneChange = school_number.split('-').join('')
        let phoneChange = NumberremoveFormat(school_number);
        student_tranfer = {
            school_type,
            school_name,
            school_number,
            school_number_country_code,
            school_email,
            school_address,
            school_city,
            school_zip_code,
            school_state,
            school_county,
            school_last_date,
        }
        let validatEmail = validateEmail(school_email);

        student.transfer = student_tranfer;

        if (school_type == '') {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">School Type is required.</span>');

            // Insert the error message after the input field
            $('.student_transfer #school_type').after(errorMessage);
            error = 1;
        }

        if (school_name == ''){
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">School Name is required.</span>');

            // Insert the error message after the input field
            $('.student_transfer #school_name').after(errorMessage);
            error = 1;
        }

        if (school_number == ''){
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">School Number is required.</span>');


            $('.student_transfer #school_number').after(errorMessage);
            error = 1;
        } else if (!phoneChange || phoneChange.length != 10) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please enter a valid phone number.</span>');

            // Insert the error message after the input field
            $('.student_transfer #school_number').after(errorMessage);
            error = 1;
        }

        if (school_email == ''){
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">School Email is required.</span>');

            // Insert the error message after the input field
            $('.student_transfer #school_email').after(errorMessage);
            error = 1;
        } else if (!validatEmail) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please enter a valid email address.</span>');

            // Insert the error message after the input field
            $('.student_transfer #school_email').after(errorMessage);
            error = 1;
        }

        if (school_address == ''){
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">School Address is required.</span>');


            $('.student_transfer #school_address').after(errorMessage);
            error = 1;
        }

        if (school_city == ''){
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">School City is required.</span>');

            // Insert the error message after the input field
            $('.student_transfer #school_city').after(errorMessage);
            error = 1;
        }

        if (school_zip_code == ''){
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">School Zip Code is required.</span>');

            // Insert the error message after the input field
            $('.student_transfer #school_zip_code').after(errorMessage);
            error = 1;
        }

        if (school_state == '-1'){
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">School State is required.</span>');

            // Insert the error message after the input field
            $('.student_transfer #state').after(errorMessage);
            error = 1;
        }

        if (school_county == '-1'){
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">School County is required.</span>');

            // Insert the error message after the input field
            $('.student_transfer #county').after(errorMessage);
            error = 1;
        }

        if (school_last_date == ''){
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">School Last Date is required.</span>');

            // Insert the error message after the input field
            $('.student_transfer #school_last_date').after(errorMessage);
            error = 1;
        }

        if (!school_email_is_double_check) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please Double Check Email.</span>');

            // Insert the error message after the input field
            $('.student_transfer .studentTranferEmailCheckBox').after(errorMessage);
            error = 1;
        }

        if (error == 1) {
            return false;
        }



        // if (!school_name || !school_number || !school_email || !school_address || !school_city || !school_zip_code || !school_state =='-1' || school_county =='-1' || !school_last_date) {
        //     swal("", "Please Fill All Fields", "error");
        //     return false;
        // } else if (!validatEmail) {
        //     swal("", "Please Enter Corrent Email", "error");
        //     return false;
        // }else if (!school_email_is_double_check) {
        //     swal("", "Please Double Check Email", "error");
        //     return false;
        // }else
        if (edit_flag) {
            data[edit_data_index].transfer = {
                school_type,
                school_name,
                school_number,
                school_number_country_code,
                school_email,
                school_address, 
                school_city,
                school_zip_code,
                school_state,
                school_county,
                school_last_date,
            }
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    'action': 'ajax_handle_student_transfer',
                    'type': 'student_transfer',
                    // 'registration_id': rid,
                    'student_id': student_id,
                    'student_transfer': JSON.stringify(
                        {
                            "school_type": school_type,
                            "school_name": school_name,
                            "school_number": phoneChange,
                            'school_number_country_code': school_number_country_code,
                            "school_email": school_email,
                            "school_address": school_address,
                            "school_city": school_city,
                            "school_zip_code": school_zip_code,
                            "school_state": school_state,
                            "school_county": school_county,
                            "school_last_date": school_last_date,
                            'school_email_is_double_check': school_email_is_double_check
                        }
                    )
                },
                success: function (response) {
                    // console.log(response)
                    if (response.success) {
                        // $('.for_additional').removeClass('hide');
                        $('.student_transfer').addClass('hide');
                        $('.add_course').removeClass('hide');
                        $('.bgChange').css('background-color', '#f1f1f1');
                        // console.log('new data after == >', data);
                        // window.scrollTo({ top: 0, behavior: 'smooth' });
                    }else
                    {
                        swal("", "Something Went Wrong!", "error");
                    }
                }
            });
        } else {
            // console.log('student_id == >', student_id);
            // console.log(student_id);
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    'action': 'ajax_handle_student_transfer',
                    'type': 'student_transfer',
                    // 'registration_id': rid,
                    'student_id': student_id,
                    'student_transfer': JSON.stringify(
                        {
                            "school_type": school_type,
                            "school_name": school_name,
                            "school_number": phoneChange,
                            'school_number_country_code': school_number_country_code,
                            "school_email": school_email,
                            "school_address": school_address,
                            "school_city": school_city,
                            "school_zip_code": school_zip_code,
                            "school_state": school_state,
                            "school_county": school_county,
                            "school_last_date": school_last_date,
                            'school_email_is_double_check': school_email_is_double_check
                        }
                    )
                },
                success: function (response) {
                    // console.log(response)
                    if (response.success) {
                        // $('.for_additional').removeClass('hide');
                        $('.student_transfer').addClass('hide');
                        $('.add_course').removeClass('hide');
                        $('.bgChange').css('background-color', '#f1f1f1');
                        // window.scrollTo({ top: 0, behavior: 'smooth' });
                        // data.push(student)
                        // $('.student_transfer #school_type').val('')
                        // $('.student_transfer #school_name').val('')
                        // $('.student_transfer #school_number').val('')
                        // $('.student_transfer #school_email').val('')
                        // $('.student_transfer #school_address').val('')
                        // $('.student_transfer #school_city').val('')
                        // $('.student_transfer #school_zip_code').val('')
                        // $('.student_transfer #state').val('-1').trigger('change');
                        // $('.student_transfer #county').val('-1').trigger('change');
                        // $('.student_transfer #school_last_date').val('')
                        // $(".studentTranferEmailCheckBox input[type='checkbox']").prop("checked", false);

                        // console.log('new data after == >', data);
                    }else
                    {
                        // console.log(response)
                        swal("", "Something Went Wrong!", "error");
                    }
                }
            });
            
        $('#set_additional_values option').filter(function () {
            return ($(this).text() == 'no'); //To select Blue
        }).prop('selected', true);

        // if (data.length >= 1) {
        //     $('.for_additional').removeClass('hide');
        //     $('.for_additional #set_additional_values').val('no').trigger('change');
        // } else {
        //     $('.for_additional').addClass('hide');
        //     $('.for_additional #set_additional_values').val('no').trigger('change');
        // }
    }

    // console.log("Data After Student-transfer page:", data);
    });

    $('.student_transfer_back_btn').click(function () {
        // window.scrollTo({ top: 0, behavior: 'smooth' });
        $('.add_student').removeClass('hide');
        $('.student_transfer').addClass('hide');
    });
    // ################### Student Transfer End  ########################  -->


    // ################### Student Course Start  ########################  -->
    $('.course_back_btn').click(function () {
        data.pop();
        let ans3 = $('.add_student .reg_1 .ans3').val();
        if(ans3 == 'yes'){
            $('.student_transfer').removeClass('hide');
            $('.add_course').addClass('hide');
            // window.scrollTo({ top: 0, behavior: 'smooth' });
        }else{
            $('.add_student').removeClass('hide');
            $('.add_course').addClass('hide');
            // window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
    // ################### Student Course End ########################  -->


    // ################### Student Summary Start ########################  -->
    $('.studentSummaryBackBtn').click(function () {
        // window.scrollTo({ top: 0, behavior: 'smooth' });
        $('.add_course').removeClass('hide');
        $('.student_summary').addClass('hide');
    })
    // ################### Student Summary End ########################  -->



    // ################### Add Course Start ########################  -->

    $('#add_course_plus_icon').click(function () {

        let checkCourseStudentTitle = $('.singleStudentSummary #student_name').html()
        let checkCourseStudentGrade = $('.singleStudentSummary #student_grade').html()
        let credit;
        let additional;
        let studentGrade = $('.add_student #student_grade').val();

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
            // Check if an empty course object already exists
            let emptyIndex = course.findIndex(c => 
                !c.studentGrade &&
                !c.courseName && 
                !c.publisher && 
                !c.semester && 
                !c.grade && 
                !c.credit && 
                !c.description && 
                !c.additional &&
                !c.schedule
            );

            if (emptyIndex !== -1) {
                // Update existing empty course object
                course[emptyIndex] = {
                    studentGrade,
                    courseName: '',
                    publisher: 'Book Publisher/Online Course', 
                    semester: '',
                    grade: 'In Progress',
                    credit,
                    description: 'Description',
                    additional,
                    schedule: ''
                };
            } else {
                // Add new course object
                course.push({
                    studentGrade,
                    courseName: '',
                    publisher: 'Book Publisher/Online Course',
                    semester: '',
                    grade: 'In Progress', 
                    credit,
                    description: 'Description',
                    additional,
                    schedule: ''
                });
            }

            $("#reg_add_course_area tbody tr").remove();
            // console.log('course add == >', course);
            renderCourse();
        }
    })


    $('.next_to_student_summary').click(function () {

        // Clear any existing error messages
        $('.error-message').remove();
        let error = 0;

        // console.log('course')
        let move_to_next = true;
        let description_message = false;
        let publisher_message = false;
        $(".publisher").each(function () {
            let input = $(this).html();
            if (input.includes(' Book Publisher/Online Course')) {
                move_to_next = false
            }
        });

        // $(".description input").each(function () {
        //     let input = $(this).val();

        //     if (!input) {
        //         move_to_next = false
        //     }
        // });

        let year = $('.parent_1 .payingYear').val();
        let student_id = $('#student_id').val();
        // console.log('year == >', year);

        // console.log($("#reg_add_course_area tbody tr").length)
        // if ($("#reg_add_course_area tbody tr").length === 0) {
        //     // swal("", "Please Add At Least One Course!", "error");
        //     $('.add_course .singleStudentSummary').after('<span class="error-message d-flex justify-content-center mt-2 mb-2" style="color: red;">Please Add At Least One Course!</span>');
        //     return;
        // }

        let errorPublisherClass = '';
        let errorDescriptionClass = '';
        
        $("#reg_add_course_area tbody tr").each(function () {
            let checkCourseStudentGrade = $('.singleStudentSummary #student_grade').html()
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

        if(error == 1){
            return false;
        }
         
        if (move_to_next) {
            flag_for_file = 0;
            edit_flag = false
            setStudentData();

            // console.log("Data == >", data);
            // console.log("Get course data", course);
            let course_data = [];
            course.forEach(courseItem => {
                // Check if course item is not empty
                const isEmptyCourse = !courseItem.studentGrade &&
                                     !courseItem.courseName && 
                                     !courseItem.publisher &&
                                     !courseItem.semester &&
                                     !courseItem.grade &&
                                     !courseItem.credit &&
                                     !courseItem.description &&
                                     !courseItem.additional &&
                                     !courseItem.schedule;

                // Only add course if it's not completely empty                     
                if (!isEmptyCourse) {
                    let courseObj = {
                        studentGrade: courseItem.studentGrade || '',
                        courseName: courseItem.courseName || '',
                        publisher: courseItem.publisher ? courseItem.publisher.replace(/<span[^>]*>(.*?)<\/span>/g, '$1').trim() : '',
                        semester: courseItem.semester || '',
                        grade: courseItem.grade || '',
                        credit: courseItem.credit || '',
                        description: courseItem.description || '', 
                        additional: courseItem.additional || '',
                        schedule: courseItem.schedule || '',
                        year: year
                    };
                    course_data.push(courseObj);
                }
            });

            // console.log('Load course_data == >', course_data);
            $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'action': 'ajax_handle_student_course',
                'type': 'student_course',
                // 'registration_id': rid,
                'student_id': student_id,
                'student_course': JSON.stringify(course_data),
            },
            success: function (response) {
                if (response.success) {
                $('.add_course').addClass('hide');
                $('.student_summary').removeClass('hide');
                // window.scrollTo({ top: 0, behavior: 'smooth' });
                }
                else{
                swal("", "Sorry, Something went wrong!", "error");
                }
            }
            });
        } else {
            if (publisher_message) {
                // swal("", "Please Fill Publisher!", "error");
                $(errorPublisherClass).after('<br><span class="error-message" style="color: red;">Please Fill Publisher!</span>');
                error = 1;
            } 
            // else if (description_message) {
            //     // swal("", "Please Fill Description!", "error");
            //     $(errorDescriptionClass).after('<span class="error-message" style="color: red;">Please Fill Description!</span>');
            //     error = 1;
            // }

            if(error == 1){
                return false;
            }
        }
        // console.log("Data After Student-course page:", data);
    });


    $('.next_to_agreement_btn').click(function () {
        $('.next_to_agreement').click();
    });
    // ################### Add Course End ########################  -->




    // ################### Agreement Start ########################  -->

    $('.next_to_step_4').click(function () {

        // Clear any existing error messages
        $('.error-message').remove();
        let error = 0;
        let privacy_check = $(".privacyBox input[type='checkbox']").is(":checked");
        let signature_f_name = $("#signature_f_name").val();
        let signature_l_name = $("#signature_l_name").val();
        // let signature_full_name = signature_f_name + '_' + signature_l_name;
        let signature_date = $("#signature_date").val();
        // let signature_image = $('#signature-image').attr('src');

        // console.log("signature_image: ", signature_image);
        // console.log(privacy_check, signature_f_name, signature_l_name, signature_date)

        digital_signature = {
            check: privacy_check,
            f_name: signature_f_name,
            l_name: signature_l_name,
            date: signature_date,
            // image: ''
        }

        if (!privacy_check) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please Read and Accept Policies</span>');

            // Insert the error message after the input field
            $('.arrangementPage .card').after(errorMessage);
            error = 1;
        }

        if (signature_f_name == '' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please Fill Signature field</span>');

            // Insert the error message after the input field
            $('#signature_f_name').after(errorMessage);
            error = 1;
        }

        if (signature_l_name == '' ) {
            // Create an error message element
            var errorMessage = $('<span class="error-message" style="color: red;">Please Fill Signature field</span>');

            // Insert the error message after the input field
            $('#signature_l_name').after(errorMessage);
            error = 1;
        }

        if (error == 1) {
            return false;
        }
          
        // if (!privacy_check) {
        //     swal("","Please Read and Accept Policies", "error");
        // } else if (!signature_f_name || !signature_l_name) {
        //     swal("","Please Fill Signature FIield", "error");
        // } 
        // else if (signature_image == "") {
        //     swal("","Please Add Your Signature in the Box", "error");
        // }
        // else if (!isDate(signature_date|| !signature_date)) {
        //     swal("", "Please Insert Valid Date!", "error");
        // }
        //  else {
        //     $('.step_4').click();
        //     $('.next_to_step_4').hide();
        //     setPayment()
        //     setStudentData()
            
        // }
        // else if (privacy_check && signature_f_name && signature_l_name && signature_date && signature_image) {
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    'action': 'ajax_handle_digital_signature',
                    'type': 'digital_signature',
                    // 'signature_full_name': signature_full_name,
                    // 'signature_image': signature_image,
                    'digital_signature': JSON.stringify(digital_signature),
                },
                success: function (response) {
                    if (response.success) {    
                        $('.step_4').click();
                        $('.next_to_step_4').hide();
                        // window.scrollTo({ top: 0, behavior: 'smooth' });
                        setPayment()
                        setStudentData()
                    } else {
                        swal("", "Sorry, Something went wrong!", "error");
                    }
                }
            });
        // } else {
        //     swal("Something is Missing!", "Please Read and Accept Policies", "error");
        // }
    })

    $('.backToStudentSummary').click(function () {
        $("#payment img").attr("src", ajax_object.base_url + "img/Progress Bar  Agreement 3 Incomplete.png");
   })
    // ################### Agreement End ########################  -->

    // START SET PAYMENT
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
        // let transferFee = 0; // Transfer Fee
        let addTransferFee = 0;
        // let family_app_fee = 50;



        // console.log(data);
        // if (data && data.length > 0) {
        //     // Only consider the first item in data array
        //     let firstStudent = data[0];
        //     // console.log(firstStudent);
            
        //     if (firstStudent.grade == 'Kindergarten') {
        //         kindergarten += 1;
        //     }
        //     if (firstStudent.grade == '1ST GRADE') {
        //         grade_1 += 1;  
        //     }
        //     if (firstStudent.grade == '2ND GRADE') {
        //         grade_2 += 1;
        //     }
        //     if (firstStudent.grade == '3RD GRADE') {
        //         grade_3 += 1;
        //     }
        //     if (firstStudent.grade == '4TH GRADE') {
        //         grade_4 += 1;
        //     }
        //     if (firstStudent.grade == '5TH GRADE') {
        //         grade_5 += 1;
        //     }
        //     if (firstStudent.grade == '6TH GRADE') {
        //         grade_6 += 1;
        //     }
        //     if (firstStudent.grade == '7TH GRADE') {
        //         grade_7 += 1;
        //     }
        //     if (firstStudent.grade == '8TH GRADE') {
        //         grade_8 += 1;
        //     }
        //     if (firstStudent.grade == '9TH GRADE') {
        //         grade_9 += 1;
        //     }
        //     if (firstStudent.grade == '10TH GRADE') {
        //         grade_10 += 1;
        //         // if (firstStudent.questions.q2.ans2 == 'yes') {
        //         //     addTransferFee += 1;
        //         // }
        //     }
        //     if (firstStudent.grade == '11TH GRADE') {
        //         grade_11 += 1;
        //         // if (firstStudent.questions.q2.ans2 == 'yes') {
        //         //     addTransferFee += 1;
        //         // }
        //     }
        //     if (firstStudent.grade == '12TH GRADE') {
        //         grade_12 += 1;
        //         // if (firstStudent.questions.q2.ans2 == 'yes') {
        //         //     addTransferFee += 1;
        //         // }
        //     }
        //     if (firstStudent.grade == '8TH WITH HS CREDIT') {
        //         hs_credit_8 += 1;
        //     }
        //     if (firstStudent.grade == 'K8 SPECIAL NEEDS') {
        //         special_need_k8 += 1;
        //     }
        //     if (firstStudent.grade == 'HS SPECIAL NEEDS') {
        //         special_need_hs += 1;
        //     }
        // }

        // console.log(firstStudent.questions.q3.ans3);

        // Check if data array has items and first student exists with questions
        // if (data && data.length > 0 && data[0] && data[0].questions && data[0].questions.q3 && data[0].questions.q3.ans3 === 'yes') {
        //     addTransferFee += 1;

        // }


        data.map(function (item) {

                // console.log(item)

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

                if (item.questions.q2.ans2 == 'yes') {
                    addTransferFee += 1
                }
            }
            if (item.grade == '11TH GRADE') {
                grade_11 += 1;

                if (item.questions.q2.ans2 == 'yes') {
                    addTransferFee += 1
                }
            }
            if (item.grade == '12TH GRADE') {
                grade_12 += 1;

                if (item.questions.q2.ans2 == 'yes') {
                    addTransferFee += 1
                }
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
        })

        // ################## Set Family Application fee
        appendCartItem('Family Application Fee', 1, family_app_fee_price);
        appendTrasactionItems('Family Application Fee', 1, family_app_fee_price);
        // ################## Set Family Application fee



        // ################## Set Annual Registration fee
        // appendTrasactionItems('Annual Registration Fee',1,annualRegistrationFee);
        appendCartItem('Processing Fee', 1, annualRegistrationFee_price);
        appendTrasactionItems('Processing Fee', 1, annualRegistrationFee_price);

        // ################## Set Annual Registration fee


        // ################## Set Transfer Fee
        if (addTransferFee > 0) {
            appendCartItem('Transfer Fee', addTransferFee, transferFee_price);
            appendTrasactionItems('Transfer Fee', addTransferFee, transferFee_price);
        }
        // ################## Set Transfer Fee

        if (special_need_hs) {
            appendCartItem('HS SPECIAL NEEDS', special_need_hs, EachStudentPayAfter_8_price);
            appendTrasactionItems('HS SPECIAL NEEDS', special_need_hs, EachStudentPayAfter_8_price);
        }
        if (special_need_k8) {
            appendCartItem('K-8 SPECIAL NEEDS', special_need_k8, EachStudentPayBelow_8_price);
            appendTrasactionItems('K-8 SPECIAL NEEDS', special_need_k8, EachStudentPayBelow_8_price);
        }
        if (grade_12) {
            appendCartItem('12TH GRADE', grade_12, EachStudentPayAfter_8_price);
            appendTrasactionItems('12TH GRADE', grade_12, EachStudentPayAfter_8_price);
        }

        if (grade_11) {
            appendCartItem('11TH GRADE', grade_11, EachStudentPayAfter_8_price);
            appendTrasactionItems('11TH GRADE', grade_11, EachStudentPayAfter_8_price);
        }
        if (grade_10) {
            appendCartItem('10TH GRADE', grade_10, EachStudentPayAfter_8_price);
            appendTrasactionItems('10TH GRADE', grade_10, EachStudentPayAfter_8_price);
        }
        if (grade_9) {
            appendCartItem('9TH GRADE', grade_9, EachStudentPayAfter_8_price);
            appendTrasactionItems('9TH GRADE', grade_9, EachStudentPayAfter_8_price);
        }
        if (hs_credit_8) {
            appendCartItem('8TH WITH HS CREDIT', hs_credit_8, EachStudentPayAfter_8_price);
            appendTrasactionItems('8TH WITH HS CREDIT', hs_credit_8, EachStudentPayAfter_8_price);
        }
        if (grade_8) {
            appendCartItem('8TH GRADE', grade_8, EachStudentPayBelow_8_price);
            appendTrasactionItems('8TH GRADE', grade_8, EachStudentPayBelow_8_price);
        }
        if (grade_7) {
            appendCartItem('7TH GRADE', grade_7, EachStudentPayBelow_8_price);
            appendTrasactionItems('7TH GRADE', grade_7, EachStudentPayBelow_8_price);
        }

        if (grade_6) {
            appendCartItem('6TH GRADE', grade_6, EachStudentPayBelow_8_price);
            appendTrasactionItems('6TH GRADE', grade_6, EachStudentPayBelow_8_price);
        }


        if (grade_5) {
            appendCartItem('5TH GRADE', grade_5, EachStudentPayBelow_8_price);
            appendTrasactionItems('5TH GRADE', grade_5, EachStudentPayBelow_8_price);
        }
        if (grade_4) {
            appendCartItem('4TH GRADE', grade_4, EachStudentPayBelow_8_price);
            appendTrasactionItems('4TH GRADE', grade_4, EachStudentPayBelow_8_price);
        }

        if (grade_3) {
            appendCartItem('3RD GRADE', grade_3, EachStudentPayBelow_8_price);
            appendTrasactionItems('3RD GRADE', grade_3, EachStudentPayBelow_8_price);
        }

        if (grade_2) {
            appendCartItem('2ND GRADE', grade_2, EachStudentPayBelow_8_price);
            appendTrasactionItems('2ND GRADE', grade_2, EachStudentPayBelow_8_price);
        }

        if (grade_1) {
            appendCartItem('1ST GRADE', grade_1, EachStudentPayBelow_8_price);
            appendTrasactionItems('1ST GRADE', grade_1, EachStudentPayBelow_8_price);
        }

        if (kindergarten) {
            appendCartItem('Kindergarten GRADE', kindergarten, EachStudentPayBelow_8_price);
            appendTrasactionItems('Kindergarten GRADE', kindergarten, EachStudentPayBelow_8_price);
        }

        let Total_1 = (kindergarten + grade_1 + grade_2 + grade_3 + grade_4 + grade_5 + grade_6 + grade_7 + grade_8 + special_need_k8) * EachStudentPayBelow_8_price
        let Total_2 = (hs_credit_8 + grade_9 + grade_10 + grade_11 + grade_12 + special_need_hs) * EachStudentPayAfter_8_price

        let Total = Total_1 + Total_2;
        // console.log(family_app_fee_price, annualRegistrationFee_price, (transferFee_price * addTransferFee))

        Total += parseInt(family_app_fee_price) + parseInt(annualRegistrationFee_price) + parseInt(transferFee_price * addTransferFee);

        // console.log(Total);

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
        $("#paidAmount").val(`${Total}`);
        jQuery("#studentsForm").prepend(`<input type="text" name="paidAmount" id="paidAmount" value="${Total}">`);
        jQuery(".appendCouponAmonnt").prepend(`<input type="hidden" class="setAmountForCoupon" value="${Total}"></input> `);

    }
    // END SET PAYMENT

    let edit_index;
    let f_name;
    let m_name;
    let l_name;
    let grade;

    function setStudentData() {

        $(".studentSummary").remove();

        // my_arrayFilterData = data.filter((item) => item);

        // console.log(my_arrayFilterData)
        
        // console.log(data)
        // data.map(function (item, index) {
        //     student_profile_pic = $('#preview-profile-img').attr('src');
        //     let img_url = student_profile_pic.replace('http://', 'https://');

            // let img_url = ajax_object.base_url + 'img/fallback.png';
            // if (item.gender == 'male') {
            //     img_url = ajax_object.base_url +  'img/user5.jpg';
            // } else if (item.gender == 'female') {
            //     img_url = ajax_object.base_url + 'img/user4.jpg';
            // }
            // if (item.student_profile_pic) {
            //     img_url = item.student_profile_pic;
            // }
            // Render Student In Student Summary
            student_id = $('#student_id').val();
            data.forEach(function(studentItem, index) {
                let img_url = studentItem.student_profile_pic || ajax_object.base_url + 'img/fallback.png';
                img_url = img_url.replace('http://', 'https://');
                if (!studentItem.student_profile_pic) {
                    if (studentItem.gender === 'male') {
                        img_url = ajax_object.base_url + 'img/user5.jpg';
                    } else if (studentItem.gender === 'female') {
                        img_url = ajax_object.base_url + 'img/user4.jpg';
                    }
                }

                // Render student summary box
                $('.studentSummaryBox').append(` 
                    <div class="row studentSummary d-md-flex align-items-md-center justify-content-md-center">
                        <div class="col-md-1">
                            <img src="${img_url}" alt="" srcset="">
                        </div>
                        <div class="col-md-8" style="padding-left: 50px;">
                            <strong>${studentItem.f_name} ${studentItem.m_name} ${studentItem.l_name}</strong>
                            <br>
                            <label>${studentItem.grade}</label>
                        </div>
                        <div class="col-md-2">
                            <button 
                                href="#editStudent"
                                data-grade="${studentItem.grade}"
                                data-l_name="${studentItem.l_name}" 
                                data-m_name="${studentItem.m_name}"
                                data-f_name="${studentItem.f_name}"
                                data-index="${index}"
                                data-student-id="${studentItem.student_id}"
                                class="edit_student btn btn-primary action-button">
                                Edit
                            </button>
                        </div>
                        <div class="col-md-1">
                            <i class="fa-solid fa-user-xmark delete_student" 
                               data-index="${index}"
                               data-student-id="${studentItem.student_id}"
                               style="cursor: pointer; color: #dc3545; font-size: 20px;">
                            </i>
                        </div>
                    </div>
                `);

                // DELETE STUDENT FROM STUDENT SUMMARY
                $('.delete_student').off('click').on('click', function () {
                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this student!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true
                    }).then((willDelete) => {
                        if (willDelete) {
                            delete data[$(this).attr("data-index")];
                            data = data.filter(item => item !== null && item !== undefined);
                            student_id = $(this).attr("data-student-id");
                            // console.log("student_id", student_id);
                            // for delete the sutdent from database
                            $.ajax({
                                type: 'POST',
                                url: ajax_object.ajax_url,
                                data: {
                                    'action': 'ajax_handle_delete_student',
                                    'type': 'delete_student',
                                    // 'registration_id': rid,
                                    'student_id': student_id
                                },
                                success: function (response) {
                                    // if (jQuery.isEmptyObject(data)) {
                                    if (response.success) {
                                        swal("", "Student Deleted Successfully!", "success");
                                        // console.log(data);
                                        // console.log(data.length);
                                        setStudentData();
                                        if(data.length<= 0){                                                                            
                                            edit_flag = false
                                            $('#student_id').val('0');

                                            $("#reg_add_course_area tbody tr").remove();

                                            $('.add_course').addClass('hide');
                                            $('.student_summary').addClass('hide');
                                            $('.add_student').removeClass('hide');

                                            $('.student_transfer #school_type').val('');
                                            $('.student_transfer #school_name').val('');
                                            $('.student_transfer #country_code').val('+1');
                                            $('.student_transfer #school_number').val('');
                                            $('.student_transfer #school_email').val('');
                                            $('.student_transfer #school_address').val('');
                                            $('.student_transfer #school_city').val('');
                                            $('.student_transfer #school_zip_code').val('');
                                            $('.student_transfer #state').val('');
                                            $('.student_transfer #county').val('');
                                            $('.student_transfer #school_last_date').val('');

                                            $('.add_student #student_f_name').val('')
                                            $('.add_student #student_m_name').val('')
                                            $('.add_student #student_l_name').val('')
                                            $('.add_student #dob').val('')
                                            // $('.add_student #age option[value=1]').attr('selected', 'selected');
                                            $('.add_student #age').val('')
                                            $('.add_student #student_grade').val('-1').trigger('change');
                                            $('.add_student #county option[value=-1]').attr('selected', 'selected');
                                            $('.add_student #state').val('-1').trigger('change');
                                            $('.add_student #gender').val('-1').trigger('change');
                                            $('.add_student #coop_name').val('')
                                            $('.add_student .reg_1 .ans1').val('-1').trigger('change');
                                            $('.add_student .reg_1 .please_describe').addClass('hide');
                                            $('.add_student .reg_1 #please_describe').val('');
                                            $('.add_student .reg_1 .ans2').val('-1').trigger('change');
                                            $('.add_student .reg_1 .ans3').val('-1').trigger('change');

                                            $('.show_immunization_file_name').html(``);
                                            $('#immunization_file_url').val('');
                                            $('#preview-profile-img').attr('src', ajax_object.base_url + 'img/fallback.png');
                                            immunization_file_name = '';
                                            student_profile_pic = '';
                                            immunization_file = '';

                                            // $('#edit_student_grade option').filter(function () {
                                            //     return ($(this).text() == grade); //To select Blue
                                            // }).prop('selected', true);
                                            add_student_btn = true; 
                                            course = []
                                        }
                                    }
                                    else {
                                        swal("", "Sorry, Something went wrong!", "error");
                                    }
                                }
                            });
                        }
                    });
                });
                // DELETE STUDENT FROM STUDENT SUMMARY

                // EDIT STUDENT FROM STUDENT SUMMARY
                $('.edit_student').off('click').on('click', function () {
                    $('#student_id').val($(this).attr("data-student-id"));
                    edit_index = $(this).attr("data-index");
                    edit_flag = true;
                    edit_data_index = edit_index;

                    let e_data = data[edit_index];
                    $('.add_student').removeClass('hide');
                    $('.student_summary').addClass('hide');

                    $('.add_student #student_f_name').val(e_data.f_name);
                    $('.add_student #student_m_name').val(e_data.m_name);
                    $('.add_student #student_l_name').val(e_data.l_name);
                    $('.add_student #dob').val(e_data.dob);
                    $('.add_student #age').val(e_data.age).trigger('change');
                    $('.add_student #student_grade').val(e_data.grade).trigger('change');
                    $('.add_student #state').val(e_data.state).trigger('change');
                    $('.add_student #country').val(e_data.country).trigger('change');
                    $('.add_student #county').val(e_data.county).trigger('change');
                    $('.add_student #gender').val(e_data.gender).trigger('change');
                    $('.add_student #coop_name').val(e_data.coop_name);
                    $('.add_student #immunization_file_url').val(e_data.immunization_file);
                    $('.show_immunization_file_name').html(`
                        <span>
                            ${e_data.immunization_file_name}
                        </span>
                        <i class="far fa-times-circle pl-3 pt-1 delete_file"></i>`);
                    // console.log(e_data.student_profile_pic);
                    if (e_data.student_profile_pic) {
                        $('.add_student #preview-profile-img').attr('src', e_data.student_profile_pic);
                    }
                    else{
                        if (e_data.gender === 'male') {
                            $('.add_student #preview-profile-img').attr('src', ajax_object.base_url + 'img/user5.jpg');
                        }
                        else if (e_data.gender === "female") {
                            $('.add_student #preview-profile-img').attr('src', ajax_object.base_url + 'img/user4.jpg');
                        }
                        else{
                            $('.add_student #student_profile_pic').attr('src', ajax_object.base_url + 'img/fallback.png');
                        }
                    }
                    $('.add_student .reg_1 .ans1').val(e_data.questions.q1.ans1).trigger('change');
                    // console.log(e_data.questions.please_describe);
                    $('.add_student .reg_1 .please_describe').val(e_data.questions.please_describe);
                    $('.add_student .reg_1 .ans2').val(e_data.questions.q2.ans2).trigger('change');
                    $('.add_student .reg_1 .ans3').val(e_data.questions.q3.ans3).trigger('change');

                    if (e_data.questions.q3.ans3 === 'yes' && e_data.transfer) {
                        $('.for_additional').addClass('hide');
                        $('.student_transfer #school_type').val(e_data.transfer.school_type);
                        $('.student_transfer #school_name').val(e_data.transfer.school_name);
                        $('.student_transfer #school_number').val(e_data.transfer.school_number);
                        $('.student_transfer #school_email').val(e_data.transfer.school_email);
                        $('.student_transfer #school_address').val(e_data.transfer.school_address);
                        $('.student_transfer #school_city').val(e_data.transfer.school_city);
                        $('.student_transfer #school_zip_code').val(e_data.transfer.school_zip_code);
                        $('.student_transfer #state').val(e_data.transfer.school_state);
                        $('.student_transfer #county').val(e_data.transfer.school_county);
                        $('.student_transfer #school_last_date').val(e_data.transfer.school_last_date);
                    }

                    $('#reg_add_course_area tbody tr').remove();
                    if (e_data.course && e_data.course.length > 0) { 
                        course = [];
                        let CustomCouse = ['Math','Science','English','History','Physical Education','Religious Studies','Foreign Language','Social Studies','Art','Music'];
                        let not_show_credit = ['Kindergarten','1ST GRADE','2ND GRADE','3RD GRADE','4TH GRADE','5TH GRADE','6TH GRADE','7TH GRADE','8TH GRADE'];
                        e_data.course.map(function(item, idx) {
                            course.push({
                                studentGrade: item.studentGrade,
                                courseName: item.courseName,
                                publisher: item.publisher,
                                semester: item.semester,
                                grade: item.grade,
                                credit: item.credit,
                                description: item.description,
                                additional: item.additional
                            });

                            let checkCourseStudentGrade = e_data.grade;
                            let show_additional = ['9TH GRADE','10TH GRADE','11TH GRADE','12TH GRADE','8TH WITH HS CREDIT'];

                            $('#reg_add_course_area tbody').append(` 
                                <tr class="${idx}" onkeyup="editCourse(${idx})" onClick="editCourse(${idx})" onchange="editCourse(${idx})">
                                    <td class="selectCourse">
                                        <div style="display:flex;width: 250px;">
                                            <input style="margin-bottom:0" type='${CustomCouse.includes(item.courseName) && 'hidden' || item.courseName === '' && 'hidden' || 'text'}' value="${item.courseName}" />
                                            <select>
                                                <option ${item.courseName === '' && "selected"} value="" style="display:none">Main Subject Area</option>
                                                <option ${!CustomCouse.includes(item.courseName) && item.courseName !== '' && "selected"} value="Custom">Custom</option>
                                                <option ${item.courseName === 'Math' && "selected"} value="Math">Math</option>
                                                <option ${item.courseName === 'Science' && "selected"} value="Science">Science</option>
                                                <option ${item.courseName === 'English' && "selected"} value="English">English</option>
                                                <option ${item.courseName === 'History' && "selected"} value="History">History</option>
                                                <option ${item.courseName === 'Physical Education' && "selected"} value="Physical Education">Physical Education</option>
                                                <option ${item.courseName === 'Religious Studies' && "selected"} value="Religious Studies">Religious Studies</option>
                                                <option ${item.courseName === 'Foreign Language' && "selected"} value="Foreign Language">Foreign Language</option>
                                                <option ${item.courseName === 'Social Studies' && "selected"} value="Social Studies">Social Studies</option>
                                                <option ${item.courseName === 'Art' && "selected"} value="Art">Art</option>
                                                <option ${item.courseName === 'Music' && "selected"} value="Music">Music</option>
                                            </select>
                                            &nbsp;
                                            <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Select the general subject area for this course"></i>
                                        </div>
                                        <p onclick="emptyVal(${idx},'publisher')" class="publisher" contenteditable="true" style="display: inline-block;max-width: 225px;width: 89%;border-bottom: 1px solid #ccc;background: transparent;outline: none; padding-top: 10px; padding-left: 10px;">${item.publisher}</p>
                                        &nbsp;                                        
                                        <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="List the specific course name"></i>
                                    </td>
                                    <td class="text-center">
                                        <div style="width: 230px;">
                                            <span onClick="chooseSemester(${idx},'fall','sem1')" class="sem1 badge rounded-pill  ${item.semester.search('fall') !== -1 ? 'text-bg-primary' : 'text-bg-secondary'}">Fall</span>
                                            <span onClick="chooseSemester(${idx},'spring','sem2')" class="sem2 badge rounded-pill  ${item.semester.search('spring') !== -1 ? 'text-bg-primary' : 'text-bg-secondary'}">Spring</span>
                                            <span onClick="chooseSemester(${idx},'summer','sem3')" class="sem3 badge rounded-pill  ${item.semester.search('summer') !== -1 ? 'text-bg-primary' : 'text-bg-secondary'}">Summer</span>
                                            &nbsp;
                                            <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Select which semester(s) this course will be taught. If this course will be taught year-round select all 3 semesters"></i>
                                        </div>
                                    </td>
                                    <td class="grade">
                                        <div>
                                            <select>
                                                <option value="" style="display:none">Grade</option>
                                                <option ${item.grade === 'In Progress' && "selected"} value="In Progress">In Progress</option>
                                                <option ${item.grade === 'A+' && "selected"} value="A+">A+</option>
                                                <option ${item.grade === 'A' && "selected"} value="A">A</option>
                                                <option ${item.grade === 'A-' && "selected"} value="A-">A-</option>
                                                <option ${item.grade === 'B+' && "selected"} value="B+">B+</option>
                                                <option ${item.grade === 'B' && "selected"} value="B">B</option>
                                                <option ${item.grade === 'B-' && "selected"} value="B-">B-</option>
                                                <option ${item.grade === 'C+' && "selected"} value="C+">C+</option>
                                                <option ${item.grade === 'C' && "selected"} value="C">C</option>
                                                <option ${item.grade === 'C-' && "selected"} value="C-">C-</option>
                                                <option ${item.grade === 'D+' && "selected"} value="D+">D+</option>
                                                <option ${item.grade === 'D' && "selected"} value="D">D</option>
                                                <option ${item.grade === 'D-' && "selected"} value="D-">D-</option>
                                                <option ${item.grade === 'F' && "selected"} value="F">F</option>
                                                <option ${item.grade === 'Pass' && "selected"} value="Pass">Pass</option>
                                                <option ${item.grade === 'Incomplete' && "selected"} value="Incomplete">Incomplete</option>
                                                <option ${item.grade === 'Excellent' && "selected"} value="Excellent">Excellent</option>
                                                <option ${item.grade === 'Satisfactory' && "selected"} value="Satisfactory">Satisfactory</option>
                                                <option ${item.grade === 'Needs Improvement' && "selected"} value="Needs Improvement">Needs Improvement</option>
                                            </select>
                                            &nbsp;
                                            <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Leave course grade as In Progress. You will be able to assign grades for each course within your parent portal account"></i>
                                        </div>
                                    </td>
                                    ${
                                        !not_show_credit.includes(checkCourseStudentGrade)
                                        ? `<td class="credit">
                                            <div style="display:flex;align-items:center">
                                                <input style="min-width: 100px;" type="text" onclick="emptyVal(${idx},'credit')" value="${item.credit ? item.credit : 'Credit'}" />
                                                &nbsp;
                                                <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="1 credit = 1 full year of study. 0.5 credit = one semester of study."></i>
                                            </div>
                                        </td>`
                                        : `<td></td>`
                                    }
                                    ${
                                        show_additional.includes(checkCourseStudentGrade)
                                        ? `<td class="additional">
                                            <div style="display:flex; align-items:center">
                                                <select onchange="chooseAdditional(${idx}, this.value)">
                                                    <option ${item.additional === "Standard Course" && "selected"} value="Standard Course">Standard Course</option>
                                                    <option ${item.additional === "AP" && "selected"} value="AP">AP</option>
                                                    <option ${item.additional === "CLEP" && "selected"} value="CLEP">CLEP</option>
                                                    <option ${item.additional === "Dual Enrollment" && "selected"} value="Dual Enrollment">Dual Enrollment</option>
                                                    <option ${item.additional === "Honors" && "selected"} value="Honors">Honors</option>
                                                    <option ${item.additional === "IB" && "selected"} value="IB">IB</option>
                                                </select>
                                                &nbsp;
                                                 <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="For all regular/standard high school courses select Standard Course. If this high school course qualifies for AP/CLEP/Dual Enrollment select the appropriate option. Please Note: we require official exam results/transcripts in order to list the course appropriately as such on the student’s transcript."></i>
                                            </div>
                                        </td>`
                                        : `<td></td>`
                                    }
                                    <td class="description">
                                            <div style="display:flex;">
                                                <input class="mb-2" style="min-width: 120px;" type="text" onclick="emptyVal(${idx},'description')" value="${item.description || 'Description'}" />
                                                &nbsp;
                                                <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="List the specific book or online course you are utilizing and/or describe how this course will be taught."></i>
                                            </div>
                                        </td>
                                    <td class="text-center">
                                        <span class="dropdownBox">
                                            <a class="dropdown-item delete_course" href="#delete" data-index="${idx}" onClick="deleteCourse(${idx})"><i class="far fa-trash-alt"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            `);
                            $('[data-toggle="popover"]').popover();
                            $('body').on('click', function (evt) {
                                $('[data-toggle=popover]').each(function () {
                                    if (!$(this).is(evt.target) && $(this).has(evt.target).length === 0 && $('.popover').has(evt.target).length === 0) {
                                        $(this).popover('hide');
                                    }
                                });
                            });
                        });
                    }
                });
                // EDIT STUDENT FROM STUDENT SUMMARY
            });

    }

    $('.step_2').click(function () {
        $('.addStudentButton').hide();
    })

    $('.backFromSubmit').click(function () {
        $("#confirm img").attr("src", ajax_object.base_url  + "img/Progress Bar  Payment 4 Incomplete.png");
        $('.next_to_step_4').show();
    })
    $('.parentPortalBackFromSubmit').click(function () {
        $('.student_summary').removeClass('hide');
        $('.payment').addClass('hide');
    })


    $('.next_to_step_2').click(function () {
        let grade = $('#student_grade').val()
        let f_name = $('#student_f_name').val()
        let m_name = $('#student_m_name').val()
        let l_name = $('#student_l_name').val()

        if (grade && f_name && l_name) {
            data.push({
                f_name,
                m_name,
                l_name,
                grade
            })
            setStudentData();
        }

        if (data.length > 0) {
            $('.step_2').click();
            $('.next_to_step_2').hide();
            $('.back_to_step_2').hide();
            $('.studentSummaryBackBtn').show();
        } else {
            swal("Something Wrong!", "Please Add Student!", "error");
        }
    })


    $(".next").click(function () {
        if ($("#personal").hasClass("active")) {
            $("#personal img").attr("src", ajax_object.base_url + "img/Progress Bar 2 Student Complete.png");
        }
        if ($("#payment").hasClass("active")) {
            $("#payment img").attr("src", ajax_object.base_url + "img/Progress Bar 3 Agreement Complete.png");
        }
        if ($("#confirm").hasClass("active")) {
            $("#confirm img").attr("src", ajax_object.base_url  + "img/Progress Bar 4 Payment Complete.png");
        }
    });

    let fall = '';
    let spring = '';
    let summer = '';

    $('.chooseSemester').on("click", function () {
        let id = $(this).attr('data-id')
        let calenderSlot = $('#' + id).find('.schedule-class select').val()
        let semester = '';

        // if ($(this).find('.a').hasClass("badge-primary")) {
        if($(this).find('.a').hasClass("text-bg-primary")) {
            fall = 'fall'
        } else {
            fall = ''
        }

        // if ($(this).find('.b').hasClass("badge-primary")) {
        if ($(this).find('.b').hasClass("text-bg-primary")) {
            spring = 'spring'
        } else {
            spring = ''
        }

        // if ($(this).find('.c').hasClass("badge-primary")) {
        if ($(this).find('.c').hasClass("text-bg-primary")) {
            summer = 'summer'
        } else {
            summer = ''
        }

        semester = fall + "," + spring + "," + summer

        // $.ajax({
        //     type: 'POST',
        //     url: 'Controllers/ajax.php',
        //     data: {
        //         'type': 'inline_edit_semester',
        //         'id': id,
        //         'semester': semester,
        //         'calenderSlot': calenderSlot
        //     },
        //     success: function (data) {


        //     },
        // })


        if (fall) {
            // $('#' + id + ' .credit select').val('0.50').trigger('change');
            $('#' + id + ' .credit input').val('0.50');
        }
        if (spring) {
            // $('#' + id + ' .credit select').val('0.50').trigger('change');
            $('#' + id + ' .credit input').val('0.50');
        }
        if (summer) {
            // $('#' + id + ' .credit select').val('1.00').trigger('change');
            $('#' + id + ' .credit input').val('1.00');
        }
        if (fall && spring) {
            // $('#' + id + ' .credit select').val('1.00').trigger('change');
            $('#' + id + ' .credit input').val('1.00');
        }
        if (!fall && !spring && !summer) {
            // $('#' + id + ' .credit select').val('0.0').trigger('change');
            $('#' + id + ' .credit input').val('0.0');
        }
    })



    $('.chooseSemester .badge').on("click", function () {

        // if ($(this).hasClass("badge-primary")) {
        //     $(this).removeClass("badge-primary");
        //     $(this).addClass("badge-secondary");
        // } else if ($(this).hasClass("badge-secondary")) {
        //     $(this).addClass("badge-primary");
        //     $(this).removeClass("badge-secondary");
        // }

        if ($(this).hasClass("text-bg-primary")) {
            $(this).removeClass("text-bg-primary");
            $(this).addClass("text-bg-secondary");
        }
        else if ($(this).hasClass("text-bg-secondary")) {
            $(this).addClass("text-bg-primary");
            $(this).removeClass("text-bg-secondary");
        }
    })


    // $('.addNote').on("click", function () {
    //     $("#noteAppend").empty();
    //     let id = $(this).attr("data-id");
        // $.ajax({
        //     type: 'POST',
        //     url: 'Controllers/ajax.php',
        //     data: {
        //         'type': 'get_notes',
        //         'course_id': id,
        //     },
        //     success: function (data) {
        //         console.log(data)
                // $('#noteAppend').append(data);
        //     },
        // })
        //    alert(id)
    // })

    // ##################### Back to Order Summary #####################
    $('.backToOrderSummary').click(function () {
        $('.PaymentPage').addClass('hide');
        $('.payment').removeClass('hide');
        $('.backFromSubmit').removeClass('hide');
        $('.payOrder').removeClass('hide');
        // $('.payNow').removeClass('hide');  
    })
    // ##################### Back to Order Summary #####################

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
        // Clear any existing error messages
        $('.error-message').remove();
        let error = 0;
        let code = $('#coupon_code').val() || $('#coupon_code1').val()
        // console.log(code);
        if (!code) {
            // return swal('', "Please Enter Code", "error");
            var errorMessagePhone = '<span class="error-message" style="color: red; padding-left: 5px;">Please Enter Coupon Code</span>';
            $('.showMessagePhone').after(errorMessagePhone);

            var errorMessageDesktop = '<br><span class="error-message" style="color: red; padding-left: 115px;">Please Enter Coupon Code</span>';
            $('.showMessageDestop').append(errorMessageDesktop);
            error = 1;
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
                }
                 else {

                    if (data.data.amount < 0) {
                        return swal('', "Your Total Amount Lower than Discount", "error");
                    } else {
                        let rush_amount_after_remove_coupon = $(".rushAmountDesktop input[type='checkbox']").is(":checked") || $(".rushAmountMobile input[type='checkbox']").is(":checked") ? 25 : 0;
                        swal('', "Success", "success");
                        coupon_discount_amount = "$" + data.data.discount;
                        total_amount_without_rush_after_discount = data.data.amount;
                        total_amount_after_discount = eval(data.data.amount + "+" + rush_amount_after_remove_coupon);
                        $('.totalAmount').text(total_amount_after_discount.toFixed(2));
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

        $('.totalAmount').text(total_after_remove_coupon.toFixed(2));

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

    // For Add New Student
    $('.addStudentPage img').click(() => {
        let all_data = {
            parent_1,
            parent_2,
            additional_information,
            student_application,
            address,
            data
        }
        localStorage.setItem('data', JSON.stringify(all_data))
    })
    if (window.location.href.indexOf('addNewStudent') > -1) {
        $(function () {
            let userObjectFromStorage = localStorage.getItem("data");
            let userDataSet = JSON.parse(userObjectFromStorage);

            if (userDataSet && userDataSet.hasOwnProperty('data') && setUnsaveDataOnce) {
                if (userDataSet.data.length > 0) {
                    data = userDataSet.data.filter((item) => item.course.filter((item1) => item1));
                    add_student_btn = true;
                    setUnsaveDataOnce = false;
                    // console.log(data)
                }
            }
        })
    }

});

// Remove error messages instantly as user types
function removeEmptyFieldError(thisElement) {
    // Convert DOM element to jQuery object if it's not already
    var $element = $(thisElement);
    
    // Remove any existing error messages next to this element
    $element.next('.error-message').remove();
}

// Apply event handlers to all form fields
$(document).ready(function() {
    // Attach input event to all text inputs, selects, and textareas
    $('input[type="text"], input[type="email"], input[type="tel"], input[type="date"], select, textarea').on('input change', function() {
        removeEmptyFieldError(this);
    });

    // Attach input event to all select elements
    // $('select').on('change', function() {
    //     console.log("select change");
    // });
});


// Initialize all tooltips
document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl, {
            customClass: 'custom-tooltip'
        })
    })
})


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

function validateNumber(phone, id) {
    // Get the selected country code
    let countryCode = $(id).closest('.row').find('.country_code select').val();
    
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

function NumberremoveFormat(phone) {
    return phone.replace(/[^\d]/g, '');
}

function scheduleSlotOptionsHtml(selectedItem) {
// console.log("🚀 ~ file: ajax.js ~ line 3327 ~ scheduleSlotOptionsHtml ~ selectedItem", selectedItem)

    let calendarSlots = ['M-F', 'M-W-F', 'M-W', 'T-Thur', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    let html = `<select>`    
    
    for (let i = 0; i < calendarSlots.length; i++) {
        html += `<option ${calendarSlots[i] == selectedItem && "selected"} value="${calendarSlots[i]}">${calendarSlots[i]}</option>`
    }
    
    html += `</select>`;
    
    return html;
}

function renderCourse() {

    let CustomCouse = ['Math', 'Science', 'English', 'History', 'Physical Education', 'Religious Studies', 'Foreign Language', 'Social Studies', 'Art', 'Music'];
    let checkCourseStudentGrade = $('.singleStudentSummary #student_grade').html()
    // let not_show_description = ['9TH GRADE', '10TH GRADE', '11TH GRADE', '12TH GRADE', '8TH WITH HS CREDIT'];
    let not_show_credit = ['Kindergarten', '1ST GRADE', '2ND GRADE', '3RD GRADE', '4TH GRADE', '5TH GRADE', '6TH GRADE', '7TH GRADE', '8TH GRADE'];
    let show_additional = ['9TH GRADE', '10TH GRADE', '11TH GRADE', '12TH GRADE', '8TH WITH HS CREDIT'];

    if (course.length > 0) {
        course.map(function (item, index) {
            $('#reg_add_course_area tbody').append(` 
            <tr class="${index}" onkeyup="editCourse(${index})" onClick="editCourse(${index})" onchange="editCourse(${index})">
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
                &nbsp;
                <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle info-tooltip" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Select the general subject area for this course"></i>
                </div>
                    <p style="display: inline-block;max-width: 225px;width: 89%;border-bottom: 1px solid #ccc;background: transparent;outline: none; padding-top: 10px; padding-left: 10px;" onclick="emptyVal(${index},'publisher')" class="publisher" contenteditable="true"> ${item.publisher? item.publisher : 'Book Publisher/Online Course'}</p>
                    &nbsp;
                    <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle info-tooltip" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="List the specific course name"></i>
                </td>
                <td class=" text-center">
                <div class="button-wrapper">
                <span onClick="chooseSemester(${index},'fall','sem1')" class="sem1 badge rounded-pill ${item.semester.includes("fall") ? 'text-bg-primary' : 'text-bg-secondary'}">Fall</span>
                <span onClick="chooseSemester(${index},'spring','sem2')" class="sem2 badge rounded-pill ${item.semester.includes("spring") ? 'text-bg-primary' : 'text-bg-secondary'}">Spring</span>
                <span onClick="chooseSemester(${index},'summer','sem3')" class="sem3 badge rounded-pill ${item.semester.includes("summer") ? 'text-bg-primary' : 'text-bg-secondary'}">Summer</span>
                &nbsp; 
                <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle info-tooltip" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Select which semester(s) this course will be taught. If this course will be taught year-round select all 3 semesters"></i>
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
                        &nbsp;
                        <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle info-tooltip" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Leave course grade as In Progress. You will be able to assign grades for each course within your parent portal account"></i>
                    </div>
                </td>

                ${!not_show_credit.includes(checkCourseStudentGrade) ? `<td class="credit">
                <div style="display:flex;">
                    <input style="min-width: 100px;" type="text" onclick="emptyVal(${index},'credit')" value="${item.credit ? item.credit : 'Credit'}"/>
                    &nbsp;
                    <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle info-tooltip" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="1 credit = 1 full year of study. 0.5 credit = one semester of study."></i>
                </div>
                </td>`: `<td class=""></td>`}

                ${show_additional.includes(checkCourseStudentGrade) ? `<td class='additional'>
                <div style="display:flex;">
                <select name="" id="" onchange="chooseAdditional(${index}, this.value)">
                    <option ${item.additional === "Standard Course" ? "selected" : ""} value="Standard Course">Standard Course</option>
                    <option ${item.additional === "AP" ? "selected" : ""} value="AP">AP</option>
                    <option ${item.additional === "CLEP" ? "selected" : ""} value="CLEP">CLEP</option>
                    <option ${item.additional === "Dual Enrollment" ? "selected" : ""} value="Dual Enrollment">Dual Enrollment</option>
                    <option ${item.additional === "Honors" ? "selected" : ""} value="Honors">Honors</option>
                    <option ${item.additional === "IB" ? "selected" : ""} value="IB">IB</option>
                </select>&nbsp;
                <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle info-tooltip" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="For all regular/standard high school courses select Standard Course. If this high school course qualifies for AP/CLEP/Dual Enrollment select the appropriate option. Official exam results/transcripts are required to list the course appropriately on the student's transcript."></i>
                </div>
                </td>`: `<td class=''></td>`}
                <td class="description">
                    <div style="display:flex;">
                        <input class="mb-2" style="min-width: 120px;" type="text" onclick="emptyVal(${index},'description')" value="${item.description ? item.description : 'Description'}"/>
                        &nbsp;
                        <i style="cursor: pointer; color: #456fb6;" class="fa fa-info-circle info-tooltip" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="List the specific book or online course you are utilizing and/or describe how this course will be taught."></i>
                    </div>
                </td>
                <td class="schedule">
                ${scheduleSlotOptionsHtml(item.schedule)}
                </td>

                <td class="text-center">
                <span class="dropdownBox">
                    <a class="dropdown-item delete_course" href="#delete" data-index="${index}"
                    data-bs-toggle="modal"
                    onClick="deleteCourse(${index})"
                    ><i class="far fa-trash-alt" style="cursor: pointer;"></i>
                    </a>
                </span>
                </td>
            </tr>
            `)
        });
        
        // Initialize Bootstrap 5 tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('.info-tooltip'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            // Create tooltip instance
            var tooltip = new bootstrap.Tooltip(tooltipTriggerEl, {
                trigger: 'hover focus' // Show on hover and focus by default
            });
            
            // Add click event listener to toggle tooltip manually
            tooltipTriggerEl.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (tooltipTriggerEl._isShown) {
                    tooltip.hide();
                } else {
                    tooltip.show();
                }
                tooltipTriggerEl._isShown = !tooltipTriggerEl._isShown;
            });
            
            return tooltip;
        });
        
        // Close tooltips when clicking elsewhere on the document
        document.addEventListener('click', function (e) {
            if (!e.target.classList.contains('info-tooltip')) {
                tooltipList.forEach(function(tooltip) {
                    tooltip.hide();
                    tooltip._element._isShown = false;
                });
            }
        });
    } else {
        $('#reg_add_course_area tbody tr').remove();
    }
}

function chooseSemester(index, semester, sem) {
    // console.log('index', index);
    // console.log('semester', semester);
    // console.log('sem', sem);
    var all_semester = [];
    // if ($('#reg_add_course_area .' + index + ' .' + sem).hasClass("badge-primary")) {
    //     $('#reg_add_course_area .' + index + ' .' + sem).removeClass("badge-primary");
    //     $('#reg_add_course_area .' + index + ' .' + sem).addClass("badge-secondary");
    // } else if ($('#reg_add_course_area .' + index + ' .' + sem).hasClass("badge-secondary")) {
    //     $('#reg_add_course_area .' + index + ' .' + sem).addClass("badge-primary");
    //     $('#reg_add_course_area .' + index + ' .' + sem).removeClass("badge-secondary");
    // }
    // $('#reg_add_course_area .' + index + ' .badge-primary').each(function () {
    //     all_semester.push($(this).html());
    // });
    if ($('#reg_add_course_area .' + index + ' .' + sem).hasClass("text-bg-primary")) {
        $('#reg_add_course_area .' + index + ' .' + sem).removeClass("text-bg-primary");
        $('#reg_add_course_area .' + index + ' .' + sem).addClass("text-bg-secondary");
    } else if ($('#reg_add_course_area .' + index + ' .' + sem).hasClass("text-bg-secondary")) {
        $('#reg_add_course_area .' + index + ' .' + sem).addClass("text-bg-primary");
        $('#reg_add_course_area .' + index + ' .' + sem).removeClass("text-bg-secondary");
    }
    $('#reg_add_course_area .' + index + ' .text-bg-primary').each(function () {
        all_semester.push($(this).html());
    });

    if (all_semester.indexOf("Fall") > -1) {
        // $('.' + index + ' .credit select').val('0.50').trigger('change');
        $('.' + index + ' .credit input').val('0.50');
    }
    if (all_semester.indexOf("Spring") > -1) {
        // $('.' + index + ' .credit select').val('0.50').trigger('change');
        $('.' + index + ' .credit input').val('0.50');
    }
    if (all_semester.indexOf("Summer") > -1) {
        // $('.' + index + ' .credit select').val('1.00').trigger('change');
        $('.' + index + ' .credit input').val('1.00');
    }
    if (all_semester.indexOf("Spring") > -1 && all_semester.indexOf("Fall") > -1) {
        // $('.' + index + ' .credit select').val('1.00').trigger('change');
        $('.' + index + ' .credit input').val('1.00');
    }
    if (!(all_semester.indexOf("Fall") > -1) && !(all_semester.indexOf("Spring") > -1) && !(all_semester.indexOf("Summer") > -1)) {
        // $('.' + index + ' .credit select').val('0.0').trigger('change');
        $('.' + index + ' .credit input').val('0.0');
    }
}

function chooseAdditional(index , value){
    if (value == "Honors"){
        $('.' + index + ' .credit input').val('0.50');
    } else if (value == "AP" || value == "IB" || value == "Dual Enrollment") {
        $('.' + index + ' .credit input').val('1.00');
    } else {
        $('.' + index + ' .credit input').val('0.00');
    }
}

function editCourse(index) {
    // Ensure the course array has an object at this index
    if (!course[index]) {
        course[index] = {};
    }

    let name = jQuery("#reg_add_course_area ." + index + " .selectCourse select").val();
    let publisher = jQuery("#reg_add_course_area ." + index + " .publisher").html();
    let grade = jQuery("#reg_add_course_area ." + index + " .grade select").val();
    // let credit = jQuery("#reg_add_course_area ." + index + " .credit select").val();
    let credit = jQuery("#reg_add_course_area ." + index + " .credit input").val();
    let description = jQuery("#reg_add_course_area ." + index + " .description input").val();
    let additional = jQuery("#reg_add_course_area ." + index + " .additional select").val();
    let schedule = jQuery("#reg_add_course_area ." + index + " .schedule select").val();
    let studentGrade = jQuery('.add_student #student_grade').val();
    
    var all_semester = [];

    // $('#reg_add_course_area .' + index + ' .badge-primary').each(function () {
    //     all_semester.push($(this).html().toLowerCase());
    // }); 
    $('#reg_add_course_area .' + index + ' .text-bg-primary').each(function () {
        all_semester.push($(this).html().toLowerCase());
    });

    if (name == 'Custom') {
        $("#reg_add_course_area ." + index + " .selectCourse input").attr('type', 'text')
        name = jQuery("#reg_add_course_area ." + index + " .selectCourse input").val();
    } else {
        $("#reg_add_course_area ." + index + " .selectCourse input").attr('type', 'hidden')
    }

    // Update course object properties
    Object.assign(course[index], {
        studentGrade: studentGrade || '',
        courseName: name || '',
        publisher: publisher || '',
        semester: all_semester.toString(),
        grade: grade || '',
        credit: credit || '',
        description: description || '',
        additional: additional || '',
        schedule: schedule || ''
    });
}

function deleteCourse(index) {
    $('#reg_add_course_area .' + index).remove();
    // console.log('course before delete', course);
    // delete course[index];
    // Remove item from array 
    course.splice(index, 1);
    // course = course.filter((_, i) => i !== index);
    // console.log('course after delete', course);
    // Re-render course list
    // renderCourse();
}

function onlyNumberKey(evt) {

    // Only ASCII charactar in that range allowed 
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}

function getYear(n) {
    let d = new Date();
    let year = d.getFullYear();
    let month = d.getMonth();
    let day = d.getDate();
    let c = new Date(year + n, month, day);
    return c.getFullYear();
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

function emptyVal(id, clas) {
    if (clas == 'publisher') {
        if (jQuery("#reg_add_course_area ." + id + " ." + clas).html() == ' Book Publisher/Online Course') {
            // console.log(jQuery("#reg_add_course_area ." + id + " ." + clas).html())
            jQuery("#reg_add_course_area ." + id + " ." + clas).html('');
        }
    }

    if (clas == 'description') {
        if (jQuery("#reg_add_course_area ." + id + " ." + clas + " input").val() == 'Description') {
            jQuery("#reg_add_course_area ." + id + " ." + clas + " input").val('');
        }
    }

    if(clas == 'credit') {
        if (jQuery("#reg_add_course_area ." + id + " ." + clas + " input").val() == 'Credit') {
            jQuery("#reg_add_course_area ." + id + " ." + clas + " input").val('');
        }
    }
}

function appendTrasactionItems(item, quantity, price) {
    // jQuery('.transactionItems').append(`
    //     <input type="text" name='itemName[]' value="${item}">
    //     <input type="text" name='quantity[]' value="${quantity}">
    //     <input type="text" name='price[]' value="${price}">
    // `)


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

    // console.log('Price h ',studentPayClass);
    // console.log("Grade:", grade);
    // console.log("Student Class:", studenClass);
    // console.log("Student Pay Class:", studentPayClass);

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