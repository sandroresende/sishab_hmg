<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Regiao;
use App\Uf;
use App\Municipio;

use App\OperacoesContratadas;
use App\Operacao;
use App\MedicoesCaixa;

use App\ResumoEntregasLiberacoes;

use App\Modalidade;

use App\FaixaRenda;

class BriefingController extends Controller
{
    public function consultaBriefingNovo (){

        return view('briefing.consultaBriefingNovo');
    }

    public function briefingNovo (Request $request){
        
        session_start();          //php part
        $_SESSION['municipio'] = $request->municipio;

        if($request->pergunta == 1){
            return redirect('briefing/novo/pergunta1')->with('where'); 
        }else if($request->pergunta == 2){
            return redirect('briefing/novo/pergunta2')->with('where'); 
        }else if($request->pergunta == 3){
            return redirect('briefing/novo/pergunta3')->with('where'); 
        }else if($request->pergunta == 4){
            return redirect('briefing/novo/pergunta4')->with('where'); 
        }else if($request->pergunta == 5){
            return redirect('briefing/novo/pergunta5')->with('where'); 
        }else if($request->pergunta == 6){
            return redirect('briefing/novo/pergunta6')->with('where'); 
        }else if($request->pergunta == 9){
            return redirect('briefing/novo/pergunta9')->with('where'); 
        }else if($request->pergunta == 10){
            return redirect('briefing/novo/pergunta10')->with('where'); 
        }else if($request->pergunta == 0){
            return redirect('briefing/novo/tabela')->with('where'); 
        }
    }

