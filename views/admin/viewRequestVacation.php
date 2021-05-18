<?php include  "../../template/header.php";
if (!checkHash() || !in_array(6, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}?>
<div class="page-title">
    <div class="title_left">
        <h3><?php echo _VacationViewer;?></h3>
    </div>

</div>

<div class="clearfix"></div>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo _Manage;?> <small><?php echo _PendingVacation;?> </small></h2>
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

                <table id="pro" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo _EmployeeName;?></th>
                        <th><?php echo _VacationDate;?></th>
                        <th><?php echo _Type;?></th>
                        <th><?php echo _Tools;?></th>
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _Close;?></button>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo _Manage;?> <small><?php echo _Vacations;?> </small></h2>
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
                        <th><?php echo _EmployeeName;?></th>
                        <th><?php echo _VacationDate;?></th>
                        <th><?php echo _VacationAcceptDate;?></th>
                        <th><?php echo _Type;?></th>
                        <th><?php echo _State;?></th>
                        <th><?php echo _Tools;?></th>
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _Close;?></button>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




<?php include  "../../template/footer.php"?>
<script src="./resource/js/forms/viewRequestVacation.js"></script>

