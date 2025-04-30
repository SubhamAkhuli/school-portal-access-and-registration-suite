<!-- Modernize js -->
<style>
    .dashboard-summery-one .item-content {
        text-align: left !important;
    }

    .table-responsive .dropdownBox {
        display: flex;
        padding: 19px 15px !important;
    }

    /* tr td:nth-child(1) {
        text-align: left !important;
    } */

    tr td:nth-child(1) h3,
    tr td:nth-child(1) p {
        margin: 0 !important;
    }

    tr th:nth-child(1) {
        text-align: left !important;
    }

    .table .badge {
        padding: 10px 15px;
    }

    .filter-row {
        display: flex;
        align-items: flex-end;
        gap: 20px;
    }
</style>

<!-- Student names and Back Button -->
<div class="row mb-3">
    <div class="col-6">
        <button onclick="window.history.back();" class="btn blue-btn"><i class="fa fa-arrow-left"></i> Back</button>
    </div>
    <div class="col-6 student-names d-flex align-items-center justify-content-end">
        <!-- Student names will be populated here -->
    </div>
</div>

<div class="transcript-container">
    <!-- Class Table Area Start Here -->
</div>

<!-- Include the AJAX handler file -->
<!-- <script type="text/javascript"  src="<?php echo plugin_dir_url(__FILE__); ?>ajax/view_transcript_ajax_function.js"></script> -->
<script type="text/javascript" src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>ajax/view_transcript_ajax_function.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>