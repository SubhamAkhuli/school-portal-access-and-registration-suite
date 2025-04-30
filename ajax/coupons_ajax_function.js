// Get all coupons
jQuery(document).ready(function(){
    // Get all coupons
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'get_all_coupons',
        },
        success: function(response) {
            //  console.log(response);
            if(response.success){
                if (response.data.coupons_data.length > 0) {
                    let tableBody = '';
                    response.data.coupons_data.forEach(coupon => {
                        tableBody += `
                            <tr class="${coupon.status !== 'active' ? 'table-danger' : ''}">
                                <td class="text-center">${coupon.code}</td>
                                <td class="text-center">
                                    <span>
                                        ${coupon.discount}${coupon.discount_type === 'percentage' ? ' %' : ' $'}
                                    </span>
                                </td>
                                <td class="text-center text-capitalize">${coupon.discount_type}</td>
                                <td class="text-center">
                                    <span class=" ${coupon.status === 'active' ? 'text-success' : 'text-danger'}">
                                        ${coupon.status.charAt(0).toUpperCase() + coupon.status.slice(1)}
                                    </span>
                                </td>
                                <td class="text-center">
                                     <button class="btn btn-light btn-sm rounded-circle me-2 shadow-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#edit-coupon" 
                                            data-coupon-id="${coupon.id}"
                                            data-coupon-code="${coupon.code}"
                                            data-discount="${coupon.discount}"
                                            data-discount-type="${coupon.discount_type}"
                                            data-status="${coupon.status}">
                                        <i class="fas fa-edit" style="color: #456fb6;"></i>
                                    </button>
                                    <button class="btn btn-light btn-sm rounded-circle shadow-sm delete-coupon"
                                            data-coupon-id="${coupon.id}">
                                        <i class="fas fa-trash-alt" style="color: #dc3545;"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    $('.coupons-table tbody').html(tableBody);

                    // Initialize DataTable with enhanced styling
                    $('.coupons-table').DataTable({
                        responsive: true,
                        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                        pageLength: 10,
                        dom: '<"d-flex justify-content-between align-items-center mb-3"lf>' +
                             '<"row"<"col-sm-12"tr>>' +
                             '<"row align-items-center"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search coupons...",
                            lengthMenu: "_MENU_ records per page",
                            info: "Showing _START_ to _END_ of _TOTAL_ coupons",
                            paginate: {
                                first: '<i class="fas fa-angle-double-left"></i>',
                                last: '<i class="fas fa-angle-double-right"></i>',
                                next: '<i class="fas fa-angle-right"></i>',
                                previous: '<i class="fas fa-angle-left"></i>'
                            }
                        },
                        columnDefs: [
                            { orderable: true, targets: [0, 1, 2, 3] },
                            { orderable: false, targets: 4 },
                            { className: "align-middle text-center", targets: "_all" }
                        ],
                        order: [[0, 'asc']],
                        autoWidth: false,
                        drawCallback: function() {
                            $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                            $('.coupons-table thead th').css({
                            'background-color': '#bc9f5e',
                            'color': 'white'
                        });
                        },
                        stateSave: true,
                        processing: true,
                        scrollCollapse: true,
                        initComplete: function() {
                            $('.dataTables_filter input').addClass('form-control');
                            $('.dataTables_length select').addClass('form-select');
                            $('.dataTables_length').addClass('d-flex align-items-center'); // Fix alignment
                            $('.coupons-table thead th').css({
                                'background-color': '#bc9f5e',
                                'color': 'white'
                            });
                        }
                    });
                    
                } else {
                    $('.coupons-table tbody').html('<tr><td colspan="4" class="text-center">No coupons found</td></tr>');
                }
            } else {
                swal('Error', response.data.message, 'error');
            }
        },
        error: function() {
            swal('Error', 'An unexpected error occurred.', 'error');
        }
    });

    // Set modal data from button attributes when modal is shown
    const editCouponModal = new bootstrap.Modal(document.getElementById('edit-coupon'));
    editCouponModal._element.addEventListener('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var coupon_id = button.data('coupon-id');
        var coupon_code = button.data('coupon-code');
        var discount = button.data('discount');
        var discount_type = button.data('discount-type');
        var status = button.data('status');
        
        $('#edit_coupon_id').val(coupon_id);
        $('#edit_coupon_code').val(coupon_code);
        $('#edit_discount').val(discount);
        $('#edit-coupon').find('#edit_discount_type').val(discount_type);
        $('#edit-coupon').find('#edit_status').val(status);
    });

    // handle the add-coupon modal
    $('#create_coupon').on('click', function (e) {
        e.preventDefault();
        //  console.log($('#new_coupon_code').val());
        if (!$('#new_coupon_code').val() || !$('#new_discount').val() || $('#new_discount_type').val() == null) {
            swal('Error', 'Please fill in all fields', 'error');
            return;
        }
        // console.log($('#new_discount_type').val());
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'action': 'ajax_handle_add_coupon',
                'coupon_code': $('#new_coupon_code').val(),
                'discount': $('#new_discount').val(),
                'discount_type': $('#new_discount_type').val(),
            },
            success: function(response) {
                //  console.log(response);
                if(response.success){
                    swal('Success', response.data.message, 'success');
                    $('#new_coupon_code').val('');
                    $('#new_discount').val('');
                    $('#new_discount_type').val('');
                    const modal = bootstrap.Modal.getInstance(document.querySelector('#add-coupon'));
                    modal.hide();
                    // $('#add-coupon').modal('hide');
                    location.reload();
                } else {
                    swal('Error', response.data.message, 'error');
                }
            },
            error: function() {
                swal('Error', 'An unexpected error occurred.', 'error');
            }
        });
    });

    // handle the coupon_edit modal
    $('#update_coupon').on('click', function (e) {
        e.preventDefault();

     if (!$('#edit_coupon_code').val() || !$('#edit_discount').val() || $('#edit_discount_type').val() == null) {
            swal('Error', 'Please fill in all fields', 'error');
            return;
        }
             
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'action': 'ajax_handle_edit_coupon',
                'coupon_id': $('#edit_coupon_id').val(),
                'coupon_code': $('#edit_coupon_code').val(),
                'discount': $('#edit_discount').val(),
                'discount_type': $('#edit-coupon').find('#edit_discount_type').val(),
                'status': $('#edit-coupon').find('#edit_status').val(),
            },
            success: function(response) {
                //  console.log(response);
                if(response.success){
                    swal('Success', response.data.message, 'success');
                    const modal = bootstrap.Modal.getInstance(document.querySelector('#edit-coupon'));
                    modal.hide();
                    // $('#edit-coupon').modal('hide');
                    location.reload();
                } else {
                    swal('Error', response.data.message, 'error');
                }
            },
            error: function() {
                swal('Error', 'An unexpected error occurred.', 'error');
            }
        });
    });

    // handle the delete coupon
    $('.coupons-table').on('click', '.delete-coupon', function (e) {
        e.preventDefault();
        var coupon_id = $(this).data('coupon-id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this coupon!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                    url: ajax_object.ajax_url,
                    data: {
                        'action': 'ajax_handle_delete_coupon',
                        'coupon_id': coupon_id,
                    },
                    success: function(response) {
                        //  console.log(response);
                        if(response.success){
                            swal('Success', response.data.message, 'success');
                            location.reload();
                        } else {
                            swal('Error', response.data.message, 'error');
                        }
                    },
                    error: function() {
                        swal('Error', 'An unexpected error occurred.', 'error');
                    }
                });
            }
        });
    });
});