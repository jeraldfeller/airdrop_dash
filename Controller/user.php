<?php
require $_SERVER['DOCUMENT_ROOT'] . '/dashboard/Model/Init.php';
require $_SERVER['DOCUMENT_ROOT'] . '/dashboard/Model//Mail.php';
require $_SERVER['DOCUMENT_ROOT'] . '/dashboard/Model/Users.php';
$users = new Users();


$action = $_GET['action'];

switch ($action){
    case 'register':
        $data = json_decode($_POST['param'], true);
        $return = $users->registerAccountFunction($data);
        echo $return;
        break;
    case 'login':
        $data = json_decode($_POST['param'], true);
        $return = $users->userLoginFunction($data);
        echo $return;
        break;
    case 'admin-login':
        $data = json_decode($_POST['param'], true);
        $return = $users->adminLoginFunction($data);
        echo $return;
        break;
    case 'has-shared':
        $data = json_decode($_POST['param'], true);
        $return = $users->hasSharedAction($data);
        echo $return;
        break;
    case 'get-info':
        $data = json_decode($_POST['param'], true);
        $return = $users->getInfoAction($data);
        echo $return;
        break;
    case 'delete-key':
        $data = json_decode($_POST['param'], true);
        $return = $users->deleteKeyAction($data);
        echo $return;
        break;
    case 'edit-points':
        $data = json_decode($_POST['param'], true);
        $return = $users->editPointsAction($data);
        echo $return;
        break;
    case 'update-affiliate-url':
        $data = json_decode($_POST['param'], true);
        $return = $users->updateAffiliateUrlAction($data);
        echo $return;
        break;
    case 'request-password-reset':
        $data = json_decode($_POST['param'], true);
        $return = $users->requestPasswordResetAction($data);
        echo $return;
        break;
    case 'password-reset':
        $data = json_decode($_POST['param'], true);
        $return = $users->changePasswordAction($data);
        echo $return;
        break;
}