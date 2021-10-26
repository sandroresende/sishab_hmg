<?php

namespace App\Http\Controllers\ente_publico;

use Illuminate\Http\Request;
use App\Http\Requests\ente_publico\SalvarDirigente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\ente_publico\EntePublico;
use App\ente_publico\TipoEntePublico;
use App\ente_publico\Dirigente;
use App\StatusUsuario;


class DirigenteController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('entePublico');
    }

    public function cadastroDirigente(){

        if(Auth::user()->isUserAtivo()){
            $usuario = Auth::user();
            $ente = EntePublico::where('id',$usuario->ente_publico_id)->get();
    
            return view('ente_publico.cadastro_dirigente',compact('usuario','ente'));
        }else{
            return redirect('/entePublico');
        }
       
    }

    public function cadastrarDirigente(SalvarDirigente $request){
        //return $request->all();

        $ente = Auth::user()->ente_publico_id;
        $dirigente = new Dirigente;
        $dirigente->txt_nome_dirigente = $request->txt_nome_dirigente;
        $dirigente->txt_cargo_dirigente = $request->txt_cargo_dirigente;
        $dirigente->txt_cpf_dirigente = $request->txt_cpf_dirigente;
        $dirigente->txt_rg_dirigente = $request->txt_rg_dirigente;
        $dirigente->txt_orgao_expeditor_dirigente = $request->txt_orgao_expeditor_dirigente;
        $dirigente->txt_email_dirigente = $request->txt_email_dirigente;        
        $dirigente->bln_ativo = true;    
        $dirigente->ente_publico_id = $ente;    

        $dirigente->created_at = date("Y-m-d H:i:s");

        $salvouDirigente = $dirigente->save();

        if ($salvouDirigente){
            flash()->sucesso("Sucesso", "Dirigente cadastrado com sucesso!"); 
            return redirect('entePublico/termo');
        } else {
            flash()->erro("Erro", "Não foi possível cadastrar os dados do dirigente.");            
        }      

    }

    public function dirigenteEntePublico(){
        $ente = Auth::user()->ente_publico_id;
         $statusUsuario = StatusUsuario::where('id', "<",3)->get();
         $ente = Auth::user()->ente_publico_id;
         $statusUsuario = StatusUsuario::where('id', "<",3)->get();
         $where = [];
         $where[] = ['ente_publico_id',$ente];
         $where[] = ['bln_ativo', 1];
         $dirigente = Dirigente::where($where)->firstOrFail();

         return view('ente_publico.dados_dirigente',compact('dirigente','statusUsuario'));
         
    }
    
    public function atualizarDirigente(SalvarDirigente $request, Dirigente $dirigente){
        //return $request->all();
        
         $ente = Auth::user()->ente_publico_id;
         
         $dirigente->txt_nome_dirigente = $request->txt_nome_dirigente;
         $dirigente->txt_cargo_dirigente = $request->txt_cargo_dirigente;
         $dirigente->txt_cpf_dirigente = $request->txt_cpf_dirigente;
         $dirigente->txt_rg_dirigente = $request->txt_rg_dirigente;
         $dirigente->txt_orgao_expeditor_dirigente = $request->txt_orgao_expeditor_dirigente;
         $dirigente->txt_email_dirigente = $request->txt_email_dirigente;        
         if($request->bln_ativo == 1){
             $status = true;
            } else {
                $status = false;
            }

         $dirigente->bln_ativo = $status;    
         $dirigente->ente_publico_id = $ente;    
 
         $dirigente->created_at = date("Y-m-d H:i:s");
 
         //return $dirigente;
         $salvouDirigente = $dirigente->save();
 
         if ($salvouDirigente){
             flash()->sucesso("Sucesso", "Dados do Dirigente atualizado com sucesso!"); 
             return redirect('entePublico/dirigente');
         } else {
             flash()->erro("Erro", "Não foi possível atual;izar os dados do dirigente.");            
         }  
        }

}


