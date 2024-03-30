<?php
class DatabaseConnect {
    private static $instance = null;
    private $conn;


    private function __construct($host, $username, $password, $databaseName) {
        try {
            $this->conn = new mysqli($host, $username, $password, $databaseName);
        }
        catch (mysqli_sql_exception $e) {
            fwrite(STDOUT, "Failed to connect to database, Please check your host user and password\n");
            fwrite(STDOUT, $e->getMessage());
            die;
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