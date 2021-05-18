<?php include  "../../template/header.php";
if (!checkHash() || !in_array(13, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}?>
<div class="page-title">
    <div class="title_left">
        <h3><?php echo _TaskViewer;?></h3>
    </div>

</div>

<div class="clearfix"></div>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo _Manage;?> <small><?php echo _Tasks;?> </small></h2>
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
                        <th><?php echo _EmployeeAssignedTo;?></th>
                        <th><?php echo _Creator;?></th>
                        <th><?php echo _Checker;?></th>
                        <th><?php echo _Task;?></th>
                        <th><?php echo _State;?></th>
                        <th><?php echo _CreatDate;?></th>
                        <th><?php echo _EndDate;?></th>
                        <th><?php echo _Tools;?></th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>




<?php include  "../../template/footer.php"?>
<script src="./resource/js/forms/viewTask.js"></script>

