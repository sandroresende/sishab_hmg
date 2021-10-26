<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivoNaoEnquadramento extends Model
{
    protected $table = 'tab_motivo_nao_enquadramento';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
