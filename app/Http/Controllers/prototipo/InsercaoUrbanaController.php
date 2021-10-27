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

use App\Mod_prototipo\RotaInsercaoUrbana;






class InsercaoUrbanaController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('entePublico');
        //$this->middleware('redirecionar');
        
    }

    public function insercaoUrbanaParte1($prototipo_id)
    {
        $usuario = Auth::user();
        $prototipo = Prototipo::where('id',$prototipo_id)->first();

        if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }

        if($prototipo->bln_insercao_urbana){
            return redirect('prototipo/show/levantamento/'.$prototipo->id);       
         }else{
            return view('views_prototipo.insercao_urbana_parte1',compact('prototipo'));
         }


    } 
    
    public function insercaoUrbanaSalvarParte1(Request $request)
    {

         //return $request->all();

          $usuario = Auth::user();
         $prototipo = Prototipo::find($request->prototipo_id);
        
         if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }
         
        DB::beginTransaction();

        
        $prototipo->bln_inspecao_parte1 = TRUE;
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
        $insercaoUrbana->vlr_dist_mts_supermercado = $request->vlr_dist_mts_supermercado;
        $insercaoUrbana->num_tempo_min_supermercado = $request->num_tempo_min_supermercado;
              
       
        $insercaoUrbana->bln_agencia_bancaria = $request->bln_agencia_bancaria;
        $insercaoUrbana->vlr_dist_mts_ag_bancaria = $request->vlr_dist_mts_ag_bancaria;
        $insercaoUrbana->num_tempo_min_ag_bancaria = $request->num_tempo_min_ag_bancaria;
        
       $insercaoUrbana->bln_agencia_correios = $request->bln_agencia_correios;
       $insercaoUrbana->vlr_dist_mts_correios = $request->vlr_dist_mts_correios;
       $insercaoUrbana->num_tempo_min_correios = $request->num_tempo_min_correios;  
       
            
       $insercaoUrbana->bln_loterica = $request->bln_loterica;
       $insercaoUrbana->vlr_dist_mts_loterica = $request->vlr_dist_mts_loterica;
       $insercaoUrbana->num_tempo_min_loterica = $request->num_tempo_min_loterica;  
       
      
              
       $insercaoUrbana->bln_escola_ed_infantil = $request->bln_escola_ed_infantil;
       $insercaoUrbana->vlr_dist_mts_ed_inf = $request->vlr_dist_mts_ed_inf;
       $insercaoUrbana->num_tempo_min_ed_inf = $request->num_tempo_min_ed_inf;
       
       $insercaoUrbana->bln_escola_ed_fund_ciclo_1 = $request->bln_escola_ed_fund_ciclo_1;
       $insercaoUrbana->vlr_dist_mts_ed_fund_c1 = $request->vlr_dist_mts_ed_fund_c1;
       $insercaoUrbana->num_tempo_min_ed_fund_c1 = $request->num_tempo_min_ed_fund_c1;
       
       
       $insercaoUrbana->bln_escola_ed_fund_ciclo_2 = $request->bln_escola_ed_fund_ciclo_2;
       $insercaoUrbana->vlr_dist_mts_ed_fund_c2 = $request->vlr_dist_mts_ed_fund_c2;
       $insercaoUrbana->num_tempo_min_ed_fund_c2 = $request->num_tempo_min_ed_fund_c2;
       
       $insercaoUrbana->bln_cras = $request->bln_cras;
       $insercaoUrbana->vlr_dist_mts_cras = $request->vlr_dist_mts_cras;
       $insercaoUrbana->num_tempo_min_cras = $request->num_tempo_min_cras;
       
       
       $insercaoUrbana->bln_ubs  = $request->bln_ubs ;
       $insercaoUrbana->vlr_dist_mts_ubs = $request->vlr_dist_mts_ubs;
       $insercaoUrbana->num_tempo_min_ubs = $request->num_tempo_min_ubs;
       
       $insercaoUrbana->bln_aeroporto_comercial  = $request->bln_aeroporto_comercial ;
       $insercaoUrbana->vlr_dist_km_aerop_comercial = $request->vlr_dist_km_aerop_comercial;
       $salvoInsercaoUrbana = $insercaoUrbana->save();
           

        
             
        if (!$salvouPrototipo || !$salvoInsercaoUrbana){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados de Inserção Urbana Parte 1 salvos com sucesso!"); 

            if($usuario->modalidade_participacao_id == 1){
                return redirect('prototipo/show/levantamento/'.$prototipo->id);       
            }else{
                return redirect('prototipo/iniciar/insercaoUrbana/parte2/'.$prototipo->id); 
            }
        } 
    }    

    public function insercaoUrbanaParte2($prototipo_id)
    {
        $usuario = Auth::user();
        $prototipo = Prototipo::where('id',$prototipo_id)->first();
         $insercaoUrbana = TabInsercaoUrbana::where('prototipo_id',$prototipo_id)->first();
        $mapasInsercaoUrbana = MapaInsercaoUrbana::where('insercao_urbana_id',$insercaoUrbana->id)->get();
        $rotasInsercaoUrbana = RotaInsercaoUrbana::where('insercao_urbana_id',$insercaoUrbana->id)->get();

        if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }

        if($prototipo->bln_insercao_urbana){
            return redirect('prototipo/show/levantamento/'.$prototipo->id);       
         }else{
            return view('views_prototipo.insercao_urbana_parte2',compact('prototipo','mapasInsercaoUrbana','rotasInsercaoUrbana'));
         }
    } 

    public function adicionarMapa(Request $request)
    {
        //return $request->all();
        $prototipo = Prototipo::where('id',$request->prototipoId)->first();
        $insercaoUrbana = TabInsercaoUrbana::where('prototipo_id',$request->prototipoId)->first();
       $mapasInsercaoUrbana = MapaInsercaoUrbana::where('insercao_urbana_id',$insercaoUrbana->id)->get();

        if($request->txt_caminho_mapa){               
         

                $arquivo = $request->txt_caminho_mapa;

            
                        
                    $salvoMapas = false;
                    
                    $nomeArqMapa = 'arqMapa-'.md5($arquivo->getClientOriginalName().Date("h:i:s")).'-'.$prototipo->id.'-'.$insercaoUrbana->id.'.'.$arquivo->extension();

                    

                    $path_arquivo = public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_mapa';
                        
                    if(!File::isDirectory($path_arquivo)){
                        File::makeDirectory($path_arquivo, 0777, true, true);
                    }
                    $caminho_mapa = $arquivo->storeAs('/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_mapa', $nomeArqMapa, 'arquivos');  


            }

            $mapas = new MapaInsercaoUrbana();

                $mapas->insercao_urbana_id = $insercaoUrbana->id;
                $mapas->txt_caminho_mapa = $caminho_mapa;
                $mapas->txt_nome_arquivo = $nomeArqMapa;
                $salvoMapas = $mapas->save();
           
             
        if ( !$salvoMapas){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível anexar o arquivo.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Arquivo anexado com sucesso!"); 

           
            

            if($request->acao == 'salvar'){
                return redirect('/prototipo/iniciar/insercaoUrbana/parte2/'.$insercaoUrbana->prototipo_id); 
            }else{
                return redirect('/prototipo/insercaoUrbana/editar/'.$insercaoUrbana->id); 
            }
        } 

    }  
    
    public function adicionarRota(Request $request)
    {
       // return $request->all();
        $prototipo = Prototipo::where('id',$request->prototipoId)->first();
        $insercaoUrbana = TabInsercaoUrbana::where('prototipo_id',$request->prototipoId)->first();
        $mapasInsercaoUrbana = MapaInsercaoUrbana::where('insercao_urbana_id',$insercaoUrbana->id)->get();
       $rotasInsercaoUrbana = RotaInsercaoUrbana::where('insercao_urbana_id',$insercaoUrbana->id)->get();

        if($request->txt_caminho_rota){               
         

                $arquivo = $request->txt_caminho_rota;

            
                        
                    $salvoRotas = false;
                    
                    $nomeArqRota = 'arqRota-'.md5($arquivo->getClientOriginalName().Date("h:i:s")).'-'.$prototipo->id.'-'.$insercaoUrbana->id.'.'.$arquivo->extension();

                    

                    $path_arquivo = public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_rota';
                        
                    if(!File::isDirectory($path_arquivo)){
                        File::makeDirectory($path_arquivo, 0777, true, true);
                    }
                    $caminho_rota = $arquivo->storeAs('/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_rota', $nomeArqRota, 'arquivos');  


            }

            $rotas = new RotaInsercaoUrbana();

                $rotas->insercao_urbana_id = $insercaoUrbana->id;
                $rotas->txt_caminho_rotas = $caminho_rota;
                $rotas->txt_nome_arquivo = $nomeArqRota;
                $salvoRotas = $rotas->save();
           
             
        if ( !$salvoRotas){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível anexar o arquivo.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Arquivo anexado com sucesso!"); 

            if($request->acao == 'salvar'){
                return redirect('/prototipo/iniciar/insercaoUrbana/parte2/'.$insercaoUrbana->prototipo_id); 
            }else{
                return redirect('/prototipo/insercaoUrbana/editar/'.$insercaoUrbana->id); 
            }
            
            
           
        } 

    }  


    public function insercaoUrbana($prototipo_id)
    {
        $usuario = Auth::user();
        $prototipo = Prototipo::where('id',$prototipo_id)->first();

        if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }

        if($prototipo->bln_insercao_urbana){
            return redirect('prototipo/show/levantamento/'.$prototipo->id);       
         }else{
            return view('views_prototipo.insercao_urbana',compact('prototipo'));
         }


    } 

    public function insercaoUrbanaSalvarParte2(Request $request)
    {

         //return $request->all();

          $usuario = Auth::user();
         $prototipo = Prototipo::find($request->prototipo_id);
        
         if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }
         
        DB::beginTransaction();

        if($usuario->modalidade_participacao_id == 1){
            $prototipo->situacao_prototipo_id = 2;
        }else{
            $prototipo->situacao_prototipo_id = 3;
        }    
        $prototipo->bln_insercao_urbana = TRUE;
        $prototipo->bln_inspecao_parte2 = TRUE;
        $prototipo->dte_conclusao_preenchimento =  Date("Y-m-d h:i:s");
        $prototipo->dte_conclusao_insercao_urbana =  Date("Y-m-d h:i:s");
        $salvouPrototipo = $prototipo->save();

          

        
             
        if (!$salvouPrototipo){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados de Inserção Urbana salvos com sucesso!"); 

            if($usuario->modalidade_participacao_id == 1){
                return redirect('prototipo/show/levantamento/'.$prototipo->id);       
            }else{
                return redirect('prototipo/show/levantamento/'.$prototipo->id); 
            }
        } 
    }     


    
  public function editarInsercaoUrbana ($insercaoUrbanaId){
    
    $insercaoUrbana = TabInsercaoUrbana::find($insercaoUrbanaId);
    $mapasInsercaoUrbana = MapaInsercaoUrbana::where('insercao_urbana_id',$insercaoUrbanaId)->get();
    $rotasInsercaoUrbana = RotaInsercaoUrbana::where('insercao_urbana_id',$insercaoUrbana->id)->get();
   $prototipo = Prototipo::where('id',$insercaoUrbana->prototipo_id)->first();

   $usuario = Auth::user();   
   if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
      flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
      return redirect('/prototipo');
  }

  return view('views_prototipo.editar_insercao_urbana',compact('insercaoUrbana','prototipo','mapasInsercaoUrbana','rotasInsercaoUrbana'));    

 }

 public function insercaoUrbanaUpdate(Request $request){
     // return $request->all();
       $insercaoUrbana = TabInsercaoUrbana::find($request->insercaoUrbanaId);
      $prototipo = Prototipo::find($insercaoUrbana->prototipo_id);

      $usuario = Auth::user();   
    if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
       flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
       return redirect('/prototipo');
   }


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
        $insercaoUrbana->vlr_dist_mts_supermercado = $request->vlr_dist_mts_supermercado;
        $insercaoUrbana->num_tempo_min_supermercado = $request->num_tempo_min_supermercado;
              
       
        $insercaoUrbana->bln_agencia_bancaria = $request->bln_agencia_bancaria;
        $insercaoUrbana->vlr_dist_mts_ag_bancaria = $request->vlr_dist_mts_ag_bancaria;
        $insercaoUrbana->num_tempo_min_ag_bancaria = $request->num_tempo_min_ag_bancaria;
        
       $insercaoUrbana->bln_agencia_correios = $request->bln_agencia_correios;
       $insercaoUrbana->vlr_dist_mts_correios = $request->vlr_dist_mts_correios;
       $insercaoUrbana->num_tempo_min_correios = $request->num_tempo_min_correios;  
       
            
       $insercaoUrbana->bln_loterica = $request->bln_loterica;
       $insercaoUrbana->vlr_dist_mts_loterica = $request->vlr_dist_mts_loterica;
       $insercaoUrbana->num_tempo_min_loterica = $request->num_tempo_min_loterica;  
       
       $insercaoUrbana->bln_restaurante_popular = $request->bln_restaurante_popular;
       $insercaoUrbana->vlr_dist_mts_rest_pop = $request->vlr_dist_mts_rest_pop;
       $insercaoUrbana->num_tempo_min_rest_pop = $request->num_tempo_min_rest_pop;
              
       $insercaoUrbana->bln_escola_ed_infantil = $request->bln_escola_ed_infantil;
       $insercaoUrbana->vlr_dist_mts_ed_inf = $request->vlr_dist_mts_ed_inf;
       $insercaoUrbana->num_tempo_min_ed_inf = $request->num_tempo_min_ed_inf;
       
       $insercaoUrbana->bln_escola_ed_fund_ciclo_1 = $request->bln_escola_ed_fund_ciclo_1;
       $insercaoUrbana->vlr_dist_mts_ed_fund_c1 = $request->vlr_dist_mts_ed_fund_c1;
       $insercaoUrbana->num_tempo_min_ed_fund_c1 = $request->num_tempo_min_ed_fund_c1;
       
       
       $insercaoUrbana->bln_escola_ed_fund_ciclo_2 = $request->bln_escola_ed_fund_ciclo_2;
       $insercaoUrbana->vlr_dist_mts_ed_fund_c2 = $request->vlr_dist_mts_ed_fund_c2;
       $insercaoUrbana->num_tempo_min_ed_fund_c2 = $request->num_tempo_min_ed_fund_c2;
       
       $insercaoUrbana->bln_cras = $request->bln_cras;
       $insercaoUrbana->vlr_dist_mts_cras = $request->vlr_dist_mts_cras;
       $insercaoUrbana->num_tempo_min_cras = $request->num_tempo_min_cras;
       
       
       $insercaoUrbana->bln_ubs  = $request->bln_ubs ;
       $insercaoUrbana->vlr_dist_mts_ubs = $request->vlr_dist_mts_ubs;
       $insercaoUrbana->num_tempo_min_ubs = $request->num_tempo_min_ubs;
       
       $insercaoUrbana->bln_aeroporto_comercial  = $request->bln_aeroporto_comercial ;
       $insercaoUrbana->vlr_dist_km_aerop_comercial = $request->vlr_dist_km_aerop_comercial;
      
       $caminho_registro_rota = '';

       if($request->file('txt_caminho_registro_rota')){
        $tipoAquivo = $request->file('txt_caminho_registro_rota')->getMimeType();
  

        $nomeArqInteresse = 'arqRegRotas-'.$prototipo->municipio_id.'-'.$prototipo->id.'.'.$request->file('txt_caminho_registro_rota')->extension();

         $path_arquivo_interesse = public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/registro_rotas';
           
       if(!File::isDirectory($path_arquivo_interesse)){
           File::makeDirectory($path_arquivo_interesse, 0777, true, true);
       }
       unlink(public_path().'/'.$insercaoUrbana->txt_caminho_registro_rota);

       $caminho_registro_rota = $request->file('txt_caminho_registro_rota')->storeAs('/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/registro_rotas', $nomeArqInteresse, 'arquivos');  
      
     
      
   }  
   if($caminho_registro_rota){
    $insercaoUrbana->txt_caminho_registro_rota = $caminho_registro_rota;
    }
    
       
