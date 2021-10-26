<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoComunidade extends Model
{
    protected $table = 'opc_tipo_comunidade';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function tipoComunidadeRural()
    {
    	return $this->hasMany(TipoComunidadeRural::class); //possui muitos
    }

}
