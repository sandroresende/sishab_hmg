<?php

namespace App\Http\Controllers\ente_publico;

use Illuminate\Http\Request;
use App\Http\Requests\ente_publico\SalvarDirigente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\ente_publico\VisualizacaoLegislacao;

use App\StatusUsuario;
use App\ente_publico\Legislacao;
use App\ente_publico\TipoEntePublico;
use App\ente_publico\EntePublico;
//use App\ente_publico;



class AceiteLegislacaoController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('entePublico');
    }

    public function index()
    {
       

          $usuario = Auth::User();
          $tipoEnte = TipoEntePublico::select('id','txt_tipo_ente_publico as nome')->get();
          
            $ente = EntePublico::where('id',$usuario->ente_publico_id)->get();
         $dte_aceite_termo  =  strtotime($usuario->dte_aceite_termo);   
         $dte_aceite_termo = date('d/m/Y H:i:s', $dte_aceite_termo);
       	  $legislacao = $this->buscar_legislacao();
          $usuario->load('visualizacoes');

           $legislacaoObrigatoria = VisualizacaoLegislacao::join('opc_legislacao', 'opc_legislacao.id', '=','tab_visualizacao_legislacao.legislacao_id')
                                          ->select('tab_visualizacao_legislacao.*') 
                                          ->where([["user_id" , Auth::user()->id],["bln_leitura_obrigatoria" , true]])
                                          ->get();
        
       // return $legislacaoObrigatoria;
        //usort($legislacao, 'id');
        if(Auth::user()->isUserAtivo()){
            return view('ente_publico.documentos_especificacoes' ,compact('usuario', 'legislacao', 'legislacaoObrigatoria','dte_aceite_termo'));        
        }
        else
            {
                
                return view('ente_publico.cadastro_ente_publico', compact('usuario','ente','tipoEnte'));
                
                
            }
    }

    private function buscar_legislacao(){
        
        $usuario = Auth::User();

         $usuario = $usuario->load('visualizacoes');
        $legislacao = Legislacao::orderBy('id')->get();
        $legislacao->data_visualizacao = '';
        

            $usuario = $usuario->load('visualizacoes.legislacao');
            $legislacaoVisualizadas = [];

            foreach ($legislacao as $legis) {
                foreach($usuario->visualizacoes as $visualizacao){
                    if($visualizacao->legislacao_id == $legis->id){
                        $legis->data_visualizacao = $visualizacao->updated_at;	      				
                        $legis->bln_visualizacao = true;	      				
                    }
                }
                $legislacaoVisualizadas[] = $legis;
            }
            return $legislacaoVisualizadas;
    }

    public function visualizarLegislacao(Request $request, Legislacao $legislacao){
    	  $visualizacao = VisualizacaoLegislacao::where([
    			["user_id" , Auth::user()->id],
    			["legislacao_id" , $legislacao->id]
    			])->get();

                $numLegObrigatoria =  $legislacaoObrigatoria = Legislacao::where("bln_leitura_obrigatoria" , true)->count();
       // return count($visualizacao);
        
        
        
        if(count($visualizacao) < $numLegObrigatoria) {
            $visualizacaoLegislacao = new VisualizacaoLegislacao;
            $visualizacaoLegislacao->legislacao_id = $legislacao->id;    		
            $visualizacaoLegislacao->user_id = Auth::user()->id; 
            $visualizacaoLegislacao->bln_visualizado = true;
            $novaData = date("Y-m-d h:m:s");
            $visualizacaoLegislacao->updated_at = $novaData;
            //return $visualizacaoLegislacao;
            $visualizacaoLegislacao->save();  

            $visualizacao = VisualizacaoLegislacao::where([
    			["user_id" , Auth::user()->id],
    			["legislacao_id" , $legislacao->id]
    			])->get();

           


        } 

        if(count($visualizacao) == $numLegObrigatoria) {
                $usuario = Auth::user();
                
                $usuario->bln_visualizar_documentos = true;
             $usuario->save();
                
                $numUsuarios = Auth::user()->getNumUsuarios($usuario); 
                

                return view('ente_publico.painel_ente_publico', compact('usuario','numUsuarios'));
        }
       
   
    
            
    return back();

                
		
    }

}


