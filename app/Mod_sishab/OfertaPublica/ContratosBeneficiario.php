<?php

namespace App\Mod_sishab\OfertaPublica;

use Illuminate\Database\Eloquent\Model;

class ContratosBeneficiario extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'tab_contratos_beneficiarios';
}
