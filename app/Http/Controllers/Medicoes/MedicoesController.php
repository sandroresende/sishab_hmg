<?php

namespace App\Http\Controllers\Medicoes;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\IndicadoresHabitacionais\Regiao;
use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;
use App\IndicadoresHabitacionais\BrasilComRm;

use App\Tab_dominios\Mes;
use App\Tab_dominios\TipoLiberacao;

use App\Mod_sishab\MedicoesObras\ViewMedicoesObras;

//Usadas para o excel
use App\Exports\ResumoMilagrosoExport;
use App\Exports\RelatorioExecutivoExport;
use App\Exports\BaseRelatorioExecutivoExport;
use App\Exports\EmpreendimentosExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use App\Mod_sishab\MedicoesObras\SituacaoMedicoes;

class MedicoesController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function consultaSituacaoPagMedicoes(){

        return view('views_sishab.medicoes.filtroRelatorioMedicoes');
    }   

    public function dadosSituacaoPagMedicoes(Request $request){

      // return $request->all();
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

       $modalidade = '';
       if($request->modalidade){
           if($request->modalidade == 3){
               $whereSolicitacoes[] = ['txt_modalidade','LIKE', '%FAR%'];    
               $modalidade = "FAR";
           }else{
               $whereSolicitacoes[] = ['modalidade_id', $request->modalidade];    
               if($request->modalidade == 2){                                 
                $modalidade = "ENTIDADES";
               }elseif($request->modalidade == 6){                                 
                $modalidade = "RURAL";
               }
           }
           
         
           
       }
       
       $tipoLiberacao = [];
       if($request->tipoLiberacao){
           $whereSolicitacoes[] = ['tipo_liberacao_id', $request->tipoLiberacao]; 
           $tipoLiberacao = TipoLiberacao::where('id',$request->tipoLiberacao)->firstOrFail();                   
       }

       $mes = [];
       if($request->mesSolicitacao){
          
           
           $pos_espaco = strpos($request->mesSolicitacao, '-');// perceba que há um espaço aqui
         $mesSol = substr($request->mesSolicitacao, 0,$pos_espaco);
         $anoSol = substr($request->mesSolicitacao, $pos_espaco+1, 5);

         $whereSolicitacoes[] = ['num_mes_solicitacao', $mesSol]; 
         $mes = Mes::find($mesSol);           
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

       //return  $posicaoDe; 
       
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

        $solicitacoesPag = ViewMedicoesObras::selectRaw(' operacao_id as num_apf_obra, txt_modalidade, 
                                                           txt_sigla_uf, ds_municipio, txt_empreendimento as txt_nome_empreendimento,COUNT(dte_solicitacao) AS qtd_solicitacoes,
                                                           MAX(dte_solicitacao) AS dte_ultima_solicitacao, SUM(vlr_solicitado) AS vlr_solicitado, SUM(vlr_liberacao) as vlr_liberado, txt_tipo_liberacao_abreviado,
                                                              txt_situacao_solicitacao_medicao as txt_observacao' )
                                           ->groupBy('operacao_id','txt_modalidade','txt_sigla_uf','ds_municipio','txt_empreendimento','txt_tipo_liberacao_abreviado','txt_situacao_solicitacao_medicao')
                                           ->where($whereSolicitacoes)
                                           ->orderBy('txt_sigla_uf')
                                           ->orderBy('ds_municipio')
                                           ->get();

        $dtePosicao = ViewMedicoesObras::where($whereSolicitacoes)->max('dte_movimento');
      
       $cabecalhoTab = ['APF','Modalidade', 'UF','Município','Empreendimento','Quant Solicitacoes','Data Última Solicitação','Valor Total Solicitado','Valor Total Liberado','Tipo de Liberação','Situação'];

       
if(count($solicitacoesPag)>0){
   
   if($request->num_apf){
    $solicitacoesPagObs = ViewMedicoesObras::selectRaw('txt_empreendimento, txt_sigla_uf,ds_municipio, txt_situacao_solicitacao_medicao as txt_observacao, count(operacao_id) as qtd_solicitacoes, 
                                           sum(vlr_solicitado) as total_solicitado,
                                           COUNT(dte_liberacao) AS qtd_liberacoes, 
                                           sum(vlr_liberacao) as total_liberado ')
                          ->groupBy('txt_empreendimento','txt_sigla_uf','ds_municipio','txt_situacao_solicitacao_medicao')
                          ->where($whereSolicitacoes)
                          ->orderBy('txt_situacao_solicitacao_medicao')
                          ->get();
   }else{
       $solicitacoesPagObs = ViewMedicoesObras::selectRaw('txt_situacao_solicitacao_medicao as txt_observacao, count(operacao_id) as qtd_solicitacoes, 
                                           sum(vlr_solicitado) as total_solicitado,
                                           COUNT(dte_liberacao) AS qtd_liberacoes, 
                                           sum(vlr_liberacao) as total_liberado ')
                          ->groupBy('txt_situacao_solicitacao_medicao')
                          ->where($whereSolicitacoes)
                          ->orderBy('txt_situacao_solicitacao_medicao')
                          ->get();
   }                       
   $solicitacoesPagMod = ViewMedicoesObras::selectRaw('txt_modalidade, count(operacao_id) as qtd_solicitacoes, 
                          sum(vlr_solicitado) as total_solicitado,
                          COUNT(dte_liberacao) AS qtd_liberacoes, 
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
           $totalSolicitacaoPagObs['total_solicitado'] += $solicitacao->vlr_solicitado;
           $totalSolicitacaoPagObs['qtd_liberacoes'] += $solicitacao->qtd_liberacoes;
           $totalSolicitacaoPagObs['total_liberado'] += $solicitacao->vlr_liberado;
          
           if(($numApf != '') && ($totalSolicitacaoPagObs['nome_empreendimento'] == '')){
               $totalSolicitacaoPagObs['nome_empreendimento'] = $solicitacao->txt_empreendimento; 
               $totalSolicitacaoPagObs['sigla_uf'] = $solicitacao->txt_sigla_uf; 
               $totalSolicitacaoPagObs['municipio'] = $solicitacao->ds_municipio; 
           }

          // return $totalSolicitacaoPagObs;
           $count++;                                                            
       }
// return  $totalSolicitacoesPagamento;   

$subtitulo1 = '';
$subtitulo2 = '';
$subtitulo3 = '';
        
if($request->num_apf){
    $subtitulo1 = $totalSolicitacaoPagObs['nome_empreendimento'];
    $subtitulo2 = $totalSolicitacaoPagObs['municipio'] .'-'. $totalSolicitacaoPagObs['sigla_uf'];
    $subtitulo3 = 'APF: '. $numApf;
}elseif(!$municipio && !$estado ){
    $subtitulo1 = 'BRASIL';

}
elseif($municipio){
    $subtitulo1 = $municipio->ds_municipio . '-' . $estado->txt_sigla_uf;
}
else{          
    if($estado){
        $subtitulo1 = $estado->txt_uf;
    }
}    

if($request->modalidade){
    $subtitulo2 = $modalidade;
}elseif($request->mesSolicitacao){
    $subtitulo2 = $mes->txt_mes . '/' . $anoSol;
}elseif($request->tipoLiberacao){
    $subtitulo2 = $tipoLiberacao->txt_tipo_liberacao;
}




       return view('views_sishab.medicoes.dadosRelMedicoes',compact('estado','municipio','tipoLiberacao','totalSolicitacaoPagObs',
                                                           'mes','posicaoDe','posicaoAte','solicitacoesPag','solicitacoesPagObs',
                                                           'mesLiberacao','posicaoDeLib','solicitacoesPagMod',
                                                           'posicaoAteLib','dtePosicao','cabecalhoTab',
                                                       'numApf','subtitulo1','subtitulo2','subtitulo3'));
        } else {
            flash()->erro("Erro", "Não existe solicitação para os parâmetros escolhidos.");            
            return back();  
        }
    }
    
}

    