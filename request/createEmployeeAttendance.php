<?php
include "init.php";
$response = [];
if (checkHash()) {
    if ($_POST['action'] == 'login') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $time = isset($_POST['time']) ? mysql_escape_mimic($_POST['time']) : "";
        $now = isset($_POST['date']) ? mysql_escape_mimic($_POST['date']) : "";


        if (checkItem2('id', 'employee_shift', 'employeeId', $id, 'date', $now) > 0) {
            $response['code'] = '2';
            $response['msg'] = _EmployeeAlreadyChekIn;
        } else {
            $stmt = $con->prepare("SELECT  start FROM shift_rule_time where id = ?");
            //execute yhe statement
            $stmt->execute(array($_SESSION['user']['shiftId']));
            //Assign To Variable
            $rows = $stmt->fetch();
            $startTime = $rows['start'];
            if ($startTime < $time) {
                $start_t = new DateTime($time);
                $current_t = new DateTime($startTime);
                $difference = $start_t->diff($current_t);


                $return_time = $difference->format('%H:%I:%S');


                $stmt = $con->prepare("SELECT * FROM `shift_rule_discount` WHERE CAST(value as time) <= ? ORDER BY `shift_rule_discount`.`value` DESC ");
                //execute yhe statement
                $stmt->execute(array($return_time));
                //Assign To Variable
                $rows = $stmt->fetchAll();
                $return_time = new DateTime($return_time);
                $min = $return_time->format('i');
                $hour = $return_time->format('H');
                $return_time = intval($hour) * 60 + intval($min);
                if (isset($rows[0]['percentage'])) {
                    $title = "Late Alert";
                    $alertBody = "You Late About " . $return_time . "Min And You Get Discount " . $rows[0]['percentage'] . "%";
                    $discount = $rows[0]['percentage'];

                    $stmt = $con->prepare("INSERT INTO  alerts(employeeId,type,description,discount,date,state) VALUES(:zemployeeId,:ztype,:zdescription,:zdiscount,now(),:zstate)");
                    $stmt->execute(array('zemployeeId' => $id, 'ztype' => $title, 'zdescription' => $alertBody, 'zdiscount' => $discount, 'zstate' => '0'));
                }
                $stmt = $con->prepare("INSERT INTO  employee_shift(employeeId,start,date,vacation) VALUES(:id,:start,:date,4)");
                $stmt->execute(array('id' => $id, 'start' => $time, 'date' => $now));
                $response['code'] = '1';
                $response['msg'] = _Success;


            } else {

                $stmt = $con->prepare("INSERT INTO  employee_shift(employeeId,start,date,vacation) VALUES(:id,:start,:date,4)");
                $stmt->execute(array('id' => $id, 'start' => $time, 'date' => $now));
                $response['code'] = '1';
                $response['msg'] = _Success;
            }


        }


    } elseif ($_POST['action'] == 'logout') {
        $now = isset($_POST['date2']) ? mysql_escape_mimic($_POST['date2']) : "";
        $id2 = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $time2 = isset($_POST['time']) ? mysql_escape_mimic($_POST['time']) : "";

        if (checkItem3('id', 'employee_shift', 'employeeId', $id2, 'date', $now, 'vacation', '4') > 0) {
            $statement = $con->prepare("SELECT * FROM employee_shift WHERE  employeeId = ? AND date= ? AND end IS null ");
            $statement->execute(array($id2, $now));
            $count = $statement->rowCount();

            if ($count == 0) {
                $response['code'] = '2';
                $response['msg'] = _EmployeeAlreadyChekOut;
            } else {
                $stmt = $con->prepare("SELECT id,start FROM employee_shift where date = ? and employeeId=?");
                //execute yhe statement
                $stmt->execute(array($now, $id2));
                //Assign To Variable
                $rows = $stmt->fetch();
                $id = $rows['id'];
                $start = $rows['start'];
                if ($start > $time2) {
                    $response['code'] = '-10';
                    $response['msg'] = _CheckOutIsEarlierThanCheckIn;
                } else {
                    $start_t = new DateTime($start);
                    $current_t = new DateTime($time2);
                    $difference = $start_t->diff($current_t);
                    $return_time = $difference->format('%H:%I:%S');

                    $stmt = $con->prepare("SELECT  end FROM shift_rule_time where id = ?");
                    //execute yhe statement
                    $stmt->execute(array($_SESSION['user']['shiftId']));
                    //Assign To Variable
                    $rows = $stmt->fetch();
                    $endShiftTime = $rows['end'];
                    if ($time2 < $endShiftTime) {
                        $end_t = new DateTime($time2);
                        $endShiftTime = new DateTime($endShiftTime);
                        $earlyTimeDifference = $endShiftTime->diff($end_t);
                        $earlyTime = $earlyTimeDifference->format('%H:%I:%S');

                        $stmt = $con->prepare("SELECT * FROM `shift_rule_discount` WHERE CAST(value as time) <= ? ORDER BY `shift_rule_discount`.`value` DESC ");
                        //execute yhe statement
                        $stmt->execute(array($earlyTime));
                        //Assign To Variable
                        $rows = $stmt->fetchAll();

                        $earlyTime = new DateTime($earlyTime);
                        $min = $earlyTime->format('i');
                        $hour = $earlyTime->format('H');
                        $earlyTimeMin = intval($hour) * 60 + intval($min);


//                    var_dump($rows[0]['percentage']);
//                    exit();
                        if (isset($rows[0]['percentage'])) {

                            $title = "Early Leave Alert";
                            $alertBody = "You Early Leave About " . $earlyTimeMin . "Min And You Get Discount " . $rows[0]['percentage'] . "%";
                            $discount = $rows[0]['percentage'];
                            $stmt = $con->prepare("INSERT INTO  alerts(employeeId,type,description,discount,date,state) VALUES(:zemployeeId,:ztype,:zdescription,:zdiscount,now(),:zstate)");
                            $stmt->execute(array('zemployeeId' => $id2, 'ztype' => $title, 'zdescription' => $alertBody, 'zdiscount' => $discount, 'zstate' => '0'));
                        }
                        $stmt = $con->prepare("UPDATE employee_shift SET end = ? , duration = ? where employeeId =? and date = ? and id = ? ");
                        $stmt->execute(array($time2, $return_time, $id2, $now, $id));
                        $response['code'] = '1';
                        $response['msg'] = _Success;

                    } else {
                        $stmt = $con->prepare("UPDATE employee_shift SET end = ? , duration = ? where employeeId =? and date = ? and id = ? ");
                        $stmt->execute(array($time2, $return_time, $id2, $now, $id));
                        $response['code'] = '1';
                        $response['msg'] = _Success;
                    }


                }
            }
        } else {
            $response['code'] = '2';
            $response['msg'] = _PleaseCheckInFirst;
        }
    } elseif ($_POST['action'] == 'vacation') {
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $now = isset($_POST['date3']) ? mysql_escape_mimic($_POST['date3']) : "";

        if (checkItem2('id', 'employee_shift', 'employeeId', $id, 'date', $now) > 0) {
            $response['code'] = '2';
            $response['msg'] = _EmployeeAlreadyTakeAction;
        } else {
            $stmt = $con->prepare("INSERT INTO  employee_shift(employeeId,start,end,duration,date,vacation) VALUES(:id,:start,:end,:duration,:date,5)");
            $stmt->execute(array('id' => $id, 'start' => 0, 'end' => 0, 'duration' => 0, 'date' => $now));
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