<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    protected $table = 'tab_regiao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function ufs()
    {
       return $this->hasMany(Uf::class); //possui muitos
    }
}
