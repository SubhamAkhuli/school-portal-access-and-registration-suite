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

<div class="transcript-container">
    
</div>

<!-- Include the AJAX handler file -->
<script type="text/javascript"  src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>ajax/transcript_ajax_function.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>