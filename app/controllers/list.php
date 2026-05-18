<?php 
session_start();

require_once("../models/connection.php");

$obj_db = new Database;

if($obj_db->check()){
    $conn = $obj_db->getPDO();
    $sql_select = "SELECT * FROM tasks";
    $stmt = $conn->prepare($sql_select);
    $stmt->execute();    
    $_SESSION["task_list"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($task_list as $tasks){
        foreach($tasks as $task){
            echo $task;
        }
    }
}
else{
    echo "Соеденения не установлено";
}

?>