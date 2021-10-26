<?php

namespace App\relatorio_atividades;

use Illuminate\Database\Eloquent\Model;

class TemaGeral extends Model
{
    protected $table = 'opc_tema_geral';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
