<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemandaFechadaAno extends Model
{
    protected $table = 'view_uh_demanda_fechada_ano';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
