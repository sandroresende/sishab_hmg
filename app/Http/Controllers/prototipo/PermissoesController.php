<?php

namespace App\Http\Controllers\Prototipo;

use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


use App\User;

use Illuminate\Support\Facades\Mail;
use App\Mail\NovoUsuario;
use App\Mail\NovoOficio;
use App\Mail\PermissaoDeferida;
use App\Mail\PermissaoIndeferida;

use App\Mod_prototipo\Permissoes;
use App\Mod_prototipo\StatusPermissao;

use App\Mod_prototipo\TipoIndeferimento;
use App\Mod_prototipo\EntePublicoProponente;

use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;

class PermissoesController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
        
    }

    


public function deferirPermissao(Permissoes $permissao){

    return view('prototipo.deferir_permissao',compact('permissao'));

}



public function deferirPendencia(Permissoes $permissao){

    //  return $request;
    
      DB::beginTransaction();
     // $permissao = Permissoes::find($request->permissao_id);
           $usuario = Auth::user();
          
           
  
          $permissao->status_permissao_id = 2;
          $permissao->bln_analisada = true;
          $permissao->dte_analise = Date("Y-m-d h:i:s");
          $permissao->usuario_id_analise = $usuario->id; 
  
          
  
          $salvouPermissao = $permissao->save();
  
         $permissao->load('user');
  
          if (!$salvouPermissao){   
              DB::rollBack();
              flash()->erro("Erro", "Não foi possível deferir a permissão.");            
          } else {
              Mail::to($permissao->user->email)->send(new PermissaoDeferida($permissao));
             
              DB::commit();
              flash()->sucesso("Sucesso", "Permissão deferida com sucesso"); 
  
             // return redirect()->back()->with('mensagem','Credenciais não são válidas');
  
  
              return redirect('admin/permissoes/prototipos/'); 
              
          } 
  
  }

public function salvarDeferimento(Request $request){

  //  return $request;
  
    DB::beginTransaction();
    $permissao = Permissoes::find($request->permissao_id);
         $usuario = Auth::user();
        
         

        $permissao->status_permissao_id = $request->tipo_deferimento;
        $permissao->txt_observacao = $request->txt_observacao;
        $permissao->bln_analisada = true;
        $permissao->dte_analise = Date("Y-m-d h:i:s");
        $permissao->usuario_id_analise = $usuario->id; 

        

        $salvouPermissao = $permissao->save();

       $permissao->load('user');

        if (!$salvouPermissao){   
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível deferir a permissão.");            
        } else {
           // Mail::to($permissao->user->email)->send(new PermissaoDeferida($permissao));
           
            DB::commit();
            flash()->sucesso("Sucesso", "Permissão deferida com sucesso"); 

           // return redirect()->back()->with('mensagem','Credenciais não são válidas');


            return redirect('admin/permissoes/prototipos/'); 
            
        } 

}

public function abrirIndeferirPermissao(Permissoes $permissao){

    //return $permissao;
    
     $tipo_indeferimento = TipoIndeferimento::select('id as tipo_indeferimento_id', 'txt_tipo_indeferimento as nome')->orderBy('txt_tipo_indeferimento')->get();
    
    return view('prototipo.indeferir_permissao ',compact('permissao','tipo_indeferimento'));

}

