<?php

namespace App\pac;

use Illuminate\Database\Eloquent\Model;

class CaracteristicasFisicasProjeto extends Model
{
    protected $table = 'tab_caracteristicas_fisicas_projeto';
    
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
