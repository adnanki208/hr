<?php
include "init.php";
$response = [];
if(checkHash()) {
    if ($_POST['action'] == 'login') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $time = isset($_POST['time']) ? mysql_escape_mimic($_POST['time']) : "";
        $now=date('Y-m-d');


        if(checkItem2('id','employee_shift','employeeId',$id,'date',$now)>0){
            $response['code'] = '2';
            $response['msg'] = 'Employee Already Loged In ';
        }else{
            $stmt = $con->prepare("INSERT INTO  employee_shift(employeeId,start,date,holyday) VALUES(:id,:start,:date,4)");
            $stmt->execute(array('id' => $id, 'start' => $time,'date'=>$now));
            $response['code'] = '1';
            $response['msg'] = 'Employee checkIn Successfully ';
        }




    }elseif ($_POST['action'] == 'logout') {
        $now=date('Y-m-d');
        $id2 = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $time2 = isset($_POST['time']) ? mysql_escape_mimic($_POST['time']) : "";

        if(checkItem2('id','employee_shift','employeeId',$id2,'date',$now)>0){

            $stmt=$con->prepare("SELECT id,start FROM employee_shift where date = ? and employeeId=?");
            //execute yhe statement
            $stmt->execute(array($now,$id2));
            //Assign To Variable
            $rows=$stmt->fetch();
            $id=$rows['id'];
            $start=$rows['start'];

            $start_t = new DateTime($start);
            $current_t = new DateTime($time2);
            $difference = $start_t ->diff($current_t );
            $return_time = $difference ->format('%H:%I:%S');

            $stmt = $con->prepare("UPDATE employee_shift SET end = ? , duration = ? where employeeId =? and date = ? and id = ? ");
            $stmt->execute(array($time2,$return_time,$id2,$now,$id));

            $response['code']='1';
            $response['msg']='Employee checkOut Successfully ';
        }else{
            $response['code'] = '2';
            $response['msg'] = 'Please CheckIn First ';
        }
    }
}else{
    $response['code'] = '-30';
    $response['msg'] = 'Not Authorized ';
}
header('Content-Type: application/json');
echo json_encode($response);