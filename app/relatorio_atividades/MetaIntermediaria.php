<?php

namespace App\relatorio_atividades;

use Illuminate\Database\Eloquent\Model;

class MetaIntermediaria extends Model
{
    protected $table = 'opc_metas_intermediaria';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
