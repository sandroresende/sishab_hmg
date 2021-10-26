<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DadosOperacaoPnhr extends Model
{
   protected $table = 'view_dados_operacao_pnhr';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
  
}
