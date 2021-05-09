<?php include  "../../template/header.php"?>
<div class="page-title">
    <div class="title_left">
        <h3>Vacation Viewer</h3>
    </div>

</div>

<div class="clearfix"></div>

<div class="row tile_count">
    <?php
    global $con;
    $year= date('Y');
    $statement = $con->prepare("SELECT id FROM leave_request WHERE  employeeId = ? AND type= ? AND state = ? AND YEAR(date) = ?");
    $statement->execute(array($_SESSION['user']['id'], 1 , 1,$year));
    $count = $statement->rowCount();

        $count=checkItem3InThisYear('id','leave_request','employeeId',$_SESSION['user']['id'],'type',1,'state',1);
        $count2=checkItem3InThisYear('id','leave_request','employeeId',$_SESSION['user']['id'],'type',2,'state',1);
        $count3=checkItem2InThisYear('id','leave_request','employeeId',$_SESSION['user']['id'],'state',0);
        $count4=checkItem2InThisYear('id','leave_request','employeeId',$_SESSION['user']['id'],'state',1);
        $count5=checkItem2InThisYear('id','leave_request','employeeId',$_SESSION['user']['id'],'state',2);
    ?>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Vacation </span>
        <div class="count"><?=$_SESSION['user']['vacation']?></div>
    </div>

    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Sick Vacation </span>
        <div class="count"><?=$_SESSION['user']['sake']?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Used Normal Vacation </span>
        <div class="count"><?=$count?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> used Sick Vacation </span>
        <div class="count"><?=$count2?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Pending Vacation </span>
        <div class="count"><?=$count3?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Accepted Vacation </span>
        <div class="count green"><?=$count4?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Rejected Vacation </span>
        <div class="count red"><?=$count5?></div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Put  Vacation information </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <form class="form-horizontal form-label-left" id="addVacation" data-parsley-validate>
                    <span class="section">Vacation Info</span>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vacationDate">Enter Date Of Vacation <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  id="vacationDate" class="form-control col-md-7 col-xs-12" required=""   data-parsley-error-message="<?php echo _Required;?>" name="vacationDate"   type="date">
                        </div>
                    </div>


                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vacationType">Choose Vacation Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" id="vacationType" name="vacationType"  required="" data-parsley-error-message="<?php echo _Required;?>">

                                <option value="1">Normal Vacation</option>
                                <option value="2">Sick Vacation</option>
                                <option value="3">Unjustified</option>

                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vacationDescription">Enter Description Of Vacation <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  id="vacationDescription" class="form-control col-md-7 col-xs-12" required=""   data-parsley-error-message="<?php echo _Required;?>" name="vacationDate"   type="text">
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> loading..." id="submit" type="submit" class="btn btn-success">Add Vacation</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Manage <small>Vacation </small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <p class="text-muted font-13 m-b-30">

                </p>

                <table id="pro2" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vacation Date</th>
                        <th>Vacation Accept Date</th>
                        <th>type</th>
                        <th>Status</th>
                        <th>Tools</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>


                <!-- Modal -->
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




<?php include  "../../template/footer.php"?>
<!--<script src="./resource/js/forms/viewUserService.js"></script>-->
<script src="./resource/js/forms/createUserService.js"></script>

