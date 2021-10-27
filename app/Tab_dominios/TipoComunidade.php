<?php

namespace App\Tab_dominios;

use Illuminate\Database\Eloquent\Model;

use App\Mod_sishab\Propostas_mcmv\TipoComunidadeRural;

class TipoComunidade extends Model
{
    protected $table = 'opc_tipo_comunidade';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function tipoComunidade()
    {
    	return $this->hasMany(TipoComunidade::class); //possui muitos
    }

}
