<?php

namespace App\Http\Controllers\OfertaPublica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_sishab\OfertaPublica\Beneficiario;
use App\Mod_sishab\OfertaPublica\Contratos;
use App\Mod_sishab\OfertaPublica\DevolucaoContratos;
use App\Mod_sishab\OfertaPublica\Instituicao;
use App\Mod_sishab\OfertaPublica\Municipio;
use App\Mod_sishab\OfertaPublica\NotasPagamentoRemessaDevolucao;
use App\Mod_sishab\OfertaPublica\NotasPagamentos;
use App\Mod_sishab\OfertaPublica\PagamentosContrato;
use App\Mod_sishab\OfertaPublica\ParcelasRemessasDevolucao;
use App\Mod_sishab\OfertaPublica\ProtocolosInstituicao;
use App\Mod_sishab\OfertaPublica\RemessaDevolucao;
use App\Mod_sishab\OfertaPublica\PagamentosParcelasRemessaDevolucao;
use App\Mod_sishab\OfertaPublica\NotasPagamentosRemessaDevolucao;

use App\Exports\RemessaDevolucaoExport;
use Maatwebsite\Excel\Facades\Excel;

class RemessasDevolucaoController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
    }


        public function index()
    {

    	$remessas = RemessaDevolucao::orderBy('id','desc')->get();
    	
        return view('views_sishab.oferta_publica.filtro_relatorio_devolucao', compact('remessas'));
    }


    public function remessaDevolucao(Request $request)
    {
        //return $request->remessa_devolucao_id;
        return redirect('/oferta_publica/remessa_devolucao/'.$request->remessa_devolucao_id);
    }    
    
    public function dadosRemessaDevolucao(RemessaDevolucao $remessaDevolucao)
        {    

    	// $where[] =  ['id', $request->remessa_devolucao_id ];
		//$remessaDevolucao = RemessaDevolucao::where($where)->firstOrFail();

		 $remessaDevolucao->load('tipoSituacaoDevolucao');

		$whereContratos[] =  ['remessa_devolucao_id', $remessaDevolucao->id ];
		//$contratosDevolvidos = DevolucaoContratos::where($whereContratos)->get();
		//$contratosDevolvidos->load('pagamentosContratos.notasPagamento','contratos.protocolosInstituicaos');
    	
		$instituicao = DevolucaoContratos::join('tab_contratos','tab_contratos.id','=','tab_devolucao_contratos.contrato_id')
													->join('opc_instituicoes_financeiras','opc_instituicoes_financeiras.id','=','tab_contratos.instituicao_id')
    												  ->select('instituicao_id','txt_nome_if','txt_nome_completo_if')
    												  ->where($whereContratos)
    												  ->groupBy('instituicao_id','txt_nome_if','txt_nome_completo_if')
    												  ->firstOrFail();



       // return $instituicao;

       $parcelasRemessas = PagamentosParcelasRemessaDevolucao::where($whereContratos)
                                                             ->orderBy('sg_uf')
                                                             ->orderBy('ds_municipio')
                                                             ->orderBy('txt_nome_beneficiario')
                                                             ->get();    												  
    //	return $parcelasRemessas->load('pagamentosContratosParcelaDtePagam');
    //	$parcelasRemessas = $parcelasRemessas->sortBy('protocolosInstituicao.sg_uf')
    //										 ->sortBy('protocolosInstituicao.ds_municipio')
    //										 ->sortBy('beneficiario.txt_nome_beneficiario');

		$totalPago = 0;    										 
    	foreach ($parcelasRemessas as $parcelas) {
    		$totalPago += $parcelas->parcela_1 + $parcelas->parcela_2 + $parcelas->parcela_3 + $parcelas->parcela_4 + $parcelas->parcela_5 + $parcelas->parcela_6 + $parcelas->parcela_7;
    	}

        //return $totalPago;
    	//$max = $contratosDevolvidos->where('instituicao_id', $contratosDevolvidos->max('instituicao_id'))->first();

    	$subtitulo1 = 'Remessa de Devolução: '.$remessaDevolucao->id;


    	return view('views_sishab.oferta_publica.relatorio_remessa_devolucao', compact('remessaDevolucao','parcelasRemessas','instituicao','totalPago','subtitulo1'));
    	
       
    }

    public function devolucaoContrato(RemessasDevolucao $remessaDevolucao, Contratos $contrato)
    {
    	$remessaDevolucao->load('situacaoDevolucao');;
    	$where[] =  ['contrato_id', $contrato->id];
    	$notasContrato = NotasPagamentoRemessaDevolucao::where($where)->get();
    	
    	$beneficiario = Beneficiario::where('txt_nis_beneficiario','=',$contrato->txt_nis_titular)->firstOrFail();
    	//return $notasContrato;
    	$totalSubvencao = 0;    										 
    	$totalRemuneracao = 0;    										 
    	foreach ($notasContrato as $notas) {
    		$totalSubvencao += $notas->total_subvencao;
    		$totalRemuneracao += $notas->total_remuneracao;
    	}
    	//return $notasContrato;
    	return view('views_sishab.oferta_publica.notas_remessa_devolucao_contrato', compact('notasContrato','beneficiario','contrato','remessaDevolucao','totalSubvencao','totalRemuneracao'));

    }	

    public function notasRemessaDevolucao(Instituicao $instituicao, RemessasDevolucao $remessaDevolucao)
    {
         $remessaDevolucao->load('situacaoDevolucao');;
        
        $where[] =  ['remessa_devolucao_id', $remessaDevolucao->id];
        $notasRemessa = NotasPagamentoRemessaDevolucao::selectRaw('sg_uf,ds_municipio,txt_num_nota_tecnica,dte_geracao_nota,dte_pagamento,sum(total_subvencao) as total_subvencao, sum(total_remuneracao) as total_remuneracao')
                                                        ->groupBy('sg_uf','ds_municipio','txt_num_nota_tecnica','dte_geracao_nota','dte_pagamento')
                                                      ->orderBy('sg_uf','ds_municipio','dte_geracao_nota')
                                                        ->where($where)
                                                        ->get();
        //return $notasRemessa;                                                        
//return $notasContrato;
        $totalSubvencao = 0;                                             
        $totalRemuneracao = 0;                                           
        foreach ($notasRemessa as $notas) {
            $totalSubvencao += $notas->total_subvencao;
            $totalRemuneracao += $notas->total_remuneracao;
        }
        
        
        return view('views_sishab.oferta_publica.notas_remessa_devolucao_if', compact('notasRemessa','beneficiario','contrato','remessaDevolucao','totalSubvencao','totalRemuneracao','instituicao'));

    }

    public function filtroDevolucoesIF()
    {
        
        $instituicoes = Instituicao::orderby('txt_nome_if')->get();
        
        return view('views_sishab.oferta_publica.filtro_devolucoes_if', compact('instituicoes'));

    }


