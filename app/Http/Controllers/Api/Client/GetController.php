<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Client;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function index(){

        $response = Client::where("user_id", $this->user()->id)->get();
        $this->response["result"] = $this->client($response);
        return Response()->json($this->response, 200);
    }

    private function client($response){

        if($response->isEmpty()){
            return $response;
        }

        foreach($response as $value => $key){
            $address = Address::find($key->address_id);
            $response[$value]["address"] = $address;
        }

        return $response;

    }
}
