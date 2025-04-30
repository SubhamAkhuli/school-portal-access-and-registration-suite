let immunization_file_name = '';
let student_profile_pic = '';
let immunization_file= '';

$(document).ready(function () {

    // form url get parameter
    const urlParams = new URLSearchParams(window.location.search);
    const student_id = urlParams.get('sid');

    if (!student_id) {
        $('#msform').html('<div class="alert alert-danger">No Student Data Found</div>');
        return;
    }

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

    // Get student data
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'get_student_data',
            'student_id': student_id
        },
        success: function (response) {
            // console.log(response);
            if (response.success) {
                let data = response.data;
                
                // Parse stored questions and course data
                let questions = JSON.parse(data.questions);
                
                // Fill in basic student info
                $('#student_f_name').val(data.first_name);
                $('#student_m_name').val(data.middle_name); 
                $('#student_l_name').val(data.last_name);
                $('#dob').val(data.dob);
                $('#age').val(data.age);
                $('#state').val(data.state).trigger('change');
                $('#county').val(data.county);
                $('#country').val(data.country).trigger('change');
                $('#student_grade').val(data.grade);
                $('#gender').val(data.gender.toLowerCase());
                $('#coop_name').val(data.coop_name);
                
                // Set question answers
                $('.ans1').val(questions.q1.ans1).trigger('change');
                $('.ans2').val(questions.q2.ans2); 
                $('.ans3').val(questions.q3.ans3);
                $('#please_describe').val(questions.please_describe);

                // Set profile image and immunization file if they exist
                if (data.student_profile_pic && data.immunization_file_name && data.immunization_file_url) {
                    let img_url = data.student_profile_pic.replace('http://', 'https://');
                    $('#preview-profile-img').attr('src', img_url);
                    $('#immunization_file_url').val(data.immunization_file_url);

                    $('.show_immunization_file_name').html(`
                        <span>${data.immunization_file_name}</span>
                        <i class="far fa-times-circle pl-3 pt-1 delete_file text-danger"></i>
                    `);
                }
                else{
                    // $('#preview-profile-img').attr('src', ajax_object.base_url + 'img/new_profile_default.png');
                    if (data.gender=='male'){
                        $('#preview-profile-img').attr('src', ajax_object.base_url + 'img/new_male_default.png');
                    } else if (data.gender == 'female'){
                        $('#preview-profile-img').attr('src', ajax_object.base_url + 'img/new_female_default.png');
                    } else {
                        $('#preview-profile-img').attr('src', ajax_object.base_url + 'img/new_profile_default.png');
                    }
                    $('.show_immunization_file_name').html(``);
                    $('#immunization_file_url').val('');
                }

                // Store student ID 
                $('#student_id').val(data.id);
            }
            else {
                $('#msform').html('<div class="alert alert-danger">No Student Data Found</div>');
            }
        },
        error: function (xhr, status, error) {
            $('#msform').html('<div class="alert alert-danger">An error occurred while fetching student data: ' + error + '</div>');
        }
    });

    // automatically calculate age from dob
    $('#dob').on('change', function() {
        var dobValue = $(this).val(); // Gets YYYY-MM-DD format
        var dob = new Date(dobValue);
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();
        var m = today.getMonth() - dob.getMonth();

        // Check if date is valid
        // if (!dobValue || dob == "Invalid Date") {
        //     swal("", "Please enter a valid date", "error");
        //     $(this).val('');
        //     $('.add_student #age').val('');
        //     return;
        // }

        // Check if date is in future
        if (dob > today) {
            swal("", "Date of birth cannot be in the future!", "error");
            $(this).val('');
            $('.add_student #age').val('');
            return;
        }

        // Check if age is too high  
        // if (age > 100) {
        //     swal("", "Please enter a valid date of birth!", "error");
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

    // Update student data
    $('.add_student #saveChangesButton').on('click', function(e){

        // Clear any existing error messages
        $('.error-message').remove();
        let error = 0;

        e.preventDefault();
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
        let student_profile_pic = $('#preview-profile-img').attr('src');
        let immunization_file_name = $('.show_immunization_file_name').text();
        immunization_file = $('#immunization_file_url').val();

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
            var errorMessage = $('<br><span class="error-message" style="color: red;">Please Select your Answer!</span>');
            
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
            var errorMessage = $(' <br><span class="error-message" style="color: red;">Please Select your Answer!</span>');

            $('.add_student .q2').after(errorMessage);
            error = 1;
        } 
        // else if (ans2 == 'yes') {
        //     // Create an error message element
        //     var errorMessage = $('<br><span class="error-message" style="color: red;">We are Unable to Accept This Application at This Time</span>');

        //     // Insert the error message after the input field
        //     $('.add_student .q2').after(errorMessage);
        //     error = 1;
        // }

        if (ans3 == '-1' ) {
            // Create an error message element
            var errorMessage = $('<br><span class="error-message" style="color: red;">Please Select your Answer!</span>');

            $('.add_student .q3').after(errorMessage);
            error = 1;
        }

        if (error == 1) {
            return false;
        }

        // if (!f_name || !l_name || !dob || !age || state == '-1' || county == '-1' || country == '-1' || grade == '-1' || county=='-1' || state=='-1'|| gender == '-1' || !coop_name) {
        //     swal("", "Please Fill All Fields", "error");
        // } else if (ans1 == '-1' || ans2 == '-1' || ans3 == '-1') {
        //     swal("", "Please Select your Answer!", "error");
        // } else if (ans2 == 'yes') {
        //     swal("", "We are Unable to Accept This Application at This Time", "error");
        // } else{
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    'action': 'edit_student_data',
                    'student_id': student_id,
                    'first_name': f_name,
                    'middle_name': m_name,
                    'last_name': l_name,
                    'dob': dob,
                    'age': age,
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
                    if (response.success) {
                        swal("", "Student Data Updated Successfully", "success");
                    } else {
                        swal("", "Error Updating Student Data", "error");
                    }
                }
            });
        // }

    });

    // Attach input event to all text inputs, selects, and textareas
    $('input[type="text"], input[type="email"], input[type="tel"], input[type="date"], select, textarea').on('input change', function() {
        removeEmptyFieldError(this);
    });


});

// Remove error messages instantly as user types
function removeEmptyFieldError(thisElement) {
    // Convert DOM element to jQuery object if it's not already
    var $element = $(thisElement);
    
    // Remove any existing error messages next to this element
    $element.next('.error-message').remove();
}
