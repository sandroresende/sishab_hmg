<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'tab_contratos';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function protocolo()
    {
       return $this->belongsTo(Protocolo::class); 
    }


}
