<?php
/**
 * Created by PhpStorm.
 * User: broxy
 * Date: 2019-05-06
 * Time: 6:38 PM
 */

 session_start(); //Start The Session

session_unset(); //Unset the Data

session_destroy(); //Destroy The Session

header('Location: /hr/');

exit();