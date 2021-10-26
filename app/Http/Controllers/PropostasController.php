<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ResumoPropostas;
use App\ItensDeclaratoriosPropostas;
use App\RegimeCOnstrutivo;
use App\TomadorFinanciamento;
use App\TipoComunidadeRural;
use App\MotivoNaoSelecao;
use App\MotivoNaoEnquadramento;
use App\Selecao;
use App\Municipio;
use App\Uf;
use App\Regiao;
use App\TipoComunidade;
use App\Modalidade;
use App\Intrl008;
use App\ResumoOperacao;
use App\SelecionadasAno;
use App\DemandaFechadaAno;
use App\Proponente;
use App\ResumoProponentes;
use App\ResumoOperacoes;
use App\PropostasContratadasVinculadas;

//Usadas para o excel
use App\Exports\ResumoPropostasExport;
use App\Exports\PropostasApresentadasExport;
use App\Exports\selecaoResumoExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class PropostasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    public function consultaAPF(){
        $selecoes = Selecao::orderBy('dte_portaria_resultado')->get();
        $selecoes->load("modalidade");
        
        return view('propostas.consultaAPF',compact('selecoes'));
    }

    public function consultaFiltro(){
        $selecoes = Selecao::orderBy('dte_portaria_resultado')->get();
        $selecoes->load("modalidade");


        

        return view('propostas.consultaFiltroPropostas',compact('selecoes'));
    }
    
    public function buscaPropostaAPF(Request $request){
        
        $propostas = ResumoPropostas::where('num_apf','=',$request->txt_num_apf)->orderBy('selecao_id', 'asc')->get();
        
        
        if (count($propostas)>0 ){
            return view('propostas.propostas_apf',compact('propostas'));
        } else {
            flash()->erro("Erro", "Não existe proposta para esse Número de APF.");            
        }
	    return back();
    }

    public function buscaPropostaCNPJ(Request $request){
        
      
       $proponente = Proponente::where('txt_cnpj','=',$request->txt_cnpj)->first();
        
        if ($proponente){

        $propostas = ResumoPropostas::select('view_resumo_propostas.proposta_id','view_resumo_propostas.dte_portaria_resultado', 
        'view_resumo_propostas.txt_nome_empreendimento',
        'view_resumo_propostas.num_selecao',
        'view_resumo_propostas.num_apf',
        'view_resumo_propostas.txt_modalidade',
        'view_resumo_propostas.num_uh',
       'view_resumo_propostas.vlr_investimento',
        'view_resumo_propostas.bln_enquadrada',
        'view_resumo_propostas.bln_selecionada',
        'view_resumo_propostas.bln_contratada',
        'view_resumo_propostas.num_uh_contratadas',
        'view_resumo_propostas.num_ano_selecao',
        'view_resumo_propostas.modalidade_id')
        ->orderBy('txt_nome_empreendimento', 'asc')
        ->orderBy('num_selecao', 'asc')
        ->where('txt_cnpj','=',$request->txt_cnpj)       
        ->get();

        $resumoPropostas = ResumoProponentes::where('txt_cnpj','=',$request->txt_cnpj)->orderBy('selecao_id', 'asc')->get();

        $totalResumo = array();        
        $totalResumo = ['total_propostas_apresentadas'=> 0,
                             'total_uh_apresentadas'=> 0,
                             'total_propostas_selecionadas'=> 0, 
                             'total_uh_selecionadas'=> 0,
                             'total_propostas_contratadas'=> 0,
                             'total_uh_contratadas'=> 0,
                             'total_vlr_contratado'=> 0];

        foreach($resumoPropostas as $resumo){
            $totalResumo['total_propostas_apresentadas'] += $resumo->qtd_propostas_apresentadas;
            $totalResumo['total_uh_apresentadas'] += $resumo->num_uh_apresentadas;
            $totalResumo['total_propostas_selecionadas'] += $resumo->qtd_propostas_selecionada; 
            $totalResumo['total_uh_selecionadas'] += $resumo->num_uh_selecionada;
            $totalResumo['total_propostas_contratadas'] += $resumo->qtd_propostas_contratada;
            $totalResumo['total_uh_contratadas'] += $resumo->num_uh_contratadas;
            $totalResumo['total_vlr_contratado'] += $resumo->vlr_total_contratado;
        }
             //return $totalResumo;  

       
            return view('propostas.propostas_proponente',compact('propostas','proponente','resumoPropostas','totalResumo'));
        } else {
            flash()->erro("Erro", "Não existe proposta para esse Número de CNPJ.");            
        }
	    return back();
    }

    public function buscaPropostaPortaria(Request $request){
        //return $request->all();
        $propostasApresentadas = ResumoPropostas::where('selecao_id','=',$request->selecao_id)->orderBy('selecao_id', 'asc')->get();
        $selecao = Selecao::where('id',$request->selecao_id)->first();
        

        if (count($propostasApresentadas)>0 ){
            $selecao->load('modalidade');
            return view('propostas.propostas_portaria',compact('propostasApresentadas','selecao'));
        } else {
            flash()->erro("Erro", "Não existem propostas para esse Número de Portaria.");            
        }
	    return back();
    	
    }

    public function proposta($propostaID, $numAPF = null)
    {
        $propostaID;
        $dataPosicao =  date("Y-m-d");
        $where[] = ['proposta_id', $propostaID];

        $proposta = ResumoPropostas::where($where)->first();
        $itensDeclaratorios = ItensDeclaratoriosPropostas::where('proposta_id', $propostaID)->firstOrFail();
          $itensDeclaratorios->load('regimeConstrutivo','tomadorFinanciamento');

        if($proposta->modalidade_id == 6){
            $tipoComunidadeRural = TipoComunidadeRural::where('proposta_id', $propostaID)->get();
            $tipoComunidadeRural->load('tipoComunidade');
        } else{
            $tipoComunidadeRural = [];
        } 
            

        $naoSelecionado = [];
        if(!$proposta->bln_selecionada){
             $naoSelecionado = MotivoNaoSelecao::where('proposta_id', $propostaID)->get();
            $naoSelecionado->load('tipoMotivoNaoSelecao');
        }
        //return $numAPF;
         $dadosContratacao = [];
         $operacao = '';
         if($proposta->bln_contratada){

            $propostaIdVinculada = PropostasContratadasVinculadas::where('proposta_id_vinculada',$propostaID)->first();
            if($propostaIdVinculada){
               
                $proposta = ResumoPropostas::where('proposta_id',$propostaIdVinculada->proposta_id)->first();

                $operacao = ResumoOperacoes::where('cod_operacao',$proposta->num_apf)
                        ->orderBy('txt_modalidade','asc')
                        ->orderBy('num_pmcmv','asc')
                        ->orderBy('txt_nome_empreendimento','asc')
                        ->firstOrFail(); 
            }else{
                $operacao = ResumoOperacoes::where('cod_operacao',$numAPF)
                        ->orderBy('txt_modalidade','asc')
                        ->orderBy('num_pmcmv','asc')
                        ->orderBy('txt_nome_empreendimento','asc')
                        ->firstOrFail(); 
            }            
           //$operacaoIdExecutivo = $operacao->id;
         }
         /**
            if($proposta->bln_contratada){
                $operacao = ResumoOperacoes::where('cod_operacao',$numAPF)
                            ->orderBy('txt_modalidade','asc')
                            ->orderBy('num_pmcmv','asc')
                            ->orderBy('txt_nome_empreendimento','asc')
                            ->firstOrFail();
                // $dadosContratacao = ResumoOperacao::where('txt_num_apf', $numAPF)->get();
                // $dadosContratacao->load('situacaoObra','situacaoContrato');
            }
        */
        
        
        $naoEnquadramento = [];
        if(!$proposta->bln_enquadrada){
       	    $naoEnquadramento = MotivoNaoEnquadramento::join('opc_tipo_motivo_nao_enquadra', 'opc_tipo_motivo_nao_enquadra.id', '=', 'tab_motivo_nao_enquadramento.tipo_motivo_nao_enquadra_id')
               ->select('opc_tipo_motivo_nao_enquadra.txt_motivo_nao_enquadramento')       // just to avoid fetching anything from joined table
               ->where('proposta_id', $propostaID)
               ->get();
        }

        //return $proposta;

           return view('propostas.proposta',compact('proposta','itensDeclaratorios','naoEnquadramento','tipoComunidadeRural','naoSelecionado',
                                                    'dadosContratacao','dataPosicao','operacao'));
     } 

     public function propostasApresentadas(Request $request)
     {

        // $request->ALL();
         $wherePropostas = [];
        
         //$wherePropostas[] = ['bln_enquadrada',TRUE];
         
         $where = [];

         //Dados para o Excel
        $dadosPropostas = array();
        $dadosPropostas = ['estado'=> "tudo",'municipio'=> "tudo",'modalidade'=> "tudo",'selecao'=> "tudo"];
        //Fim Dados para o Excel
        
         $selecao = [];
         if($request->selecao){
             $where[] = ['selecao_id', $request->selecao]; 
             $wherePropostas[] = ['selecao_id', $request->selecao]; 
             $dadosPropostas['selecao'] = $request->selecao; // Para o Excel
 
            $selecao = Selecao::where('id',$request->selecao)->firstOrFail();
            $selecao->load('modalidade');
         }      

         $modalidade = [];
        if($request->modalidade){
            $where[] = ['modalidade_id', $request->modalidade]; 
            $wherePropostas[] = ['modalidade_id', $request->modalidade]; 
            $dadosPropostas['modalidade'] = $request->modalidade; // Para o Excel

            $modalidade = Modalidade::where('id',$request->modalidade)->firstOrFail();
        }      
         $estado = [];
        if($request->estado){
             $where[] = ['uf_id', $request->estado];
             $wherePropostas[] = ['uf_id', $request->estado];
             $dadosPropostas['estado'] = $request->estado; // Para o Excel

             $estado = Uf::where('id',$request->estado)->firstOrFail();
         }
  
     $municipio = [];
        if($request->municipio){
             $where[] = ['municipio_id', $request->municipio];
             $wherePropostas[] = ['municipio_id', $request->municipio];
             $dadosPropostas['municipio'] = $request->municipio; // Para o Excel

             $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
         }
 
         //return $where;
         $propostas = ResumoPropostas::where($wherePropostas)->get();
          $propostasApresentadas = ResumoPropostas::orderBy('txt_uf', 'asc')
                                     ->orderBy('ds_municipio', 'asc')
                                     ->orderBy('txt_nome_empreendimento', 'asc')
                                     ->orderBy('proposta_id', 'asc')
                                     ->where($where)
                                     ->get();



            $num_total_uh = 0;
            $vlr_total_investimento = 0;
 
            foreach($propostasApresentadas as $apresentadas){            
                $num_total_uh += $apresentadas->num_uh;
                $vlr_total_investimento += $apresentadas->vlr_investimento;
                $tipo_selecao = $apresentadas->selecao_id;
            }
 

          
            
         return view('propostas.propostas_apresentadas',compact('propostasApresentadas','regiao','estado','municipio','propostas','selecao',
                    'num_total_uh', 'vlr_total_investimento','modalidade','dadosPropostas'));
            
        
         
     }

     public function buscaResumoSelecao(Request $request)
     {
        return view('selecao.consultaResumoSelecao');
     }   
     

     public function resumoSelecao(Request $request)
     {  
        $dataPosicao =  date("Y-m-d");
        //Dados para o Excel
        $dadosPropostas = array();
        $dadosPropostas = ['estado'=> "tudo",'municipio'=> "tudo"];
        //Fim Dados para o Excel
        
        if($request->estado){
             $dadosPropostas['estado'] = $request->estado; // Para o Excel
             $estado = Uf::where('id',$request->estado)->firstOrFail();
         }

        $municipio = [];
        $where = []; 
         $municipio = $request->municipio;

        if($request->municipio){
            session(['municipios' => $request->municipio]);
            $dadosPropostas['municipio'] = $request->municipio; // Para o Excel
            foreach ($municipio as $value) {
                $where[] = ['municipio_id', $value];              
            }          
        }

        
        //return $where;
           $propostasApresentadas = ResumoPropostas::selectRaw('municipio_id,txt_sigla_uf,ds_municipio,txt_modalidade,num_portaria_resultado,
                                                            dte_portaria_resultado,bln_enquadrada,bln_selecionada,bln_contratada, count(proposta_id) as qtd_propostas,
                                            sum(num_uh) as num_uh, sum(num_uh_contratadas) as num_uh_contratadas, sum(vlr_contratado) as vlr_contratado')
                                                ->groupBy('municipio_id','txt_sigla_uf','ds_municipio','txt_modalidade','num_portaria_resultado',
                                                          'dte_portaria_resultado','bln_enquadrada','bln_selecionada','bln_contratada')
                                                ->whereIn('municipio_id',$municipio)
                                                ->orderBy('ds_municipio', 'asc')
                                                ->orderBy('txt_modalidade', 'asc')
                                                ->get();

        $selecionadaContratadas = [];                                                
        $totalSelUH = 0;
        $totalSelUHCont = 0;
        $totalSelVlrContr = 0;
        
        $enqNSelecionada = false;
        $NenqNSelecionada = false;
        $selCont = false;
        $selNaoCont = false;

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
                $qtdPropEnqNSelecionada += $apresentadas->qtd_propostas;
                $totalEnqNSel += $apresentadas->num_uh;               
            } 

            if((!$apresentadas->bln_enquadrada) && (!$apresentadas->bln_selecionada)){
                $NenqNSelecionada = true;                
                $qtdPropNenqNSelecionada += $apresentadas->qtd_propostas;
                $totalNEnqNSel += $apresentadas->num_uh;               
            } 
           
            if(($apresentadas->bln_selecionada) && (!$apresentadas->bln_contratada)){
                $selNaoCont = true;
                $qtdPropSelNaoCont += $apresentadas->qtd_propostas;
                $totalSelNContUH += $apresentadas->num_uh;
                $totalSelNContUHCont += $apresentadas->num_uh_contratadas;
                $totalSelNContVlrContr += $apresentadas->vlr_contratado;
            }  
            
            if(($apresentadas->bln_selecionada) && ($apresentadas->bln_contratada)){
                $selCont = true;
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
        return view('selecao.resumoSelecao',compact('estado','propostasApresentadas','selCont','selNaoCont','selecionadaNaoContratadas',
                                                    'selecionadaContratadas','enqNSelecionada','totalEnqNSel','NenqNSelecionada','totalNEnqNSel',
                                                    'qtdPropEnqNSelecionada','qtdPropNenqNSelecionada','qtdPropSelCont','qtdPropSelNaoCont', 
                                                    'dadosPropostas','dataPosicao'));
    } else {
        flash()->erro("Erro", "Não existem propostas para esse(s) Município(s).");            
    }

    return back();
     
     }

     public function buscaResumoContratadas(Request $request)
     {
     return view('selecao.consultaPropostasContratadas');
     } 

     public function propostasContratadas(Request $request)
     {
        // return $request->all();

        $where = []; 
       // $where[] = ['bln_selecionada',true]; 
        $where[] = ['bln_contratada',true]; 

        //Dados para o Excel
        $dadosPropostas = array();
        $dadosPropostas = ['regiao'=> "tudo",'estado'=> "tudo",'municipio'=> "tudo",'modalidade'=> "tudo",'ano'=> "tudo"];
        //Fim Dados para o Excel

        $regiao = [];
        if($request->regiao){
            $where[] = ['regiao_id',$request->regiao];
            $dadosPropostas['regiao'] = $request->regiao; // Para o Excel
            $regiao = Regiao::where('id',$request->regiao)->firstOrFail();
        }
            
        $estado = [];
        if($request->estado){
            $where[] = ['uf_id',$request->estado];
            $dadosPropostas['estado'] = $request->estado; // Para o Excel
            $estado = Uf::where('id',$request->estado)->firstOrFail();
        }
     
        $municipio = [];
       if($request->municipio){
            $where[] = ['municipio_id', $request->municipio];  
            $dadosPropostas['municipio'] = $request->municipio; // Para o Excel           
            $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
            if(!$request->estado){
                $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
            }
       }
       
       $modalidade = [];
       if($request->modalidade){
            $where[] = ['modalidade_id', $request->modalidade]; 
            $dadosPropostas['modalidade'] = $request->modalidade; // Para o Excel
            $modalidade = Modalidade::where('id',$request->modalidade)->firstOrFail();
        }

        if($request->ano_selecao){
            $where[] = ['num_ano_selecao', $request->ano_selecao];
            $dadosPropostas['ano'] = $request->ano_selecao; // Para o Excel
            $anoSelecao = $request->ano_selecao;
        }

        $demanda_fechada = [];
        if($request->demanda_fechada){
            $where[] = ['bln_demanda_fechada',$request->demanda_fechada];
            $dadosPropostas['demanda_fechada'] = $request->demanda_fechada; // Para o Excel
           
        }

       
       //return $where;
       
         $contratadasAno = SelecionadasAno::selectRaw('num_ano_selecao,
                                                    sum(propostas_selecionada_entidade) as total_prop_selec_entidade, 
                                                    sum(uh_selecionada_entidade) as total_selecionada_entidade,
                                                    sum(uh_contratadas_entidades) as total_contratadas_entidades,
                                                    sum(vlr_contratado_entidades) as total_vlr_contratado_entidades,
                                                    sum(propostas_selecionada_far) as total_prop_selec_far, 
                                                    sum(uh_selecionada_far) as total_selecionada_far,
                                                    sum(uh_contratadas_far) as total_contratadas_far,
                                                    sum(vlr_contratado_far) as total_vlr_contratado_far,
                                                    sum(propostas_selecionada_rural) as total_prop_selec_rural,
                                                    sum(uh_selecionada_rural) as total_selecionada_rural,
                                                    sum(uh_contratadas_rural) as total_contratadas_rural,
                                                    sum(vlr_contratado_rural) as total_vlr_contratado_rural')
                                            ->where($where)
                                            ->orderBy('num_ano_selecao', 'asc')
                                            ->groupBy('num_ano_selecao')
                                            ->get();
                                            

        $totalAno = array();        
        $totalAno = ['total_prop_selec_entidade'=> 0,'total_selecionada_entidade'=> 0,'total_contratadas_entidades'=> 0,'total_vlr_contratado_entidades'=> 0,
        'total_prop_selec_far'=> 0,'total_selecionada_far'=> 0,'total_contratadas_far'=> 0,'total_vlr_contratado_far'=> 0,
        'total_prop_selec_rural'=> 0,'total_selecionada_rural'=> 0,'total_contratadas_rural'=> 0,'total_vlr_contratado_rural'=> 0];

        foreach($contratadasAno as $ano){
           $totalAno['total_prop_selec_entidade'] += $ano->total_prop_selec_entidade;
           $totalAno['total_selecionada_entidade'] += $ano->total_selecionada_entidade;
           $totalAno['total_contratadas_entidades'] += $ano->total_contratadas_entidades;
           $totalAno['total_vlr_contratado_entidades'] += $ano->total_vlr_contratado_entidades;
           $totalAno['total_prop_selec_far'] += $ano->total_prop_selec_far;
           $totalAno['total_selecionada_far'] += $ano->total_selecionada_far;
           $totalAno['total_contratadas_far'] += $ano->total_contratadas_far;
           $totalAno['total_vlr_contratado_far'] += $ano->total_vlr_contratado_far;
           $totalAno['total_prop_selec_rural'] += $ano->total_prop_selec_rural;
           $totalAno['total_selecionada_rural'] += $ano->total_selecionada_rural;
           $totalAno['total_contratadas_rural'] += $ano->total_contratadas_rural;
           $totalAno['total_vlr_contratado_rural'] += $ano->total_vlr_contratado_rural;
        }

        $contratadasAnoDemFechada = DemandaFechadaAno::selectRaw('num_ano_selecao,
                                                    sum(propostas_selecionada_entidade) as total_prop_selec_entidade, 
                                                    sum(uh_selecionada_entidade) as total_selecionada_entidade,
                                                    sum(uh_contratadas_entidades) as total_contratadas_entidades,
                                                    sum(vlr_contratado_entidades) as total_vlr_contratado_entidades,
                                                    sum(propostas_selecionada_far) as total_prop_selec_far, 
                                                    sum(uh_selecionada_far) as total_selecionada_far,
                                                    sum(uh_contratadas_far) as total_contratadas_far,
                                                    sum(vlr_contratado_far) as total_vlr_contratado_far,
                                                    sum(propostas_selecionada_rural) as total_prop_selec_rural,
                                                    sum(uh_selecionada_rural) as total_selecionada_rural,
                                                    sum(uh_contratadas_rural) as total_contratadas_rural,
                                                    sum(vlr_contratado_rural) as total_vlr_contratado_rural')
                                            ->where($where)
                                            ->orderBy('num_ano_selecao', 'asc')
                                            ->groupBy('num_ano_selecao')
                                            ->get();
        
        
            $totalDemFechadaAno = array();        
            $totalDemFechadaAno = ['total_prop_selec_entidade'=> 0,'total_selecionada_entidade'=> 0,'total_contratadas_entidades'=> 0,'total_vlr_contratado_entidades'=> 0,
            'total_prop_selec_far'=> 0,'total_selecionada_far'=> 0,'total_contratadas_far'=> 0,'total_vlr_contratado_far'=> 0,
            'total_prop_selec_rural'=> 0,'total_selecionada_rural'=> 0,'total_contratadas_rural'=> 0,'total_vlr_contratado_rural'=> 0];
    
            foreach($contratadasAnoDemFechada as $ano){
                $totalDemFechadaAno['total_prop_selec_entidade'] += $ano->total_prop_selec_entidade;
                $totalDemFechadaAno['total_selecionada_entidade'] += $ano->total_selecionada_entidade;
                $totalDemFechadaAno['total_contratadas_entidades'] += $ano->total_contratadas_entidades;
                $totalDemFechadaAno['total_vlr_contratado_entidades'] += $ano->total_vlr_contratado_entidades;
                $totalDemFechadaAno['total_prop_selec_far'] += $ano->total_prop_selec_far;
                $totalDemFechadaAno['total_selecionada_far'] += $ano->total_selecionada_far;
                $totalDemFechadaAno['total_contratadas_far'] += $ano->total_contratadas_far;
                $totalDemFechadaAno['total_vlr_contratado_far'] += $ano->total_vlr_contratado_far;
                $totalDemFechadaAno['total_prop_selec_rural'] += $ano->total_prop_selec_rural;
                $totalDemFechadaAno['total_selecionada_rural'] += $ano->total_selecionada_rural;
                $totalDemFechadaAno['total_contratadas_rural'] += $ano->total_contratadas_rural;
                $totalDemFechadaAno['total_vlr_contratado_rural'] += $ano->total_vlr_contratado_rural;
            }
        
        
        
                                    //    return $totalAno;
        $propostasContratadas = ResumoPropostas::where($where)
                                               ->orderBy('txt_uf', 'asc')
                                               ->orderBy('ds_municipio', 'asc')
                                               ->orderBy('num_ano_selecao', 'asc')
                                               ->get();

        $totalContratadas = array();        
        $totalContratadas = ['total_prop_selec'=> 0,'total_selecionada'=> 0,'total_contratadas'=> 0,'total_vlr_contratado'=> 0];
        foreach($propostasContratadas as $total){
            $totalContratadas['total_prop_selec'] += 1;
            $totalContratadas['total_selecionada'] += $total->num_uh;
            $totalContratadas['total_contratadas'] += $total->num_uh_contratadas;
            $totalContratadas['total_vlr_contratado'] += $total->vlr_contratado;            
         }


        

        return view('selecao.propostasContratadas',compact('propostasContratadas','contratadasAno','totalAno','totalContratadas','dadosPropostas',
                                                    'regiao','estado','municipio','modalidade','contratadasAnoDemFechada','totalDemFechadaAno'));
     } 


    //Funcao para download do arquivo Excel
    public function export($regiao, $estado, $municipio, $modalidade, $ano) 
    {

        return Excel::download(new ResumoPropostasExport($regiao, $estado, $municipio, $modalidade, $ano), 'Resumo-Propostas.xlsx');
    }

    public function propostasApresentadasExport($estado, $municipio, $modalidade, $selecao)
    {
        return Excel::download(new PropostasApresentadasExport($estado, $municipio, $modalidade, $selecao), 'Propostas-Apresentadas.xlsx');
    }
    
    public function selecaoResumoExport($estado)
    {
        $municipios = session('municipios');
        return Excel::download(new selecaoResumoExport($estado, $municipios), 'Selecao-Resumo.xlsx');
    }
    
    
}
