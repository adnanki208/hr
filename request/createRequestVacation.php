<?php
include "init.php";
$response = [];
$year= date('Y');
if (checkHash()) {

    if ($_POST['action'] == 'add') {

        $vacationDate = isset($_POST['vacationDate']) ? mysql_escape_mimic($_POST['vacationDate']) : "";
        $vacationType = isset($_POST['vacationType']) ? mysql_escape_mimic($_POST['vacationType']) : "";
        $vacationDescription = isset($_POST['vacationDescription']) ? mysql_escape_mimic($_POST['vacationDescription']) : "";

        if ($vacationType == 1) {
            $stmt = $con->prepare("SELECT * FROM leave_request WHERE employeeId =? AND type = 1 AND  (state = 0 OR state = 1) AND YEAR(date) = ?");
            //execute yhe statement
            $stmt->execute(array($_SESSION['user']['id'],$year));
            $count = $stmt->rowCount();

            if ($count >= $_SESSION['user']['vacation']) {
                $response['code'] = '-2';
                $response['msg'] = 'You Don\'t have Vacation Credit  ';
            } else {

                if (checkItem2("id", "leave_request", 'employeeId', $_SESSION['user']['id'], 'date', $vacationDate) > 0) {
                    $response['code'] = '0';
                    $response['msg'] = 'Vacation inserted already ';
                } else {
                    $stmt = $con->prepare("INSERT INTO  leave_request(employeeId,date,description,type,state) VALUES(:zemployeeId,:zdate,:zdescription,:ztype,0)");
                    $stmt->execute(array('zemployeeId' => $_SESSION['user']['id'], 'zdate' => $vacationDate, 'zdescription' => $vacationDescription, 'ztype' => $vacationType));
                    $response['code'] = '1';
                    $response['msg'] = 'Vacation inserted successfully ';
                }

            }

        } elseif ($vacationType == 2) {
            $stmt = $con->prepare("SELECT * FROM leave_request WHERE employeeId =? AND  type = 2 AND (state = 0 OR state = 1)  AND YEAR(date) = ?");
            //execute yhe statement
            $stmt->execute(array($_SESSION['user']['id'],$year));
            $count = $stmt->rowCount();

            if ($count >= $_SESSION['user']['sake']) {
                $response['code'] = '-2';
                $response['msg'] = 'You Don\'t have Vacation Credit  ';
            } else {
                if (checkItem2("id", "leave_request", 'employeeId', $_SESSION['user']['id'], 'date', $vacationDate) > 0) {
                    $response['code'] = '0';
                    $response['msg'] = 'Vacation inserted already ';
                } else {
                    $stmt = $con->prepare("INSERT INTO  leave_request(employeeId,date,description,type,state) VALUES(:zemployeeId,:zdate,:zdescription,:ztype,0)");
                    $stmt->execute(array('zemployeeId' => $_SESSION['user']['id'], 'zdate' => $vacationDate, 'zdescription' => $vacationDescription, 'ztype' => $vacationType));
                    $response['code'] = '1';
                    $response['msg'] = 'Vacation inserted successfully ';
                }
            }
        } elseif ($vacationType == 3) {

            if (checkItem2("id", "leave_request", 'employeeId', $_SESSION['user']['id'], 'date', $vacationDate) > 0) {
                $response['code'] = '0';
                $response['msg'] = 'Vacation inserted already ';
            } else {
                $stmt = $con->prepare("INSERT INTO  leave_request(employeeId,date,description,type,state) VALUES(:zemployeeId,:zdate,:zdescription,:ztype,0)");
                $stmt->execute(array('zemployeeId' => $_SESSION['user']['id'], 'zdate' => $vacationDate, 'zdescription' => $vacationDescription, 'ztype' => $vacationType));
                $response['code'] = '1';
                $response['msg'] = 'Vacation inserted successfully ';
            }
        }


    } elseif ($_POST['action'] == 'addForEmployee') {

        $employeeId = isset($_POST['employeeId']) ? mysql_escape_mimic($_POST['employeeId']) : "";
        $vacationDate = isset($_POST['vacationDate']) ? mysql_escape_mimic($_POST['vacationDate']) : "";
        $vacationType = isset($_POST['vacationType']) ? mysql_escape_mimic($_POST['vacationType']) : "";
        $vacationDescription = isset($_POST['vacationDescription']) ? mysql_escape_mimic($_POST['vacationDescription']) : "";
        $stmt = $con->prepare("SELECT * FROM employee WHERE id =?;");
        //execute yhe statement
        $stmt->execute(array($employeeId));
        $user = $stmt->fetch();
        if ($vacationType == 1) {


            $stmt = $con->prepare("SELECT * FROM leave_request WHERE employeeId =? AND type = 1 AND  (state = 0 OR state = 1) AND YEAR(date) = ?");
            //execute yhe statement
            $stmt->execute(array($employeeId,$year));
            $count = $stmt->rowCount();

            if ($count >= $user['vacation']) {
                $response['code'] = '-2';
                $response['msg'] = 'Employee Don\'t have Vacation Credit  ';
            } else {

                if (checkItem2("id", "leave_request", 'employeeId', $employeeId, 'date', $vacationDate) > 0) {
                    $response['code'] = '0';
                    $response['msg'] = 'Vacation inserted already ';
                } else {
                    $stmt = $con->prepare("INSERT INTO  leave_request(employeeId,date,description,type,state,acceptedDate,acceptedId) VALUES(:zemployeeId,:zdate,:zdescription,:ztype,1,now(),:zacceptedId)");
                    $stmt->execute(array('zemployeeId' => $employeeId, 'zdate' => $vacationDate, 'zdescription' => $vacationDescription, 'ztype' => $vacationType, 'zacceptedId' => $_SESSION['user']['id']));
                    $response['code'] = '1';
                    $response['msg'] = 'Vacation inserted successfully ';
                }

            }

        } elseif ($vacationType == 2) {
            $stmt = $con->prepare("SELECT * FROM leave_request WHERE employeeId =? AND  type = 2 AND (state = 0 OR state = 1)  AND YEAR(date) = ?");
            //execute yhe statement
            $stmt->execute(array($employeeId,$year));
            $count = $stmt->rowCount();

            if ($count >= $user['sake']) {
                $response['code'] = '-2';
                $response['msg'] = 'Employee Don\'t have Vacation Credit  ';
            } else {
                if (checkItem2("id", "leave_request", 'employeeId', $employeeId, 'date', $vacationDate) > 0) {
                    $response['code'] = '0';
                    $response['msg'] = 'Vacation inserted already ';
                } else {
                    $stmt = $con->prepare("INSERT INTO  leave_request(employeeId,date,description,type,state,acceptedDate,acceptedId) VALUES(:zemployeeId,:zdate,:zdescription,:ztype,1,now(),:zacceptedId)");
                    $stmt->execute(array('zemployeeId' => $employeeId, 'zdate' => $vacationDate, 'zdescription' => $vacationDescription, 'ztype' => $vacationType, 'zacceptedId' => $_SESSION['user']['id']));
                    $response['code'] = '1';
                    $response['msg'] = 'Vacation inserted successfully ';
                }
            }
        } elseif ($vacationType == 3) {

            if (checkItem2("id", "leave_request", 'employeeId', $employeeId, 'date', $vacationDate) > 0) {
                $response['code'] = '0';
                $response['msg'] = 'Vacation inserted already ';
            } else {
                $stmt = $con->prepare("INSERT INTO  leave_request(employeeId,date,description,type,state,acceptedDate,acceptedId) VALUES(:zemployeeId,:zdate,:zdescription,:ztype,1,now(),:zacceptedId)");
                $stmt->execute(array('zemployeeId' => $employeeId, 'zdate' => $vacationDate, 'zdescription' => $vacationDescription, 'ztype' => $vacationType, 'zacceptedId' => $_SESSION['user']['id']));
                $response['code'] = '1';
                $response['msg'] = 'Vacation inserted successfully ';
            }
        }


    } elseif ($_POST['action'] == 'del') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        if (checkItem("id", "skill_group", $id) > 0) {
            $stmt = $con->prepare("DELETE FROM skill_group WHERE  id = :kid");
            $stmt->bindParam("kid", $id);
            $stmt->execute();

            $response['code'] = '1';
            $response['msg'] = 'Skill Deleted successfully ';
        } else {

            $response['code'] = '0';
            $response['msg'] = 'Skill Not exist ';

        }
    } elseif ($_POST['action'] == 'reject') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $stmt = $con->prepare("UPDATE leave_request SET acceptedId = ? , acceptedDate=now(),state = ? where id =? ");
        $stmt->execute(array($_SESSION['user']['id'], 2, $id));

        $response['code'] = '1';
        $response['msg'] = 'Vacation Rejected successfully ';

    } elseif ($_POST['action'] == 'approve') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $employeeId = isset($_POST['employeeId']) ? mysql_escape_mimic($_POST['employeeId']) : "";
        $vacationType = isset($_POST['type']) ? mysql_escape_mimic($_POST['type']) : "";
        $vacationDate = isset($_POST['date']) ? mysql_escape_mimic($_POST['date']) : "";

        $stmt = $con->prepare("UPDATE leave_request SET acceptedId = ? , acceptedDate=now(),state = ? where id =? ");
        $stmt->execute(array($_SESSION['user']['id'], 1, $id));

        $stmt = $con->prepare("SELECT shiftId FROM employee WHERE id = ?");
        //execute yhe statement
        $stmt->execute(array($employeeId));
        $shift = $stmt->fetch();
        //Add To Employee Shift Table
        $duration = shiftCalc($shift['shiftId']);
        $stmt = $con->prepare("INSERT INTO  employee_shift(employeeId,start,end,duration,date,vacation) VALUES(:zemployeeId,:zstart,:zend,:zduration,:zdate,:zvacation)");
        $stmt->execute(array('zemployeeId' => $employeeId, 'zstart' => 0, 'zend' => 0, 'zduration' => $duration, 'zdate' => $vacationDate, 'zvacation' => $vacationType));

        $stmt = $con->prepare("DELETE FROM employee_shift WHERE  employeeId = ? AND vacation = 5 AND date =?");
        $stmt->execute(array($employeeId,$vacationDate));
        $stmt->execute();
//
        $response['code'] = '1';
        $response['msg'] = 'Vacation Approved successfully ';

    }
} else {
    $response['code'] = '-30';
    $response['msg'] = 'Not Authorized ';
}
header('Content-Type: application/json');
echo json_encode($response);