<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumoPropostas extends Model
{
    protected $table = 'view_resumo_propostas';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
}
