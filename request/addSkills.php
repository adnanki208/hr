<?php

include "init.php";
$response = [];
if (checkHash()) {
    if ($_POST['action'] == 'add') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $name = isset($_POST['name']) ? mysql_escape_mimic($_POST['name']) : "";
        if (checkItem2("name", "skill", "name", $name, "groupId", $id) > 0) {
            $response['code'] = '0';
            $response['msg'] = 'Skill inserted already ';
        } else {

            $stmt = $con->prepare("INSERT INTO  skill(name,groupId) VALUES(:zname,:zid)");
            $stmt->execute(array('zname' => $name, 'zid' => $id));
            $response['code'] = '1';
            $response['msg'] = 'Skill inserted successfully ';
        }


    } elseif ($_POST['action'] == 'del') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        if (checkItem("id", "skill", $id) > 0) {
            $stmt = $con->prepare("DELETE FROM skill WHERE  id = :kid");
            $stmt->bindParam("kid", $id);
            $stmt->execute();

            $response['code'] = '1';
            $response['msg'] = 'Skill Deleted successfully ';
        } else {

            $response['code'] = '0';
            $response['msg'] = 'Skill Not exist ';

        }
    } elseif ($_POST['action'] == 'update') {

        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $name = isset($_POST['name']) ? mysql_escape_mimic($_POST['name']) : "";
        $groupId = isset($_POST['groupid']) ? mysql_escape_mimic($_POST['groupid']) : "";
        if (checkItem2("name", "skill", "name", $name, "groupId", $groupId) > 0) {
            $response['code'] = '0';
            $response['msg'] = 'Skill  Exist ';

        } else {


            $stmt = $con->prepare("UPDATE skill SET name = ? , groupId = ? where id =? ");
            $stmt->execute(array($name, $groupId, $id));

            $response['code'] = '1';
            $response['msg'] = 'Skill Updated successfully ';

        }

    }
} else {
    $response['code'] = '-30';
    $response['msg'] = 'Not Authorized ';
}
header('Content-Type: application/json');
echo json_encode($response);