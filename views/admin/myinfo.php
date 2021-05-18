<?php include "../../template/header.php";

    if (!checkHash()) { ?>
        <div class="alert alert-danger">
            <strong>Error!</strong>Not Authorized.
        </div>
        <?php
        session_destroy();
        exit();


    }
    $id = $_SESSION['user']['id'];

    $stmt = $con->prepare("SELECT * ,employee.id as employeeId ,role.name as roleName , jobtype.name as jobtypename,branch.name as branchname FROM employee
INNER JOIN `role` ON employee.roleId = role.id
INNER JOIN `department` ON employee.departmintId = department.id
INNER JOIN `jobtype` ON employee.jobTypeId = jobtype.id
INNER JOIN `branch` ON employee.branchId = branch.id
INNER JOIN `shift_rule_time` ON employee.shiftId = shift_rule_time.id  WHERE employee.id =?
;");
//execute yhe statement
    $stmt->execute(array($id));
//Assign To Variable
    $count = $stmt->rowCount();
    if ($count > 0) {
        $userInfo = $stmt->fetch();
//var_dump($userInfo);
        $stmt = $con->prepare("SELECT userName,first,last FROM employee  WHERE id =?;");
//execute yhe statement
        $stmt->execute(array($userInfo['upperId']));
//Assign To Variable
        $upper = $stmt->fetch();




        $skills=[];

        $stmt = $con->prepare("SELECT * FROM employee_skile WHERE employeeId = ?");
//execute yhe statement
        $stmt->execute(array($id));

//Assign To Variable
        $skill = $stmt->fetch();
        if(isset($skill)&& !empty($skill)) {
            $skills = explode(',', $skill['skillId']);
        }


        ?>

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3><?php echo _EmployeeInfo;?></h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><?php echo _EmployeeInfo;?></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">


                            <span class="section"><?php echo _EmployeeInfo;?></span>

                            <div class="col-xs-12 text-center">
                                <div style="border-radius: 50%;margin: 20px auto;background:url('uploads/img/<?php echo $userInfo['img'] ?>');background-size: cover;background-position: center;height: 150px;width: 150px;"></div>

                            </div>
                            <div class="col-xs-12 text-center">
                                <a title="change Password" class="btn btn-danger change" data-id="<?php echo $id;?>"> <?php echo _ChangePassword;?></a></div>

                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _UserName;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['userName']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _FirstName;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['first']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _FatherName;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['father']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _LastName;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['last']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _MatherName;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['mather']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Gander;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['gander'] == '1' ? 'Male' : 'Female'; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Branch;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['branchname']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Role;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['roleName']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Department;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['title']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _JobType;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['jobtypename']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Mobile;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['mobile']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Phone;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['phone']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _CoPhone;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['cophone']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _ConfirmEmail;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['email']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Address;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['address']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _TypeOfEducation;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['typeOfEdu']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Facility;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['facelty']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Degree;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-info"><?php echo $userInfo['degree']; ?></span>
                                </div>
                            </div>
                            <hr style="width: 100%;border-top: 2px solid #E6E9ED;padding:10px 0;display: inline-block">

                            <div class="col-xs-12 col-sm-12 col-lg-6 ">
                            <span class=" col-xs-12 col-sm-3"><?php echo _Skills;?>
                            </span>
                                <div class="col-xs-12 col-sm-9">
                                    <ul>
                                       <?php  $stmt3=$con->prepare("SELECT * FROM skill  ");
                                        //execute yhe statement
                                        $stmt3->execute();
                                        //Assign To Variable
                                        $rowss=$stmt3->fetchAll();
                                        foreach ($rowss as $i) {
                                            if(in_array($i['id'],$skills)){?>
                                                <li><?php echo $i['name']?></li>
                                        <?php }} ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr style="width: 100%;border-top: 2px solid #E6E9ED;padding:10px 0;display: inline-block">
                            <div class="col-xs-12 col-sm-12 col-lg-6 ">
                            <span class=" col-xs-12 col-sm-3"><?php echo _Education;?>
                            </span>
                                <div class="col-xs-12 col-sm-9">
                                    <span class="text-info"><?php echo $userInfo['education']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-lg-6 ">
                            <span class=" col-xs-12 col-sm-3"><?php echo _Experience;?>
                            </span>
                                <div class="col-xs-12 col-sm-9">
                                    <span class="text-info"><?php echo $userInfo['experience']; ?></span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr style="width: 100%;border-top: 2px solid #E6E9ED;padding:10px 0;display: inline-block">
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Upper;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-success"><?php echo $upper['first'] . ' ' . $upper['last'] . ' (' . $upper['userName'] . ')'; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Salary;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-success"><?php echo $userInfo['salary']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Shift;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-success"><?php echo $userInfo['start'] . ' - ' . $userInfo['end']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _TotalWorkingHoursPerMonth;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-success"><?php echo $userInfo['totalHours']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Vacations;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-success"><?php echo $userInfo['vacation']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Sake;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <span class="text-success"><?php echo $userInfo['sake']; ?></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5"><?php echo _Document;?>
                            </span>
                                <div class="col-xs-12 col-sm-7">
                                    <a class="btn btn-primary"
                                       href="uploads/document/<?php echo $userInfo['document'] ?>" target="_blank"><i
                                                class="fa fa-download"></i> <?php echo _Document;?></a>
                                </div>
                            </div>


                        </div>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span
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
        <?php
    } else {
        ?>
        <div class="alert alert-danger">
            <strong>Error!</strong> User Not Found.
        </div>

    <?php }


include "../../template/footer.php" ?>

<script src="./resource/js/forms/viewEmployees.js"></script>