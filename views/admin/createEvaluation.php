<?php include  "../../template/header.php";
if (!checkHash() || !in_array(10, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}
$stmt = $con->prepare("SELECT * FROM employee");
//execute yhe statement
$stmt->execute();
//Assign To Variable
$users = $stmt->fetchAll();
?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo _CreateEvaluation;?></h3>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo _AddEvaluationInformation;?> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="item form-group dateSelect">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 text-right" for="date"><?php echo _Month;?><span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="date" class="form-control col-md-7 col-xs-12" required=""  name="date"  type="month">

                        </div>
                    </div>
                    <div id="month" class="mt-5 text-center"></div>
                    <div class="clearfix"></div>
                    <form class="form-horizontal form-label-left dsNone  mt-5" style="margin-top: 20px" id="add" data-parsley-validate>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employeeId"><?php echo _User;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="employeeId" name="employeeId"
                                        data-parsley-errors-container="#documentError"        required="required" data-parsley-error-message="<?php echo _Required;?>">
                                    <option disabled="disabled" selected><?php echo _SelectUser;?></option>
                                    <?php foreach ($users as $user) { ?>
                                        <option value="<?= $user['id'] ?>"><?= $user['first'].' '.$user['last'].' ('.$user['userName'].')' ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <div id="documentError"></div>

                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attendance"><?php echo _Attendance;?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="attendance" min="1" max="5" step="0.1"   class="form-control col-md-7 col-xs-12 countEv" required=""   data-parsley-error-message="<?php echo _Required;?>"    type="number">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="punctuality"><?php echo _Punctuality;?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="punctuality" min="1" max="5" step="0.1" class="form-control col-md-7 col-xs-12 countEv" required=""   data-parsley-error-message="<?php echo _Required;?>"    type="number">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="communication"><?php echo _Communication;?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="communication" min="1" max="5" step="0.1" class="form-control col-md-7 col-xs-12 countEv" required=""   data-parsley-error-message="<?php echo _Required;?>"    type="number">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dress"><?php echo _Dress;?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="dress" min="1" max="5" step="0.1" class="form-control col-md-7 col-xs-12 countEv" required=""   data-parsley-error-message="<?php echo _Required;?>"    type="number">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productivity"><?php echo _Productivity;?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="productivity" min="1" max="5" step="0.1" class="form-control col-md-7 col-xs-12 countEv" required=""   data-parsley-error-message="<?php echo _Required;?>"    type="number">
                            </div>
                        </div>

                        <input type="hidden" id="total">


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="submit" type="submit" class="btn btn-success" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?php echo _Loading;?>..." ><?php echo _Add;?></button>
                            </div>
                        </div>
                    </form>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><?php echo _EvaluationConfirmation;?></h4>
                                </div>
                                <div class="modal-body">
                                    <h4><span><?php echo _Name;?>: <label class="userName label label-primary" ></label></span></h4>
                                    <h4><span><?php echo _Date;?>: <label class="dateOut label label-info" ></label></span></h4>
                                    <h4><span><?php echo _Total;?>: <label class="total label label-success" ></label></span></h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success evBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?php echo _Loading;?>..."><?php echo _CheckOut;?></button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _Close;?></button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="notification_body">
                        <div class="notification">
                            <div class="msg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include  "../../template/footer.php"?>
<!--own page Script-->
<script src="./resource/js/forms/createEvaluation.js"></script>

