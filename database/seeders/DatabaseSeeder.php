<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;
use App\models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();;
      $address = Address::create([
            "cep" => "683774732",
            "state" => $faker->stateAbbr(),
            "city" => $faker->city(),
            "district" => $faker->streetName(),
            "street" => $faker->streetName(),
            "number" => $faker->buildingNumber(),
            "complement" => $faker->secondaryAddress()
        ]);

        $address->user()->create(
            [
                "name" => "admin",
                "email" => "password@password.com",
                "level" => "5",
                'email_verified_at' => now(),
                "password" => Hash::make("password123"),
            ]);

    }
}
