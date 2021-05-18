<?php
include "init.php";
$response=[];
if(checkHash()) {

$stmt=$con->prepare("SELECT alerts.id,alerts.employeeId,alerts.type,alerts.date,alerts.discount,alerts.description ,employee.userName as userName  FROM alerts INNER JOIN employee on alerts.employeeId = employee.id ");
//execute yhe statement
$stmt->execute();
//Assign To Variable
$rows=$stmt->fetchAll();
//var_dump($rows);
//exit;
$response['code']='1';
$response['msg']=_Success;
$response['data']=$rows;
}else{
    $response['code'] = '-30';
    $response['msg'] =  _NotAuthorized;
}
header('Content-Type: application/json');
echo json_encode($response);