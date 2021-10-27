<?php

namespace App\Tab_dominios;

use Illuminate\Database\Eloquent\Model;

class TipoContrapartida extends Model
{
    protected $table = 'opc_tipo_contrapartida';

    public function dadosParcerias()
    {
       return $this->belongsTo(DadosParcerias::class); //possui muitos
    } 
    
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
