<?php include  "../../template/header.php";

if (!isset($_GET['id']) || $_GET['id']=='') { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>ID Not Found.
    </div>
    <?php

}else{
if (!checkHash() || !in_array(2, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}
$id = isset($_GET['id']) ? mysql_escape_mimic($_GET['id']) : null;
    $stmt=$con->prepare("SELECT * FROM skill where id = ? ");
//execute yhe statement
    $stmt->execute(array($id));
//Assign To Variable
    $count = $stmt->rowCount();
    if ($count > 0) {
    $rows=$stmt->fetch();



$stmt=$con->prepare("SELECT * FROM skill_group");
//execute yhe statement
$stmt->execute(array());
//Assign To Variable

$rows2=$stmt->fetchAll();



?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Edit Skill</h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Skill information </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" id="edit" data-parsley-validate>
                        <span class="section">Skill Info</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="skillGroup">Choose Skill Group Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="groupid" name="skillGroup"  required="" data-parsley-error-message="This value is required.">
                                    <option value="">....</option>
                                    <?php foreach ($rows2 as $row2) { ?>
                                        <option value="<?php echo $row2['id'];?>" <?php if($row2['id'] == $rows['groupId']){echo "selected";};?>><?php echo $row2['name']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="skillName">Skill Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="skillName" value="<?php echo $rows['name']?>" class="form-control col-md-7 col-xs-12" required=""   data-parsley-error-message="This value is required." name="firstName" placeholder="Example IT .."  type="text">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="hidden" id="idSkill" value="<?php echo $rows['id']?>" class="form-control col-md-7 col-xs-12" name="idSkill">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="submit" type="submit" class="btn btn-success">Edit Skill</button>
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

<?php }} include  "../../template/footer.php"?>
<script src="./../resource/js/forms/updSkills.js"></script>
