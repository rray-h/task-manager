<?php
session_start();

require_once("../app/models/connection.php");
include "views/header.php";

$obj_db = new Database;

if($obj_db->check()){

    $conn = $obj_db->getPDO();
    $sql_select = "SELECT * FROM tasks";
    $stmt = $conn->prepare($sql_select);
    $stmt->execute();    

    if(isset($_SESSION["task_list"])){
        $task_list = $_SESSION["task_list"];
        unset($_SESSION["task_list"]);
    }
    else{
        $task_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
else{
    echo "<p>Соединения не установлено</p>";
}

?>

<div class="main">
    <div class="task__list">
        <div class="list">
            <form method="POST">
                Сортировать по 
                <input type="submit" name="sort" value="Алфавиту">
            </form>
            <table border='1' cellpadding='5'>
                <thead>
                    <tr>
                    <th> Задача </th>
                    <th> Тема задачи </th>
                    <th> Описание задачи </th>
                    <th> Приоритет задачи </th>
                    </tr>
            </thead>
                <tbody>
                <?php foreach ($task_list as $tasks): ?>
                    <tr onclick="window.location='task.php?id=<?php echo $tasks['id']; ?>'" style="cursor: pointer;">
                        <td><?php echo htmlspecialchars($tasks['id']); ?></td>
                        <td><?php echo htmlspecialchars($tasks['task_title']); ?></td>
                        <td><?php echo htmlspecialchars($tasks['task_describe']); ?></td>
                        <td><?php echo htmlspecialchars($tasks['task_priority']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "views/footer.php" ?>