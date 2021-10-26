<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitacaoPagamento extends Model
{
    protected $table = 'view_medicoes_obras';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
