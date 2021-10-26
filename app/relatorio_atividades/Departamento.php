<?php

namespace App\relatorio_atividades;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'opc_departamento';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
