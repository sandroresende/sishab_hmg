<?php

namespace App\ente_publico;

use Illuminate\Database\Eloquent\Model;

class Legislacao extends Model
{
    protected $table = 'opc_legislacao';

    public function visualizacoes(){
        return $this->hasMany(VisualizacaoLegislacao::class);
    }
}
