   <!-- Admin-Sidebar start -->
   <div class="sidebar" id="sidebar-wrapper">
      <div class="sidebar-logo">
        <div class="logo">
          <?php
          if ( has_custom_logo() ) {
            the_custom_logo();
          }
          ?>
        </div>
      </div>

      <?php
        $current_url = get_permalink();
        $url_arr = explode("/", $current_url);
        
      ?>
      <ul class="menu">
        <li><a href="./dashboard" class="l-menu-link d-flex gap-2 <?php if(in_array('dashboard', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-house"></i></span><span>Dashboard</span></a></li>
        <li><a href="./users" class="l-menu-link d-flex gap-2 <?php if(in_array('users', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-users"></i></span><span>Users</span></a></li>
        <li><a href="javascript:void(0)" class="l-menu-link d-flex gap-2 <?php if(in_array('search', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-search"></i></span><span>Search</span></a></li>
        <li><a href="javascript:void(0)" class="l-menu-link d-flex gap-2 <?php if(in_array('message', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-envelope"></i></span><span>Message</span></a></li>
        <li><a href="./manage-coupons" class="l-menu-link d-flex gap-2 <?php if(in_array('coupon', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-gift"></i></span><span>Coupon</span></a></li>
        <li><a href="javascript:void(0)" class="l-menu-link d-flex gap-2 <?php if(in_array('grades', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-award"></i></span><span>Grades</span></a></li>
        <li><a href="javascript:void(0)" class="l-menu-link d-flex gap-2 <?php if(in_array('unpaid', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-receipt"></i></span><span>Unpaid</span></a></li>
        <li><a href="./transfer-students" class="l-menu-link d-flex gap-2 <?php if(in_array('transfer', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-exchange-alt"></i></span><span>New Transfer</span></a></li>
        <li><a href="./graduate-students" class="l-menu-link d-flex gap-2 <?php if(in_array('graduate', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-graduation-cap"></i></span><span>Graduate</span></a></li>
        <li><a href="javascript:void(0)" class="l-menu-link d-flex gap-2 <?php if(in_array('email-logs', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-envelope-open-text"></i></span><span>Email Logs</span></a></li>
        <li><a href="javascript:void(0)" class="l-menu-link d-flex gap-2 <?php if(in_array('quiz', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-chalkboard-teacher"></i></span><span>Quiz</span></a></li>
        <li><a href="javascript:void(0)" class="l-menu-link d-flex gap-2 <?php if(in_array('upload', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-upload"></i></span><span>Upload PDF</span></a></li>
        <li><a href="./transaction-data" class="l-menu-link d-flex gap-2 <?php if(in_array('transactions', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-money-check-alt"></i></span><span>Transactions</span></a></li>
        <li><a href="<?php echo wp_logout_url(home_url()); ?>" class="l-menu-link d-flex gap-2"><span class="icon-holder"><i class="fas fa-sign-out-alt"></i></span><span>Logout</span></a></li>
      </ul>
 
    </div>
    <!-- admin-sidebar end -->