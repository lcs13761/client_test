<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function index()
    {
        $user = User::find($this->user()->id);
        $this->response["result"] = $this->address($user);
        return Response()->json($this->response, 200);
    }

    private function address(User $user)
    {
        $user["address"] = Address::find($user->address_id);
        return $user;
    }
}
