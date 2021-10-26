<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicoesCaixa extends Model
{
   protected $table = 'tab_medicoes_caixa';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
  
}
