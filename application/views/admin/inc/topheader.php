<header class="main-header"> 
        <a href="<?=base_url('admin/dashboard')?>" class="logo"> <!-- Logo -->
            <span class="logo-mini">               
                <img src="<?=base_url()?>assets/img/logo.png" alt="Logo">
            </span>
            <span class="logo-lg">                      
                <img src="<?=base_url()?>assets/img/logo.png" alt="Logo">
            </span>
        </a>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <!-- Sidebar toggle button-->
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-ellipsis-h"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                   
                    <!-- settings -->
                    <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cog"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=base_url('admin/dashboard')?>"><i class="fa fa-user"></i> User Profile</a></li>
                            <li><a href="#"><i class="fa fa-cogs"></i> Settings</a></li>
                            <li><a href="<?=base_url('admin/logout')?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>