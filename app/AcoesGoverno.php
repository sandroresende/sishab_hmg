<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcoesGoverno extends Model
{
    protected $connection	= 'pgsql';

    protected $table = 'opc_acao_governo';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   
}
