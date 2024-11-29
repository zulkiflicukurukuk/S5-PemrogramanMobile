<?php

namespace app\Controller;
include "../app/Traits/ApiResponseFormatter.php";
include "C:\xampp\htdocs\Modul 4\Tugas1\Backend\app\Models\Film.php";

use app\Models\film;
use app\Traits\ApiResponseFormatter;

class filmController
{
    use ApiResponseFormatter;

    public function index()
    {
        $filmModel = new film();
        $response = $filmModel->findAll();
    
        if (empty($response)) {  
            return $this->apiResponse(404, "No data found", []);
        }else{
            return $this->apiResponse(200, "success", $response);
        }
        
    }
    

    public function insert()
    {

        $jsonInput = file_get_contents("php://input");
        $inputData = json_decode($jsonInput, true);
        if (!isset($inputData['product_name'])) {
            return $this->apiResponse(400, "Error: Invalid input", null);
        }

        $filmModel = new film();
        $response = $filmModel->create($inputData);
        
        return $this->apiResponse(200, "success", $response);
    }

    public function update($id)
    {
        $jsonInput = file_get_contents("php://input");
        $inputData = json_decode($jsonInput, true);

        if (!isset($inputData['product_name'])) {
            return $this->apiResponse(400, "Error: Invalid input", null);
        }

        $filmModel = new film();
        $response = $filmModel->update($inputData, $id);
        
        return $this->apiResponse(200, "success", $response);
    }

    public function delete($id)
    {
        $filmModel = new film();
        $response = $filmModel->delete($id);
        
        return $this->apiResponse(200, "success", $response);
    }
}