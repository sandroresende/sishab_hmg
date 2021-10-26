<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Selecao;
use Config\App;
use App\Municipio;
use App\RelatorioExecutivoResumo;
use App\oferta\Protocolo;
use App\BrasilComRm;
use App\DeficitHabitacional;
use App\RelatorioExecutivoAno;
use App\Posicao;
use App\RelatorioExecutivoInt;
use App\ResumoOperacao;

use App\EstimativaPopulacao;
use App\Operacao;
use App\PainelContratacaoAno;
use App\Entregas;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('redirecionar');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $usuario = auth()->user()->modulo_sistema_id;
        //return $usuario;
        $populacao = new EstimativaPopulacao;
        $populacaoTotal =  $populacao->qtdePopulacaoEstimada();

        $deficit = DeficitHabitacional::selectRaw('sum(vlr_deficit_habitacional_urbano) as vlr_deficit_habitacional_urbano, 
                                                  sum(vlr_deficit_habitacional_rural) as vlr_deficit_habitacional_rural')
                                                ->firstOrFail();
        
        $dataPosicao = Operacao::join('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
                                ->selectRaw('txt_modalidade, max(dte_movimento_arquivo) as dte_movimento')->where('modalidade_id','!=',99)
                                                ->groupBy('txt_modalidade')->get();
        $relatorioExecutivo = Operacao::join('opc_status_empreendimento','opc_status_empreendimento.id','=','tab_operacoes.status_empreendimento_id')
                                ->join('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
                                ->join('opc_faixa_renda','opc_faixa_renda.id','=','tab_operacoes.faixa_renda_id')
                                ->selectRaw('txt_modalidade, dsc_faixa, faixa_renda_id, max(dte_movimento_arquivo) as dte_movimento,
                                            sum(qtd_uh_financiadas) AS num_uh,
                                            sum(num_uh_distratadas) AS num_distratadas,
                                            sum(CASE
                                                    WHEN status_empreendimento_id = 7 THEN 0
                                                    WHEN opc_status_empreendimento.bln_vigente = true AND modalidade_id = 1 AND origem_id = 3 THEN qtd_uh_financiadas - num_uh_distratadas
                                                    ELSE qtd_uh_financiadas - qtd_uh_entregues - num_uh_distratadas
                                                END) AS num_vigentes,
                                            sum(CASE
                                                    WHEN status_empreendimento_id = 7 THEN qtd_uh_financiadas - qtd_uh_entregues - num_uh_distratadas
                                                    ELSE 0
                                                END) AS num_nao_entregues,
                                            sum(qtd_uh_entregues) as num_entregues,
                                            sum(vlr_liberado) as num_vlr_liberado, 
                                            sum(vlr_operacao) as num_vlr_total')
                                        ->groupBy('txt_modalidade','dsc_faixa', 'faixa_renda_id')
                                        ->orderBy('dsc_faixa', 'txt_modalidade')
                                        ->get();



        $uh_contratadas = $relatorioExecutivo->sum('num_uh');   
        
       
        $contratacaoAno = PainelContratacaoAno::selectRaw('txt_regiao, sum(uh_faixa_1) as uh_faixa_1,sum(uh_faixa_15) as uh_faixa_15,
                                    sum(uh_faixa_2) as uh_faixa_2,sum(uh_faixa_3) as uh_faixa_3, 
                                    sum(uh_producao_estoque) as uh_producao_estoque,
                                    sum(vlr_contratado) as vlr_contratado,sum(qtd_uh_contratada) as qtd_uh_contratada ')
                                    ->where('num_ano_assinatura', '=', 2019)
                                    ->groupBy('txt_regiao')
                                    ->orderBy('txt_regiao')
                                    ->get();                                        
        
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
                                        ->where('num_ano_entrega', 2019)                                
                                        ->groupBy('txt_regiao')                                                
                                        ->orderBy('txt_regiao', 'asc')
                                            ->get();


            $valoresEntregas = ['faixa1'=> 0, 'faixa15'=> 0, 'faixa2'=> 0,'faixa3'=> 0,'entregues'=> 0, 'valor_uh_entregues'=> 0]; 
            
            foreach($entregaAno as $dados){
    
                $valoresEntregas['faixa1'] += empty($dados->uh_faixa_1) ? 0 : $dados->uh_faixa_1;  
                $valoresEntregas['faixa15'] += empty($dados->uh_faixa_15) ? 0 : $dados->uh_faixa_15;  
                $valoresEntregas['faixa2'] += empty($dados->uh_faixa_2) ? 0 : $dados->uh_faixa_2;  
                $valoresEntregas['faixa3'] += empty($dados->uh_faixa_3) ? 0 : $dados->uh_faixa_3;              
                $valoresEntregas['entregues'] += $dados->qtd_uh_entregues;      
                $valoresEntregas['valor_uh_entregues'] += $dados->vlr_uh_entregues_fx1+$dados->vlr_uh_entregues_fgts;      
    
            }                                            

         return view('home',compact('populacaoTotal','deficit','uh_contratadas','relatorioExecutivo','dataPosicao',
                                        'valoresMCMV','contratacaoAno','valoresEntregas','entregaAno')); 
    }

    public function consultaRapida()
    {
        $selecoes = Selecao::orderBy('dte_portaria_resultado')->get();
        $selecoes->load('modalidade');

        $municipiosLimite = Municipio::join('tab_uf','tab_uf.id','=','tab_municipios.uf_id')
                                        ->orderBy('ds_municipio', 'asc')                                
                                        ->orderBy('txt_uf', 'asc')  
                                        ->select('tab_municipios.id','tab_municipios.ds_municipio','tab_uf.txt_sigla_uf')
                                        ->get();

        $municipiosExecutivo = RelatorioExecutivoResumo::selectRaw('municipio_id, ds_municipio, txt_sigla_uf')
                                ->groupBy('municipio_id', 'ds_municipio','txt_sigla_uf')
                                ->orderBy('ds_municipio', 'asc')
                                ->orderBy('txt_sigla_uf', 'asc')
                                ->get();    
                                
        $protocolos = Protocolo::select('txt_protocolo')
        ->orderBy('txt_protocolo', 'asc')
        ->get();     
        
        $itens = [];
        foreach($protocolos as $protocolo){
            $itens[] = $protocolo->txt_protocolo;
        }
        $itens = json_encode($itens);
        
        return view('consultaRapida',compact('selecoes','municipiosLimite','municipiosExecutivo','itens'));
    }
    
}
