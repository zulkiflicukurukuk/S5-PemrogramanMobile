<?php

    header("Content-type: application/json;");

    include "Routes/filmRoutes.php";

    use app\Routes\filmRoutes;

    $method = $_SERVER['REQUEST_METHOD'];
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $productRoutes = new filmRoutes;
    $productRoutes->handle($method, $path);
?>