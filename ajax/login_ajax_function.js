jQuery(document).ready(function($) {

    // Function to handle AJAX form submission of registration form
    function handleRegistrationFormSubmit(formId, action) {
        $(formId).on('submit', function(e) {
            e.preventDefault();
            // show message
            // var messageDiv= document.getElementById('error-message')

            var formData = new FormData(this);
            formData.append('action', action);
            formData.append('security', ajax_object.ajax_nonce);
            formData.append('type', 'register');

            // verify email address
            var email = formData.get('email');

            if (isValidEmail(email)) {
                // console.log("Email is valid!");
            } else {
                // swal("Invalid Email Address", "Please enter a valid email address.", "error");
                document.getElementById('registration-error-message').innerHTML = "Please enter a valid email address.";
                return false; // Stop further processing
            }

            var password = formData.get('password');
            var confirmPassword = formData.get('confirm_password');
            if (password === confirmPassword) {
                var specialChar = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
                if (password.length < 8 || !specialChar.test(password)) {
                    // show message
                    // return swal("Password must have 8 characters and at least 1 special character", "", "error");
                    document.getElementById('registration-error-message').innerHTML = "Password must have 8 characters and at least 1 special character.";
                    return false; // Stop further processing
                }
            } else {
                // show message
                // return swal("Password and Confirm Password must be same", "", "error");
                document.getElementById('registration-error-message').innerHTML = "Passwords do not match.";
                return false; // Stop further processing
            }

            $.ajax({
                url: ajax_object.ajax_url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Handle success message
                    if (response.success) {
                        // show message
                        // swal(response.data.message,"",  "success").then(function() {
                            window.location.href = response.data.redirect_url;
                        // });
                    } else {
                        // swal(response.data.message,"",  "error");
                        document.getElementById('registration-error-message').innerHTML = response.data.message; 
                        // Handle error message
                        // messageDiv.innerHTML = response.data.message;
                        // // add css red color text
                        // messageDiv.style.color = "red";
                        // messageDiv.style.display = "block";
                    }
                    // Reset the form
                    $(formId)[0].reset();
                },
                error: function() {
                    // Reset the form
                    $(formId)[0].reset();

                    // swal("Error: Please try again", "", "error");
                    document.getElementById('registration-error-message').innerHTML = "Error: Please try again later";
                    // // Display error message
                    // messageDiv.innerHTML = "Error: Please try again";
                    // // add css red color text
                    // messageDiv.style.color = "red";
                    // messageDiv.style.display = "block";
                }
            });
        });
    
    }
    // Call the function to handle registration form submission
    handleRegistrationFormSubmit('#registration-form', 'ajax_handle_register');

    // Function to handle AJAX form submission of login form
    function handleLoginFormSubmit(formId, action) {
        $(formId).on('submit', function(e) {
            e.preventDefault();
            // show message
            // var messageDiv= document.getElementById('error-message')

            var formData = new FormData(this);
            formData.append('action', action);
            formData.append('security', ajax_object.ajax_nonce);
            formData.append('type', 'login');
            // verify email address
            var email = formData.get('email');
            if (isValidEmail(email)) {
                // console.log("Email is valid!");
            } else {
                // swal("Invalid Email Address", "Please enter a valid email address.", "error");
                document.getElementById('login-error-message').innerHTML = "Please enter a valid email address.";
                return false; // Stop further processing
            }


            $.ajax({
                url: ajax_object.ajax_url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Handle success message
                    if (response.success) {
                        // Reset the form
                        $(formId)[0].reset();
                        // show message
                        // swal(response.data.message,"",  "success").then(function() {
                            window.location.href = response.data.redirect_url;
                        // });
                    } else {
                        // swal(response.data.message,"",  "error");
                        document.getElementById('login-error-message').innerHTML = response.data.message;
                        // Handle error message
                        // messageDiv.innerHTML = response.data.message;
                        // // add css red color text
                        // messageDiv.style.color = "red";
                        // messageDiv.style.display = "block";
                    }
                },
                error: function() {
                    // Reset the form
                    $(formId)[0].reset();

                    // swal("Error: Please try again", "", "error");
                    document.getElementById('login-error-message').innerHTML = "Error: Please try again later";
                    // // Display error message
                    // messageDiv.innerHTML = "Error: Please try again";
                    // // add css red color text
                    // messageDiv.style.color = "red";
                    // messageDiv.style.display = "block";
                }
            });
        });
    
    }
    // Call the function to handle login form submission
    handleLoginFormSubmit('#login-form', 'ajax_handle_login');

    // Function to handle AJAX form submission of forgot password form
    function handleForgotPasswordFormSubmit(formId, action) {
        $(formId).on('submit', function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            formData.append('action', action);
            formData.append('security', ajax_object.ajax_nonce);
            formData.append('type', 'forgot_password');
            
            // Clear any previous error messages
            document.getElementById('forgotPassword-error-message').innerHTML = "";
            
            // Verify email address
            var email = formData.get('email');
            if (!isValidEmail(email)) {
                document.getElementById('forgotPassword-error-message').innerHTML = "Please enter a valid email address.";
                return false;
            }
            
            // Verify password if fields are not empty
            if (formData.get('new_password') && formData.get('new_confirm_password')) {
                var password = formData.get('new_password');
                var confirmPassword = formData.get('new_confirm_password');
                
                if (password !== confirmPassword) {
                    document.getElementById('forgotPassword-error-message').innerHTML = "Passwords do not match.";
                    return false;
                }
                
                var specialChar = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
                if (password.length < 8 || !specialChar.test(password)) {
                    document.getElementById('forgotPassword-error-message').innerHTML = "Password must have 8 characters and at least 1 special character.";
                    return false;
                }
            }
            
            $.ajax({
                url: ajax_object.ajax_url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        const addFields = document.getElementById('add_fields');
                        const passwordResetCode = document.getElementById('password_reset_code');
                        const newPassword = document.getElementById('new_password');
                        const newConfirmPassword = document.getElementById('new_confirm_password');
                        
                        if (response.data.status ==="code_sent") {
                            swal(response.data.message,"",  "success").then(function() {
                                // remove class hide and make fields required
                                document.getElementById('add_fields').classList.remove('hide');
                                document.getElementById('password_reset_code').required = true;
                                document.getElementById('new_password').required = true;
                                document.getElementById('new_confirm_password').required = true;

                                // make filed value empty
                                document.getElementById('password_reset_code').value = '';
                                document.getElementById('new_password').value = '';
                                document.getElementById('new_confirm_password').value = '';
                            });
                        }
                        else if (response.data.status ==="code_expired") {
                            // Reset the form
                            // $(formId)[0].reset();
                            // // hide fields and make fields not required
                            // document.getElementById('add_fields').classList.add('hide');
                            // document.getElementById('password_reset_code').required = false;
                            // document.getElementById('new_password').required = false;
                            // document.getElementById('new_confirm_password').required = false;


                            // show message
                            swal(response.data.message,"",  "error").then(function() {
                                // window.location.href = '/forgot-password';
                                // make fields required
                                document.getElementById('password_reset_code').required = true;
                                document.getElementById('new_password').required = true;
                                document.getElementById('new_confirm_password').required = true;

                                // make filed value empty
                                document.getElementById('password_reset_code').value = '';
                                document.getElementById('new_password').value = '';
                                document.getElementById('new_confirm_password').value = '';
                            });
                            
                        }
                        else if (response.data.status ==="password_changed") {
                            
                            // show message
                            swal(response.data.message,"",  "success").then(function() {
                                // Reset the form
                                $(formId)[0].reset();
                                // hide fields and make fields not required
                                document.getElementById('add_fields').classList.add('hide');
                                document.getElementById('password_reset_code').required = false;
                                document.getElementById('new_password').required = false;
                                document.getElementById('new_confirm_password').required = false;
                                // redirect to login page
                                window.location.href = '/login';
                            });
                        }
                        else if (response.data.status ==="code_mismatch") {
                            // show message
                            swal(response.data.message,"",  "error").then(function() {
                                // make fields required
                                document.getElementById('password_reset_code').required = true;
                                document.getElementById('new_password').required = true;
                                document.getElementById('new_confirm_password').required = true;

                                // make filed value empty
                                document.getElementById('password_reset_code').value = '';
                                document.getElementById('new_password').value = '';
                                document.getElementById('new_confirm_password').value = '';
                            });
                        }
                    } else {
                        // Reset the form
                        // $(formId)[0].reset();

                        // show message
                        swal(response.data.message,"",  "error").then(function() {
                                // hide fields and make fields not required
                                document.getElementById('add_fields').classList.add('hide');
                                document.getElementById('password_reset_code').required = false;
                                document.getElementById('new_password').required = false;
                                document.getElementById('new_confirm_password').required = false;

                                // make filed value empty
                                document.getElementById('password_reset_code').value = '';
                                document.getElementById('new_password').value = '';
                                document.getElementById('new_confirm_password').value = '';
                            });
                        }
                },
                error: function() {
                   
                    swal("Error: Please try again later", "", "error");
                }
            });
        });
    
    }
    // Call the function to handle forgot password form submission
    handleForgotPasswordFormSubmit('#forgotPassword-form', 'ajax_handle_forgot_password');

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
    
});