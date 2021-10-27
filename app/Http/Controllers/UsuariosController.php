<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests\Mod_selecao_demanda\SalvarUsuario;
use App\Http\Requests\Mod_selecao_demanda\SalvarUsuarioEnte;
use Illuminate\Support\Facades\Auth;

use App\User;
use Config\App;
use App\StatusUsuario;
use App\TipoUsuario;
use App\Mod_selecao_demanda\EntePublico;
use App\Mod_prototipo\EntePublicoProponente;

use App\ModuloSistema;


class UsuariosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
       // $this->middleware('entePublico');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

    }

    public function cadastroUsuario()
    {
        return view('views_selecao_beneficiarios.cadastrar_usuario');
    }

    public function cadastroUsuarioEnte()
    {
         $entes = EntePublico::get();
         $modulos = ModuloSistema::get();
        
        return view('views_selecao_beneficiarios.cadastrar_usuario_ente', compact('entes', 'modulos','tipoUsuarios'));
    }

    public function salvarUsuario(SalvarUsuario $request)
    {

        $request->all();
        $ente = Auth::user()->ente_publico_id;


        $usuario = new User;
        $usuario->txt_cpf_usuario = $request->txt_cpf_usuario;
        $usuario->name = $request->txt_nome;
        $usuario->email = $request->email;
        $usuario->tipo_usuario_id = 9;
        $usuario->modulo_sistema_id = 2;
        $usuario->ente_publico_id = $ente;
        $usuario->status_usuario_id = 2;
        $usuario->password = bcrypt('123456');
       
        $salvoComSucesso = $usuario->save();

        if ($salvoComSucesso){
            flash()->sucesso("Sucesso", "Usuário cadastrado com sucesso!"); 
            return redirect('/selecao_beneficiarios/usuarios');
        } else {
            flash()->erro("Erro", "Não foi possível cadastrar os dados do usuário.");            
        }  
        // return view('views_selecao_beneficiarios.cadastrar_usuario');
    }

    public function salvarUsuarioEnte(Request $request)
    {

        // return $request->all();

        if($request->modulo_sistema == 2){
            $ente = $request->ente_publico_id;
            $status_usuario = 2;
        }else if($request->modulo_sistema == 3){
            $ente = $request->txt_cnpj;
            $status_usuario = 2;
        }else{
            $ente = null;
            $status_usuario = 1;
        }
        
        DB::beginTransaction();

        $usuario = new User;
        $usuario->name = $request->txt_nome;
        $usuario->email = $request->txt_email;
        $usuario->tipo_usuario_id = $request->tipo_usuario;
        $usuario->modulo_sistema_id = $request->modulo_sistema;
        $usuario->ente_publico_id = $ente;
        $usuario->status_usuario_id = $status_usuario;
        $usuario->created_at = Date("Y-m-d h:i:s");
        if($request->modulo_sistema == 3){
            $usuario->txt_cpf_usuario = $request->txt_cpf_usuario;
            $usuario->txt_cargo = $request->txt_cargo;
            $usuario->txt_ddd_fixo = $request->txt_ddd_fixo;
            $usuario->txt_telefone_fixo = $request->txt_telefone_fixo;
            $usuario->txt_ddd_movel = $request->txt_ddd_movel;
            $usuario->txt_telefone_movel = $request->txt_telefone_movel;
           
        }    
        $usuario->password = bcrypt('123456');
       
        $salvoComSucessoUsu = $usuario->save();
        if($request->modulo_sistema == 3){
            $entePublico = new EntePublicoProponente;
            $entePublico->id = $ente;
            $entePublico->txt_ente_publico = $request->txt_ente_publico;
            $entePublico->txt_email_ente_publico = $request->txt_email;
            $entePublico->tipo_proponente_id = $request->tipo_ente_publico;
            $entePublico->municipio_id = $request->municipio;
            $entePublico->txt_nome_chefe_executivo = $request->txt_nome_chefe_executivo;
            $entePublico->txt_cargo_executivo = $request->cargo_executivo;
            $entePublico->created_at = Date("Y-m-d h:i:s");
            $salvoComSucessoEnte = $entePublico->save();
        }else{
            $salvoComSucessoEnte = true;
        }   



        if (!$salvoComSucessoUsu || !$salvoComSucessoEnte){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados do usuário.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Usuário cadastrado com sucesso!"); 
            return redirect('admin/usuario/' . $usuario->id);
            
        }  
    }    

    public function excluirUsuario(Request $request, User $usuario){
        
        $usuario->status_usuario_id = 3;
        $usuario->bln_ativo = false;
        $usuario->updated_at = Date("Y-m-d h:i:s");
        
        if($usuario->save()){
           
            flash()->sucesso('Usuário excluído com sucesso!', $usuario->name);
           
            
        }else{
            flash()->erro('Sem permissão', 'Este usuário não pertence à sua insituição!');
        }

        
        return redirect('selecao_beneficiarios/usuarios');
           
    
    }
    public function usuariosEntePublico(){

        if(Auth::user()->tipo_usuario_id == 8){
             $usuariosAtivos = $this->buscarUsuariosStatus(1);
             $usuariosInativos = $this->buscarUsuariosStatus(2);
            $usuariosExcluidos = $this->buscarUsuariosStatus(3);

           $numUsuarios = Auth::user()->getNumUsuarios(Auth::user()); 
            //return $usuariosInativos->count();
            return view('views_selecao_beneficiarios.usuarios_ente_publico', compact('usuariosAtivos', 'usuariosInativos', 
                    'usuariosExcluidos','numUsuarios'));  
        }else{
            flash()->erro('Acesso negado', 'Você não possui acesso aos dados dos Usuários', 'error');
            return back(); 
        }
    }

    private function buscarUsuariosStatus($statusUsuarios){

        $where = [];
        if((Auth::user()->tipo_usuario_id == 8) || (Auth::user()->tipo_usuario_id == 9)){
            $where[] = ['ente_publico_id',Auth::user()->ente_publico_id];  
        }
         
        $where[] = ['tipo_usuario_id',9];   
        $where[] = ['status_usuario_id',$statusUsuarios];   

        $usuarios = User::where($where)->get();

        
        $usuarios = $usuarios->load('tipoUsuario', 'statusUsuario');
        return $usuarios;          
        
}

