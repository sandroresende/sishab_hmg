<?php

namespace App\Mod_selecao_demanda;

use Illuminate\Database\Eloquent\Model;

class TipoArquivo extends Model
{
    protected $table = 'opc_tipo_arquivo_demanda';


    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function dadosArquivoEntePublico()
    {
       return $this->belongsTo(DadosArquivoEntePublico::class); //possui muitos
    }

}
