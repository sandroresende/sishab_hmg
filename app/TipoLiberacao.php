<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoLiberacao extends Model
{
    protected $table = 'opc_tipo_liberacoes';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
