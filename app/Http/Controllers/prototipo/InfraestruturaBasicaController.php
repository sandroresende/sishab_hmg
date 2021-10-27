<?php

namespace App\Http\Controllers\Prototipo;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ente_publico\SalvarDirigente;
use App\Http\Requests\prototipo\SalvarCaracTerreno;

use App\Http\Controllers\Controller;


use App\User;
use App\Municipio;
use App\TipoProponente;

use App\ente_publico\TipoEntePublico;

use App\Mod_prototipo\Prototipo;
use App\Mod_prototipo\EntePublicoProponente;
use App\Mod_prototipo\TabCaracterizacaoTerreno;
use App\Mod_prototipo\TabInfraestrututaBasica;
use App\Mod_prototipo\TabConcepcaoProjeto;
use App\Mod_prototipo\TabInsercaoUrbana;
use App\Mod_prototipo\Permissoes;
use App\Mod_prototipo\MapaInsercaoUrbana;








class InfraestruturaBasicaController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('entePublico');
        //$this->middleware('redirecionar');
        
    }

    
    
    public function infraestruturaBasica($prototipo_id)
    {
        $usuario = Auth::user();
        $prototipo = Prototipo::where('id',$prototipo_id)->first();

        if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }

        if($prototipo->bln_infraestrutura_basica){
            return redirect('prototipo/iniciar/insercaoUrbana/'.$prototipo->id); 
         }else{
            return view('views_prototipo.infraestrutura_basica',compact('prototipo'));
         }
    } 

    public function infraestruturaBasicaSalvar(Request $request)

    
    {
        $usuario = Auth::user();
         $prototipo = Prototipo::find($request->prototipo_id);

         if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }
        DB::beginTransaction();

        $prototipo->situacao_prototipo_id = 2;
        $prototipo->bln_infraestrutura_basica = TRUE;
        $prototipo->dte_conclusao_infraestrutura_basica =  Date("Y-m-d h:i:s");
        $salvouPrototipo = $prototipo->save();

        //return $request->all();
        
        $infraestruturaBasica = new TabInfraestrututaBasica();
        
        $infraestruturaBasica->prototipo_id = $prototipo->id;
       // $infraestruturaBasica->infraestrutura_basica_id = $request->infraestrututa_basica;
       
            if($request->bln_sistema_abastecimento == true){
                $infraestruturaBasica->bln_sistema_abastecimento = true;
                $infraestruturaBasica->vlr_dist_sis_abast = $request->vlr_dist_sis_abast;
            }else{
                $infraestruturaBasica->bln_sistema_abastecimento = false;
                $infraestruturaBasica->vlr_dist_sis_abast = 0;
            }

            if($request->bln_sistema_coleta_esgoto == true){
                $infraestruturaBasica->bln_sistema_coleta_esgoto = true;
                $infraestruturaBasica->vlr_dist_sis_coleta = $request->vlr_dist_sis_coleta;
            }else{
                $infraestruturaBasica->bln_sistema_coleta_esgoto = false;
                $infraestruturaBasica->vlr_dist_sis_coleta = 0;
            }

            if($request->bln_sistema_coleta_lixo == true){
                $infraestruturaBasica->bln_sistema_coleta_lixo = true;
                $infraestruturaBasica->vlr_dist_sis_coleta_lixo = $request->vlr_dist_sis_coleta_lixo;
            }else{
                $infraestruturaBasica->bln_sistema_coleta_lixo = false;
                $infraestruturaBasica->vlr_dist_sis_coleta_lixo = 0;
            }

            if($request->bln_sistema_renagem_ag_pluviais == true){
                $infraestruturaBasica->bln_sistema_renagem_ag_pluviais = true;
                $infraestruturaBasica->vlr_dist_sis_dren_ag_pluv = $request->vlr_dist_sis_dren_ag_pluv;
            }else{
                $infraestruturaBasica->bln_sistema_renagem_ag_pluviais = false;
                $infraestruturaBasica->vlr_dist_sis_dren_ag_pluv = 0;
            }
            
            if($request->bln_dist_energia_eletrica == true){
                $infraestruturaBasica->bln_dist_energia_eletrica = true;
                $infraestruturaBasica->vlr_dist_sis_dist_ener_elet = $request->vlr_dist_sis_dist_ener_elet;
            }else{
                $infraestruturaBasica->bln_dist_energia_eletrica = false;
                $infraestruturaBasica->vlr_dist_sis_dist_ener_elet = 0;
            }
        
            if($request->bln_iluminacao_publica == true){
                $infraestruturaBasica->bln_iluminacao_publica = true;
                $infraestruturaBasica->vlr_dist_sis_ilum_pub = $request->vlr_dist_sis_ilum_pub;
            }else{
                $infraestruturaBasica->bln_iluminacao_publica = false;
                $infraestruturaBasica->vlr_dist_sis_ilum_pub = 0;
            }
            
            if($request->bln_guias_sarjetas == true){
                $infraestruturaBasica->bln_guias_sarjetas = true;
                $infraestruturaBasica->vlr_dist_sis_guias_sarj = $request->vlr_dist_sis_guias_sarj;
            }else{
                $infraestruturaBasica->bln_guias_sarjetas = false;
                $infraestruturaBasica->vlr_dist_sis_guias_sarj = 0;
            }  

            if($request->bln_pavimentacao == true){
                $infraestruturaBasica->bln_pavimentacao = true;
                $infraestruturaBasica->vlr_dist_sis_pavim = $request->vlr_dist_sis_pavim;
            }else{
                $infraestruturaBasica->bln_pavimentacao = false;
                $infraestruturaBasica->vlr_dist_sis_pavim = 0;
            } 
            
        $infraestruturaBasica->bln_obras_andamento = $request->bln_obras_andamento;
        
        $infraestruturaBasica->txt_origem_recurso = $request->txt_origem_recurso;
        $infraestruturaBasica->dte_termino_obras = $request->dte_termino_obras;

        /**
            if($request->bln_obras_andamento == 1){
                if($request->bln_sistema_abastecimento_pendentes == true){
                    $infraestruturaBasica->bln_sistema_abastecimento_pendentes = true;
                }else{
                    $infraestruturaBasica->bln_sistema_abastecimento_pendentes = false;
                }
        
                if($request->bln_sistema_coleta_esgoto_pendentes == true){
                    $infraestruturaBasica->bln_sistema_coleta_esgoto_pendentes = true;
                }else{
                    $infraestruturaBasica->bln_sistema_coleta_esgoto_pendentes = false;
                }
        
                if($request->bln_sistema_renagem_ag_pluviais_pendentes == true){
                    $infraestruturaBasica->bln_sistema_renagem_ag_pluviais_pendentes = true;
                }else{
                    $infraestruturaBasica->bln_sistema_renagem_ag_pluviais_pendentes = false;
                }
                
                if($request->bln_dist_energia_eletrica_pendentes == true){
                    $infraestruturaBasica->bln_dist_energia_eletrica_pendentes = true;
                }else{
                    $infraestruturaBasica->bln_dist_energia_eletrica_pendentes = false;
                }
               
                if($request->bln_iluminacao_publica_pendentes == true){
                    $infraestruturaBasica->bln_iluminacao_publica_pendentes = true;
                }else{
                    $infraestruturaBasica->bln_iluminacao_publica_pendentes = false;
                }
                
                if($request->bln_guias_sarjetas_pendentes == true){
                    $infraestruturaBasica->bln_guias_sarjetas_pendentes = true;
                }else{
                    $infraestruturaBasica->bln_guias_sarjetas_pendentes = false;
                }  
        
                if($request->bln_pavimentacao_pendentes == true){
                    $infraestruturaBasica->bln_pavimentacao_pendentes = true;
                }else{
                    $infraestruturaBasica->bln_pavimentacao_pendentes = false;
                }   

                if($request->bln_outras_pendentes == true){
                    $infraestruturaBasica->bln_outras_pendentes = true;
                    $infraestruturaBasica->txt_outras_obras_pendentes = $request->txt_outras_obras_pendentes;
                }else{
                    $infraestruturaBasica->bln_outras_pendentes = false;
                }                   
            }             
*/
        //return $infraestruturaBasica;

        $salvoInfraestruturaBasica = $infraestruturaBasica->save();
        

        if (!$salvouPrototipo || !$salvoInfraestruturaBasica){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados de Infraestrutura Básica!"); 

            return redirect('prototipo/iniciar/insercaoUrbana/'.$prototipo->id); 
            
        } 
    }
    
    
   public function editarInfraBasica ($infraestrututaBasicaId){
    
    $infraestrututaBasica = TabInfraestrututaBasica::find($infraestrututaBasicaId);
    $prototipo = Prototipo::where('id',$infraestrututaBasica->prototipo_id)->first();

    $usuario = Auth::user();
    if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
    }

   return view('views_prototipo.editar_infraestrutura_basica',compact('infraestrututaBasica','prototipo'));    

  }

  public function infraestrututaBasicaUpdate(Request $request){
       //return $request->all();
        $usuario = Auth::user();
      
         $infraestruturaBasica = TabInfraestrututaBasica::find($request->infraestrututaBasicaId);
          $prototipo = Prototipo::find($infraestruturaBasica->prototipo_id);

        DB::beginTransaction();

        $prototipo->bln_infraestrutura_basica = TRUE;
        $prototipo->dte_conclusao_infraestrutura_basica =  Date("Y-m-d h:i:s");
        $salvouPrototipo = $prototipo->save();

        
        
        $infraestruturaBasica->prototipo_id = $prototipo->id;
       // $infraestruturaBasica->infraestrutura_basica_id = $request->infraestrututa_basica;
       

       if($request->bln_sistema_abastecimento == true){
        $infraestruturaBasica->bln_sistema_abastecimento = true;
        $infraestruturaBasica->vlr_dist_sis_abast = $request->vlr_dist_sis_abast;
    }else{
        $infraestruturaBasica->bln_sistema_abastecimento = false;
        $infraestruturaBasica->vlr_dist_sis_abast = 0;
    }

    if($request->bln_sistema_coleta_esgoto == true){
        $infraestruturaBasica->bln_sistema_coleta_esgoto = true;
        $infraestruturaBasica->vlr_dist_sis_coleta = $request->vlr_dist_sis_coleta;
    }else{
        $infraestruturaBasica->bln_sistema_coleta_esgoto = false;
        $infraestruturaBasica->vlr_dist_sis_coleta = 0;
    }

    if($request->bln_sistema_coleta_lixo == true){
        $infraestruturaBasica->bln_sistema_coleta_lixo = true;
        $infraestruturaBasica->vlr_dist_sis_coleta_lixo = $request->vlr_dist_sis_coleta_lixo;
    }else{
        $infraestruturaBasica->bln_sistema_coleta_lixo = false;
        $infraestruturaBasica->vlr_dist_sis_coleta_lixo = 0;
    }

    if($request->bln_sistema_renagem_ag_pluviais == true){
        $infraestruturaBasica->bln_sistema_renagem_ag_pluviais = true;
        $infraestruturaBasica->vlr_dist_sis_dren_ag_pluv = $request->vlr_dist_sis_dren_ag_pluv;
    }else{
        $infraestruturaBasica->bln_sistema_renagem_ag_pluviais = false;
        $infraestruturaBasica->vlr_dist_sis_dren_ag_pluv = 0;
    }
    
    if($request->bln_dist_energia_eletrica == true){
        $infraestruturaBasica->bln_dist_energia_eletrica = true;
        $infraestruturaBasica->vlr_dist_sis_dist_ener_elet = $request->vlr_dist_sis_dist_ener_elet;
    }else{
        $infraestruturaBasica->bln_dist_energia_eletrica = false;
        $infraestruturaBasica->vlr_dist_sis_dist_ener_elet = 0;
    }

    if($request->bln_iluminacao_publica == true){
        $infraestruturaBasica->bln_iluminacao_publica = true;
        $infraestruturaBasica->vlr_dist_sis_ilum_pub = $request->vlr_dist_sis_ilum_pub;
    }else{
        $infraestruturaBasica->bln_iluminacao_publica = false;
        $infraestruturaBasica->vlr_dist_sis_ilum_pub = 0;
    }
    
    if($request->bln_guias_sarjetas == true){
        $infraestruturaBasica->bln_guias_sarjetas = true;
        $infraestruturaBasica->vlr_dist_sis_guias_sarj = $request->vlr_dist_sis_guias_sarj;
    }else{
        $infraestruturaBasica->bln_guias_sarjetas = false;
        $infraestruturaBasica->vlr_dist_sis_guias_sarj = 0;
    }  

    if($request->bln_pavimentacao == true){
        $infraestruturaBasica->bln_pavimentacao = true;
        $infraestruturaBasica->vlr_dist_sis_pavim = $request->vlr_dist_sis_pavim;
    }else{
        $infraestruturaBasica->bln_pavimentacao = false;
        $infraestruturaBasica->vlr_dist_sis_pavim = 0;
    } 

        $infraestruturaBasica->bln_obras_andamento = $request->bln_obras_andamento;
        
        $infraestruturaBasica->txt_origem_recurso = $request->txt_origem_recurso;
        $infraestruturaBasica->dte_termino_obras = $request->dte_termino_obras;
/**
        if($request->bln_obras_andamento == 1){
            if($request->bln_sistema_abastecimento_pendentes == true){
                $infraestruturaBasica->bln_sistema_abastecimento_pendentes = true;
            }else{
                $infraestruturaBasica->bln_sistema_abastecimento_pendentes = false;
            }
    
            if($request->bln_sistema_coleta_esgoto_pendentes == true){
                $infraestruturaBasica->bln_sistema_coleta_esgoto_pendentes = true;
            }else{
                $infraestruturaBasica->bln_sistema_coleta_esgoto_pendentes = false;
            }
    
            if($request->bln_sistema_renagem_ag_pluviais_pendentes == true){
                $infraestruturaBasica->bln_sistema_renagem_ag_pluviais_pendentes = true;
            }else{
                $infraestruturaBasica->bln_sistema_renagem_ag_pluviais_pendentes = false;
            }
            
            if($request->bln_dist_energia_eletrica_pendentes == true){
                $infraestruturaBasica->bln_dist_energia_eletrica_pendentes = true;
            }else{
                $infraestruturaBasica->bln_dist_energia_eletrica_pendentes = false;
            }
           
            if($request->bln_iluminacao_publica_pendentes == true){
                $infraestruturaBasica->bln_iluminacao_publica_pendentes = true;
            }else{
                $infraestruturaBasica->bln_iluminacao_publica_pendentes = false;
            }
            
            if($request->bln_guias_sarjetas_pendentes == true){
                $infraestruturaBasica->bln_guias_sarjetas_pendentes = true;
            }else{
                $infraestruturaBasica->bln_guias_sarjetas_pendentes = false;
            }  
    
            if($request->bln_pavimentacao_pendentes == true){
                $infraestruturaBasica->bln_pavimentacao_pendentes = true;
            }else{
                $infraestruturaBasica->bln_pavimentacao_pendentes = false;
            }   

            if($request->bln_outras_pendentes == true){
                $infraestruturaBasica->bln_outras_pendentes = true;
                $infraestruturaBasica->txt_outras_obras_pendentes = $request->txt_outras_obras_pendentes;
            }else{
                $infraestruturaBasica->bln_outras_pendentes = false;
            }               
        }
        */
        
        //return $infraestruturaBasica;
        $salvoInfraestruturaBasica = $infraestruturaBasica->save();
             
        if (!$salvouPrototipo || !$salvoInfraestruturaBasica){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados de Infraestrutura Básica atualizados com sucesso!"); 

            return redirect('prototipo/show/levantamento/'.$prototipo->id); 
            
        } 

  }

  

}




