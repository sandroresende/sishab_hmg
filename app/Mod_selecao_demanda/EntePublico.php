<?php

namespace App\Mod_selecao_demanda;

use App\User;
use App\IndicadoresHabitacionais\Municipio;

use Illuminate\Database\Eloquent\Model;

class EntePublico extends Model
{
    protected $table = 'tab_ente_publico';

   protected $keyType = 'string';
   
   public function tipoEntePublico()
   {
      return $this->belongsTo(TipoEntePublico::class); //possui muitos
   } 

   public function dadosArquivoEntePublico()
   {
      return $this->belongsTo(DadosArquivoEntePublico::class); //possui muitos
   }

   public function user()
   {
      return $this->belongsTo(User::class); //possui muitos
   }

   public function municipio()
   {
      return $this->belongsTo(Municipio::class); //possui muitos
   }


   // public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
