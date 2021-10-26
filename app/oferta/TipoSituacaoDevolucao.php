<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class TipoSituacaoDevolucao extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'opc_situacao_devolucao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function situacoesDevolucoes()
    {
       return $this->hasMany(SituacaoDevolucao::class); 
    }

}
