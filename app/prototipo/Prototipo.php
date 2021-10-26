<?php

namespace App\prototipo;

use Illuminate\Database\Eloquent\Model;

class Prototipo extends Model
{
    protected $table = 'tab_prototipo';

   
    public function situacaoPrototipo()
    {
       return $this->belongsTo(SituacaoPrototipo::class); //possui muitos
    }
       
    
   // public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
