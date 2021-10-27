<?php

namespace App\Mod_sishab\PropostasMcmv;

use Illuminate\Database\Eloquent\Model;

use App\Tab_dominios\TipoComunidade;

class TipoComunidadeRural extends Model
{
    protected $table = 'tab_tipo_comunidade_rural';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function tipoComunidade()
    {
    	return $this->belongsTo(TipoComunidade::class); //possui muitos
    }

}
