<?php

namespace App\Models;

use app\configs\DbConfig;
use mysqli;

class Product extends DbConfig{
    public $conn;

    public function __construct(){
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbName, $this->port);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function findAll(){
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function findById($id){
        $sql = "SELECT * FROM product WHERE id = ?";
        $stsmt = $this->conn->prepare($sql);
        $stsmt->bind_param("i", $id);
        $stsmt->execute();
        $result = $stsmt->get_result();
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function create($data){
        $sql = "INSERT INTO products(product_name) VALUES (?)";
        $stsmt = $this->conn->prepare($sql);
        $stsmt->bind_param("s", $productName);
        $stsmt->execute();
        $this->conn->close();
    } 

    public function update($id, $data){
        $sql = "UPDATE products SET product_name = ? WHERE id = ?";
        $stsmt = $this->conn->prepare($sql);
        $stsmt->bind_param("si", $productName, $id);
        $stsmt->execute();
        $this->conn->close();
    }

    public function delete($id){
        $sql = "DELETE FROM products WHERE id = ?";
        $stsmt = $this->conn->prepare($sql);
        $stsmt->bind_param("i", $id);
        $stsmt->execute();
        $this->conn->close();
    }
}
