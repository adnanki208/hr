<?php

include "init.php";
$response = [];
if (checkHash()) {
    if ($_POST['action'] == 'add') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $name = isset($_POST['name']) ? mysql_escape_mimic($_POST['name']) : "";
        if (checkItem2("name", "skill", "name", $name, "groupId", $id) > 0) {
            $response['code'] = '0';
            $response['msg'] = _SkillInsertedAlready;
        } else {

            $stmt = $con->prepare("INSERT INTO  skill(name,groupId) VALUES(:zname,:zid)");
            $stmt->execute(array('zname' => $name, 'zid' => $id));
            $response['code'] = '1';
            $response['msg'] = _Success;
        }


    } elseif ($_POST['action'] == 'del') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        if (checkItem("id", "skill", $id) > 0) {
            $stmt = $con->prepare("DELETE FROM skill WHERE  id = :kid");
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
        $groupId = isset($_POST['groupid']) ? mysql_escape_mimic($_POST['groupid']) : "";
        if (checkItem2("name", "skill", "name", $name, "groupId", $groupId) > 0) {
            $response['code'] = '0';
            $response['msg'] = _Exist;

        } else {


            $stmt = $con->prepare("UPDATE skill SET name = ? , groupId = ? where id =? ");
            $stmt->execute(array($name, $groupId, $id));

            $response['code'] = '1';
            $response['msg'] = _Success;

        }

    }
} else {
    $response['code'] = '-30';
    $response['msg'] = _NotAttended;
}
header('Content-Type: application/json');
echo json_encode($response);