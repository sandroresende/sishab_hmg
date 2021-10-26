<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosicaoArquivoExecutivo extends Model
{
    protected $table = 'tab_posicao_arquivo_executivo';

    public function historicoExecutivos()
    {
       return $this->hasMany(HistoricoExecutivo::class); //possui muitos
    }
}
