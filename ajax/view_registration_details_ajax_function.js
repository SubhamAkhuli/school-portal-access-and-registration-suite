jQuery(document).ready(function ($) {

    // Get registration ID from URL
    const urlParams = new URLSearchParams(window.location.search);
    const rid = urlParams.get('rid');

    // set the Country code options in the phone number field
    $('.country_code').html(`
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
        <option data-countryCode="US" value="+1" Selected>USA (+1)</option>
        <option data-countryCode="UZ" value="+7">Uzbekistan (+7)</option>
        <option data-countryCode="VU" value="+678">Vanuatu (+678)</option>
        <option data-countryCode="VA" value="+379">Vatican City (+379)</option>
        <option data-countryCode="VE" value="+58">Venezuela (+58)</option>
        <option data-countryCode="VN" value="+84">Vietnam (+84)</option>
        <option data-countryCode="VG" value="+84">Virgin Islands - British (+1284)</option>
        <option data-countryCode="VI" value="+1340">Virgin Islands - US (+1340)</option>
        <option data-countryCode="WF" value="+681">Wallis &amp; Futuna (+681)</option>
        <option data-countryCode="YE" value="+969">Yemen (North)(+969)</option>
        <option data-countryCode="YE" value="+967">Yemen (South)(+967)</option>
        <option data-countryCode="ZM" value="+260">Zambia (+260)</option>
        <option data-countryCode="ZW" value="+263">Zimbabwe (+263)</option>
    `);

    // fetch all the data
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'get_registration_data_by_id',
            'registration_id': rid
        },
        success: function (response) {
            console.log(response);
            if (response.success) {
                if(response.data.data === null) { 
                    $('#parent1-details').html(`
                        <div class="d-flex align-items-center mb-4 justify-content-between">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-user-circle fs-2 text-primary me-3 mt-1"></i>
                                <h5 class="mb-0">Parent #1 Information</h5>
                            </div>
                        </div>
                        <div class="card border-0 bg-light rounded-3">
                            <div class="card-body">
                                <div class="text-center py-4">
                                    <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                    <p class="text-muted mb-0">No Parent #1 data found</p>
                                </div>
                            </div>
                        </div>
                    `);
                    $('#parent2-details').html(`
                        <div class="d-flex align-items-center mb-4 justify-content-between">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-user-circle fs-2 text-primary me-3 mt-1"></i>
                                <h5 class="mb-0">Parent #2 Information</h5>
                            </div>
                        </div>
                        <div class="card border-0 bg-light rounded-3">
                            <div class="card-body">
                                <div class="text-center py-4">
                                    <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                    <p class="text-muted
                                    mb-0">No Parent #2 data found</p>
                                </div>
                            </div>
                        </div>
                    `);
                    $('#additional-info').html(`
                        <div class="d-flex align-items-center mb-4 justify-content-between">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-info-circle fs-2 text-primary me-3 mt-1"></i>
                                <h5 class="mb-0">Additional Information</h5>
                            </div>
                        </div>
                        <div class="card border-0 bg-light rounded-3">
                            <div class="card-body">
                                <div class="text-center py-4">
                                    <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                    <p class="text-muted
                                    mb-0">No Additional Information data found</p>
                                </div>
                            </div>
                        </div>
                    `);
                    $('#student-application').html(`
                        <div class="d-flex align-items-center mb-4 justify-content-between">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-info-circle fs-2 text-primary me-3 mt-1"></i>
                                <h5 class="mb-0">Student Application</h5>
                            </div>
                        </div>
                        <div class="card border-0 bg-light rounded-3">
                            <div class="card-body">
                                <div class="text-center py-4">
                                    <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                    <p class="text-muted mb-0">No Student Application data found</p>
                                </div>
                            </div>
                        </div>
                    `);
                    $('#parent-address').html(`
                        <div class="d-flex align-items-center mb-4 justify-content-between">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-info-circle fs-2 text-primary me-3 mt-1"></i>
                                <h5 class="mb-0">Parent Address</h5>
                            </div>
                        </div>
                        <div class="card border-0 bg-light rounded-3">
                            <div class="card-body">
                                <div class="text-center py-4">
                                    <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                    <p class="text-muted mb-0">No Parent Address data found</p>
                                </div>
                            </div>
                        </div>
                    `);
                    // No student data found
                    $('#nav-student-info').html(`
                        <div class="d-flex align-items-center mb-4 justify-content-between">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-user-graduate fs-2 text-primary me-3 mt-1"></i>
                                <h5 class="mb-0">Student Information</h5>
                            </div>
                        </div>
                        <div class="card border-0 bg-light rounded-3">
                            <div class="card-body">
                                <div class="text-center py-4">
                                    <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                    <p class="text-muted mb-0">No student data found</p>
                                </div>
                            </div>
                        </div>
                    `);
                    $('#digital-signature').html(`
                        <div class="d-flex align-items-center mb-4 justify-content-between">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-info-circle fs-2 text-primary me-3 mt-1"></i>
                                <h5 class="mb-0">Digital Signature</h5>
                            </div>
                        </div>
                        <div class="card border-0 bg-light rounded-3">
                            <div class="card-body">
                                <div class="text-center py-4">
                                    <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                    <p class="text-muted
                                    mb-0">No Digital Signature data found</p>
                                </div>
                            </div>
                        </div>
                    `); 

                }
                else {
                    let data = response.data;
                    let parent_1 = data.parent_1_data;
                    let parent_2 = data.parent_2_data;
                    let additional_info_data = data.additional_info_data;
                    let student_application_data = data.student_application_data;
                    let parent_address_data = data.parent_address_data;
                    let student_data = data.student_data;

                    console.log("Parent 1 Data: ", parent_1);
                    console.log("Parent 2 Data: ", parent_2);
                    console.log("Additional Info Data: ", additional_info_data);
                    console.log("Student Application Data: ", student_application_data);
                    console.log("Parent Address Data: ", parent_address_data);
                    console.log("Student Data: ", student_data);

                    // Display the digital signature data - only display the first student's signature
                    if (data.student_data && data.student_data.length > 0 && data.student_data[0].digital_signature !== null) {
                        // console.log(data.student_data[0].digital_signature);
                        let student = data.student_data[0]; // Get first student
                        if (student.digital_signature) {
                            let signature = JSON.parse(student.digital_signature);
                            
                            // Update signature image
                            // if (signature.image) {
                            //     $('#signature_image').attr('src', signature.image);
                            // }
                            
                            // Update name
                            if (signature.f_name || signature.l_name) {
                                $('#signature_name').text(`${signature.f_name || ''} ${signature.l_name || ''}`);
                            }
                            
                            // Update date
                            if (signature.date) {
                                let dateObj;
                                
                                // Try to parse the date regardless of input format
                                if (typeof signature.date === 'string') {
                                    // Handle string date formats
                                    const dateParts = signature.date.split(/[-\/]/);
                                    if (dateParts.length === 3) {
                                        // Try to intelligently determine format based on values
                                        if (parseInt(dateParts[0]) > 12 && parseInt(dateParts[0]) <= 31) {
                                            // Likely DD/MM/YYYY format
                                            dateObj = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
                                        } else {
                                            // Assume MM/DD/YYYY or YYYY/MM/DD format
                                            if (parseInt(dateParts[0]) > 31) {
                                                // Likely YYYY/MM/DD format
                                                dateObj = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
                                            } else {
                                                // Likely MM/DD/YYYY format
                                                dateObj = new Date(dateParts[2], dateParts[0] - 1, dateParts[1]);
                                            }
                                        }
                                    } else {
                                        // Try standard JS date parsing
                                        dateObj = new Date(signature.date);
                                    }
                                } else if (signature.date instanceof Date) {
                                    // Already a Date object
                                    dateObj = signature.date;
                                } else {
                                    // Try to convert to Date object
                                    dateObj = new Date(signature.date);
                                }
                                
                                // Check if date is valid before formatting
                                if (!isNaN(dateObj.getTime())) {
                                    // Format as MM/DD/YYYY
                                    let month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
                                    let day = dateObj.getDate().toString().padStart(2, '0');
                                    let year = dateObj.getFullYear();
                                    $('#signature_date').text(`${month}/${day}/${year}`);
                                } else {
                                    // If parsing fails, try to format as MM/DD/YYYY if it's a string with slashes or dashes
                                    if (typeof signature.date === 'string') {
                                        const cleanDate = signature.date.replace(/[^0-9\/\-]/g, '');
                                        $('#signature_date').text(cleanDate.replace(/[-\/]/g, '/'));
                                    } else {
                                        // Last resort - display as is
                                        $('#signature_date').text(signature.date);
                                    }
                                }
                            }
                            
                            // The check is always shown as it's static text
                            $('#signature_check').text('Agreed to Terms & Conditions');
                        }
                    } else {
                        // console.log(data.student_data[0].digital_signature);
                        // If no signature data found, show placeholder text
                        $('#digital-signature').html(`
                            <div class="d-flex align-items-center mb-4 justify-content-between">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-info-circle fs-2 text-primary me-3 mt-1"></i>
                                    <h5 class="mb-0">Digital Signature</h5>
                                </div>
                            </div>
                            <div class="card border-0 bg-light rounded-3">
                                <div class="card-body">
                                    <div class="text-center py-4">
                                        <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                        <p class="text-muted
                                        mb-0">No Digital Signature data found</p>
                                    </div>
                                </div>
                            </div>
                        `);
                    }

                    // Parent 1
                    if (parent_1) {
                        
                        // Parse questions JSON safely
                        let parent1Questions = { questions: {} };
                        if (parent_1.questions) {
                            try {
                                parent1Questions = JSON.parse(parent_1.questions).questions;
                            } catch (e) {
                                // console.error("Error parsing parent 1 questions:", e);
                                parent1Questions = {
                                    q1: { ans1: '' }, q2: { ans2: '' }, q3: { ans3: '' },
                                    q4: { ans4: '' }, q5: { ans5: '' }, q6: { ans6: '' }
                                };
                            }
                        } else {
                            parent1Questions = {
                                q1: { ans1: '' }, q2: { ans2: '' }, q3: { ans3: '' },
                                q4: { ans4: '' }, q5: { ans5: '' }, q6: { ans6: '' }
                            };
                        }

                        // Update parent 1 section
                        $('#p1_role').html(parent_1.role.charAt(0).toUpperCase() + parent_1.role.slice(1));
                        $('#p1_full_name').html(parent_1.first_name + ' ' + parent_1.middle_name + ' ' + parent_1.last_name);

                        $('#p1_contact').html(formatPhoneNumber(parent_1.country_code, parent_1.phone));
                        $('#p1_email').html(parent_1.email);
                        $('#p1_school_year').html(parent_1.year_paying);
                        $('#p1_heard_about_us').html(parent_1.heard_about_us);
                        $('#p1_legal_custody').html(parent1Questions.q1.ans1.charAt(0).toUpperCase() + parent1Questions.q1.ans1.slice(1));
                        $('#p1_msg_authorization').html(parent1Questions.q2.ans2.charAt(0).toUpperCase() + parent1Questions.q2.ans2.slice(1));
                        $('#p1_high_school_diploma').html(parent1Questions.q3.ans3.charAt(0).toUpperCase() + parent1Questions.q3.ans3.slice(1));
                        $('#p1_education_level').html(parent1Questions.q4.ans4.charAt(0).toUpperCase() + parent1Questions.q4.ans4.slice(1));
                        $('#p1_lives_with_student').html(parent1Questions.q5.ans5.charAt(0).toUpperCase() + parent1Questions.q5.ans5.slice(1));
                        $('#p1_us_citizen').html(parent1Questions.q6.ans6.charAt(0).toUpperCase() + parent1Questions.q6.ans6.slice(1));


                        // set value in modal
                        document.getElementById('p1_edit_role').value = parent_1.role;
                        document.getElementById('p1_edit_f_name').value = parent_1.first_name;
                        document.getElementById('p1_edit_m_name').value = parent_1.middle_name;
                        document.getElementById('p1_edit_l_name').value = parent_1.last_name;
                        document.getElementById('p1_edit_country_code').value = parent_1.country_code;
                        document.getElementById('p1_edit_contact').value = showPhonenumber(parent_1.country_code, parent_1.phone);
                        document.getElementById('p1_edit_email').value = parent_1.email;
                        document.getElementById('p1_edit_school_year').value = parent_1.year_paying;
                        document.getElementById('p1_edit_heard_about_us').value = parent_1.heard_about_us;
                        document.getElementById('p1_edit_legal_custody').value = parent1Questions.q1.ans1;
                        document.getElementById('p1_edit_msg_authorization').value = parent1Questions.q2.ans2;
                        document.getElementById('p1_edit_high_school_diploma').value = parent1Questions.q3.ans3;
                        document.getElementById('p1_edit_education_level').value = parent1Questions.q4.ans4;
                        document.getElementById('p1_edit_lives_with_student').value = parent1Questions.q5.ans5;
                        document.getElementById('p1_edit_us_citizen').value = parent1Questions.q6.ans6;

                
                    }
                    else {
                        // no parent 1 data found
                        // $('#parent1-details').html('<p>No Parent #1 data found</p>');
                        $('#parent1-details').html(`
                            <div class="d-flex align-items-center mb-4 justify-content-between">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-user-circle fs-2 text-primary me-3 mt-1"></i>
                                    <h5 class="mb-0">Parent #1 Information</h5>
                                </div>
                            </div>
                            <div class="card border-0 bg-light rounded-3">
                                <div class="card-body">
                                    <div class="text-center py-4">
                                        <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                        <p class="text-muted mb-0">No Parent #1 data found</p>
                                    </div>
                                </div>
                            </div>
                        `);

                    }

                    // Parent 2
                    if (parent_2) {
                        // Parse questions JSON
                        let parent2Questions = JSON.parse(parent_2.questions).questions;
                        // Update parent 2 section
                        $('#p2_role').html(parent_2.role.charAt(0).toUpperCase() + parent_2.role.slice(1));
                        $('#p2_full_name').html(parent_2.first_name + ' ' + parent_2.middle_name + ' ' + parent_2.last_name);
                        $('#p2_contact').html(formatPhoneNumber(parent_2.country_code, parent_2.phone));
                        $('#p2_email').html(parent_2.email);
                        $('#p2_school_year').html(parent_2.year_paying);
                        $('#p2_msg_authorization').html(parent2Questions.q1.ans1.charAt(0).toUpperCase() + parent2Questions.q1.ans1.slice(1));
                        $('#p2_high_school_diploma').html(parent2Questions.q2.ans2.charAt(0).toUpperCase() + parent2Questions.q2.ans2.slice(1));
                        $('#p2_education_level').html(parent2Questions.q3.ans3.charAt(0).toUpperCase() + parent2Questions.q3.ans3.slice(1));
                        $('#p2_lives_with_student').html(parent2Questions.q4.ans4.charAt(0).toUpperCase() + parent2Questions.q4.ans4.slice(1));
                        $('#p2_us_citizen').html(parent2Questions.q5.ans5.charAt(0).toUpperCase() + parent2Questions.q5.ans5.slice(1));


                        // set value in modal
                        document.getElementById('p2_edit_role').value = parent_2.role;
                        document.getElementById('p2_edit_f_name').value = parent_2.first_name;
                        document.getElementById('p2_edit_m_name').value = parent_2.middle_name;
                        document.getElementById('p2_edit_l_name').value = parent_2.last_name;
                        document.getElementById('p2_edit_country_code').value = parent_2.country_code;
                        document.getElementById('p2_edit_contact').value = showPhonenumber(parent_2.country_code, parent_2.phone);
                        document.getElementById('p2_edit_email').value = parent_2.email;
                        document.getElementById('p2_edit_school_year').value = parent_2.year_paying;
                        document.getElementById('p2_edit_msg_authorization').value = parent2Questions.q1.ans1;
                        document.getElementById('p2_edit_high_school_diploma').value = parent2Questions.q2.ans2;
                        document.getElementById('p2_edit_education_level').value = parent2Questions.q3.ans3;
                        document.getElementById('p2_edit_lives_with_student').value = parent2Questions.q4.ans4;
                        document.getElementById('p2_edit_us_citizen').value = parent2Questions.q5.ans5;    

                    }
                    else {
                        // no parent 2 data found
                        $('#parent2-details').html(`
                            <div class="d-flex align-items-center mb-4 justify-content-between">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-user-circle fs-2 text-primary me-3 mt-1"></i>
                                    <h5 class="mb-0">Parent #2 Information</h5>
                                </div>
                            </div>
                            <div class="card border-0 bg-light rounded-3">
                                <div class="card-body">
                                    <div class="text-center py-4">
                                        <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                        <p class="text-muted
                                        mb-0">No Parent #2 data found</p>
                                    </div>
                                </div>
                            </div>
                        `);
                        
                    }

                    // Additional Information
                    if (additional_info_data) {
                        // Parse questions JSON
                        let additionalQuestions = JSON.parse(additional_info_data.questions).questions;
                        // Update additional info section
                        $('#additional_q1').html('<strong>Answer:</strong> ' + (additionalQuestions.q1.ans1.charAt(0).toUpperCase() + additionalQuestions.q1.ans1.slice(1)));
                        $('#additional_q2').html('<strong>Answer:</strong> ' + (additionalQuestions.q2.ans2.charAt(0).toUpperCase() + additionalQuestions.q2.ans2.slice(1)));
                        $('#additional_q3').html('<strong>Answer:</strong> ' + (additionalQuestions.q3.ans3.charAt(0).toUpperCase() + additionalQuestions.q3.ans3.slice(1)));
                        $('#additional_q4').html('<strong>Answer:</strong> ' + (additionalQuestions.q4.ans4.charAt(0).toUpperCase() + additionalQuestions.q4.ans4.slice(1)));
                        $('#additional_q5').html('<strong>Answer:</strong> ' + (additionalQuestions.q5.ans5.charAt(0).toUpperCase() + additionalQuestions.q5.ans5.slice(1)));

                        if (additionalQuestions.q5.ans5 === 'yes') {
                            $('#additional_explanation').html(additionalQuestions.explanation);
                        }
                        else {
                            $('#additional_explanation_div').hide();
                        }

                        // set value in modal
                        document.getElementById('additional_edit_q1').value = additionalQuestions.q1.ans1;
                        document.getElementById('additional_edit_q2').value = additionalQuestions.q2.ans2;
                        document.getElementById('additional_edit_q3').value = additionalQuestions.q3.ans3;
                        document.getElementById('additional_edit_q4').value = additionalQuestions.q4.ans4;
                        document.getElementById('additional_edit_q5').value = additionalQuestions.q5.ans5;
                        if (additionalQuestions.q5.ans5 === 'yes') {
                            document.getElementById('additional_edit_explanation').value = additionalQuestions.explanation;
                            $('#additional_edit_explanation_div').show();
                        }
                        else {
                            $('#additional_edit_explanation_div').hide();
                        } 
                    }
                    else {
                        // no additional info data found
                        $('#additional-info').html(`
                            <div class="d-flex align-items-center mb-4 justify-content-between">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-info-circle fs-2 text-primary me-3 mt-1"></i>
                                    <h5 class="mb-0">Additional Information</h5>
                                </div>
                            </div>
                            <div class="card border-0 bg-light rounded-3">
                                <div class="card-body">
                                    <div class="text-center py-4">
                                        <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                        <p class="text-muted
                                        mb-0">No Additional Information data found</p>
                                    </div>
                                </div>
                            </div>
                        `);
                    }

                    // Student Application
                    if (student_application_data) {
                        // Parse questions JSON
                        let studentApplicationQuestions = JSON.parse(student_application_data.questions);
                        // Update student application section
                        $('#ch1').prop('checked', studentApplicationQuestions.q1.ans);
                        $('#ch2').prop('checked', studentApplicationQuestions.q2.ans);
                        $('#ch3').prop('checked', studentApplicationQuestions.q3.ans); 
                        $('#ch4').prop('checked', studentApplicationQuestions.q4.ans);
                        $('#ch5').prop('checked', studentApplicationQuestions.q5.ans);
                        $('#ch6').prop('checked', studentApplicationQuestions.q6.ans);

                        // Make unchecked checkboxes readonly
                        $('#ch1').not(':checked').prop('disabled', true);
                        $('#ch2').not(':checked').prop('disabled', true);
                        $('#ch3').not(':checked').prop('disabled', true);
                        $('#ch4').not(':checked').prop('disabled', true); 
                        $('#ch5').not(':checked').prop('disabled', true);
                        $('#ch6').not(':checked').prop('disabled', true);

                        if (studentApplicationQuestions.q6.ans) {
                            $('#application_description_text_div').hide();
                        }
                        else {
                            $('#application_description_text').html(studentApplicationQuestions.description);
                        }

                        // set value in modal
                        document.getElementById('application_q1').value = studentApplicationQuestions.q1.ans ? 'yes' : 'no';
                        document.getElementById('application_q2').value = studentApplicationQuestions.q2.ans ? 'yes' : 'no';
                        document.getElementById('application_q3').value = studentApplicationQuestions.q3.ans ? 'yes' : 'no';
                        document.getElementById('application_q4').value = studentApplicationQuestions.q4.ans ? 'yes' : 'no';
                        document.getElementById('application_q5').value = studentApplicationQuestions.q5.ans ? 'yes' : 'no';
                        document.getElementById('application_q6').value = studentApplicationQuestions.q6.ans ? 'yes' : 'no';
                        if (studentApplicationQuestions.q6.ans) {
                            $('#edit_application_description_text_div').hide();
                        }
                        document.getElementById('application_description').value = studentApplicationQuestions.description;
                    }
                    else {
                        // no student application data found
                        $('#student-application').html(`
                            <div class="d-flex align-items-center mb-4 justify-content-between">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-info-circle fs-2 text-primary me-3 mt-1"></i>
                                    <h5 class="mb-0">Student Application</h5>
                                </div>
                            </div>
                            <div class="card border-0 bg-light rounded-3">
                                <div class="card-body">
                                    <div class="text-center py-4">
                                        <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                        <p class="text-muted
                                        mb-0">No Student Application data found</p>
                                    </div>
                                </div>
                            </div>
                        `);
                    }

                    // address
                    if (parent_address_data) {

                        // Update parent address section
                        $('#street_address').html(parent_address_data.address);
                        $('#city').html(parent_address_data.city);
                        $('#parent-address #parent_state').html(parent_address_data.state === '-1' ? '-' : (getFullStateName(parent_address_data.state) || parent_address_data.state));
                        $('#zip').html(parent_address_data.zip);
                        $('#parent-address #addressCounty').html(parent_address_data.county);
                        $('#emg_contact_phone').html(formatPhoneNumber(parent_address_data.country_code, parent_address_data.emg_contact_phone));
                        $('#emg_contact_name').html(parent_address_data.emg_contact_name);

                        // set value in modal
                        document.getElementById('edit_street_address').value = parent_address_data.address;
                        document.getElementById('edit_city').value = parent_address_data.city;
                        // Set state value
                        $('.edit_parent_address #state').val(parent_address_data.state)
                        $(".edit_parent_address #state").change(()=>{ drop_down_list('edit_parent_address') });
                        $('.edit_parent_address #state').trigger('change');
                        // Set county value
                        $('#address-form #county').val(parent_address_data.county);  
                        document.getElementById('edit_zip').value = parent_address_data.zip;
                        document.getElementById('edit_emg_country_code').value = parent_address_data.country_code;
                        document.getElementById('edit_emg_contact_phone').value = showPhonenumber(parent_address_data.country_code, parent_address_data.emg_contact_phone);
                        document.getElementById('edit_emg_contact_name').value = parent_address_data.emg_contact_name;
                    }
                    else {
                        // no parent address data found
                        $('#parent-address').html(`
                            <div class="d-flex align-items-center mb-4 justify-content-between">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-info-circle fs-2 text-primary me-3 mt-1"></i>
                                    <h5 class="mb-0">Parent Address</h5>
                                </div>
                            </div>
                            <div class="card border-0 bg-light rounded-3">
                                <div class="card-body">
                                    <div class="text-center py-4">
                                        <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                        <p class="text-muted
                                        mb-0">No Parent Address data found</p>
                                    </div>
                                </div>
                            </div>
                        `);
                    }

                    // Student Information
                    if(student_data && student_data.length > 0) {
                        // Clear existing accordion content
                        $('#studentAccordion').empty();
                        
                        // Iterate through each student and create accordions
                        student_data.forEach((student, index) => {
                            // Parse student questions
                            let studentQuestions = {};
                            try {
                                studentQuestions = JSON.parse(student.questions);
                            } catch (e) {
                                console.error("Error parsing student questions:", e);
                            }

                            // Format student name
                            const fullName = `${student.first_name || ''} ${student.middle_name || ''} ${student.last_name || ''}`.trim();
                            
                            // Create accordion item
                            // Create a click handler to populate the edit form with student data
                            const setupStudentEditModal = () => {
                                // Add event listener to edit student buttons
                                $('#studentAccordion').on('click', '.edit-student-btn', function() {
                                    const studentId = $(this).data('student-id');
                                    const student = student_data.find(s => s.id == studentId);
                                    
                                    if (!student) return;
                                    
                                    // Parse student questions
                                    let studentQuestions = {};
                                    try {
                                        studentQuestions = JSON.parse(student.questions);
                                    } catch (e) {
                                        console.error("Error parsing student questions:", e);
                                    }
                                    
                                    // Populate form fields
                                    $('#edit_student_id').val(student.id);
                                    $('#edit_student_f_name').val(student.first_name || '');
                                    $('#edit_student_m_name').val(student.middle_name || '');
                                    $('#edit_student_l_name').val(student.last_name || '');
                                    
                                    // Set date in YYYY-MM-DD format for date input
                                    if (student.dob) {
                                        const date = new Date(student.dob);
                                        const formattedDate = date.toISOString().split('T')[0];
                                        $('#edit_dob').val(formattedDate);
                                    }
                                    
                                    $('.editStudentForm #state').val(student.state);
                                    $(".editStudentForm #state").change(()=>{ drop_down_list('editStudentForm') });
                                    $('.editStudentForm #state').trigger('change');
                                    
                                    $('.editStudentForm #county').val(student.county);
                                    // console.log(student.county);
                                    
                                    $('#edit_age').val(student.age || '');
                                    $('#edit_student_grade').val(student.grade || '');
                                    $('#edit_gender').val(student.gender || '-1');
                                    
                                    // Set questions
                                    if (studentQuestions.q1) {
                                        $('#edit_parental_agreement').val(studentQuestions.q1.ans1 || '-1').trigger('change');
                                        if(studentQuestions.q1.ans1 === 'not applicable') {
                                            $('#edit_please_describe').val(studentQuestions.please_describe || '');
                                        }
                                    }
                                    
                                    if (studentQuestions.q2) {
                                        $('#edit_truancy').val(studentQuestions.q2.ans2 || '-1').trigger('change');
                                    }
                                    
                                    if (studentQuestions.q3) {
                                        $('#edit_transfer_student').val(studentQuestions.q3.ans3 || '-1').trigger('change');
                                    }
                                    
                                    // Profile image
                                    if (student.student_profile_pic) {
                                        $('#edit-preview-profile-img').attr('src', student.student_profile_pic);
                                    } else {
                                        $('#edit-preview-profile-img').attr('src', plugin_dir_url(dirname(__FILE__)) + 'img/new_profile_default.jpg');
                                    }

                                    // Immunization file name
                                    if (student.immunization_file_name) {
                                        $('#edit_immunization_file_name').text(student.immunization_file_name);
                                        $('#edit_immunization_file_name').append(' <i class="far fa-times-circle p-2 delete_file text-danger" style="cursor: pointer;"></i>');
                                    } else {
                                        $('#edit_immunization_file_name').text('');
                                    }
                                    
                                    // Immunization file URL
                                    if (student.immunization_file_url) {
                                        $('#edit_immunization_file_url').val(student.immunization_file_url);
                                    } else {
                                        $('#edit_immunization_file_url').val('');
                                    }
                                });
                            };
                            
                            const accordionItem = `
                                <div class="accordion-item border-0 mb-3">
                                    <h2 class="accordion-header" id="studentHeading${student.id}">
                                        <button class="accordion-button collapsed rounded-3 shadow-sm" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#studentCollapse${student.id}" 
                                                aria-expanded="false" 
                                                aria-controls="studentCollapse${student.id}" 
                                                style="background-color: #456fb6;">
                                            <div class="d-flex align-items-center text-white">
                                                <div class="me-3">
                                                    <img src="${student.student_profile_pic || plugin_dir_url(dirname(__FILE__)) + 'img/new_profile_default.png'}" 
                                                         alt="${fullName}" class="rounded-circle border border-2 border-white" 
                                                         style="width: 40px; height: 40px; object-fit: cover;">
                                                </div>
                                                <div>
                                                    <span class="fw-medium">${fullName}</span>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="studentCollapse${student.id}" 
                                         class="accordion-collapse collapse" 
                                         aria-labelledby="studentHeading${student.id}">
                                        <div class="accordion-body bg-light rounded-bottom">
                                            <div class="col-md-12 text-end mb-2">
                                                <button class="btn btn-primary rounded-pill px-4 py-2 edit-student-btn" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editStudentModal"
                                                        data-student-id="${student.id}">
                                                    <i class="fas fa-edit me-2"></i>Edit Student
                                                </button>
                                            </div>
                                            <form id="student-form-${student.id}">
                                                <input type="hidden" id="student_id_${student.id}" value="${student.id}">
                                                <div class="row g-4">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label text-secondary fw-medium">First Name</label>
                                                            <input type="text" id="student_f_name_${student.id}" class="form-control border-0 shadow-sm rounded-3" value="${student.first_name || ''}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label text-secondary fw-medium">Middle Name</label>
                                                            <input type="text" id="student_m_name_${student.id}" class="form-control border-0 shadow-sm rounded-3" value="${student.middle_name || ''}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label text-secondary fw-medium">Last Name</label>
                                                            <input type="text" id="student_l_name_${student.id}" class="form-control border-0 shadow-sm rounded-3" value="${student.last_name || ''}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label text-secondary fw-medium">Date of Birth</label>
                                                            <input type="text" id="dob_${student.id}" class="form-control border-0 shadow-sm rounded-3" value="${student.dob ? new Date(student.dob).toLocaleDateString('en-US', {month: '2-digit', day: '2-digit', year: 'numeric'}) : ''}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label text-secondary fw-medium">State Student Resides In</label>
                                                            <input type="text" id="student_state_${student.id}" class="form-control border-0 shadow-sm rounded-3" value="${getFullStateName(student.state) || ''}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label text-secondary fw-medium">County</label>
                                                            <input type="text" id="student_county_${student.id}" class="form-control border-0 shadow-sm rounded-3" value="${student.county || ''}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label text-secondary fw-medium">Age</label>
                                                            <input type="number" id="age_${student.id}" class="form-control border-0 shadow-sm rounded-3" value="${student.age || ''}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label text-secondary fw-medium">Grade</label>
                                                            <input type="text" id="grade_${student.id}" class="form-control border-0 shadow-sm rounded-3" value="${student.grade || ''}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label text-secondary fw-medium">Gender</label>
                                                            <input type="text" id="gender_${student.id}" class="form-control border-0 shadow-sm rounded-3" value="${student.gender ? student.gender.charAt(0).toUpperCase() + student.gender.slice(1) : ''}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label text-secondary fw-medium">
                                                                Co-op Name
                                                            </label>
                                                            <input type="text" id="coop_name_${student.id}" class="form-control border-0 shadow-sm rounded-3" value="${student.coop_name || ''}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="flex-grow-1">
                                                                <label class="form-label text-secondary fw-medium mb-0">Are both parents (when applicable) in agreement to
                                                                homeschooling this student and registering them with Graduates Academy?</label>
                                                            </div>
                                                            <input type="text" class="form-control border-0 shadow-sm rounded-3 w-auto ms-3 text-center" 
                                                                id="parents_agreement_${student.id}" 
                                                                value="${studentQuestions.q1 ? (studentQuestions.q1.ans1.charAt(0).toUpperCase() + studentQuestions.q1.ans1.slice(1)) : ''}" readonly>
                                                        </div>
                                                    </div>
                                                    ${studentQuestions.q1 && studentQuestions.q1.ans1 === 'not applicable' ? `
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label text-secondary fw-medium">Please describe why this is not applicable:</label>
                                                            <textarea class="form-control border-0 shadow-sm rounded-3" readonly>${studentQuestions.please_describe || ''}</textarea>
                                                        </div>
                                                    </div>
                                                    ` : ''}

                                                    <div class="col-12">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="flex-grow-1">
                                                                <label class="form-label text-secondary fw-medium mb-0">Truancy/Expulsion - Does this Student have prior truancy, expulsion, suspension, or misdemeanor issues?</label>
                                                            </div>
                                                            <input type="text" class="form-control border-0 shadow-sm rounded-3 w-auto ms-3 text-center" 
                                                                id="prior_issues_${student.id}" 
                                                                value="${studentQuestions.q2 ? (studentQuestions.q2.ans2.charAt(0).toUpperCase() + studentQuestions.q2.ans2.slice(1)) : ''}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="flex-grow-1">
                                                                <label class="form-label text-secondary fw-medium mb-0">Is this Student transferring from another school or umbrella program?</label>
                                                            </div>
                                                            <input type="text" class="form-control border-0 shadow-sm rounded-3 w-auto ms-3 text-center" 
                                                                id="transferring_student_${student.id}" 
                                                                value="${studentQuestions.q3 ? (studentQuestions.q3.ans3.charAt(0).toUpperCase() + studentQuestions.q3.ans3.slice(1)) : ''}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="col-md-6 mt-3">
                                                ${student.immunization_file_url ? 
                                                    `<button class="btn btn-primary rounded-pill px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#viewImmunizationModal" id="viewImmunizationBtn_${student.id}"
                                                        data-student-id="${student.id}"
                                                        data-immunization-file-url="${student.immunization_file_url}"
                                                        data-immunization-file-name="${student.immunization_file_name}"
                                                        onclick="viewImmunizationFile(this)"
                                                        >
                                                            <i class="fa-solid fa-syringe me-2"></i>View Immunization
                                                    </button>` : 
                                                    `<button type="button" class="btn btn-secondary rounded-pill px-4 py-2 shadow-sm" disabled>
                                                        <i class="fa-solid fa-syringe me-2"></i>No Immunization File
                                                    </button>`
                                                }
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            
                            // Initialize the edit modal functionality after all accordions are created
                            if (index === student_data.length - 1) {
                                setTimeout(setupStudentEditModal, 100);
                            }
                            
                            // Append the accordion item to the container
                            $('#studentAccordion').append(accordionItem);
                        });
                    }
                    else {
                        // No student data found
                        $('#nav-student-info').html(`
                            <div class="d-flex align-items-center mb-4 justify-content-between">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-user-graduate fs-2 text-primary me-3 mt-1"></i>
                                    <h5 class="mb-0">Student Information</h5>
                                </div>
                            </div>
                            <div class="card border-0 bg-light rounded-3">
                                <div class="card-body">
                                    <div class="text-center py-4">
                                        <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                        <p class="text-muted mb-0">No student data found</p>
                                    </div>
                                </div>
                            </div>
                        `);
                    }
                }
            }
            else {
                $('#parent1-details').html(`
                    <div class="d-flex align-items-center mb-4 justify-content-between">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-user-circle fs-2 text-primary me-3 mt-1"></i>
                            <h5 class="mb-0">Parent #1 Information</h5>
                        </div>
                    </div>
                    <div class="card border-0 bg-light rounded-3">
                        <div class="card-body">
                            <div class="text-center py-4">
                                <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                <p class="text-muted mb-0">No Parent #1 data found</p>
                            </div>
                        </div>
                    </div>
                `);
                $('#parent2-details').html(`
                    <div class="d-flex align-items-center mb-4 justify-content-between">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-user-circle fs-2 text-primary me-3 mt-1"></i>
                            <h5 class="mb-0">Parent #2 Information</h5>
                        </div>
                    </div>
                    <div class="card border-0 bg-light rounded-3">
                        <div class="card-body">
                            <div class="text-center py-4">
                                <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                <p class="text-muted
                                mb-0">No Parent #2 data found</p>
                            </div>
                        </div>
                    </div>
                `);
                $('#additional-info').html(`
                    <div class="d-flex align-items-center mb-4 justify-content-between">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-info-circle fs-2 text-primary me-3 mt-1"></i>
                            <h5 class="mb-0">Additional Information</h5>
                        </div>
                    </div>
                    <div class="card border-0 bg-light rounded-3">
                        <div class="card-body">
                            <div class="text-center py-4">
                                <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                <p class="text-muted
                                mb-0">No Additional Information data found</p>
                            </div>
                        </div>
                    </div>
                `);
                $('#student-application').html(`
                    <div class="d-flex align-items-center mb-4 justify-content-between">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-info-circle fs-2 text-primary me-3 mt-1"></i>
                            <h5 class="mb-0">Student Application</h5>
                        </div>
                    </div>
                    <div class="card border-0 bg-light rounded-3">
                        <div class="card-body">
                            <div class="text-center py-4">
                                <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                <p class="text-muted mb-0">No Student Application data found</p>
                            </div>
                        </div>
                    </div>
                `);
                $('#parent-address').html(`
                    <div class="d-flex align-items-center mb-4 justify-content-between">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-info-circle fs-2 text-primary me-3 mt-1"></i>
                            <h5 class="mb-0">Parent Address</h5>
                        </div>
                    </div>
                    <div class="card border-0 bg-light rounded-3">
                        <div class="card-body">
                            <div class="text-center py-4">
                                <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                <p class="text-muted mb-0">No Parent Address data found</p>
                            </div>
                        </div>
                    </div>
                `);
                // No student data found
                $('#nav-student-info').html(`
                    <div class="d-flex align-items-center mb-4 justify-content-between">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-user-graduate fs-2 text-primary me-3 mt-1"></i>
                            <h5 class="mb-0">Student Information</h5>
                        </div>
                    </div>
                    <div class="card border-0 bg-light rounded-3">
                        <div class="card-body">
                            <div class="text-center py-4">
                                <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                <p class="text-muted mb-0">No student data found</p>
                            </div>
                        </div>
                    </div>
                `);
                $('#digital-signature').html(`
                    <div class="d-flex align-items-center mb-4 justify-content-between">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-info-circle fs-2 text-primary me-3 mt-1"></i>
                            <h5 class="mb-0">Digital Signature</h5>
                        </div>
                    </div>
                    <div class="card border-0 bg-light rounded-3">
                        <div class="card-body">
                            <div class="text-center py-4">
                                <i class="fas fa-info-circle text-muted fs-2 mb-3"></i>
                                <p class="text-muted
                                mb-0">No Digital Signature data found</p>
                            </div>
                        </div>
                    </div>
                `);
            }
        }
    });


    // handle the parent_1_submit modal
    $('#parent_1_submit').on('click', function (e) {
        e.preventDefault();

        let role  = $('#p1_edit_role').val();
        let first_name = $('#p1_edit_f_name').val();
        let middle_name = $('#p1_edit_m_name').val();
        let last_name = $('#p1_edit_l_name').val();
        let country_code = $('#p1_edit_country_code').val();
        let contact = $('#p1_edit_contact').val();
        let email = $('#p1_edit_email').val();
        let school_year = $('#p1_edit_school_year').val();
        let heard_about_us = $('#p1_edit_heard_about_us').val();
        let ans1  = $('#p1_edit_legal_custody').val();
        let ans2  = $('#p1_edit_msg_authorization').val();
        let ans3  = $('#p1_edit_high_school_diploma').val();
        let ans4  = $('#p1_edit_education_level').val();
        let ans5  = $('#p1_edit_lives_with_student').val();
        let ans6  = $('#p1_edit_us_citizen').val();

        contact = NumberremoveFormat(contact);
        // console.log(contact);
        if (role === '' || first_name === '' || last_name === '' || country_code === '' || contact === '' || email === '' || school_year === '' || heard_about_us === '') {
            swal('Error', 'Please fill in all the required fields.', 'error');
            return;
        } else if (ans1 === '-1' || ans2 === '-1' || ans3 === '-1' || ans4 === '-1' || ans5 === '-1' || ans6 === '-1') {
            swal('Error', 'Please answer all questions.', 'error');
            return;
        } else if (ans1 == 'no') {
            swal("", "Parent/Guardian #1 Must have legal custody", "error");
            return;
        } else if (ans5 == 'no') {
            swal("", "Parent who is legal guardian must live in the same home as student!", "error");
            return;
        } else if (!isValidEmail(email)) {
            swal("", "Please enter a valid email address", "error");
            return;
        } else if (!isValidPhoneNumber(contact)) {
            swal("", "Please enter a valid phone number", "error");
            return;
        } else if (ans3 == 'no' && $('#p2_edit_high_school_diploma').val() == 'no') {
            swal("", "Any parent/guardian must have a high school diploma or GED", "error");
            return;
        }

        // Store the questions
        const questions = {
            questions: {
            q1: {
            q: 'Do You Have Legal Custody of the Child?',
            ans1: $('#p1_edit_legal_custody').val(),
            },
            q2: {
            q: 'Do You Authorize SMS/Text Messages for Important Notifications?',
            ans2: $('#p1_edit_msg_authorization').val(),
            },
            q3: {
            q: 'Does this Parent/Guardian Have a High School Diploma or GED?',
            ans3: $('#p1_edit_high_school_diploma').val(),
            },
            q4: {
            q: 'Highest Level of Education?',
            ans4: $('#p1_edit_education_level').val(),
            },
            q5: {
            q: 'Does this Parent/Guardian Live in the Same Home as the Student?',
            ans5: $('#p1_edit_lives_with_student').val(),
            },
            q6: {
            q: 'Are you a United States Citizen?',
            ans6: $('#p1_edit_us_citizen').val(),
            }
            },
        };
        
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'type': 'parent_1',
                'action': 'ajax_handle_update_parent_data_by_admin',
                'registration_id': rid,
                'role': role,
                'first_name': first_name,
                'middle_name': middle_name,
                'last_name': last_name,
                'country_code': country_code,
                'contact': contact,
                'email': email,
                'school_year': school_year,
                'heard_about_us': heard_about_us,
                'questions': JSON.stringify(questions)  
            },
            success: function(response) {
                if(response.success){
                    swal({
                        title: 'Success!',
                        text: 'Parent #1 details updated successfully!',
                        icon: 'success',
                        button: 'Close'
                    });
                    const modal = document.getElementById('edit-parent1');
                    bootstrap.Modal.getInstance(modal).hide();
                    location.reload();
                } else {
                    swal('Error', response.data.message, 'error');
                }
            },
            error: function() {
                swal('Error', 'An unexpected error occurred.', 'error');
            }
        });
    });

    // handle the parent_2_submit modal
    $('#parent_2_submit').on('click', function (e) {
        e.preventDefault();

        let role  = $('#p2_edit_role').val();
        let first_name = $('#p2_edit_f_name').val();
        let middle_name = $('#p2_edit_m_name').val();
        let last_name = $('#p2_edit_l_name').val();
        let country_code = $('#p2_edit_country_code').val();
        let contact = $('#p2_edit_contact').val();
        let email = $('#p2_edit_email').val();
        let school_year = $('#p2_edit_school_year').val();
        let ans1  = $('#p2_edit_msg_authorization').val();
        let ans2  = $('#p2_edit_high_school_diploma').val();
        let ans3  = $('#p2_edit_education_level').val();
        let ans4  = $('#p2_edit_lives_with_student').val();
        let ans5  = $('#p2_edit_us_citizen').val();

        contact = NumberremoveFormat(contact);
        // console.log(contact);

        if (role === '' || first_name === '' || last_name === '' || country_code === '' || contact === '' || email === '' || school_year === '') {
            swal('Error', 'Please fill in all the required fields.', 'error');
            return;
        } else if (ans1 === '-1' || ans2 === '-1' || ans3 === '-1' || ans4 === '-1' || ans5 === '-1') {
            swal('Error', 'Please answer all questions.', 'error');
            return;
        } else if (ans4 == 'no') {
            swal("", "Parent who is legal guardian must live in the same home as student!", "error");
            return;
        } else if (ans2 == 'no' && $('#p1_edit_high_school_diploma').val() == 'no') {
            swal("", "Any parent/guardian must have a high school diploma or GED", "error");
            return;
        } else if (!isValidEmail(email)) {
            swal("", "Please enter a valid email address", "error");
            return;
        } else if (!isValidPhoneNumber(contact)) {
            swal("", "Please enter a valid phone number", "error");
            return;
        }

        // Store the questions
        const questions = {
            questions: {
            q1: {
            q: 'Do You Authorize SMS/Text Messages for Important Notifications?',
            ans1: $('#p2_edit_msg_authorization').val(),
            },
            q2: {
            q: 'Does this Parent/Guardian Have a High School Diploma or GED?',
            ans2: $('#p2_edit_high_school_diploma').val(),
            },
            q3: {
            q: 'Highest Level of Education?',
            ans3: $('#p2_edit_education_level').val(),
            },
            q4: {
            q: 'Does this Parent/Guardian Live in the Same Home as the Student?',
            ans4: $('#p2_edit_lives_with_student').val(),
            },
            q5: {
            q: 'Are you a United States Citizen?',
            ans5: $('#p2_edit_us_citizen').val(),
            }
            },
        };
        
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'type': 'parent_2',
                'action': 'ajax_handle_update_parent_data_by_admin',
                'registration_id': rid,
                'role': role,
                'first_name': first_name,
                'middle_name': middle_name,
                'last_name': last_name,
                'country_code': country_code,
                'contact': contact,
                'email': email,
                'school_year': school_year,
                'questions': JSON.stringify(questions)
            
            },
            success: function(response) {
                if(response.success){
                    swal({
                        title: 'Success!',
                        text: 'Parent #2 details updated successfully!',
                        icon: 'success',
                        button: 'Close'
                    });
                    const modal = document.getElementById('edit-parent2');
                    bootstrap.Modal.getInstance(modal).hide();
                    location.reload();
                } else {
                    swal('Error', response.data.message, 'error');
                }
            },
            error: function() {
                swal('Error', 'An unexpected error occurred.', 'error');
            }
        });
    });

    // handle the additional_submit modal
    $('#additional_submit').on('click', function (e) {
        e.preventDefault();

        let ans1  = $('#additional_edit_q1').val();
        let ans2  = $('#additional_edit_q2').val();
        let ans3  = $('#additional_edit_q3').val();
        let ans4  = $('#additional_edit_q4').val();
        let ans5  = $('#additional_edit_q5').val();
        let explanation  = $('#additional_edit_explanation').val();

        if (ans1 == '-1' || ans2 == '-1' || ans3 == '-1' || ans4 == '-1' || ans5 == '-1') {
            swal("", "Please Select your Answer!", "error");
            return;
        } else if (ans1 == 'yes' || ans2 == 'yes' || ans3 == 'yes' || ans4 == 'yes') {
            swal("", "We are Unable to Accept This Application at This Time", "error");
            return;
        } else if (ans5 == 'yes' && explanation == '') { 
            swal("", "Please provide an explanation.", "error");
            return;
        }

        // Store the questions
        const questions = {
            questions: {
            q1: {
            q: 'Actively on Probation?',
            ans1: $('#additional_edit_q1').val(),
            },
            q2: {
            q: 'Currently Being Investigated for Abuse or Neglect (Physical or Educational)?',
            ans2: $('#additional_edit_q2').val(),
            },
            q3: {
            q: 'Currently Being Investigated And/Or Charged With a Misdemeanor of Felony?',
            ans3: $('#additional_edit_q3').val(),
            },
            q4: {
            q: 'Currently Involved in an Open Criminal Court Case that Could Lead to a Misdemeanor of Felony?',
            ans4: $('#additional_edit_q4').val(),
            },
            q5: {
            q: 'Does the Student Have a History of Truancy or Expulsion issues?',
            ans5: $('#additional_edit_q5').val(),
            },
            explanation: $('#additional_edit_explanation').val(),
            },
        };
        
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'type': 'additional',
                'action': 'ajax_handle_update_additional_data_by_admin',
                'registration_id': rid,
                'additional_info': JSON.stringify(questions)
            
            },
            success: function(response) {
                if(response.success){
                    swal({
                        title: 'Success!',
                        text: 'Additional information updated successfully!',
                        icon: 'success',
                        button: 'Close'
                    });
                    const modal = document.getElementById('additionalModal');
                    bootstrap.Modal.getInstance(modal).hide();
                    location.reload();
                } else {
                    swal('Error', response.data.message, 'error');
                }
            },
            error: function() {
                swal('Error', 'An unexpected error occurred.', 'error');
            }
        });
    });

    // handle the application_submit modal
    $('#application_submit').on('click', function (e) {
        e.preventDefault();

        let ans1  = $('#application_q1').val();
        let ans2  = $('#application_q2').val();
        let ans3  = $('#application_q3').val();
        let ans4  = $('#application_q4').val();
        let ans5  = $('#application_q5').val();
        let ans6  = $('#application_q6').val();
        let description  = $('#application_description').val();

        if ((ans1 == 'yes' || ans2 == 'yes' || ans3 == 'yes' || ans4 == 'yes' || ans5 == 'yes') && description == '') {
            swal("", "Please provide a description for your application.", "error");
            return;
        } else if (ans1 == 'no' && ans2 == 'no' && ans3 == 'no' && ans4 == 'no' && ans5 == 'no' && ans6 == 'no') {
            swal("", "Please Select your Answer!", "error");
            return;
        }

        // Store the questions
        const questions = {
            q1: {
            q: 'Currently involved in an open custody case of an enrolling student',
            ans: $('#application_q1').val() === 'yes' ? true : false,
            },
            q2: {
            q: 'Currently a foster parent(s) of an enrolling student', 
            ans: $('#application_q2').val() === 'yes' ? true : false,
            },
            q3: {
            q: 'Currently have Power of Attorney for an enrolling student',
            ans: $('#application_q3').val() === 'yes' ? true : false,
            },
            q4: {
            q: 'Currently are in the process of adoption of an enrolling student',
            ans: $('#application_q4').val() === 'yes' ? true : false,
            },
            q5: {
            q: 'Other unique family situation',
            ans: $('#application_q5').val() === 'yes' ? true : false,
            },
            q6: {
            q: 'None of the above',
            ans: $('#application_q6').val() === 'yes' ? true : false,
            },
            description: $('#application_description').val(),
        };
        
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'type': 'application',
                'action': 'ajax_handle_update_student_application_by_admin',
                'registration_id': rid,
                'student_application': JSON.stringify(questions)
            
            },
            success: function(response) {
                if(response.success){
                    swal({
                        title: 'Success!',
                        text: 'Student application updated successfully!',
                        icon: 'success',
                        button: 'Close'
                    });
                    const modal = document.getElementById('applicationModal');
                    bootstrap.Modal.getInstance(modal).hide();
                    // location.reload();
                } else {
                    swal('Error', response.data.message, 'error');
                }
            },
            error: function() {
                swal('Error', 'An unexpected error occurred.', 'error');
            }
        });
    });

    // handle the address_submit modal
    $('#address_submit').on('click', function (e) {
        e.preventDefault();

        let address  = $('#edit_street_address').val();
        let city = $('#edit_city').val();
        let state = $('.edit_parent_address #state').val();
        let zip = $('#edit_zip').val();
        let county = $('.edit_parent_address #county').val() || '';
        let country_code = $('#edit_emg_country_code').val();
        let emg_contact_phone = $('#edit_emg_contact_phone').val();
        let emg_contact_name = $('#edit_emg_contact_name').val();

        emg_contact_phone = NumberremoveFormat(emg_contact_phone);
        // console.log(emg_contact_phone);
        // console.log("county", county);

        if (address === '' || city === '' || state === '-1' || zip === '' || county === '' || county === "-1" || country_code === '' || emg_contact_phone === '' || emg_contact_name === '') {
            swal('Error', 'Please fill in all required fields.', 'error');
            return;
        } else if (!isValidPhoneNumber(emg_contact_phone)) {
            swal("", "Please enter a valid phone number", "error");
            return;
        }
        
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'type': 'address',
                'action': 'ajax_handle_update_parent_address_by_admin',
                'registration_id': rid,
                'address': address,
                'city': city,
                'state': state,
                'zip': zip,
                'county': county,
                'country_code': country_code,
                'emg_contact_phone': emg_contact_phone,
                'emg_contact_name': emg_contact_name
            },
            success: function(response) {
                if(response.success){
                    swal({
                        title: 'Success!',
                        text: 'Parent address updated successfully!',
                        icon: 'success',
                        button: 'Close'
                    });
                    const modal = document.getElementById('addressModal');
                    bootstrap.Modal.getInstance(modal).hide();
                    location.reload();
                } else {
                    swal('Error', response.data.message, 'error');
                }
            },
            error: function() {
                swal('Error', 'An unexpected error occurred.', 'error');
            }
        });
    });

    // handle the additional_q5 on additional_q5 change
    $('#additional_edit_q5').on('change', function() {
        
        if ($(this).val() === 'yes') {
            // add required attribute
            $('#additional_edit_explanation').attr('required', true);
            $('#additional_edit_explanation_div').show();
        } else {
            // remove required attribute
            $('#additional_edit_explanation').removeAttr('required');
            $('#additional_edit_explanation_div').hide();
        }
    });

    // handle the application_description on application_q6 change
    $('#application_q6').on('change', function() {
        
        if ($(this).val() === 'yes') {
            $('#edit_application_description_text_div').hide();
            $('#application_description').val('');
            $('#application_description').removeAttr('required');
            $('#application_q1, #application_q2, #application_q3, #application_q4, #application_q5').val('no');
        } else {
            $('#application_description').attr('required', true);
            $('#edit_application_description_text_div').show();
        }
    });

    // onchange function for application questions
    $('#application_q1, #application_q2, #application_q3, #application_q4, #application_q5').on('change', function() {
        $('#application_q6').val('no');
        $('#edit_application_description_text_div').show();
        $('#application_description').attr('required', true);
    });

    //automatically calculate age from dob
    $('#dob').on('change', function() {
        var dob = $(this).val();
        if (dob) {
            var birthDate = new Date(dob);
            var today = new Date();
            var age = today.getFullYear() - birthDate.getFullYear();
            var monthDifference = today.getMonth() - birthDate.getMonth();
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            $('#age').val(age);
        } else {
            $('#age').val('');
        }
    });

    // Show please_describe field
    $('#editStudentForm #edit_parental_agreement').on('change', function() {
        let ansValue = $(this).val();
        if(ansValue === 'no') {
            swal("", "We cannot accept the application at this time.", "info").then(() => {
                $(this).val('-1').trigger('change');
                $('#editStudentForm .edit_please_describe').addClass('hide');
                $('#editStudentForm #edit_please_describe').val('');
            });
        } else if(ansValue === 'not applicable') {
            $('#editStudentForm .edit_please_describe').removeClass('hide');
        } else {
            $('#editStudentForm .edit_please_describe').addClass('hide');
            $('#editStudentForm #edit_please_describe').val('');
        }
    });

    // Onclick the delete immunization file
    $('body').on('click', ".delete_file", function () {
        $('#edit_immunization_file_name').text('');
        $('#edit_immunization_file_url').val('');
        // Clear the file input value
        $('#edit_immunization_file').val('');
    });
    
    // handel the edit student modal
    $('.edit_student_submit').on('click', function (e) {
        e.preventDefault();
        let student_id = $('#edit_student_id').val();
        let first_name = $('#edit_student_f_name').val();
        let middle_name = $('#edit_student_m_name').val();
        let last_name = $('#edit_student_l_name').val();
        let dob = $('#edit_dob').val();
        let age = $('#edit_age').val();
        let state = $('.editStudentForm #state').val();
        let county = $('.editStudentForm #county').val();
        let grade = $('#edit_student_grade').val();
        let gender = $('#edit_gender').val();
        let ans1 = $('#edit_parental_agreement').val();
        let please_describe = $('#edit_please_describe').val();
        let ans2 = $('#edit_truancy').val();
        let ans3 = $('#edit_transfer_student').val();
        let student_profile_pic = $('#edit-preview-profile-img').attr('src');
        let immunization_file_url = $('#edit_immunization_file_url').val();
        let immunization_file_name = $('#edit_immunization_file_name').text();

        // console.log('student_id', student_id);
        // console.log('first_name', first_name);
        // console.log('middle_name', middle_name);
        // console.log('last_name', last_name);
        // console.log('dob', dob);
        // console.log('age', age);
        // console.log('state', state);
        // console.log('county', county);
        // console.log('grade', grade);
        // console.log('gender', gender);
        // console.log('ans1', ans1);
        // console.log('please_describe', please_describe);
        // console.log('ans2', ans2);
        // console.log('ans3', ans3);
        // console.log('student_profile_pic', student_profile_pic);
        // console.log('immunization_file_url', immunization_file_url);
        // console.log('immunization_file_name', immunization_file_name);
        
        // Check for required fields
        if (first_name === '' || last_name === '' || dob === '' || age === '' || state === '-1' || county === '-1' || grade === '-1') {
            swal("Error", "Please fill in all required fields.", "error");
            return;
        } else if (ans1 === '-1' || ans2 === '-1' || ans3 === '-1') {
            swal("Error", "Please answer all questions.", "error");
            return;
        } else if (ans1 === 'not applicable' && please_describe === '') {
            swal("Error", "Please provide a description.", "error");
            return;
        }   
         

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'update_student_data',
                student_id: student_id,
                first_name: first_name,
                middle_name: middle_name,
                last_name: last_name,
                dob: dob,
                state: state,
                county: county,
                age: age,
                grade: grade,
                gender: gender,
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
            },
            success: function(response) {
                if (response.success) {
                    swal("Success", "Student data saved successfully", "success")
                    .then(() => {
                        const modal = document.getElementById('editStudentModal');
                        const bootstrapModal = bootstrap.Modal.getInstance(modal);
                        bootstrapModal.hide();
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

    // Format phone number
    function NumberremoveFormat(phone) {
        return phone.replace(/[^\d]/g, '');
    }
});

// validate phone number
function validateNumber(phone, id , countryCode) {
    // Get the selected country code
    // let countryCode = $(id).closest('.row').find('.country_code select').val();
    // console.log(countryCode);
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

// Format phone number function
function formatPhoneNumber(country, phone) {
    if (country === '+1') {
        // format US phone number as (XXX) XXX-XXXX
            return `${country} (${phone.slice(0,3)}) ${phone.slice(3,6)}-${phone.slice(6)}`;
    } else if (country === '+1c') {
        country = '+1';
        // format US phone number as (XXX) XXX-XXXX
        return `${country} (${phone.slice(0,3)}) ${phone.slice(3,6)}-${phone.slice(6)}`;
    } else {
        // For non-US numbers, format as XXX-XXX-XXXX
        // return `${country} ${phone.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3')}`;
        return `${country} ${phone}`;
    }   
}

// show Phone number in edit modal
function showPhonenumber(country, phone) {
    if (country === '+1' || country === '+1c') {
        // format US phone number as (XXX) XXX-XXXX
            return `(${phone.slice(0,3)}) ${phone.slice(3,6)}-${phone.slice(6)}`;
    } else {
        // For non-US numbers, format as XXX-XXX-XXXX
        // return phone.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
        return phone;
    }   
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