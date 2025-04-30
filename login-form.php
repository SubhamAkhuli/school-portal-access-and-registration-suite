<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/bootstrap.min.css'; ?>">
<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/login_form.css'; ?>">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<div class="container-fluid">
    <div class="text-center">
    </div>
    <div class="row justify-content-center mt-0 formBox ">
        <div class="col-sm-12 col-md-6 col-lg-6 mt-3 mb-2 mobileForm1">
            <h4 class="text-center mb-4"><i class="fas fa-user-circle fa-2x  mb-3" style="color: #456fb6 ;"></i><br>Member Login</h4>
            <form id='login-form' method='post'>
                <label class="text-muted"><i class="fas fa-envelope me-2"></i>Email</label>
                <input required name='email' class="form-control mb-4" type="email" placeholder="Enter your email address">
                <label class="text-muted"><i class="fas fa-lock me-2"></i>Password</label>
                <div class="input-group">
                    <input required name='password' class="form-control" type="password" id="login-password" placeholder="Enter your password">
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword('login-password')">
                            <i class="fa fa-eye" id="login-eye"></i>
                        </span>
                    </div>
                </div>
                <p class="txt1" style="margin-top:5px" class="mb-4"><a href="/forget-password/">Forgot Password</a></p>
                <hr>
                <p class="txt1 gotoRegistration hide text-center">Don't have account? <span
                    style="text-decoration: underline;">Registration</span>
                </p>
                <label id="login-error-message" class="mt-2" style='color:red !important;position: absolute;'></label>
                <div class="text-center loginBtn">
                    <input type="submit" name='login' class="action-button" value="Login">
                </div>
            </form>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6  mt-3 mb-2 mobileForm2">
        <h4 class="text-center mb-4"><i class="fas fa-user-plus fa-2x  mb-3" style="color: #456fb6 ;"></i><br>Registration</h4>
            <form id="registration-form" method='post'>
                <label class="text-muted"><i class="fas fa-envelope me-2"></i>Email</label>
                <input required name='email' class="form-control mb-3" type="email" placeholder="Enter your email address">
                <label class="text-muted"><i class="fas fa-lock me-2"></i>Password</label>
                <div class="input-group">
                    <input required name='password' class="form-control" type="password" id="reg-password" placeholder="Enter your password">
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword('reg-password')">
                            <i class="fa fa-eye" id="reg-eye"></i>
                        </span>
                    </div>
                </div>
                <sup style="color: #9e9e9e;display: block;line-height: 13px;margin-top: 10px;" class="mb-4">Must have 8 Characters and at least 1 Special Character <span style="color:red">*</span> </sup>
                <label class="text-muted"><i class="fas fa-lock me-2"></i>Confirm Password</label>
                <div class="input-group mb-4">
                    <input required name='confirm_password' class="form-control" type="password" id="reg-confirm-password" placeholder="Confirm your password">
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword('reg-confirm-password')">
                            <i class="fa fa-eye" id="reg-confirm-eye"></i>
                        </span>
                    </div>
                </div>
                <label id="registration-error-message" style='color:red !important;position: absolute;'></label>
                <hr>
                <p class="txt1 gotoLogin hide text-center" >Already have an account? <span
                        style="text-decoration: underline;">Login</span></p>
                <p class="txt1 desktop text-center">Already have an account? <span style="text-decoration: underline;">Login on
                        the
                        left</span></p>
                <div class="text-center">
                    <input type="submit" name='register' class="action-button" value="Get Started">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // toggle password visibility
    function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = document.getElementById(inputId.replace('password', 'eye'));
        
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

    // $(document).ready(function() {
    JQuery(document).ready(function() {
        $('.gotoRegistration').click(()=>{
            $('.mobileForm1').addClass('hide');
            $('.mobileForm2').removeClass('hide');
        })

        $('.gotoLogin').click(()=>{
            $('.mobileForm1').removeClass('hide');
            $('.mobileForm2').addClass('hide');

        })
    })

    // Make error message disappear after 5 seconds
    // Function to handle error message timeout
    // function handleErrorMessage(elementId) {
    //     const element = document.getElementById(elementId);
    //     if (element && element.textContent !== '') {
    //         setTimeout(() => {
    //             element.textContent = '';
    //         }, 5000);
    //     }
    // }

    // Create observers for both error messages
    // const loginObserver = new MutationObserver(() => {
    //     handleErrorMessage('login-error-message');
    // });

    // const registrationObserver = new MutationObserver(() => {
    //     handleErrorMessage('registration-error-message');
    // });

    // // Start observing
    // loginObserver.observe(document.getElementById('login-error-message'), {
    //     childList: true,
    //     characterData: true,
    //     subtree: true
    // });

    // registrationObserver.observe(document.getElementById('registration-error-message'), {
    //     childList: true,
    //     characterData: true,
    //     subtree: true
    // });
</script>