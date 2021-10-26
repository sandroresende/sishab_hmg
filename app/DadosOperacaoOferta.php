<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DadosOperacaoOferta extends Model
{
   protected $table = 'tab_dados_operacao_oferta';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
  
}
