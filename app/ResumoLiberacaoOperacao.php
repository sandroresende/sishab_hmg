<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumoLiberacaoOperacao extends Model
{
    protected $table = 'view_liberacoes_operacao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
