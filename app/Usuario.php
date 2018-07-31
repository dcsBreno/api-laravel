<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "usuario";
    protected $fillable = [
        "nome", "email", "telefone", "endereco_id"
    ];

    public function endereco() {
        return $this->hasMany('App\Endereco', 'id', 'endereco_id');
    }
}
