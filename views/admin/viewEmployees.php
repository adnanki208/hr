<?php include "../../template/header.php";
if (!checkHash() || !in_array(7, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


} ?>
<div class="page-title">
    <div class="title_left">
        <h3><?php echo _EmployeesList;?></h3>
    </div>


</div>

<div class="clearfix"></div>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo _Manage;?> <small><?php echo _Employees;?></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <p class="text-muted font-13 m-b-30">

                </p>

                <table id="pro" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo _UserName;?></th>
                        <th><?php echo _FirstName;?></th>
                        <th><?php echo _LastName;?></th>
                        <th><?php echo _State;?></th>
                        <th><?php echo _Branch;?></th>
                        <th><?php echo _Role;?></th>
                        <th><?php echo _Department;?></th>
                        <th><?php echo _JobType;?></th>
                        <th><?php echo _TotalWorkingHoursPerMonth;?></th>
                        <th><?php echo _Mobile;?></th>
                        <th><?php echo _Tools;?></th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo _ChangePassword;?></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left" id="changePass" data-parsley-validate>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password"><?php echo _Password;?> <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password" class="form-control col-md-7 col-xs-12" required="required"
                                   minlength="6" maxlength="30"
                                   data-parsley-error-message="<?php echo _Required6;?>"
                                   name="password" placeholder="password" type="password">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo _RepeatPassword;?> <span
                                    class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password2" type="password" name="password2" data-parsley-equalto="#password"
                                   class="form-control col-md-7 col-xs-12" required="required" data-parsley-error-message="<?php echo _Required;?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label  class="control-label col-md-3 col-sm-3 col-xs-12">
                          </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="submit" class="btn btn-success" id="submit"
                                   data-loading-text="<?php echo _Loading;?>..." placeholder="<?php echo _Change;?>">

                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _Close;?></button>
                        </div>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>

<?php include "../../template/footer.php" ?>
<script src="./resource/js/forms/viewEmployees.js"></script>

