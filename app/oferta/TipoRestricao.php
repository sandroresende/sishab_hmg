<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class TipoRestricao extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'opc_tipo_restricao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function restricoesContratos()
    {
       return $this->hasMany(RestricaoContrato::class); //possui muitos
    }
}
