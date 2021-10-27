<?php

namespace App\Mod_prototipo;

use App\User;
use App\IndicadoresHabitacionais\Municipio;
use App\Tab_dominios\TipoProponente;

use Illuminate\Database\Eloquent\Model;

class EntePublicoProponente extends Model
{
    protected $table = 'tab_ente_publico_proponente';

   protected $keyType = 'string';
   
   
   public function municipio()
   {
      return $this->belongsTo(Municipio::class); //possui muitos
   }

   public function user()
   {
      return $this->belongsTo(User::class); //possui muitos
   }

   public function tipoProponente()
   {
      return $this->belongsTo(TipoProponente::class); //possui muitos
   } 


   // public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
