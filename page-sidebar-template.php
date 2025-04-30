<?php
/**
 * Template Name: Sidebar Template
 * Description: A custom template with a sidebar.
 */

get_header('dashboard'); 

if(is_user_logged_in()) {
    $user = wp_get_current_user();
    $roles = $user->roles;
    $role = $roles[0];
}
?>

<div class="dash-container flex-column flex-md-row" id="wrapper">
    <?php 
    if($role == 'school_admin' || $role == 'administrator') {
        include 'admin/admin-sidebar.php';
    } else {
        include 'parent/sidebar.php';
    }
     ?>
    <!-- Main Content Area -->
    <div class="main-content" id="page-content-wrapper">
        <?php 
        if($role == 'school_admin' || $role == 'administrator') {
            include 'admin/admin-titlebar.php';
        } else {
            include 'parent/titlebar.php';
        }
        
        ?>

        <div class="dashboard">
            <?php
                // Start the Loop.
                the_content();
            ?>
        </div><!-- #main -->
        
        <?php get_footer(); ?>

    </div><!-- #primary -->
</div>

<style type="text/css">
    .emoji {
        max-width: 40px;
    }
</style>
