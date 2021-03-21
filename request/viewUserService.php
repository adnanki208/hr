<?php
include "init.php";
$response=[];
$stmt=$con->prepare("SELECT * FROM leave_request where employeeId = ? ");
//execute yhe statement
$stmt->execute(array($_SESSION['user']['id']));
//Assign To Variable
$rows=$stmt->fetchAll();
//var_dump($rows);
//exit;
$response['code']='1';
$response['msg']='Success';
$response['data']=$rows;
header('Content-Type: application/json');
echo json_encode($response);