<?php

include "init.php";
$response=[];
if(checkHash()) {
if ($_POST['action'] == 'search'){
    $employeeId = isset($_POST['employeeId']) ? mysql_escape_mimic($_POST['employeeId']) : "";
    $date = isset($_POST['date']) ? mysql_escape_mimic($_POST['date']) : "";

    $stmt = $con->prepare("SELECT salary,totalHours FROM  employee where id =? ");
    $stmt->execute(array($employeeId));
    $data=$stmt->fetch();
    $salary=$data['salary'];
    $totalHours=$data['totalHours'];
    $selectedDate = new DateTime($date);
    $return_DateYear = $selectedDate ->format('Y');
    $return_DateMonth = $selectedDate ->format('m');



    $stmt = $con->prepare("SELECT discount FROM  alerts where employeeId =? AND YEAR(date) = ? AND MONTH(date) = ?");
    $stmt->execute(array($employeeId,$return_DateYear,$return_DateMonth));
    $warning=$stmt->fetchAll();
    $dayPrice=$salary/30;

    $discount=0;
    foreach ($warning as $war){
        if($war['discount']>0){
            $discount=$discount+(($war['discount']*$dayPrice)/100);
        }
    }

    $stmt = $con->prepare("SELECT duration FROM  employee_shift where employeeId =? AND YEAR(date) = ? AND MONTH(date) = ?");
    $stmt->execute(array($employeeId,$return_DateYear,$return_DateMonth));
    $durations=$stmt->fetchAll();
    $hourPrice=$salary/$totalHours;

    $overTime=0;
    $allHours=0;
    foreach ($durations as $duration){
        if($duration['duration']>0){
            $d=new DateTime($duration['duration']);
            $da = $d ->format('H');
            $allHours=$allHours+intval($da);
        }
    }
    if($allHours>$totalHours){
        $overTime=($allHours-$totalHours)*$hourPrice;
    }

    $response['code']='1';
    $response['data']['salary']=$salary;
    $response['data']['discount']=floor($discount);
    $response['data']['overTime']=floor($overTime);
    $response['data']['allHours']=floor($allHours);
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




}elseif ($_POST['action']=='update'){
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
    $name = isset($_POST['name']) ? mysql_escape_mimic($_POST['name']) : "";
    $groupid = isset($_POST['groupid']) ? mysql_escape_mimic($_POST['groupid']) : "";
    if ( checkItem2  ("name","skill","name",$name,"groupId",$groupid) > 0){
        $response['code']='0';
        $response['msg']='Skill  Exist ';

    }else{


        $stmt = $con->prepare("UPDATE skill SET name = ? , groupId = ? where id =? ");
        $stmt->execute(array($name,$groupid, $id));

        $response['code']='1';
        $response['msg']='Skill Updated successfully ';

    }

}
}else{
    $response['code'] = '-30';
    $response['msg'] = 'Not Authorized ';
}
header('Content-Type: application/json');
echo json_encode($response);