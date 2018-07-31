<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    protected $table = "vaga";
    protected $fillable = [
        "funcao", "descricao", "salario", "empresa_id"
    ];

    public function empresa() {
        return $this->hasMany('App\Empresa', 'id', 'empresa_id');
    }
}
