<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ResumoOperacao;
use App\ResumoOperacoesRetomadas;
use App\Retomada;
use App\OperacaoRetomada;
use App\ResumoRetomada;
use App\ResumoOficio;
use App\ObservacaoRetomada;
use App\Municipio;
use App\Uf;
use App\ResumoStatusDemanda;
use App\ResumoStatusSnh;
use App\ResumoRetomadaObras;
use App\ResumoOficioRetomada;



class RetomadaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    public function index(Request $request){

        //return $request->all();
        $estado = [];
        $where = []; 

        $municipioId = $request->municipio ? $request->municipio : 0;
        $estadoId = $request->estado ? $request->estado : 0;
        $situacaoId = $request->situacaoObra ? $request->situacaoObra : 0;

        if($request->estado){
            $where[] = ['uf_id', $request->estado]; 
            $estado = Uf::where('id',$request->estado)->firstOrFail();
        }

        $municipio = [];
        if($request->municipio){
            $where[] = ['municipio_id', $request->municipio]; 
            $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
        }

        $situacaoObra = [];
        if($request->situacaoObra){
            $where[] = ['situacao_obra_id', $request->situacaoObra]; 
            
        }

          $resumoStatusRetomada = ResumoStatusDemanda::selectRaw('txt_sigla_uf, count(operacao_id) as qtd_operacoes,
                                                                sum(iniciar_solicitacao) as iniciar_solicitacao,
                                                                sum(analise_ao) as analise_ao,
                                                                sum(dotado) as dotado,
                                                                sum(contratado) as contratado,
                                                                sum(mcidades) as mcidades,
                                                                sum(analise_finalizada) as analise_finalizada,
                                                                sum(encaminhado_dotacao) as encaminhado_dotacao,
                                                                sum(nao_autorizado_mcidades) as nao_autorizado_mcidades,
                                                                sum(pendente_af) as pendente_af,
                                                                sum(nao_autorizado_ao) as nao_autorizado_ao,
                                                                sum(nao_preenchido) as nao_preenchido')
                                                    ->groupBy('txt_sigla_uf')
                                                    ->orderBy('txt_sigla_uf')
                                                    ->get();
        
        $totalStatus = ['total_qtd_operacoes'=> 0,
                        'total_iniciar_solicitacao'=> 0,
                        'total_analise_ao'=> 0,
                        'total_dotado'=> 0,
                        'total_contratado'=> 0,
                        'total_mcidades'=> 0,
                        'total_analise_finalizada'=> 0,
                        'total_encaminhado_dotacao'=> 0,
                        'total_nao_autorizado_mcidades'=> 0,
                        'total_pendente_af'=> 0,
                        'total_nao_autorizado_ao'=> 0,
                        'total_nao_preenchido'=> 0];
        
        foreach($resumoStatusRetomada as $status){
            $totalStatus['total_qtd_operacoes'] += $status->qtd_operacoes;
            $totalStatus['total_iniciar_solicitacao'] += $status->iniciar_solicitacao;
            $totalStatus['total_analise_ao'] += $status->analise_ao;
            $totalStatus['total_dotado'] += $status->dotado;
            $totalStatus['total_contratado'] += $status->contratado;
            $totalStatus['total_mcidades'] += $status->mcidades;
            $totalStatus['total_analise_finalizada'] += $status->analise_finalizada;
            $totalStatus['total_encaminhado_dotacao'] += $status->encaminhado_dotacao;
            $totalStatus['total_nao_autorizado_mcidades'] += $status->nao_autorizado_mcidades;
            $totalStatus['total_pendente_af'] += $status->pendente_af;
            $totalStatus['total_nao_autorizado_ao'] += $status->nao_autorizado_ao;
            $totalStatus['total_nao_preenchido'] += $status->nao_preenchido;
        }
       // $totalStatus = json_encode($totalStatus);
        //return $totalStatus;
        /**
        if($where){
            $operacoesRetomadas = ResumoOperacoesRetomadas::where($where)->paginate(20);   
        }else{
            $operacoesRetomadas = ResumoOperacoesRetomadas::paginate(20);   
        }
        */
        //return $operacoesRetomadas;
        $resumoStatusSnh = ResumoStatusSnh::selectRaw('txt_sigla_uf, count(operacao_id) as qtd_operacoes,
                                                                sum(em_analise) as em_analise,
                                                                sum(aguardando) as aguardando,
                                                                sum(autorizado) as autorizado,
                                                                sum(valor_questionado) as valor_questionado,
                                                                sum(nao_preenchido) as nao_preenchido')
                                                        ->groupBy('txt_sigla_uf')
                                                        ->orderBy('txt_sigla_uf')
                                                        ->get();
            $totalStatusSnh = ['total_qtd_operacoes'=> 0,
            'total_em_analise'=> 0,
            'total_aguardando'=> 0,
            'total_autorizado'=> 0,
            'total_valor_questionado'=> 0,            
            'total_nao_preenchido'=> 0];
        
        foreach($resumoStatusSnh as $statusSnh){
            $totalStatusSnh['total_qtd_operacoes'] += $statusSnh->qtd_operacoes;
            $totalStatusSnh['total_em_analise'] += $statusSnh->em_analise;
            $totalStatusSnh['total_aguardando'] += $statusSnh->aguardando;
            $totalStatusSnh['total_autorizado'] += $statusSnh->autorizado;
            $totalStatusSnh['total_valor_questionado'] += $statusSnh->valor_questionado;           
            $totalStatusSnh['total_nao_preenchido'] += $statusSnh->nao_preenchido;
        }

        //return $totalStatusSnh;
        return view('retomada.filtroRetomada',compact('operacoesRetomadas','estado','municipioId','estadoId','situacaoId',
                                                      'resumoStatusRetomada','totalStatus','totalStatusSnh','resumoStatusSnh'));
    }
    
    public function operacoesRetomadas(Request $request){

         $request->all();
        $estado = [];
        $where = []; 

        $municipioId = $request->municipio ? $request->municipio : 0;
        $estadoId = $request->estado ? $request->estado : 0;
        $situacaoId = $request->situacaoObra ? $request->situacaoObra : 0;

        if($request->estado){
            $where[] = ['uf_id', $request->estado]; 
            $estado = Uf::where('id',$request->estado)->firstOrFail();
        }

        $municipio = [];
        if($request->municipio){
            $where[] = ['municipio_id', $request->municipio]; 
            $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
        }

        $situacaoObra = [];
        if($request->situacaoObra){
            $where[] = ['situacao_obra_id', $request->situacaoObra]; 
            
        }

      $operacoesRetomadas = ResumoRetomadaObras::where($where)->orderBy('operacao_id', 'asc')->orderBy('num_suplementacao','asc')->get();   

       // return $operacoesRetomadas;
       
        return view('retomada.retomadas',compact('operacoesRetomadas','estado','municipioId','estadoId','situacaoId'));
    }

    public function operacaoRetomada($operacaoRetomadaId){
      
         $operacaoRetomada = ResumoRetomadaObras::where('id',$operacaoRetomadaId)->FirstOrFail(); 
          $operacao = ResumoOperacao::where('operacao_id',$operacaoRetomada->operacao_id)->FirstOrFail(); 
        
         $oficiosRetomadaSNH = ResumoOficioRetomada::where('retomada_obras_id',$operacaoRetomadaId)
                                        ->where('tipo_oficio_id',2)
                                        ->orderBy('dte_oficio','desc')
                                        ->orderBy('oficio_id','desc')
                                        ->get();
        
        $oficiosRetomadaGefus = ResumoOficioRetomada::where('retomada_obras_id',$operacaoRetomadaId)
                                        ->where('tipo_oficio_id',1)
                                        ->orderBy('dte_oficio','desc')
                                        ->orderBy('oficio_id','desc')
                                        ->get();                                        

           $observacoes = ObservacaoRetomada::where('retomada_obras_id',$operacaoRetomadaId)->orderBy('dte_observacao','desc')->get();
        $observacoes->load('user');

       
       
       
     return view('retomada.dadosOperacaoRetomada',compact('operacaoRetomada','operacao','observacoes','oficiosRetomadaSNH','oficiosRetomadaGefus'));
    }

    public function retomada($retomadaId){
      

         $retomada = ResumoRetomada::where('retomada_id',$retomadaId)->orderby('num_suplementacao','asc')->firstOrFail(); 
         $oficiosRetomada = ResumoOficio::where('operacao_id',$retomada->operacao_id)
                                        ->orderBy('num_ano_oficio','desc')
                                        ->orderBy('oficio_id','desc')
                                        ->get();
        
        

        return view('retomada.dadosRetomada',compact('retomada','oficiosRetomada'));
    }

    public function cadastrarNovaObservacao(Request $request){
       
        
        
        $salvoSucesso = ObservacaoRetomada::create([
                                'user_id' => Auth::user()->id,
                                'retomada_obras_id' => $request->retomada_obras_id,
                                'dte_observacao' => date("Y-m-d"),
                                'txt_observacao' => $request->observacao
                        ]);


        if ($salvoSucesso){
            flash()->sucesso("Sucesso", "Observação salva com sucesso!");                        
        } else {
            flash()->erro("Erro", "Não foi possível salvar a observação.");            
        }

        return back();
    }

    public function deleteObservacao($observacaoId){   
        $observacao =  ObservacaoRetomada::where('id',$observacaoId)->firstOrFail();

        $salvoSucesso = $observacao->delete();
        if ($salvoSucesso){
            flash()->sucesso("Sucesso", "Observação deletada com sucesso!");             
        } else {
            flash()->erro("Erro", "Não foi possível deletar a observação.");            
        }
        
        return redirect()->back()->with('ativarAba', 'observacao'); 

         //return view('codem.demanda',compact('demanda','estados'));    
     }
}
