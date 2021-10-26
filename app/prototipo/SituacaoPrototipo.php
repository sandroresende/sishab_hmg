<?php

namespace App\prototipo;

use Illuminate\Database\Eloquent\Model;

class SituacaoPrototipo extends Model
{
    protected $table = 'opc_situacao_prototipo';

    public function prototipo()
    {
       return $this->belongsTo(Prototipo::class); //possui muitos
    }

       
    
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
