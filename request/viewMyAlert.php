<?php
include "init.php";
$response = [];
if (checkHash()) {


    $stmt = $con->prepare("SELECT *  FROM alerts where employeeId=?");
//execute yhe statement
    $stmt->execute(array($_SESSION['user']['id']));
//Assign To Variable
    $rows = $stmt->fetchAll();
//var_dump($rows);
    $stmt2 = $con->prepare("UPDATE alerts SET state = 1 where employeeId =? ");
    $stmt2->execute(array($_SESSION['user']['id']));
//exit;
    $response['code'] = '1';
    $response['msg'] = _Success;
    $response['data'] = $rows;
} else {
    $response['code'] = '-30';
    $response['msg'] =  _NotAuthorized;
}
header('Content-Type: application/json');
echo json_encode($response);


