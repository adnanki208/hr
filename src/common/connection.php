<?php
$dsn='mysql:host=localhost;dbname=hr';
$user='root';
$pass='';
$option= array(
    PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8',
);

try{
    $con =new PDO($dsn,$user,$pass,$option);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//    echo "You Are Connected";
}
catch (PDOException $e){
//    echo 'Failed To Connect' . $e->getMessage();
}

function checkItem($select,$from,$value) {
    global $con;
    $statement=$con->prepare("SELECT $select FROM $from WHERE  $select = ?");
    $statement->execute(array($value));
    $count=$statement->rowCount();
    return $count;

}
//function checkAlert($select, $from, $value)
//{
//    global $con;
//    $statement = $con->prepare("SELECT $select FROM $from WHERE  employeeId = ? and state = 0");
//    $statement->execute(array($value));
//    $count = $statement->rowCount();
//    return $count;
//
//}
?>