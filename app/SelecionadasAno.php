<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelecionadasAno extends Model
{
    protected $table = 'view_uh_selecionadas_ano';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
