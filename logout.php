<?php
require $_SERVER['DOCUMENT_ROOT'] . '/dashboard/Model/Init.php';
require $_SERVER['DOCUMENT_ROOT'] . '/dashboard/Model/session.php';
if($userData['userLevel'] == 'admin'){
    $location = 'admin-login.php';
}else{
    $location = 'login.php';
}

unset($_SESSION["userData"]);
unset($_SESSION["isLoggedIn"]);
session_destroy();

Header('location: '.$location);
?>