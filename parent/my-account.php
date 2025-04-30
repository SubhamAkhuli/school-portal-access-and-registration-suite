<div class="container">
    <div class="text-center mb-5">
        <div class="position-relative d-inline-block mb-3">
            <img src="<?php echo plugin_dir_url(dirname(__FILE__))  . 'img/default.jpg'; ?>"
                    id="profilePhoto"
                    class="rounded-circle shadow-lg"
                    style="width: 180px; height: 180px; object-fit: cover; border: 4px solid #456fb6;"
                    alt="user profile">
        </div>
        <h2 class="fw-bold mb-2" id="profileName" style="color: #2c3e50;">User Name</h2>
        <div class="d-inline-block px-4 py-2 rounded-pill shadow-sm" 
                style="background: linear-gradient(135deg, #456fb6, #3498db);">
            <span class="text-white" id="profileRole">
                <i class="fas fa-star me-1"></i>
                <span class="fw-medium">User Role</span>
            </span>
        </div>
    </div>

    <h4 class="card-title mb-4 fw-bold">
        <i class="fas fa-user-edit me-2" style="color: #456fb6;"></i>
        Edit Profile Information
    </h4>

    <form method="post" class="needs-validation" novalidate id="editProfileForm">
        <input type="hidden" name="parent_id" id="parent_id">
        <div class="modal-body p-4 bg-light">
            <div class="row g-4 mb-3">
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="firstName" class="form-label text-secondary fw-medium">
                            <i class="fas fa-user me-2" style="color: #456fb6;"></i>First Name
                        </label>
                        <input type="text" class="form-control border-0 shadow-sm rounded-3" id="firstName" name="f_name" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="lastName" class="form-label text-secondary fw-medium">
                            <i class="fas fa-user me-2" style="color: #456fb6;"></i>Last Name
                        </label>
                        <input type="text" class="form-control border-0 shadow-sm rounded-3" id="lastName" name="l_name" required>
                    </div>
                        
                    <div class="form-group mb-3 position-relative">
                        <label for="oldPasswordInput" class="form-label text-secondary fw-medium">
                            <i class="fas fa-lock me-2" style="color: #456fb6;"></i>Current Password
                        </label>
                        <input type="password" class="form-control border-0 shadow-sm rounded-3" id="oldPasswordInput" name="old_password" autocomplete="new-password">
                        <span class="position-absolute end-0 translate-middle-y me-3" style="top: 70% !important;">
                            <i id="toggleOldIcon" class="fas fa-eye" style="cursor: pointer;" onclick="togglePassword('oldPasswordInput','toggleOldIcon')"></i>
                        </span>
                    </div>

                    <div class="form-group mb-3 position-relative">
                        <label for="confirmPasswordInput" class="form-label text-secondary fw-medium">
                            <i class="fas fa-check-circle me-2" style="color: #456fb6;"></i>Confirm Password
                        </label>
                        <input type="password" class="form-control border-0 shadow-sm rounded-3" id="confirmPasswordInput" name="confirm_password" autocomplete="new-password">
                        <span class="position-absolute end-0 translate-middle-y me-3" style="top: 70% !important;">
                            <i id="toggleConfirmIcon" class="fas fa-eye" style="cursor: pointer;" onclick="togglePassword('confirmPasswordInput','toggleConfirmIcon')"></i>
                        </span>
                    </div>

                </div>
                <div class="col-lg-6">

                    <div class="form-group mb-3">
                        <label for="middleName" class="form-label text-secondary fw-medium">
                            <i class="fas fa-user me-2" style="color: #456fb6;"></i>Middle Name
                        </label>
                        <input type="text" class="form-control border-0 shadow-sm rounded-3" id="middleName" name="m_name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="emailInput" class="form-label text-secondary fw-medium">
                            <i class="fas fa-envelope me-2" style="color: #456fb6;"></i>Email Address
                        </label>
                        <input type="email" class="form-control border-0 shadow-sm rounded-3" id="emailInput" name="email" required>
                    </div>

                    <div class="form-group mb-3 position-relative">
                        <label for="newPasswordInput" class="form-label text-secondary fw-medium">
                            <i class="fas fa-key me-2" style="color: #456fb6;"></i>New Password
                        </label>
                        <input type="password" class="form-control border-0 shadow-sm rounded-3" id="newPasswordInput" name="password" autocomplete="new-password">
                        <span class="position-absolute end-0 translate-middle-y me-3" style="top: 50% !important;">
                            <i id="toggleNewIcon" class="fas fa-eye" style="cursor: pointer;" onclick="togglePassword('newPasswordInput','toggleNewIcon')"></i>
                        </span>
                        <small class="text-secondary">Must have 8 Characters and at least 1 Special Character *</small>
                    </div>

                </div>
            </div>
            <div class="col-12 text-center">
                <button name="updateAdmin" id="saveChangesBtn" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-save me-2"></i>Save Changes
                </button>
            </div>
        </div>
    </form>
</div>


<script>
    // Toggle password visibility
    function togglePassword(inputId, iconId) {
        var input = document.getElementById(inputId);
        var icon = document.getElementById(iconId);
        if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
        } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
        }
    }
</script>

<!-- AJAX JS -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>ajax/my_account_ajax_function.js"></script>
