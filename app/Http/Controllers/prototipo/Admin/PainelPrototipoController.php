<?php

namespace App\Http\Controllers\Prototipo\Admin;

use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;


use App\Mod_prototipo\StatusPermissoes;

use App\Mod_prototipo\Prototipo;
use App\Mod_prototipo\EntePublicoProponente;
use App\Mod_prototipo\TabCaracterizacaoTerreno;
use App\Mod_prototipo\PlantaTerreno;
use App\Mod_prototipo\TabInfraestrututaBasica;
use App\Mod_prototipo\TabInsercaoUrbana;
use App\Mod_prototipo\MapaInsercaoUrbana;
use App\Mod_prototipo\TabConcepcaoProjeto;
use App\Mod_prototipo\ViewTabelaPontuacao;
use App\Mod_prototipo\PontuacaoCriteriosPrototipo;
use App\Mod_prototipo\SituacaoTerreno;
use App\Mod_prototipo\ViewPontuacaoCriterios;
use App\Mod_prototipo\ViewResumoPermissoes;
use App\Mod_prototipo\ViewSituacaoUsuarioPrototipo;
use App\Mod_prototipo\ViewCriteriosHabilitacaoAuto;
use App\Mod_prototipo\RequisitosHabilitacao;
use App\Mod_prototipo\HabilitacaoPrototipo;
use App\Mod_prototipo\Permissoes;
use App\Mod_prototipo\RotaInsercaoUrbana;
use App\Mod_prototipo\TipoIndeferimento;

use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;

class PainelPrototipoController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
        
    }

    

public function usuariosPrototipo(){
    
    $where = [];
    $where[] = ['modulo_sistema_id',3];   
    //$where[] = ['tipo_usuario_id',9];   

      $usuarios = ViewSituacaoUsuarioPrototipo::where($where)
                            ->orderBy('txt_sigla_uf', 'asc')
                            ->orderBy('ds_municipio', 'asc')
                            ->orderBy('name', 'asc')
                            ->get();

    return view('views_prototipo.admin.lista_usuarios_prototipo', compact('usuarios'));  
 
}
public function consultaPermissoes(){
    
    $usuario = Auth::user();   

    if($usuario->tipo_usuario_id == 8 || $usuario->tipo_usuario_id == 9){
    flash()->erro('Sem permissão', "Você não tem permissão para acessar essa página");
    return redirect('/prototipo');
    }

     $resumoPermissoes = ViewResumoPermissoes::get();


    return view('views_prototipo.admin.consulta_permissoes',compact('resumoPermissoes'));

}

