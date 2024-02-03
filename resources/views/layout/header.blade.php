<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>The Social Edge</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="The Nonverbal Group - Develop Behavioral Awareness, Sharpen Your Communication & Gain a Social Edge" name="description" />
        <meta content="The Nonverbal Group" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo URL("/") ?>/assets/images/favicon.ico">

        <link href="<?php echo URL("/") ?>/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
		
		
        <!-- third party css -->
        <link href="<?php echo URL("/") ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL("/") ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL("/") ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL("/") ?>/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

		<!-- App css -->
		<link href="<?php echo URL("/") ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="<?php echo URL("/") ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="<?php echo URL("/") ?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
		<link href="<?php echo URL("/") ?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />

		<!-- icons -->
		<link href="<?php echo URL("/") ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo URL("/") ?>/assets/css/theme.css" rel="stylesheet" type="text/css" />
        <style>
#textarea{display: none;}
#checkbox{display: none;}
#radio{display: none;}
.inputbox{display: none; height:100%;}
#quiz{display: none;}
.left-side-menu{background:#000;}
#sidebar-menu>ul>li>a{color:#ffffff;}
body[data-topbar-color=light] .logo-box{background:#000;}
#sidebar-menu .menuitem-active .active { color:#ffffff; }
#sidebar-menu .menuitem-active { background:#535151; }
.btn-dark{background-color: #000;border-color: #000;border-radius: 0px;}
</style>
        

    </head>

    <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>
        <!-- Begin page -->
<div id="wrapper">

<!-- Topbar Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">

            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none" data-toggle="fullscreen" href="#">
                    <i data-feather="maximize"></i>
                </a>
            </li>

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link nav-user me-0" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="<?php echo URL("/") ?>/assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ms-1">Admin</span>
                </a>
            </li>

   <!--         <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle">
                    <i data-feather="settings"></i>
                </a>
            </li>
-->
            <li class="dropdown notification-list">
                <a onclick="if(confirm('Are you sure you want to logout?')) { window.location.href='{{route('admin.logout')}}'; }" style="cursor:pointer;" title="Logout" class="nav-link">
                    <i data-feather="power"></i>
                </a>
            </li>
        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="<?php echo URL("/") ?>/assets/images/logo-sm.png" alt="" height="24">
                    <!-- <span class="logo-lg-text-light">Shreyu</span> -->
                </span>
                <span class="logo-lg">
                    <img src="<?php echo URL("/") ?>/assets/images/logo-dark.png" alt="" height="27">
                    <!-- <span class="logo-lg-text-light">S</span> -->
                </span>
            </a>

            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="<?php echo URL("/") ?>/assets/images/logo-sm.png" alt="" height="24">
                </span>
                <span class="logo-lg">
                    <img src="<?php echo URL("/") ?>/assets/images/logo-light.png" alt="" height="24">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile">
                    <i data-feather="menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->

<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <!-- <li class="menu-title">Navigation</li> -->

                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <i data-feather="home"></i>
                        <span> Dashboards </span>
                        <!-- <span class="menu-arrow"></span> -->
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.user')}}">
                        <i data-feather="users"></i>
                        <span> Users </span>
                    </a>
                </li>
                
                <li>
                    <a href="{{route('admin.content_list')}}">
                        <i data-feather="list"></i>
                        <span> Content </span>
                    </a>
                </li>
                
                <li>
                    <a href="{{route('admin.course')}}">
                        <i data-feather="grid"></i>
                        <span> Courses </span>
                    </a>
                </li>

                <li>
                    <a href=" {{route('admin.phase')}}">
                        <i data-feather="bookmark"></i>
                        <span> Phases </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.part')}}">
                        <i data-feather="package"></i>
                        <span> Parts </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.lesson')}}">
                        <i data-feather="grid"></i>
                        <span> Lessons </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.quiz')}}">
                        <i data-feather="clipboard"></i>
                        <span> Quiz </span>
                    </a>
                </li>
                
                <li>
                    <a href="{{route('admin.quiz_submission')}}">
                        <i data-feather="clipboard"></i>
                        <span> Quiz Submission </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.membership')}}">
                        <i data-feather="gift"></i>
                        <span> Membership </span>
                    </a>
                </li>


                <li>
                    <a href="javascript:;">
                        <i data-feather="file-plus"></i>
                        <span> Transaction </span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->