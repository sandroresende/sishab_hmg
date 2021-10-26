<?php

namespace App\ente_publico;

use Illuminate\Database\Eloquent\Model;

use App\OperacoesContratadas;

class DemandaConsolidada extends Model
{
    protected $table = 'tab_demanda_consolidada';

    
    public function operacoesContratadas()
    {
       return $this->belongsTo(OperacoesContratadas::class,'operacao_id','operacao_id'); //possui muitos
    }
   

       
    
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
