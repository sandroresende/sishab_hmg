<?php

namespace App\Mod_sishab\Retomada;

use Illuminate\Database\Eloquent\Model;

class ViewOficioRetomada extends Model
{
    protected $table = 'view_oficio_retomada';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
}
