<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumoOperacoesRetomadas extends Model
{
    protected $table = 'view_operacoes_retomadas';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function retomadas()
    {
       return $this->hasMany(Retomada::class); //possui muitos
    }
}