   public function briefingNovoPergunta1 (Request $request){
    
    session_start();
    $municipioID = $_SESSION['municipio'];
    

    $municipio = Municipio::where('id',$municipioID)->firstOrFail();
    $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
    $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();  

    $where = [];
    
    $where[] = ['uf_id', $estado->id]; 
    $where[] = ['bln_vigente', true]; 
    $where[] = ['faixa_renda_id','!=', 1]; 
   
    
     $qtd_municipios_fgts = OperacoesContratadas::selectRaw('COUNT(DISTINCT operacao_id) AS qtd_contratos, COUNT(DISTINCT municipio_id) AS qtd_municipios')
                                                    ->where($where)
                                                    ->first();


        
    $resumoVigentes = OperacoesContratadas::selectRaw('dsc_faixa,
                                                count(DISTINCT municipio_id) AS qtd_municipios,
                                                count(DISTINCT operacao_id) AS qtd_contratos,
                                                sum(qtd_uh_vigentes) as qtd_uh_vigentes,
                                                sum(vlr_sub_ogu) as vlr_sub_ogu,
                                                sum(vlr_sub_fgts) as vlr_sub_fgts,
                                                sum(vlr_operacao-vlr_sub_ogu-vlr_sub_fgts) AS vlr_financiamento,
                                                sum(vlr_operacao) AS vlr_contratado
                                                ')
                                        ->where($where)
                                        ->groupBy('dsc_faixa')
                                        ->orderBy('dsc_faixa', 'asc')        
                                        ->get(); 
    //final if            

    $valoresFgts = ['municipios'=>  $qtd_municipios_fgts->qtd_municipios, 
                    'contratos'=> $qtd_municipios_fgts->qtd_contratos, 
                    'vigentes'=> 0, 
                    'vlr_ogu'=> 0, 
                    'vlr_fgts'=> 0,
                    'financiamento'=> 0,
                    'valor_contratado'=> 0];
    
    $cont = 0;                
    foreach($resumoVigentes as $dados){  
            $valoresFgts['vigentes'] += empty($dados->qtd_uh_vigentes) ? 0 : $dados->qtd_uh_vigentes;     
            $valoresFgts['vlr_ogu'] += empty($dados->vlr_sub_ogu) ? 0 : $dados->vlr_sub_ogu;    
            $valoresFgts['vlr_fgts'] += empty($dados->vlr_sub_fgts) ? 0 : $dados->vlr_sub_fgts;    
            $valoresFgts['financiamento'] += empty($dados->vlr_financiamento) ? 0 : $dados->vlr_financiamento;    
            $valoresFgts['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;  

            $cont += 1;
        }    

        //return $valoresFgts;
       


    if($cont > 0){  
        //return $resumoVigentes;
        return view('briefing.dadosBriefingNovoPerg1', compact('resumoVigentes','valoresFgts',
                                                                'qtd_municipios_fgts', 
                                                                'municipio','estado','regiao'));
    }else {
        flash()->erro("Erro", "Não houve contratos para os parâmetros selecionados");             
    }
        return back();                                                                 
   }

   public function briefingNovoPergunta2 (Request $request){
    
    session_start();
    $municipioID = $_SESSION['municipio'];
    

    $municipio = Municipio::where('id',$municipioID)->firstOrFail();
    $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
    $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();  

    $where = [];
    
    $where[] = ['uf_id', $estado->id]; 
    $where[] = ['bln_vigente', true]; 
    $where[] = ['faixa_renda_id', 1]; 
    $where[] = ['modalidade_id','!=', 5]; 
   
    
     $qtd_municipios_fx1 = OperacoesContratadas::selectRaw('COUNT(DISTINCT operacao_id) AS qtd_contratos, COUNT(DISTINCT municipio_id) AS qtd_municipios')
                                                    ->where($where)
                                                    ->first();


        
    $resumoVigentes = OperacoesContratadas::selectRaw('txt_status_empreendimento,
                                                sum(qtd_uh_vigentes) as qtd_uh_vigentes,
                                                count(DISTINCT operacao_id) AS qtd_contratos,
                                                sum((vlr_operacao/qtd_uh_contratadas)*qtd_uh_vigentes) AS vlr_contratado,
                                                count(DISTINCT municipio_id) AS qtd_municipios')  
                                            ->where($where)
                                            ->groupBy('txt_status_empreendimento')
                                            ->orderBy('txt_status_empreendimento', 'asc')        
                                            ->get(); 
    //final if            

    $valoresFaixa1 = ['vigentes'=> 0, 'contratos'=> $qtd_municipios_fx1->qtd_contratos,  'valor_contratado'=> 0, 'municipios' => $qtd_municipios_fx1->qtd_municipios]; 
    $cont = 0;
    foreach($resumoVigentes as $dados){  
        $valoresFaixa1['vigentes'] += empty($dados->qtd_uh_vigentes) ? 0 : $dados->qtd_uh_vigentes;     
        $valoresFaixa1['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;  
        $cont += 1;
        }    

        //return $valoresFgts;
       


        
        return view('briefing.dadosBriefingNovoPerg2', compact('resumoVigentes','valoresFaixa1',
                                                                'qtd_municipios_fx1', 
                                                                'municipio','estado','regiao'));

        if($cont > 0){  
            //return $resumoVigentes;
            return view('briefing.dadosBriefingNovoPerg2', compact('resumoVigentes','valoresFaixa1',
                                                                    'qtd_municipios_fx1', 
                                                                    'municipio','estado','regiao'));

        }else {
            flash()->erro("Erro", "Não houve contratos para os parâmetros selecionados");             
        }
            return back();                                                                 
                                                                        
   }

   public function briefingNovoPergunta3 (Request $request){
    
    session_start();
    $municipioID = $_SESSION['municipio'];
    
 
    $municipio = Municipio::where('id',$municipioID)->firstOrFail();
    $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
    $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();  

    $where = [];
    
    $where[] = ['uf_id', $estado->id]; 
    $where[] = ['bln_vigente', true]; 
    $where[] = ['modalidade_id', 1]; 
    //$where[] = ['status_empreendimento_id', 2]; 
   // $where[] = ['status_empreendimento_id', 10]; 
    $where[] = ['vlr_liberado_2019','>',0]; 

    $qtd_municipios_fgts = OperacoesContratadas::selectRaw('COUNT(DISTINCT operacao_id) AS qtd_contratos, COUNT(DISTINCT municipio_id) AS qtd_municipios')
                                                ->where($where)
                                                ->whereIn('status_empreendimento_id', [2,10])
                                                ->first();

 $resumoLiberacoes =  OperacoesContratadas::selectRaw('dsc_faixa,
                                        count(DISTINCT municipio_id) AS qtd_municipios,
                                        sum(qtd_uh_contratadas) AS qtd_uh_contratadas,
                                        count(DISTINCT operacao_id) AS qtd_contratos,
                                        sum(vlr_liberado_2019) as vlr_liberado_2019,
                                        sum(vlr_operacao) as vlr_operacao
                                        ')
                                    ->where($where)
                                    ->whereIn('status_empreendimento_id', [2,10])
                                    ->groupBy('dsc_faixa')
                                    ->orderBy('dsc_faixa', 'asc')        
                                    ->get(); 

$valoresFgts = ['municipio'=> $qtd_municipios_fgts->qtd_municipios, 'uh_contratadas'=> 0, 'contratos'=>$qtd_municipios_fgts->qtd_contratos,  'valor_liberado'=> 0, 'valor_contratado' => 0]; 
$cont = 0;
foreach($resumoLiberacoes as $dados){  
    //$valoresFgts['municipio'] += empty($dados->qtd_municipios) ? 0 : $dados->qtd_municipios;     
    $valoresFgts['uh_contratadas'] += empty($dados->qtd_uh_contratadas) ? 0 : $dados->qtd_uh_contratadas;     
    //$valoresFgts['contratos'] += empty($dados->qtd_contratos) ? 0 : $dados->qtd_contratos;     
    $valoresFgts['valor_liberado'] += empty($dados->vlr_liberado_2019) ? 0 : $dados->vlr_liberado_2019;     
    $valoresFgts['valor_contratado'] += empty($dados->vlr_operacao) ? 0 : $dados->vlr_operacao;     
    $cont += 1;
    }    
    
    //return $valoresFgts;

    if($cont > 0){  
        //return $resumoVigentes;
        return view('briefing.dadosBriefingNovoPerg3', compact('resumoLiberacoes','valoresFgts',
                                                                'municipio','estado','regiao'));

    }else {
        flash()->erro("Erro", "Não houve contratos para os parâmetros selecionados");             
    }
        return back(); 
   }
   
   
   public function briefingNovoPergunta4 (Request $request){
    
    session_start();
    $municipioID = $_SESSION['municipio'];
    
    

    $municipio = Municipio::where('id',$municipioID)->firstOrFail();
    $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
    $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();  

    $where = [];
    
    $where[] = ['uf_id', $estado->id]; 
    $where[] = ['bln_vigente', true]; 
    $where[] = ['faixa_renda_id', 1]; 
    //$where[] = ['status_empreendimento_id', 2]; 
   // $where[] = ['status_empreendimento_id', 10]; 
    $where[] = ['vlr_liberado_2019','>',0]; 

$resumoLiberacoes =  OperacoesContratadas::selectRaw('dsc_faixa,
                                        count(DISTINCT municipio_id) AS qtd_municipios,
                                        sum(qtd_uh_contratadas) AS qtd_uh_contratadas,
                                        count(DISTINCT operacao_id) AS qtd_contratos,
                                        sum(vlr_liberado_2019) as vlr_liberado_2019,
                                        sum(vlr_operacao) as vlr_operacao
                                        ')
                                    ->where($where)
                                    ->whereIn('status_empreendimento_id', [2,10])
                                    ->groupBy('dsc_faixa')
                                    ->orderBy('dsc_faixa', 'asc')        
                                    ->get(); 








    if($resumoLiberacoes->count() > 0){  
        //return $resumoVigentes;
        return view('briefing.dadosBriefingNovoPerg4', compact('resumoLiberacoes','municipio','estado','regiao'));
    }else {
        flash()->erro("Erro", "Não houve liberações para os parâmetros selecionados");             
    }
        return back();                                       
  }

  public function briefingNovoPergunta5 (Request $request){
    
    session_start();
    $municipioID = $_SESSION['municipio'];
    
    

    $municipio = Municipio::where('id',$municipioID)->firstOrFail();
    $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
    $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();  

    $where = [];
    
    $where[] = ['uf_id', $estado->id];    

 $municipios = Operacao::join('tab_estimativa_populacao','tab_operacoes.municipio_id','=','tab_estimativa_populacao.municipio_id')
                        ->join('tab_municipios','tab_operacoes.municipio_id', '=','tab_municipios.id')
                        ->selectRaw('tab_operacoes.municipio_id,tab_operacoes.faixa_renda_id,vlr_populacao_estimada')
                        ->where($where)
                        ->where('num_ano_referencia',2019)
                        ->where('qtd_entregue_2019','>',0)
                        ->groupBy('tab_operacoes.municipio_id','tab_operacoes.faixa_renda_id','vlr_populacao_estimada')
                        ->get();

$qtd_municipios_contratos = Operacao::join('tab_municipios','tab_operacoes.municipio_id', '=','tab_municipios.id')
                        ->selectRaw('COUNT(DISTINCT tab_operacoes.id) AS qtd_contratos, COUNT(DISTINCT municipio_id) AS qtd_municipios')
                        ->where($where)
                        ->where('qtd_entregue_2019','>',0)
                        ->first();

 $resumoEntregas = Operacao::join('tab_municipios','tab_operacoes.municipio_id', '=','tab_municipios.id')
                                        ->join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                        ->join('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id')  
                                        ->selectRaw('faixa_renda_id, 
                                                    count(DISTINCT tab_operacoes.id) as qtd_contratos,
                                                    sum(qtd_uh_financiadas) as qtd_uh_contratadas,
                                                    sum(vlr_operacao/qtd_uh_financiadas) as vlr_contratado_uh_entregue,
                                                    count(DISTINCT tab_operacoes.municipio_id) as qtd_municipios,
                                                    sum(vlr_liberado_2019) as vlr_liberado_2019,
                                                    sum(qtd_entregue_2019) as qtd_uh_entregue_2019')
                                              ->where($where)
                                              ->where('qtd_entregue_2019','>',0)
                                                        ->groupBy('faixa_renda_id')
                                                        ->get();

 $totalMunicipioFaixas = ['faixa1'=> 0,'faixa15'=> 0,'faixa2'=> 0,'faixa3'=> 0];   
 $totalEntregas = ['contratos'=> $qtd_municipios_contratos->qtd_contratos,
                   'contratadas'=> 0,
                   'valor_uh_entregues'=> 0,
                   'municipios'=> $qtd_municipios_contratos->qtd_municipios,
                   'liberado_2019'=> 0,
                   'entregue_2019'=> 0,
                   'populacao'=> 0];   
$count = 0;
 foreach($municipios as $dados){
    $totalMunicipioFaixas['faixa1'] += $dados->faixa_renda_id == 1 ? $dados->vlr_populacao_estimada : 0;
    $totalMunicipioFaixas['faixa15'] += $dados->faixa_renda_id == 4 ? $dados->vlr_populacao_estimada : 0;
    $totalMunicipioFaixas['faixa2'] += $dados->faixa_renda_id == 2 ? $dados->vlr_populacao_estimada : 0;
    $totalMunicipioFaixas['faixa3'] += $dados->faixa_renda_id == 3 ? $dados->vlr_populacao_estimada : 0;

    $totalEntregas['populacao'] += $dados->vlr_populacao_estimada;    
      
 }  
 
 foreach($resumoEntregas as $dados){
    $totalEntregas['contratadas'] += $dados->qtd_uh_contratadas;
    $totalEntregas['valor_uh_entregues'] += $dados->vlr_contratado_uh_entregue;
    $totalEntregas['liberado_2019'] += $dados->vlr_liberado_2019;
    $totalEntregas['entregue_2019'] += $dados->qtd_uh_entregue_2019;


    ++$count;
 }  

    //return $totalEntregas;
       //$resumoEntregas->load('faixaRenda');
   $resumoEntregas->load(['faixaRenda' => function ($query) {
                $query->orderBy('dsc_faixa', 'asc');
            }]);
    

    if($count > 0){  
        //return $resumoVigentes;
        return view('briefing.dadosBriefingNovoPerg5', compact('resumoEntregas','totalMunicipioFaixas','count',
                            'totalEntregas','municipio','estado','regiao'));

    }else {
        flash()->erro("Erro", "Não houve contratos para os parâmetros selecionados");             
    }
        return back();                                     
  }

  public function briefingNovoPergunta6 (Request $request){
    
    session_start();
    $municipioID = $_SESSION['municipio'];
    
    

    $municipio = Municipio::where('id',$municipioID)->firstOrFail();
    $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
    $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();  

    $where = [];
    
    $where[] = ['uf_id', $estado->id]; 
    $where[] = ['num_ano_assinatura',2019]; 

     $qtd_contratos_fx1 = OperacoesContratadas::selectRaw('COUNT(DISTINCT operacao_id) AS qtd_contratos')
                                                        ->where($where)
                                                        ->where('origem_id','!=',1)
                                                        ->first();
 $qtd_municipios_fx1 = OperacoesContratadas::selectRaw('COUNT(DISTINCT municipio_id) AS qtd_municipios')
                                                        ->where($where)
                                                        ->first();                                                        
       //return $where;
$resumoContratadas =  OperacoesContratadas::selectRaw('dsc_faixa,
                                        count(DISTINCT municipio_id) AS qtd_municipios,
                                        sum(qtd_uh_contratadas) AS qtd_uh_contratadas,
                                        sum(  CASE WHEN origem_id != 1 THEN 1::integer ELSE 0::integer END) AS qtd_contratos,
                                        sum(vlr_operacao) as vlr_operacao
                                        ')
                                    ->where($where)
                                    //->where('origem_id','!=',1)
                                    ->groupBy('dsc_faixa')
                                    ->orderBy('dsc_faixa', 'asc')        
                                    ->get(); 


    $valoresMcmv = ['municipio'=> $qtd_municipios_fx1->qtd_municipios, 'uh_contratadas'=> 0, 'contratos'=> $qtd_contratos_fx1->qtd_contratos,  'valor_contratado' => 0]; 

    foreach($resumoContratadas as $dados){  
        //$valoresMcmv['municipio'] += empty($dados->qtd_municipios) ? 0 : $dados->qtd_municipios;     
        $valoresMcmv['uh_contratadas'] += empty($dados->qtd_uh_contratadas) ? 0 : $dados->qtd_uh_contratadas;     
        //$valoresMcmv['contratos'] += empty($dados->qtd_contratos) ? 0 : $dados->qtd_contratos;     
        $valoresMcmv['valor_contratado'] += empty($dados->vlr_operacao) ? 0 : $dados->vlr_operacao;     
        
        }    


        $request->session()->reflash();


    if($resumoContratadas->count() > 0){  
        //return $resumoVigentes;
        return view('briefing.dadosBriefingNovoPerg6', compact('resumoContratadas','valoresMcmv','municipio','estado','regiao'));
    }else {
        flash()->erro("Erro", "Não houve contratos para os parâmetros selecionados");             
    }
        return back();                                      
  }

  public function briefingNovoPergunta9 (Request $request){
    
    session_start();
    $municipioID = $_SESSION['municipio'];
    
    

    $municipio = Municipio::where('id',$municipioID)->firstOrFail();
    $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
    $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();  

    $where = [];
    
    $where[] = ['uf_id', $estado->id]; 
  $where[] = ['status_empreendimento_id',5];
  //$where[] = ['faixa_renda_id',1];

  $qtd_municipios = OperacoesContratadas::where($where)
                                         ->distinct('municipio_id')->count('municipio_id');

   $qtd_contratos = OperacoesContratadas::where($where)
                                         ->distinct('operacao_id')->count('operacao_id');                                                


 $resumoParalisadas = OperacoesContratadas::selectRaw('CASE
                                                                 WHEN faixa_renda_id = 1 THEN 1
                                                                 ELSE 0
                                                                 END AS bln_faixa,
                                                                count(DISTINCT operacao_id) as qtd_contratos,
                                                                count(DISTINCT municipio_id) as qtd_municipio,
                                                                sum(qtd_uh_contratadas) AS qtd_uh_paralisadas,
                                                                sum(CASE
                                                                    WHEN faixa_renda_id = 1 THEN vlr_operacao
                                                                    ELSE vlr_sub_ogu+vlr_sub_fgts
                                                                END) AS vlr_nao_oneroso,
                                                                sum(CASE
                                                                    WHEN faixa_renda_id = 1 THEN 0
                                                                    ELSE vlr_operacao-vlr_sub_ogu-vlr_sub_fgts
                                                                END) AS vlr_oneroso,
                                                                sum(vlr_liberado_2019) AS vlr_liberado_2019,
                                                                sum(vlr_operacao) AS vlr_contratado')                 
                                                        ->where($where)
                                                        ->groupBy('bln_faixa')
                                                        ->orderBy('bln_faixa', 'desc')         
                                                        ->get();   
                                                        //final if            

$valoresMcmv = ['municipio'=> $qtd_municipios, 
                'uh_paralisadas'=> 0, 
                'contratos'=> $qtd_contratos,  
                'valor_contratado' => 0,
                'valor_liberado_2019'=> 0,
                'valor_nao_oneroso'=> 0,
                'valor_oneroso'=> 0,]; 

foreach($resumoParalisadas as $dados){  
    
    $valoresMcmv['uh_paralisadas'] += empty($dados->qtd_uh_paralisadas) ? 0 : $dados->qtd_uh_paralisadas;         
    $valoresMcmv['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;     
    $valoresMcmv['valor_liberado_2019'] += empty($dados->vlr_liberado_2019) ? 0 : $dados->vlr_liberado_2019;     
    $valoresMcmv['valor_nao_oneroso'] += empty($dados->vlr_nao_oneroso) ? 0 : $dados->vlr_nao_oneroso;     
    $valoresMcmv['valor_oneroso'] += empty($dados->vlr_oneroso) ? 0 : $dados->vlr_oneroso;     

    
    }    


    $request->session()->reflash();
return view('briefing.dadosBriefingNovoPerg9', compact('resumoParalisadas','valoresMcmv',
                                'municipio','estado','regiao'));



    if($resumoParalisadas->count() > 0){  
        //return $resumoVigentes;
        return view('briefing.dadosBriefingNovoPerg9', compact('resumoParalisadas','valoresMcmv',
                                'municipio','estado','regiao'));
    }else {
        flash()->erro("Erro", "Não houve contratos paralisados para os parâmetros selecionados");             
    }
        return back();                                  
  }

  public function briefingNovoPergunta10 (Request $request){
    
    session_start();
    $municipioID = $_SESSION['municipio'];
    
    

    $municipio = Municipio::where('id',$municipioID)->firstOrFail();
     $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
    $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();  

    $where = [];
    
    $where[] = ['txt_uf', $estado->txt_sigla_uf];   

    $resumoMedicoes = MedicoesCaixa::selectRaw('count(id) as qtd_solicitacoes, count(DISTINCT txt_apf) AS qtd_contratos, sum(vlr_valores_solicitados) AS vlr_devido')
                                            ->where($where)->get();

    
    if($resumoMedicoes->count() > 0){  
        //return $resumoVigentes;
        return view('briefing.dadosBriefingNovoPerg10', compact('resumoMedicoes','municipio','estado','regiao'));      
    }else {
        flash()->erro("Erro", "Não houve contratos para os parâmetros selecionados");             
    }
        return back();                                                                               
  }
  
  public function briefingNovoTabela (Request $request){
    
    session_start();
    $municipioID = $_SESSION['municipio'];
    
    

     $municipio = Municipio::where('id',$municipioID)->firstOrFail();
     $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
    $regiao = Regiao::where('id',$estado->regiao_id)->firstOrFail();  

    $where = [];
    
    $where[] = ['txt_sigla_uf', $estado->txt_sigla_uf];   
    $where[] = ['municipio_id', $municipioID];   
    $where[] = ['faixa_renda_id', 1];
    $where[] = ['bln_vigente', true];
    
    return $resumoLiberacoes =  OperacoesContratadas::selectRaw('txt_status_empreendimento,
                                                count(DISTINCT municipio_id) AS qtd_municipios,
                                                sum(qtd_uh_contratadas) AS qtd_uh_contratadas,
                                                count(DISTINCT operacao_id) AS qtd_contratos,
                                                sum(vlr_liberado_2019) as vlr_liberado_2019,
                                                sum(vlr_operacao) as vlr_operacao
                                                ')
                                            ->where($where)
                                           // ->whereIn('status_empreendimento_id', [1,2,3,5,10])
                                            ->groupBy('txt_status_empreendimento')
                                            ->orderBy('txt_status_empreendimento', 'asc')        
                                            ->get(); 
  }
}