<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegimeConstrutivo extends Model
{
    protected $table = 'opc_regime_construtivo';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function itensDeclaratoriosPropostas()
    {
    	return $this->hasMany(ItensDeclaratoriosPropostas::class); //possui muitos
    }

}
