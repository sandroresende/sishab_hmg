<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstimativaPopulacao extends Model
{
   protected $table = 'tab_estimativa_populacao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public static function qtdePopulacaoEstimada()
    {
        //$populacao = new self();
        $ano_max = EstimativaPopulacao::max('num_ano_referencia');
        $where = [];        
        $where[] = ['num_ano_referencia',$ano_max];

        return EstimativaPopulacao::selectRaw('num_ano_referencia,sum(vlr_populacao_estimada) as total_populacao')
                                    ->where($where)
                                    ->groupBy('num_ano_referencia')
                                    ->firstOrFail();
    } 

    public static function qtdePopulacaoEstado($ufId)
    {
        //$populacao = new self();
        $ano_max = EstimativaPopulacao::max('num_ano_referencia');
        $where = [];
        $where[] = ['tab_uf.id',$ufId]; 
        $where[] = ['num_ano_referencia',$ano_max];

        return EstimativaPopulacao::join('tab_municipios','tab_municipios.id','=','tab_estimativa_populacao.municipio_id')
                                    ->join('tab_uf','tab_uf.id','=','tab_municipios.uf_id')
                                    ->selectRaw('tab_uf.txt_uf, tab_uf.txt_sigla_uf, num_ano_referencia,sum(vlr_populacao_estimada) as total_populacao')
                                    ->where($where)
                                    ->groupBy('tab_uf.txt_uf','tab_uf.txt_sigla_uf','num_ano_referencia')
                                    ->firstOrFail();
    } 
    
    public static function qtdePopulacaoMunicipio($municipioId)
    {
        //$populacao = new self();
        $ano_max = EstimativaPopulacao::max('num_ano_referencia');
        $where = [];
        $where[] = ['municipio_id',$municipioId]; 
        $where[] = ['num_ano_referencia',$ano_max];

        return EstimativaPopulacao::join('tab_municipios','tab_municipios.id','=','tab_estimativa_populacao.municipio_id')
                                    ->join('tab_uf','tab_uf.id','=','tab_municipios.uf_id')
                                    ->selectRaw('tab_uf.txt_uf, tab_uf.txt_sigla_uf,tab_municipios.ds_municipio, num_ano_referencia,sum(vlr_populacao_estimada) as total_populacao')
                                    ->where($where)
                                    ->groupBy('tab_uf.txt_uf','tab_uf.txt_sigla_uf','tab_municipios.ds_municipio','num_ano_referencia')
                                    ->firstOrFail();
    } 
    
}
