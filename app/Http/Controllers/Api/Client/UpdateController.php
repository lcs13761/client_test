<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\Address\AddressController;

class UpdateController extends Controller
{
    public function index(Request $request, int|string $id)
    {

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "cpf_or_cnpj" => "required|cpf_ou_cnpj",
            "phone" => "required",
            "email" => "required",
            "address" => "required"
        ]);

        $validatorAddress = Validator::make($request->address, [
            "cep" => "required",
            "number" => "required"
        ]);

        if ($validator->fails() || $validatorAddress->fails()) {
            $this->response["error"] = "Informe todos os campos requiridos.";
            return Response()->json($this->response, 400);
        }

        $checkData = $this->validadData($request,$id);
        if(!$checkData){
            return Response()->json($this->response, 400);
        }

        $dataAddress = (new AddressController())->address((object)$request->address);

        if (!$dataAddress) {
            $this->response["error"] = "Error ao validar o endereço..";
            return Response()->json($this->response, 400);
        }
        $address = Address::find($checkData);
        $address->update($dataAddress);

        $client = [
            "name" => $request->name,
            "email" => $request->email,
            "cpf_or_cnpj" => $request->cpf_or_cnpj,
            "user_id" => $this->user()->id,
            "phone" => $request->phone
        ];

        if (!$address->client()->update($client)) {
            $this->response["error"] = "Error ao salva o client.";
            return Response()->json($this->response, 400);
        }

        $this->response["result"] = "Editado com sucesso.";
        return Response()->json($this->response, 200);
    }

    private function validadData($request,$id){

        $client = Client::where("user_id", $this->user()->id)->where("id", $id)->first();

        if ($client->email != $request->email && Client::where("email", $request->email)->where("user_id", $this->user()->id)->exists()) {
            $this->response["error"] = "E-mail ja atributos a um cliente.";
            return false;
        }

        if ($client->cpf_or_cnpj != $request->cpf_or_cnpj &&  Client::where("cpf_or_cnpj", $request->cpf_or_cnpj)->where("user_id", $this->user()->id)->exists()) {
            $this->response["error"] = "CPF/CNPJ ja atributos a um cliente.";
            return false;
        }

        return $client->address_id;
    }
}
