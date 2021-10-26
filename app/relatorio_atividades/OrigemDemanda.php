<?php

namespace App\relatorio_atividades;

use Illuminate\Database\Eloquent\Model;

class OrigemDemanda extends Model
{
    protected $table = 'opc_origem_demanda';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
