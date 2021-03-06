<?php include  "../../template/header.php";
if (!checkHash() || !in_array(5, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}
$skills=[];
$stmt=$con->prepare("SELECT * FROM skill_group ");
//execute yhe statement
$stmt->execute();
//Assign To Variable
$rows=$stmt->fetchAll();


$stmt2=$con->prepare("SELECT * FROM employee");
//execute yhe statement
$stmt2->execute();

//Assign To Variable
$rows2=$stmt2->fetchAll();


if(isset($_GET['id'])&& $_GET['id']!='') {
    $id=mysql_escape_mimic($_GET['id']);
}else{
    $id=$rows2[0]['id'];
}

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
            <h3><?php echo _AssignSkill;?></h3>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo _AssignSkill;?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" id="addSkill" data-parsley-validate>
                        <span class="section"><?php echo _SkillInfo;?></span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alertTo"><?php echo _AssignSkillsToEmployees;?>  <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="employeeName" name="employeeName"  required="" data-parsley-error-message="<?php echo _Required;?>">
                                    <?php foreach ($rows2 as $row) { ?>
                                        <option value="<?php echo $row['id']?>" <?php echo isset($_GET['id'])&&$_GET['id']==$row['id']?'selected':'';?>><?php echo  $row['userName']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alertTo"><?php echo _ChooseSkills;?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select multiple="multiple" class="form-control col-md-7 col-xs-12" id="skillName" name="skillName[]"  required="" data-parsley-error-message="<?php echo _Required;?>">
                                    <?php foreach ($rows as $row) { ?>
                                        <option disabled value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                                        <?php
                                        $stmt3=$con->prepare("SELECT * FROM skill where groupId = ?  ");
                                        //execute yhe statement
                                        $stmt3->execute(array($row['id']));
                                        //Assign To Variable
                                        $rowss=$stmt3->fetchAll();
                                        foreach ($rowss as $i) {?>
                                            <option value="<?php echo $i['id']?>" <?php echo in_array($i['id'],$skills)==true?'selected':''; ?> ><?php echo $i['name']?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?php echo _Loading;?>..." id="submit" type="submit" class="btn btn-success"><?php echo _Add;?></button>
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
<script src="./../resource/js/forms/employeeSkill.js"></script>

