<?php

namespace App\Mod_sishab\PropostasMcmv;

use Illuminate\Database\Eloquent\Model;
use App\Tab_dominios\RegimeConstrutivo;
use App\Tab_dominios\TomadorFinanciamento;

class ItensDeclaratoriosPropostas extends Model
{
    protected $table = 'tab_itens_declaratorios_proposta';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function regimeConstrutivo()
    {
    	return $this->belongsTo(RegimeConstrutivo::class); //possui muitos
    }
    
    public function tomadorFinanciamento()
    {
    	return $this->belongsTo(TomadorFinanciamento::class); //possui muitos
    }

}
