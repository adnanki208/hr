<?php include "../../template/header.php";
$id=isset($_GET['id'])?mysql_escape_mimic($_GET['id']):null;
if (!checkHash()) {?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
<?php
exit();
}

$stmt=$con->prepare("SELECT * ,employee.id as employeeId ,role.name as roleName , jobtype.name as jobtypename FROM employee
INNER JOIN `role` ON employee.roleId = role.id
INNER JOIN `department` ON employee.departmintId = department.id
INNER JOIN `jobtype` ON employee.jobTypeId = jobtype.id
INNER JOIN `shift_rule_time` ON employee.shiftId = shift_rule_time.id  WHERE employee.id =?;");
//execute yhe statement
$stmt->execute(array($id));
//Assign To Variable
$count=$stmt->rowCount();
if($count>0) {
$userInfo=$stmt->fetch();
//var_dump($userInfo);
    $stmt=$con->prepare("SELECT userName,first,last FROM employee  WHERE id =?;");
//execute yhe statement
    $stmt->execute(array($userInfo['upperId']));
//Assign To Variable
    $upper=$stmt->fetch();
?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Employee Information</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>employee information</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">


                        <span class="section">Employee Info</span>

                        <div class="col-xs-12 text-center" >
                            <div style="border-radius: 50%;margin: 20px auto;background:url('../uploads/img/<?php echo $userInfo['img']?>');background-size: cover;background-position: center;height: 150px;width: 150px;"></div>

                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >User Name
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['userName'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >First Name
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['first'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Father Name
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['father'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Last Name
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['last'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Mather Name
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['mather'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Gander
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['gander']=='1'?'Male':'Female';?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Role
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['roleName'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Department
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['title'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Job Type
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['jobtypename'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Mobile
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['mobile'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Phone
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['phone'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Co Phone
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['cophone'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Email
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['email'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Address
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['address'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Type Of Education
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['typeOfEdu'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Faculty
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['facelty'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Degree
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-info"><?php echo $userInfo['degree'];?></span>
                            </div>
                        </div>
                    <hr style="width: 100%;border-top: 2px solid #E6E9ED;padding:10px 0;display: inline-block" >
                        <div class="col-xs-12 col-sm-12 col-lg-6 ">
                            <span class=" col-xs-12 col-sm-3" >Education
                            </span>
                            <div class="col-xs-12 col-sm-9">
                                <span class="text-info"><?php echo $userInfo['education'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-6 ">
                            <span class=" col-xs-12 col-sm-3" >Experience
                            </span>
                            <div class="col-xs-12 col-sm-9">
                                <span class="text-info"><?php echo $userInfo['experience'];?></span>
                            </div>
                        </div>
                    <div class="clearfix"></div>
                    <hr style="width: 100%;border-top: 2px solid #E6E9ED;padding:10px 0;display: inline-block" >
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Upper
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-success"><?php echo $upper['first'].' '.$upper['last'].' ('.$upper['userName'].')';?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Salary
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-success"><?php echo $userInfo['salary'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Shift
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-success"><?php echo $userInfo['start'].' - '.$userInfo['end'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >totalHours
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-success"><?php echo $userInfo['totalHours'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Holiday
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-success"><?php echo $userInfo['holyday'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Sake
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <span class="text-success"><?php echo $userInfo['sike'];?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 mt-5">
                            <span class=" col-xs-12 col-sm-5" >Document
                            </span>
                            <div class="col-xs-12 col-sm-7">
                                <a class="btn btn-primary" href="../uploads/document/<?php echo $userInfo['document']?>" target="_blank"><i class="fa fa-download"></i>  Doucoment</a>
                            </div>
                        </div>


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