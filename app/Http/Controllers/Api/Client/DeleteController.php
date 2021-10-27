<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Client;

class DeleteController extends Controller
{
    public function index(int|string $id){


        $client = Client::where('id', $id)->where('user_id',$this->user()->id)->first();
        if(!$client){
            $this->response["error"] = "Cliente não encontrado.";
            return Response()->json($this->response, 400);
        }

        if(!Address::find($client->address_id)->delete()){
            $this->response["error"] = "Error ao remove.";
            return Response()->json($this->response, 400);
        }

        $this->response["result"] = "Removido com sucesso.";
        return Response()->json($this->response, 200);

    }
}
