<?php

namespace App\Http\Controllers\Api\Address;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function address(object $request){

        $api = $this->connectioApi($request->cep);
        if (!$api) {
            return false;
        }
        $data = [
            "cep" =>  $api->cep,
            "state" => $api->state,
            "city" => $api->city,
            "district" => $api->neighborhood,
            "street" => $api->street,
            "number" => $request->number,
            "complement" => $request->complement ?? null
        ];
        return $data;
    }

    private function connectioApi($cep){

        $url = "https://brasilapi.com.br/api/cep/v2/" . $cep;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        if ($error) {
            return false;
        }
        return json_decode($response);
    }
}
