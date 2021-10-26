<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiberacaoOperacao extends Model
{
    protected $table = 'tab_liberacoes_operacao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
