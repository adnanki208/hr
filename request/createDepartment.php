<?php

include "init.php";
$response = [];
if ($_POST['action'] == 'add') {
    $title = $_POST['title'];
    $code = $_POST['code'];
    if (checkItem("title", "department", $title) > 0) {
        $response['code'] = '0';
        $response['msg'] = 'title already inserted';
    } else {
        if (checkItem("code", "department", $code) > 0) {
            $response['code'] = '0';
            $response['msg'] = 'code already inserted';
        } else {
            $stmt = $con->prepare("INSERT INTO  department(title,code) VALUES(:title,:code)");
            $stmt->execute(array('title' => $title, 'code' => $code,));
            $response['code'] = '1';
            $response['msg'] = 'inserted successfully ';


        }
    }
} elseif
($_POST['action'] == 'del') {
    $id = $_POST['id'];
    if (checkItem("id", "department", $id) > 0) {
        $count = 0;
        $stmt = $con->prepare("SELECT * FROM `employee`  WHERE `departmintId`= ?");
        $stmt->execute(array($id));
        $count = $stmt->rowCount();
        if ($count > 0) {
            $response['code'] = '-10';
            $response['msg'] = 'This Department Still Include Employees Please Change Them Department';
        } else {
            $stmt = $con->prepare("DELETE FROM department WHERE  id = :id");
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

    $title = $_POST['title'];
    $code = $_POST['code'];
    $id = $_POST['id'];
    if ($check = checkItem("id", "department", $id) > 0) {
        if (checkItem("title", "department", $title) > 0) {
            $response['code'] = '0';
            $response['msg'] = 'title already inserted';
        } else {

            if (checkItem("code", "department", $code) > 0) {
                $response['code'] = '0';
                $response['msg'] = 'code already inserted';
            } else {
                $stmt = $con->prepare("UPDATE department SET title = ?,code = ? where id =? ");
                $stmt->execute(array($title, $code, $id));

                $response['code'] = '1';
                $response['msg'] = 'Updated successfully ';
            }
        }
    } else {
        $response['code'] = '0';
        $response['msg'] = 'Not Exist ';

    }

}
header('Content-Type: application/json');
echo json_encode($response);