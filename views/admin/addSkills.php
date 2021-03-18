<?php include  "../../template/header.php";
include_once '../../src/common/connection.php';
    $stmt=$con->prepare("SELECT * FROM skill_group");
    //execute yhe statement
    $stmt->execute(array());
    //Assign To Variable
    $rows=$stmt->fetchAll();

?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Add Skill</h3>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Put  Skill information </h2>
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
                        <span class="section">Skill Info</span>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="skillGroup">Choose Skill Group Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="groupid" name="skillGroup"  required="" data-parsley-error-message="This value is required.">
                                    <?php foreach ($rows as $row) { ?>
                                        <option value="<?php echo $row['id']?>"><?php echo  $row['name']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="skillName">Add Skill Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="skillName" class="form-control col-md-7 col-xs-12" required=""   name="firstName" placeholder="Example CSS"  type="text">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> loading..." id="submit" type="submit" class="btn btn-success">Add Skill</button>
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
<script src="./resource/js/forms/addSkills.js"></script>

