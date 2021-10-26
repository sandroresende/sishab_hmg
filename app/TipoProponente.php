<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\prototipo\EntePublicoProponente;

class TipoProponente extends Model
{
    protected $table = 'opc_tipo_proponente';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function entePublicoProponente()
    {
       return $this->belongsTo(EntePublicoProponente::class); //possui muitos
    } 
}
