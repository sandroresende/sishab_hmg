<?php

namespace App\Tab_dominios;

use Illuminate\Database\Eloquent\Model;

class Modalidade extends Model
{
    protected $connection	= 'pgsql';

    protected $table = 'opc_modalidades';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function selecoes()
    {
       return $this->hasMany(Selecao::class); //possui muitos
    }
    
}
