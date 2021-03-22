<?php

include "init.php";
$response = [];
if ($_POST['action'] == 'add') {
    $title = isset($_POST['title']) ? mysql_escape_mimic($_POST['title']) : "";
    $code = isset($_POST['code']) ? mysql_escape_mimic($_POST['code']) : "";
    $rolee=$_POST['role'];
    $role=implode(",",$rolee);
    if (checkItem("name", "role", $title) > 0) {
        $response['code'] = '0';
        $response['msg'] = 'Role already Exist';
    } else {
        if (checkItem("code", "role", $code) > 0) {
            $response['code'] = '0';
            $response['msg'] = 'code already Exist';
        } else {
            $stmt = $con->prepare("INSERT INTO  role(name,code,access) VALUES(:title,:code,:role)");
            $stmt->execute(array('title' => $title, 'code' => $code,'role' => $role));
            $response['code'] = '1';
            $response['msg'] = 'inserted successfully ';


        }
    }
} elseif
($_POST['action'] == 'del') {
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
    if (checkItem("id", "role", $id) > 0) {
        $count = 0;
        $stmt = $con->prepare("SELECT * FROM `employee`  WHERE `roleId`= ?");
        $stmt->execute(array($id));
        $count = $stmt->rowCount();
        if ($count > 0) {
            $response['code'] = '-10';
            $response['msg'] = 'This Role Still Include Employees Please Change Them To Another Role';
        } else {
            $stmt = $con->prepare("DELETE FROM role WHERE  id = :id");
            $stmt->bindParam("id", $id);
            $stmt->execute();

            $response['code'] = '1';
            $response['msg'] = 'Deleted successfully ';
        }
    } else {

        $response['code'] = '0';
        $response['msg'] = 'Not exist ';

    }
} elseif
($_POST['action'] == 'update') {

    $title = isset($_POST['title']) ? mysql_escape_mimic($_POST['title']) : "";
    $code = isset($_POST['code']) ? mysql_escape_mimic($_POST['code']) : "";
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
    $rolee=$_POST['role'];
    $role=implode(",",$rolee);
    if ($check = checkItem("id", "role", $id) > 0) {

        $statement = $con->prepare("SELECT * FROM role WHERE id != ? and  name = ?   ");
        $statement->execute(array($id,$title));
        $count = $statement->rowCount();

        $statement2 = $con->prepare("SELECT * FROM role WHERE id != ? and code= ?  ");
        $statement2->execute(array($id, $code));
        $count2 = $statement2->rowCount();
        if ($count>0){
            $response['code'] = '0';
            $response['msg'] = 'Role Name already Existed';
        }elseif($count2>0) {
                $response['code'] = '0';
                $response['msg'] = 'Role Code already Existed';
        }else{
            $stmt = $con->prepare("UPDATE role SET name = ?,code = ? , access = ? where id =? ");
            $stmt->execute(array($title, $code,$role, $id));

            $response['code'] = '1';
            $response['msg'] = 'Updated successfully ';
        }
    } else {
        $response['code'] = '0';
        $response['msg'] = 'Not Exist ';

    }

}
header('Content-Type: application/json');
echo json_encode($response);