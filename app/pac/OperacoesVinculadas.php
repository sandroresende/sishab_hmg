<?php

namespace App\pac;

use Illuminate\Database\Eloquent\Model;

class OperacoesVinculadas extends Model
{
    protected $table = 'view_operacoes_vinculadas';
    
    public function projetosPacs()
    {
       return $this->belongsToMany(ProjetosPac::class,'projeto_pac_id','projeto_pac_id'); //possui muitos
    }
    
}
