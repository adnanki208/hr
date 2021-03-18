<?php include  "../../template/header.php"?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Create Role</h3>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Put your information <small>correctly</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" id="addDepartment" data-parsley-validate>
                        <span class="section">Role Info</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Role Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="title" class="form-control col-md-7 col-xs-12" required=""   data-parsley-error-message="This value is required."    type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Role Code <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="code" class="form-control col-md-7 col-xs-12" required=""   data-parsley-error-message="This value is required."    type="text">
                            </div>
                        </div>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Permissions<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <input id="check1" class="" type="checkbox" name="favorite_pet" value="Cats">
                                <lable for="check1">Cat</lable>
                                <input class="" type="checkbox" name="favorite_pet" value="Cats">Cats
                                <input class="" type="checkbox" name="favorite_pet" value="Cats">Cats

                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="submit" type="submit" class="btn btn-success" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> loading..." >Add Role</button>
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
<script src="./resource/js/forms/createDepartment.js"></script>
