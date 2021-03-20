<?php
include "init.php";
$response = [];
if ($_POST['action'] == 'add') {
    if (!file_exists('../uploads')) {
        mkdir('../uploads/img', 0777, true);
        mkdir('../uploads/document', 0777, true);
    }

    $userName = isset($_POST['userName']) ? mysql_escape_mimic($_POST['userName']) : "";
    $password = isset($_POST['password']) ? mysql_escape_mimic($_POST['password']) : "";
    $roleId = isset($_POST['roleId']) ? mysql_escape_mimic($_POST['roleId']) : "";
    $departmintId = isset($_POST['departmintId']) ? mysql_escape_mimic($_POST['departmintId']) : "";
    $jobTypeId = isset($_POST['jobTypeId']) ? mysql_escape_mimic($_POST['jobTypeId']) : "";
    $first = isset($_POST['first']) ? mysql_escape_mimic($_POST['first']) : "";
    $last = isset($_POST['last']) ? mysql_escape_mimic($_POST['last']) : "";
    $father = isset($_POST['father']) ? mysql_escape_mimic($_POST['father']) : "";
    $mather = isset($_POST['mather']) ? mysql_escape_mimic($_POST['mather']) : "";
    $experience = isset($_POST['experience']) ? mysql_escape_mimic($_POST['experience']) : "";
    $gander = isset($_POST['gander']) ? mysql_escape_mimic($_POST['gander']) : "";
    $mobile = isset($_POST['mobile']) ? mysql_escape_mimic($_POST['mobile']) : "";
    $phone = isset($_POST['phone']) ? mysql_escape_mimic($_POST['phone']) : "";
    $cophone = isset($_POST['cophone']) ? mysql_escape_mimic($_POST['cophone']) : "";
    $email = isset($_POST['email']) ? mysql_escape_mimic($_POST['email']) : "";
    $address = isset($_POST['address']) ? mysql_escape_mimic($_POST['address']) : "";
    $education = isset($_POST['education']) ? mysql_escape_mimic($_POST['education']) : "";
    $salary = isset($_POST['salary']) ? mysql_escape_mimic($_POST['salary']) : "";
    $upperId = isset($_POST['upperId']) ? mysql_escape_mimic($_POST['upperId']) : "";
    $holyday = isset($_POST['holyday']) ? mysql_escape_mimic($_POST['holyday']) : "";
    $sike = isset($_POST['sike']) ? mysql_escape_mimic($_POST['sike']) : "";
    $degree = isset($_POST['degree']) ? mysql_escape_mimic($_POST['degree']) : "";
    $typeOfEdu = isset($_POST['typeOfEdu']) ? mysql_escape_mimic($_POST['typeOfEdu']) : "";
    $facelty = isset($_POST['facelty']) ? mysql_escape_mimic($_POST['facelty']) : "";
    $totalHours = isset($_POST['totalHours']) ? mysql_escape_mimic($_POST['totalHours']) : "";
    $img = isset($_FILES['img']['name']) ? $_FILES['img']['name'] : "";
    $document = isset($_FILES['document']['name']) ? $_FILES['document']['name'] : "";
    $authKey = md5($userName . $password);
//var_dump($_FILES);exit();
    $error = 0;
    if (checkItem("userName", "employee", $userName) > 0) {
        $response['code'] = '0';
        $response['msg'] = 'User Name Exist';
    } else {
        if ($img !== "") {
            $extension = explode("/", $_FILES['img']['type']);
            $img = GUID();
            if (move_uploaded_file($_FILES['img']['tmp_name'], '../uploads/img/' . $img . '.' . $extension[1]) == true) {
                resize($img, '../uploads/img/' . $img . '.' . $extension[1]);
                $img = $img . '.' . $extension[1];
            } else {
                $img = '';
                $error = 1;
            }
        }
        if ($document !== "") {
            $extension = explode("/", $_FILES['document']['type']);
            $document = GUID();
            if (move_uploaded_file($_FILES['document']['tmp_name'], '../uploads/document/' . $document . '.' . $extension[1]) == false) {
                $document = '';
                $error = 1;
            } else {
                $document = $document . '.' . $extension[1];
            }
        }
        if ($error === 0 && $document != '') {

            $stmt = $con->prepare("INSERT INTO  employee(userName,authKey,password,roleId,departmintId,jobTypeId,first,last,father,mather,experience,gander,mobile,phone,cophone,email,address,education,salary,upperId,holyday,sike,degree,typeOfEdu,facelty,totalHours,img,document) VALUES(:userName,:authKey,:password,:roleId,:departmintId,:jobTypeId,:first,:last,:father,:mather,:experience,:gander,:mobile,:phone,:cophone,:email,:address,:education,:salary,:upperId,:holyday,:sike,:degree,:typeOfEdu,:facelty,:totalHours,:img,:document)");
            $stmt->execute(array('userName' => $userName, 'authKey' => $authKey, 'password' => $password, 'roleId' => $roleId, 'departmintId' => $departmintId, 'jobTypeId' => $jobTypeId, 'first' => $first, 'last' => $last, 'father' => $father, 'mather' => $mather, 'experience' => $experience, 'gander' => $gander, 'mobile' => $mobile, 'phone' => $phone, 'cophone' => $cophone, 'email' => $email, 'address' => $address, 'education' => $education, 'salary' => $salary, 'upperId' => $upperId, 'holyday' => $holyday, 'sike' => $sike, 'degree' => $degree, 'typeOfEdu' => $typeOfEdu, 'facelty' => $facelty, 'totalHours' => $totalHours, 'img' => $img, 'document' => $document));
            $response['code'] = '1';
            $response['msg'] = 'successful';
        } else {
            $response['code'] = '-10';
            $response['msg'] = 'Upload Error';
        }
    }


} elseif ($_POST['action'] == 'change') {

    $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
    $state = isset($_POST['state']) ? mysql_escape_mimic($_POST['state']) : "";
    $state==='1'?$state='0':$state='1';
//  var_dump($state,$id);
//  exit();
    $stmt = $con->prepare("UPDATE employee SET state = ? WHERE  id =? ");
    $stmt->execute(array($state,$id));

        $response['code'] = '1';
        $response['msg'] = 'success';

}
header('Content-Type: application/json');
echo json_encode($response);