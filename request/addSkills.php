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
    $name = $_POST['name'];
    $id=$_POST['id'];

    if (checkItem2  ("name","skill","name",$name,"groupId",$id) > 0){
        $response['code']='0';
        $response['msg']='Skill inserted already ';
    }else{

        $stmt=$con->prepare("INSERT INTO  skill(name,groupId) VALUES(:zname,:zid)");
        $stmt->execute(array('zname' => $name, 'zid'=>$id));
        $response['code']='1';
        $response['msg']='Skill inserted successfully ';
    }


} elseif ($_POST['action'] == 'del'){
    $id=$_POST['id'];
    if (checkItem("id","skill",$id) > 0 ){
        $stmt=$con->prepare("DELETE FROM skill WHERE  id = :kid");
        $stmt->bindParam("kid",$id);
        $stmt->execute();

        $response['code']='1';
        $response['msg']='Skill Deleted successfully ';
    }else{

        $response['code']='0';
        $response['msg']='Skill Not exist ';

    }
}elseif ($_POST['action']=='update'){

    $name = $_POST['name'];
    $id = $_POST['id'];
    $groupid=$_POST['groupid'];
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
header('Content-Type: application/json');
echo json_encode($response);