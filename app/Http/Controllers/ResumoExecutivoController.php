<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\BrasilComRm;
use App\ContratacaoMcmv;
use App\DeficitHabitacional;
use App\Municipio;
use App\Uf;
use App\Regiao;
use App\ResumoPropostas;
use App\Selecao;
use App\RelatorioExecutivoResumo;
use App\ResumoOperacoes;
use App\Empreendimentos;
use App\ResumoOperacao;
use App\RelatorioExecutivoAno;
use App\PosicaoArquivoExecutivo;
use App\Posicao;
use App\ExecutivoHistorico;
use App\SelecionadasAno;
use App\ValorMaxUh;
use App\MunicipiosContrataramMcmv;
use App\ItensDeclaratoriosPropostas;
use App\MotivoNaoSelecao;
use App\MotivoNaoEnquadramento;
use App\TipoComunidadeRural;
use App\Propostas;
use App\UltimaPropostaApresentada;
use App\Modalidade;
use App\ArquivosMatriz;
use App\BeneficiariosOperacao;
use App\ResumoLiberacaoOperacao;
use App\RelatorioExecutivoInt;
use App\RelatorioExecutivoAnoInt;
use App\SituacaoObra;
use App\SolicitacaoLiberacao;
use App\SolicitacaoPagamento;

use App\EstimativaPopulacao;
use App\Entregas;
use App\ResumoEntregasUfAno;
use App\ResumoEntregasModalidadeAno;
use App\ResumoEntregas;
use App\Operacao;
use App\StatusEmpreendimento;

