<?php

namespace App\Mod_pcva_parcerias;

use App\Tab_dominios\TipoProponente;

use Illuminate\Database\Eloquent\Model;

class EntePublicoParcerias extends Model
{
    protected $table = 'tab_ente_publico_parcerias';

    
    public function tipoProponente()
    {
       return $this->belongsTo(TipoProponente::class,'tipo_proponente_id','id'); //possui muitos
    }    
    
    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
