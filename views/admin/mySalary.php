<?php include  "../../template/header.php";
if (!checkHash()) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}?>
<div class="page-title">
    <div class="title_left">
        <h3><?php echo _Salary;?></h3>
    </div>


</div>

<div class="clearfix"></div>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo _ViewMy;?>  <small><?php echo _Salary;?></small></h2>
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
                        <th><?php echo _Date;?></th>
                        <th><?php echo _Basic;?></th>
                        <th><?php echo _Sustenance;?></th>
                        <th><?php echo _Management;?></th>
                        <th><?php echo _Travel;?></th>
                        <th><?php echo _OverTime;?></th>
                        <th><?php echo _Advance;?></th>
                        <th><?php echo _Reward;?></th>
                        <th><?php echo _Discount;?></th>
                        <th><?php echo _Total;?></th>
                        <th><?php echo _CheckOut;?></th>

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
<script src="./resource/js/forms/mySalary.js"></script>

