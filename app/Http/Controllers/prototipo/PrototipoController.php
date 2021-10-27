<?php

namespace App\Http\Controllers\Prototipo;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

//use App\Http\Requests\ente_publico\SalvarDirigente;
//use App\Http\Requests\prototipo\SalvarCaracTerreno;

use App\Http\Controllers\Controller;


use App\User;
use App\IndicadoresHabitacionais\Municipio;
use App\Tab_dominios\TipoProponente;

use App\Mod_selecao_demanda\TipoEntePublico;

use App\Mod_prototipo\Prototipo;
use App\Mod_prototipo\EntePublicoProponente;
use App\Mod_prototipo\TabCaracterizacaoTerreno;
use App\Mod_prototipo\TabInfraestrututaBasica;
use App\Mod_prototipo\TabConcepcaoProjeto;
use App\Mod_prototipo\TabInsercaoUrbana;
use App\Mod_prototipo\Permissoes;
use App\Mod_prototipo\MapaInsercaoUrbana;
use App\Mod_prototipo\PontuacaoCriteriosPrototipo;
use App\Mod_prototipo\ViewPontuacaoCriterios;
use App\Mod_prototipo\SituacaoTerreno;
use App\Mod_prototipo\PlantaTerreno;

use App\Mod_prototipo\RotaInsercaoUrbana;

use App\Mod_sishab\Sishab\Configuracoes;




