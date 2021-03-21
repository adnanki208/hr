<?php
include "init.php";
$response=[];
$stmt=$con->prepare("SELECT leave_request.id as idreq,leave_request.type,leave_request.description,leave_request.date,leave_request.employeeId,leave_request.state, employee.userName as userName, employee.first ,employee.last FROM leave_request INNER JOIN employee on leave_request.employeeId = employee.id WHERE leave_request.state = 0");
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