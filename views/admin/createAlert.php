<?php include  "../../template/header.php";
if (!checkHash() || !in_array(5, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}
$stmt=$con->prepare("SELECT id,userName FROM employee");
//execute yhe statement
$stmt->execute(array());

//Assign To Variable
$rows=$stmt->fetchAll();

?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Create Alert</h3>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Put  Alert information </h2>
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
                        <span class="section">Alert Info</span>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alertTo">Assign Alert To  <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="alertTo" name="alertTo"  required="" data-parsley-error-message="This value is required.">
                                    <?php foreach ($rows as $row) { ?>
                                        <option value="<?php echo $row['id']?>" <?php echo isset($_GET['id'])&&$_GET['id']==$row['id']?'selected':'';?>><?php echo  $row['userName']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Alert title  <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="title" class="form-control col-md-7 col-xs-12" required=""   data-parsley-error-message="This value is required."    type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alertBody">Body Of Alert <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea required="" id="alertBody"></textarea></div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Discount %
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="discount" class="form-control col-md-7 col-xs-12"   name="endTime" type="number" data-parsley-range="[1, 100]">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> loading..." id="submit" type="submit" class="btn btn-success">Add Alert</button>
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
<script src="./../resource/js/forms/createAlert.js"></script>

