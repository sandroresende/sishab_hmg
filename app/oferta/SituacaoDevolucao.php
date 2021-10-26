<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class SituacaoDevolucao extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'tab_situacao_devolucao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function devolucoesContratos()
    {
       return $this->hasMany(DevolucaoContratos::class); 
    }

    public function tipoSituacaoDevolucao()
    {
       return $this->belongsTo(TipoSituacaoDevolucao::class,'situacao_devolucao_id','id'); 
    }

}
