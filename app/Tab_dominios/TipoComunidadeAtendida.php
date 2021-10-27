<?php

namespace App\Tab_dominios;

use Illuminate\Database\Eloquent\Model;

use App\Mod_sishab\Propostas_mcmv\TipoComunidadeRural;

class TipoComunidadeAtendida extends Model
{
    protected $table = 'opc_tipo_comunidade_atendida';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function tipoComunidadeRural()
    {
    	return $this->hasMany(TipoComunidadeRural::class); //possui muitos
    }

}
