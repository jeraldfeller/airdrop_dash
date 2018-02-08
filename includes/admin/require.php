<?php
require $_SERVER['DOCUMENT_ROOT'] . '/dashboard/Model/Init.php';
require $_SERVER['DOCUMENT_ROOT'] . '/dashboard/Model/Dashboard.php';
require $_SERVER['DOCUMENT_ROOT'] . '/dashboard/Model/session.php';
if($userData['userLevel'] != 'admin'){
    Header('location: error.php');
}