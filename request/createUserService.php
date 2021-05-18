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
                $response['msg'] = _NoVacationCredit;
            } else {

                if (checkItem2("id", "leave_request", 'employeeId', $_SESSION['user']['id'], 'date', $vacationDate) > 0) {
                    $response['code'] = '0';
                    $response['msg'] = _VacationInsertedAlready;
                } else {
                    $stmt = $con->prepare("INSERT INTO  leave_request(employeeId,date,description,type,state) VALUES(:zemployeeId,:zdate,:zdescription,:ztype,0)");
                    $stmt->execute(array('zemployeeId' => $_SESSION['user']['id'], 'zdate' => $vacationDate, 'zdescription' => $vacationDescription, 'ztype' => $vacationType));
                    $response['code'] = '1';
                    $response['msg'] = _Success;
                }

            }

        } elseif ($vacationType == 2) {
            $stmt = $con->prepare("SELECT * FROM leave_request WHERE employeeId =? AND  type = 2 AND (state = 0 OR state = 1) AND YEAR(date) = ?");
            //execute yhe statement
            $stmt->execute(array($_SESSION['user']['id'],$year));
            $count = $stmt->rowCount();

            if ($count >= $_SESSION['user']['sake']) {
                $response['code'] = '-2';
                $response['msg'] = _NoVacationCredit;
            } else {
                if (checkItem2("id", "leave_request", 'employeeId', $_SESSION['user']['id'], 'date', $vacationDate) > 0) {
                    $response['code'] = '0';
                    $response['msg'] = _VacationInsertedAlready;
                } else {
                    $stmt = $con->prepare("INSERT INTO  leave_request(employeeId,date,description,type,state) VALUES(:zemployeeId,:zdate,:zdescription,:ztype,0)");
                    $stmt->execute(array('zemployeeId' => $_SESSION['user']['id'], 'zdate' => $vacationDate, 'zdescription' => $vacationDescription, 'ztype' => $vacationType));
                    $response['code'] = '1';
                    $response['msg'] = _Success;
                }
            }
        } elseif ($vacationType == 3) {

            if (checkItem2("id", "leave_request", 'employeeId', $_SESSION['user']['id'], 'date', $vacationDate) > 0) {
                $response['code'] = '0';
                $response['msg'] = _VacationInsertedAlready;
            } else {
                $stmt = $con->prepare("INSERT INTO  leave_request(employeeId,date,description,type,state) VALUES(:zemployeeId,:zdate,:zdescription,:ztype,0)");
                $stmt->execute(array('zemployeeId' => $_SESSION['user']['id'], 'zdate' => $vacationDate, 'zdescription' => $vacationDescription, 'ztype' => $vacationType));
                $response['code'] = '1';
                $response['msg'] = _Success;
            }
        }


    }
} else {
    $response['code'] = '-30';
    $response['msg'] =  _NotAuthorized;
}
header('Content-Type: application/json');
echo json_encode($response);