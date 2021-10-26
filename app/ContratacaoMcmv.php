<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContratacaoMcmv extends Model
{
    protected $table = 'tab_contratacao_mcmv';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function modalidade()
    {
       return $this->belongsTo(Modalidade::class); //possui muitos
    }
}
