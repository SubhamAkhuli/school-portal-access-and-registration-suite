let users = [];
// Get Transfer Student Data
jQuery(document).ready(function(){

    // Get all transfer students
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'get_all_registration_data'
        },
        success: function(data){
            // console.log(data);
            if (data.success) {
                users = data.data;
                // Call the render function with the data
                render_user_data(users);
            }
        }
    });

    // Filter to the table
    $('#userFilter').on('change', function() {
        let filterValue = $(this).val();
        let filteredUsers;

        if (filterValue === 'paid') {
            filteredUsers = users.filter(user => user.payment_status === 'paid');
        } else if (filterValue === 'unpaid') {
            filteredUsers = users.filter(user => user.payment_status === 'unpaid' || !user.payment_status);
        } else {
            filteredUsers = users;
        }

        render_user_data(filteredUsers);
    });

    // Users Render function
    function render_user_data(users) {
        // Destroy existing DataTable if it exists
        let table = $('.users-table').DataTable();
        if (table) {
            table.destroy();
        }
        let tableBody = '';
        users.forEach(user => {
            // Create full name, defaulting to "-" if all name parts are empty
            let fullName = (user.parent_first_name || user.parent_middle_name || user.parent_last_name) ?
                `${user.parent_first_name || ''} ${user.parent_middle_name || ''} ${user.parent_last_name || ''}`.trim() :
                '-';

            // Table row creation
            tableBody += `
                <tr class="table-row-hover">
                    <td class="fw-semibold text-nowrap">
                        ${fullName !== '-' ? 
                            `<a href="/view-students/?rid=${user.registration_id}" style="text-decoration: none; color: #456fb6;">
                                ${fullName.charAt(0).toUpperCase() + fullName.slice(1)}
                             </a>` : '-'}
                    </td>
                    <td class="text-primary">${user.student_count || '0'}</td>
                    <td class="text-nowrap"><span class="text-muted">${user.registration_email || '-'}</span></td>
                    <td class="text-nowrap">${user.parent_role ? 
                        (user.parent_role.charAt(0).toUpperCase() + user.parent_role.slice(1)) : '-'}</td>
                    <td>
                        <button class="btn btn-sm rounded-3 shadow-sm renew-user" 
                            style="background-color: ${user.renewal_by_admin === 'yes' ? '#28a745' : '#456fb6'}; color: white;"
                            onclick="renewUser('${user.registration_id}', '${user.account_expire}')"
                            data-id="${user.registration_id}"
                            data-bs-toggle="tooltip"
                            title="Renew User">
                            <i class="fa-solid fa-repeat me-1"></i> Renew
                        </button>
                    </td>
                    <td>${new Date(user.account_expire).toLocaleDateString('en-US', {
                            month: '2-digit', day: '2-digit', year: 'numeric'
                        }).replace(',', ', ')}
                    </td>
                    <td>
                        <div class="form-check form-switch d-inline-block ms-2">
                            <input class="form-check-input user-status-toggle ${user.account_status === 'active' ? 'bg-success' : ''}" 
                                type="checkbox"  
                                data-id="${user.registration_id}"
                                data-bs-toggle="tooltip"
                                onchange="updateUserStatus(this, '${user.registration_id}')"
                                title="Toggle user status"
                                ${user.account_status === 'active' ? 'checked' : ''}>
                        </div>
                    </td>
                    <td class="text-nowrap">${formatDateTime(user.submitted_at)}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            ${user.parent_id ? 
                                `<a href="/view-portfolio/?rid=${user.registration_id}" 
                                    class="btn btn-light btn-sm rounded-circle shadow-sm portfolio-user" 
                                    data-id="${user.registration_id}"
                                    data-bs-toggle="tooltip"
                                    title="View Portfolio">
                                    <i class="fa-solid fa-user-tie" style="color: #456fb6;"></i>
                                </a>` : 
                                `<button class="btn btn-light btn-sm rounded-circle shadow-sm" disabled
                                    data-bs-toggle="tooltip"
                                    title="Portfolio not available">
                                    <i class="fa-solid fa-user-tie" style="color: #ccc;"></i>
                                </button>`
                            }
                            <!-- <button class="btn btn-light btn-sm rounded-circle shadow-sm approve-user" 
                                    data-id="${user.registration_id}"
                                    data-bs-toggle="tooltip"
                                    title="Approve User">
                                <i class="fa-solid fa-user-check" style="color: #456fb6;"></i>
                            </button> -->
                            ${user.parent_id ? 
                                `<button class="btn btn-light btn-sm rounded-circle shadow-sm edit-user" 
                                    onclick="openEditModal('${user.registration_id}', '${user.parent_id}', 
                                    '${user.parent_first_name}', '${user.parent_middle_name}', 
                                    '${user.parent_last_name}', '${user.parent_email}', '${user.parent_role}')"
                                    data-id="${user.registration_id}"
                                    data-bs-toggle="tooltip"
                                    title="Edit User">
                                    <i class="fas fa-edit" style="color: #456fb6;"></i>
                                </button>
                                <a href="/view-registration-details/?rid=${user.registration_id}" 
                                    class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                    data-bs-toggle="tooltip"
                                    title="View Details">
                                    <i class="fas fa-info-circle" style="color: #456fb6;"></i>
                                </a>` : 
                                `<button class="btn btn-light btn-sm rounded-circle shadow-sm" disabled
                                    data-bs-toggle="tooltip"
                                    title="Edit not available">
                                    <i class="fas fa-edit" style="color: #ccc;"></i>
                                </button>
                                <button class="btn btn-light btn-sm rounded-circle shadow-sm" disabled
                                    data-bs-toggle="tooltip"
                                    title="View Details not available">
                                    <i class="fas fa-info-circle" style="color: #ccc;"></i>
                                </button>`
                            }
                            
                            <button class="btn btn-light btn-sm rounded-circle shadow-sm delete-user" 
                                onclick="deleteUser('${user.registration_id}')"
                                data-id="${user.registration_id}"
                                data-bs-toggle="tooltip"
                                title="Delete User">
                                <i class="fas fa-trash" style="color: #456fb6;"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
        $('.users-table tbody').html(tableBody);
        // Initialize DataTable with enhanced styling
        $('.users-table').DataTable({
            responsive: true,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            pageLength: 10,
            dom: '<"sticky-top bg-white"<"d-flex justify-content-between align-items-center mb-3"lf>>' +
                '<"row"<"col-sm-12 table-responsive"tr>>' +
                '<"sticky-bottom bg-white"<"row align-items-center"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>>',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search Users...",
                lengthMenu: "_MENU_ records per page",
                info: "Showing _START_ to _END_ of _TOTAL_ users",
                paginate: {
                    first: '<i class="fas fa-angle-double-left"></i>',
                    last: '<i class="fas fa-angle-double-right"></i>',
                    next: '<i class="fas fa-angle-right"></i>',
                    previous: '<i class="fas fa-angle-left"></i>'
                }
            },
            columnDefs: [
                { orderable: true, targets: [0, 1, 2, 3, 5, 7] },
                { orderable: false, targets: [4, 6, 8] },
                { className: "text-start", targets: [0, 2] },
                { className: "align-middle text-center", targets: [1, 3, 4, 5, 6, 7, 8] }
            ],
            order: [[7, 'desc']],
            autoWidth: false,
            drawCallback: function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                $('.users-table thead th').css({
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
                $('.users-table thead th').css({
                    'background-color': '#bc9f5e',
                    'color': 'white'
                });
            }
        });
    }

    // Add User Data
    $('#addUserForm').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData($('#addUserForm')[0]);
        
        // verify email address
        var email = formData.get('email');

        if (isValidEmail(email)) {
            // console.log("Email is valid!");
        } else {
            swal("Invalid Email Address", "Please enter a valid email address.", "error");
            return false; // Stop further processing
        }

        var password = formData.get('password');
        var confirmPassword = formData.get('confirm_password');
        if (password === confirmPassword) {
            var specialChar = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
            if (password.length < 8 || !specialChar.test(password)) {
            // show message
            return swal("Password must have 8 characters and at least 1 special character", "", "error");
            }
        } else {
            // show message
            return swal("Password and Confirm Password must be same", "", "error");
        }

        formData = $('#addUserForm').serialize();
        console.log(formData);
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: formData + '&action=add_new_user_data',
            success: function(data){
                console.log(data);
                if(data.success) {
                    swal({
                        title: data.data.message,
                        icon: "success",
                        timer: 3000
                    });
                    $('#addUserModal').modal('hide');
                    location.reload();
                } else {
                    swal({
                        title: data.data.message || "Failed to add user",
                        icon: "error",
                        timer: 3000
                    });
                }
            }
        })
    });

    // Open edit user modal
    window.openEditModal = function( registrationID, parentId, parentFirstName, parentMiddleName, parentLastName, parentEmail, parentRole) {
        // Reset form first
        $('#editUserForm')[0].reset();

        // Get the modal inputs

        $('#edit_user_registration_id').val(registrationID);

        // Set parent ID in hidden input
        $('#edit_user_id').val(parentId);

        // Set form field values
        $('#edit_first_name').val(parentFirstName);
        $('#edit_middle_name').val(parentMiddleName);
        $('#edit_last_name').val(parentLastName);
        $('#edit_email').val(parentEmail);
        $('#edit_role').val(parentRole);

        // Show the modal
        $('#editUserModal').modal('show');
    };

    // save edited user data
    $('#editUserForm').on('submit', function(e) {
        e.preventDefault();
        let formData = $('#editUserForm').serialize();
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: formData + '&action=update_user_data',
            success: function(data) {
                console.log(data);
                if (data.success) {
                    swal({
                        title: data.data.message,
                        icon: "success",
                        timer: 3000
                    });
                    $('#editUserModal').modal('hide');
                    location.reload();
                } else {
                    swal({
                        title: data.data.message || "Failed to update user data",
                        icon: "error",
                        timer: 3000
                    });
                }
            }
        });
    });

    // Handle copy emails button click
    $('#copyEmails').on('click', async function() {
        // Get all user emails from the table
        let emails = [];
        let table = $('.users-table').DataTable();
        let allData = table.rows().data();
        
        allData.each(function(rowData) {
            // Get email from the third column (index 2)
            let email = $(rowData[2]).text().trim();
            if (email) {
            emails.push(email);
            }
        });

        // Create temporary textarea to copy emails
        let tempTextArea = $('<textarea>')
            .val(emails.join('\n'))
            .appendTo('body')
            .select();

        try {
            // Copy to clipboard using the modern API
            await navigator.clipboard.writeText(emails.join('\n'));
            swal({
                title: "Emails copied to clipboard",
                icon: "success",
                timer: 3000
            });
        } catch (err) {
            console.error('Failed to copy emails:', err);
            swal({"title":"Failed to copy emails","icon":"error"});
        } finally {
            // Remove temporary textarea
            tempTextArea.remove();
        }
    });

    // Update user status
    window.updateUserStatus = function(element, registrationId) {
        let status = element.checked ? 'active' : 'inactive';
         // change the background color of the toggle switch
         if (element.checked) {
            $(element).addClass('bg-success');
        } else {
            $(element).removeClass('bg-success');
        }
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'action': 'update_user_status',
                'registration_id': registrationId,
                'status': status
            },
            success: function(data) {
                console.log(data);
                if (data.success) {
                    swal({
                        title: data.data.message,
                        icon: "success",
                        timer: 1000
                    });
                } else {
                    swal({
                        title: data.data.message || "Failed to update user status",
                        icon: "error",
                        timer: 3000
                    });
                }
            }
        });
    }
    
    // Renew user
    window.renewUser = function(registrationId , accountExpire) {
        swal({
            title: "Are you sure?",
            text: "Once renewed, it will be extended for another year!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willRenew) => {
            if (willRenew) {
                // console.log("registrationId:", registrationId);
                // console.log("accountExpire:", accountExpire); 
                $.ajax({
                    type: 'POST',
                    url: ajax_object.ajax_url,
                    data: {
                        'action': 'renew_user_by_admin',
                        'registration_id': registrationId,
                        'account_expire': accountExpire,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.success) {
                            swal({
                                title: data.data.message,
                                icon: "success",
                                timer: 3000
                            });
                            location.reload();
                        } else {
                            swal({
                                title: data.data.message || "Failed to renew user",
                                icon: "error",
                                timer: 3000
                            });
                        }
                    }
                });
            }
        });
    }

    // Delete user
    window.deleteUser = function(registrationId) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this user!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                    url: ajax_object.ajax_url,
                    data: {
                        'action': 'delete_user',
                        'registration_id': registrationId
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.success) {
                            swal({
                                title: data.data.message,
                                icon: "success",
                                timer: 3000
                            });
                            location.reload();
                        } else {
                            swal({
                                title: data.data.message || "Failed to delete user",
                                icon: "error",
                                timer: 3000
                            });
                        }
                    }
                });
            }
        });
    }

    // Function to format date
    function formatDateTime(dateString) {
        return new Date(dateString).toLocaleString('en-US', {
            month: '2-digit',
            day: '2-digit',
            year: 'numeric',
        });
    }

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