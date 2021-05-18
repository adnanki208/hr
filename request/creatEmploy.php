<?php
include "init.php";
$response = [];
if (checkHash()) {
    if ($_POST['action'] == 'add') {
        if (!file_exists('../uploads')) {
            mkdir('../uploads/img', 0777, true);
            mkdir('../uploads/document', 0777, true);
        }

        $userName = isset($_POST['userName']) ? mysql_escape_mimic($_POST['userName']) : "";
        $password = isset($_POST['password']) ? md5(mysql_escape_mimic($_POST['password'])) : "";
        $roleId = isset($_POST['roleId']) ? mysql_escape_mimic($_POST['roleId']) : "";
        $branchId = isset($_POST['branchId']) ? mysql_escape_mimic($_POST['branchId']) : "";
        $departmintId = isset($_POST['departmintId']) ? mysql_escape_mimic($_POST['departmintId']) : "";
        $shiftId = isset($_POST['shiftId']) ? mysql_escape_mimic($_POST['shiftId']) : "";
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
        $vacation = isset($_POST['vacation']) ? mysql_escape_mimic($_POST['vacation']) : "";
        $sake = isset($_POST['sake']) ? mysql_escape_mimic($_POST['sake']) : "";
        $degree = isset($_POST['degree']) ? mysql_escape_mimic($_POST['degree']) : "";
        $typeOfEdu = isset($_POST['typeOfEdu']) ? mysql_escape_mimic($_POST['typeOfEdu']) : "";
        $facelty = isset($_POST['facelty']) ? mysql_escape_mimic($_POST['facelty']) : "";
        $totalHours = isset($_POST['totalHours']) ? mysql_escape_mimic($_POST['totalHours']) : "";
        $img = isset($_FILES['img']['name']) ? $_FILES['img']['name'] : "";
        $document = isset($_FILES['document']['name']) ? $_FILES['document']['name'] : "";
        $authKey = md5($userName);
//var_dump($_FILES);exit();
        $error = 0;
        if (checkItem("userName", "employee", $userName) > 0) {
            $response['code'] = '0';
            $response['msg'] = _UserNameExist;
        } else {
            if ($img !== "") {
                $extension = explode("/", $_FILES['img']['type']);
                $img = $userName;
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
                $document = $userName;
                if (move_uploaded_file($_FILES['document']['tmp_name'], '../uploads/document/' . $document . '.' . $extension[1]) == false) {
                    $document = '';
                    $error = 1;
                } else {
                    $document = $document . '.' . $extension[1];
                }
            }
            if ($error === 0 && $document != '') {

                $stmt = $con->prepare("INSERT INTO  employee(userName,authKey,password,branchId,shiftId,roleId,departmintId,jobTypeId,first,last,father,mather,experience,gander,mobile,phone,cophone,email,address,education,salary,upperId,vacation,sake,degree,typeOfEdu,facelty,totalHours,img,document) VALUES(:userName,:authKey,:password,:branchId,:shiftId,:roleId,:departmintId,:jobTypeId,:first,:last,:father,:mather,:experience,:gander,:mobile,:phone,:cophone,:email,:address,:education,:salary,:upperId,:vacation,:sake,:degree,:typeOfEdu,:facelty,:totalHours,:img,:document)");
                $stmt->execute(array('userName' => $userName, 'authKey' => $authKey, 'password' => $password, 'branchId' => $branchId, 'shiftId' => $shiftId, 'roleId' => $roleId, 'departmintId' => $departmintId, 'jobTypeId' => $jobTypeId, 'first' => $first, 'last' => $last, 'father' => $father, 'mather' => $mather, 'experience' => $experience, 'gander' => $gander, 'mobile' => $mobile, 'phone' => $phone, 'cophone' => $cophone, 'email' => $email, 'address' => $address, 'education' => $education, 'salary' => $salary, 'upperId' => $upperId, 'vacation' => $vacation, 'sake' => $sake, 'degree' => $degree, 'typeOfEdu' => $typeOfEdu, 'facelty' => $facelty, 'totalHours' => $totalHours, 'img' => $img, 'document' => $document));
                $response['code'] = '1';
                $response['msg'] = _Success;
            } else {
                $response['code'] = '-10';
                $response['msg'] = _UploadError;
            }
        }


    } elseif ($_POST['action'] == 'change') {

        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $state = isset($_POST['state']) ? mysql_escape_mimic($_POST['state']) : "";
        $state === '1' ? $state = '0' : $state = '1';
//  var_dump($state,$id);
//  exit();
        $stmt = $con->prepare("UPDATE employee SET state = ? WHERE  id =? ");
        $stmt->execute(array($state, $id));

        $response['code'] = '1';
        $response['msg'] = _Success;

    } elseif ($_POST['action'] == 'edit') {
        if (!file_exists('../uploads')) {
            mkdir('../uploads/img', 0777, true);
            mkdir('../uploads/document', 0777, true);
        }
        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $userName = isset($_POST['userName']) ? mysql_escape_mimic($_POST['userName']) : "";
        $roleId = isset($_POST['roleId']) ? mysql_escape_mimic($_POST['roleId']) : "";
        $branchId = isset($_POST['branchId']) ? mysql_escape_mimic($_POST['branchId']) : "";
        $departmintId = isset($_POST['departmintId']) ? mysql_escape_mimic($_POST['departmintId']) : "";
        $shiftId = isset($_POST['shift']) ? mysql_escape_mimic($_POST['shift']) : "";
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
        $vacation = isset($_POST['vacation']) ? mysql_escape_mimic($_POST['vacation']) : "";
        $sake = isset($_POST['sake']) ? mysql_escape_mimic($_POST['sake']) : "";
        $degree = isset($_POST['degree']) ? mysql_escape_mimic($_POST['degree']) : "";
        $typeOfEdu = isset($_POST['typeOfEdu']) ? mysql_escape_mimic($_POST['typeOfEdu']) : "";
        $facelty = isset($_POST['facelty']) ? mysql_escape_mimic($_POST['facelty']) : "";
        $totalHours = isset($_POST['totalHours']) ? mysql_escape_mimic($_POST['totalHours']) : "";
        $img = isset($_FILES['img']['name']) ? $_FILES['img']['name'] : "";
        $document = isset($_FILES['document']['name']) ? $_FILES['document']['name'] : "";
        $authKey = md5($userName);
//var_dump($_FILES);exit();
        $error = 0;
        $statement = $con->prepare("SELECT * FROM employee WHERE id != ? and userName= ?  ");
        $statement->execute(array($id, $userName));
        $count = $statement->rowCount();
        if ($count > 0) {
            $response['code'] = '0';
            $response['msg'] = _UserNameExist;
        } else {
            if ($img !== "") {
                $extension = explode("/", $_FILES['img']['type']);
                $img = $userName . '.' . $extension[1];
                if (move_uploaded_file($_FILES['img']['tmp_name'], '../uploads/img/' . $img) == true) {
                    resize($img, '../uploads/img/' . $img);
                } else {
                    $img = '';
                    $error = 1;
                }
            }
            if ($document !== "") {
                $extension1 = explode("/", $_FILES['document']['type']);
                $document = $userName . '.' . $extension1[1];

                if (move_uploaded_file($_FILES['document']['tmp_name'], '../uploads/document/' . $document) == false) {
                    $document = '';
                    $error = 1;
                }
            }
//        var_dump($img);
//        var_dump($document);
//        exit();
            if ($error === 0) {
                if ($img != '' && $document != '') {
                    $stmt = $con->prepare("UPDATE employee SET authKey= ?,userName = ?,branchId = ?,shiftId = ?,roleId = ?,departmintId = ?,jobTypeId = ?,first = ?,last = ?,father = ?,mather = ?,experience = ?,gander = ?,mobile = ?,phone = ?,cophone = ?,email = ?,address = ?,education = ?,salary = ?,upperId = ?,vacation = ?,sake = ?,degree = ?,typeOfEdu = ?,facelty = ?,totalHours = ?,img = ?,document = ? where id =? ");
                    $stmt->execute(array($authKey, $userName, $branchId, $shiftId, $roleId, $departmintId, $jobTypeId, $first, $last, $father, $mather, $experience, $gander, $mobile, $phone, $cophone, $email, $address, $education, $salary, $upperId, $vacation, $sake, $degree, $typeOfEdu, $facelty, $totalHours, $img, $document, $id));
                } elseif ($img != '' && $document == '') {
                    $stmt = $con->prepare("UPDATE employee SET authKey= ?,userName = ?,branchId = ?,shiftId = ?,roleId = ?,departmintId = ?,jobTypeId = ?,first = ?,last = ?,father = ?,mather = ?,experience = ?,gander = ?,mobile = ?,phone = ?,cophone = ?,email = ?,address = ?,education = ?,salary = ?,upperId = ?,vacation = ?,sake = ?,degree = ?,typeOfEdu = ?,facelty = ?,totalHours = ?,img = ? where id =? ");
                    $stmt->execute(array($authKey, $userName, $branchId, $shiftId, $roleId, $departmintId, $jobTypeId, $first, $last, $father, $mather, $experience, $gander, $mobile, $phone, $cophone, $email, $address, $education, $salary, $upperId, $vacation, $sake, $degree, $typeOfEdu, $facelty, $totalHours, $img, $id));

                } elseif ($img == '' && $document != '') {
                    $stmt = $con->prepare("UPDATE employee SET authKey= ?,userName = ?,branchId = ?,shiftId = ?,roleId = ?,departmintId = ?,jobTypeId = ?,first = ?,last = ?,father = ?,mather = ?,experience = ?,gander = ?,mobile = ?,phone = ?,cophone = ?,email = ?,address = ?,education = ?,salary = ?,upperId = ?,vacation = ?,sake = ?,degree = ?,typeOfEdu = ?,facelty = ?,totalHours = ?,document = ? where id =? ");
                    $stmt->execute(array($authKey, $userName, $branchId, $shiftId, $roleId, $departmintId, $jobTypeId, $first, $last, $father, $mather, $experience, $gander, $mobile, $phone, $cophone, $email, $address, $education, $salary, $upperId, $vacation, $sake, $degree, $typeOfEdu, $facelty, $totalHours, $document, $id));

                } elseif ($img == '' && $document == '') {
                    $stmt = $con->prepare("UPDATE employee SET authKey= ?,userName = ?,branchId = ?,shiftId = ?,roleId = ?,departmintId = ?,jobTypeId = ?,first = ?,last = ?,father = ?,mather = ?,experience = ?,gander = ?,mobile = ?,phone = ?,cophone = ?,email = ?,address = ?,education = ?,salary = ?,upperId = ?,vacation = ?,sake = ?,degree = ?,typeOfEdu = ?,facelty = ?,totalHours = ? where id =? ");
                    $stmt->execute(array($authKey, $userName, $branchId, $shiftId, $roleId, $departmintId, $jobTypeId, $first, $last, $father, $mather, $experience, $gander, $mobile, $phone, $cophone, $email, $address, $education, $salary, $upperId, $vacation, $sake, $degree, $typeOfEdu, $facelty, $totalHours, $id));

                }
                if ($id == $_SESSION['user']['id'] && $img != '') {
                    $_SESSION['user']['img'] = $img;
                }

                $response['code'] = '1';
                $response['msg'] = _Success;
            } else {
                $response['code'] = '-10';
                $response['msg'] = _UploadError;
            }
        }


    } elseif ($_POST['action'] == 'changePass') {

        $id = isset($_POST['id']) ? mysql_escape_mimic($_POST['id']) : "";
        $password = isset($_POST['pass']) ? md5(mysql_escape_mimic($_POST['pass'])) : "";

        $stmt = $con->prepare("UPDATE employee SET password= ? where id =? ");
        $stmt->execute(array($password, $id));
        $response['code'] = '1';
        $response['msg'] = _Success;


    }
} else {
    $response['code'] = '-30';
    $response['msg'] =  _NotAuthorized;
}
header('Content-Type: application/json');
echo json_encode($response);