public function notasRemessaDevolucaoIf(Request $request)
    {
        
      // return $request->all();
         $where[] =  ['id_uf', $request->uf_id ];
       //  $wherePagamentos[] =  ['id_uf', $request->uf ];
         if($request->municipio_id){
            $where[] =  ['id_municipio', $request->municipio_id ];            
       //     $wherePagamentos[] =  ['id_municipio', $request->municipio ];            
         }
        
        $where[] =  ['instituicao_id', $request->instituicao_id];

        //$municipio = Municipio::where('id', $request->municipio_id)->firstOrFail();
        //$notasRemessa = $municipio->load('notasPagamentoRemessaDevolucao');
       
       $notasRemessa = NotasPagamentoRemessaDevolucao::selectRaw('sg_uf,ds_municipio,id_municipio,txt_protocolo,notas_pagamento_id,txt_num_nota_tecnica,dte_geracao_nota,dte_pagamento,remessa_devolucao_id,count(contrato_id) as total_beneficiarios,sum(total_subvencao) as total_subvencao, sum(total_remuneracao) as total_remuneracao')
                                                        ->groupBy('sg_uf','ds_municipio','id_municipio','txt_protocolo','notas_pagamento_id','txt_num_nota_tecnica','dte_geracao_nota','dte_pagamento','remessa_devolucao_id')
                                                      ->orderBy('sg_uf','ds_municipio','dte_geracao_nota')
                                                        ->where($where)
                                                        ->get();

        $instituicao = Instituicao::where('id', "=", $request->instituicao_id)->firstOrFail();                                               

//return $notasRemessa;
        $totalSubvencao = 0;                                             
        $totalRemuneracao = 0;                                           
        foreach ($notasRemessa as $notas) {
            $totalSubvencao += $notas->total_subvencao;
            $totalRemuneracao += $notas->total_remuneracao;
        }
        
        
        return view('views_sishab.oferta_publica.notas_devolucao_if', compact('notasRemessa','beneficiario','contrato','totalSubvencao','totalRemuneracao','instituicao'));

    }


   public function buscarEstados($instituicao)
    {
        
        $where[] =  ['instituicao_id', $instituicao ];

        $estados =  NotasPagamentoRemessaDevolucao::select('id_uf', 'sg_uf')
                                    ->orderBy('sg_uf', 'asc')
                                    ->where($where)
                                    ->groupBy('id_uf', 'sg_uf')
                                    ->get();

        return $estados;                                    
    }

    public function buscarMunicipios($instituicao, $id_uf)
    {
        $where = [];
        $where[] = ['id_uf', $id_uf];
        $where[] =  ['instituicao_id', $instituicao ];

        $municipios =  NotasPagamentoRemessaDevolucao::select('id_municipio', 'ds_municipio')
                                    ->orderBy('ds_municipio', 'asc')
                                    ->where($where)
                                    ->groupBy('id_municipio', 'ds_municipio')
                                    ->get();

        return $municipios;                                    
    }
    
    public function remessaDevolucaoExport($remessaDevolucaoId)
    {

        return Excel::download(new RemessaDevolucaoExport($remessaDevolucaoId), 'Relatorio_devolucao_rem_'.$remessaDevolucaoId .'.xlsx');
    }
}