//Usadas para o excel
use App\Exports\ResumoMilagrosoExport;
use App\Exports\RelatorioExecutivoExport;
use App\Exports\BaseRelatorioExecutivoExport;
use App\Exports\EmpreendimentosExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class ResumoExecutivoController extends Controller
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

    public function buscaLimiteIbge(Request $request){
        //return $request->all();
        $where = [];
        //$where[] = ['modalidade_id', 3]; 
        $where[] = ['municipio_id', $request->municipio]; 

        //$municipio = [];
        
        $municipio = Municipio::where('id',$request->municipio)->first();
        if ($municipio){            
            $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();         
            $deficit = DeficitHabitacional::where('municipio_id',"=",$request->municipio)->firstOrFail();   
            $brasilComRm = BrasilComRm::where('municipio_id',"=",$request->municipio)->firstOrFail();
            
            $contratacao = RelatorioExecutivoResumo::selectRaw('municipio_id,modalidade_id,txt_modalidade,
                                                                    sum(num_uh) as num_uh_contratadas,sum(num_vlr_total) as vlr_contratacao')
                                                    ->where('municipio_id',"=",$request->municipio)
                                                    ->groupBy('municipio_id','modalidade_id','txt_modalidade')
                                                    ->get();
            //$contratacao = ContratacaoMcmv::where('municipio_id',"=",$request->municipio)->get();
            //$contratacao->load('modalidade');
    
            $num_uh_contratada_urbano = 0;
            $num_uh_contratada_rural = 0;
            
            foreach ($contratacao as $valor) {        
                if($valor->modalidade_id == 6){
                     $num_uh_contratada_rural += $valor->num_uh_contratadas;                
                }else{
                    if(($valor->modalidade_id != 7) & ($valor->modalidade_id != 1) ){
                        $num_uh_contratada_urbano += $valor->num_uh_contratadas;   
                    }
                }       
            }   
            
            $calculoElegibilidade = ($deficit->vlr_deficit_habitacional_urbano/2) - $num_uh_contratada_urbano;    
            if($calculoElegibilidade<=0){
                $elegivel = FALSE;
            }else{
                $elegivel = TRUE;            
            } 
    
             $propostasApresentadas = ResumoPropostas::leftJoin('view_motivos','view_motivos.proposta_id','=','view_resumo_propostas.proposta_id')
            ->selectRaw('view_resumo_propostas.proposta_id, view_resumo_propostas.dte_portaria_resultado, 
                        view_resumo_propostas.txt_nome_empreendimento,
                        view_resumo_propostas.num_selecao,
                        view_resumo_propostas.num_apf,
                        view_resumo_propostas.txt_modalidade,
                        view_resumo_propostas.num_uh,
                        view_resumo_propostas.vlr_investimento,
                        view_resumo_propostas.bln_enquadrada,
                        view_resumo_propostas.bln_selecionada,
                        view_resumo_propostas.bln_contratada,
                        view_resumo_propostas.num_uh_contratadas,
                        view_resumo_propostas.num_ano_selecao,
                        view_resumo_propostas.modalidade_id,
                        view_motivos.txt_tipo_motivo_nao_selecao
                        ')
            ->orderBy('txt_nome_empreendimento', 'asc')
            ->orderBy('num_selecao', 'asc')
            ->where($where)
            ->groupBy('view_resumo_propostas.proposta_id','view_resumo_propostas.dte_portaria_resultado', 
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
                    'view_resumo_propostas.modalidade_id',
                    'view_motivos.txt_tipo_motivo_nao_selecao')
            ->get();
                           
            $num_uh_contratadas_ano = 0;
            $num_uh_selecao_ativa_ano = 0;
            //return date('Y');
            foreach($propostasApresentadas as $apresentadas){        
                
                if(($apresentadas->bln_contratada) && ($apresentadas->num_ano_selecao == date('Y')) && ($apresentadas->modalidade_id == 3) && ($apresentadas->bln_ativo == false)){
                    $num_uh_contratadas_ano += $apresentadas->num_uh_contratadas;
                }
    
                if(($apresentadas->bln_selecionada) && ($apresentadas->num_ano_selecao == date('Y')) && ($apresentadas->modalidade_id == 3) && ($apresentadas->bln_ativo == true)){
                    $num_uh_selecao_ativa_ano += $apresentadas->num_uh;
                }    
            } 
    
            $saldoLimite = $brasilComRm->num_limite_uh - $num_uh_contratadas_ano - $num_uh_selecao_ativa_ano;
            
            //return $propostasApresentadas->municipio_id;
   
    
            
               return view('executivo.dados_municipio',compact('num_uh_contratada_urbano','num_uh_contratada_rural','num_uh_contratadas_ano','num_uh_selecao_ativa_ano',
                                                                'deficit','brasilComRm','contratacao','municipio','estado','elegivel', 'saldoLimite','propostasApresentadas'));       


        } else {
            flash()->erro("Erro", "Código de IBGE inválido.");            
        }
	    return back();       
    }

    public function consultaLimite(){
        $selecoes = Selecao::orderBy('dte_portaria_resultado')->get();
        $selecoes->load("modalidade");
        

        return view('executivo.consultaLimite',compact('selecoes'));
    }

    public function consultaRelExecutivo(){
      
        return view('executivo.consultaRelatorioExecutivo');
    }

    public function filtroRelExecutivoHistorico(){
      
        return view('executivo.consultaRelatorioExecutivoHistorico');
    }
    

    public function consultaEmpreendimento(){

        return view('executivo.consultaEmpreendimentos');
    }

    public function buscarExecutivoHistorico(Request $request){

       // return $request->all();
        $where = [];       
        $whereDe = [];       
        $whereAte = [];       
        
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
            }
        }

        $rm_ride = [];
        
        if($request->rm_ride){
            $where[] = ['txt_rm_ride','LIKE', $request->rm_ride]; 
            $rm_ride = $request->rm_ride;     

        }

        $anoMes = "";
        $anoDe = substr($request->posicao_de, 0, 4);
        $mesDe = substr($request->posicao_de, 5, 2);
        $dataPosicaoDeSelecionada =  $anoDe ."-" . $mesDe ."-01";
        if($request->posicao_de){
            if($request->posicao_de == '2012-06-30'){
                $posicaoDe = PosicaoArquivoExecutivo::where('dte_posicao_arquivo',$request->posicao_de)->firstOrFail();
            }else{
                $posicaoArquivo = PosicaoArquivoExecutivo::where('dte_posicao_arquivo','<',$request->posicao_de)->max('dte_posicao_arquivo');
                $posicaoDe = PosicaoArquivoExecutivo::where('dte_posicao_arquivo',$posicaoArquivo)->firstOrFail();
            }
            $whereDe[] = ['posicao_arquivo_executivo_id', $posicaoDe->id]; 
        }        
        
        if($request->posicao_ate){
            $posicaoAte = PosicaoArquivoExecutivo::where('dte_posicao_arquivo',$request->posicao_ate)->firstOrFail();            
            $whereAte[] = ['posicao_arquivo_executivo_id', $posicaoAte->id]; 
        }

        
         $executivoPosicaoDe = ExecutivoHistorico::selectRaw('posicao_arquivo_executivo_id,txt_modalidade,dsc_faixa,faixa_renda_id, sum(num_uh) as num_uh, sum(num_concluidas) as num_concluidas, 
                                                            sum(num_entregues) as num_entregues, sum(num_vlr_total) as num_vlr_total')
                                                    ->where($where)
                                                    ->where($whereDe)
                                                    ->groupBy('posicao_arquivo_executivo_id','txt_modalidade', 'dsc_faixa','faixa_renda_id')
                                                    ->orderBy('dsc_faixa', 'asc')
                                                    ->orderBy('txt_modalidade', 'asc')
                                                    ->get();
        
                                                                              
          $executivoPosicaoAte = ExecutivoHistorico::selectRaw('posicao_arquivo_executivo_id,txt_modalidade,dsc_faixa,faixa_renda_id, sum(num_uh) as num_uh, sum(num_concluidas) as num_concluidas, 
                                                             sum(num_entregues) as num_entregues, sum(num_vlr_total) as num_vlr_total')
                                                        ->where($where)
                                                        ->where($whereAte)
                                                        ->groupBy('posicao_arquivo_executivo_id','txt_modalidade', 'dsc_faixa','faixa_renda_id')
                                                        ->orderBy('dsc_faixa', 'asc')
                                                        ->orderBy('txt_modalidade', 'asc')
                                                        ->get();
                                                        
 $existeDe15 = false;     
 $existeAte15 = false;  
 foreach($executivoPosicaoDe as $dadosDe){
    if($dadosDe->faixa_renda_id == 4){
        $existeDe15 = true;
    }
 }  

 foreach($executivoPosicaoAte as $dadosAte){
    if($dadosAte->faixa_renda_id == 4){
        $existeAte15 = true;
    }
 } 
        
        $executivoDiferenca = []; 
        $dados = []; 

        $count = 0;
        foreach($executivoPosicaoAte as $dadosAte){
            foreach($executivoPosicaoDe as $dadosDe){
            
            if($dadosAte->txt_modalidade){
                if($dadosAte->faixa_renda_id){
                    if(($dadosAte->txt_modalidade==$dadosDe->txt_modalidade) && ($dadosAte->faixa_renda_id==$dadosDe->faixa_renda_id)){              
                        $dados['txt_modalidade'] =  $dadosAte->txt_modalidade;
                        $dados['faixa_renda_id'] = $dadosAte->faixa_renda_id;
                        $dados['dsc_faixa'] = $dadosAte->dsc_faixa;
                        $dados['num_uh'] =  $dadosAte->num_uh-$dadosDe->num_uh;
                        $dados['num_concluidas'] = $dadosAte->num_concluidas-$dadosDe->num_concluidas;
                        $dados['num_entregues'] = $dadosAte->num_entregues-$dadosDe->num_entregues;
                        $dados['num_vlr_total'] = $dadosAte->num_vlr_total-$dadosDe->num_vlr_total;
                        array_push($executivoDiferenca, $dados);
                        break;
                    }else {
                        
                        if($dadosAte->faixa_renda_id == 4){
                            if((!$existeDe15) && ((!$existeAte15))){
                                $dados['txt_modalidade'] =  'CCFGTS';
                                $dados['faixa_renda_id'] = 4;
                                $dados['dsc_faixa'] = 'Faixa 1,5';
                                $dados['num_uh'] =  0;
                                $dados['num_concluidas'] = 0;
                                $dados['num_entregues'] = 0;
                                $dados['num_vlr_total'] = 0;
                                array_push($executivoPosicaoDe, $dados);
                                break;
                            }else if((!$existeDe15) && (($existeAte15))){               
                                $dados['txt_modalidade'] =  $dadosAte->txt_modalidade;
                                $dados['faixa_renda_id'] = $dadosAte->faixa_renda_id;
                                $dados['dsc_faixa'] = $dadosAte->dsc_faixa;
                                $dados['num_uh'] =  $dadosAte->num_uh-$dadosDe->num_uh;
                                $dados['num_concluidas'] = $dadosAte->num_concluidas;
                                $dados['num_entregues'] = $dadosAte->num_entregues;
                                $dados['num_vlr_total'] = $dadosAte->num_vlr_total;
                                array_push($executivoDiferenca, $dados);
                                break;
                            }   
                        }
                    }      



                }

            }else{     
                if((!$existeDe15)){
                    $dados['txt_modalidade'] =  'CCFGTS';
                    $dados['faixa_renda_id'] = 4;
                    $dados['dsc_faixa'] = 'Faixa 1,5';
                    $dados['num_uh'] =  0;
                    $dados['num_concluidas'] = 0;
                    $dados['num_entregues'] = 0;
                    $dados['num_vlr_total'] = 0;
                    array_push($executivoPosicaoDe, $dados);
                    break;
                }               
                    $dados['txt_modalidade'] =  $dadosAte->txt_modalidade;
                    $dados['faixa_renda_id'] = $dadosAte->faixa_renda_id;
                    $dados['dsc_faixa'] = $dadosAte->dsc_faixa;
                    $dados['num_uh'] =  $dadosAte->num_uh-$dadosDe->num_uh;
                    $dados['num_concluidas'] = $dadosAte->num_concluidas;
                    $dados['num_entregues'] = $dadosAte->num_entregues;
                    $dados['num_vlr_total'] = $dadosAte->num_vlr_total;
                    array_push($executivoDiferenca, $dados);
                    break;
            }
            
            } 
            
            $count++;
        }

        $executivoDiferenca = json_encode($executivoDiferenca); 
        //$executivoDiferenca;
        return view('executivo.dados_executivo_historico',compact('executivoDiferenca','executivoPosicaoDe','executivoPosicaoAte','posicaoDe','posicaoAte','municipio','estado','regiao','rm_ride','dataPosicaoDeSelecionada'));   
    }
    

    public function buscaMilagroso(Request $request){
    
       
        $where = [];
        $whereDeficit = [];
        $whereBetween = [];
return $request->all();
        //Dados para o Excel
        $dadosPropostas = array();
        $dadosPropostas = ['regiao'=> "tudo",'estado'=> "tudo",'municipio'=> "tudo",'rm_ride'=> "tudo", 'ano_de'=>"tudo", 
                            'ano_ate'=>"tudo"];
        //Fim Dados para o Excel

        $regiao = [];
        if($request->regiao){
            session(['regiao' => $request->regiao]); // Para o Excel
            $dadosPropostas['regiao'] = $request->regiao; // Para o Excel
            $where[] = ['regiao_id', $request->regiao];
            $regiao = Regiao::where('id',$request->regiao)->firstOrFail(); 
            $request->session()->flash('regiao_txt' ,$regiao);   
        }
        
        $estado = [];
        if($request->estado){
            session(['estado' => $request->estado]); // Para o Excel
            $dadosPropostas['estado'] = $request->estado; // Para o Excel
            $where[] = ['uf_id', $request->estado]; 
            $estado = Uf::where('id',$request->estado)->firstOrFail();
            $request->session()->flash('estado_txt', $estado); 
        }

        $municipio = [];
        if($request->municipio){
            session(['municipio' => $request->municipio]); // Para o Excel
            $dadosPropostas['municipio'] = $request->municipio; // Para o Excel
            $where[] = ['municipio_id', $request->municipio]; 
            $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
            $request->session()->flash('municipio_txt', $municipio); 
            if(!$request->estado){
                $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
                $request->session()->flash('estado_txt', $estado); 
                $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail(); 
                $request->session()->flash('regiao_txt' ,$regiao);   
            }
        }

        $rm_ride = [];
        
        if($request->rm_ride){    
            session(['rm_ride' => $request->rm_ride]); // Para o Excel
            $dadosPropostas['rm_ride'] = $request->rm_ride; // Para o Excel
            $where[] = ['txt_rm_ride','LIKE', $request->rm_ride]; 
            $rm_ride = $request->rm_ride;   
            $request->session()->flash('rm_ride_txt',  $rm_ride);                  
        }

        $whereDe = [];
        $whereAte = [];
        $ano_de = 0;
        $ano_ate = 0;
        if($request->ano_de){
            session(['ano_de' => $request->ano_de]); // Para o Excel
            $dadosPropostas['ano_de'] = $request->ano_de; // Para o Excel
            $ano_ate = $request->ano_de;
            if($request->ano_ate){
                $whereDe[] = ['num_ano_assinatura', '>=', $request->ano_de];
                 
            }else{
                $whereDe[] = ['num_ano_assinatura', '=', $request->ano_de]; 
                
            }
            
        }

        if($request->ano_ate){
            $ano_ate = $request->ano_ate;
            session(['ano_ate' => $request->ano_ate]); // Para o Excel
            $dadosPropostas['ano_ate'] = $request->ano_ate; // Para o Excel
            $whereAte[] = ['num_ano_assinatura', '<=', $ano_ate]; 
        }
        //return $whereBetween;
        $valoresMCMV = ['uh'=> 0, 'valor'=> 0, 'concluidas'=> 0, 'entregues'=> 0]; 
        $valoresFaixa1 = ['uh'=> 0, 'valor'=> 0, 'concluidas'=> 0, 'entregues'=> 0]; 
        $valoresFaixa2 = ['uh'=> 0, 'valor'=> 0, 'concluidas'=> 0, 'entregues'=> 0]; 
        $valoresFaixa3 = ['uh'=> 0, 'valor'=> 0, 'concluidas'=> 0, 'entregues'=> 0]; 
        $valoresFaixa15 = ['uh'=> 0, 'valor'=> 0, 'concluidas'=> 0, 'entregues'=> 0]; 
        
       // return $relatorioExecutivo = RelatorioExecutivoResumo::get();

       $relatorioExecutivo = RelatorioExecutivoResumo::selectRaw('modalidade_id, txt_modalidade,dsc_faixa,faixa_renda_id, sum(num_uh) as num_uh, sum(num_concluidas) as num_concluidas, 
                                                                    sum(num_entregues) as num_entregues, sum(num_vlr_total) as num_vlr_total')
                                                                    ->where($whereDe)                                                            
                                                                    ->where($whereAte)   
                                                                    ->where($where)
                                                            ->groupBy('modalidade_id','txt_modalidade', 'dsc_faixa','faixa_renda_id')
                                                            ->orderBy('dsc_faixa', 'asc')
                                                            ->orderBy('txt_modalidade', 'asc')
                                                            ->get();
        
        $brasilComRm = [];
        $deficit = [];
        $brasilComRm = BrasilComRm::selectRaw('num_ano_referencia, num_ano_referencia_populacao_estimada,count(municipio_id) as num_municipios,sum(num_total_populacao_2010) as num_total_populacao_2010, sum(num_populacao_estimada) as num_populacao_estimada')
                                    ->where($where)
                                    ->groupBy('num_ano_referencia', 'num_ano_referencia_populacao_estimada')
                                    ->firstOrFail(); 

      
                                    
        
        $deficit = DeficitHabitacional::selectRaw('num_ano_referencia, sum(vlr_deficit_habitacional_total) as vlr_deficit_habitacional_total, 
                                                   sum(vlr_deficit_habitacional_total_relativo) as vlr_deficit_habitacional_total_relativo,
                                                   sum(vlr_deficit_habitacional_urbano) as vlr_deficit_habitacional_urbano,
                                                   sum(vlr_deficit_habitacional_urbano_relativo) as vlr_deficit_habitacional_urbano_relativo,
                                                   sum(vlr_deficit_habitacional_urbano_relativo_ate3_sal) as vlr_deficit_habitacional_urbano_relativo_ate3_sal,
                                                   sum(vlr_deficit_habitacional_urbano_relativo_de3a10_sal) as vlr_deficit_habitacional_urbano_relativo_de3a10_sal,
                                                   sum(vlr_deficit_habitacional_urbano_relativo_ate10_sal) as vlr_deficit_habitacional_urbano_relativo_ate10_sal,
                                                   sum(vlr_deficit_habitacional_urbano_relativo_acima10_sal) as vlr_deficit_habitacional_urbano_relativo_acima10_sal,
                                                   sum(vlr_deficit_habitacional_rural) as vlr_deficit_habitacional_rural,
                                                   sum(vlr_deficit_habitacional_rural_relativo) as vlr_deficit_habitacional_rural_relativo,
                                                   sum(vlr_domicilios_precarios) as vlr_domicilios_precarios,
                                                   sum(vlr_coabitacao_familiar) as vlr_coabitacao_familiar,
                                                   sum(vlr_onus_excessivo_com_aluguel) as vlr_onus_excessivo_com_aluguel,
                                                   sum(vlr_adensamento_excessivo_domicilios_alugados) as vlr_adensamento_excessivo_domicilios_alugados')
                                    ->where($where)
                                    ->groupBy('num_ano_referencia')
                                    ->firstOrFail();

        $relatorioExecutivoAno = RelatorioExecutivoAno::selectRaw('num_ano_assinatura, 
                                                        SUM(total_uh_fgts_15) AS total_uh_fgts_15, SUM(valor_total_fgts_15) AS valor_total_fgts_15,     
                                                        SUM(total_uh_fgts_2) AS total_uh_fgts_2, SUM(valor_total_fgts_2) AS valor_total_fgts_2, 
                                                        SUM(total_uh_fgts_3) AS total_uh_fgts_3, SUM(valor_total_fgts_3) AS valor_total_fgts_3, 
                                                        SUM(total_uh_entidades) AS total_uh_entidades, SUM(valor_total_entidades) AS valor_total_entidades, 
                                                        SUM(total_uh_far) AS total_uh_far, SUM(valor_total_far) AS valor_total_far, 
                                                        SUM(total_uh_oferta) AS total_uh_oferta, SUM(valor_total_oferta) AS valor_total_oferta, SUM(total_uh_rural) AS total_uh_rural, 
                                                        SUM(valor_total_rural) AS valor_total_rural, SUM(total_uh_far_vinc) AS total_uh_far_vinc, SUM(valor_total_far_vinc) AS valor_total_far_vinc,
                                                        SUM(valor_total_num_uh_23) AS valor_total_num_uh_23, SUM(valor_total_23) AS valor_total_23,
                                                        SUM(valor_total_num_uh_1) AS valor_total_num_uh_1, SUM(valor_total_1) AS valor_total_1')
                            ->where($where)
                            ->where($whereDe)                                                            
                            ->where($whereAte)   
                            ->groupBy('num_ano_assinatura')
                            ->orderBy('num_ano_assinatura')
                            ->get();

        $totalAno = RelatorioExecutivoAno::selectRaw('SUM(total_uh_fgts_2) AS total_uh_fgts_2, SUM(valor_total_fgts_2) AS valor_total_fgts_2, 
                                                            SUM(total_uh_fgts_15) AS total_uh_fgts_15, SUM(valor_total_fgts_15) AS valor_total_fgts_15, 
                                                            SUM(total_uh_fgts_3) AS total_uh_fgts_3, SUM(valor_total_fgts_3) AS valor_total_fgts_3, 
                                                            SUM(total_uh_entidades) AS total_uh_entidades, SUM(valor_total_entidades) AS valor_total_entidades, 
                                                            SUM(total_uh_far) AS total_uh_far, SUM(valor_total_far) AS valor_total_far, 
                                                            SUM(total_uh_oferta) AS total_uh_oferta, SUM(valor_total_oferta) AS valor_total_oferta, SUM(total_uh_rural) AS total_uh_rural, 
                                                            SUM(valor_total_rural) AS valor_total_rural, SUM(total_uh_far_vinc) AS total_uh_far_vinc, SUM(valor_total_far_vinc) AS valor_total_far_vinc,
                                                            SUM(valor_total_num_uh_23) AS valor_total_num_uh_23, SUM(valor_total_23) AS valor_total_23,
                                                            SUM(valor_total_num_uh_1) AS valor_total_num_uh_1, SUM(valor_total_1) AS valor_total_1')
                                                    ->where($where)
                                                    ->where($whereDe)                                                            
                                                    ->where($whereAte) 
                                                    ->get();             


        $total_uh = 0;
        $uhTotal_rural =0;
        $uhTotal_urbano =0;
        $uh_rural = 0;
        $uh_urbano = 0;
        foreach($relatorioExecutivo as $dados){  

            if($dados->modalidade_id == 6){
                $uhTotal_rural += $dados->num_uh;
            }else{
                if(($dados->modalidade_id == 2) || ($dados->modalidade_id == 3) || ($dados->modalidade_id == 5)){
                    $uhTotal_urbano += $dados->num_uh;
                }    
            }
            
            if($dados->dsc_faixa == 1){
                $valoresFaixa1['uh'] += $dados->num_uh;
                $valoresFaixa1['valor'] += $dados->num_vlr_total;
                $valoresFaixa1['concluidas'] += $dados->num_concluidas;
                $valoresFaixa1['entregues'] += $dados->num_entregues;
            }elseif($dados->dsc_faixa == 2){
                $valoresFaixa2['uh'] += $dados->num_uh;
                $valoresFaixa2['valor'] += $dados->num_vlr_total;
                $valoresFaixa2['concluidas'] += $dados->num_concluidas;
                $valoresFaixa2['entregues'] += $dados->num_entregues;
            }elseif($dados->dsc_faixa == 3){
                $valoresFaixa3['uh'] += $dados->num_uh;
                $valoresFaixa3['valor'] += $dados->num_vlr_total;
                $valoresFaixa3['concluidas'] += $dados->num_concluidas;
                $valoresFaixa3['entregues'] += $dados->num_entregues;
            }elseif($dados->dsc_faixa == 4){
                $valoresFaixa15['uh'] += $dados->num_uh;
                $valoresFaixa15['valor'] += $dados->num_vlr_total;
                $valoresFaixa15['concluidas'] += $dados->num_concluidas;
                $valoresFaixa15['entregues'] += $dados->num_entregues;
            }
            
                 $valoresMCMV['uh'] += $dados->num_uh;
                 $valoresMCMV['valor'] += $dados->num_vlr_total;
                 $valoresMCMV['concluidas'] += $dados->num_concluidas;
                 $valoresMCMV['entregues'] += $dados->num_entregues;

        }    
        $valoresMCMV = json_encode($valoresMCMV);
        $valoresFaixa1 = json_encode($valoresFaixa1);
        $valoresFaixa2 = json_encode($valoresFaixa2);
        $valoresFaixa3 = json_encode($valoresFaixa3);
        $valoresFaixa15 = json_encode($valoresFaixa15);

        $dataPosicao = Posicao::firstOrFail();

         
        $uh_rural = $uhTotal_rural;
        $uh_urbano = $uhTotal_urbano;

        $calculoElegibilidade = ($deficit->vlr_deficit_habitacional_urbano/2) - $uh_urbano;    
            if($calculoElegibilidade<=0){
                $elegivel = FALSE;
            }else{
                $elegivel = TRUE;            
            }
            
    // DADOS PARA CAIXAS LIMITE //
    if($request->municipio){
        //Valor para as unidades
        $valoresUh = ValorMaxUh::selectRaw('municipio_id, vlr_res_836_faixa_15, vlr_res_836_faixa_2,  
                                           vlr_imovel_faixa_1, vlr_imovel_contrucao_pnhr,
                                           vlr_imovel_reforma_pnhr')
                                            ->where('municipio_id', '=' , $request->municipio)->firstOrFail();
        $brasilComRm2 = BrasilComRm::where('municipio_id',"=",$request->municipio)->firstOrFail();

        $propostasFeitas = ResumoPropostas::selectRaw('view_resumo_propostas.proposta_id,
                                                    view_resumo_propostas.bln_contratada, 
                                                    view_resumo_propostas.num_ano_selecao,
                                                    view_resumo_propostas.num_uh_contratadas,
                                                    view_resumo_propostas.num_uh,
                                                    view_resumo_propostas.modalidade_id,
                                                    view_resumo_propostas.num_apf,
                                                    view_resumo_propostas.txt_nome_empreendimento')
                                                    ->where('municipio_id',"=",$request->municipio)
                                                    ->orderBy('txt_nome_empreendimento', 'asc')
                                                    ->orderBy('num_selecao', 'asc')
                                                    ->get(); 
        

        $num_uh_contratadas_ano = 0;
        $num_uh_selecao_ativa_ano = 0;

        foreach($propostasFeitas as $propostas){       
                
            if(($propostas->bln_contratada) && ($propostas->num_ano_selecao == date('Y')) && ($propostas->modalidade_id == 3) && ($propostas->bln_ativo == false)){
                $num_uh_contratadas_ano += $propostas->num_uh_contratadas;
            }

            if(($propostas->bln_selecionada) && ($propostas->num_ano_selecao == date('Y')) && ($propostas->modalidade_id == 3) && ($propostas->bln_ativo == true)){
                $num_uh_selecao_ativa_ano += $propostas->num_uh;
            } 
        } 
        $saldoLimite = $brasilComRm2->num_limite_uh - $num_uh_contratadas_ano - $num_uh_selecao_ativa_ano;
        
    }
    // FIM DADOS PARA CAIXAS LIMITE //



    // DADOS VALORES CONTRATADOS ANO //

    $whereContratadas[] = ['bln_selecionada',true]; 
    
    //$whereContratadas[] = ['bln_demanda_fechada',false]; 
    if($request->regiao){
        $whereContratadas[] = ['regiao_id',$request->regiao];
        $dadosPropostas2['regiao'] = $request->regiao; // Para o Excel

    }

    if($request->estado){
        $whereContratadas[] = ['uf_id',$request->estado];
        $dadosPropostas2['estado'] = $request->estado; // Para o Excel

    }
 

   if($request->municipio){
        $whereContratadas[] = ['municipio_id', $request->municipio];  
        $dadosPropostas2['municipio'] = $request->municipio; // Para o Excel           

   }

   if($request->modalidade){
        $whereContratadas[] = ['modalidade_id', $request->modalidade]; 
        $dadosPropostas2['modalidade'] = $request->modalidade; // Para o Excel
        
    }

    if($request->ano_selecao){
        $whereContratadas[] = ['num_ano_selecao', $request->ano_selecao];
        $dadosPropostas2['ano'] = $request->ano_selecao; // Para o Excel
        
    }

    if($request->ano_ate){
        $whereContratadas[] = ['num_ano_selecao','<=', $request->ano_ate];
        
        
    }
    //return $whereContratadas;
      $contratadasAno2 = SelecionadasAno::selectRaw('num_ano_selecao,
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
                                                ->where($whereContratadas)
                                                ->orderBy('num_ano_selecao', 'asc')
                                                ->groupBy('num_ano_selecao')
                                                ->get();
    
    $totalAno2 = array();        
    $totalAno2 = ['total_prop_selec_entidade'=> 0,'total_selecionada_entidade'=> 0,'total_contratadas_entidades'=> 0,'total_vlr_contratado_entidades'=> 0,
    'total_prop_selec_far'=> 0,'total_selecionada_far'=> 0,'total_contratadas_far'=> 0,'total_vlr_contratado_far'=> 0,
    'total_prop_selec_rural'=> 0,'total_selecionada_rural'=> 0,'total_contratadas_rural'=> 0,'total_vlr_contratado_rural'=> 0];

    foreach($contratadasAno2 as $ano){
        $totalAno2['total_prop_selec_entidade'] += $ano->total_prop_selec_entidade;
        $totalAno2['total_selecionada_entidade'] += $ano->total_selecionada_entidade;
        $totalAno2['total_contratadas_entidades'] += $ano->total_contratadas_entidades;
        $totalAno2['total_vlr_contratado_entidades'] += $ano->total_vlr_contratado_entidades;
        $totalAno2['total_prop_selec_far'] += $ano->total_prop_selec_far;
        $totalAno2['total_selecionada_far'] += $ano->total_selecionada_far;
        $totalAno2['total_contratadas_far'] += $ano->total_contratadas_far;
        $totalAno2['total_vlr_contratado_far'] += $ano->total_vlr_contratado_far;
        $totalAno2['total_prop_selec_rural'] += $ano->total_prop_selec_rural;
        $totalAno2['total_selecionada_rural'] += $ano->total_selecionada_rural;
        $totalAno2['total_contratadas_rural'] += $ano->total_contratadas_rural;
        $totalAno2['total_vlr_contratado_rural'] += $ano->total_vlr_contratado_rural;
    }                                            
$whereContratadas[] = ['bln_contratada',true]; 
  $propostasContratadas = ResumoPropostas::where($whereContratadas)
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

    //FIM DAS PROPOSTAS
        //SESSIO COM VALORES 
        $request->session()->flash('relatorioExecutivoAno' , $relatorioExecutivoAno);
        $request->session()->flash('relatorioExecutivo' , $relatorioExecutivo);
        $request->session()->flash('dataPosicao', $dataPosicao);
        $request->session()->flash('totalAno', $totalAno);
        $request->session()->flash('totalAno2', $totalAno2);
        $request->session()->flash('contratadasAno2', $contratadasAno2);

        //
        $request->session()->flash('propostasContratadas', $propostasContratadas);
        $request->session()->flash('totalContratadas', $totalContratadas);
        $request->session()->flash('request', $dadosPropostas);

        $ano_de = $request->ano_de;
        $ano_ate = $request->ano_ate;
        $request->session()->reflash();

        $contratacao = RelatorioExecutivoResumo::selectRaw('municipio_id,modalidade_id,txt_modalidade,
                                                                    sum(num_uh) as num_uh_contratadas,sum(num_vlr_total) as vlr_contratacao')
                                                    ->where('municipio_id',"=",$request->municipio)
                                                    ->groupBy('municipio_id','modalidade_id','txt_modalidade')
                                                    ->get();

        return view('executivo.dados_milagroso',compact('relatorioExecutivo','valoresMCMV','valoresFaixa1',
                                                        'valoresFaixa2','valoresFaixa3','valoresFaixa15',
                                                        'municipio','estado','regiao','rm_ride','brasilComRm',
                                                        'deficit','relatorioExecutivoAno','totalAno', 
                                                        'dadosPropostas','dataPosicao','uhTotal_urbano',
                                                        'uhTotal_rural','elegivel','propostasFeitas',
                                                        'num_uh_contratadas_ano','num_uh_selecao_ativa_ano',
                                                        'saldoLimite','brasilComRm2','contratadasAno2','totalAno2',
                                                        'propostasContratadas2','valoresUh','ano_de','ano_ate','contratacao'
                                                        ));   
    }


    public function buscaEmpreendimento(Request $request){
      
        //Dados para o Excel
            $dadosEmpreendimento = array();
             $dadosEmpreendimento = ['regiao'=> "tudo", 'municipio' => 'tudo', 'estado' => 'tudo', 'modalidade' => 'tudo', 'empreendimento' => 'tudo','faixa' => 'tudo'];
        //Fim Dados para o Excel
        
        //return $request->all();
        if((!$request->regiao) && (!$request->estado)){
            flash()->erro("Erro", "Selecione ao menos uma opção de filtro.");  
        } else {
            $where = [];
            $orWhere = [];
            $orWhere[] = ['txt_nome_empreendimento','!=', '']; 
            $orWhere[] = ['cod_operacao','!=', '']; 

            $regiao = [];
            if($request->regiao){
                $where[] = ['regiao_id', $request->regiao]; 
                session(['regiao' => $request->regiao]); // Para o Excel
                $dadosEmpreendimento['regiao'] = $request->regiao; // Para o Excel            
                $regiao = Regiao::where('id',$request->regiao)->firstOrFail();
            }

            $municipio = [];
            if($request->municipio){
                $where[] = ['view_resumo_operacoes.municipio_id', $request->municipio]; 
                session(['municipio' => $request->municipio]); // Para o Excel
                $dadosEmpreendimento['municipio'] = $request->municipio; // Para o Excel
                $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
                $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
            }

            $estado = [];
            if($request->estado){
                $where[] = ['uf_id', $request->estado]; 
                session(['estado' => $request->estado]); // Para o Excel
                $dadosEmpreendimento['estado'] = $request->estado; // Para o Excel
                $estado = Uf::where('id',$request->estado)->firstOrFail();
            }

            $modalidade = [];
            if($request->modalidade){
                $where[] = ['view_resumo_operacoes.modalidade_id', $request->modalidade]; 
                session(['modalidade' => $request->modalidade]); // Para o Excel
                $dadosEmpreendimento['modalidade'] = $request->modalidade; // Para o Excel
            }

            $empreendimento = [];
            
            if($request->empreendimento){
                $where[] = ['cod_operacao','LIKE', $request->empreendimento]; 
                $empreendimento = $request->empreendimento;     
                session(['empreendimento' => $request->empreendimento]); // Para o Excel
                $dadosEmpreendimento['empreendimento'] = $request->empreendimento; // Para o Excel                   
            }
        
          

          $operacoes = ResumoOperacoes::join('tab_municipios','view_resumo_operacoes.municipio_id','=','tab_municipios.id')
                                        ->join('tab_uf','tab_municipios.uf_id','=','tab_uf.id')                                        
                                        ->leftjoin('view_id_ultima_proposta_apresentada','view_resumo_operacoes.cod_operacao','=','view_id_ultima_proposta_apresentada.num_apf')
                                        ->leftjoin('tab_propostas','view_id_ultima_proposta_apresentada.proposta_id','=','tab_propostas.id')
                                        ->leftjoin('tab_selecao','tab_propostas.selecao_id','=','tab_selecao.id')
                                        ->select('view_resumo_operacoes.id',
                                                'tab_uf.regiao_id',
                                                'tab_uf.txt_sigla_uf',
                                                'tab_municipios.ds_municipio',                                                     
                                                'view_resumo_operacoes.cod_operacao as txt_num_apf',
                                                'view_resumo_operacoes.txt_nome_empreendimento',
                                                'view_resumo_operacoes.txt_modalidade',
                                                'tab_selecao.txt_num_portaria_mes_ano',
                                                'view_resumo_operacoes.num_percentual',
                                                'view_resumo_operacoes.num_uh',
                                                'view_resumo_operacoes.num_concluidas',
                                                'view_resumo_operacoes.num_entregues',
                                                'view_resumo_operacoes.num_vlr_total',
                                                'view_resumo_operacoes.num_concluidas',
                                                'view_resumo_operacoes.txt_situacao_obras'                                                
                                                )
                                        ->raw('(CASE WHEN tab_propostas.bln_selecionada = true THEN tab_selecao.txt_num_portaria_mes_ano ELSE NULL END) AS txt_num_portaria_mes_ano')        
                                        ->where($where)
                                        ->orderBy('num_ordenacao','asc')
                                        ->orderBy('tab_uf','asc')
                                        ->orderBy('num_pmcmv','asc')
                                        ->orderBy('txt_nome_empreendimento','asc')
                                    ->get();

               $resumoOperacoes = ResumoOperacoes::join('tab_municipios','view_resumo_operacoes.municipio_id','=','tab_municipios.id')
                                           ->join('tab_uf','tab_uf.id','=','tab_municipios.uf_id')
                                           ->selectRaw('view_resumo_operacoes.txt_modalidade,
                                                        count(view_resumo_operacoes.id) as qtd_empreendimentos,
                                                        SUM(view_resumo_operacoes.num_uh) AS qtd_num_uh,
                                                        SUM(view_resumo_operacoes.num_concluidas) AS qtd_num_concluidas,
                                                        SUM(view_resumo_operacoes.num_entregues) AS qtd_num_entregues,
                                                        SUM(view_resumo_operacoes.num_vlr_total) AS qtd_num_vlr_total
                                                    ')                                               
                                           ->where($where)
                                           ->groupBy('view_resumo_operacoes.txt_modalidade')
                                          
                                           ->orderBy('txt_modalidade','asc')
                                          ->get();  
            $totalResumo = array();        
            $totalResumo = ['total_qtd_empreendimentos'=> 0,'total_qtd_num_uh'=> 0,
                            'total_qtd_num_concluidas'=> 0,'total_qtd_num_entregues'=> 0,'total_qtd_num_vlr_total'=> 0];   
            foreach($resumoOperacoes as $resumo){
                $totalResumo['total_qtd_empreendimentos'] += $resumo->qtd_empreendimentos;
                $totalResumo['total_qtd_num_uh'] += $resumo->qtd_num_uh;
                $totalResumo['total_qtd_num_concluidas'] += $resumo->qtd_num_concluidas;
                $totalResumo['total_qtd_num_entregues'] += $resumo->qtd_num_entregues;
                $totalResumo['total_qtd_num_vlr_total'] += $resumo->qtd_num_vlr_total;
            }                                                                                     
            $count = 0;      
                                                  
            foreach($operacoes as $operacao){
                $operacoes[$count]['num_vlr_total'] = number_format($operacao->num_vlr_total,2,",",".");
                $operacoes[$count]['num_percentual'] = number_format($operacao->num_percentual,2,",",".");
                    

                if($operacao->txt_situacao_obras){
                    if($operacao->num_uh == $operacao->num_entregues){
                        $operacoes[$count]['txt_situacao_obras'] = 'Entregue';
                    }else{
                        if(($operacao->txt_situacao_obras == 'Concluída') && ($operacao->num_percentual<95)){
                            $operacoes[$count]['txt_situacao_obras'] = 'Em Andamento';
                        }else{
                            $operacoes[$count]['txt_situacao_obras'] = $operacao->txt_situacao_obras;
                        }                        
                    }
                    
                    
                }else{    
                    if($operacao->num_uh == $operacao->num_entregues){
                        $operacoes[$count]['txt_situacao_obras'] = 'Entregue';
                    }else if($operacao->num_uh == $operacao->num_concluidas){
                        $operacoes[$count]['txt_situacao_obras'] = 'Concluída';
                    }else{
                        if($operacao->num_percentual == 0){
                            $operacoes[$count]['txt_situacao_obras'] = 'Não Iniciada';
                        }elseif(($operacao->num_percentual >0) && ($operacao->num_percentual < 100)){
                            $operacoes[$count]['txt_situacao_obras'] = 'Em Andamento'; 
                        }else{
                            $operacoes[$count]['txt_situacao_obras'] = 'Em Andamento'; 
                        }
                    } 
                }        
                $count++;              
            }    
            unset($operacoes->bln_selecionada);                                        
            //return $operacoes;                           
            $cabecalhoTab = ['UF','Município', 'APF','Empreendimento','Modalidade','Portaria','%','Contr.','Conc.','Entr.','Valor','Situação'];
            $cabecalhoTab = json_encode($cabecalhoTab);
            //$operacoes = $operacoes->toArray();
            //$operacoes = json_encode($operacoes);

           $dataPosicao = Posicao::firstOrFail();
            

            return view('executivo.emprendimentos',compact('municipio','estado','regiao','modalidade','empreendimento','operacoes','cabecalhoTab',
                                                        'dadosEmpreendimento','resumoOperacoes','totalResumo','dataPosicao'));       
            
        }
                return back();     
    
    }

    public function dados_empreendimento($operacaoId){
       
        
        //return $operacaoId;
         $operacao = ResumoOperacoes::where('id',$operacaoId)
                                ->orderBy('txt_modalidade','asc')
                                ->orderBy('num_pmcmv','asc')
                                ->orderBy('txt_nome_empreendimento','asc')
                                ->firstOrFail();
        
        $resumoLiberacoes = ResumoLiberacaoOperacao::selectRaw('count(tipo_liberacao_id) as qtd_liberacoes,txt_tipo_liberacao,tipo_liberacao_id,  sum(vlr_liberacao) as vlr_liberacoes')
                                                ->where('operacao_id',$operacao->cod_operacao)
                                                ->groupBy('txt_tipo_liberacao','tipo_liberacao_id')
                                                ->get();
        $totalLiberacoes = ['qtd_liberacoes'=> 0, 'total_liberado'=> 0];
        $count = 0;
        foreach($resumoLiberacoes as $liberacao){
            $where = [];
            $where[] = ['operacao_id',$operacao->cod_operacao];
            $where[] = ['tipo_liberacao_id',$liberacao->tipo_liberacao_id];
            //return $where;
            $liberacoes = ResumoLiberacaoOperacao::where($where)->orderBy('dte_liberacao')->get();
            $resumoLiberacoes[$count]['tipo_liberacoes'] = $liberacoes;

            $totalLiberacoes['qtd_liberacoes'] += $liberacao->qtd_liberacoes;
            $totalLiberacoes['total_liberado'] += $liberacao->vlr_liberacoes;
             
            $count++;
        }
        //return  $resumoLiberacoes;
        
        //return  $operacao->cod_operacao;
        $arquivoMatriz = ArquivosMatriz::where('operacao_id',$operacao->cod_operacao)->first();
        
        
        $autenticado = Auth::user();
        $count = 0;
        $dadosBeneficiarios = [];
       
        
        
        $dataPosicao = Posicao::firstOrFail();
        $municipio = Municipio::where('id',$operacao->municipio_id)->firstOrFail();
        $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
            

    //dados das propostas
    $whereProposta[] = ['num_apf', $operacao->cod_operacao];
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
    
    if($operacao){
        return view('executivo.dados_empreendimento',compact('operacao','municipio','estado', 'proposta','itensDeclaratorios',
                                                        'naoEnquadramento','tipoComunidadeRural','naoSelecionado','arquivoMatriz',
                                                        'dadosBeneficiarios','cabecalhoTab','resumoLiberacoes','totalLiberacoes','dataPosicao'));  
    } else {
        flash()->erro("Erro", "Código de IBGE inválido.");            
    }
    return back();  
    } 
    


    //Classe para exportacao para o excel
    public function resumoMilagrosoExport($regiao, $estado, $municipio, $rm_ride, $ano_de, $ano_ate)
    {

        return Excel::download(new ResumoMilagrosoExport($regiao, $estado, $municipio, $rm_ride, $ano_de, $ano_ate), 'Resumo_Milagroso.xlsx');
    }

    public function detalhesContratacao(Request $request){
        
        $regiao = session('regiao_txt');
        $municipio = session('municipio_txt');
        $estado = session('estado_txt');
        $rm_ride = session('rm_ride_txt');
        $dataPosicao = session('dataPosicao');
        $relatorioExecutivoAno = session('relatorioExecutivoAno');
        $relatorioExecutivo = session('relatorioExecutivo');
        $totalAno = session('totalAno');
        $ano_de = session('ano_de');
        $ano_ate = session('ano_ate');

        $request->session()->reflash();
        // $estado, $municipio, $rm_ride, $ano_de, $ano_ate
        return view('executivo.detalhes_contratacao', compact('regiao','municipio','estado','rm_ride',
                                                                'relatorioExecutivoAno','relatorioExecutivo',
                                                                'dataPosicao','totalAno','ano_de','ano_ate'));
    }

    public function detalhesContratacaoInt(Request $request){
        
        $regiao = session('regiao_txt');
        $municipio = session('municipio_txt');
        $estado = session('estado_txt');
        $rm_ride = session('rm_ride_txt');
        $dataPosicao = session('dataPosicao');
        $relatorioExecutivoAno = session('relatorioExecutivoAno');
        $relatorioExecutivo = session('relatorioExecutivo');
        $totalAno = session('totalAno');
        $ano_de = session('ano_de');
        $ano_ate = session('ano_ate');

        $situacoesSelecionadas = session('situacoesSelecionadas');

        $request->session()->reflash();
        // $estado, $municipio, $rm_ride, $ano_de, $ano_ate
        return view('executivo.detalhes_contratacao_int', compact('regiao','municipio','estado','rm_ride',
                                                                'relatorioExecutivoAno','relatorioExecutivo',
                                                                'dataPosicao','totalAno','ano_de','ano_ate','situacoesSelecionadas'));
    }

    public function detalhesPropostas(Request $request){

        
        $regiao = session('regiao_txt');
        $municipio = session('municipio_txt');
        $estado = session('estado_txt');
        $rm_ride = session('rm_ride_txt');
        $contratadasAno2 = session('contratadasAno2');
        $totalAno2 = session('totalAno2');
        $propostasContratadas = session('propostasContratadas');
        $totalContratadas = session('totalContratadas');
        $ano_de = session('ano_de');
        $ano_ate = session('ano_ate');
        $dataPosicao = session('dataPosicao');

        $request->session()->reflash();
        return view('executivo.detalhes_propostas', compact('regiao','municipio','estado','rm_ride',
                                                            'contratadasAno2','totalAno2','propostasContratadas',
                                                            'totalContratadas','ano_de','ano_ate','dataPosicao'));
    }
    


    public function empreendimentosExport($regiao, $estado, $municipio, $modalidade, $empreendimento,$faixa){
        
        return Excel::download(new EmpreendimentosExport($regiao, $estado, $municipio, $modalidade, $empreendimento,$faixa), 'empreendimentos.xlsx');
    }

    public function filtroSitucaoContratacao(){

        return view('executivo.consultaSituacaoContratacao');
    }
    
    public function dadosSitucaoContratacao(Request $request){
        
       // return $request->all();

        $municipio = [];
            if($request->municipio){
                $where[] = ['municipio_id', $request->municipio]; 
                $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
                $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
            }

            $estado = [];
            if($request->estado){
                $where[] = ['uf_id', $request->estado]; 
                $estado = Uf::where('id',$request->estado)->firstOrFail();
            }

            
                if($request->situacao == "1"){
                    $where[] = ['bln_contratou_pmcmv', true]; 
                }elseif($request->situacao == "0"){
                    $where[] = ['bln_contratou_pmcmv', false]; 
                }
                
            

            if(($request->municipio) && ($request->estado)){
                $dadosMunicipio =  MunicipiosContrataramMcmv::where($where)
                                    ->orderBy('ds_municipio', 'asc')
                                    ->firstOrFail();
                if(!$dadosMunicipio->bln_contratou_pmcmv){
                    flash()->info($dadosMunicipio->ds_municipio . "-" . $dadosMunicipio->txt_sigla_uf , "Não houve contratação para este município.");                            
                    return back();  
                }else{
                      return $this->buscaMilagroso($request);    
                }
            }else{
                $valoresUF= ['mun_contratadas'=> 0, 'mun_nao_contratadas'=> 0, 'uh_contratadas'=> 0]; 
                $dadosUF =  MunicipiosContrataramMcmv::where($where)
                                    ->orderBy('bln_contratou_pmcmv', 'asc')
                                    ->orderBy('ds_municipio', 'asc')
                                    ->get();
                foreach($dadosUF as $dados){
                    if($dados->bln_contratou_pmcmv){
                        $valoresUF['mun_contratadas'] += 1;
                        $valoresUF['uh_contratadas'] += $dados->num_uh;
                    }else{
                        $valoresUF['mun_nao_contratadas'] += 1;
                    }
                }
                //return $dadosUF;
                return view('executivo.dadosSituacaoContratacaoUF', compact('estado','dadosUF','valoresUF'));                    
            }        
        
    }

    public function filtrarEmpreendimentoMilagroso(Request $request, $modalidadeID){
       
        /**
          $relatorioExecutivo = session('request');
        
        
        if($relatorioExecutivo['regiao']=='tudo'){
            $regiao = null;
        }else{
            $regiao = $relatorioExecutivo['regiao']; 
        }

        if($relatorioExecutivo['municipio']=='tudo'){
            $municipio = null;
        }else{
            $municipio = $relatorioExecutivo['municipio']; 
        }

        if($relatorioExecutivo['estado']=='tudo'){
            $estado = null;
        }else{
            $estado = $relatorioExecutivo['estado']; 
        }
        if($relatorioExecutivo['rm_ride']=='tudo'){
            $rm_ride = null;
        }else{
            $rm_ride = $relatorioExecutivo['rm_ride']; 
        }
     
        $dadosEmpreendimento = ['regiao'=> $regiao, 
                                'municipio' => $municipio, 
                                'estado' => $estado, 
                                'modalidade' => $modalidadeID,
                                'rm_ride' =>  $rm_ride];
     
*/

            
    $regiao = session('regiao_txt');
    $municipio = session('municipio_txt');
    $estado = session('estado_txt');
    $rm_ride = session('rm_ride_txt');
    $dataPosicao = session('dataPosicao');
    $relatorioExecutivoAno = session('relatorioExecutivoAno');
    $relatorioExecutivo = session('relatorioExecutivo');
    $totalAno = session('totalAno');
    $ano_de = session('ano_de');
    $ano_ate = session('ano_ate');

    $request->session()->reflash();
   
        return $this->buscaEmpreendimento($request);
    }

    public function buscaEmpreendimentoModalidadeMilagro($modalidadeID, $faixaID, $municipioID){
        
        //Dados para o Excel
            $dadosEmpreendimento = array();
            $dadosEmpreendimento = ['regiao'=> "tudo", 'municipio' => 'tudo', 'estado' => 'tudo', 'modalidade' => 'tudo', 'empreendimento' => 'tudo','faixa' => 'tudo'];
        //Fim Dados para o Excel
        //return $dadosEmpreendimento;
        
        
            $where = [];
            $orWhere = [];
            $orWhere[] = ['txt_nome_empreendimento','!=', '']; 
            $orWhere[] = ['cod_operacao','!=', '']; 



            $municipio = [];
            if($municipioID){
                $where[] = ['view_resumo_operacoes.municipio_id', $municipioID]; 
               
                session(['municipio' => $municipioID]); // Para o Excel
                $municipio = Municipio::where('id',$municipioID)->firstOrFail();
                $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
                $dadosEmpreendimento['municipio'] = $municipioID;
                $dadosEmpreendimento['estado'] = $estado->id;
            }

            
            if($faixaID){
                $where[] = ['view_resumo_operacoes.faixa_id', $faixaID];
                $dadosEmpreendimento['faixa'] = $faixaID;
                $faixa = $faixaID;
            } 
           $dadosEmpreendimento;

           // $modalidade = [];
            if($modalidadeID){
                $where[] = ['view_resumo_operacoes.modalidade_id', $modalidadeID]; 
                session(['modalidade' => $modalidadeID]); // Para o Excel
                
                $modalidade = Modalidade::where('id',$modalidadeID)->firstOrFail();
                $dadosEmpreendimento['modalidade'] = $modalidadeID;
            }

 
           
              $operacoes = ResumoOperacoes::join('tab_municipios','view_resumo_operacoes.municipio_id','=','tab_municipios.id')
                                        ->join('tab_uf','tab_municipios.uf_id','=','tab_uf.id')                                        
                                        ->leftjoin('view_id_ultima_proposta_apresentada','view_resumo_operacoes.cod_operacao','=','view_id_ultima_proposta_apresentada.num_apf')
                                        ->leftjoin('tab_propostas','view_id_ultima_proposta_apresentada.proposta_id','=','tab_propostas.id')
                                        ->leftjoin('tab_selecao','tab_propostas.selecao_id','=','tab_selecao.id')
                                        ->select('view_resumo_operacoes.id',
                                                'tab_uf.regiao_id',
                                                'tab_uf.txt_sigla_uf',
                                                'tab_municipios.ds_municipio',                                                     
                                                'view_resumo_operacoes.cod_operacao',
                                                'view_resumo_operacoes.txt_nome_empreendimento',
                                                'view_resumo_operacoes.txt_modalidade',
                                                'tab_selecao.txt_num_portaria_mes_ano',
                                                'view_resumo_operacoes.num_percentual',
                                                'view_resumo_operacoes.num_uh',
                                                'view_resumo_operacoes.num_concluidas',
                                                'view_resumo_operacoes.num_entregues',
                                                'view_resumo_operacoes.num_vlr_total',
                                                'view_resumo_operacoes.num_concluidas'                                                     
                                                )
                                        ->where($where)
                                        ->orderBy('num_ordenacao','asc')
                                        ->orderBy('tab_uf','asc')
                                        ->orderBy('num_pmcmv','asc')
                                        ->orderBy('txt_nome_empreendimento','asc')
                                    ->get();

               $resumoOperacoes = ResumoOperacoes::join('tab_municipios','view_resumo_operacoes.municipio_id','=','tab_municipios.id')
                                           ->join('tab_uf','tab_uf.id','=','tab_municipios.uf_id')
                                           ->selectRaw('view_resumo_operacoes.txt_modalidade,
                                                        count(view_resumo_operacoes.id) as qtd_empreendimentos,
                                                        SUM(view_resumo_operacoes.num_uh) AS qtd_num_uh,
                                                        SUM(view_resumo_operacoes.num_concluidas) AS qtd_num_concluidas,
                                                        SUM(view_resumo_operacoes.num_entregues) AS qtd_num_entregues,
                                                        SUM(view_resumo_operacoes.num_vlr_total) AS qtd_num_vlr_total
                                                    ')                                               
                                           ->where($where)
                                           ->groupBy('view_resumo_operacoes.txt_modalidade')
                                          
                                           ->orderBy('txt_modalidade','asc')
                                          ->get();  
            $totalResumo = array();        
            $totalResumo = ['total_qtd_empreendimentos'=> 0,'total_qtd_num_uh'=> 0,
                            'total_qtd_num_concluidas'=> 0,'total_qtd_num_entregues'=> 0,'total_qtd_num_vlr_total'=> 0];   
            foreach($resumoOperacoes as $resumo){
                $totalResumo['total_qtd_empreendimentos'] += $resumo->qtd_empreendimentos;
                $totalResumo['total_qtd_num_uh'] += $resumo->qtd_num_uh;
                $totalResumo['total_qtd_num_concluidas'] += $resumo->qtd_num_concluidas;
                $totalResumo['total_qtd_num_entregues'] += $resumo->qtd_num_entregues;
                $totalResumo['total_qtd_num_vlr_total'] += $resumo->qtd_num_vlr_total;
            }                                                                                     
            $count = 0;      
                                                  
            foreach($operacoes as $operacao){
                $operacoes[$count]['num_vlr_total'] = number_format($operacao->num_vlr_total,2,",",".");
                $operacoes[$count]['num_percentual'] = number_format($operacao->num_percentual,2,",",".");
                
                if($operacao->txt_situacao_obras){
                    if($operacao->num_uh == $operacao->num_entregues){
                        $operacoes[$count]['txt_situacao_obras'] = 'Entregue';
                    }                   
                }else{    
                    if($operacao->num_uh == $operacao->num_entregues){
                        $operacoes[$count]['txt_situacao_obras'] = 'Entregue';
                    }else if($operacao->num_uh == $operacao->num_concluidas){
                        $operacoes[$count]['txt_situacao_obras'] = 'Concluída';
                    }else{
                        if($operacao->num_percentual == 0){
                            $operacoes[$count]['txt_situacao_obras'] = 'Não Iniciada';
                        }elseif(($operacao->num_percentual >0) && ($operacao->num_percentual < 100)){
                            $operacoes[$count]['txt_situacao_obras'] = 'Em Andamento'; 
                        }else{
                            $operacoes[$count]['txt_situacao_obras'] = 'Em Andamento'; 
                        }
                    } 
                }        
                $count++;              
            }                                            
           // return $operacoes;                           
            $cabecalhoTab = ['UF','Município', 'Cód Operacao','Empreendimento','Modalidade','Portaria - Mes/Ano','%','Contr.','Conc.','Entr.','Valor','Situação'];
            $cabecalhoTab = json_encode($cabecalhoTab);
            //$operacoes = $operacoes->toArray();
            //$operacoes = json_encode($operacoes);

            $dataPosicao = Posicao::firstOrFail();
            

         
            
      
            return view('executivo.emprendimentos',compact('municipio','estado','regiao','modalidade','empreendimento','operacoes','cabecalhoTab',
            'dadosEmpreendimento','resumoOperacoes','totalResumo','modalidade','faixa','dataPosicao'));       
           
   
    }

    public function consultaRelExecutivoInt(){
      
        return view('executivo.consultaRelatorioExecutivoInt');
    }    


  /**  
    public function novoRelatorioExecutivo(Request $request){
        $where = [];
        $whereBetween = [];

        //Dados para o Excel
        $dadosPropostas = array();
        $dadosPropostas = ['regiao'=> "tudo",'estado'=> "tudo",'municipio'=> "tudo",'rm_ride'=> "tudo", 'ano_de'=>"tudo", 
                            'ano_ate'=>"tudo"];
        //Fim Dados para o Excel
        return $request->all();
        $regiao = [];
        if($request->regiao){
            session(['regiao' => $request->regiao]); // Para o Excel
            $dadosPropostas['regiao'] = $request->regiao; // Para o Excel
            $where[] = ['regiao_id', $request->regiao]; 
            $regiao = Regiao::where('id',$request->regiao)->firstOrFail(); 
            $request->session()->flash('regiao_txt' ,$regiao);   
        }
        
        $estado = [];
        if($request->estado){
            session(['estado' => $request->estado]); // Para o Excel
            $dadosPropostas['estado'] = $request->estado; // Para o Excel
            $where[] = ['uf_id', $request->estado]; 
            $estado = Uf::where('id',$request->estado)->firstOrFail();
            $request->session()->flash('estado_txt', $estado); 
        }

        $municipio = [];
        if($request->municipio){
            session(['municipio' => $request->municipio]); // Para o Excel
            $dadosPropostas['municipio'] = $request->municipio; // Para o Excel
            $where[] = ['municipio_id', $request->municipio]; 
            $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
            $request->session()->flash('municipio_txt', $municipio); 
            if(!$request->estado){
                $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
                $request->session()->flash('estado_txt', $estado); 
                $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail(); 
                $request->session()->flash('regiao_txt' ,$regiao);   
            }
        }

        $rm_ride = [];
        
        if($request->rm_ride){    
            session(['rm_ride' => $request->rm_ride]); // Para o Excel
            $dadosPropostas['rm_ride'] = $request->rm_ride; // Para o Excel
            $where[] = ['txt_rm_ride','LIKE', $request->rm_ride]; 
            $rm_ride = $request->rm_ride;   
            $request->session()->flash('rm_ride_txt',  $rm_ride);                  
        }

        $whereDe = [];
        $whereAte = [];
        $ano_de = 0;
        $ano_ate = 0;
        if($request->ano_de){
            session(['ano_de' => $request->ano_de]); // Para o Excel
            $dadosPropostas['ano_de'] = $request->ano_de; // Para o Excel
            $ano_ate = $request->ano_de;
            if($request->ano_ate){
                $whereDe[] = ['ano_assinatura', '>=', $request->ano_de];
                 
            }else{
                $whereDe[] = ['ano_assinatura', '=', $request->ano_de]; 
                
            }
            
        }

        if($request->ano_ate){
            $ano_ate = $request->ano_ate;
            session(['ano_ate' => $request->ano_ate]); // Para o Excel
            $dadosPropostas['ano_ate'] = $request->ano_ate; // Para o Excel
            $whereAte[] = ['ano_assinatura', '<=', $ano_ate]; 
        }

        $whereSituacao = [];
        $situacoesSelecionadas = [];
        session_start();          //php part
           $_SESSION['situacao'] = null;
        if($request->situacaoObra){
           $whereSituacao[] = ['situacao_obras_ifs_id', $request->situacaoObra]; 
           
           
           $_SESSION['situacao']=$request->situacaoObra;//$request->session()->flash('situacao' , $request->situacaoObra);

            session(['situacao_obras_ifs_id' => $request->situacaoObra]); // Para o Excel
           $situacoesSelecionadas = SituacaoObra::whereIn('id', $request->situacaoObra)->get(); 
           $request->session()->flash('situacoesSelecionadas', $situacoesSelecionadas);
            $relatorioExecutivo = RelatorioExecutivoInt::selectRaw('modalidade_id, txt_modalidade, dsc_faixa,faixa_renda_id, 
                                            sum(num_uh) as num_uh, sum(num_uh_andamento) as num_uh_andamento, sum(qtd_uh_concluida) as num_concluidas, 
                                            sum(qtd_uh_obra_fisica_concluida) as num_obra_fisica_concluidas, 
                                            sum(qtd_uh_entregues) as num_entregues, sum(qtd_uh_distratadas) as num_distratadas,
                                            sum(vlr_liberado) as num_vlr_liberado, sum(vlr_operacao) as num_vlr_total')
                                            ->where($whereDe)                                                            
                                            ->where($whereAte)   
                                            ->where($where)
                                            ->whereIn('situacao_obras_ifs_id', $request->situacaoObra)
                                            ->groupBy('modalidade_id','txt_modalidade', 'dsc_faixa','faixa_renda_id')
                                            ->orderBy('dsc_faixa', 'asc')
                                            ->orderBy('txt_modalidade', 'asc')
                                            ->get();   
                                            
            $relatorioExecutivoAno = RelatorioExecutivoAnoInt::selectRaw('ano_assinatura as num_ano_assinatura, 
                                        SUM(total_uh_fgts_15) AS total_uh_fgts_15, SUM(valor_total_fgts_15) AS valor_total_fgts_15,     
                                        SUM(total_uh_fgts_2) AS total_uh_fgts_2, SUM(valor_total_fgts_2) AS valor_total_fgts_2, 
                                        SUM(total_uh_fgts_3) AS total_uh_fgts_3, SUM(valor_total_fgts_3) AS valor_total_fgts_3, 
                                        SUM(total_uh_entidades) AS total_uh_entidades, SUM(valor_total_entidades) AS valor_total_entidades, 
                                        SUM(total_uh_far) AS total_uh_far, SUM(valor_total_far) AS valor_total_far, 
                                        SUM(total_uh_oferta) AS total_uh_oferta, SUM(valor_total_oferta) AS valor_total_oferta, SUM(total_uh_rural) AS total_uh_rural, 
                                        SUM(valor_total_rural) AS valor_total_rural, SUM(total_uh_far_vinc) AS total_uh_far_vinc, SUM(valor_total_far_vinc) AS valor_total_far_vinc,
                                        SUM(valor_total_num_uh_23) AS valor_total_num_uh_23, SUM(valor_total_23) AS valor_total_23,
                                        SUM(valor_total_num_uh_1) AS valor_total_num_uh_1, SUM(valor_total_1) AS valor_total_1')
                                ->where($where)
                                ->where($whereDe)                                                            
                                ->where($whereAte)  
                                ->whereIn('situacao_obras_ifs_id', $request->situacaoObra)
                                ->groupBy('ano_assinatura')
                                ->orderBy('ano_assinatura')
                                ->get();    
                                
           $totalAno = RelatorioExecutivoAnoInt::selectRaw('SUM(total_uh_fgts_2) AS total_uh_fgts_2, SUM(valor_total_fgts_2) AS valor_total_fgts_2, 
                                                            SUM(total_uh_fgts_15) AS total_uh_fgts_15, SUM(valor_total_fgts_15) AS valor_total_fgts_15, 
                                                            SUM(total_uh_fgts_3) AS total_uh_fgts_3, SUM(valor_total_fgts_3) AS valor_total_fgts_3, 
                                                            SUM(total_uh_entidades) AS total_uh_entidades, SUM(valor_total_entidades) AS valor_total_entidades, 
                                                            SUM(total_uh_far) AS total_uh_far, SUM(valor_total_far) AS valor_total_far, 
                                                            SUM(total_uh_oferta) AS total_uh_oferta, SUM(valor_total_oferta) AS valor_total_oferta, SUM(total_uh_rural) AS total_uh_rural, 
                                                            SUM(valor_total_rural) AS valor_total_rural, SUM(total_uh_far_vinc) AS total_uh_far_vinc, SUM(valor_total_far_vinc) AS valor_total_far_vinc,
                                                            SUM(valor_total_num_uh_23) AS valor_total_num_uh_23, SUM(valor_total_23) AS valor_total_23,
                                                            SUM(valor_total_num_uh_1) AS valor_total_num_uh_1, SUM(valor_total_1) AS valor_total_1')
                                                    ->where($where)
                                                    ->where($whereDe)                                                            
                                                    ->where($whereAte) 
                                                    ->whereIn('situacao_obras_ifs_id', $request->situacaoObra)
                                                    ->get();  
        }else{
            $relatorioExecutivo = RelatorioExecutivoInt::selectRaw('modalidade_id, txt_modalidade, dsc_faixa,faixa_renda_id, 
                                            sum(num_uh) as num_uh, sum(num_uh_andamento) as num_uh_andamento, sum(qtd_uh_concluida) as num_concluidas, 
                                            sum(qtd_uh_obra_fisica_concluida) as num_obra_fisica_concluidas, 
                                            sum(qtd_uh_entregues) as num_entregues, sum(qtd_uh_distratadas) as num_distratadas,
                                            sum(vlr_liberado) as num_vlr_liberado, sum(vlr_operacao) as num_vlr_total')
                                            ->where($whereDe)                                                            
                                            ->where($whereAte)   
                                            ->where($where)
                                            ->groupBy('modalidade_id','txt_modalidade', 'dsc_faixa','faixa_renda_id')
                                            ->orderBy('dsc_faixa', 'asc')
                                            ->orderBy('txt_modalidade', 'asc')
                                            ->get();

                                            $relatorioExecutivoAno = RelatorioExecutivoAnoInt::selectRaw('ano_assinatura as num_ano_assinatura, 
                                            SUM(total_uh_fgts_15) AS total_uh_fgts_15, SUM(valor_total_fgts_15) AS valor_total_fgts_15,     
                                            SUM(total_uh_fgts_2) AS total_uh_fgts_2, SUM(valor_total_fgts_2) AS valor_total_fgts_2, 
                                            SUM(total_uh_fgts_3) AS total_uh_fgts_3, SUM(valor_total_fgts_3) AS valor_total_fgts_3, 
                                            SUM(total_uh_entidades) AS total_uh_entidades, SUM(valor_total_entidades) AS valor_total_entidades, 
                                            SUM(total_uh_far) AS total_uh_far, SUM(valor_total_far) AS valor_total_far, 
                                            SUM(total_uh_oferta) AS total_uh_oferta, SUM(valor_total_oferta) AS valor_total_oferta, SUM(total_uh_rural) AS total_uh_rural, 
                                            SUM(valor_total_rural) AS valor_total_rural, SUM(total_uh_far_vinc) AS total_uh_far_vinc, SUM(valor_total_far_vinc) AS valor_total_far_vinc,
                                            SUM(valor_total_num_uh_23) AS valor_total_num_uh_23, SUM(valor_total_23) AS valor_total_23,
                                            SUM(valor_total_num_uh_1) AS valor_total_num_uh_1, SUM(valor_total_1) AS valor_total_1')
                                    ->where($where)
                                    ->where($whereDe)                                                            
                                    ->where($whereAte)  
                                    ->groupBy('ano_assinatura')
                                    ->orderBy('ano_assinatura')
                                    ->get();    
                                    
                $totalAno = RelatorioExecutivoAnoInt::selectRaw('SUM(total_uh_fgts_2) AS total_uh_fgts_2, SUM(valor_total_fgts_2) AS valor_total_fgts_2, 
                                                                SUM(total_uh_fgts_15) AS total_uh_fgts_15, SUM(valor_total_fgts_15) AS valor_total_fgts_15, 
                                                                SUM(total_uh_fgts_3) AS total_uh_fgts_3, SUM(valor_total_fgts_3) AS valor_total_fgts_3, 
                                                                SUM(total_uh_entidades) AS total_uh_entidades, SUM(valor_total_entidades) AS valor_total_entidades, 
                                                                SUM(total_uh_far) AS total_uh_far, SUM(valor_total_far) AS valor_total_far, 
                                                                SUM(total_uh_oferta) AS total_uh_oferta, SUM(valor_total_oferta) AS valor_total_oferta, SUM(total_uh_rural) AS total_uh_rural, 
                                                                SUM(valor_total_rural) AS valor_total_rural, SUM(total_uh_far_vinc) AS total_uh_far_vinc, SUM(valor_total_far_vinc) AS valor_total_far_vinc,
                                                                SUM(valor_total_num_uh_23) AS valor_total_num_uh_23, SUM(valor_total_23) AS valor_total_23,
                                                                SUM(valor_total_num_uh_1) AS valor_total_num_uh_1, SUM(valor_total_1) AS valor_total_1')
                                                        ->where($where)
                                                        ->where($whereDe)                                                            
                                                        ->where($whereAte) 
                                                        ->get();                                              
        }
        //return $whereBetween;
        $valoresMCMV = ['uh'=> 0,'andamento'=> 0, 'valor'=> 0, 'concluidas'=> 0, 'obra_fisica_concluidas'=> 0, 'entregues'=> 0, 'distratadas'=> 0, 'valor_liberado'=> 0]; 
        $valoresFaixa1 = ['uh'=> 0,'andamento'=> 0, 'valor'=> 0, 'concluidas'=> 0, 'obra_fisica_concluidas'=> 0, 'entregues'=> 0, 'distratadas'=> 0, 'valor_liberado'=> 0]; 
        $valoresFaixa2 = ['uh'=> 0,'andamento'=> 0, 'valor'=> 0, 'concluidas'=> 0, 'obra_fisica_concluidas'=> 0, 'entregues'=> 0, 'distratadas'=> 0, 'valor_liberado'=> 0]; 
        $valoresFaixa3 = ['uh'=> 0,'andamento'=> 0, 'valor'=> 0, 'concluidas'=> 0, 'obra_fisica_concluidas'=> 0, 'entregues'=> 0, 'distratadas'=> 0, 'valor_liberado'=> 0]; 
        $valoresFaixa15 = ['uh'=> 0,'andamento'=> 0, 'valor'=> 0, 'concluidas'=> 0, 'obra_fisica_concluidas'=> 0, 'entregues'=> 0, 'distratadas'=> 0, 'valor_liberado'=> 0]; 
        
       // return $relatorioExecutivo = RelatorioExecutivoResumo::get();

      
        $brasilComRm = [];
        $deficit = [];
        $brasilComRm = BrasilComRm::selectRaw('num_ano_referencia, num_ano_referencia_populacao_estimada,
                                    count(municipio_id) as num_municipios,sum(num_total_populacao_2010) as num_total_populacao_2010, 
                                    sum(num_populacao_estimada) as num_populacao_estimada')
                                    ->where($where)
                                    ->groupBy('num_ano_referencia', 'num_ano_referencia_populacao_estimada')
                                    ->firstOrFail(); 
        
                                    
        
 $deficit = DeficitHabitacional::selectRaw('num_ano_referencia, sum(vlr_deficit_habitacional_total) as vlr_deficit_habitacional_total, 
                                        sum(vlr_deficit_habitacional_total_relativo) as vlr_deficit_habitacional_total_relativo,
                                        sum(vlr_deficit_habitacional_urbano) as vlr_deficit_habitacional_urbano,
                                        sum(vlr_deficit_habitacional_urbano_relativo) as vlr_deficit_habitacional_urbano_relativo,
                                        sum(vlr_deficit_habitacional_urbano_relativo_ate3_sal) as vlr_deficit_habitacional_urbano_relativo_ate3_sal,
                                        sum(vlr_deficit_habitacional_urbano_relativo_de3a10_sal) as vlr_deficit_habitacional_urbano_relativo_de3a10_sal,
                                        sum(vlr_deficit_habitacional_urbano_relativo_ate10_sal) as vlr_deficit_habitacional_urbano_relativo_ate10_sal,
                                        sum(vlr_deficit_habitacional_urbano_relativo_acima10_sal) as vlr_deficit_habitacional_urbano_relativo_acima10_sal,
                                        sum(vlr_deficit_habitacional_rural) as vlr_deficit_habitacional_rural,
                                        sum(vlr_deficit_habitacional_rural_relativo) as vlr_deficit_habitacional_rural_relativo,
                                        sum(vlr_domicilios_precarios) as vlr_domicilios_precarios,
                                        sum(vlr_coabitacao_familiar) as vlr_coabitacao_familiar,
                                        sum(vlr_onus_excessivo_com_aluguel) as vlr_onus_excessivo_com_aluguel,
                                        sum(vlr_adensamento_excessivo_domicilios_alugados) as vlr_adensamento_excessivo_domicilios_alugados')
                                        ->where($where)
                                        ->groupBy('num_ano_referencia')
                                        ->firstOrFail();         
            
       $total_uh = 0;
        $uhTotal_rural =0;
        $uhTotal_urbano =0;
        $uh_rural = 0;
        $uh_urbano = 0;
        foreach($relatorioExecutivo as $dados){  

            if($dados->modalidade_id == 6){
                $uhTotal_rural += $dados->num_uh;
            }else{
                if(($dados->modalidade_id == 2) || ($dados->modalidade_id == 3) || ($dados->modalidade_id == 5)){
                    $uhTotal_urbano += $dados->num_uh;
                }    
            }
            
            if($dados->faixa_renda_id == 1){
                $valoresFaixa1['uh'] += empty($dados->num_uh) ? 0 : $dados->num_uh;                
                $valoresFaixa1['valor'] +=  empty($dados->num_vlr_total) ? 0 : $dados->num_vlr_total;
                $valoresFaixa1['concluidas'] +=  empty($dados->num_concluidas) ? 0 : $dados->num_concluidas;
                $valoresFaixa1['entregues'] +=  empty($dados->num_entregues) ? 0 : $dados->num_entregues;
                $valoresFaixa1['obra_fisica_concluidas'] +=  empty($dados->qtd_uh_obra_fisica_concluida) ? 0 : $dados->qtd_uh_obra_fisica_concluida;
                $valoresFaixa1['distratadas'] +=  empty($dados->qtd_uh_distratadas) ? 0 : $dados->qtd_uh_distratadas;
                $valoresFaixa1['valor_liberado'] +=  empty($dados->vlr_liberado) ? 0 : $dados->vlr_liberado;
                $valoresFaixa1['andamento'] +=  empty($dados->num_uh_andamento) ? 0 : $dados->num_uh_andamento;

            }elseif($dados->faixa_renda_id == 2){
                $valoresFaixa2['uh'] += empty($dados->num_uh) ? 0 : $dados->num_uh;                
                $valoresFaixa2['valor'] +=  empty($dados->num_vlr_total) ? 0 : $dados->num_vlr_total;
                $valoresFaixa2['concluidas'] +=  empty($dados->num_concluidas) ? 0 : $dados->num_concluidas;
                $valoresFaixa2['entregues'] +=  empty($dados->num_entregues) ? 0 : $dados->num_entregues;
                $valoresFaixa2['obra_fisica_concluidas'] +=  empty($dados->qtd_uh_obra_fisica_concluida) ? 0 : $dados->qtd_uh_obra_fisica_concluida;
                $valoresFaixa2['distratadas'] +=  empty($dados->qtd_uh_distratadas) ? 0 : $dados->qtd_uh_distratadas;
                $valoresFaixa2['valor_liberado'] +=  empty($dados->vlr_liberado) ? 0 : $dados->vlr_liberado;
                $valoresFaixa2['andamento'] +=  empty($dados->num_uh_andamento) ? 0 : $dados->num_uh_andamento;
            }elseif($dados->faixa_renda_id == 3){
                $valoresFaixa3['uh'] += empty($dados->num_uh) ? 0 : $dados->num_uh;                
                $valoresFaixa3['valor'] +=  empty($dados->num_vlr_total) ? 0 : $dados->num_vlr_total;
                $valoresFaixa3['concluidas'] +=  empty($dados->num_concluidas) ? 0 : $dados->num_concluidas;
                $valoresFaixa3['entregues'] +=  empty($dados->num_entregues) ? 0 : $dados->num_entregues;
                $valoresFaixa3['obra_fisica_concluidas'] +=  empty($dados->qtd_uh_obra_fisica_concluida) ? 0 : $dados->qtd_uh_obra_fisica_concluida;
                $valoresFaixa3['distratadas'] +=  empty($dados->qtd_uh_distratadas) ? 0 : $dados->qtd_uh_distratadas;
                $valoresFaixa3['valor_liberado'] +=  empty($dados->vlr_liberado) ? 0 : $dados->vlr_liberado;
                $valoresFaixa3['andamento'] +=  empty($dados->num_uh_andamento) ? 0 : $dados->num_uh_andamento;
            }elseif($dados->faixa_renda_id == 4){
                $valoresFaixa15['uh'] += empty($dados->num_uh) ? 0 : $dados->num_uh;                
                $valoresFaixa15['valor'] +=  empty($dados->num_vlr_total) ? 0 : $dados->num_vlr_total;
                $valoresFaixa15['concluidas'] +=  empty($dados->num_concluidas) ? 0 : $dados->num_concluidas;
                $valoresFaixa15['entregues'] +=  empty($dados->num_entregues) ? 0 : $dados->num_entregues;
                $valoresFaixa15['obra_fisica_concluidas'] +=  empty($dados->qtd_uh_obra_fisica_concluida) ? 0 : $dados->qtd_uh_obra_fisica_concluida;
                $valoresFaixa15['distratadas'] +=  empty($dados->qtd_uh_distratadas) ? 0 : $dados->qtd_uh_distratadas;
                $valoresFaixa15['valor_liberado'] +=  empty($dados->vlr_liberado) ? 0 : $dados->vlr_liberado;
                $valoresFaixa15['andamento'] +=  empty($dados->num_uh_andamento) ? 0 : $dados->num_uh_andamento;
            }
            
            $valoresMCMV['uh'] += empty($dados->num_uh) ? 0 : $dados->num_uh;                
            $valoresMCMV['valor'] +=  empty($dados->num_vlr_total) ? 0 : $dados->num_vlr_total;
            $valoresMCMV['concluidas'] +=  empty($dados->num_concluidas) ? 0 : $dados->num_concluidas;
            $valoresMCMV['entregues'] +=  empty($dados->num_entregues) ? 0 : $dados->num_entregues;
            $valoresMCMV['obra_fisica_concluidas'] +=  empty($dados->qtd_uh_obra_fisica_concluida) ? 0 : $dados->qtd_uh_obra_fisica_concluida;
            $valoresMCMV['distratadas'] +=  empty($dados->qtd_uh_distratadas) ? 0 : $dados->qtd_uh_distratadas;
            $valoresMCMV['valor_liberado'] +=  empty($dados->vlr_liberado) ? 0 : $dados->vlr_liberado;
            $valoresMCMV['andamento'] +=  empty($dados->num_uh_andamento) ? 0 : $dados->num_uh_andamento;
                 

        }    
        $valoresMCMV = json_encode($valoresMCMV);
        $valoresFaixa1 = json_encode($valoresFaixa1);
        $valoresFaixa2 = json_encode($valoresFaixa2);
        $valoresFaixa3 = json_encode($valoresFaixa3);
        $valoresFaixa15 = json_encode($valoresFaixa15);

        $dataPosicao = ResumoOperacao::selectRaw('txt_modalidade, max(dte_movimento_arquivo) as dte_movimento')->where('modalidade_id','!=',99)
                                      ->groupBy('txt_modalidade')->get();
        
        $request->session()->flash('dataPosicao', $dataPosicao);
         
        $uh_rural = $uhTotal_rural;
        $uh_urbano = $uhTotal_urbano;

        $calculoElegibilidade = ($deficit->vlr_deficit_habitacional_urbano/2) - $uh_urbano;    
            if($calculoElegibilidade<=0){
                $elegivel = FALSE;
            }else{
                $elegivel = TRUE;            
            }
            
    // DADOS PARA CAIXAS LIMITE //
    if($request->municipio){
        //Valor para as unidades
        $valoresUh = ValorMaxUh::selectRaw('municipio_id, vlr_res_836_faixa_15, vlr_res_836_faixa_2,  
                                           vlr_imovel_faixa_1, vlr_imovel_contrucao_pnhr,
                                           vlr_imovel_reforma_pnhr')
                                            ->where('municipio_id', '=' , $request->municipio)->firstOrFail();
        $brasilComRm2 = BrasilComRm::where('municipio_id',"=",$request->municipio)->firstOrFail();

        $propostasFeitas = ResumoPropostas::selectRaw('view_resumo_propostas.proposta_id,
                                                    view_resumo_propostas.bln_contratada, 
                                                    view_resumo_propostas.num_ano_selecao,
                                                    view_resumo_propostas.num_uh_contratadas,
                                                    view_resumo_propostas.num_uh,
                                                    view_resumo_propostas.modalidade_id,
                                                    view_resumo_propostas.num_apf,
                                                    view_resumo_propostas.txt_nome_empreendimento')
                                                    ->where('municipio_id',"=",$request->municipio)
                                                    ->orderBy('txt_nome_empreendimento', 'asc')
                                                    ->orderBy('num_selecao', 'asc')
                                                    ->get(); 
        

        $num_uh_contratadas_ano = 0;
        $num_uh_selecao_ativa_ano = 0;

        foreach($propostasFeitas as $propostas){       
                
            if(($propostas->bln_contratada) && ($propostas->num_ano_selecao == date('Y')) && ($propostas->modalidade_id == 3) && ($propostas->bln_ativo == false)){
                $num_uh_contratadas_ano += $propostas->num_uh_contratadas;
            }

            if(($propostas->bln_selecionada) && ($propostas->num_ano_selecao == date('Y')) && ($propostas->modalidade_id == 3) && ($propostas->bln_ativo == true)){
                $num_uh_selecao_ativa_ano += $propostas->num_uh;
            } 
        } 
        $saldoLimite = $brasilComRm2->num_limite_uh - $num_uh_contratadas_ano - $num_uh_selecao_ativa_ano;
        
    }
    // FIM DADOS PARA CAIXAS LIMITE //



    // DADOS VALORES CONTRATADOS ANO //

    $whereContratadas[] = ['bln_selecionada',true]; 
    $whereContratadas[] = ['bln_contratada',true]; 
    if($request->regiao){
        $whereContratadas[] = ['regiao_id',$request->regiao];
        $dadosPropostas2['regiao'] = $request->regiao; // Para o Excel

    }

    if($request->estado){
        $whereContratadas[] = ['uf_id',$request->estado];
        $dadosPropostas2['estado'] = $request->estado; // Para o Excel

    }
 

   if($request->municipio){
        $whereContratadas[] = ['municipio_id', $request->municipio];  
        $dadosPropostas2['municipio'] = $request->municipio; // Para o Excel           

   }

   if($request->modalidade){
        $whereContratadas[] = ['modalidade_id', $request->modalidade]; 
        $dadosPropostas2['modalidade'] = $request->modalidade; // Para o Excel
        
    }

    if($request->ano_selecao){
        $whereContratadas[] = ['num_ano_selecao', $request->ano_selecao];
        $dadosPropostas2['ano'] = $request->ano_selecao; // Para o Excel
        
    }

    if($request->ano_ate){
        $whereContratadas[] = ['num_ano_selecao','<=', $request->ano_ate];
        
        
    }
    //return $request->all();
    $contratadasAno2 = SelecionadasAno::selectRaw('num_ano_selecao,
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
                                                ->where($whereContratadas)
                                                ->orderBy('num_ano_selecao', 'asc')
                                                ->groupBy('num_ano_selecao')
                                                ->get();
    
    $totalAno2 = array();        
    $totalAno2 = ['total_prop_selec_entidade'=> 0,'total_selecionada_entidade'=> 0,'total_contratadas_entidades'=> 0,'total_vlr_contratado_entidades'=> 0,
    'total_prop_selec_far'=> 0,'total_selecionada_far'=> 0,'total_contratadas_far'=> 0,'total_vlr_contratado_far'=> 0,
    'total_prop_selec_rural'=> 0,'total_selecionada_rural'=> 0,'total_contratadas_rural'=> 0,'total_vlr_contratado_rural'=> 0];

    foreach($contratadasAno2 as $ano){
        $totalAno2['total_prop_selec_entidade'] += $ano->total_prop_selec_entidade;
        $totalAno2['total_selecionada_entidade'] += $ano->total_selecionada_entidade;
        $totalAno2['total_contratadas_entidades'] += $ano->total_contratadas_entidades;
        $totalAno2['total_vlr_contratado_entidades'] += $ano->total_vlr_contratado_entidades;
        $totalAno2['total_prop_selec_far'] += $ano->total_prop_selec_far;
        $totalAno2['total_selecionada_far'] += $ano->total_selecionada_far;
        $totalAno2['total_contratadas_far'] += $ano->total_contratadas_far;
        $totalAno2['total_vlr_contratado_far'] += $ano->total_vlr_contratado_far;
        $totalAno2['total_prop_selec_rural'] += $ano->total_prop_selec_rural;
        $totalAno2['total_selecionada_rural'] += $ano->total_selecionada_rural;
        $totalAno2['total_contratadas_rural'] += $ano->total_contratadas_rural;
        $totalAno2['total_vlr_contratado_rural'] += $ano->total_vlr_contratado_rural;
    }                                            

    $propostasContratadas = ResumoPropostas::where($whereContratadas)
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

    //FIM DAS PROPOSTAS
        //SESSIO COM VALORES 
        $request->session()->flash('relatorioExecutivoAno' , $relatorioExecutivoAno);
        $request->session()->flash('relatorioExecutivo' , $relatorioExecutivo);
        $request->session()->flash('dataPosicao', $dataPosicao);
        $request->session()->flash('totalAno', $totalAno);
        $request->session()->flash('totalAno2', $totalAno2);
        $request->session()->flash('contratadasAno2', $contratadasAno2);
      
      
        //
        $request->session()->flash('propostasContratadas', $propostasContratadas);
        $request->session()->flash('totalContratadas', $totalContratadas);
        $request->session()->flash('request', $dadosPropostas);

        $ano_de = $request->ano_de;
        $ano_ate = $request->ano_ate;
        $request->session()->reflash();

        $contratacao = RelatorioExecutivoResumo::selectRaw('municipio_id,modalidade_id,txt_modalidade,
                                                                    sum(num_uh) as num_uh_contratadas,sum(num_vlr_total) as vlr_contratacao')
                                                    ->where('municipio_id',"=",$request->municipio)
                                                    ->groupBy('municipio_id','modalidade_id','txt_modalidade')
                                                    ->get();
        //return $dadosPropostas;
        $relatorioExecutivo;
       
            return view('executivo.dados_executivo_int',compact('relatorioExecutivo','valoresMCMV','valoresFaixa1',
                                                            'valoresFaixa2','valoresFaixa3','valoresFaixa15',
                                                            'municipio','estado','regiao','rm_ride','brasilComRm',
                                                            'deficit','relatorioExecutivoAno','totalAno', 
                                                            'dadosPropostas','dataPosicao','uhTotal_urbano',
                                                            'uhTotal_rural','elegivel','propostasFeitas',
                                                            'num_uh_contratadas_ano','num_uh_selecao_ativa_ano',
                                                            'saldoLimite','brasilComRm2','contratadasAno2','totalAno2',
                                                            'propostasContratadas2','valoresUh','ano_de','ano_ate','contratacao','situacoesSelecionadas'
                                                            ));    

    }
      */
      
      public function novoRelatorioExecutivo(Request $request){
        // return $request->all();
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
            $where[] = ['municipio_id', $request->municipio]; 
            $whereDeficit[] = ['municipio_id', $request->municipio]; 
            $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
            
            if(!$request->estado){
                $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
                $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();             
            }
        }

        $rm_ride = [];
        
        if($request->rm_ride){    
            $where[] = ['txt_rm_ride','LIKE', $request->rm_ride]; 
            $whereDeficit[] = ['txt_rm_ride','LIKE', $request->rm_ride]; 
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

        $situacaoVigencia = '';
        if($request->bln_vigente){
            $where[] = ['bln_vigente', $request->bln_vigente]; 
            if($request->bln_vigente == true){
                $situacaoVigencia = 'Empreendimentos Vigentes';
            }else{
                $situacaoVigencia = 'Empreendimentos Não Vigentes';
            }
        }

          // return $request->statusEmpreendimento; 
        $whereStatusEmpreendimento = [];
        $situacoesSelecionadas = [];
        
//return $where;
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

           
            $relatorioExecutivo = Operacao::join('tab_municipios','tab_operacoes.municipio_id', '=','tab_municipios.id')
                                    ->join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                    ->join('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id') 
                                    ->join('opc_status_empreendimento','opc_status_empreendimento.id','=','tab_operacoes.status_empreendimento_id')
                                ->join('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
                                ->join('opc_faixa_renda','opc_faixa_renda.id','=','tab_operacoes.faixa_renda_id')
                                ->selectRaw('txt_modalidade,modalidade_id, dsc_faixa, faixa_renda_id, max(dte_movimento_arquivo) as dte_movimento,
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
                                            ->where($whereDe)                                                            
                                            ->where($whereAte)   
                                            ->where($where)
                                            ->whereIn('status_empreendimento_id', $request->statusEmpreendimento)
                                        ->groupBy('txt_modalidade','modalidade_id','dsc_faixa', 'faixa_renda_id')
                                        ->orderBy('dsc_faixa')
                                        ->orderBy('txt_modalidade')
                                        ->get();
            
                $relatorioExecutivoAno = RelatorioExecutivoAnoInt::selectRaw('num_ano_assinatura as num_ano_assinatura, 
                                                SUM(total_uh_fgts_prod) AS total_uh_fgts_prod, SUM(valor_total_fgts_prod) AS valor_total_fgts_prod,     
                                                SUM(total_uh_fgts_15) AS total_uh_fgts_15, SUM(valor_total_fgts_15) AS valor_total_fgts_15,     
                                                SUM(total_uh_fgts_2) AS total_uh_fgts_2, SUM(valor_total_fgts_2) AS valor_total_fgts_2, 
                                                SUM(total_uh_fgts_3) AS total_uh_fgts_3, SUM(valor_total_fgts_3) AS valor_total_fgts_3, 
                                                SUM(total_uh_entidades) AS total_uh_entidades, SUM(valor_total_entidades) AS valor_total_entidades, 
                                                SUM(total_uh_far) AS total_uh_far, SUM(valor_total_far) AS valor_total_far, 
                                                SUM(total_uh_oferta) AS total_uh_oferta, SUM(valor_total_oferta) AS valor_total_oferta, SUM(total_uh_rural) AS total_uh_rural, 
                                                SUM(valor_total_rural) AS valor_total_rural, SUM(total_uh_far_vinc) AS total_uh_far_vinc, SUM(valor_total_far_vinc) AS valor_total_far_vinc,
                                                SUM(valor_total_num_uh_23) AS valor_total_num_uh_23, SUM(valor_total_23) AS valor_total_23,
                                                SUM(valor_total_num_uh_1) AS valor_total_num_uh_1, SUM(valor_total_1) AS valor_total_1')
                                                                    ->where($where)
                                                                ->where($whereDe)                                                            
                                                                ->where($whereAte)
                                                                ->whereIn('status_empreendimento_id', $request->statusEmpreendimento)  
                                                                ->groupBy('num_ano_assinatura')
                                                                ->orderBy('num_ano_assinatura')
                                                                ->get();    
                                
             $totalAno = RelatorioExecutivoAnoInt::selectRaw('SUM(total_uh_fgts_2) AS total_uh_fgts_2, SUM(valor_total_fgts_2) AS valor_total_fgts_2, 
                                                            SUM(total_uh_fgts_prod) AS total_uh_fgts_prod, SUM(valor_total_fgts_prod) AS valor_total_fgts_prod, 
                                                            SUM(total_uh_fgts_15) AS total_uh_fgts_15, SUM(valor_total_fgts_15) AS valor_total_fgts_15, 
                                                            SUM(total_uh_fgts_3) AS total_uh_fgts_3, SUM(valor_total_fgts_3) AS valor_total_fgts_3, 
                                                            SUM(total_uh_entidades) AS total_uh_entidades, SUM(valor_total_entidades) AS valor_total_entidades, 
                                                            SUM(total_uh_far) AS total_uh_far, SUM(valor_total_far) AS valor_total_far, 
                                                            SUM(total_uh_oferta) AS total_uh_oferta, SUM(valor_total_oferta) AS valor_total_oferta, SUM(total_uh_rural) AS total_uh_rural, 
                                                            SUM(valor_total_rural) AS valor_total_rural, SUM(total_uh_far_vinc) AS total_uh_far_vinc, SUM(valor_total_far_vinc) AS valor_total_far_vinc,
                                                            SUM(valor_total_num_uh_23) AS valor_total_num_uh_23, SUM(valor_total_23) AS valor_total_23,
                                                            SUM(valor_total_num_uh_1) AS valor_total_num_uh_1, SUM(valor_total_1) AS valor_total_1')
                                                    ->where($where)
                                                    ->where($whereDe)                                                            
                                                    ->where($whereAte)
                                                    ->whereIn('status_empreendimento_id', $request->statusEmpreendimento) 
                                                    ->get();                                          
        }else{
            $relatorioExecutivo = Operacao::join('tab_municipios','tab_operacoes.municipio_id', '=','tab_municipios.id')
                                ->join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                ->join('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id') 
                                ->join('opc_status_empreendimento','opc_status_empreendimento.id','=','tab_operacoes.status_empreendimento_id')
                                ->join('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
                                ->join('opc_faixa_renda','opc_faixa_renda.id','=','tab_operacoes.faixa_renda_id')
                                ->selectRaw('txt_modalidade,modalidade_id, dsc_faixa, faixa_renda_id, max(dte_movimento_arquivo) as dte_movimento,
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
                                            ->where($whereDe)                                                            
                                            ->where($whereAte)   
                                            ->where($where)
                                        ->groupBy('txt_modalidade','modalidade_id','dsc_faixa', 'faixa_renda_id')
                                        ->orderBy('dsc_faixa', 'txt_modalidade')
                                        ->get();

                $relatorioExecutivoAno = RelatorioExecutivoAnoInt::selectRaw('num_ano_assinatura as num_ano_assinatura, 
                                            SUM(total_uh_fgts_prod) AS total_uh_fgts_prod, SUM(valor_total_fgts_prod) AS valor_total_fgts_prod,     
                                            SUM(total_uh_fgts_15) AS total_uh_fgts_15, SUM(valor_total_fgts_15) AS valor_total_fgts_15,     
                                            SUM(total_uh_fgts_2) AS total_uh_fgts_2, SUM(valor_total_fgts_2) AS valor_total_fgts_2, 
                                            SUM(total_uh_fgts_3) AS total_uh_fgts_3, SUM(valor_total_fgts_3) AS valor_total_fgts_3, 
                                            SUM(total_uh_entidades) AS total_uh_entidades, SUM(valor_total_entidades) AS valor_total_entidades, 
                                            SUM(total_uh_far) AS total_uh_far, SUM(valor_total_far) AS valor_total_far, 
                                            SUM(total_uh_oferta) AS total_uh_oferta, SUM(valor_total_oferta) AS valor_total_oferta, SUM(total_uh_rural) AS total_uh_rural, 
                                            SUM(valor_total_rural) AS valor_total_rural, SUM(total_uh_far_vinc) AS total_uh_far_vinc, SUM(valor_total_far_vinc) AS valor_total_far_vinc,
                                            SUM(valor_total_num_uh_23) AS valor_total_num_uh_23, SUM(valor_total_23) AS valor_total_23,
                                            SUM(valor_total_num_uh_1) AS valor_total_num_uh_1, SUM(valor_total_1) AS valor_total_1')
                                                                ->where($where)
                                                                ->where($whereDe)                                                            
                                                                ->where($whereAte)  
                                                                ->groupBy('num_ano_assinatura')
                                                                ->orderBy('num_ano_assinatura')
                                                                ->get();    
                                    
                $totalAno = RelatorioExecutivoAnoInt::selectRaw('SUM(total_uh_fgts_prod) AS total_uh_fgts_prod, SUM(valor_total_fgts_prod) AS valor_total_fgts_prod, 
                                                                SUM(total_uh_fgts_2) AS total_uh_fgts_2, SUM(valor_total_fgts_2) AS valor_total_fgts_2, 
                                                                SUM(total_uh_fgts_15) AS total_uh_fgts_15, SUM(valor_total_fgts_15) AS valor_total_fgts_15, 
                                                                SUM(total_uh_fgts_3) AS total_uh_fgts_3, SUM(valor_total_fgts_3) AS valor_total_fgts_3, 
                                                                SUM(total_uh_entidades) AS total_uh_entidades, SUM(valor_total_entidades) AS valor_total_entidades, 
                                                                SUM(total_uh_far) AS total_uh_far, SUM(valor_total_far) AS valor_total_far, 
                                                                SUM(total_uh_oferta) AS total_uh_oferta, SUM(valor_total_oferta) AS valor_total_oferta, SUM(total_uh_rural) AS total_uh_rural, 
                                                                SUM(valor_total_rural) AS valor_total_rural, SUM(total_uh_far_vinc) AS total_uh_far_vinc, SUM(valor_total_far_vinc) AS valor_total_far_vinc,
                                                                SUM(valor_total_num_uh_23) AS valor_total_num_uh_23, SUM(valor_total_23) AS valor_total_23,
                                                                SUM(valor_total_num_uh_1) AS valor_total_num_uh_1, SUM(valor_total_1) AS valor_total_1')
                                                        ->where($where)
                                                        ->where($whereDe)                                                            
                                                        ->where($whereAte) 
                                                        ->get();  
        }    

        $deficit = DeficitHabitacional::selectRaw('num_ano_referencia, sum(vlr_deficit_habitacional_total) as vlr_deficit_habitacional_total, 
                                        sum(vlr_deficit_habitacional_total_relativo) as vlr_deficit_habitacional_total_relativo,
                                        sum(vlr_deficit_habitacional_urbano) as vlr_deficit_habitacional_urbano,
                                        sum(vlr_deficit_habitacional_urbano_relativo) as vlr_deficit_habitacional_urbano_relativo,
                                        sum(vlr_deficit_habitacional_urbano_relativo_ate3_sal) as vlr_deficit_habitacional_urbano_relativo_ate3_sal,
                                        sum(vlr_deficit_habitacional_urbano_relativo_de3a10_sal) as vlr_deficit_habitacional_urbano_relativo_de3a10_sal,
                                        sum(vlr_deficit_habitacional_urbano_relativo_ate10_sal) as vlr_deficit_habitacional_urbano_relativo_ate10_sal,
                                        sum(vlr_deficit_habitacional_urbano_relativo_acima10_sal) as vlr_deficit_habitacional_urbano_relativo_acima10_sal,
                                        sum(vlr_deficit_habitacional_rural) as vlr_deficit_habitacional_rural,
                                        sum(vlr_deficit_habitacional_rural_relativo) as vlr_deficit_habitacional_rural_relativo,
                                        sum(vlr_domicilios_precarios) as vlr_domicilios_precarios,
                                        sum(vlr_coabitacao_familiar) as vlr_coabitacao_familiar,
                                        sum(vlr_onus_excessivo_com_aluguel) as vlr_onus_excessivo_com_aluguel,
                                        sum(vlr_adensamento_excessivo_domicilios_alugados) as vlr_adensamento_excessivo_domicilios_alugados')
                                        ->where($whereDeficit)
                                        ->groupBy('num_ano_referencia')
                                        ->firstOrFail();         
            
       $total_uh = 0;
        $uhTotal_rural =0;
        $uhTotal_urbano =0;
        foreach($relatorioExecutivo as $dados){  

            if($dados->modalidade_id == 6){
                
                $uhTotal_rural += $dados->num_uh;
            }else{
              
                if(($dados->modalidade_id == 2) || ($dados->modalidade_id == 3) || ($dados->modalidade_id == 5)){
                    
                    $uhTotal_urbano += $dados->num_uh;
                }    
            }
        }    
        $dataPosicao = Operacao::join('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
                                ->selectRaw('txt_modalidade, max(dte_movimento_arquivo) as dte_movimento')->where('modalidade_id','!=',99)
                                ->groupBy('txt_modalidade')->get();

        return view('executivo.dados_executivo_novo',compact('relatorioExecutivo','dataPosicao', 'municipio','estado','regiao','rm_ride',
                                                        'ano_de','ano_ate','deficit','uhTotal_rural','uhTotal_urbano',
                                                    'totalAno','relatorioExecutivoAno','status','situacaoVigencia'));
      }  
    
    public function relatorioExecutivoExport($regiao, $estado, $municipio, $rm_ride, $ano_de, $ano_ate)
    {
        //$situacao = session('situacao');
        session_start();
        if($_SESSION['situacao']){
            $situacao_obra =  $_SESSION['situacao'];
        }else{
            $situacao_obra =  null;
        }
        session_destroy();
        //return $situacao_obra;
        return Excel::download(new RelatorioExecutivoExport($regiao, $estado, $municipio, $rm_ride, $ano_de, $ano_ate,$situacao_obra), 'Relatorio_executivo_' . date("d_m_Y") .'.xlsx');
    }
    
    public function baseExecutivoExport()
    {
        //return $situacao_obra;
        return Excel::download(new BaseRelatorioExecutivoExport(), 'Base_Relatorio_executivo_' . date("d_m_Y") .'.xlsx');
    }

    
    
    public function filtroEntregas(){

        return view('executivo.consultaEntregas');
    }

    public function quantidadeEntregas(Request $request){
        
        if(($request->estado) || ($request->modalidade) || ($request->faixa) || ($request->ano) ){
            
            $where = []; 
            if($request->estado){
                $where[] = ['uf_id',$request->estado];
            }

            if($request->modalidade){
                $where[] = ['modalidade_id',$request->modalidade];
            }

            if($request->faixa){
                $where[] = ['faixa_renda_id',$request->faixa];
            }

            if($request->ano){
                $where[] = ['num_ano_entrega',$request->ano];
            }
            
            $entregas = ResumoEntregas::where($where)
                                        ->orderBy('txt_sigla_uf')
                                        ->orderBy('txt_modalidade')
                                        ->orderBy('dsc_faixa')
                                        ->get();
            $totalUH = Entregas::where($where)->sum('num_uh_entregue'); 
            
            $totalEntregasAno = ResumoEntregas::selectRaw('Sum(total_uh_entregue_2009) as total_2009, 
                                                            Sum(total_uh_entregue_2010) as total_2010, 
                                                            Sum(total_uh_entregue_2011) as total_2011, 
                                                            Sum(total_uh_entregue_2012) as total_2012, 
                                                            Sum(total_uh_entregue_2013) as total_2013, 
                                                            Sum(total_uh_entregue_2014) as total_2014, 
                                                            Sum(total_uh_entregue_2015) as total_2015, 
                                                            Sum(total_uh_entregue_2016) as total_2016, 
                                                            Sum(total_uh_entregue_2017) as total_2017, 
                                                            Sum(total_uh_entregue_2018) as total_2018, 
                                                            Sum(total_uh_entregue_2019) as total_2019')
                                                            ->where($where)
                                                            ->get();

            $totalEntregas = ResumoEntregas::selectRaw('txt_sigla_uf,txt_modalidade, dsc_faixa, 
                                                        Sum(total_uh_entregue_2009+total_uh_entregue_2010+total_uh_entregue_2011+total_uh_entregue_2012+total_uh_entregue_2013+total_uh_entregue_2014+total_uh_entregue_2015+total_uh_entregue_2016+total_uh_entregue_2017+total_uh_entregue_2018+total_uh_entregue_2019) as total_uh')
                                                            ->groupBy('txt_sigla_uf','txt_modalidade', 'dsc_faixa')
                                                            ->orderBy('txt_sigla_uf')
                                                            ->orderBy('txt_modalidade')
                                                            ->orderBy('dsc_faixa')
                                                            ->get(); 

            if($totalUH>0){                                                
                return view('executivo.dadosEntregas',compact('entregas','totalEntregasAno','totalUH','totalEntregas'));
            }else{
                flash()->erro("Erro", "Não houve entregas para os parâmetros selecionados");            
                return back();                              
            }
            
            
        }else{
             
             $entregasModalidade = ResumoEntregasModalidadeAno::get();
             $totalEntregasModalidade = ResumoEntregasModalidadeAno::selectRaw('txt_modalidade, Sum(total_uh_entregue_2009+total_uh_entregue_2010+total_uh_entregue_2011+total_uh_entregue_2012+total_uh_entregue_2013+total_uh_entregue_2014+total_uh_entregue_2015+total_uh_entregue_2016+total_uh_entregue_2017+total_uh_entregue_2018+total_uh_entregue_2019) as total_modalidade')
                            ->groupBy('txt_modalidade')->orderBy('txt_modalidade')->get();     
             
            
            $entregas = ResumoEntregasUfAno::get();
            $totalEntregasAno = ResumoEntregasUfAno::selectRaw('Sum(total_uh_entregue_2009) as total_2009, 
                                                                Sum(total_uh_entregue_2010) as total_2010, 
                                                                Sum(total_uh_entregue_2011) as total_2011, 
                                                                Sum(total_uh_entregue_2012) as total_2012, 
                                                                Sum(total_uh_entregue_2013) as total_2013, 
                                                                Sum(total_uh_entregue_2014) as total_2014, 
                                                                Sum(total_uh_entregue_2015) as total_2015, 
                                                                Sum(total_uh_entregue_2016) as total_2016, 
                                                                Sum(total_uh_entregue_2017) as total_2017, 
                                                                Sum(total_uh_entregue_2018) as total_2018, 
                                                                Sum(total_uh_entregue_2019) as total_2019')
                                                    ->get();
           $totalEntregasUF = ResumoEntregasUfAno::selectRaw('txt_sigla_uf, Sum(total_uh_entregue_2009+total_uh_entregue_2010+total_uh_entregue_2011+total_uh_entregue_2012+total_uh_entregue_2013+total_uh_entregue_2014+total_uh_entregue_2015+total_uh_entregue_2016+total_uh_entregue_2017+total_uh_entregue_2018+total_uh_entregue_2019) as total_uh')
                                        ->groupBy('txt_sigla_uf')->orderBy('txt_sigla_uf')->get();                                                    
            $totalUF =  $totalEntregasUF->sum('total_uh');
            return view('executivo.dadosEntregasBrasil',compact('entregas','totalEntregasAno','totalEntregasUF','totalUF','entregasModalidade',
                                                            'totalEntregasModalidade'));
        }
        
        
    }

    public function consultaSituacaoPagamento(){

        return view('financeiro.consultaExternaSituacaoPagamento');
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

         $solicitacoesPag = SolicitacaoPagamento::selectRaw(' operacao_id as num_apf_obra, txt_modalidade, 
                                                            txt_sigla_uf, ds_municipio, txt_empreendimento as txt_nome_empreendimento,COUNT(dte_solicitacao) AS qtd_solicitacoes,
                                                            MAX(dte_solicitacao) AS dte_ultima_solicitacao, SUM(vlr_solicitado) AS vlr_solicitado, SUM(vlr_liberacao) as vlr_liberado, txt_tipo_liberacao_abreviado,
                                                               txt_situacao_solicitacao_medicao as txt_observacao' )
                                            ->groupBy('operacao_id','txt_modalidade','txt_sigla_uf','ds_municipio','txt_empreendimento','txt_tipo_liberacao_abreviado','txt_situacao_solicitacao_medicao')
                                            ->where($whereSolicitacoes)
                                            ->orderBy('txt_sigla_uf')
                                            ->orderBy('ds_municipio')
                                            ->get();

         $dtePosicao = SolicitacaoPagamento::where($whereSolicitacoes)->max('dte_movimento');
       
        $cabecalhoTab = ['APF','Modalidade', 'UF','Município','Empreendimento','Quant Solicitacoes','Data Última Solicitação','Valor Total Solicitado','Valor Total Liberado','Tipo de Liberação','Situação'];

        
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
        return view('financeiro.situacaoPagamentoExterno',compact('estado','municipio','tipoLiberacao','totalSolicitacaoPagObs',
                                                            'mes','posicaoDe','posicaoAte','solicitacoesPag','solicitacoesPagObs',
                                                            'mesLiberacao','posicaoDeLib','solicitacoesPagMod',
                                                            'posicaoAteLib','dtePosicao','cabecalhoTab',
                                                        'numApf'));
    } else {
        flash()->erro("Erro", "Não existe solicitação para os parâmetros escolhidos.");            
        return back();  
    }
    


}

}

    