<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SituacaoContrato extends Model
{
    protected $table = 'opc_situacoes_contratos';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function resumoOperacoes()
    {
       return $this->hasMany(ResumoOperacao::class); //possui muitos
    }
}
