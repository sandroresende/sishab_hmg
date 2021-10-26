<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeficitHabitacional extends Model
{
   protected $table = 'tab_deficit_habitacional';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
}
