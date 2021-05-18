<?php include  "../../template/header.php";
if (!checkHash() || !in_array(5, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}
$stmt=$con->prepare("SELECT id,userName FROM employee");
//execute yhe statement
$stmt->execute(array());

//Assign To Variable
$rows=$stmt->fetchAll();

?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo _EmployeeAttendance;?></h3>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo _PutEmployeeAttendance;?> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" id="add" data-parsley-validate>
                        <span class="section"><?php echo _EmployeeAttendance;?></span>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id"><?php echo _AssignEmployee;?>  <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="id" name="id"  required="" data-parsley-error-message="<?php echo _Required;?>">
                                    <?php foreach ($rows as $row) { ?>
                                        <option value="<?php echo $row['id']?>" <?php echo isset($_GET['id'])&&$_GET['id']==$row['id']?'selected':'';?>><?php echo  $row['userName']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-right" for="date"><?php echo _Day;?><span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="date" class="form-control col-md-7 col-xs-12" required=""  name="date"  data-parsley-error-message="<?php echo _Required;?>" type="date">

                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="time"><?php echo _PutTheEnterTime;?>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="time" class="form-control col-md-7 col-xs-12"   name="time" type="time" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?php echo _Loading;?>..." id="login" type="submit" class="btn btn-success"><?php echo _CheckIN;?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo _PutEmployeeAttendance;?> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" id="add2" data-parsley-validate>
                        <span class="section"><?php echo _EmployeeAttendance;?></span>

                        <div class="item form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-right" for="date2"><?php echo _Day;?><span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="date2" class="form-control col-md-7 col-xs-12" required=""  name="date2" data-parsley-error-message="<?php echo _Required;?>" type="date">

                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id"><?php echo _AssignEmployee;?>  <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="id2" name="id"  required="" data-parsley-error-message="<?php echo _Required;?>">
                                    <?php foreach ($rows as $row) { ?>
                                        <option value="<?php echo $row['id']?>" <?php echo isset($_GET['id'])&&$_GET['id']==$row['id']?'selected':'';?>><?php echo  $row['userName']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="time2"><?php echo _PutTheOutTime;?>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="time2" class="form-control col-md-7 col-xs-12"   name="time2" type="time" data-parsley-error-message="<?php echo _Required;?>" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?php echo _Loading;?>..." id="logout" type="submit" class="btn btn-danger"><?php echo _CheckOut;?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo _PutEmployeeNotAttended;?> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" id="add3" data-parsley-validate>
                        <span class="section"><?php echo _EmployeeNotAttended;?></span>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id3"><?php echo _AssignEmployee;?>  <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="id3" name="id3"  required="" data-parsley-error-message="<?php echo _Required;?>">
                                    <?php foreach ($rows as $row) { ?>
                                        <option value="<?php echo $row['id']?>" <?php echo isset($_GET['id'])&&$_GET['id']==$row['id']?'selected':'';?>><?php echo  $row['userName']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 text-right" for="date3"><?php echo _Day;?><span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="date3" class="form-control col-md-7 col-xs-12" required="" data-parsley-error-message="<?php echo _Required;?>" name="date3"  type="date">

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?php echo _Loading;?>..." id="vacation" type="submit" class="btn btn-primary"><?php echo _NotAttended;?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include  "../../template/footer.php"?>
<!--own page Script-->
<script src="./resource/js/forms/createEmployeeAttendance.js"></script>

