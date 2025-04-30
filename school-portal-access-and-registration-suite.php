<?php

/*
Plugin Name: School Portal Access & Registration Suite
Plugin URI: https://www.tscamerica.com
Description: A comprehensive WordPress plugin providing secure login, multi-step registration, and role-based access control for school portals. Includes parent and admin dashboards, student management, account renewal, and robust security features. Easily integrates with custom pages via shortcodes and supports AJAX-powered forms for a seamless user experience.
Version: 4.4.3
Author: TSCAmerica.com
License: GPL2
*/

// Secure and optimize page access and redirects
add_action('template_redirect', function() {
    // Helper: get current user and roles
    $user = wp_get_current_user();
    $user_id = get_current_user_id();
    $user_roles = (array) $user->roles;
    $user_status = get_user_meta($user_id, 'account_status', true);
    $user_account_expire = get_user_meta($user_id, 'account_expire', true);
    $registration_status = get_user_meta($user_id, 'registration_status', true);

    // Define admin and parent page slugs with corrected slugs
    $admin_pages = array(
        'settings', 'users', 'manage-coupons', 'transfer-students', 'graduate-students', 'view-attendance', 'transcript-editor',
        'transaction-data', 'view-classes', 'view-registration-details', 'view-students',
        'view-transcript', 'edit-student', 'view-portfolio'
    );
    $parent_pages = array(
        'dashboard', 'students', 'add-new-student', 'calendar', 'transaction', 'registrationdata',
        'attendance', 'transcripts', 'class', 'apply-to-graduate',
        'my-account', 'portfolio', 'links', 'account-renewal', 'student-renewal', 'suspend'
    );

    // Get current page slug
    global $wp;
    $current_slug = isset($wp->request) ? $wp->request : '';

    // 0. Prevent direct file access
    if (!defined('ABSPATH')) {
        exit;
    }

    // 1. Block access to admin pages for non-admins
    foreach ($admin_pages as $slug) {
        if (stripos($current_slug, $slug) !== false && !in_array('school_admin', $user_roles) && !in_array('administrator', $user_roles)) {
            // If not an admin, redirect to login page
            wp_safe_redirect(home_url('/login'));
            exit;
        }
    }

    // 2. Block access to parent portal for users with incomplete registration or unpaid
    if (is_user_logged_in() && !in_array('school_admin', $user_roles)) {
        // If registration is not complete or account is not active/paid, block parent pages
        if (
            ($registration_status !== 'complete' || $user_status !== 'active' || 
            (!empty($user_account_expire) && strtotime($user_account_expire) < current_time('timestamp')))
            && !is_page(array('registration', 'account-renewal', 'suspend', 'forget-password'))
        ) {
            // If on a parent page, redirect to registration or renewal
            foreach ($parent_pages as $slug) {
                if (stripos($current_slug, $slug) !== false) {
                    if ($registration_status !== 'complete') {
                        wp_safe_redirect(home_url('/registration'));
                    } elseif ($user_status !== 'active') {
                        wp_safe_redirect(home_url('/suspend'));
                    } elseif (!empty($user_account_expire) && strtotime($user_account_expire) < current_time('timestamp')) {
                        wp_safe_redirect(home_url('/account-renewal'));
                    } else {
                        wp_safe_redirect(home_url('/login'));
                    }
                    exit;
                }
            }
        }
    }

    // 3. Force login for all except login/forgot/registration/coming soon pages
    if (
        !is_user_logged_in() &&
        !is_page(array('login', 'forget-password', 'registration', 'coming-soon'))
    ) {
        wp_safe_redirect(home_url('/login'));
        exit;
    }

    // 4. If logged in and on login page, redirect to dashboard or students
    if (is_page('login') && is_user_logged_in()) {
        if (in_array('school_admin', $user_roles)) {
            wp_safe_redirect(home_url('/users'));
        } else {
            wp_safe_redirect(home_url('/students'));
        }
        exit;
    }

    // 5. If account suspended, redirect to suspend page
    if (
        is_user_logged_in() &&
        $user_status !== 'active' &&
        !is_page(array('suspend', 'forget-password', 'account-renewal')) &&
        !in_array('school_admin', $user_roles)
    ) {
        wp_safe_redirect(home_url('/suspend'));
        exit;
    }

    // 6. If account expired, redirect to renewal page
    if (
        is_user_logged_in() &&
        !empty($user_account_expire) &&
        strtotime($user_account_expire) < current_time('timestamp') &&
        !is_page(array('account-renewal', 'forget-password')) &&
        !in_array('school_admin', $user_roles)
    ) {
        wp_safe_redirect(home_url('/account-renewal'));
        exit;
    }

    // 7. If registration incomplete, block parent portal access
    if (
        is_user_logged_in() &&
        $registration_status !== 'complete' &&
        !is_page(array('registration', 'forget-password', 'coming-soon')) &&
        !in_array('school_admin', $user_roles)
    ) {
        wp_safe_redirect(home_url('/registration'));
        exit;
    }

    // 8. Prevent logged-in users from accessing registration or forgot password pages
    if (
        is_user_logged_in() &&
        (is_page('registration') || is_page('forget-password')) &&
        in_array($user_status, array('active')) &&
        $registration_status === 'complete'
    ) {
        if (in_array('school_admin', $user_roles)) {
            wp_safe_redirect(home_url('/users'));
        } else {
            wp_safe_redirect(home_url('/students'));
        }
        exit;
    }

    // 9. Prevent clickjacking by setting X-Frame-Options
    header('X-Frame-Options: SAMEORIGIN');

    // 10. Prevent content sniffing
    header('X-Content-Type-Options: nosniff');

    // 11. Set strict transport security if using HTTPS
    if (is_ssl()) {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
    }
});


