<?php

namespace App\pac;

use Illuminate\Database\Eloquent\Model;

class DadosObras extends Model
{
    protected $table = 'tab_dados_obras';
    
    public function situacaoObraPac()
    {
       return $this->belongsTo(SituacaoObraPac::class); //possui muitos
    }

}
