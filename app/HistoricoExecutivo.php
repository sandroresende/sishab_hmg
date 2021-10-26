<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoExecutivo extends Model
{
    protected $table = 'tab_historico_executivo';

    public function posicaoArquivoExecutivo()
    {
       return $this->belongsTo(PosicaoArquivoExecutivo::class); //possui muitos
    }
}
