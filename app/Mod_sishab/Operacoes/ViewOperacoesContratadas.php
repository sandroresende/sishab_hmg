<?php

namespace App\Mod_sishab\Operacoes;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ViewOperacoesContratadas extends Model
{
    protected $table = 'view_operacoes_contratadas';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function demandaConsolidada()
    {
       return $this->belongsTo(DemandaConsolidada::class); //possui muitos
    }

    public static function dadosRelatorioExecutivo($where)
    {


        $operacoeContratadas = DB::table('view_operacoes_contratadas')
                        ->selectRaw('programa_id,txt_sigla_programa,
                                    modalidade_id, txt_modalidade,
                                    dsc_faixa,faixa_renda_id, 
                                    sum(qtd_uh_contratadas) as num_uh, 
                                    sum(qtd_uh_concluidas) as num_concluidas, 
                                    sum(qtd_uh_vigentes) as num_vigentes, 
                                    sum(CASE WHEN qtd_uh_distratadas IS NULL THEN 0 ELSE qtd_uh_distratadas END ) as num_distratadas,
                                    sum(qtd_nao_entregues) as num_nao_entregues, 
                                    sum(qtd_uh_entregues) as num_entregues, 
                                    sum(vlr_operacao) as num_vlr_total,
                                    sum(CASE WHEN vlr_liberado IS NULL THEN 0 ELSE vlr_liberado END ) as num_vlr_liberado')
                                ->where($where)
                        ->groupBy('programa_id','txt_sigla_programa','modalidade_id','txt_modalidade', 'dsc_faixa','faixa_renda_id')
                        ->orderBy('programa_id', 'asc')
                        ->orderBy('dsc_faixa', 'asc')
                        ->orderBy('txt_modalidade', 'asc')
                        ->get();
        
        return $operacoeContratadas;                                                            
    } 
    public static function resumoContratadasPrograma($where)
    {


        $resumoContratadasPrograma = DB::table('view_operacoes_contratadas')
                        ->selectRaw('programa_id,txt_sigla_programa,                                    
                                    sum(qtd_uh_contratadas) as num_uh, 
                                    sum(qtd_uh_concluidas) as num_concluidas, 
                                    sum(qtd_uh_vigentes) as num_vigentes, 
                                    sum(qtd_uh_distratadas) as num_distratadas, 
                                    sum(qtd_nao_entregues) as num_nao_entregues, 
                                    sum(qtd_uh_entregues) as num_entregues, 
                                    sum(vlr_operacao) as num_vlr_total,
                                    sum(vlr_liberado) as num_vlr_liberado')
                                ->where($where)
                        ->groupBy('programa_id','txt_sigla_programa')
                        ->orderBy('programa_id', 'asc')
                        ->get();
        
        return $resumoContratadasPrograma;                                                            
    }                                                            

}