public function dadosUsuario(Request $request, User $usuario){           
        
     $idUsuarioLogado = Auth::user()->id;
    // Auth::user()->ente_publico_id;                                                                                                                                                                                                                                                                                            ;
    if($usuario->ente_publico_id != Auth::user()->ente_publico_id){
        flash()->erro('Acesso negado', 'Você não possui acesso aos dados desse Usuário', 'error');
        return back(); 
    }
    
    $usuario = $usuario->load('tipoUsuario', 'statusUsuario');
    return view('views_gerais.dados_usuario', compact('usuario', 'idUsuarioLogado'));
}  

public function listaUsuarios(){

    if(Auth::user()->tipo_usuario_id == 1){
        $usuariosAtivos = $this->buscarUsuariosStatus(1);
         $usuariosInativos = $this->buscarUsuariosStatus(2);
        $usuariosExcluidos = $this->buscarUsuariosStatus(3);

        //return $usuariosInativos->count();
        return view('views_selecao_beneficiarios.usuarios_ente_publico', compact('usuariosAtivos', 'usuariosInativos', 'usuariosExcluidos'));  
    }else{
        flash()->erro('Acesso negado', 'Você não possui acesso aos dados dos Usuários', 'error');
        return back(); 
    }
}


public function updateUsuario(Request $request, $usuario)
    {

         //return $request->all();

       
        DB::beginTransaction();

        $usuario = User::find($usuario);
        $usuario->name = $request->txt_nome;
        $usuario->txt_cargo = $request->txt_cargo;
        $usuario->txt_ddd_fixo = $request->txt_ddd_fixo;
        $usuario->txt_telefone_fixo = $request->txt_telefone_fixo;
        $usuario->txt_ddd_movel = $request->txt_ddd_movel;
        $usuario->txt_telefone_movel = $request->txt_telefone_movel;
        $usuario->txt_telefone_movel = $request->txt_telefone_movel;
        $usuario->updated_at = Date("Y-m-d h:i:s");
               
        $salvoComSucessoUsu = $usuario->save();
   



        if (!$salvoComSucessoUsu){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar os dados do responsável.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados Atualizados com sucessocom sucesso!"); 
        }  
        return back(); 
    }   

}

