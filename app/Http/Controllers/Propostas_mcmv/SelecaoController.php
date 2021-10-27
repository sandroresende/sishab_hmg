<?php

namespace App\Http\Controllers\Propostas_mcmv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

use App\Mod_sishab\PropostasMcmv\Selecao;
use App\Tab_dominios\Modalidade;

use App\Mod_sishab\PropostasMcmv\ResumoPropostas;


class SelecaoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $selecoes = Selecao::join('opc_modalidades','tab_selecao.modalidade_id','opc_modalidades.id')
                            ->select('tab_selecao.id','num_selecao','txt_modalidade','dte_selecao','num_total_enquadradas','num_total_selecionadas')
                            ->orderBy('dte_portaria_resultado')->get();

        $tituloTabela = ['Id','Nº Seleção','Modalidade','Data','Enquadradas','UH Selecionadas'];
        
        

        return view('views_sishab.propostas_mcmv.filtroSelecao',compact('selecoes','tituloTabela'));
    }

    public function selecaoConsulta()
    {
        $selecoes = Selecao::where('num_ano_selecao', 2018)->orderBy('dte_portaria_resultado')->get();
        $selecoes->load("modalidade");

        

        return view('views_sishab.propostas_mcmv.selecaoConsulta',compact('selecoes'));
    }

    public function dadosSelecao($selecaoId)
     {  
        $dataPosicao =  date("Y-m-d");
        //Dados para o Excel
        $dadosPropostas = array();
        $dadosPropostas = ['estado'=> "tudo",'municipio'=> "tudo"];
        //Fim Dados para o Excel
        
        
        //return $where;

         $selecao = Selecao::find($selecaoId);
         $selecao->load("modalidade");                            

          $propostasApresentadas = ResumoPropostas::selectRaw('txt_sigla_uf,num_portaria_resultado,
                                                            dte_portaria_resultado,bln_enquadrada,bln_selecionada,bln_contratada, 
                                                            count(DISTINCT(municipio_id)) as qtd_municipios, count(proposta_id) as qtd_propostas,
                                            sum(num_uh) as num_uh, sum(num_uh_contratadas) as num_uh_contratadas, sum(vlr_contratado) as vlr_contratado')
                                                ->groupBy('txt_sigla_uf','txt_modalidade','num_portaria_resultado',
                                                          'dte_portaria_resultado','bln_enquadrada','bln_selecionada','bln_contratada')
                                                ->where('selecao_id',$selecaoId)
                                                ->orderBy('txt_sigla_uf', 'asc')
                                                ->get();

        $selecionadaContratadas = [];                                                
        $totalSelUH = 0;
        $totalSelUHCont = 0;
        $totalSelVlrContr = 0;
        
        $enqNSelecionada = false;
        $NenqNSelecionada = false;
        $selCont = false;
        $selNaoCont = false;

        $qtdMunEnqNSelecionada = 0;
        $qtdMunNenqNSelecionada = 0;
        $qtdMunSelCont = 0;
        $qtdMunSelNaoCont = 0;

        $qtdPropEnqNSelecionada = 0;
        $qtdPropNenqNSelecionada = 0;
        $qtdPropSelCont = 0;
        $qtdPropSelNaoCont = 0;


        $selecionadaNaoContratadas = [];  
        $totalSelNContUH = 0;
        $totalSelNContUHCont = 0;
        $totalSelNContVlrContr = 0;    

        
        $totalEnqNSel = 0;
        $totalNEnqNSel = 0;
        
        foreach($propostasApresentadas as $apresentadas){ 

            if(($apresentadas->bln_enquadrada) && (!$apresentadas->bln_selecionada)){
                $enqNSelecionada = true;
                $qtdMunEnqNSelecionada += $apresentadas->qtd_municipios;
                $qtdPropEnqNSelecionada += $apresentadas->qtd_propostas;
                $totalEnqNSel += $apresentadas->num_uh;               
            } 

            if((!$apresentadas->bln_enquadrada) && (!$apresentadas->bln_selecionada)){
                $NenqNSelecionada = true;           
                $qtdMunNenqNSelecionada += $apresentadas->qtd_municipios;     
                $qtdPropNenqNSelecionada += $apresentadas->qtd_propostas;
                $totalNEnqNSel += $apresentadas->num_uh;               
            } 
           
            if(($apresentadas->bln_selecionada) && (!$apresentadas->bln_contratada)){
                $selNaoCont = true;
                $qtdMunSelNaoCont += $apresentadas->qtd_municipios;     
                $qtdPropSelNaoCont += $apresentadas->qtd_propostas;
                $totalSelNContUH += $apresentadas->num_uh;
                $totalSelNContUHCont += $apresentadas->num_uh_contratadas;
                $totalSelNContVlrContr += $apresentadas->vlr_contratado;
            }  
            
            if(($apresentadas->bln_selecionada) && ($apresentadas->bln_contratada)){
                $selCont = true;
                $qtdMunSelCont += $apresentadas->qtd_municipios;     
                $qtdPropSelCont += $apresentadas->qtd_propostas;
                $totalSelUH += $apresentadas->num_uh;
                $totalSelUHCont += $apresentadas->num_uh_contratadas;
                $totalSelVlrContr += $apresentadas->vlr_contratado;
            } 
        }

        $selecionadaNaoContratadas['totalSelNContUH'] = $totalSelNContUH;
        $selecionadaNaoContratadas['totalSelNContUHCont'] = $totalSelNContUHCont;
        $selecionadaNaoContratadas['totalSelNContVlrContr'] = $totalSelNContVlrContr;
        $selecionadaNaoContratadas['qtdPropSelNaoCont'] = $qtdPropSelNaoCont;
     
        $selecionadaContratadas['totalSelUH'] = $totalSelUH;
        $selecionadaContratadas['totalSelUHCont'] = $totalSelUHCont;
        $selecionadaContratadas['totalSelVlrContr'] = $totalSelVlrContr;
        $selecionadaContratadas['qtdPropSelCont'] = $qtdPropSelCont;


       //return $selecionadaContratadas;
      if (count($propostasApresentadas)>0 ){        
        return view('views_sishab.propostas_mcmv.DadosSelecao',compact('selecao','propostasApresentadas','selCont','selNaoCont','selecionadaNaoContratadas',
                                                    'selecionadaContratadas','enqNSelecionada','totalEnqNSel','NenqNSelecionada','totalNEnqNSel',
                                                    'qtdMunEnqNSelecionada','qtdMunNenqNSelecionada','qtdMunSelCont','qtdMunSelNaoCont', 
                                                    'qtdPropEnqNSelecionada','qtdPropNenqNSelecionada','qtdPropSelCont','qtdPropSelNaoCont', 
                                                    'dadosPropostas','dataPosicao'));
    } else {
        flash()->erro("Erro", "Não existem propostas para esse(s) Município(s).");            
    }

    return back();
     
     }
}

