<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
   protected $table = 'opc_genero';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
    public function beneficiariosOperacoes()
    {
       return $this->hasMany(BeneficiariosOperacao::class); //possui muitos
    }
}
