   <!-- Sidebar start -->
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
        <li><a href="./dashboard" class="l-menu-link d-flex gap-2 <?php if(in_array('dashboard', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-server"></i></span><span>Dashboard</span></a></li>
        <li><a href="./students" class="l-menu-link d-flex gap-2 <?php if(in_array('students', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fa-solid fa-user-graduate"></i></span><span>Students</span></a></li>
        <li><a href="./calendar" class="l-menu-link d-flex gap-2 <?php if(in_array('calendar', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fa-solid fa-calendar-days"></i></span><span>Calendar</span></a></li>
        <li><a href="./class" class="l-menu-link d-flex gap-2 <?php if(in_array('class', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fa-solid fa-chalkboard "></i></span><span>Classes & Grades</span></a></li>
        <li><a href="./attendance" class="l-menu-link d-flex gap-2 <?php if(in_array('attendance', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fa-solid fa-calendar-check"></i></span><span>Attendance</span></a></li>
        <li><a href="./transcripts" class="l-menu-link d-flex gap-2 <?php if(in_array('transcripts', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fa-solid fa-file-alt"></i></span><span>Transcripts</span></a></li>
        <li><a href="./links" class="l-menu-link d-flex gap-2 <?php if(in_array('links', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fa-solid fa-link"></i></span><span>Links</span></a></li>
        <li><a href="./campus-shop" class="l-menu-link d-flex gap-2 <?php if(in_array('campus-shop', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fa-solid fa-store"></i></span><span>Campus Shop</span></a></li>
        <li><a href="./forms" class="l-menu-link d-flex gap-2 <?php if(in_array('forms', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-file"></i></span><span>Forms</span></a></li>
        <li><a href="./quiz" class="l-menu-link d-flex gap-2 <?php if(in_array('quiz', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fas fa-question-circle"></i></span><span>Quiz</span></a></li>
        <li><a href="./portfolio" class="l-menu-link d-flex gap-2 <?php if(in_array('portfolio', $url_arr)) { echo 'active'; } ?>"><span class="icon-holder"><i class="fa-solid fa-scroll"></i></span><span>Portfolio</span></a></li>
        <li><a href="<?php echo wp_logout_url(home_url()); ?>" class="l-menu-link d-flex gap-2"><span class="icon-holder"><i class="fas fa-sign-out-alt"></i></span><span>Logout</span></a></li>
    </ul>

    </div>
    <!-- sidebar end -->