<?php

namespace App\Mod_selecao_demanda;

use Illuminate\Database\Eloquent\Model;

class VisualizacaoLegislacao extends Model
{
   protected $table = 'tab_visualizacao_legislacao';

public function user(){
        return $this->belongsTo(User::class);
    }

public function legislacao(){
        return $this->belongsTo(Legislacao::class);
    }

}
