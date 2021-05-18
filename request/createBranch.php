<?php

include "init.php";
$response = [];
if(checkHash()) {
    if ($_POST['action'] == 'add') {
        $title = isset($_POST['title']) ? mysql_escape_mimic($_POST['title']) : "";

        if (checkItem("name", "branch", $title) > 0) {
            $response['code'] = '0';
            $response['msg'] = _Exist;
        } else {

                $stmt = $con->prepare("INSERT INTO  branch(name ) VALUES(:name)");
                $stmt->execute(array('name' => $title,));
                $response['code'] = '1';
                $response['msg'] = _Success;


        }
    } elseif
    ($_POST['action'] == 'del') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        if (checkItem("id", "branch", $id) > 0) {
            $count = 0;
            $stmt = $con->prepare("SELECT * FROM `employee`  WHERE `branchId`= ?");
            $stmt->execute(array($id));
            $count = $stmt->rowCount();
            if ($count > 0) {
                $response['code'] = '-10';
                $response['msg'] = _IncludeEmployees;
            } else {
                $stmt = $con->prepare("DELETE FROM branch WHERE  id = :id");
                $stmt->bindParam("id", $id);
                $stmt->execute();

                $response['code'] = '1';
                $response['msg'] = _Success;
            }
        } else {

            $response['code'] = '0';
            $response['msg'] = _NotExist;

        }
    } elseif
    ($_POST['action'] == 'update') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $title = isset($_POST['title']) ? mysql_escape_mimic($_POST['title']) : "";
        if ($check = checkItem("id", "branch", $id) > 0) {
            $statement = $con->prepare("SELECT * FROM branch WHERE  NOT id = ? AND name = ?");
            $statement->execute(array($id, $title));
            $count = $statement->rowCount();
            if ($count > 0) {
                $response['code'] = '0';
                $response['msg'] = _Exist;
            } else {

                    $stmt = $con->prepare("UPDATE branch SET name = ? where id =? ");
                    $stmt->execute(array($title, $id));

                    $response['code'] = '1';
                    $response['msg'] = _Success;

            }
        } else {
            $response['code'] = '0';
            $response['msg'] = _NotExist;

        }

    }
}else{
    $response['code'] = '-30';
    $response['msg'] =  _NotAuthorized;
}
header('Content-Type: application/json');
echo json_encode($response);