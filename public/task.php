<?php 
include "views/header.php";
require_once "../app/models/connection.php";

session_start();

$obj_db = new Database;
$task_id = isset($_GET["id"]) && !empty($_GET["id"]) ? $_GET["id"] : 0;
$errors = $_SESSION["errors"];
$_SESSION["task_id"] = $task_id;


if($obj_db->check()){
    $conn = $obj_db->getPDO();
    $sql_select_id = "SELECT * FROM tasks WHERE id = :task_id";
    $stmt = $conn->prepare($sql_select_id);
    $stmt->execute(["task_id"=>$task_id]);

    $task_id_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="main">
    <div class="task">
        <div class="task__form">
            <form action="../app/controllers/edit.php" method="POST">
                <label>
                    <p>Тема задачи:</p> 
                    <?php 
                        echo "<input type='text' name='task_title' value='" . $task_id_data[0]["task_title"] . "' />" 
                    ?>
                </label>
                <label>
                    <p>Описание задачи:</p> 
                    <?php echo "<input type='text' name='task_describe' value='" . $task_id_data[0]["task_describe"] . "' />" ?>
                </label>
                <ul>
                    <p>Приоритет задачи: </p>
                    <?php
                    
                        if($task_id_data[0]["task_priority"] === "Низкий"){
                            echo "
                                <li><label><input type='radio' name='task_priority' value='Низкий' checked />Низкий</label></li>
                                <li><label><input type='radio' name='task_priority' value='Средний' />Средний</label></li>
                                <li><label><input type='radio' name='task_priority' value='Высокий' />Высокий</label></li>
                            ";
                        }
                        elseif($task_id_data[0]["task_priority"] === "Средний"){
                            echo "
                                <li><label><input type='radio' name='task_priority' value='Низкий' />Низкий</label></li>
                                <li><label><input type='radio' name='task_priority' value='Средний' checked />Средний</label></li>
                                <li><label><input type='radio' name='task_priority' value='Высокий' />Высокий</label></li>
                            ";
                        }
                        elseif($task_id_data[0]["task_priority"] === "Высокий"){
                            echo "
                                <li><label><input type='radio' name='task_priority' value='Низкий' />Низкий</label></li>
                                <li><label><input type='radio' name='task_priority' value='Средний' />Средний</label></li>
                                <li><label><input type='radio' name='task_priority' value='Высокий' checked />Высокий</label></li>
                            ";
                        }
                        else{
                            echo "
                                <li><label><input type='radio' name='task_priority' value='Низкий' />Низкий</label></li>
                                <li><label><input type='radio' name='task_priority' value='Средний' />Средний</label></li>
                                <li><label><input type='radio' name='task_priority' value='Высокий' />Высокий</label></li>
                            ";
                        }
                    ?>
                </ul>
                <input type="submit" name="edit" value="Изменить" />
                <input type="submit" name="edit" value="Удалить" />
            </form>
        </div>
    </div>
</div>

<?php include "views/footer.php"; ?>