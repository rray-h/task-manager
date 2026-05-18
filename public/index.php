<?php include "views/header.php" ?>
<?php 
    session_start();
    $errors = $_SESSION["errors"];
    $task_data = $_SESSION["task_data"];
    unset($_SESSION["errors"]);
    unset($_SESSION["task_data"]);
?>

<div class="main">

    <div class="task">
        <div class="task__form">
            <form action="../app/controllers/create.php" method="POST">
                <label>
                    <p>Тема задачи: </p>
                    <?php 
                        if(!isset($errors['title'])) echo "<input type='text' name='task_title' value='" . $task_data["title"] . "' />";
                        else echo "<input class='red__outline' type='text' name='task_title' value='" . $task_data["title"] . "' />" . " " . $errors["title"];
                    ?>
                </label>
                <label>
                    <p>Описание задачи: </p>
                    <?php 
                        if(!isset($errors['describe'])) echo "<input type='text' name='task_describe' value='" . $task_data["describe"] . "' />";
                        else echo "<input class='red__outline' type='text' name='task_describe' value='" . $task_data["describe"] . "' />" . " " . $errors["describe"];
                    ?>                
                </label>
                <ul>
                    <p>Приоритет задачи: </p>
                    <li><label><input type="radio" name="task_priority" value="Низкий" checked />Низкий</label></li>
                    <li><label><input type="radio" name="task_priority" value="Средний">Средний</label></li>
                    <li><label><input type="radio" name="task_priority" value="Высокий">Высокий</label></li>
                </ul>
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>

</div>

<?php include "views/footer.php" ?>