<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoComunidadeRural extends Model
{
    protected $table = 'tab_tipo_comunidade_rural';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function tipoComunidade()
    {
    	return $this->belongsTo(TipoComunidade::class); //possui muitos
    }

}
