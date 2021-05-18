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
            <h3><?php echo _CreateEmployee;?></h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo _PutEmployeeInformation;?></h2>
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
                        <span class="section"><?php echo _EmployeeInfo;?></span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="userName"><?php echo _UserName;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="userName" class="form-control col-md-7 col-xs-12" required="required"
                                       minlength="6" maxlength="30"
                                       data-parsley-error-message="<?php echo _Required6;?>"
                                       name="firstName" placeholder="JonDan" type="text">
                            </div>
                        </div>
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
                                       class="form-control col-md-7 col-xs-12" required="required" data-parsley-error-message="<?php echo _Required6;?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstName"><?php echo _FirstName;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="firstName" class="form-control col-md-7 col-xs-12" required="required"
                                       maxlength="30" data-parsley-error-message="<?php echo _Required;?>"
                                       name="firstName" placeholder="Jon" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fatherName"><?php echo _FatherName;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="fatherName" class="form-control col-md-7 col-xs-12" maxlength="30"
                                       name="fatherName" placeholder="Doe" required="required" data-parsley-error-message="<?php echo _Required;?>" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastName"><?php echo _LastName;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="lastName" class="form-control col-md-7 col-xs-12" maxlength="30"
                                       name="lastName" placeholder="Ki" required="required" data-parsley-error-message="<?php echo _Required;?>" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matherName"><?php echo _MatherName;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="matherName" class="form-control col-md-7 col-xs-12" maxlength="30"
                                       name="matherName" placeholder="Laila" required="required" data-parsley-error-message="<?php echo _Required;?>" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch"><?php echo _Branch;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="branch" name="branch"
                                        required="" data-parsley-error-message="<?php echo _Required;?>">
                                    <?php foreach ($branch as $branch1) { ?>
                                        <option value="<?= $branch1['id'] ?>"><?= $branch1['name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shift"><?php echo _Shift;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="shift" name="shift"
                                        required="" data-parsley-error-message="<?php echo _Required;?>">
                                    <?php foreach ($shift as $shift1) { ?>
                                        <option value="<?= $shift1['id'] ?>"><?= $shift1['start'].' - '.$shift1['end'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department"><?php echo _Department;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="department" name="department"
                                        required="" data-parsley-error-message="<?php echo _Required;?>">
                                    <?php foreach ($dep as $depa) { ?>
                                        <option value="<?= $depa['id'] ?>"><?= $depa['title'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gander"><?php echo _Gander;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="gander" name="gander"
                                        required="required" data-parsley-error-message="<?php echo _Required;?>">
                                    <option value="1"><?php echo _Male;?></option>
                                    <option value="2"><?php echo _Female;?></option>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role"><?php echo _Role;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="role" name="role"
                                        required="required" data-parsley-error-message="<?php echo _Required;?>">
                                    <?php foreach ($roles as $role) { ?>
                                        <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upper"><?php echo _Upper;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="upper" name="upper"
                                        required="required" data-parsley-error-message="<?php echo _Required;?>">
                                    <?php foreach ($upper as $uppers) { ?>
                                        <option value="<?= $uppers['id'] ?>"><?= $uppers['first'].' '.$uppers['last'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jobType"><?php echo _JobType;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="jobType" name="jobType" required=""
                                        data-parsley-error-message="<?php echo _Required;?>">
                                    <?php foreach ($jobTypes as $jobType) { ?>
                                        <option value="<?= $jobType['id'] ?>"><?= $jobType['name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"><?php echo _ConfirmEmail;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="email" id="email" name="confirm_email" data-validate-linked="email"
                                       required="required" data-parsley-error-message="<?php echo _Required;?>" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile"><?php echo _Mobile;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="mobile" name="mobile" required="required" data-parsley-error-message="<?php echo _Required;?>" minlength="7"
                                       maxlength="20" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone"><?php echo _Phone;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="phone" name="phone" required="required" data-parsley-error-message="<?php echo _Required;?>" minlength="7"
                                       maxlength="20" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cophone"><?php echo _CoPhone;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="cophone" name="cophone" required="required" data-parsley-error-message="<?php echo _Required;?>" minlength="7"
                                       maxlength="20" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"><?php echo _Address;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="address" name="address" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edu"><?php echo _Education;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="edu" required="required" data-parsley-error-message="<?php echo _Required;?>"></textarea></div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exp"><?php echo _Experience;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="exp" required="required" data-parsley-error-message="<?php echo _Required;?>"></textarea></div>
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
                                <label for="document"><?php echo _Document;?> <span
                                            class="required">*</span></label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="document" type="file" required="" <?php echo _Required;?> data-parsley-error-message="<?php echo _Required;?>" data-parsley-errors-container="#documentError" class="file" accept=".pdf, .docx"   data-preview-file-type="text">
                                <div id="documentError">

                                </div>
                            </div>

                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vacations"><?php echo _Vacations;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="vacations" name="vacations" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sake"><?php echo _Sake;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="sake" name="sake" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salary"><?php echo _Salary;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="salary" name="salary" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="typeOfEdu"><?php echo _TypeOfEducation;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="typeOfEdu" name="typeOfEdu" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facelty"><?php echo _Facility;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="facelty" name="facelty" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="degree"><?php echo _Degree;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="degree" name="degree" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="totalHours"><?php echo _TotalWorkingHoursPerMonth;?><span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="totalHours" name="totalHours" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="submit" type="submit" class="btn btn-success"><?php echo _Add;?></button>
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