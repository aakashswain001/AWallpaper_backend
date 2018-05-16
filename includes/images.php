<?php

class Image
{


    // database connection and table name
    private $conn;
    private $table_name = "images";

    // object properties
    public $id;
    public $image;
    public $category;
    public $tag;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {


        // query to insert record
        $query = "INSERT INTO      " . $this->table_name . "
            SET
                image=:image,category=:category,tag=:tag";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":tag", $this->tag);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read($cat)
    {
        $query = "SELECT  * FROM " . $this->table_name;
        if ($cat != "") {
            $query = $query . ' WHERE category = "' . $cat . '"';
        }
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

?>