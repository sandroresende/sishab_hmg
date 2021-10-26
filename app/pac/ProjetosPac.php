<?php

namespace App\pac;

use Illuminate\Database\Eloquent\Model;

class ProjetosPac extends Model
{
    protected $table = 'view_projetos_pac';

    public function operacoesVinculadas()
    {
       return $this->belongsToMany(OperacoesVinculadas::class,'projeto_pac_id','projeto_pac_id'); //possui muitos
    }
}
