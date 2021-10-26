<?php

namespace App\Codem;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{

    protected $table = 'opc_tipo_documento';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
