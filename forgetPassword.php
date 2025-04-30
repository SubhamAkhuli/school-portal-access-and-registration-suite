<!-- <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/bootstrap.min.css'; ?>"> -->
<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/login_form.css'; ?>">
<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/all.min.css'; ?>">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<div class="container-fluid py-5 bg-light">
    <div class="row justify-content-center">
        <div class="col-sm-11 col-md-8 col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="fw-bold mb-0">Reset Password</h3>
                </div>
                <div class="card-body p-4 p-lg-5">
                    <form id="forgotPassword-form" method="post">
                        <div class="form-floating mb-4">
                            <input id="email" required name="email" class="form-control form-control-lg" type="email" placeholder="Enter your email">
                            <label for="email" class="text-muted">Email Address</label>
                        </div>
                        <div id="add_fields" class="hide">
                            <div class="form-floating mb-4">
                                <input id="password_reset_code" type="text" name="password_reset_code" class="form-control form-control-lg" placeholder="Enter reset code">
                                <label for="password_reset_code" class="text-muted">Reset Code</label>
                            </div>
                            <div class="mb-4">
                                <div class="input-group input-group-lg">
                                    <div class="form-floating flex-grow-1">
                                        <input name="new_password" id="new_password" autocomplete="off" class="form-control" type="password" placeholder="Enter new password">
                                        <label for="new_password" class="text-muted">New Password</label>
                                    </div>
                                    <button class="btn btn-outline-secondary border"  onclick="togglePassword('new_password')">
                                        <i class="fa fa-eye" id="new_password_eye"></i>
                                    </button>
                                </div>
                                <small class="form-text text-muted mt-2">
                                    Must have 8 Characters and at least 1 Special Character <span class="text-danger">*</span>
                                </small>
                            </div>
                            <div class="mb-4">
                                <div class="input-group input-group-lg">
                                    <div class="form-floating flex-grow-1">
                                        <input name="new_confirm_password" id="new_confirm_password" class="form-control" type="password" placeholder="Confirm new password">
                                        <label for="new_confirm_password" class="text-muted">Confirm Password</label>
                                    </div>
                                    <button class="btn btn-outline-secondary border"  onclick="togglePassword('new_confirm_password')">
                                        <i class="fa fa-eye" id="new_confirm_password_eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button name="submit_email" class="btn btn-primary btn-lg fw-bold">Reset Password</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3 bg-light">
                    <div class="small text-primary"><a href="/login" class="text-decoration-none">Return to Login</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = document.getElementById(inputId + '_eye');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>