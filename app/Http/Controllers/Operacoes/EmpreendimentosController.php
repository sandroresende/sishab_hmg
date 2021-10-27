<?php

namespace App\Http\Controllers\Operacoes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\IndicadoresHabitacionais\Regiao;
use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;
use App\IndicadoresHabitacionais\BrasilComRm;

use App\Tab_dominios\StatusEmpreendimento;
use App\Tab_dominios\Modalidade;

use App\Mod_sishab\Operacoes\Operacao;
use App\Mod_sishab\Operacoes\ViewOperacoesContratadas;
use App\Mod_sishab\Operacoes\ViewOperacoesContratadasAno;
use App\Mod_sishab\Operacoes\ViewLiberacaoOperacao;
use App\Mod_sishab\Operacoes\DadosOperacaoFds;
use App\Mod_sishab\Operacoes\DadosOperacaoFar;
use App\Mod_sishab\Operacoes\DadosOperacaoPnhr;
use App\Mod_sishab\Operacoes\HistoricoEntregas;
use App\Mod_sishab\Operacoes\ViewDadosResumoOferta;

use App\Mod_sishab\Retomada\ViewRetomadaObras;
use App\Mod_sishab\Retomada\ViewOficioRetomada;
use App\Mod_sishab\Retomada\ObservacaoRetomada;

use App\Mod_sishab\PropostasMcmv\ResumoPropostas;
use App\Mod_sishab\PropostasMcmv\ItensDeclaratoriosPropostas;
use App\Mod_sishab\PropostasMcmv\TipoComunidadeRural;
use App\Mod_sishab\PropostasMcmv\MotivoNaoSelecao;
use App\Mod_sishab\PropostasMcmv\MotivoNaoEnquadramento;

use App\Mod_sishab\MedicoesObras\ViewMedicoesObras;

use App\Mod_sishab\OfertaPublica\Protocolo;



