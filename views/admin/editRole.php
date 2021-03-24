<?php include "../../template/header.php";


if (!isset($_GET['id']) || $_GET['id']=='') { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>ID Not Found.
    </div>
    <?php

} else {
    if (!checkHash() || !in_array(3, $_SESSION['user']['access'])) { ?>
        <div class="alert alert-danger">
            <strong>Error!</strong>Not Authorized.
        </div>
        <?php
        session_destroy();
        exit();


    }
    $id = isset($_GET['id']) ? mysql_escape_mimic($_GET['id']) : null;

    $stmt = $con->prepare("SELECT * FROM role where id = ? ");
//execute The statement
    $stmt->execute(array($id));
//Assign To Variable
    $count = $stmt->rowCount();
    if ($count > 0) {
        $rows = $stmt->fetch();
        $access = explode(",", $rows['access']);


        ?>

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit Role</h3>
                </div>

            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Put your information <small>correctly</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <form class="form-horizontal form-label-left" id="editRole" data-parsley-validate>
                                <span class="section">Role Info</span>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Role Name <span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="title" class="form-control col-md-7 col-xs-12"
                                               value="<?php echo $rows['name'] ?>" required=""
                                               data-parsley-error-message="This value is required." type="text">
                                        <input type="hidden" id="roleid" class="form-control col-md-7 col-xs-12"
                                               value="<?php echo $rows['id'] ?>">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Role Code <span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?php echo $rows['code'] ?>" id="code"
                                               class="form-control col-md-7 col-xs-12" required=""
                                               data-parsley-error-message="This value is required." type="text">
                                    </div>
                                </div>


                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Permissions<span
                                                class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-check">
                                            <input <?php echo in_array("1", $access) ? "checked" : ""; ?>
                                                    class="form-check-input" type="checkbox" value="1"
                                                    id="defaultCheck1" name="role">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Department
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input <?php echo in_array("2", $access) ? "checked" : ""; ?>
                                                    class="form-check-input" type="checkbox" value="2"
                                                    id="defaultCheck2" name="role">
                                            <label class="form-check-label" for="defaultCheck2">
                                                Skills
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input <?php echo in_array("3", $access) ? "checked" : ""; ?>
                                                    class="form-check-input" type="checkbox" value="3"
                                                    id="defaultCheck3" name="role">
                                            <label class="form-check-label" for="defaultCheck3">
                                                Role
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input <?php echo in_array("4", $access) ? "checked" : ""; ?>
                                                    class="form-check-input" type="checkbox" value="4"
                                                    id="defaultCheck4" name="role">
                                            <label class="form-check-label" for="defaultCheck4">
                                                Attendance
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input <?php echo in_array("5", $access) ? "checked" : ""; ?>
                                                    class="form-check-input" type="checkbox" value="5"
                                                    id="defaultCheck5" name="role">
                                            <label class="form-check-label" for="defaultCheck5">
                                                Alerts
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input <?php echo in_array("6", $access) ? "checked" : ""; ?>
                                                    class="form-check-input" type="checkbox" value="6"
                                                    id="defaultCheck6" name="role">
                                            <label class="form-check-label" for="defaultCheck6">
                                                Self Service
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input <?php echo in_array("7", $access) ? "checked" : ""; ?>
                                                    class="form-check-input" type="checkbox" value="7"
                                                    id="defaultCheck7" name="role">
                                            <label class="form-check-label" for="defaultCheck7">
                                                Employee
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input <?php echo in_array("8", $access) ? "checked" : ""; ?>
                                                    class="form-check-input" type="checkbox" value="8"
                                                    id="defaultCheck8" name="role">
                                            <label class="form-check-label" for="defaultCheck8">
                                                Job Type
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input <?php echo in_array("9", $access) ? "checked" : ""; ?>
                                                    class="form-check-input" type="checkbox" value="9"
                                                    id="defaultCheck9" name="role">
                                            <label class="form-check-label" for="defaultCheck9">
                                               Salary
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button id="submit" type="submit"
                                                class="btn btn-success"
                                                data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> loading...">
                                            Edit Role
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-danger">
            <strong>Error!</strong>  Not Found.
        </div>

    <?php }
}
include "../../template/footer.php" ?>
<!--own page Script-->
<script src="./../resource/js/forms/updateRole.js"></script>

