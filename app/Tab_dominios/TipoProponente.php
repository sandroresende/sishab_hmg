<?php

namespace App\Tab_dominios;

use Illuminate\Database\Eloquent\Model;

use App\Mod_prototipo\EntePublicoProponente;
use App\Mod_pcva_parcerias\EntePublicoParcerias;

class TipoProponente extends Model
{
    protected $table = 'opc_tipo_proponente';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function entePublicoProponente()
    {
       return $this->belongsTo(EntePublicoProponente::class); 
    } 

    public function entePublicoParcerias()
    {
       return $this->belongsTo(EntePublicoParcerias::class); 
    } 
}
