<?php

namespace App\Mod_selecao_demanda;

use Illuminate\Database\Eloquent\Model;

class Legislacao extends Model
{
    protected $table = 'opc_legislacao';

    public function visualizacoes(){
        return $this->hasMany(VisualizacaoLegislacao::class);
    }
}
