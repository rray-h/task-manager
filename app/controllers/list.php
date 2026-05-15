<?php 
session_start();

require_once("../models/connection.php");

$obj_db = new Database;

if($obj_db->check()){
    $conn = $obj_db->getPDO($conn);
    $sql_select = "SELECT * FROM tasks";
    $stmt = $conn->prepare($sql_select);
    $stmt->execute();    
    $_SESSION["task_list"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($_SESSION["task_list"] as $tasks){
        foreach($tasks as $item){
            echo "<p>" . $item . "</p>";
        }
    }

}
else{
    echo "Соеденения не установлено";
}

?>