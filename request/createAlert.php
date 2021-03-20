<?php

include "init.php";
$response=[];
if ($_POST['action'] == 'add'){
    $alertTo = $_POST['alertTo'];
    $alertBody=$_POST['alertBody'];
    $title=$_POST['title'];
    $discount=$_POST['discount'];



        $stmt=$con->prepare("INSERT INTO  alerts(employeeId,type,description,discount,date,state) VALUES(:zemployeeId,:ztype,:zdescription,:zdiscount,now(),:zstate)");
        $stmt->execute(array('zemployeeId' => $alertTo, 'ztype'=>$title,'zdescription'=>$alertBody,'zdiscount'=>$discount,'zstate' => '0'));
        $response['code']='1';
        $response['msg']='Alert inserted successfully ';



} elseif ($_POST['action'] == 'del'){
    $id=$_POST['id'];
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

    $name = $_POST['name'];
    $id = $_POST['id'];
    $groupid=$_POST['groupid'];
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
header('Content-Type: application/json');
echo json_encode($response);