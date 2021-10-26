<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatorioExecutivoResumo extends Model
{
    protected $table = 'view_relatorio_executivo_resumo';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
