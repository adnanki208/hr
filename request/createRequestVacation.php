<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/16/2021
 * Time: 4:49 PM
 */
include "init.php";
$response=[];

if ($_POST['action'] == 'add'){
//FFF
    $vacationDate = isset($_POST['vacationDate']) ? mysql_escape_mimic($_POST['vacationDate']) : "";
    $vacationType = isset($_POST['vacationType']) ? mysql_escape_mimic($_POST['vacationType']) : "";
    $vacationDescription = isset($_POST['vacationDescription']) ? mysql_escape_mimic($_POST['vacationDescription']) : "";

    if($vacationType == 1){
    $stmt=$con->prepare("SELECT * FROM leave_request WHERE employeeId =? AND type = 1 AND  (state = 0 OR state = 1)");
    //execute yhe statement
    $stmt->execute(array($_SESSION['user']['id']));
    $count=$stmt->rowCount();

    if($count >= $_SESSION['user']['holyday']){
        $response['code']='-2';
        $response['msg']='You Don\'t have Vacation Credit  ';
    }else {

        if(checkItem2("id","leave_request",'employeeId',$_SESSION['user']['id'],'date',$vacationDate) > 0){$response['code']='0';
            $response['msg']='Vacation inserted already ';}
            else{
                $stmt=$con->prepare("INSERT INTO  leave_request(employeeId,date,description,type,state) VALUES(:zemployeeId,:zdate,:zdescription,:ztype,0)");
                $stmt->execute(array('zemployeeId' => $_SESSION['user']['id'],'zdate' => $vacationDate,'zdescription' => $vacationDescription,'ztype' =>$vacationType));
                $response['code']='1';
                $response['msg']='Vacation inserted successfully ';
            }

    }

    }elseif ($vacationType == 2){
        $stmt=$con->prepare("SELECT * FROM leave_request WHERE employeeId =? AND date LIKE '2022%' AND type = 2 AND (state = 0 OR state = 1)");
        //execute yhe statement
        $stmt->execute(array($_SESSION['user']['id']));
        $count=$stmt->rowCount();

        if($count >= $_SESSION['user']['sike']){
            $response['code']='-2';
            $response['msg']='You Don\'t have Vacation Credit  ';
        }else{
            if(checkItem2("id","leave_request",'employeeId',$_SESSION['user']['id'],'date',$vacationDate) > 0){$response['code']='0';
                $response['msg']='Vacation inserted already ';}
            else{
                $stmt=$con->prepare("INSERT INTO  leave_request(employeeId,date,description,type,state) VALUES(:zemployeeId,:zdate,:zdescription,:ztype,0)");
                $stmt->execute(array('zemployeeId' => $_SESSION['user']['id'],'zdate' => $vacationDate,'zdescription' => $vacationDescription,'ztype' =>$vacationType));
                $response['code']='1';
                $response['msg']='Vacation inserted successfully ';
            }
        }
    }elseif ($vacationType == 3){

        if(checkItem2("id","leave_request",'employeeId',$_SESSION['user']['id'],'date',$vacationDate) > 0){
            $response['code']='0';
            $response['msg']='Vacation inserted already ';
        }
        else{
            $stmt=$con->prepare("INSERT INTO  leave_request(employeeId,date,description,type,state) VALUES(:zemployeeId,:zdate,:zdescription,:ztype,0)");
            $stmt->execute(array('zemployeeId' => $_SESSION['user']['id'],'zdate' => $vacationDate,'zdescription' => $vacationDescription,'ztype' =>$vacationType));
            $response['code']='1';
            $response['msg']='Vacation inserted successfully ';
        }
    }



} elseif ($_POST['action'] == 'del'){
    $id=$_POST['id'];
    if (checkItem("id","skill_group",$id) > 0 ){
        $stmt=$con->prepare("DELETE FROM skill_group WHERE  id = :kid");
        $stmt->bindParam("kid",$id);
        $stmt->execute();

        $response['code']='1';
        $response['msg']='Skill Deleted successfully ';
    }else{

        $response['code']='0';
        $response['msg']='Skill Not exist ';

    }
}elseif($_POST['action']=='reject'){
    $id = $_POST['id'];
    $stmt = $con->prepare("UPDATE leave_request SET acceptedId = ? , acceptedDate=now(),state = ? where id =? ");
    $stmt->execute(array($_SESSION['user']['id'],2, $id));

    $response['code']='1';
    $response['msg']='Vacation Rejected successfully ';

}elseif($_POST['action']=='approve'){
    $id = $_POST['id'];
    $stmt = $con->prepare("UPDATE leave_request SET acceptedId = ? , acceptedDate=now(),state = ? where id =? ");
    $stmt->execute(array($_SESSION['user']['id'],1, $id));

    $response['code']='1';
    $response['msg']='Vacation Approved successfully ';

}
header('Content-Type: application/json');
echo json_encode($response);