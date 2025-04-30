<div class="container">
    <div class="card shadow">
        <div class="card-body p-0">
                <table class="table table-responsive table-hover table-striped transactionsTable border w-100 ">
                    <thead>
                        <tr>
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
</div>

<!-- Include the AJAX handler file -->
<script type="text/javascript" src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>ajax/transaction_ajax_function.js"></script>

<!-- DataTables JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>