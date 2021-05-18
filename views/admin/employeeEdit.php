<?php include "../../template/header.php";

if (!isset($_GET['id']) || $_GET['id']=='') { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>ID Not Found.
    </div>
    <?php

}else{
if (!checkHash() || !in_array(7, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}
$id = isset($_GET['id']) ? mysql_escape_mimic($_GET['id']) : null;

$stmt = $con->prepare("SELECT * FROM employee where id=?");
//execute yhe statement
$stmt->execute(array($id));
//Assign To Variable
$count=$stmt->rowCount();
if($count>0) {
    $user = $stmt->fetch();
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
    $jobTypes = $stmt->fetchAll();

    $stmt = $con->prepare("SELECT * FROM shift_rule_time ");
//execute yhe statement
    $stmt->execute();
//Assign To Variable
    $shift = $stmt->fetchAll();
//Assign To Variable
    $stmt = $con->prepare("SELECT * FROM branch ");
//execute yhe statement
    $stmt->execute();
//Assign To Variable
    $branch = $stmt->fetchAll();
//Assign To Variable

    $stmt = $con->prepare("SELECT * FROM employee WHERE state = 1");
//execute yhe statement
    $stmt->execute();
//Assign To Variable
    $upper = $stmt->fetchAll();

?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo _EditEmployee;?></h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo _EditEmployeeInformation;?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" id="editEmployee" data-parsley-validate>
                        <span class="section"><?php echo _EmployeeInfo;?></span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="userName"><?php echo _UserName;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="userName" class="form-control col-md-7 col-xs-12" required="required"
                                       minlength="6" maxlength="30"
                                       data-parsley-error-message="<?php echo _Required6;?>"
                                       name="firstName" placeholder="JonDan" type="text" value="<?php echo $user['userName']?>">
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
                                       class="form-control col-md-7 col-xs-12" required="required" data-parsley-error-message="<?php echo _Required;?>" >
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstName"><?php echo _FirstName;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="firstName" class="form-control col-md-7 col-xs-12" required="required"
                                       maxlength="30" data-parsley-error-message="<?php echo _Required;?>"
                                       name="firstName" placeholder="Jon" type="text" value="<?php echo $user['first']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fatherName"><?php echo _FatherName;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="fatherName" class="form-control col-md-7 col-xs-12" maxlength="30" data-parsley-error-message="<?php echo _Required;?>"
                                       name="fatherName" placeholder="Doe" required="required" type="text" value="<?php echo $user['father']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastName"><?php echo _LastName;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="lastName" class="form-control col-md-7 col-xs-12" maxlength="30" data-parsley-error-message="<?php echo _Required;?>"
                                       name="lastName" placeholder="Ki" required="required" type="text" value="<?php echo $user['last']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matherName"><?php echo _MatherName;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="matherName" class="form-control col-md-7 col-xs-12" maxlength="30" data-parsley-error-message="<?php echo _Required;?>"
                                       name="matherName" placeholder="Laila" required="required" type="text" value="<?php echo $user['mather']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch"><?php echo _Branch;?> <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select  class="form-control col-md-7 col-xs-12" id="branch" name="branch"
                                        required="" data-parsley-error-message="<?php echo _Required;?>">
                                    <?php foreach ($branch as $branch1) { ?>
                                        <option value="<?= $branch1['id'] ?>" <?php echo $user['branchId']==$branch1['id']?'selected':'';  ?>><?= $branch1['name']; ?></option>
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
                                        <option value="<?= $shift1['id'] ?>" <?php echo $user['shiftId']==$shift1['id']?'selected':'';  ?>><?= $shift1['start'].' - '.$shift1['end'] ?></option>
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
                                        <option value="<?= $depa['id'] ?>" <?php echo $user['departmintId']==$depa['id']?'selected':'';  ?>  ><?= $depa['title'] ?></option>
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
                                    <option value="1" <?php echo $user['gander']=='1'?'selected':'';  ?>><?php echo _Male;?></option>
                                    <option value="2" <?php echo $user['gander']=='2'?'selected':'';  ?>><?php echo _Female;?></option>
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
                                        <option value="<?= $role['id'] ?>"  <?php echo $user['roleId']==$role['id']?'selected':'';  ?> ><?= $role['name'] ?></option>
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
                                        <option value="<?= $uppers['id'] ?> <?php echo $user['upperId']==$uppers['id']?'selected':'';  ?>"><?= $uppers['first'].' '.$uppers['last'].' ('.$uppers['userName'].')' ?></option>
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
                                        <option value="<?= $jobType['id'] ?>" <?php echo $user['jobTypeId']==$jobType['id']?'selected':'';  ?>><?= $jobType['name'] ?></option>
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
                                       required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $user['email']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile"><?php echo _Mobile;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="mobile" name="mobile" required="required" minlength="7"
                                       maxlength="20" class="form-control col-md-7 col-xs-12" value="<?php echo $user['mobile']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone"><?php echo _Phone;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="phone" name="phone" required="required" minlength="7"
                                       maxlength="20" class="form-control col-md-7 col-xs-12" value="<?php echo $user['phone']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cophone"><?php echo _CoPhone;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="cophone" name="cophone" required="required" minlength="7"
                                       maxlength="20" class="form-control col-md-7 col-xs-12" value="<?php echo $user['cophone']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"><?php echo _Address;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="address" name="address" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['address']?>">
                            </div>
                        </div>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edu"><?php echo _Education;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="edu" required="required" data-parsley-error-message="<?php echo _Required;?>"><?php echo $user['education']?></textarea></div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exp"><?php echo _Experience;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="exp" required="required" data-parsley-error-message="<?php echo _Required;?>"><?php echo $user['experience']?></textarea></div>
                        </div>
                        <?php if(isset($user['img']) && $user['img']!=''){?>
                        <div class="item form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                <label for="userImg"><?php echo _OldImage;?></label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <img src="../uploads/img/<?php echo $user['img']?>" style="max-width: 300px">
                            </div>
                        </div>
                        <?php } ?>
                        <div class="item form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                <label for="userImg"><?php echo _Image;?></label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="userImg" type="file"  class="file" data-preview-file-type="any" accept=".png, .jpeg, .jpg">
                            </div>
                        </div>
                        <div class="item form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                <label for="userImg"><?php echo _OldDocument;?></label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a href="../uploads/document/<?php echo $user['document']?>" target="_blank" class="btn btn-primary" ><i class="fa fa-download"> Download Document</i></a>
                            </div>
                        </div>
                        <div class="item form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                <label for="document"><?php echo _Document;?><span
                                        class="required">*</span></label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="document" type="file" class="file" accept=".pdf, .docx"   data-preview-file-type="text">
                                <div id="documentError">

                                </div>
                            </div>

                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vacations"><?php echo _Vacations;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="vacations" name="vacations" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['vacation']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sake"><?php echo _Sake;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="sake" name="sake" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['sake']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salary"><?php echo _Salary;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="salary" name="salary" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['salary']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="typeOfEdu"><?php echo _TypeOfEducation;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="typeOfEdu" name="typeOfEdu" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['typeOfEdu']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facelty"><?php echo _Facility;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="facelty" name="facelty" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['facelty']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="degree"><?php echo _Degree;?> <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="degree" name="degree" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['degree']?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="totalHours"><?php echo _TotalWorkingHoursPerMonth;?><span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="totalHours" name="totalHours" required="required" data-parsley-error-message="<?php echo _Required;?>"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['totalHours']?>">
                            </div>
                        </div>
                        <input type="hidden" id="id" value="<?php echo $_GET['id'];?>">
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

<?php
}else{
   ?>
    <div class="alert alert-danger">
        <strong>Error!</strong> User Not Found.
    </div>

<?php } }

include "../../template/footer.php" ?>

<script src="./../resource/js/forms/editEmployee.js"></script>