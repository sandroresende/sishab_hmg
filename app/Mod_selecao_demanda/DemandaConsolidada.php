<?php

namespace App\Mod_selecao_demanda;

use Illuminate\Database\Eloquent\Model;

use App\Mod_sishab\Operacoes\ViewOperacoesContratadas;

class DemandaConsolidada extends Model
{
    protected $table = 'tab_demanda_consolidada';

    
    public function operacoesContratadas()
    {
       return $this->belongsTo(ViewOperacoesContratadas::class,'operacao_id','txt_apf'); //possui muitos
    }
   

       
    
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