//Usadas para o excel
use App\Exports\ResumoMilagrosoExport;
use App\Exports\RelatorioExecutivoExport;
use App\Exports\BaseRelatorioExecutivoExport;
use App\Exports\EmpreendimentosExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class EmpreendimentosController extends Controller
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
    public function consultaEmpreendimentos()
    {
        return view('views_sishab.empreendimentos.filtroEmpreendimentos');
    }

    public function consulta_empreendimentos(Request $request)
    {
        

        $where = []; 
        $wherePropostas = [];
        //inicio if 1
        if($request->num_apf || $request->empreendimento){
            //inicio if 2
            if($request->empreendimento){
                $numApf = $request->empreendimento;
            }else{/**////////ELSE IF 2 ////////////////////////////*/   
                $numApf = $request->num_apf;
            }//fim if 2

            $wherePropostas[] = ['num_apf', $numApf]; 
            $where[] = ['txt_apf', $numApf]; 
            $where[] = ['origem_id', '!=',1]; 

            
              $empreendimentosContratados = ViewOperacoesContratadas::selectRaw('txt_apf')->where($where)->first();

             //inicio if 3
            if($empreendimentosContratados){                   
                return redirect('/empreendimento/'.$empreendimentosContratados->txt_apf);
            }else{     /**////////ELSE IF 3 ////////////////////////////*/                    
                
                $propostas = ResumoPropostas::buscaPropostaAPF($numApf);
                 $dataAtualizacao = $propostas->max('created_at');
                 $titulo1 = $propostas->max('txt_nome_empreendimento');
                 $titulo2 = $numApf;
                 //inicio if 4
                if (count($propostas)>0 ){
                    return view('views_sishab.propostas_mcmv.propostas_apf',compact('propostas','dataAtualizacao',
                                    'titulo1','titulo2'));
                } else { 
                    flash()->erro("Erro", "Não existe proposta para esse Número de APF.");            
                    return back();
                }//fim if 4                
            } //fim if  3  
////////////////////////////// FIM PESQUISA POR APF/////////////////////////

        }else{ /**////////ELSE IF 1 ////////////////////////////*/   
            //return $request->all();

            $estado = [];
            //inicio if 5
            if($request->estado){
                $where[] = ['uf_id', $request->estado];
                $wherePropostas[] = ['uf_id', $request->estado];
                $estado = Uf::where('id',$request->estado)->firstOrFail();          
            }//fim if 5
    
            $municipio = [];
            //inicio if 6
            if($request->municipio){
                $where[] = ['cod_mun_ibge', $request->municipio];
                $wherePropostas[] = ['municipio_id', $request->municipio];
                $municipio = Municipio::where('id',$request->municipio)->firstOrFail();    
            }//fim if 6

            $modalidade = [];
            //inicio if 7
            if($request->modalidade){
                $where[] = ['modalidade_id', $request->modalidade];
                $wherePropostas[] = ['modalidade_id', $request->modalidade];
                $modalidade = Modalidade::where('id',$request->modalidade)->firstOrFail();   
            }//fim if  7  

            $situacoesSelecionadas = [];
            $situacoes = [];
             //inicio if 8
            if($request->bln_vigente){
                $where[] = ['bln_vigente', $request->bln_vigente];               
                $situacoes = StatusEmpreendimento::where('bln_vigente', $request->bln_vigente)->get(); 
            }//fim if  8   
            
         
            //inicio if 9
            if($request->statusEmpreendimento){
                $whereSituacao = [];
                $whereSituacao[] = ['status_empreendimento_id', $request->statusEmpreendimento]; 
                  $situacoes = StatusEmpreendimento::whereIn('id', $request->statusEmpreendimento)->get(); 

                $situacoesSelecionadas = 'Status: ';
                $numSituacoes = count($situacoes);
                $cont = 0;
                foreach($situacoes as $dados){
                    $cont++;   
                  if($cont == $numSituacoes ){
                    $situacoesSelecionadas = $situacoesSelecionadas . $dados->txt_status_empreendimento . '. ';
                  }else{
                    $situacoesSelecionadas = $situacoesSelecionadas . $dados->txt_status_empreendimento . ', ';                    
                  }
                                 
                }

               //return $situacoesSelecionadas;
                $empreendimentos =  ViewOperacoesContratadas::selectRaw('txt_sigla_uf, ds_municipio, txt_apf, txt_nome_empreendimento, txt_modalidade, faixa_renda_id,
                                                                                prc_obra_realizado, sum(qtd_uh_contratadas) as num_uh, sum(qtd_uh_concluidas) as num_uh_concluidas,
                                                                                sum(qtd_uh_entregues) as num_uh_entregues, sum(vlr_operacao) as num_valor, txt_status_empreendimento,
                                                                                bln_vigente')
                                                                    ->where($where)
                                                                    ->whereIn('status_empreendimento_id', $request->statusEmpreendimento)  
                                                                    ->groupBy('txt_sigla_uf','ds_municipio','txt_apf','txt_nome_empreendimento','txt_modalidade','faixa_renda_id',
                                                                    'prc_obra_realizado','txt_status_empreendimento','bln_vigente')
                                                                    //->whereIn('status_empreendimento_id', $request->statusEmpreendimento)          
                                                                    ->get();
                                                                           
                                                                    
               
               
               
           
            }else{
             //   return $where;
                  $empreendimentos = ViewOperacoesContratadas::selectRaw('txt_sigla_uf, ds_municipio, txt_apf, txt_nome_empreendimento, txt_modalidade, faixa_renda_id,
                                                                                prc_obra_realizado, sum(qtd_uh_contratadas) as num_uh, sum(qtd_uh_concluidas) as num_uh_concluidas,
                                                                                sum(qtd_uh_entregues) as num_uh_entregues, sum(vlr_operacao) as num_valor, txt_status_empreendimento,
                                                                                bln_vigente')
                                                                    ->where($where)
                                                                    ->groupBy('txt_sigla_uf','ds_municipio','txt_apf','txt_nome_empreendimento','txt_modalidade','faixa_renda_id',
                                                                    'prc_obra_realizado','txt_status_empreendimento','bln_vigente')
                                                                    //->whereIn('status_empreendimento_id', $request->statusEmpreendimento)          
                                                                    ->get();
               
            }//fim if  9    
            
/** EMPREENDIMENTOS CONTRATADOS */ 
            $empreendimentosContratados = [];
            
            foreach($empreendimentos as $empreendimento){
                $dados = [];
                $dados['txt_sigla_uf'] = $empreendimento->txt_sigla_uf;
                $dados['ds_municipio'] = $empreendimento->ds_municipio;
                $dados['id'] = $empreendimento->txt_apf;
                $dados['txt_nome_empreendimento'] = $empreendimento->txt_nome_empreendimento;
                $dados['txt_modalidade'] = $empreendimento->txt_modalidade;
                //inicio if  10
                if($empreendimento->faixa_renda_id == 1){
                    $dados['faixa'] = 1;
                }elseif($empreendimento->faixa_renda_id == 2){
                    $dados['faixa'] = 2;
                }elseif($empreendimento->faixa_renda_id == 3){
                    $dados['faixa'] = 3;
                }else{
                    $dados['faixa'] = "Prod/Est";
                }//fim if  10
                
               // $dados['num_portaria_resultado'] = $empreendimento->txt_portaria_selecao;
                                
                $dados['num_percentual'] = number_format($empreendimento->prc_obra_realizado,2,",",".");
                $dados['num_uh'] = $empreendimento->qtd_uh_contratadas;
                $dados['num_uh_concluidas'] = $empreendimento->qtd_uh_concluidas;
                $dados['num_uh_entregues'] = $empreendimento->qtd_uh_entregues;
                $dados['num_valor'] = number_format($empreendimento->vlr_operacao,2,",",".");
                
                $dados['situacao'] = $empreendimento->txt_status_empreendimento;
                //$dados['vigente'] = $empreendimento->bln_vigente;
                //inicio if  11 
                if($empreendimento->bln_vigente){
                    $dados['vigente'] = "Sim";
                }else{
                    $dados['vigente'] = "Não";
                }//fim if  11
                    
                
                
                array_push($empreendimentosContratados, $dados);

            }//FIM FOREACH 2



            $cabecalhoTabContratados = ['UF','Município', 'APF','Empreendimento','Modalidade','Fx','%','UH','Conc.','Entr.','Valor','Status','Vigente?'];
            $cabecalhoTabContratados = json_encode($cabecalhoTabContratados);


/** EMPREENDIMENTOS NÃO CONTRATADOS */

                    $empreendimentosNaoContratados = [];

                    $empreendimentosPropostas = ResumoPropostas::select('txt_sigla_uf','ds_municipio','num_apf','txt_nome_empreendimento','txt_modalidade','num_portaria_resultado',
                                                    'dte_portaria_resultado', 'num_uh','vlr_investimento','bln_enquadrada','bln_selecionada',
                                                    'num_selecao','num_ano_selecao','proposta_id'    )
                                                    ->orderBy('txt_sigla_uf', 'asc')
                                                    ->orderBy('ds_municipio', 'asc')
                                                    ->orderBy('txt_nome_empreendimento', 'asc')
                                                    ->where($wherePropostas)->get();
                                                  
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
                        }//FIM FOREACH 1

                        $cabecalhoTabNaoContratados = ['UF','Município', 'APF','Empreendimento','Modalidade','Seleção','Portaria','UH','Valor','Situação'];
                        $cabecalhoTabNaoContratados = json_encode($cabecalhoTabNaoContratados);

        
    
            $subtitulo1 = '';
          //inicio if 12
         if($municipio){ 
            $subtitulo1 = $municipio->ds_municipio . '-' . $subtitulo1 = $estado->txt_sigla_uf;
         }elseif($estado){
                $subtitulo1 = $estado->txt_uf;
         }elseif($estado){
                $subtitulo1 = $regiao->txt_regiao;
         }else{
            $subtitulo1 = 'Brasil';
         } //fim if 12

         $subtitulo2 = '';
         $subtitulo3 = '';
         //inicio if  13 
        if($modalidade){
            $subtitulo2 = $modalidade->txt_modalidade;
            if($request->bln_vigente){
                $subtitulo3 = ($request->bln_vigente == true) ? 'Empreendimentos Vigentes' : 'Empreendimentos Não Vigentes';
            } else{
                $subtitulo3 = $situacoesSelecionadas;
            }
        }else if($request->bln_vigente){
            $subtitulo2 = ($request->bln_vigente == true) ? 'Empreendimentos Vigentes' : 'Empreendimentos Não Vigentes';
            if($situacoesSelecionadas){
                $subtitulo3 = $situacoesSelecionadas;
            } 
        }else if($situacoesSelecionadas){
            $subtitulo2 = $situacoesSelecionadas;
        }  //fim if 13

       
     
        // return $empreendimentosContratados;
         //inicio if 14 
         if (count($empreendimentos)>0 ){
            return view('views_sishab.empreendimentos.listaEmpreendimentos',
                        compact('empreendimentosContratados','cabecalhoTabContratados','estado','municipio',
                                'empreendimentosNaoContratados','cabecalhoTabNaoContratados','dadosEmpreendimento',
                                'situacoesSelecionadas','situacoes','subtitulo1','subtitulo2','subtitulo3','retomadaObras','resumoLiberacoesRetomadas')); 
        }else{
            flash()->erro("Erro", "Não existem empreendimentos para esses parâmetros..");            
            return back();
        }//fim if 14 

        } //fim if  1  
        
        

       
    }

    public function dados_empreendimento($numApf){
       
        

          $operacao = ViewOperacoesContratadas::where('txt_apf',$numApf)
                                                ->firstOrFail();

                   $entregas = HistoricoEntregas::selectRaw("operacao_id, 
                                                date_part('YEAR'::text, dte_entrega) AS num_ano_entrega,
                                                sum(qtd_uh_entregues) as total_uh_entregues,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 1 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_jan,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 2 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_fev,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 3 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_mar,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 4 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_abr,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 5 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_mai,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 6 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_jun,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 7 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_jul,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 8 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_ago,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 9 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_set,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 10 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_out,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 11 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_nov,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 12 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_dez")
                                                ->where('operacao_id', $operacao->operacao_id)
                                                ->groupby("operacao_id", "num_ano_entrega")
                                                ->orderby( "num_ano_entrega")
                                                ->get();


       

        $percEntrega = ($operacao->qtd_uh_entregues / $operacao->qtd_uh_contratadas)*100;

        $where = [];
        $where[] = ['txt_num_apf',$numApf];    
        
        $dadosEmpreendimento = [];
       
        $mediaPercProtocolos = 0;

        if(($operacao->modalidade_id == 3) || ($operacao->modalidade_id == 7)){
              $dadosEmpreendimento = DadosOperacaoFar::where('operacao_id',$operacao->operacao_id)->firstOrFail();

        }else if($operacao->modalidade_id == 2){
              $dadosEmpreendimento = DadosOperacaoFds::where('operacao_id',$operacao->operacao_id)->firstOrFail();

        }else if($operacao->modalidade_id == 6){
             $dadosEmpreendimento = DadosOperacaoPnhr::where('operacao_id',$operacao->operacao_id)->firstOrFail();

        }else if($operacao->modalidade_id == 5){
            $txtProtocolo = substr($numApf, 0, 6) .'.' . substr($numApf, 6,2) .'.'. substr($numApf, 8,2) .'/'. substr($numApf, 10,4) .'-'. substr($numApf, 14,2) ;
              $dadosEmpreendimento = ViewDadosResumoOferta::where('txt_protocolo',$txtProtocolo)->first();
             $mediaPercProtocolos =  getMediaPercProtocolo($dadosEmpreendimento->protocolo_id);
           
                
          }else if($operacao->modalidade_id == 1){
                $dadosEmpreendimento = ViewOperacoesContratadas::selectRaw('dsc_origem, origem_id, txt_sigla_uf, ds_municipio, txt_apf, txt_nome_empreendimento, txt_modalidade, txt_sigla_programa, 
                                                                    txt_faixa_programa,txt_apf as txt_cod_operacao, proponente_id, txt_razao_social, txt_endereco, txt_localidade, txt_cep, dte_assinatura,  
                                                                    sum(vlr_operacao_inicial) as total_operacao_inicial, sum(vlr_investimento) as vlr_investimento,sum(vlr_financiamento) as vlr_financiamento,
                                                                    sum(vlr_sub_ogu) as vlr_sub_ogu, sum(vlr_sub_fgts) as vlr_sub_fgts, sum(vlr_liberado) as vlr_liberado,
                                                                    prc_obra_realizado, sum(qtd_unidades_inicial) as num_uh_inicial, sum(qtd_uh_contratadas) as num_uh, sum(qtd_uh_concluidas) as num_uh_concluidas,
                                                                    sum(qtd_uh_entregues) as num_uh_entregues, sum(vlr_operacao) as num_valor, txt_status_empreendimento,
                                                                    bln_vigente')
                                                        ->where('txt_apf',$numApf)  
                                                        ->groupBy('dsc_origem','origem_id','txt_sigla_uf','ds_municipio','txt_apf','txt_nome_empreendimento','txt_modalidade','txt_sigla_programa','txt_faixa_programa',
                                                                    'txt_apf','proponente_id','txt_razao_social','txt_endereco','txt_localidade','txt_cep', 'dte_assinatura',    
                                                                    'prc_obra_realizado','txt_status_empreendimento','bln_vigente')
                                                        ->orderBy('dsc_origem', 'DESC')
                                                        ->get();
        $totalFGTS = ['total_uh' => 0,
                      'total_investimento' => 0,
                      'total_financiamento' => 0,
                      'total_OGU' => 0,
                      'total_FGTS' => 0];

        $dadosEmpreendimentoPF = [];
          foreach($dadosEmpreendimento as $dados){
            if($dados->origem_id != 2){
                $totalFGTS['total_uh'] += $dados->num_uh;
                $totalFGTS['total_investimento'] += $dados->vlr_investimento;
                $totalFGTS['total_financiamento'] += $dados->vlr_financiamento;
                $totalFGTS['total_OGU'] += $dados->vlr_sub_ogu;
                $totalFGTS['total_FGTS'] += $dados->vlr_sub_fgts;

                array_push($dadosEmpreendimentoPF, $dados);
            }
          }            
                                                        
                return view('views_sishab.empreendimentos.dadosEmpreendimentoFGTS',compact('operacao','dadosEmpreendimento', 'dadosEmpreendimentoPF','totalFGTS')); 

        }

//INICIO LIBERAÇÕES ////////////////////
         $resumoLiberacoes = ViewLiberacaoOperacao::selectRaw('count(tipo_liberacao_id) as qtd_liberacoes,txt_tipo_liberacao,tipo_liberacao_id,  sum(vlr_liberacao) as vlr_liberacoes')
                                                ->where($where)
                                                ->groupBy('txt_tipo_liberacao','tipo_liberacao_id')
                                                ->get();

        $totalLiberacoes = ['qtd_liberacoes'=> 0, 'total_liberado'=> 0];
        $countLiberacoes = 0;
        $ultimaLiberacao = '';
       
        if($resumoLiberacoes){
            foreach($resumoLiberacoes as $liberacao){
                $where = [];
                $where[] = ['operacao_id',$operacao->operacao_id];
                $where[] = ['tipo_liberacao_id',$liberacao->tipo_liberacao_id];
                
                if(($liberacao->tipo_liberacao_id == 5) && ($dadosFds->nu_apf_nao_obra)){
                    $where = [];
                    $where[] = ['operacao_id',$dadosFds->nu_apf_nao_obra];
                    $liberacoes = ViewLiberacaoOperacao::where($where)->orderBy('dte_liberacao')->get();
                }else{
                    $liberacoes = ViewLiberacaoOperacao::where($where)->orderBy('dte_liberacao')->get();
                    
                }
                
                
                $resumoLiberacoes[$countLiberacoes]['tipo_liberacoes'] = $liberacoes;

                $totalLiberacoes['qtd_liberacoes'] += $liberacao->qtd_liberacoes;
                $totalLiberacoes['total_liberado'] += $liberacao->vlr_liberacoes;
                
            
                $countLiberacoes++;
            }
        }          
// FIM LIBERAÇÕES ////////////////


//////////////INICIO dados das propostas//////////
$whereProposta[] = ['num_apf', $numApf];
$whereProposta[] = ['bln_contratada', true];

  $proposta = ResumoPropostas::where($whereProposta)->first();
 
 if($proposta){
    $propostaID = $proposta->proposta_id;
    $itensDeclaratorios = ItensDeclaratoriosPropostas::where('proposta_id', $propostaID)->firstOrFail();
    $itensDeclaratorios->load('regimeConstrutivo','tomadorFinanciamento');

    $tipoComunidadeRural = TipoComunidadeRural::where('proposta_id', $propostaID)->get();
    $tipoComunidadeRural->load('tipoComunidadeAtendida');

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
        ->where('num_apf',$numApf)
        ->where('bln_contratada',false)
        ->get();

////////////// FIM PROPOSTAS ///////////////////////////////        


//////////////////////MEDIÇÕES/////////////////////////////////
     $medicaoObras = ViewMedicoesObras::selectRaw(' operacao_id as num_apf_obra,  txt_situacao_solicitacao_medicao,COUNT(dte_solicitacao) AS qtd_solicitacoes, COUNT(dte_liberacao) AS qtd_liberacoes,
                                            MAX(dte_solicitacao) AS dte_ultima_solicitacao, SUM(vlr_solicitado) AS vlr_solicitado, SUM(vlr_liberacao) as vlr_liberado' )
                                        ->groupBy('operacao_id','txt_situacao_solicitacao_medicao')
                                        ->where('operacao_id',$numApf)
                                        ->get();

        $totalMedicaoObras = ['nome_empreendimento' => '', 'sigla_uf' => '','municipio' => '',
                                        'qtd_solicitacoes'=> 0, 'total_solicitado'=> 0,'qtd_liberacoes'=> 0, 'total_liberado'=> 0];
                $count = 0;
                foreach($medicaoObras as $medicao){
                    $totalMedicaoObras['qtd_solicitacoes'] += $medicao->qtd_solicitacoes;
                    $totalMedicaoObras['total_solicitado'] += $medicao->vlr_solicitado;
                    $totalMedicaoObras['qtd_liberacoes'] += $medicao->qtd_liberacoes;
                    $totalMedicaoObras['total_liberado'] += $medicao->vlr_liberado;
                   
                    if(($numApf != '') && ($totalMedicaoObras['nome_empreendimento'] == '')){
                        $totalMedicaoObras['nome_empreendimento'] = $medicao->txt_empreendimento; 
                        $totalMedicaoObras['sigla_uf'] = $medicao->txt_sigla_uf; 
                        $totalMedicaoObras['municipio'] = $medicao->ds_municipio; 
                    }
         
                    $count++;                                                            
                }
        //////////////////////RETOMADAS/////////////////////////////////
           $retomadaObras = ViewRetomadaObras::where('txt_cod_operacao_suplementada',$numApf)->get();        
         // return  $totalMedicaoObras;   


         $whereRetomada = [];      
         if($retomadaObras){
             foreach($retomadaObras as $dados){
                $whereRetomada[] = $dados->txt_cod_operacao_suplementacao;
             }

             $resumoLiberacoesRetomadas = ViewLiberacaoOperacao::selectRaw('txt_num_apf as txt_cod_operacao, count(tipo_liberacao_id) as qtd_liberacoes,txt_tipo_liberacao,tipo_liberacao_id,  sum(vlr_liberacao) as vlr_liberacoes')
                                                        ->whereIn('txt_num_apf',$whereRetomada)
                                                        ->groupBy('txt_num_apf','txt_tipo_liberacao','tipo_liberacao_id')
                                                        ->get();
         }

         if($operacao->modalidade_id == 5){
            $titulo = $dadosEmpreendimento->txt_nome_empreendimento .' - ' . number_format($operacao->prc_obra_realizado, 0, ',' , '.') . '%';
        }elseif($operacao->txt_nome_empreendimento) {            
                $titulo = $operacao->txt_nome_empreendimento .' - ' . number_format($operacao->prc_obra_realizado, 0, ',' , '.') . '%';
        }else{
                $titulo = $operacao->txt_apf .' - ' . number_format($operacao->prc_obra_realizado, 0, ',' , '.') . '%';
        }


        
        
        return view('views_sishab.empreendimentos.dadosEmpreendimento',
                                compact('operacao','dadosEmpreendimento','percEntrega','titulo','resumoLiberacoes','totalLiberacoes','proposta','propostasApresentadas',
                            'tipoComunidadeRural','itensDeclaratorios','naoEnquadramento','naoSelecionado','medicaoObras','totalMedicaoObras','retomadaObras','resumoLiberacoesRetomadas',
                        'entregas','graficoEntrega','mediaPercProtocolos')); 

            

        
    }   
}

    