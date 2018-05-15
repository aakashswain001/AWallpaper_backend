<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 15-05-2018
 * Time: 20:05
 */

class Category
{


    // database connection and table name
    private $conn;
    private $table_name = "category";

    // object properties
    public $id;
    public $category;
    public $category_url;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {


        // query to insert record
        $query = "INSERT INTO      " . $this->table_name . "
            SET
                category=:category,category_url=:category_url";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":category_url", $this->category_url);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read()
    {

        //select all data
        $query = "SELECT  * FROM category  ORDER BY category";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

?>