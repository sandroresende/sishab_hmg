<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Uf;
use App\Municipio;

use App\pac\ProjetosPac;
use App\pac\OperacoesVinculadas;
use App\pac\ItensInvestimentoProjeto;
use App\pac\CaracteristicasFisicasProjeto;
use App\pac\DadosObras;
use App\pac\DadosFinanceiros;
use App\pac\MunicipiosBeneficiados;



class VinculadasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    Public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtro_pac()
    {
        return view('pac.consultaPac');
    }

 

    public function consulta_vinculadas(Request $request)
    {
        //return $request->all();
        $projetoId = str_replace(".","",str_replace("/","",str_replace("-","",$request->projeto_pac_id)));
        if($projetoId){
            $projetosPac = ProjetosPac::where('projeto_pac_id',$projetoId)
                                        ->first();

            if($projetosPac){
                $operacoesPac = OperacoesVinculadas::where('projeto_pac_id',$projetoId)
                        ->get();    
                
                $investimentos = ItensInvestimentoProjeto::join('opc_item_investimento','opc_item_investimento.id','=','tab_itens_investimentos_projeto.item_investimento_id')
                                                    ->select('tab_itens_investimentos_projeto.item_investimento_id','opc_item_investimento.txt_item_investimento','tab_itens_investimentos_projeto.vlr_item_investimento')
                                                    ->orderBy('opc_item_investimento.txt_item_investimento')
                                                    ->where('projeto_pac_id',$projetoId)
                                                    ->get(); 
                $caracteristicas = CaracteristicasFisicasProjeto::join('opc_caracteristicas_fisicas','opc_caracteristicas_fisicas.id','=','tab_caracteristicas_fisicas_projeto.caracteristica_fisica_id')
                                                    ->select('tab_caracteristicas_fisicas_projeto.caracteristica_fisica_id',
                                                             'opc_caracteristicas_fisicas.txt_caracteristica_fisica',
                                                             'tab_caracteristicas_fisicas_projeto.vlr_caracteristica',
                                                                'opc_caracteristicas_fisicas.txt_unidade_medida')
                                                    ->orderBy('opc_caracteristicas_fisicas.txt_caracteristica_fisica')
                                                    ->where('projeto_pac_id',$projetoId)
                                                    ->get(); 
                $dadosObras = DadosObras::where('projeto_pac_id',$projetoId)
                                          ->firstOrFail();   
                $dadosObras->load('situacaoObraPac');
                
                $dadosFinanceiros = DadosFinanceiros::where('projeto_pac_id',$projetoId)
                                          ->firstOrFail();   
                 $municipiosBeneficiados = MunicipiosBeneficiados::join('tab_municipios','tab_municipios.id','=','tab_municipios_beneficiados.municipio_id')
                                                                    ->join('tab_uf','tab_uf.id','=','tab_municipios.uf_id')
                                                                    ->select('txt_uf','ds_municipio')
                                                                    ->where('projeto_pac_id',$projetoId)
                                                                    ->get();   
                                
                return view('pac.dados_projeto_pac',compact('projetosPac','operacoesPac','investimentos','caracteristicas','dadosObras',
                                                            'dadosFinanceiros','municipiosBeneficiados'));       
            }else{
                flash()->erro("Código Inválido!", "Não existe projeto para esse código.");            
                return back();  
            }
            
        }else{
            
            $where = [];

            $estado = [];
            if($request->estado){
                 $where[] = ['uf_id', $request->estado];
                 $estado = Uf::where('id',$request->estado)->firstOrFail();
             }
      
            $municipio = [];
            if($request->municipio){
                 $where[] = ['tab_municipios_beneficiados.municipio_id', $request->municipio];                 
                 $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
             }
             
             $cabecalhoProjetosPac = ['UF','Tomador', 'Código','Empreendimento','Situação','MCMV'];
             $cabecalhoProjetosPac = json_encode($cabecalhoProjetosPac);
             $projetosPac = ProjetosPac::leftjoin('tab_municipios_beneficiados','tab_municipios_beneficiados.projeto_pac_id','=','view_projetos_pac.projeto_pac_id')
                                        ->select('view_projetos_pac.txt_sigla_uf','view_projetos_pac.txt_tomador','view_projetos_pac.projeto_pac_id',
                                                'view_projetos_pac.txt_nome_empreendimento_pac','view_projetos_pac.txt_situacao_contrato_pac',
                                                'view_projetos_pac.bln_vinculacao_mcmv','view_projetos_pac.projeto_pac_id as id')
                                        ->where($where)
                                        ->get();
            $projetosPac = json_encode($projetosPac);                                        

            return view('pac.lista_vinculadas',compact('projetosPac','estado','municipio','cabecalhoProjetosPac'));
        }        
    }   

    public function dados_projeto($projetoId){
        $projetoId = '0'.$projetoId;
         $projetosPac = ProjetosPac::where('projeto_pac_id',$projetoId)->first();
           
         $operacoesPac = OperacoesVinculadas::where('projeto_pac_id',$projetoId)->get();    
        if(!$operacoesPac){
            $operacoesPac = null;
        }

         $investimentos = ItensInvestimentoProjeto::join('opc_item_investimento','opc_item_investimento.id','=','tab_itens_investimentos_projeto.item_investimento_id')
                        ->select('tab_itens_investimentos_projeto.item_investimento_id','opc_item_investimento.txt_item_investimento','tab_itens_investimentos_projeto.vlr_item_investimento')
                        ->orderBy('opc_item_investimento.txt_item_investimento')
                        ->where('projeto_pac_id',$projetoId)
                        ->get(); 
        if(!$investimentos){
            $investimentos = null;
        }                
        
        $caracteristicas = CaracteristicasFisicasProjeto::join('opc_caracteristicas_fisicas','opc_caracteristicas_fisicas.id','=','tab_caracteristicas_fisicas_projeto.caracteristica_fisica_id')
                        ->select('tab_caracteristicas_fisicas_projeto.caracteristica_fisica_id',
                                'opc_caracteristicas_fisicas.txt_caracteristica_fisica',
                                'tab_caracteristicas_fisicas_projeto.vlr_caracteristica',
                                    'opc_caracteristicas_fisicas.txt_unidade_medida')
                        ->orderBy('opc_caracteristicas_fisicas.txt_caracteristica_fisica')
                        ->where('projeto_pac_id',$projetoId)
                        ->get(); 
        if(!$caracteristicas){
            $caracteristicas = null;
        }

         $dadosObras = DadosObras::where('projeto_pac_id',$projetoId)
            ->first();   
        
        if($dadosObras){
            $dadosObras->load('situacaoObraPac');
            }   
      

        $dadosFinanceiros = DadosFinanceiros::where('projeto_pac_id',$projetoId)
            ->first();   

        $municipiosBeneficiados = MunicipiosBeneficiados::join('tab_municipios','tab_municipios.id','=','tab_municipios_beneficiados.municipio_id')
                                        ->join('tab_uf','tab_uf.id','=','tab_municipios.uf_id')
                                        ->select('txt_uf','ds_municipio')
                                        ->where('projeto_pac_id',$projetoId)
                                        ->get();   

        return view('pac.dados_projeto_pac',compact('projetosPac','operacoesPac','investimentos','caracteristicas','dadosObras',
                                'dadosFinanceiros','municipiosBeneficiados'));    
    }
}

