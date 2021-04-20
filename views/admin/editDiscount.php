<?php include "../../template/header.php";
if (!isset($_GET['id']) || $_GET['id']=='') { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>ID Not Found.
    </div>
    <?php

}else{
if (!checkHash() || !in_array(4, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}
$id = isset($_GET['id']) ? mysql_escape_mimic($_GET['id']) : null;

$stmt = $con->prepare("SELECT * FROM shift_rule_discount where id = ? ");
//execute yhe statement
$stmt->execute(array($id));
//Assign To Variable
$count = $stmt->rowCount();
if ($count > 0) {
$rows = $stmt->fetch();
    $selectedTime = new DateTime($rows['value']);
    $min = $selectedTime ->format('i');
    $hour = $selectedTime ->format('H');
$rows['value']=intval($hour)*60+intval($min);
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Edit Discount</h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Put Discount information </h2>
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
                        <span class="section">Edit Discount Info</span>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="min">Delay or early min
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="min" value="<?php echo $rows['value'] ?>"
                                       class="form-control col-md-7 col-xs-12" required="" name="min" type="number">
                                <input id="id" value="<?php echo $rows['id'] ?>" type="hidden">

                            </div>
                        </div>



                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Delay Discount %
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="<?php echo $rows['percentage'] ?>" id="discount"
                                       class="form-control col-md-7 col-xs-12" required="" name="endTime" type="number"
                                       data-parsley-range="[1, 100]">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="submit" type="submit" class="btn btn-success"
                                        data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> loading...">Edit
                                    Discount
                                </button>
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
    <?php
} else {
    ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>  Not Found.
    </div>

<?php }} include "../../template/footer.php" ?>
<script src="./../resource/js/forms/updateDiscount.js"></script>
