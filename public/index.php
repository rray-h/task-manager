<?php 
    session_start();
    include "views/header.php";

    $errors = $_SESSION["errors"] ?? [];
    $task_data = $_SESSION["task_data"] ?? [];
    unset($_SESSION["errors"]);
    unset($_SESSION["task_data"]);
?>

<div class="main">

    <div class="task">
        <div class="task__form">
            <form action="../app/controllers/create.php" method="POST">
                <label>
                    <p>Тема задачи: </p>
                    <?php if(!isset($errors['title']) && empty($errors['title'])): ?>
                        <input type='text' name='task_title' value="<?= $task_data["title"] ?>" />
                    <?php else: ?>
                        <input class='red__outline' type='text' name='task_title' value="<?= $task_data["title"]; ?>" /> <?= $errors["title"]; ?>
                    <?php endif; ?>
                </label>
                <label>
                    <p>Описание задачи: </p>
                    <?php if(!isset($errors['describe']) && empty($errors['describe'])): ?>
                        <textarea name="task_describe" border=1><?= $task_data["describe"] ?></textarea>
                    <?php else: ?>
                        <textarea name="task_describe" class="red__outline" border=1><?= $task_data["describe"] ?></textarea> <?= $errors["describe"]; ?>
                    <?php endif; ?>
                </label>
                <ul>
                    <p>Приоритет задачи: </p>
                    <label><li><input type="radio" name="task_priority" value="Низкий" checked />Низкий</li></label>
                    <label><li><input type="radio" name="task_priority" value="Средний">Средний</li></label>
                    <label><li><input type="radio" name="task_priority" value="Высокий">Высокий</li></label>
                </ul>
                <input type="submit" value="Отправить" />
            </form>
        </div>
    </div>

</div>

<?php include "views/footer.php" ?>