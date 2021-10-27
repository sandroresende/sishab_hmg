<?php

namespace App\Mod_sishab\Operacoes;

use Illuminate\Database\Eloquent\Model;

class DadosOperacaoFds extends Model
{
   protected $table = 'view_dados_operacao_fds';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
  
}
