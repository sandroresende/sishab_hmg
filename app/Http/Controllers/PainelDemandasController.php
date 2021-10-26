<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;

use App\ente_publico\EntePublico;
use App\ente_publico\Dirigente;
use App\ente_publico\DadosArquivoEntePublico;
use App\ente_publico\DemandaGerada;
use App\ente_publico\DemandaConsolidada;

class PainelDemandasController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
        
    }

    

    public function arquivosGerados(){

         $usuario = Auth::user();

        if(($usuario->tipo_usuario_id == 1) || ($usuario->tipo_usuario_id == 10)){
            $arquivosmunicipio = DadosArquivoEntePublico::where('tipo_arquivo_id', 1)->get();
             $arquivosmunicipio->load('tipoArquivo','user','entePublico','municipio.uf');
         return view('admin.arquivos_ente_publico',compact('usuario','ente','arquivosmunicipio' ));

        }else{
            flash()->erro("Erro", "Este usuário não tem permissão para acessar os dados deste arquivo");    
            return redirect('home');
        }

    }

    public function dadosArquivo($demandaGeradaId, $arquivoId){
        
        $demandaGerada = DemandaGerada::where('id', $demandaGeradaId)->get();
         $demandaConsolidada = DemandaConsolidada::where('demanda_gerada_id', $demandaGeradaId)->get();
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
        $arquivosMunicipioPrincipal = DadosArquivoEntePublico::where($where)->first();
          $arquivosMunicipioPrincipal->load('tipoArquivo','user','entePublico','municipio.uf');
       $where = [];
       $where[] = ['demanda_gerada_id', $demandaGeradaId];
       $where[] = ['tipo_arquivo_id', '>',1];
      $arquivosMunicipioComplemento = DadosArquivoEntePublico::where($where)->get();
      $arquivosMunicipioComplemento->load('tipoArquivo','user','entePublico');

    //   return $arquivosMunicipioPrincipal;
      if($demandaGerada->count() == 0){
           flash()->erro("Erro", "Ainda não existe demanda para esse ente.");    
           return redirect('entePublico');
       } else {
           
           return view('admin.demanda_gerada_ente',compact('usuario','ente','demandaGerada', 'arquivosMunicipioPrincipal',
                           'arquivosMunicipioComplemento','demandaConsolidada','totalDemanda'));
       }  
       
       
   }

   public function usuariosEntePublico(){
    
    $where = [];
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

    return view('admin.lista_usuarios_ente', compact('usuarios'));  
 
}

public function usuariosPrototipo(){
    
    $where = [];
    $where[] = ['modulo_sistema_id',3];   
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

    return view('admin.lista_usuarios_prototipo', compact('usuarios'));  
 
}

private function buscarUsuariosStatus($statusUsuarios){

    $where = [];
   
    $where[] = ['status_usuario_id',$statusUsuarios];   

    $usuarios = User::where($where)->get();

    
    $usuarios = $usuarios->load('tipoUsuario', 'statusUsuario','entePublico.municipio.uf');
    return $usuarios;          
    
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
    return view('admin.dados_usuario_admin', compact('usuario', 'idUsuarioLogado'));
} 

public function lista_entePublicos(Request $request){
    
   // return $request->all();
    $where = [];  
    
    if($request->estado){
         $where[] = ['tab_uf.id',$request->estado];   
    }
    
    if($request->municipio){
         $where[] = ['tab_municipios.id',$request->municipio];   
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
            return view('admin.lista_entes', compact('entePublicos'));  
        }else{    
            flash()->info('Informação', 'Não Existe Ente Público Ativo para os critérios selecionados', 'error');
            return back(); 
        }
    
 
}

public function dadosEntePublico(EntePublico $entePublico){ 
     $entePublico->load('municipio.uf');
      $dirigente = Dirigente::where('ente_publico_id', $entePublico->id)->first();
      $usuarios = User::where('ente_publico_id', $entePublico->id)->get();
     $usuarios->load('tipoUsuario','statusUsuario');

 return view('admin.dados_ente_publico', compact('entePublico','usuarios','dirigente')); 
}

public function filtroEntePublico(){
    return view('admin.consultaEntePublico'); 
}

}


