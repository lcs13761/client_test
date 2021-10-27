<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\Address\AddressController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function index(Request $request)
    {
        $validade =  Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "address" => "required"
        ]);

        $validatorAddress = Validator::make($request->address, [
            "cep" => "required",
            "number" => "required",
        ]);

        if ($validade->fails() || $validatorAddress->fails()) {
            $this->response["error"] = "Informe todos os campos requiridos.";
            return Response()->json($this->response, 400);
        }

        $user = User::find($this->user()->id);
        if ($user->email != $request->email) {
            $email = User::where("email", $request->email)->exists();
            if ($email) {
                $this->response["result"] = "Email ja registrado.";
                return Response()->json($this->response, 400);
            }
        }

        $data = (new AddressController())->address((object)$request->address);

        if (!$data) {
            $this->response["result"] = "CEP invalido.";
            return Response()->json($this->response, 400);
        };

        $address = Address::find($user->address_id);

        $user = [
            "name" => $request->name,
            "email" => $request->email,
        ];

        if (!$address->update($data) || !$address->user()->update($user)) {
            $this->response["result"] = "Error ao editar.";
            return Response()->json($this->response, 400);
        }

        $this->response["result"] = "Sucesso no update.";
        return Response()->json($this->response, 200);
    }
}
