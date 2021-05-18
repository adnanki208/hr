<?php include  "../../template/header.php";
if (!checkHash() || !in_array(3, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo _CreateRole;?></h3>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo _PutYourInformation;?> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" id="addRole" data-parsley-validate>
                        <span class="section"><?php echo _RoleInfo;?></span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo _RoleName ;?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="title" class="form-control col-md-7 col-xs-12" required=""   data-parsley-error-message="<?php echo _Required;?>"    type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code"><?php echo _RoleCode;?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="code" class="form-control col-md-7 col-xs-12" required=""   data-parsley-error-message="<?php echo _Required;?>"    type="text">
                            </div>
                        </div>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code"><?php echo _Permissions;?><span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="role">
                                    <label class="form-check-label" for="defaultCheck1">
                                        <?php echo _Department;?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="2" id="defaultCheck2"  name="role">
                                    <label class="form-check-label" for="defaultCheck2">
                                        <?php echo _Skills;?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="3" id="defaultCheck3"  name="role">
                                    <label class="form-check-label" for="defaultCheck3">
                                        <?php echo _Role;?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="4" id="defaultCheck4"  name="role">
                                    <label class="form-check-label" for="defaultCheck4">
                                        <?php echo _Attendance;?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="5" id="defaultCheck5"  name="role">
                                    <label class="form-check-label" for="defaultCheck5">
                                        <?php echo _Alerts;?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="6" id="defaultCheck6"  name="role">
                                    <label class="form-check-label" for="defaultCheck6">
                                        <?php echo _SelfService;?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="7" id="defaultCheck7"  name="role">
                                    <label class="form-check-label" for="defaultCheck7">
                                        <?php echo _Employees;?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="14" id="defaultCheck14"  name="role">
                                    <label class="form-check-label" for="defaultCheck14">
                                        <?php echo _MyEmployees;?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="13" id="defaultCheck13"  name="role">
                                    <label class="form-check-label" for="defaultCheck13">
                                        <?php echo _Tasks;?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="8" id="defaultCheck8"  name="role">
                                    <label class="form-check-label" for="defaultCheck8">
                                        <?php echo _JobType;?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="9" id="defaultCheck9"  name="role">
                                    <label class="form-check-label" for="defaultCheck9">
                                        <?php echo _Salary;?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="10" id="defaultCheck10"  name="role">
                                    <label class="form-check-label" for="defaultCheck10">
                                        <?php echo _Evaluation;?>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="11" id="defaultCheck11"  name="role">
                                    <label class="form-check-label" for="defaultCheck11">
                                        <?php echo _Discount;?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="12" id="defaultCheck12"  name="role">
                                    <label class="form-check-label" for="defaultCheck12">
                                        <?php echo _Branch;?>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button class="btn btn-success" id="submit" type="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?php echo _Loading;?>..."  ><?php echo _Add;?></button>
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
<script src="./resource/js/forms/createRole.js"></script>

