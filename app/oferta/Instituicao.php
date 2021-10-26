<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'opc_instituicoes_financeiras';

        // protocolos metodo.
        public function protocolos()
        {
           return $this->belongsToMany(Protocolo::class, 'tab_protocolos_instituicao');
        } 

}
