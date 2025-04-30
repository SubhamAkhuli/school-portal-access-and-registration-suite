// show transaction details in table 
jQuery(document).ready(function($) {
    // Show the transaction data in the table
    $.ajax({
        type: 'POST',
        url: ajax_object.ajax_url,
        data: {
            'action': 'get_transaction_data',
        },
        success: function(response) {
            // console.log(response);
            if(response.success){
                if (Array.isArray(response.data.transaction_data)) {
                    if (response.data.transaction_data.length > 0) {
                        let tableBody = '';
                        response.data.transaction_data.forEach(record => {
                        tableBody += `
                            <tr>
                                <td>${record.transaction_id || ''}</td>
                                <td>${parseFloat(record.amount).toFixed(2)}$</td>
                                <td>${record.description || '-'}</td>
                                <td>${record.expires_at ? 
                                    `<span data-order="${new Date(record.expires_at).getTime()}">${new Date(record.expires_at).toLocaleDateString('en-US', { 
                                        month: '2-digit', 
                                        day: '2-digit',
                                        year: 'numeric', 
                                    }).replace(',', ', ')}</span>` : '-'}</td>
                                <td data-order="${new Date(record.created_at).getTime()}">${new Date(record.created_at).toLocaleDateString('en-US', { 
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
                            order: [[4, 'desc']], // Date column, newest first
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