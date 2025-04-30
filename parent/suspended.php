<div class="container-fluid bg-light d-flex justify-content-center align-items-center overflow-hidden" style="min-height: 67vh;">
    <div class="text-center p-4 bg-white rounded shadow-lg" style="max-width: 90%;">
        <div class="mb-3">
            <i class="fas fa-lock text-danger display-4"></i>
        </div>
        <h1 class="mb-3 fw-bold text-dark">Your Account Has Been Suspended</h1>
        <p class="mb-2 text-muted">Please contact support for further assistance.</p>
        <p class="mb-3">
            <i class="fas fa-envelope me-2"></i>
            <a href="mailto:support@graduatesacademy.com" class="text-decoration-none">support@graduatesacademy.com</a>
        </p>
        <a href="<?php echo wp_logout_url(home_url()); ?>" class="btn btn-primary btn-lg px-4 shadow-sm hover-lift">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>
</div>
