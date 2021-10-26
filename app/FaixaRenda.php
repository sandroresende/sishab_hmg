<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaixaRenda extends Model
{
   protected $table = 'opc_faixa_renda';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
    public function entregas()
    {
       return $this->hasMany(Entregas::class); //possui muitos
    }
   
    public function operacoes()
    {
       return $this->hasMany(Operacoes::class); //possui muitos
    }
}
