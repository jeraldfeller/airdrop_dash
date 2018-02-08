<?php
require $_SERVER['DOCUMENT_ROOT'] . '/dashboard/Model/Init.php';
require $_SERVER['DOCUMENT_ROOT'] . '/dashboard/Model/Dashboard.php';
$dashboard = new Dashboard();

$action = $_GET['action'];

switch ($action){
    case 'generate-new-key-list':
        $data = json_decode($_POST['param'], true);
        $return = $dashboard->generateNewKeyListAction($data);
        echo $return;
        break;
    case 'generate-clear-list':
        $return = $dashboard->clearKeyListAction();
        echo $return;
        break;
    case 'get-game':
        $return = $dashboard->getTreasureHuntGame();
        echo $return;
        break;
    case 'start-game':
        $data = json_decode($_POST['param'], true);
        $return = $dashboard->startGame($data);
        echo $return;
        break;
}