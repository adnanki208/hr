<?php include  "../../template/header.php";


?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Add Attendance Shift </h3>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Put Shift information </h2>
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
                        <span class="section">Shift Info</span>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="startTime">Shift Start Time <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="startTime" class="form-control col-md-7 col-xs-12" required=""  name="startTime"  type="time">

                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="endTime">Shift End Time <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="endTime" class="form-control col-md-7 col-xs-12" required=""  name="endTime" type="time">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> loading..." id="submit" type="submit" class="btn btn-success">Add Shift</button>
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
<script src="./resource/js/forms/createAttendance.js"></script>
