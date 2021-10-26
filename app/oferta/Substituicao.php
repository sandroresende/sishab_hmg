<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class Substituicao extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'tab_substituicao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   
}
