<?php

namespace App\Tab_dominios;

use Illuminate\Database\Eloquent\Model;

use App\Mod_sishab\Propostas_mcmv\MotivoNaoSelecao;

class TipoMotivoNaoSelecao extends Model
{
    protected $table = 'opc_tipo_motivo_nao_selecao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function motivoNaoSelecao()
    {
    	return $this->hasMany(MotivoNaoSelecao::class); //possui muitos
    }
    
}
