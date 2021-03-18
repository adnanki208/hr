<?php

session_start();
//adnan kefak
//if(!isset($_SESSION['admin_name']) && !isset($_SESSION['password'])) {
//   sssssss header("Location:views/admin/dashboard.php");
//}
$url='http://localhost/hr/';
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
    <link href="resource/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="resource/css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="resource/css/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="resource/css/animate.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="resource/css/custom.css" rel="stylesheet">
</head>

<body class="login" style="padding: 10%">
<div>


    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form id="loginForm">
                    <h1>Log in your Account</h1>
                    <h5 class="errorAlert">

                    </h5>
                    <div>
                        <input type="text" id="userName" name="userName" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                        <button type="submit" name="login" id="submit"  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> loading..." class="btn btn-default submit">Log in</button>

                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                            <h1><i class="fa fa-paw"></i> HR Group !</h1>
                            <p>©2021 All Rights Reserved. HR Group</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>


    </div>
</div>
</body>
<script src="resource/js/jquery.min.js"></script>
<script src="resource/js/jquery.js"></script>
<script src="resource/js/bootstrap.js"></script>
<script src="resource/js/forms/log.js"></script>
</html>