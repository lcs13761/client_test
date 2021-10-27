<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\Address\AddressController;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Validator;

class CreateController extends Controller
{
    public function index(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "cpf_or_cnpj" => "required|cpf_ou_cnpj",
            "phone" => "required",
            "email" => "required",
        ]);
        $validatorAddress = Validator::make($request->address, [
            "cep" => "required",
            "number" => "required",
        ]);

        if ($validator->fails() || $validatorAddress->fails()) {
            $this->response["error"] = "Informe todos os campos requiridos.";
            return Response()->json($this->response, 400);
        }

        $checkDate = Client::where("email", $request->email)->orWhere("cpf_or_cnpj", $request->cpf_or_cnpj)->where("user_id", $this->user()->id)->exists();
        if($checkDate){
            $this->response["error"] = "Email ou CPF/CNPJ ja atributos a um cliente.";
            return Response()->json($this->response, 400);
        }

        $dataAddress = (new AddressController())->address((object)$request->address);

        if (!$dataAddress) {
            $this->response["error"] = "Error ao validar o endereço..";
            return Response()->json($this->response, 400);
        }

        $address = Address::create($dataAddress);

        $client = [
            "name" => $request->name,
            "email" => $request->email,
            "cpf_or_cnpj" => $request->cpf_or_cnpj,
            "user_id" => $this->user()->id,
            "phone" => $request->phone
        ];

        if(!$address->client()->create($client)){
            $this->response["error"] = "Error ao salva o client.";
            return Response()->json($this->response, 400);
        }

        $this->response["result"] = "Criado com sucesso.";
        return Response()->json($this->response, 200);
    }
}
