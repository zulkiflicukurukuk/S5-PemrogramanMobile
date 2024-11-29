<?php

namespace app\Routes;
include "C:\xampp\htdocs\Modul 4\Tugas1\Backend\app\Models\Film.php";

use app\Controller\filmController;

class filmRoutes
{
    public function handle($method, $path)
    {
        if ($method == "GET" && $path == '/api/cinema') {
            $controller = new filmController();
            echo $controller->index();
        }

        if ($method == "POST" && $path == "/api/cinema") {
            $controller = new filmController();
            echo $controller->insert();
        }

        if ($method == "PUT" && strpos($path, "/api/cinema/") == 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];
            
            $controller = new filmController();
            echo $controller->update($id);
        }

        if ($method == "DELETE" && strpos($path, "/api/cinema/") == 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];
            
            $controller = new filmController();
            echo $controller->delete($id);
        }
    }
}

?>