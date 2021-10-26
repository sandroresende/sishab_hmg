<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumoProponentes extends Model
{
    protected $table = 'view_resumo_proponentes';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
}
