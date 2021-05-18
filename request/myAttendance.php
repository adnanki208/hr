<?php
include "init.php";
$response = [];
if (checkHash()) {


    $stmt = $con->prepare("SELECT *   FROM employee_shift where employeeId = ? ");
    //execute yhe statement
    $stmt->execute(array($_SESSION['user']['id']));
    //Assign To Variable
    $rows = $stmt->fetchAll();

    $response['code'] = '1';
    $response['msg'] = _Success;
    $response['data'] = $rows;
} else {
    $response['code'] = '-30';
    $response['msg'] =  _NotAuthorized;
}
header('Content-Type: application/json');
echo json_encode($response);
