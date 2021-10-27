<?php

namespace Tests\Feature\Client;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{

    public $token;

     /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {   

        $response = $this->json("POST","/api/login",[
            "email" => "password@password.com",
            "password" => "password123"
        ],[
            'Content-Type' => 'application/json',
        ]);
        
        $response->assertStatus(200);
        $this->token = $response->decodeResponseJson()["token"];


    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create()
    {

        $data  = [
            "name" => $this->faker->name(),
            "cpf_or_cnpj" => $this->faker->cpf(),
            "phone" => sprintf('(0%s) %s', $this->faker->areaCode(), $this->faker->landline()),
            "email" => $this->faker->email(),
            "address" => [
                "cep" => "68374732",
                "number" => $this->faker->randomDigitNot(0),
            ]
            ];

            $token ="";
        $response = $this->json("POST","/api/client/add",$data,[
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
    }
}
