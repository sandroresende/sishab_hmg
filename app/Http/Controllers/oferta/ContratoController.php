<?php

namespace App\Http\Controllers\oferta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\oferta\Contrato;
use App\oferta\ResumoContratosProtocolo;
use App\oferta\RestricaoContrato;
use App\oferta\Substituicao;
use App\oferta\Beneficiario;
use App\oferta\PagamentosContrato;
use App\oferta\ResumoPagamentos;
use App\oferta\ResumoProtocolos;
use App\oferta\DevolucaoContratos;
use App\oferta\FaixaExecucao;
use App\oferta\Instituicao;
use App\Uf;
use App\oferta\PagamentosContratosParcela;


class ContratoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function dados_contrato(Contrato $contrato){
        
        $where = [];
        $whereSubs = [];
        $whereBen = [];
        $where[] = ['contrato_id', $contrato->id];
        $whereSubs[] = ['tab_substituicao.contrato_id', $contrato->id];
        $whereSubs[] = ['tab_substituicao.bln_substituido', true];
        $whereBen[] = ['tab_contratos_beneficiarios.contrato_id', $contrato->id];
        $whereBen[] = ['tab_contratos_beneficiarios.bln_ativo', true];
        $wherePag[] = ['contrato_id', $contrato->id];        
       
        $protocolo = ResumoProtocolos::where('protocolo_id',$contrato->protocolo_id)->firstOrFail();
        $restricoes = RestricaoContrato::where($where)
                                                ->orderBy('dte_inclusao','DESC')
                                                ->orderBy('bln_ativa','ASC')
                                                ->get();
        $substituicoes = Substituicao::join('tab_beneficiarios','tab_beneficiarios.txt_nis_beneficiario','=','tab_substituicao.txt_nis_substituido')
                                        ->select('tab_substituicao.id','tab_substituicao.contrato_id','tab_substituicao.txt_nis_substituido','tab_substituicao.txt_cpf_substituido',
                                                 'tab_beneficiarios.txt_nome_beneficiario','tab_substituicao.dte_processamento','tab_substituicao.txt_nis_substituto')   
                                        ->where($whereSubs)              
                                        ->get();
        $beneficiario = Beneficiario::join('tab_contratos_beneficiarios','tab_contratos_beneficiarios.beneficiario_id','=','tab_beneficiarios.id')
                                        ->select('tab_beneficiarios.*')   
                                        ->where($whereBen)              
                                        ->firstOrFail();
        $beneficiario->load('genero','estadoCivil','generoConjuge');

        $pagamentos = PagamentosContrato::where($wherePag)
                                        ->orderBy('notas_pagamento_id','ASC')
                                        ->get();
        $pagamentos->load('notaPagamento');

         $resumoPagamentos = ResumoPagamentos::where($where)
                                            ->firstOrFail();

        $devolucoes = DevolucaoContratos::join('tab_situacao_devolucao','tab_situacao_devolucao.devolucao_contratos_id','=','tab_devolucao_contratos.id')
                                            ->join('opc_situacao_devolucao','tab_situacao_devolucao.situacao_devolucao_id','=','opc_situacao_devolucao.id')
                                    ->where($where)
                                    ->orderBy('remessa_devolucao_id', 'asc')
                                    ->orderBy('situacao_devolucao_id', 'desc')
                                    ->get();   

    $remessaDevolucao = DevolucaoContratos::join('tab_remessas_devolucao','tab_remessas_devolucao.id','=','tab_devolucao_contratos.remessa_devolucao_id')                                                    
                                            ->join('opc_origem_devolucao','opc_origem_devolucao.id','=','tab_remessas_devolucao.origem_id')                                                    
                                                ->where($where)
                                                ->get();                                                

