<?php include "../app/views/header.php" ?>
<?php 
session_start();
$errors = $_SESSION["errors"];
unset($_SESSION["errors"]);
?>

<div class="main">

    <div class="task">
        <div class="task__form">
            <form action="../app/controllers/create.php" method="POST">
                <label>
                    <p>Тема задачи: </p>
                    <input type="text" name="task_title" />
                </label>
                <label>
                    <p>Описание задачи: </p>
                    <input type="text" name="task_describe" />
                </label>
                <ul>
                    <p>Приоритет задачи: </p>
                    <li><label><input type="radio" name="task_priority" value="Низкий" checked />Низкий</label></li>
                    <li><label><input type="radio" name="task_priority" value="Средний">Средний</label></li>
                    <li><label><input type="radio" name="task_priority" value="Высокий">Высокий</label></li>
                </ul>
                <input type="submit" values="Отправить" />
            </form>
        </div>
        <div class="task_output">
            <?php
            
                
                foreach($errors as $error)
                    echo "<p>$error</p>";

            ?>
        </div>
    </div>

</div>

<?php include "../app/views/footer.php" ?>