<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\Address;
use App\Http\Controllers\Api\Client;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware("auth:api")->group(function () {

  //
  Route::get("/401", [AuthController::class, "unauthenticated"])->name('login')->withoutMiddleware("auth:api");
  Route::post("/login", [AuthController::class, "login"])->withoutMiddleware("auth:api");
  Route::post("/logout", [AuthController::class, "logout"]);
  Route::post("/refresh", [AuthController::class, "refresh"]);

  //user
  Route::get("/user", [User\GetController::class, "index"]);
  Route::put("/user/update", [User\UpdateController::class, 'index']);

  //address
  Route::delete('user/address/{id}', [Address\DeleteController::class, 'index'])->where("id", '[0-9]+');

  //client
  Route::get("clients", [Client\GetController::class, "index"]);
  Route::post('client/add', [Client\CreateController::class, "index"]);
  Route::put('client/update/{id}', [Client\UpdateController::class, "index"])->where("id", '[0-9]+');
  Route::delete('client/delete/{id}', [Client\DeleteController::class, "index"])->where("id", '[0-9]+');
});
