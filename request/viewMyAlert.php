<?php
include "init.php";
$response=[];
$stmt2 = $con->prepare("UPDATE alerts SET state = 1 where employeeId =? ");
$stmt2->execute(array($_SESSION['user']['id']));

$stmt=$con->prepare("SELECT *  FROM alerts WHERE employeeId = ? ");
//execute yhe statement
$stmt->execute($_SESSION['user']['id']);
//Assign To Variable
$rows=$stmt->fetchAll();
//var_dump($rows);
//exit;
$response['code']='1';
$response['msg']='Success';
$response['data']=$rows;
header('Content-Type: application/json');
echo json_encode($response);
