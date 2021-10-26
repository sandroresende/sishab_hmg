<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class RestricaoContrato extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'tab_restricao_contrato';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function tipoRestricao()
    {
       return $this->belongsTo(TipoRestricao::class); //possui muitos
    }
}
