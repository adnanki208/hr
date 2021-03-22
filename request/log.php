<?php
include "init.php";
$response=[];
if ($_POST['action'] == 'login'){
    $name = isset($_POST['name']) ? mysql_escape_mimic($_POST['name']) : "";
    $pass = isset($_POST['pass']) ? mysql_escape_mimic($_POST['pass']) : "";

    $pass = md5($pass);
//    var_dump($pass);
    $count=0;
        $stmt=$con->prepare("SELECT * FROM `employee`  WHERE `userName`= ? AND `password` = ?");
        $stmt->execute(array($name,$pass));
    $count=$stmt->rowCount();
    if($count>0){
        $rows=$stmt->fetch();
        if($rows['state']=='1') {
            $_SESSION['user']['id'] = $rows['id'];
            $_SESSION['user']['userName'] = $rows['userName'];
            $_SESSION['user']['authKey'] = $rows['authKey'];
            $_SESSION['user']['roleId'] = $rows['roleId'];
            $_SESSION['user']['shiftId'] = $rows['shiftId'];
            $_SESSION['user']['departmintId'] = $rows['departmintId'];
            $_SESSION['user']['jobTypeId'] = $rows['jobTypeId'];
            $_SESSION['user']['first'] = $rows['first'];
            $_SESSION['user']['salary'] = $rows['salary'];
            $_SESSION['user']['img'] = $rows['img'];
            $_SESSION['user']['upperId'] = $rows['upperId'];
            $_SESSION['user']['holyday'] = $rows['holyday'];
            $_SESSION['user']['sike'] = $rows['sike'];
            $_SESSION['user']['totalHours'] = $rows['totalHours'];
            $stmt = $con->prepare("SELECT access FROM `role`  WHERE `id`= ? ");
            $stmt->execute(array($rows['roleId']));
            $rows = $stmt->fetch();
            $_SESSION['user']['access'] = explode(',', $rows['access']);
//        var_dump($_SESSION);exit();
            $response['data'] = null;
            $response['code'] = 1;
            $response['msg'] = 'Success';
        }else{
            $response['data'] = null;
            $response['code'] = -1;
            $response['msg'] = 'User Disabled';
        }
    }else{
        $response['data']=null;
        $response['code']=-1;
        $response['msg']='User Or Password Incorrect';
    }
}
header('Content-Type: application/json');
echo json_encode($response);
