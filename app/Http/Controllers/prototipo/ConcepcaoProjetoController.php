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








class ConcepcaoProjetoController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('entePublico');
        //$this->middleware('redirecionar');
        
    }

    
    public function concepcaoProjeto($prototipo_id)
    {
        //return $request->all();
        $usuario = Auth::user();
        $prototipo = Prototipo::where('id',$prototipo_id)->first();

        if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }

        if($prototipo->bln_concepcao_projeto){
            return redirect('prototipo/show/levantamento/'.$prototipo->id); 
         }else{
            return view('prototipo.concepcao_projeto',compact('prototipo'));
         }
        
    } 

    public function concepcaoProjetoSalvar(Request $request)
    {
        //return $request->all();
        $usuario = Auth::user();
        $prototipo = Prototipo::find($request->prototipo_id);

        if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }

        DB::beginTransaction();

        $prototipo->situacao_prototipo_id = 3;
        $prototipo->dte_conclusao_preenchimento =  Date("Y-m-d h:i:s");
        $prototipo->bln_concepcao_projeto = TRUE;
        $prototipo->dte_conclusao_concepcao_projeto =  Date("Y-m-d h:i:s");
        $salvouPrototipo = $prototipo->save();

        
        $concepcaoProjeto = new TabConcepcaoProjeto();
        $concepcaoProjeto->prototipo_id = $prototipo->id;
        $concepcaoProjeto->bln_possui_projeto_proposto = $request->bln_possui_projeto_proposto;
        $concepcaoProjeto->txt_nome_parceiro_desenv_projeto = $request->txt_nome_parceiro_desenv_projeto;
        $concepcaoProjeto->num_unidades_hab_propostas = $request->num_unidades_hab_propostas;
        $concepcaoProjeto->vlr_area_uh_m2 = $request->vlr_area_uh_m2;
        $concepcaoProjeto->tipo_organizacao_id = $request->tipo_organizacao;        
        $concepcaoProjeto->num_pavimentos_cond_vertical = $request->txt_num_pavimentos_cond_vertical;
        $concepcaoProjeto->txt_estrategia_reducao_custos_cond = $request->txt_estrategia_reducao_custos_cond;
        $concepcaoProjeto->txt_destinacao_atividade_comercial = $request->destinacao_atividade_comercial;
        $concepcaoProjeto->txt_observacao = $request->txt_observacao;       

        $salvoConcepcaoProjeto = $concepcaoProjeto->save();
             
        if (!$salvouPrototipo || !$salvoConcepcaoProjeto){   
            $ente = EntePublicoProponente::where('id',$usuario->ente_publico_id)->firstOrFail();
       

           $municipio = Municipio::join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                ->select('txt_sigla_uf','ds_municipio')
                ->where('tab_municipios.id',$ente->municipio_id)->firstOrFail();          
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados de Concepção do Projeto!"); 

            return redirect('prototipo/show/levantamento/'.$prototipo->id); 
            
        } 
       
    } 

    public function editarConcepcaoProjeto ($concepcaoProjetoId){
    
        $concepcaoProjeto = TabConcepcaoProjeto::find($concepcaoProjetoId);
        $prototipo = Prototipo::where('id',$concepcaoProjeto->prototipo_id)->first();
        $usuario = Auth::user();   
        if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
           flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
           return redirect('/prototipo');
       }
    
       return view('prototipo.editar_concepcao_projeto',compact('concepcaoProjeto','prototipo'));    
    
      }
    
      public function concepcaoProjetoUpdate(Request $request){
        return $request->all();
    
    }

    
}




