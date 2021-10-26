<?php

namespace App\relatorio_atividades;

use Illuminate\Database\Eloquent\Model;

class TipoDemanda extends Model
{
    protected $table = 'opc_tipo_demanda';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
