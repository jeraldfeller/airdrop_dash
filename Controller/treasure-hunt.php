<?php
require $_SERVER['DOCUMENT_ROOT'] . '/dashboard/Model/Init.php';
require $_SERVER['DOCUMENT_ROOT'] . '/dashboard/Model/Mail.php';
require $_SERVER['DOCUMENT_ROOT'] . '/dashboard/Model/Users.php';
require $_SERVER['DOCUMENT_ROOT'] . '/dashboard/Model/TreasureHunt.php';
$treasureHunt = new TreasureHunt();
$action = $_GET['action'];
switch ($action){
    case 'get-game':
        $return = $treasureHunt->getTreasureHuntGameById();
        echo $return;
        break;
    case 'start-game':
        $data = json_decode($_POST['param'], true);
        $return = $treasureHunt->startGame($data);
        echo $return;
        break;
    case 'submit-key':
        $data = json_decode($_POST['param'], true);
        $return = $treasureHunt->submitPublicKey($data);
        echo $return;
        break;
}
