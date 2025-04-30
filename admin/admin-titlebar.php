<div class="titlebar">
    <div class="d-flex justify-content-between gap-1 flex-wrap">      
        <div class="d-flex  gap-1 flex-wrap"><h3 class="entry-title" style="color: #456fb6;"><?php the_title(); ?></h3></div>

        <div class="d-flex justify-content-between gap-1 flex-wrap">
            <div class="dropdown">
                <button class="dropdown-toggle" id="dropdownMenuButton">
                    <!-- <img src="<?php echo plugin_dir_url(__FILE__); ?>/img/user-1.jpg" class="profile-icon" height="35" alt="user"> -->
                    <img src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>/img/user-profile.png" class="profile-icon" height="35" alt="user">
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item l-menu-link d-flex" href="/settings"><span class="icon-holder"><i class="fa-solid fa-gears"></i></span> Settings</a>
                    <a class="dropdown-item logout" href="<?php echo wp_logout_url(home_url()); ?>">
                        <span class="icon-holder"><i class="fas fa-sign-out-alt"></i></span> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .titlebar h3 {
        margin: 0px;
    }
        /* Dropdown container */
    .titlebar .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown toggle button */
    .titlebar .dropdown-toggle {
        background: none;
        border: none;
        cursor: pointer;
        outline: none;
        padding: 0px;
    }

    /* Profile icon styling */
    .profile-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        border: 2px solid #456fb6;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    /* Dropdown menu */
    .titlebar .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        padding: 10px 0;
        z-index: 1000;
        min-width: 180px;
    }

    /* Dropdown item */
    .titlebar .dropdown-item {
        padding: 10px 15px;
        color: #333;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .titlebar .dropdown-item:hover {
        background: #f8f9fa;
    }

    /* Icon holder styling */
    .titlebar .icon-holder {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
    }

    /* Logout button */
    .titlebar .logout {
        text-align: center;
        padding: 10px 15px;
        border-top: 1px solid #e9ecef;
    }

    .titlebar .logout:hover {
        background: #f8f9fa;
    }

    /* Show dropdown menu on hover or click */
    .titlebar .dropdown:hover .dropdown-menu {
        display: block;
    }
    
</style>