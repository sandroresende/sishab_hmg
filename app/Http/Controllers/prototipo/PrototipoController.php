<?php

namespace App\Http\Controllers\prototipo;

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

use App\prototipo\Prototipo;
use App\prototipo\EntePublicoProponente;
use App\prototipo\TabCaracterizacaoTerreno;
use App\prototipo\TabInfraestrututaBasica;
use App\prototipo\TabConcepcaoProjeto;
use App\prototipo\TabInsercaoUrbana;
use App\prototipo\Permissoes;








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
          $wherePermissao[] = ['user_id',$usuario->id];    
          $wherePermissao[] = ['status_permissao_id',2];   

          $permissao = Permissoes::where($wherePermissao)->get();
     // return $ente->id;
          $where = [];
          $where[] = ['ente_publico_id', $usuario->ente_publico_id];    
          $where[] = ['tipo_usuario_id',8];    
          $where[] = ['status_usuario_id',1];    

           $ente = EntePublicoProponente::where('id',$usuario->ente_publico_id)->first();
            $ente->load('tipoProponente');

          if(Auth::user()->isUserAtivo()){
            if(Auth::user()->isAceiteTermo()){
                
               
                    return view('prototipo.painel_prototipo', compact('usuario','numUsuarios','permissao'));
               
            }else{                               
             return redirect('/prototipo/termo');
            } 
          }  
          else{
            
                  return view('prototipo.cadastro_ente_publico_proponente', compact('usuario','ente','tipoEnte'));
            
            
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
           
        return view('prototipo.minhas_permissoes',compact('usuario','permissoes','permissaoDeferida'));
    }
    public function novoPrototipo(){
        $usuario = Auth::user();
        $ente = EntePublicoProponente::where('id',$usuario->ente_publico_id)->firstOrFail();       

        $municipio = Municipio::join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                ->select('txt_sigla_uf','ds_municipio')
                ->where('tab_municipios.id',$ente->municipio_id)->firstOrFail();   

    
        return view('prototipo.cadastrar_prototipo',compact('usuario','ente','municipio'));
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
        //return $prototipo_id;

        return redirect("prototipo/iniciar/caracterizacaoTerreno/$prototipo_id")->with('usuario'); 
    }

    public function introducaoLevantamento($prototipo_id){
        
        $usuario = Auth::user();
       $ente = EntePublicoProponente::where('id',$usuario->ente_publico_id)->firstOrFail();       

       $municipio = Municipio::join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
               ->select('txt_sigla_uf','ds_municipio')
               ->where('tab_municipios.id',$ente->municipio_id)->firstOrFail();  
               
        $prototipo = Prototipo::where('id',$prototipo_id)->firstOrFail();        
         return view('prototipo.inicio_levantamento',compact('usuario','ente','municipio','prototipo'));
   }

    public function listaPrototipos($usuario_id){
 
            $usuario = User::where('id',$usuario_id)->firstOrFail();
         $prototipos = Prototipo::join('opc_situacao_prototipo', 'opc_situacao_prototipo.id','tab_prototipo.situacao_prototipo_id')
                                        ->select('tab_prototipo.*','txt_situacao_prototipo')
                                        ->where('ente_publico_proponente_id',$usuario->ente_publico_id)->get();
   
        return view('prototipo.lista_prototipos',compact('prototipos','usuario'));
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

                    
                return view('prototipo.termo_responsabilidade_prototipo', compact('usuario', 'ente','municipio','dataExtenso'));
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

       // return $prototipo;
        $prototipo = Prototipo::where('id',$prototipo_id)->first();

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
                                
                        if(!$prototipo->bln_concepcao_projeto){
                            return redirect('prototipo/iniciar/concepcaoProjeto/'.$prototipo_id); 
                        }else{
                                    
                            return redirect('prototipo/show/levantamento/'.$prototipo_id); 
                        }
                    }    
                }    
            }
        }       

    }
    public function caracterizacaoTerreno($prototipo_id)
    {
         $prototipo = Prototipo::where('id',$prototipo_id)->first();
         if($prototipo->bln_caracterizacao_terreno){
            return redirect('prototipo/iniciar/infraestruturaBasica',compact('prototipo')); 
         }else{
            return view('prototipo.caracterizacao_terreno',compact('prototipo'));
         }
       
    }

    public function caracterizacaoTerrenoSalvar(Request $request)
    {
        // return $request->all();
       
         $usuario = Auth::user();
         $prototipo = Prototipo::find($request->prototipo_id);

         $caminho_doc_cartorio = "";
        if($request->file('txt_caminho_doc_cartorio')){
            $tipoAquivo = $request->file('txt_caminho_doc_cartorio')->getMimeType();
            if(!verificaTipoArquivo($tipoAquivo)){
                return back();
            }

            
             $nomeArqCartorio = 'arqCartorio-'.$prototipo->municipio_id.'-'.$prototipo->id.'.'.$request->file('txt_caminho_doc_cartorio')->extension();
             $path_arquivo = public_path() . '/uploads_arquivos/prototipo/doc_cartorio/'.$prototipo->id;
                
             
                if(!File::isDirectory($path_arquivo)){
                    
                    File::makeDirectory($path_arquivo, 0777, true, true);
                }
            
            $caminho_doc_cartorio = $request->file('txt_caminho_doc_cartorio')->storeAs('/uploads_arquivos/prototipo/doc_cartorio/'.$prototipo->id, $nomeArqCartorio, 'arquivos');  

           // return var_dump($caminho_doc_cartorio); 
           
            
        }

        $caminho_dec_interesse = "";

        if($request->file('txt_caminho_dec_interesse')){
            $tipoAquivo = $request->file('txt_caminho_dec_interesse')->getMimeType();
            if(!verificaTipoArquivo($tipoAquivo)){
                return back();
            }

            $nomeArqInteresse = 'arqInteresse-'.$prototipo->municipio_id.'-'.$prototipo->id.'.'.$request->file('txt_caminho_dec_interesse')->extension();

            $path_arquivo_interesse = public_path(). '/uploads_arquivos/prototipo/doc_interesse/'.$prototipo->id;
                
            if(!File::isDirectory($path_arquivo_interesse)){
                File::makeDirectory($path_arquivo_interesse, 0777, true, true);
            }
            $caminho_dec_interesse = $request->file('txt_caminho_dec_interesse')->storeAs('/uploads_arquivos/prototipo/doc_interesse/'.$prototipo->id, $nomeArqInteresse, 'arquivos');  


            //$caminho_dec_interesse = $request->file('txt_caminho_dec_interesse')->storeAs('/uploads_arquivos/prototipo/doc_interesse/'.$prototipo->id, $nomeArqInteresse, 'arquivos');
           
        }  

        DB::beginTransaction();

        $prototipo->situacao_prototipo_id = 2;
        $prototipo->bln_caracterizacao_terreno = TRUE;
        $prototipo->dte_conclusao_caracterizacao_terreno =  Date("Y-m-d h:i:s");
        $salvouPrototipo = $prototipo->save();

        //DADOS DO UPLOAD ARQUIVO
         
   


        $caracTerreno = new TabCaracterizacaoTerreno();
        $caracTerreno->prototipo_id =   $prototipo->id;

        $caracTerreno->txt_caminho_doc_cartorio = $caminho_doc_cartorio;
        $caracTerreno->txt_caminho_dec_interesse = $caminho_dec_interesse;
        
        
        
        
        $caracTerreno->vlr_area_terreno = $request->vlr_area_terreno;
        $caracTerreno->titularidade_terreno_id = $request->titularidade_terreno;
        $caracTerreno->txt_terreno_terceiro = $request->txt_terreno_terceiro;
        $caracTerreno->bln_terreno_ocupado = $request->terreno_ocupado;
        $caracTerreno->txt_ocupacao = $request->txt_ocupacao;
        $caracTerreno->txt_terreno_area_risco = $request->terreno_area_risco;
        $caracTerreno->tipo_risco_id = $request->tipo_risco;
        $caracTerreno->bln_terreno_reis_ociosidade = $request->bln_terreno_reis_ociosidade;
        $caracTerreno->txt_observacao = $request->txt_observacao;
        $salvoCaracTerreno = $caracTerreno->save();



       // || !$salvoComSucessoEnte
        
        if (!$salvouPrototipo || !$salvoCaracTerreno){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados de Caracterização do Terreno salvo com sucesso!"); 

            return redirect('prototipo/iniciar/infraestruturaBasica/'.$prototipo->id); 
            
        } 


        
    } 
    
    public function infraestruturaBasica($prototipo_id)
    {
        
          $prototipo = Prototipo::where('id',$prototipo_id)->first();

        if($prototipo->bln_infraestrutura_basica){
            return redirect('prototipo/iniciar/insercaoUrbana/'.$prototipo->id); 
         }else{
            return view('prototipo.infraestrutura_basica',compact('prototipo'));
         }
    } 

    public function infraestruturaBasicaSalvar(Request $request)

    
    {
        $usuario = Auth::user();
        $prototipo = Prototipo::find($request->prototipo_id);

        DB::beginTransaction();

        $prototipo->situacao_prototipo_id = 2;
        $prototipo->bln_infraestrutura_basica = TRUE;
        $prototipo->dte_conclusao_infraestrutura_basica =  Date("Y-m-d h:i:s");
        $salvouPrototipo = $prototipo->save();

        //return $request->all();
        
        $infraestruturaBasica = new TabInfraestrututaBasica();
        $infraestruturaBasica->prototipo_id = $prototipo->id;
       // $infraestruturaBasica->infraestrutura_basica_id = $request->infraestrututa_basica;
        $infraestruturaBasica->bln_obras_andamento = $request->bln_obras_andamento;
        $infraestruturaBasica->txt_sistema_em_obras = $request->txt_sistema_em_obras;
        $infraestruturaBasica->txt_origem_recurso = $request->txt_origem_recurso;
        $infraestruturaBasica->dte_termino_obras = $request->dte_termino_obras;

        

        if($request->bln_sistema_abastecimento == true){
            $infraestruturaBasica->bln_sistema_abastecimento = true;
        }else{
            $infraestruturaBasica->bln_sistema_abastecimento = false;
        }

        if($request->bln_sistema_coleta_esgoto == true){
            $infraestruturaBasica->bln_sistema_coleta_esgoto = true;
        }else{
            $infraestruturaBasica->bln_sistema_coleta_esgoto = false;
        }

        if($request->bln_sistema_renagem_ag_pluviais == true){
            $infraestruturaBasica->bln_sistema_renagem_ag_pluviais = true;
        }else{
            $infraestruturaBasica->bln_sistema_renagem_ag_pluviais = false;
        }
        
        if($request->bln_dist_energia_eletrica == true){
            $infraestruturaBasica->bln_dist_energia_eletrica = true;
        }else{
            $infraestruturaBasica->bln_dist_energia_eletrica = false;
        }
       
        if($request->bln_iluminacao_publica == true){
            $infraestruturaBasica->bln_iluminacao_publica = true;
        }else{
            $infraestruturaBasica->bln_iluminacao_publica = false;
        }
        
        if($request->bln_guias_sarjetas == true){
            $infraestruturaBasica->bln_guias_sarjetas = true;
        }else{
            $infraestruturaBasica->bln_guias_sarjetas = false;
        }  

        if($request->bln_pavimentacao == true){
            $infraestruturaBasica->bln_pavimentacao = true;
        }else{
            $infraestruturaBasica->bln_pavimentacao = false;
        }         

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
    
    public function insercaoUrbana($prototipo_id)
    {
        $prototipo = Prototipo::where('id',$prototipo_id)->first();

        if($prototipo->bln_insercao_urbana){
            return redirect('prototipo/iniciar/concepcaoProjeto/'.$prototipo->id); 
         }else{
            return view('prototipo.insercao_urbana',compact('prototipo'));
         }


    } 

    public function insercaoUrbanaSalvar(Request $request)
    {

         //return $request->all();

        $usuario = Auth::user();
        $prototipo = Prototipo::find($request->prototipo_id);

        DB::beginTransaction();

        $prototipo->situacao_prototipo_id = 2;
        $prototipo->bln_insercao_urbana = TRUE;
        $prototipo->dte_conclusao_insercao_urbana =  Date("Y-m-d h:i:s");
        $salvouPrototipo = $prototipo->save();

     
        $insercaoUrbana = new TabInsercaoUrbana();
        $insercaoUrbana->prototipo_id =   $prototipo->id;
        $insercaoUrbana->bln_transporte_publico_coletivo = $request->bln_transporte_publico_coletivo;
        $insercaoUrbana->vlr_distancia_ponto = $request->vlr_distancia_ponto;
        $insercaoUrbana->num_itinerarios = $request->num_itinerarios;
        $insercaoUrbana->bln_equip_esporte_cultura = $request->bln_equip_esporte_cultura;
        $insercaoUrbana->txt_equip_esporte_cultura = $request->txt_equip_esporte_cultura;
        $insercaoUrbana->vlr_dist_mts_eq_esp_cult = $request->vlr_dist_mts_eq_esp_cult;
        $insercaoUrbana->num_tempo_min_eq_esp_cult = $request->num_tempo_min_eq_esp_cult;
        $insercaoUrbana->bln_mercadinho_mercado = $request->bln_mercadinho_mercado;
        $insercaoUrbana->vlr_dist_mts_mercadinho = $request->vlr_dist_mts_mercadinho;
        $insercaoUrbana->bln_padaria = $request->bln_padaria;
        $insercaoUrbana->vlr_dist_mts_padaria = $request->vlr_dist_mts_padaria;
        $insercaoUrbana->bln_farmacia = $request->bln_farmacia;
        $insercaoUrbana->vlr_dist_mts_farmacia = $request->vlr_dist_mts_farmacia;


        $insercaoUrbana->bln_supermercado = $request->bln_supermercado;
       if($request->radioDisttempSuperm == "distancia"){
            $insercaoUrbana->vlr_dist_mts_supermercado = $request->vlr_dist_mts_supermercado;
            $insercaoUrbana->num_tempo_min_supermercado = 0;
       }else if($request->radioDisttempSuperm == "tempo"){
            $insercaoUrbana->vlr_dist_mts_supermercado = 0;
            $insercaoUrbana->num_tempo_min_supermercado = $request->num_tempo_min_supermercado;
       }       
       
       $insercaoUrbana->bln_agencia_bancaria = $request->bln_agencia_bancaria;
       if($request->radioDisttempAgBancaria == "distancia"){
            $insercaoUrbana->vlr_dist_mts_ag_bancaria = $request->vlr_dist_mts_ag_bancaria;
            $insercaoUrbana->num_tempo_min_ag_bancaria = 0;
        }else if($request->radioDisttempAgBancaria == "tempo"){
            $insercaoUrbana->vlr_dist_mts_ag_bancaria = 0;
            $insercaoUrbana->num_tempo_min_ag_bancaria = $request->num_tempo_min_ag_bancaria;
        }
       
       $insercaoUrbana->bln_agencia_correios = $request->bln_agencia_correios;
       if($request->radioDisttempCorreios == "distancia"){
            $insercaoUrbana->vlr_dist_mts_correios = $request->vlr_dist_mts_correios;
            $insercaoUrbana->num_tempo_min_correios = 0;  
        }else if($request->radioDisttempCorreios == "tempo"){
            $insercaoUrbana->vlr_dist_mts_correios = 0;
            $insercaoUrbana->num_tempo_min_correios = $request->num_tempo_min_correios;  
        }
            
       $insercaoUrbana->bln_centro_comercial = $request->bln_centro_comercial;
       if($request->radioDisttempCenCom == "distancia"){
            $insercaoUrbana->vlr_dist_mts_cent_comerc = $request->vlr_dist_mts_cent_comerc;
            $insercaoUrbana->num_tempo_min_cent_comerc = 0;
        }else if($request->radioDisttempCenCom == "tempo"){
            $insercaoUrbana->vlr_dist_mts_cent_comerc = 0;
            $insercaoUrbana->num_tempo_min_cent_comerc = $request->num_tempo_min_cent_comerc;  
        }
       
       $insercaoUrbana->bln_restaurante_popular = $request->bln_restaurante_popular;
       if($request->radioDisttempRestPopular == "distancia"){
            $insercaoUrbana->vlr_dist_mts_rest_pop = $request->vlr_dist_mts_rest_pop;
            $insercaoUrbana->num_tempo_min_rest_pop = 0;
        }else if($request->radioDisttempRestPopular == "tempo"){
            $insercaoUrbana->vlr_dist_mts_rest_pop = 0;
            $insercaoUrbana->num_tempo_min_rest_pop = $request->num_tempo_min_rest_pop;
        }
       
       $insercaoUrbana->bln_escola_ed_infantil = $request->bln_escola_ed_infantil;
       if($request->radioDisttempEdInf == "distancia"){
            $insercaoUrbana->vlr_dist_mts_ed_inf = $request->vlr_dist_mts_ed_inf;
            $insercaoUrbana->num_tempo_min_ed_inf = 0;
        }else if($request->radioDisttempEdInf == "tempo"){
            $insercaoUrbana->vlr_dist_mts_ed_inf = 0;
            $insercaoUrbana->num_tempo_min_ed_inf = $request->num_tempo_min_ed_inf;
        }
       
       $insercaoUrbana->bln_escola_ed_fund_ciclo_1 = $request->bln_escola_ed_fund_ciclo_1;
       if($request->radioDisttempEdFund1 == "distancia"){
            $insercaoUrbana->vlr_dist_mts_ed_fund_c1 = $request->vlr_dist_mts_ed_fund_c1;
            $insercaoUrbana->num_tempo_min_ed_fund_c1 = 0;
        }else if($request->radioDisttempEdFund1 == "tempo"){
            $insercaoUrbana->vlr_dist_mts_ed_fund_c1 = 0;
            $insercaoUrbana->num_tempo_min_ed_fund_c1 = $request->num_tempo_min_ed_fund_c1;
        }
       
       $insercaoUrbana->bln_escola_ed_fund_ciclo_2 = $request->bln_escola_ed_fund_ciclo_2;
       if($request->radioDisttempEdFund2 == "distancia"){
            $insercaoUrbana->vlr_dist_mts_ed_fund_c2 = $request->vlr_dist_mts_ed_fund_c2;
            $insercaoUrbana->num_tempo_min_ed_fund_c2 = 0;
        }else if($request->radioDisttempEdFund2 == "tempo"){
            $insercaoUrbana->vlr_dist_mts_ed_fund_c2 = 0;
            $insercaoUrbana->num_tempo_min_ed_fund_c2 = $request->num_tempo_min_ed_fund_c2;
        }
       
       $insercaoUrbana->bln_cras = $request->bln_cras;
       if($request->radioDisttempCras == "distancia"){
            $insercaoUrbana->vlr_dist_mts_cras = $request->vlr_dist_mts_cras;
            $insercaoUrbana->num_tempo_min_cras = 0;
        }else if($request->radioDisttempCras == "tempo"){
            $insercaoUrbana->vlr_dist_mts_cras = 0;
            $insercaoUrbana->num_tempo_min_cras = $request->num_tempo_min_cras;
        }
       
       $insercaoUrbana->bln_ubs  = $request->bln_ubs ;
       if($request->radioDisttempUbs == "distancia"){
            $insercaoUrbana->vlr_dist_mts_ubs = $request->vlr_dist_mts_ubs;
            $insercaoUrbana->num_tempo_min_ubs = 0;
        }else if($request->radioDisttempUbs == "tempo"){
            $insercaoUrbana->vlr_dist_mts_ubs = 0;
            $insercaoUrbana->num_tempo_min_ubs = $request->num_tempo_min_ubs;
        }
        

        if($request->file('txt_caminho_mapa')){
            $nomeArqMapa = 'arqMapa-'.$prototipo->municipio_id.'-'.$prototipo->id.'.'.$request->file('txt_caminho_mapa')->extension();

            $path_arquivo = public_path(). '/uploads_arquivos/prototipo/doc_mapa/'.$prototipo->id;
                
            if(!File::isDirectory($path_arquivo)){
                File::makeDirectory($path_arquivo, 0777, true, true);
            }
            $caminho_mapa = $request->file('txt_caminho_mapa')->storeAs('/uploads_arquivos/prototipo/doc_mapa/'.$prototipo->id, $nomeArqMapa, 'arquivos');  


          //  $caminho_mapa = $request->file('txt_caminho_mapa')->storeAs('/uploads_arquivos/prototipo/doc_mapa/'.$prototipo->id, $nomeArqMapa, 'arquivos');            
            $tipoAquivo = $request->file('txt_caminho_mapa')->getMimeType();
            if(!verificaTipoArquivo($tipoAquivo)){
                return back();
            }
        }


        $insercaoUrbana->txt_caminho_mapa = $caminho_mapa;

        $salvoInsercaoUrbana = $insercaoUrbana->save();
             
        if (!$salvouPrototipo || !$salvoInsercaoUrbana){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados de Inserção Urbana salvos com sucesso!"); 

            return redirect('prototipo/iniciar/concepcaoProjeto/'.$prototipo->id); 
            
        } 

       
        
    } 

    public function concepcaoProjeto($prototipo_id)
    {
        //return $request->all();
        $prototipo = Prototipo::where('id',$prototipo_id)->first();

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



    public function dadosPrototipo (Prototipo $prototipo){
   //return $prototipo;

        return view('prototipo.dados_prototipo ',compact('prototipo'));
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
               $caracTerreno = TabCaracterizacaoTerreno::join('opc_titularidade_terreno','opc_titularidade_terreno.id','tab_caracterizacao_terreno.titularidade_terreno_id')
                                                                ->join('opc_tipo_risco','opc_tipo_risco.id','tab_caracterizacao_terreno.tipo_risco_id')
                                                                ->select('tab_caracterizacao_terreno.*','opc_titularidade_terreno.txt_titularidade_terreno','opc_tipo_risco.txt_tipo_risco')
                                                                ->where('prototipo_id',$prototipo->id)->first();        
               
                $infraBasica = TabInfraestrututaBasica::where('prototipo_id',$prototipo->id)->first();        
               
                 $insercaoUrbana = TabInsercaoUrbana::where('prototipo_id',$prototipo->id)->first();        

                 $concepcaoProjeto = TabConcepcaoProjeto::join('opc_tipo_organizacao','opc_tipo_organizacao.id','tab_concepcao_projeto.tipo_organizacao_id')
                                                                ->select('tab_concepcao_projeto.*','opc_tipo_organizacao.txt_tipo_organizacao')
                                                                ->where('prototipo_id',$prototipo->id)->first();        
               
               
               
       if($prototipo->situacao_prototipo_id == 4){
            return view('prototipo.dados_prototipo ',compact('usuario','ente','municipio','prototipo','caracTerreno','concepcaoProjeto','insercaoUrbana','infraBasica'));
       }else{
            return view('prototipo.dados_levantamento ',compact('usuario','ente','municipio','prototipo','caracTerreno','concepcaoProjeto','insercaoUrbana','infraBasica'));
       }
         

        
   }

   public function concluirPreenchimento (Prototipo $prototipo){
      $usuario = Auth::user();   

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

   public function editarCaracTerreno ($caracterizacaoTerrenoId){
    
    
     $caracterizacaoTerreno = TabCaracterizacaoTerreno::find($caracterizacaoTerrenoId);
     $prototipo = Prototipo::where('id',$caracterizacaoTerreno->prototipo_id)->first();
    return view('prototipo.editar_caracterizacao_terreno',compact('caracterizacaoTerreno'));    

   }

   public function caracterizacaoTerrenoUpdate(Request $request){
        //return $request->all();

        $caracTerreno = TabCaracterizacaoTerreno::find($request->caracterizacaoTerrenoId);
        $prototipo = Prototipo::find($caracTerreno->prototipo_id); 

        $caminho_doc_cartorio_edit = "";
        if($request->file('txt_caminho_doc_cartorio_edit')){
            $tipoAquivo = $request->file('txt_caminho_doc_cartorio_edit')->getMimeType();
            if(!verificaTipoArquivo($tipoAquivo)){
                return back();
            }

            //unlink(public_path() . $caracTerreno->txt_caminho_doc_cartorio);
            
             $nomeArqCartorio = 'arqCartorio-'.$prototipo->municipio_id.'-'.$prototipo->id.'.'.$request->file('txt_caminho_doc_cartorio_edit')->extension();
             $path_arquivo = public_path() . '/uploads_arquivos/prototipo/doc_cartorio/'.$prototipo->id;
                
             
                if(!File::isDirectory($path_arquivo)){
                    
                    File::makeDirectory($path_arquivo, 0777, true, true);
                }
            
            $caminho_doc_cartorio_edit = $request->file('txt_caminho_doc_cartorio_edit')->storeAs('/uploads_arquivos/prototipo/doc_cartorio/'.$prototipo->id, $nomeArqCartorio, 'arquivos');  

           // return var_dump($caminho_doc_cartorio); 
           
            
        }

        $caminho_dec_interesse_edit = "";

        if($request->file('txt_caminho_dec_interesse_edit')){
            $tipoAquivo = $request->file('txt_caminho_dec_interesse_edit')->getMimeType();
            if(!verificaTipoArquivo($tipoAquivo)){
                return back();
            }

            $nomeArqInteresse = 'arqInteresse-'.$prototipo->municipio_id.'-'.$prototipo->id.'.'.$request->file('txt_caminho_dec_interesse_edit')->extension();

            $path_arquivo_interesse = public_path(). '/uploads_arquivos/prototipo/doc_interesse/'.$prototipo->id;
                
            if(!File::isDirectory($path_arquivo_interesse)){
                File::makeDirectory($path_arquivo_interesse, 0777, true, true);
            }
            $caminho_dec_interesse_edit = $request->file('txt_caminho_dec_interesse_edit')->storeAs('/uploads_arquivos/prototipo/doc_interesse/'.$prototipo->id, $nomeArqInteresse, 'arquivos');  


            //$caminho_dec_interesse = $request->file('txt_caminho_dec_interesse')->storeAs('/uploads_arquivos/prototipo/doc_interesse/'.$prototipo->id, $nomeArqInteresse, 'arquivos');
           
        }  

        DB::beginTransaction();

        $prototipo->dte_conclusao_caracterizacao_terreno =  Date("Y-m-d h:i:s");
        $salvouPrototipo = $prototipo->save();

        //DADOS DO UPLOAD ARQUIVO      
        if($caminho_dec_interesse_edit){
        $caracTerreno->txt_caminho_doc_cartorio = $caminho_doc_cartorio_edit;
        }
        
        if($caminho_dec_interesse_edit){
            $caracTerreno->txt_caminho_dec_interesse = $caminho_dec_interesse_edit;
        }
        
        
        
        
        
        $caracTerreno->vlr_area_terreno = $request->vlr_area_terreno;
        $caracTerreno->titularidade_terreno_id = $request->titularidade_terreno;
        if($request->titularidade_terreno == 3){
            $caracTerreno->txt_terreno_terceiro = $request->txt_terreno_terceiro;
        }else{
            $caracTerreno->txt_terreno_terceiro = null;
        }
        
        $caracTerreno->bln_terreno_ocupado = $request->terreno_ocupado;
        if($request->terreno_ocupado == 1){
            $caracTerreno->txt_ocupacao = $request->txt_ocupacao;
        }else{
            $caracTerreno->txt_ocupacao = null;
        }
        //$caracTerreno->txt_ocupacao = $request->txt_ocupacao;

        $caracTerreno->txt_terreno_area_risco = $request->terreno_area_risco;
        if($request->terreno_area_risco == 1){
            $caracTerreno->tipo_risco_id = $request->tipo_risco;
        }else{
            $caracTerreno->tipo_risco_id = null;
        }
        
        $caracTerreno->bln_terreno_reis_ociosidade = $request->bln_terreno_reis_ociosidade;
        $caracTerreno->txt_observacao = $request->txt_observacao;
        $salvoCaracTerreno = $caracTerreno->save();



       // || !$salvoComSucessoEnte
        
        if (!$salvouPrototipo || !$salvoCaracTerreno){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados de Caracterização do Terreno alterados com sucesso!"); 

            return redirect('prototipo/show/levantamento/'.$prototipo->id); 
            
        } 
   }

   public function editarInfraBasica ($infraestrututaBasicaId){
    
    $infraestrututaBasica = TabInfraestrututaBasica::find($infraestrututaBasicaId);
    $prototipo = Prototipo::where('id',$infraestrututaBasica->prototipo_id)->first();
   return view('prototipo.editar_infraestrutura_basica',compact('infraestrututaBasica','prototipo'));    

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
        $infraestruturaBasica->bln_obras_andamento = $request->bln_obras_andamento;
        $infraestruturaBasica->txt_sistema_em_obras = $request->txt_sistema_em_obras;
        $infraestruturaBasica->txt_origem_recurso = $request->txt_origem_recurso;
        $infraestruturaBasica->dte_termino_obras = $request->dte_termino_obras;

        if($request->bln_sistema_abastecimento == true){
            $infraestruturaBasica->bln_sistema_abastecimento = true;
        }else{
            $infraestruturaBasica->bln_sistema_abastecimento = false;
        }

        if($request->bln_sistema_coleta_esgoto == true){
            $infraestruturaBasica->bln_sistema_coleta_esgoto = true;
        }else{
            $infraestruturaBasica->bln_sistema_coleta_esgoto = false;
        }

        if($request->bln_sistema_renagem_ag_pluviais == true){
            $infraestruturaBasica->bln_sistema_renagem_ag_pluviais = true;
        }else{
            $infraestruturaBasica->bln_sistema_renagem_ag_pluviais = false;
        }
        
        if($request->bln_dist_energia_eletrica == true){
            $infraestruturaBasica->bln_dist_energia_eletrica = true;
        }else{
            $infraestruturaBasica->bln_dist_energia_eletrica = false;
        }
       
        if($request->bln_iluminacao_publica == true){
            $infraestruturaBasica->bln_iluminacao_publica = true;
        }else{
            $infraestruturaBasica->bln_iluminacao_publica = false;
        }
        
        if($request->bln_guias_sarjetas == true){
            $infraestruturaBasica->bln_guias_sarjetas = true;
        }else{
            $infraestruturaBasica->bln_guias_sarjetas = false;
        }  

        if($request->bln_pavimentacao == true){
            $infraestruturaBasica->bln_pavimentacao = true;
        }else{
            $infraestruturaBasica->bln_pavimentacao = false;
        }  


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

 

  public function editarInsercaoUrbana ($insercaoUrbanaId){
    
     $insercaoUrbana = TabInsercaoUrbana::find($insercaoUrbanaId);
    $prototipo = Prototipo::where('id',$insercaoUrbana->prototipo_id)->first();
   return view('prototipo.editar_insercao_urbana',compact('insercaoUrbana','prototipo'));    

  }

  public function insercaoUrbanaUpdate(Request $request){
      // return $request->all();
        $insercaoUrbana = TabInsercaoUrbana::find($request->insercaoUrbanaId);
       $prototipo = Prototipo::find($insercaoUrbana->prototipo_id);

      

       DB::beginTransaction();

       
       $prototipo->bln_insercao_urbana = TRUE;
       $prototipo->dte_conclusao_insercao_urbana =  Date("Y-m-d h:i:s");
       $salvouPrototipo = $prototipo->save();

    
       
       
       $insercaoUrbana->bln_transporte_publico_coletivo = $request->bln_transporte_publico_coletivo;
       $insercaoUrbana->vlr_distancia_ponto = $request->vlr_distancia_ponto;
       $insercaoUrbana->num_itinerarios = $request->num_itinerarios;
       $insercaoUrbana->bln_equip_esporte_cultura = $request->bln_equip_esporte_cultura;
       $insercaoUrbana->txt_equip_esporte_cultura = $request->txt_equip_esporte_cultura;
       $insercaoUrbana->vlr_dist_mts_eq_esp_cult = $request->vlr_dist_mts_eq_esp_cult;
       $insercaoUrbana->num_tempo_min_eq_esp_cult = $request->num_tempo_min_eq_esp_cult;
       $insercaoUrbana->bln_mercadinho_mercado = $request->bln_mercadinho_mercado;
       $insercaoUrbana->vlr_dist_mts_mercadinho = $request->vlr_dist_mts_mercadinho;
       $insercaoUrbana->bln_padaria = $request->bln_padaria;
       $insercaoUrbana->vlr_dist_mts_padaria = $request->vlr_dist_mts_padaria;
       $insercaoUrbana->bln_farmacia = $request->bln_farmacia;
       $insercaoUrbana->vlr_dist_mts_farmacia = $request->vlr_dist_mts_farmacia;

       $insercaoUrbana->bln_supermercado = $request->bln_supermercado;
       if($request->radioDisttempSuperm == "distancia"){
            $insercaoUrbana->vlr_dist_mts_supermercado = $request->vlr_dist_mts_supermercado;
            $insercaoUrbana->num_tempo_min_supermercado = 0;
       }else if($request->radioDisttempSuperm == "tempo"){
            $insercaoUrbana->vlr_dist_mts_supermercado = 0;
            $insercaoUrbana->num_tempo_min_supermercado = $request->num_tempo_min_supermercado;
       }       
       
       $insercaoUrbana->bln_agencia_bancaria = $request->bln_agencia_bancaria;
       if($request->radioDisttempAgBancaria == "distancia"){
            $insercaoUrbana->vlr_dist_mts_ag_bancaria = $request->vlr_dist_mts_ag_bancaria;
            $insercaoUrbana->num_tempo_min_ag_bancaria = 0;
        }else if($request->radioDisttempAgBancaria == "tempo"){
            $insercaoUrbana->vlr_dist_mts_ag_bancaria = 0;
            $insercaoUrbana->num_tempo_min_ag_bancaria = $request->num_tempo_min_ag_bancaria;
        }
       
       $insercaoUrbana->bln_agencia_correios = $request->bln_agencia_correios;
       if($request->radioDisttempCorreios == "distancia"){
            $insercaoUrbana->vlr_dist_mts_correios = $request->vlr_dist_mts_correios;
            $insercaoUrbana->num_tempo_min_correios = 0;  
        }else if($request->radioDisttempCorreios == "tempo"){
            $insercaoUrbana->vlr_dist_mts_correios = 0;
            $insercaoUrbana->num_tempo_min_correios = $request->num_tempo_min_correios;  
        }
            
       $insercaoUrbana->bln_centro_comercial = $request->bln_centro_comercial;
       if($request->radioDisttempCenCom == "distancia"){
            $insercaoUrbana->vlr_dist_mts_cent_comerc = $request->vlr_dist_mts_cent_comerc;
            $insercaoUrbana->num_tempo_min_cent_comerc = 0;
        }else if($request->radioDisttempCenCom == "tempo"){
            $insercaoUrbana->vlr_dist_mts_cent_comerc = 0;
            $insercaoUrbana->num_tempo_min_cent_comerc = $request->num_tempo_min_cent_comerc;  
        }
       
       $insercaoUrbana->bln_restaurante_popular = $request->bln_restaurante_popular;
       if($request->radioDisttempRestPopular == "distancia"){
            $insercaoUrbana->vlr_dist_mts_rest_pop = $request->vlr_dist_mts_rest_pop;
            $insercaoUrbana->num_tempo_min_rest_pop = 0;
        }else if($request->radioDisttempRestPopular == "tempo"){
            $insercaoUrbana->vlr_dist_mts_rest_pop = 0;
            $insercaoUrbana->num_tempo_min_rest_pop = $request->num_tempo_min_rest_pop;
        }
       
       $insercaoUrbana->bln_escola_ed_infantil = $request->bln_escola_ed_infantil;
       if($request->radioDisttempEdInf == "distancia"){
            $insercaoUrbana->vlr_dist_mts_ed_inf = $request->vlr_dist_mts_ed_inf;
            $insercaoUrbana->num_tempo_min_ed_inf = 0;
        }else if($request->radioDisttempEdInf == "tempo"){
            $insercaoUrbana->vlr_dist_mts_ed_inf = 0;
            $insercaoUrbana->num_tempo_min_ed_inf = $request->num_tempo_min_ed_inf;
        }
       
       $insercaoUrbana->bln_escola_ed_fund_ciclo_1 = $request->bln_escola_ed_fund_ciclo_1;
       if($request->radioDisttempEdFund1 == "distancia"){
            $insercaoUrbana->vlr_dist_mts_ed_fund_c1 = $request->vlr_dist_mts_ed_fund_c1;
            $insercaoUrbana->num_tempo_min_ed_fund_c1 = 0;
        }else if($request->radioDisttempEdFund1 == "tempo"){
            $insercaoUrbana->vlr_dist_mts_ed_fund_c1 = 0;
            $insercaoUrbana->num_tempo_min_ed_fund_c1 = $request->num_tempo_min_ed_fund_c1;
        }
       
       $insercaoUrbana->bln_escola_ed_fund_ciclo_2 = $request->bln_escola_ed_fund_ciclo_2;
       if($request->radioDisttempEdFund2 == "distancia"){
            $insercaoUrbana->vlr_dist_mts_ed_fund_c2 = $request->vlr_dist_mts_ed_fund_c2;
            $insercaoUrbana->num_tempo_min_ed_fund_c2 = 0;
        }else if($request->radioDisttempEdFund2 == "tempo"){
            $insercaoUrbana->vlr_dist_mts_ed_fund_c2 = 0;
            $insercaoUrbana->num_tempo_min_ed_fund_c2 = $request->num_tempo_min_ed_fund_c2;
        }
       
       $insercaoUrbana->bln_cras = $request->bln_cras;
       if($request->radioDisttempCras == "distancia"){
            $insercaoUrbana->vlr_dist_mts_cras = $request->vlr_dist_mts_cras;
            $insercaoUrbana->num_tempo_min_cras = 0;
        }else if($request->radioDisttempCras == "tempo"){
            $insercaoUrbana->vlr_dist_mts_cras = 0;
            $insercaoUrbana->num_tempo_min_cras = $request->num_tempo_min_cras;
        }
       
       $insercaoUrbana->bln_ubs  = $request->bln_ubs ;
       if($request->radioDisttempUbs == "distancia"){
            $insercaoUrbana->vlr_dist_mts_ubs = $request->vlr_dist_mts_ubs;
            $insercaoUrbana->num_tempo_min_ubs = 0;
        }else if($request->radioDisttempUbs == "tempo"){
            $insercaoUrbana->vlr_dist_mts_ubs = 0;
            $insercaoUrbana->num_tempo_min_ubs = $request->num_tempo_min_ubs;
        }
       

       if($request->file('txt_caminho_mapa')){
           $nomeArqMapa = 'arqMapa-'.$prototipo->municipio_id.'-'.$prototipo->id.'.'.$request->file('txt_caminho_mapa')->extension();

           $path_arquivo = public_path(). '/uploads_arquivos/prototipo/doc_mapa/'.$prototipo->id;
               
           if(!File::isDirectory($path_arquivo)){
               File::makeDirectory($path_arquivo, 0777, true, true);
           }
           $caminho_mapa = $request->file('txt_caminho_mapa')->storeAs('/uploads_arquivos/prototipo/doc_mapa/'.$prototipo->id, $nomeArqMapa, 'arquivos');  


         //  $caminho_mapa = $request->file('txt_caminho_mapa')->storeAs('/uploads_arquivos/prototipo/doc_mapa/'.$prototipo->id, $nomeArqMapa, 'arquivos');            
           $tipoAquivo = $request->file('txt_caminho_mapa')->getMimeType();
           if(!verificaTipoArquivo($tipoAquivo)){
               return back();
           }
           $insercaoUrbana->txt_caminho_mapa = $caminho_mapa;
       }


       

       $salvoInsercaoUrbana = $insercaoUrbana->save();
            
       if (!$salvouPrototipo || !$salvoInsercaoUrbana){            
           DB::rollBack();
           flash()->erro("Erro", "Não foi possível atualizar os dados.");            
       } else {
           DB::commit();
           flash()->sucesso("Sucesso", "Dados de Inserção Urbana atualizados com sucesso!"); 

           return redirect('prototipo/show/levantamento/'.$prototipo->id); 
           
       }

  }

  public function editarConcepcaoProjeto ($concepcaoProjetoId){
    
    $concepcaoProjeto = TabConcepcaoProjeto::find($concepcaoProjetoId);
    $prototipo = Prototipo::where('id',$concepcaoProjeto->prototipo_id)->first();
   return view('prototipo.editar_concepcao_projeto',compact('concepcaoProjeto','prototipo'));    

  }

  public function concepcaoProjetoUpdate(Request $request){
       return $request->all();

  }

  

  

}




