<?php

session_start();

if (isset($_GET['lang'])) {
    if($_GET['lang']=='ar'){
        $_SESSION['lang'] = 'ar';
    }
    else{
        $_SESSION['lang']='en';
    }
}


if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar') {
    include_once('./../../lang/ar.php');
} else {
    include_once('./../../lang/en.php');
}




$url = "http://localhost/hr/";
include "../../request/init.php";

if (!isset($_SESSION['user']['authKey'])) {
    header("Location:" . $url . "");
}


$alert = checkAlert('id', 'alerts', $_SESSION['user']['id']);

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
    <link href="<?php echo $url ?>resource/css/bootstrap.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo $url ?>resource/css/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $url ?>resource/css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $url ?>resource/css/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo $url ?>resource/css/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo $url ?>resource/css/bootstrap-progressbar-3.3.4.css" rel="stylesheet">
    <link href="<?php echo $url ?>resource/css/trumbowyg.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo $url ?>resource/css/jqvmap.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo $url ?>resource/css/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo $url ?>resource/css/custom.css" rel="stylesheet">
    <!-- Select2 Style -->
    <link href="<?php echo $url ?>resource/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo $url ?>resource/css/fileinput.min.css" rel="stylesheet">
    <!-- Main Style -->
    <link href="<?php echo $url ?>resource/css/main.css" rel="stylesheet">
    <?php if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar') {?>
    <link href="<?php echo $url ?>resource/css/rtl.css" rel="stylesheet">
    <?php  }?>

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="<?php echo $url ?>myinfo" class="site_title"><i class="fa fa-users"></i>
                        <span>HR System </span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="<?php echo isset($_SESSION['user']['img']) ? $url . 'uploads/img/' . $_SESSION['user']['img'] : $url . 'resource/images/img.png' ?>"
                             style="width: 50px;height:50px" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span><?php echo _Welcome;?></span>
                        <h2><?php echo $_SESSION['user']['userName'] ?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <li class="">
                                <a><i class="fa fa-home"></i> <?php echo _Home;?> <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo $url ?>myinfo">
                                            <?php echo _Profile;?>  </a></li>
                                    <li><a href="<?php echo $url ?>UserService"> <?php echo _SelfService;?></a></li>
                                    <li class=""><a class="beforePage" href="<?php echo $url ?>viewMyAlerts"><?php echo _MyAlerts;?> <?php if ($alert > 0) { ?> <span
                                                    class="badge bg-green"><?php echo $alert ?></span><?php } ?></a>
                                    </li>
                                    <li class=""><a href="<?php echo $url ?>myTask"><?php echo _MyTasks;?></a></li>
                                    <li class=""><a href="<?php echo $url ?>myAttendance"><?php echo _ShowMyAttendance;?></a></li>
                                    <li class=""><a href="<?php echo $url ?>mySalary"><?php echo _Salary;?></a></li>
                                    <li class=""><a href="<?php echo $url ?>myEvaluation"><?php echo _Evaluation;?></a></li>

                                    <!--<li><a href="../admin/dashboard2.php">Dashboard2</a></li>-->
                                    <!--<li><a href="../admin/dashboard3.php">Dashboard3</a></li>-->
                                </ul>
                            </li>
                            <?php if (in_array(14, $_SESSION['user']['access'])) { ?>

                                <li>
                                    <a><i class="fa fa-group"></i><?php echo _MyEmployees;?> <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li class=""><a href="<?php echo $url ?>myEmployees"><?php echo _MyEmployees;?></a></li>
                                        <li class=""><a href="<?php echo $url ?>viewMyEmployeeAlert"><?php echo _MyEmployeesAlert;?></a></li>
                                        <li class=""><a href="<?php echo $url ?>myEmployeeTask"><?php echo _MyEmployeesTasks;?></a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (in_array(1, $_SESSION['user']['access'])) { ?>
                                <li>
                                    <a><i class="fa fa-edit"></i> <?php echo _Department;?> <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo $url ?>viewDepartment"><?php echo _ViewDepartment;?></a></li>
                                        <li><a href="<?php echo $url ?>createDepartment"><?php echo _CreateDepartment;?></a></li>

                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (in_array(12, $_SESSION['user']['access'])) { ?>
                                <li>
                                    <a><i class="fa fa-bank"></i> <?php echo _Branch;?> <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo $url ?>viewBranch"><?php echo _ViewBranch;?></a></li>
                                        <li><a href="<?php echo $url ?>createBranch"><?php echo _CreateBranch;?></a></li>

                                    </ul>
                                </li>
                            <?php } ?>

                            <?php if (in_array(2, $_SESSION['user']['access'])) { ?>
                                <li>
                                    <a><i class="fa fa-skyatlas"></i> <?php echo _Skills;?> <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo $url ?>viewSkill"><?php echo _ViewSkillGroups;?></a></li>
                                        <li><a href="<?php echo $url ?>createSkill"><?php echo _CreateSkillGroup;?></a></li>
                                        <li><a href="<?php echo $url ?>showSkills"><?php echo _ViewSkills;?></a></li>
                                        <li><a href="<?php echo $url ?>addSkills"><?php echo _AddSkills;?></a></li>
                                        <li><a href="<?php echo $url ?>employeeSkill/"><?php echo _AssignSkillsToEmployees;?> </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php }
                            if (in_array(3, $_SESSION['user']['access'])) { ?>
                                <li>
                                    <a><i class="fa fa-tasks"></i> <?php echo _Roles;?> <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo $url ?>viewRole"><?php echo _ViewRoles;?></a></li>
                                        <li><a href="<?php echo $url ?>createRole"><?php echo _CreateRole;?></a></li>
                                    </ul>
                                </li>
                            <?php }
                            if (in_array(4, $_SESSION['user']['access'])){ ?>
                            <li>
                                <a><i class="fa fa-clock-o"></i> <?php echo _Attendance;?> <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo $url ?>viewAttendance"><?php echo _ViewAttendanceShifts;?></a></li>
                                    <li><a href="<?php echo $url ?>createAttendance"><?php echo _CreateAttendanceShift;?></a></li>
                                    <li><a href="<?php echo $url ?>viewEmployeeAttendance"><?php echo _ViewEmployeeAttendance;?></a>
                                    </li>
                                    <li><a href="<?php echo $url ?>EmployeeAttendance"><?php echo _EmployeesAttendance;?></a></li>

                                </ul>

                                <?php } if (in_array(5, $_SESSION['user']['access'])){ ?>

                            <li>
                                <a><i class="fa fa-warning"></i> <?php echo _Alerts;?> <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo $url ?>viewAlert"><?php echo _ViewAlerts;?> </a></li>
                                    <li><a href="<?php echo $url ?>createAlert/"><?php echo _CreateAlert;?></a></li>
                                </ul>
                            </li>
                        <?php }
                        if (in_array(6, $_SESSION['user']['access'])) { ?>

                            <li>
                                <a><i class="fa fa-paper-plane-o"></i> <?php echo _SelfService;?> <span
                                            class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo $url ?>viewRequestVacation"><?php echo _ViewVacations;?> </a></li>
                                    <li><a href="<?php echo $url ?>createRequestVacation"><?php echo _RequestVacation;?> </a></li>
                                </ul>
                            </li>
                        <?php }?>
                            <?php if (in_array(8, $_SESSION['user']['access'])) { ?>

                            <li>
                                <a><i class="fa fa-briefcase"></i> <?php echo _JobType;?> <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo $url ?>viewJobType"><?php echo _ViewJobType;?></a></li>
                                    <li><a href="<?php echo $url ?>createJobType"><?php echo _CreateJobType;?></a></li>
                                </ul>
                            </li>
                            <?php }
                        if (in_array(7, $_SESSION['user']['access'])) { ?>

                            <li>
                                <a><i class="fa fa-user"></i> <?php echo _Employees;?> <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo $url ?>viewEmployees"><?php echo _ViewEmployees;?></a></li>
                                    <li><a href="<?php echo $url ?>createEmployee"><?php echo _CreateEmployee;?></a></li>
                                </ul>
                            </li>
                        <?php } ?>

                            <?php if (in_array(13, $_SESSION['user']['access'])) { ?>

                                <li>
                                    <a><i class="fa fa-check-square-o"></i> <?php echo _Tasks;?> <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo $url ?>viewTasks"><?php echo _ViewEmployeesTasks;?></a></li>
                                        <li><a href="<?php echo $url ?>createTask"><?php echo _CreateTask;?></a></li>
                                    </ul>
                                </li>
                            <?php } ?>

                            <?php if (in_array(9, $_SESSION['user']['access'])) { ?>

                                <li>
                                    <a><i class="fa fa-money"></i> <?php echo _Salary;?> <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo $url ?>viewSalary"><?php echo _ViewSalaries;?></a></li>
                                        <li><a href="<?php echo $url ?>createSalary"><?php echo _CreateSalary;?></a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (in_array(10, $_SESSION['user']['access'])) { ?>

                                <li>
                                    <a><i class="fa fa-bar-chart"></i> <?php echo _Evaluation;?> <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo $url ?>viewEvaluation"><?php echo _ViewEvaluations;?></a></li>
                                        <li><a href="<?php echo $url ?>createEvaluation"><?php echo _CreateEvaluation;?></a></li>
                                        <li><a href="<?php echo $url ?>bonusEvaluation"><?php echo _EvaluationBonus;?></a></li>
                                    </ul>
                                </li>
                            <?php } ?>

                            <?php if (in_array(11, $_SESSION['user']['access'])) { ?>

                                <li>
                                    <a><i class="fa fa-percent"></i><?php echo _LateDiscount;?> <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo $url ?>viewDiscount"><?php echo _ViewDiscount;?></a></li>
                                        <li><a href="<?php echo $url ?>createDiscount"><?php echo _CreateDiscountRole;?></a></li>
                                    </ul>
                                </li>
                            <?php } ?>
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
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="<?php echo isset($_SESSION['user']['img']) ? $url . 'uploads/img/' . $_SESSION['user']['img'] : $url . 'resource/images/img.png' ?>"
                                     alt=""><?php echo $_SESSION['user']['userName'] ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="<?php echo $url ?>employeeInfo/<?php echo $_SESSION['user']['id'] ?>">
                                        <?php echo _Profile;?></a></li>
                                <li><a href="?lang=<?php echo  _Lang?>"><i class="fa fa-language pull-right"></i> <?php echo _Lang?></a></li>

                                <li><a href="<?php echo $url ?>logout"><i class="fa fa-sign-out pull-right"></i> <?php echo _LogOut;?></a>
                                </li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-calendar"></i>
                                <?php if ($alert > 0) { ?>
                                    <span class="badge bg-green"><?php echo $alert ?></span>
                                <?php } ?>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">

                                <?php
                                //                        foreach ($_SESSION["events"] as $event){
                                ?>
                                <li>
                                    <a>
                                        <span class="image"><img
                                                    src="<?php echo isset($_SESSION['user']['img']) ? $url . 'uploads/img/' . $_SESSION['user']['img'] : $url . 'resource/images/img.png' ?>"
                                                    alt="Profile Image"/></span>
                                        <span>
                                  <span><?php echo $_SESSION['user']['userName'] ?></span>
                                  <span class="time"><?php echo(date("Y-m-d", time()));
                                      ?></span>
                                </span>
                                        <span class="message">
                                        <?php if ($alert > 0) { ?>
                                            <?php echo _YouHave;?> <?php echo $alert ?> <?php echo _Alerts;?>
                                        <?php } else {
                                            echo _NoAlerts;
                                        } ?>
                               </span>
                                    </a>
                                </li>
                                <?php
                                //                        }
                                ?>
                                <?php if ($alert > 0) { ?>
                                    <li>
                                        <div class="text-center">
                                            <a href="<?php echo $url ?>viewMyAlert">
                                                <strong><?php echo _SeeAllAlerts;?></strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        <input type="hidden" id="lang1" value="<?php echo $_SESSION['lang']?>">

        <!-- page content -->
        <div class="right_col" role="main">
