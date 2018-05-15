<?php

class User
{

    // database connection and table name
    private $conn;
    private $table_name = "users";

    // object properties
    public $id;
    public $username;
    public $password;
    public $phone;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login()
    {

        // select all query
        $query = "SELECT * FROM users WHERE username = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->username);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $pass = $row['password'];
            if ($pass == $this->password) {
                // user authentication details are correct
                return true;
            } else {
                return false;
            }
        }
    }
}

?>