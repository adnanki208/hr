<?php include "../../template/header.php";
if (!checkHash() || !in_array(7, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}
$stmt = $con->prepare("SELECT * FROM role ");
//execute yhe statement
$stmt->execute();
//Assign To Variable
$roles = $stmt->fetchAll();
$stmt = $con->prepare("SELECT * FROM department");
//execute yhe statement
$stmt->execute();
//Assign To Variable
$dep = $stmt->fetchAll();
$stmt = $con->prepare("SELECT * FROM jobtype");
//execute yhe statement
$stmt->execute();
//Assign To Variable
$jobTypes = $stmt->fetchAll();

$stmt = $con->prepare("SELECT * FROM shift_rule_time ");
//execute yhe statement
$stmt->execute();
//Assign To Variable
$shift = $stmt->fetchAll();

$stmt = $con->prepare("SELECT * FROM branch ");
//execute yhe statement
$stmt->execute();
//Assign To Variable
$branch = $stmt->fetchAll();

$stmt = $con->prepare("SELECT * FROM employee WHERE state = 1");
//execute yhe statement
$stmt->execute();
//Assign To Variable
$upper = $stmt->fetchAll();
?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Create Employee</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Put employee information</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" id="addEmployee" data-parsley-validate>
                        <span class="section">Employee Info</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="userName">User Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="userName" class="form-control col-md-7 col-xs-12" required="required"
                                       minlength="6" maxlength="30"
                                       data-parsley-error-message="This value is required and min more than 6 Letters."
                                       name="firstName" placeholder="JonDan" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password" class="form-control col-md-7 col-xs-12" required="required"
                                       minlength="6" maxlength="30"
                                       data-parsley-error-message="This value most be more than 6 and less than 30 Letters."
                                       name="password" placeholder="password" type="password">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat
                                Password <span
                                        class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password2" type="password" name="password2" data-parsley-equalto="#password"
                                       class="form-control col-md-7 col-xs-12" required="required">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstName">First Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="firstName" class="form-control col-md-7 col-xs-12" required="required"
                                       maxlength="30" data-parsley-error-message="This value is required."
                                       name="firstName" placeholder="Jon" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fatherName">Father Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="fatherName" class="form-control col-md-7 col-xs-12" maxlength="30"
                                       name="fatherName" placeholder="Doe" required="required" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastName">Last Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="lastName" class="form-control col-md-7 col-xs-12" maxlength="30"
                                       name="lastName" placeholder="Ki" required="required" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matherName">Mather Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="matherName" class="form-control col-md-7 col-xs-12" maxlength="30"
                                       name="matherName" placeholder="Laila" required="required" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch">Branch <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="branch" name="branch"
                                        required="" data-parsley-error-message="This value is required.">
                                    <?php foreach ($branch as $branch1) { ?>
                                        <option value="<?= $branch1['id'] ?>"><?= $branch1['name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shift">Shift <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="shift" name="shift"
                                        required="" data-parsley-error-message="This value is required.">
                                    <?php foreach ($shift as $shift1) { ?>
                                        <option value="<?= $shift1['id'] ?>"><?= $shift1['start'].' - '.$shift1['end'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department">Department <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="department" name="department"
                                        required="" data-parsley-error-message="This value is required.">
                                    <?php foreach ($dep as $depa) { ?>
                                        <option value="<?= $depa['id'] ?>"><?= $depa['title'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gander">Gander <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="gander" name="gander"
                                        required="required" data-parsley-error-message="This value is required.">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role">Role <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="role" name="role"
                                        required="required" data-parsley-error-message="This value is required.">
                                    <?php foreach ($roles as $role) { ?>
                                        <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upper">Upper <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="upper" name="upper"
                                        required="required" data-parsley-error-message="This value is required.">
                                    <?php foreach ($upper as $uppers) { ?>
                                        <option value="<?= $uppers['id'] ?>"><?= $uppers['first'].' '.$uppers['last'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jobType">Job Type <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="jobType" name="jobType" required=""
                                        data-parsley-error-message="This value is required.">
                                    <?php foreach ($jobTypes as $jobType) { ?>
                                        <option value="<?= $jobType['id'] ?>"><?= $jobType['name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Confirm Email <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="email" id="email" name="confirm_email" data-validate-linked="email"
                                       required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile">Mobile <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="mobile" name="mobile" required="required" minlength="7"
                                       maxlength="20" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="phone" name="phone" required="required" minlength="7"
                                       maxlength="20" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cophone">co phone <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="cophone" name="cophone" required="required" minlength="7"
                                       maxlength="20" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="address" name="address" required="required"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edu">Education <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="edu" required="required"></textarea></div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exp">Experience <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="exp" required="required"></textarea></div>
                        </div>
                        <div class="item form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                <label for="userImg">Image</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="userImg" type="file" class="file" data-preview-file-type="text" accept=".png, .jpeg, .jpg">
                            </div>
                        </div>
                        <div class="item form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                <label for="document">Document <span
                                            class="required">*</span></label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="document" type="file" required="" data-parsley-errors-container="#documentError" class="file" accept=".pdf, .docx"   data-preview-file-type="text">
                                <div id="documentError">

                                </div>
                            </div>

                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vacations">Vacations <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="vacations" name="vacations" required="required"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sake">Sake <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="sake" name="sake" required="required"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salary">Salary <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="salary" name="salary" required="required"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="typeOfEdu">Type Of Education <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="typeOfEdu" name="typeOfEdu" required="required"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facelty">Facility <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="facelty" name="facelty" required="required"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="degree">Degree <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="degree" name="degree" required="required"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="totalHours">Total Working Hours Per Month<span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="totalHours" name="totalHours" required="required"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="submit" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../../template/footer.php" ?>

<script src="./resource/js/forms/createEmployee.js"></script>