// Shortcode for displaying the login forms
function paypal_payment_success(){
    // include the login form
    include plugin_dir_path(__FILE__) . 'thank-you.php';
}
add_shortcode('thank_you', 'paypal_payment_success');


// Shortcode for displaying the login forms
function login_forms(){
    // include the login form
    include plugin_dir_path(__FILE__) . 'login-form.php';
}
add_shortcode('school_login', 'login_forms');

// shortcode for displaying the full registration form
function full_registration_froms(){
    // inculde the registration form
    include plugin_dir_path(__FILE__) . 'registration-form.php';
}
add_shortcode('school_registration', 'full_registration_froms');

// shortcode for displaying the forgot password form
function forgot_password(){
    // include the forgot password form
    include plugin_dir_path(__FILE__) . 'forgetPassword.php';
}
add_shortcode('school_forgot_password', 'forgot_password');

// shortcode for displaying the incomplete pages
function empty_page(){
    // include the incomplete pages
    include plugin_dir_path(__FILE__) . 'empty_page.php';
}
add_shortcode('school_empty_page', 'empty_page');

// shortcode for displaying the suspend page 
function suspend(){
    // include the suspend page
    include plugin_dir_path(__FILE__) . '/parent/suspended.php';
}
add_shortcode('school_suspend', 'suspend');


// Admin Pages

// shortcode for displaying the Settings page
function settings(){
    // include the settings
    include plugin_dir_path(__FILE__) . '/admin/settings.php';
}
add_shortcode('school_admin_settings', 'settings');

// shortcode for displaying the Users page
function users(){
    // include the users
    include plugin_dir_path(__FILE__) . '/admin/users.php';
}
add_shortcode('school_users', 'users');

// shortcode for ADD/edit Coupons
function add_edit_coupons(){
    // include the add/edit coupons
    include plugin_dir_path(__FILE__) . '/admin/coupons.php';
}
add_shortcode('school_add_edit_coupons', 'add_edit_coupons');

// shortcode for New Transfer page
function new_transfer(){
    // include the new transfer
    include plugin_dir_path(__FILE__) . '/admin/newTransfer.php';
}
add_shortcode('school_new_transfer', 'new_transfer');

// shortcode for displaying the Graduate page
function graduate(){
    // include the graduate data
    include plugin_dir_path(__FILE__) . '/admin/graduateData.php';
}
add_shortcode('school_graduate', 'graduate');

// shortcode for displaying the Transcript Editor to admin
function transcript_editor(){
    // include the transcript editor
    include plugin_dir_path(__FILE__) . '/admin/transcriptEditor.php';
}
add_shortcode('school_transcript_editor', 'transcript_editor'); 

// shortcode for displaying the students Attendancedata to admin
function students_attendance(){
    // include the students attendance
    include plugin_dir_path(__FILE__) . '/admin/view_attendance.php';
}
add_shortcode('school_students_attendance', 'students_attendance'); 

// shortcode for displaying the transaction data
function transaction_data(){
    // include the transaction data
    include plugin_dir_path(__FILE__) . '/admin/transactionData.php';
}
add_shortcode('school_transaction_data', 'transaction_data'); // shortcode for displaying the transaction data

// shortcode for displaying the students classes to admin
function students_classes(){
    // include the students classes
    include plugin_dir_path(__FILE__) . '/admin/view_classes.php';
}
add_shortcode('school_students_classes', 'students_classes');

// shortcode for displaying the students registrationdata to admin
function students_registrationdata_admin(){
    // include the students registration data
    include plugin_dir_path(__FILE__) . '/admin/view_registrationData.php';
}
add_shortcode('school_students_registrationdata_admin', 'students_registrationdata_admin');

