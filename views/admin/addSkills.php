<?php include  "../../template/header.php";
if (!checkHash() || !in_array(2, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}
    $stmt=$con->prepare("SELECT * FROM skill_group");
    //execute yhe statement
    $stmt->execute(array());
    //Assign To Variable
$count = $stmt->rowCount();
if ($count > 0) {
    $rows=$stmt->fetchAll();

?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo _AddSkill;?></h3>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo _PutSkillInformation;?></h2>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="skillGroup"><?php echo _ChooseSkillGroupName;?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="groupid" name="skillGroup"  required="" data-parsley-error-message="<?php echo _Required;?>">
                                    <?php foreach ($rows as $row) { ?>
                                        <option value="<?php echo $row['id']?>"><?php echo  $row['name']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="skillName"><?php echo _AddSkillName;?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="skillName" class="form-control col-md-7 col-xs-12" required=""  data-parsley-error-message="<?php echo _Required;?>"  name="firstName" placeholder="Example CSS"  type="text">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?php echo _Loading;?>..." id="submit" type="submit" class="btn btn-success"><?php echo _AddSkill;?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } else {
    ?>
    <div class="alert alert-danger">
        <strong>Error!</strong> There is no skill group found please Insert Skill Group.
    </div>

<?php }
 include  "../../template/footer.php"?>
<!--own page Script-->
<script src="./resource/js/forms/addSkills.js"></script>