if($request->file('txt_caminho_mapa')){   
    if(count($request->allFiles()['txt_caminho_mapa']) > 0){    
                
        for($i = 0; $i < count($request->allFiles()['txt_caminho_mapa']);$i++){
            

            $arquivo = $request->allFiles()['txt_caminho_mapa'][$i];

        
                    
                $salvoMapas = false;

                $nomeArqMapa = 'arqMapa-'.md5($arquivo->getClientOriginalName()).'-'.$prototipo->id.'-'.$insercaoUrbana->id.'-'.$i.'.'.$arquivo->extension();

                $path_arquivo = public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_mapa';
                    
                if(!File::isDirectory($path_arquivo)){
                    File::makeDirectory($path_arquivo, 0777, true, true);
                }
                $caminho_mapa = $arquivo->storeAs('/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_mapa', $nomeArqMapa, 'arquivos');  


            //  $caminho_mapa = $arquivo->storeAs('/uploads_arquivos/prototipo/prototipos/doc_mapa/'.$prototipo->id, $nomeArqMapa, 'arquivos');            
            /**
                $tipoAquivo = $arquivo->getMimeType();
                if(!verificaTipoArquivo($tipoAquivo)){
                    return back();
                }
        */

            $mapas = new MapaInsercaoUrbana();

            $mapas->insercao_urbana_id = $insercaoUrbana->id;
            $mapas->txt_caminho_mapa = $caminho_mapa;
            $mapas->txt_nome_arquivo = $nomeArqMapa;
            $salvoMapas = $mapas->save();
            unset($mapas);

        }
    }
}    

        $mapas = MapaInsercaoUrbana::where('insercao_urbana_id', $insercaoUrbana->id)->count();
        if($mapas == 0){
            flash()->erro('Arquivo', "Deve ser anexado pelo menos um mapa no item 3.3.");
            return back(); 
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

 public function insercaoUrbanaEditarParte1(Request $request){
    // return $request->all();

      $insercaoUrbana = TabInsercaoUrbana::find($request->insercaoUrbanaId);
     $prototipo = Prototipo::find($insercaoUrbana->prototipo_id);

     $usuario = Auth::user();   
   if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
      flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
      return redirect('/prototipo');
  }


     DB::beginTransaction();

     

  
     
     
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
       $insercaoUrbana->vlr_dist_mts_supermercado = $request->vlr_dist_mts_supermercado;
       $insercaoUrbana->num_tempo_min_supermercado = $request->num_tempo_min_supermercado;
             
      
       $insercaoUrbana->bln_agencia_bancaria = $request->bln_agencia_bancaria;
       $insercaoUrbana->vlr_dist_mts_ag_bancaria = $request->vlr_dist_mts_ag_bancaria;
       $insercaoUrbana->num_tempo_min_ag_bancaria = $request->num_tempo_min_ag_bancaria;
       
      $insercaoUrbana->bln_agencia_correios = $request->bln_agencia_correios;
      $insercaoUrbana->vlr_dist_mts_correios = $request->vlr_dist_mts_correios;
      $insercaoUrbana->num_tempo_min_correios = $request->num_tempo_min_correios;  
      
           
      $insercaoUrbana->bln_loterica = $request->bln_loterica;
      $insercaoUrbana->vlr_dist_mts_loterica = $request->vlr_dist_mts_loterica;
      $insercaoUrbana->num_tempo_min_loterica = $request->num_tempo_min_loterica;  
      
      $insercaoUrbana->bln_restaurante_popular = $request->bln_restaurante_popular;
      $insercaoUrbana->vlr_dist_mts_rest_pop = $request->vlr_dist_mts_rest_pop;
      $insercaoUrbana->num_tempo_min_rest_pop = $request->num_tempo_min_rest_pop;
             
      $insercaoUrbana->bln_escola_ed_infantil = $request->bln_escola_ed_infantil;
      $insercaoUrbana->vlr_dist_mts_ed_inf = $request->vlr_dist_mts_ed_inf;
      $insercaoUrbana->num_tempo_min_ed_inf = $request->num_tempo_min_ed_inf;
      
      $insercaoUrbana->bln_escola_ed_fund_ciclo_1 = $request->bln_escola_ed_fund_ciclo_1;
      $insercaoUrbana->vlr_dist_mts_ed_fund_c1 = $request->vlr_dist_mts_ed_fund_c1;
      $insercaoUrbana->num_tempo_min_ed_fund_c1 = $request->num_tempo_min_ed_fund_c1;
      
      
      $insercaoUrbana->bln_escola_ed_fund_ciclo_2 = $request->bln_escola_ed_fund_ciclo_2;
      $insercaoUrbana->vlr_dist_mts_ed_fund_c2 = $request->vlr_dist_mts_ed_fund_c2;
      $insercaoUrbana->num_tempo_min_ed_fund_c2 = $request->num_tempo_min_ed_fund_c2;
      
      $insercaoUrbana->bln_cras = $request->bln_cras;
      $insercaoUrbana->vlr_dist_mts_cras = $request->vlr_dist_mts_cras;
      $insercaoUrbana->num_tempo_min_cras = $request->num_tempo_min_cras;
      
      
      $insercaoUrbana->bln_ubs  = $request->bln_ubs ;
      $insercaoUrbana->vlr_dist_mts_ubs = $request->vlr_dist_mts_ubs;
      $insercaoUrbana->num_tempo_min_ubs = $request->num_tempo_min_ubs;
      
      $insercaoUrbana->bln_aeroporto_comercial  = $request->bln_aeroporto_comercial ;
      $insercaoUrbana->vlr_dist_km_aerop_comercial = $request->vlr_dist_km_aerop_comercial;
   
     $salvoInsercaoUrbana = $insercaoUrbana->save();
          
     if (!$salvoInsercaoUrbana){            
         DB::rollBack();
         flash()->erro("Erro", "Não foi possível atualizar os dados.");            
     } else {
         DB::commit();
         flash()->sucesso("Sucesso", "Dados de Inserção Urbana atualizados com sucesso!"); 

         return redirect('prototipo/show/levantamento/'.$prototipo->id); 
         
     }

}

 public function excluirMapa($mapaArquivoId){
    
    DB::beginTransaction();
    $mapaArquivo = MapaInsercaoUrbana::find($mapaArquivoId);
    $insercaoUrbanaId = $mapaArquivo->insercao_urbana_id;
    $insercaoUrbana = TabInsercaoUrbana::find($insercaoUrbanaId);

    $deletouRegistro = $mapaArquivo->delete();

     $path_arquivo = public_path().'/'.$mapaArquivo->txt_caminho_mapa;
     $arquivoDeletado = File::delete($path_arquivo);

     if (!$deletouRegistro || !$arquivoDeletado){            
        DB::rollBack();
        flash()->erro("Erro", "Não foi possível excluir o arquivo desejado.");            
    } else {
        DB::commit();
        flash()->sucesso("Sucesso", "Arquivo excluído com sucesso!"); 

        return redirect('/prototipo/iniciar/insercaoUrbana/parte2/'.$insercaoUrbana->prototipo_id); 
        
    }

 }

    public function excluirRota($rotaArquivoId){
    
        DB::beginTransaction();
        $rotaArquivo = RotaInsercaoUrbana::find($rotaArquivoId);
        $insercaoUrbanaId = $rotaArquivo->insercao_urbana_id;
        $insercaoUrbana = TabInsercaoUrbana::find($insercaoUrbanaId);
    
        $deletouRegistro = $rotaArquivo->delete();
    
         $path_arquivo = public_path().'/'.$rotaArquivo->txt_caminho_rotas;
         $arquivoDeletado = File::delete($path_arquivo);
    
         if (!$deletouRegistro || !$arquivoDeletado){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível excluir o arquivo desejado.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Arquivo excluído com sucesso!"); 
    
            return redirect('/prototipo/iniciar/insercaoUrbana/parte2/'.$insercaoUrbana->prototipo_id); 
            
        }
    
}


}

