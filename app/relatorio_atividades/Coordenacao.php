<?php

namespace App\relatorio_atividades;

use Illuminate\Database\Eloquent\Model;

class Coordenacao extends Model
{
    protected $table = 'opc_coordenacao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
