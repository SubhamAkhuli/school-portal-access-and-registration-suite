<?php
// Start the session
// session_start();

// // Check if user is logged in and is admin
// if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
//     // Redirect to login page if not logged in as admin
//     wp_redirect(home_url('/login'));
//     exit();
// }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School | Registration | Login </title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/login_form.css'; ?>">
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/all.min.css'; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>
<body>
    <div class="container-fluid">
        <div class="text-center">
            <h1>Admin Dashboard</h1>
        </div>
        <div class="row justify-content-center mt-0 formBox ">
            <div class="col-sm-12 col-md-6 col-lg-9 p-0 mt-3 mb-2">
                <h4 class="text-center">Admin Dashboard</h4>
                <div id="showdata"></div>
                
</body>
<script src="<?php echo plugin_dir_url(__FILE__); ?>js/jquery-3.3.1.min.js"></script>
<script src="<?php echo plugin_dir_url(__FILE__); ?>ajax/admin_ajax_function.js"></script>