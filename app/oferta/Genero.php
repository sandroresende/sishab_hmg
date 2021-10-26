<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'opc_genero';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function beneficiarios()
    {
       return $this->hasMany(Beneficiario::class); //possui muitos
    }
}
