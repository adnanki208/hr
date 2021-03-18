<?php include  "../../template/header.php";
include  "../../request/init.php";
if(isset($_GET['id'])){

    $id = $_GET['id'];
    $stmt=$con->prepare("SELECT * FROM skill_group where id = ? ");
//execute yhe statement
    $stmt->execute(array($id));
//Assign To Variable
    $rows=$stmt->fetch();
}
else {
$id=0;
$rows['name']="there Is No Skill Like This Name ";
}



?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Edit Skill Group</h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Skill Group information </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" id="editSkill" data-parsley-validate>
                        <span class="section">Skill Group Info</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="skillName">Skill Name Group <span class="required">*</span>
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

                    <div class="notification_body">
                        <div class="notification">
                            <div class="msg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include  "../../template/footer.php"?>
<script src="./../resource/js/forms/updateSkill.js"></script>
