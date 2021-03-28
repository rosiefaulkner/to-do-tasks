<?php
require_once 'app/init.php';

if(isset($_POST['name'])) {
    $title = trim($_POST['name']);
    if(!empty($title)){
        $addedQuery = $db->prepare("
        INSERT INTO tasks (title, user, done)
        VALUES(:title, :user, 0)
        ");

        $addedQuery->execute([
            'title' => $title,
            'user' => $_SESSION['user_id']
        ]);
    }
}

header('Location: index.php');