<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empreendimentos extends Model
{
    protected $table = 'tab_empreendimentos';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


    public function executivoPj()
    {
       return $this->belongsTo(ExecutivoPj::class); //possui muitos
    } 

    public function operacao()
    {
       return $this->belongsTo(Operacao::class); //possui muitos
    } 

}
