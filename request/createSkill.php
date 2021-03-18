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

if (checkItem("name","skill_group",$name) > 0 ){
    $response['code']='0';
    $response['msg']='Skill inserted already ';
}else{

    $stmt=$con->prepare("INSERT INTO  skill_group(name) VALUES(:zname)");
    $stmt->execute(array('zname' => $name,));
    $response['code']='1';
    $response['msg']='Skill inserted successfully ';


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
}elseif ($_POST['action']=='update'){

    $name = $_POST['name'];
    $id = $_POST['id'];
    if ($check = checkItem("id","skill_group",$id) > 0){

        $stmt = $con->prepare("UPDATE skill_group SET name = ? where id =? ");
        $stmt->execute(array($name, $id));

        $response['code']='1';
        $response['msg']='Skill Updated successfully ';
    }else{
        $response['code']='0';
        $response['msg']='Skill Not Exist ';

    }

}
header('Content-Type: application/json');
echo json_encode($response);