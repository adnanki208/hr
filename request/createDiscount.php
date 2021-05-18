<?php

include "init.php";
$response=[];
if(checkHash()) {
if ($_POST['action'] == 'add'){
    $min = isset($_POST['min']) ? mysql_escape_mimic($_POST['min']) : "";
    $discount = isset($_POST['discount']) ? mysql_escape_mimic($_POST['discount']) : "";
    $value=gmdate('H:i', $min * 60);


    if (checkItem ("value","shift_rule_discount",$value) > 0){
        $response['code']='0';
        $response['msg']= _Exist;
    }else {


        $stmt = $con->prepare("INSERT INTO shift_rule_discount(value,percentage) VALUES(:zvalue,:zdiscount)");
        $stmt->execute(array('zvalue' => $value, 'zdiscount' => $discount));
        $response['code'] = '1';
        $response['msg'] = _Success;

    }

} elseif ($_POST['action'] == 'del'){
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
    if (checkItem("id","shift_rule_discount",$id) > 0 ){
        $stmt=$con->prepare("DELETE FROM shift_rule_discount WHERE  id = :kid");
        $stmt->bindParam("kid",$id);
        $stmt->execute();

        $response['code']='1';
        $response['msg']= _Success;
    }else{

        $response['code']='0';
        $response['msg']=_NotExist;

    }
}elseif ($_POST['action']=='update'){
    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
    $min = isset($_POST['min']) ? mysql_escape_mimic($_POST['min']) : "";
    $discount = isset($_POST['discount']) ? mysql_escape_mimic($_POST['discount']) : "";
    $value=gmdate('H:i', $min * 60);


    $statement = $con->prepare("SELECT * FROM shift_rule_discount WHERE  NOT id = ? AND value = ?");
    $statement->execute(array($id, $value));
    $count = $statement->rowCount();
    if ($count > 0) {
        $response['code']='0';
        $response['msg']= _Exist;

    }
    else{


        $stmt = $con->prepare("UPDATE shift_rule_discount SET value=?,percentage = ? where id =? ");
        $stmt->execute(array($value,$discount, $id));

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