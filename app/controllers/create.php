<?php 
session_start();

require_once("../models/connection.php");

$obj_db = new Database;

if($obj_db->check()){

    $conn = $obj_db->getPDO();

    $task_title = htmlspecialchars($_POST["task_title"]);
    $task_describe = htmlspecialchars($_POST["task_describe"]);
    $task_priority = htmlspecialchars($_POST["task_priority"]);
    
    $errors = [];

    if(empty(trim($task_title))){
        $errors['title'] = "Тема не заполнена";
    }
    if(empty(trim($task_describe))){
        $errors['describe'] = "Описание не заполнено";
    }
    if(empty(trim($task_priority))){
        $errors['priority'] = "Не выбран приоритет";
    }

    if(empty($errors)){

        $sql_insert = "INSERT INTO tasks (task_title, task_describe, task_priority) VALUES (:task_title, :task_describe, :task_priority)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->execute([":task_title"=>$task_title, ":task_describe"=>$task_describe, ":task_priority"=>$task_priority]);

        if($stmt->rowCount() > 0){
            echo "Данные отправлены";
        }
        else{
            echo "Данные не записаны";
        }
        
        $_SESSION["task_data"] = ["title"=>$task_title, "describe"=>$task_describe];
    }
    else{
       $_SESSION["errors"] = $errors;
    }
}
else{
    echo "Соеденения с БД не установлено";
}




header("Location: ../../public/index.php");
exit;
?>