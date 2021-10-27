<?php

namespace App\Mod_sishab\Operacoes;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ViewOperacoesContratadasAno extends Model
{
    protected $table = 'view_operacoes_contratadas_por_ano';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização



    public static function dadosRelatorioExecutivoPorAno($where)
    {

        $dadosRelatorioExecutivo =   DB::table('view_operacoes_contratadas_por_ano')
                            ->selectRaw('programa_id, num_ano_assinatura as num_ano_assinatura, 
                            SUM(total_uh_fgts_prod) AS total_uh_fgts_prod, SUM(valor_total_fgts_prod) AS valor_total_fgts_prod,     
                            SUM(total_uh_fgts_fx_15) AS total_uh_fgts_15, SUM(valor_total_fgts_fx_15) AS valor_total_fgts_15,     
                            SUM(total_uh_fgts_fx_2) AS total_uh_fgts_2, SUM(valor_total_fgts_fx_2) AS valor_total_fgts_2, 
                            SUM(total_uh_fgts_fx_3) AS total_uh_fgts_3, SUM(valor_total_fgts_fx_3) AS valor_total_fgts_3, 
                            SUM(total_uh_fgts_gp_1) AS total_uh_fgts_gp_1, SUM(valor_total_fgts_gp_1) AS valor_total_fgts_gp_1, 
                            SUM(total_uh_fgts_gp_2) AS total_uh_fgts_gp_2, SUM(valor_total_fgts_gp_2) AS valor_total_fgts_gp_2, 
                            SUM(total_uh_fgts_gp_3) AS total_uh_fgts_gp_3, SUM(valor_total_fgts_gp_3) AS valor_total_fgts_gp_3, 
                            SUM(total_uh_entidades) AS total_uh_entidades, SUM(valor_total_entidades) AS valor_total_entidades, 
                            SUM(total_uh_far) AS total_uh_far, SUM(valor_total_far) AS valor_total_far, 
                            SUM(total_uh_oferta) AS total_uh_oferta, SUM(valor_total_oferta) AS valor_total_oferta, SUM(total_uh_rural) AS total_uh_rural, 
                            SUM(valor_total_rural) AS valor_total_rural, SUM(total_uh_far_vinc) AS total_uh_far_vinc, SUM(valor_total_far_vinc) AS valor_total_far_vinc,
                            SUM(valor_total_num_uh_fx_23) AS valor_total_num_uh_23, SUM(valor_total_fx_23) AS valor_total_23,
                            SUM(valor_total_num_uh_gp_123) AS valor_total_num_uh_gp_123, SUM(valor_total_gp_123) AS valor_total_gp_123,
                            SUM(valor_total_num_uh_1) AS valor_total_num_uh_1, SUM(valor_total_1) AS valor_total_1')
                                            ->where($where)                                            
                                            ->groupBy('programa_id','num_ano_assinatura')
                                            ->orderBy('num_ano_assinatura')
                                            ->get();     

        return $dadosRelatorioExecutivo;                                            
    }


    public static function resumoRelatorioExecutivoPorAno($where)
    {
        
                return  DB::table('view_operacoes_contratadas_por_ano')
                                ->selectRaw('programa_id, SUM(total_uh_fgts_fx_2) AS total_uh_fgts_2, SUM(valor_total_fgts_fx_2) AS valor_total_fgts_2, 
                                            SUM(total_uh_fgts_prod) AS total_uh_fgts_prod, SUM(valor_total_fgts_prod) AS valor_total_fgts_prod, 
                                            SUM(total_uh_fgts_fx_15) AS total_uh_fgts_15, SUM(valor_total_fgts_fx_15) AS valor_total_fgts_15, 
                                            SUM(total_uh_fgts_fx_3) AS total_uh_fgts_3, SUM(valor_total_fgts_fx_3) AS valor_total_fgts_3, 
                                            SUM(total_uh_fgts_gp_1) AS total_uh_fgts_gp_1, SUM(valor_total_fgts_gp_1) AS valor_total_fgts_gp_1, 
                                            SUM(total_uh_fgts_gp_2) AS total_uh_fgts_gp_2, SUM(valor_total_fgts_gp_2) AS valor_total_fgts_gp_2, 
                                            SUM(total_uh_fgts_gp_3) AS total_uh_fgts_gp_3, SUM(valor_total_fgts_gp_3) AS valor_total_fgts_gp_3, 
                                            SUM(total_uh_entidades) AS total_uh_entidades, SUM(valor_total_entidades) AS valor_total_entidades, 
                                            SUM(total_uh_far) AS total_uh_far, SUM(valor_total_far) AS valor_total_far, 
                                            SUM(total_uh_oferta) AS total_uh_oferta, SUM(valor_total_oferta) AS valor_total_oferta, SUM(total_uh_rural) AS total_uh_rural, 
                                            SUM(valor_total_rural) AS valor_total_rural, SUM(total_uh_far_vinc) AS total_uh_far_vinc, SUM(valor_total_far_vinc) AS valor_total_far_vinc,
                                            SUM(valor_total_num_uh_fx_23) AS valor_total_num_uh_23, SUM(valor_total_fx_23) AS valor_total_23,
                                            SUM(valor_total_num_uh_gp_123) AS valor_total_num_uh_gp_123, SUM(valor_total_gp_123) AS valor_total_gp_123,
                                            SUM(valor_total_num_uh_1) AS valor_total_num_uh_1, SUM(valor_total_1) AS valor_total_1')
                                    ->where($where)
                                    ->groupBy('programa_id')
                                    ->get();     
    }                               

}
