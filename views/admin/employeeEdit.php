<?php include "../../template/header.php";
$id=isset($_GET['id'])?mysql_escape_mimic($_GET['id']):null;
if (!checkHash()) {?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
<?php
exit();
}

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
//Assign To Variable
    $jobTypes = $stmt->fetchAll();
    $stmt = $con->prepare("SELECT * FROM employee WHERE state = 1");
//execute yhe statement
    $stmt->execute();
//Assign To Variable
    $upper = $stmt->fetchAll();


?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Edit Employee</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit employee information</h2>
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
                        <span class="section">Employee Info</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="userName">User Name <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="userName" class="form-control col-md-7 col-xs-12" required="required"
                                       minlength="6" maxlength="30"
                                       data-parsley-error-message="This value is required and min more than 6 Letters."
                                       name="firstName" placeholder="JonDan" type="text" value="<?php echo $user['userName']?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstName">First Name <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="firstName" class="form-control col-md-7 col-xs-12" required="required"
                                       maxlength="30" data-parsley-error-message="This value is required."
                                       name="firstName" placeholder="Jon" type="text" value="<?php echo $user['first']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fatherName">Father Name <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="fatherName" class="form-control col-md-7 col-xs-12" maxlength="30"
                                       name="fatherName" placeholder="Doe" required="required" type="text" value="<?php echo $user['father']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastName">Last Name <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="lastName" class="form-control col-md-7 col-xs-12" maxlength="30"
                                       name="lastName" placeholder="Ki" required="required" type="text" value="<?php echo $user['last']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matherName">Mather Name <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="matherName" class="form-control col-md-7 col-xs-12" maxlength="30"
                                       name="matherName" placeholder="Laila" required="required" type="text" value="<?php echo $user['mather']?>">
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
                                        <option value="<?= $depa['id'] ?>" <?php echo $user['departmintId']==$depa['id']?'selected':'';  ?>  ><?= $depa['title'] ?></option>
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
                                    <option value="1" <?php echo $user['gander']=='1'?'selected':'';  ?>>Male</option>
                                    <option value="2" <?php echo $user['gander']=='2'?'selected':'';  ?>>Female</option>
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
                                        <option value="<?= $role['id'] ?>"  <?php echo $user['roleId']==$role['id']?'selected':'';  ?> ><?= $role['name'] ?></option>
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
                                        <option value="<?= $uppers['id'] ?> <?php echo $user['upperId']==$uppers['id']?'selected':'';  ?>"><?= $uppers['first'].' '.$uppers['last'].' ('.$uppers['userName'].')' ?></option>
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
                                        <option value="<?= $jobType['id'] ?>" <?php echo $user['jobTypeId']==$jobType['id']?'selected':'';  ?>><?= $jobType['name'] ?></option>
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
                                       required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $user['email']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile">Mobile <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="mobile" name="mobile" required="required" minlength="7"
                                       maxlength="20" class="form-control col-md-7 col-xs-12" value="<?php echo $user['mobile']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="phone" name="phone" required="required" minlength="7"
                                       maxlength="20" class="form-control col-md-7 col-xs-12" value="<?php echo $user['phone']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cophone">co phone <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="cophone" name="cophone" required="required" minlength="7"
                                       maxlength="20" class="form-control col-md-7 col-xs-12" value="<?php echo $user['cophone']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="address" name="address" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['address']?>">
                            </div>
                        </div>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edu">Education <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="edu" required="required" ><?php echo $user['education']?></textarea></div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exp">Experience <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="exp" required="required"><?php echo $user['experience']?></textarea></div>
                        </div>
                        <?php if(isset($user['img']) && $user['img']!=''){?>
                        <div class="item form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                <label for="userImg">Old Image</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <img src="../uploads/img/<?php echo $user['img']?>" style="max-width: 300px">
                            </div>
                        </div>
                        <?php } ?>
                        <div class="item form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                <label for="userImg">New Image</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="userImg" type="file"  class="file" data-preview-file-type="any" accept=".png, .jpeg, .jpg">
                            </div>
                        </div>
                        <div class="item form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                <label for="document">New Document<span
                                        class="required">*</span></label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="document" type="file" class="file" accept=".pdf, .docx"   data-preview-file-type="text">
                                <div id="documentError">

                                </div>
                            </div>

                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="holidays">Holidays <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="holidays" name="holidays" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['holyday']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sake">Sake <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="sake" name="sake" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['sike']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salary">Salary <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="salary" name="salary" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['salary']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="typeOfEdu">Type Of Education <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="typeOfEdu" name="typeOfEdu" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['typeOfEdu']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facelty">Facility <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="facelty" name="facelty" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['facelty']?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="degree">Degree <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="degree" name="degree" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['degree']?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="totalHours">Total Working Hours Per Month<span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="totalHours" name="totalHours" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo $user['totalHours']?>">
                            </div>
                        </div>
                        <input type="hidden" id="id" value="<?php echo $_GET['id'];?>">
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

<?php
}else{
   ?>
    <div class="alert alert-danger">
        <strong>Error!</strong> User Not Found.
    </div>

<?php }

include "../../template/footer.php" ?>

<script src="./../resource/js/forms/editEmployee.js"></script>