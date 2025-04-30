<div class="container">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="d-flex align-items-center gap-3 flex-wrap mb-2">
            <div class="d-flex justify-content-between w-100 align-items-center">
                <div>
                    <select class="form-select" style="width: auto;" id="userFilter">
                        <option value="all">All Users</option>
                        <option value="paid">Paid Users</option>
                        <option value="unpaid">Unpaid Users</option>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn blue-btn btn-md" id="add_user" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fa-solid fa-user-plus me-1"></i>Add User
                    </button>
                    <button id="copyEmails" class="btn blue-btn btn-md">
                        <i class="fa-regular fa-clone me-1"></i>Copy All User Emails
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-responsive table-hover table-striped users-table border w-100">
                <thead class="text-white">
                    <tr>
                        <th class="text-center py-3" style="width: 150px; white-space: nowrap;" >Name</th>
                        <th class="text-center py-3" style="width: 150px; white-space: nowrap;" >Children</th>
                        <th class="text-center py-3" style="width: 150px; white-space: nowrap;" >Email</th>
                        <th class="text-center py-3" style="width: 150px; white-space: nowrap;" >Role</th>
                        <th class="text-center py-3" style="width: 150px; white-space: nowrap;" >Renew Year</th>
                        <th class="text-center py-3" style="width: 150px; white-space: nowrap;" >Account Expire</th>
                        <th class="text-center py-3" style="width: 150px; white-space: nowrap;" >Account Active</th>
                        <th class="text-center py-3" style="width: 150px; white-space: nowrap;" >Submit Date</th>
                        <th class="text-center py-3" style="width: 150px; white-space: nowrap;" >Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-modal="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header" style="background-color: #456fb6;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-plus fs-4 text-white me-2"></i>
                    <h5 class="modal-title text-white mb-0" id="addUserModalLabel">Add User</h5>
                </div>
                <button  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <form id="addUserForm">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label text-secondary fw-medium"><i class="fas fa-user me-2"></i>First Name</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label text-secondary fw-medium"><i class="fas fa-user me-2"></i>Middle Name</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" name="middle_name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label text-secondary fw-medium"><i class="fas fa-user me-2"></i>Last Name</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" name="last_name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label text-secondary fw-medium"><i class="fas fa-envelope me-2"></i>Email</label>
                                <input type="email" class="form-control border-0 shadow-sm rounded-3" name="email" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group position-relative">
                                <label class="form-label text-secondary fw-medium"><i class="fas fa-lock me-2"></i>Password</label>
                                <input type="password" class="form-control border-0 shadow-sm rounded-3" name="password" id="password" required>
                                <span class="position-absolute end-0 translate-middle-y me-3" style="top: 70% !important;">
                                    <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                                </span>
                            </div>
                            <small class="text-secondary">Must have 8 Characters and at least 1 Special Character *</small>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group position-relative">
                                <label class="form-label text-secondary fw-medium"><i class="fas fa-lock me-2"></i>Confirm Password</label>
                                <input type="password" class="form-control border-0 shadow-sm rounded-3" name="confirm_password" id="confirm_password" required>
                                <span class="position-absolute  end-0 translate-middle-y me-3" style="top: 70% !important;">
                                    <i class="fas fa-eye" id="toggleConfirmPassword" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label text-secondary fw-medium"><i class="fas fa-user-tag me-2"></i>Role</label>
                                <select class="form-select border-0 shadow-sm rounded-3" name="role" id="role">
                                    <option value="mother">Mother</option>
                                    <option value="father">Father</option>
                                    <option value="step-mother">Step-Mother</option>
                                    <option value="step-father">Step-Father</option>
                                    <option value="grand-father">Grandfather</option>
                                    <option value="grand-mother">Grandmother</option>
                                    <option value="guardian">Guardian</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button class="btn blue-btn px-4 rounded-3 shadow-sm">
                            <i class="fas fa-save me-2"></i>Save User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-modal="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header" style="background-color: #456fb6;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-edit fs-4 text-white me-2"></i>
                    <h5 class="modal-title text-white mb-0" id="editUserModalLabel">Edit User</h5>
                </div>
                <button  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <form id="editUserForm">
                    <input type="hidden" id="edit_user_id" name="user_id">
                    <input type="hidden" id="edit_user_registration_id" name="user_registration_id">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label text-secondary fw-medium"><i class="fas fa-user me-2"></i>First Name</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="edit_first_name" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label text-secondary fw-medium"><i class="fas fa-user me-2"></i>Middle Name</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="edit_middle_name" name="middle_name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label text-secondary fw-medium"><i class="fas fa-user me-2"></i>Last Name</label>
                                <input type="text" class="form-control border-0 shadow-sm rounded-3" id="edit_last_name" name="last_name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label text-secondary fw-medium"><i class="fas fa-envelope me-2"></i>Email</label>
                                <input type="email" class="form-control border-0 shadow-sm rounded-3" id="edit_email" name="email" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label text-secondary fw-medium"><i class="fas fa-user-tag me-2"></i>Role</label>
                                <select class="form-select border-0 shadow-sm rounded-3" name="role" id="edit_role">
                                    <option value="mother">Mother</option>
                                    <option value="father">Father</option>
                                    <option value="step-mother">Step-Mother</option>
                                    <option value="step-father">Step-Father</option>
                                    <option value="grand-father">Grandfather</option>
                                    <option value="grand-mother">Grandmother</option>
                                    <option value="guardian">Guardian</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-center gap-2 mt-4">
                                <!-- <button  class="btn blue-btn px-4 rounded-3 shadow-sm" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2"></i>Close
                                </button> -->
                                <button  class="btn blue-btn px-4 rounded-3 shadow-sm" id="updateUser">
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

<!-- Password Toggle -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const password = document.getElementById('password');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        const confirmPassword = document.getElementById('confirm_password');
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>
<!-- AJAX JS -->
<!-- <script src="<?php echo plugin_dir_url(__FILE__); ?>ajax/admin_user_ajax_function.js"></script> -->

<!-- AJAX JS -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>ajax/admin_user_ajax_function.js"></script>