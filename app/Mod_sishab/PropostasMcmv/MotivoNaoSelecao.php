<?php

namespace App\Mod_sishab\PropostasMcmv;

use Illuminate\Database\Eloquent\Model;

use App\Tab_dominios\TipoMotivoNaoSelecao;

class MotivoNaoSelecao extends Model
{
    protected $table = 'tab_motivo_nao_selecao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function tipoMotivoNaoSelecao()
    {
    	return $this->belongsTo(TipoMotivoNaoSelecao::class); //possui muitos
    }
    
}
