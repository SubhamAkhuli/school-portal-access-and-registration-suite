<?php
$page_id = get_the_ID();

$reg_button_1 = get_field('registration_page_button1', $page_id);
$reg_button_2 = get_field('registration_page_button2', $page_id);
$agreement_page_privacy_policy_text = get_field('agreement_page_privacy_policy_text', $page_id);

$each_student_pay_below_8 = get_field('each_student_pay_below_8', $page_id);
$each_student_pay_after_8 = get_field('each_student_pay_after_8', $page_id);
$processing_fee = get_field('processing_fee', $page_id);
$transfer_fee = get_field('transfer_fee', $page_id);
$additional_transfer_fee = get_field('additional_transfer_fee', $page_id);
$family_app_fee = get_field('family_app_fee', $page_id);
$reinstatement_fess = get_field('reinstatement_fess', $page_id);
$old_student_graduate_price = get_field('old_student_graduate_price', $page_id);
$new_student_graduate_price = get_field('new_student_graduate_price', $page_id);
$renewal_app_fee = get_field('renewal_app_fee', $page_id);
?>

<div class="container mt-5">
    <form id="settingsForm" class="needs-validation">
        <!-- Registration Buttons Section -->
        <div class="mb-4 bg-white p-4 rounded shadow-sm">
            <h5 class="border-bottom border-primary pb-2 text-primary fw-bold">
                <i class="fa-solid fa-computer-mouse me-2"></i>Registration Buttons
            </h5>
            <div class="row g-4 mt-2">
                <div class="col-md-6">
                    <label for="reg_button_1" class="form-label fw-bold text-dark">Registration Page 1st Button Text:</label>
                    <input type="text" id="reg_button_1" name="reg_button_1" required class="form-control form-control-lg rounded-pill border-primary" 
                        value="<?php echo $reg_button_1; ?>" />
                </div>
                
                <div class="col-md-6">
                    <label for="reg_button_2" class="form-label fw-bold text-dark">Registration Page 2nd Button Text:</label>
                    <input type="text" id="reg_button_2" name="reg_button_2" class="form-control form-control-lg rounded-pill border-primary" 
                        value="<?php echo $reg_button_2; ?>" />
                </div>
            </div>
        </div>

        <!-- Privacy Policy Section -->
        <div class="mb-4 bg-white p-4 rounded shadow-sm">
            <h5 class="border-bottom border-primary pb-2 text-primary fw-bold">
                <i class="fas fa-shield-alt me-2"></i>Privacy Policy
            </h5>
            <div class="row mt-2">
                <div class="col-12">
                    <label for="post_content" class="form-label fw-bold text-dark">Agreement Page Privacy Policy Text:</label>
                    <textarea id="post_content" name="agreement_privacy_policy" class="form-control border-primary"><?php echo apply_filters('the_content', $agreement_page_privacy_policy_text); ?></textarea>
                </div>
            </div>
        </div>

        <!-- Fee Structure Section -->
        <div class="mb-4 bg-white p-4 rounded shadow-sm">
            <h5 class="border-bottom border-primary pb-2 text-primary fw-bold">
                <i class="fas fa-dollar-sign me-2"></i>Fee Structure
            </h5>
            <div class="row g-3 mt-2">
                <div class="col-md-6 col-lg-4">
                    <label for="each_student_pay_below_8" class="form-label fw-bold text-dark">Each Student Pay Below 8:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-dollar-sign"></i></span>
                        <input type="text" id="each_student_pay_below_8" name="each_student_pay_below_8" required class="form-control border-primary"
                            value="<?php echo $each_student_pay_below_8; ?>" />
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <label for="each_student_pay_after_8" class="form-label fw-bold text-dark">Each Student Pay After 8:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-dollar-sign"></i></span>
                        <input type="text" id="each_student_pay_after_8" name="each_student_pay_after_8" class="form-control border-primary" 
                            value="<?php echo $each_student_pay_after_8; ?>" />
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <label for="processing_fee" class="form-label fw-bold text-dark">Processing Fee:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-dollar-sign"></i></span>
                        <input type="text" id="processing_fee" name="processing_fee" required class="form-control border-primary"
                            value="<?php echo $processing_fee; ?>" />
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <label for="transfer_fee" class="form-label fw-bold text-dark">Transfer Fee:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-dollar-sign"></i></span>
                        <input type="text" id="transfer_fee" name="transfer_fee" class="form-control border-primary" 
                            value="<?php echo $transfer_fee; ?>" />
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <label for="family_app_fee" class="form-label fw-bold text-dark">Family App Fee:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-dollar-sign"></i></span>
                        <input type="text" id="family_app_fee" name="family_app_fee" class="form-control border-primary" 
                            value="<?php echo $family_app_fee; ?>" />
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <label for="reinstatement_fess" class="form-label fw-bold text-dark">Reinstatement Fees:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-dollar-sign"></i></span>
                        <input type="text" id="reinstatement_fess" name="reinstatement_fess" class="form-control border-primary" 
                            value="<?php echo $reinstatement_fess; ?>" />
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="old_student_graduate_price" class="form-label fw-bold text-dark">Old Student Graduate Price:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-dollar-sign"></i></span>
                        <input type="text" id="old_student_graduate_price" name="old_student_graduate_price" class="form-control border-primary" 
                            value="<?php echo $old_student_graduate_price; ?>" />
                    </div>
                    <small class="form-text text-muted d-block fst-italic">(if student enrolled since 9th grade or before)</small>
                </div>

                <div class="col-md-4">
                    <label for="new_student_graduate_price" class="form-label fw-bold text-dark">New Student Graduate Price:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-dollar-sign"></i></span>
                        <input type="text" id="new_student_graduate_price" name="new_student_graduate_price" class="form-control border-primary" 
                            value="<?php echo $new_student_graduate_price; ?>" />
                    </div>
                    <small class="form-text text-muted d-block fst-italic">(if student enrolled after 9th grade)</small>
                </div>

                <div class="col-md-4">
                    <label for="renewal_app_fee" class="form-label fw-bold text-dark">Renewal Application Fee:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-dollar-sign"></i></span>
                        <input type="text" id="renewal_app_fee" name="renewal_app_fee" class="form-control border-primary" 
                            value="<?php echo $renewal_app_fee; ?>" />
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="settings_save_action" value="<?php echo wp_create_nonce('update_settings_data'); ?>">
        <input type="hidden" name="page_id" value="<?php echo $page_id; ?>">

        <div class="text-center mt-4"> 
            <button class="btn btn-primary btn-lg px-3 py-2 rounded-pill shadow" id="saveSettingsBtn">
                <i class="fas fa-save me-1"></i> Save Changes
            </button>
        </div>
    </form>
</div>

<script>
    jQuery(document).ready(function($) {
        $('#settingsForm').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: formData + '&action=update_settings_action&security=' + ajax_object.ajax_nonce,
                beforeSend: function() {
                    $('#saveSettingsBtn').html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Saving...').attr('disabled', true);
                },
                success: function(response) {
                    // console.log(response);
                    swal("Success!", "Settings updated successfully!", "success");
                    $('#saveSettingsBtn').html('<i class="fas fa-save me-2"></i> Save Changes').attr('disabled', false);
                },
                error: function() {
                    swal("Error!", "An error occurred while saving settings.", "error");
                    $('#saveSettingsBtn').html('<i class="fas fa-save me-2"></i> Save Changes').attr('disabled', false);
                }
            });
        });

        tinymce.init({
            selector: '#post_content',
            height: 400,
            menubar: false,
            plugins: 'lists link',
            toolbar: 'bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link',
            setup: function(editor) {
                editor.on('change', function() {
                    tinymce.triggerSave();
                });
            }
        });
    });
</script>