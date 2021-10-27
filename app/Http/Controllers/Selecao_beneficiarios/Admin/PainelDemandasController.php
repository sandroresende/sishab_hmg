<?php

namespace App\Http\Controllers\Selecao_beneficiarios\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;

use App\Mod_selecao_demanda\EntePublico;
use App\Mod_selecao_demanda\Dirigente;
use App\Mod_selecao_demanda\DadosArquivoEntePublico;
use App\Mod_selecao_demanda\DemandaGerada;
use App\Mod_selecao_demanda\DemandaConsolidada;

class PainelDemandasController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
        
    }

    
    
    public function filtroArquivosGerados(){
        return view('views_selecao_beneficiarios.admin.filtro_arquivos_gerados');
    }

    public function arquivosGerados(Request $request){

        $where = [];
        $subtitulo1 = 'Brasil';
        $estado = [];
            //inicio if 5
            if($request->estado){
                $where[] = ['uf_id', $request->estado];
                $estado = Uf::where('id',$request->estado)->firstOrFail();       
                $subtitulo1 = $estado->txt_uf;   
            }//fim if 5
    
            $municipio = [];
            //inicio if 6
            if($request->municipio){
                $where[] = ['tab_municipios.id', $request->municipio];
                $municipio = Municipio::where('id',$request->municipio)->firstOrFail();    
                $subtitulo1 = trim($municipio->ds_municipio).'/'.$estado->txt_sigla_uf;
            }//fim if 6


         $usuario = Auth::user();

        if(($usuario->tipo_usuario_id == 1) || ($usuario->tipo_usuario_id == 10)){
            
             $arquivosmunicipio = DadosArquivoEntePublico::leftjoin('tab_municipios','tab_dados_arquivo_ente_publico.municipio_id', '=','tab_municipios.id')
                                                            ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                                            ->leftjoin('tab_ente_publico','tab_dados_arquivo_ente_publico.ente_publico_id', '=','tab_ente_publico.id')
                                                            ->leftjoin('opc_tipo_arquivo_demanda','tab_dados_arquivo_ente_publico.tipo_arquivo_id', '=','opc_tipo_arquivo_demanda.id')
                                                            ->leftjoin('users','tab_dados_arquivo_ente_publico.user_id', '=','users.id')
                                                            ->select('tab_uf.txt_sigla_uf','ds_municipio','txt_ente_publico','tab_dados_arquivo_ente_publico.id','txt_tipo_arquivo',
                                                                    'name','tab_dados_arquivo_ente_publico.*')
                                                            ->where($where)
                                                            ->orderBy('txt_sigla_uf', 'asc')
                                                            ->orderBy('ds_municipio', 'asc')
                                                            ->where('tipo_arquivo_id','<=', 2)->get();

            $dataAtualizacao = $arquivosmunicipio->max('created_at')->toArray();
            
            

         return view('views_selecao_beneficiarios.admin.arquivos_ente_publico',compact('usuario','ente','arquivosmunicipio','subtitulo1','dataAtualizacao' ));

        }else{
            flash()->erro("Erro", "Este usuário não tem permissão para acessar os dados deste arquivo");    
            return redirect('home');
        }

    }

    public function dadosArquivo($demandaGeradaId, $arquivoId){
        

         $demandaGerada = DemandaGerada::find($demandaGeradaId);
        $ente = EntePublico::find($demandaGerada->ente_publico_id);
         $municipio = Municipio::where('id',$ente->municipio_id)->firstOrFail();
        $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();

        $demandaConsolidada = DemandaConsolidada::where('municipio_id', $demandaGerada->municipio_id)->get();
         $demandaConsolidada->load('operacoesContratadas');

       $totalDemanda = ['num_empreendimento'=> 0,
                        'num_contratadas'=> 0,
                        'num_entregues'=> 0];

      foreach($demandaConsolidada as $dados){
          $totalDemanda['num_empreendimento'] += 1;
          $totalDemanda['num_contratadas'] += $dados->operacoesContratadas->qtd_uh_contratadas;
          $totalDemanda['num_entregues'] += $dados->operacoesContratadas->qtd_uh_entregues;
      }                          

      //return $totalDemanda;

       $where = [];
       $where[] = ['demanda_gerada_id', $demandaGeradaId];
       $where[] = ['tipo_arquivo_id', 1];
      
        $arquivosMunicipioPrincipal = DadosArquivoEntePublico::leftjoin('tab_municipios','tab_dados_arquivo_ente_publico.municipio_id', '=','tab_municipios.id')
                                                                   ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                                                   ->leftjoin('tab_ente_publico','tab_dados_arquivo_ente_publico.ente_publico_id', '=','tab_ente_publico.id')
                                                                   ->leftjoin('opc_tipo_arquivo_demanda','tab_dados_arquivo_ente_publico.tipo_arquivo_id', '=','opc_tipo_arquivo_demanda.id')
                                                                   ->leftjoin('users','tab_dados_arquivo_ente_publico.user_id', '=','users.id')
                                                                   ->select('tab_uf.txt_sigla_uf','ds_municipio','txt_ente_publico','tab_dados_arquivo_ente_publico.id','txt_tipo_arquivo',
                                                                           'name','tab_dados_arquivo_ente_publico.*')
                                                                   ->orderBy('txt_sigla_uf', 'asc')
                                                                   ->orderBy('ds_municipio', 'asc')
                                                                   ->where($where)->first();

      // DadosArquivoEntePublico::where($where)->first();
      //   $arquivosMunicipioPrincipal->load('tipoArquivo','user','entePublico','municipio.uf');
      $where = [];
      $where[] = ['demanda_gerada_id', $demandaGeradaId];
      $where[] = ['tipo_arquivo_id', '>',1];
       $arquivosMunicipioComplemento = DadosArquivoEntePublico::leftjoin('tab_municipios','tab_dados_arquivo_ente_publico.municipio_id', '=','tab_municipios.id')
                                                                   ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                                                   ->leftjoin('tab_ente_publico','tab_dados_arquivo_ente_publico.ente_publico_id', '=','tab_ente_publico.id')
                                                                   ->leftjoin('opc_tipo_arquivo_demanda','tab_dados_arquivo_ente_publico.tipo_arquivo_id', '=','opc_tipo_arquivo_demanda.id')
                                                                   ->leftjoin('users','tab_dados_arquivo_ente_publico.user_id', '=','users.id')
                                                                   ->select('tab_uf.txt_sigla_uf','ds_municipio','txt_ente_publico','tab_dados_arquivo_ente_publico.id','txt_tipo_arquivo',
                                                                           'name','tab_dados_arquivo_ente_publico.*')
                                                                   ->orderBy('txt_sigla_uf', 'asc')
                                                                   ->orderBy('ds_municipio', 'asc')
                                                                   ->where($where)->get();

   //   return $arquivosMunicipioPrincipal;
     if($demandaGerada->count() == 0){
          flash()->erro("Erro", "Ainda não existe demanda para esse ente.");    
          return redirect('entePublico');
      } else {
          
          return view('views_selecao_beneficiarios.admin.demanda_gerada_ente',compact('usuario','ente','demandaGerada', 'arquivosMunicipioPrincipal',
                          'arquivosMunicipioComplemento','demandaConsolidada','totalDemanda','municipio','estado'));
      }  
  }

    public function filtroEntePublico(){
        return view('views_selecao_beneficiarios.admin.filtroEntePublico'); 
    }

    public function lista_entePublicos(Request $request){
    
        // return $request->all();
         $where = [];  
         $subtitulo1 = 'BRASIL';
         if($request->estado){
              $where[] = ['tab_uf.id',$request->estado];   
              $estado = Uf::where('id',$request->estado)->firstOrFail();
              $subtitulo1 = $estado->txt_uf;
         }
         
         if($request->municipio){
              $where[] = ['tab_municipios.id',$request->municipio];   
              $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
              $subtitulo1 = trim($municipio->ds_municipio) .'/'. $estado->txt_sigla_uf;
         }
         
         
            $entePublicos = EntePublico::leftjoin('tab_municipios','tab_ente_publico.municipio_id', '=','tab_municipios.id')
                                 ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                 ->leftjoin('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id') 
                                 ->leftjoin('opc_tipo_ente_publico', 'tab_uf.regiao_id', '=', 'opc_tipo_ente_publico.id') 
                                 ->join('users', 'tab_ente_publico.id', '=', 'users.ente_publico_id') 
                                 ->selectRaw('txt_sigla_uf, ds_municipio,txt_regiao,tab_ente_publico.id as ente_publico_id,txt_ente_publico,
                                             txt_email_ente_publico, count(users.id) as usuarios')
                                 ->where($where)            
                                 ->groupBy('txt_sigla_uf', 'ds_municipio','txt_regiao','tab_ente_publico.id','txt_ente_publico','txt_email_ente_publico')
                                 ->orderBy('txt_sigla_uf', 'asc')
                                 ->orderBy('ds_municipio', 'asc')
                                 ->get();
     
                                 
             if($entePublicos->count() > 0){
                 return view('views_selecao_beneficiarios.admin.lista_entes', compact('entePublicos','subtitulo1'));  
             }else{    
                 flash()->info('Informação', 'Não Existe Ente Público para os critérios selecionados', 'error');
                 return back(); 
             }
     }

     public function dadosEntePublico(EntePublico $entePublico){ 
            $entePublico->load('municipio.uf');
            $dirigente = Dirigente::where('ente_publico_id', $entePublico->id)->first();
            $usuarios = User::where('ente_publico_id', $entePublico->id)->get();
            $usuarios->load('tipoUsuario','statusUsuario');
    
        return view('views_selecao_beneficiarios.admin.dados_ente_publico', compact('entePublico','usuarios','dirigente')); 
    }
    public function filtroUsuariosEntePublico(){
        return view('views_selecao_beneficiarios.admin.filtroUsuariosEnte');         
    }

    public function usuariosEntePublico(Request $request){
    
       
        $where = [];
        
         $subtitulo1 = 'BRASIL';
         if($request->estado){
              $where[] = ['tab_uf.id',$request->estado];   
              $estado = Uf::where('id',$request->estado)->firstOrFail();
              $subtitulo1 = $estado->txt_uf;
         }
         
         if($request->municipio){
              $where[] = ['tab_municipios.id',$request->municipio];   
              $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
              $subtitulo1 = trim($municipio->ds_municipio) .'/'. $estado->txt_sigla_uf;
         }

        $where[] = ['modulo_sistema_id',2];   
       // $where[] = ['tipo_usuario_id',9];   
    
         $usuarios = User::leftjoin('opc_tipo_usuario','users.tipo_usuario_id', '=','opc_tipo_usuario.id')
                                ->leftjoin('opc_status_usuario','users.status_usuario_id', '=','opc_status_usuario.id')
                                ->leftjoin('tab_ente_publico','users.ente_publico_id', '=','tab_ente_publico.id')
                                ->leftjoin('tab_municipios','tab_ente_publico.municipio_id', '=','tab_municipios.id')
                                ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                ->leftjoin('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id') 
                                ->select('txt_sigla_uf','ds_municipio','txt_regiao','txt_ente_publico','users.id as usuario_id',
                                         'email','name','txt_tipo_usuario','txt_status_usuario','dte_aceite_termo')
                                ->orderBy('txt_sigla_uf', 'asc')
                                ->orderBy('ds_municipio', 'asc')
                                ->orderBy('name', 'asc')
                                ->where($where)->get();

        if($usuarios->count() > 0){
            return view('views_selecao_beneficiarios.admin.lista_usuarios_ente', compact('usuarios','subtitulo1'));  
        }else{    
            flash()->info('Informação', 'Não Existe Usuários ou responsáveis para os critérios selecionados', 'error');
            return back(); 
        }
    }

    public function dadosUsuario(Request $request, User $usuario){           
        
        $usuarioLogado = Auth::user();
        $idUsuarioLogado = $usuarioLogado->id;
       // Auth::user()->ente_publico_id;                                                                                                                                                                                                                                                                                            ;
       if($usuarioLogado->tipo_usuario_id != 1){
           flash()->erro('Acesso negado', 'Você não possui acesso aos dados desse Usuário', 'error');
           return back(); 
       }
       
       $usuario = $usuario->load('tipoUsuario', 'statusUsuario');
       return view('views_selecao_beneficiarios.admin.dados_usuario_admin', compact('usuario', 'idUsuarioLogado'));
   } 
}


