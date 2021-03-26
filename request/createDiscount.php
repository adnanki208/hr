<?php

include "init.php";
$response=[];
if(checkHash()) {
if ($_POST['action'] == 'add'){
    $starTime = isset($_POST['startTime']) ? mysql_escape_mimic($_POST['startTime']) : "";
    $endTime = isset($_POST['endTime']) ? mysql_escape_mimic($_POST['endTime']) : "";
    $discount = isset($_POST['discount']) ? mysql_escape_mimic($_POST['discount']) : "";


    if (checkItem2  ("id","shift_rule_discount","start",$starTime,"end",$endTime) > 0){
        $response['code']='0';
        $response['msg']='Discount Already Inserted ';
    }elseif($endTime < $starTime)
    {
        $response['code']='-1';
        $response['msg']='Wrong Time ';
    }
    else{
        $start_t = new DateTime($starTime);
        $current_t = new DateTime($endTime);
        $difference = $start_t ->diff($current_t );
        $return_time = $difference ->format('%H:%I:%S');

        $stmt=$con->prepare("INSERT INTO shift_rule_discount(start,end,value,percentage) VALUES(:zstart,:zend,:zvalue,:zdiscount)");
        $stmt->execute(array('zstart' => $starTime, 'zend'=>$endTime,'zvalue'=>$return_time,'zdiscount' => $discount));
        $response['code']='1';
        $response['msg']='Discount inserted successfully ';
    }


} elseif ($_POST['action'] == 'del'){
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
    if (checkItem("id","shift_rule_discount",$id) > 0 ){
        $stmt=$con->prepare("DELETE FROM shift_rule_discount WHERE  id = :kid");
        $stmt->bindParam("kid",$id);
        $stmt->execute();

        $response['code']='1';
        $response['msg']='Discount Deleted successfully ';
    }else{

        $response['code']='0';
        $response['msg']='Discount Not exist ';

    }
}elseif ($_POST['action']=='update'){
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
    $starTime = isset($_POST['startTime']) ? mysql_escape_mimic($_POST['startTime']) : "";
    $endTime = isset($_POST['endTime']) ? mysql_escape_mimic($_POST['endTime']) : "";
    $discount = isset($_POST['discount']) ? mysql_escape_mimic($_POST['discount']) : "";



    if ( checkItem2  ("id","shift_rule_discount","start",$starTime,"end",$endTime) > 0){
        $response['code']='0';
        $response['msg']='Discount Already  Exist ';

    }elseif ($endTime < $starTime){
        $response['code']='-1';
        $response['msg']='Wrong Time ';
    }
    else{
        $start_t = new DateTime($starTime);
        $current_t = new DateTime($endTime);
        $difference = $start_t ->diff($current_t );
        $return_time = $difference ->format('%H:%I:%S');

        $stmt = $con->prepare("UPDATE shift_rule_discount SET start = ? , end = ?,value=?,percentage = ? where id =? ");
        $stmt->execute(array($starTime,$endTime,$return_time,$discount, $id));

        $response['code']='1';
        $response['msg']='Discount Updated successfully ';

    }

}
}else{
    $response['code'] = '-30';
    $response['msg'] = 'Not Authorized ';
}
header('Content-Type: application/json');
echo json_encode($response);