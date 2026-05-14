<?php

class Database 
{

    private $instance = null;
    private $pdo;

    public function __construct(){
        $host = "localhost";
        $dbname = "task_manager";
        $user = "root";
        $pass = "123";
        
        try{
            $dsn = "mysql:host=$host;dbname=$dbname";
            $this->pdo = new PDO($dsn, $user, $pass);
        } 
        catch(PDOException $e){
            echo "Соединение не установлено" . $e->getMessage();
        }
        
    }

    public function check(){
        if(!$this->pdo){
            return false;
        }
        else{
            return true;
        }
    }

    public function getPDO($conn): PDO {
        return $conn = $this->pdo;
    }

}

?>