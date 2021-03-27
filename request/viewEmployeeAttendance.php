<?php
include "init.php";
$response = [];
if (checkHash()) {


    $stmt = $con->prepare("SELECT * , employee_shift.holyday as holydayState, employee.userName as user,employee.first as first ,employee.last as last  FROM employee_shift  inner join employee on employee_shift.employeeID=employee.id ");
//execute yhe statement
    $stmt->execute(array());
//Assign To Variable
    $rows = $stmt->fetchAll();
//exit;
    $response['code'] = '1';
    $response['msg'] = 'Success';
    $response['data'] = $rows;
} else {
    $response['code'] = '-30';
    $response['msg'] = 'Not Authorized ';
}
header('Content-Type: application/json');
echo json_encode($response);
