<?php
@session_start();
$dsn = 'mysql:host=localhost;dbname=hr';
$user = 'root';
$pass = '';
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try {
    $con = new PDO($dsn, $user, $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "You Are Connected";
} catch (PDOException $e) {
//    echo 'Failed To Connect' . $e->getMessage();
}

function checkItem($select, $from, $value)
{
    global $con;
    $statement = $con->prepare("SELECT $select FROM $from WHERE  $select = ?");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    return $count;

}

function checkHash()
{
    global $con;
    $statement = $con->prepare("SELECT authKey FROM employee WHERE  id = ?");
    $statement->execute(array($_SESSION['user']['id']));
    $hash = $statement->fetch();

    if ($hash['authKey'] == $_SESSION['user']['authKey']) {
        return true;
    } else {
        return false;
    }
}

?>