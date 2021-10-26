<?php

namespace App\Codem;

use Illuminate\Database\Eloquent\Model;

class StatusProcesso extends Model
{

    protected $table = 'opc_status_processo';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
