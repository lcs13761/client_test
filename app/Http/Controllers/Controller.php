<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Tymon\JWTAuth\Facades\JWTAuth; 
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public array $response = ["error" => '', "result" => []];


    protected function user(){

        $token = JWTAuth::getToken();
        $response = JWTAuth::getPayload($token)->toArray();
        return  (object)$response["user"];
    }
}
