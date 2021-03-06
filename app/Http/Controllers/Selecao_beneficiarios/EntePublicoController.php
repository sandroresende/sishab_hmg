<?php

namespace App\Http\Controllers\Selecao_beneficiarios;

use Illuminate\Http\Request;
use App\Http\Requests\NovaSenha;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Session;

use App\User;
use App\Mod_selecao_demanda\EntePublico;
use App\Mod_selecao_demanda\TipoEntePublico;
use App\Mod_selecao_demanda\Dirigente;
use App\Mod_selecao_demanda\DadosArquivoEntePublico;
use App\IndicadoresHabitacionais\Municipio;

class EntePublicoController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');        
        $this->middleware('entePublico');
        //$this->middleware('redirecionar');
    }


        public function index()
    {
        
          $tipoEnte = TipoEntePublico::select('id','txt_tipo_ente_publico as nome')->get();
          $usuario = Auth::user();
        
       // return $ente->id;
            $where = [];
            $where[] = ['ente_publico_id', $usuario->ente_publico_id];    
            $where[] = ['tipo_usuario_id',8];    
            $where[] = ['status_usuario_id',1];    
          
            $usuarioPrincipalAtivo =  User::where($where)->get();

            $usuario = Auth::user();
            $usuario->ente_publico_id;
          $ente = EntePublico::where('id',$usuario->ente_publico_id)->first();
        // $ente->municipio_id;
        $whereFile = [];
        $whereFile[] = ['municipio_id', $ente->municipio_id];
        $whereFile[] = ['bln_arquivo_gerado', true];
        $whereFile[] = ['tipo_arquivo_id', 1];
      //  return $whereFile;
         $dadosArquivosmunicipio = DadosArquivoEntePublico::where($whereFile)->get();
        $arquivosmunicipio = $dadosArquivosmunicipio->count();

         $dadosArquivosmunicipio = DadosArquivoEntePublico::where($whereFile)->first();
            /**
            $where = [];
            $where[] = ['ente_publico_id',$usuario->ente_publico_id];    
            $where[] = ['tipo_usuario_id',9];   
            $where[] = ['bln_visualizar_documentos',false];   
            */
              $numUsuarios = Auth::user()->getNumUsuarios($usuario); 

             $dirigente = Dirigente::where('ente_publico_id',$usuario->ente_publico_id)->get();
             $ente = EntePublico::where('id',$usuario->ente_publico_id)->first();
             $ente->load('tipoEntePublico');

             if(Auth::user()->tipo_usuario_id == 9){
                
                 if(count($usuarioPrincipalAtivo)==0){ 
    
                    Auth::logout();
                    Session::flush();
                    session()->forget('mensagem'); 
                   // $mensagemErro = 'O perfil principal do Ente P??blico ainda n??o foi ativado.';  
                  return  redirect()->back()->with('mensagem');
                   // return redirect('/login');
                } 
            } 
           
                if(Auth::user()->isUserAtivo()){
                   
                    if( (Auth::user()->tipo_usuario_id == 8) && (count($dirigente) == 0) ){
                           
                            return view('views_selecao_beneficiarios.cadastro_dirigente',compact('usuario','ente'));
                    }else{
                        
                        if(Auth::user()->isAceiteTermo()){
                            if(Auth::user()->isAceiteDocumentos()){
                                
                                $mensagemTempo = '';
                                if($dadosArquivosmunicipio->bln_download_arquivo){
                                    
                                     $qtDiasDownload = diferenca_datas($dadosArquivosmunicipio->dte_download_ente, Date("Y-m-d h:i:s"));
                                    $tempoRestante = 30 - $qtDiasDownload;
                                    if($tempoRestante>0 && $tempoRestante<=10){
                                        $mensagemTempo = "Restam " . $tempoRestante . " para o fim do prazo para envio do arquivo.";
                                        flash()->confirma("Informa????o", "Restam " . $tempoRestante . " para o fim do prazo para envio do arquivo.");   
                                    }                                    
                                }else{
                                   
                                    $qtDiasDownload = diferenca_datas($dadosArquivosmunicipio->created_at, Date("Y-m-d h:i:s"));
                                      $tempoRestante = 30 - $qtDiasDownload;
                                      $mensagemTempo =  "Ainda n??o foi realizado o download do arquivo. Restam " . $tempoRestante . " para o fim do prazo para envio do arquivo." ;
                                    if($tempoRestante>0){  
                                      flash()->confirma("Informa????o", "Ainda n??o foi realizado o download do arquivo. Restam " . $tempoRestante . " para o fim do prazo para envio do arquivo.");   
                                    } 
                                }
                                return view('views_selecao_beneficiarios.painel_ente_publico', compact('usuario','numUsuarios','arquivosmunicipio','mensagemTempo'));
                            }else{                       
                                return redirect('/selecao_beneficiarios/documentos');
                            }
                            
                        }else{
                            
                            return redirect('/selecao_beneficiarios/termo');
                            //return view('views_selecao_beneficiarios.termo_responsabilidade_ente');
                        }
                    }
                }else{
                        return view('views_selecao_beneficiarios.cadastro_ente_publico', compact('usuario','ente','tipoEnte'));
                }
            
              
            
            
    }

    public function atualizarSenhaEntePublico(NovaSenha $request)
    {
       //return $request->all();
            $usuario = Auth::user();
            $ente = EntePublico::where('id',$usuario->ente_publico_id)->get();
            $usuario->name = $request->name;  
            $usuario->txt_cargo = $request->txt_cargo;  
            //$usuario->txt_cpf_usuario = $request->txt_cpf_usuario;  
            $usuario->password = bcrypt($request->password);      
            $usuario->bln_ativo = true;    
            $usuario->status_usuario_id = 1;  
            $usuario->updated_at = Date("Y-m-d h:i:s");  

            
            
            $salvouNovaSenha = $usuario->update();
    
            //return $salvouNovaSenha;
            if ($usuario->save()){

                flash()->sucesso("Sucesso", "Senha cadastrada com sucesso!");   
               if($usuario->modulo_sistema_id == 2){
                    if( $usuario->tipo_usuario_id == 8){                  
                        return redirect('selecao_beneficiarios/dirigente/cadastro');
                    }else{
                        return redirect('selecao_beneficiarios/termo');
                    }
               }
               else{
                return redirect('prototipo/termo');
               }    
                
                //return view('views_selecao_beneficiarios.cadastro_dirigente',compact('usuario','ente'));
                
            } else {
                flash()->erro("Erro", "N??o foi poss??vel cadastrar uma nova senha.");            
            }     
    
            // tem que redirecionar o admin para a pagina correta, sen??o o flash nao fuinciona.
           
        }

        public function aceiteTermo(Request $request){
            //return $request->all();
            
            if($request->termo == true){
                $usuario = Auth::user();
                $usuario->bln_aceite_termo = true;      
                $usuario->dte_aceite_termo = Date("Y-m-d h:i:s");  
                
                //return $usuario;
                $salvouAceite = $usuario->save();
            }
            
           /**
            $where = [];
            $where[] = ['ente_publico_id',$usuario->ente_publico_id];    
            $where[] = ['tipo_usuario_id',9];   
            $where[] = ['bln_visualizar_documentos',false];   
            */
             $numUsuarios = Auth::user()->getNumUsuarios($usuario); 
    
            if ($salvouAceite){
                flash()->sucesso("Sucesso", "Termo de Responsabilidade aceito de acordo com o disposto nos normativos vigentes do Programa.");   
                return redirect('/selecao_beneficiarios/documentos');    
                //return view('views_selecao_beneficiarios.painel_ente_publico',compact('usuario','numUsuarios'));
                                
            } else {
                flash()->erro("Erro", "N??o foi poss??vel aceitar o Termo de Responsabilidade.");            
            }   
        }

        public function  visualizarDocumentos(){
           

            return view('views_selecao_beneficiarios.documentos_especificacoes', compact('dte_aceite_termo'));
        }

        public function  selecaoHome(){

            
            return view('views_selecao_beneficiarios.selecao_home');
        }

        public function abrirTermo(){
           

            if(Auth::user()->isUserAtivo()){
                   $tipoEnte = TipoEntePublico::select('id','txt_tipo_ente_publico as nome')->get();
                     $usuario = Auth::user();
                     $ente = EntePublico::where('id',$usuario->ente_publico_id)->firstOrFail();
                     //return $dirigente = Dirigente::where('ente_publico_id',$ente->id)->firstOrFail();

                 $municipio = Municipio::join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                             ->select('txt_sigla_uf','ds_municipio')
                            ->where('tab_municipios.id',$ente->municipio_id)->firstOrFail();   

                $dataExtenso = convertaDataExtenso(getdate());

                    
            return view('views_selecao_beneficiarios.termo_responsabilidade_ente', compact('usuario', 'ente','municipio','dataExtenso'));
        }else{
            return redirect('/selecao_beneficiarios');
        }
        }

}


