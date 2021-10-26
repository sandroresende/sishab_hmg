<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpreendimentoOperacao extends Model
{
    protected $table = 'tab_empreendimento';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização



    public function resumoOperacao()
    {
       return $this->belongsTo(ResumoOperacao::class); //possui muitos
    } 

}
