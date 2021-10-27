<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Address;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('address', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string("cep");
            $table->string('state');
            $table->string('city');
            $table->string('district');
            $table->string('street');
            $table->integer('number');
            $table->string('complement')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('level')->default('1');
            $table->foreignIdFor(Address::class)->constrained("address")->cascadeOnUpdate()->onDelete("Restrict");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('cpf_or_cnpj');
            $table->foreignIdFor(User::class)->constrained("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Address::class)->constrained("address")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client');
        Schema::dropIfExists('address');
        Schema::dropIfExists('users');
    }
}
