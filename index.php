<?php

require_once 'app/init.php';

$itemsQuery = $db->prepare("
    SELECT task_id, title, done
    FROM tasks
    WHERE user = :user
");

$itemsQuery->execute([
    'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ToDo List</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="list">
        <h1 class="header">To Do. </h1>
        <?php if (!empty($items)) : ?>
            <ul>
                <?php foreach ($items as $item) : ?>
                    <li>
                        <span class="item<?php echo $item['done'] ? ' done' : ' ' ?>"><?php echo $item['title']; ?></span>
                        <?php if (!$item['done']) : ?>
                            <a href="mark.php?as=done&item=<?php echo $item['task_id'] ?>" class="done-button">mark as done</a>
                        <?php endif; ?>
                        <?php if ($item['done']) : ?>
                            <a href="mark.php?as=notdone&item=<?php echo $item['task_id'] ?>" class="notdone-button">mark as not done</a>
                            <a href="delete.php?as=delete&item=<?php echo $item['task_id'] ?>" class="delete-button">delete task</a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>You haven't added any items yet.
            <p>
            <?php endif; ?>
            <form class="item-add" action="add.php" method="post">
                <input type="text" name="name" placeholder="Type a new item here." class="input">
                <input type="submit" value="add" class="submit">
            </form>
    </div>

</body>

</html>