<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoMotivoNaoSelecao extends Model
{
    protected $table = 'opc_tipo_motivo_nao_selecao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function motivoNaoSelecao()
    {
    	return $this->hasMany(MotivoNaoSelecao::class); //possui muitos
    }
    
}
