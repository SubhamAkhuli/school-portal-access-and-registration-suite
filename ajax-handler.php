<?php

use phpspreadsheet\vendor\PhpOffice\PhpSpreadsheet\Spreadsheet;
use phpspreadsheet\vendor\PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create necessary tables for school registration
function create_school_registration_tables() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    // School registration table
    $registration_table = $wpdb->prefix . 'tsc_school_registration';
    $sql1 = "CREATE TABLE IF NOT EXISTS $registration_table (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('school_admin', 'student') NOT NULL,
        status ENUM('create', 'processing', 'complete') NOT NULL DEFAULT 'create',
        password_reset_code VARCHAR(50),
        password_reset_time DATETIME,
        renewal_by_admin ENUM('yes', 'no') NOT NULL DEFAULT 'no',
        account_expire  DATE,
        submitted_at DATETIME NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    // Parent registration table
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';
    $sql2 = "CREATE TABLE IF NOT EXISTS $parent_table (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        registration_id BIGINT(20) UNSIGNED NOT NULL,
        type VARCHAR(50) NOT NULL,
        role VARCHAR(50) NOT NULL,
        first_name VARCHAR(100) NOT NULL,
        middle_name VARCHAR(100),
        last_name VARCHAR(100) NOT NULL,
        country_code VARCHAR(5),
        phone VARCHAR(20) NOT NULL,
        email VARCHAR(255) NOT NULL,
        year_paying VARCHAR(10),
        heard_about_us VARCHAR(50),
        profile_image VARCHAR(255),
        questions JSON NOT NULL,
        submitted_at DATETIME NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (registration_id) REFERENCES {$wpdb->prefix}tsc_school_registration(id)
    ) $charset_collate;";

    // Additional information table
    $additional_info_table = $wpdb->prefix . 'tsc_additional_information';
    $sql3 = "CREATE TABLE IF NOT EXISTS $additional_info_table (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        registration_id BIGINT(20) UNSIGNED NOT NULL,
        questions LONGTEXT NOT NULL,
        submitted_at DATETIME NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (registration_id) REFERENCES {$wpdb->prefix}tsc_school_registration(id)
    ) $charset_collate;";

    // Student application table
    $student_application_table = $wpdb->prefix . 'tsc_student_application';
    $sql4 = "CREATE TABLE IF NOT EXISTS $student_application_table (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        registration_id BIGINT(20) UNSIGNED NOT NULL,
        questions LONGTEXT NOT NULL,
        submitted_at DATETIME NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (registration_id) REFERENCES {$wpdb->prefix}tsc_school_registration(id)
    ) $charset_collate;";

    // parent address table
    $parent_address_table = $wpdb->prefix . 'tsc_parent_address';
    $sql5 = "CREATE TABLE IF NOT EXISTS $parent_address_table (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        registration_id BIGINT(20) UNSIGNED NOT NULL,
        address VARCHAR(255) NOT NULL,
        city VARCHAR(100) NOT NULL,
        state VARCHAR(100) NOT NULL,
        zip VARCHAR(10) NOT NULL,
        county VARCHAR(100) NOT NULL,
        emg_contact_name VARCHAR(100) NOT NULL,
        country_code VARCHAR(5),
        emg_contact_phone VARCHAR(20) NOT NULL,
        submitted_at DATETIME NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (registration_id) REFERENCES {$wpdb->prefix}tsc_school_registration(id)
    ) $charset_collate;";

    // Coupon codes table
    $coupon_codes_table = $wpdb->prefix . 'tsc_coupon_codes';
    $sql6 = "CREATE TABLE IF NOT EXISTS $coupon_codes_table (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        code VARCHAR(50) NOT NULL UNIQUE,
        discount INT NOT NULL,
        discount_type ENUM('percentage', 'amount') NOT NULL DEFAULT 'percentage',
        status ENUM('active', 'deactive') NOT NULL DEFAULT 'active',
        use_list json NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    // Student table
    $student_table = $wpdb->prefix . 'tsc_student_information';
    $sql7 = "CREATE TABLE IF NOT EXISTS $student_table (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        registration_id BIGINT(20) UNSIGNED NOT NULL,
        student VARCHAR(50) NOT NULL,
        registration_status ENUM('create', 'processing', 'complete') NOT NULL DEFAULT 'create',
        first_name VARCHAR(100) NOT NULL,
        middle_name VARCHAR(100),
        last_name VARCHAR(100) NOT NULL,
        dob VARCHAR(50) NOT NULL,
        age INT NOT NULL,
        year_paying VARCHAR(10),
        grade VARCHAR(50) NOT NULL,
        country VARCHAR(100) NOT NULL,
        county VARCHAR(100) NOT NULL,
        state VARCHAR(100) NOT NULL,
        gender VARCHAR(10) NOT NULL,
        coop_name VARCHAR(255) NULL,
        immunization_file_name VARCHAR(255),
        immunization_file_url VARCHAR(255),
        student_profile_pic VARCHAR(255),
        questions JSON NOT NULL,
        student_transfer JSON,
        student_course JSON,
        digital_signature JSON,
        priority ENUM('high', 'low') NOT NULL DEFAULT 'low',
        transaction_id VARCHAR(50),
        paid_amount FLOAT,
        used_coupon_code VARCHAR(50),
        account_expire DATE,
        submitted_at DATETIME NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (registration_id) REFERENCES {$wpdb->prefix}tsc_school_registration(id)
    ) $charset_collate;";

    // student attendance table
    $student_attendance_table = $wpdb->prefix . 'tsc_students_attendance';
    $sql8 = "CREATE TABLE IF NOT EXISTS $student_attendance_table (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        registration_id BIGINT(20) UNSIGNED NOT NULL,
        student_id BIGINT(20) UNSIGNED NOT NULL,
        year VARCHAR(10) NOT NULL,
        fall_semester INT(3) NOT NULL,
        spring_semester INT(3) NOT NULL,
        summer_semester INT(3) NOT NULL,
        created_at DATETIME NOT NULL,
        updated_at DATETIME NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (student_id) REFERENCES {$wpdb->prefix}tsc_student_information(id),
        FOREIGN KEY (registration_id) REFERENCES {$wpdb->prefix}tsc_school_registration(id)
    ) $charset_collate;";

    // student transaction table
    $student_transaction_table = $wpdb->prefix . 'tsc_transaction';
    $sql9 = "CREATE TABLE IF NOT EXISTS $student_transaction_table (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        registration_id BIGINT(20) UNSIGNED NOT NULL,
        transaction_id VARCHAR(50) NOT NULL,
        description VARCHAR(255) NOT NULL,
        amount FLOAT NOT NULL,
        transactionItems JSON NOT NULL,
        expires_at DATE,
        created_at DATETIME NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (registration_id) REFERENCES {$wpdb->prefix}tsc_school_registration(id)
    ) $charset_collate;";

    // Calendar event data table
    $events_table = $wpdb->prefix . 'tsc_custom_events';
    $sql10 = "CREATE TABLE IF NOT EXISTS $events_table (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        registration_id BIGINT(20) UNSIGNED NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        class_schedule VARCHAR(100) DEFAULT NULL,
        start_date DATE NOT NULL,
        end_date DATE NOT NULL,
        start_time TIME NOT NULL,
        end_time TIME NOT NULL,
        color VARCHAR(7) DEFAULT '#3788d8',
        recurrence VARCHAR(255),
        custom_interval INT,
        custom_frequency VARCHAR(50),
        source VARCHAR(50) DEFAULT 'custom',
        hidden tinyint(1) DEFAULT '0',
        PRIMARY KEY (id),
        FOREIGN KEY (registration_id) REFERENCES {$wpdb->prefix}tsc_school_registration(id)
    ) $charset_collate;";

    // Graduate Student table
    $graduate_student_table = $wpdb->prefix . 'tsc_graduate_student';
    $sql11 = "CREATE TABLE IF NOT EXISTS $graduate_student_table (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        registration_id BIGINT(20) UNSIGNED NOT NULL,
        student_id BIGINT(20) UNSIGNED NOT NULL,
        student_name VARCHAR(200) NOT NULL,
        graduate_data JSON NOT NULL,
        status ENUM('approved', 'applied', 'pending', 'rejected') NOT NULL DEFAULT 'pending',
        transaction_id VARCHAR(50),
        paid_amount FLOAT,
        reject_reason TEXT,
        submitted_at DATETIME NOT NULL,
        updated_at DATETIME NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (student_id) REFERENCES {$wpdb->prefix}tsc_student_information(id),
        FOREIGN KEY (registration_id) REFERENCES {$wpdb->prefix}tsc_school_registration(id)
    ) $charset_collate;";

    // Portfolio table
    $portfolio_table = $wpdb->prefix . 'tsc_student_portfolio';
    $sql12 = "CREATE TABLE IF NOT EXISTS $portfolio_table (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        registration_id BIGINT(20) UNSIGNED NOT NULL,
        student_id BIGINT(20) UNSIGNED NOT NULL,
        student_name VARCHAR(200) NOT NULL,
        document_type VARCHAR(50) NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        document_name VARCHAR(255) NOT NULL,
        document_url VARCHAR(255) NOT NULL,
        submitted_at DATETIME NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (student_id) REFERENCES {$wpdb->prefix}tsc_student_information(id),
        FOREIGN KEY (registration_id) REFERENCES {$wpdb->prefix}tsc_school_registration(id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql1);
    dbDelta($sql2);
    dbDelta($sql3);
    dbDelta($sql4);
    dbDelta($sql5);
    dbDelta($sql6);
    dbDelta($sql7);
    dbDelta($sql8);
    dbDelta($sql9);
    dbDelta($sql10);
    dbDelta($sql11);
    dbDelta($sql12);
}
add_action('init', 'create_school_registration_tables');

// Register a new user
function ajax_handle_register() {
    global $wpdb;
    $table = $wpdb->prefix . 'tsc_school_registration';

    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $confirm_password = sanitize_text_field($_POST['confirm_password']);

    // Check if the user is already logged in
    if (is_user_logged_in()) {
        wp_safe_redirect(home_url('/dashboard')); // Redirect logged-in users to the dashboard
        exit;
    }

    if (empty($email) || empty($password) || empty($confirm_password)) {
        wp_send_json_error(['success' => false, 'message' => 'All fields are required.']);
    } elseif (!is_email($email)) {
        wp_send_json_error(['success' => false, 'message' => 'Invalid email address.']);
    } elseif (email_exists($email)) {
        wp_send_json_error(['success' => false, 'message' => 'Email already in use. Please login under Member Login.']);
    } elseif ($password !== $confirm_password) {
        wp_send_json_error(['success' => false, 'message' => 'Passwords do not match.']);
    } else {
        $email_check = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table WHERE email = %s", $email));
        if ($email_check) {
            wp_send_json_error(['success' => false, 'message' => 'Email already in use. Please login under Member Login.']);
        } else {
            // Create the user
            $user_id = wp_create_user($email, $password, $email);

            update_user_meta($user_id, 'registration_status', 'create');
            update_user_meta($user_id, 'account_status', 'active');

            // add user to the school registration table
            // encrypt password
            $password = wp_hash_password($password);
            $data = [
                'email' => $email,
                'password' => $password,
                'role' => 'student',
                'submitted_at' => current_time('mysql'),
            ];
            $inserted = $wpdb->insert($table, $data);
            
            if (!is_wp_error($user_id) && $inserted) {
                // Set the role to 'student'
                $user = new WP_User($user_id);
                $user->set_role('student');
                
                // Log the user in
                wp_set_current_user($user_id);
                wp_set_auth_cookie($user_id);

                // add subscriber to MailerLite
                $result = add_mailerlite_subscriber($email);
                
                // Redirect to a specific page after registration
                // wp_safe_redirect(home_url('/dashboard')); // Change '/dashboard' to your desired URL
                if (is_wp_error($result)) {
                    wp_send_json_error(['success' => false, 'message' => 'Registration successful but failed to add subscriber to MailerLite.', 'error' => $result->get_error_message()]);
                }
                wp_send_json_success([
                    'success' => true,
                    'message' => 'Registration successful.',
                    'redirect_url' => home_url('/registration')
                ]);
                exit;
            } else {
                wp_send_json_error(['success' => false, 'message' => $user_id->get_error_message()]);
            }
        }
    }

    // $email_check = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table WHERE email = %s", $email));
    // if ($email_check) {
    //     wp_send_json_error(['success' => false, 'message' => 'Email already exists.']);
    // } else {
    //     $data = [
    //         'email' => $email,
    //         'password' => $password,
    //         'role' => 'parent',
    //         'submitted_at' => current_time('mysql'),
    //     ];
    //     $inserted = $wpdb->insert($table, $data);
    //     if ($inserted) {
    //         wp_send_json_success([
    //             'success' => true,
    //             'message' => 'Registration successful.',
    //             'redirect_url' => home_url('/registration/?rid=' . $wpdb->insert_id)
    //         ]);
    //     } else {
    //         wp_send_json_error(['success' => false, 'message' => 'Registration failed.']);
    //     }
    // }
}
add_action('wp_ajax_nopriv_ajax_handle_register', 'ajax_handle_register');
add_action('wp_ajax_ajax_handle_register', 'ajax_handle_register');

// Parent registration
function ajax_handle_parent_registration() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found. '));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $role = sanitize_text_field($_POST['role']);
    $type = sanitize_text_field($_POST['type']);
    $f_name = sanitize_text_field($_POST['f_name']);
    $m_name = sanitize_text_field($_POST['m_name']);
    $l_name = sanitize_text_field($_POST['l_name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $country_code = sanitize_text_field($_POST['country_code']);
    $year_paying = isset($_POST['yearPaying']) ? sanitize_text_field($_POST['yearPaying']) : '';
    $heard_about_us = isset($_POST['heardAboutUs']) ? sanitize_text_field($_POST['heardAboutUs']) : '';
    $parent_data = json_decode(stripslashes($_POST['parent_data']), true);
    $table = $wpdb->prefix . 'tsc_parent_registration';

    $data = [
        'registration_id' => $registration_id,
        'type' => $type,
        'role' => $role,
        'first_name' => $f_name,
        'middle_name' => $m_name,
        'last_name' => $l_name,
        'phone' => $phone,
        'country_code' => $country_code,
        'email' => $email,
        'year_paying' => $year_paying,
        'heard_about_us' => $heard_about_us,
        'questions' => wp_json_encode($parent_data),
        'submitted_at' => current_time('mysql'),
    ];

    $check = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM $table WHERE registration_id = %d AND type = %s",
        $registration_id,
        $type
    ));

    if ($check) {
        $inserted = $wpdb->update($table, $data, ['id' => $check]);
    } else {
        $inserted = $wpdb->insert($table, $data);

        // // Add parent contact details to ManyChat subscriber list
        // $first_name = $f_name + $m_name;
        // $last_name = $l_name;
        // $phone = $phone;
        // $email = $email;
        // $result = add_phone_to_manychat($email, $phone, $first_name, $last_name);
        
    }

    if ($inserted !== false) {
        $wpdb->update($wpdb->prefix . 'tsc_school_registration', ['status' => 'processing'], ['id' => $registration_id]);
        // set user registration_status to processing
        update_user_meta($registration_id, 'registration_status', 'processing');
        wp_send_json_success(['success' => true, 'message' => 'Parent registration successful.']);
    } else {
        wp_send_json_error(['success' => false, 'message' => 'Registration failed.', 'error' => $wpdb->last_error]);
    }
}
add_action('wp_ajax_nopriv_ajax_handle_parent_registration', 'ajax_handle_parent_registration');
add_action('wp_ajax_ajax_handle_parent_registration', 'ajax_handle_parent_registration');

// Additional information
function ajax_handle_additional_info() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $additional_info_data = json_decode(stripslashes($_POST['additional_info_data']), true);
    $table = $wpdb->prefix . 'tsc_additional_information';

    $data = [
        'registration_id' => $registration_id,
        'questions' => wp_json_encode($additional_info_data),
        'submitted_at' => current_time('mysql'),
    ];

    $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d", $registration_id));
    if ($check) {
        $inserted = $wpdb->update($table, $data, ['id' => $check]);
    } else {
        $inserted = $wpdb->insert($table, $data);
    }

    if ($inserted) {
        wp_send_json_success(['success' => true, 'message' => 'Additional information saved successfully.']);
    } else {
        wp_send_json_error(['success' => false, 'message' => 'Failed to save additional information.', 'error' => $wpdb->last_error]);
    }
}
add_action('wp_ajax_nopriv_ajax_handle_additional_info', 'ajax_handle_additional_info');
add_action('wp_ajax_ajax_handle_additional_info', 'ajax_handle_additional_info');

// Student application
function ajax_handle_student_application() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $student_data = json_decode(stripslashes($_POST['student_application']), true);
    $table = $wpdb->prefix . 'tsc_student_application';

    $data = [
        'registration_id' => $registration_id,
        'questions' => wp_json_encode($student_data),
        'submitted_at' => current_time('mysql'),
    ];

    $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d", $registration_id));
    if ($check) {
        $inserted = $wpdb->update($table, $data, ['id' => $check]);
    } else {
        $inserted = $wpdb->insert($table, $data);
    }

    if ($inserted) {
        wp_send_json_success(['success' => true, 'message' => 'Student application saved successfully.']);
    } else {
        wp_send_json_error(['success' => false, 'message' => 'Failed to save student application.', 'error' => $wpdb->last_error]);
    }
}
add_action('wp_ajax_nopriv_ajax_handle_student_application', 'ajax_handle_student_application');
add_action('wp_ajax_ajax_handle_student_application', 'ajax_handle_student_application');

// Parent address
function ajax_handle_parent_address() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $address = sanitize_text_field($_POST['street_address']);
    $city = sanitize_text_field($_POST['city']);
    $state = sanitize_text_field($_POST['state']);
    $zip = sanitize_text_field($_POST['zip_code']);
    $county = sanitize_text_field($_POST['county']);
    $emg_contact_name = sanitize_text_field($_POST['emergency_name']);
    $emg_contact_phone = sanitize_text_field($_POST['emergency_number']);
    $country_code = sanitize_text_field($_POST['country_code']);
    $table = $wpdb->prefix . 'tsc_parent_address';
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';

    $data = [
        'registration_id' => $registration_id,
        'address' => $address,
        'city' => $city,
        'state' => $state,
        'zip' => $zip,
        'county' => $county,
        'emg_contact_name' => $emg_contact_name,
        'emg_contact_phone' => $emg_contact_phone,
        'country_code' => $country_code,
        'submitted_at' => current_time('mysql'),
    ];

    $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d", $registration_id));
    if ($check) {
        $inserted = $wpdb->update($table, $data, ['id' => $check]);
    } else {
        $inserted = $wpdb->insert($table, $data);

        // get email of the user
        $user = get_userdata($registration_id);
        $email = $user->user_email;

        // get parent data
        $parent_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $parent_table WHERE registration_id = %d", $registration_id));
        $f_name = $parent_data->first_name;
        $m_name = $parent_data->middle_name;
        $l_name = $parent_data->last_name;
        $phone = $parent_data->phone;


        // After successful insert, add subscriber to MailerLite
        $name = $f_name . ' ' . $m_name . ' ' . $l_name;
        $mailerlite_data = array(
            "email" => $email,
            "status" => "active", 
            "source" => "api",
            "fields" => array(
                "name" => $name,
                "phone" => preg_replace('/[^0-9]/', '', $phone),
                "country" => "United States",
                "state" => $state,
                "city" => $city,
                "z_i_p" => $zip
            ),
            "groups" => array(
                "142520461172934445" 
            )
        );

        $mailerlite_response = wp_remote_post('https://connect.mailerlite.com/api/subscribers', array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiM2M3OGVkMzQ5NGU1MGU3M2E2MmUxNGU5MmMwZWM4Y2Y4N2MyOWFhNGIwNzJiYmQ4YTUzMmE5MmY4NGQ5M2Y2YzIxMjAyZWQyM2MwNzcyMjMiLCJpYXQiOjE3MzU5MTQ4NjUuOTYwMzg5LCJuYmYiOjE3MzU5MTQ4NjUuOTYwMzkzLCJleHAiOjQ4OTE1ODg0NjUuOTU1NTIzLCJzdWIiOiIxMjY5Njg1Iiwic2NvcGVzIjpbXX0.KlDowxEIFhBvCt93nLkYahy0MuxV0Gb2Dz8sxkArXlr3vw9DkQhRhkPbJYuBbmNzxtDcOBmqKhOldW37TTwX5u5VXfKTPBpEk-ARJg6DYQKhifFj_sQiDOMMuY44hMFCigxMkFwwCad_Hyqr0HkCXe2gv4eQSrXiy5LA07x0GuArkJPlWl29GO8uOQW9rS3wVyo2wjt-IrGSKybN1nuMEIKKuNO7zYb5o7K7HzaEqSNe7OT63k2EqVnhS9WwkBHheKWmF-XnfEP8zWAzXHzIW2-uP1j9Hi3mKK_HmyXWzH15fuoysXbyeed0TgBFI7BkRwsIM3Oy0OfNlr8zQ8LoAFqe_RCvcp8fiEFGeCnRebIMF5DY-Sb21Ohfuf1M-23hrvf4o5utwE_Mzda3ZUl6IgMlsOQqJYnMZy966lr0DaxRVPi-umhWbEVBWYbrXkQyt_PUTGxMdpegxg-QjdHv0DU-uiCIbnYR36mAH16NcJ2xfokLAF7mD_B3lHRY5fH72nzoKYYNSdV-NkcfaNyv9kAQs-YAs7GOoinCMwPW_8vGe9WJ2azfSnj4cCqGSvDiRfxKQ6Lh-yckE3jmfEivhXTygmV1BlOuH99dA-Wxef_awB6B_iIDI8qIG80LMn2vDhxV1jBuREZolJ2-R5336ZIxQXPEAeTjk2OW3ukrF_g'
            ),
            'body' => json_encode($mailerlite_data),
            'method' => 'POST',
            'data_format' => 'body'
        ));

        if (is_wp_error($mailerlite_response)) {
            wp_send_json_error(['success' => false, 'message' => 'Failed to add subscriber to MailerLite.', 'error' => $mailerlite_response->get_error_message()]);
        }
    }

    if ($inserted) {
        wp_send_json_success(['success' => true, 'message' => 'Parent address saved successfully.', 'email' => $email]);
    } else {
        wp_send_json_error(['success' => false, 'message' => 'Failed to save parent address.', 'error' => $wpdb->last_error]);
    }
}
add_action('wp_ajax_nopriv_ajax_handle_parent_address', 'ajax_handle_parent_address');
add_action('wp_ajax_ajax_handle_parent_address', 'ajax_handle_parent_address');

// For Add parent contact details to ManyChat subscriber list
function add_phone_to_manychat($email, $phone, $first_name, $last_name) {

    $url = 'https://api.manychat.com/fb/subscriber/createSubscriber';
    $api_key = '';  // Replace with your ManyChat API key
    $headers = [
        'accept' => 'application/json',
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . $api_key,
    ];
    $body = [
        'phone' => strval($phone),
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'has_opt_in_sms' => true,
        'has_opt_in_email' => true
    ];

    $response = wp_remote_post($url, [
        'headers' => $headers,
        'body' => json_encode($body),
    ]);

    if (is_wp_error($response)) {
        return false;
    }

    $response_body = json_decode(wp_remote_retrieve_body($response), true);

    if (isset($response_body['error'])) {
        return false;
    }

    return true;
}

// Add subscriber to MailerLite
function add_mailerlite_subscriber($email) {
    $api_url = 'https://connect.mailerlite.com/api/subscribers';
   //put api key 
    $api_key = '.eyJhdWQiOiI0IiwianRpIjoiM2M3OGVkMzQ5NGU1MGU3M2E2MmUxNGU5MmMwZWM4Y2Y4N2MyOWFhNGIwNzJiYmQ4YTUzMmE5MmY4NGQ5M2Y2YzIxMjAyZWQyM2MwNzcyMjMiLCJpYXQiOjE3MzU5MTQ4NjUuOTYwMzg5LCJuYmYiOjE3MzU5MTQ4NjUuOTYwMzkzLCJleHAiOjQ4OTE1ODg0NjUuOTU1NTIzLCJzdWIiOiIxMjY5Njg1Iiwic2NvcGVzIjpbXX0.KlDowxEIFhBvCt93nLkYahy0MuxV0Gb2Dz8sxkArXlr3vw9DkQhRhkPbJYuBbmNzxtDcOBmqKhOldW37TTwX5u5VXfKTPBpEk-ARJg6DYQKhifFj_sQiDOMMuY44hMFCigxMkFwwCad_Hyqr0HkCXe2gv4eQSrXiy5LA07x0GuArkJPlWl29GO8uOQW9rS3wVyo2wjt-IrGSKybN1nuMEIKKuNO7zYb5o7K7HzaEqSNe7OT63k2EqVnhS9WwkBHheKWmF-XnfEP8zWAzXHzIW2-uP1j9Hi3mKK_HmyXWzH15fuoysXbyeed0TgBFI7BkRwsIM3Oy0OfNlr8zQ8LoAFqe_RCvcp8fiEFGeCnRebIMF5DY-Sb21Ohfuf1M-23hrvf4o5utwE_Mzda3ZUl6IgMlsOQqJYnMZy966lr0DaxRVPi-umhWbEVBWYbrXkQyt_PUTGxMdpegxg-QjdHv0DU-uiCIbnYR36mAH16NcJ2xfokLAF7mD_B3lHRY5fH72nzoKYYNSdV-NkcfaNyv9kAQs-YAs7GOoinCMwPW_8vGe9WJ2azfSnj4cCqGSvDiRfxKQ6Lh-yckE3jmfEivhXTygmV1BlOuH99dA-Wxef_awB6B_iIDI8qIG80LMn2vDhxV1jBuREZolJ2-R5336ZIxQXPEAeTjk2OW3ukrF_g';
    
    $data = array(
        'email' => $email,
        'status' => 'active',
        'source' => 'api',
        'groups' => array('142520461172934445')
    );

    $response = wp_remote_post($api_url, array(
        'headers' => array(
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $api_key
        ),
        'body' => json_encode($data)
    ));

    if (is_wp_error($response)) {
        return false;
    }

    // print_r($response);
    $response_code = wp_remote_retrieve_response_code($response);
    if ($response_code === 201) {
        return true;
    } else {
        return false;
    }
}

// Student registration
function ajax_handle_student_reg() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $student_id = sanitize_text_field($_POST['student_id']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $middle_name = sanitize_text_field($_POST['middle_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $dob = sanitize_text_field($_POST['dob']);
    $age = intval($_POST['age']);
    $year_paying = sanitize_text_field($_POST['yearPaying']);
    $grade = sanitize_text_field($_POST['grade']);
    $country = sanitize_text_field($_POST['country']);
    $county = sanitize_text_field($_POST['county']);
    $state = sanitize_text_field($_POST['state']);
    $gender = sanitize_text_field($_POST['gender']);
    $coop_name = sanitize_text_field($_POST['coop_name']);
    $immunization_file_name = sanitize_text_field($_POST['immunization_file_name']);
    $immunization_file_url = sanitize_text_field($_POST['immunization_file']);
    $student_profile_pic = sanitize_text_field($_POST['student_profile_pic']);
    $answer_3 = sanitize_text_field($_POST['answer_3']);
    $student_data = json_decode(stripslashes($_POST['questions']), true);
    $table = $wpdb->prefix . 'tsc_student_information';

    $data = [
        'registration_id' => $registration_id,
        'student' => "student" ,
        'first_name' => $first_name,
        'middle_name' => $middle_name,
        'last_name' => $last_name,
        'dob' => $dob,
        'age' => $age,
        'year_paying' => $year_paying,
        'grade' => $grade,
        'country' => $country,
        'county' => $county,
        'state' => $state,
        'gender' => $gender,
        'coop_name' => $coop_name,
        'immunization_file_name' => $immunization_file_name,
        'immunization_file_url' => $immunization_file_url,
        'student_profile_pic' => $student_profile_pic,
        'questions' => wp_json_encode($student_data),
        'submitted_at' => current_time('mysql'),
    ];
    if ($answer_3 == 'no') {
        $data['student_transfer'] = wp_json_encode([]);
    }
    if($student_id == 0){
        $inserted = $wpdb->insert($table, $data);
        $student_id = $wpdb->insert_id;
    }
    else{
        $check = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM $table WHERE registration_id = %d AND id = %d",
            $registration_id,
            $student_id
        ));
        if ($check) {
            $inserted = $wpdb->update($table, $data, ['id' => $check]);
            $student_id = $check;
        } else {
            $inserted = $wpdb->insert($table, $data);
            $student_id = $wpdb->insert_id;
        }
    }

    if ($inserted) {
        wp_send_json_success(['success' => true, 'message' => 'Student registration successful.', 'student_id' => $student_id]);
    } else {
        wp_send_json_error(['success' => false, 'message' => 'Registration failed.', 'error' => $wpdb->last_error]);
    }
}
add_action('wp_ajax_nopriv_ajax_handle_student_reg', 'ajax_handle_student_reg');
add_action('wp_ajax_ajax_handle_student_reg', 'ajax_handle_student_reg');

// Student transfer
function ajax_handle_student_transfer() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $student_id = intval($_POST['student_id']);
    $student_transfer_data = json_decode(stripslashes($_POST['student_transfer']), true);
    $table = $wpdb->prefix . 'tsc_student_information';

    $data = [
        'student_transfer' => wp_json_encode($student_transfer_data),
        // 'submitted_at' => current_time('mysql'),
    ];

    $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d AND id = %d", $registration_id, $student_id));
    if ($check) {
        $inserted = $wpdb->update($table, $data, ['id' => $check]);
    }
    if ($inserted !== false) {
        wp_send_json_success(['success' => true, 'message' => 'Student transfer information saved successfully.']);
    } else {
        wp_send_json_error(['success' => false, 'message' => 'Failed to save student transfer information.', 'error' => $wpdb->last_error]);
    }
}
add_action('wp_ajax_nopriv_ajax_handle_student_transfer', 'ajax_handle_student_transfer');
add_action('wp_ajax_ajax_handle_student_transfer', 'ajax_handle_student_transfer');

// Student course
function ajax_handle_student_course() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $student_id = intval($_POST['student_id']);
    $student_course_data = json_decode(stripslashes($_POST['student_course']), true);
    $table = $wpdb->prefix . 'tsc_student_information';

    $data = [
        'registration_status' => 'processing',
        'student_course' => wp_json_encode($student_course_data),
        'submitted_at' => current_time('mysql'),
    ];

    $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d AND id = %d", $registration_id, $student_id));
    if ($check) {
        $inserted = $wpdb->update($table, $data, ['id' => $check]);
    }
    if ($inserted) {
        wp_send_json_success(['success' => true, 'message' => 'Student course information saved successfully.']);
    } else {
        wp_send_json_error(['success' => false, 'message' => 'Failed to save student course information.', 'error' => $wpdb->last_error]);
    }
}
add_action('wp_ajax_nopriv_ajax_handle_student_course', 'ajax_handle_student_course');
add_action('wp_ajax_ajax_handle_student_course', 'ajax_handle_student_course');

