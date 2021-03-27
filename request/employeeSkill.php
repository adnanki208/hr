<?php

include "init.php";
$response=[];
if(checkHash()) {
    if ($_POST['action'] == 'add'){
        $employeeId = isset($_POST['employeeId']) ? mysql_escape_mimic($_POST['employeeId']) : "";
        $skillName = isset($_POST['skillName']) ? mysql_escape_mimic($_POST['skillName']) : "";
        $skillName2 = implode(",", $skillName);
        if (checkItem("employeeId","employee_skile",$employeeId) > 0 ){
            $response['code']='0';
            $response['msg']='Skills Already Added To This Employee';
        }else{
            $stmt=$con->prepare("INSERT INTO employee_skile(employeeId,skillId) VALUES(:zemployeeId,:zskill)");
            $stmt->execute(array('zemployeeId' => $employeeId, 'zskill'=>$skillName2));
            $response['code']='1';
            $response['msg']='Skills inserted successfully ';
        }



    } elseif ($_POST['action'] == 'del'){
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        if (checkItem("id","alerts",$id) > 0 ){
            $stmt=$con->prepare("DELETE FROM alerts WHERE  id = :kid");
            $stmt->bindParam("kid",$id);
            $stmt->execute();

            $response['code']='1';
            $response['msg']='Alert Deleted successfully ';
        }else{

            $response['code']='0';
            $response['msg']='Alert Not exist ';

        }
    }elseif ($_POST['action']=='update'){
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $name = isset($_POST['name']) ? mysql_escape_mimic($_POST['name']) : "";
        $groupid = isset($_POST['groupid']) ? mysql_escape_mimic($_POST['groupid']) : "";
        if ( checkItem2  ("name","skill","name",$name,"groupId",$groupid) > 0){
            $response['code']='0';
            $response['msg']='Skill  Exist ';

        }else{


            $stmt = $con->prepare("UPDATE skill SET name = ? , groupId = ? where id =? ");
            $stmt->execute(array($name,$groupid, $id));

            $response['code']='1';
            $response['msg']='Skill Updated successfully ';

        }

    }
}else{
    $response['code'] = '-30';
    $response['msg'] = 'Not Authorized ';
}
header('Content-Type: application/json');
echo json_encode($response);