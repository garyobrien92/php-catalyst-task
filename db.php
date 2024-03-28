<?php

class DatabaseConnect {
    private static $instance = null;
    private $conn;


    private function __construct($host, $username, $password, $databaseName) {
        $this->conn = new mysqli($host, $username, $password, $databaseName);
 
        // Check connection
        if($this->conn === false){
            die("ERROR: Could not connect. " . $this->conn->connect_error);
        }
    }

    public static function getInstance($host, $username, $password, $databaseName) {
        if(!self::$instance) {
            self::$instance = new DatabaseConnect($host, $username, $password, $databaseName);
        }

        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
 
// Attempt create table query execution
$sql = "CREATE TABLE persons(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    email VARCHAR(70) NOT NULL UNIQUE
)";
if($mysqli->query($sql) === true){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}
 
// Close connection
$mysqli->close();
?>