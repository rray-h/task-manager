<?php 
session_start();

require_once("../models/connection.php");

$test = new Database;

if($test->check()){
    $conn = $test->getPDO($conn);

    $task_title = htmlspecialchars($_POST["task_title"]);
    $task_describe = htmlspecialchars($_POST["task_describe"]);
    $task_priority = htmlspecialchars($_POST["task_priority"]);
    $errors = [];

    if(trim($task_title) === ""){
        $errors[] = "Тема не заполнена";
    }
    if(trim($task_describe) === ""){
        $errors[] = "Описание не заполнено";
    }
    if(trim($task_priority) === ""){
        $errors[] = "Не выбран приоритет";
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