<?php

include "init.php";
$response=[];
if(checkHash()) {
    if ($_POST['action'] == 'add'){
        $employeeId = isset($_POST['employeeId']) ? mysql_escape_mimic($_POST['employeeId']) : "";
        $skillName = isset($_POST['skillName']) ? mysql_escape_mimic($_POST['skillName']) : "";
        $skillName2 = implode(",", $skillName);
        if (checkItem("employeeId","employee_skile",$employeeId) > 0 ){
            $stmt = $con->prepare("UPDATE employee_skile SET skillId = ?  where employeeId =? ");
            $stmt->execute(array($skillName2,$employeeId));

            $response['code']='1';
            $response['msg']=_Success;
        }else{
            $stmt=$con->prepare("INSERT INTO employee_skile(employeeId,skillId) VALUES(:zemployeeId,:zskill)");
            $stmt->execute(array('zemployeeId' => $employeeId, 'zskill'=>$skillName2));
            $response['code']='1';
            $response['msg']=_Success;
        }



    } elseif ($_POST['action'] == 'del'){
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        if (checkItem("id","alerts",$id) > 0 ){
            $stmt=$con->prepare("DELETE FROM alerts WHERE  id = :kid");
            $stmt->bindParam("kid",$id);
            $stmt->execute();

            $response['code']='1';
            $response['msg']= _Success;
        }else{

            $response['code']='0';
            $response['msg']= _NotExist;

        }
    }elseif ($_POST['action']=='update'){
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $name = isset($_POST['name']) ? mysql_escape_mimic($_POST['name']) : "";
        $groupid = isset($_POST['groupid']) ? mysql_escape_mimic($_POST['groupid']) : "";
        if ( checkItem2  ("name","skill","name",$name,"groupId",$groupid) > 0){
            $response['code']='0';
            $response['msg']= _Exist;

        }else{


            $stmt = $con->prepare("UPDATE skill SET name = ? , groupId = ? where id =? ");
            $stmt->execute(array($name,$groupid, $id));

            $response['code']='1';
            $response['msg']= _Success;

        }

    }
}else{
    $response['code'] = '-30';
    $response['msg'] =  _NotAuthorized;
}
header('Content-Type: application/json');
echo json_encode($response);