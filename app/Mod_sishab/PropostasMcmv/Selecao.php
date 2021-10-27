<?php

namespace App\Mod_sishab\PropostasMcmv;

use Illuminate\Database\Eloquent\Model;
use App\Tab_dominios\Modalidade;

class Selecao extends Model
{
    protected $table = 'tab_selecao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function modalidade()
    {
       return $this->belongsTo(Modalidade::class); //possui muitos
    }

    
    
  
}
