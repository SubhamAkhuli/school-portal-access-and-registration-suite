// show transaction details in table 
jQuery(document).ready(function($) {
    // Show the transaction data in the table
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'get_all_transaction_data',
        },
        success: function(response) {
            // console.log(response);
            if(response.success){
                if (Array.isArray(response.data.transaction_data)) {
                    if (response.data.transaction_data.length > 0) {
                        let tableBody = '';
                        response.data.transaction_data.forEach(record => {
                        // Parse transaction items
                        let transactionItems = [];
                        try {
                            transactionItems = JSON.parse(record.transactionItems);
                            // console.log("transactionItems", transactionItems)
                        } catch (e) {
                            console.error('Error parsing transaction items:', e);
                        }

                        // Store items in data attribute
                        const itemsData = encodeURIComponent(JSON.stringify(transactionItems));
                        // console.log('itemsData:', itemsData);

                        tableBody += `
                            <tr>
                                <td>
                                    <a href="/view-registration-details/?rid=${record.registration_id}" 
                                       class="fw-bold" style="color: #456fb6;">
                                       ${record.user_name || '-'}
                                    </a>
                                </td>
                                <td>${record.transaction_id || ''}</td>
                                <td><a href="#" class="text-primary transaction-details fw-bold" data-items='${itemsData}' data-bs-toggle="modal"  data-bs-target="#transactionModal">$${parseFloat(record.amount).toFixed(2)}</a></td>
                                <td>${record.description || '-'}</td>
                                <td>${record.expires_at ? new Date(record.expires_at).toLocaleDateString('en-US', { 
                                    month: '2-digit', 
                                    day: '2-digit',
                                    year: 'numeric', 
                                }).replace(',', ', ') : '-'}</td>
                                <td data-sort="${new Date(record.created_at).getTime()}">${new Date(record.created_at).toLocaleDateString('en-US', { 
                                    month: '2-digit', 
                                    day: '2-digit',
                                    year: 'numeric',
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: true 
                                }).replace(',', ', ')}</td>
                            </tr>
                        `;

                        });
                        $('.transactionsTable tbody').html(tableBody);

                        // Initialize the DataTable
                        $('.transactionsTable').DataTable({
                            responsive: true,
                            scrollCollapse: true,
                            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                            pageLength: 10,
                            dom: '<"bg-white"<"d-flex justify-content-between align-items-center mb-3"lf>>' +
                                 '<"row"<"col-sm-12 table-responsive"tr>>' +
                                 '<"sticky-bottom bg-white"<"row align-items-center"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>>',
                            language: {
                                search: "_INPUT_",
                                searchPlaceholder: "Search Transactions...",
                                lengthMenu: "_MENU_ records per page",
                                info: "Showing _START_ to _END_ of _TOTAL_ transactions",
                                paginate: {
                                    first: '<i class="fas fa-angle-double-left"></i>',
                                    last: '<i class="fas fa-angle-double-right"></i>',
                                    next: '<i class="fas fa-angle-right"></i>',
                                    previous: '<i class="fas fa-angle-left"></i>'
                                }
                            },
                            columnDefs: [
                                { orderable: true, targets: '_all' },
                                { className: "align-middle text-center", targets: "_all" }
                            ],
                            order: [[5, 'desc']], // Date column, newest first
                            autoWidth: false,
                            drawCallback: function() {
                                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                                $('.transactionsTable thead th').css({
                                    'background-color': '#bc9f5e',
                                    'color': 'white'
                                });
                            },
                            stateSave: true,
                            processing: true,
                            fixedHeader: false,
                            fixedFooter: false,
                            initComplete: function() {
                                $('.dataTables_filter input').addClass('form-control');
                                $('.dataTables_length select').addClass('form-select');
                                $('.transactionsTable thead th').css({
                                    'background-color': '#bc9f5e',
                                    'color': 'white'
                                });
                            }
                        });

                    } else {
                        $('.transactionsTable tbody').html('<tr class="text-center"><td colspan="5">No transaction records found</td></tr>');
                    }
                }
            } else {
                swal('Error', 'An unexpected error occurred.', 'error');
            }
        },
        error: function() {
            swal('Error', 'An unexpected error occurred.', 'error');
        }
    });
}); 

// Add click handler for transaction details
$(document).on('click', '.transaction-details', function(e) {
    e.preventDefault();
    const main_items = JSON.parse(decodeURIComponent($(this).data('items')));
    const items = main_items.filter(item => item.itemName !== "Rush Fee" && !item.itemName.startsWith("Coupon Code - "));
    // console.log('main_items:', main_items);
    // console.log('items:', items);
    let detailsHtml = '';

    // console.log(items);
    let subtotal = 0;
    items.forEach(item => {
        const price = parseFloat(String(item.price).replace('$', ''));
        const lineTotal = price * item.quantity;
        subtotal += lineTotal;
        
        detailsHtml += `
            <tr>
                <td>${item.itemName}</td>
                <td class="text-center">${item.quantity}</td>
                <td class="text-end">${lineTotal.toFixed(2)}</td>
            </tr>
        `;
    });

    // Check if subtotal exceeds $195 before adding Rush Fee and Coupon
    if (subtotal > 195) {
        const excess = subtotal - 195;
        detailsHtml += `
            <tr>
                <td style="background-color: #ffeb3b4f;">Exceeded $195 Maximum Amount</td>
                <td class="text-center" style="background-color: #ffeb3b4f;">-</td>
                <td class="text-end" style="background-color: #ffeb3b4f;">-${excess.toFixed(2)}</td>
            </tr>
        `;
        subtotal = 195; // Adjust subtotal to maximum
    }

    // Add Rush Fee and Coupon Code if present in items
    const rushFee = main_items.find(item => item.itemName === "Rush Fee");
    // console.log('rushFee:', rushFee);
    if (rushFee) {
        const rushFeeAmount = parseFloat(String(rushFee.price).replace('$', ''));
        subtotal += rushFeeAmount;
        detailsHtml += `
            <tr>
                <td>Rush Fee</td>
                <td class="text-center">1</td>
                <td class="text-end">${rushFeeAmount.toFixed(2)}</td>
            </tr>
        `;
    }

    const coupon = main_items.find(item => item.itemName.startsWith("Coupon Code - "));
    // console.log('coupon:', coupon);
    if (coupon) {
        const couponAmount = parseFloat(String(coupon.price).replace('$', ''));
        subtotal -= couponAmount;
        detailsHtml += `
            <tr class="alert alert-danger">
                <td >${coupon.itemName}</td>
                <td class="text-center">1</td>
                <td class="text-end">-${couponAmount.toFixed(2)}</td>
            </tr>
        `;
    }

    // console.log('subtotal:', subtotal);
    // console.log('detailsHtml:', detailsHtml);
    $('#transactionDetails').html(detailsHtml);
    $('#totalAmount').text('$' + subtotal.toFixed(2));
});