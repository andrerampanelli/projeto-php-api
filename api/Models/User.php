<?php

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

    function auth($email)
    {
        $query = "SELECT
                name, email, password 
            FROM
                " . $this->table_name . " 
            WHERE 
                email = '" . $email . "'";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->password = $row['password'];
    }

}
