<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\client;

function fetch() { 
    $client = new Client();

    $response = $client->request('GET','http://127.0.0.1:1337/api/cinema');
    $body = $response->getBody();
    
    $body = json_decode($body, true);
    return $body;
    }
?>