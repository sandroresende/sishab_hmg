<?php

namespace App\Mod_selecao_demanda;

use App\Mod_prototipo\EntePublicoProponente;

use Illuminate\Database\Eloquent\Model;

class TipoEntePublico extends Model
{
    protected $table = 'opc_tipo_ente_publico';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização
   
   public function entePublico()
   {
      return $this->belongsTo(EntePublico::class); //possui muitos
   } 


}
