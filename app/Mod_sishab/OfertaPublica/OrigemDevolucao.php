<?php

namespace App\Mod_sishab\OfertaPublica;

use Illuminate\Database\Eloquent\Model;

class OrigemDevolucao extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'opc_origem_devolucao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function remessasDevolucao()
    {
       return $this->hasMany(RemessaDevolucao::class); 
    }

}
