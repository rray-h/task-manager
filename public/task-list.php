<?php 
    include "views/header.php";
    $task_list = $_SESSION["task_list"];
    unset($_SESSION["task_list"]);
?>

<div class="list">
        <?php
           echo "<table border='1' cellpadding='5'>";
           echo "<thead>";
           echo "<tr>";
           echo "<th> Задача </th>";
           echo "<th> Тема задачи </th>";
           echo "<th> Описание задачи </th>";
           echo "<th> Приоритет задачи </th>";
           echo "</tr>";
           echo "</thead>";
        ?>
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
        <?php
           echo "</table>";
        ?>
</div>


<?php include "views/footer.php" ?>