<?php

namespace app\Models;

include "app/Config/DatabaseConfig.php";

use app\Config\DatabaseConfig;

use mysqli;

class Product extends DatabaseConfig

{

public $conn;

public function __construct()

{

// connect to database mysql

$this->conn = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);

// check koneksi

if ($this->conn->connect_error) {

die("Connection Failed: " . $this->conn->connect_error);

}

}

// Function menampilkan sebuah data

public function findAll()

{

$sql = "SELECT * FROM products";

$result = $this->conn->query($sql);

$this->conn->close();

$data = [];

while ($row = $result->fetch_assoc()) {

$data[] = $row;

}

return $data;

}

// Function menampilkan data dengan id

public function findById($id)

{

$sql = "SELECT * FROM products where id = ?";

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

}

?>