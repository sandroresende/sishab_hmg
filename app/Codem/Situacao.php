<?php

namespace App\Codem;

use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{

    protected $table = 'opc_situacao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
