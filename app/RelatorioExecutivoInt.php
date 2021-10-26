<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatorioExecutivoInt extends Model
{
    protected $table = 'view_relatorio_executivo';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
