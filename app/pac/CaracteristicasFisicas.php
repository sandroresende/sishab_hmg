<?php

namespace App\pac;

use Illuminate\Database\Eloquent\Model;

class CaracteristicasFisicas extends Model
{
    protected $table = 'opc_caracteristicas_fisicas';
    
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
