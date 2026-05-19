<?php 
session_start();

require_once("../models/connection.php");

$obj_db = new Database;

if($obj_db->check()){
    $conn = $obj_db->getPDO();

    $edit = $_POST["edit"];

    if($edit === "Изменить"){
        $task_id = isset($_SESSION["task_id"]) && !empty($_SESSION["task_id"]) ? $_SESSION["task_id"] : 0;
        $task_title = htmlspecialchars($_POST["task_title"]);
        $task_describe = htmlspecialchars($_POST["task_describe"]);
        $task_priority = htmlspecialchars($_POST["task_priority"]);
        $errors = [];

        if(trim($task_title) === ""){
            $errors['title'] = "Тема не заполнена";
        }
        if(trim($task_describe) === ""){
            $errors['describe'] = "Описание не заполнено";
        }
        if(trim($task_priority) === ""){
            $errors['priority'] = "Не выбран приоритет";
        }


        if(empty($errors)){
            $sql_edit = "UPDATE tasks SET task_title = :task_title, task_describe = :task_describe, task_priority = :task_priority WHERE id = :task_id";
            $stmt = $conn->prepare($sql_edit);
            $stmt->execute([":task_title"=>$task_title, ":task_describe"=>$task_describe, ":task_priority"=>$task_priority, ":task_id"=>$task_id]);

            if($stmt->rowCount() > 0){
                echo "Данные изменены";
            }
            else{
                echo "Данные не записаны";
            }
        }
        else{
            $_SESSION["errors"] = $errors;
        }
    }
    elseif($edit === "Удалить"){
        $task_id = isset($_SESSION["task_id"]) && !empty($_SESSION["task_id"]) ? $_SESSION["task_id"] : 0;
        $sql_delete = "DELETE FROM tasks WHERE id = :task_id";
        $stmt = $conn->prepare($sql_delete);
        $stmt->execute([":task_id"=>$task_id]);
        $sql_select = "SELECT * FROM tasks";
        $stmt = $conn->prepare($sql_select);
        $stmt->execute();
        $_SESSION["task_list"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        

        if($stmt->rowCount() > 0){
            echo "Задача удалена";
        }

    }

}
else{
    echo "Соединения с БД не установлено";
}



unset($_SESSION["task_id"]);
header("Location: ../../public/task-list.php");
exit;
?>