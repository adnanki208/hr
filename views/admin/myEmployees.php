<?php include  "../../template/header.php";
if (!checkHash() || !in_array(14, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}?>
<div class="page-title">
    <div class="title_left">
        <h3><?php echo _MyEmployeesList;?></h3>
    </div>


</div>

<div class="clearfix"></div>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo _Manage;?> <small><?php echo _Employees;?></small></h2>
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
                        <th><?php echo _UserName;?></th>
                        <th><?php echo _FirstName;?></th>
                        <th><?php echo _LastName;?></th>
                        <th><?php echo _State;?></th>
                        <th><?php echo _Branch;?></th>
                        <th><?php echo _Role;?></th>
                        <th><?php echo _Department;?></th>
                        <th><?php echo _JobType;?></th>
                        <th><?php echo _TotalWorkingHoursPerMonth;?></th>
                        <th><?php echo _Mobile;?></th>
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
<script src="./resource/js/forms/myEmployees.js"></script>