// shortcode for displaying the students per user
function view_students(){
    // include the students per user
    include plugin_dir_path(__FILE__) . '/admin/view_students.php';
}
add_shortcode('school_view_students', 'view_students');

// shortcode for displaying the students tarnscript per user
function view_transcript(){
    // include the students tarnscript per user
    include plugin_dir_path(__FILE__) . '/admin/view_transcript.php';
}
add_shortcode('school_view_transcript', 'view_transcript');

// shortcode for displaying the edit student page
function edit_student(){
    // include the edit student page
    include plugin_dir_path(__FILE__) . '/admin/edit-student.php';
}
add_shortcode('school_edit_student', 'edit_student');

// shortcode for displaying the view portfolio page
function view_portfolio(){
    // include the view portfolio page
    include plugin_dir_path(__FILE__) . '/admin/view_portfolio.php';
}
add_shortcode('school_view_portfolio', 'view_portfolio');



// Parent Pages

// shortcode for displaying the account renewal page
function account_renewal(){
    // include the account renewal page
    include plugin_dir_path(__FILE__) . '/parent/renewal_expire.php';
}
add_shortcode('school_account_renewal', 'account_renewal');

// shortcode for displaying the dashboard
function dashboard(){
    // include the dashboard
    include plugin_dir_path(__FILE__) . '/parent/dashboard.php';
}
add_shortcode('school_dashboard', 'dashboard');

// shortcode for displaying the students data
function students_data(){
    // include the students dashboard
    include plugin_dir_path(__FILE__) . '/parent/students.php';
}
add_shortcode('school_students_data', 'students_data');

// shortcode for Add a New Student
function student_add(){
    // include Add a Student 
    include plugin_dir_path(__FILE__) . '/parent/addNewStudent.php';
}
add_shortcode('school_student_add', 'student_add');

// shortcode for displaying the calendar
function calendar(){
    // include the calendar
    include plugin_dir_path(__FILE__) . '/parent/calendar.php';
}
add_shortcode('school_calendar', 'calendar');

// shortcode for displaying the transaction
function transaction(){
    // include the transaction
    include plugin_dir_path(__FILE__) . '/parent/transaction.php';
}
add_shortcode('school_transaction', 'transaction');

// shortcode for displaying the students registrationdata
function students_registrationdata(){
    // include the students dashboard
    include plugin_dir_path(__FILE__) . '/parent/registrationData.php';
}
add_shortcode('school_students_registrationdata', 'students_registrationdata');

// shortcode for displaying the student attendance
function student_attendance(){
    // include the student attendance
    include plugin_dir_path(__FILE__) . '/parent/attendance.php';
}
add_shortcode('school_student_attendance', 'student_attendance');

// shortcode for displaying the student Transcript
function student_transcript(){
    // include the student Transcript
    include plugin_dir_path(__FILE__) . '/parent/transcript.php';
}
add_shortcode('school_student_transcript', 'student_transcript');

// shortcode for displaying the student classes
function student_classes(){
    // include the student classes
    include plugin_dir_path(__FILE__) . '/parent/classes.php';
}
add_shortcode('school_student_classes', 'student_classes');

// shortcode for Student Apply to Graduate page
function student_apply_to_graduate(){
    // include the student Apply to Graduate page
    include plugin_dir_path(__FILE__) . '/parent/applyToGraduate.php';
}
add_shortcode('school_student_apply_to_graduate', 'student_apply_to_graduate');

// shortcode for displaying the student my account
function student_my_account(){
    // include the student my account
    include plugin_dir_path(__FILE__) . '/parent/my-account.php';
}
add_shortcode('school_student_my_account', 'student_my_account');

// shortcode for displaying portfolio page
function student_portfolio(){
    // include the student portfolio
    include plugin_dir_path(__FILE__) . '/parent/portfolio.php';
}
add_shortcode('school_student_portfolio', 'student_portfolio');

// shortcode for displaying links page
function links_page(){
    // include the links page
    include plugin_dir_path(__FILE__) . '/parent/link-page.php';
}
add_shortcode('school_links_page', 'links_page');

// shortCode for displaying the Coming Soon page
function coming_soon(){
    // include the coming soon page
    include plugin_dir_path(__FILE__) . 'coming_soon.php';
}
add_shortcode('school_coming_soon', 'coming_soon'); 

// shortcode for displaying the student renewal page
function student_renewal(){
    // include the student renewal page
    include plugin_dir_path(__FILE__) . '/parent/renewal.php';
}
add_shortcode('school_student_renewal', 'student_renewal');

