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


function checkAlert($select, $from, $value)
{
    global $con;
    $statement = $con->prepare("SELECT $select FROM $from WHERE  employeeId = ? and state = 0");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    return $count;

}

function checkItem($select, $from, $value)
{
    global $con;
    $statement = $con->prepare("SELECT $select FROM $from WHERE  $select = ?");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    return $count;

}

function checkItem2($select, $from, $col, $value, $col2, $value2)
{
    global $con;
    $statement = $con->prepare("SELECT $select FROM $from WHERE  $col = ? AND $col2= ? ");
    $statement->execute(array($value, $value2));
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

function GUID()
{
    if (function_exists('com_create_guid') === true) {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function mysql_escape_mimic($inp)
{
    if (is_array($inp))
        return array_map(__METHOD__, $inp);

    if (!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
    }

    return $inp;
}
function resize( $targetFile, $originalFile) {
    $newWidth=600;
    $info = getimagesize($originalFile);
    $mime = $info['mime'];

    switch ($mime) {
        case 'image/jpeg':
            $image_create_func = 'imagecreatefromjpeg';
            $image_save_func = 'imagejpeg';
            $new_image_ext = 'jpg';
            break;

        case 'image/png':
            $image_create_func = 'imagecreatefrompng';
            $image_save_func = 'imagepng';
            $new_image_ext = 'png';
            break;


        default:
            throw new Exception('Unknown image type.');
    }

    $img = $image_create_func($originalFile);
    list($width, $height) = getimagesize($originalFile);

    $newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    if (!file_exists('../uploads/img')) {
        mkdir('../uploads/img', 0777, true);
    }

    $image_save_func($tmp, "../uploads/img/".$targetFile.".".$new_image_ext."");

}
?>