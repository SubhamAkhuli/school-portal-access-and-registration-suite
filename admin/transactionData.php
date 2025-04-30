<div class="container">
    <div class="card-body p-0 mt-2">
        <table class="table table-responsive table-hover table-striped transactionsTable border w-100 ">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Transaction ID</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Expire</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody >
                <!-- AJAX will populate this table -->   
            </tbody>
        </table>
    </div>
</div>

<!-- Transaction Details Modal -->
<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="transactionModalLabel">
                    <i class="fas fa-receipt me-2"></i>Transaction Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="fw-bold">Item Description</th>
                                <th class="fw-bold text-center">Quantity</th>
                                <th class="fw-bold text-end">Amount ($)</th>
                            </tr>
                        </thead>
                        <tbody id="transactionDetails">
                            <!-- AJAX will populate this -->
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="2" class="fw-bold text-end">Total:</td>
                                <td class="fw-bold text-end" id="totalAmount">$0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Include the AJAX handler file -->
<script type="text/javascript" src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>ajax/admin_transaction_ajax_function.js"></script>

<!-- DataTables JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>