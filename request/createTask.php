<?php

include "init.php";
$response=[];
if(checkHash()) {
if ($_POST['action'] == 'add'){
    $employee = isset($_POST['employee']) ? mysql_escape_mimic($_POST['employee']) : "";
    $description = isset($_POST['description']) ? mysql_escape_mimic($_POST['description']) : "";
foreach ($employee as $e) {
    $stmt = $con->prepare("INSERT INTO  task(employee,creator,checker,description) VALUES(:employee,:creator,:checker,:description)");
    $stmt->execute(array('employee' => $e, 'creator' => $_SESSION['user']['id'], 'checker' => $_SESSION['user']['id'], 'description' => $description));

}
        $response['code']='1';
        $response['msg']= _Success;


} elseif ($_POST['action'] == 'del'){
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
    if (checkItem("id","task",$id) > 0 ){
        $stmt=$con->prepare("DELETE FROM task WHERE  id = :kid");
        $stmt->bindParam("kid",$id);
        $stmt->execute();

        $response['code']='1';
        $response['msg']= _Success;
    }else{

        $response['code']='0';
        $response['msg']=_NotExist;

    }
}elseif ($_POST['action']=='finish'){
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";

    if ( checkItem('id','task',$id) == 0){
        $response['code']='0';
        $response['msg']=_NotExist;

    }else{


        $stmt = $con->prepare("UPDATE task SET endDate = now() , state = 2 where id =? ");
        $stmt->execute(array($id));

        $response['code']='1';
        $response['msg']=_Success;

    }

}elseif ($_POST['action']=='approve'){
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";

    if ( checkItem('id','task',$id) == 0){
        $response['code']='0';
        $response['msg']=_NotExist;

    }else{


        $stmt = $con->prepare("UPDATE task SET checker = ? , state = 3 where id =? ");
        $stmt->execute(array($_SESSION['user']['id'],$id));

        $response['code']='1';
        $response['msg']=_Success;

    }

}elseif ($_POST['action']=='reject'){
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";

    if ( checkItem('id','task',$id) == 0){
        $response['code']='0';
        $response['msg']=_NotExist;

    }else{


        $stmt = $con->prepare("UPDATE task SET endDate = NULL ,checker = ?, state = 4 where id =? ");
        $stmt->execute(array($_SESSION['user']['id'],$id));

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