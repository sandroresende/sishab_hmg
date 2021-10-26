<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatorioExecutivoAno extends Model
{
    protected $table = 'view_relatorio_executivo_ano';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
