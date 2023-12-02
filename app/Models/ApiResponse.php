<?php

namespace App\Models;

class ApiResponse
{
    protected $response;
    public $success;
    public $data;
    public $error;
    public $errorMsg;
    public $message;
    public $pagination;

    public function isSuccessful()
    {
        return $this->response->successful();
    }

    public function getData()
    {
        $response = $this->response->json();
        if (isset($response['success']))

        return $response;
    }
}
