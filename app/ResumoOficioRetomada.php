<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumoOficioRetomada extends Model
{
    protected $table = 'view_oficio_retomada';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
}
