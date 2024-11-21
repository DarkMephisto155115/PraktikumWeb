<?php

header("Content-type: aplication/json; charset=UTF-8");

include "app/routes/productRoute.php";

use App\Routes\ProductRoutes;

$method = $_SERVER['REQUEST_METHOD'];

$path = $parse_url($_SERVER['REQUEST_METHOD'], PHP_URL_PATH);

$productRoutes = new ProductRoutes();

$productRoutes->handle($method, $path);