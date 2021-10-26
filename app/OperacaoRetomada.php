<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperacaoRetomada extends Model
{
    protected $table = 'tab_operacao_retomada';

    public function retomadas()
    {
       return $this->hasMany(Retomada::class); //possui muitos
    }

    public function resumoOperacao()
    {
       return $this->belongsTo(ResumoOperacao::class); //possui muitos
    }

    public function municipio()    {
       return $this->belongsTo(Municipio::class); //possui muitos
    } 
}
