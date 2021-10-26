<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ResumoOperacao;
use App\SolicitacaoPagamento;
use App\Uf;
use App\Municipio;
use App\TipoLiberacao;
use App\Mes;
use App\Orcamento;
use App\ResumoLiberacoesAnoMesOperacao;
use App\ResumoLiberacoesAno;
use App\Operacao;



class FinanceiroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
 
    }
    
    public function consultaSolicitacoes(){

        return view('financeiro.consultaQuadroResumoSolicitacoes');
    }

    public function QuadroResumoSolicitacoes(Request $request){
        
                //return $request->all();
                $whereSolicitacoes = [];
                
                $estado = [];
                if($request->estado){
                    $whereSolicitacoes[] = ['uf_id', $request->estado]; 
                    $estado = Uf::where('id',$request->estado)->firstOrFail();                   
                }

                $municipio = [];
                if($request->municipio){
                    $whereSolicitacoes[] = ['municipio_id', $request->municipio]; 
                    $municipio = Municipio::where('id',$request->municipio)->firstOrFail();                   
                }
                
                $tipoLiberacao = [];
                if($request->tipoLiberacao){
                    $whereSolicitacoes[] = ['tipo_liberacao_id', $request->tipoLiberacao]; 
                    $tipoLiberacao = TipoLiberacao::where('id',$request->tipoLiberacao)->firstOrFail();                   
                }

                $mes = [];
                if($request->mesSolicitacao){
                    $whereSolicitacoes[] = ['num_mes_solicitacao', $request->mesSolicitacao]; 
                    $mes = Mes::where('id',$request->mesSolicitacao)->firstOrFail();                   
                }

                $posicaoDe = '';
                if(($request->posicao_de) && (!$request->posicao_ate)){
                    $whereSolicitacoes[] = ['dte_solicitacao','=', $request->posicao_de]; 
                    $posicaoDe = $request->posicao_de;                   
                }else if(($request->posicao_de) && ($request->posicao_ate)){
                    $whereSolicitacoes[] = ['dte_solicitacao','>=', $request->posicao_de]; 
                    $posicaoDe = $request->posicao_de;                   
                }else{
                    $posicaoDe = $request->posicao_de;                   
                }
                
                $posicaoAte = '';
                if($request->posicao_ate){
                    $whereSolicitacoes[] = ['dte_solicitacao','<=', $request->posicao_ate]; 
                    $posicaoAte = $request->posicao_ate;                   
                }

                $mesLiberacao = [];
                if($request->mesLiberacao){
                    $whereSolicitacoes[] = ['num_mes_liberacao', $request->mesLiberacao]; 
                    $mesLiberacao = Mes::where('id',$request->mesLiberacao)->firstOrFail();                   
                }


                $posicaoDeLib = '';
                if(($request->posicao_deLib) && (!$request->posicao_ateLib)){
                    $whereSolicitacoes[] = ['dte_liberacao','=', $request->posicao_deLib]; 
                    $posicaoDeLib = $request->posicao_deLib;                   
                }else if(($request->posicao_deLib) && ($request->posicao_ateLib)){
                    $whereSolicitacoes[] = ['dte_liberacao','>=', $request->posicao_deLib]; 
                    $posicaoDeLib = $request->posicao_deLib;                   
                }else{
                    $posicaoDeLib = $request->posicao_deLib;                   
                }

                $posicaoAteLib = '';
                if($request->posicao_ateLib){
                    $whereSolicitacoes[] = ['dte_liberacao','<=', $request->posicao_ateLib]; 
                    $posicaoAteLib = $request->posicao_ateLib;                   
                }
                
                
               //solicitações por observações
                $solicitacoesPagObs = SolicitacaoPagamento::selectRaw('txt_observacao, count(operacao_id) as qtd_solicitacoes, 
                                                                                sum(vlr_solicitado) as total_solicitado,
                                                                                sum(qtd_liberado) as qtd_liberacoes, 
                                                                                sum(vlr_liberado) as total_liberado ')
                        ->groupBy('txt_observacao')
                        ->where($whereSolicitacoes)
                        ->orderBy('txt_observacao')
                        ->get();
                
                
            if(count($solicitacoesPagObs)==0) {
                flash()->erro("Erro", "Não existe solicitação para os parâmetros escolhidos.");            
                return back();  
            } else {
                
            
                $totalSolicitacaoPagObs = ['qtd_solicitacoes'=> 0, 'total_solicitado'=> 0,'qtd_liberacoes'=> 0, 'total_liberado'=> 0];
                $count = 0;
                foreach($solicitacoesPagObs as $solicitacao){
                   

                    $totalSolicitacaoPagObs['qtd_solicitacoes'] += $solicitacao->qtd_solicitacoes;
                    $totalSolicitacaoPagObs['total_solicitado'] += $solicitacao->total_solicitado;
                    $totalSolicitacaoPagObs['qtd_liberacoes'] += $solicitacao->qtd_liberacoes;
                    $totalSolicitacaoPagObs['total_liberado'] += $solicitacao->total_liberado;
                    $count++;                                                            
                }

                //solicitações por uf
                $solicitacoesPagUhs = SolicitacaoPagamento::selectRaw('txt_sigla_uf, count(operacao_id) as qtd_solicitacoes, 
                                                                        sum(vlr_solicitado) as total_solicitado,
                                                                        sum(qtd_liberado) as qtd_liberacoes, 
                                                                        sum(vlr_liberado) as total_liberado ')
                                                        ->groupBy('txt_sigla_uf')
                                                        ->where($whereSolicitacoes)
                                                        ->orderBy('txt_sigla_uf')
                                                        ->get();
            $dtePosicao = SolicitacaoPagamento::where($whereSolicitacoes)
                                        ->max('dte_movimento');

                $solicitacoesPagMes = SolicitacaoPagamento::selectRaw('num_mes_solicitacao,mes_solicitacao,count(operacao_id) as qtd_solicitacoes, 
                                                        sum(vlr_solicitado) as total_solicitado,
                                                        sum(qtd_liberado) as qtd_liberacoes, 
                                                        sum(vlr_liberado) as total_liberado ')
                    ->groupBy('num_mes_solicitacao','mes_solicitacao')
                    ->where($whereSolicitacoes)
                    ->orderBy('num_mes_solicitacao')
                    ->get(); 

                $count = 0;
                foreach($solicitacoesPagMes as $solicitacao){
                        
                    $where = [];
                    //$where[] = ['bln_1_parcela', true];
                    $where[] = ['num_mes_solicitacao', $solicitacao->num_mes_solicitacao];
                    $faturasMesPagObs = SolicitacaoPagamento::selectRaw('txt_observacao, count(operacao_id) as qtd_solicitacoes, 
                                                                            sum(vlr_solicitado) as total_solicitado,
                                                                            sum(qtd_liberado) as qtd_liberacoes, 
                                                                            sum(vlr_liberado) as total_liberado ')
                                                                ->groupBy('txt_observacao')
                                                                ->where($where)
                                                                ->where($whereSolicitacoes)
                                                                ->orderBy('txt_observacao')
                                                                ->get();
                    
                    $faturasMesPagTipo = SolicitacaoPagamento::selectRaw('txt_tipo_liberacao, count(operacao_id) as qtd_solicitacoes, 
                                                                sum(vlr_solicitado) as total_solicitado,
                                                                sum(qtd_liberado) as qtd_liberacoes, 
                                                                sum(vlr_liberado) as total_liberado ')
                                                    ->groupBy('txt_tipo_liberacao')
                                                    ->where($where)
                                                    ->where($whereSolicitacoes)
                                                    ->orderBy('txt_tipo_liberacao')
                                                    ->get();                                                                

                    $solicitacoesPagMes[$count]['observacoes'] = $faturasMesPagObs;
                    $solicitacoesPagMes[$count]['tipo_liberacoes'] = $faturasMesPagTipo;

                    $count++;
                }        
                
               // return $solicitacoesPagMes;
                return view('financeiro.quadroResumoSolicitacoes',compact('solicitacoesPagObs','totalSolicitacaoPagObs','solicitacoesPagUhs',
                                                                          'solicitacoesPagMes','estado','municipio',
                                                                          'tipoLiberacao', 'mes','posicaoDe','posicaoAte','mesLiberacao',
                                                                          'posicaoDeLib','posicaoAteLib','dtePosicao'));
            
            }

        }

            public function consultaSituacaoPagamento(){

                return view('financeiro.consultaSituacaoPagamento');
            }

            
            public function situacaoPagamento(Request $request){
        
                 $request->all();
                $whereSolicitacoes = [];
               
                $pos_espaco = strpos($request->mesSolicitacao, '-');// perceba que há um espaço aqui
                $mesSol = substr($request->mesSolicitacao, 0, $pos_espaco);

                
                $estado = [];
                if($request->estado){
                    $whereSolicitacoes[] = ['uf_id', $request->estado]; 
                    $estado = Uf::where('id',$request->estado)->firstOrFail();                   
                }

                $municipio = [];
                if($request->municipio){
                    $whereSolicitacoes[] = ['municipio_id', $request->municipio]; 
                    $municipio = Municipio::where('id',$request->municipio)->firstOrFail();                   
                }

                if($request->modalidade){
                    if($request->modalidade == 3){
                        $whereSolicitacoes[] = ['txt_modalidade','LIKE', '%FAR%'];                                                                
                    }else{
                        $whereSolicitacoes[] = ['modalidade_id', $request->modalidade];                                     
                    }
                    
                }
                
                $tipoLiberacao = [];
                if($request->tipoLiberacao){
                    $whereSolicitacoes[] = ['tipo_liberacao_id', $request->tipoLiberacao]; 
                    $tipoLiberacao = TipoLiberacao::where('id',$request->tipoLiberacao)->firstOrFail();                   
                }

                $mes = [];
                if($request->mesSolicitacao){
                    $whereSolicitacoes[] = ['num_mes_solicitacao', $mesSol]; 
                    $mes = Mes::where('id',$mesSol)->firstOrFail();                   
                }

                $posicaoDe = '';
                if(($request->posicao_de) && (!$request->posicao_ate)){
                    $whereSolicitacoes[] = ['dte_solicitacao','=', $request->posicao_de]; 
                    $posicaoDe = $request->posicao_de;                   
                }else if(($request->posicao_de) && ($request->posicao_ate)){
                    $whereSolicitacoes[] = ['dte_solicitacao','>=', $request->posicao_de]; 
                    $posicaoDe = $request->posicao_de;                   
                }else{
                    $posicaoDe = $request->posicao_de;                   
                }
                
                $posicaoAte = '';
                if($request->posicao_ate){
                    $whereSolicitacoes[] = ['dte_solicitacao','<=', $request->posicao_ate]; 
                    $posicaoAte = $request->posicao_ate;                   
                }

                $mesLiberacao = [];
                if($request->mesLiberacao){
                    $whereSolicitacoes[] = ['num_mes_liberacao', $request->mesLiberacao]; 
                    $mesLiberacao = Mes::where('id',$request->mesLiberacao)->firstOrFail();                   
                }


                $posicaoDeLib = '';
                if(($request->posicao_deLib) && (!$request->posicao_ateLib)){
                    $whereSolicitacoes[] = ['dte_liberacao','=', $request->posicao_deLib]; 
                    $posicaoDeLib = $request->posicao_deLib;                   
                }else if(($request->posicao_deLib) && ($request->posicao_ateLib)){
                    $whereSolicitacoes[] = ['dte_liberacao','>=', $request->posicao_deLib]; 
                    $posicaoDeLib = $request->posicao_deLib;                   
                }else{
                    $posicaoDeLib = $request->posicao_deLib;                   
                }

                $posicaoAteLib = '';
                if($request->posicao_ateLib){
                    $whereSolicitacoes[] = ['dte_liberacao','<=', $request->posicao_ateLib]; 
                    $posicaoAteLib = $request->posicao_ateLib;                   
                }

                $numApf = '';
                if($request->num_apf){
                    $whereSolicitacoes[] = ['operacao_id', $request->num_apf];
                    $numApf = $request->num_apf;
                }
                 //solicitações por observações
        
                $solicitacoesPag = SolicitacaoPagamento::select('dte_solicitacao','operacao_id as num_apf_obra','txt_modalidade','txt_sigla_uf','ds_municipio','txt_empreendimento as txt_nome_empreendimento',
                                                                       'vlr_solicitado','vlr_liberacao as vlr_liberado','dte_liberacao','txt_tipo_liberacao_abreviado',
                                                                       'txt_situacao_solicitacao_medicao as txt_observacao' )
                                                    ->where($whereSolicitacoes)
                                                    ->orderBy('dte_solicitacao')
                                                    ->orderBy('txt_sigla_uf')
                                                    ->orderBy('ds_municipio')
                                                    ->get();

                 $dtePosicao = SolicitacaoPagamento::where($whereSolicitacoes)->max('dte_movimento');
               
                $cabecalhoTab = ['Data da Solicitação','APF','Modalidade', 'UF','Município','Empreendimento','Valor Solicitado','Valor Liberado','Data da Liberação','Tipo de Liberação','Situação'];

                
        if(count($solicitacoesPag)>0){
            
            if($request->num_apf){
             $solicitacoesPagObs = SolicitacaoPagamento::selectRaw('txt_empreendimento, txt_sigla_uf,ds_municipio, txt_situacao_solicitacao_medicao as txt_observacao, count(operacao_id) as qtd_solicitacoes, 
                                                    sum(vlr_solicitado) as total_solicitado,
                                                    sum(qtd_liberado) as qtd_liberacoes, 
                                                    sum(vlr_liberacao) as total_liberado ')
                                   ->groupBy('txt_empreendimento','txt_sigla_uf','ds_municipio','txt_situacao_solicitacao_medicao')
                                   ->where($whereSolicitacoes)
                                   ->orderBy('txt_situacao_solicitacao_medicao')
                                   ->get();
            }else{
                $solicitacoesPagObs = SolicitacaoPagamento::selectRaw('txt_situacao_solicitacao_medicao as txt_observacao, count(operacao_id) as qtd_solicitacoes, 
                                                    sum(vlr_solicitado) as total_solicitado,
                                                    sum(qtd_liberado) as qtd_liberacoes, 
                                                    sum(vlr_liberacao) as total_liberado ')
                                   ->groupBy('txt_situacao_solicitacao_medicao')
                                   ->where($whereSolicitacoes)
                                   ->orderBy('txt_situacao_solicitacao_medicao')
                                   ->get();
            }                       
            $solicitacoesPagMod = SolicitacaoPagamento::selectRaw('txt_modalidade, count(operacao_id) as qtd_solicitacoes, 
                                   sum(vlr_solicitado) as total_solicitado,
                                   sum(qtd_liberado) as qtd_liberacoes, 
                                   sum(vlr_liberacao) as total_liberado ')
                  ->groupBy('txt_modalidade')
                  ->where($whereSolicitacoes)
                  ->orderBy('txt_modalidade')
                  ->get();                       

                $totalSolicitacaoPagObs = ['nome_empreendimento' => '', 'sigla_uf' => '','municipio' => '',
                                        'qtd_solicitacoes'=> 0, 'total_solicitado'=> 0,'qtd_liberacoes'=> 0, 'total_liberado'=> 0];
                $count = 0;
                foreach($solicitacoesPagObs as $solicitacao){
                    $totalSolicitacaoPagObs['qtd_solicitacoes'] += $solicitacao->qtd_solicitacoes;
                    $totalSolicitacaoPagObs['total_solicitado'] += $solicitacao->total_solicitado;
                    $totalSolicitacaoPagObs['qtd_liberacoes'] += $solicitacao->qtd_liberacoes;
                    $totalSolicitacaoPagObs['total_liberado'] += $solicitacao->total_liberado;
                   
                    if(($numApf != '') && ($totalSolicitacaoPagObs['nome_empreendimento'] == '')){
                        $totalSolicitacaoPagObs['nome_empreendimento'] = $solicitacao->txt_empreendimento; 
                        $totalSolicitacaoPagObs['sigla_uf'] = $solicitacao->txt_sigla_uf; 
                        $totalSolicitacaoPagObs['municipio'] = $solicitacao->ds_municipio; 
                    }

                   // return $totalSolicitacaoPagObs;
                    $count++;                                                            
                }
    // return  $totalSolicitacoesPagamento;            
                return view('financeiro.situacaoPagamento',compact('estado','municipio','tipoLiberacao','totalSolicitacaoPagObs',
                                                                    'mes','posicaoDe','posicaoAte','solicitacoesPag','solicitacoesPagObs',
                                                                    'mesLiberacao','posicaoDeLib','solicitacoesPagMod',
                                                                    'posicaoAteLib','dtePosicao','cabecalhoTab',
                                                                'numApf'));
            } else {
                flash()->erro("Erro", "Não existe solicitação para os parâmetros escolhidos.");            
                return back();  
            }
            
        
        
    }

    public function filtroOrcamentos(){

        return view('financeiro.consultaOrcamentos');
    }

    public function dadosOrcamentos(Request $request){

        //return $request->all();
        $where = [];
                
        $estado = [];
        if($request->acao){
            $where[] = ['acao_governo_id', $request->acao];             
        }

        if($request->ano){
            $where[] = ['num_ano_exercicio', $request->ano];             
        }

         $orcamentos = Orcamento::where($where)->orderBy('num_ano_exercicio')->orderBy('txt_cod_acao')->get();
        $subTotalizadorOrcamentos = Orcamento::selectRaw('num_ano_exercicio,
                                            Sum(vlr_dotacao_inicial) as total_dotacao_inicial,
                                            Sum(vlr_dotacao_adicional) as total_dotacao_adicional,
                                            Sum(vlr_orcamento_disponibilizado) as total_orcamento_disponibilizado,
                                            Sum(vlr_empenhado_sem_canc) as total_empenhado_sem_canc,
                                            Sum(vlr_rp_cancelados) as total_rp_cancelados,
                                            Sum(vlr_empenhado_liquidado_exerc) as total_empenhado_liquidado_exerc,
                                            Sum(vlr_aporte_fgts) as total_aporte_fgts,
                                            Sum(vlr_pago_exec_loa) as total_pago_exec_loa,
                                            Sum(vlr_rp_processado_pago_ne) as total_rp_processado_pago_ne,
                                            Sum(vlr_rp_nao_processados_pagos) as total_rp_nao_processados_pagos,
                                            Sum(vlr_pago_exercicio) as total_pago_exercicio,
                                            Sum(vlr_a_pagar_orcamentario) as total_a_pagar_orcamentario,
                                            Sum(vlr_a_pagar_rap) as total_a_pagar_rap,
                                            Sum(a_pagar_orcamentario_extra) as total_a_pagar_orcamentario_extra')
                                    ->where($where)
                                    ->groupBy('num_ano_exercicio')->orderBy('num_ano_exercicio')->get();
         $totalizadorOrcamentos = ['total_dotacao_inicial'=> 0, 'total_dotacao_adicional'=> 0,'total_orcamento_disponibilizado'=> 0, 'total_empenhado_sem_canc'=> 0,
                                    'total_rp_cancelados'=> 0, 'total_empenhado_liquidado_exerc'=> 0,'total_aporte_fgts'=> 0, 'total_pago_exec_loa'=> 0,
                                    'total_rp_processado_pago_ne'=> 0, 'total_rp_nao_processados_pagos'=> 0,'total_pago_exercicio'=> 0,'total_a_pagar_orcamentario'=> 0,
                                    'total_a_pagar_rap'=> 0, 'total_a_pagar_orcamentario_extra'=> 0];                                 
        
        foreach($subTotalizadorOrcamentos as $dados){
            $totalizadorOrcamentos['total_dotacao_inicial'] += $dados->total_dotacao_inicial;
            $totalizadorOrcamentos['total_dotacao_adicional'] += $dados->total_dotacao_adicional;
            $totalizadorOrcamentos['total_orcamento_disponibilizado'] += $dados->total_orcamento_disponibilizado;
            $totalizadorOrcamentos['total_empenhado_sem_canc'] += $dados->total_empenhado_sem_canc;
            $totalizadorOrcamentos['total_rp_cancelados'] += $dados->total_rp_cancelados;
            $totalizadorOrcamentos['total_empenhado_liquidado_exerc'] += $dados->total_empenhado_liquidado_exerc;
            $totalizadorOrcamentos['total_aporte_fgts'] += $dados->total_aporte_fgts;
            $totalizadorOrcamentos['total_pago_exec_loa'] += $dados->total_pago_exec_loa;
            $totalizadorOrcamentos['total_rp_processado_pago_ne'] += $dados->total_rp_processado_pago_ne;
            $totalizadorOrcamentos['total_rp_nao_processados_pagos'] += $dados->total_rp_nao_processados_pagos;
            $totalizadorOrcamentos['total_pago_exercicio'] += $dados->total_pago_exercicio;
            $totalizadorOrcamentos['total_a_pagar_orcamentario'] += $dados->total_a_pagar_orcamentario;
            $totalizadorOrcamentos['total_a_pagar_rap'] += $dados->total_a_pagar_rap;
            $totalizadorOrcamentos['total_a_pagar_orcamentario_extra'] += $dados->total_a_pagar_orcamentario_extra;
        }   
                                    
       $liberacoes = ResumoLiberacoesAno::selectRaw('txt_cod_acao, txt_titulo_acao,
                                                    sum(vlr_liberacao_2009) as total_liberacoes_2009, sum(vlr_liberacao_2010) as total_liberacoes_2010, sum(vlr_liberacao_2011) as total_liberacoes_2011, sum(vlr_liberacao_2012) as total_liberacoes_2012, 
                                                sum(vlr_liberacao_2013) as total_liberacoes_2013, sum(vlr_liberacao_2014) as total_liberacoes_2014, sum(vlr_liberacao_2015) as total_liberacoes_2015, sum(vlr_liberacao_2016) as total_liberacoes_2016, 
                                                sum(vlr_liberacao_2017) as total_liberacoes_2017, sum(vlr_liberacao_2018) as total_liberacoes_2018, sum(vlr_liberacao_2019) as total_liberacoes_2019,
                                                Sum(total_liberacao_acao) as total_liberacao_acao')
                                                    ->where($where)
                                                    ->groupBy('txt_cod_acao','txt_titulo_acao')
                                                    ->orderBy('txt_titulo_acao')
                                                    ->orderBy('txt_cod_acao')                                                    
                                                    ->get();
        $totalLiberacoes = ['total_liberacoes_2009'=> 0, 'total_liberacoes_2010'=> 0,'total_liberacoes_2011'=> 0, 'total_liberacoes_2012'=> 0,
                            'total_liberacoes_2013'=> 0, 'total_liberacoes_2014'=> 0,'total_liberacoes_2015'=> 0, 'total_liberacoes_2016'=> 0,
                            'total_liberacoes_2017'=> 0, 'total_liberacoes_2018'=> 0,'total_liberacoes_2019'=> 0,'total_liberacao_acao'=> 0];                                 

        foreach($liberacoes as $dados){
            $totalLiberacoes['total_liberacoes_2009'] += $dados->total_liberacoes_2009;
            $totalLiberacoes['total_liberacoes_2010'] += $dados->total_liberacoes_2010;
            $totalLiberacoes['total_liberacoes_2011'] += $dados->total_liberacoes_2011;
            $totalLiberacoes['total_liberacoes_2012'] += $dados->total_liberacoes_2012;
            $totalLiberacoes['total_liberacoes_2013'] += $dados->total_liberacoes_2013;
            $totalLiberacoes['total_liberacoes_2014'] += $dados->total_liberacoes_2014;
            $totalLiberacoes['total_liberacoes_2015'] += $dados->total_liberacoes_2015;
            $totalLiberacoes['total_liberacoes_2016'] += $dados->total_liberacoes_2016;
            $totalLiberacoes['total_liberacoes_2017'] += $dados->total_liberacoes_2017;
            $totalLiberacoes['total_liberacoes_2018'] += $dados->total_liberacoes_2018;
            $totalLiberacoes['total_liberacoes_2019'] += $dados->total_liberacoes_2019;
            $totalLiberacoes['total_liberacao_acao'] += $dados->total_liberacao_acao;
        }   

       // return $totalLiberacoes;

        return view('financeiro.dadosOrcamento', compact('orcamentos','totalizadorOrcamentos','subTotalizadorOrcamentos','liberacoes','totalLiberacoes'));
    }

    public function solicitacoesAPF($apf){
        
         $solicitacoesPag = SolicitacaoPagamento::select('dte_solicitacao','operacao_id as num_apf_obra','txt_modalidade','txt_sigla_uf','ds_municipio','txt_empreendimento as txt_nome_empreendimento',
                                                                       'vlr_solicitado','vlr_liberacao as vlr_liberado','dte_liberacao','txt_tipo_liberacao_abreviado',
                                                                       'txt_situacao_solicitacao_medicao as txt_observacao' )
                                                    ->where('operacao_id', $apf)
                                                    ->orderBy('dte_solicitacao')
                                                    ->orderBy('txt_sigla_uf')
                                                    ->orderBy('ds_municipio')
                                                    ->get();
    $totalSolicitacaoPag = ['qtd_solicitacoes'=> 0, 'total_solicitado'=> 0,
                            'qtd_liberacoes'=> 0, 'total_liberado'=> 0];

    $count = 0;
    foreach($solicitacoesPag as $solicitacao){
        $totalSolicitacaoPag['qtd_solicitacoes'] += 1;
        $totalSolicitacaoPag['total_solicitado'] += $solicitacao->vlr_solicitado;
        $totalSolicitacaoPag['qtd_liberacoes'] += ($solicitacao->vlr_liberado > 0) ? 1 : 0;
        $totalSolicitacaoPag['total_liberado'] += $solicitacao->vlr_liberado;

        $count++;                                                            
    }

    $empreendimentos = Operacao::leftjoin('tab_municipios','tab_operacoes.municipio_id', '=','tab_municipios.id')
               ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
               ->leftjoin('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id') 
               ->leftjoin('opc_status_empreendimento','opc_status_empreendimento.id','=','tab_operacoes.status_empreendimento_id')
           ->leftjoin('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
           ->leftjoin('opc_faixa_renda','opc_faixa_renda.id','=','tab_operacoes.faixa_renda_id')
           ->select('txt_sigla_uf','ds_municipio', 'tab_operacoes.id as operacao_id', 'txt_nome_empreendimento','txt_modalidade','dsc_faixa','txt_portaria_selecao',
           'prc_obra_realizado', 'qtd_uh_financiadas','qtd_uh_concluidas','qtd_uh_entregues',
           'vlr_operacao','txt_status_empreendimento',
           'bln_vigente')
           ->orderBy('txt_sigla_uf', 'asc')
           ->orderBy('ds_municipio', 'asc')
           ->orderBy('txt_nome_empreendimento', 'asc')
           ->where('tab_operacoes.id',$apf)
           ->first();

    // return $totalSolicitacaoPag;
    return view('financeiro.solicitacoes_apf', compact('solicitacoesPag','totalSolicitacaoPag','empreendimentos'));                                                    

    }
}
