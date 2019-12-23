<?php

// namespace Api\Config;

// use \PDO;
// use PDOException;

class Database
{

    private $host = "bancodedados";
    private $db_name = "my_db";
    private $username = "root";
    private $password = "123456";

    private $conn;
    private static $instace = null;

    public function __construct()
    {
        try {
            $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8", $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public static function getInstance()
    {
        if (self::$instace == null) {
            self::$instace = new Database();
        }
        return self::$instace;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
