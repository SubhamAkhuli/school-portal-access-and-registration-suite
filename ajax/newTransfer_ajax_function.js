// Get Transfer Student Data
jQuery(document).ready(function(){
    
    // set country code in phone number
    $("#country_code").html(`
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
    `);
    
    // State name mapping
    const stateNames = {
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
        'WI': 'Wisconsin', 'WY': 'Wyoming'
    };

    // Format phone number function
    function formatPhoneNumber(country, phone) {
        if (country === '+1' || country === '+1c') {
            country = '+1'; // Normalize country code
            // format US phone number as (XXX) XXX-XXXX
                return `${country} (${phone.slice(0,3)}) ${phone.slice(3,6)}-${phone.slice(6)}`;
        } else {
            // For non-US numbers, format as XXX-XXX-XXXX
            // return `${country} ${phone.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3')}`;
            return `${country} ${phone}`;
        }   
    }

    // Capitalize first letter of each word
    function capitalizeWords(str) {
        return str.toLowerCase().replace(/(?:^|\s)\w/g, function(match) {
            return match.toUpperCase();
        });
    }

    // Get all transfer students
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'get_all_school_transfers'
        },
        success: function(data){
            // console.log(data);
            if (data.success && data.data.transfer_students) {
                let tableBody = '';
                data.data.transfer_students.forEach(student => {
                    const transfer = JSON.parse(student.student_transfer);
                    // Convert date to US format (MM/DD/YYYY)
                    const formatDate = (dateStr) => {
                        if (dateStr === '-1' || !dateStr) return '-';
                        const date = new Date(dateStr);
                        return date.toLocaleDateString('en-US', {
                            month: '2-digit',
                            day: '2-digit',
                            year: 'numeric'
                        });
                    };

                    tableBody += `
                        <tr>
                            <td class="text-center text-nowrap">${student.student_name}</td>
                            <td class="text-center text-nowrap">${capitalizeWords(transfer.school_type)}</td>
                            <td class="text-center text-nowrap">${transfer.school_name}</td>
                            <td class="text-center text-nowrap">${transfer.school_email}</td>
                            <td class="text-center text-nowrap">${formatPhoneNumber(transfer.school_number_country_code, transfer.school_number)}</td>
                            <td class="text-center text-nowrap">${transfer.school_address}</td>
                            <td class="text-center text-nowrap">${transfer.school_city}</td>
                            <td class="text-center text-nowrap">${transfer.school_state === '-1' ? '-' : (stateNames[transfer.school_state] || transfer.school_state)}</td>
                            <td class="text-center text-nowrap">${transfer.school_county === '-1' ? '-' : transfer.school_county}</td>
                            <td class="text-center text-nowrap">${transfer.school_zip_code}</td>
                            <td class="text-center text-nowrap">${formatDate(transfer.school_last_date)}</td>
                            <td class="text-nowrap" data-sort="${new Date(student.submitted_at).getTime()}">${new Date(student.submitted_at).toLocaleDateString('en-US', {
                                month: '2-digit',
                                day: '2-digit',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            }).replace(',', ', ')}</td>
                            <td class="text-center">
                                <button class="btn btn-light btn-sm rounded-circle me-2 shadow-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal" 
                                        data-id="${student.id}"
                                        data-student-name="${student.student_name}"
                                        data-transfer='${JSON.stringify(transfer)}'>
                                    <i class="fas fa-edit" style="color: #456fb6;"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
                $('.students-table tbody').html(tableBody);
                
                // Initialize DataTable with enhanced styling and fixed header/footer
                $('.students-table').DataTable({
                    responsive: true,
                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                    pageLength: 10,
                    dom: '<" bg-white"<"d-flex justify-content-between align-items-center mb-3"lf>>' +
                         '<"row"<"col-sm-12 table-responsive "tr>>' +
                         '<"sticky-bottom bg-white"<"row align-items-center"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>>',
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search Students...",
                        lengthMenu: "_MENU_ records per page",
                        info: "Showing _START_ to _END_ of _TOTAL_ transfer students",
                        paginate: {
                            first: '<i class="fas fa-angle-double-left"></i>',
                            last: '<i class="fas fa-angle-double-right"></i>',
                            next: '<i class="fas fa-angle-right"></i>',
                            previous: '<i class="fas fa-angle-left"></i>'
                        }
                    },
                    columnDefs: [
                        { orderable: true, targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] },
                        { orderable: false, targets: [12] },
                        { className: "align-middle text-center", targets: "_all" }
                    ],
                    order: [[11, 'desc']], // Changed to desc for newest first
                    autoWidth: false,
                    drawCallback: function() {
                        $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                        $('.students-table thead th').css({
                            'background-color': '#bc9f5e',
                            'color': 'white'
                        });
                    },
                    stateSave: true,
                    processing: true,
                    scrollCollapse: false,
                    fixedHeader: false,
                    scrollX: false,    
                    initComplete: function() {
                        $('.dataTables_filter input').addClass('form-control');
                        $('.dataTables_length select').addClass('form-select');
                        $('.students-table thead th').css({
                            'background-color': '#bc9f5e',
                            'color': 'white'
                        });
                    }
                });
            }
            else {
                    $('.students-table tbody').append('<tr><td colspan="13" class="text-center">No Transfer Students Found</td></tr>');
            }
        }
    });
});

// Set Edit Modal Data
const editModal = document.getElementById('editModal');
editModal.addEventListener('show.bs.modal', function(event) {
    const button = $(event.relatedTarget);
    // Get data attributes from button
    const studentId = button.attr('data-id');
    const studentName = button.attr('data-student-name');
    const transfer = JSON.parse(button.attr('data-transfer'));

    // Set values in modal
    const modal = $(this);
    modal.find('.modal-body #student_id').val(studentId);
    modal.find('.modal-body #student_name').val(studentName);
    modal.find('.modal-body #school_type').val(transfer.school_type).trigger('change');
    modal.find('.modal-body #school_name').val(transfer.school_name);
    modal.find('.modal-body #school_email').val(transfer.school_email);
    modal.find('.modal-body #country_code').val(transfer.school_number_country_code).trigger('change');
    modal.find('.modal-body #school_number').val(showPhonenumber(transfer.school_number_country_code, transfer.school_number));
    modal.find('.modal-body #school_address').val(transfer.school_address);
    modal.find('.modal-body #school_city').val(transfer.school_city);
    modal.find('.modal-body #state').val(transfer.school_state).trigger('change');
    modal.find('.modal-body #county').val(transfer.school_county).trigger('change');
    modal.find('.modal-body #school_zip_code').val(transfer.school_zip_code);
    modal.find('.modal-body #school_last_date').val(transfer.school_last_date);
    modal.find('.modal-body #emailConfirmation').prop('checked', transfer.school_email_is_double_check === true);
});


// handle Update button click
$('#updateTransfer').click(function(e) {
    e.preventDefault();

    let studentId = $('#student_id').val();
    let studentName = $('#student_name').val();
    let schoolType = $('#school_type').val();
    let schoolName = $('#school_name').val();
    let schoolEmail = $('#school_email').val();
    let schoolNumberCountryCode = $('#country_code').val();
    let schoolNumber = $('#school_number').val();
    let schoolAddress = $('#school_address').val();
    let schoolCity = $('#school_city').val();
    let schoolState = $('#state').val();
    let schoolCounty = $('#county').val();
    let schoolZipCode = $('#school_zip_code').val();
    let schoolLastDate = $('#school_last_date').val();
    let schoolEmailIsDoubleCheck = $('#emailConfirmation').prop('checked');

    schoolNumber = NumberremoveFormat(schoolNumber);

    // console.log(studentId, studentName, schoolType, schoolName, schoolEmail, schoolNumberCountryCode, schoolNumber, schoolAddress, schoolCity, schoolState, schoolCounty, schoolZipCode, schoolLastDate, schoolEmailIsDoubleCheck);

    // Check if any required field is empty
    if (!studentName || !schoolType || !schoolName || !schoolEmail || !schoolNumber || 
        !schoolAddress || !schoolCity || schoolState === '-1'|| schoolCounty === '-1' || !schoolZipCode || !schoolLastDate) {
        swal({
            title: 'Error!',
            text: 'Please fill in all required fields',
            icon: 'error',
            button: 'Close'
        });
        return;
    } else if(!schoolEmailIsDoubleCheck) {
        swal({
            title: 'Error!',
            text: 'Please confirm the email address by checking the checkbox',
            icon: 'error',
            button: 'Close'
        });
        return;
    } else if (!isValidPhoneNumber(schoolNumber)) {
        swal({
            title: 'Error!',
            text: 'Please enter a valid phone number',
            icon: 'error',
            button: 'Close'
        });
        return;
    }


    // Update transfer student
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'update_school_transfer',
            'student_id': studentId,
            'student_name': studentName,
            'student_transfer': JSON.stringify({
                'school_type': schoolType,
                'school_name': schoolName, 
                'school_email': schoolEmail,
                'school_number_country_code': schoolNumberCountryCode,
                'school_number': schoolNumber,
                'school_address': schoolAddress,
                'school_city': schoolCity,
                'school_state': schoolState,
                'school_county': schoolCounty,
                'school_zip_code': schoolZipCode,
                'school_last_date': schoolLastDate,
                'school_email_is_double_check': schoolEmailIsDoubleCheck
            })
        },
        success: function(data){
            // console.log(data);
            if (data.success) {
                // Reload page to update table
                swal({
                    title: 'Success!',
                    text: 'Student Transfer Data Updated Successfully',
                    icon: 'success',
                    button: 'Close'
                });
                location.reload();
            }
        }
    });
});

// validate phone number
function validateNumber(phone, id) {
    // Get the selected country code
    let countryCode = $(id).closest('.row').find('#country_code').val();
    
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

// show Phone number in edit modal
function showPhonenumber(country, phone) {
    if (country === '+1' || country === '+1c') {
        country = '+1'; // Normalize country code
        // format US phone number as (XXX) XXX-XXXX
            return `(${phone.slice(0,3)}) ${phone.slice(3,6)}-${phone.slice(6)}`;
    } else {
        // For non-US numbers, format as XXX-XXX-XXXX
        // return phone.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
        return phone;
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

// Format phone number
function NumberremoveFormat(phone) {
    return phone.replace(/[^\d]/g, '');
}