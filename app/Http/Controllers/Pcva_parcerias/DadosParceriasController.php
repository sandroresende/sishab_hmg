<?php

namespace App\Http\Controllers\Pcva_parcerias;

use DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

use App\Mod_pcva_parcerias\EntePublicoParcerias;
use App\Mod_pcva_parcerias\DadosParcerias;
use App\Mod_pcva_parcerias\MunicipiosBeneficiadosParcerias;
use App\Tab_dominios\SituacaoAdesao;

use App\Mod_pcva_parcerias\ViewResumoSituacaoAdesao;

use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;

class DadosParceriasController extends Controller
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

    public function consultaTermoAdesao()
    {
        return view('views_pcva_parcerias.admin.consulta_termos_adesao');
    }

    public function visualizarTermoAdesao($numProtocolo){
        $dadosParceria = DadosParcerias::where('txt_protocolo_aceite',$numProtocolo)->first();
        $dadosParceria->load('situacaoAdesao','tipoContrapartida','user');

        
        $entePublicoParcerias = EntePublicoParcerias::where('id',$dadosParceria->ente_publico_parceria_id)->firstOrFail();

        $entePublicoParcerias->load('tipoProponente');

        $municipiosBeneficiados = MunicipiosBeneficiadosParcerias::join('tab_municipios','tab_municipios_beneficiados_parcerias.municipio_id', '=','tab_municipios.id')
                                                                            ->join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                                                            ->selectRaw('municipio_id,txt_sigla_uf, ds_municipio')
                                                                            ->where('dados_parceria_id',$dadosParceria->id)
                                                                            ->orderBy('ds_municipio')
                                                                            ->get();
        $municipio = Municipio::where('id', $entePublicoParcerias->municipio_id)->firstOrFail();       
        $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
    

        return view('views_pcva_parcerias.admin.validar_termo_parceria', compact('entePublicoParcerias','dadosParceria','municipiosBeneficiados','municipio','estado'));  
    }

    public function listaTermosAdesao(Request $request){

        //return $request->all();
        $where = [];
        $subTitulo1 = null;
        $subTitulo2 = null;
        if($request->num_protocolo){
            return redirect('/admin/pcva_parcerias/termo/protocolo/'.$request->num_protocolo);
        }else{
            
            if($request->estado){
                $estado = Uf::where('id',$request->estado)->firstOrFail();
                $where[] = ['uf_id', $request->estado];
                $subTitulo1 = $estado->txt_uf;
            }

            if($request->municipio){
                $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
                $where[] = ['municipio_id', $request->municipio];                
                $subTitulo1 = $municipio->ds_municipio .'-' .$estado->txt_sigla_uf;
            }

            if($request->situacao_adesao_id){
                $where[] = ['situacao_adesao_id', $request->situacao_adesao_id];
                $situacaoAdesao = SituacaoAdesao::where('id', $request->situacao_adesao_id)->first();
                if($request->municipio || $request->estado){
                    $subTitulo2 = $situacaoAdesao->txt_situacao_adesao;
                }else{
                    $subTitulo1 = $situacaoAdesao->txt_situacao_adesao;    
                }
                
            }

            $dadosTermo = DadosParcerias::join('tab_ente_publico_parcerias','tab_dados_parcerias.ente_publico_parceria_id','=','tab_ente_publico_parcerias.id')
                                        ->join('tab_municipios','tab_ente_publico_parcerias.municipio_id', '=','tab_municipios.id')
                                        ->join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                        ->join('opc_situacao_adesao', 'tab_dados_parcerias.situacao_adesao_id', '=', 'opc_situacao_adesao.id')
                                        ->where($where)
                                        ->select('tab_dados_parcerias.id as DadosParceriasID', 'tab_dados_parcerias.txt_protocolo_aceite',
                                                    'txt_nome_usuario','txt_sobrenome_usuario','txt_cpf_usuario','txt_cnpj_ente_publico','txt_ente_publico','municipio_id',
                                                    'txt_sigla_uf','ds_municipio','tab_ente_publico_parcerias.txt_email_usuario','tab_ente_publico_parcerias.txt_email_ente_publico',
                                                    'dte_envio_termo','dte_validacao','situacao_adesao_id','txt_situacao_adesao')
                                        ->get();



            if (count($dadosTermo)>0){   
                return view('views_pcva_parcerias.admin.lista_termos_adesao', compact('dadosTermo','municipio','estado','subTitulo1','subTitulo2'));
            } else {
                flash()->erro("Erro", "Não existem dados para os parametros selecionados!"); 
                return back();
            }                                

            
        }
    }

    public function validarTermoAdesao(Request $request)
    {
        $usuario = Auth::user();

        // $request->all();
         $dadosParceria = DadosParcerias::find($request->dados_parceria_id);
        
        $dadosParceria->situacao_adesao_id = $request->situacao_adesao;
        if($request->situacao_adesao == 4){
            $dadosParceria->txt_justificativa_recusa = $request->txt_justificativa_recusa;
        }
        $dadosParceria->dte_validacao =  Date("Y-m-d");
        $dadosParceria->user_id =  $usuario->id;

        $salvouDados = $dadosParceria->save();
        if ($salvouDados){   
            DB::commit();
            flash()->sucesso("Sucesso", "Dados salvos com sucesso!"); 
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Erro ao salvar os dados!"); 
           
            
        }      
        return redirect('/admin/pcva_parcerias/termo/protocolo/'.$dadosParceria->txt_protocolo_aceite);
    }

    public function cancelarAnaliseTermo($dadosParceria){
        
        $usuario = Auth::user();

        $dadosParceria = DadosParcerias::find($dadosParceria);
        $dadosParceria->situacao_adesao_id = 2;
        $dadosParceria->user_id = $usuario->id;
        $dadosParceria->dte_validacao = null;
        $dadosParceria->txt_justificativa_recusa = null;
        
        $salvouDados = $dadosParceria->update();

        if ($salvouDados){   
            DB::commit();
            flash()->sucesso("Sucesso", "Dados salvos com sucesso!"); 
            return redirect('/admin/pcva_parcerias/termo/protocolo/'.$dadosParceria->txt_protocolo_aceite);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Erro ao salvar os dados!"); 
        }  
    }

    public function filtroSituacaoTermo()
    {
           $dadosSituacaoTermo = ViewResumoSituacaoAdesao::selectRaw('txt_sigla_uf, sum(num_termos_totais) as num_termos_totais, sum(num_uh_totais) as num_uh_totais,
                                                                        sum(num_termo_registrados) as num_termo_registrados,sum(num_unidades_registradas) as num_unidades_registradas,
                                                                        sum(num_termo_enviados) as num_termo_enviados, sum(num_unidades_enviadas) as num_unidades_enviadas,
                                                                        sum(num_termo_validados) as num_termo_validados, sum(num_unidades_validadas) as num_unidades_validadas,
                                                                        sum(num_termo_recusados) as num_termo_recusados, sum(num_unidades_recusadas) as num_unidades_recusadas')
                                                                    ->groupBy('txt_sigla_uf')
                                                                    ->orderBy('txt_sigla_uf')
                                                                    ->get();
                                                                    
        $totais = ['total_termos_totais'=> 0,'total_uh_totais'=> 0, 'total_termo_registrados'=> 0, 'total_unidades_registradas'=> 0, 
                    'total_termo_enviados'=> 0, 'total_unidades_enviadas'=> 0, 'total_termo_validados'=> 0, 'total_unidades_validadas'=> 0,
                    'total_termo_recusados'=> 0, 'total_unidades_recusadas'=> 0];    
                         
        foreach($dadosSituacaoTermo as $dados){
            $totais['total_termos_totais'] += $dados->num_termos_totais;
            $totais['total_uh_totais'] += $dados->num_uh_totais;
            $totais['total_termo_registrados'] += $dados->num_termo_registrados;
            $totais['total_unidades_registradas'] += $dados->num_unidades_registradas;
            $totais['total_termo_enviados'] += $dados->num_termo_enviados;
            $totais['total_unidades_enviadas'] += $dados->num_unidades_enviadas;
            $totais['total_termo_validados'] += $dados->num_termo_validados;
            $totais['total_unidades_validadas'] += $dados->num_unidades_validadas;
            $totais['total_termo_recusados'] += $dados->num_termo_recusados;
            $totais['total_unidades_recusadas'] += $dados->num_unidades_recusadas;
        }            
                 // return $totais;                                                            

        return view('views_pcva_parcerias.admin.consulta_resumo_situacao',compact('dadosSituacaoTermo','totais'));
    }

    public function visualizarSituacaoTermo(Request $request)
    {
        //return $request->all();
        $where = [];

        if($request->estado){
            $estado = Uf::where('id',$request->estado)->firstOrFail();
            $where[] = ['uf_id', $request->estado];
        }

        if($request->municipio){
            $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
            $where[] = ['municipio_id', $request->municipio];
        }


         $dadosSituacaoTermo = ViewResumoSituacaoAdesao::where($where)->get();

        $totais = ['total_termos_totais'=> 0,'total_uh_totais'=> 0, 'total_termo_registrados'=> 0, 'total_unidades_registradas'=> 0, 
                   'total_contr_est_uh_registradas'=> 0, 'total_contr_adicional_registradas'=> 0, 
                   'total_termo_enviados'=> 0, 'total_unidades_enviadas'=> 0, 
                   'total_contr_est_uh_enviadas'=> 0, 'total_contr_adicional_enviadas'=> 0, 
                   'total_termo_validados'=> 0, 'total_unidades_validadas'=> 0,
                   'total_contr_est_uh_validadas'=> 0, 'total_contr_adicional_validadas'=> 0, 
                    'total_termo_recusados'=> 0, 'total_unidades_recusadas'=> 0,
                    'total_contr_est_uh_recusadas'=> 0, 'total_contr_adicional_recusadas'=> 0, ];    
                         
        foreach($dadosSituacaoTermo as $dados){
            $totais['total_termos_totais'] += $dados->num_termos_totais;
            $totais['total_uh_totais'] += $dados->num_uh_totais;
            $totais['total_termo_registrados'] += $dados->num_termo_registrados;
            $totais['total_unidades_registradas'] += $dados->num_unidades_registradas;
            $totais['total_contr_est_uh_registradas'] += $dados->vlr_contr_est_uh_registradas;
            $totais['total_contr_adicional_registradas'] += $dados->vlr_contr_adicional_registradas;
            $totais['total_termo_enviados'] += $dados->num_termo_enviados;
            $totais['total_unidades_enviadas'] += $dados->num_unidades_enviadas;
            $totais['total_contr_est_uh_enviadas'] += $dados->vlr_contr_est_uh_enviadas;
            $totais['total_contr_adicional_enviadas'] += $dados->vlr_contr_adicional_enviadas;
            $totais['total_termo_validados'] += $dados->num_termo_validados;
            $totais['total_unidades_validadas'] += $dados->num_unidades_validadas;
            $totais['total_contr_est_uh_validadas'] += $dados->vlr_contr_est_uh_validadas;
            $totais['total_contr_adicional_validadas'] += $dados->vlr_contr_adicional_validadas;
            $totais['total_termo_recusados'] += $dados->num_termo_recusados;
            $totais['total_unidades_recusadas'] += $dados->num_unidades_recusadas;
            $totais['total_contr_est_uh_recusadas'] += $dados->vlr_contr_est_uh_recusadas;
            $totais['total_contr_adicional_recusadas'] += $dados->vlr_contr_adicional_recusadas;
        }     

        //return count($dadosSituacaoTermo);
        if (count($dadosSituacaoTermo)>0){   
            return view('views_pcva_parcerias.admin.relatorio_recebimento', compact('dadosSituacaoTermo','municipio','estado','totais'));
        } else {
            flash()->erro("Erro", "Não existem dados para os parametros selecionados!"); 
            return back();
        }  
       
    }
    
    
}

