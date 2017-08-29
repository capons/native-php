<?php

namespace app\system\database;

use mysqli;

class Database {

    private $connection;
    //The single instance
    private static $instance;
    private $host = "localhost";
    private $username = "root";
    private $password = "root";
    private $database = "test";

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->username,
            $this->password, $this->database);

        // Error handling
        if(mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
                E_USER_ERROR);
        }
    }

    /*
    Get an instance of the Database
    @return Instance
    */
    public static function startDB() {
        if(!self::$instance) { // If no instance then make one
            self::$instance = new self;
        }
        return self::$instance->getConnection();
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }

    // Get mysqli connection
    public function getConnection() {
        return $this->connection;
    }
}