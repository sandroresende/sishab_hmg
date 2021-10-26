<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DadosOperacaoFar extends Model
{
   protected $table = 'view_dados_operacao_far';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
  
}
