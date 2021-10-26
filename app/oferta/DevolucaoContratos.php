<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class DevolucaoContratos extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'tab_devolucao_contratos';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function remessasDevolucao()
    {
       return $this->hasMany(RemessaDevolucao::class); 
    }

    public function situacoesDevolucao()
    {
       return $this->hasMany(SituacaoDevolucao::class,'devolucao_contratos_id','id'); 
    }
}
