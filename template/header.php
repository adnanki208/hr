<?php

session_start();
$url="http://localhost/hr/";

if(!isset($_SESSION['user']['authKey'])) {
    header("Location:".$url."");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Human Resource Management Sysytem</title>
    <link rel="icon" href="<?php echo $url; ?>resource/images/img.png" type="image/gif"/>
    <!-- Bootstrap -->
    <link href="<?php echo $url?>resource/css/bootstrap.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo $url?>resource/css/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $url?>resource/css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $url?>resource/css/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo $url?>resource/css/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo $url?>resource/css/bootstrap-progressbar-3.3.4.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo  $url?>resource/css/jqvmap.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo  $url?>resource/css/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo  $url?>resource/css/custom.css" rel="stylesheet">
    <!-- Select2 Style -->
    <link href="<?php echo  $url?>resource/css/select2.min.css" rel="stylesheet">
    <!-- Main Style -->
    <link href="<?php echo  $url?>resource/css/main.css" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
     <div class="main_container">
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo  $url?>dashboard" class="site_title"><i class="fa fa-paw"></i> <span>HR Group !</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?php echo  $url?>resource/images/img.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['user']['userName']?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li class="">
                        <a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="current-page"><a href="<?php echo  $url?>dashboard">Dashboard</a></li>
                            <!--<li><a href="../admin/dashboard2.php">Dashboard2</a></li>-->
                            <!--<li><a href="../admin/dashboard3.php">Dashboard3</a></li>-->
                        </ul>
                    </li>
                    <?php if(in_array(1,$_SESSION['user']['access'])){ ?>
                    <li>
                        <a><i class="fa fa-edit"></i> Department <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo  $url?>viewDepartment">View Department</a></li>
                            <li><a href="<?php echo  $url?>createDepartment">Create Department</a></li>

                        </ul>
                    </li>
                    <?php } ?>


                    <li>
                        <a><i class="fa fa-skyatlas"></i> Skils <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo  $url?>viewSkill">View Skill Groups</a></li>
                            <li ><a href="<?php echo  $url?>createSkill">Create Skill Group</a></li>
                            <li ><a href="<?php echo  $url?>showSkills">View Skills </a></li>
                            <li ><a href="<?php echo  $url?>addSkills">Add Skills </a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-tasks"></i> Roles <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo  $url?>viewRole">View Roles</a></li>
                            <li ><a href="<?php echo  $url?>createRole">Create Roles</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-user"></i> Employees <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo  $url?>viewRole">View Roles</a></li>
                            <li ><a href="<?php echo  $url?>createEmployee">Create Employee</a></li>
                        </ul>
                    </li>


                    <li>
                        <a><i class="fa fa-clone"></i>Notice <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="../noticeBoard/noticeBoard.php">Notice Board</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                    <li>
                        <a><i class="fa fa-laptop"></i> Live Event <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="../liveEvent/liveEvent.php">View Live Event</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

    </div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $url?>resource/images/img.png" alt="">HR Group
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;"> Profile</a></li>
                        <li><a href="<?php echo $url?>logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>

                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-calendar"></i>
                        <span class="badge bg-green">a</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">

                        <?php
//                        foreach ($_SESSION["events"] as $event){
                            ?>
                            <li>
                                <a>
                                    <span class="image"><img src="<?php echo $url?>resource/images/img.png" alt="Profile Image" /></span>
                                    <span>
                                  <span>HR Group</span>
                                  <span class="time">10:30</span>
                                </span>
                                    <span class="message">
                                 aa
                               </span>
                                </a>
                            </li>
                            <?php
//                        }
                        ?>
                        <li>
                            <div class="text-center">
                                <a href="../liveEvent/liveEvent.php">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
<!-- page content -->
<div class="right_col" role="main">
