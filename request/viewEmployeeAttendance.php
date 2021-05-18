<?php
include "init.php";
$response = [];
if (checkHash()) {


    $stmt = $con->prepare("SELECT * , employee_shift.vacation as vacationState, employee.userName as user,employee.first as first ,employee.last as last  FROM employee_shift  inner join employee on employee_shift.employeeID=employee.id ");
//execute yhe statement
    $stmt->execute(array());
//Assign To Variable
    $rows = $stmt->fetchAll();
//exit;
    $response['code'] = '1';
    $response['msg'] = _Success;
    $response['data'] = $rows;
} else {
    $response['code'] = '-30';
    $response['msg'] =  _NotAuthorized;
}
header('Content-Type: application/json');
echo json_encode($response);
