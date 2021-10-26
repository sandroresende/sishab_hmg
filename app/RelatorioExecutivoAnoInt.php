<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatorioExecutivoAnoInt extends Model
{
    protected $table = 'view_relatorio_executivo_ano_int';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
