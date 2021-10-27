<?php

namespace App\Tab_dominios;

use App\Mod_pcva_parcerias\DadosParcerias;

use Illuminate\Database\Eloquent\Model;

class SituacaoAdesao extends Model
{
    protected $table = 'opc_situacao_adesao';

    
    public function dadosParcerias()
    {
       return $this->belongsTo(DadosParcerias::class); //possui muitos
    }     
    
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
