<?php

namespace App\Mod_sishab\OfertaPublica;

use Illuminate\Database\Eloquent\Model;

class Protocolo extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'tab_protocolo';

    public function contratos()
    {
       return $this->hasMany(Contrato::class); 
    }

        // protocolos metodo.
        public function instituicoes()
        {
           return $this->belongsToMany(Instituicao::class, 'tab_protocolos_instituicao');
        } 


}