class PrototipoController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('entePublico');
        //$this->middleware('redirecionar');
        
    }

    public function index()
    {
       
         $tipoEnte = TipoProponente::select('id','txt_tipo_proponente as nome')->get();
         $usuario = Auth::user();
         $wherePermissao = [];
         //$wherePermissaoIn = [];
          $wherePermissao[] = ['user_id',$usuario->id];    
          //$wherePermissaoIn[] = ['status_permissao_id',[2,5]];   
          

          
          $permissao = Permissoes::where($wherePermissao)->whereIn('status_permissao_id',[2,5])->get();
     // return $ente->id;
          $where = [];
          $where[] = ['ente_publico_id', $usuario->ente_publico_id];    
          $where[] = ['tipo_usuario_id',8];    
          $where[] = ['status_usuario_id',1];    

           $ente = EntePublicoProponente::where('id',$usuario->ente_publico_id)->first();
            $ente->load('tipoProponente');

            $numPrototipos = Prototipo::where('ente_publico_proponente_id',$ente->id)->count();

          if(Auth::user()->isUserAtivo()){
            if(Auth::user()->isAceiteTermo()){
                
               
                    return view('views_prototipo.painel_prototipo', compact('usuario','numUsuarios','permissao','numPrototipos'));
               
            }else{                               
             return redirect('/prototipo/termo');
            } 
          }  
          else{
            
                  return view('views_prototipo.cadastro_ente_publico_proponente', compact('usuario','ente','tipoEnte'));
            
            
          }
          
    }  

    public function minhasPermissoes(){

        
         $usuario = Auth::user();
       // $permissoes = Permissoes::where('user_id',$usuario->id)->orderBy('created_at', 'desc')->get();
        
        $permissoes = Permissoes::join('users','users.id','=','tab_permissoes.user_id')
                    ->leftjoin('tab_ente_publico_proponente','users.ente_publico_id', '=','tab_ente_publico_proponente.id')
                   ->leftjoin('opc_status_permissao','tab_permissoes.status_permissao_id', '=','opc_status_permissao.id')
                    ->leftjoin('opc_tipo_indeferimento','tab_permissoes.tipo_indeferimento_id', '=','opc_tipo_indeferimento.id')
                    ->leftjoin('users as users2','users2.id','=','tab_permissoes.usuario_id_analise')
                    ->where('user_id',$usuario->id)
                    ->select('txt_ente_publico','users.txt_cpf_usuario',
                            'users.email','users.name','txt_status_permissao',
                            'opc_tipo_indeferimento.txt_tipo_indeferimento','users2.name as analisado_por',
                            'tab_permissoes.*')
                    ->orderBy('created_at', 'desc')
                            ->get();

         $wherePermissao = [];
          $wherePermissao[] = ['user_id',$usuario->id];    
          $wherePermissao[] = ['status_permissao_id','<=',2];   

          $permissaoDeferida = Permissoes::where($wherePermissao)->count();
           
        return view('views_prototipo.minhas_permissoes',compact('usuario','permissoes','permissaoDeferida'));
    }

    public function novoPrototipo(){
        $usuario = Auth::user();
         $ente = EntePublicoProponente::where('id',$usuario->ente_publico_id)->firstOrFail();       

        $municipio = Municipio::join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                ->select('txt_sigla_uf','ds_municipio')
                ->where('tab_municipios.id',$ente->municipio_id)->firstOrFail();   

    
        return view('views_prototipo.cadastrar_prototipo',compact('usuario','ente','municipio'));
    }

    public function salvarPrototipo(Request $request){
        //return $request->all();
        DB::beginTransaction();
        $usuario = Auth::user();
        
       
        
        $ente = EntePublicoProponente::where('id',$usuario->ente_publico_id)->firstOrFail();
        
        $where = [];
        $where[] = ['ente_publico_proponente_id',$usuario->ente_publico_id];    
        $where[] = ['txt_nome_prototipo',trim($request->txt_nome_prototipo)];    
        $where[] = ['municipio_id',trim($ente->municipio_id)];    

         $prototipoExiste = Prototipo::where($where)->first();

     

        if(!$prototipoExiste){
            $prototipo = New Prototipo;
            $prototipo->txt_nome_prototipo = trim($request->txt_nome_prototipo);
            $prototipo->municipio_id = $ente->municipio_id;
            $prototipo->ente_publico_proponente_id = $ente->id;
            $prototipo->situacao_prototipo_id = 1;
            $salvouPrototipo = $prototipo->save();
        }else{
            DB::rollBack();
            
            flash()->confirma("Erro", "Já existe um protótipo com o nome: ".trim($request->txt_nome_prototipo),'error');
            return back();
        }
        
           
        if (!$salvouPrototipo){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados do Prototipo salvo com sucesso!"); 

            return redirect('/prototipo/levantamento/'.$prototipo->id); 
            
        } 

    }

    
    public function iniciarLevantamento($prototipo_id){
        $usuario = Auth::user();
        $prototipo = Prototipo::where('id',$prototipo_id)->firstOrFail();     

        if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }
       
        return redirect("prototipo/iniciar/caracterizacaoTerreno/$prototipo_id")->with('usuario'); 
    }

    public function introducaoLevantamento($prototipo_id){
        
       $usuario = Auth::user();
       $ente = EntePublicoProponente::where('id',$usuario->ente_publico_id)->firstOrFail();       

       $municipio = Municipio::join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
               ->select('txt_sigla_uf','ds_municipio')
               ->where('tab_municipios.id',$ente->municipio_id)->firstOrFail();  
               
        $prototipo = Prototipo::where('id',$prototipo_id)->firstOrFail();     
        
        if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }


         return view('views_prototipo.inicio_levantamento',compact('usuario','ente','municipio','prototipo'));
   }

    public function listaPrototipos(){
 
            $usuario = Auth::user();
         $prototipos = Prototipo::join('opc_situacao_prototipo', 'opc_situacao_prototipo.id','tab_prototipo.situacao_prototipo_id')
                                        ->leftjoin('tab_caracterizacao_terreno', 'tab_caracterizacao_terreno.prototipo_id','tab_prototipo.id')
                                        ->leftjoin('tab_infraestrutura_basica', 'tab_infraestrutura_basica.prototipo_id','tab_prototipo.id')
                                        ->leftjoin('tab_insercao_urbana', 'tab_insercao_urbana.prototipo_id','tab_prototipo.id')
                                        ->select('tab_prototipo.*','txt_situacao_prototipo','tab_caracterizacao_terreno.id as caracterizacao_terreno_id',
                                                'tab_infraestrutura_basica.id as infraestrutura_basica_id', 'tab_insercao_urbana.id as insercao_urbana_id')
                                        ->where('ente_publico_proponente_id',$usuario->ente_publico_id)->get();
   
        return view('views_prototipo.lista_prototipos',compact('prototipos','usuario'));
    }
    
    public function abrirTermo(){
        
        //return Auth::user();
        if(Auth::user()->isUserAtivo()){
                   $tipoEnte = TipoEntePublico::select('id','txt_tipo_ente_publico as nome')->get();
                     $usuario = Auth::user();
                      $ente = EntePublicoProponente::where('id',$usuario->ente_publico_id)->firstOrFail();
                     

                  $municipio = Municipio::join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                             ->select('txt_sigla_uf','ds_municipio')
                            ->where('tab_municipios.id',$ente->municipio_id)->firstOrFail();   

                $dataExtenso = convertaDataExtenso(getdate());

                    
                return view('views_prototipo.termo_responsabilidade_prototipo', compact('usuario', 'ente','municipio','dataExtenso'));
        }else{
            return redirect('/prototipo');
        }
        
        
    }

    public function aceiteTermo(Request $request){
        //return $request->all();
        
        if($request->termo == true){
            $usuario = Auth::user();
            $usuario->bln_aceite_termo = true;      
            $usuario->dte_aceite_termo = Date("Y-m-d h:i:s");  
            
            //return $usuario;
            $salvouAceite = $usuario->save();
        }
        
      
         $numUsuarios = Auth::user()->getNumUsuarios($usuario); 

        if ($salvouAceite){
            flash()->sucesso("Sucesso", "Termo de Responsabilidade aceito de acordo com o disposto nos normativos vigentes do Programa.");   
            return redirect('/prototipo');    
            //return view('ente_publico.painel_ente_publico',compact('usuario','numUsuarios'));
                            
        } else {
            flash()->erro("Erro", "Não foi possível aceitar o Termo de Responsabilidade.");            
        }   
    }


    public function responderPerguntas ($prototipo_id){

       
         $usuario = Auth::user();

         $prototipo = Prototipo::where('id',$prototipo_id)->first();

        if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            return "teste if";
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }

       
        if($prototipo->situacao_prototipo_id == 1){
            return redirect("prototipo/levantamento/".$prototipo_id); 
        }else{ 
            if(!$prototipo->bln_caracterizacao_terreno){
                return redirect("prototipo/iniciar/caracterizacaoTerreno/".$prototipo_id); 
            }else{ 

                if(!$prototipo->bln_infraestrutura_basica){
                    return redirect('prototipo/iniciar/infraestruturaBasica/'.$prototipo_id); 
                }else{
                    if(!$prototipo->bln_insercao_urbana){
                        return redirect('prototipo/iniciar/insercaoUrbana/'.$prototipo_id); 
                    }else{
                                
                        return redirect('prototipo/show/levantamento/'.$prototipo_id);       
                    }    
                }    
            }
        }       

    }
    
      


    public function dadosPrototipo (Prototipo $prototipo){
        $usuario = Auth::user();
      

        if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }

        if($prototipo->situacao_prototipo_id <= 2){
            return redirect('/prototipo');
        }else{
            return view('views_prototipo.dados_prototipo ',compact('prototipo'));
        }
        
    }    
    public function dadosLevantamento ($prototipo_id){
       
        $usuario = Auth::user();
         $ente = EntePublicoProponente::where('id',$usuario->ente_publico_id)->firstOrFail();      
         
       
         
         $municipio = Municipio::join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
               ->select('txt_sigla_uf','ds_municipio')
               ->where('tab_municipios.id',$ente->municipio_id)->firstOrFail();   

               //$prototipo = Prototipo::where('ente_publico_proponente_id',$usuario->ente_publico_id)->first();   
                $prototipo = Prototipo::find($prototipo_id); 
                   $prototipo->load('situacaoPrototipo');    
                  
                  if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
                    flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
                    return redirect('/prototipo');
                }

                if($prototipo->situacao_prototipo_id <= 2){
                    return redirect('/propostas');
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
                 $where = [];
                 $where[] = ['modulo_sistema_id', 3];
                 $where[] = ['id', 2];
                 
                $configuracoes = Configuracoes::where($where)->first();

        if($prototipo->situacao_prototipo_id < 3){
            return view('views_prototipo.dados_prototipo ',compact('usuario','ente','municipio','prototipo','caracTerreno',
            'situacaoTerreno','concepcaoProjeto','insercaoUrbana','infraBasica','mapasInsercao','plantaTerreno','rotasInsercaoUrbana'));
       }else{
            return view('views_prototipo.dados_levantamento ',compact('usuario','ente','municipio','prototipo','caracTerreno',
            'situacaoTerreno','concepcaoProjeto','insercaoUrbana','infraBasica','mapasInsercao','plantaTerreno','rotasInsercaoUrbana'));
       }
         

        
   }

   public function concluirPreenchimento (Prototipo $prototipo){
      $usuario = Auth::user();   

      if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
        flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
        return redirect('/prototipo');
        }

    DB::beginTransaction();

   

    $prototipo->situacao_prototipo_id = 4;
   
    $prototipo->dte_prototipo_finalizado =  Date("Y-m-d h:i:s");
    $salvouPrototipo = $prototipo->save();

    if (!$salvouPrototipo){           
        DB::rollBack();
        flash()->erro("Erro", "Não foi possível enviar a proposta.");            
        return back();
    } else {
        DB::commit();
        flash()->sucesso("Sucesso", "Proposta enviada com sucesso!"); 
        return back()  ;
        
    } 

   }

   public function excluirPrototipo(Prototipo $prototipo){
       //return $prototipo;

       DB::beginTransaction();        
       $deletouPrototipo = false;
       $deletouCaracTerreno = false;
       $deletouInfraBasica = false;
       $deletouMapasInsercao = false;
       $deletouInsercaoUrbana = false;

       $prototipoId = $prototipo->id;
       
      
       if(($prototipo->situacao_prototipo_id > 1) && ($prototipo->situacao_prototipo_id <= 3) ){
       if($prototipo->bln_caracterizacao_terreno){
            $caracTerreno = TabCaracterizacaoTerreno::where('prototipo_id',$prototipoId)->first();        
                    
            unlink(public_path().'/'.$caracTerreno->txt_caminho_doc_cartorio);
            rmdir(public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipoId.'/doc_cartorio');

          if(!empty($caracTerreno->txt_caminho_dec_reassent))  {
            unlink(public_path().'/'.$caracTerreno->txt_caminho_dec_reassent);
            rmdir(public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipoId.'/doc_reassent');
          }
        
            $plantaTerreno = PlantaTerreno::where('caracterizacao_terreno_id',$caracTerreno->id)->get(); 

            foreach($plantaTerreno as $dados){
                 $dados->txt_caminho_planta;
                if($dados->txt_caminho_planta){
                    
                    unlink(public_path().'/'.$dados->txt_caminho_planta);
                    
                }
                $deletouPlanta = $dados->delete();
                
            }     
            rmdir(public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipoId.'/planta_terreno');     

            $deletouCaracTerreno = $caracTerreno->delete();
       }
     
        if($prototipo->bln_infraestrutura_basica){
            $infraBasica = TabInfraestrututaBasica::where('prototipo_id',$prototipoId)->first();        
            $deletouInfraBasica = $infraBasica->delete();
        }
        
        if($prototipo->bln_insercao_urbana){
        
            $insercaoUrbana = TabInsercaoUrbana::where('prototipo_id',$prototipoId)->first();        

            unlink(public_path().'/'.$insercaoUrbana->txt_caminho_registro_rota);
            rmdir(public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipoId.'/registro_rotas');

             $mapasInsercao = MapaInsercaoUrbana::where('insercao_urbana_id',$insercaoUrbana->id)->get(); 

            foreach($mapasInsercao as $dados){
                 $dados->txt_caminho_mapa;
                if($dados->txt_caminho_mapa){
                    
                    unlink(public_path().'/'.$dados->txt_caminho_mapa);
                    
                }
                $deletouMapasInsercao = $dados->delete();
                
            }     
            rmdir(public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipoId.'/doc_mapa');       
           
           

             $rotasInsercao = RotaInsercaoUrbana::where('insercao_urbana_id',$insercaoUrbana->id)->get(); 

            foreach($rotasInsercao as $dados){
                 $dados->txt_caminho_rotas;
                if($dados->txt_caminho_rotas){
                    
                    unlink(public_path().'/'.$dados->txt_caminho_rotas);
                    
                }
                $deletourotasInsercao = $dados->delete();
                
            }     
            rmdir(public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipoId.'/doc_rota');       
           
          
            $deletouInsercaoUrbana = $insercaoUrbana->delete();
           
        }

        //$deletouPrototipo = $prototipo->delete();
        //$concepcaoProjeto = TabConcepcaoProjeto::where('prototipo_id',$prototipoId)->first();     

        $path_arquivo = public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipoId;
                
        if(!File::isDirectory($path_arquivo)){
            File::makeDirectory($path_arquivo, 0777, true, true);
        }
      
        rmdir($path_arquivo);
    }else{
        $deletouCaracTerreno = true;
       $deletouInfraBasica = true;
       $deletouMapasInsercao = true;
       $deletouInsercaoUrbana = true;

      
    }
    
    $deletouPrototipo = $prototipo->delete();
        
        if (!$deletouPrototipo && !$deletouCaracTerreno && !$deletouInfraBasica && !$deletouMapasInsercao && !$deletouInsercaoUrbana){           
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível excluir a proposta.");            
            return back();
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Proposta excluída com sucesso!"); 
            return back()  ;
            
        } 

   }


}




