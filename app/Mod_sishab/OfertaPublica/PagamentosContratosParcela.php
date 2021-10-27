<?php

namespace App\Mod_sishab\OfertaPublica;

use Illuminate\Database\Eloquent\Model;

class PagamentosContratosParcela extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'view_pagamentos_contratos_por_parcela';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
}
