<?php

namespace App\Http\Controllers\oferta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\oferta\Protocolo;
use App\oferta\ResumoContratosProtocolo;
use App\oferta\ResumoProtocolos;
use App\oferta\ResumoPagamentos;
use App\oferta\Contrato;
use App\oferta\Instituicao;
use App\oferta\FaixaExecucao;
use App\oferta\PagamentosContratosParcela;

class ProtocolosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function filtro_protocolos(){
        
        return view('oferta.filtroProtocolos');    
    } 
    
    public function protocolos(Request $request){
        $protocolos = ResumoProtocolos::where('municipio_id',$request->municipio)->get();

        
        return view('oferta.Protocolos',compact('protocolos'));    
    }

    public function contratos_protocolo(Protocolo $protocolo){
        //return $protocolo;
        $mediaPercProtocolos =  getMediaPercProtocolo($protocolo->id);
        
        $contratos = ResumoContratosProtocolo::where('protocolo_id',$protocolo->id)->orderby('txt_nome_beneficiario')->get();
        $contratosParcelas = PagamentosContratosParcela::where('protocolo_id',$protocolo->id)->orderby('txt_nome_beneficiario')->get();
        $contratos->load('resumoPagamento');
        
        //return $contratos;
        
        $protocolo = ResumoProtocolos::where('protocolo_id',$protocolo->id)->firstOrFail();
        
        $qtd_restricao = 0;
        $qtd_devolvido = 0;
        $qtd_entregue = 0;
        $qtd_concluida = 0;
        $qtd_andamento = 0;
        $totalSubvencao = 0;
        foreach($contratos as $contrato){

            if($contrato->bln_restricao) {
                $qtd_restricao += 1;
                $qtd_andamento += 1; 
            }    
            else{
                if($contrato->bln_recurso_devolvido) {
                    $qtd_devolvido += 1;
                }
                else{
                    if($contrato->bln_entregue){ 
                        if($contrato->bln_recurso_devolvido){
                            $qtd_devolvido += 1;                               
                        }    
                        else{
                            $qtd_entregue += 1;                             
                        }
                    }    
                    elseif((!$contrato->bln_entregue) && (!$contrato->bln_recurso_devolvido) && ($contrato->vlr_percentual_obra==100)){                    
                        $qtd_concluida += 1;
                    }
                    else{
                        $qtd_andamento += 1;                                
                    }   
                }   
            } 
            $totalSubvencao += $contrato->resumoPagamento->total_subvencao;
            
        }
            $totalParcelas = ['total_parcela_1'=> 0,
            'total_parcela_2'=> 0,
            'total_parcela_3'=> 0,
            'total_parcela_4'=> 0,
            'total_parcela_5'=> 0,
            'total_parcela_6'=> 0,
            'total_parcela_7'=> 0,
            'total_subvencao'=> 0,
            'total_parcela_1_rem'=> 0,
            'total_parcela_2_rem'=> 0]; 

            foreach($contratosParcelas as $parcelas){
                $totalParcelas['total_parcela_1'] += $parcelas->parcela_1;
                $totalParcelas['total_parcela_2'] += $parcelas->parcela_2;
                $totalParcelas['total_parcela_3'] += $parcelas->parcela_3;
                $totalParcelas['total_parcela_4'] += $parcelas->parcela_4;
                $totalParcelas['total_parcela_5'] += $parcelas->parcela_5;
                $totalParcelas['total_parcela_6'] += $parcelas->parcela_6;
                $totalParcelas['total_parcela_7'] += $parcelas->parcela_7;
                $totalParcelas['total_subvencao'] += $parcelas->parcela_1+$parcelas->parcela_2+$parcelas->parcela_3+$parcelas->parcela_4+$parcelas->parcela_5+$parcelas->parcela_6+$parcelas->parcela_7;
                $totalParcelas['total_parcela_1_rem'] += $parcelas->parcela_1_remun;
                $totalParcelas['total_parcela_2_rem'] += $parcelas->parcela_2_remun;
                }
        
        
        return view('oferta.contratos',compact('protocolo','contratos', 'qtd_restricao','qtd_devolvido','qtd_entregue','qtd_concluida',
                                                'contratosParcelas','qtd_andamento','mediaPercProtocolos','totalSubvencao','totalParcelas'));
    }

    public function protocolo(Request $request){

        
        $protocolo = Protocolo::where('txt_protocolo', $request->txt_protocolo)->first();
        
        if($protocolo){
            $contratos = ResumoContratosProtocolo::where('protocolo_id',$protocolo->id)->orderby('txt_nome_beneficiario')->get();
            
            $contratos->load('resumoPagamento');
             $protocolo = ResumoProtocolos::where('protocolo_id',$protocolo->id)->firstOrFail();
              $contratosParcelas = PagamentosContratosParcela::where('protocolo_id',$protocolo->protocolo_id)->orderby('txt_nome_beneficiario')->get();

            $qtd_restricao = 0;
            $qtd_devolvido = 0;
            $qtd_entregue = 0;
            $qtd_concluida = 0;
            $qtd_andamento = 0;
            $totalSubvencao = 0;
            foreach($contratos as $contrato){
                if($contrato->bln_restricao) {
                    $qtd_restricao += 1;
                }    
                
                    if($contrato->bln_recurso_devolvido) {
                        $qtd_devolvido += 1;
                    }
                    else{
                        if($contrato->bln_entregue){ 
                            if($contrato->bln_recurso_devolvido){
                                $qtd_devolvido += 1;                               
                            }    
                            else{
                                $qtd_entregue += 1;                             
                            }
                        }    
                        elseif((!$contrato->bln_entregue) && (!$contrato->bln_recurso_devolvido) && ($contrato->vlr_percentual_obra==100)){                    
                            $qtd_concluida += 1;
                        }
                        else{
                            $qtd_andamento += 1;                                
                        }   
                    }   
                    $totalSubvencao += $contrato->resumoPagamento->total_subvencao;
            }
            $totalParcelas = ['total_parcela_1'=> 0,
            'total_parcela_2'=> 0,
            'total_parcela_3'=> 0,
            'total_parcela_4'=> 0,
            'total_parcela_5'=> 0,
            'total_parcela_6'=> 0,
            'total_parcela_7'=> 0,
            'total_subvencao'=> 0,
            'total_parcela_1_rem'=> 0,
            'total_parcela_2_rem'=> 0]; 

            foreach($contratosParcelas as $parcelas){
                $totalParcelas['total_parcela_1'] += $parcelas->parcela_1;
                $totalParcelas['total_parcela_2'] += $parcelas->parcela_2;
                $totalParcelas['total_parcela_3'] += $parcelas->parcela_3;
                $totalParcelas['total_parcela_4'] += $parcelas->parcela_4;
                $totalParcelas['total_parcela_5'] += $parcelas->parcela_5;
                $totalParcelas['total_parcela_6'] += $parcelas->parcela_6;
                $totalParcelas['total_parcela_7'] += $parcelas->parcela_7;
                $totalParcelas['total_subvencao'] += $parcelas->parcela_1+$parcelas->parcela_2+$parcelas->parcela_3+$parcelas->parcela_4+$parcelas->parcela_5+$parcelas->parcela_6+$parcelas->parcela_7;
                $totalParcelas['total_parcela_1_rem'] += $parcelas->parcela_1_remun;
                $totalParcelas['total_parcela_2_rem'] += $parcelas->parcela_2_remun;
                }

            return view('oferta.contratos',compact('protocolo','contratos','contratosParcelas', 'totalSubvencao','totalParcelas','qtd_restricao','qtd_devolvido','qtd_entregue','qtd_concluida','qtd_andamento'));
        }else{
            flash()->erro("Protocolo Incorreto", "Não foi possível encontrar este protocolo.");
        }

        return back();
    }   
    
    public function filtro_protocolos_if(){

        $instituicoes = Instituicao::orderBy('txt_nome_if')->get();
        return view('oferta.filtroProtocolosIf',compact('instituicoes'));
    
    }

    public function protocolos_instituicao(Request $request){

        $instituicao =  Instituicao::where('id',$request->instituicao_id)->firstOrFail();
        $where[] = ['instituicao_id',$request->instituicao_id];

       $protocolos = FaixaExecucao::selectRaw('sg_uf,ds_municipio, protocolo_id, txt_protocolo, num_oferta,COUNT(contrato_id) AS total_uh, 
                                                SUM(de_0_perc + de_0_a_15_perc + de_15_a_30_perc + de_30_a_45_perc + de_45_a_60_perc + de_60_a_75_perc + de_75_a_99_perc) AS total_andamento, 
                                                SUM(concluidas) AS total_concluidas, SUM(entregues) AS total_entregues, SUM(devolvidas) AS total_devolvidas,
                                                AVG(vlr_percentual_obra) as media_percentual, sum(inviavel) as total_obra_inviavel')
                                                ->where($where)         
                                                ->groupBy('sg_uf','ds_municipio','protocolo_id','txt_protocolo','num_oferta')
                                                ->orderBy('sg_uf', 'asc')
                                                ->orderBy('ds_municipio', 'asc')
                                                ->get(); 
        $count = 0;
        //return $this->qtd_inviaveis_e_devolvidas(3465);
        foreach($protocolos as $protocolo){   
            $valor = $protocolo->protocolo_id;                    
            //return $this->qtd_inviaveis_e_devolvidas(3465);
            $protocolos[$count]['total_inviavies_devolvidas'] = $this->qtd_inviaveis_e_devolvidas($valor);
            $count++;
        }
        
        return view('oferta.protocolosInstituicao',compact('protocolos','instituicao'));
    }

    private function qtd_inviaveis_e_devolvidas($protocoloId){
        $where = [];
        $where[] = ['protocolo_id',$protocoloId];

        $where[] = ['bln_recurso_devolvido',true];
        $where[] = ['bln_obra_inviavel',true];
        
        $dados = FaixaExecucao::selectRaw('protocolo_id,bln_obra_inviavel,bln_recurso_devolvido, SUM(devolvidas) AS total_devolvidas')
                                                    ->where($where)         
                                                    ->groupBy('protocolo_id','bln_obra_inviavel','bln_recurso_devolvido')
                                                    ->first(); 
        
        if($dados){
            return $dados->total_devolvidas;
        }else{
            return 0;
        } 
        
                
    }
}        