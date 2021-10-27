<?php

namespace App\Tab_dominios;

use Illuminate\Database\Eloquent\Model;

class FaixaRenda extends Model
{
   protected $table = 'opc_faixa_renda';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
    public function operacoes()
    {
       return $this->hasMany(Operacoes::class); //possui muitos
    }
}
