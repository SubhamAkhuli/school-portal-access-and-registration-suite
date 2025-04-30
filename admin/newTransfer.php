<div class="container">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
                <table class="table table-responsive table-hover table-striped students-table border w-100">
                    <thead class="text-white">
                        <tr>
                            <th class="text-center py-3" style="width: 150px; white-space: nowrap;">Student Name</th>
                            <th class="text-center py-3" style="width: 150px; white-space: nowrap;">School Type</th>
                            <th class="text-center py-3" style="width: 150px; white-space: nowrap;">School Name</th>
                            <th class="text-center py-3" style="width: 150px; white-space: nowrap;">School Email</th>
                            <th class="text-center py-3" style="width: 150px; white-space: nowrap;">School Phone</th>
                            <th class="text-center py-3" style="width: 150px; white-space: nowrap;">School Address</th>
                            <th class="text-center py-3" style="width: 150px; white-space: nowrap;">School City</th>
                            <th class="text-center py-3" style="width: 150px; white-space: nowrap;">School State</th>
                            <th class="text-center py-3" style="width: 150px; white-space: nowrap;">School County</th>
                            <th class="text-center py-3" style="width: 150px; white-space: nowrap;">School Zip Code</th>
                            <th class="text-center py-3" style="width: 150px; white-space: nowrap;">Last Date of Study</th>
                            <th class="text-center py-3" style="width: 150px; white-space: nowrap;">Submit Date</th>
                            <th class="text-center py-3" style="width: 150px; white-space: nowrap;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header" style="background-color: #456fb6; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-edit fs-4 text-white me-2"></i>
                        <h5 class="modal-title text-white mb-0" id="editModalLabel">Edit Transfer Request</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light edit_student_transfer">
                    <form id="transfer-form">
                        <input type="hidden" id="student_id">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium"><i class="fas fa-user me-2"></i>Student Name</label>
                                    <input type="text" id="student_name" class="form-control border-0 shadow-sm rounded-3" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium"><i class="fas fa-school me-2"></i>Type of School</label>
                                    <select id="school_type" class="form-select border-0 shadow-sm rounded-3">
                                        <option value="public school">Public School</option>
                                        <option value="private school">Private School</option>
                                        <option value="online program">Online Program</option>
                                        <option value="umbrella school">Umbrella School</option>
                                        <option value="homeschooled through county/district office">Homeschooled Through County/District Office</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium"><i class="fas fa-building me-2"></i>School Name</label>
                                    <input type="text" id="school_name" class="form-control border-0 shadow-sm rounded-3">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium"><i class="fas fa-phone me-2"></i>School Phone Number</label>
                                    <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                        <select class="form-select border-0" id="country_code" style="max-width: 120px;"></select>
                                        <input type="text" id="school_number" class="form-control border-0 numberFormat" onkeyup="validateNumber(this.value,'#school_number')"/>
                                    </div>
                                </div>
                            </div>
                            <!-- Continue with other fields following same pattern -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium"><i class="fas fa-envelope me-2"></i>School Email</label>
                                    <input type="email" id="school_email" class="form-control border-0 shadow-sm rounded-3">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium"><i class="fas fa-map-marker-alt me-2"></i>School Address</label>
                                    <input type="text" id="school_address" class="form-control border-0 shadow-sm rounded-3">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium"><i class="fas fa-city me-2"></i>School City</label>
                                    <input type="text" id="school_city" class="form-control border-0 shadow-sm rounded-3">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium"><i class="fas fa-flag-usa me-2"></i>School State</label>
                                    <select id="state" class="form-select border-0 shadow-sm rounded-3">
                                        <option value='-1'>Select State</option>

                                        <option value='AL'>Alabama</option>
                                        <option value='AK'>Alaska</option>
                                        <option value='AZ'>Arizona</option>
                                        <option value='AR'>Arkansas</option>
                                        <option value='CA'>California</option>

                                        <option value='CO'>Colorado</option>
                                        <option value='CT'>Connecticut</option>
                                        <option value='DE'>Delaware</option>
                                        <option value='DC'>District of Columbia</option>
                                        <option value='FL'>Florida</option>

                                        <option value='GA'>Georgia</option>
                                        <option value='HI'>Hawaii</option>
                                        <option value='ID'>Idaho</option>
                                        <option value='IL'>Illinois</option>
                                        <option value='IN'>Indiana</option>

                                        <option value='IA'>Iowa</option>
                                        <option value='KS'>Kansas</option>
                                        <option value='KY'>Kentucky</option>
                                        <option value='LA'>Louisiana</option>
                                        <option value='ME'>Maine</option>

                                        <option value='MD'>Maryland</option>
                                        <option value='MA'>Massachusetts</option>
                                        <option value='MI'>Michigan</option>
                                        <option value='MN'>Minnesota</option>
                                        <option value='MS'>Mississippi</option>

                                        <option value='MO'>Missouri</option>
                                        <option value='MT'>Montana</option>
                                        <option value='NE'>Nebraska</option>
                                        <option value='NV'>Nevada</option>
                                        <option value='NH'>New Hampshire</option>

                                        <option value='NJ'>New Jersey</option>
                                        <option value='NM'>New Mexico</option>
                                        <option value='NY'>New York</option>
                                        <option value='NC'>North Carolina</option>
                                        <option value='ND'>North Dakota</option>

                                        <option value='OH'>Ohio</option>
                                        <option value='OK'>Oklahoma</option>
                                        <option value='OR'>Oregon</option>
                                        <option value='PA'>Pennsylvania</option>
                                        <option value='RI'>Rhode Island</option>

                                        <option value='SC'>South Carolina</option>
                                        <option value='SD'>South Dakota</option>
                                        <option value='TN'>Tennessee</option>
                                        <option value='TX'>Texas</option>
                                        <option value='UT'>Utah</option>

                                        <option value='VT'>Vermont</option>
                                        <option value='VA'>Virginia</option>
                                        <option value='WA'>Washington</option>
                                        <option value='WV'>West Virginia</option>
                                        <option value='WI'>Wisconsin</option>

                                        <option value='WY'>Wyoming</option>   
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium"><i class="fas fa-globe me-2"></i>School County</label>
                                    <select id="county" class="form-select border-0 shadow-sm rounded-3">
                                        <option value='-1'>Select County</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium"><i class="fas fa-map-pin me-2"></i>School Zip Code</label>   
                                    <input type="text" id="school_zip_code" class="form-control border-0 shadow-sm rounded-3">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label text-secondary fw-medium"><i class="fas fa-calendar-alt me-2"></i>Last Date of Study</label>
                                    <input type="date" id="school_last_date" class="form-control border-0 shadow-sm rounded-3">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" id="emailConfirmation">
                                    <label class="form-check-label text-secondary fw-medium" for="emailConfirmation">
                                        Please Check Email is Correct
                                        <i class="fas fa-info-circle ms-2" style="color: #456fb6" data-bs-toggle="tooltip"
                                           data-bs-placement="right"
                                           title="Confirm this email is correct. It's essential for contacting the previous school to transfer your child's records.">
                                        </i>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex justify-content-center gap-2 mt-4">
                                    <button class="btn blue-btn px-4 rounded-3 shadow-sm" data-bs-dismiss="modal">Close</button>
                                    <button class="btn blue-btn px-4 rounded-3 shadow-sm" id="updateTransfer">
                                        <i class="fas fa-save me-2"></i>Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize all tooltips
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl, {
                customClass: 'custom-tooltip'
            })
        })
    })
</script> 
<!-- Drop Down JS -->
<!-- <script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__); ?>js/drop_down.js"></script>  -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>js/drop_down.js"></script>
<!-- AJAX JS -->
<!-- <script src="<?php echo plugin_dir_url(__FILE__); ?>ajax/newTransfer_ajax_function.js"></script> -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>ajax/newTransfer_ajax_function.js"></script>