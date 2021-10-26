<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiberacaoAnoEntrega extends Model
{
    protected $table = 'view_liberacoes_ano_entregas';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
