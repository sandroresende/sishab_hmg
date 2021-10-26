<?php

namespace App\Http\Controllers\prototipo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;

use App\Permissoes;
use App\StatusPermissoes;

class PainelPrototipoController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
        
    }

    

public function usuariosPrototipo(){
    
    $where = [];
    $where[] = ['users.modulo_sistema_id',3];   
   // $where[] = ['tipo_usuario_id',9];   

     $usuarios = User::leftjoin('opc_tipo_usuario','users.tipo_usuario_id', '=','opc_tipo_usuario.id')
                            ->leftjoin('opc_status_usuario','users.status_usuario_id', '=','opc_status_usuario.id')
                            ->leftjoin('tab_ente_publico','users.ente_publico_id', '=','tab_ente_publico.id')
                            ->leftjoin('tab_municipios','tab_ente_publico.municipio_id', '=','tab_municipios.id')
                            ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                            ->leftjoin('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id') 
                            ->leftjoin('tab_permissoes','users.id', '=','tab_permissoes.user_id')
                            ->leftjoin('opc_status_permissao','tab_permissoes.status_permissao_id', '=','opc_status_permissao.id')
                            ->select('txt_sigla_uf','ds_municipio','txt_regiao','txt_ente_publico','users.id as usuario_id',
                                     'email','name','txt_tipo_usuario','txt_status_usuario','dte_aceite_termo','txt_status_permissao')
                            ->orderBy('txt_sigla_uf', 'asc')
                            ->orderBy('ds_municipio', 'asc')
                            ->orderBy('name', 'asc')
                            ->where($where)->get();

    return view('admin.lista_usuarios_prototipo', compact('usuarios'));  
 
}

public function listaPermissoes(){

       $permissoes = Permissoes::join('users','users.id','=','tab_permissoes.user_id')
                                    ->leftjoin('tab_ente_publico_proponente','users.ente_publico_id', '=','tab_ente_publico_proponente.id')
                                    ->leftjoin('tab_municipios','tab_ente_publico_proponente.municipio_id', '=','tab_municipios.id')
                                    ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                    ->leftjoin('opc_status_permissao','tab_permissoes.status_permissao_id', '=','opc_status_permissao.id')
                                    ->select('txt_sigla_uf','ds_municipio','txt_ente_publico','users.txt_cpf_usuario',
                                     'email','name','txt_status_permissao','tab_permissoes.*')
                            ->orderBy('txt_sigla_uf', 'asc')
                            ->orderBy('ds_municipio', 'asc')
                            ->orderBy('name', 'asc')
                                    ->get();

     $cabecalhoTabAnalise = ['UF','Município', 'Proponente','CPF','Nome','Data Solicitação'];

     $cabecalhoTab = ['UF','Município', 'Proponente','CPF','Nome','Data Solicitação','Data Análise','Analisada Por'];

     $permissoesAnalise =  [];
     $permissoesDeferida = [];
     $permissoesIndeferida = [];
     $permissoesCancelada = [];

  

     foreach($permissoes as $permissao){
        $dados = [];
        if($permissao->status_permissao_id == 1){
            
            $dados['txt_sigla_uf'] = $permissao->txt_sigla_uf;
            $dados['ds_municipio'] = $permissao->ds_municipio;
            $dados['txt_ente_publico'] = $permissao->txt_ente_publico;
            $dados['txt_cpf_usuario'] = $permissao->txt_cpf_usuario;
            $dados['name'] = $permissao->name;
            $dados['created_at'] = date("d/m/Y", strtotime($permissao->created_at));
            $dados['id'] = $permissao->id;

            array_push($permissoesAnalise, $dados);            
        }
        
        
        
        
     }   
     

    return view('prototipo.permissoes_prototipo ',compact('permissoesAnalise','permissoesDeferida','permissoesIndeferida','permissoesCancelada','cabecalhoTabAnalise','cabecalhoTab'));

}

}


