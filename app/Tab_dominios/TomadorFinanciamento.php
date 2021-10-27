<?php

namespace App\Tab_dominios;

use Illuminate\Database\Eloquent\Model;

class TomadorFinanciamento extends Model
{
    protected $table = 'opc_tomador_financiamento';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function itensDeclaratoriosPropostas()
    {
    	return $this->hasMany(ItensDeclaratoriosPropostas::class); //possui muitos
    }

}
