<?php

namespace App\Tab_dominios;

use Illuminate\Database\Eloquent\Model;

class StatusEmpreendimento extends Model
{
    protected $connection	= 'pgsql';

    protected $table = 'opc_status_empreendimento';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   
}
