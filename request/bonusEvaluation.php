<?php
include "init.php";
$response = [];
if (checkHash()) {
    if (isset($_POST['action']) && $_POST['action'] == 'view') {
        $stmt = $con->prepare("SELECT * From evaluate_bonus;");

//execute yhe statement
        $stmt->execute();
//Assign To Variable
        $rows = $stmt->fetchAll();
//var_dump($rows);
//exit();
        $response['code'] = '1';
        $response['msg'] = 'Success';
        $response['data'] = $rows;
    } elseif ($_POST['action'] == 'add') {
        $rate = isset($_POST['rate']) ? mysql_escape_mimic($_POST['rate']) : "";
        $percent = isset($_POST['percent']) ? mysql_escape_mimic($_POST['percent']) : "";
        if (checkItem("rate", "evaluate_bonus", $rate) == 0) {
            $stmt = $con->prepare("INSERT INTO  evaluate_bonus(rate,percent) VALUES(:rate,:percent)");
            $stmt->execute(array('rate' => $rate, 'percent' => $percent));
            $response['code'] = '1';
            $response['msg'] = 'Success';
        }else{
            $response['code'] = '-1';
            $response['msg'] = 'Already Exist';
        }

    } elseif ($_POST['action'] == 'del') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        if (checkItem("id", "evaluate_bonus", $id) > 0) {
            $stmt = $con->prepare("DELETE FROM evaluate_bonus WHERE  id = :kid");
            $stmt->bindParam("kid", $id);
            $stmt->execute();

            $response['code'] = '1';
            $response['msg'] = 'Success';
        } else {

            $response['code'] = '0';
            $response['msg'] = 'Not exist ';

        }
    }
} else {
    $response['code'] = '-30';
    $response['msg'] = 'Not Authorized ';
}
header('Content-Type: application/json');
echo json_encode($response);