<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = "client";
    protected $hidden = [
        "created_at",
        "updated_at",
    ];
    protected $fillable = [
        "name","email","cpf_or_cnpj","user_id","address_id","phone"
    ];


    public function address(){
        return $this->hasOne(Address::class);
    }
    
}
