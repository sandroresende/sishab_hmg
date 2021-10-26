<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Selecao;
use App\Modalidade;
use App\User;
use App\ResumoPropostas;
use App\Uf;
use App\Municipio;
use App\ResumoOperacao;
use App\ResumoLiberacaoOperacao;
use App\ArquivosMatriz;
use App\DadosOperacaoFar;
use App\DadosOperacaoFds;
use App\DadosOperacaoPnhr;
use App\DadosOperacaoOferta;
use App\ItensDeclaratoriosPropostas;
use App\TipoComunidadeRural;
use App\SolicitacaoPagamento;
use App\MotivoNaoSelecao;
use App\ResumoRetomada;
use App\ResumoOficio;
use App\oferta\Protocolo;
use App\ResumoRetomadaObras;
use App\ResumoOficioRetomada;
use App\ObservacaoRetomada;
use App\MotivoNaoEnquadramento;

use App\SituacaoObra;
use App\Operacao;
use App\StatusEmpreendimento;
use App\BeneficiariosOperacao;


use App\pac\ProjetosPac;
use App\pac\OperacoesVinculadas;

//Usadas para o excel
use App\Exports\EmpreendimentoAPFExport;
use App\Exports\EmpreendimentoContratadosExp;

use Maatwebsite\Excel\Facades\Excel;

class EmpreendimentoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    Public function __construct()
    {
      //  $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtro_empreendimentos()
    {
        return view('empreendimentos.consultaEmpreendimentos');
    }

    public function consulta_empreendimentos(Request $request)
    {
       
        //return $request->all();
       //Dados para o Excel
       $dadosEmpreendimento = array();
       $dadosEmpreendimento = ['regiao'=> "tudo", 'municipio' => 'tudo', 'estado' => 'tudo', 'modalidade' => 'tudo', 'empreendimento' => 'tudo','faixa' => 'tudo'];
  //Fim Dados para o Excel

        $wherePropostas = [];
        $where = [];
        $where[] = ['origem_id', 2];                    
       // $where[] = ['txt_nome_empreendimento','<>', null];
        $operacaoId = str_replace(".","",str_replace("/","",str_replace("-","",$request->num_apf)));
        
        if($request->num_apf || $request->empreendimento){
            if($request->empreendimento){
                $operacaoId = $request->empreendimento;
            }

            $wherePropostas[] = ['num_apf', $operacaoId]; 
            $where[] = ['operacao_id', $operacaoId]; 
            $where[] = ['origem_id', '!=',1]; 
            //$wherePropostas[] = ['bln_contratada', false]; 

          $empreendimentosContratados = ResumoOperacao::selectRaw('operacao_id')
                ->where($where)
                ->first();

            if($empreendimentosContratados){               
               
                return $this->dados_empreendimento($empreendimentosContratados->operacao_id);
            }else{  
                        
               return $this->buscaPropostaAPF($operacaoId);
            }   
        }else{
            $estado = [];
            if($request->estado){
                 $where[] = ['uf_id', $request->estado];
                 $wherePropostas[] = ['uf_id', $request->estado];
                $estado = Uf::where('id',$request->estado)->firstOrFail();
                 $dadosEmpreendimento['estado'] = $request->estado; // Para o Excel            
             }
      
            $municipio = [];
            if($request->municipio){
                 $where[] = ['municipio_id', $request->municipio];
                 $wherePropostas[] = ['municipio_id', $request->municipio];
                 $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
                 $dadosEmpreendimento['municipio'] = $request->municipio; // Para o Excel       
             }

             $modalidade = [];
            if($request->modalidade){
                 $where[] = ['modalidade_id', $request->modalidade];
                 $wherePropostas[] = ['modalidade_id', $request->modalidade];
                 $modalidade = Modalidade::where('id',$request->modalidade)->firstOrFail();
                 $dadosEmpreendimento['modalidade'] = $request->modalidade; // Para o Excel       
             }

             
             $empreendimentosPropostas = ResumoPropostas::select('txt_sigla_uf','ds_municipio','num_apf','txt_nome_empreendimento','txt_modalidade','num_portaria_resultado',
                        'dte_portaria_resultado', 'num_uh','vlr_investimento','bln_enquadrada','bln_selecionada',
                        'num_selecao','num_ano_selecao','proposta_id'    )
                        ->orderBy('txt_sigla_uf', 'asc')
                        ->orderBy('ds_municipio', 'asc')
                        ->orderBy('txt_nome_empreendimento', 'asc')
                        ->where($wherePropostas)->get();
             
                        $empreendimentosContratados = [];
             $empreendimentosNaoContratados = [];
          
            

           foreach($empreendimentosPropostas as $empreendimento){
                $dados = [];
                $dados['txt_sigla_uf'] = $empreendimento->txt_sigla_uf;
                $dados['ds_municipio'] = $empreendimento->ds_municipio;
                $dados['txt_num_apf'] = $empreendimento->num_apf;
                $dados['txt_nome_empreendimento'] = $empreendimento->txt_nome_empreendimento;
                $dados['txt_modalidade'] = $empreendimento->txt_modalidade;
                $dados['selecao'] = $empreendimento->num_selecao . '/' .$empreendimento->num_ano_selecao;
                if($empreendimento->bln_selecionada){
                    $dados['num_portaria_resultado'] = $empreendimento->num_portaria_resultado . ' de ' . date("d/m/Y", strtotime($empreendimento->dte_portaria_resultado));
                }else{
                    $dados['num_portaria_resultado'] = null;
                }
                
                $dados['num_uh'] = $empreendimento->num_uh;
                $dados['num_valor'] = number_format($empreendimento->vlr_investimento,2,",",".");
                if($empreendimento->bln_selecionada){
                    $dados['situacao'] = 'Proposta Selecionada';
                }else{
                    if($empreendimento->bln_enquadrada){
                        $dados['situacao'] = 'Proposta Enquadrada';
                    }else{
                        $dados['situacao'] = 'Proposta Não Enquadrada';
                    }
                    $dados['id'] = $empreendimento->proposta_id;    
            }
            
            array_push($empreendimentosNaoContratados, $dados);

           }

           $cabecalhoTabNaoContratados = ['UF','Município', 'APF','Empreendimento','Modalidade','Seleção','Portaria','UH','Valor','Situação'];
            $cabecalhoTabNaoContratados = json_encode($cabecalhoTabNaoContratados);
               
           $empreendimentosNaoContratados = ($empreendimentosNaoContratados);
           $situacoesSelecionadas = [];
           session_start();          //php part
           $_SESSION['situacao'] = null;
           if($request->statusEmpreendimento){
             $whereSituacao[] = ['status_empreendimento_id', $request->statusEmpreendimento]; 
             //$dadosEmpreendimento['situacao'] = $request->situacaoObra; // Para o Excel     
            // session_start();          //php part
            $_SESSION['situacao']=$request->statusEmpreendimento;//$request->session()->flash('situacao' , $request->situacaoObra);

            //return $dadosEmpreendimento;
             $situacoesSelecionadas = StatusEmpreendimento::whereIn('id', $request->statusEmpreendimento)->get(); 
        
             $empreendimentos = Operacao::leftjoin('tab_municipios','tab_operacoes.municipio_id', '=','tab_municipios.id')
               ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
               ->leftjoin('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id') 
               ->leftjoin('opc_status_empreendimento','opc_status_empreendimento.id','=','tab_operacoes.status_empreendimento_id')
           ->leftjoin('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
           ->leftjoin('opc_faixa_renda','opc_faixa_renda.id','=','tab_operacoes.faixa_renda_id')
           ->select('txt_sigla_uf','ds_municipio', 'tab_operacoes.id as operacao_id', 'txt_nome_empreendimento','txt_modalidade','faixa_renda_id','txt_portaria_selecao',
           'prc_obra_realizado', 'qtd_uh_financiadas','qtd_uh_concluidas','qtd_uh_entregues',
           'vlr_operacao','txt_status_empreendimento',
           'bln_vigente')
           ->orderBy('txt_sigla_uf', 'asc')
           ->orderBy('ds_municipio', 'asc')
           ->orderBy('txt_nome_empreendimento', 'asc')
           ->where($where)
           ->whereIn('status_empreendimento_id', $request->statusEmpreendimento)          
           ->get();
           /**
             return  $empreendimentos = Operacao::leftjoin('tab_municipios','tab_operacoes.municipio_id', '=','tab_municipios.id')
               ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
               ->leftjoin('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id') 
               ->leftjoin('opc_status_empreendimento','opc_status_empreendimento.id','=','tab_operacoes.status_empreendimento_id')
           ->leftjoin('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
           ->leftjoin('opc_faixa_renda','opc_faixa_renda.id','=','tab_operacoes.faixa_renda_id')
           ->select('txt_sigla_uf','ds_municipio', 'qtd_uh_financiadas as num_uh', 'txt_nome_empreendimento','txt_modalidade','num_portaria_resultado',
           'dte_portaria_resultado', 'vlr_investimento','bln_enquadrada','bln_selecionada',
           'num_selecao','num_ano_selecao','proposta_id')
           ->orderBy('txt_sigla_uf', 'asc')
           ->orderBy('ds_municipio', 'asc')
           ->orderBy('txt_nome_empreendimento', 'asc')
           ->where($wherePropostas)->get();
           
           ResumoOperacao::orderBy('txt_sigla_uf', 'asc')
                                            ->orderBy('ds_municipio', 'asc')
                                            ->orderBy('txt_nome_empreendimento', 'asc')
                                            ->where($where)                                                
                                            ->whereIn('situacao_obras_ifs_id', $request->situacaoObra)          
                                            ->get();
                                      
**/
       }  else{

         $empreendimentos = Operacao::leftjoin('tab_municipios','tab_operacoes.municipio_id', '=','tab_municipios.id')
               ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
               ->leftjoin('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id') 
               ->leftjoin('opc_status_empreendimento','opc_status_empreendimento.id','=','tab_operacoes.status_empreendimento_id')
           ->leftjoin('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
           ->leftjoin('opc_faixa_renda','opc_faixa_renda.id','=','tab_operacoes.faixa_renda_id')
           ->select('txt_sigla_uf','ds_municipio', 'tab_operacoes.id as operacao_id', 'txt_nome_empreendimento','txt_modalidade','faixa_renda_id','txt_portaria_selecao',
           'prc_obra_realizado', 'qtd_uh_financiadas','qtd_uh_concluidas','qtd_uh_entregues',
           'vlr_operacao','txt_status_empreendimento',
           'bln_vigente')
           ->orderBy('txt_sigla_uf', 'asc')
           ->orderBy('ds_municipio', 'asc')
           ->orderBy('txt_nome_empreendimento', 'asc')
           ->where($where)->get();

/**
        $empreendimentos = ResumoOperacao::orderBy('txt_sigla_uf', 'asc')
                    ->orderBy('ds_municipio', 'asc')
                    ->orderBy('txt_nome_empreendimento', 'asc')
                    ->where($where)
                    ->get();
*/

       }
            

            foreach($empreendimentos as $empreendimento){
                $dados = [];
                $dados['txt_sigla_uf'] = $empreendimento->txt_sigla_uf;
                $dados['ds_municipio'] = $empreendimento->ds_municipio;
                $dados['num_apf_obra'] = $empreendimento->operacao_id;
                $dados['txt_nome_empreendimento'] = $empreendimento->txt_nome_empreendimento;
                $dados['txt_modalidade'] = $empreendimento->txt_modalidade;
                if($empreendimento->faixa_renda_id == 1){
                    $dados['faixa'] = 1;
                }elseif($empreendimento->faixa_renda_id == 2){
                    $dados['faixa'] = 2;
                }elseif($empreendimento->faixa_renda_id == 3){
                    $dados['faixa'] = 3;
                }else{
                    $dados['faixa'] = "Prod/Est";
                }
                
                $dados['num_portaria_resultado'] = $empreendimento->txt_portaria_selecao;
                                
                $dados['num_percentual'] = number_format($empreendimento->prc_obra_realizado,2,",",".");
                $dados['num_uh'] = $empreendimento->qtd_uh_financiadas;
                $dados['num_uh_concluidas'] = $empreendimento->qtd_uh_concluidas;
                $dados['num_uh_entregues'] = $empreendimento->qtd_uh_entregues;
                $dados['num_valor'] = number_format($empreendimento->vlr_operacao,2,",",".");
                
                $dados['situacao'] = $empreendimento->txt_status_empreendimento;
                //$dados['vigente'] = $empreendimento->bln_vigente;
                if($empreendimento->bln_vigente){
                    $dados['vigente'] = "Sim";
                }else{
                    $dados['vigente'] = "Não";
                }
                     
                
                
                array_push($empreendimentosContratados, $dados);
    
            }
        
            //$empreendimentosContratados = json_encode($empreendimentosContratados);
            //return $empreendimentosContratados;
          

            $cabecalhoTabContratados = ['UF','Município', 'APF','Empreendimento','Modalidade','Fx','Portaria','%','UH','Conc.','Entr.','Valor','Status','Vigente?'];
            $cabecalhoTabContratados = json_encode($cabecalhoTabContratados);
 

            return view('empreendimentos.lista_empreendimentos',
                        compact('empreendimentosContratados','cabecalhoTabContratados','estado','municipio',
                                'empreendimentosNaoContratados','cabecalhoTabNaoContratados','dadosEmpreendimento',
                                'situacoesSelecionadas')); 
        }
        
        
    }

    public function dados_empreendimento($operacaoId){
       
        //return 'teste';  
        //return $operacaoId;
        $operacao = ResumoOperacao::where('operacao_id',$operacaoId)
                                    ->firstOrFail();
       
        $where = [];
        $where[] = ['operacao_id',$operacaoId];    

            

            $resumoLiberacoes = ResumoLiberacaoOperacao::selectRaw('count(tipo_liberacao_id) as qtd_liberacoes,txt_tipo_liberacao,tipo_liberacao_id,  sum(vlr_liberacao) as vlr_liberacoes')
                                                ->where($where)
                                                ->groupBy('txt_tipo_liberacao','tipo_liberacao_id')
                                                ->get();

    //INICIO IF   //////                                             
        if($operacao->modalidade_id == 2){
            $dadosFds = DadosOperacaoFds::where('operacao_id',$operacaoId)->firstOrFail();
            if($dadosFds->nu_apf_nao_obra){
                // $where[] = ['operacao_id', $dadosFds->nu_apf_nao_obra];  
                    $resumoLiberacoes = ResumoLiberacaoOperacao::selectRaw('count(tipo_liberacao_id) as qtd_liberacoes,txt_tipo_liberacao,tipo_liberacao_id,  sum(vlr_liberacao) as vlr_liberacoes')
                                            ->where('operacao_id',$operacaoId)
                                            ->orWhere('operacao_id', $dadosFds->nu_apf_nao_obra)
                                            ->groupBy('txt_tipo_liberacao','tipo_liberacao_id')
                                            ->get();  
            }
        }   
    //FIM IF//////    
        $whereRetomada = [];
        $whereRetomada[] = ['operacao_id',$operacaoId];
        $whereRetomada[] = ['status_demanda_id',4];

           
        /////////RETOMADA///////////////////////
        $operacaoRetomada = ResumoRetomadaObras::where($whereRetomada)->First(); 
        $whereSolicitacoes = [];

      //INICIO IF////////////////
      if($operacaoRetomada){        
        $whereSolicitacoes[] = [$operacaoRetomada->num_apf_vinculado];
        $oficiosRetomadaSNH = ResumoOficioRetomada::where('retomada_obras_id',$operacaoRetomada->id)
                                      ->where('tipo_oficio_id',2)
                                      ->orderBy('dte_oficio','desc')
                                      ->orderBy('oficio_id','desc')
                                      ->get();
      
        $oficiosRetomadaGefus = ResumoOficioRetomada::where('retomada_obras_id',$operacaoRetomada->id)
                                      ->where('tipo_oficio_id',1)
                                      ->orderBy('dte_oficio','desc')
                                      ->orderBy('oficio_id','desc')
                                      ->get();                                        

         $observacoes = ObservacaoRetomada::where('retomada_obras_id',$operacaoRetomada->id)->orderBy('dte_observacao','desc')->get();
      $observacoes->load('user');
      }
      // FIM IF ////////////////
        ////////////////RETOMADA///////////////
        
   
                                              

        $totalLiberacoes = ['qtd_liberacoes'=> 0, 'total_liberado'=> 0];
        $countLiberacoes = 0;
        $ultimaLiberacao = '';
        //INICIO IF ////////////////////
        if($resumoLiberacoes){
            foreach($resumoLiberacoes as $liberacao){
                $where = [];
                $where[] = ['operacao_id',$operacaoId];
                $where[] = ['tipo_liberacao_id',$liberacao->tipo_liberacao_id];
                
                if(($liberacao->tipo_liberacao_id == 5) && ($dadosFds->nu_apf_nao_obra)){
                    $where = [];
                    $where[] = ['operacao_id',$dadosFds->nu_apf_nao_obra];
                    $liberacoes = ResumoLiberacaoOperacao::where($where)->orderBy('dte_liberacao')->get();
                }else{
                    $liberacoes = ResumoLiberacaoOperacao::where($where)->orderBy('dte_liberacao')->get();
                }
                
                
                $resumoLiberacoes[$countLiberacoes]['tipo_liberacoes'] = $liberacoes;

                $totalLiberacoes['qtd_liberacoes'] += $liberacao->qtd_liberacoes;
                $totalLiberacoes['total_liberado'] += $liberacao->vlr_liberacoes;
                
            
                $countLiberacoes++;
            }
        }          
        // FIM IF ////////////////


        //return $liberacoes;
        $ultimaLiberacao = ResumoLiberacaoOperacao::where('operacao_id',$operacaoId)->max('dte_liberacao'); 
       
        
        
        if(isset($ultimaLiberacao)){
            //$whereSolicitacoes[] = ['dte_liberacao','>', $ultimaLiberacao];    
            
        }
        


        $whereSolicitacoes[] = [$operacaoId];

        //return $whereSolicitacoes;
        
        
       $solicitacoesPag = SolicitacaoPagamento::whereIn('operacao_id',$whereSolicitacoes)
                            ->orderBy('dte_solicitacao')
                            ->get();

        

        if(count($solicitacoesPag)>0){                
            $solicitacoesPagObs = SolicitacaoPagamento::selectRaw('txt_situacao_solicitacao_medicao as txt_observacao, 
                                                    count(operacao_id) as qtd_solicitacoes, 
                                                    sum(vlr_solicitado) as total_solicitado,
                                                    sum(qtd_liberado) as qtd_liberacoes, 
                                                    sum(vlr_liberacao) as total_liberado ')
                                    ->groupBy('txt_observacao')
                                    ->whereIn('operacao_id',$whereSolicitacoes)
                                    ->orderBy('txt_observacao')
                                    ->get();

            $totalSolicitacaoPagObs = ['qtd_solicitacoes'=> 0, 'total_solicitado'=> 0,'qtd_liberacoes'=> 0, 'total_liberado'=> 0];
            $count = 0;
            foreach($solicitacoesPagObs as $solicitacao){
                $totalSolicitacaoPagObs['qtd_solicitacoes'] += $solicitacao->qtd_solicitacoes;
                $totalSolicitacaoPagObs['total_solicitado'] += $solicitacao->total_solicitado;
                $totalSolicitacaoPagObs['qtd_liberacoes'] += $solicitacao->qtd_liberacoes;
                $totalSolicitacaoPagObs['total_liberado'] += $solicitacao->total_liberado;
                $count++;                                                            
            }   
        }              
        //return  $operacaoId;
        $arquivoMatriz = ArquivosMatriz::where('operacao_id',$operacaoId)->first();
        
        
        $autenticado = Auth::user();
        $count = 0;
        $cabecalhoTab = ['UF','Município', 'CPF', 'Nome'];
        // $dadosBeneficiarios = BeneficiariosOperacao::where('operacao_id', $operacaoId)
          //                      ->select('txt_sigla_uf','ds_municipio','txt_cpf_beneficiario','txt_nome_beneficiario')
         //                       ->get();
        $dadosBeneficiarios = [];
        

        //return $dadosBeneficiarios->load('genero');;
        
        

        $municipio = Municipio::where('id',$operacao->municipio_id)->firstOrFail();
        $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
            

    //dados das propostas
    $whereProposta[] = ['num_apf', $operacaoId];
    $whereProposta[] = ['bln_contratada', true];

     $proposta = ResumoPropostas::where($whereProposta)->first();
     
     if($proposta){
        $propostaID = $proposta->proposta_id;
        $itensDeclaratorios = ItensDeclaratoriosPropostas::where('proposta_id', $propostaID)->firstOrFail();
        $itensDeclaratorios->load('regimeConstrutivo','tomadorFinanciamento');

        $tipoComunidadeRural = TipoComunidadeRural::where('proposta_id', $propostaID)->get();
        $tipoComunidadeRural->load('tipoComunidade');

        $naoSelecionado = [];
        if(!$proposta->bln_selecionada){
            $naoSelecionado = MotivoNaoSelecao::where('proposta_id', $propostaID)->get();
            $naoSelecionado->load('tipoMotivoNaoSelecao');
        }

        $naoEnquadramento = [];
        if(!$proposta->bln_enquadrada){
                $naoEnquadramento = MotivoNaoEnquadramento::join('opc_tipo_motivo_nao_enquadra', 'opc_tipo_motivo_nao_enquadra.id', '=', 'tab_motivo_nao_enquadramento.tipo_motivo_nao_enquadra_id')
                ->select('opc_tipo_motivo_nao_enquadra.txt_motivo_nao_enquadramento')       // just to avoid fetching anything from joined table
                ->where('proposta_id', $propostaID)
                ->get();
        }
    }
     $propostasApresentadas = ResumoPropostas::orderBy('txt_uf', 'asc')
            ->orderBy('ds_municipio', 'asc')
            ->orderBy('txt_nome_empreendimento', 'asc')
            ->orderBy('proposta_id', 'asc')
            ->where('num_apf',$operacaoId)
            ->where('bln_contratada',false)
            ->get();
    //return $operacao->modalidade_id;
    $operacoesPac = null;
$projetosPac = null;
$projetosPacId = '';

      $projetosPacId = ProjetosPac::join('tab_operacoes_vinculadas','tab_operacoes_vinculadas.projeto_pac_id','=','view_projetos_pac.projeto_pac_id')
                                     ->select('tab_operacoes_vinculadas.projeto_pac_id')->where('operacao_id',$operacaoId)->first();
                                     
    $projetosPac = ProjetosPac::join('tab_operacoes_vinculadas','tab_operacoes_vinculadas.projeto_pac_id','=','view_projetos_pac.projeto_pac_id')
                                ->where('operacao_id',$operacaoId)
                                ->get();
    
    //return  $projetosPac->load('operacoesVinculadas');                           
    if($projetosPac){
        $count = 0;
       foreach($projetosPac as $projetos){
            
            $operacoesPac = OperacoesVinculadas::where('projeto_pac_id',$projetos->projeto_pac_id)
                    ->get();  
            foreach($operacoesPac as $operacaoPAC){
                    
                if($projetos->projeto_pac_id == $operacaoPAC->projeto_pac_id){
                    $projetosPac[$count]['operacoes'] = $operacoesPac;
                }        
            }    
            $count++;
       }
         
                                                                                     
    }
 
   // return $projetosPac ;                                                   
    $count = 0;
    if($operacao){
        if(($operacao->modalidade_id == 3) || ($operacao->modalidade_id == 7)){
             $resumoLiberacoesRetomada = ResumoLiberacaoOperacao::selectRaw('count(tipo_liberacao_id) as qtd_liberacoes,txt_tipo_liberacao,tipo_liberacao_id,  sum(vlr_liberacao) as vlr_liberacoes')
                        ->where('operacao_id',$operacao->txt_apf_retomada)
                        ->groupBy('txt_tipo_liberacao','tipo_liberacao_id')
                        ->get();
           
                       
          $dadosFar = DadosOperacaoFar::where('operacao_id',$operacaoId)->firstOrFail();


            return view('empreendimentos.dados_empreendimento_far',compact('operacao','dadosFar','propostasApresentadas','municipio','estado', 'proposta','itensDeclaratorios',
                                                        'naoEnquadramento','tipoComunidadeRural','naoSelecionado','arquivoMatriz',
                                                        'dadosBeneficiarios','cabecalhoTab','resumoLiberacoes','totalLiberacoes',
                                                        'solicitacoesPag','solicitacoesPagObs','totalSolicitacaoPagObs',
                                                        'projetosPac','operacoesPac',
                                                        'resumoLiberacoesRetomada','totalLiberacoesRetomada','operacaoRetomada',
                                                    'oficiosRetomadaSNH','oficiosRetomadaGefus','observacoes'));  
        }elseif($operacao->modalidade_id == 2){

            $dadosFds = DadosOperacaoFds::where('operacao_id',$operacaoId)->firstOrFail();
            $where = [];
            $where[] = ['operacao_id',$operacaoId];    
            
                
            
            return view('empreendimentos.dados_empreendimento_fds',compact('operacao','dadosFds','propostasApresentadas','municipio','estado', 'proposta','itensDeclaratorios',
                                                        'naoEnquadramento','tipoComunidadeRural','naoSelecionado','arquivoMatriz',
                                                        'dadosBeneficiarios','cabecalhoTab','resumoLiberacoes','totalLiberacoes',
                                                        'solicitacoesPag','solicitacoesPagObs','totalSolicitacaoPagObs'));  
        }elseif($operacao->modalidade_id == 6){
             $dadosPnhr = DadosOperacaoPnhr::where('operacao_id',$operacaoId)->firstOrFail();
            return view('empreendimentos.dados_empreendimento_pnhr',compact('operacao','dadosPnhr','propostasApresentadas','municipio','estado', 'proposta','itensDeclaratorios',
                                                        'naoEnquadramento','tipoComunidadeRural','naoSelecionado','arquivoMatriz',
                                                        'dadosBeneficiarios','cabecalhoTab','resumoLiberacoes','totalLiberacoes',
                                                        'solicitacoesPag','solicitacoesPagObs','totalSolicitacaoPagObs',
                                                        'retomada','oficiosRetomada'));  
        }elseif($operacao->modalidade_id == 5){
            $dadosOferta = DadosOperacaoOferta::where('operacao_id',$operacaoId)->firstOrFail();
            $operacaoId = substr($operacaoId, 0, 6) . "." . substr($operacaoId,6,2) . ".". substr($operacaoId,8,2)."/". substr($operacaoId,10,4)."-". substr($operacaoId,14,2);
             $protocolo = Protocolo::where('txt_protocolo',$operacaoId)->firstOrFail();
            
            return view('empreendimentos.dados_empreendimento_oferta',compact('operacao','protocolo','dadosOferta','municipio','estado', 
                                                        'dadosBeneficiarios','cabecalhoTab','resumoLiberacoes'));  
           
        }elseif($operacao->modalidade_id == 1){
            
           return view('empreendimentos.dados_empreendimento_fgts',compact('operacao','municipio','estado'));  
       }
        
    } else {
        flash()->erro("Erro", "Código de IBGE inválido.");            
    }
    return back();  
    } 

    public function buscaPropostaAPF($txt_num_apf){
        
        $propostas = ResumoPropostas::where('num_apf','=',$txt_num_apf)->orderBy('selecao_id', 'asc')->get();
        
        
        if (count($propostas)>0 ){
            return view('propostas.propostas_apf',compact('propostas'));
        } else {
            flash()->erro("Erro", "Não existe proposta para esse Número de APF.");            
        }
	    return back();
    }


    
    public function downloadEmpreendimentoAPF($operacaoId){

        return Excel::download(new EmpreendimentoAPFExport($operacaoId), 'empreendimentoAPF.xlsx');

    }

    public function donwloadEmpreendimentosContratados($estado, $municipio){

        //$situacao = session('situacao');
        session_start();
        if($_SESSION['situacao']){
            $situacao =  $_SESSION['situacao'];
        }else{
            $situacao =  null;
        }
        session_destroy();
        //return $situacao;

        return Excel::download(new EmpreendimentoContratadosExp($estado, $municipio,$situacao), 'empreendimentoContratados.xlsx');

    }

    public function buscaEmpreendimentoModalidadeExecutivo($modalidadeID, $faixaID, $municipioID){
        session_start();
        if($_SESSION['situacao']){
            $situacao =  $_SESSION['situacao'];
        }else{
            $situacao =  null;
        }
        
        session_destroy();

            $municipio = [];
            $estado = [];
            $where = [];
            $where = [];
            
                 $where[] = ['modalidade_id', $modalidadeID];
                 $where[] = ['faixa_renda_id', $faixaID];
                 $where[] = ['municipio_id', $municipioID];

                 $wherePropostas[] = ['modalidade_id', $modalidadeID];
                 $wherePropostas[] = ['municipio_id', $municipioID];      
                            
                 $municipio = Municipio::where('id',$municipioID)->firstOrFail();
                 $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
                 $dadosEmpreendimento['estado'] = $estado->id; // Para o Excel       
                 $dadosEmpreendimento['municipio'] = $municipioID; // Para o Excel   
            

             
             $empreendimentosPropostas = ResumoPropostas::select('txt_sigla_uf','ds_municipio','num_apf','txt_nome_empreendimento','txt_modalidade','num_portaria_resultado',
                        'dte_portaria_resultado', 'num_uh','vlr_investimento','bln_enquadrada','bln_selecionada',
                        'num_selecao','num_ano_selecao','proposta_id'    )
                        ->orderBy('txt_sigla_uf', 'asc')
                        ->orderBy('ds_municipio', 'asc')
                        ->orderBy('txt_nome_empreendimento', 'asc')
                        ->where($wherePropostas)->get();
             
                        $empreendimentosContratados = [];
             $empreendimentosNaoContratados = [];
          
            

           foreach($empreendimentosPropostas as $empreendimento){
                $dados = [];
                $dados['txt_sigla_uf'] = $empreendimento->txt_sigla_uf;
                $dados['ds_municipio'] = $empreendimento->ds_municipio;
                $dados['txt_num_apf'] = $empreendimento->num_apf;
                $dados['txt_nome_empreendimento'] = $empreendimento->txt_nome_empreendimento;
                $dados['txt_modalidade'] = $empreendimento->txt_modalidade;
                $dados['selecao'] = $empreendimento->num_selecao . '/' .$empreendimento->num_ano_selecao;
                $dados['id'] = $empreendimento->proposta_id; 
                if($empreendimento->bln_selecionada){
                    $dados['num_portaria_resultado'] = $empreendimento->num_portaria_resultado . ' de ' . date("d/m/Y", strtotime($empreendimento->dte_portaria_resultado));
                }else{
                    $dados['num_portaria_resultado'] = null;
                }
                
                $dados['num_uh'] = $empreendimento->num_uh;
                $dados['num_valor'] = number_format($empreendimento->vlr_investimento,2,",",".");
                if($empreendimento->bln_selecionada){
                    $dados['situacao'] = 'Proposta Selecionada';
                }else{
                    if($empreendimento->bln_enquadrada){
                        $dados['situacao'] = 'Proposta Enquadrada';
                    }else{
                        $dados['situacao'] = 'Proposta Não Enquadrada';
                    }                      
                }
            
            array_push($empreendimentosNaoContratados, $dados);

           }

           $cabecalhoTabNaoContratados = ['UF','Município', 'APF','Empreendimento','Modalidade','Seleção','Portaria','UH','Valor','Situação'];
            $cabecalhoTabNaoContratados = json_encode($cabecalhoTabNaoContratados);
               
           //$empreendimentosNaoContratados = ($empreendimentosNaoContratados);
           session_start();          //php part
           $_SESSION['situacao'] = null;
           $situacoesSelecionadas = [];
           
           if($situacao){
                    
                    //$dadosEmpreendimento['situacao'] = $request->situacaoObra; // Para o Excel     
                    // session_start();          //php part
                    $_SESSION['situacao']=$situacao;//$request->session()->flash('situacao' , $situacao);

                    //return $dadosEmpreendimento;
                    $situacoesSelecionadas = SituacaoObra::whereIn('id', $situacao)->get(); 
                
                    $empreendimentos = ResumoOperacao::orderBy('txt_sigla_uf', 'asc')
                                                    ->orderBy('ds_municipio', 'asc')
                                                    ->orderBy('txt_nome_empreendimento', 'asc')
                                                    ->where($where)                                                
                                                    ->whereIn('situacao_obras_ifs_id', $situacao)          
                                                    ->get();
                                            

            }  else{
                $empreendimentos = ResumoOperacao::orderBy('txt_sigla_uf', 'asc')
                            ->orderBy('ds_municipio', 'asc')
                            ->orderBy('txt_nome_empreendimento', 'asc')
                            ->where($where)
                            ->get();
                            
          

            }
            

            foreach($empreendimentos as $empreendimento){
                $dados = [];
                $dados['txt_sigla_uf'] = $empreendimento->txt_sigla_uf;
                $dados['ds_municipio'] = $empreendimento->ds_municipio;
                $dados['txt_num_apf'] = $empreendimento->operacao_id;
                $dados['txt_nome_empreendimento'] = $empreendimento->txt_nome_empreendimento;
                $dados['txt_modalidade'] = $empreendimento->txt_modalidade;
                $dados['num_portaria_resultado'] = $empreendimento->txt_portaria_selecao;
                                
                $dados['num_percentual'] = number_format($empreendimento->prc_obra_realizado,2,",",".");
                $dados['num_uh'] = $empreendimento->qtd_uh_financiadas;
                $dados['num_uh_concluidas'] = $empreendimento->qtd_uh_concluidas;
                $dados['num_uh_entregues'] = $empreendimento->qtd_uh_entregues;
                $dados['num_valor'] = number_format($empreendimento->vlr_operacao,2,",",".");
                if(($empreendimento->qtd_uh_financiadas>0)){    
                    if($empreendimento->qtd_uh_financiadas == $empreendimento->qtd_uh_entregues){
                        $dados['situacao'] = 'Entregue';
                    }else{
                        $dados['situacao'] = $empreendimento->txt_situacao_obra;
                    }
                }else{
                    $dados['situacao'] = $empreendimento->txt_situacao_obra;
                }
                
                
                array_push($empreendimentosContratados, $dados);
    
            }
        //$empreendimentosContratados = json_encode($empreendimentosContratados);
        //return $empreendimentosNaoContratados;
          

            $cabecalhoTabContratados = ['UF','Município', 'APF','Empreendimento','Modalidade','Portaria','%','UH','Conc.','Entr.','Valor','Situação'];
            $cabecalhoTabContratados = json_encode($cabecalhoTabContratados);

            return view('empreendimentos.lista_empreendimentos',compact('empreendimentosContratados','cabecalhoTabContratados','estado','municipio',
                                                                        'empreendimentosNaoContratados','cabecalhoTabNaoContratados','dadosEmpreendimento',
                                                                    'situacoesSelecionadas'));        
        
 
        
    }    
}

