<?php

namespace App\Routes;

// Headers for CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

class routesApp
{
    public function handle($method, $path)
    {
        // POST: Fetch all products
        if ($method === "POST" && $path === "/api/allProducts") {
            $input = json_decode(file_get_contents('php://input'), true);
            if (isset($input['action']) && $input['action'] === 'fetchProducts') {
                include __DIR__ . "/../api/getProducts.php";
                return;
            }

            $this->sendErrorResponse(400, "Invalid action");
            return;
        }

        // GET: Products by brand
        if ($method === "GET" && preg_match("#^/api/allProducts/byBrand/([^/]+)$#", $path, $matches)) {
            $brand = $matches[1];
            if (empty($brand)) {
                $this->sendErrorResponse(400, "Brand name is missing");
                return;
            }

            include __DIR__ . "/../api/getProductsByBrand.php";
            return;
        }

        // GET: Product by ID
        if ($method === "GET" && preg_match("#^/api/product/(\d+)$#", $path, $matches)) {
            $id = $matches[1];
            if (empty($id)) {
                $this->sendErrorResponse(400, "ID is missing");
                return;
            }

            include __DIR__ . "/../api/getProductById.php";
            return;
        }

        // POST: Add product
        if ($method === "POST" && $path === "/api/addProduct") {
            include __DIR__ . "/../api/createProducts.php";
            return;
        }

        // PUT: Update product
        if ($method === "PUT" && preg_match("#^/api/update/(\d+)$#", $path, $matches)) {
            $id = $matches[1];
            if (empty($id)) {
                $this->sendErrorResponse(400, "ID is missing");
                return;
            }

            include __DIR__ . "/../api/updateProducts.php";
            return;
        }

        // PUT: Buy product
        if ($method === "PUT" && preg_match("#^/api/buy/(\d+)$#", $path, $matches)) {
            $id = $matches[1];
            if (empty($id)) {
                $this->sendErrorResponse(400, "ID is missing");
                return;
            }

            include __DIR__ . "/../api/buyProduct.php";
            return;
        }

        // DELETE: Delete product
        if ($method === "DELETE" && preg_match("#^/api/delete/(\d+)$#", $path, $matches)) {
            $id = $matches[1];
            if (empty($id)) {
                $this->sendErrorResponse(400, "ID is missing");
                return;
            }

            include __DIR__ . "/../api/deleteProducts.php";
            return;
        }

        // Route not found
        $this->sendErrorResponse(404, "Route Not Found");
    }

    private function sendErrorResponse($statusCode, $message)
    {
        http_response_code($statusCode);
        echo json_encode([
            "status" => "Error",
            "message" => $message
        ]);
    }
}
