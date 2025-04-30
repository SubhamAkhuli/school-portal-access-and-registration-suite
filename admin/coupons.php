<div class="container">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <div class="d-flex justify-content-end align-items-center mb-4">
                <button class="btn blue-btn px-4" data-bs-toggle="modal" data-bs-target="#add-coupon">
                    <i class="fas fa-plus-circle me-2"></i>Add Coupon
                </button>
            </div>
            <div class="">
                <table class="table table-hover table-striped coupons-table border w-100">
                    <thead class="text-white">
                        <tr>
                            <th class="text-center py-3">Coupon Code</th>
                            <th class="text-center py-3">Discount Value</th>
                            <th class="text-center py-3">Discount Type</th>
                            <th class="text-center py-3">Status</th>
                            <th class="text-center py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add coupon modal -->
<div class="modal fade" id="add-coupon" tabindex="-1" role="dialog" aria-labelledby="addCouponLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header" style="background-color: #456fb6; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-plus-circle fs-4 text-white me-2"></i>
                    <h5 class="modal-title text-white mb-0">Add New Coupon</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <form>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="new_coupon_code" class="form-label text-secondary fw-medium">
                                    <i class="fas fa-gift me-2"></i>Coupon Code:
                                </label>
                                <input type="text" id="new_coupon_code" class="form-control border-0 shadow-sm rounded-3" placeholder="Enter coupon code">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="new_discount" class="form-label text-secondary fw-medium">
                                    <i class="fa-solid fa-filter-circle-dollar me-2"></i>Discount Value:
                                </label>
                                <input type="number" id="new_discount" class="form-control border-0 shadow-sm rounded-3" min="0" max="100" placeholder="Enter discount">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="new_discount_type" class="form-label text-secondary fw-medium">
                                    <i class="fas fa-tag me-2"></i>Discount Type:
                                </label>
                                <select id="new_discount_type" class="form-select border-0 shadow-sm rounded-3">
                                    <option selected disabled value="-1">Select Discount Type</option>
                                    <option value="percentage">Percentage</option>
                                    <option value="amount">Fixed Amount</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-center gap-2 mt-4">
                                <button class="btn blue-btn px-4 rounded-3 shadow-sm" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn blue-btn px-4 rounded-3 shadow-sm" id="create_coupon">
                                    <i class="fas fa-save me-2"></i>Create Coupon
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit coupon modal -->
<div class="modal fade" id="edit-coupon" tabindex="-1" role="dialog" aria-labelledby="editCouponLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header" style="background-color: #456fb6; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-edit fs-4 text-white me-2"></i>
                    <h5 class="modal-title text-white mb-0">Edit Coupon</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <form>
                    <div class="row g-4">
                        <input type="hidden" id="edit_coupon_id" value="">
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_coupon_code" class="form-label text-secondary fw-medium">
                                    <i class="fas fa-gift me-2"></i>Coupon Code:
                                </label>
                                <input type="text" id="edit_coupon_code" class="form-control border-0 shadow-sm rounded-3" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_discount" class="form-label text-secondary fw-medium">
                                    <i class="fa-solid fa-filter-circle-dollar me-2"></i>Discount Value:
                                </label>
                                <input type="number" id="edit_discount" class="form-control border-0 shadow-sm rounded-3" min="0" max="100">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_discount_type" class="form-label text-secondary fw-medium">
                                    <i class="fas fa-tag me-2"></i>Discount Type:
                                </label>
                                <select id="edit_discount_type" class="form-select border-0 shadow-sm rounded-3">
                                    <option selected disabled value="-1">Select Discount Type</option>
                                    <option value="percentage">Percentage</option>
                                    <option value="amount">Fixed Amount</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_status" class="form-label text-secondary fw-medium">
                                    <i class="fas fa-toggle-on me-2"></i>Status:
                                </label>
                                <select id="edit_status" class="form-select border-0 shadow-sm rounded-3">
                                    <option value="active">Active</option>
                                    <option value="deactive">Deactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-center gap-2 mt-4">
                                <button class="btn blue-btn px-4 rounded-3 shadow-sm" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn blue-btn px-4 rounded-3 shadow-sm" id="update_coupon">
                                    <i class="fas fa-save me-2"></i>Update Coupon
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- <script src="<?php echo plugin_dir_url(__FILE__); ?>ajax/coupons_ajax_function.js"></script> -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>ajax/coupons_ajax_function.js"></script>