// Enqueue scripts and styles
function school_forms_enqueue_scripts() {
    // Styles
    wp_enqueue_style('school-forms-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    // wp_enqueue_style('school-forms-style', plugins_url('css/login_form.css', __FILE__));
    wp_enqueue_style('font-awesome-6', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
    // wp_enqueue_style('montserrat-font', 'https://fonts.googleapis.com/css?family=Montserrat');
    // wp_enqueue_style('roboto-font', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    // wp_enqueue_style('hind-font', 'https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&display=swap');

    wp_enqueue_style('roboto-font', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');
    wp_enqueue_style('calendar-font', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=edit_calendar');
    wp_enqueue_style('parent-dashboard', plugins_url('css/parent_pages.css', __FILE__));
    // trasncript Page Css
    wp_enqueue_style('transcript-css', plugins_url('css/transcript.css', __FILE__));
    wp_enqueue_style('fullcalendar', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css');
    wp_enqueue_style('datatables-css', 'https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css');

    // Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('sweetalert', 'https://unpkg.com/sweetalert/dist/sweetalert.min.js', array('jquery'), null, true);
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_script('custom-jquery', plugins_url('js/jquery-3.3.1.min.js', __FILE__), array('jquery'), null, true);

    // Calendar
    wp_enqueue_script('calendar-js', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js', array('jquery'), null, true);
    wp_enqueue_script('add-to-calendar-button', 'https://cdn.jsdelivr.net/npm/add-to-calendar-button@2', array('jquery'), null, true);
    wp_enqueue_script('moment-js', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js', array('jquery'), null, true);
    wp_enqueue_script('datatables-js', 'https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js', array('jquery'), null, true);

    wp_enqueue_script('jquery-3.5.1', 'https://code.jquery.com/jquery-3.5.1.min.js');
    wp_enqueue_script('common-js', plugins_url('js/common.js', __FILE__), array('jquery'), null, true);

    wp_enqueue_script('jquery');
    wp_enqueue_script('wp-util'); // Ensures WordPress utilities are loaded
    wp_enqueue_script('editor');
    wp_enqueue_script('quicktags');
    wp_enqueue_script('tiny_mce', includes_url('js/tinymce/tinymce.min.js'));

    wp_enqueue_style('thickbox');
}
add_action('wp_enqueue_scripts', 'school_forms_enqueue_scripts');

// Include the AJAX handler file
require_once plugin_dir_path(__FILE__) . 'ajax-handler.php';
// require_once plugin_dir_path(__FILE__) . 'temporary-ajax-handler.php';

// Enqueue scripts for AJAX handling it for all ajax call
function all_ajax_enqueue_scripts() {
    // For login and crete account
    wp_enqueue_script('ajax-script', plugins_url('ajax/login_ajax_function.js', __FILE__), array('jquery'), null, true);
    wp_localize_script('ajax-script', 'ajax_object', array(
        'base_url' => plugins_url('/', __FILE__), // plugin base url
        'ajax_url' => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce('ajax_nonce')
    ));
    // For registration
    wp_enqueue_script('ajax-script', plugins_url('ajax/registration_ajax_function.js', __FILE__), array('jquery'), null, true);
    wp_localize_script('ajax-script', 'ajax_object', array(
        'base_url' => plugins_url('/', __FILE__), // plugin base url
        'ajax_url' => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce('ajax_nonce')
    ));

    // For admin dashboard
    wp_enqueue_script('ajax-script', plugins_url('ajax/admin_ajax_function.js', __FILE__), array('jquery'), null, true);
    wp_localize_script('ajax-script', 'ajax_object', array(
        'base_url' => plugins_url('/', __FILE__), // plugin base url
        'ajax_url' => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce('ajax_nonce')
    ));

    // for students registration data
    wp_enqueue_script('ajax-script', plugins_url('ajax/students_ajax_function.js', __FILE__), array('jquery'), null, true);
    wp_localize_script('ajax-script', 'ajax_object', array(
        'base_url' => plugins_url('/', __FILE__), // plugin base url
        'ajax_url' => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce('ajax_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'all_ajax_enqueue_scripts');

function hide_admin_bar_for_students($show_admin_bar) {
    // Get the current user
    $current_user = wp_get_current_user();

    // Check if the user has the 'student' role
    if (in_array('student', (array) $current_user->roles) or in_array('school_admin', (array) $current_user->roles)) {
        return false;
    }

    return $show_admin_bar;
}
add_filter('show_admin_bar', 'hide_admin_bar_for_students');


add_filter('theme_page_templates', 'register_custom_template');
add_filter('template_include', 'load_custom_template');

function register_custom_template($templates) {
    $templates['page-sidebar-template.php'] = __('Sidebar Template', 'text-domain');
    return $templates;
}

function load_custom_template($template) {
    if (is_page_template('page-sidebar-template.php')) {
        $custom_template = plugin_dir_path(__FILE__) . 'page-sidebar-template.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    return $template;
}

// Include the PayPal payment handler file
require_once plugin_dir_path(__FILE__) . 'create-paypal-payment-handler.php';