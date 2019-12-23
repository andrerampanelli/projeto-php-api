<?php

namespace Api\Models;

class User
{

    private $conn;
    private $table_name = "users";

    public $id;
    public $name;
    public $description;
    public $email;
    public $password;
    public $created;

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
