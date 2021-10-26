<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitacaoLiberacao extends Model
{
    protected $table = 'tab_solicitacao_liberacoes';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
