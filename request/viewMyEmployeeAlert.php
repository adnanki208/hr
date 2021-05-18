<?php
include "init.php";
$response=[];
if(checkHash()) {
    $stmt = $con->prepare("SELECT *  FROM employee WHERE employee.upperId = ? AND  (NOT employee.id = ?)");
//execute yhe statement
    $stmt->execute(array($_SESSION['user']['id'], $_SESSION['user']['id']));
//Assign To Variable
    $rows = $stmt->fetchAll();
$users=[];
foreach ($rows as $row){
    $users[]=$row['id'];
}
if(!empty($users)){
    $users= implode(',',$users);
    $stmt=$con->prepare("SELECT alerts.id,alerts.employeeId,alerts.type,alerts.date,alerts.discount,alerts.description ,employee.userName as userName  FROM alerts INNER JOIN employee on alerts.employeeId = employee.id  WHERE  alerts.employeeId IN ( ".$users." )");
//execute yhe statement
    $stmt->execute();
//Assign To Variable
    $rows=$stmt->fetchAll();
}


//var_dump($stmt);
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