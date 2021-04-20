<?php include  "../../template/header.php";
if (!checkHash() || !in_array(14, $_SESSION['user']['access'])) { ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>Not Authorized.
    </div>
    <?php
    session_destroy();
    exit();


}
$stmt=$con->prepare("SELECT id,userName FROM employee where upperId = ? and  state = ? AND NOT id = ".$_SESSION['user']['id'].";");
//execute yhe statement
$stmt->execute(array($_SESSION['user']['id'],1));

//Assign To Variable
$rows=$stmt->fetchAll();

?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Tasks</h3>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Crate Task</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" id="add" data-parsley-validate>
                        <span class="section">Task Info</span>


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee">Assign Task To  <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select multiple class="form-control col-md-7 col-xs-12" id="employee"  required="" data-parsley-error-message="This value is required.">
                                    <?php foreach ($rows as $row) { ?>
                                        <option value="<?php echo $row['id']?>" ><?php echo  $row['userName']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Task  <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="description" class="form-control col-md-7 col-xs-12" required=""   data-parsley-error-message="This value is required."    type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> loading..." id="submit" type="submit" class="btn btn-success">Add Task</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Manage <small>Tasks </small></h2>
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
                            <th>Employee assigned to</th>
                            <th>Creator</th>
                            <th>Checker</th>
                            <th>Task</th>
                            <th>State</th>
                            <th>Creat Date</th>
                            <th>End Date</th>
                            <th>Tools</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>

</div>


<?php include  "../../template/footer.php"?>
<!--own page Script-->
<script src="./resource/js/forms/myEmployeeTask.js"></script>

