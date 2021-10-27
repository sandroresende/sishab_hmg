<?php

namespace App\Mod_sishab\Operacoes;

use Illuminate\Database\Eloquent\Model;

class ViewLiberacaoOperacao extends Model
{
    protected $table = 'view_liberacoes_operacao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
