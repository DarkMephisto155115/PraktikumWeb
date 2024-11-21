<?php

namespace App\Controllers;

include "app/traits/apiResponseFormatter.php";
include "app/models/product.php";

use App\Models\Product;
use App\Traits\ApiResponseFormatter;

class ProductController{
    use ApiResponseFormatter;

    public function index(){
        $productModel = new Product();
        $response = $productModel->findAll();
        return $this->ApiResponse(200, "success", $response);
    }
    public function getById($id){
        $productModel = new Product();
        $response = $productModel->findById($id);
        return $this->ApiResponse(200,"success", $response);
    }

    public function insert(){
        $jsonInput = file_get_contents("php://input");
        $inputData = json_decode($jsonInput, true);
        if (json_last_error()) {
            return $this->ApiResponse(400,"Error invalid input", null);
        }

        $productModel = new Product();
        $response = $productModel->create([
            "product_name"=> $inputData["product_name"],
        ]);

        return $this->ApiResponse(200,"success", $response);
    }

    public function update($id){
        $jsonInput = file_get_contents("php://input");
        $inputData = json_decode($jsonInput, true);
        if (json_last_error()) {
            return $this->ApiResponse(400,"Error invalid input", null);
        }
        $productModel = new Product();
        $response = $productModel->update([
            "product_name"=> $inputData["product_name"],
        ], $id);

        return $this->ApiResponse(200,"success", $response);
    }

    public function delete($id){
        $productModel = new Product();
        $response = $productModel->delete($id);
        return $this->ApiResponse(200,"success", $response);
    }
}