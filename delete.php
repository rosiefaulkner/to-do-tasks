<?php

require_once 'app/init.php';

if(isset($_GET['as'], $_GET['item'])){
    $as = $_GET['as'];
    $item = $_GET['item'];

    switch($as){
        case 'delete':
            $doneQuery = $db->prepare("
            DELETE FROM tasks
            WHERE task_id = :item
            AND user = :user
            ");
            $doneQuery->execute([
                'item' => $item,
                'user' => $_SESSION['user_id']
            ]);
        break;
        case 'notdone':
            $doneQuery = $db->prepare("
            UPDATE tasks
            SET done = 0
            WHERE task_id = :item
            AND user = :user
            ");
            $doneQuery->execute([
                'item' => $item,
                'user' => $_SESSION['user_id']
            ]);
        break;
        default:
        break;
    }
}

header('Location: index.php');