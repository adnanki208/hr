<?php

include "init.php";
$response=[];
if(checkHash()) {
if ($_POST['action'] == 'search'){
    $employeeId = isset($_POST['employeeId']) ? mysql_escape_mimic($_POST['employeeId']) : "";
    $date = isset($_POST['date']) ? mysql_escape_mimic($_POST['date']) : "";

    $stmt = $con->prepare("SELECT salary,totalHours,shiftId FROM  employee where id =? ");
    $stmt->execute(array($employeeId));
    $data=$stmt->fetch();
    $salary=$data['salary'];
    $totalHours=$data['totalHours'];
    $shiftId=$data['shiftId'];
    $selectedDate = new DateTime($date);
    $return_DateYear = $selectedDate ->format('Y');
    $return_DateMonth = $selectedDate ->format('m');
    $stmt = $con->prepare("SELECT * FROM  shift_rule_time where id =? ");
    $stmt->execute(array($shiftId));
    $shiftData=$stmt->fetch();
    $startShift=new  DateTime($shiftData['start']);
    $endShift=new  DateTime($shiftData['end']);
    $shiftDuration=$startShift->diff($endShift);
    $shiftDuration = $shiftDuration->format('%H:%I');


    $stmt = $con->prepare("SELECT discount FROM  alerts where employeeId =? AND YEAR(date) = ? AND MONTH(date) = ?");
    $stmt->execute(array($employeeId,$return_DateYear,$return_DateMonth));
    $warning=$stmt->fetchAll();
    $dayPrice=$salary/30;
    $evaluateReward=0;
    $discount=0;
    foreach ($warning as $war){
        if($war['discount']>0){
            $discount=$discount+(($war['discount']*$dayPrice)/100);
        }
    }


    $stmt = $con->prepare("SELECT COUNT(vacation) FROM  employee_shift where employeeId =? AND YEAR(date) = ? AND MONTH(date) = ? AND (vacation = 3 OR vacation = 5)");
    $stmt->execute(array($employeeId,$return_DateYear,$return_DateMonth));
    $unJastfideCount=$stmt->fetch();

    $stmt = $con->prepare("SELECT total FROM  evaluate where employeeId =? AND YEAR(date) = ? AND MONTH(date) = ?");
    $stmt->execute(array($employeeId,$return_DateYear,$return_DateMonth));
    $reward=$stmt->fetch();
    if (!isset($reward['total'])){
        $reward['total']=0;
    }
    $stmt = $con->prepare("SELECT * FROM  evaluate_bonus WHERE rate <= ? ORDER BY `evaluate_bonus`.`rate` DESC ");
    $stmt->execute(array($reward['total']));
    $bonus=$stmt->fetch();
    if(isset($bonus['percent'])) {
        $evaluateReward = ($salary * $bonus['percent']) / 100;
    }

$stmt = $con->prepare("SELECT duration FROM  employee_shift where employeeId =? AND YEAR(date) = ? AND MONTH(date) = ?");
    $stmt->execute(array($employeeId,$return_DateYear,$return_DateMonth));
    $durations=$stmt->fetchAll();

    $hourPrice=$salary/$totalHours;

    $overTime=0;
    foreach ($durations as $duration){

        if($duration['duration']>0){
            if($shiftDuration<$duration['duration']){
                $shiftDurationTime = new DateTime($shiftDuration);
                $duration['duration'] = new DateTime($duration['duration']);
                $overTimeDuration=$duration['duration']->diff($shiftDurationTime);
                $overTimeDuration=$overTimeDuration->format('%H:%I');
                $overTimeDuration = new DateTime($overTimeDuration);
                $min = $overTimeDuration ->format('i');
                $hour = $overTimeDuration ->format('H');
                $overTime=$overTime+((intval($hour)+intval($min)/60)*$hourPrice);
            }
        }
    }
    $discount=(intval($unJastfideCount[0])*$dayPrice)+$discount;

    $response['code']='1';
    $response['data']['salary']=$salary;
    $response['data']['discount']=floor($discount);
    $response['data']['overTime']=floor($overTime);
    $response['data']['reward']=floor($evaluateReward);
        $response['msg']='successful';


} elseif ($_POST['action'] == 'add'){
    $employeeId = isset($_POST['employeeId']) ? mysql_escape_mimic($_POST['employeeId']) : "";
    $basic = isset($_POST['basic']) ? mysql_escape_mimic($_POST['basic']) : "";
    $sustenance = isset($_POST['sustenance']) ? mysql_escape_mimic($_POST['sustenance']) : "";
    $management = isset($_POST['management']) ? mysql_escape_mimic($_POST['management']) : "";
    $travel = isset($_POST['travel']) ? mysql_escape_mimic($_POST['travel']) : "";
    $overTime = isset($_POST['overTime']) ? mysql_escape_mimic($_POST['overTime']) : "";
    $advance = isset($_POST['advance']) ? mysql_escape_mimic($_POST['advance']) : "";
    $reward = isset($_POST['reward']) ? mysql_escape_mimic($_POST['reward']) : "";
    $discount = isset($_POST['discount']) ? mysql_escape_mimic($_POST['discount']) : "";
    $total = isset($_POST['total']) ? mysql_escape_mimic($_POST['total']) : "";
    $date = isset($_POST['date']) ? mysql_escape_mimic($_POST['date']) : "";
    $selectedDate = new DateTime($date);
    $return_Date= $selectedDate ->format('Y-m-d');
    $return_DateYear = $selectedDate ->format('Y');
    $return_DateMonth = $selectedDate ->format('m');

        $stmt=$con->prepare("SELECT * FROM salary WHERE employeeId=? AND YEAR(date) = ? AND MONTH(date) = ?");
        $stmt->execute(array($employeeId,$return_DateYear,$return_DateMonth));
        $count=$stmt->rowCount();
        if($count>0){
            $response['code']='-1';
            $response['msg']='Salary Already Check Out';
        }else{
            $stmt=$con->prepare("INSERT INTO  salary(employeeId,basic,sustenance,management,travel,overTime,advance,reward,discount,total,date ) VALUES(:employeeId,:basic,:sustenance,:management,:travel,:overTime,:advance,:reward,:discount,:total,:date)");
            $stmt->execute(array('employeeId' => $employeeId,'basic' => $basic,'sustenance' => $sustenance,'management' => $management,'travel' => $travel,'overTime' => $overTime,'advance' => $advance,'reward' => $reward,'discount' => $discount,'total' => $total,'date' => $return_Date ));
            $response['code']='1';
            $response['msg']='Success';
        }




}
}else{
    $response['code'] = '-30';
    $response['msg'] = 'Not Authorized ';
}
header('Content-Type: application/json');
echo json_encode($response);