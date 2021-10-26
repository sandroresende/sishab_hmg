<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\OperacoesContratadas;
use App\Regiao;
use App\Uf;
use App\Municipio;
use App\Entregas;

use App\PainelContratacaoAno;
use App\PainelEntregaAno;
use App\LiberacaoAnoEntrega;

class QuadrosResumosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function filtro_contratacao()
    {
        return view('painel.consultaContratacao');
    }

    public function consulta_contratacao(Request $request)
    {
       // return $request->all();
        $where = [];

        $regiao = [];
        if($request->regiao){            
            $where[] = ['regiao_id', $request->regiao]; 
            $regiao = Regiao::where('id',$request->regiao)->firstOrFail();             
        }
        
        $estado = [];
        if($request->estado){
            $where[] = ['uf_id', $request->estado]; 
            $estado = Uf::where('id',$request->estado)->firstOrFail();            
        }

        $municipio = [];
        if($request->municipio){
            $where[] = ['municipio_id', $request->municipio]; 
            $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
            
            if(!$request->estado){
                $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
                $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();             
            }
        }

        $rm_ride = [];
        
        if($request->rm_ride){    
            $where[] = ['txt_rm_ride','LIKE', $request->rm_ride]; 
            $rm_ride = $request->rm_ride;              
        }

        $whereDe = [];
        $whereAte = [];
        $ano_de = 0;
        $ano_ate = 0;
        if($request->ano_de){
            $ano_ate = $request->ano_de;
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

        if($request->bln_vigente){
            $where[] = ['bln_vigente', $request->bln_vigente]; 
        }

         //  return $where; 
        $whereStatusEmpreendimento = [];
        $situacoesSelecionadas = [];
        


        if($request->statusEmpreendimento){
           $whereStatusEmpreendimento[] = ['status_empreendimento_id', $request->statusEmpreendimento]; 
           
           $qtd_municipios = OperacoesContratadas::where($whereDe)                                                            
                                                ->where($whereAte)   
                                                ->where($where)
                                                ->whereIn('status_empreendimento_id', $request->statusEmpreendimento)
                                                ->distinct('municipio_id')->count('municipio_id');

            

            $resumoContratadas = OperacoesContratadas::selectRaw('txt_origem,dsc_origem, dsc_faixa, faixa_renda_id, txt_modalidade,
                            sum(vlr_operacao) AS vlr_contratado,
                            sum(qtd_uh_contratadas) AS qtd_uh_contratadas,
                            sum(qtd_uh_distratadas) AS qtd_uh_distratadas,
                            sum(qtd_uh_vigentes) as qtd_uh_vigentes,
                            sum(qtd_uh_nao_entregues) AS qtd_uh_nao_entregues,
                            sum(qtd_uh_entregues) AS qtd_uh_entregues,
                            sum(vlr_sub_ogu) AS vlr_sub_ogu,
                            sum(vlr_sub_fgts) AS vlr_sub_fgts,
                            sum(vlr_operacao - vlr_sub_fgts - vlr_sub_ogu) AS vlr_financiamento')
                    ->where($whereDe)                                                            
                    ->where($whereAte)   
                    ->where($where)
                    ->whereIn('status_empreendimento_id', $request->statusEmpreendimento)
                    ->groupBy('txt_origem','dsc_origem', 'dsc_faixa','faixa_renda_id', 'txt_modalidade')
                    ->orderBy('dsc_origem', 'asc')
                    ->orderBy('dsc_faixa', 'asc')        
                    ->get(); 
        }else{            

            $qtd_municipios = OperacoesContratadas::where($whereDe)                                                            
                                                    ->where($whereAte)   
                                                    ->where($where)
                                                    ->distinct('municipio_id')->count('municipio_id');


            $resumoContratadas = OperacoesContratadas::selectRaw('txt_origem,dsc_origem, dsc_faixa, faixa_renda_id, txt_modalidade,
                                                            sum(vlr_operacao) AS vlr_contratado,
                                                            sum(qtd_uh_contratadas) AS qtd_uh_contratadas,
                                                            sum(qtd_uh_distratadas) AS qtd_uh_distratadas,
                                                            sum(qtd_uh_vigentes) as qtd_uh_vigentes,
                                                            sum(qtd_uh_nao_entregues) AS qtd_uh_nao_entregues,
                                                            sum(qtd_uh_entregues) AS qtd_uh_entregues,
                                                            sum(vlr_sub_ogu) AS vlr_sub_ogu,
                                                            sum(vlr_sub_fgts) AS vlr_sub_fgts,
                                                            sum(vlr_operacao - vlr_sub_fgts - vlr_sub_ogu) AS vlr_financiamento')
                                                    ->where($whereDe)                                                            
                                                    ->where($whereAte)   
                                                    ->where($where)
                                                    ->groupBy('txt_origem','dsc_origem', 'dsc_faixa','faixa_renda_id', 'txt_modalidade')
                                                    ->orderBy('dsc_origem', 'asc')
                                                    ->orderBy('dsc_faixa', 'asc')        
                                                    ->get();   
        }//final if            

        $valoresMCMV = ['contratadas'=> 0, 'entregues'=> 0, 'valor_contratado'=> 0]; 
        $valoresFaixa1 = ['distratadas'=> 0,'vigentes'=> 0, 'entregues'=> 0, 'nao_entregues'=> 0, 'contratadas'=> 0, 'valor_contratado'=> 0]; 
        $valoresFgts = ['contratadas'=> 0, 'entregues'=> 0,'subsidio_ogu'=> 0, 'subsidio_fgts'=> 0, 'financiamento'=> 0, 'valor_contratado'=> 0]; 
        $unidadesContratadas = 0;
        $valorContratado = 0;
        foreach($resumoContratadas as $dados){  
            if( $dados->faixa_renda_id == 1 ){
                $valoresFaixa1['distratadas'] += empty($dados->qtd_uh_distratadas) ? 0 : $dados->qtd_uh_distratadas;     
                $valoresFaixa1['vigentes'] += empty($dados->qtd_uh_vigentes) ? 0 : $dados->qtd_uh_vigentes;     
                $valoresFaixa1['entregues'] += empty($dados->qtd_uh_entregues) ? 0 : $dados->qtd_uh_entregues;     
                $valoresFaixa1['nao_entregues'] += empty($dados->qtd_uh_nao_entregues) ? 0 : $dados->qtd_uh_nao_entregues;     
                $valoresFaixa1['contratadas'] += empty($dados->qtd_uh_contratadas) ? 0 : $dados->qtd_uh_contratadas;     
                $valoresFaixa1['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;     
            }else{
                $valoresFgts['contratadas'] += empty($dados->qtd_uh_contratadas) ? 0 : $dados->qtd_uh_contratadas;     
                $valoresFgts['entregues'] += empty($dados->qtd_uh_entregues) ? 0 : $dados->qtd_uh_entregues;     
                $valoresFgts['subsidio_ogu'] += empty($dados->vlr_sub_ogu) ? 0 : $dados->vlr_sub_ogu;                     
                $valoresFgts['subsidio_fgts'] += empty($dados->vlr_sub_fgts) ? 0 : $dados->vlr_sub_fgts;     
                $valoresFgts['financiamento'] += empty($dados->vlr_financiamento) ? 0 : $dados->vlr_financiamento;     
                $valoresFgts['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;    
            }

               
                $valoresMCMV['contratadas'] += empty($dados->qtd_uh_contratadas) ? 0 : $dados->qtd_uh_contratadas;     
                $valoresMCMV['entregues'] += empty($dados->qtd_uh_entregues) ? 0 : $dados->qtd_uh_entregues;                     
                $valoresMCMV['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;    
                 
                 $unidadesContratadas += empty($dados->qtd_uh_contratadas) ? 0 : $dados->qtd_uh_contratadas;    
                 $valorContratado += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;    

        }    

        //return $valoresFgts;
        return view('painel.dados_painel_contratacao', compact('resumoContratadas','valoresFaixa1','valoresFgts','valoresMCMV',
                                                                'qtd_municipios','unidadesContratadas','valorContratado',
                                                                'municipio','estado','regiao','rm_ride','ano_de','ano_ate'));
    }


    public function filtro_contratos_vigentes()
    {
        return view('painel.consultaContratosVigentes');
    }

    public function consulta_vigentes(Request $request)
    {
       // return $request->all();
        $where = [];
       // $where[] = ['modalidade_id','!=',5];
        $regiao = [];
        if($request->regiao){            
            $where[] = ['regiao_id', $request->regiao]; 
            $regiao = Regiao::where('id',$request->regiao)->firstOrFail();             
        }
        
        $estado = [];
        if($request->estado){
            $where[] = ['uf_id', $request->estado]; 
            $estado = Uf::where('id',$request->estado)->firstOrFail();            
        }

        $municipio = [];
        if($request->municipio){
            $where[] = ['municipio_id', $request->municipio]; 
            $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
            
            if(!$request->estado){
                $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
                $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();             
            }
        }

        $rm_ride = [];
        
        if($request->rm_ride){    
            $where[] = ['txt_rm_ride','LIKE', $request->rm_ride]; 
            $rm_ride = $request->rm_ride;              
        }

        $whereDe = [];
        $whereAte = [];
        $ano_de = 0;
        $ano_ate = 0;
        if($request->ano_de){
            $ano_ate = $request->ano_de;
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

        $where[] = ['bln_vigente', true]; 

        //$whereStatusEmpreendimento = [];
        //$situacoesSelecionadas = [];
        

        $valorContratado = 0;
                   




            $qtd_municipios_fx1 = OperacoesContratadas::selectRaw('COUNT(DISTINCT operacao_id) AS qtd_contratos, COUNT(DISTINCT municipio_id) AS qtd_municipios')
            ->where($whereDe)                                                            
            ->where($whereAte)   
            ->where($where)
            ->where('faixa_renda_id', 1)
            ->first();

            $qtd_municipios_fgts = OperacoesContratadas::selectRaw('COUNT(DISTINCT operacao_id) AS qtd_contratos, COUNT(DISTINCT municipio_id) AS qtd_municipios')
            ->where($whereDe)                                                            
            ->where($whereAte)   
            ->where($where)
            ->where('faixa_renda_id','!=', 1)
            ->first();


            
            $resumoVigentes = OperacoesContratadas::selectRaw('txt_status_empreendimento,CASE WHEN faixa_renda_id = 1 THEN 1 ELSE 2 END AS faixa,
                                                    sum(qtd_uh_vigentes) as qtd_uh_vigentes,
                                                    count(DISTINCT operacao_id) AS qtd_contratos,
                                                    sum(vlr_operacao) AS vlr_contratado,
                                                    count(DISTINCT municipio_id) AS qtd_municipios')
                                            ->where($whereDe)                                                            
                                            ->where($whereAte)   
                                            ->where($where)
                                            ->groupBy('txt_status_empreendimento','faixa')
                                            ->orderBy('txt_status_empreendimento', 'asc')        
                                            ->get(); 
        //final if            

        $valoresMCMV = ['vigentes'=> 0, 'contratos'=> 0,  'valor_contratado'=> 0, 'municipios' => 0]; 
        $valoresFaixa1 = ['vigentes'=> 0, 'contratos'=> $qtd_municipios_fx1->qtd_contratos,  'valor_contratado'=> 0, 'municipios' => $qtd_municipios_fx1->qtd_municipios]; 
        $valoresFgts = ['vigentes'=> 0, 'contratos'=> $qtd_municipios_fgts->qtd_contratos,  'valor_contratado'=> 0, 'municipios' => $qtd_municipios_fgts->qtd_municipios]; 
        
        foreach($resumoVigentes as $dados){  
            if( $dados->faixa == 1 ){
                $valoresFaixa1['vigentes'] += empty($dados->qtd_uh_vigentes) ? 0 : $dados->qtd_uh_vigentes;     
                $valoresFaixa1['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;  
               
            }else{
                $valoresFgts['vigentes'] += empty($dados->qtd_uh_vigentes) ? 0 : $dados->qtd_uh_vigentes;     
                $valoresFgts['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;  
               
            }

               
                $valoresMCMV['vigentes'] += empty($dados->qtd_uh_vigentes) ? 0 : $dados->qtd_uh_vigentes;     
                $valoresMCMV['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;  
               
                 
                 $valorContratado += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;    

        }    

        //return $valoresFgts;
        return view('painel.dados_painel_vigentes', compact('resumoVigentes','valoresFaixa1','valoresFgts','valoresMCMV',
                                                                'qtd_municipios_fx1','qtd_municipios_fgts', 'valorContratado',
                                                                'municipio','estado','regiao','rm_ride','ano_de','ano_ate'));
    }

    public function filtro_contratacao_ano()
    {
        return view('painel.consultaContratacaoAno');
    }

    public function consulta_contratacao_ano(Request $request)
    {
       // return $request->all();
        $where = [];
        $parametrosFiltro = 0;
        $parametrosRegionais = 0;

        $regiao = [];
        if($request->regiao){            
            $where[] = ['regiao_id', $request->regiao]; 
            $regiao = Regiao::where('id',$request->regiao)->firstOrFail();             
            $parametrosFiltro = 1;
        }
        
        
        $estado = [];
        if($request->estado){
            $where[] = ['uf_id', $request->estado]; 
            $estado = Uf::where('id',$request->estado)->firstOrFail();            
            $parametrosFiltro = 1;
        }

        $municipio = [];
        if($request->municipio){
            $where[] = ['municipio_id', $request->municipio]; 
            $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
            
            if(!$request->estado){
                $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
                $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();             
            }

            $parametrosFiltro = 1;
        }

        $rm_ride = [];
        
        
        if($request->rm_ride){    
            $where[] = ['txt_rm_ride','LIKE', $request->rm_ride]; 
            $rm_ride = $request->rm_ride;   
            $parametrosFiltro = 1;           
        }

        $whereDe = [];
        $whereAte = [];
        $ano_de = 0;
        $ano_ate = 0;
        if($request->ano_de){
            $where[] = ['num_ano_assinatura', '>=', $request->ano_de];     
            $parametrosFiltro = 1;       
            $ano_de = $request->ano_de     ;
        }

        if($parametrosFiltro = 0){
            $contratacaoAno = PainelContratacaoAno::selectRaw('txt_regiao, sum(uh_faixa_1) as uh_faixa_1,sum(uh_faixa_15) as uh_faixa_15,
                                                            sum(uh_faixa_2) as uh_faixa_2,sum(uh_faixa_3) as uh_faixa_3, 
                                                            sum(uh_producao_estoque) as uh_producao_estoque,
                                                            sum(vlr_contratado) as vlr_contratado,sum(qtd_uh_contratada) as qtd_uh_contratada ')
                                                ->groupBy('txt_regiao')
                                                ->orderBy('txt_regiao')
                                                ->get();
        }else{
            if($request->regiao || $request->estado || $request->municipio || $request->rm_ride){
                $parametrosRegionais = 1;
                 $contratacaoAno = PainelContratacaoAno::selectRaw('txt_regiao, txt_sigla_uf, ds_municipio,
                                                            sum(uh_faixa_1) as uh_faixa_1,sum(uh_faixa_15) as uh_faixa_15,
                                                            sum(uh_faixa_2) as uh_faixa_2,sum(uh_faixa_3) as uh_faixa_3, 
                                                            sum(uh_producao_estoque) as uh_producao_estoque,
                                                            sum(vlr_contratado) as vlr_contratado,sum(qtd_uh_contratada) as qtd_uh_contratada ')
                                                ->where($where)
                                                ->groupBy('txt_regiao','txt_sigla_uf', 'ds_municipio')
                                                ->orderBy('txt_sigla_uf', 'asc')
                                                ->orderBy('ds_municipio', 'asc')
                                                ->get();
            }else{
                $contratacaoAno = PainelContratacaoAno::selectRaw('txt_regiao, sum(uh_faixa_1) as uh_faixa_1,sum(uh_faixa_15) as uh_faixa_15,
                                                            sum(uh_faixa_2) as uh_faixa_2,sum(uh_faixa_3) as uh_faixa_3, 
                                                            sum(uh_producao_estoque) as uh_producao_estoque,
                                                            sum(vlr_contratado) as vlr_contratado,sum(qtd_uh_contratada) as qtd_uh_contratada ')
                                                ->where($where)
                                                ->groupBy('txt_regiao')
                                                ->orderBy('txt_regiao')
                                                ->get();
            }                                    

        }

        $valoresMCMV = ['faixa1'=> 0, 'faixa15'=> 0, 'faixa2'=> 0,'faixa3'=> 0,'producao'=> 0, 'valor_contratado'=> 0, 'contratadas' => 0]; 
        
        foreach($contratacaoAno as $dados){

            $valoresMCMV['faixa1'] += empty($dados->uh_faixa_1) ? 0 : $dados->uh_faixa_1;  
            $valoresMCMV['faixa15'] += empty($dados->uh_faixa_15) ? 0 : $dados->uh_faixa_15;  
            $valoresMCMV['faixa2'] += empty($dados->uh_faixa_2) ? 0 : $dados->uh_faixa_2;  
            $valoresMCMV['faixa3'] += empty($dados->uh_faixa_3) ? 0 : $dados->uh_faixa_3;  
            $valoresMCMV['producao'] += empty($dados->uh_producao_estoque) ? 0 : $dados->uh_producao_estoque;  
            $valoresMCMV['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;  
            $valoresMCMV['contratadas'] += empty($dados->qtd_uh_contratada) ? 0 : $dados->qtd_uh_contratada;  
        }
        

        return view('painel.dados_painel_contratacao_ano', compact('contratacaoAno', 'valoresMCMV',
                                                'parametrosFiltro','parametrosRegionais',
                                                'municipio','estado','regiao','rm_ride','ano_de'));
    }    

    public function filtro_entrega_ano()
    {
        return view('painel.consultaEntregaAno');
    }
    

    public function consulta_entrega_ano(Request $request)
    {
        //return $request->all();
        $where = [];
        $parametrosFiltro = 0;
        $parametrosRegionais = 0;

        $regiao = [];
        if($request->regiao){            
            $where[] = ['regiao_id', $request->regiao]; 
            $whereLiberacao[] = ['regiao_id', $request->regiao]; 
            $regiao = Regiao::where('id',$request->regiao)->firstOrFail();             
            $parametrosFiltro = 1;
        }
        
        
        $estado = [];
        if($request->estado){
            $where[] = ['uf_id', $request->estado]; 
            $whereLiberacao[] = ['uf_id', $request->estado]; 
            $estado = Uf::where('id',$request->estado)->firstOrFail();            
            $parametrosFiltro = 1;
        }

        $municipio = [];
        if($request->municipio){
            $where[] = ['municipio_id', $request->municipio]; 
            $whereLiberacao[] = ['municipio_id', $request->municipio]; 
            $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
            
            if(!$request->estado){
                $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
                $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();             
            }

            $parametrosFiltro = 1;
        }

        $rm_ride = [];
        
        
        if($request->rm_ride){    
            $where[] = ['txt_rm_ride','LIKE', $request->rm_ride]; 
            $whereLiberacao[] = ['txt_rm_ride','LIKE', $request->rm_ride]; 
            $rm_ride = $request->rm_ride;   
            $parametrosFiltro = 1;           
        }

        $whereDe = [];
        $whereAte = [];
        $ano_de = 0;
        $ano_ate = 0;
        if($request->ano_de){
            $where[] = ['num_ano_entrega', $request->ano_de];     
            $whereLiberacao[] = ['num_ano_liberacao', $request->ano_de];     
            $parametrosFiltro = 1;       
            $ano_de = $request->ano_de     ;
        }
        
        //return $where;
        //return $parametrosFiltro;
        if($parametrosFiltro == 0){
         
            $entregaAno = Entregas::join('tab_municipios','tab_entregas.municipio_id', '=','tab_municipios.id')
                                           ->join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                           ->join('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id')            
                                            ->selectRaw('txt_regiao, 
                                            sum(
                                                CASE
                                                    WHEN tab_entregas.faixa_renda_id = 1 THEN 1
                                                    ELSE 0
                                                END) AS uh_faixa_1,
                                            sum(
                                                CASE
                                                    WHEN tab_entregas.faixa_renda_id = 4 THEN 1
                                                    ELSE 0
                                                END) AS uh_faixa_15,
                                            sum(
                                                CASE
                                                    WHEN tab_entregas.faixa_renda_id = 2 THEN 1
                                                    ELSE 0
                                                END) AS uh_faixa_2,
                                            sum(
                                                CASE
                                                    WHEN tab_entregas.faixa_renda_id = 3 THEN 1
                                                    ELSE 0
                                                END) AS uh_faixa_3,
                                            count(tab_entregas.txt_cpf_mutuario) AS qtd_uh_entregues,
                                            sum(
                                                CASE
                                                    WHEN tab_entregas.faixa_renda_id = 1 THEN tab_entregas.vlr_unidade_habitacional
                                                    ELSE 0
                                                END) AS vlr_uh_entregues_fx1,
                                                sum(
                                                    CASE
                                                        WHEN tab_entregas.faixa_renda_id != 1 THEN 0
                                                        ELSE tab_entregas.vlr_unidade_habitacional
                                                    END) AS vlr_uh_entregues_fgts')                   
                                                ->groupBy('txt_regiao')                                                
                                                ->orderBy('txt_regiao')
                                                ->get();
                                                   ;

                         $liberacaoEntregaFx1  = LiberacaoAnoEntrega::sum('vlr_liberacao');  
                    
                                                                                  

        }else{
            if($request->regiao || $request->estado || $request->municipio || $request->rm_ride){
               
                $parametrosRegionais = 1;
                $entregaAno = Entregas::join('tab_municipios','tab_entregas.municipio_id', '=','tab_municipios.id')
                                           ->join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                           ->join('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id')            
                                            ->selectRaw('txt_regiao, txt_sigla_uf, ds_municipio, 
                                            sum(
                                                CASE
                                                    WHEN tab_entregas.faixa_renda_id = 1 THEN 1
                                                    ELSE 0
                                                END) AS uh_faixa_1,
                                            sum(
                                                CASE
                                                    WHEN tab_entregas.faixa_renda_id = 4 THEN 1
                                                    ELSE 0
                                                END) AS uh_faixa_15,
                                            sum(
                                                CASE
                                                    WHEN tab_entregas.faixa_renda_id = 2 THEN 1
                                                    ELSE 0
                                                END) AS uh_faixa_2,
                                            sum(
                                                CASE
                                                    WHEN tab_entregas.faixa_renda_id = 3 THEN 1
                                                    ELSE 0
                                                END) AS uh_faixa_3,
                                            count(tab_entregas.txt_cpf_mutuario) AS qtd_uh_entregues,
                                            sum(
                                                CASE
                                                    WHEN tab_entregas.faixa_renda_id = 1 THEN tab_entregas.vlr_unidade_habitacional
                                                    ELSE 0
                                                END) AS vlr_uh_entregues_fx1,
                                                sum(
                                                    CASE
                                                        WHEN tab_entregas.faixa_renda_id != 1 THEN 0
                                                        ELSE tab_entregas.vlr_unidade_habitacional
                                                    END) AS vlr_uh_entregues_fgts')
                                            ->where($where)                                
                                            ->groupBy('txt_regiao', 'txt_sigla_uf', 'ds_municipio')                                                
                                            ->orderBy('txt_sigla_uf', 'asc')
                                            ->orderBy('ds_municipio', 'asc')
                                                ->get()
                                                   ;

                         $liberacaoEntregaFx1  = LiberacaoAnoEntrega::where($whereLiberacao)
                                                    ->sum('vlr_liberacao');  
            }else{
                
               
                $entregaAno = Entregas::join('tab_municipios','tab_entregas.municipio_id', '=','tab_municipios.id')
                                        ->join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                        ->join('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id')            
                                        ->selectRaw('txt_regiao,
                                        sum(
                                            CASE
                                                WHEN tab_entregas.faixa_renda_id = 1 THEN 1
                                                ELSE 0
                                            END) AS uh_faixa_1,
                                        sum(
                                            CASE
                                                WHEN tab_entregas.faixa_renda_id = 4 THEN 1
                                                ELSE 0
                                            END) AS uh_faixa_15,
                                        sum(
                                            CASE
                                                WHEN tab_entregas.faixa_renda_id = 2 THEN 1
                                                ELSE 0
                                            END) AS uh_faixa_2,
                                        sum(
                                            CASE
                                                WHEN tab_entregas.faixa_renda_id = 3 THEN 1
                                                ELSE 0
                                            END) AS uh_faixa_3,
                                        count(tab_entregas.txt_cpf_mutuario) AS qtd_uh_entregues,
                                        sum(
                                            CASE
                                                WHEN tab_entregas.faixa_renda_id = 1 THEN tab_entregas.vlr_unidade_habitacional
                                                ELSE 0
                                            END) AS vlr_uh_entregues_fx1,
                                            sum(
                                                CASE
                                                    WHEN tab_entregas.faixa_renda_id != 1 THEN 0
                                                    ELSE tab_entregas.vlr_unidade_habitacional
                                                END) AS vlr_uh_entregues_fgts')
                                        ->where($where)                                
                                        ->groupBy('txt_regiao')                                                
                                        ->orderBy('txt_regiao', 'asc')
                                            ->get();

                         $liberacaoEntregaFx1  = LiberacaoAnoEntrega::where($whereLiberacao)
                                                    ->sum('vlr_liberacao');                            
            }                                    

        }

        $valoresMCMV = ['faixa1'=> 0, 'faixa15'=> 0, 'faixa2'=> 0,'faixa3'=> 0,'entregues'=> 0, 'valor_uh_entregues'=> 0]; 
        $liberacaoEntregaFgts = 0;
        $liberacaoEntrega = 0;
        foreach($entregaAno as $dados){

            $valoresMCMV['faixa1'] += empty($dados->uh_faixa_1) ? 0 : $dados->uh_faixa_1;  
            $valoresMCMV['faixa15'] += empty($dados->uh_faixa_15) ? 0 : $dados->uh_faixa_15;  
            $valoresMCMV['faixa2'] += empty($dados->uh_faixa_2) ? 0 : $dados->uh_faixa_2;  
            $valoresMCMV['faixa3'] += empty($dados->uh_faixa_3) ? 0 : $dados->uh_faixa_3;              
            $valoresMCMV['entregues'] += $dados->qtd_uh_entregues;      
            $valoresMCMV['valor_uh_entregues'] += $dados->vlr_uh_entregues_fx1+$dados->vlr_uh_entregues_fgts;      

            $liberacaoEntregaFgts += $dados->vlr_uh_entregues_fgts;
        }

        $liberacaoEntrega = $liberacaoEntregaFx1 + $liberacaoEntregaFgts;
        
        //return $valoresMCMV;

        return view('painel.dados_painel_entrega_ano', compact('entregaAno', 'valoresMCMV',
                                                'parametrosFiltro','parametrosRegionais','liberacaoEntrega',
                                                'municipio','estado','regiao','rm_ride','ano_de'));
    }

    public function filtro_paralisadas()
    {
        return view('painel.consultaParalisadas');
    }
    

    public function consulta_paralisadas(Request $request)
    {

         //return $request->all();
         $where = [];
         $parametrosFiltro = 0;
         $parametrosRegionais = 0;
 
         $regiao = [];
         if($request->regiao){            
             $where[] = ['regiao_id', $request->regiao]; 
             $whereLiberacao[] = ['regiao_id', $request->regiao]; 
             $regiao = Regiao::where('id',$request->regiao)->firstOrFail();             
             $parametrosFiltro = 1;
         }
         
         
         $estado = [];
         if($request->estado){
             $where[] = ['uf_id', $request->estado]; 
             $whereLiberacao[] = ['uf_id', $request->estado]; 
             $estado = Uf::where('id',$request->estado)->firstOrFail();            
             $parametrosFiltro = 1;
         }
 
         $municipio = [];
         if($request->municipio){
             $where[] = ['municipio_id', $request->municipio]; 
             $whereLiberacao[] = ['municipio_id', $request->municipio]; 
             $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
             
             if(!$request->estado){
                 $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
                 $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();             
             }
 
             $parametrosFiltro = 1;
         }
 
         $rm_ride = [];
         
         
         if($request->rm_ride){    
             $where[] = ['txt_rm_ride','LIKE', $request->rm_ride]; 
             $whereLiberacao[] = ['txt_rm_ride','LIKE', $request->rm_ride]; 
             $rm_ride = $request->rm_ride;   
             $parametrosFiltro = 1;           
         }
 
         $whereDe = [];
         $whereAte = [];
         $ano_de = 0;
         $ano_ate = 0;


         if($request->ano_de){
            $parametrosFiltro = 1;       

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
         
         
    
    
         $where[] = ['status_empreendimento_id',5];
         //$where[] = ['faixa_renda_id',1];
    
         $qtd_municipios_fx1 = OperacoesContratadas::where($whereDe)                                                            
                                                ->where($whereAte)   
                                                ->where($where)
                                                ->where('faixa_renda_id',1)
                                                ->distinct('municipio_id')->count('municipio_id');
         $qtd_municipios_fgts = OperacoesContratadas::where($whereDe)                                                            
                                                ->where($whereAte)   
                                                ->where($where)
                                                ->where('faixa_renda_id','!=',1)
                                                ->distinct('municipio_id')->count('municipio_id');                                                


   $resumoParalisadas = OperacoesContratadas::selectRaw('txt_modalidade,CASE
                                                                        WHEN faixa_renda_id = 1 THEN 1
                                                                        ELSE 0
                                                                        END AS bln_faixa,
                 count(DISTINCT municipio_id) as qtd_municipio,
                 sum(qtd_uh_contratadas) AS qtd_uh_contratadas,
                 sum(vlr_operacao) AS vlr_contratado')                 
         ->where($whereDe)                                                            
         ->where($whereAte)   
         ->where($where)
         ->groupBy('txt_modalidade','bln_faixa')
         ->orderBy('txt_modalidade', 'asc')         
         ->get();   
//final if            

        $valoresMCMV = ['contratadas'=> 0, 'valor_contratado'=> 0]; 
        $valoresFaixa1 = ['contratadas'=> 0, 'municipios'=> $qtd_municipios_fx1, 'valor_contratado'=> 0]; 
        $valoresFgts =['contratadas'=> 0, 'municipios'=> $qtd_municipios_fgts, 'valor_contratado'=> 0]; 
        $unidadesContratadas = 0;
        $valorContratado = 0;
        foreach($resumoParalisadas as $dados){  
        if( $dados->bln_faixa == 1 ){
            $valoresFaixa1['contratadas'] += empty($dados->qtd_uh_contratadas) ? 0 : $dados->qtd_uh_contratadas;     
            $valoresFaixa1['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;     
        }else{
            $valoresFgts['contratadas'] += empty($dados->qtd_uh_contratadas) ? 0 : $dados->qtd_uh_contratadas;     
            $valoresFgts['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;    
        }


        $valoresMCMV['contratadas'] += empty($dados->qtd_uh_contratadas) ? 0 : $dados->qtd_uh_contratadas;     
        $valoresMCMV['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;    

        $unidadesContratadas += empty($dados->qtd_uh_contratadas) ? 0 : $dados->qtd_uh_contratadas;    
        $valorContratado += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;    

        }    

        //return $valoresFaixa1;
        return view('painel.dados_painel_paralisadas', compact('resumoParalisadas','valoresFaixa1','valoresFgts','valoresMCMV',
                            'qtd_municipios','unidadesContratadas','valorContratado',
                            'municipio','estado','regiao','rm_ride','ano_de','ano_ate'));
            
        }

}
