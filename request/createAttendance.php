<?php

include "init.php";
$response=[];
if ($_POST['action'] == 'add'){
    $starTime = $_POST['startTime'];
    $endTime=$_POST['endTime'];

    if (checkItem2  ("id","shift_rule_time","start",$starTime,"end",$endTime) > 0){
        $response['code']='0';
        $response['msg']='Shift Already Inserted ';
    }elseif($endTime < $starTime)
    {
        $response['code']='-1';
        $response['msg']='Wrong Time ';
    }
    else{

        $stmt=$con->prepare("INSERT INTO shift_rule_time(start,end) VALUES(:zstart,:zend)");
        $stmt->execute(array('zstart' => $starTime, 'zend'=>$endTime));
        $response['code']='1';
        $response['msg']='Shift inserted successfully ';
    }


} elseif ($_POST['action'] == 'del'){
    $id=$_POST['id'];
    if (checkItem("id","shift_rule_time",$id) > 0 ){
        $stmt=$con->prepare("DELETE FROM shift_rule_time WHERE  id = :kid");
        $stmt->bindParam("kid",$id);
        $stmt->execute();

        $response['code']='1';
        $response['msg']='Shift Deleted successfully ';
    }else{

        $response['code']='0';
        $response['msg']='Shift Not exist ';

    }
}elseif ($_POST['action']=='update'){

    $starTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $id = $_POST['id'];

    if ( checkItem2  ("id","shift_rule_time","start",$starTime,"end",$endTime) > 0){
        $response['code']='0';
        $response['msg']='Shift Already  Exist ';

    }elseif ($endTime < $starTime){
        $response['code']='-1';
        $response['msg']='Wrong Time ';
    }
    else{


        $stmt = $con->prepare("UPDATE shift_rule_time SET start = ? , end = ? where id =? ");
        $stmt->execute(array($starTime,$endTime, $id));

        $response['code']='1';
        $response['msg']='Shift Updated successfully ';

    }

}
header('Content-Type: application/json');
echo json_encode($response);