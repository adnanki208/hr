<?php
include "init.php";
$response=[];
if(checkHash()) {

    $stmt=$con->prepare("SELECT * FROM jobtype");
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