// Digital signature
function ajax_handle_digital_signature() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    // $signature_full_name = sanitize_text_field($_POST['signature_full_name']);
    // $signature_image = sanitize_text_field($_POST['signature_image']);
    $digital_signature_data = json_decode(stripslashes($_POST['digital_signature']), true);
    $table = $wpdb->prefix . 'tsc_student_information';

    // check if signature image is start with $upload_url
    // if (strpos($signature_image, 'http') !== false) {
    //     wp_send_json_success(array('success' => true, 'message' => 'No changes made.'));
    // }

    // Save signature image
    // $upload_dir = wp_upload_dir();
    // $upload_path = $upload_dir['path'];
    // $upload_url = $upload_dir['url'];
    // $signature_image = str_replace($upload_url, $upload_path, $signature_image);
    // $signature_image = str_replace('data:image/png;base64,', '', $signature_image);
    // $signature_image = str_replace(' ', '+', $signature_image);
    // $signature_image = base64_decode($signature_image);
    // $signature_image_name = 'signature_' . $signature_full_name ."_" . $registration_id . '.png';
    // $signature_image_path = $upload_path . '/' . $signature_image_name;
    // file_put_contents($signature_image_path, $signature_image);

    // $digital_signature_data['image'] = $upload_url . '/' . $signature_image_name;

    $data = [
        'digital_signature' => wp_json_encode($digital_signature_data),
    ];

    $student_ids = $wpdb->get_col($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d", $registration_id));
    if ($student_ids) {
        foreach ($student_ids as $s_id) {
            $inserted = $wpdb->update($table, $data, ['id' => $s_id]);
        }
    } else {
        $inserted = false;
    }
    if ($inserted) {
        wp_send_json_success(['success' => true, 'message' => 'Digital signature saved successfully.', 'image' => $digital_signature_data['image']]);
    } else if ($inserted === 0) {
        wp_send_json_success(array('success' => true, 'message' => 'No changes made.'));
    } else {
        wp_send_json_error(['success' => false, 'message' => 'Failed to save digital signature.', 'error' => $wpdb->last_error]);
    }
}
add_action('wp_ajax_nopriv_ajax_handle_digital_signature', 'ajax_handle_digital_signature');
add_action('wp_ajax_ajax_handle_digital_signature', 'ajax_handle_digital_signature');

// Student delete
function ajax_handle_delete_student() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    $student_id = intval($_POST['student_id']);
    // $registration_id = intval($_POST['registration_id']);
    $table = $wpdb->prefix . 'tsc_student_information';

    $deleted = $wpdb->delete($table, ['id' => $student_id, 'registration_id' => $registration_id]);
    if ($deleted) {
        wp_send_json_success(['success' => true, 'message' => 'Student deleted successfully.']);
    } else {
        wp_send_json_error(['success' => false, 'message' => 'Failed to delete student.', 'error' => $wpdb->last_error]);
    }
}
add_action('wp_ajax_nopriv_ajax_handle_delete_student', 'ajax_handle_delete_student');
add_action('wp_ajax_ajax_handle_delete_student', 'ajax_handle_delete_student');

// For Use coupon code
function ajax_handle_use_coupon_code() {
    global $wpdb;
    $code = sanitize_text_field($_POST['code']);
    $amount = floatval($_POST['amount']);
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $table = $wpdb->prefix . 'tsc_coupon_codes';

    $coupon = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE BINARY code = %s", $code));
    if (!$coupon) {
        wp_send_json_success(['type' => '1', 'message' => 'Wrong Code.']);
    } else {
        // print_r($coupon);
        $use_list = !empty($coupon->use_list) ? json_decode($coupon->use_list, true) : [];
        if (in_array($registration_id, $use_list)) {
            wp_send_json_success(['type' => '2', 'message' => 'Already Avail.']);
        } else {
            if ($coupon->status == 'deactive') {
                wp_send_json_success(['type' => '3', 'message' => 'Code is Deactive.']);
            } else {
                $discount = $coupon->discount;
                $code_type = $coupon->discount_type;
                if ($code_type == 'amount'){
                    $discount_amount = $discount;
                    $new_amount = $amount - $discount_amount;
                }
                else{
                    $discount_amount = $amount * $discount / 100;
                    $new_amount = $amount - $discount_amount;
                }
            }
           
            wp_send_json_success([
                'type' => '0',
                'amount' => $new_amount,
                'discount' => $discount_amount,
                'message' => 'Success'
            ]);
        }
    }
}
add_action('wp_ajax_nopriv_ajax_handle_use_coupon_code', 'ajax_handle_use_coupon_code');
add_action('wp_ajax_ajax_handle_use_coupon_code', 'ajax_handle_use_coupon_code');

// For payment in stripe
function process_stripe_payment() {
    // Verify the request is a POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        wp_send_json_error(['message' => 'Invalid request method']);
        return;
    }

    // Get the POST data
    $stripeToken = sanitize_text_field($_POST['stripeToken']); 
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $address = sanitize_text_field($_POST['address']);
    $city = sanitize_text_field($_POST['city']);
    $state = sanitize_text_field($_POST['state']);
    $zip = sanitize_text_field($_POST['zip']);
    $amount = intval($_POST['amount']); // Amount in cents
    $currency = sanitize_text_field($_POST['currency']);
    $description = sanitize_text_field($_POST['description']);

    if ($amount === 0) {
        wp_send_json_success([
            'payment_status' => 'succeeded',
            'transaction_id' => '',
            'amount' => $amount,
            'message' => 'Payment successful!',
        ]);
        return;
    }

    // Stripe API endpoint
    $url = 'https://api.stripe.com/v1/charges';

    // Prepare the body data
    $body = [
        'amount' => $amount * 100, // Convert to cents
        'currency' => $currency,
        'source' => $stripeToken,
        'description' => $description,
        'receipt_email' => $email,
        'shipping' => [
            'name' => $name,
            'address' => [
                'line1' => $address,
                'city' => $city,
                'state' => $state,
                'postal_code' => $zip,
                'country' => 'US' // Hardcode US since this is for US transactions
            ],
        ],
        'metadata' => [
            'customer_name' => $name,
            'customer_email' => $email,
            'customer_address' => "$address, $city, $state $zip"
        ]
    ];

    // Prepare the headers
    $headers = [
        'Authorization' => 'Bearer sk_test_tR3PYbcVNZZ796tH88S4VQ2u', // Test key
        'Content-Type' => 'application/x-www-form-urlencoded',
        'Stripe-Version' => '2020-08-27' // Specify API version
    ];

    // Make the API request
    $response = wp_remote_post($url, [
        'headers' => $headers,
        'body' => $body,
        'timeout' => 30
    ]);

    // Handle the response
    if (is_wp_error($response)) {
        wp_send_json_error([
            'message' => 'Failed to connect to Stripe API: ' . $response->get_error_message()
        ]);
        return;
    }

    $response_body = json_decode(wp_remote_retrieve_body($response), true);
    $response_code = wp_remote_retrieve_response_code($response);

    if ($response_code !== 200 || isset($response_body['error'])) {
        $error_message = isset($response_body['error']['message']) ? 
            $response_body['error']['message'] : 
            'An error occurred while processing the payment.';
        
        wp_send_json_error([
            'message' => $error_message,
            'code' => $response_code,
            'response' => $response_body
        ]);
    } else {
        wp_send_json_success([
            'payment_status' => $response_body['status'],
            'transaction_id' => $response_body['id'],
            'amount' => $response_body['amount'] / 100, // Convert back to dollars
            'paid_amount' => $response_body['amount'],
            'message' => 'Payment successful!'
        ]);
    }
}
add_action('wp_ajax_process_stripe_payment', 'process_stripe_payment');
add_action('wp_ajax_nopriv_process_stripe_payment', 'process_stripe_payment');

// Final submit student registration
function ajax_handle_final_submit() {
    global $wpdb;

    if (!is_user_logged_in()) {
        wp_send_json_error(['success' => false, 'message' => 'Registration not found.']);
        return;
    }

    $registration_id   = get_current_user_id();
    $addnewstudent     = sanitize_text_field($_POST['addNewStudent']);
    $rushfee           = sanitize_text_field($_POST['rushfee']);
    $transaction_id    = sanitize_text_field($_POST['transaction_id']);
    $paidAmount        = floatval($_POST['paidAmount']);
    $coupon_code       = !empty($_POST['coupon_code']) ? sanitize_text_field($_POST['coupon_code']) : '';
    $description       = sanitize_text_field($_POST['description']);
    $account_expire    = date('Y-m-d', strtotime((date('Y')+1).'-08-10'));
    $transactionItems  = json_decode(stripslashes($_POST['transactionItems']), true);

    $table               = $wpdb->prefix . 'tsc_school_registration';
    $student_table       = $wpdb->prefix . 'tsc_student_information';
    $coupon_codes_table  = $wpdb->prefix . 'tsc_coupon_codes';
    $transaction_table   = $wpdb->prefix . 'tsc_transaction';

    $current_time = current_time('mysql');

    // Prepare data arrays
    $add_data = [
        'registration_status' => 'complete',
        'priority'         => $rushfee,
        'transaction_id'   => $transaction_id,
        'paid_amount'      => $paidAmount,
        'used_coupon_code' => $coupon_code,
        'account_expire'   => $account_expire,
        'submitted_at'     => $current_time,
    ];

    $transaction_data = [
        'registration_id' => $registration_id,
        'transaction_id'  => $transaction_id,
        'description'     => $description,
        'transactionItems' => wp_json_encode($transactionItems),
        'amount'          => $paidAmount,
        'expires_at'      => $account_expire,
        'created_at'      => $current_time,
    ];

    // Validate transaction details
    if (empty($transaction_id) && $paidAmount > 0) {
        wp_send_json_error(['success' => false, 'message' => 'Transaction ID required.']);
        return;
    }

    // Insert transaction
    $add_transaction = $wpdb->insert($transaction_table, $transaction_data);
    if (!$add_transaction) {
        wp_send_json_error(['success' => false, 'message' => 'Failed to record transaction.', 'error' => $wpdb->last_error]);
        return;
    }

    // Update student information
    $updated_student = $wpdb->update($student_table, $add_data, ['registration_id' => $registration_id]);
    if ($updated_student === false) {
        wp_send_json_error(['success' => false, 'message' => 'Failed to update student information.', 'error' => $wpdb->last_error]);
        return;
    }

    // Update registration status to complete
    $data = [
        'status'        => 'complete',
        'account_expire' => $account_expire,
        'submitted_at'  => $current_time,
    ];

    $updated = $wpdb->update($table, $data, ['id' => $registration_id]);
    if (!$updated) {
        wp_send_json_error(['success' => false, 'message' => 'Failed to complete registration.', 'error' => $wpdb->last_error]);
        return;
    }

    // Send email notification
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';
    $parent = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $parent_table WHERE registration_id = %d AND type = 'parent_1'", 
        $registration_id
    ));

    $parentName = $parent->first_name . ' ' . $parent->middle_name . ' ' . $parent->last_name;
    $parentEmail = $parent->email;

    if ($addnewstudent == 'yes') {
        $student = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $student_table 
            WHERE registration_id = %d AND student = 'student'
            ORDER BY submitted_at DESC
            LIMIT 1", 
            $registration_id
        ));
        if ($student) {
            $studentName = $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name;
        }
    } else {
        $studentName = "";
    }

    // Send email to parent
    send_registration_completion_email($parentName, $studentName, $parentEmail, $addnewstudent);

    // Handle coupon code usage
    if (!empty($coupon_code)) {
        $coupon = $wpdb->get_row($wpdb->prepare("SELECT * FROM $coupon_codes_table WHERE code = %s", $coupon_code));
        if ($coupon) {
            $use_list = json_decode($coupon->use_list, true) ?: [];
            $use_list[] = $registration_id;

            $updated_coupon = $wpdb->update(
                $coupon_codes_table,
                ['use_list' => wp_json_encode($use_list)],
                ['id' => $coupon->id]
            );

            if (!$updated_coupon) {
                wp_send_json_error(['success' => false, 'message' => 'Failed to update coupon usage.', 'error' => $wpdb->last_error]);
                return;
            }
        }
    }

    // Update user meta data
    update_user_meta($registration_id, 'registration_status', 'complete');
    update_user_meta($registration_id, 'account_expire', $account_expire);

    // Send admin notification if rushfee is high
    if ($rushfee === 'high') {
        $message_type = "High Priority Student Registration Alert";
        $message = "A New Student Registration has been completed with high priority. Please review this transaction with priority and provide immediate attention.";
        send_high_priority_admin_notification($registration_id, $transaction_id, $paidAmount, $message_type, $message);
    }

    wp_send_json_success(['success' => true, 'message' => 'Registration completed successfully.']);
}
add_action('wp_ajax_nopriv_ajax_handle_final_submit', 'ajax_handle_final_submit');
add_action('wp_ajax_ajax_handle_final_submit', 'ajax_handle_final_submit');

function send_registration_completion_email($parentName, $studentName, $parentEmail, $addnewstudent) {
    // Prepare email content
    $subject = "Registration Completed Successfully";
    
    // Get logo URL with better fallback options
    $logo_url = '';
    $logo_id = get_theme_mod('custom_logo');
    if ($logo_id) {
        $logo_attachment = wp_get_attachment_image_src($logo_id, 'full');
        if ($logo_attachment) {
            $logo_url = $logo_attachment[0];
        }
    } 
    
    // Final fallback to text if no images available
    if (empty($logo_url)) {
        $logo_url = '';
    }

    if ($addnewstudent == 'yes') {
        $message = '
            <html>
            <body style="font-family: \'Segoe UI\', Arial, sans-serif; background-color: #f8f9fa; padding: 20px; margin: 0; color: #333333;">
            <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <!-- Header Section -->
                <div style="text-align: center; margin-bottom: 25px;">
                ' . (!empty($logo_url) ? '<img src="' . esc_url($logo_url) . '" alt="' . get_bloginfo('name') . '" style="max-width: 180px; height: auto;" />' : '<h2 style="color: #3a6ea5;">' . get_bloginfo('name') . '</h2>') . '
                </div>
                
                <!-- Title Section -->
                <h2 style="font-size: 22px; color: #3a6ea5; border-bottom: 2px solid #e9ecef; padding-bottom: 10px; margin-bottom: 20px;">New Student Registration Confirmation</h2>
                
                <!-- Personalized Greeting -->
                <p style="font-size: 16px; line-height: 1.5; margin-bottom: 15px;">Dear ' . $parentName . ',</p>
                
                <!-- Main Message -->
                <p style="font-size: 16px; line-height: 1.5; margin-bottom: 15px;">We are pleased to confirm that <strong>' . $studentName . '</strong> has been successfully registered with Graduates Academy and added to your family account.</p>
                
                <!-- Important Information Box -->
                <div style="background-color: #f1f8fe; border-left: 4px solid #3a6ea5; padding: 15px; margin: 20px 0; border-radius: 4px;">
                <p style="font-size: 16px; line-height: 1.5; margin: 0;">You can now begin entering courses, grades, and educational records for your student directly through your parent portal. All necessary features have been activated for your account.</p>
                </div>
                
                <!-- Next Steps -->
                <p style="font-size: 16px; line-height: 1.5; margin-bottom: 15px;">As you begin this educational journey with us, please remember:</p>
                <ul style="font-size: 16px; line-height: 1.5; margin-bottom: 20px; padding-left: 25px;">
                <li>Regular course updates will help maintain accurate academic records</li>
                <li>Our curriculum specialists are available for guidance and planning assistance</li>
                <li>Transcript services are available upon request for your student</li>
                </ul>
                
                <!-- Support Information -->
                <p style="font-size: 16px; line-height: 1.5; margin-bottom: 15px;">If you have any questions or need assistance, please contact our support team at <a href="mailto:admin@graduatesacademy.com" style="color: #3a6ea5; text-decoration: none;">admin@graduatesacademy.com</a> or call (865) 564-4810.</p>
                
                <!-- Closing -->
                <p style="font-size: 16px; line-height: 1.5; margin-top: 25px;">Thank you for choosing Graduates Academy for your student\'s educational journey.</p>
                
                <!-- Signature -->
                <p style="font-size: 16px; line-height: 1.5; margin-bottom: 5px;">Sincerely,</p>
                <p style="font-size: 16px; line-height: 1.5; font-weight: 600; margin-bottom: 30px;">The Graduates Academy Team</p>
                
                <!-- Footer -->
                <div style="border-top: 1px solid #e9ecef; padding-top: 20px; margin-top: 20px; text-align: center; font-size: 14px; color: #6c757d;">
                <p style="margin-bottom: 5px;">© ' . date('Y') . ' Graduates Academy. All rights reserved.</p>
                <p style="margin-top: 0;">309 Ebenezer Rd, Knoxville, TN 37923 | (865) 564-4810</p>
                </div>
            </div>
            </body>
            </html>
        ';
    } else {    
        $message = '
            <html>
            <body style="font-family: \'Segoe UI\', Arial, sans-serif; background-color: #f8f9fa; padding: 20px; margin: 0; color: #333333;">
            <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <!-- Header Section -->
                <div style="text-align: center; margin-bottom: 25px;">
                ' . (!empty($logo_url) ? '<img src="' . esc_url($logo_url) . '" alt="' . get_bloginfo('name') . '" style="max-width: 180px; height: auto;" />' : '<h2 style="color: #3a6ea5;">' . get_bloginfo('name') . '</h2>') . '
                </div>
                
                <!-- Title Section -->
                <h2 style="font-size: 22px; color: #3a6ea5; border-bottom: 2px solid #e9ecef; padding-bottom: 10px; margin-bottom: 20px;">Registration Confirmation</h2>
                
                <!-- Personalized Greeting -->
                <p style="font-size: 16px; line-height: 1.5; margin-bottom: 15px;">Dear ' . $parentName . ',</p>
                
                <!-- Main Message -->
                <p style="font-size: 16px; line-height: 1.5; margin-bottom: 15px;">We\'re pleased to confirm that your registration with Graduates Academy has been completed successfully.</p>
                
                <!-- Important Information Box -->
                <div style="background-color: #f1f8fe; border-left: 4px solid #3a6ea5; padding: 15px; margin: 20px 0; border-radius: 4px;">
                <p style="font-size: 16px; line-height: 1.5; margin: 0;">Your account is now active, providing you with full access to our educational resources, tools, and support services.</p>
                </div>
                
                <!-- Follow-up Instructions -->
                <p style="font-size: 16px; line-height: 1.5; margin-bottom: 15px;">To get started:</p>
                <ul style="font-size: 16px; line-height: 1.5; margin-bottom: 20px; padding-left: 25px;">
                <li>Log in to your dashboard to view your registration details</li>
                <li>Complete your profile information if you haven\'t already</li>
                <li>Explore the resources available to support your educational journey</li>
                </ul>
                
                <!-- Support Information -->
                <p style="font-size: 16px; line-height: 1.5; margin-bottom: 15px;">If you have any questions or need assistance, please don\'t hesitate to contact our support team at <a href="mailto:admin@graduatesacademy.com" style="color: #3a6ea5; text-decoration: none;">admin@graduatesacademy.com</a>.</p>
                
                <!-- Closing -->
                <p style="font-size: 16px; line-height: 1.5; margin-top: 25px;">Thank you for choosing Graduates Academy. We look forward to supporting your educational journey.</p>
                
                <!-- Signature -->
                <p style="font-size: 16px; line-height: 1.5; margin-bottom: 5px;">Sincerely,</p>
                <p style="font-size: 16px; line-height: 1.5; font-weight: 600; margin-bottom: 30px;">The Graduates Academy Team</p>
                
                <!-- Footer -->
                <div style="border-top: 1px solid #e9ecef; padding-top: 20px; margin-top: 20px; text-align: center; font-size: 14px; color: #6c757d;">
                <p style="margin-bottom: 5px;">© ' . date('Y') . ' Graduates Academy. All rights reserved.</p>
                <p style="margin-top: 0;">309 Ebenezer Rd, Knoxville, TN 37923 | (865) 564-4810</p>
                </div>
            </div>
            </body>
            </html>
        ';
    }

    // Add temporary filters to properly set the from name and email
    add_filter('wp_mail_from', function($original_email) {
        return 'no-reply@graduatesacademy.com';
    });
    
    add_filter('wp_mail_from_name', function($original_name) {
        return 'Graduates Academy';
    });

    $headers = array(
        'Content-Type: text/html; charset=UTF-8'
    );

    // $mail_sent = wp_mail($email, $subject, $message, $headers);
    
    // Remove the filters after sending
    remove_filter('wp_mail_from', function($original_email) {
        return 'no-reply@graduatesacademy.com';
    });
    
    remove_filter('wp_mail_from_name', function($original_name) {
        return 'Graduates Academy';
    });

    return wp_mail($parentEmail, $subject, $message, $headers);
}

// Create a new function for sending admin notification
function send_high_priority_admin_notification($registration_id, $transaction_id, $paidAmount, $message_type, $message) {
    global $wpdb;
    
    // Get parent details
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';
    $parent = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $parent_table WHERE registration_id = %d AND type = 'parent_1'", 
        $registration_id
    ));

    $name= $parent->first_name . ' ' . $parent->middle_name . ' ' . $parent->last_name;
    
    // Prepare email content
    $admin_email = get_option('admin_email');
    // echo $admin_email;
    $subject = $message_type;
    $head = $message;
    
    // Create a professional, modern email template with Bootstrap-inspired styling
    $message = '<html><body style="font-family: \'Segoe UI\', Roboto, Arial, sans-serif; background-color: #f8f9fa; margin: 0; padding: 20px; color: #212529;">';
    $message .= '<div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">';
    
    // Header with alert styling
    $message .= '<div style="text-align: center; margin-bottom: 25px;">';
    $message .= '<h2 style="color: #dc3545; margin: 0; font-weight: 600;">' . esc_html($message_type) . '</h2>';
    $message .= '<div style="width: 60px; height: 4px; background-color: #dc3545; margin: 12px auto;"></div>';
    $message .= '</div>';
    
    // Alert box for main message
    $message .= '<div style="padding: 20px; background-color: #f8d7da; border-left: 4px solid #dc3545; border-radius: 4px; margin-bottom: 25px;">';
    $message .= '<p style="font-size: 16px; margin: 0; color: #721c24;"><strong>Important:</strong> ' . esc_html($head) . '</p>';
    $message .= '</div>';
    
    // Parent information card
    $message .= '<div style="background-color: #f8f9fa; border-radius: 8px; padding: 20px; margin-bottom: 25px;">';
    $message .= '<h3 style="font-size: 18px; color: #495057; margin-top: 0; border-bottom: 1px solid #dee2e6; padding-bottom: 10px;">Parent Details</h3>';
    $message .= '<div style="display: flex; margin-bottom: 8px;"><div style="width: 100px; font-weight: bold; color: #495057;">Name:</div><div>' . esc_html($name) . '</div></div>';
    $message .= '<div style="display: flex; margin-bottom: 8px;"><div style="width: 100px; font-weight: bold; color: #495057;">Email:</div><div>' . esc_html($parent->email) . '</div></div>';
    $message .= '<div style="display: flex; margin-bottom: 8px;"><div style="width: 100px; font-weight: bold; color: #495057;">Phone:</div><div>' . esc_html($parent->phone) . '</div></div>';
    $message .= '</div>';
    
    // Call to action
    $message .= '<div style="padding: 20px; background-color: #e2f0fd; border-left: 4px solid #0d6efd; border-radius: 4px; margin-bottom: 25px;">';
    $message .= '<p style="font-size: 16px; margin: 0; color: #084298;"><strong>Action Required:</strong> Please review this transaction with priority and provide immediate attention.</p>';
    $message .= '</div>';
    
    // Transaction details
    $message .= '<div style="background-color: #f8f9fa; border-radius: 8px; padding: 20px; margin-top: 20px;">';
    $message .= '<h3 style="font-size: 18px; color: #495057; margin-top: 0; border-bottom: 1px solid #dee2e6; padding-bottom: 10px;">Transaction Details</h3>';
    $message .= '<div style="display: flex; margin-bottom: 8px;"><div style="width: 150px; font-weight: bold; color: #495057;">Transaction ID:</div><div>' . esc_html($transaction_id) . '</div></div>';
    $message .= '<div style="display: flex; margin-bottom: 8px;"><div style="width: 150px; font-weight: bold; color: #495057;">Paid Amount:</div><div><span style="color: #198754; font-weight: bold;">$' . number_format($paidAmount, 2) . '</span></div></div>';
    $message .= '</div>';
    
    // Footer
    $message .= '<div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #dee2e6; color: #6c757d; font-size: 14px;">';
    $message .= '<p>This is an automated notification from Graduates Academy System.</p>';
    $message .= '<p style="margin-bottom: 0;">© ' . date('Y') . ' Graduates Academy. All rights reserved.</p>';
    $message .= '</div>';
    
    $message .= '</div>';
    $message .= '</body></html>';

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: Graduates Academy <no-reply@graduatesacademy.com>'
    );
    
    return wp_mail($admin_email, $subject, $message, $headers);
}

// Login
function ajax_handle_login() {
    global $wpdb;
    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);

    // Validate email
    if (!is_email($email)) {
        wp_send_json_error(['success' => false, 'message' => 'Invalid email address.']);
        return;
    }

    // Get user by email
    $user = get_user_by('email', $email);

    if ($user && wp_check_password($password, $user->data->user_pass, $user->ID)) {
        // Log the user in
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);

        // Redirect to home or any custom page
        // wp_safe_redirect(home_url('/dashboard'));
        $user_role = $user->roles[0];
        $registration_status = get_user_meta($user->ID, 'registration_status', true);
        if($user_role == 'school_admin') {
            $redirect_url = "/users";
        } else if($registration_status == 'create'|| $registration_status == 'processing') {
            // $redirect_url = "/login";
            $redirect_url = "/registration";
        } else {
            // $redirect_url = "/dashboard";
            $redirect_url = "/students";
        }
        wp_send_json_success([
            'success' => true,
            'message' => 'Login successful.',
            'redirect_url' => home_url($redirect_url)
        ]);
        exit;
    } else {
        // Login failed
        wp_send_json_error(['success' => false, 'message' => 'Invalid email or password.']);
        return;
    }


    // $table = $wpdb->prefix . 'tsc_school_registration';
    // $user = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE email = %s", $email));

    // if ($user) {
    //     if (wp_check_password($password, $user->password) && $user->status == 'complete') {
    //         $role = $user->role;
    //         if ($role == 'admin') {
    //             $_SESSION['user_role'] = 'admin'; 
    //             $_SESSION['user_id'] = $user->id;
    //             wp_send_json_success([
    //                 'success' => true,
    //                 'message' => 'Login successful.',
    //                 'redirect_url' => home_url('/admin_dashboard')
    //             ]);
    //         } else {
    //             $_SESSION['user_role'] = 'parent';
    //             $_SESSION['user_id'] = $user->id;
    //             wp_send_json_success([
    //                 'success' => true,
    //                 'message' => 'Login successful.',
    //                 'redirect_url' => home_url('/dashboard')
    //             ]);
    //         }
    //     } elseif ($user->status == 'processing' || $user->status == 'create') {
    //         wp_send_json_success([
    //             'success' => true,
    //             'message' => 'Please Complete Your Registration.',
    //             'redirect_url' => home_url('/registration/?rid=' . $user->id)
    //         ]);
    //     } else {
    //         wp_send_json_error(['success' => false, 'message' => 'Invalid Credentials.']);
    //     }
    // } else {
    //     wp_send_json_error(['success' => false, 'message' => 'Email does not exist.']);
    // }
}
add_action('wp_ajax_nopriv_ajax_handle_login', 'ajax_handle_login');
add_action('wp_ajax_ajax_handle_login', 'ajax_handle_login');

// file upload for school registration
function ajax_handle_fileUpload(){

    $media_url="";
    if(isset($_FILES['file'])){
        $file = $_FILES['file']; 
        $upload_dir = wp_upload_dir();
        $upload_path = $upload_dir['path'];
        $file_name = $file['name'];
        $file_path = $upload_path . '/' . $file_name;
        $media_url = $upload_dir['url'] . '/' . $file_name;
        move_uploaded_file($file['tmp_name'], $file_path);
        //  data = JSON.parse(data);
        // immunization_file_name = data.response;

        wp_send_json_success(array('message' => 'File uploaded successfully.', 'media_url' => $media_url));
    }
    
}
add_action('wp_ajax_nopriv_ajax_handle_fileUpload', 'ajax_handle_fileUpload');
add_action('wp_ajax_ajax_handle_fileUpload', 'ajax_handle_fileUpload');

