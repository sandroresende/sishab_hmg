<?php

namespace App\Http\Controllers\codem;


use Illuminate\Http\Request;
use App\Http\Requests\codem\SalvarArquivo;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\codem\SalvarDemanda;
use App\Codem\Demanda;
use App\Codem\Situacao;
use App\Codem\TipoDemanda;
use App\Codem\TipoArquivo;
use App\Codem\TipoAtendimento;
use App\Codem\TipoDocumento;
use App\Codem\ModalidadeDemanda;
use App\Codem\TipoInteressado;
use App\Codem\Prioridade;
use App\Codem\ResponsabilidadeDemanda;
use App\Codem\ResponsavelAssinatura;
use App\Codem\ObservacaoDemanda;
use App\Codem\ProcessoDemanda;
use App\Codem\DocumentosDemanda;
use App\Codem\ArquivoDemanda;
use App\Uf;
use App\Municipio;
use App\User;
use App\Codem\StatusProcesso;
use App\Codem\RelacaoDemanda;
use App\Codem\Secretaria;
use App\Codem\Setor;

class DemandaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function cadatrarDemanda(){       
        
        return view('codem.cadastrar_demanda');    
    } 

    public function salvarDemanda(Request $request){       
        
       // return implode("-",array_reverse(explode("/",$request->dte_solicitacao)));
       $dte_previsao_conclusao =  adicionarDiasData(implode("-",array_reverse(explode("/",$request->dte_solicitacao))),$request->qtd_dias_conclusao);

        $salvoSucesso = Demanda::create([
            'dte_solicitacao' => implode("-",array_reverse(explode("/",$request->dte_solicitacao))),
            'tipo_demanda_id' => $request->tipo_demanda,
            'tipo_atendimento_id' => $request->tipo_atendimento,     
            'modalidade_demanda_id' => $request->modalidade,       
            'subtema_id' => $request->subTema,
            'prioridade_id' => $request->prioridade,
            'qtd_dias_conclusao' => $request->qtd_dias_conclusao,

            'dte_previsao_conclusao' => $dte_previsao_conclusao,
            'tipo_interessado_id' => $request->tipoInteressado,
            'txt_nome_interessado' => $request->txt_nome_interessado,
            'uf_id' => $request->estado,
            'municipio_id' => $request->municipio,
            'txt_descricao_demanda' => $request->txt_descricao_demanda,
            'situacao_id' => 1,
            'user_id' => Auth::user()->id,
            'created_at' => date("Y-m-d h:i:s")
    ]);


        if ($salvoSucesso){
        flash()->sucesso("Sucesso", "Demanda cadastrada com sucesso!"); 
        return redirect("/demanda/$salvoSucesso->id");                       
        } else {
        flash()->erro("Erro", "Não foi possível cadastrar a demanda.");            
        }

        return back(); 
    } 

    public function abrirDemanda($demandaID){   
       $demanda = Demanda::where('id', $demandaID)->firstOrFail();

       if(!$demanda->bln_visualizada){
            $demanda->bln_visualizada = true;
            $demanda->save();
       }

       $situacoes = Situacao::select('id','txt_situacao as nome')->orderBy('txt_situacao')->get();
       $tiposDemanda = TipoDemanda::select('id','txt_tipo_demanda as nome')->orderBy('txt_tipo_demanda')->get();
       $tiposAtendimento = TipoAtendimento::select('id','txt_tipo_atendimento as nome')->orderBy('txt_tipo_atendimento')->get();
       $modalidade = ModalidadeDemanda::select('id','txt_modalidade_demanda as nome')->orderBy('txt_modalidade_demanda')->get();
       $tipoInteressado = TipoInteressado::select('id','txt_tipo_interessado as nome')->orderBy('txt_tipo_interessado')->get();
       $prioridade = Prioridade::select('id','txt_prioridade as nome')->orderBy('txt_prioridade')->get();
       $estados = Uf::select('id','txt_sigla_uf as nome')->orderBy('txt_sigla_uf')->get();
       $responsavelAssinatura = ResponsavelAssinatura::select('id','txt_responsavel_assinatura as nome')->orderBy('txt_responsavel_assinatura')->get();
       $statusProcesso = StatusProcesso::select('id','txt_status_processo as nome')->orderBy('txt_status_processo')->get();
       $responsaveis = User::select('id','name as nome')->orderBy('name')->get();
       $tipoDocumento = TipoDocumento::select('id','txt_tipo_documento as nome')->orderBy('txt_tipo_documento')->get();
       $tipoArquivo = TipoArquivo::select('id','txt_tipo_arquivo as nome')->orderBy('txt_tipo_arquivo')->get();
       $secretaria = Secretaria::select('id','txt_sigla_secretaria as nome')->orderBy('txt_sigla_secretaria')->get();
       $setor = Setor::select('id','txt_sigla_setor as nome')->orderBy('txt_sigla_setor')->get();
       

       $responsaveisDemanda = ResponsabilidadeDemanda::join('users','users.id','=','tab_responsabilidade_demanda.user_id')
                                                ->select('tab_responsabilidade_demanda.id as responsabilidade_demanda_id','users.name','tab_responsabilidade_demanda.dte_atribuicao_demanda','tab_responsabilidade_demanda.demanda_id')
                                                ->orderBy('users.name')
                                                ->where('demanda_id', $demandaID)->get();
       $observacoes = ObservacaoDemanda::join('users','users.id','=','tab_observacao_demanda.user_id')
                                                ->select('tab_observacao_demanda.id as observacao_demanda_id','users.name','tab_observacao_demanda.demanda_id','tab_observacao_demanda.dte_observacao','tab_observacao_demanda.txt_observacao')
                                                ->orderBy('tab_observacao_demanda.dte_observacao','desc')
                                                ->where('demanda_id', $demandaID)->get();      

        $documentos = DocumentosDemanda::join('opc_tipo_documento','opc_tipo_documento.id','=','tab_documento_demanda.tipo_documento_id')
                                        ->join('users','users.id','=','tab_documento_demanda.user_id')
                                        ->select('tab_documento_demanda.id','tab_documento_demanda.txt_documento','tab_documento_demanda.txt_descricao_documento',
                                        'opc_tipo_documento.txt_tipo_documento','users.name','tab_documento_demanda.num_sei')
                                        ->orderBy('txt_documento')
                                        ->where('demanda_id', $demandaID)->get();

          $arquivos = ArquivoDemanda::join('opc_tipo_arquivos','opc_tipo_arquivos.id','=','tab_arquivo_demandas.tipo_arquivo_id')
                                               ->select('tab_arquivo_demandas.id','tab_arquivo_demandas.txt_nome_arquivo','tab_arquivo_demandas.txt_caminho_arquivo',
                                                       'opc_tipo_arquivos.txt_tipo_arquivo')
                                               ->where('demanda_id', $demandaID)->get();

            
            
        $processos = ProcessoDemanda::where('demanda_id', $demandaID)->get();                                                
        $processos->load('responsavelAssinatura','statusProcesso');
        $ativarAba = 'demanda';
       return view('codem.demanda',compact('demanda','estados','situacoes','tiposDemanda','tiposAtendimento','modalidade','tipoInteressado',
                                            'prioridade','responsaveis','responsaveisDemanda','observacoes','processos','documentos','arquivos',
                                            'ativarAba','responsavelAssinatura','statusProcesso','tipoDocumento','tipoArquivo',
                                        'secretaria','setor'));    
    }

    public function updateDemanda(Request $request){   
        return $request;
         //return view('codem.demanda',compact('demanda','estados'));    
     }
     public function salvarObservacao(Request $request,Demanda $demanda){       
        $salvoSucesso = ObservacaoDemanda::create([
            'demanda_id' => $demanda->id, 
            'user_id' => Auth::user()->id,
            'dte_observacao' => date("Y-m-d h:i:s"),
            'txt_observacao' => $request->txt_observacao,
            'created_at' => date("Y-m-d h:i:s")
        ]);

        if ($salvoSucesso){
            flash()->sucesso("Sucesso", "Observação cadastrada com sucesso!");             
        } else {
            flash()->erro("Erro", "Não foi possível cadastrar a observação.");            
        }
    
        
        return redirect()->back()->with('ativarAba', 'observacao'); 
    
    } 

     public function deleteObservacao($observacaoId){   
        $observacao =  ObservacaoDemanda::where('id',$observacaoId)->firstOrFail();

        $salvoSucesso = $observacao->delete();
        if ($salvoSucesso){
            flash()->sucesso("Sucesso", "Observação deletada com sucesso!");             
        } else {
            flash()->erro("Erro", "Não foi possível deletar a observação.");            
        }
        
        return redirect()->back()->with('ativarAba', 'observacao'); 

         //return view('codem.demanda',compact('demanda','estados'));    
     }

     public function salvarProcesso(Request $request,Demanda $demanda){       
        
        //return $request->all();

        $salvoSucesso = ProcessoDemanda::create([
            'txt_num_processo' => $request->txt_num_processo, 
            'demanda_id' => $demanda->id,
            'bln_processo_sei' => $request->bln_processo_sei,
            'dte_autuacao' => $request->dte_autuacao,
            'dte_atribuicao_tecnico' => $request->dte_atribuicao_tecnico,
            'dte_atribuicao_assinatura' => $request->dte_atribuicao_assinatura,
            'responsavel_assinatura_id' => $request->responsavel_assinatura_id,
            'dte_assinatura' => $request->dte_assinatura,
            'status_processo_id' => $request->status_processo_id
        ]);

        if ($salvoSucesso){
            flash()->sucesso("Sucesso", "Processo cadastrado com sucesso!");             
        } else {
            flash()->erro("Erro", "Não foi possível cadastrar o processo.");            
        }
    
        
        return redirect()->back()->with('ativarAba', 'processos'); 
    
    } 

    public function deleteProcesso($processoId){   
        $processo =  ProcessoDemanda::where('id',$processoId)->firstOrFail();

        $salvoSucesso = $processo->delete();
        if ($salvoSucesso){
            flash()->sucesso("Sucesso", "Processo deletado com sucesso!");             
        } else {
            flash()->erro("Erro", "Não foi possível deletar o processo.");            
        }
        
        return redirect()->back()->with('ativarAba', 'processos'); 

         //return view('codem.demanda',compact('demanda','estados'));    
     }

     public function salvarDocumento(Request $request,Demanda $demanda){       
        
        //return $request->all();
        $salvoSucesso = DocumentosDemanda::create([
            'demanda_id' => $demanda->id, 
            'txt_documento' => $request->txt_documento, 
            'txt_descricao_documento' => $request->txt_descricao_documento, 
            'tipo_documento_id' => $request->tipo_documento_id, 
            'num_sei' => $request->num_sei, 
            'user_id' => Auth::user()->id
        ]);
        

        if ($salvoSucesso){
            flash()->sucesso("Sucesso", "Processo cadastrado com sucesso!");             
        } else {
            flash()->erro("Erro", "Não foi possível cadastrar o processo.");            
        }
    
        
        return redirect()->back()->with('ativarAba', 'documentos'); 
    
    } 

    public function deleteDocumento($documentoId){   
        $processo =  DocumentosDemanda::where('id',$documentoId)->firstOrFail();

        $salvoSucesso = $processo->delete();
        if ($salvoSucesso){
            flash()->sucesso("Sucesso", "Documento deletado com sucesso!");             
        } else {
            flash()->erro("Erro", "Não foi possível deletar o documento.");            
        }
        
        return redirect()->back()->with('ativarAba', 'documentos'); 

         //return view('codem.demanda',compact('demanda','estados'));    
     }

     public function salvarArquivo(SalvarArquivo $salvarArquivo,Demanda $demanda){       
         
            //return $salvarArquivo;

           // return $salvarArquivo;
                    $salvoSucesso = ArquivoDemanda::create([
                        'demanda_id' => $demanda->id, 
                        'txt_nome_arquivo' => $salvarArquivo->txt_nome_arquivo, 
                        'txt_caminho_arquivo' => $salvarArquivo->txt_caminho_arquivo, 
                        'tipo_arquivo_id' => $salvarArquivo->tipo_arquivo_id             
                    ]);
                    
            
                    if ($salvoSucesso){
                        flash()->sucesso("Sucesso", "Arquivo cadastrado com sucesso!");   
                        session()->forget('ativarAba');          
                    } else {
                        flash()->erro("Erro", "Não foi possível cadastrar o arquivo.");            
                    }               

        
        return redirect()->back()->with('ativarAba', 'arquivos'); 
    
    } 

    public function deleteArquivo($arquivoId){   
        $arquivo =  ArquivoDemanda::where('id',$arquivoId)->firstOrFail();

        $salvoSucesso = $arquivo->delete();
        if ($salvoSucesso){
            flash()->sucesso("Sucesso", "Arquivo deletado com sucesso!");             
        } else {
            flash()->erro("Erro", "Não foi possível deletar o arquivo.");            
        }
        
        return redirect()->back()->with('ativarAba', 'arquivos'); 

         //return view('codem.demanda',compact('demanda','estados'));    
     }

     public function minhasDemandas(){
        
        $usuarioID = Auth::user()->id;
        $where[] = ['user_id',$usuarioID];
        $where[] = ['bln_visualizada',false];
        return $demandaUser = RelacaoDemanda::where($where)
                                            ->limit(4)
                                            ->get();
     }   

     public function retornarDemandasAtrasadas($usuarioID){
        
        
        $where[] = ['user_id',$usuarioID];
        $where[] = ['qtd_dias_atraso','>',0];
        
        $demandasAtrasadas = RelacaoDemanda::leftjoin('tab_uf','tab_uf.id','=','view_relacao_demandas.uf_id')
                                            ->leftjoin('tab_municipios','tab_municipios.id','=','view_relacao_demandas.municipio_id')
                                            ->select('view_relacao_demandas.id','tab_uf.txt_sigla_uf','tab_municipios.ds_municipio',
                                            'dte_solicitacao','dte_previsao_conclusao','qtd_dias_atraso','txt_descricao_demanda','txt_nome_interessado')
                                            ->where($where)
                                            ->orderBy('qtd_dias_atraso','desc')
                                            ->get();    
                                            
                                            
        return view('codem.demandas_atrasadas',compact('demandasAtrasadas')); 
                                                                                                                             
    }

    public function retornarDemandasUsuario(){
        
        $usuarioID = Auth::user()->id;
        $where[] = ['user_id',$usuarioID];
        
        $demandasUsuario = RelacaoDemanda::leftjoin('tab_uf','tab_uf.id','=','view_relacao_demandas.uf_id')
                                            ->leftjoin('tab_municipios','tab_municipios.id','=','view_relacao_demandas.municipio_id')
                                            ->select('view_relacao_demandas.id','tab_uf.txt_sigla_uf','tab_municipios.ds_municipio',
                                            'dte_solicitacao','dte_previsao_conclusao','qtd_dias_atraso','txt_descricao_demanda',
                                            'txt_nome_interessado','bln_visualizada')
                                            ->where($where)
                                            ->orderBy('dte_solicitacao','desc')
                                            ->get();    
                                            
                                            
        return view('codem.demandas_usuario',compact('demandasUsuario')); 
                                                                                                                             
    }

    public function retornarDemandasRespUsuario(){
        
        $usuarioID = Auth::user()->id;
        $where[] = ['tab_responsabilidade_demanda.user_id',$usuarioID];
        
        $demandasUsuario = RelacaoDemanda::leftjoin('tab_uf','tab_uf.id','=','view_relacao_demandas.uf_id')
                                            ->leftjoin('tab_municipios','tab_municipios.id','=','view_relacao_demandas.municipio_id')
                                            ->leftjoin('tab_responsabilidade_demanda','tab_responsabilidade_demanda.demanda_id','=','view_relacao_demandas.id')
                                            ->select('view_relacao_demandas.id','tab_uf.txt_sigla_uf','tab_municipios.ds_municipio',
                                            'dte_solicitacao','dte_previsao_conclusao','qtd_dias_atraso','txt_descricao_demanda',
                                            'txt_nome_interessado','bln_visualizada')
                                            ->where($where)
                                            ->orderBy('dte_solicitacao','desc')
                                            ->get();    
                                            
                                            
        return view('codem.demandas_responder_usuario',compact('demandasUsuario')); 
                                                                                                                             
    }

    
}
