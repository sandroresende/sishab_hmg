<?php

namespace App\Mod_sishab\OfertaPublica;

use Illuminate\Database\Eloquent\Model;

class ViewProtocolosInstituicao extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'view_protocolos_instituicao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

  

}
