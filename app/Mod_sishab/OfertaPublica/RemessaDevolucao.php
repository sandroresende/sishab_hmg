<?php

namespace App\Mod_sishab\OfertaPublica;

use Illuminate\Database\Eloquent\Model;

class RemessaDevolucao extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'tab_remessas_devolucao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function devolucoesContratos()
    {
       return $this->hasMany(DevolucaoContratos::class); 
    }

    public function origemDevolucao()
    {
       return $this->belongsTo(OrigemDevolucao::class,'origem_id','id'); 
    }

    public function situacaoDevolucao()
    {
       return $this->belongsTo(SituacaoDevolucao::class,'situacao_remessa_devolucao_id','id'); 
    }

    public function tipoSituacaoDevolucao()
    {
       return $this->belongsTo(TipoSituacaoDevolucao::class,'situacao_remessa_devolucao_id','id'); 
    }
}
