<?php

include "init.php";
$response = [];
if(checkHash()) {
if ($_POST['action'] == 'add') {
    $starTime = isset($_POST['startTime']) ? mysql_escape_mimic($_POST['startTime']) : "";
    $endTime = isset($_POST['endTime']) ? mysql_escape_mimic($_POST['endTime']) : "";
    if (checkItem2("id", "shift_rule_time", "start", $starTime, "end", $endTime) > 0) {
        $response['code'] = '0';
        $response['msg'] = _Exist;
    } elseif ($endTime < $starTime) {
        $response['code'] = '-1';
        $response['msg'] = _WrongTime;
    } else {

        $stmt = $con->prepare("INSERT INTO shift_rule_time(start,end) VALUES(:zstart,:zend)");
        $stmt->execute(array('zstart' => $starTime, 'zend' => $endTime));
        $response['code'] = '1';
        $response['msg'] = _Success;
    }


} elseif ($_POST['action'] == 'del') {
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
    if (checkItem("id", "shift_rule_time", $id) > 0) {
        $stmt = $con->prepare("SELECT * FROM `employee`  WHERE `shiftId`= ?");
        $stmt->execute(array($id));
        $count = $stmt->rowCount();
        if ($count > 0) {
            $response['code'] = '-10';
            $response['msg'] = _IncludeEmployees;
        } else {
            $stmt = $con->prepare("DELETE FROM shift_rule_time WHERE  id = :kid");
            $stmt->bindParam("kid", $id);
            $stmt->execute();

            $response['code'] = '1';
            $response['msg'] = _Success;
        }
    } else {

        $response['code'] = '0';
        $response['msg'] = _NotExist;

    }
} elseif ($_POST['action'] == 'update') {
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
    $starTime = isset($_POST['startTime']) ? mysql_escape_mimic($_POST['startTime']) : "";
    $endTime = isset($_POST['endTime']) ? mysql_escape_mimic($_POST['endTime']) : "";

    if (checkItem2("id", "shift_rule_time", "start", $starTime, "end", $endTime) > 0) {
        $response['code'] = '0';
        $response['msg'] = _Exist;

    } elseif ($endTime < $starTime) {
        $response['code'] = '-1';
        $response['msg'] = _WrongTime;
    } else {


        $stmt = $con->prepare("UPDATE shift_rule_time SET start = ? , end = ? where id =? ");
        $stmt->execute(array($starTime, $endTime, $id));

        $response['code'] = '1';
        $response['msg'] = _Success;

    }

}
}else{
    $response['code'] = '-30';
    $response['msg'] =  _NotAuthorized;
}
header('Content-Type: application/json');
echo json_encode($response);