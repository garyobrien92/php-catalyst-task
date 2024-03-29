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
?>