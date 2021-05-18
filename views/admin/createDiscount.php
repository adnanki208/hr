<?php include  "../../template/header.php";

if (!checkHash() || !in_array(4, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}
?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo _AddDiscountRole;?> </h3>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo _PutDiscountInformation;?> </h2>
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
                        <span class="section"><?php echo _DiscountInfo;?></span>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="min"><?php echo _DelayOrEarlyMin;?> <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="min"  class="form-control col-md-7 col-xs-12" required="" data-parsley-error-message="<?php echo _Required;?>" name="min"  type="number">

                            </div>
                        </div>




                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount"><?php echo _DelayDiscount;?> % <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="discount" class="form-control col-md-7 col-xs-12" required="" data-parsley-error-message="<?php echo _Required;?>"  name="endTime" type="number" data-parsley-range="[1, 100]">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button   data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?php echo _Loading;?>..." id="submit" type="submit" class="btn btn-success"><?php echo _Add;?></button>
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
<script src="./resource/js/forms/createDiscount.js"></script>

