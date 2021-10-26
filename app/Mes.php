<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
   protected $table = 'opc_meses';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
}
