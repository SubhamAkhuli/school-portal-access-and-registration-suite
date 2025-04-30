jQuery(document).ready(function(){

    // Initial AJAX call to get data
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'get_my_account_data'
        },
        success: function(data) {
            // console.log(data);
            if (data.success) {
                if (data.data) {
                    // Update profile section
                    if (data.data.profile_image) {
                        $('#profilePhoto').attr('src', data.data.profile_image);
                    } else {
                        $('#profilePhoto').attr('src', ajax_object.base_url + 'img/user-profile.png');
                    }

                    $('#profileName').text(data.data.first_name + ' ' + data.data.middle_name + ' ' + data.data.last_name);
                    if (data.data.user_role == 'student') {
                        $('#profileRole').html('<i class="fas fa-user-graduate me-1 text-white"></i>' +'Parent/Guardian');
                    }
                    else {
                        $('#profileRole').html('<i class="fas fa-user-shield me-1 text-white"></i>' + data.data.user_role.charAt(0).toUpperCase() + data.data.user_role.slice(1));
                    }
                    $('#parent_id').val(data.data.parent_id);
                    // Update form fields
                    $('#firstName').val(data.data.first_name);
                    $('#middleName').val(data.data.middle_name);
                    $('#lastName').val(data.data.last_name);
                    $('#emailInput').val(data.data.email);
                }
            } else {
                // Handle error case
                swal({
                    title: data.data.message || "Failed to load account data",
                    icon: "error",
                    timer: 3000
                });
            }
        },
        error: function(xhr, status, error) {
            // Handle AJAX error
            swal({
                title: "Error loading account data",
                text: "Please try again later",
                icon: "error",
                timer: 3000
            });
        }
    });

    // Update profile information
    $('#saveChangesBtn').click(function(e) {
        e.preventDefault();
        var firstName = $('#firstName').val();
        var middleName = $('#middleName').val();
        var lastName = $('#lastName').val();
        var email = $('#emailInput').val();
        var parent_id = $('#parent_id').val();

        // check if email is valid
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            swal({
                title: "Please enter a valid email address",
                icon: "warning",
                timer: 3000
            });
            return;
        }


        if ($('#oldPasswordInput').val() !== '' && $('#newPasswordInput').val() !== '' && $('#confirmPasswordInput').val() !== '') {
            var oldPassword = $('#oldPasswordInput').val();
            var newPassword = $('#newPasswordInput').val();
            var confirmPassword = $('#confirmPasswordInput').val();

            // check password match this pattern(Must have 8 Characters and at least 1 Special Character)
            var specialChar = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
            var newPassword = $('#newPasswordInput').val();
            if (newPassword.length < 8 || !specialChar.test(newPassword)) {
                swal({
                    title: "Password must have 8 Characters and at least 1 Special Character",
                    icon: "warning",
                    timer: 3000
                });
                return;
            } else if (newPassword !== confirmPassword) {
                swal({
                    title: "Passwords do not match",
                    icon: "warning",
                    timer: 3000
                });
                return;
            } else if (oldPassword === newPassword) {
                swal({
                    title: "New password must be different from old password",
                    icon: "warning",
                    timer: 3000
                });
                return;
            }
        } else {
            var oldPassword = '';
            var newPassword = '';
            var confirmPassword = '';
        }

        // console.log("firstName: " + firstName);
        // console.log("middleName: " + middleName);
        // console.log("lastName: " + lastName);
        // console.log("email: " + email);
        // console.log("oldPassword: " + oldPassword);
        // console.log("newPassword: " + newPassword);
        // console.log("confirmPassword: " + confirmPassword);

        // AJAX call to update data
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'action': 'update_my_account_data',
                'parent_id': parent_id,
                'first_name': firstName,
                'middle_name': middleName,
                'last_name': lastName,
                'email': email,
                'old_password': oldPassword,
                'new_password': newPassword,
            },
            success: function(data) {
                // console.log(data);
                if (data.success) {
                    swal({
                        title: data.data.message || "Profile updated successfully",
                        icon: "success",
                        timer: 5000
                    });
                    location.reload();
                } else {
                    // Handle error case
                    swal({
                        title: data.data.message || "Failed to update profile",
                        icon: "error",
                        timer: 5000
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX error
                swal({
                    title: "Error updating profile",
                    text: "Please try again later",
                    icon: "error",
                    timer: 3000
                });
            }
        });
    });


    // Profile image upload functionality
    $(document).ready(function() {
        const photoElement = $('#profilePhoto');
        const overlay = $('#photoUploadOverlay');
        const fileInput = $('#profilePhotoUpload');
        
        photoElement.parent().hover(
            function() { overlay.css('opacity', '1'); },
            function() { overlay.css('opacity', '0'); }
        );
        
        overlay.click(function() {
            fileInput.click();
        });
        
        fileInput.change(function(e) {
            // Show preview immediately
            if (this.files && this.files[0]) {
                
                // Upload to server
                var formData = new FormData();
                formData.append('action', 'upload_profile_image');
                formData.append('profile_image', this.files[0]);
                
                $.ajax({
                    type: 'POST',
                    url: ajax_object.ajax_url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success) {
                            // Show preview of the uploaded image
                            photoElement.attr('src', URL.createObjectURL(e.target.files[0]));
                            swal({
                                title: data.data.message || "Profile image uploaded successfully",
                                icon: "success",
                                timer: 2000
                            });
                           
                            // Reload the page to reflect changes
                            location.reload();
                        } else {
                            swal({
                                title: data.data.message || "Failed to upload profile image",
                                icon: "error",
                                timer: 3000
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        swal({
                            title: "Error uploading profile image",
                            text: "Please try again later",
                            icon: "error",
                            timer: 3000
                        });
                    }
                });
            }
        });
    });
});