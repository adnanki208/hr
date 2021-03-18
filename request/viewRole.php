<?php
include "init.php";
$response=[];
$stmt=$con->prepare("SELECT * FROM role ");
//execute yhe statement
$stmt->execute();
//Assign To Variable
$rows=$stmt->fetchAll();
//var_dump($rows);
//exit;
$response['code']='1';
$response['msg']='Success';
$response['data']=$rows;
header('Content-Type: application/json');
echo json_encode($response);