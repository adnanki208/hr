<?php

include "init.php";
$response = [];
if(checkHash()) {
    if ($_POST['action'] == 'add') {
        $title = isset($_POST['title']) ? mysql_escape_mimic($_POST['title']) : "";
        $code = isset($_POST['code']) ? mysql_escape_mimic($_POST['code']) : "";

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
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
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
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $title = isset($_POST['title']) ? mysql_escape_mimic($_POST['title']) : "";
        $code = isset($_POST['code']) ? mysql_escape_mimic($_POST['code']) : "";
        if ($check = checkItem("id", "department", $id) > 0) {
            $statement = $con->prepare("SELECT * FROM department WHERE  NOT id = ? AND title = ?");
            $statement->execute(array($id, $title));
            $count = $statement->rowCount();
            if ($count > 0) {
                $response['code'] = '0';
                $response['msg'] = 'title already inserted';
            } else {
                $statement = $con->prepare("SELECT * FROM department WHERE  NOT id = ? AND code = ?");
                $statement->execute(array($id, $code));
                $count = $statement->rowCount();
                if ($count > 0) {
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
}else{
    $response['code'] = '-30';
    $response['msg'] = 'Not Authorized ';
}
header('Content-Type: application/json');
echo json_encode($response);