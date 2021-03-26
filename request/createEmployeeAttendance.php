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
            $stmt=$con->prepare("SELECT  start FROM shift_rule_time where id = ?");
            //execute yhe statement
            $stmt->execute(array($_SESSION['user']['shiftId']));
            //Assign To Variable
            $rows=$stmt->fetch();
            $startTime=$rows['start'];
            if($startTime < $time){
                $start_t = new DateTime($time);
                $current_t = new DateTime($startTime);
                $difference = $start_t ->diff($current_t );
                $return_time = $difference ->format('%H:%I:%S');

                $stmt=$con->prepare("SELECT id, value,percentage  FROM shift_rule_discount where start=? ");
                //execute yhe statement
                $stmt->execute(array($startTime));
                //Assign To Variable
                $rows=$stmt->fetchAll();
                foreach ($rows as $row){
                    if ($return_time < $row['value']) {
                        $title="Late Alert";
                        $alertBody="You Late About " . $return_time ." And You Get Discount " .$row['percentage'] . "%";
                        $discount=$row['percentage'];
                        $stmt=$con->prepare("INSERT INTO  alerts(employeeId,type,description,discount,date,state) VALUES(:zemployeeId,:ztype,:zdescription,:zdiscount,now(),:zstate)");
                        $stmt->execute(array('zemployeeId' => $id, 'ztype'=>$title,'zdescription'=>$alertBody,'zdiscount'=>$discount,'zstate' => '0'));

                        $stmt = $con->prepare("INSERT INTO  employee_shift(employeeId,start,date,holyday) VALUES(:id,:start,:date,4)");
                        $stmt->execute(array('id' => $id, 'start' => $time,'date'=>$now));
                        $response['code'] = '1';
                        $response['msg'] = 'Employee checkIn Successfully ';
                        break;
                    }
                }
            }else{

                $stmt = $con->prepare("INSERT INTO  employee_shift(employeeId,start,date,holyday) VALUES(:id,:start,:date,4)");
                $stmt->execute(array('id' => $id, 'start' => $time,'date'=>$now));
                $response['code'] = '1';
                $response['msg'] = 'Employee checkIn Successfully ';
            }


        }




    }elseif ($_POST['action'] == 'logout') {
        $now=date('Y-m-d');
        $id2 = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $time2 = isset($_POST['time']) ? mysql_escape_mimic($_POST['time']) : "";

        if(checkItem3('id','employee_shift','employeeId',$id2,'date',$now,'holyday','4')>0){

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
    }elseif($_POST['action'] == 'vacation'){
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $now=date('Y-m-d');
        if(checkItem2('id','employee_shift','employeeId',$id,'date',$now)>0){
            $response['code'] = '2';
            $response['msg'] = 'Employee Already Added In Vacation';
        }else{
            $stmt = $con->prepare("INSERT INTO  employee_shift(employeeId,start,end,duration,date,holyday) VALUES(:id,:start,:end,:duration,:date,5)");
            $stmt->execute(array('id' => $id, 'start' => 0,'end' => 0,'duration' => 0,'date'=>$now));
            $response['code']='1';
            $response['msg']='Employee Vacation Added Successfully ';
        }
    }
}else{
    $response['code'] = '-30';
    $response['msg'] = 'Not Authorized ';
}
header('Content-Type: application/json');
echo json_encode($response);