public function listaPermissoes(){
    
    $permissoes = Permissoes::join('users','users.id','=','tab_permissoes.user_id')
                                ->leftjoin('tab_ente_publico_proponente','users.ente_publico_id', '=','tab_ente_publico_proponente.id')
                                ->leftjoin('tab_municipios','tab_ente_publico_proponente.municipio_id', '=','tab_municipios.id')
                                ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                ->leftjoin('opc_status_permissao','tab_permissoes.status_permissao_id', '=','opc_status_permissao.id')
                                ->leftjoin('opc_tipo_indeferimento','tab_permissoes.tipo_indeferimento_id', '=','opc_tipo_indeferimento.id')
                                ->leftjoin('users as users2','users2.id','=','tab_permissoes.usuario_id_analise')
                                ->select('txt_sigla_uf','ds_municipio','txt_ente_publico','users.txt_cpf_usuario',
                                 'users.email','users.name','txt_status_permissao','bln_adm_indireta',
                                 'opc_tipo_indeferimento.txt_tipo_indeferimento','users2.name as analisado_por',
                                 'tab_permissoes.*')
                       ->orderBy('txt_sigla_uf', 'asc')
                        ->orderBy('ds_municipio', 'asc')
                        ->orderBy('name', 'asc')
                                ->get();
    if(count($permissoes) == 0){
        flash()->erro('Inválido', "Não existem permissões para os Parâmetros selecionados");
        return back();
        }

     $whereAnalise[] = ['status_permissao_id', '1'];                          
     $permissoesAnalise = Permissoes::join('users','users.id','=','tab_permissoes.user_id')
                                ->leftjoin('tab_ente_publico_proponente','users.ente_publico_id', '=','tab_ente_publico_proponente.id')
                                ->leftjoin('tab_municipios','tab_ente_publico_proponente.municipio_id', '=','tab_municipios.id')
                                ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                ->leftjoin('opc_status_permissao','tab_permissoes.status_permissao_id', '=','opc_status_permissao.id')
                                ->leftjoin('opc_tipo_indeferimento','tab_permissoes.tipo_indeferimento_id', '=','opc_tipo_indeferimento.id')
                                ->leftjoin('users as users2','users2.id','=','tab_permissoes.usuario_id_analise')
                                ->select('txt_sigla_uf','ds_municipio','txt_ente_publico','users.txt_cpf_usuario',
                                 'users.email','users.name','txt_status_permissao','bln_adm_indireta',
                                 'opc_tipo_indeferimento.txt_tipo_indeferimento','users2.name as analisado_por',
                                 'tab_permissoes.*')
                        ->where($whereAnalise)
                        ->orderBy('created_at', 'desc')
                        ->orderBy('name', 'asc')
                                ->get();                                

 $cabecalhoTabAnalise = ['UF','Município', 'Proponente','CPF','Nome','Data Solicitação'];

  $cabecalhoTab = ['UF','Município', 'Proponente','CPF','Nome','Data Solicitação','Data Análise','Analisada Por'];

 //$permissoesAnalise =  [];
 $permissoesDeferida = [];
 $permissoesDeferidaPendencia = [];
 $permissoesIndeferida = [];
 $permissoesBloqueada = [];



 foreach($permissoes as $permissao){
    $dados = [];
     if($permissao->status_permissao_id == 2){
                array_push($permissoesDeferida, $permissao);            
            }else if($permissao->status_permissao_id == 3){
                    array_push($permissoesIndeferida, $permissao);            
                }else  if($permissao->status_permissao_id == 4){
                        array_push($permissoesBloqueada, $permissao);            
                     }else  if($permissao->status_permissao_id == 5){
                        array_push($permissoesDeferidaPendencia, $permissao);            
    }
    
    
     
    
    
    
 }  
  $tipoIndeferimento = TipoIndeferimento::select('id','txt_tipo_indeferimento as nome')->orderBy('txt_tipo_indeferimento')->get(); 

  //$permissoesIndeferida = json_encode($permissoesIndeferida);

    return view('views_prototipo.admin.permissoes_prototipo ',compact('permissoes','permissoesAnalise','permissoesDeferida','permissoesDeferidaPendencia','permissoesIndeferida','permissoesBloqueada','cabecalhoTabAnalise',
            'cabecalhoTab','tipoIndeferimento','estado','municipio'));

}



public function situacaoPermissoes(Request $request){
    $where = [];
    $whereAnalise = [];

    $estado = [];
    $subtitulo2 = 'BRASIL';
    if($request->estado){
        $where[] = ['tab_municipios.uf_id', $request->estado];
        $whereAnalise[] = ['tab_municipios.uf_id', $request->estado];
        $estado = Uf::where('id',$request->estado)->firstOrFail();
        $request->session()->flash('estado', $request->estado);
        $subtitulo2 = $estado->txt_silga_uf;

    }

    $municipio = [];
    if($request->municipio){
        $where[] = ['tab_municipios.id', $request->municipio];
        $whereAnalise[] = ['tab_municipios.id', $request->municipio];
        $municipio = Municipio::where('id',$request->municipio)->firstOrFail();   
        $request->session()->flash('municipio', $request->municipio);
        $subtitulo2 = trim($municipio->ds_municipio) .'/'. $estado->txt_silga_uf;  
    }
  //  $request->session()->flash('where',  $where);

         $permissoes = Permissoes::join('users','users.id','=','tab_permissoes.user_id')
                                    ->leftjoin('tab_ente_publico_proponente','users.ente_publico_id', '=','tab_ente_publico_proponente.id')
                                    ->leftjoin('tab_municipios','tab_ente_publico_proponente.municipio_id', '=','tab_municipios.id')
                                    ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                    ->leftjoin('opc_status_permissao','tab_permissoes.status_permissao_id', '=','opc_status_permissao.id')
                                    ->leftjoin('opc_tipo_indeferimento','tab_permissoes.tipo_indeferimento_id', '=','opc_tipo_indeferimento.id')
                                    ->leftjoin('users as users2','users2.id','=','tab_permissoes.usuario_id_analise')
                                    ->select('txt_sigla_uf','ds_municipio','txt_ente_publico','users.txt_cpf_usuario',
                                     'users.email','users.name','txt_status_permissao',
                                     'opc_tipo_indeferimento.txt_tipo_indeferimento','users2.name as analisado_por',
                                     'tab_permissoes.*')
                            ->where($where)
                            ->orderBy('txt_sigla_uf', 'asc')
                            ->orderBy('ds_municipio', 'asc')
                            ->orderBy('name', 'asc')
                                    ->get();
        if(count($permissoes) == 0){
            flash()->erro('Inválido', "Não existem permissões para os Parâmetros selecionados");
            return back();
            }

   

    return view('views_prototipo.admin.situacao_permissoes_prototipo',compact('permissoes','subtitulo2'));

}

