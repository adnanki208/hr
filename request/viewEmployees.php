<?php
include "init.php";
$response=[];
if(checkHash()) {
$stmt=$con->prepare("SELECT * ,employee.id as employeeId,role.name as roleName ,jobtype.name as jobtypename,branch.name as branchname FROM employee 
INNER JOIN `role` ON employee.roleId = role.id
INNER JOIN `department` ON employee.departmintId = department.id
INNER JOIN `jobtype` ON employee.jobTypeId = jobtype.id
INNER JOIN `branch` ON employee.branchId = branch.id;");
//execute yhe statement
$stmt->execute();
//Assign To Variable
$rows=$stmt->fetchAll();
//var_dump($rows);
//exit();
$response['code']='1';
$response['msg']=_Success;
$response['data']=$rows;
}else{
    $response['code'] = '-30';
    $response['msg'] =  _NotAuthorized;
}
header('Content-Type: application/json');
echo json_encode($response);