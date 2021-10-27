<?php

namespace App\Http\Controllers\Api\Address;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function index(int|string $id){

        if(!Address::find($id)->delete()){
            $this->response["error"] = "Error";
            return Response()->json($this->response, 400);
        }
        $this->response["result"] = "Removido";
        return Response()->json($this->response, 400);
    }
}
