<?php
include "init.php";
$response=[];
if(checkHash()) {

$stmt=$con->prepare("SELECT leave_request.id as idreq,leave_request.type,leave_request.description,leave_request.date,leave_request.employeeId,leave_request.state,leave_request.acceptedDate, employee.userName as userName, employee.first ,employee.last FROM leave_request INNER JOIN employee on leave_request.employeeId = employee.id ");
//execute yhe statement
$stmt->execute();
//Assign To Variable
$rows=$stmt->fetchAll();
//var_dump($rows);
//exit;
$response['code']='1';
$response['msg']='Success';
$response['data']=$rows;
}else{
    $response['code'] = '-30';
    $response['msg'] = 'Not Authorized ';
}
header('Content-Type: application/json');
echo json_encode($response);