<?php

include "init.php";
$response=[];
if(checkHash()) {
if ($_POST['action'] == 'search'){
    $employeeId = isset($_POST['employeeId']) ? mysql_escape_mimic($_POST['employeeId']) : "";
    $date = isset($_POST['date']) ? mysql_escape_mimic($_POST['date']) : "";

    $stmt = $con->prepare("SELECT totalHours FROM  employee where id =? ");
    $stmt->execute(array($employeeId));
    $data=$stmt->fetch();
    $totalHours=$data['totalHours'];
    $selectedDate = new DateTime($date);
    $return_DateYear = $selectedDate ->format('Y');
    $return_DateMonth = $selectedDate ->format('m');


    $stmt = $con->prepare("SELECT duration FROM  employee_shift where employeeId =? AND YEAR(date) = ? AND MONTH(date) = ?");
    $stmt->execute(array($employeeId,$return_DateYear,$return_DateMonth));
    $durations=$stmt->fetchAll();

    $allHours=0;
    foreach ($durations as $duration){
        if($duration['duration']>0){
            $d=new DateTime($duration['duration']);
            $da = $d ->format('H');
            $allHours=$allHours+intval($da);
        }
    }
    if($allHours >= $totalHours){
        $percent = 5;
    }else {
        $percent = ((intval($totalHours)-intval($allHours)) / intval($totalHours)) * 100;
        $percent=100-$percent;
        $percent=($percent/100)*5;
        $percent= number_format($percent, 1, '.', '');
    }

    $response['code']='1';

    $response['data']['attendance']=$percent;
        $response['msg']= _Success;


} elseif ($_POST['action'] == 'add'){
    $employeeId = isset($_POST['employeeId']) ? mysql_escape_mimic($_POST['employeeId']) : "";
    $attendance = isset($_POST['attendance']) ? mysql_escape_mimic($_POST['attendance']) : "";
    $punctuality = isset($_POST['punctuality']) ? mysql_escape_mimic($_POST['punctuality']) : "";
    $communication = isset($_POST['communication']) ? mysql_escape_mimic($_POST['communication']) : "";
    $dress = isset($_POST['dress']) ? mysql_escape_mimic($_POST['dress']) : "";
    $productivity = isset($_POST['productivity']) ? mysql_escape_mimic($_POST['productivity']) : "";
    $total = isset($_POST['total']) ? mysql_escape_mimic($_POST['total']) : "";
    $date = isset($_POST['date']) ? mysql_escape_mimic($_POST['date']) : "";
    $selectedDate = new DateTime($date);
    $return_Date= $selectedDate ->format('Y-m-d');
    $return_DateYear = $selectedDate ->format('Y');
    $return_DateMonth = $selectedDate ->format('m');

        $stmt=$con->prepare("SELECT * FROM evaluate WHERE employeeId=? AND YEAR(date) = ? AND MONTH(date) = ?");
        $stmt->execute(array($employeeId,$return_DateYear,$return_DateMonth));
        $count=$stmt->rowCount();
        if($count>0){
            $response['code']='-1';
            $response['msg']=_AlreadyEvaluated;
        }else{
            $stmt=$con->prepare("INSERT INTO  evaluate (employeeId,attendance,punctuality,communication,dress,productivity,total,date ) VALUES(:employeeId,:attendance,:punctuality,:communication,:dress,:productivity,:total,:date)");
            $stmt->execute(array('employeeId' => $employeeId,'attendance' => $attendance,'punctuality' => $punctuality,'communication' => $communication,'dress' => $dress,'productivity' => $productivity,'total' => $total,'date' => $return_Date ));
            $response['code']='1';
            $response['msg']=_Success;
        }




}elseif ($_POST['action']=='update'){
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
    $name = isset($_POST['name']) ? mysql_escape_mimic($_POST['name']) : "";
    $groupid = isset($_POST['groupid']) ? mysql_escape_mimic($_POST['groupid']) : "";
    if ( checkItem2  ("name","skill","name",$name,"groupId",$groupid) > 0){
        $response['code']='0';
        $response['msg']=_Exist;

    }else{


        $stmt = $con->prepare("UPDATE skill SET name = ? , groupId = ? where id =? ");
        $stmt->execute(array($name,$groupid, $id));

        $response['code']='1';
        $response['msg']=_Success;

    }

}
}else{
    $response['code'] = '-30';
    $response['msg'] =  _NotAuthorized;
}
header('Content-Type: application/json');
echo json_encode($response);