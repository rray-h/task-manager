<?php 
session_start();

require_once "../app/models/connection.php";
include "views/header.php";

$obj_db = new Database;
$task_id = $_GET["id"] ?? 0;

if($obj_db->check()){

    $conn = $obj_db->getPDO();
    $sql_select_id = "SELECT * FROM tasks WHERE id = :task_id";
    $stmt = $conn->prepare($sql_select_id);
    $stmt->execute(["task_id"=>$task_id]);

    $task_id_data = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION["task_id"] = $task_id;
}
?>

<div class="main">
    <div class="task">
        <div class="task__form">
            <form action="../app/controllers/edit.php" method="POST">
                <label>
                    <p>Тема задачи:</p> 
                    <input type='text' name='task_title' value="<?= $task_id_data["task_title"] ?>" />
                </label>
                <label>
                    <p>Описание задачи:</p> 
                    <textarea name="task_describe" border=1><?= $task_id_data["task_describe"] ?></textarea>
                </label>
                <ul>
                    <p>Приоритет задачи: </p>
                    <?php if($task_id_data["task_priority"] === "Низкий"): ?>
                        <li><input type='radio' name='task_priority' value='Низкий' checked />Низкий</li>
                        <li><input type='radio' name='task_priority' value='Средний' />Средний</li>
                        <li><input type='radio' name='task_priority' value='Высокий' />Высокий</li>
                    <?php elseif($task_id_data["task_priority"] === "Средний"): ?>
                        <li><input type='radio' name='task_priority' value='Низкий' />Низкий</li>
                        <li><input type='radio' name='task_priority' value='Средний' checked/>Средний</li>
                        <li><input type='radio' name='task_priority' value='Высокий' />Высокий</li>
                    <?php elseif($task_id_data["task_priority"] === "Высокий"): ?>
                        <li><input type='radio' name='task_priority' value='Низкий' />Низкий</li>
                        <li><input type='radio' name='task_priority' value='Средний' />Средний</li>
                        <li><input type='radio' name='task_priority' value='Высокий' checked/>Высокий</li>
                    <?php endif; ?>
                </ul>
                <input type="submit" name="edit" value="Изменить" />
                <input type="submit" name="edit" value="Удалить" />
            </form>
        </div>
    </div>
</div>

<?php include "views/footer.php"; ?>