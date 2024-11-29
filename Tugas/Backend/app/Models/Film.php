<?php

namespace app\Models;
include "../app/config/DatabaseConfig.php";

use app\Config\DatabaseConfig;
use mysqli;

class film extends DatabaseConfig
{
    public $conn;

    public function __construct()
    {

        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }


    public function findAll()
    {
        $sql = "SELECT * FROM product";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
    
        
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }


    public function findById($id)
    {
        $sql = "SELECT * FROM product WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();
        $data = [];
        
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        return $data;
    }


    public function create($data)
    {
        $filmName = $data['product_name'];
        $filmPrice = $data['price'];
        $filmImage = $data['product_image'];
        $query = "INSERT INTO product (product_name,price,product_image) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sis",$filmName , $filmPrice , $filmImage);
        $stmt->execute();
        $this->conn->close();
    }


    public function update($data, $product_id)
    {
        $filmName= $data['product_name'];
        $query = "UPDATE product SET product_name = ? WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $filmName, $product_id);
        $stmt->execute();
        $this->conn->close();
    }


    public function delete($product_id)
    {
        $query = "DELETE FROM product WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $this->conn->close();
    }
}