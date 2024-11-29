<?php

namespace app\Routes;

include "app/Controller/ProductController.php";

use app\Controller\ProductController;

class ProductRoutes
{
    public function handle($method, $path)
    {
        $controller = new ProductController();

        // Routing berdasarkan method dan path
        switch (true) {
            // GET /api/product
            case $method === "GET" && $path === "/api/product":
                echo $controller->index();
                break;

            // GET /api/product/{id}
            case $method === "GET" && strpos($path, "/api/product/") === 0:
                $id = $this->extractId($path);
                if ($id) {
                    echo $controller->getById($id);
                } else {
                    echo $this->errorResponse("Invalid ID in path");
                }
                break;

            // POST /api/product
            case $method === "POST" && $path === "/api/product":
                echo $controller->insert();
                break;

            // PUT /api/product/{id}
            case $method === "PUT" && strpos($path, "/api/product/") === 0:
                $id = $this->extractId($path);
                if ($id) {
                    echo $controller->update($id);
                } else {
                    echo $this->errorResponse("Invalid ID in path");
                }
                break;

            // DELETE /api/product/{id}
            case $method === "DELETE" && strpos($path, "/api/product/") === 0:
                $id = $this->extractId($path);
                if ($id) {
                    echo $controller->delete($id);
                } else {
                    echo $this->errorResponse("Invalid ID in path");
                }
                break;

            // Default: Route Not Found
            default:
                echo $this->errorResponse("Route not found", 404);
                break;
        }
    }

    /**
     * Extract ID from the path
     */
    private function extractId($path)
    {
        $pathParts = explode("/", $path);
        return isset($pathParts[count($pathParts) - 1]) ? intval($pathParts[count($pathParts) - 1]) : null;
    }

    /**
     * Generate a simple error response
     */
    private function errorResponse($message, $status = 400)
    {
        return json_encode([
            "status" => $status,
            "message" => $message,
            "data" => null,
        ]);
    }
}
?>
