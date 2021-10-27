<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = "address";
    protected $hidden = [
        "created_at",
        "updated_at",
    ];
    protected $fillable = [
        "cep",
        "state",
        "city",
        "district",
        "street",
        "number",
        "complement"
    ];

    public function client(){
        return $this->hasOne(Client::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
