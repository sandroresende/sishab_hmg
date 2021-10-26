<?php

namespace App\ente_publico;

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
