<?php

namespace App\Traits;

trait ApiResponseFormatter{
    public function ApiResponse($code = 200, $message = "success", $data =[]){
        return json_encode([
            "code" => $code,
            "message"=> $message,
            "data"=> $data,
        ]);
    }
}
