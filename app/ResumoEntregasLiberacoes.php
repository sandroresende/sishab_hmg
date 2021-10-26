<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumoEntregasLiberacoes extends Model
{
    protected $table = 'view_entregas_com_liberacoes';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
