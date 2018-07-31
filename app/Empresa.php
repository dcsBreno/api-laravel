<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = "empresa";
    protected $fillable = [
        "cnpj", "nome", "telefone", "endereco_id"
    ];

    public function endereco() {
        return $this->hasMany('App\Endereco', 'id', 'endereco_id');
    }
}