// For forgot password
function ajax_handle_forgot_password() {
    global $wpdb;
    $email = sanitize_email($_POST['email']);
    
    if (!is_email($email)) {
        wp_send_json_error(['success' => false, 'message' => 'Invalid email format.']);
        return;
    }
    
    // Check if email exists
    $user = get_user_by('email', $email);
    if (!$user) {
        wp_send_json_error(['success' => false, 'message' => 'Email not found in our system.']);
        return;
    }
    
    $password_reset_code = isset($_POST['password_reset_code']) ? sanitize_text_field($_POST['password_reset_code']) : '';
    $new_password = isset($_POST['new_password']) ? sanitize_text_field($_POST['new_password']) : '';

    // Generate and send code
    if (empty($password_reset_code)) {
        // Generate a random 6-digit code
        $temp_code = wp_rand(100000, 999999);

        // Save the code and timestamp
        update_user_meta($user->ID, 'forget_password_token', $temp_code);
        update_user_meta($user->ID, 'token_reset_time', current_time('mysql'));
        
        // Prepare email
        $subject = 'Password Reset for Your Account';
        // Add PHPMailer configuration
        add_action('phpmailer_init', function($phpmailer) {
            $phpmailer->isHTML(true);
            $phpmailer->CharSet = 'UTF-8';
        });
        
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: Graduates Academy <no-reply@graduatesacademy.com>'
        ];
        
        // Get logo URL with better fallback options
        $logo_id = get_theme_mod('custom_logo');
        if ($logo_id) {
            $logo_url = wp_get_attachment_url($logo_id);
        } else {
            // Fallback to site icon
            $site_icon_id = get_option('site_icon');
            if ($site_icon_id) {
                $logo_url = wp_get_attachment_url($site_icon_id);
            } else {
                // Final fallback
        $message .= '<table><tr><td><img src="' . esc_url($logo_url) . '" alt="' . get_bloginfo('name') . '" style="width:150px; height:auto; display:block;" /></td></tr></table>';
            }
        }
        
        // echo esc_url($logo_url);

        $message = '<html>
        <body style="font-family: Arial, Helvetica, sans-serif; background-color: #f8f9fa; margin: 0; padding: 20px; color: #333333;">
            <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 40px 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                <!-- Header with logo -->
                <div style="text-align: center; margin-bottom: 30px;">
                    ' . (!empty($logo_url) ? '<img src="' . esc_url($logo_url) . '" alt="' . get_bloginfo('name') . '" style="max-width: 180px; height: auto; margin-bottom: 20px;" />' : '<h2 style="color: #0056b3;">' . get_bloginfo('name') . '</h2>') . '
                    <h2 style="color: #0056b3; margin: 0; font-size: 24px;">Password Reset Verification</h2>
                </div>
                
                <!-- Main notification -->
                <div style="padding: 20px; background-color: #f0f7ff; border-left: 4px solid #0056b3; border-radius: 4px; margin-bottom: 25px;">
                    <p style="font-size: 16px; line-height: 1.5; margin: 0;">We received a request to reset your password. Please use the verification code below to complete this process.</p>
                </div>
                
                <!-- Verification code section -->
                <div style="text-align: center; margin: 35px 0;">
                    <div style="background-color: #f5f5f5; display: inline-block; padding: 15px 40px; border-radius: 6px; border: 1px dashed #cccccc;">
                        <span style="font-family: monospace; font-size: 28px; font-weight: bold; letter-spacing: 5px; color: #0056b3;">' . $temp_code . '</span>
                    </div>
                    <p style="font-size: 14px; color: #666666; margin-top: 10px; font-style: italic;">This code will expire in 10 minutes</p>
                </div>
                
                <!-- Instructions -->
                <div style="margin-bottom: 30px;">
                    <p style="font-size: 16px; line-height: 1.6; margin-bottom: 15px;">To reset your password:</p>
                    <ol style="font-size: 16px; line-height: 1.6; margin-top: 0; padding-left: 25px;">
                        <li>Enter this verification code on the password reset page</li>
                        <li>Create your new password following our security guidelines</li>
                        <li>Log in with your new credentials</li>
                    </ol>
                </div>
                
                <!-- Security notice -->
                <div style="background-color: #fff9e6; border-left: 4px solid #e6b400; padding: 15px; border-radius: 4px; margin: 25px 0;">
                    <p style="font-size: 15px; line-height: 1.5; margin: 0;"><strong>Security Notice:</strong> If you did not request this password reset, please disregard this email or contact our support team immediately if you have concerns.</p>
                </div>
                
                <!-- Footer -->
                <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eeeeee; text-align: center;">
                    <p style="font-size: 16px; margin-bottom: 20px;">Thank you,<br /><strong>The ' . htmlspecialchars(get_bloginfo('name')) . ' Team</strong></p>
                    <p style="color: #777777; font-size: 14px;">© ' . date('Y') . ' ' . htmlspecialchars(get_bloginfo('name')) . '. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>';

        // Send email with error handling
        $mail_sent = wp_mail($email, $subject, $message, $headers);
        
        if ($mail_sent) {
            wp_send_json_success(['success' => true, 'message' => 'Password reset code sent to your email.', 'status' => 'code_sent']);
        } else {
            // Log the error for admin review
            error_log("Failed to send password reset email to: $email");
            wp_send_json_error(['success' => false, 'message' => 'Failed to send email. Please try again or contact support.']);
        }
        return;
    }
    
    // Verify code and reset password
    $user_code = get_user_meta($user->ID, 'forget_password_token', true);
    $reset_time = get_user_meta($user->ID, 'token_reset_time', true);
    
    // Verify code validity
    if (empty($user_code) || $user_code != $password_reset_code) {
        wp_send_json_success(['success' => true, 'message' => 'Invalid code.', 'status' => 'code_mismatch']);
        return;
    }
    
    // Check if code is expired (10 minutes = 600 seconds)
    $current_time = strtotime(current_time('mysql'));
    $code_time = strtotime($reset_time);
    if ($current_time - $code_time > 600) {
        // Generate new code
        $temp_code = wp_rand(100000, 999999);
        update_user_meta($user->ID, 'forget_password_token', $temp_code);
        update_user_meta($user->ID, 'token_reset_time', current_time('mysql'));
        
        // Prepare expired code email
        $subject = 'Resend New Password Reset Code';
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: Graduates Academy <no-reply@graduatesacademy.com>'
        ];
        
        // $logo_url = wp_get_attachment_url(get_theme_mod('custom_logo')) ?: site_url('/wp-content/uploads/2025/01/site-icon-1.png');
        
        // Get logo URL with proper fallback
        $logo_id = get_theme_mod('custom_logo');
        if ($logo_id) {
            $logo_url = wp_get_attachment_url($logo_id);
        } else {
            $site_icon_id = get_option('site_icon');
            if ($site_icon_id) {
            $logo_url = wp_get_attachment_url($site_icon_id);
            } else {
            $logo_url = '';
            }
        }

        $message = '<html><body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 0; color: #333333;">';
        $message .= '<div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; padding: 40px 30px; border-radius: 6px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);">';
        
        // Header with logo
        $message .= '<div style="text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #eeeeee;">';
        if (!empty($logo_url)) {
            $message .= '<img src="' . esc_url($logo_url) . '" alt="' . get_bloginfo('name') . '" style="max-width: 180px; height: auto;" />';
        } else {
            $message .= '<h1 style="color: #0056b3; margin: 0; font-size: 24px;">' . get_bloginfo('name') . '</h1>';
        }
        $message .= '</div>';
        
        // Main content
        $message .= '<h2 style="color: #0056b3; margin-top: 0; margin-bottom: 20px; font-size: 22px; text-align: center;">Password Reset Code Renewal</h2>';
        
        // Notification box
        $message .= '<div style="padding: 15px; background-color: #f0f7ff; border-left: 4px solid #0056b3; border-radius: 3px; margin-bottom: 25px;">';
        $message .= '<p style="font-size: 15px; line-height: 1.5; margin: 0;">Your previous code has expired. We\'ve generated a new verification code for your security.</p>';
        $message .= '</div>';
        
        // Personalized greeting
        $message .= '<p style="font-size: 16px; line-height: 1.6; margin-bottom: 15px;">Hello,</p>';
        $message .= '<p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px;">Please use the following verification code to complete your password reset:</p>';
        
        // Code display
        $message .= '<div style="text-align: center; margin: 30px 0;">';
        $message .= '<div style="background-color: #f5f5f5; padding: 18px; border-radius: 6px; display: inline-block; font-family: monospace; font-size: 26px; font-weight: bold; letter-spacing: 6px; color: #0056b3;">' . $temp_code . '</div>';
        $message .= '<p style="font-size: 14px; color: #666666; margin-top: 10px; font-style: italic;">This code will expire in 10 minutes</p>';
        $message .= '</div>';
        
        // Security notice
        $message .= '<div style="padding: 15px; background-color: #fff9e6; border-left: 4px solid #e6b400; border-radius: 3px; margin: 25px 0;">';
        $message .= '<p style="font-size: 15px; line-height: 1.5; margin: 0;"><strong>Security Notice:</strong> If you didn\'t request this password reset, please disregard this email or contact our support team immediately if you have concerns.</p>';
        $message .= '</div>';
        
        // Next steps
        $message .= '<p style="font-size: 16px; line-height: 1.6; margin: 25px 0 10px 0;">To reset your password:</p>';
        $message .= '<ol style="font-size: 15px; line-height: 1.6; margin-top: 0; padding-left: 25px;">';
        $message .= '<li>Return to the password reset page</li>';
        $message .= '<li>Enter this verification code</li>';
        $message .= '<li>Create your new password</li>';
        $message .= '</ol>';
        
        // Signature
        $message .= '<p style="font-size: 16px; line-height: 1.6; margin-top: 30px;">Regards,</p>';
        $message .= '<p style="font-size: 16px; line-height: 1.6; font-weight: 600; margin-bottom: 30px;">The ' . htmlspecialchars(get_bloginfo('name')) . ' Team</p>';
        
        // Footer
        $message .= '<div style="text-align: center; border-top: 1px solid #eeeeee; padding-top: 20px; margin-top: 30px; color: #777777; font-size: 13px;">';
        $message .= '<p style="margin-bottom: 5px;">© ' . date('Y') . ' ' . htmlspecialchars(get_bloginfo('name')) . '. All rights reserved.</p>';
        $message .= '<p style="margin-top: 5px;">If you need assistance, please contact our support team.</p>';
        $message .= '</div>';
        
        $message .= '</div>';
        $message .= '</body></html>';

        $mail_sent = wp_mail($email, $subject, $message, $headers);
        if (!$mail_sent) {
            error_log("Failed to send expired code email to: $email");
        }
        
        wp_send_json_success(['success' => true, 'message' => 'Code expired. New code sent to your email.', 'status' => 'code_expired']);
        return;
    }
    
    // Validate new password
    if (strlen($new_password) < 6) {
        wp_send_json_error(['success' => false, 'message' => 'Password must be at least 6 characters.']);
        return;
    }
    
    // Reset password
    wp_set_password($new_password, $user->ID);
    
    // Clear reset tokens
    delete_user_meta($user->ID, 'forget_password_token');
    delete_user_meta($user->ID, 'token_reset_time');
    
    // Send confirmation email
    $subject = 'Password Reset Successful';
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: Graduates Academy <no-reply@graduatesacademy.com>'
    ];

    // $logo_url = wp_get_attachment_url(get_theme_mod('custom_logo')) ?: site_url('/wp-content/uploads/2025/01/site-icon-1.png');
    
    // Get logo URL with proper fallback
    $logo_id = get_theme_mod('custom_logo');
    if ($logo_id) {
        $logo_url = wp_get_attachment_url($logo_id);
    } else {
        $site_icon_id = get_option('site_icon');
        if ($site_icon_id) {
            $logo_url = wp_get_attachment_url($site_icon_id);
        } else {
            $logo_url = '';
        }
    }

    $message = '<html><body style="font-family: \'Segoe UI\', Roboto, Arial, sans-serif; background-color: #f8f9fa; margin: 0; padding: 20px; color: #212529;">';
    $message .= '<div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">';
    
    // Header
    $message .= '<div style="text-align: center; margin-bottom: 25px; border-bottom: 2px solid #e9ecef; padding-bottom: 15px;">';
    $message .= '<h2 style="color: #0d6efd; margin: 0; font-weight: 600;">Password Change Confirmation</h2>';
    $message .= '</div>';
    
    // Main notification
    $message .= '<div style="padding: 20px; background-color: #e9f5fe; border-left: 4px solid #0d6efd; border-radius: 4px; margin-bottom: 25px;">';
    $message .= '<p style="font-size: 16px; margin: 0;"><strong>Your account password has been successfully changed.</strong></p>';
    $message .= '</div>';
    
    // Email content
    $message .= '<div style="margin-bottom: 25px;">';
    $message .= '<p style="font-size: 16px; line-height: 1.6; margin-bottom: 15px;">Dear Account Holder,</p>';
    $message .= '<p style="font-size: 16px; line-height: 1.6; margin-bottom: 15px;">This is to confirm that the password for your account with <strong>' . htmlspecialchars(get_bloginfo('name')) . '</strong> has been successfully changed.</p>';
    $message .= '<p style="font-size: 16px; line-height: 1.6;">You may now log in using your new password. If you experience any issues accessing your account, please contact our support team.</p>';
    $message .= '</div>';
    
    // Security notice
    $message .= '<div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; border-radius: 4px; margin: 25px 0;">';
    $message .= '<p style="font-size: 15px; margin: 0;"><strong>Security Notice:</strong> If you did not initiate this password change, please contact our support team immediately at  <a href="mailto:admin@graduatesacademy.com" style="color: #3a6ea5; text-decoration: none;">admin@graduatesacademy.com</a>.</p>';
    $message .= '</div>';
    
    // Closing and signature
    $message .= '<div style="margin-top: 30px;">';
    $message .= '<p style="font-size: 16px; line-height: 1.6; margin-bottom: 5px;">Sincerely,</p>';
    $message .= '<p style="font-size: 16px; line-height: 1.6; font-weight: 600; margin-bottom: 0;">The ' . htmlspecialchars(get_bloginfo('name')) . ' Team</p>';
    $message .= '</div>';
    
    // Footer
    $message .= '<div style="text-align: center; border-top: 1px solid #e9ecef; padding-top: 20px; margin-top: 30px;">';
    if (!empty($logo_url)) {
        $message .= '<img src="' . esc_url($logo_url) . '" alt="' . get_bloginfo('name') . '" style="max-width: 150px; height: auto;" />';
    } else {
        $message .= '<p style="font-weight: bold; font-size: 18px; color: #0d6efd;">' . get_bloginfo('name') . '</p>';
    }
    $message .= '<p style="color: #6c757d; font-size: 14px; margin-top: 15px;">© ' . date('Y') . ' ' . htmlspecialchars(get_bloginfo('name')) . '. All rights reserved.</p>';
    $message .= '</div>';
    
    $message .= '</div>';
    $message .= '</body></html>';

    $mail_sent = wp_mail($email, $subject, $message, $headers);
    if (!$mail_sent) {
        error_log("Failed to send password reset confirmation to: $email");
    }
    
    wp_send_json_success(['success' => true, 'message' => 'Password reset successful.', 'status' => 'password_changed']);
}
add_action('wp_ajax_nopriv_ajax_handle_forgot_password', 'ajax_handle_forgot_password');
add_action('wp_ajax_ajax_handle_forgot_password', 'ajax_handle_forgot_password');

// Student data fetch by student id
function ajax_handle_get_student_details(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    $student_id = intval($_POST['student_id']);
    $table = $wpdb->prefix . 'tsc_student_information';
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';
    $graduate_table = $wpdb->prefix . 'tsc_graduate_student';

    $settings_page_id = 380;

    $fee_data = array();
    $fee_data['old_student_graduate_price'] = get_field('old_student_graduate_price', $settings_page_id); 
    $fee_data['new_student_graduate_price'] = get_field('new_student_graduate_price', $settings_page_id);

    $student = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table WHERE id = %d",
        $student_id
    ));

    $parent_email = $wpdb->get_var($wpdb->prepare(
        "SELECT email FROM $parent_table WHERE registration_id = %d AND type = 'parent_1'",
        $registration_id
    ));

    $graduate_data = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $graduate_table WHERE student_id = %d",
        $student_id
    ));

    if (!$graduate_data) {
        $graduate_data = [];
    }
    
    if ($student && $parent_email) {
        wp_send_json_success(['success' => true, 'student' => $student, 'parent_email' => $parent_email, 'graduate_data' => $graduate_data, 'fee_data' => $fee_data]);
    } else {
        wp_send_json_error(['success' => false, 'message' => 'Student not found.', 'error' => $wpdb->last_error]);
    }
}
add_action('wp_ajax_nopriv_ajax_handle_get_student_details', 'ajax_handle_get_student_details');
add_action('wp_ajax_ajax_handle_get_student_details', 'ajax_handle_get_student_details');

// Get all data for a specific registration id
function get_registration_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $registration_table = $wpdb->prefix . 'tsc_school_registration';
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';
    $additional_info_table = $wpdb->prefix . 'tsc_additional_information';
    $student_application_table = $wpdb->prefix . 'tsc_student_application';
    $parent_address_table = $wpdb->prefix . 'tsc_parent_address';
    $student_table = $wpdb->prefix . 'tsc_student_information';

    $registration_status = get_user_meta($registration_id, 'registration_status', true);

    $registration_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $registration_table WHERE id = %d", $registration_id));
    // if (!$registration_data) {

    //     wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
    // }

    $data = array();

    $settings_page_id = 380;

    $data['each_student_pay_below_8'] = get_field('each_student_pay_below_8', $settings_page_id);
    $data['each_student_pay_after_8'] = get_field('each_student_pay_after_8', $settings_page_id);
    $data['processing_fee'] = get_field('processing_fee', $settings_page_id);
    $data['transfer_fee'] = get_field('transfer_fee', $settings_page_id);
    $data['family_app_fee'] = get_field('family_app_fee', $settings_page_id);

    if($registration_status == 'create')
    {
        // get the gmail of the user
        $user = get_userdata($registration_id);
        $email = $user->user_email;
        $data['status'] = 'Not Started';
        $data['success'] = 'true';
        $data['email'] = $email;
        wp_send_json(array('success' => true, 'data' => $data));
        // wp_send_json_success(array('success' => true, 'status' => 'Not Started', 'email' => $email, 'data' => $data));
    }
    else {

        // Get registration data
        $data['status'] = $registration_status;
        
        // Get parent 1 data
        $parent_1_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $parent_table WHERE registration_id = %d AND type = 'parent_1'", $registration_id), ARRAY_A);
        if (!$parent_1_data) {
            $data['message'] = 'Parent 1 data not found.';
            $data['success'] = 'true';
            wp_send_json(array('success' => true, 'data' => $data));
            // wp_send_json(array('success' => true, 'message' => 'Parent 1 data not found.', 'data' => $data));
        }
        $data['parent_1_data'] = $parent_1_data;

        // Get parent 2 data
        $parent_2_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $parent_table WHERE registration_id = %d AND type = 'parent_2'", $registration_id), ARRAY_A);
        if ($parent_2_data) {
            $data['parent_2_data'] = $parent_2_data;
        }

        // Get additional info data
        $additional_info_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $additional_info_table WHERE registration_id = %d", $registration_id), ARRAY_A);
        if ($additional_info_data) {
            $data['additional_info_data'] = $additional_info_data;
        }

        // Get student application data
        $student_application_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $student_application_table WHERE registration_id = %d", $registration_id), ARRAY_A);
        if ($student_application_data) {
            $data['student_application_data'] = $student_application_data;
        }

        // Get parent address data
        $parent_address_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $parent_address_table WHERE registration_id = %d", $registration_id), ARRAY_A);
        if ($parent_address_data) {
            $data['parent_address_data'] = $parent_address_data;
        }

        // Get student data
        $student_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $student_table WHERE registration_id = %d", $registration_id), ARRAY_A);
        if ($student_data) {
            $data['student_data'] = $student_data;
        }

        wp_send_json(array('success' => true, 'data' => $data));
    }

}
add_action('wp_ajax_nopriv_get_registration_data', 'get_registration_data');
add_action('wp_ajax_get_registration_data', 'get_registration_data');

