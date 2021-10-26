<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class PagamentosContratosParcelaDtePagam extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'view_pagamentos_contratos_por_parcela_dte_pag';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}