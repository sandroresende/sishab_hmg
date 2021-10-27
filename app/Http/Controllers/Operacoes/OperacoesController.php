<?php

namespace App\Http\Controllers\Operacoes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\IndicadoresHabitacionais\Regiao;
use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;
use App\IndicadoresHabitacionais\BrasilComRm;

use App\Tab_dominios\StatusEmpreendimento;

use App\Mod_sishab\Operacoes\Operacao;
use App\Mod_sishab\Operacoes\ViewOperacoesContratadas;
use App\Mod_sishab\Operacoes\ViewOperacoesContratadasAno;

//Usadas para o excel
use App\Exports\ResumoMilagrosoExport;
use App\Exports\RelatorioExecutivoExport;
use App\Exports\BaseRelatorioExecutivoExport;
use App\Exports\EmpreendimentosExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class OperacoesController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function consultaRelExecutivoInt(){
        return view('views_sishab.operacoes.filtroRelatorioExecutivo');
    }   

    public function dadosRelatorioExecutivo(Request $request){

         //   return $request->all();
        $where = [];
        $whereDeficit = [];

        $regiao = [];
        if($request->regiao){            
            $where[] = ['regiao_id', $request->regiao]; 
            $whereDeficit[] = ['regiao_id', $request->regiao]; 
            $regiao = Regiao::where('id',$request->regiao)->firstOrFail();             
        }
        
        $estado = [];
        if($request->estado){
            $where[] = ['uf_id', $request->estado]; 
            $whereDeficit[] = ['uf_id', $request->estado]; 
            $estado = Uf::where('id',$request->estado)->firstOrFail();            
        }

        $municipio = [];
        if($request->municipio){
            $where[] = ['cod_mun_ibge', $request->municipio]; 
            $whereDeficit[] = ['cod_mun_ibge', $request->municipio]; 
            $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
            
            if(!$request->estado){
                $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
                $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();             
            }
        }

        $rm_ride = [];
        
        if($request->rm_ride){    
            $where[] = ['txt_ride_rm','LIKE', $request->rm_ride]; 
            $whereDeficit[] = ['txt_ride_rm','LIKE', $request->rm_ride]; 
            $rm_ride = $request->rm_ride;              
        }

        $whereDe = [];
        $whereAte = [];
        $ano_de = 0;
        $ano_ate = 0;
        if($request->ano_de){
            $ano_de = $request->ano_de;
            if($request->ano_ate){
                $whereDe[] = ['num_ano_assinatura', '>=', $request->ano_de];
                 
            }else{
                $whereDe[] = ['num_ano_assinatura', '=', $request->ano_de];                 
            }            
        }

        if($request->ano_ate){
            $ano_ate = $request->ano_ate;
            $whereAte[] = ['num_ano_assinatura', '<=', $ano_ate]; 
        }

        $situacaoVigencia = '';
        if($request->bln_vigente){
            $where[] = ['bln_vigente', $request->bln_vigente]; 
            if($request->bln_vigente == true){
                $situacaoVigencia = 'Empreendimentos Vigentes';
            }else{
                $situacaoVigencia = 'Empreendimentos Não Vigentes';
            }
        }

        
        $whereStatusEmpreendimento = [];
        $situacoesSelecionadas = [];
        
        
        $status = '';
        if($request->statusEmpreendimento){
            $whereStatusEmpreendimento[] = ['status_empreendimento_id', $request->statusEmpreendimento]; 
            $statusEmp = StatusEmpreendimento::whereIn('id', $request->statusEmpreendimento)->get();
            foreach($statusEmp as $dados){
                
                if($status == ''){

                    $status = 'Status Empreendimentos: ' . $dados->txt_status_empreendimento . '; ';
                }else{
                    $status =  $status . $dados->txt_status_empreendimento . '; ';
                }
            }   
                $operacoesContratadas = ViewOperacoesContratadas::selectRaw('programa_id,txt_sigla_programa,
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
                                ->where($whereDe)                                                            
                                ->where($whereAte)   
                                ->where($where)
                                ->whereIn('status_empreendimento_id', $request->statusEmpreendimento)
                                ->groupBy('programa_id','txt_sigla_programa','modalidade_id','txt_modalidade', 'dsc_faixa','faixa_renda_id')
                                ->orderBy('programa_id', 'asc')
                                ->orderBy('dsc_faixa', 'asc')
                                ->orderBy('txt_modalidade', 'asc')
                                ->get();

                $resumoContratadasPrograma = ViewOperacoesContratadas::selectRaw('programa_id,txt_sigla_programa,                                    
                                            sum(qtd_uh_contratadas) as num_uh, 
                                            sum(qtd_uh_concluidas) as num_concluidas, 
                                            sum(qtd_uh_vigentes) as num_vigentes, 
                                             sum(CASE WHEN qtd_uh_distratadas IS NULL THEN 0 ELSE qtd_uh_distratadas END ) as num_distratadas,
                                            sum(qtd_nao_entregues) as num_nao_entregues, 
                                            sum(qtd_uh_entregues) as num_entregues, 
                                            sum(vlr_operacao) as num_vlr_total,
                                            sum(CASE WHEN vlr_liberado IS NULL THEN 0 ELSE vlr_liberado END ) as num_vlr_liberado')
                                            ->where($whereDe)                                                            
                                            ->where($whereAte)   
                                            ->where($where)
                                            ->whereIn('status_empreendimento_id', $request->statusEmpreendimento)
                                ->groupBy('programa_id','txt_sigla_programa')
                                ->orderBy('programa_id', 'asc')
                                ->get(); 

         $dadosRelatorioExecutivoPorAno = ViewOperacoesContratadasAno::selectRaw('programa_id, num_ano_assinatura as num_ano_assinatura, 
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
                                ->where($whereDe)                                                            
                                ->where($whereAte)   
                                ->where($where)     
                                ->whereIn('status_empreendimento_id', $request->statusEmpreendimento)                                     
                                ->groupBy('programa_id','num_ano_assinatura')
                                ->orderBy('num_ano_assinatura')
                                ->get();     

        $resumoRelatorioExecutivoPorAno = ViewOperacoesContratadasAno::selectRaw('programa_id, SUM(total_uh_fgts_fx_2) AS total_uh_fgts_2, SUM(valor_total_fgts_fx_2) AS valor_total_fgts_2, 
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
                        ->where($whereDe)                                                            
                        ->where($whereAte)  
                        ->where($where)
                        ->whereIn('status_empreendimento_id', $request->statusEmpreendimento)                                     
                        ->groupBy('programa_id')
                        ->get(); 

        }  else{ 

            $operacoesContratadas = ViewOperacoesContratadas::selectRaw('programa_id,txt_sigla_programa,
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
                                ->where($whereDe)                                                            
                                ->where($whereAte)   
                                ->where($where)
                                ->groupBy('programa_id','txt_sigla_programa','modalidade_id','txt_modalidade', 'dsc_faixa','faixa_renda_id')
                                ->orderBy('programa_id', 'asc')
                                ->orderBy('dsc_faixa', 'asc')
                                ->orderBy('txt_modalidade', 'asc')
                                ->get();

             $resumoContratadasPrograma = ViewOperacoesContratadas::selectRaw('programa_id,txt_sigla_programa,                                    
                                        sum(qtd_uh_contratadas) as num_uh, 
                                        sum(qtd_uh_concluidas) as num_concluidas, 
                                        sum(qtd_uh_vigentes) as num_vigentes, 
                                        sum(qtd_uh_distratadas) as num_distratadas, 
                                        sum(qtd_nao_entregues) as num_nao_entregues, 
                                        sum(qtd_uh_entregues) as num_entregues, 
                                        sum(vlr_operacao) as num_vlr_total,
                                        sum(vlr_liberado) as num_vlr_liberado')
                                        ->where($whereDe)                                                            
                                        ->where($whereAte)   
                                        ->where($where)
                            ->groupBy('programa_id','txt_sigla_programa')
                            ->orderBy('programa_id', 'asc')
                            ->get();

            $dadosRelatorioExecutivoPorAno = ViewOperacoesContratadasAno::selectRaw('programa_id, num_ano_assinatura as num_ano_assinatura, 
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
                            ->where($whereDe)                                                            
                            ->where($whereAte)   
                            ->where($where)                                          
                            ->groupBy('programa_id','num_ano_assinatura')
                            ->orderBy('num_ano_assinatura')
                            ->get();   

            $resumoRelatorioExecutivoPorAno = ViewOperacoesContratadasAno::selectRaw('programa_id, SUM(total_uh_fgts_fx_2) AS total_uh_fgts_2, SUM(valor_total_fgts_fx_2) AS valor_total_fgts_2, 
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
                                    ->where($whereDe)                                                            
                                    ->where($whereAte)  
                                    ->where($where)
                                    ->groupBy('programa_id')
                                    ->get();   

                                           
        }

        if(count($operacoesContratadas) == 0){
            flash()->erro("Erro", "Não existe dados para os parâmetros. selecionados.");            
            return back();
        }

        $operacoesContratadasMcmv = [];
        $operacoesContratadasCvea = [];
        
        foreach($operacoesContratadas as $dados){
            if($dados->programa_id == 1){
                array_push($operacoesContratadasMcmv, $dados);               
            }else{
                array_push($operacoesContratadasCvea, $dados);                
            }
        }
       // return $operacoesContratadasCvea;
      
       $operacoesContratadasMcmv = json_encode($operacoesContratadasMcmv);
       $operacoesContratadasCvea = json_encode($operacoesContratadasCvea);

        $resumoContratadasProgramaMcmv = $resumoContratadasPrograma;
        $resumoContratadasProgramaMcmv = $resumoContratadasProgramaMcmv->where('programa_id', 1);
          
      
        $resumoContratadasProgramaCvea = $resumoContratadasPrograma;
        $resumoContratadasProgramaCvea = $resumoContratadasProgramaCvea->where('programa_id', 2);

        $dadosRelatorioExecutivoPorAnoMcmv = $dadosRelatorioExecutivoPorAno;
         $dadosRelatorioExecutivoPorAnoMcmv = $dadosRelatorioExecutivoPorAnoMcmv->where('programa_id', 1);

        $resumoRelatorioExecutivoPorAnoMcmv = $resumoRelatorioExecutivoPorAno;
        $resumoRelatorioExecutivoPorAnoMcmv = $resumoRelatorioExecutivoPorAnoMcmv->where('programa_id', 1);
        
        

       // return $operacoesContratadasMcmv;
        //preparando cabeçalho
        $titulo = '';
        
        if(!$municipio && !$estado && !$rm_ride && !$regiao){
            $titulo = 'BRASIL';
        }
        elseif($municipio){
            $titulo = $municipio->ds_municipio . '-' . $estado->txt_sigla_uf;
        }
        else{          
            if($estado){
                $titulo = $estado->txt_uf;
            }elseif($regiao){
                $titulo = $regiao->txt_regiao;
            }elseif($rm_ride){
                $titulo = $rm_ride;
            }
        }    
        
        $subtitulo1 = null;
        $subtitulo2 = null;
        $subtitulo3 = null;
        if( (($ano_de) > 0) && (($ano_ate) == 0) ){
            $subtitulo1 = 'Período de Janeiro/' . $request->ano_de . ' até Dezembro/' . $request->ano_de;
            if($status == ''){
                if($situacaoVigencia != ''){
                    $subtitulo2 = $situacaoVigencia;                  
                }else{
                    $subtitulo3 = $status;
                }       
            }   
        }elseif( (($ano_de) > 0) && (($ano_ate) > 0) ){
            $subtitulo1 = 'Período de Janeiro/' . $request->ano_de . ' até Dezembro/' . $request->ano_ate;
            if($status == ''){
                if($situacaoVigencia != ''){
                    $subtitulo2 = $situacaoVigencia;                  
                }else{
                    $subtitulo3 = $status;
                }       
            }   
        }
            


        
        if($status == ''){
            if($situacaoVigencia != ''){
                $subtitulo3 = $situacaoVigencia;                  
            }     
        }else{
            $subtitulo3 = $status;
        }         
        
        
        $mostrarPeriodo = false;

        return view('views_sishab.operacoes.dadosRelExecutivo',compact('resumoContratadasProgramaCvea',
        'resumoContratadasProgramaMcmv','operacoesContratadasMcmv','operacoesContratadasCvea',
        'titulo','subtitulo1','subtitulo2','subtitulo3','mostrarPeriodo',
    'dadosRelatorioExecutivoPorAnoMcmv','resumoRelatorioExecutivoPorAnoMcmv')); 


    }

    public function dadosAbertos(){
        return view('views_gerais.dados_abertos');    
    }
}

    