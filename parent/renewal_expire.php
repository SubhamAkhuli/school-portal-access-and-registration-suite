<div class="container">
    <div class="card shadow">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <i class="fas fa-calendar-times text-danger mb-3" style="font-size: 3rem;"></i>
                <h1 class="fw-bold text-primary">Your Account Has Expired</h1>
                <p class="lead text-muted">Please renew your subscription to continue accessing your account</p>
                <div class="alert alert-danger d-inline-block px-4 py-2 mb-3" id="expiry-date">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Expired on: <strong >YYYY-MM-DD</strong>
                </div>
                <hr class="my-4">
            </div> 
            <div class="text-center mt-5">
                <div class="alert alert-warning p-3">
                    <h4 class="fw-bold"><i class="fas fa-exclamation-circle me-2"></i>Don't miss out on your children's progress!</h4>
                </div>
                
                <button class="btn btn-primary btn-lg mt-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#renewModal">
                    <i class="fas fa-sync-alt me-2"></i>Renew Subscription Now
                </button>
            
                <div class="mt-4 p-3 border-top">
                    <p class="text-muted">Need help? Contact our support team.</p>
                    <div class="d-flex justify-content-center align-items-center">    
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        <a href="mailto:support@graduatesacademy.com" class="text-decoration-none text-primary">support@graduatesacademy.com</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <!-- Renew Registration Modal -->
    <div class="modal fade" id="renewModal" tabindex="-1" aria-labelledby="renewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header" style="background-color: #456fb6; color: white;">
                    <h5 class="modal-title" id="renewModalLabel">
                        <i class="fas fa-user-graduate me-2"></i>Select Students for Registration Renewal
                    </h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="student-renew-list">
                        <!-- Student items with checkboxes will be loaded dynamically -->
                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-1 pb-3">
                    <button class="btn btn-primary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button class="btn blue-btn" id="renewRegistration" onclick="renewRegistration()" aria-label="Renew registration button">
                        Continue to Renewal
                    </button>
                </div>
            </div> 
        </div>
    </div> 
</div>

<script type="text/javascript" src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>ajax/renewal_expire_function_ajax.js"></script>