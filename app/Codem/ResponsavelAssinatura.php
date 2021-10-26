<?php

namespace App\Codem;

use Illuminate\Database\Eloquent\Model;

class ResponsavelAssinatura extends Model
{

    protected $table = 'opc_responsavel_assinatura';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