        $restricoes->load('tipoRestricao');
        return view('oferta.dadosContrato',compact('contrato','restricoes','substituicoes','beneficiario','pagamentos','resumoPagamentos','protocolo','devolucoes','remessaDevolucao'));    
    } 

    public function contrato(Request $request){
        // $request->all();
        $whereContrato[] = ['txt_nis_titular', $request->txt_nis];
       if($request->num_oferta){
        $whereContrato[] = ['num_oferta', $request->num_oferta];
       }
        
       
       
            $contrato = Contrato::where($whereContrato)->firstOrFail();
    
            $where = [];
            $whereSubs = [];
            $whereBen = [];
            $where[] = ['contrato_id', $contrato->id];
            $whereSubs[] = ['tab_substituicao.contrato_id', $contrato->id];
            $whereSubs[] = ['tab_substituicao.bln_substituido', true];
            $whereBen[] = ['tab_contratos_beneficiarios.contrato_id', $contrato->id];
            $whereBen[] = ['tab_contratos_beneficiarios.bln_ativo', true];
            $wherePag[] = ['contrato_id', $contrato->id];        
        
            $protocolo = ResumoProtocolos::where('protocolo_id',$contrato->protocolo_id)->firstOrFail();
            $restricoes = RestricaoContrato::where($where)
                                                    ->orderBy('dte_inclusao','DESC')
                                                    ->orderBy('bln_ativa','ASC')
                                                    ->get();
            $substituicoes = Substituicao::join('tab_beneficiarios','tab_beneficiarios.txt_nis_beneficiario','=','tab_substituicao.txt_nis_substituido')
                                            ->select('tab_substituicao.id','tab_substituicao.contrato_id','tab_substituicao.txt_nis_substituido','tab_substituicao.txt_cpf_substituido',
                                                    'tab_beneficiarios.txt_nome_beneficiario','tab_substituicao.dte_processamento','tab_substituicao.txt_nis_substituto')   
                                            ->where($whereSubs)              
                                            ->get();
            $beneficiario = Beneficiario::join('tab_contratos_beneficiarios','tab_contratos_beneficiarios.beneficiario_id','=','tab_beneficiarios.id')
                                            ->select('tab_beneficiarios.*')   
                                            ->where($whereBen)              
                                            ->firstOrFail();
            $beneficiario->load('genero','estadoCivil','generoConjuge');

            $pagamentos = PagamentosContrato::where($wherePag)
                                            ->orderBy('notas_pagamento_id','ASC')
                                            ->get();
            $pagamentos->load('notaPagamento');

            $resumoPagamentos = ResumoPagamentos::where($where)
                                                ->firstOrFail();

            $devolucoes = DevolucaoContratos::join('tab_situacao_devolucao','tab_situacao_devolucao.devolucao_contratos_id','=','tab_devolucao_contratos.id')
                                                    ->join('opc_situacao_devolucao','tab_situacao_devolucao.situacao_devolucao_id','=','opc_situacao_devolucao.id')
                                            ->where($where)
                                            ->orderBy('remessa_devolucao_id', 'desc')
                                            ->orderBy('situacao_devolucao_id', 'desc')
                                            ->get();
                                            

            $remessaDevolucao = DevolucaoContratos::join('tab_remessas_devolucao','tab_remessas_devolucao.id','=','tab_devolucao_contratos.remessa_devolucao_id')                                                    
                                                    ->join('opc_origem_devolucao','opc_origem_devolucao.id','=','tab_remessas_devolucao.origem_id')                                                    
                                                        ->where($where)
                                                        ->get();    
            
            $restricoes->load('tipoRestricao');
            return view('oferta.dadosContrato',compact('contrato','restricoes','substituicoes','beneficiario','pagamentos','resumoPagamentos',
                                                        'protocolo','devolucoes','remessaDevolucao'));                                                         

    }

    public function contrato_oferta($oferta, $nis){
        //return $request->all();
        $whereContrato[] = ['txt_nis_titular', $nis];
        $whereContrato[] = ['num_oferta', $oferta];
      
        
      
       
            $contrato = Contrato::where($whereContrato)->firstOrFail();
    
            $where = [];
            $whereSubs = [];
            $whereBen = [];
            $where[] = ['contrato_id', $contrato->id];
            $whereSubs[] = ['tab_substituicao.contrato_id', $contrato->id];
            $whereSubs[] = ['tab_substituicao.bln_substituido', true];
            $whereBen[] = ['tab_contratos_beneficiarios.contrato_id', $contrato->id];
            $whereBen[] = ['tab_contratos_beneficiarios.bln_ativo', true];
            $wherePag[] = ['contrato_id', $contrato->id];        
        
            $protocolo = ResumoProtocolos::where('protocolo_id',$contrato->protocolo_id)->firstOrFail();
            $restricoes = RestricaoContrato::where($where)
                                                    ->orderBy('dte_inclusao','DESC')
                                                    ->orderBy('bln_ativa','ASC')
                                                    ->get();
            $substituicoes = Substituicao::join('tab_beneficiarios','tab_beneficiarios.txt_nis_beneficiario','=','tab_substituicao.txt_nis_substituido')
                                            ->select('tab_substituicao.id','tab_substituicao.contrato_id','tab_substituicao.txt_nis_substituido','tab_substituicao.txt_cpf_substituido',
                                                    'tab_beneficiarios.txt_nome_beneficiario','tab_substituicao.dte_processamento','tab_substituicao.txt_nis_substituto')   
                                            ->where($whereSubs)              
                                            ->get();
            $beneficiario = Beneficiario::join('tab_contratos_beneficiarios','tab_contratos_beneficiarios.beneficiario_id','=','tab_beneficiarios.id')
                                            ->select('tab_beneficiarios.*')   
                                            ->where($whereBen)              
                                            ->firstOrFail();
            $beneficiario->load('genero','estadoCivil','generoConjuge');

            $pagamentos = PagamentosContrato::where($wherePag)
                                            ->orderBy('notas_pagamento_id','ASC')
                                            ->get();
            $pagamentos->load('notaPagamento');

            $resumoPagamentos = ResumoPagamentos::where($where)
                                                ->firstOrFail();

            $devolucoes = DevolucaoContratos::join('tab_situacao_devolucao','tab_situacao_devolucao.devolucao_contratos_id','=','tab_devolucao_contratos.id')
                                                    ->join('opc_situacao_devolucao','tab_situacao_devolucao.situacao_devolucao_id','=','opc_situacao_devolucao.id')
                                            ->where($where)
                                            ->orderBy('remessa_devolucao_id', 'asc')
                                            ->orderBy('situacao_devolucao_id', 'desc')
                                            ->get();   

            $remessaDevolucao = DevolucaoContratos::join('tab_remessas_devolucao','tab_remessas_devolucao.id','=','tab_devolucao_contratos.remessa_devolucao_id')                                                    
                                                    ->join('opc_origem_devolucao','opc_origem_devolucao.id','=','tab_remessas_devolucao.origem_id')                                                    
                                                        ->where($where)
                                                        ->get();    
            
            $restricoes->load('tipoRestricao');
            return view('oferta.dadosContrato',compact('contrato','restricoes','substituicoes','beneficiario','pagamentos','resumoPagamentos',
                                                        'protocolo','devolucoes','remessaDevolucao'));  

    }

    public function execucaoObras(Request $request){

       // return $request->all();
        $where = [];

        $where[] = ['instituicao_id','<>', 3];
        if($request->estado){
            $where[] = ['id_uf', $request->estado];
            $estado = Uf::where('id',$request->estado)->firstOrFail();
        }

        $instituicao = '';    
        if($request->instituicao){
            $where[] = ['instituicao_id', $request->instituicao];
            $instituicao = Instituicao::where('id',$request->instituicao)->firstOrFail();
        }

        $municipio = '';    
        if($request->municipio){
            $where[] = ['id_municipio', $request->municipio];            
        }
       
        $execucaoObra = FaixaExecucao::selectRaw('id_uf,sg_uf,num_oferta,COUNT(contrato_id) AS total_uh, SUM(de_0_perc) AS total_0_perc, SUM(de_0_a_15_perc) AS total_de_0_a_15_perc, 
                                                        SUM(de_15_a_30_perc) AS total_de_15_a_30_perc, SUM(de_30_a_45_perc) AS total_de_30_a_45_perc, 
                                                        SUM(de_45_a_60_perc) AS total_de_45_a_60_perc, SUM(de_60_a_75_perc) AS total_de_60_a_75_perc, 
                                                        SUM(de_75_a_99_perc) AS total_de_75_a_99_perc, SUM(concluidas) AS total_concluidas,
                                                        SUM(entregues) AS total_entregues, SUM(devolvidas) AS total_devolvidas')
                                                ->where($where)          
                                                ->groupBy('id_uf','sg_uf','num_oferta')
                                                ->orderBy('sg_uf')
                                                ->get();    

        if(($request->municipio) || ($request->estado)){    
            
            $execucaoObra = FaixaExecucao::selectRaw('id_uf,sg_uf,ds_municipio,num_oferta,COUNT(contrato_id) AS total_uh, SUM(de_0_perc) AS total_0_perc, SUM(de_0_a_15_perc) AS total_de_0_a_15_perc, 
                                                        SUM(de_15_a_30_perc) AS total_de_15_a_30_perc, SUM(de_30_a_45_perc) AS total_de_30_a_45_perc, 
                                                        SUM(de_45_a_60_perc) AS total_de_45_a_60_perc, SUM(de_60_a_75_perc) AS total_de_60_a_75_perc, 
                                                        SUM(de_75_a_99_perc) AS total_de_75_a_99_perc, SUM(concluidas) AS total_concluidas,
                                                        SUM(entregues) AS total_entregues, SUM(devolvidas) AS total_devolvidas')
                                                ->where($where)         
                                                ->groupBy('id_uf','sg_uf','ds_municipio','num_oferta')
                                                ->orderBy('ds_municipio')
                                                ->get(); 
        }else if(($request->instituicao)){ 
             
            $execucaoObra = FaixaExecucao::selectRaw('id_uf,sg_uf,num_oferta,COUNT(contrato_id) AS total_uh, SUM(de_0_perc) AS total_0_perc, SUM(de_0_a_15_perc) AS total_de_0_a_15_perc, 
                                                        SUM(de_15_a_30_perc) AS total_de_15_a_30_perc, SUM(de_30_a_45_perc) AS total_de_30_a_45_perc, 
                                                        SUM(de_45_a_60_perc) AS total_de_45_a_60_perc, SUM(de_60_a_75_perc) AS total_de_60_a_75_perc, 
                                                        SUM(de_75_a_99_perc) AS total_de_75_a_99_perc, SUM(concluidas) AS total_concluidas,
                                                        SUM(entregues) AS total_entregues, SUM(devolvidas) AS total_devolvidas')
                                                ->where($where)         
                                                ->groupBy('id_uf','sg_uf','num_oferta')
                                                ->orderBy('sg_uf')
                                                ->get();                                                     
        }      
        
        $totalizadores2009 = [
                        'total_uh'=> 0, 
                        'total_0_perc'=> 0, 
                        'total_de_0_a_15_perc'=> 0, 
                        'total_de_15_a_30_perc'=> 0,
                        'total_de_30_a_45_perc'=> 0, 
                        'total_de_45_a_60_perc'=> 0, 
                        'total_de_60_a_75_perc'=> 0, 
                        'total_de_75_a_99_perc'=> 0,
                        'total_concluidas'=> 0, 
                        'total_entregues'=> 0, 
                        'total_devolvidas'=> 0
                        ];  
        
        $totalizadores2012 = [
                        'total_uh'=> 0, 
                        'total_0_perc'=> 0, 
                        'total_de_0_a_15_perc'=> 0, 
                        'total_de_15_a_30_perc'=> 0,
                        'total_de_30_a_45_perc'=> 0, 
                        'total_de_45_a_60_perc'=> 0, 
                        'total_de_60_a_75_perc'=> 0, 
                        'total_de_75_a_99_perc'=> 0,
                        'total_concluidas'=> 0, 
                        'total_entregues'=> 0, 
                        'total_devolvidas'=> 0
                        ]; 
        
        foreach($execucaoObra as $dados){  
            if($dados->num_oferta == 1){
                $totalizadores2009['total_uh'] += $dados->total_uh;
                $totalizadores2009['total_0_perc'] += $dados->total_0_perc;
                $totalizadores2009['total_de_0_a_15_perc'] += $dados->total_de_0_a_15_perc;
                $totalizadores2009['total_de_15_a_30_perc'] += $dados->total_de_15_a_30_perc;
                $totalizadores2009['total_de_30_a_45_perc'] += $dados->total_de_30_a_45_perc;
                $totalizadores2009['total_de_45_a_60_perc'] += $dados->total_de_45_a_60_perc;
                $totalizadores2009['total_de_60_a_75_perc'] += $dados->total_de_60_a_75_perc;
                $totalizadores2009['total_de_75_a_99_perc'] += $dados->total_de_75_a_99_perc;
                $totalizadores2009['total_concluidas'] += $dados->total_concluidas;
                $totalizadores2009['total_entregues'] += $dados->total_entregues;
                $totalizadores2009['total_devolvidas'] += $dados->total_devolvidas;
            }else{
                $totalizadores2012['total_uh'] += $dados->total_uh;
                $totalizadores2012['total_0_perc'] += $dados->total_0_perc;
                $totalizadores2012['total_de_0_a_15_perc'] += $dados->total_de_0_a_15_perc;
                $totalizadores2012['total_de_15_a_30_perc'] += $dados->total_de_15_a_30_perc;
                $totalizadores2012['total_de_30_a_45_perc'] += $dados->total_de_30_a_45_perc;
                $totalizadores2012['total_de_45_a_60_perc'] += $dados->total_de_45_a_60_perc;
                $totalizadores2012['total_de_60_a_75_perc'] += $dados->total_de_60_a_75_perc;
                $totalizadores2012['total_de_75_a_99_perc'] += $dados->total_de_75_a_99_perc;
                $totalizadores2012['total_concluidas'] += $dados->total_concluidas;
                $totalizadores2012['total_entregues'] += $dados->total_entregues;
                $totalizadores2012['total_devolvidas'] += $dados->total_devolvidas;
            }            
           
        }

        //$totalizadores = json_encode($totalizadores);
        if(($request->municipio) || ($request->estado)){       
            return view('oferta.execucaoObrasMunicipio',compact('execucaoObra','totalizadores2009','totalizadores2012','instituicao','estado'));            
        }else{  
            return view('oferta.execucaoObrasUF',compact('execucaoObra','totalizadores2009','totalizadores2012','instituicao','estado'));
        }    
    }

    public function filtroExecucaoObras(){
        
        return view('oferta.filtroExecucaoObras');
    }

    public function filtro_contratos_if(){
        $instituicoes = Instituicao::orderBy('txt_nome_if')->get();
        return view('oferta.filtroContratosIf',compact('instituicoes'));    
    } 

    public function contratos_instituicao(Request $request){
        //return $request->all();
        
        
        $contratos = ResumoContratosProtocolo::where('instituicao_id',$request->instituicao_id)->orderby('txt_nome_beneficiario')->get();
        $contratosParcelas = PagamentosContratosParcela::where('instituicao_id',$request->instituicao_id)->orderby('txt_nome_beneficiario')->get();
        $contratos->load('resumoPagamento');
        
        //return $contratos;
        
        $instituicao = Instituicao::where('id',$request->instituicao_id)->firstOrFail();
        
        $qtd_contratadas = 0;
        $qtd_restricao = 0;
        $qtd_devolvido = 0;
        $qtd_entregue = 0;
        $qtd_concluida = 0;
        $qtd_andamento = 0;
        $totalSubvencao = 0;
        foreach($contratos as $contrato){
            $qtd_contratadas += 1;

            if($contrato->bln_restricao) {
                $qtd_restricao += 1;
                $qtd_andamento += 1; 
            }    
            else{
                if($contrato->bln_recurso_devolvido) {
                    $qtd_devolvido += 1;
                }
                else{
                    if($contrato->bln_entregue){ 
                        if($contrato->bln_recurso_devolvido){
                            $qtd_devolvido += 1;                               
                        }    
                        else{
                            $qtd_entregue += 1;                             
                        }
                    }    
                    elseif((!$contrato->bln_entregue) && (!$contrato->bln_recurso_devolvido) && ($contrato->vlr_percentual_obra==100)){                    
                        $qtd_concluida += 1;
                    }
                    else{
                        $qtd_andamento += 1;                                
                    }   
                }   
            } 
            $totalSubvencao += $contrato->resumoPagamento->total_subvencao;
            
        }
            $totalParcelas = ['total_parcela_1'=> 0,
            'total_parcela_2'=> 0,
            'total_parcela_3'=> 0,
            'total_parcela_4'=> 0,
            'total_parcela_5'=> 0,
            'total_parcela_6'=> 0,
            'total_parcela_7'=> 0,
            'total_subvencao'=> 0,
            'total_parcela_1_rem'=> 0,
            'total_parcela_2_rem'=> 0]; 

            foreach($contratosParcelas as $parcelas){
                $totalParcelas['total_parcela_1'] += $parcelas->parcela_1;
                $totalParcelas['total_parcela_2'] += $parcelas->parcela_2;
                $totalParcelas['total_parcela_3'] += $parcelas->parcela_3;
                $totalParcelas['total_parcela_4'] += $parcelas->parcela_4;
                $totalParcelas['total_parcela_5'] += $parcelas->parcela_5;
                $totalParcelas['total_parcela_6'] += $parcelas->parcela_6;
                $totalParcelas['total_parcela_7'] += $parcelas->parcela_7;
                $totalParcelas['total_subvencao'] += $parcelas->parcela_1+$parcelas->parcela_2+$parcelas->parcela_3+$parcelas->parcela_4+$parcelas->parcela_5+$parcelas->parcela_6+$parcelas->parcela_7;
                $totalParcelas['total_parcela_1_rem'] += $parcelas->parcela_1_remun;
                $totalParcelas['total_parcela_2_rem'] += $parcelas->parcela_2_remun;
                }
        
        
        return view('oferta.contratosIF',compact('instituicao','contratos', 'qtd_contratadas','qtd_restricao','qtd_devolvido','qtd_entregue','qtd_concluida',
                                                'contratosParcelas','qtd_andamento','totalSubvencao','totalParcelas'));
    }
    
}        