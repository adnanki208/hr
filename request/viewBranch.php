<?php
include "init.php";
$response = [];
if (checkHash()) {
    $stmt = $con->prepare("SELECT * FROM branch");
//execute yhe statement
    $stmt->execute();
//Assign To Variable
    $rows = $stmt->fetchAll();
//var_dump($rows);
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