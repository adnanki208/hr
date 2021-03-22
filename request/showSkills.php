<?php
include "init.php";
$response=[];
if(checkHash()) {

$stmt=$con->prepare("SELECT skill.id,skill.name,skill.groupId ,skill_group.name as groupname FROM skill INNER JOIN skill_group on skill.groupId = skill_group.id");
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