<?php include  "../../template/header.php";
if (!checkHash() || !in_array(6, $_SESSION['user']['access'])) { ?>
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
            <h3><?php echo _RequestVacation;?></h3>
        </div>

    </div>
    <div class="clearfix"></div>



    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo _PutVacationInformation;?> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" id="addVacation" data-parsley-validate>
                        <span class="section"><?php echo _VacationInfo;?></span>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vacationDate"><?php echo _EnterDateOfVacation;?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  id="vacationDate" class="form-control col-md-7 col-xs-12" required=""   data-parsley-error-message="<?php echo _Required;?>" name="vacationDate"   type="date">
                            </div>
                        </div>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vacationType"><?php echo _ChooseVacationType;?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="vacationType" name="vacationType"  required="" data-parsley-error-message="<?php echo _Required;?>">

                                        <option value="1"><?php echo _NormalVacation;?></option>
                                        <option value="2"><?php echo _SickVacation;?></option>
                                        <option value="3"><?php echo _Unjustified;?></option>

                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vacationDescription"><?php echo _EnterDateOfVacation;?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  id="vacationDescription" class="form-control col-md-7 col-xs-12" required=""   data-parsley-error-message="<?php echo _Required;?>" name="vacationDate"   type="text">
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?php echo _Loading;?>..." id="submit" type="submit" class="btn btn-success"><?php echo _Add;?></button>
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
<script src="./resource/js/forms/createRequestVacation.js"></script>

