<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExecutivoHistorico extends Model
{
    protected $table = 'view_executivo_historico';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