// For Update parent_data for parent 1 and parent 2
function ajax_handle_update_parent_data() {
    // handel data for parent 1
    global $wpdb;
    // print all data
    // print_r($_POST);
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $role = sanitize_text_field($_POST['role']);
    $type = sanitize_text_field($_POST['type']);
    $f_name = sanitize_text_field($_POST['first_name']);
    $m_name = sanitize_text_field($_POST['middle_name']);
    $l_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $country_code = sanitize_text_field($_POST['country_code']);
    $phone = sanitize_text_field($_POST['contact']);
    $year_paying = isset($_POST['school_year']) ? sanitize_text_field($_POST['school_year']) : '';
    $heard_about_us = isset($_POST['heard_about_us']) ? sanitize_text_field($_POST['heard_about_us']) : '';
    $parent_data = json_decode(stripslashes($_POST['questions']), true);
    $table = $wpdb->prefix . 'tsc_parent_registration';

    $data = array(
        'registration_id' => $registration_id,
        'type' => $type,
        'role' => $role,
        'first_name' => $f_name,
        'middle_name' => $m_name,
        'last_name' => $l_name,
        'country_code' => $country_code,
        'phone' => $phone,
        'email' => $email,
        'year_paying' => $year_paying,
        'heard_about_us' => $heard_about_us,
        'questions' => wp_json_encode($parent_data),
        'submitted_at' => current_time('mysql'),
    );

    if ($type == 'parent_1') {
        $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d AND type = %s", $registration_id, $type));
        if ($check) {
            // updata the data
            $inserted = $wpdb->update($table, $data, array('id' => $check));
        }
        else
        {
            $inserted = $wpdb->insert($table, $data);
        }
    }
    else
    {
        $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d AND type = %s", $registration_id, $type));
        if ($check) {
            // updata the data
            $inserted = $wpdb->update($table, $data, array('id' => $check));
        }
        else
        {
            $inserted = $wpdb->insert($table, $data);
        }
    }

    if ($inserted) {
        wp_send_json_success(array('success' => true, 'message' => 'Parent data saved successfully.'));
    } else if ($inserted === 0) {
        wp_send_json_success(array('success' => true, 'message' => 'No changes made.'));
    }
     else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to save parent data.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_update_parent_data', 'ajax_handle_update_parent_data');
add_action('wp_ajax_ajax_handle_update_parent_data', 'ajax_handle_update_parent_data');

// For Update additional information data
function ajax_handle_update_additional_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $additional_data = json_decode(stripslashes($_POST['additional_info']), true);
    $table = $wpdb->prefix . 'tsc_additional_information';

    $data = array(
        'registration_id' => $registration_id,
        'questions' => wp_json_encode($additional_data),
        'submitted_at' => current_time('mysql'),
    );

    $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d", $registration_id));
    if ($check) {
        $inserted = $wpdb->update($table, $data, array('id' => $check));
    } else {
        $inserted = $wpdb->insert($table, $data);
    }

    if ($inserted) {
        wp_send_json_success(array('success' => true, 'message' => 'Additional information saved successfully.'));
    } else if ($inserted === 0) {
        wp_send_json_success(array('success' => true, 'message' => 'No changes made.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to save additional information.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_update_additional_data', 'ajax_handle_update_additional_data');
add_action('wp_ajax_ajax_handle_update_additional_data', 'ajax_handle_update_additional_data');

// For Update student application data
function ajax_handle_update_student_application(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $student_data = json_decode(stripslashes($_POST['student_application']), true);
    $table = $wpdb->prefix . 'tsc_student_application';

    $data = array(
        'registration_id' => $registration_id,
        'questions' => wp_json_encode($student_data),
        'submitted_at' => current_time('mysql'),
    );

    $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d", $registration_id));
    if ($check) {
        $inserted = $wpdb->update($table, $data, array('id' => $check));
    } else {
        $inserted = $wpdb->insert($table, $data);
    }

    if ($inserted) {
        wp_send_json_success(array('success' => true, 'message' => 'Student application saved successfully.'));
    } else if ($inserted === 0) {
        wp_send_json_success(array('success' => true, 'message' => 'No changes made.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to save student application.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_update_student_application', 'ajax_handle_update_student_application');
add_action('wp_ajax_ajax_handle_update_student_application', 'ajax_handle_update_student_application');

// For Update parent address data
function ajax_handle_update_parent_address(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $address = sanitize_text_field($_POST['address']);
    $city = sanitize_text_field($_POST['city']);
    $state = sanitize_text_field($_POST['state']);
    $zip = sanitize_text_field($_POST['zip']);
    $county = sanitize_text_field($_POST['county']);
    $country_code = sanitize_text_field($_POST['country_code']);
    $emg_contact_name = sanitize_text_field($_POST['emg_contact_name']);
    $emg_contact_phone = sanitize_text_field($_POST['emg_contact_phone']);
    $table = $wpdb->prefix . 'tsc_parent_address';

    $data = array(
        'registration_id' => $registration_id,
        'address' => $address,
        'city' => $city,
        'state' => $state,
        'zip' => $zip,
        'county' => $county,
        'country_code' => $country_code,
        'emg_contact_name' => $emg_contact_name,
        'emg_contact_phone' => $emg_contact_phone,
        'submitted_at' => current_time('mysql'),
    );

    $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d", $registration_id));
    if ($check) {
        $inserted = $wpdb->update($table, $data, array('id' => $check));
    } else {
        $inserted = $wpdb->insert($table, $data);
    }

    if ($inserted) {

        // get user email
        $user = get_userdata($registration_id);
        $email = $user->user_email;
        wp_send_json_success(array('success' => true, 'message' => 'Parent address saved successfully.', 'email' => $email));
    } else if ($inserted === 0) {
        wp_send_json_success(array('success' => true, 'message' => 'No changes made.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to save parent address.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_update_parent_address', 'ajax_handle_update_parent_address');
add_action('wp_ajax_ajax_handle_update_parent_address', 'ajax_handle_update_parent_address');


// Get attendance data for a specific registration id
function get_student_attendance_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $table = $wpdb->prefix . 'tsc_students_attendance';
    // Get all students for this registration
    $student_table = $wpdb->prefix . 'tsc_student_information';
    $students = $wpdb->get_results($wpdb->prepare(
        "SELECT id, registration_id, CONCAT(first_name,' ', middle_name,' ', last_name) as student_name, student_profile_pic 
        FROM $student_table 
        WHERE registration_id = %d AND registration_status = 'complete'", 
        $registration_id
    ), ARRAY_A);

    $data = array();
    
    if ($students) {
        foreach ($students as $student) {
            $student_attendance = $wpdb->get_results($wpdb->prepare(
                "SELECT id, year, fall_semester, spring_semester, summer_semester 
                FROM $table 
                WHERE student_id = %d", 
                $student['id']
            ), ARRAY_A); 

            $data[] = array(
                'student_id' => $student['id'],
                'registration_id' => $student['registration_id'], 
                'student_name' => $student['student_name'],
                'student_picture' => $student['student_profile_pic'],
                'attendance' => $student_attendance ? $student_attendance : []
            );
        }
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_student_attendance_data', 'get_student_attendance_data');
add_action('wp_ajax_get_student_attendance_data', 'get_student_attendance_data');

// For create student attendance data
function add_student_attendance(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = intval($_POST['registration_id']);
    $student_id = intval($_POST['student_id']);
    $year = sanitize_text_field($_POST['student_attendance_year']);
    $semester_1 = intval($_POST['semester_1']);
    $semester_2 = intval($_POST['semester_2']); 
    $semester_3 = intval($_POST['semester_3']);

    $table = $wpdb->prefix . 'tsc_students_attendance';
    
    $data = array(
        'registration_id' => $registration_id,
        'student_id' => $student_id,
        'year' => $year,
        'fall_semester' => $semester_1,
        'spring_semester' => $semester_2, 
        'summer_semester' => $semester_3,
        'created_at' => current_time('mysql'),
    );

    $inserted = $wpdb->insert($table, $data);

    if ($inserted) {
        wp_send_json_success(array('success' => true, 'message' => 'Student attendance saved successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to save student attendance.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_add_student_attendance', 'add_student_attendance');
add_action('wp_ajax_add_student_attendance', 'add_student_attendance');

// For Update student attendance data
function update_student_attendance(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $attendance_id = intval($_POST['attendance_id']);
    $semester_1 = intval($_POST['semester_1']);
    $semester_2 = intval($_POST['semester_2']); 
    $semester_3 = intval($_POST['semester_3']);

    $table = $wpdb->prefix . 'tsc_students_attendance';

    $data = array(
        'fall_semester' => $semester_1,
        'spring_semester' => $semester_2, 
        'summer_semester' => $semester_3,
    );

    $updated = $wpdb->update($table, $data, array('id' => $attendance_id));

    if ($updated) {
        wp_send_json_success(array('success' => true, 'message' => 'Student attendance updated successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to update student attendance.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_update_student_attendance', 'update_student_attendance');
add_action('wp_ajax_update_student_attendance', 'update_student_attendance');

// For Delete student attendance data
function delete_student_attendance(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }
    $table = $wpdb->prefix . 'tsc_students_attendance';

    $attendance_id = intval($_POST['attendance_id']);
    
    $deleted = $wpdb->delete($table, array('id' => $attendance_id));

    if ($deleted) {
        wp_send_json_success(array('success' => true, 'message' => 'Student attendance deleted successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to delete student attendance.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_delete_student_attendance', 'delete_student_attendance');
add_action('wp_ajax_delete_student_attendance', 'delete_student_attendance');

// For Get Transaction data
function get_transaction_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.', 'transaction_data' => []));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $table = $wpdb->prefix . 'tsc_transaction';

    $data = array();

    $transaction_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE registration_id = %d", $registration_id), ARRAY_A);
    if ($transaction_data) {
        $data['transaction_data'] = $transaction_data;
    }
    else {
        $data['transaction_data'] = [];
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_transaction_data', 'get_transaction_data');
add_action('wp_ajax_get_transaction_data', 'get_transaction_data');

// For get Student data by registration id
function get_student_data_by_registration_id(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.', 'student_data' => []));
        return;
    }

    $registration_id = get_current_user_id();
    
    // $registration_id = intval($_POST['registration_id']);
    $table = $wpdb->prefix . 'tsc_student_information';
    $graduate_table = $wpdb->prefix . 'tsc_graduate_student';

    $data = array();

    $student_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE registration_id = %d AND registration_status = 'complete'", $registration_id), ARRAY_A);
    if ($student_data) {

        // Get user role
        $user = get_userdata($registration_id);
        $user_role = $user->roles[0];

        // Graduate data
        $graduate_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $graduate_table WHERE registration_id = %d", $registration_id), ARRAY_A);

        $data['student_data'] = $student_data;
        $data['graduate_data'] = $graduate_data;
        $data['user_role'] = $user_role;
    }
    else {
        $data['student_data'] = [];
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_student_data_by_registration_id', 'get_student_data_by_registration_id');
add_action('wp_ajax_get_student_data_by_registration_id', 'get_student_data_by_registration_id');


// For get student course data by registration id and event data
function get_student_course_data_by_registration_id(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.', 'student_data' => []));
        return;
    }

    $registration_id = get_current_user_id();
    
    // $registration_id = intval($_POST['registration_id']);
    $table = $wpdb->prefix . 'tsc_student_information';

    $data = array();

    $student_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE registration_id = %d AND registration_status = 'complete'", $registration_id), ARRAY_A);
    if ($student_data) {
        $data['student_data'] = $student_data;
    }
    else {
        $data['student_data'] = [];
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_student_course_data_by_registration_id', 'get_student_course_data_by_registration_id');
add_action('wp_ajax_get_student_course_data_by_registration_id', 'get_student_course_data_by_registration_id');


// For get custom event data
function ajax_handle_get_custom_event_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.', 'custom_event_data' => []));
        return;
    }

    $registration_id = get_current_user_id();
    $table = $wpdb->prefix . 'tsc_custom_events';

    $data = array();

    $custom_event_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE registration_id = %d", $registration_id), ARRAY_A);
    if ($custom_event_data) {
        $data['custom_event_data'] = $custom_event_data;
    }
    else {
        $data['custom_event_data'] = [];
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_ajax_handle_get_custom_event_data', 'ajax_handle_get_custom_event_data');
add_action('wp_ajax_ajax_handle_get_custom_event_data', 'ajax_handle_get_custom_event_data');

// For save custom event data
function ajax_handle_save_custom_event_data(){
    global $wpdb;
    // Retrieve and sanitize POST data
    $registration_id = get_current_user_id();
    $title = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
    $start_date = isset($_POST['startDate']) ? sanitize_text_field($_POST['startDate']) : '';
    $end_date = isset($_POST['endDate']) ? sanitize_text_field($_POST['endDate']) : $start_date;
    $start_time = isset($_POST['startTime']) ? sanitize_text_field($_POST['startTime']) : '';
    $end_time = isset($_POST['endTime']) ? sanitize_text_field($_POST['endTime']) : $start_time;
    $description = isset($_POST['description']) && !empty($_POST['description']) ? sanitize_text_field($_POST['description']) : '';
    $color = isset($_POST['color']) && !empty($_POST['color']) ? sanitize_hex_color($_POST['color']) : '#3788d8';

    // Handle recurrence fields
    if (isset($_POST['recurrence']) && !empty($_POST['recurrence'])) {
        $recurrence = sanitize_text_field($_POST['recurrence']);
        if (isset($_POST['customInterval']) && !empty($_POST['customInterval'])) {
            $custom_interval = intval($_POST['customInterval']);
        } else {
            $custom_interval = null;
        }
        if (isset($_POST['customFrequency']) && !empty($_POST['customFrequency'])) {
            $custom_frequency = sanitize_text_field($_POST['customFrequency']);
        } else {
            $custom_frequency = '';
        }
    } else {
        $recurrence = '';
        $custom_interval = null;
        $custom_frequency = '';
    }

    // Prepare data array
    $data = array(
        'registration_id'    => $registration_id,
        'title'              => $title,
        'description'        => $description,
        'start_date'         => $start_date,
        'end_date'           => $end_date,
        'start_time'         => $start_time,
        'end_time'           => $end_time,
        'color'              => $color,
        'recurrence'         => $recurrence,
        'custom_interval'    => $custom_interval,
        'custom_frequency'   => $custom_frequency,
    );

    // print_r($data);
    // Validate required fields
    if (empty($registration_id) || empty($title) || empty($start_date) || empty($start_time)) {
        wp_send_json_error(array('success' => false, 'message' => 'Required fields are missing.'));
    }
    $table = $wpdb->prefix . 'tsc_custom_events';
    
    $inserted = $wpdb->insert($table, $data);

    if ($inserted) {
        wp_send_json_success(array('success' => true, 'message' => 'Event saved successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to save event.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_save_custom_event_data', 'ajax_handle_save_custom_event_data');
add_action('wp_ajax_ajax_handle_save_custom_event_data', 'ajax_handle_save_custom_event_data');

// For Update custom event data
function ajax_handle_update_custom_event_data(){
    global $wpdb;
    $table = $wpdb->prefix . 'tsc_custom_events';
    // Retrieve and sanitize POST data
    $registration_id = get_current_user_id();
    $event_id = intval($_POST['editEventId']);
    $title = isset($_POST['editTitle']) ? sanitize_text_field($_POST['editTitle']) : '';
    $start_date = isset($_POST['editStartDate']) ? sanitize_text_field($_POST['editStartDate']) : '';
    $end_date = isset($_POST['editEndDate']) ? sanitize_text_field($_POST['editEndDate']) : $start_date;
    $start_time = isset($_POST['editStartTime']) ? sanitize_text_field($_POST['editStartTime']) : '';
    $end_time = isset($_POST['editEndTime']) ? sanitize_text_field($_POST['editEndTime']) : $start_time;
    $description = isset($_POST['editDescription']) && !empty($_POST['editDescription']) ? sanitize_text_field($_POST['editDescription']) : '';
    $color = isset($_POST['editColor']) && !empty($_POST['editColor']) ? sanitize_hex_color($_POST['editColor']) : '#3788d8';
    $hideEvent = isset($_POST['editHideEvent']) ? sanitize_text_field($_POST['editHideEvent']) : '0';

    // Handle recurrence fields
    if (isset($_POST['editRecurrence']) && !empty($_POST['editRecurrence'])) {
        $recurrence = sanitize_text_field($_POST['editRecurrence']);
        if (isset($_POST['editCustomInterval']) && !empty($_POST['editCustomInterval'])) {
            $custom_interval = intval($_POST['editCustomInterval']);
        } else {
            $custom_interval = null;
        }
        if (isset($_POST['editCustomFrequency']) && !empty($_POST['editCustomFrequency'])) {
            $custom_frequency = sanitize_text_field($_POST['editCustomFrequency']);
        } else {
            $custom_frequency = '';
        }
    } else {
        $recurrence = '';
        $custom_interval = null;
        $custom_frequency = '';
    }

    // Prepare data array
    $data = array(
        'title'              => $title,
        'description'        => $description,
        'start_date'         => $start_date,
        'end_date'           => $end_date,
        'hidden'             => $hideEvent,
        'start_time'         => $start_time,
        'end_time'           => $end_time,
        'color'              => $color,
        'recurrence'         => $recurrence,
        'custom_interval'    => $custom_interval,
        'custom_frequency'   => $custom_frequency,
    );

    // Validate required fields
    if (empty($registration_id) || empty($title) || empty($start_date) || empty($start_time)){
        wp_send_json_error(array('success' => false, 'message' => 'Required fields are missing.'));
    }
    
    $inserted = $wpdb->update($table, $data, array('id' => $event_id));
    if ($inserted === false) {
        wp_send_json_error(array(
            'success' => false,
            'message' => 'Failed to update event.',
            'error' => $wpdb->last_error,
        ));
    } elseif ($inserted === 0) {
        wp_send_json_success(array('success' => true, 'message' => 'No changes made.'));
    } else {
        wp_send_json_success(array('success' => true, 'message' => 'Event updated successfully.'));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_update_custom_event_data', 'ajax_handle_update_custom_event_data');
add_action('wp_ajax_ajax_handle_update_custom_event_data', 'ajax_handle_update_custom_event_data');

// For Custom event data drag and drop update
function ajax_handle_drag_drop_update_event_date(){
    global $wpdb;
    $table = $wpdb->prefix . 'tsc_custom_events';
    $event_id = intval($_POST['event_id']);
    $date = sanitize_text_field($_POST['date']);

    $data = array(
        'date' => $date,
    );

    $inserted = $wpdb->update($table, $data, array('id' => $event_id));
    if ($inserted) {
        wp_send_json_success(array('success' => true, 'message' => 'Event date updated successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to update event date.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_drag_drop_update_event_date', 'ajax_handle_drag_drop_update_event_date');
add_action('wp_ajax_ajax_handle_drag_drop_update_event_date', 'ajax_handle_drag_drop_update_event_date');

// For delete custom event data
function ajax_handle_delete_custom_event_data(){
    global $wpdb;
    $table = $wpdb->prefix . 'tsc_custom_events';
    $event_id = intval($_POST['event_id']);

    $deleted = $wpdb->delete($table, array('id' => $event_id));

    if ($deleted) {
        wp_send_json_success(array('success' => true, 'message' => 'Event deleted successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to delete event.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_delete_custom_event_data', 'ajax_handle_delete_custom_event_data');
add_action('wp_ajax_ajax_handle_delete_custom_event_data', 'ajax_handle_delete_custom_event_data');

// For Add/ Update student class in calendar
function ajax_handle_add_student_class_in_calendar(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    $event_id = intval($_POST['editEventId']);
    $event_type = sanitize_text_field($_POST['editEventType']);
    $title = isset($_POST['editTitle']) ? sanitize_text_field($_POST['editTitle']) : '';
    $start_date = isset($_POST['editStartDate']) ? sanitize_text_field($_POST['editStartDate']) : '';
    $end_date = isset($_POST['editEndDate']) ? sanitize_text_field($_POST['editEndDate']) : $start_date;
    $start_time = isset($_POST['editStartTime']) ? sanitize_text_field($_POST['editStartTime']) : '';
    $end_time = isset($_POST['editEndTime']) ? sanitize_text_field($_POST['editEndTime']) : $start_time;
    $description = isset($_POST['editDescription']) && !empty($_POST['editDescription']) ? sanitize_text_field($_POST['editDescription']) : '';
    $color = isset($_POST['editColor']) && !empty($_POST['editColor']) ? sanitize_hex_color($_POST['editColor']) : '#3788d8';
    $class_schedule = isset($_POST['editClassSchedule']) ? sanitize_text_field($_POST['editClassSchedule']) : '';
    $hideEvent = isset($_POST['editHideEvent']) ? sanitize_text_field($_POST['editHideEvent']) : '0';

    // Prepare data array
    $data = array(
        'registration_id'    => $registration_id,
        'title'              => $title,
        'description'        => $description,
        'start_date'         => $start_date,
        'end_date'           => $end_date,
        'start_time'         => $start_time,
        'end_time'           => $end_time,
        'color'              => $color,
        'class_schedule'     => $class_schedule, 
        'hidden'             => $hideEvent,
        'source'             => 'class',
    );

    // Validate required fields
    if (empty($registration_id) || empty($title) || empty($start_date) || empty($start_time)) {
        wp_send_json_error(array('success' => false, 'message' => 'Required fields are missing.'));
    }

    $table = $wpdb->prefix . 'tsc_custom_events';

    if ($event_id != 0) {
        // Update existing event
        $updated = $wpdb->update($table, $data, array('id' => $event_id));
       
        if ($updated === false) {
            wp_send_json_error(array('success' => false, 'message' => 'Failed to update event.', 'error' => $wpdb->last_error));
        } elseif ($updated === 0) {
            wp_send_json_success(array('success' => true, 'message' => 'No changes made.', 'event_id' =>$event_id));
        } else {
            wp_send_json_success(array('success' => true, 'message' => 'Event updated successfully.', 'event_id' =>$event_id));
        }
    } else {
        // Insert new event
        $inserted = $wpdb->insert($table, $data);
        if ($inserted) {
            wp_send_json_success(array('success' => true, 'message' => 'Event saved successfully.', 'event_id' => $wpdb->insert_id));
        } else {
            wp_send_json_error(array('success' => false, 'message' => 'Failed to save event.', 'error' => $wpdb->last_error));
        }
    }

}
add_action('wp_ajax_nopriv_ajax_handle_add_student_class_in_calendar', 'ajax_handle_add_student_class_in_calendar');
add_action('wp_ajax_ajax_handle_add_student_class_in_calendar', 'ajax_handle_add_student_class_in_calendar');

// Get all data for a specific registration id for Course page 
function get_registration_data_course(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    $student_table = $wpdb->prefix . 'tsc_student_information';

    $registration_status = get_user_meta($registration_id, 'registration_status', true);

    if($registration_status == 'create')
    {
        // get the gmail of the user
        $user = get_userdata($registration_id);
        $email = $user->user_email;
        wp_send_json_success(array('success' => false, 'status' => 'Not Started', 'email' => $email));
    }
    else {
        $data = array();

        // Get registration data
        $data['status'] = $registration_status;
        
        // Get student data
        $student_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $student_table WHERE registration_id = %d AND registration_status = 'complete'", $registration_id), ARRAY_A);
        if ($student_data) {
            $data['student_data'] = $student_data;
        }

        // Get user event data
        $event_table = $wpdb->prefix . 'tsc_custom_events';
        $event_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $event_table WHERE registration_id = %d AND source = 'class'", $registration_id), ARRAY_A);
        if ($event_data) {
            $data['event_data'] = $event_data;
        } else {
            $data['event_data'] = array();
        }

        wp_send_json(array('success' => true, 'data' => $data));
    }

}
add_action('wp_ajax_nopriv_get_registration_data_course', 'get_registration_data_course');
add_action('wp_ajax_get_registration_data_course', 'get_registration_data_course');

// Save course data
function save_student_course() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $student_id = intval($_POST['student_id']);
    $student_course_data = json_decode(stripslashes($_POST['student_course']), true);
    $table = $wpdb->prefix . 'tsc_student_information';

    $data = [
        'student_course' => wp_json_encode($student_course_data),
        'submitted_at' => current_time('mysql'),
    ];

    $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d AND id = %d", $registration_id, $student_id));
    if ($check) {
        $inserted = $wpdb->update($table, $data, ['id' => $check]);
    }
    if ($inserted!==false) {
        wp_send_json_success(['success' => true, 'message' => 'Student course information saved successfully.']);
    } else {
        wp_send_json_error(['success' => false, 'message' => 'Failed to save student course information.', 'error' => $wpdb->last_error]);
    }
}
add_action('wp_ajax_nopriv_save_student_course', 'save_student_course');
add_action('wp_ajax_save_student_course', 'save_student_course');

// For Student Transcript data
function get_student_transcript_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.', 'transcript_data' => []));
        return;
    }
    $registration_id = get_current_user_id();
    $student_table = $wpdb->prefix . 'tsc_student_information';
    $attendance_table = $wpdb->prefix . 'tsc_students_attendance';
    $parent_address_table = $wpdb->prefix . 'tsc_parent_address';
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';

    // Get all students for this registration
    $students = $wpdb->get_results($wpdb->prepare(
        "SELECT id, 
                first_name,
                middle_name,
                last_name,
                CONCAT(first_name,' ',middle_name,' ',last_name) as student_name,
                student_profile_pic,
                grade,
                dob,
                gender,
                student_course
         FROM $student_table 
         WHERE registration_id = %d
         AND registration_status = 'complete'", 
        $registration_id
    ), ARRAY_A);

    $data = array();

    $address = $wpdb->get_row($wpdb->prepare("SELECT * FROM $parent_address_table WHERE registration_id = %d", $registration_id), ARRAY_A);
    $parent_data = $wpdb->get_row($wpdb->prepare("SELECT 
     email,
     phone,
     country_code
     FROM $parent_table WHERE registration_id = %d AND type = 'parent_1'", $registration_id));

    if ($students) {
        foreach ($students as $student) {
            // Get attendance data for this student
            $attendance = $wpdb->get_results($wpdb->prepare(
                "SELECT year, fall_semester as fall, spring_semester as spring, summer_semester as summer
                 FROM $attendance_table 
                 WHERE student_id = %d",
                $student['id']
            ), ARRAY_A);

            $data[] = array(
                'student_id' => $student['id'],
                'first_name' => $student['first_name'],
                'middle_name' => $student['middle_name'],
                'last_name' => $student['last_name'],
                'student_name' => $student['student_name'],
                'student_grade' => $student['grade'],
                'photo' => $student['student_profile_pic'],
                'dob' => $student['dob'],
                'course_data' => json_decode($student['student_course'], true),
                'attendance' => $attendance ? $attendance : [],
                'address' => $address,
                'parent_email' => $parent_data->email,
                'gender' => $student['gender'],
                'parent_phone' => $parent_data->phone,
                'country_code' => $parent_data->country_code
            );
        }
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_student_transcript_data', 'get_student_transcript_data');
add_action('wp_ajax_get_student_transcript_data', 'get_student_transcript_data');


// For Student's Official Transcript data
function get_student_official_transcript_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.', 'transcript_data' => []));
        return;
    }
    $registration_id = get_current_user_id();

    $student_table = $wpdb->prefix . 'tsc_student_information';
    $attendance_table = $wpdb->prefix . 'tsc_students_attendance';
    $parent_address_table = $wpdb->prefix . 'tsc_parent_address';
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';

    $student_id = $_REQUEST['student_id'];

    // echo $registration_id;

    // Get all students for this registration
    $students = $wpdb->get_results($wpdb->prepare(
        "SELECT id, 
                first_name,
                middle_name,
                last_name,
                CONCAT(first_name,' ',middle_name,' ',last_name) as student_name,
                student_profile_pic,
                grade,
                dob,
                gender,
                student_course
         FROM $student_table 
         WHERE id = %d
         AND registration_status = 'complete'", 
        $student_id
    ), ARRAY_A);

    $data = array();

    $address = $wpdb->get_row($wpdb->prepare("SELECT * FROM $parent_address_table WHERE registration_id = %d", $registration_id), ARRAY_A);
    $parent_data = $wpdb->get_row($wpdb->prepare("SELECT 
     email,
     phone,
     country_code
     FROM $parent_table WHERE registration_id = %d AND type = 'parent_1'", $registration_id));

    if ($students) {
        foreach ($students as $student) {
            // Get attendance data for this student
            $attendance = $wpdb->get_results($wpdb->prepare(
                "SELECT year, fall_semester as fall, spring_semester as spring, summer_semester as summer
                 FROM $attendance_table 
                 WHERE student_id = %d",
                $student['id']
            ), ARRAY_A);

            $data[] = array(
                'student_id' => $student['id'],
                'first_name' => $student['first_name'],
                'middle_name' => $student['middle_name'],
                'last_name' => $student['last_name'],
                'student_name' => $student['student_name'],
                'student_grade' => $student['grade'],
                'photo' => $student['student_profile_pic'],
                'dob' => $student['dob'],
                'course_data' => json_decode($student['student_course'], true),
                'attendance' => $attendance ? $attendance : [],
                'address' => $address,
                'parent_email' => $parent_data->email,
                'gender' => $student['gender'],
                'parent_phone' => $parent_data->phone,
                'country_code' => $parent_data->country_code
            );
        }
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_student_official_transcript_data', 'get_student_official_transcript_data');
add_action('wp_ajax_get_student_official_transcript_data', 'get_student_official_transcript_data');

// For get Student data by registration id where 'registration_status' !== 'complete'
function get_incomplete_student_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.', 'student_data' => []));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $table = $wpdb->prefix . 'tsc_student_information';
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';

    // get user email id
    $user = get_userdata($registration_id);
    $email = $user->user_email;
    $data = array();

    // For Fees settings
    $settings_page_id = 380;

   
    $parent_1_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $parent_table WHERE registration_id = %d AND type = 'parent_1'", $registration_id), ARRAY_A);
    if (!$parent_1_data) {
        wp_send_json(array('success' => false, 'message' => 'Parent 1 data not found.'));
    }
    $data['year_paying'] = $parent_1_data['year_paying'];

    $data['each_student_pay_below_8'] = get_field('each_student_pay_below_8', $settings_page_id);
    $data['each_student_pay_after_8'] = get_field('each_student_pay_after_8', $settings_page_id);
    $data['processing_fee'] = get_field('processing_fee', $settings_page_id);
    $data['transfer_fee'] = get_field('transfer_fee', $settings_page_id);
    $data['family_app_fee'] = get_field('family_app_fee', $settings_page_id);

    $student_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE registration_id = %d AND registration_status != 'complete'", $registration_id), ARRAY_A);
    if ($student_data) {
        $data['student_data'] = $student_data;
    }
    else {
        $data['student_data'] = [];
    }

    wp_send_json(array('success' => true, 'data' => $data, 'email' => $email));
}
add_action('wp_ajax_nopriv_get_incomplete_student_data', 'get_incomplete_student_data');
add_action('wp_ajax_get_incomplete_student_data', 'get_incomplete_student_data');

// For get Student data by registration id where 'registration_status' === 'complete'
function get_complete_student_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $registration_table = $wpdb->prefix . 'tsc_school_registration';
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';
    $additional_info_table = $wpdb->prefix . 'tsc_additional_information';
    $student_application_table = $wpdb->prefix . 'tsc_student_application';
    $parent_address_table = $wpdb->prefix . 'tsc_parent_address';
    $student_table = $wpdb->prefix . 'tsc_student_information';

    $registration_status = get_user_meta($registration_id, 'registration_status', true);

    $registration_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $registration_table WHERE id = %d", $registration_id));

    $data = array();

    // Get registration data
    $data['status'] = $registration_status;

    // Get parent 1 data
    $parent_1_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $parent_table WHERE registration_id = %d AND type = 'parent_1'", $registration_id), ARRAY_A);
    if (!$parent_1_data) {
        wp_send_json(array('success' => false, 'message' => 'Parent 1 data not found.'));
    }
    $data['parent_1_data'] = $parent_1_data;

    // Get parent 2 data
    $parent_2_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $parent_table WHERE registration_id = %d AND type = 'parent_2'", $registration_id), ARRAY_A);
    if ($parent_2_data) {
        $data['parent_2_data'] = $parent_2_data;
    }

    // Get additional info data
    $additional_info_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $additional_info_table WHERE registration_id = %d", $registration_id), ARRAY_A);
    if ($additional_info_data) {
        $data['additional_info_data'] = $additional_info_data;
    }

    // Get student application data
    $student_application_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $student_application_table WHERE registration_id = %d", $registration_id), ARRAY_A);
    if ($student_application_data) {
        $data['student_application_data'] = $student_application_data;
    }

    // Get parent address data
    $parent_address_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $parent_address_table WHERE registration_id = %d", $registration_id), ARRAY_A);
    if ($parent_address_data) {
        $data['parent_address_data'] = $parent_address_data;
    }

    // Get student data
    $student_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM  $student_table WHERE registration_id = %d AND registration_status = 'complete'", $registration_id), ARRAY_A);
    if ($student_data) {
        $data['student_data'] = $student_data;
    }

    wp_send_json(array('success' => true, 'data' => $data));

}
add_action('wp_ajax_nopriv_get_complete_student_data', 'get_complete_student_data');
add_action('wp_ajax_get_complete_student_data', 'get_complete_student_data');

// For Save Graduate data
function ajax_handle_save_graduate_data(){
    global $wpdb;
    // Retrieve and sanitize POST data
    $registration_id = get_current_user_id();
    $student_id = intval($_POST['student_id']);
    $graduation_student_name = isset($_POST['student_name']) ? sanitize_text_field($_POST['student_name']) : '';
    $graduate_data = json_decode(stripslashes($_POST['graduate_data']), true);

    $table = $wpdb->prefix . 'tsc_graduate_student';

    $data = array(
        'registration_id' => $registration_id,
        'student_id' => $student_id,
        'student_name' => $graduation_student_name,
        'graduate_data' => json_encode($graduate_data),
        'submitted_at' => current_time('mysql'),
        'updated_at' => current_time('mysql'),
    );
    
    $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d AND student_id = %d", $registration_id, $student_id));

    if ($check) {
        $result = $wpdb->update($table, $data, array('id' => $check));
    } else {
        $result = $wpdb->insert($table, $data);
    }
    
    if ($result) {
        wp_send_json(array('success' => true, 'message' => 'Graduate data saved successfully.'));
    } else {
        wp_send_json(array('success' => false, 'message' => 'Failed to save graduate data.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_save_graduate_data', 'ajax_handle_save_graduate_data');
add_action('wp_ajax_ajax_handle_save_graduate_data', 'ajax_handle_save_graduate_data');

// For Get My account data
function get_my_account_data() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Not logged in'));
        return;
    }

    // Get current user ID
    $user_id = get_current_user_id();
    
    // Get user role
    $user = get_userdata($user_id);
    $user_role = $user->roles[0];

    // Get data from registration table
    $registration_table = $wpdb->prefix . 'tsc_school_registration';
    $reg_data = $wpdb->get_row($wpdb->prepare(
        "SELECT email FROM {$registration_table} WHERE id = %d",
        $user_id
    ));

    // Get data from parent table
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';
    $parent_data = $wpdb->get_row($wpdb->prepare(
        "SELECT id, first_name, middle_name, last_name, profile_image 
            FROM {$parent_table} 
            WHERE registration_id = %d AND type = 'parent_1'",
        $user_id
    ));

    $response = array(
        'success' => true,
        'data' => array(
            'user_role' => $user_role,
            'email' => $reg_data ? $reg_data->email : '',
            'parent_id' => $parent_data ? $parent_data->id : '',
            'first_name' => $parent_data ? $parent_data->first_name : '',
            'middle_name' => $parent_data ? $parent_data->middle_name : '',
            'last_name' => $parent_data ? $parent_data->last_name : '',
            'profile_image' => $parent_data ? $parent_data->profile_image : '',
        )
    );

    wp_send_json($response);
}
add_action('wp_ajax_nopriv_get_my_account_data', 'get_my_account_data');
add_action('wp_ajax_get_my_account_data', 'get_my_account_data');

// For Update My account data
function update_my_account_data() {
    if (!is_user_logged_in()) {
        wp_send_json_error(['success' => false, 'message' => 'Not logged in']);
        return;
    }

    global $wpdb;
    $user_id = get_current_user_id();

    // Sanitize and validate input data
    $input = array(
        'parent_id' => intval($_POST['parent_id']),
        'first_name' => sanitize_text_field($_POST['first_name']),
        'middle_name' => sanitize_text_field($_POST['middle_name']),
        'last_name' => sanitize_text_field($_POST['last_name']),
        'email' => sanitize_email($_POST['email']),
        'old_password' => isset($_POST['old_password']) ? sanitize_text_field($_POST['old_password']) : '',
        'new_password' => isset($_POST['new_password']) ? sanitize_text_field($_POST['new_password']) : ''
    );

    // Validate email
    if (!is_email($input['email'])) {
        wp_send_json_error(['success' => false, 'message' => 'Invalid email format']);
        return;
    }

    // Check email uniqueness
    $existing_user = get_user_by('email', $input['email']);
    if ($existing_user && $existing_user->ID != $user_id) {
        wp_send_json_error(['success' => false, 'message' => 'Email already exists']);
        return;
    }

    // Prepare update data
    $parent_data = array(
        'first_name' => $input['first_name'],
        'middle_name' => $input['middle_name'],
        'last_name' => $input['last_name'],
        'email' => $input['email']
    );

    $tables = array(
        'parent' => $wpdb->prefix . 'tsc_parent_registration',
        'registration' => $wpdb->prefix . 'tsc_school_registration'
    );

    // Start transaction
    $wpdb->query('START TRANSACTION');

    try {
        // Update parent data
        $updated_parent = $wpdb->update(
            $tables['parent'], 
            $parent_data, 
            ['id' => $input['parent_id']]
        );

        if ($updated_parent === false) {
            throw new Exception('Failed to update parent data');
        }

        // Handle password update if provided
        if (!empty($input['old_password']) && !empty($input['new_password'])) {

            $user = get_user_by('ID', $user_id);
            
            if (!wp_check_password($input['old_password'], $user->data->user_pass, $user_id)) {
            throw new Exception('Current password is incorrect');
            }

            if ($input['old_password'] === $input['new_password']) {
            throw new Exception('New password must be different from current password');
            }

            // Store the current auth cookie
            $auth_cookie = wp_parse_auth_cookie('', 'logged_in');
            
            // Update WordPress password
            wp_set_password($input['new_password'], $user_id);
            
            // Re-authenticate the user to prevent logout
            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);

            // Update registration table
            $updated_registration = $wpdb->update(
                $tables['registration'],
                [
                    'password' => wp_hash_password($input['new_password']),
                    'email' => $input['email']
                ],
                ['id' => $user_id]
            );

            // send email to user
            $subject = 'Password Reset Successful';
            $headers = array(
                'Content-Type: text/html; charset=UTF-8',
                'From: Graduates Academy <no-reply@graduatesacademy.com>'
            );
            $message = '<html>
            <body style="font-family: \'Segoe UI\', Roboto, Arial, sans-serif; background-color: #f8f9fa; margin: 0; padding: 20px; color: #212529;">
                <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                    <!-- Header -->
                    <div style="text-align: center; margin-bottom: 25px; border-bottom: 2px solid #e9ecef; padding-bottom: 15px;">
                        <h2 style="color: #0d6efd; margin: 0; font-weight: 600;">Password Changed Successfully</h2>
                    </div>
                    
                    <!-- Main Message -->
                    <div style="padding: 20px; background-color: #e9f5fe; border-left: 4px solid #0d6efd; border-radius: 4px; margin-bottom: 25px;">
                        <p style="font-size: 16px; margin: 0;">This is a confirmation that your account password has been updated.</p>
                    </div>
                    
                    <!-- Message Details -->
                    <div style="margin-bottom: 25px;">
                        <p style="font-size: 16px; line-height: 1.6; margin-bottom: 15px;">Dear Account Holder,</p>
                        <p style="font-size: 16px; line-height: 1.6; margin-bottom: 15px;">Your password for <strong>' . htmlspecialchars(get_bloginfo('name')) . '</strong> has been successfully changed.</p>
                        <p style="font-size: 16px; line-height: 1.6; margin-bottom: 15px;">For your records, your new password is:</p>
                        <div style="text-align: center; margin: 20px 0;">
                            <span style="background-color: #f8f9fa; padding: 8px 16px; border-radius: 4px; font-family: monospace; font-weight: bold; border: 1px solid #dee2e6;">' . $input['new_password'] . '</span>
                        </div>
                        <p style="font-size: 16px; line-height: 1.6;">For security purposes, we recommend changing this password to something memorable after your next login.</p>
                    </div>
                    
                    <!-- Security Notice -->
                    <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; border-radius: 4px; margin: 25px 0;">
                        <p style="font-size: 15px; margin: 0;"><strong>Security Notice:</strong> If you did not initiate this password change, please contact our support team immediately at < <a href="mailto:admin@graduatesacademy.com" style="color: #3a6ea5; text-decoration: none;">admin@graduatesacademy.com</a>.</p>
                    </div>
                    
                    <!-- Footer -->
                    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e9ecef;">
                        <p style="font-size: 16px; line-height: 1.6; margin-bottom: 5px;">Sincerely,</p>
                        <p style="font-size: 16px; line-height: 1.6; font-weight: 600; margin-bottom: 25px;">The ' . htmlspecialchars(get_bloginfo('name')) . ' Team</p>
                        
                        <div style="text-align: center; margin-top: 20px;">
                            ' . (!empty($logo_url) ? '<img src="' . esc_url($logo_url) . '" alt="' . get_bloginfo('name') . '" style="max-width: 150px; height: auto;" />' : '<h3>' . get_bloginfo('name') . '</h3>') . '
                            <p style="color: #6c757d; font-size: 14px; margin-top: 15px;">© ' . date('Y') . ' ' . htmlspecialchars(get_bloginfo('name')) . '. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </body>
            </html>';

            wp_mail($input['email'], $subject, $message, $headers);

        } else {
            // Update only email in registration table
            $updated_registration = $wpdb->update(
                $tables['registration'],
                ['email' => $input['email']],
                ['id' => $user_id]
            );
        }

        if ($updated_registration === false) {
            throw new Exception('Failed to update registration data');
        }

        // Update WordPress user email
        $updated_wp_user = wp_update_user([
            'ID' => $user_id,
            'user_email' => $input['email']
        ]);

        if (is_wp_error($updated_wp_user)) {
            throw new Exception($updated_wp_user->get_error_message());
        }

        $wpdb->query('COMMIT');
        wp_send_json_success(['success' => true, 'message' => 'Profile updated successfully']);

    } catch (Exception $e) {
        $wpdb->query('ROLLBACK');
        wp_send_json_error(['success' => false, 'message' => $e->getMessage()]);
    }
}
add_action('wp_ajax_nopriv_update_my_account_data', 'update_my_account_data');
add_action('wp_ajax_update_my_account_data', 'update_my_account_data');

// For get Portfolio data and get all student data for a specific registration id
function get_portfolio_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.', 'portfolio_data' => []));
        return;
    }

    $registration_id = get_current_user_id();
    $table = $wpdb->prefix . 'tsc_student_portfolio';
    $student_table = $wpdb->prefix . 'tsc_student_information';

    $data = array();

    $student_data = $wpdb->get_results($wpdb->prepare(
        "SELECT id, CONCAT(first_name, ' ', middle_name, ' ', last_name) as student_name 
         FROM $student_table 
         WHERE registration_id = %d AND registration_status = 'complete'", 
        $registration_id
    ), ARRAY_A);

    if ($student_data) {
        $data['student_data'] = $student_data;
    }
    else {
        $data['student_data'] = [];
    }
    
    $portfolio_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE registration_id = %d", $registration_id), ARRAY_A);
    if ($portfolio_data && $student_data) {
        $data['portfolio_data'] = $portfolio_data;
    }
    else {
        $data['portfolio_data'] = [];
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_portfolio_data', 'get_portfolio_data');
add_action('wp_ajax_get_portfolio_data', 'get_portfolio_data');

// For save portfolio data
function save_portfolio_data(){
    // print_r($_POST);
    global $wpdb;
    // Retrieve and sanitize POST data
    $registration_id = get_current_user_id();
    $student_id = intval($_POST['student_id']);
    $document_type = sanitize_text_field($_POST['document_type']);
    $title = sanitize_text_field($_POST['title']);
    $description = sanitize_textarea_field($_POST['description']); 
    $file_name = sanitize_text_field($_POST['file_name']);
    $student_name = sanitize_text_field($_POST['student_name']);

    // Handle file upload
    if(isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $upload_dir = wp_upload_dir();
        $upload_path = $upload_dir['path'];
        $upload_url = $upload_dir['url'];
        
        // Generate unique filename
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $unique_filename = uniqid() . '.' . $extension;
        $file_path = $upload_path . '/' . $unique_filename;
        
        if(move_uploaded_file($file['tmp_name'], $file_path)) {
            $document_url = $upload_url . '/' . $unique_filename;
            
            $table = $wpdb->prefix . 'tsc_student_portfolio';
            
            $data = array(
                'registration_id' => $registration_id,
                'student_id' => intval($_POST['student_id']), 
                'student_name' => $student_name,
                'document_type' => $document_type,
                'title' => $title,
                'description' => $description,
                'document_name' => $file_name,
                'document_url' => $document_url,
                'submitted_at' => current_time('mysql')
            );

            $inserted = $wpdb->insert($table, $data);
            
            if($inserted) {
                wp_send_json_success(array(
                    'success' => true, 
                    'message' => 'Portfolio document saved successfully',
                    'document_url' => $document_url
                ));
            } else {
                wp_send_json_error(array(
                    'success' => false,
                    'message' => 'Failed to save portfolio document',
                    'error' => $wpdb->last_error
                ));
            }
        } else {
            wp_send_json_error(array(
                'success' => false,
                'message' => 'Failed to upload file'
            ));
        }
    } else {
        wp_send_json_error(array(
            'success' => false,
            'message' => 'No file uploaded'
        ));
    }

}
add_action('wp_ajax_nopriv_save_portfolio_data', 'save_portfolio_data');
add_action('wp_ajax_save_portfolio_data', 'save_portfolio_data');

// For delete portfolio data
function delete_document(){
    global $wpdb;
    $table = $wpdb->prefix . 'tsc_student_portfolio';
    $document_id = intval($_POST['document_id']);

    $document = $wpdb->get_row($wpdb->prepare("SELECT document_url FROM $table WHERE id = %d", $document_id));
    if ($document) {
        $deleted = $wpdb->delete($table, array('id' => $document_id));
        if ($deleted) {
            // Delete the file
            $file_path = str_replace(site_url(), ABSPATH, $document->document_url);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            wp_send_json_success(array('success' => true, 'message' => 'Document deleted successfully'));
        } else {
            wp_send_json_error(array('success' => false, 'message' => 'Failed to delete document', 'error' => $wpdb->last_error));
        }
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Document not found'));
    }
}
add_action('wp_ajax_nopriv_delete_document', 'delete_document');
add_action('wp_ajax_delete_document', 'delete_document');

// Get Renew Student 
function get_renew_student_data() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $settings_page_id = 380;

    $fee_data = array();
    $fee_data['each_student_pay_below_8'] = get_field('each_student_pay_below_8', $settings_page_id);
    $fee_data['each_student_pay_after_8'] = get_field('each_student_pay_after_8', $settings_page_id);
    $fee_data['processing_fee'] = get_field('processing_fee', $settings_page_id);
    $fee_data['transfer_fee'] = get_field('transfer_fee', $settings_page_id);
    $fee_data['reinstatement_fees'] = get_field('reinstatement_fess', $settings_page_id);
    $fee_data['renewal_app_fee'] = get_field('renewal_app_fee', $settings_page_id);

    $registration_id = get_current_user_id();
    $student_id = intval($_POST['student_id']);
    $student_table = $wpdb->prefix . 'tsc_student_information';

    $student = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $student_table WHERE registration_id = %d AND id = %d",
        $registration_id,
        $student_id
    ));

    $parent_table = $wpdb->prefix . 'tsc_parent_registration';

    $parent_data = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $parent_table WHERE registration_id = %d AND type = 'parent_1'",
        $registration_id
    ));

    $parent_address_table = $wpdb->prefix . 'tsc_parent_address';

    $address = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $parent_address_table WHERE registration_id = %d",
        $registration_id
    ));

    if ($student && $parent_data && $address){
        wp_send_json(array('success' => true, 'student_data' => $student, 'address'=> $address, 'parent_data'=>$parent_data , 'fee_data' => $fee_data));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Student or parent data not found.'));
    }
}
add_action('wp_ajax_nopriv_get_renew_student_data', 'get_renew_student_data');
add_action('wp_ajax_get_renew_student_data', 'get_renew_student_data');


// Get All Renew Student data
function get_all_renew_student_data() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $settings_page_id = 380;

    $fee_data = array();
    $fee_data['each_student_pay_below_8'] = get_field('each_student_pay_below_8', $settings_page_id);
    $fee_data['each_student_pay_after_8'] = get_field('each_student_pay_after_8', $settings_page_id);
    $fee_data['processing_fee'] = get_field('processing_fee', $settings_page_id);
    $fee_data['transfer_fee'] = get_field('transfer_fee', $settings_page_id);
    $fee_data['reinstatement_fees'] = get_field('reinstatement_fess', $settings_page_id);
    $fee_data['renewal_app_fee'] = get_field('renewal_app_fee', $settings_page_id);

    $registration_id = get_current_user_id();
    $student_table = $wpdb->prefix . 'tsc_student_information';

    $student = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $student_table WHERE registration_id = %d AND registration_status = 'complete'",
        $registration_id
    ), ARRAY_A);

    $parent_table = $wpdb->prefix . 'tsc_parent_registration';

    $parent_data = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $parent_table WHERE registration_id = %d AND type = 'parent_1'",
        $registration_id
    ));

    $parent_address_table = $wpdb->prefix . 'tsc_parent_address';

    $address = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $parent_address_table WHERE registration_id = %d",
        $registration_id
    ));

    if ($student && $parent_data && $address){
        wp_send_json(array('success' => true, 'student_data' => $student, 'address'=> $address, 'parent_data'=>$parent_data , 'fee_data' => $fee_data));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Student or parent data not found.'));
    }
}
add_action('wp_ajax_nopriv_get_all_renew_student_data', 'get_all_renew_student_data');
add_action('wp_ajax_get_all_renew_student_data', 'get_all_renew_student_data');

// For Save Renew Student data and save payment 
function ajax_handle_renewal_submit() {
    global $wpdb;

    if (!is_user_logged_in()) {
        wp_send_json_error(['success' => false, 'message' => 'Not logged in']);
        return;
    }

    $registration_id = get_current_user_id();
    
    // Sanitize and process POST data
    $input = [
        // Transaction details
        'rushfee' => sanitize_text_field($_POST['rushfee']),
        'transaction_id' => sanitize_text_field($_POST['transaction_id']),
        'paidAmount' => floatval($_POST['paidAmount']),
        'coupon_code' => !empty($_POST['coupon_code']) ? sanitize_text_field($_POST['coupon_code']) : '',
        'description' => sanitize_text_field($_POST['description']),
        'transactionItems' => json_decode(stripslashes($_POST['transaction_items'] ?? $_POST['transactionItems']), true),
        
        // Parent details
        'parentId' => sanitize_text_field($_POST['parentId']),
        'f_name' => sanitize_text_field($_POST['f_name']),
        'm_name' => sanitize_text_field($_POST['m_name']),
        'l_name' => sanitize_text_field($_POST['l_name']),
        'email' => sanitize_email($_POST['email']),
        'country_code' => sanitize_text_field($_POST['country_code']),
        'phone' => sanitize_text_field($_POST['phone']),
        
        // Address details
        'addressId' => sanitize_text_field($_POST['addressId']),
        'street_address' => sanitize_text_field($_POST['street_address']),
        'city' => sanitize_text_field($_POST['city']),
        'state' => sanitize_text_field($_POST['state']),
        'zip_code' => sanitize_text_field($_POST['zip_code']),
        'county' => sanitize_text_field($_POST['county']),
        'emergency_name' => sanitize_text_field($_POST['emergency_name']),
        'emergency_country_code' => sanitize_text_field($_POST['emergency_country_code']),
        'emergency_number' => sanitize_text_field($_POST['emergency_number']),
        
        // Signature details
        'privacy_check' => isset($_POST['privacy_check']) ? $_POST['privacy_check'] : false,
        'signature_f_name' => sanitize_text_field($_POST['signature_f_name']),
        'signature_l_name' => sanitize_text_field($_POST['signature_l_name']),
        'signature_date' => sanitize_text_field($_POST['signature_date']),
    ];
    
    // Define tables
    $tables = [
        'registration' => $wpdb->prefix . 'tsc_school_registration',
        'parent' => $wpdb->prefix . 'tsc_parent_registration',
        'address' => $wpdb->prefix . 'tsc_parent_address',
        'student' => $wpdb->prefix . 'tsc_student_information',
        'coupon' => $wpdb->prefix . 'tsc_coupon_codes',
        'transaction' => $wpdb->prefix . 'tsc_transaction',
    ];

    $current_time = current_time('mysql');
    $studentAccountExpire = '';

    // Process student data
    $students_array = json_decode(stripslashes($_POST['student_data']), true);
    
    // Ensure we have a valid array of students
    if (!is_array($students_array)) {
        $students_array = json_decode($students_array, true);
    }
    
    if (empty($students_array) || !is_array($students_array)) {
        wp_send_json_error(['success' => false, 'message' => 'No valid student data provided']);
        return;
    }
    
    // Create digital signature object
    $digital_signature = [
        'check' => $input['privacy_check'],
        'f_name' => $input['signature_f_name'],
        'l_name' => $input['signature_l_name'],
        'date' => $input['signature_date'],
    ];
    
    // Validate transaction details
    if (empty($input['transaction_id']) && $input['paidAmount'] > 0) {
        wp_send_json_error(['success' => false, 'message' => 'Transaction ID required']);
        return;
    }

    // Start transaction to ensure all updates happen or none
    $wpdb->query('START TRANSACTION');
    
    try {
        // 1. Update student records
        foreach ($students_array as $student) {
            if (empty($student['id'])) continue;
            
            $studentId = intval($student['id']);
            $studentGrade = $student['grade'] ?? '';
            $studentExpireDate = $student['new_account_expire'] ?? '';
            
            // Track the latest expiration date
            if (empty($studentAccountExpire) || strtotime($studentExpireDate) > strtotime($studentAccountExpire)) {
                $studentAccountExpire = $studentExpireDate;
            }

            $student_update = [
                'registration_status' => 'complete',
                'grade' => $studentGrade,
                'digital_signature' => wp_json_encode($digital_signature),
                'priority' => $input['rushfee'],
                'transaction_id' => $input['transaction_id'],
                'paid_amount' => $input['paidAmount'],
                'used_coupon_code' => $input['coupon_code'],
                'account_expire' => $studentExpireDate,
                'submitted_at' => $current_time,
            ];
            
            $result = $wpdb->update($tables['student'], $student_update, ['id' => $studentId]);
            if ($result === false) {
                throw new Exception('Failed to update student record: ' . $wpdb->last_error);
            }
        }
        
        // 2. Update registration record
        $updated_reg = $wpdb->update(
            $tables['registration'], 
            ['account_expire' => $studentAccountExpire],
            ['id' => $registration_id]
        );
        
        if ($updated_reg === false) {
            throw new Exception('Failed to update registration record: ' . $wpdb->last_error);
        }

        // 3. Insert transaction record if payment was made
        if ($input['paidAmount'] > 0) {
            $transaction_data = [
                'registration_id' => $registration_id,
                'transaction_id' => $input['transaction_id'],
                'description' => $input['description'],
                'amount' => $input['paidAmount'],
                'transactionItems' => wp_json_encode($input['transactionItems']),
                'expires_at' => $studentAccountExpire,
                'created_at' => $current_time,
            ];
            
            $add_transaction = $wpdb->insert($tables['transaction'], $transaction_data);
            if ($add_transaction === false) {
                throw new Exception('Failed to record transaction: ' . $wpdb->last_error);
            }
        }

        // 4. Update user meta
        update_user_meta($registration_id, 'account_expire', $studentAccountExpire);
        
        // 5. Update parent information
        $parent_data = [
            'first_name' => $input['f_name'],
            'middle_name' => $input['m_name'],
            'last_name' => $input['l_name'],
            'email' => $input['email'],
            'country_code' => $input['country_code'],
            'phone' => $input['phone'],
        ];
        
        $updated_parent = $wpdb->update($tables['parent'], $parent_data, ['id' => $input['parentId']]);
        if ($updated_parent === false) {
            throw new Exception('Failed to update parent information: ' . $wpdb->last_error);
        }

        // 6. Update parent address
        $address_data = [
            'address' => $input['street_address'],
            'city' => $input['city'],
            'state' => $input['state'],
            'zip' => $input['zip_code'],
            'county' => $input['county'],
            'emg_contact_name' => $input['emergency_name'],
            'country_code' => $input['emergency_country_code'],
            'emg_contact_phone' => $input['emergency_number'],
        ];
        
        $updated_address = $wpdb->update($tables['address'], $address_data, ['id' => $input['addressId']]);
        if ($updated_address === false) {
            throw new Exception('Failed to update parent address: ' . $wpdb->last_error);
        }

        // 7. Handle coupon code usage
        if (!empty($input['coupon_code'])) {
            $coupon = $wpdb->get_row($wpdb->prepare(
                "SELECT * FROM {$tables['coupon']} WHERE code = %s", 
                $input['coupon_code']
            ));
            
            if ($coupon) {
                $use_list = json_decode($coupon->use_list, true) ?: [];
                if (!in_array($registration_id, $use_list)) {
                    $use_list[] = $registration_id;
                    $updated_coupon = $wpdb->update(
                        $tables['coupon'],
                        ['use_list' => wp_json_encode($use_list)],
                        ['id' => $coupon->id]
                    );

                    if ($updated_coupon === false) {
                        throw new Exception('Failed to update coupon usage: ' . $wpdb->last_error);
                    }
                }
            }
        }
        
        // Commit the transaction if all steps succeeded
        $wpdb->query('COMMIT');

        // 8. Send notification email to parent
        // Get student names for the email
        $student_names = [];
        foreach ($students_array as $student) {
            if (!empty($student['name']) && !empty($student['grade'])) {
                // Replace '+' with spaces in both name and grade (handle URL encoded values)
                $student_name = str_replace('+', ' ', $student['name']);
                $student_grade = str_replace('+', ' ', $student['grade']);
                // Add formatted student name and grade to the array
                $student_names[] = $student_name . ' (' . $student_grade . ')';
            } elseif (!empty($student['name'])) {
                // Fallback if only name is available
                $student_names[] = str_replace('+', ' ', $student['name']);
            }
        }
                
        // Format expiration date for email
        $formatted_expire_date = date('F j, Y', strtotime($studentAccountExpire));
        
        // Get logo URL with proper fallback
        $logo_url = '';
        $logo_id = get_theme_mod('custom_logo');
        if ($logo_id) {
            $logo_attachment = wp_get_attachment_image_src($logo_id, 'full');
            if ($logo_attachment) {
                $logo_url = $logo_attachment[0];
            }
        }
        
        // Prepare parent name
        $parent_name = trim($input['f_name'] . ' ' . $input['m_name'] . ' ' . $input['l_name']);
        
        // Email subject
        $subject = "Graduates Academy - Registration Renewal Confirmation";
        
        // Email headers
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: Graduates Academy <no-reply@graduatesacademy.com>'
        ];
        
        // Email message
        $message = '
        <html>
        <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 650px; margin: 0 auto; padding: 20px;">
            <div style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 30px; border-top: 5px solid #3a6ea5;">
                <!-- Header with logo -->
                <div style="text-align: center; margin-bottom: 30px;">
                    ' . (!empty($logo_url) ? '<img src="' . esc_url($logo_url) . '" alt="Graduates Academy" style="max-width: 200px; height: auto;" />' : '<h2 style="color: #3a6ea5;">Graduates Academy</h2>') . '
                    <h1 style="color: #3a6ea5; margin-top: 20px; font-size: 24px;">Registration Renewal Confirmation</h1>
                </div>
                
                <!-- Main content -->
                <div style="margin-bottom: 30px;">
                    <p style="font-size: 16px;">Dear ' . esc_html($parent_name) . ',</p>
                    
                    <p style="font-size: 16px;">Thank you for renewing your registration with Graduates Academy. We\'re pleased to confirm that the renewal process has been completed successfully.</p>
                    
                    <div style="background-color: #f5f9ff; border-left: 4px solid #3a6ea5; padding: 15px; margin: 20px 0; border-radius: 4px;">
                        <p style="font-size: 16px; margin: 0;"><strong>Important:</strong> Your registration has been renewed until ' . esc_html($formatted_expire_date) . '.</p>
                    </div>
                    
                    <p style="font-size: 16px;"><strong>The following student(s) have been renewed:</strong></p>
                    <div style="margin: 15px 0;">
                        <table style="width: 100%; border-collapse: collapse; font-size: 15px;">
                            <thead style="background-color: #f5f9ff;">
                                <tr>
                                    <th style="padding: 10px; text-align: left; border: 1px solid #e0e0e0;">Student Name</th>
                                    <th style="padding: 10px; text-align: left; border: 1px solid #e0e0e0;">Grade Level</th>
                                </tr>
                            </thead>
                            <tbody>';
                            
                            // Add each student with name and grade in separate columns
                            foreach ($student_names as $student_entry) {
                                // Split the combined string back into name and grade
                                if (preg_match('/^(.+) \((.+)\)$/', $student_entry, $matches)) {
                                    $name = $matches[1];
                                    $grade = $matches[2];
                                    $message .= '<tr>
                                        <td style="padding: 8px 10px; border: 1px solid #e0e0e0;">' . esc_html($name) . '</td>
                                        <td style="padding: 8px 10px; border: 1px solid #e0e0e0;">' . esc_html($grade) . '</td>
                                    </tr>';
                                } else {
                                    // Fallback if pattern doesn't match
                                    $message .= '<tr>
                                        <td style="padding: 8px 10px; border: 1px solid #e0e0e0;" colspan="2">' . esc_html($student_entry) . '</td>
                                    </tr>';
                                }
                            }
                            
                $message .= '</tbody>
            </table>
        </div>';
        
        // Add transaction details if payment was made
        if ($input['paidAmount'] > 0) {
                        $message .= '
                        <p style="font-size: 16px;"><strong>Transaction Details:</strong></p>
                        <ul style="font-size: 16px;">
                            <li>Transaction ID: ' . esc_html($input['transaction_id']) . '</li>
                            <li>Amount: $' . number_format($input['paidAmount'], 2) . '</li>
                            <li>Date: ' . date('F j, Y') . '</li>
                        </ul>';
                    }
                    
        $message .= '
                    <p style="font-size: 16px;">You can access all your student records, update information, and manage your account by logging into your parent portal.</p>
                </div>
                
                <!-- Call to action -->
                <div style="text-align: center; margin: 30px 0;">
                    <a href="' . esc_url(home_url('/students')) . '" style="background-color: #3a6ea5; color: white; padding: 12px 25px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block;">Access Your Account</a>
                </div>
                
                <!-- Support information -->
                <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-top: 30px;">
                    <p style="font-size: 15px; margin-top: 0;"><strong>Need Help?</strong></p>
                    <p style="font-size: 15px;">If you have any questions about your renewal or need assistance with your account, please contact us:</p>
                    <ul style="font-size: 15px;">
                        <li>Email: <a href="mailto:admin@graduatesacademy.com" style="color: #3a6ea5; text-decoration: none;">admin@graduatesacademy.com</a></li>
                        <li>Phone: (865) 564-4810</li>
                    </ul>
                </div>
                
                <!-- Footer -->
                <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; color: #777; font-size: 14px;">
                    <p>Thank you for choosing Graduates Academy for your educational journey.</p>
                    <p>© ' . date('Y') . ' Graduates Academy. All rights reserved.</p>
                    <p>309 Ebenezer Rd, Knoxville, TN 37923</p>
                </div>
            </div>
        </body>
        </html>';
        
        // Send the email
        $mail_sent = wp_mail($input['email'], $subject, $message, $headers);
        
        if (!$mail_sent) {
            // Log the error but don't fail the transaction
            error_log("Failed to send renewal confirmation email to: " . $input['email']);
        }

        
    } catch (Exception $e) {
        // Rollback on any failure
        $wpdb->query('ROLLBACK');
        wp_send_json_error([
            'success' => false, 
            'message' => $e->getMessage()
        ]);
        return;
    }

    // Send admin notification for high priority renewals
    if ($input['rushfee'] === 'high') {
        $message_type = "High Priority Student Renewal Application";
        $message = "A High Priority renewal application has been submitted. Please review and process it as soon as possible.";
        send_high_priority_admin_notification($registration_id, $input['transaction_id'], $input['paidAmount'], $message_type, $message);
    }

    wp_send_json_success(['success' => true, 'message' => 'Renewal completed successfully']);
}
add_action('wp_ajax_nopriv_ajax_handle_renewal_submit', 'ajax_handle_renewal_submit');
add_action('wp_ajax_ajax_handle_renewal_submit', 'ajax_handle_renewal_submit');

// For getting specific user students data
function get_students_renewal_data() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.', 'student_data' => []));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $student_table = $wpdb->prefix . 'tsc_student_information';
    $registration_table = $wpdb->prefix . 'tsc_school_registration';

    $data = array();

    $registration_data = $wpdb->get_row($wpdb->prepare(
        "SELECT email, account_expire FROM $registration_table WHERE id = %d",
        $registration_id
    ));
    
    if (!$registration_data) {
        wp_send_json_success(array('success' => false, 'message' => 'No registration data found.'));
        return;
    }

    $student_data = $wpdb->get_results($wpdb->prepare(
        "SELECT id, 
                CONCAT(first_name, ' ', middle_name, ' ', last_name) as student_name,
                grade,
                student_profile_pic
         FROM $student_table 
         WHERE registration_id = %d 
         AND registration_status = 'complete'",
        $registration_id
    ), ARRAY_A);
    
    if ($student_data) {
        $data['student_data'] = $student_data;
        $data['registration_data'] = $registration_data;
    }
    else {
        $data['student_data'] = [];
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_students_renewal_data', 'get_students_renewal_data');
add_action('wp_ajax_get_students_renewal_data', 'get_students_renewal_data');

// For Save Final Submit data
function ajax_handle_apply_graduate_submit(){
    global $wpdb;
    // Retrieve and sanitize POST data
    $registration_id = get_current_user_id();
    $student_id = intval($_POST['student_id']);
    $transaction_id = sanitize_text_field($_POST['transaction_id']);
    $paidAmount = floatval($_POST['paidAmount']);
    $coupon_code = !empty($_POST['coupon_code']) ? sanitize_text_field($_POST['coupon_code']) : '';
    $description = sanitize_text_field($_POST['description']);
    $rushfee = sanitize_text_field($_POST['rushfee']);
    $account_expire    = date('Y-m-d', strtotime((date('Y')+1).'-08-10'));
    $current_time = current_time('mysql');
    $transactionItems  = json_decode(stripslashes($_POST['transactionItems']), true);

    $table = $wpdb->prefix . 'tsc_graduate_student';
    $transaction_table = $wpdb->prefix . 'tsc_transaction';
    $coupon_codes_table  = $wpdb->prefix . 'tsc_coupon_codes';

    // Validate transaction details
    if (empty($transaction_id) && $paidAmount > 0) {
        wp_send_json_error(['success' => false, 'message' => 'Transaction ID required.']);
        return;
    }

    $data = array(
       'transaction_id' => sanitize_text_field($_POST['transaction_id']),
       'paid_amount' => $paidAmount,
       'updated_at' => current_time('mysql'),
       'status' => 'applied',
    );

    $transaction_data = [
        'registration_id' => $registration_id,
        'transaction_id'  => $transaction_id,
        'description'     => $description,
        'amount'          => $paidAmount,
        'transactionItems' => json_encode($transactionItems),
        'expires_at'      => $account_expire,
        'created_at'      => $current_time,
    ];
    
    // Start a database transaction for consistency
    $wpdb->query('START TRANSACTION');

    try {
        // Check if record exists
        $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d AND student_id = %d", $registration_id, $student_id));

        // Update or insert graduate student record
        if ($check) {
            $graduate_result = $wpdb->update($table, $data, array('id' => $check));
            if ($graduate_result === false) {
                throw new Exception('Failed to update graduate application');
            }
        } else {
            $graduate_result = $wpdb->insert($table, $data);
            if (!$graduate_result) {
                throw new Exception('Failed to insert graduate application');
            }
        }

        // Insert transaction record
        $transaction_result = $wpdb->insert($transaction_table, $transaction_data);
        if (!$transaction_result) {
            throw new Exception('Failed to record transaction');
        }

        if (!empty($coupon_code)) {
            $coupon = $wpdb->get_row($wpdb->prepare("SELECT * FROM $coupon_codes_table WHERE code = %s", $coupon_code));
            if ($coupon) {
                $use_list = json_decode($coupon->use_list, true) ?: [];
                if (!in_array($registration_id, $use_list)) {
                    $use_list[] = $registration_id;
                    $updated_coupon = $wpdb->update(
                        $coupon_codes_table,
                        ['use_list' => wp_json_encode($use_list)],
                        ['id' => $coupon->id]
                    );

                    if ($updated_coupon === false) {
                        throw new Exception('Failed to update coupon usage');
                    }
                }
            }
        }

        // If both operations successful, commit the transaction
        $wpdb->query('COMMIT');

        // Send admin notification if rushfee is high
        if ($rushfee === 'high') {
            $message_type = "High Priority Student Graduate Application";
            $message = "A High Priority graduate application has been submitted. Please review and process it as soon as possible.";
            send_high_priority_admin_notification($registration_id, $transaction_id, $paidAmount, $message_type, $message);
        }
        
        // Send parent notification email
        // Get parent data from database
        $parent_table = $wpdb->prefix . 'tsc_parent_registration';
        $parent_data = $wpdb->get_row($wpdb->prepare(
            "SELECT CONCAT(first_name, ' ', middle_name, ' ', last_name) as parent_name, email 
             FROM $parent_table 
             WHERE registration_id = %d AND type = 'parent_1'", 
            $registration_id
        ));
        
        // Get student data from database
        $student_table = $wpdb->prefix . 'tsc_student_information';
        $student_data = $wpdb->get_row($wpdb->prepare(
            "SELECT CONCAT(first_name, ' ', middle_name, ' ', last_name) as student_name
             FROM $student_table 
             WHERE id = %d", 
            $student_id
        ));
        
        $parent_email = $parent_data->email;
        $parent_name = $parent_data->parent_name;
        $student_name = $student_data->student_name;
        // Get logo URL with better fallback options
        $logo_url = '';
        $logo_id = get_theme_mod('custom_logo');
        if ($logo_id) {
            $logo_attachment = wp_get_attachment_image_src($logo_id, 'full');
            if ($logo_attachment) {
                $logo_url = $logo_attachment[0];
            }
        } 
        
        // Final fallback to text if no images available
        if (empty($logo_url)) {
            $logo_url = '';
        }
        $subject = "Graduates Academy - Graduate Application Submitted";
        $message = '
        <html>
        <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 650px; margin: 0 auto; padding: 20px;">
            <div style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 30px; border-top: 5px solid #3a6ea5;">
            <!-- Header with logo -->
            <div style="text-align: center; margin-bottom: 30px;">
                ' . (!empty($logo_url) ? '<img src="' . esc_url($logo_url) . '" alt="Graduates Academy" style="max-width: 200px; height: auto;" />' : '<h2 style="color: #3a6ea5;">Graduates Academy</h2>') . '
                <h1 style="color: #3a6ea5; margin-top: 20px; font-size: 24px;">Graduate Application Confirmation</h1>
            </div>
            
            <!-- Main content -->
            <div style="margin-bottom: 30px;">
                <p style="font-size: 16px;">Dear ' . esc_html($parent_name) . ',</p>
                
                <p style="font-size: 16px;">Thank you for submitting a graduation application for <strong>' . esc_html($student_name) . '</strong>. We\'re pleased to confirm that your application has been received and is now being processed.</p>
                
                <div style="background-color: #f5f9ff; border-left: 4px solid #3a6ea5; padding: 15px; margin: 20px 0; border-radius: 4px;">
                <p style="font-size: 16px; margin: 0;"><strong>Important:</strong> Our academic team will review your student\'s records within the next 5-7 business days. We will contact you if additional information is required.</p>
                </div>
                
                <p style="font-size: 16px;"><strong>Important Information:</strong></p>
                <ol style="font-size: 16px; line-height: 1.6;">
                <li><strong>Academic Records:</strong> Please verify that all high school courses and grades are entered accurately in your parent portal and are listed under the correct academic years.</li>
                <li><strong>Additional Documentation:</strong> For AP or dual enrollment courses, please provide official transcripts and College Board documentation if applicable.</li>
                <li><strong>Diploma Delivery:</strong> Please reply to this email to confirm your mailing address for diploma delivery.</li>
                </ol>
                
                <p style="font-size: 16px;">Upon approval, each graduate will receive:</p>
                <ul style="font-size: 16px;">
                <li>A personalized diploma from Graduates Academy</li>
                <li>An official transcript (digital copy and one printed copy)</li>
                <li>Optional transcript delivery to colleges or institutions of your choice</li>
                </ul>';
                
                if ($paidAmount > 0) {
                $message .= '
                <p style="font-size: 16px;"><strong>Payment Details:</strong></p>
                <ul style="font-size: 16px;">
                    <li>Transaction ID: ' . esc_html($transaction_id) . '</li>
                    <li>Amount: $' . number_format($paidAmount, 2) . '</li>
                    <li>Date: ' . date('F j, Y') . '</li>
                </ul>';
                }
                
        $message .= '
            </div>
            
            <!-- Call to action -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="' . esc_url(home_url('/students')) . '" style="background-color: #3a6ea5; color: white; padding: 12px 25px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block;">Access Your Account</a>
            </div>
            
            <!-- Support information -->
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-top: 30px;">
                <p style="font-size: 15px; margin-top: 0;"><strong>Need Help?</strong></p>
                <p style="font-size: 15px;">If you have any questions about your graduation application or need assistance, please contact us:</p>
                <ul style="font-size: 15px;">
                <li>Email: <a href="mailto:admin@graduatesacademy.com" style="color: #3a6ea5; text-decoration: none;">admin@graduatesacademy.com</a></li>
                <li>Phone: (865) 564-4810</li>
                </ul>
            </div>
            
            <!-- Footer -->
            <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; color: #777; font-size: 14px;">
                <p>Congratulations on this important milestone!</p>
                <p>© ' . date('Y') . ' Graduates Academy. All rights reserved.</p>
                <p>309 Ebenezer Rd, Knoxville, TN 37923</p>
            </div>
            </div>
        </body>
        </html>
        ';
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: Graduates Academy <no-reply@graduatesacademy.com>'
        );
        wp_mail($parent_email, $subject, $message, $headers);

        wp_send_json(array('success' => true, 'message' => 'Graduate Application submitted successfully.' , 'logo_url' => $logo_url));
        
    } catch (Exception $e) {
        // If any operation fails, roll back all changes
        $wpdb->query('ROLLBACK');
        wp_send_json(array(
            'success' => false, 
            'message' => 'Failed to submit graduate application.', 
            'error' => $e->getMessage()
        ));
    }
    
}
add_action('wp_ajax_nopriv_ajax_handle_apply_graduate_submit', 'ajax_handle_apply_graduate_submit');
add_action('wp_ajax_ajax_handle_apply_graduate_submit', 'ajax_handle_apply_graduate_submit');

// For generating transcript PDF
function generate_transcript_pdf() {
    // 1. VALIDATION AND INPUT PROCESSING
    if (!isset($_POST['student_name']) || !isset($_POST['dob']) || !isset($_POST['courses'])) {
        wp_send_json_error('Missing required data');
        return;
    }

    // Get and sanitize student information
    $student_id = sanitize_text_field($_POST['student_id']);
    $student_name = sanitize_text_field($_POST['student_name']);
    $student_first_name = sanitize_text_field($_POST['first_name']);
    $student_middle_name = sanitize_text_field($_POST['middle_name']);
    $student_last_name = sanitize_text_field($_POST['last_name']);
    $dob = sanitize_text_field($_POST['dob']);
    $gender = sanitize_text_field($_POST['gender']);
    $parent_email = sanitize_email($_POST['parent_email']);
    $parent_phone = sanitize_text_field($_POST['parent_phone']);
    $country_code = sanitize_text_field($_POST['country_code']);
    
    // Get and process address information
    $address_data = json_decode(stripslashes($_POST['address']), true);
    $address = $address_data['address'];
    $city = $address_data['city'];
    $state = $address_data['state'];
    $zip = $address_data['zip'];
    
    // Process course data
    $courses_raw = json_decode(stripslashes($_POST['courses']), true);
    if (!$courses_raw || !is_array($courses_raw)) {
        wp_send_json_error('Invalid course data format');
        return;
    }

    // 2. HELPER FUNCTIONS
    // Function to format phone numbers based on country code
    function formatPhoneNumber($phone, $country) {
        if ($country === '+1' || $country === '+1c') {
            return '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6);
        } else {
            return preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $phone);
        }
    }
    
    // Format parent's phone number
    $formatted_parent_phone = formatPhoneNumber($parent_phone, $country_code);

    // 3. PROCESS COURSE DATA
    $processed_courses = [];
    foreach ($courses_raw as $course) {
        if (isset($course['course_name']) || isset($course['year'])) {
            // Extract and clean course data
            $processed_courses[] = [
                'course_name' => !empty($course['course_name']) ? trim($course['course_name']) : 'Unnamed Course',
                'grade' => !empty($course['grade']) ? trim($course['grade']) : '',
                'credits' => !empty($course['credit']) ? trim($course['credit']) : '0.00',
                'year' => !empty($course['student_grade']) ? preg_match('/(\d+)/', $course['student_grade'], $matches) ? $matches[1] : '' : '',
                'academic_year' => !empty($course['year']) ? trim($course['year']) : 'Unknown',
                'student_grade' => !empty($course['student_grade']) ? trim($course['student_grade']) : '',
                'publisher' => !empty($course['publisher']) ? trim($course['publisher']) : '',
                'semester' => !empty($course['semester']) ? trim($course['semester']) : '',
                'additional' => !empty($course['additional']) ? trim($course['additional']) : '',
                'weight_adjustment' => isset($course['weight_adjustment']) ? intval($course['weight_adjustment']) : 0
            ];
        }
    }

    // 4. GROUP COURSES BY ACADEMIC YEAR
    $courses_by_year = [];
    foreach ($processed_courses as $course) {
        $academic_year = $course['academic_year'];
        if (!isset($courses_by_year[$academic_year])) {
            $courses_by_year[$academic_year] = [];
        }
        $courses_by_year[$academic_year][] = $course;
    }
    
    // Sort by academic year - newest first
    krsort($courses_by_year);

    // 5. START OUTPUT BUFFERING FOR HTML GENERATION
    ob_start();
    
    // Define watermark background based on role
    $current_user = wp_get_current_user();
    if ($current_user->roles && (in_array('administrator', $current_user->roles) || in_array('school_admin', $current_user->roles))) {
        $bgurl = "";
    }
    else { 
        $bgurl = plugins_url('img/preview-watermark.jpg', __FILE__);
    }
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo esc_html($student_name); ?> - Transcript</title>
        <style>
            /* Base Styling */
            body {
                font-family: 'Times New Roman', serif;
                margin: 0px;
                padding: 0px;
                padding-right: 40px;
                padding-top: 15px;
                box-sizing: border-box;
                font-size: 14px;
                line-height: 16px;
                background:#fff url('<?php echo $bgurl; ?>') repeat;
            }

            p, td {
                font-size: 15px;
                line-height: 18px;
                padding: 0px;
                margin: 0px;
            }

            /* Table Styling */
            .noborder, .noborder td { border: none; }
            .lowspace tr, .lowspace td { margin: 0; padding: 2px; }
            .nobackground, .nobackground td { background: #fff; }
            .nospace tr, .nospace td { margin: 0; padding: 0; }
            .smallfont td { font-size: 13px; line-height: 14px; }
            .verysmallfont td { font-size: 10px; line-height: 14px; }
            .mediumfont td { font-size: 14px; }
            .borderboundary { border: 1px solid; }
            .uppercase { text-transform: uppercase; }
            
            /* Fixed height table */
            .fixed-table {
                height: 150px;
                overflow-y: auto;
                display: block;
                width: 100%;
            }
            
            .fixed-table table { width: 100%; }
            
            .fixed-table th,
            .fixed-table td {
                height: 15px;
                text-align: left;
            }
            
            .fixed-table td {
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }
            
            h4 { padding: 5px; }
            h6 { margin: 0px; }
            
            /* Print Styles */
            @media print {
                body {
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                }
            }
        </style>
    </head>
    <body>
        <div class="transcript-container">
            <table width="100%" colspan="0" class="lowspace mediumfont noborder">
                <!-- Header with logo -->
                <tr>
                    <td align="center" colspan="2">
                        <img src="<?php echo esc_url(wp_get_attachment_url(get_theme_mod('custom_logo'))); ?>" alt="<?php echo get_bloginfo('name'); ?>" style="max-width:250px; height:auto; margin-top:10px;" />
                    </td>
                </tr>
                
                <!-- Title section -->
                <tr>
                    <td align="center" colspan="2" style="border-top:3px solid #ccc; background:#f2f2f2; padding: 0px; margin: 0px;">
                        <h4>OFFICIAL HIGH SCHOOL TRANSCRIPT</h4>
                    </td>
                </tr>
                
                <!-- Student and School Information -->
                <tr>
                    <!-- Student Information -->
                    <td width="48%">
                        <table width="100%" colspan="0" class="borderboundary lowspace noborder">
                            <tr>
                                <td colspan="2">
                                    <h6 class="uppercase">Student Information</h6>
                                </td>
                            </tr>
                            <tr class="nobackground">
                                <td>Student First Name:</td>
                                <td>
                                    <span class="contenteditable" contenteditable="false" data-field="student_first_name"><?php echo esc_html($student_first_name); ?></span>
                                </td>
                            </tr>
                            <tr class="nobackground">
                                <td>Student Middle Name:</td>
                                <td>
                                    <span class="contenteditable" contenteditable="false" data-field="student_middle_name"><?php echo esc_html($student_middle_name); ?></span>
                                </td>
                            </tr>
                            <tr class="nobackground">
                                <td>Student Last Name:</td>
                                <td>
                                    <span class="contenteditable" contenteditable="false" data-field="student_last_name"><?php echo esc_html($student_last_name); ?></span>
                                </td>
                            </tr>
                            <tr class="nobackground">
                                <td>DOB:</td>
                                <td>
                                    <span class="contenteditable" contenteditable="false" data-field="dob"><?php echo esc_html($dob); ?></span>
                                </td>
                            </tr>
                            <tr class="nobackground">
                                <td>SSN:</td>
                                <td>
                                    <span class="contenteditable" contenteditable="false" data-field="ssn"></span>
                                </td>
                            </tr>
                            <tr class="nobackground">
                                <td>City/State:</td>
                                <td>
                                    <span class="contenteditable" contenteditable="false" data-field="city_state"><?php echo esc_html("{$city}, {$state} {$zip}"); ?></span>
                                </td>
                            </tr>
                        </table>
                    </td>
                    
                    <!-- School Information -->
                    <td width="48%">
                        <table width="100%" colspan="0" class="borderboundary lowspace ">
                            <tr>
                                <td colspan="2">
                                    <h6 class="uppercase">School Information</h6>
                                </td>
                            </tr>
                            <tr class="nobackground">
                                <td colspan="2">
                                    <span class="contenteditable" contenteditable="false" data-field="school_name">Graduates Academy</span>
                                </td>
                            </tr>
                            <tr class="nobackground">
                                <td colspan="2">
                                    <span class="contenteditable" contenteditable="false" data-field="school_address1">309 Ebenezer Rd</span>
                                </td>
                            </tr>
                            <tr class="nobackground">
                                <td colspan="2">
                                    <span class="contenteditable" contenteditable="false" data-field="school_address2">Knoxville, TN 37923</span>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr class="nobackground">
                                <td>
                                    <span class="contenteditable" contenteditable="false" data-field="school_phone">(865) 564-4810</span>
                                </td>
                                <td>
                                    <a href="mailto:admin@graduatesacademy.com" class="contenteditable" contenteditable="false" data-field="school_email">admin@graduatesacademy.com</a>
                                </td>
                            </tr>
                            <tr class="nobackground">
                                <td colspan="2">
                                    Date of Graduation:
                                    <span class="contenteditable" contenteditable="false" data-field="graduation_date"></span>
                                </td>
                            </tr>
                            <tr class="nobackground">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <?php
            global $wpdb;
            
            // Track cumulative totals for all courses
            $cumulative_credits = 0;
            $cumulative_points_unweighted = 0;
            $cumulative_points_weighted = 0;
            
            if (!empty($courses_by_year)) {
                $attendance_table = $wpdb->prefix . 'tsc_students_attendance';

                // Convert associative array to indexed array for easier grouping
                $years_array = [];
                foreach ($courses_by_year as $academic_year => $year_courses) {
                    $years_array[] = ['year' => $academic_year, 'courses' => $year_courses];
                }

                $total_years = count($years_array);
                $group_size = 4;
                $group_count = ceil($total_years / $group_size);

                for ($g = 0; $g < $group_count; $g++) {
                    // Show Academic Record Header for each group of 4
                    ?>
                    <table width="100%" colspan="0" class="lowspace mediumfont noborder">
                        <tr>
                            <td align="center" colspan="2" style="border-top:3px solid #ccc; background:#f2f2f2; padding: 0px; margin: 0px;">
                                <h4>ACADEMIC RECORD</h4>
                            </td>
                        </tr>
                        <?php
                        // Each group will have up to 4 years, shown in 2 columns per row
                        for ($row = 0; $row < 2; $row++) {
                            echo '<tr>';
                            for ($col = 0; $col < 2; $col++) {
                                $index = $g * $group_size + $row * 2 + $col;
                                if ($index < $total_years) {
                                    $academic_year = $years_array[$index]['year'];
                                    $year_courses = $years_array[$index]['courses'];

                                    // Get grade level and format as ordinal (9th, 10th, etc.)
                                    $grade_level = !empty($year_courses[0]['year']) ? $year_courses[0]['year'] : '';
                                    $formatter = new NumberFormatter('en_US', NumberFormatter::ORDINAL);
                                    $formatted_grade = $formatter->format($grade_level);

                                    // Get attendance data for this academic year
                                    $attendance = $wpdb->get_results($wpdb->prepare(
                                        "SELECT year, fall_semester as fall, spring_semester as spring, summer_semester as summer, 
                                            (fall_semester+spring_semester+summer_semester) as total
                                         FROM $attendance_table 
                                         WHERE student_id = %d AND year = %s",
                                        $student_id,
                                        $academic_year
                                    ), ARRAY_A);

                                    $attendance_days = !empty($attendance[0]['total']) ? $attendance[0]['total'] : 0;
                                    ?>
                                    <td width="48%">
                                        <table class="nospace smallfont" cellspacing="1" cellpadding="1" width="100%">
                                            <!-- Year and Grade Header -->
                                            <tr class="nospace" style="font-weight: bold; background:#a6a6a6; ">
                                                <td colspan="2" class="nospace">
                                                    <table class="nospace smallfont">
                                                        <tr class="nospace smallfont">
                                                            <td width="70%">
                                                                <span class="contenteditable" contenteditable="false" data-field="academic_year_<?php echo esc_attr($academic_year); ?>"><?php echo esc_html($academic_year); ?></span>
                                                            </td>
                                                            <td width="30%">
                                                                <span class="contenteditable" contenteditable="false" data-field="grade_level_<?php echo esc_attr($academic_year); ?>"><?php echo $formatted_grade; ?> Grade</span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            
                                            <!-- Course List -->
                                            <tr class="nospace" style="border-left: 1px solid #000; border-right: 1px solid #000;">
                                                <td colspan="2">
                                                    <table class="fixed-table" style="background: #fff; display:block; width: 100%;" width="100%">
                                                        <!-- Table Headers -->
                                                        <tr class="noborder" style="border-top:1px solid #000; border-bottom:1px solid #000;">
                                                            <td width="70%">Class</td>
                                                            <td align="left" width="20%">Grade</td>
                                                            <td align="left" width="10%">Credit</td>
                                                        </tr>

                                                        <?php 
                                                        // Initialize year totals
                                                        $total_credits_year = 0;
                                                        $total_points_unweighted_year = 0;
                                                        $total_points_weighted_year = 0;
                                                        
                                                        // Process each course in this academic year
                                                        foreach ($year_courses as $i => $course): 
                                                            // Format the grade display
                                                            $grade = '';
                                                            switch ($course['grade']) {
                                                                case 'In Progress': $grade = 'IP'; break;
                                                                case 'Pass': $grade = 'P'; break;
                                                                case 'Incomplete': $grade = 'I'; break;
                                                                case 'Needs Improvement': $grade = 'NI'; break;
                                                                default: $grade = $course['grade']; break;
                                                            }

                                                            // Only add credits to total if course is completed (not In Progress, Incomplete, Needs Improvement)
                                                            $completed_grades = [
                                                                'A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D', 'D-', 'F', 'Pass', 'Excellent', 'Satisfactory'
                                                            ];
                                                            $show_credits = false;
                                                            $credits = 0.00;
                                                            $unweighted_points = 0;
                                                            $weighted_points = 0;
                                                            
                                                            if (in_array($course['grade'], $completed_grades)) {
                                                                $credits = floatval($course['credits']);
                                                                $show_credits = true;
                                                                
                                                                // Calculate base GPA points based on grade
                                                                switch ($course['grade']) {
                                                                    case 'A+': $base_points = 4.3; break;
                                                                    case 'A': $base_points = 4.0; break;
                                                                    case 'A-': $base_points = 3.7; break;
                                                                    case 'B+': $base_points = 3.3; break;
                                                                    case 'B': $base_points = 3.0; break;
                                                                    case 'B-': $base_points = 2.7; break;
                                                                    case 'C+': $base_points = 2.3; break;
                                                                    case 'C': $base_points = 2.0; break;
                                                                    case 'C-': $base_points = 1.7; break;
                                                                    case 'D+': $base_points = 1.3; break;
                                                                    case 'D': $base_points = 1.0; break;
                                                                    case 'D-': $base_points = 0.7; break;
                                                                    case 'F': $base_points = 0.0; break;
                                                                    case 'Pass': 
                                                                    case 'Excellent': 
                                                                    case 'Satisfactory': 
                                                                        $base_points = 0.0; 
                                                                        break;
                                                                    default: $base_points = 0.0; break;
                                                                }
                                                                
                                                                // Calculate weight adjustment based on course type
                                                                $weight_adjustment = 0;
                                                                if (!empty($course['additional'])) {
                                                                    if ($course['additional'] == 'Honors') {
                                                                        $weight_adjustment = 0.5;
                                                                    } else if (in_array($course['additional'], ['Dual Enrollment', 'AP', 'IB'])) {
                                                                        $weight_adjustment = 1.0;
                                                                    }
                                                                    // No adjustment for regular or CLEP courses
                                                                }
                                                                
                                                                // Calculate points
                                                                $unweighted_points = $credits * $base_points;
                                                                $weighted_points = $credits * ($base_points + $weight_adjustment);
                                                                
                                                                // Add to totals
                                                                $total_credits_year += $credits;
                                                                $total_points_unweighted_year += $unweighted_points;
                                                                $total_points_weighted_year += $weighted_points;
                                                                
                                                                // Add to cumulative totals
                                                                $cumulative_credits += $credits;
                                                                $cumulative_points_unweighted += $unweighted_points;
                                                                $cumulative_points_weighted += $weighted_points;
                                                            }

                                                            // Format course name with any special designations
                                                            $course_name = !empty($course['publisher']) ? esc_html($course['publisher']) : esc_html($course['course_name']);
                                                            if (!empty($course['additional'])) {
                                                                if ($course['additional'] == 'Honors') {
                                                                    $course_name .= ' (HN)';
                                                                } else if ($course['additional'] == 'Dual Enrollment') {
                                                                    $course_name .= ' (DE)';
                                                                } else if ($course['additional'] == 'AP') {
                                                                    $course_name .= ' (AP)';
                                                                } else if ($course['additional'] == 'IB') {
                                                                    $course_name .= ' (IB)';
                                                                }
                                                            }
                                                        ?>
                                                            <tr class="noborder">
                                                                <td width="60%">
                                                                    <span class="contenteditable" contenteditable="false" data-field="course_name_<?php echo esc_attr($academic_year . '_' . $i); ?>"><?php echo $course_name; ?></span>
                                                                </td>
                                                                <td align="left" width="20%">
                                                                    <span class="contenteditable" contenteditable="false" data-field="course_grade_<?php echo esc_attr($academic_year . '_' . $i); ?>"><?php echo esc_html($grade); ?></span>
                                                                </td>
                                                                <td align="left" width="20%">
                                                                    <span class="contenteditable" contenteditable="false" data-field="course_credit_<?php echo esc_attr($academic_year . '_' . $i); ?>">
                                                                        <?php echo $show_credits ? number_format($credits, 2) : ''; ?>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </table>
                                                </td>
                                            </tr>
                                            
                                            <!-- GPA and Credits Summary -->
                                            <tr class="noborder nospace nobackground" style="border-top:1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;">
                                                <td width="80%">GPA (U/W)</td>
                                                <td align="right" width="20%" style="border-left: 1px solid #000">
                                                    <span class="contenteditable" contenteditable="false" data-field="gpa_unweighted_<?php echo esc_attr($academic_year); ?>">
                                                    <?php 
                                                    // Calculate and show unweighted GPA for this year
                                                    $year_gpa_unweighted = !empty($total_credits_year) ? number_format($total_points_unweighted_year / $total_credits_year, 2) : ' - ';
                                                    echo $year_gpa_unweighted;
                                                    ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr class="noborder nospace nobackground" style="border-left: 1px solid #000; border-right: 1px solid #000;">
                                                <td width="80%">GPA (W)</td>
                                                <td align="right" width="20%" style="border-left: 1px solid #000">
                                                    <span class="contenteditable" contenteditable="false" data-field="gpa_weighted_<?php echo esc_attr($academic_year); ?>">
                                                    <?php 
                                                    // Calculate and show weighted GPA for this year
                                                    $year_gpa_weighted = !empty($total_credits_year) ? number_format($total_points_weighted_year / $total_credits_year, 2) : ' - ';
                                                    echo $year_gpa_weighted;
                                                    ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr class="nospace nobackground">
                                                <td width="80%" style="border-left: 1px solid #000;">Credits Earned</td>
                                                <td align="right" width="20%" style="border-left: 1px solid #000; border-right: 1px solid #000;">
                                                    <span class="contenteditable" contenteditable="false" data-field="credits_earned_<?php echo esc_attr($academic_year); ?>">
                                                        <?php echo number_format($total_credits_year, 2); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr class="noborder nospace nobackground" style="border-bottom:1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;">
                                                <td width="80%">Attendance</td>
                                                <td align="right" width="20%" style="border-left: 1px solid #000">
                                                    <span class="contenteditable" contenteditable="false" data-field="attendance_<?php echo esc_attr($academic_year); ?>">
                                                        <?php echo $attendance_days; ?> days
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                <?php
                                } else {
                                    // Add empty cell to complete the row if there's an odd number of years
                                    echo '<td width="48%">&nbsp;</td>';
                                }
                            }
                            echo '</tr>';
                        }
                    ?>
                    </table>
                    <?php
                }
            }
            ?>
            <table width="100%" colspan="0" class="lowspace mediumfont noborder">
                <!-- Totals Summary -->
                <tr>
                    <td align="center" colspan="2" style="border-top:3px solid #ccc; background:#f2f2f2; padding: 0px; margin: 0px;">
                        <h4>CUMULATIVE SUMMARY</h4>
                    </td>
                </tr>
                <tr>
                    <td>Total Credit Hours</td>
                    <td>
                        <span class="contenteditable" contenteditable="false" data-field="cumulative_credits">
                            <?php echo number_format($cumulative_credits, 2); ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Unweighted GPA</td>
                    <td>
                        <span class="contenteditable" contenteditable="false" data-field="cumulative_gpa_unweighted">
                        <?php 
                        if ($cumulative_credits > 0) {
                            echo number_format($cumulative_points_unweighted / $cumulative_credits, 2);
                        } else {
                            echo ' - ';
                        }
                        ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Weighted GPA</td>
                    <td>
                        <span class="contenteditable" contenteditable="false" data-field="cumulative_gpa_weighted">
                        <?php 
                        if ($cumulative_credits > 0) {
                            echo number_format($cumulative_points_weighted / $cumulative_credits, 2);
                        } else {
                            echo ' - ';
                        }
                        ?>
                        </span>
                    </td>
                </tr>

                <!-- Legend and Date -->
                <tr>
                    <td colspan="2">
                        <table class="noborder" width="100%">
                            <tr>
                                <td width="50%" valign="top">
                                    <table class="noborder">
                                        <tr class="verysmallfont"><td>P = Pass</td></tr>
                                        <tr class="verysmallfont"><td>I = Incomplete</td></tr>
                                        <tr class="verysmallfont"><td>NI = Needs Improvement</td></tr>
                                        <tr class="verysmallfont"><td>IP = In Progress</td></tr>
                                        <tr class="verysmallfont"><td>DE = Dual Enrollment</td></tr>
                                        <tr class="verysmallfont"><td>HN = Honors</td></tr>  
                                        <tr class="verysmallfont"><td>CE = Credit By Exam </td></tr>
                                        <tr class="verysmallfont"><td>MOD = Modified Course</td></tr>
                                    </table>
                                </td>
                                <td width="50%" align="right" valign="top">
                                    Date Issued: 
                                    <span class="contenteditable" contenteditable="false" data-field="date_issued">
                                        <?php echo date('m/d/Y'); ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <!-- Footer -->
                <tr>
                    <td align="center" colspan="2">
                        <img src="<?php echo plugins_url('img/footer-pdf.png', __FILE__); ?>" alt="<?php echo get_bloginfo('name'); ?>" style="max-width:100%; height:auto;" />
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2">
                        <span class="contenteditable" contenteditable="false" data-field="footer_address">
                            309 Ebenezer Road | Knoxville, TN 37923 | 865-564-4810
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </body>
    </html>
    <?php
    // 6. GET THE CONTENT FROM THE BUFFER AND RETURN
    $html_content = ob_get_clean();

    // Send the HTML as a JSON response
    wp_send_json_success(array(
        'html' => $html_content,
        'student_name' => $student_name
    )); 
}
add_action('wp_ajax_generate_transcript_pdf', 'generate_transcript_pdf');
add_action('wp_ajax_nopriv_generate_transcript_pdf', 'generate_transcript_pdf');

// For generate transcript excel
function generate_transcript_excel() {
    // Check permissions
    if (!is_user_logged_in()) {
        wp_send_json_error('Not logged in');
        return;
    }
    
    // 1. VALIDATION AND INPUT PROCESSING
    if (!isset($_POST['student_name']) || !isset($_POST['dob']) || !isset($_POST['courses'])) {
        wp_send_json_error('Missing required data');
        return;
    }

    // Get and sanitize student information
    $student_id = sanitize_text_field($_POST['student_id']);
    $student_name = sanitize_text_field($_POST['student_name']);
    $student_first_name = sanitize_text_field($_POST['first_name']);
    $student_middle_name = sanitize_text_field($_POST['middle_name']);
    $student_last_name = sanitize_text_field($_POST['last_name']);
    $dob = sanitize_text_field($_POST['dob']);
    $gender = sanitize_text_field($_POST['gender']);
    $parent_email = sanitize_email($_POST['parent_email']);
    $parent_phone = sanitize_text_field($_POST['parent_phone']);
    $country_code = sanitize_text_field($_POST['country_code']);
    
    // Get and process address information
    $address_data = json_decode(stripslashes($_POST['address']), true);
    $address = $address_data['address'];
    $city = $address_data['city'];
    $state = $address_data['state'];
    $zip = $address_data['zip'];
    
    // Process course data
    $courses_raw = json_decode(stripslashes($_POST['courses']), true);
    if (!$courses_raw || !is_array($courses_raw)) {
        wp_send_json_error('Invalid course data format');
        return;
    }

    // 2. HELPER FUNCTIONS
    // Function to format phone numbers based on country code
    function formatPhoneNumber($phone, $country) {
        if ($country === '+1' || $country === '+1c') {
            return '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6);
        } else {
            return preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $phone);
        }
    }
    
    // Format parent's phone number
    $formatted_parent_phone = formatPhoneNumber($parent_phone, $country_code);

    // 3. PROCESS COURSE DATA
    $processed_courses = [];
    foreach ($courses_raw as $course) {
        if (isset($course['course_name']) || isset($course['year'])) {
            // Extract and clean course data
            $processed_courses[] = [
                'course_name' => !empty($course['course_name']) ? trim($course['course_name']) : 'Unnamed Course',
                'grade' => !empty($course['grade']) ? trim($course['grade']) : '',
                'credits' => !empty($course['credit']) ? trim($course['credit']) : '0.00',
                'year' => !empty($course['student_grade']) ? preg_match('/(\d+)/', $course['student_grade'], $matches) ? $matches[1] : '' : '',
                'academic_year' => !empty($course['year']) ? trim($course['year']) : 'Unknown',
                'student_grade' => !empty($course['student_grade']) ? trim($course['student_grade']) : '',
                'publisher' => !empty($course['publisher']) ? trim($course['publisher']) : '',
                'semester' => !empty($course['semester']) ? trim($course['semester']) : '',
                'additional' => !empty($course['additional']) ? trim($course['additional']) : '',
                'weight_adjustment' => isset($course['weight_adjustment']) ? intval($course['weight_adjustment']) : 0
            ];
        }
    }

    // 4. GROUP COURSES BY ACADEMIC YEAR
    $courses_by_year = [];
    foreach ($processed_courses as $course) {
        $academic_year = $course['academic_year'];
        if (!isset($courses_by_year[$academic_year])) {
            $courses_by_year[$academic_year] = [];
        }
        $courses_by_year[$academic_year][] = $course;
    }
    
    // Sort by academic year - newest first
    krsort($courses_by_year);

    // 5. SET UP CSV FILE
    $upload_dir = wp_upload_dir();
    $file_name = sanitize_file_name($student_name . '_transcript_' . date('Ymd_His') . '.csv');
    $file_path = $upload_dir['path'] . '/' . $file_name;
    $file_url = $upload_dir['url'] . '/' . $file_name;
    
    $file = fopen($file_path, 'w');
    if (!$file) {
        wp_send_json_error('Could not create output file');
        return;
    }
    // Ensure proper UTF-8 encoding for Excel compatibility
    fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

    // 6. HEADER SECTION
    fputcsv($file, array('GRADUATES ACADEMY'));
    fputcsv($file, array('OFFICIAL HIGH SCHOOL TRANSCRIPT'));
    fputcsv($file, array(''));

    // 7. STUDENT AND SCHOOL INFORMATION
    fputcsv($file, array('STUDENT INFORMATION', '', '', 'SCHOOL INFORMATION'));
    fputcsv($file, array('Student First Name:', $student_first_name, '', 'School:', 'Graduates Academy'));
    fputcsv($file, array('Student Middle Name:', $student_middle_name, '', 'Address:', '309 Ebenezer Rd'));
    fputcsv($file, array('Student Last Name:', $student_last_name, '', '', 'Knoxville, TN 37923'));
    fputcsv($file, array('Date of Birth:', $dob, '', 'Phone:', '(865) 564-4810'));
    fputcsv($file, array('Gender:', $gender, '', 'Email:', 'admin@graduatesacademy.com'));
    fputcsv($file, array('City/State:', "$city, $state $zip", '', 'Date of Graduation:', ''));
    fputcsv($file, array('', '', '', '', ''));

    // 8. ACADEMIC RECORD
    fputcsv($file, array('ACADEMIC RECORD'));
    fputcsv($file, array(''));

    // Get student attendance data
    global $wpdb;
    $attendance_table = $wpdb->prefix . 'tsc_students_attendance';

    // Track cumulative totals
    $cumulative_credits = 0;
    $cumulative_points_unweighted = 0;
    $cumulative_points_weighted = 0;

    // 9. COURSE DATA BY YEAR
    foreach ($courses_by_year as $academic_year => $year_courses) {
        $grade_level = !empty($year_courses[0]['year']) ? $year_courses[0]['year'] : '';
        
        // Create ordinal suffix for grade level
        $suffix = 'th';
        if ($grade_level % 100 < 11 || $grade_level % 100 > 13) {
            switch ($grade_level % 10) {
                case 1: $suffix = 'st'; break;
                case 2: $suffix = 'nd'; break;
                case 3: $suffix = 'rd'; break;
            }
        }
        $formatted_grade = $grade_level . $suffix;

        // Get attendance data for this academic year
        $attendance = $wpdb->get_results($wpdb->prepare(
            "SELECT year, fall_semester as fall, spring_semester as spring, summer_semester as summer, 
                (fall_semester+spring_semester+summer_semester) as total
             FROM $attendance_table 
             WHERE student_id = %d AND year = %s",
            $student_id,
            $academic_year
        ), ARRAY_A);
        $attendance_days = !empty($attendance[0]['total']) ? $attendance[0]['total'] : 0;

        // Year header
        fputcsv($file, array("$academic_year - $formatted_grade Grade"));
        fputcsv($file, array('Class', 'Grade', 'Credit'));

        // Initialize year totals
        $total_credits_year = 0;
        $total_points_unweighted_year = 0;
        $total_points_weighted_year = 0;

        // Process each course
        foreach ($year_courses as $course) {
            // Format grade display
            $grade = $course['grade'];
            switch ($grade) {
                case 'In Progress': $grade_display = 'IP'; break;
                case 'Pass': $grade_display = 'P'; break;
                case 'Incomplete': $grade_display = 'I'; break;
                case 'Needs Improvement': $grade_display = 'NI'; break;
                default: $grade_display = $grade; break;
            }

            // Format course name with designations
            $course_name = !empty($course['publisher']) ? $course['publisher'] : $course['course_name'];
            if (!empty($course['additional'])) {
                if ($course['additional'] == 'Honors') {
                    $course_name .= ' (HN)';
                } else if ($course['additional'] == 'Dual Enrollment') {
                    $course_name .= ' (DE)';
                } else if ($course['additional'] == 'AP') {
                    $course_name .= ' (AP)';
                } else if ($course['additional'] == 'IB') {
                    $course_name .= ' (IB)';
                }
            }

            // Calculate GPA points
            $completed_grades = [
                'A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-',
                'D+', 'D', 'D-', 'F', 'Pass', 'Excellent', 'Satisfactory'
            ];
            
            $credits = 0;
            $unweighted_points = 0;
            $weighted_points = 0;

            if (in_array($grade, $completed_grades)) {
                $credits = floatval($course['credits']);
                
                // Calculate base GPA points
                switch ($grade) {
                    case 'A+': $base_points = 4.3; break;
                    case 'A': $base_points = 4.0; break;
                    case 'A-': $base_points = 3.7; break;
                    case 'B+': $base_points = 3.3; break;
                    case 'B': $base_points = 3.0; break;
                    case 'B-': $base_points = 2.7; break;
                    case 'C+': $base_points = 2.3; break;
                    case 'C': $base_points = 2.0; break;
                    case 'C-': $base_points = 1.7; break;
                    case 'D+': $base_points = 1.3; break;
                    case 'D': $base_points = 1.0; break;
                    case 'D-': $base_points = 0.7; break;
                    case 'F': $base_points = 0.0; break;
                    case 'Pass': 
                    case 'Excellent': 
                    case 'Satisfactory': 
                        $base_points = 0.0; 
                        break;
                    default: $base_points = 0.0; break;
                }
                
                // Calculate weight adjustment
                $weight_adjustment = 0;
                if (!empty($course['additional'])) {
                    if ($course['additional'] == 'Honors') {
                        $weight_adjustment = 0.5;
                    } else if (in_array($course['additional'], ['Dual Enrollment', 'AP', 'IB'])) {
                        $weight_adjustment = 1.0;
                    }
                }
                
                // Calculate points
                $unweighted_points = $credits * $base_points;
                $weighted_points = $credits * ($base_points + $weight_adjustment);
                
                // Add to totals
                $total_credits_year += $credits;
                $total_points_unweighted_year += $unweighted_points;
                $total_points_weighted_year += $weighted_points;
                
                // Add to cumulative totals
                $cumulative_credits += $credits;
                $cumulative_points_unweighted += $unweighted_points;
                $cumulative_points_weighted += $weighted_points;
            }

            // Write course data
            fputcsv($file, array(
                $course_name,
                $grade_display,
                $credits > 0 ? number_format($credits, 2) : ''
            ));
        }

        // Calculate GPAs for the year
        $year_gpa_unweighted = ($total_credits_year > 0) ? ($total_points_unweighted_year / $total_credits_year) : 0;
        $year_gpa_weighted = ($total_credits_year > 0) ? ($total_points_weighted_year / $total_credits_year) : 0;

        // Write year summary
        fputcsv($file, array('Unweighted GPA:', number_format($year_gpa_unweighted, 2)));
        fputcsv($file, array('Weighted GPA:', number_format($year_gpa_weighted, 2)));
        fputcsv($file, array('Credits Earned:', number_format($total_credits_year, 2)));
        fputcsv($file, array('Attendance:', "$attendance_days days"));
        fputcsv($file, array(''));
    }

    // 10. CUMULATIVE SUMMARY
    $cumulative_gpa_unweighted = ($cumulative_credits > 0) ? ($cumulative_points_unweighted / $cumulative_credits) : 0;
    $cumulative_gpa_weighted = ($cumulative_credits > 0) ? ($cumulative_points_weighted / $cumulative_credits) : 0;

    fputcsv($file, array('CUMULATIVE SUMMARY'));
    fputcsv($file, array('Total Credit Hours:', number_format($cumulative_credits, 2)));
    fputcsv($file, array('Unweighted GPA:', number_format($cumulative_gpa_unweighted, 2)));
    fputcsv($file, array('Weighted GPA:', number_format($cumulative_gpa_weighted, 2)));
    fputcsv($file, array(''));

    // 11. LEGEND AND FOOTER
    fputcsv($file, array('LEGEND'));
    fputcsv($file, array('P = Pass, I = Incomplete, NI = Needs Improvement, IP = In Progress'));
    fputcsv($file, array('DE = Dual Enrollment, HN = Honors, AP = Advanced Placement, IB = International Baccalaureate'));
    fputcsv($file, array('CE = Credit By Exam, MOD = Modified Course'));
    fputcsv($file, array(''));
    fputcsv($file, array('Date Issued:', date('m/d/Y')));
    fputcsv($file, array('309 Ebenezer Road | Knoxville, TN 37923 | 865-564-4810'));

    fclose($file);

    // Check if file was created successfully
    if (!file_exists($file_path) || !is_readable($file_path)) {
        wp_send_json_error('Unable to create or read the generated file');
        return;
    }

    // Return success response
    wp_send_json_success([
        'message' => 'Transcript exported successfully',
        'excel_url' => $file_url,
        'file_name' => $file_name,
        'file_type' => 'csv',
        'mime_type' => 'text/csv',
        'file_size' => filesize($file_path)
    ]);
}
add_action('wp_ajax_generate_transcript_excel', 'generate_transcript_excel');
add_action('wp_ajax_nopriv_generate_transcript_excel', 'generate_transcript_excel');

// For Parent Profile photo Upload
function upload_profile_image() {
    // Check if user is logged in
    if (!is_user_logged_in()) {
        wp_send_json_error(['success' => false, 'message' => 'Not logged in']);
        return;
    }

    // Check if file was uploaded
    if (!isset($_FILES['profile_image']) || empty($_FILES['profile_image'])) {
        wp_send_json_error(['success' => false, 'message' => 'No file uploaded']);
        return;
    }

    $file = $_FILES['profile_image'];
    
    // Validate file type
    $file_type = wp_check_filetype($file['name']);
    if (!in_array($file_type['type'], ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'])) {
        wp_send_json_error(['success' => false, 'message' => 'Invalid file type. Please upload a JPG, PNG or GIF image.']);
        return;
    }
    
    // Get WP upload directory
    $upload_dir = wp_upload_dir();
    $upload_path = $upload_dir['path'];
    $upload_url = $upload_dir['url'];
    
    // Generate unique filename
    $filename = 'profile_' . get_current_user_id() . '_' . time() . '.' . $file_type['ext'];
    $file_path = $upload_path . '/' . $filename;
    
    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $file_path)) {
        wp_send_json_error(['success' => false, 'message' => 'Failed to upload file']);
        return;
    }
    
    // Get file URL
    $file_url = $upload_url . '/' . $filename;
    
    // set user profile photo
    $user_id = get_current_user_id();
    // Update WordPress user meta with the profile image URL
    update_user_meta($user_id, 'profile_picture', $file_url);
    

    // Also update in parent table if needed
    global $wpdb;
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';
    
    // Check if we have a record for this user
    $parent = $wpdb->get_row($wpdb->prepare(
        "SELECT id, questions FROM {$parent_table} WHERE registration_id = %d AND type = 'parent_1'",
        $user_id
    ));
    
    if ($parent) {
        // Update the dedicated profile_image column
        $inserted = $wpdb->update(
            $parent_table,
            ['profile_image' => $file_url],
            ['id' => $parent->id]
        );
        
        if ($inserted === false) {
            wp_send_json_error(['success' => false, 'message' => 'Failed to update profile image in parent table']);
            return;
        }
    }
    
    wp_send_json_success([
        'success' => true, 
        'message' => 'Profile image uploaded successfully',
        'profile_image_url' => $file_url
    ]);
}
add_action('wp_ajax_nopriv_upload_profile_image', 'upload_profile_image');
add_action('wp_ajax_upload_profile_image', 'upload_profile_image');


// For Admin Pages 

// get all registration data for admin view
function get_all_registration_data() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Access denied.'));
        return;
    }

    // Define tables
    $registration_table = $wpdb->prefix . 'tsc_school_registration';
    $parent_table = $wpdb->prefix . 'tsc_parent_registration'; 
    $student_table = $wpdb->prefix . 'tsc_student_information';
    $transaction_table = $wpdb->prefix . 'tsc_transaction';

    // Get all registrations with email and submitted_at
    $registrations = $wpdb->get_results("SELECT id, email, account_expire, renewal_by_admin, submitted_at FROM {$registration_table} WHERE role = 'student'", ARRAY_A);

    $data = array();
    foreach ($registrations as $registration) {
        $reg_id = $registration['id'];
        
        $user = get_user_by('id', $reg_id);
        
        if($user){
            // From wp_usermeta table
            $account_status = get_user_meta($user->ID, 'account_status', true);
        } 
        // Get parent details
        $parent = $wpdb->get_row($wpdb->prepare(
            "SELECT first_name, middle_name, last_name, role, id, email
            FROM {$parent_table} 
            WHERE registration_id = %d AND type = 'parent_1'",
            $reg_id
        ), ARRAY_A);

        // Get student count
        $student_count = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) 
            FROM {$student_table} 
            WHERE registration_id = %d AND registration_status = 'complete'",
            $reg_id
        ));

        // Find this registration_id is present in transaction table
        $transaction_exists = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$transaction_table} WHERE registration_id = %d",
            $reg_id
        ));

        if ($transaction_exists > 0) {
            $payment_status = 'paid';
        } else {
            $payment_status = 'unpaid';
        }

        // Add data for all registrations, with blank values if parent doesn't exist
        $data[] = array(
            'registration_id' => $reg_id,
            'account_status' => $account_status,
            'registration_email' => $registration['email'],
            'submitted_at' => $registration['submitted_at'],
            'account_expire' => $registration['account_expire'],
            'parent_id' => $parent ? $parent['id'] : '',
            'parent_email' => $parent ? $parent['email'] : '',
            'parent_first_name' => $parent ? $parent['first_name'] : '',
            'parent_middle_name' => $parent ? $parent['middle_name'] : '',
            'parent_last_name' => $parent ? $parent['last_name'] : '',
            'parent_role' => $parent ? $parent['role'] : '',
            'student_count' => intval($student_count),
            'payment_status' => $payment_status,
            'renewal_by_admin' => $registration['renewal_by_admin'], // added new field for renewal status
        );
    }

    if (!empty($data)) {
        wp_send_json(array('success' => true, 'data' => $data));
    } else {
        wp_send_json(array('success' => false, 'message' => 'No registration data found.'));
    }
}
add_action('wp_ajax_nopriv_get_all_registration_data', 'get_all_registration_data');
add_action('wp_ajax_get_all_registration_data', 'get_all_registration_data');

// For add new user data
function add_new_user_data(){
    global $wpdb;
    // Define tables
    $registration_table = $wpdb->prefix . 'tsc_school_registration';
    $parent_table = $wpdb->prefix . 'tsc_parent_registration'; 

    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $confirm_password = sanitize_text_field($_POST['confirm_password']);

    // Validate inputs
    if (empty($email) || empty($password) || empty($confirm_password)) {
        wp_send_json_error(['success' => false, 'message' => 'All fields are required.']);
        return;
    } 
    
    if (!is_email($email)) {
        wp_send_json_error(['success' => false, 'message' => 'Invalid email address.']);
        return;
    } 
    
    if (email_exists($email)) {
        wp_send_json_error(['success' => false, 'message' => 'Email already exists.']);
        return;
    }
    
    if ($password !== $confirm_password) {
        wp_send_json_error(['success' => false, 'message' => 'Passwords do not match.']);
        return;
    }


    // Create the WordPress user
    $user_id = wp_create_user($email, $password, $email);

    if (is_wp_error($user_id)) {
        wp_send_json_error(['success' => false, 'message' => 'Failed to create user.']);
        return;
    }

    // Set user role and meta
    $user = new WP_User($user_id);
    $user->set_role('student');
    update_user_meta($user_id, 'registration_status', 'create');
    update_user_meta($user_id, 'account_status', 'active');

    // Add user to school registration table
    $reg_data = [
        'email' => $email,
        'password' => wp_hash_password($password),
        'role' => 'student',
        'submitted_at' => current_time('mysql'),
    ];

    $inserted = $wpdb->insert($registration_table, $reg_data);

    if (!$inserted) {
        wp_send_json_error(['success' => false, 'message' => 'Failed to add registration record.']);
        return;
    }

    // Add parent data
    $first_name = sanitize_text_field($_POST['first_name']); 
    $middle_name = sanitize_text_field($_POST['middle_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $role = sanitize_text_field($_POST['role']);

    $parent_data = [
        'registration_id' => $user_id,
        'first_name' => $first_name,
        'middle_name' => $middle_name, 
        'last_name' => $last_name,
        'email' => $email,
        'role' => $role,
        'type' => 'parent_1',
        'submitted_at' => current_time('mysql')
    ];

    $parent_insert = $wpdb->insert($parent_table, $parent_data);

    // Add subscriber to MailerLite
    $mailerlite_success = add_mailerlite_subscriber($email);

    if ($parent_insert && $mailerlite_success) {
        wp_send_json_success(['success' => true, 'message' => 'User created successfully.']);
    } else if ($parent_insert) {
        wp_send_json_success(['success' => true, 'message' => 'User created successfully but failed to add to mailing list.']);
    } else {
        wp_send_json_error(['success' => false, 'message' => 'Failed to insert parent data.']);
    }
}
add_action('wp_ajax_nopriv_add_new_user_data', 'add_new_user_data');
add_action('wp_ajax_add_new_user_data', 'add_new_user_data');

// For Update Parent data
function update_user_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    // print_r($_POST);
    $registration_id = isset($_POST['user_registration_id']) ? sanitize_text_field($_POST['user_registration_id']) : '';
    $user_id = isset($_POST['user_id']) ? sanitize_text_field($_POST['user_id']) : '';
    $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
    $middle_name = isset($_POST['middle_name']) ? sanitize_text_field($_POST['middle_name']) : '';
    $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $role = isset($_POST['role']) ? sanitize_text_field($_POST['role']) : '';

    // Validate required fields
    if(empty($user_id) || empty($first_name) || empty($last_name) || empty($email) || empty($role)) {
        wp_send_json_error(array('success' => false, 'message' => 'Required fields are missing.'));
        return;
    }

    $user_data =  array(
        'email' => $email,
    );

    $data = array(
        'first_name' => $first_name,
        'middle_name' => $middle_name,
        'last_name' => $last_name,
        'email' => $email,
        'role' => $role,
    );

    $registration_table = $wpdb->prefix . 'tsc_school_registration';
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';

    // Get user by registration ID
    $user = get_user_by('ID', $registration_id);
    if ($user) {
        // Update the user data including email
        $userdata = array(
            'ID' => $registration_id,
            'user_email' => $email,
        );
        $updated_wpuser = wp_update_user($userdata);
        // echo $updated_wpuser;
        if (is_wp_error($updated_wpuser)) {
            wp_send_json_error(['success' => false, 'message' => $updated_wpuser->get_error_message()]);
            return;
        }
    } else {
        wp_send_json_error(['success' => false, 'message' => 'User not found']);
        return;
    }

    if (is_wp_error($updated_wpuser)) {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to update user data.', 'error' => $updated_wpuser->get_error_message()));
        return;
    }

    $updated_user = $wpdb->update($registration_table, $user_data, array('id' => $registration_id));
    $updated = $wpdb->update($parent_table, $data, array('id' => $user_id));
    // echo $updated;
    if ($updated !== false && $updated_user !== false) {
        wp_send_json_success(array('success' => true, 'message' => 'User data updated successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to update user data.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_update_user_data', 'update_user_data');
add_action('wp_ajax_update_user_data', 'update_user_data');

// For Delete User data
function delete_user(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = intval($_POST['registration_id']);

    // Define all relevant tables
    $registration_table = $wpdb->prefix . 'tsc_school_registration';
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';
    $additional_info_table = $wpdb->prefix . 'tsc_additional_information';
    $student_application_table = $wpdb->prefix . 'tsc_student_application';
    $parent_address_table = $wpdb->prefix . 'tsc_parent_address';
    $student_table = $wpdb->prefix . 'tsc_student_information';
    $attendance_table = $wpdb->prefix . 'tsc_students_attendance';
    $transaction_table = $wpdb->prefix . 'tsc_transaction';
    $events_table = $wpdb->prefix . 'tsc_custom_events';
    $graduate_table = $wpdb->prefix . 'tsc_graduate_student';

    // Start transaction
    $wpdb->query('START TRANSACTION');

    try {
        // Delete student attendance records 
        $wpdb->delete($attendance_table, array('registration_id' => $registration_id));

        // Delete graduate student records
        $wpdb->delete($graduate_table, array('registration_id' => $registration_id));

        // Delete custom events
        $wpdb->delete($events_table, array('registration_id' => $registration_id));

        // Delete transactions
        $wpdb->delete($transaction_table, array('registration_id' => $registration_id));

        // Delete student records
        $wpdb->delete($student_table, array('registration_id' => $registration_id));

        // Delete parent address
        $wpdb->delete($parent_address_table, array('registration_id' => $registration_id));

        // Delete student application
        $wpdb->delete($student_application_table, array('registration_id' => $registration_id));

        // Delete additional info
        $wpdb->delete($additional_info_table, array('registration_id' => $registration_id));

        // Delete parent records
        $wpdb->delete($parent_table, array('registration_id' => $registration_id));

        // Delete registration record
        $wpdb->delete($registration_table, array('id' => $registration_id));

        // Delete WordPress user
        wp_delete_user($registration_id);

        // Commit transaction
        $wpdb->query('COMMIT');

        wp_send_json_success(array('success' => true, 'message' => 'User deleted successfully.'));

    } catch (Exception $e) {
        // Rollback on error
        $wpdb->query('ROLLBACK');
        wp_send_json_error(array(
            'success' => false, 
            'message' => 'Failed to delete user data.',
            'error' => $e->getMessage()
        ));
    }
}
add_action('wp_ajax_nopriv_delete_user', 'delete_user');
add_action('wp_ajax_delete_user', 'delete_user');

// For Update User Account Status
function update_user_status(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = intval($_POST['registration_id']);
    $status = sanitize_text_field($_POST['status']);

    $user = get_user_by('id', $registration_id);
    if (!$user) {
        wp_send_json_error(array('success' => false, 'message' => 'User not found.'));
        return;
    }

    $updated = update_user_meta($registration_id, 'account_status', $status);

    if ($updated) {
        wp_send_json_success(array('success' => true, 'message' => 'User status updated successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to update user status.'));
    }
}
add_action('wp_ajax_nopriv_update_user_status', 'update_user_status');
add_action('wp_ajax_update_user_status', 'update_user_status');

// For Delete Student data
function delete_student() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Not logged in'));
        return;
    }

    $student_id = intval($_POST['student_id']);

    // Define tables
    $student_table = $wpdb->prefix . 'tsc_student_information';
    $attendance_table = $wpdb->prefix . 'tsc_students_attendance';
    $graduate_table = $wpdb->prefix . 'tsc_graduate_student';

    // Start transaction
    $wpdb->query('START TRANSACTION');

    try {
        // Delete attendance records
        $wpdb->delete($attendance_table, array('student_id' => $student_id));

        // Delete graduate records
        $wpdb->delete($graduate_table, array('student_id' => $student_id));

        // Delete student record
        $deleted = $wpdb->delete($student_table, array('id' => $student_id));

        if ($deleted === false) {
            throw new Exception('Failed to delete student');
        }

        // Commit transaction
        $wpdb->query('COMMIT');

        wp_send_json_success(array(
            'success' => true, 
            'message' => 'Student deleted successfully'
        ));

    } catch (Exception $e) {
        // Rollback on error
        $wpdb->query('ROLLBACK');
        wp_send_json_error(array(
            'success' => false,
            'message' => 'Failed to delete student',
            'error' => $e->getMessage()
        ));
    }
}
add_action('wp_ajax_nopriv_delete_student', 'delete_student');
add_action('wp_ajax_delete_student', 'delete_student');

// For Get Student data by student id
function get_student_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $student_id = intval($_POST['student_id']);
    $table = $wpdb->prefix . 'tsc_student_information';

    $student_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $student_id), ARRAY_A);

    if ($student_data) {
        wp_send_json(array('success' => true, 'data' => $student_data));
    } else {
        wp_send_json(array('success' => false, 'message' => 'Student data not found.'));
    }
}
add_action('wp_ajax_nopriv_get_student_data', 'get_student_data');
add_action('wp_ajax_get_student_data', 'get_student_data');

// For edit student data
function edit_student_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Not logged in'));
        return;
    }

    // print_r($_POST);
    $student_id = sanitize_text_field($_POST['student_id']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $middle_name = sanitize_text_field($_POST['middle_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $dob = sanitize_text_field($_POST['dob']);
    $age = intval($_POST['age']);
    $grade = sanitize_text_field($_POST['grade']);
    $country = sanitize_text_field($_POST['country']);
    $county = sanitize_text_field($_POST['county']);
    $state = sanitize_text_field($_POST['state']);
    $gender = sanitize_text_field($_POST['gender']);
    $coop_name = sanitize_text_field($_POST['coop_name']);
    $immunization_file_name = sanitize_text_field($_POST['immunization_file_name']);
    $immunization_file_url = sanitize_text_field($_POST['immunization_file']);
    $student_profile_pic = sanitize_text_field($_POST['student_profile_pic']);
    $answer_3 = sanitize_text_field($_POST['answer_3']);
    $student_data = json_decode(stripslashes($_POST['questions']), true);
    $table = $wpdb->prefix . 'tsc_student_information';

    $data = [
        'student' => "student" ,
        'first_name' => $first_name,
        'middle_name' => $middle_name,
        'last_name' => $last_name,
        'dob' => $dob,
        'age' => $age,
        'grade' => $grade,
        'country' => $country,
        'county' => $county,
        'state' => $state,
        'gender' => $gender,
        'coop_name' => $coop_name,
        'immunization_file_name' => $immunization_file_name,
        'immunization_file_url' => $immunization_file_url,
        'student_profile_pic' => $student_profile_pic,
        'questions' => wp_json_encode($student_data),
    ];

    if ($answer_3 == 'no') {
        $data['student_transfer'] = wp_json_encode([]);
    }

    $updated = $wpdb->update($table, $data, array('id' => $student_id));

    if ($updated !== false) {
        wp_send_json_success(array('success' => true, 'message' => 'Student data updated successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to update student data.'));
    }
}
add_action('wp_ajax_nopriv_edit_student_data', 'edit_student_data');
add_action('wp_ajax_edit_student_data', 'edit_student_data');

// For save new student data 
function save_new_student_data() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Not logged in'));
        return;
    }

    // print_r($_POST);
    $registration_id = sanitize_text_field($_POST['registration_id']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $middle_name = sanitize_text_field($_POST['middle_name']); 
    $last_name = sanitize_text_field($_POST['last_name']);
    $dob = sanitize_text_field($_POST['dob']);
    $state = sanitize_text_field($_POST['state']);
    $county = sanitize_text_field($_POST['county']);
    $age = intval($_POST['age']);
    $grade = sanitize_text_field($_POST['grade']);
    $gender = sanitize_text_field($_POST['gender']);
    $student_profile_pic = sanitize_text_field($_POST['student_profile_pic']);
    $answer_3 = sanitize_text_field($_POST['answer_3']);
    $student_data = json_decode(stripslashes($_POST['questions']), true);
    $student_transfer = json_decode(stripslashes($_POST['student_transfer']), true);
    $year_paying = sanitize_text_field($_POST['year_paying']);
    $immunization_file_name = sanitize_text_field($_POST['immunization_file_name']);
    $immunization_file_url = sanitize_text_field($_POST['immunization_file_url']);

    $data = array(
        'registration_id' => $registration_id,
        'student' => "student",
        'first_name' => $first_name,
        'middle_name' => $middle_name,
        'last_name' => $last_name, 
        'dob' => $dob,
        'age' => $age,
        'grade' => $grade,
        'state' => $state,
        'county' => $county,
        'gender' => $gender,
        'year_paying' => $year_paying,
        'student_profile_pic' => $student_profile_pic,
        'immunization_file_name' => $immunization_file_name,
        'immunization_file_url' => $immunization_file_url,
        'questions' => wp_json_encode($student_data),
        'registration_status' => 'complete',
        'submitted_at' => current_time('mysql')
    );

    if ($answer_3 == 'no') {
        $data['student_transfer'] = wp_json_encode([]);
    } else {
        $data['student_transfer'] = wp_json_encode($student_transfer);
    }

    $inserted = $wpdb->insert($wpdb->prefix . 'tsc_student_information', $data);

    if ($inserted) {
        wp_send_json_success(array('success' => true, 'message' => 'Student data saved successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to save student data.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_save_new_student_data', 'save_new_student_data');
add_action('wp_ajax_save_new_student_data', 'save_new_student_data');

// For Get All coupons
function get_all_coupons(){
    global $wpdb;
    $table = $wpdb->prefix . 'tsc_coupon_codes';

    $data = array();

    $coupons_data = $wpdb->get_results("SELECT * FROM $table", ARRAY_A);
    if ($coupons_data) {
        $data['coupons_data'] = $coupons_data;
    }
    else {
        $data['coupons_data'] = [];
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_all_coupons', 'get_all_coupons');
add_action('wp_ajax_get_all_coupons', 'get_all_coupons');

// For Add coupon
function ajax_handle_add_coupon(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $coupon_code = sanitize_text_field($_POST['coupon_code']);
    $discount = sanitize_text_field($_POST['discount']);
    $discount_type = sanitize_text_field($_POST['discount_type']);
    $table = $wpdb->prefix . 'tsc_coupon_codes';

    $data = array(
        'code' => $coupon_code,
        'discount' => $discount,
        'discount_type' => $discount_type,
    );

        $inserted = $wpdb->insert($table, $data);

    if ($inserted) {
        wp_send_json_success(array('success' => true, 'message' => 'Coupon added successfully.'));
    } else {
        // wp_send_json_error(array('success' => false, 'message' => 'Failed to add coupon.', 'error' => $wpdb->last_error));
        if (strpos($wpdb->last_error, 'Duplicate entry') !== false) {
            wp_send_json_error(array('success' => false, 'message' => 'Coupon already Exists.'));
        } else {
            wp_send_json_error(array('success' => false, 'message' => 'Failed to add coupon.', 'error' => $wpdb->last_error));
        }
    }
}
add_action('wp_ajax_nopriv_ajax_handle_add_coupon', 'ajax_handle_add_coupon');
add_action('wp_ajax_ajax_handle_add_coupon', 'ajax_handle_add_coupon');

// For Edit coupon
function ajax_handle_edit_coupon(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $coupon_id = intval($_POST['coupon_id']);
    $coupon_code = sanitize_text_field($_POST['coupon_code']);
    $discount = sanitize_text_field($_POST['discount']);
    $discount_type = sanitize_text_field($_POST['discount_type']);
    $status = sanitize_text_field($_POST['status']);
    $table = $wpdb->prefix . 'tsc_coupon_codes';

    $data = array(
        'code' => $coupon_code,
        'discount' => $discount,
        'discount_type' => $discount_type,
        'status' => $status,
    );

    $inserted = $wpdb->update($table, $data, array('id' => $coupon_id));

    if ($inserted) {
        wp_send_json_success(array('success' => true, 'message' => 'Coupon updated successfully.'));
    } else if ($inserted === 0) {
        wp_send_json_success(array('success' => true, 'message' => 'No changes made.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to update coupon.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_edit_coupon', 'ajax_handle_edit_coupon');
add_action('wp_ajax_ajax_handle_edit_coupon', 'ajax_handle_edit_coupon');

// For Delete coupon
function ajax_handle_delete_coupon(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $coupon_id = intval($_POST['coupon_id']);
    $table = $wpdb->prefix . 'tsc_coupon_codes';

    $deleted = $wpdb->delete($table, array('id' => $coupon_id));

    if ($deleted) {
        wp_send_json_success(array('success' => true, 'message' => 'Coupon deleted successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to delete coupon.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_delete_coupon', 'ajax_handle_delete_coupon');
add_action('wp_ajax_ajax_handle_delete_coupon', 'ajax_handle_delete_coupon');

// for get all students School Transfers data
function get_all_school_transfers(){
    global $wpdb;
    $table = $wpdb->prefix . 'tsc_student_information';

    $data = array();

    $transfer_students = $wpdb->get_results(
        "SELECT id, 
                registration_id,
                CONCAT(first_name,' ',middle_name,' ',last_name) as student_name, 
                student_transfer,
                submitted_at
         FROM $table 
         WHERE student_transfer IS NOT NULL 
         AND student_transfer != '[]'
         AND student_transfer != ''
         AND JSON_EXTRACT(student_transfer, '$') != '[]'", 
        ARRAY_A
    );

    // Additional PHP-side filtering
    $filtered_students = array_filter($transfer_students, function($student) {
        $transfer_data = json_decode($student['student_transfer'], true);
        return !empty($transfer_data) && $transfer_data !== [];
    });

    if (!empty($filtered_students)) {
        $data['transfer_students'] = array_values($filtered_students);
    } else {
        $data['transfer_students'] = [];
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_all_school_transfers', 'get_all_school_transfers');
add_action('wp_ajax_get_all_school_transfers', 'get_all_school_transfers');

// For Update student transfer data
function update_school_transfer(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $student_id = intval($_POST['student_id']);
    $transfer_data =json_decode(stripslashes($_POST['student_transfer']), true);
    $table = $wpdb->prefix . 'tsc_student_information';

    $data = array(
        'student_transfer' => wp_json_encode($transfer_data),
    );

    // print_r($data);

    // wp_send_json_success(array('success' => true, 'message' => 'Student transfer updated successfully.'));
    $updated = $wpdb->update($table, $data, array('id' => $student_id));

    if ($updated) {
        wp_send_json_success(array('success' => true, 'message' => 'Student transfer updated successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to update student transfer.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_update_school_transfer', 'update_school_transfer');
add_action('wp_ajax_update_school_transfer', 'update_school_transfer');

// Get all Graduate students data
function get_all_school_graduates(){
    global $wpdb;
    $table = $wpdb->prefix . 'tsc_graduate_student';

    $data = array();

    $graduate_students = $wpdb->get_results("SELECT * FROM $table WHERE status != 'pending'", ARRAY_A);
    if ($graduate_students) {
        // Get the registration_id and parent name from parent table
        foreach ($graduate_students as &$student) {
            $parent_table = $wpdb->prefix . 'tsc_parent_registration';
            $parent = $wpdb->get_row($wpdb->prepare(
            "SELECT CONCAT(first_name,' ',middle_name,' ',last_name) as parent_name 
             FROM $parent_table 
             WHERE registration_id = %d AND type = 'parent_1'",
            $student['registration_id']
            ));
            
            $student['parent_name'] = $parent ? $parent->parent_name : '';
        }
        
        $data['graduate_students'] = $graduate_students;
    }
    else {
        $data['graduate_students'] = [];
    }
    
    if (empty($data['graduate_students'])) {
        wp_send_json(array('success' => false, 'message' => 'No graduates found.'));
    } else {
        wp_send_json(array('success' => true, 'data' => $data));
    }
}
add_action('wp_ajax_nopriv_get_all_school_graduates', 'get_all_school_graduates');
add_action('wp_ajax_get_all_school_graduates', 'get_all_school_graduates');

// Approved Graduate students data
function approve_graduate_student(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $student_id = intval($_POST['student_id']);
    $table = $wpdb->prefix . 'tsc_graduate_student';

    $data = array(
        'status' => 'approved',
        'updated_at' => current_time('mysql')
    );

    $updated = $wpdb->update($table, $data, array('student_id' => $student_id));

    if ($updated) {
        wp_send_json_success(array('success' => true, 'message' => 'Graduate student approved successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to approve graduate student.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_approve_graduate_student', 'approve_graduate_student');
add_action('wp_ajax_approve_graduate_student', 'approve_graduate_student');

// For Rejected Graduate students data
function reject_graduate_student(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $student_id = intval($_POST['student_id']);
    $reject_reason = sanitize_text_field($_POST['rejection_reason']);
    $table = $wpdb->prefix . 'tsc_graduate_student';

    $data = array(
        'status' => 'rejected',
        'reject_reason' => $reject_reason,
        'updated_at' => current_time('mysql')
    );

    $updated = $wpdb->update($table, $data, array('student_id' => $student_id));

    if ($updated) {
        wp_send_json_success(array('success' => true, 'message' => 'Graduate student rejected successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to reject graduate student.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_reject_graduate_student', 'reject_graduate_student');
add_action('wp_ajax_reject_graduate_student', 'reject_graduate_student');

// For view Specific Student Attendance
function get_student_attendance_by_id() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $student_id = intval($_POST['student_id']);
    $table = $wpdb->prefix . 'tsc_students_attendance';
    $student_table = $wpdb->prefix . 'tsc_student_information';

    // Get student details
    $student = $wpdb->get_row($wpdb->prepare(
        "SELECT id, registration_id, CONCAT(first_name,' ', middle_name,' ', last_name) as student_name, student_profile_pic 
        FROM $student_table 
        WHERE id = %d", 
        $student_id
    ), ARRAY_A);

    $data = array();
    
    if ($student) {
        $student_attendance = $wpdb->get_results($wpdb->prepare(
            "SELECT id, year, fall_semester, spring_semester, summer_semester 
            FROM $table 
            WHERE student_id = %d", 
            $student_id
        ), ARRAY_A);

        $data[] = array(
            'student_id' => $student['id'],
            'registration_id' => $student['registration_id'],
            'student_name' => $student['student_name'],
            'student_picture' => $student['student_profile_pic'],
            'attendance' => $student_attendance ? $student_attendance : []
        );
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_student_attendance_by_id', 'get_student_attendance_by_id');
add_action('wp_ajax_get_student_attendance_by_id', 'get_student_attendance_by_id');

// For view Specific Student course data
function get_student_course_by_id() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $student_id = intval($_POST['student_id']);
    $student_table = $wpdb->prefix . 'tsc_student_information';

    $registration_status = get_user_meta($registration_id, 'registration_status', true);

    if($registration_status == 'create')
    {
        // get the gmail of the user
        $user = get_userdata($registration_id);
        $email = $user->user_email;
        wp_send_json_success(array('success' => false, 'status' => 'Not Started', 'email' => $email));
    } else {
        $data = array();

        // Get registration data
        $data['status'] = $registration_status;
        
        // Get student data
        $student_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $student_table WHERE id = %d AND registration_status = 'complete'", $student_id), ARRAY_A);
        if ($student_data) {
            $data['student_data'] = $student_data;
        } else {
            $data['student_data'] = [];
        }

        wp_send_json(array('success' => true, 'data' => $data));
    }
}
add_action('wp_ajax_nopriv_get_student_course_by_id', 'get_student_course_by_id');
add_action('wp_ajax_get_student_course_by_id', 'get_student_course_by_id');

// For view Specific Registration data
function get_registration_data_by_id() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $registration_id = intval($_POST['registration_id']);
    $registration_table = $wpdb->prefix . 'tsc_school_registration';
    $parent_table = $wpdb->prefix . 'tsc_parent_registration'; 
    $additional_info_table = $wpdb->prefix . 'tsc_additional_information';
    $student_application_table = $wpdb->prefix . 'tsc_student_application';
    $parent_address_table = $wpdb->prefix . 'tsc_parent_address';
    $student_table = $wpdb->prefix . 'tsc_student_information';

    $registration_status = get_user_meta($registration_id, 'registration_status', true);

    $registration_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $registration_table WHERE id = %d", $registration_id));

    $data = array();

    // Get registration data
    $data['status'] = $registration_status;

    // Get parent 1 data
    $parent_1_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $parent_table WHERE registration_id = %d AND type = 'parent_1'", $registration_id), ARRAY_A);
    if (!$parent_1_data) {
        // If parent 1 data is not found, send an error response
        $data['parent_1_data'] = null;
        wp_send_json(array('success' => false, 'message' => 'Parent 1 data not found.', 'data' => $data));
    }
    else {
        // If parent 1 data is found, add it to the response
        $data['parent_1_data'] = $parent_1_data;
    }


    // Get parent 2 data
    $parent_2_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $parent_table WHERE registration_id = %d AND type = 'parent_2'", $registration_id), ARRAY_A);
    if ($parent_2_data) {
        $data['parent_2_data'] = $parent_2_data;
    } 
    else {
        $data['parent_2_data'] = null;
    }

    // Get additional info data
    $additional_info_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $additional_info_table WHERE registration_id = %d", $registration_id), ARRAY_A);
    if ($additional_info_data) {
        $data['additional_info_data'] = $additional_info_data;
    }
    else {
        $data['additional_info_data'] = null;
    }

    // Get student application data
    $student_application_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $student_application_table WHERE registration_id = %d", $registration_id), ARRAY_A);
    if ($student_application_data) {
        $data['student_application_data'] = $student_application_data;
    }
    else {
        $data['student_application_data'] = null;
    }

    // Get parent address data
    $parent_address_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $parent_address_table WHERE registration_id = %d", $registration_id), ARRAY_A);
    if ($parent_address_data) {
        $data['parent_address_data'] = $parent_address_data;
    }
    else {
        $data['parent_address_data'] = null;
    }

    // Get student data
    $student_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM  $student_table WHERE registration_id = %d AND registration_status = 'complete'", $registration_id), ARRAY_A);
    if ($student_data) {
        $data['student_data'] = $student_data;
    }
    else {
        $data['student_data'] = null;
    }

    wp_send_json(array('success' => true, 'data' => $data));

}
add_action('wp_ajax_nopriv_get_registration_data_by_id', 'get_registration_data_by_id');
add_action('wp_ajax_get_registration_data_by_id', 'get_registration_data_by_id');

// For get specific user students data
function get_students_data_by_registration_id(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.', 'student_data' => []));
        return;
    }

    // $registration_id = get_current_user_id();
    $registration_id = intval($_POST['registration_id']);
    $table = $wpdb->prefix . 'tsc_student_information';

    $data = array();

    $student_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE registration_id = %d AND registration_status = 'complete'", $registration_id), ARRAY_A);
    if ($student_data) {
        $data['student_data'] = $student_data;
    }
    else {
        $data['student_data'] = [];
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_students_data_by_registration_id', 'get_students_data_by_registration_id');
add_action('wp_ajax_get_students_data_by_registration_id', 'get_students_data_by_registration_id');

// for get student transfer data by student id
function get_student_transfer_data_by_id(){
    
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.', 'transcript_data' => []));
        return;
    }

    $student_id = intval($_POST['student_id']);
    $student_table = $wpdb->prefix . 'tsc_student_information';
    $attendance_table = $wpdb->prefix . 'tsc_students_attendance';
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';
    $parent_address_table = $wpdb->prefix . 'tsc_parent_address';
    // Get all students for this registration
    $students = $wpdb->get_results($wpdb->prepare(
        "SELECT id, 
                registration_id,
                CONCAT(first_name,' ',middle_name,' ',last_name) as student_name,
                student_profile_pic,
                dob,
                grade,
                gender,
                student_course
         FROM $student_table 
         WHERE id = %d
         AND registration_status = 'complete'", 
        $student_id
    ), ARRAY_A);
    
    $data = array();

    if (empty($students)) {
        wp_send_json(array('success' => false, 'message' => 'Student not found'));
        return;
    }

    $registration_id = $students[0]['registration_id'];

    $address = $wpdb->get_row($wpdb->prepare("SELECT * FROM $parent_address_table WHERE registration_id = %d", $registration_id), ARRAY_A);

    $parent_data = $wpdb->get_row($wpdb->prepare("SELECT 
     email,
     phone,
     country_code
     FROM $parent_table WHERE registration_id = %d AND type = 'parent_1'", $registration_id), ARRAY_A);

    if ($students) {
        foreach ($students as $student) {
            // Get attendance data for this student
            $attendance = $wpdb->get_results($wpdb->prepare(
                "SELECT year, fall_semester as fall, spring_semester as spring, summer_semester as summer
                 FROM $attendance_table 
                 WHERE student_id = %d",
                $student['id']
            ), ARRAY_A);


            $data[] = array(
                'student_id' => $student['id'],
                'registration_id' => $student['registration_id'],
                'student_name' => $student['student_name'],
                'student_grade' => $student['grade'],
                'photo' => $student['student_profile_pic'],
                'dob' => $student['dob'],
                'course_data' => json_decode($student['student_course'], true),
                'attendance' => $attendance ? $attendance : [],
                'address' => $address,
                'parent_email' => isset($parent_data['email']) ? $parent_data['email'] : null,
                'gender' => $student['gender'],
                'parent_phone' => isset($parent_data['phone']) ? $parent_data['phone'] : null,
                'country_code' => isset($parent_data['country_code']) ? $parent_data['country_code'] : null
            );
        }
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_student_transfer_data_by_id', 'get_student_transfer_data_by_id');
add_action('wp_ajax_get_student_transfer_data_by_id', 'get_student_transfer_data_by_id');

// For get portfolio data by registration id
function get_portfolio_data_by_registration_id(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.', 'portfolio_data' => []));
        return;
    }

    $registration_id = intval($_POST['registration_id']);
    $table = $wpdb->prefix . 'tsc_student_portfolio';
    $student_table = $wpdb->prefix . 'tsc_student_information';

    $data = array();

    $student_data = $wpdb->get_results($wpdb->prepare(
        "SELECT id, CONCAT(first_name, ' ', middle_name, ' ', last_name) as student_name 
         FROM $student_table 
         WHERE registration_id = %d AND registration_status = 'complete'", 
        $registration_id
    ), ARRAY_A);

    if ($student_data) {
        $data['student_data'] = $student_data;
    }
    else {
        $data['student_data'] = [];
    }
    
    $portfolio_data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE registration_id = %d", $registration_id), ARRAY_A);
    if ($portfolio_data && $student_data) {
        $data['portfolio_data'] = $portfolio_data;
    }
    else {
        $data['portfolio_data'] = [];
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_portfolio_data_by_registration_id', 'get_portfolio_data_by_registration_id');
add_action('wp_ajax_get_portfolio_data_by_registration_id', 'get_portfolio_data_by_registration_id');

// For save portfolio data by admin
function save_portfolio_data_by_admin(){
    // print_r($_POST);
    global $wpdb;
    // Retrieve and sanitize POST data
    $registration_id = intval($_POST['registration_id']);
    $student_id = intval($_POST['student_id']);
    $document_type = sanitize_text_field($_POST['document_type']);
    $title = sanitize_text_field($_POST['title']);
    $description = sanitize_textarea_field($_POST['description']); 
    $file_name = sanitize_text_field($_POST['file_name']);
    $student_name = sanitize_text_field($_POST['student_name']);

    // Handle file upload
    if(isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $upload_dir = wp_upload_dir();
        $upload_path = $upload_dir['path'];
        $upload_url = $upload_dir['url'];
        
        // Generate unique filename
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $unique_filename = uniqid() . '.' . $extension;
        $file_path = $upload_path . '/' . $unique_filename;
        
        if(move_uploaded_file($file['tmp_name'], $file_path)) {
            $document_url = $upload_url . '/' . $unique_filename;
            
            $table = $wpdb->prefix . 'tsc_student_portfolio';
            
            $data = array(
                'registration_id' => $registration_id,
                'student_id' => intval($_POST['student_id']), 
                'student_name' => $student_name,
                'document_type' => $document_type,
                'title' => $title,
                'description' => $description,
                'document_name' => $file_name,
                'document_url' => $document_url,
                'submitted_at' => current_time('mysql')
            );

            $inserted = $wpdb->insert($table, $data);
            
            if($inserted) {
                wp_send_json_success(array(
                    'success' => true, 
                    'message' => 'Portfolio document saved successfully',
                    'document_url' => $document_url
                ));
            } else {
                wp_send_json_error(array(
                    'success' => false,
                    'message' => 'Failed to save portfolio document',
                    'error' => $wpdb->last_error
                ));
            }
        } else {
            wp_send_json_error(array(
                'success' => false,
                'message' => 'Failed to upload file'
            ));
        }
    } else {
        wp_send_json_error(array(
            'success' => false,
            'message' => 'No file uploaded'
        ));
    }

}
add_action('wp_ajax_nopriv_save_portfolio_data_by_admin', 'save_portfolio_data_by_admin');
add_action('wp_ajax_save_portfolio_data_by_admin', 'save_portfolio_data_by_admin');

// For Update parent_data for parent 1 and parent 2 by admin
function ajax_handle_update_parent_data_by_admin() {
    // handel data for parent 1
    global $wpdb;
    // print all data
    // print_r($_POST);
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    // $registration_id = get_current_user_id();
    $registration_id = intval($_POST['registration_id']);
    $role = sanitize_text_field($_POST['role']);
    $type = sanitize_text_field($_POST['type']);
    $f_name = sanitize_text_field($_POST['first_name']);
    $m_name = sanitize_text_field($_POST['middle_name']);
    $l_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $country_code = sanitize_text_field($_POST['country_code']);
    $phone = sanitize_text_field($_POST['contact']);
    $year_paying = isset($_POST['school_year']) ? sanitize_text_field($_POST['school_year']) : '';
    $heard_about_us = isset($_POST['heard_about_us']) ? sanitize_text_field($_POST['heard_about_us']) : '';
    $parent_data = json_decode(stripslashes($_POST['questions']), true);
    $table = $wpdb->prefix . 'tsc_parent_registration';

    $data = array(
        'registration_id' => $registration_id,
        'type' => $type,
        'role' => $role,
        'first_name' => $f_name,
        'middle_name' => $m_name,
        'last_name' => $l_name,
        'country_code' => $country_code,
        'phone' => $phone,
        'email' => $email,
        'year_paying' => $year_paying,
        'heard_about_us' => $heard_about_us,
        'questions' => wp_json_encode($parent_data),
        'submitted_at' => current_time('mysql'),
    );

    if ($type == 'parent_1') {
        $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d AND type = %s", $registration_id, $type));
        if ($check) {
            // updata the data
            $inserted = $wpdb->update($table, $data, array('id' => $check));
        }
        else
        {
            $inserted = $wpdb->insert($table, $data);
        }
    }
    else
    {
        $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d AND type = %s", $registration_id, $type));
        if ($check) {
            // updata the data
            $inserted = $wpdb->update($table, $data, array('id' => $check));
        }
        else
        {
            $inserted = $wpdb->insert($table, $data);
        }
    }

    if ($inserted) {
        wp_send_json_success(array('success' => true, 'message' => 'Parent data saved successfully.'));
    } else if ($inserted === 0) {
        wp_send_json_success(array('success' => true, 'message' => 'No changes made.'));
    }
     else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to save parent data.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_update_parent_data_by_admin', 'ajax_handle_update_parent_data_by_admin');
add_action('wp_ajax_ajax_handle_update_parent_data_by_admin', 'ajax_handle_update_parent_data_by_admin');

// For Update additional information data by admin
function ajax_handle_update_additional_data_by_admin(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    // $registration_id = get_current_user_id();
    $registration_id = intval($_POST['registration_id']);
    $additional_data = json_decode(stripslashes($_POST['additional_info']), true);
    $table = $wpdb->prefix . 'tsc_additional_information';

    $data = array(
        'registration_id' => $registration_id,
        'questions' => wp_json_encode($additional_data),
        'submitted_at' => current_time('mysql'),
    );

    $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d", $registration_id));
    if ($check) {
        $inserted = $wpdb->update($table, $data, array('id' => $check));
    } else {
        $inserted = $wpdb->insert($table, $data);
    }

    if ($inserted) {
        wp_send_json_success(array('success' => true, 'message' => 'Additional information saved successfully.'));
    } else if ($inserted === 0) {
        wp_send_json_success(array('success' => true, 'message' => 'No changes made.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to save additional information.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_update_additional_data_by_admin', 'ajax_handle_update_additional_data_by_admin');
add_action('wp_ajax_ajax_handle_update_additional_data_by_admin', 'ajax_handle_update_additional_data_by_admin');

// For Update student application data by admin
function ajax_handle_update_student_application_by_admin(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    // $registration_id = get_current_user_id();
    $registration_id = intval($_POST['registration_id']);
    $student_data = json_decode(stripslashes($_POST['student_application']), true);
    $table = $wpdb->prefix . 'tsc_student_application';

    $data = array(
        'registration_id' => $registration_id,
        'questions' => wp_json_encode($student_data),
        'submitted_at' => current_time('mysql'),
    );

    $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d", $registration_id));
    if ($check) {
        $inserted = $wpdb->update($table, $data, array('id' => $check));
    } else {
        $inserted = $wpdb->insert($table, $data);
    }

    if ($inserted) {
        wp_send_json_success(array('success' => true, 'message' => 'Student application saved successfully.'));
    } else if ($inserted === 0) {
        wp_send_json_success(array('success' => true, 'message' => 'No changes made.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to save student application.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_update_student_application_by_admin', 'ajax_handle_update_student_application_by_admin');
add_action('wp_ajax_ajax_handle_update_student_application_by_admin', 'ajax_handle_update_student_application_by_admin');

// For Update parent address data by admin
function ajax_handle_update_parent_address_by_admin(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    // $registration_id = get_current_user_id();
    $registration_id = intval($_POST['registration_id']);
    $address = sanitize_text_field($_POST['address']);
    $city = sanitize_text_field($_POST['city']);
    $state = sanitize_text_field($_POST['state']);
    $zip = sanitize_text_field($_POST['zip']);
    $county = sanitize_text_field($_POST['county']);
    $country_code = sanitize_text_field($_POST['country_code']);
    $emg_contact_name = sanitize_text_field($_POST['emg_contact_name']);
    $emg_contact_phone = sanitize_text_field($_POST['emg_contact_phone']);
    $table = $wpdb->prefix . 'tsc_parent_address';

    $data = array(
        'registration_id' => $registration_id,
        'address' => $address,
        'city' => $city,
        'state' => $state,
        'zip' => $zip,
        'county' => $county,
        'country_code' => $country_code,
        'emg_contact_name' => $emg_contact_name,
        'emg_contact_phone' => $emg_contact_phone,
        'submitted_at' => current_time('mysql'),
    );

    $check = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE registration_id = %d", $registration_id));
    if ($check) {
        $inserted = $wpdb->update($table, $data, array('id' => $check));
    } else {
        $inserted = $wpdb->insert($table, $data);
    }

    if ($inserted) {

        // get user email
        $user = get_userdata($registration_id);
        $email = $user->user_email;
        wp_send_json_success(array('success' => true, 'message' => 'Parent address saved successfully.', 'email' => $email));
    } else if ($inserted === 0) {
        wp_send_json_success(array('success' => true, 'message' => 'No changes made.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to save parent address.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_ajax_handle_update_parent_address_by_admin', 'ajax_handle_update_parent_address_by_admin');
add_action('wp_ajax_ajax_handle_update_parent_address_by_admin', 'ajax_handle_update_parent_address_by_admin');

// Save course data by admin
function save_student_course_by_admin() {
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.'));
        return;
    }

    $student_id = intval($_POST['student_id']);
    $student_course_data = json_decode(stripslashes($_POST['student_course']), true);
    $table = $wpdb->prefix . 'tsc_student_information';

    $data = [
        'student_course' => wp_json_encode($student_course_data),
    ];

    $inserted = $wpdb->update($table, $data, ['id' => $student_id]);
    if ($inserted!==false) {
        wp_send_json_success(['success' => true, 'message' => 'Student course information saved successfully.']);
    } else {
        wp_send_json_error(['success' => false, 'message' => 'Failed to save student course information.', 'error' => $wpdb->last_error]);
    }
}
add_action('wp_ajax_nopriv_save_student_course_by_admin', 'save_student_course_by_admin');
add_action('wp_ajax_save_student_course_by_admin', 'save_student_course_by_admin');

// For get specific user students data
function get_students_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.', 'student_data' => []));
        return;
    }

    $registration_id = get_current_user_id();
    // $registration_id = intval($_POST['registration_id']);
    $table = $wpdb->prefix . 'tsc_student_information';
    $graduate_table = $wpdb->prefix . 'tsc_graduate_student';

    $data = array();

    $student_data = $wpdb->get_results($wpdb->prepare(
        "SELECT s.id, 
                CONCAT(s.first_name, ' ', s.middle_name, ' ', s.last_name) as student_name,
                s.grade,
                s.student_profile_pic,
                CASE 
                    WHEN g.id IS NULL THEN 'NOT GRADUATED'
                    WHEN g.status = 'pending' THEN 'NOT GRADUATED'
                    WHEN g.status = 'applied' THEN 'GRADUATED'
                    WHEN g.status = 'approved' THEN 'GRADUATED'
                    WHEN g.status = 'rejected' THEN 'NOT GRADUATED'
                    ELSE 'NOT GRADUATED'
                END as graduation_status
         FROM $table s
         LEFT JOIN $graduate_table g ON s.id = g.student_id
         WHERE s.registration_id = %d 
         AND s.registration_status = 'complete'",
        $registration_id
    ), ARRAY_A);
    
    if ($student_data) {
        $data['student_data'] = $student_data;
    }
    else {
        $data['student_data'] = [];
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_students_data', 'get_students_data');
add_action('wp_ajax_get_students_data', 'get_students_data');

// For update specific student data
function update_student_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Not logged in'));
        return;
    }

    // print_r($_POST);
    $student_id = intval($_POST['student_id']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $middle_name = sanitize_text_field($_POST['middle_name']); 
    $last_name = sanitize_text_field($_POST['last_name']);
    $dob = sanitize_text_field($_POST['dob']);
    $state = sanitize_text_field($_POST['state']);
    $county = sanitize_text_field($_POST['county']);
    $age = intval($_POST['age']);
    $grade = sanitize_text_field($_POST['grade']);
    $gender = sanitize_text_field($_POST['gender']);
    $student_profile_pic = sanitize_text_field($_POST['student_profile_pic']);
    $answer_3 = sanitize_text_field($_POST['answer_3']);
    $student_data = json_decode(stripslashes($_POST['questions']), true);
    $immunization_file_name = sanitize_text_field($_POST['immunization_file_name']);
    $immunization_file_url = sanitize_text_field($_POST['immunization_file_url']);

    $data = array(
        'student' => "student",
        'first_name' => $first_name,
        'middle_name' => $middle_name,
        'last_name' => $last_name, 
        'dob' => $dob,
        'age' => $age,
        'grade' => $grade,
        'state' => $state,
        'county' => $county,
        'gender' => $gender,
        'student_profile_pic' => $student_profile_pic,
        'immunization_file_name' => $immunization_file_name,
        'immunization_file_url' => $immunization_file_url,
        'questions' => wp_json_encode($student_data),
    );

    if ($answer_3 == 'no') {
        $data['student_transfer'] = wp_json_encode([]);
    }

    $inserted = $wpdb->update($wpdb->prefix . 'tsc_student_information', $data, array('id' => $student_id));

    if ($inserted !== false) {
        wp_send_json_success(array('success' => true, 'message' => 'Student data saved successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to save student data.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_update_student_data', 'update_student_data');
add_action('wp_ajax_update_student_data', 'update_student_data');

// Admin settings page save action
function update_settings_action() {
    // Check nonce for security
    check_ajax_referer( 'update_settings_data', 'settings_save_action' );

    $page_id = $_POST['page_id'];
    // Process form data
    $reg_button_1 = sanitize_text_field( $_POST['reg_button_1'] );
    $reg_button_2    = sanitize_text_field( $_POST['reg_button_2'] );
    $agreement_privacy_policy    = wp_kses_post( $_POST['agreement_privacy_policy'] );

    $each_student_pay_below_8 = sanitize_text_field($_POST['each_student_pay_below_8']);
    $each_student_pay_after_8 = sanitize_text_field($_POST['each_student_pay_after_8']);
    $processing_fee = sanitize_text_field($_POST['processing_fee']);
    $transfer_fee = sanitize_text_field($_POST['transfer_fee']);
    $family_app_fee = sanitize_text_field($_POST['family_app_fee']);
    $reinstatement_fess = sanitize_text_field($_POST['reinstatement_fess']);
    $old_student_graduate_price = sanitize_text_field($_POST['old_student_graduate_price']);
    $new_student_graduate_price = sanitize_text_field($_POST['new_student_graduate_price']);
    $renewal_app_fee = sanitize_text_field($_POST['renewal_app_fee']);

    // Send a response back to the AJAX call
    update_field('registration_page_button1', $reg_button_1, $page_id);
    update_field('registration_page_button2', $reg_button_2, $page_id);
    update_field('agreement_page_privacy_policy_text', $agreement_privacy_policy, $page_id);

    // Update the Fee settings
    update_field('each_student_pay_below_8', $each_student_pay_below_8, $page_id);
    update_field('each_student_pay_after_8', $each_student_pay_after_8, $page_id);
    update_field('processing_fee', $processing_fee, $page_id);
    update_field('transfer_fee', $transfer_fee, $page_id);
    update_field('family_app_fee', $family_app_fee, $page_id);
    update_field('reinstatement_fess', $reinstatement_fess, $page_id);
    update_field('old_student_graduate_price', $old_student_graduate_price, $page_id);
    update_field('new_student_graduate_price', $new_student_graduate_price, $page_id);
    update_field('renewal_app_fee', $renewal_app_fee, $page_id);
    
    
    wp_send_json_success( 'Settings has been updated' );

}
add_action( 'wp_ajax_update_settings_action', 'update_settings_action' );
add_action( 'wp_ajax_nopriv_update_settings_action', 'update_settings_action' );

// Renew user By admin
function renew_user_by_admin(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Not logged in'));
        return;
    }

    $registration_id = intval($_POST['registration_id']);
    $account_expire = sanitize_text_field($_POST['account_expire']);
    $current_expire_year = date('Y', strtotime($account_expire));
    $next_year = $current_expire_year + 1;
    $expire_date = $next_year . '-08-10';
    $current_time = current_time('mysql');
    $transactionItems = json_decode(stripslashes($_POST['transactionItems']), true);
    $data = array(
        'renewal_by_admin' => 'yes',
        'account_expire' => $expire_date
    );

    $transaction_data = [
        'registration_id' => $registration_id,
        'transaction_id'  => 'Admin Renew Manually',
        'description'     => 'Graduates Academy - Renew Registration by Admin',
        'amount'          => '0.00',
        'expires_at'      => $expire_date,
        'created_at'      => $current_time,
        'transactionItems' => json_encode($transactionItems)
    ];

    $table = $wpdb->prefix . 'tsc_school_registration';
    $inserted = $wpdb->update($table, $data, array('id' => $registration_id));

    $transaction_table = $wpdb->prefix . 'tsc_transaction';
    $inserted_transaction = $wpdb->insert($transaction_table, $transaction_data);

    if ($inserted !== false && $inserted_transaction !== false) {
        wp_send_json_success(array('success' => true, 'message' => 'User renewed successfully.'));
    } else {
        wp_send_json_error(array('success' => false, 'message' => 'Failed to renew user.', 'error' => $wpdb->last_error));
    }
}
add_action('wp_ajax_nopriv_renew_user_by_admin', 'renew_user_by_admin');
add_action('wp_ajax_renew_user_by_admin', 'renew_user_by_admin');

// For Get All Transaction data
function get_all_transaction_data(){
    global $wpdb;
    if (!is_user_logged_in()) {
        wp_send_json_success(array('success' => false, 'message' => 'Registration not found.', 'transaction_data' => []));
        return;
    }

    $transaction_table = $wpdb->prefix . 'tsc_transaction';
    $parent_table = $wpdb->prefix . 'tsc_parent_registration';

    $data = array();

    $transactions = $wpdb->get_results("SELECT * FROM $transaction_table", ARRAY_A);

    if ($transactions) {
        foreach ($transactions as &$transaction) {
            // Get parent name for each transaction's registration_id
            $parent = $wpdb->get_row($wpdb->prepare(
                "SELECT CONCAT(first_name, ' ', middle_name, ' ', last_name) as parent_name 
                 FROM $parent_table 
                 WHERE registration_id = %d AND type = 'parent_1'",
                $transaction['registration_id']
            ));
            
            // Add parent name to transaction data
            $transaction['user_name'] = $parent ? $parent->parent_name : 'Unknown';
        }
        
        $data['transaction_data'] = $transactions;
    } else {
        $data['transaction_data'] = [];
    }

    wp_send_json(array('success' => true, 'data' => $data));
}
add_action('wp_ajax_nopriv_get_all_transaction_data', 'get_all_transaction_data');
add_action('wp_ajax_get_all_transaction_data', 'get_all_transaction_data');