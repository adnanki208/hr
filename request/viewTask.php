<?php
include "init.php";
$response=[];
if(checkHash()) {
    if(isset($_POST['action']) && $_POST['action']=='myTask'){
        $stmt = $con->prepare("SELECT * ,task.id as taskid,task.state as taskstate,e.userName as employeeName ,cr.userName as creatorName,k.userName as checkerName FROM task 
INNER JOIN employee e ON task.employee = e.id
INNER JOIN employee cr ON task.creator = cr.id
INNER JOIN employee k ON task.checker = k.id  
WHERE task.employee = ".$_SESSION['user']['id'].";");
    } elseif(isset($_POST['action']) && $_POST['action']=='myEmployeeTask'){
        $stmt = $con->prepare("SELECT * ,task.id as taskid,task.state as taskstate,e.userName as employeeName ,cr.userName as creatorName,k.userName as checkerName FROM task 
INNER JOIN employee e ON task.employee = e.id
INNER JOIN employee cr ON task.creator = cr.id
INNER JOIN employee k ON task.checker = k.id  
WHERE e.upperId = ".$_SESSION['user']['id']." AND NOT e.id = ".$_SESSION['user']['id']." ;");
    }else {
        $stmt = $con->prepare("SELECT * ,task.id as taskid,task.state as taskstate,e.userName as employeeName ,cr.userName as creatorName,k.userName as checkerName FROM task 
INNER JOIN employee e ON task.employee = e.id
INNER JOIN employee cr ON task.creator = cr.id
INNER JOIN employee k ON task.checker = k.id  ;");
    }
//execute yhe statement
$stmt->execute();
//Assign To Variable
$rows=$stmt->fetchAll();
//var_dump($rows);
//exit();
$response['code']='1';
$response['msg']='Success';
$response['data']=$rows;
}else{
    $response['code'] = '-30';
    $response['msg'] = 'Not Authorized ';
}
header('Content-Type: application/json');
echo json_encode($response);