public function indeferirPermissao(Request $request){

    //return $request->all();
         $permissao = Permissoes::find($request->permissao_id);
    DB::beginTransaction();


        $usuario = Auth::user();

        $permissao->status_permissao_id = 3;
        $permissao->bln_analisada = true;
        $permissao->dte_analise = Date("Y-m-d h:i:s");
        $permissao->usuario_id_analise = $usuario->id; 
        $permissao->tipo_indeferimento_id = $request->tipo_indeferimento; 
        if($request->outro_tipo_indeferimento){
            $permissao->txt_outro_tipo_indeferimento = $request->outro_tipo_indeferimento; 
        }    
        $permissao->txt_observacao = $request->txt_observacao; 

        $salvouPermissao = $permissao->save();

         $permissao->load('user','tipoIndeferimento');

        if (!$salvouPermissao){   
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível indeferir a permissão.");            
        } else {
            Mail::to($permissao->user->email)->send(new PermissaoIndeferida($permissao));
            DB::commit();
            flash()->sucesso("Sucesso", "Permissão indeferida com sucesso"); 

            return redirect('admin/permissoes/prototipos/'); 
            
        } 

    }

    public function bloquearPermissao(Permissoes $permissao){

        DB::beginTransaction();
    
            $usuario = Auth::user();
    
            $permissao->status_permissao_id = 4;
            $permissao->bln_analisada = true;
            $permissao->dte_analise = Date("Y-m-d h:i:s");
            $permissao->usuario_id_analise = $usuario->id; 
    
            $salvouPermissao = $permissao->save();
    
            if (!$salvouPermissao){   
                DB::rollBack();
                flash()->erro("Erro", "Não foi possível bloquear a permissão.");            
            } else {
                DB::commit();
                flash()->sucesso("Sucesso", "Permissão bloqueada com sucesso"); 
    
               return redirect('admin/permissoes/prototipos/'); 
                
            } 
    
    }

    public function desbloquearPermissao(Permissoes $permissao){

        DB::beginTransaction();
    
            $usuario = Auth::user();
    
            $permissao->status_permissao_id = 2;
            $permissao->bln_analisada = true;
            $permissao->dte_analise = Date("Y-m-d h:i:s");
            $permissao->usuario_id_analise = $usuario->id; 
    
            $salvouPermissao = $permissao->save();
    
            if (!$salvouPermissao){   
                DB::rollBack();
                flash()->erro("Erro", "Não foi possível bloquear a permissão.");            
            } else {
                DB::commit();
                flash()->sucesso("Sucesso", "Permissão bloqueada com sucesso"); 
    
                return redirect('admin/permissoes/prototipos/'); 
                
            } 
    
    }

    public function NovaPermissao(){
        
        $usuario = Auth::user();
        $wherePermissao = [];
          $wherePermissao[] = ['user_id',$usuario->id];    
          $wherePermissao[] = ['status_permissao_id','<=',2];   

          $permissaoDeferida = Permissoes::where($wherePermissao)->count();

          if ($permissaoDeferida > 0){   
            
            flash()->erro("Erro", "Não é possível solicitar mais permissões.  Já existe permissão Em Análise ou Deferida.");   
            return back();         
        } else {      
            
            return view('prototipo.cadastrar_nova_permissao ');
        }    
         
        

    }    

    public function salvarNovoOficio(Request $request){
        //return  $request->all();
            
        $usuario = Auth::user();
      
        $usuario->load('entePublicoProponente');
        DB::beginTransaction();

         $municipio = $usuario->entePublicoProponente->municipio_id;

        if($request->file('txt_caminho_oficio')){
            $nomeArqOficio = 'arqOficio-'.$municipio.'-'.str_replace("-", "", Date("Y-m-d")).str_replace(":", "", Date("H:i:s")).'.'.$request->file('txt_caminho_oficio')->extension();
            $path_arquivo = public_path().'/uploads_arquivos/prototipo/oficios/'.$municipio;
                
            if(!File::isDirectory($path_arquivo)){
                File::makeDirectory($path_arquivo, 0777, true, true);
            }
            $caminho_oficio = $request->file('txt_caminho_oficio')->storeAs('/uploads_arquivos/prototipo/oficios/'.$municipio, $nomeArqOficio, 'arquivos');  

            $tipoAquivo = $request->file('txt_caminho_oficio')->getMimeType();
            if(!verificaTipoArquivo($tipoAquivo)){
                DB::rollBack();
                flash()->erro("Erro", "Tipo de arquivo inválido! Selecione um arquivo com a extensão correta (.jpeg, .png, .pdf)"); 
                return 'back()';
            }
        }

        $permissoes = new Permissoes;
        $permissoes->user_id = $usuario->id;   
        $permissoes->modulo_sistema_id = 3;   
        $permissoes->status_permissao_id = 1;   
        $permissoes->caminho_oficio = $caminho_oficio;   
        $permissoes->txt_nome_oficio = $nomeArqOficio;   
        $permissoes->bln_analisada = false;   
        $permissoes->modalidade_participacao_id = $usuario->modalidade_participacao_id;  

       // return $permissoes;
        $salvoComSucessoPermissoes = $permissoes->save();

        $permissoes->load('user');

    if ( $salvoComSucessoPermissoes){   
        Mail::to($usuario->email)->send(new NovoOficio($usuario, $permissoes));         
        DB::commit();
        flash()->sucesso("Sucesso", "Ofício enviado com sucesso!"); 
        return redirect('prototipo/permissoes'); 
        
    } else {
        DB::rollBack();
        flash()->erro("Erro", "Erro enviar so ofício!"); 
        return back();
        
    }  

}   
}