public function consultaPrototipos(){
    
        $usuario = Auth::user();   

        if($usuario->tipo_usuario_id == 8 || $usuario->tipo_usuario_id == 9){
        flash()->erro('Sem permissão', "Você não tem permissão para acessar essa página");
        return redirect('/prototipo');
        }

        return view('views_prototipo.admin.consulta_prototipos');

    }

    public function listaPrototipos(Request $request){
    
        $usuario = Auth::user();   

        if($usuario->tipo_usuario_id == 8 || $usuario->tipo_usuario_id == 9){
        flash()->erro('Sem permissão', "Você não tem permissão para acessar essa página");
        return redirect('/prototipo');
        }

        $where = [];

        $subtitulo1 = 'Brasil';
        $estado = [];
        if($request->estado){
            $where[] = ['tab_municipios.uf_id', $request->estado];
            $estado = Uf::where('id',$request->estado)->firstOrFail();
        
        }

        $municipio = [];
        if($request->municipio){
            $where[] = ['tab_prototipo.municipio_id', $request->municipio];
            $municipio = Municipio::where('id',$request->municipio)->firstOrFail();      
        }


     $prototipos = Prototipo::join('opc_situacao_prototipo', 'opc_situacao_prototipo.id','tab_prototipo.situacao_prototipo_id')
                                ->leftjoin('tab_ente_publico_proponente','tab_prototipo.ente_publico_proponente_id', '=','tab_ente_publico_proponente.id')
                                ->leftjoin('tab_municipios','tab_prototipo.municipio_id', '=','tab_municipios.id')
                                ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                ->select('tab_uf.txt_sigla_uf','tab_municipios.ds_municipio','tab_ente_publico_proponente.txt_ente_publico','tab_prototipo.*','txt_situacao_prototipo')
                                ->where($where)
                                ->orderBy('tab_uf.txt_sigla_uf')
                                ->orderBy('tab_municipios.ds_municipio')
                                ->orderBy('tab_ente_publico_proponente.txt_ente_publico')
                                ->orderBy('tab_prototipo.created_at')
                                ->get();

    if(count($prototipos)>0){
        return view('views_prototipo.admin.lista_prototipos',compact('prototipos','subtitulo1'));        
    }else{
        flash()->info('Informação', "Não existem propostas cadastradas para os parâmetros. selecionados.");
        return back();
    }
                     
}

    public function dadosLevantamento($prototipo_id){
       
        $usuarioLogado = Auth::user();   

        if($usuarioLogado->tipo_usuario_id == 8 || $usuarioLogado->tipo_usuario_id == 9){
        flash()->erro('Sem permissão', "Você não tem permissão para acessar essa página");
        return redirect('/prototipo');
        }
        
          $prototipo = Prototipo::find($prototipo_id); 
          $prototipo->load('situacaoPrototipo');   

          $usuario = User::where('ente_publico_id',$prototipo->ente_publico_proponente_id )->firstOrFail();
         $ente = EntePublicoProponente::where('id',$prototipo->ente_publico_proponente_id)->firstOrFail();      
         
         $tabelaPontos = ViewTabelaPontuacao::where('prototipo_id',$prototipo_id)->get();
         
         $municipio = Municipio::join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
               ->select('txt_sigla_uf','ds_municipio')
               ->where('tab_municipios.id',$ente->municipio_id)->firstOrFail();   

               //$prototipo = Prototipo::where('ente_publico_proponente_id',$usuario->ente_publico_id)->first();   
                
               if($prototipo->situacao_prototipo_id >= 6){
                     $habilitacao = HabilitacaoPrototipo::where('prototipo_id',$prototipo_id)->first();
                     $criteriosHabilitacao =  ViewCriteriosHabilitacaoAuto::where('prototipo_id', $prototipo_id)->first();
               }else{
                $habilitacao = null;
                $criteriosHabilitacao = null;
               }
               

                $caracTerreno = TabCaracterizacaoTerreno::leftjoin('opc_titularidade_terreno','opc_titularidade_terreno.id','tab_caracterizacao_terreno.titularidade_terreno_id')
                                                                ->leftjoin('opc_tipo_risco','opc_tipo_risco.id','tab_caracterizacao_terreno.tipo_risco_id')
                                                                ->select('tab_caracterizacao_terreno.*','opc_titularidade_terreno.txt_titularidade_terreno','opc_tipo_risco.txt_tipo_risco')
                                                                ->where('prototipo_id',$prototipo->id)->first();        
                
                $plantaTerreno = PlantaTerreno::where('caracterizacao_terreno_id', $caracTerreno->id)->get();
               
                $infraBasica = TabInfraestrututaBasica::where('prototipo_id',$prototipo->id)->first();        
               
                $insercaoUrbana = TabInsercaoUrbana::where('prototipo_id',$prototipo->id)->first();        

                  $mapasInsercao = MapaInsercaoUrbana::where('insercao_urbana_id',$insercaoUrbana->id)->get(); 
                  $rotasInsercaoUrbana = RotaInsercaoUrbana::where('insercao_urbana_id',$insercaoUrbana->id)->get();

                 $concepcaoProjeto = TabConcepcaoProjeto::leftjoin('opc_tipo_organizacao','opc_tipo_organizacao.id','tab_concepcao_projeto.tipo_organizacao_id')
                                                                ->select('tab_concepcao_projeto.*','opc_tipo_organizacao.txt_tipo_organizacao')
                                                                ->where('prototipo_id',$prototipo->id)->first();        
               
                

                $situacaoTerreno = SituacaoTerreno::orderBy('id')->get();
       
               // return $habilitacao;
            return view('views_prototipo.admin.dados_proposta ',compact('usuario','ente','municipio','prototipo','caracTerreno','concepcaoProjeto','insercaoUrbana','infraBasica',
                                                        'mapasInsercao','tabelaPontos','situacaoTerreno','plantaTerreno','habilitacao','criteriosHabilitacao','rotasInsercaoUrbana'));
        
   }

   public function habilitarProposta($prototipoID){

    

    $usuarioLogado = Auth::user();   

    if($usuarioLogado->tipo_usuario_id == 8 || $usuarioLogado->tipo_usuario_id == 9){
    flash()->erro('Sem permissão', "Você não tem permissão para acessar essa página");
    return redirect('/prototipo');
    }
    
    
      $prototipo = Prototipo::find($prototipoID);
     


     if(empty($prototipo) || $prototipo->situacao_prototipo_id < 4){
        flash()->erro('Erro', "A proposta selecionada não existe ou não foi enviada.");
        return redirect('admin/prototipos/consulta' );
     }else{
        if($prototipo->situacao_prototipo_id >= 6){
            flash()->erro('Erro', "A proposta selecionada já foi analisada.");
            return redirect('/admin/prototipo/show/levantamento/'.$prototipoID);
        }
        $prototipo->load('situacaoPrototipo');   
     }
     
     

      $usuario = User::where('ente_publico_id',$prototipo->ente_publico_proponente_id )->firstOrFail();
       $ente = EntePublicoProponente::where('id',$prototipo->ente_publico_proponente_id)->firstOrFail();      
     
     $tabelaPontos = ViewTabelaPontuacao::where('prototipo_id',$prototipo->id)->get();
     
     $municipio = Municipio::join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
           ->select('txt_sigla_uf','ds_municipio')
           ->where('tab_municipios.id',$ente->municipio_id)->firstOrFail();   

        $criteriosHabilitacao =  ViewCriteriosHabilitacaoAuto::where('prototipo_id', $prototipo->id)->first();
       
       $insercaoUrbana = TabInsercaoUrbana::where('prototipo_id',$prototipo->id)->first();     
       $mapasInsercao = MapaInsercaoUrbana::where('insercao_urbana_id',$insercaoUrbana->id)->get(); 

       
       $caracTerreno = TabCaracterizacaoTerreno::leftjoin('opc_titularidade_terreno','opc_titularidade_terreno.id','tab_caracterizacao_terreno.titularidade_terreno_id')
                                                                ->leftjoin('opc_tipo_risco','opc_tipo_risco.id','tab_caracterizacao_terreno.tipo_risco_id')
                                                                ->select('tab_caracterizacao_terreno.*','opc_titularidade_terreno.txt_titularidade_terreno','opc_tipo_risco.txt_tipo_risco')
                                                                ->where('prototipo_id',$prototipo->id)->first();        
       $plantaTerreno = PlantaTerreno::where('caracterizacao_terreno_id', $caracTerreno->id)->get();   

       $infraBasica = TabInfraestrututaBasica::where('prototipo_id',$prototipo->id)->first();      

        $requisitosHabilitacao = RequisitosHabilitacao::get();
       $situacaoTerreno = SituacaoTerreno::orderBy('id')->get();
       return view('views_prototipo.admin.habilitar_proposta ',compact('usuario','ente','municipio','prototipo','criteriosHabilitacao','insercaoUrbana','mapasInsercao','caracTerreno',
                                                    'infraBasica','plantaTerreno','requisitosHabilitacao','situacaoTerreno','tabelaPontos'));

   }

   public function finalizarAnalise(Request $request){
       // return $request->all();
       $usuario = Auth::user();  
        $prototipo = Prototipo::find($request->prototipo_id); 
         $ente = EntePublicoProponente::where('id',$prototipo->ente_publico_proponente_id)->firstOrFail();      
     
         $municipio = Municipio::join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
             ->select('txt_sigla_uf','ds_municipio')
             ->where('tab_municipios.id',$ente->municipio_id)->firstOrFail();   

           $criteriosHabilitacao =  ViewCriteriosHabilitacaoAuto::where('prototipo_id', $request->prototipo_id)->first();
        
        $requisitos_adicionais = 0;


        if($criteriosHabilitacao->requisitos_habilitacao_id_1){
            $requisitos_adicionais += 1;
        }

        if($criteriosHabilitacao->requisitos_habilitacao_id_2 == true){
            $requisitos_adicionais += 1;
        }
        if($criteriosHabilitacao->requisitos_habilitacao_id_3 == true){
            $requisitos_adicionais += 1;
        }
        if($criteriosHabilitacao->requisitos_habilitacao_id_4 == true){
            $requisitos_adicionais += 1;
        }
        if($criteriosHabilitacao->requisitos_habilitacao_id_5 == true){
            $requisitos_adicionais += 1;
        }
        if($criteriosHabilitacao->requisitos_habilitacao_id_6 == true){
            $requisitos_adicionais += 1;
        }
        if($criteriosHabilitacao->requisitos_habilitacao_id_7 == true){
            $requisitos_adicionais += 1;
        }
        if($criteriosHabilitacao->requisitos_habilitacao_id_8 == true){
            $requisitos_adicionais += 1;
        }
        if($criteriosHabilitacao->requisitos_habilitacao_id_9){
            $requisitos_adicionais += 1;
        }
        if($criteriosHabilitacao->requisitos_habilitacao_id_10){
            $requisitos_adicionais += 1;
        }

        DB::beginTransaction();

        $habilitacao = new HabilitacaoPrototipo;
        $habilitacao->prototipo_id = $request->prototipo_id;
        $habilitacao->vlr_populacao_estimada =  $criteriosHabilitacao->vlr_populacao_estimada;
        $habilitacao->num_requisitos_adicionais =  $requisitos_adicionais;
        
        if($criteriosHabilitacao->vlr_populacao_estimada <= 750000){
            if($requisitos_adicionais >= 7){
                $habilitacao->bln_req_edital_42_43 = true;
            }else{
                $habilitacao->bln_req_edital_42_43 = false;
            }
            
        }else{
            if($requisitos_adicionais >= 8){
                $habilitacao->bln_req_edital_42_43 = true;
            }else{
                $habilitacao->bln_req_edital_42_43 = false;
            }
        }

        if($request->requisitos_habilitacao_id_11 == 'true'){
            $habilitacao->bln_req_edital_36_a = true;
        }else{
             $habilitacao->bln_req_edital_36_a = false;
        }
    

        if($request->requisitos_habilitacao_id_12 == 'true'){
            $habilitacao->bln_req_edital_36_b = true;
        }else{
            $habilitacao->bln_req_edital_36_b = false;
        }
    

        if($request->requisitos_habilitacao_id_13 == 'true'){
            $habilitacao->bln_req_edital_36_c = true;
        }else{
            $habilitacao->bln_req_edital_36_c = false;
        }
    

        if($criteriosHabilitacao->requisitos_habilitacao_id_14 == true){
            $habilitacao->bln_req_edital_36_e = true;
        }else{
            $habilitacao->bln_req_edital_36_e = false;
        }



       // return $habilitacao;
        if($habilitacao->bln_req_edital_42_43  
                && $habilitacao->bln_req_edital_36_a 
                    && $habilitacao->bln_req_edital_36_b 
                        && $habilitacao->bln_req_edital_36_c 
                            && $habilitacao->bln_req_edital_36_e){
            $habilitacao->bln_habilitada = true;
            $prototipo->situacao_prototipo_id  = 6;
        }else{
            $habilitacao->bln_habilitada = false;
           
            $prototipo->situacao_prototipo_id  = 7;
        }

        $habilitacao->txt_observacao = $request->txt_observacao;
        $habilitacao->dte_habilitacao = Date("Y-m-d h:i:s");  
        $habilitacao->user_id = $usuario->id;

        $salvouhabilitacao = $habilitacao->save();

          $pontuacao = ViewPontuacaoCriterios::where('prototipo_id',$prototipo->id )->first();
          $pontuacaoCriterio = new PontuacaoCriteriosPrototipo;
        $pontuacaoCriterio->prototipo_id = $prototipo->id ;
        $pontuacaoCriterio->num_pontuacao_item_1 = $pontuacao->num_pontuacao_item_1;
        $pontuacaoCriterio->num_pontuacao_item_2 = $pontuacao->num_pontuacao_item_2;
        $pontuacaoCriterio->num_pontuacao_item_3 = $pontuacao->num_pontuacao_item_3;
        $pontuacaoCriterio->num_pontuacao_item_4 = $pontuacao->num_pontuacao_item_4;
        $pontuacaoCriterio->num_pontuacao_item_5 = $pontuacao->num_pontuacao_item_5;
        $pontuacaoCriterio->num_pontuacao_item_6 = $pontuacao->num_pontuacao_item_6;
        $pontuacaoCriterio->num_pontuacao_item_7 = $pontuacao->num_pontuacao_item_7;
        $pontuacaoCriterio->num_pontuacao_item_8 = $pontuacao->num_pontuacao_item_8;
        $pontuacaoCriterio->num_pontuacao_item_9 = $pontuacao->num_pontuacao_item_9;
        $pontuacaoCriterio->num_pontuacao_item_10 = $pontuacao->num_pontuacao_item_10;
        $pontuacaoCriterio->situacao_prototipo_id = 4;
    
      
    
        $salvouPontuacao = $pontuacaoCriterio->save();
    
         $prototipo->num_pontuacao_total = $pontuacaoCriterio->num_pontuacao_item_1+$pontuacaoCriterio->num_pontuacao_item_2+$pontuacaoCriterio->num_pontuacao_item_3+$pontuacaoCriterio->num_pontuacao_item_4+$pontuacaoCriterio->num_pontuacao_item_5+$pontuacaoCriterio->num_pontuacao_item_6+$pontuacaoCriterio->num_pontuacao_item_7+$pontuacaoCriterio->num_pontuacao_item_8+$pontuacaoCriterio->num_pontuacao_item_9+$pontuacaoCriterio->num_pontuacao_item_10;
    
        
        $salvaPrototipo = $prototipo->save();

        $criteriosHabilitacao =  ViewCriteriosHabilitacaoAuto::where('prototipo_id', $request->prototipo_id)->first();

         

        if (!$salvouhabilitacao || !$salvaPrototipo || !$salvouPontuacao){           
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível enviar a análise da proposta.");            
            return back();
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Proposta analisada com sucesso!"); 
            return redirect('admin/prototipo/show/levantamento/'.$request->prototipo_id);
            
        } 

   }

   public function editarAnalise(HabilitacaoPrototipo $habilitacaoPrototipo){

    DB::beginTransaction();

     $prototipoID =  $habilitacaoPrototipo->prototipo_id;;

     $prototipo = Prototipo::find($prototipoID);
     $prototipo->situacao_prototipo_id = 4;
     $prototipo->num_pontuacao_total = 0;
     $salvaPrototipo = $prototipo->save();

     $pontuacaoCriterio = PontuacaoCriteriosPrototipo::where('prototipo_id', $prototipo->id)->first();
     $deletePontuacaoCriterio = $pontuacaoCriterio->delete();

     $deletouHabilitacao = $habilitacaoPrototipo->delete();

   
       
    if (!$deletouHabilitacao || !$salvaPrototipo || !$deletePontuacaoCriterio){           
        DB::rollBack();
        flash()->erro("Erro", "Não foi possível cancelar a análise da proposta.");            
        return back();
    } else {
        DB::commit();
        flash()->sucesso("Sucesso", "Análise cancelada com sucesso!"); 
        return redirect('admin/prototipo/show/levantamento/'.$prototipoID);
        
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
   return view('views_prototipo.admin.dados_usuario_admin', compact('usuario', 'idUsuarioLogado'));
} 

}


