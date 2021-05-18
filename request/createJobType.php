<?php

include "init.php";
$response = [];
if (checkHash()) {
    if ($_POST['action'] == 'add') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $name = isset($_POST['name']) ? mysql_escape_mimic($_POST['name']) : "";
        if (checkItem("name", "jobtype", $name) > 0) {
            $response['code'] = '0';
            $response['msg'] = _Exist;
        } else {

            $stmt = $con->prepare("INSERT INTO  jobtype(name) VALUES(:name)");
            $stmt->execute(array('name' => $name));
            $response['code'] = '1';
            $response['msg'] = _Success;
        }


    } elseif ($_POST['action'] == 'del') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        if (checkItem("id", "jobtype", $id) > 0) {
            $stmt = $con->prepare("DELETE FROM jobtype WHERE  id = :kid");
            $stmt->bindParam("kid", $id);
            $stmt->execute();

            $response['code'] = '1';
            $response['msg'] = _Success;
        } else {

            $response['code'] = '0';
            $response['msg'] = _NotExist;

        }
    } elseif ($_POST['action'] == 'update') {

        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $name = isset($_POST['name']) ? mysql_escape_mimic($_POST['name']) : "";
        if (checkItem("name", "jobtype", $name) > 0) {
            $response['code'] = '0';
            $response['msg'] = _Exist;

        } else {


            $stmt = $con->prepare("UPDATE jobtype SET name = ? where id =? ");
            $stmt->execute(array($name, $id));

            $response['code'] = '1';
            $response['msg'] = _Success;

        }

    }
} else {
    $response['code'] = '-30';
    $response['msg'] =  _NotAuthorized;
}
header('Content-Type: application/json');
echo json_encode($response);