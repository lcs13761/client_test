<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        $email = filter_var($request->input("email"), FILTER_VALIDATE_EMAIL);
        $password = $request->input('password');

        $token = Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);

        if (!$token) {
            $this->response["error"] = "Email e/ou senha invalido!";
            return Response()->json($this->response, 401);
        }

        $this->response["token"] = $token;
        return Response()->json($this->response, 200);
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            $this->response["error"] = "voce saiu com sucesso";
            return Response()->json($this->response, 200);
        }

        $this->response["error"] = "erro ao deslogar";
        return Response()->json($this->response, 200);
    }

    public function refresh()
    {
        try {
            $this->response["response"] = Auth::refresh();
            return response()->json($this->response, 200);
        } catch (\Exception $e) {
            $this->response["response"] = "Error";
            return response()->json($this->response, 401);
        }
    }

    public function unauthenticated()
    {
        $this->response["error"] = "Não autorizado";
        return response()->json($this->response, 401);
    }
}
