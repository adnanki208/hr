<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/16/2021
 * Time: 4:49 PM
 */
include "init.php";
$response=[];
if(checkHash()) {
if ($_POST['action'] == 'add'){
    $name = isset($_POST['name']) ? mysql_escape_mimic($_POST['name']) : "";
if (checkItem("name","skill_group",$name) > 0 ){
    $response['code']='0';
    $response['msg']=_Exist;
}else{

    $stmt=$con->prepare("INSERT INTO  skill_group(name) VALUES(:zname)");
    $stmt->execute(array('zname' => $name,));
    $response['code']='1';
    $response['msg']= _Success;


}


} elseif ($_POST['action'] == 'del'){
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
    if (checkItem("id","skill_group",$id) > 0 ){
        $stmt=$con->prepare("DELETE FROM skill_group WHERE  id = :kid");
        $stmt->bindParam("kid",$id);
        $stmt->execute();

        $response['code']='1';
        $response['msg']=_Success;
    }else{

        $response['code']='0';
        $response['msg']=_NotExist;

    }
}elseif ($_POST['action']=='update'){

    $name = isset($_POST['name']) ? mysql_escape_mimic($_POST['name']) : "";
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
    if (checkItem("name","skill_group",$name) > 0){
        $response['code']='0';
        $response['msg']=_Exist;

    }else{
        $stmt = $con->prepare("UPDATE skill_group SET name = ? where id =? ");
        $stmt->execute(array($name, $id));

        $response['code']='1';
        $response['msg']= _Success;

    }

}
}else{
    $response['code'] = '-30';
    $response['msg'] =  _NotAuthorized;
}
header('Content-Type: application/json');
echo json_encode($response);