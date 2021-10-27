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
use App\Mod_prototipo\PlantaTerreno;

class CaracterizacaoTerrenoController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('entePublico');
        //$this->middleware('redirecionar');
        
    }

    
    public function caracterizacaoTerrenoParte1($prototipo_id)
    {
         $usuario = Auth::user();
         $prototipo = Prototipo::where('id',$prototipo_id)->first();

         if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }

         if($prototipo->bln_caracterizacao_terreno){
            
            return redirect('prototipo/iniciar/infraestruturaBasica/'.$prototipo_id); 
         }else{
            
            return view('views_prototipo.caracterizacao_terreno_parte1',compact('prototipo'));
         }
       
    }

   

    public function caracterizacaoTerrenoSalvarParte1(Request $request)
    {
        $usuario = Auth::user();
        $prototipo = Prototipo::find($request->prototipo_id);

        if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
           flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
           return redirect('/prototipo');
       }

        $caminho_doc_cartorio = "";
       if($request->file('txt_caminho_doc_cartorio')){
           $tipoAquivo = $request->file('txt_caminho_doc_cartorio')->getMimeType();
           if(!verificaTipoArquivo($tipoAquivo)){
               return back();
           }

           
            $nomeArqCartorio = 'arqCartorio-'.$prototipo->municipio_id.'-'.$prototipo->id.'.'.$request->file('txt_caminho_doc_cartorio')->extension();
            $path_arquivo = public_path() . '/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_cartorio';
               
            
               if(!File::isDirectory($path_arquivo)){
                   
                   File::makeDirectory($path_arquivo, 0777, true, true);
               }
           
           $caminho_doc_cartorio = $request->file('txt_caminho_doc_cartorio')->storeAs('/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_cartorio', $nomeArqCartorio, 'arquivos');  
        }
          
        DB::beginTransaction();

        $prototipo->situacao_prototipo_id = 2;      
        $prototipo->bln_carac_parte1 = true;      
        $salvouPrototipo = $prototipo->save();

        $caracTerreno = new TabCaracterizacaoTerreno();
        $caracTerreno->prototipo_id =   $prototipo->id;

        $caracTerreno->txt_caminho_doc_cartorio = $caminho_doc_cartorio;
        
        $caracTerreno->vlr_coordenadas_terreno = $request->vlr_coordenadas_terreno;
        $caracTerreno->vlr_area_terreno = $request->vlr_area_terreno;
        $caracTerreno->txt_proprietario_terreno = $request->txt_proprietario_terreno;
        
        $caracTerreno->titularidade_terreno_id = $request->titularidade_terreno;
        $caracTerreno->txt_terreno_terceiro = $request->txt_terreno_terceiro;

        $caracTerreno->bln_terreno_parcelado = $request->terreno_parcelado; 

        $salvoCaracTerreno = $caracTerreno->save();

        if (!$salvouPrototipo || !$salvoCaracTerreno){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados de Caracterização do Terreno Parte 1 salvos com sucesso!"); 

            return redirect('prototipo/iniciar/caracterizacaoTerreno/parte2/'.$prototipo->id); 
            
        } 

           
       
    }

    public function caracterizacaoTerrenoParte2($prototipo_id)
    {
         $usuario = Auth::user();
         $prototipo = Prototipo::where('id',$prototipo_id)->first();

         if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }

         if($prototipo->bln_caracterizacao_terreno){
            
            return redirect('prototipo/iniciar/infraestruturaBasica/'.$prototipo_id); 
         }else{
            
            if(!$prototipo->bln_carac_parte1){
                return view('views_prototipo.caracterizacao_terreno_parte1',compact('prototipo'));
            }else{
                return view('views_prototipo.caracterizacao_terreno_parte2',compact('prototipo'));
            }
            
         }
       
    }

    public function caracterizacaoTerrenoSalvarParte2(Request $request)
    {
        //return $request->all();

        $usuario = Auth::user();
        $prototipo = Prototipo::find($request->prototipo_id);

        if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
           flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
           return redirect('/prototipo');
       }

       DB::beginTransaction();

        $prototipo->situacao_prototipo_id = 2;
        $prototipo->bln_carac_parte2 = true;
        $salvouPrototipo = $prototipo->save();

        $caracTerreno = TabCaracterizacaoTerreno::where('prototipo_id', $request->prototipo_id)->first();
        $caracTerreno->bln_terreno_ocupado = $request->terreno_ocupado;
        $caracTerreno->txt_ocupacao = $request->txt_ocupacao;

        $caminho_dec_reassent = "";

        if($request->file('txt_caminho_dec_reassent')){
            $tipoAquivo = $request->file('txt_caminho_dec_reassent')->getMimeType();
            if(!verificaTipoArquivo($tipoAquivo)){
                return back();
            }

            $nomeArqInteresse = 'arqReassent-'.$prototipo->municipio_id.'-'.$prototipo->id.'.'.$request->file('txt_caminho_dec_reassent')->extension();

            $path_arquivo_interesse = public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_reassent';
                
            if(!File::isDirectory($path_arquivo_interesse)){
                File::makeDirectory($path_arquivo_interesse, 0777, true, true);
            }
            $caminho_dec_reassent = $request->file('txt_caminho_dec_reassent')->storeAs('/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_reassent', $nomeArqInteresse, 'arquivos');  


            //$caminho_dec_interesse = $request->file('txt_caminho_dec_reassent')->storeAs('/uploads_arquivos/prototipo/prototipos/doc_interesse/'.$prototipo->id, $nomeArqInteresse, 'arquivos');
           
        }  
      
      
     

       if($caminho_dec_reassent){
        $caracTerreno->txt_caminho_dec_reassent = $caminho_dec_reassent;
       }
        $caracTerreno->txt_terreno_area_risco = $request->terreno_area_risco;
        $caracTerreno->tipo_risco_id = $request->tipo_risco;

        
        if($request->bln_terreno_zeis_ociosidade == 1){
            $caracTerreno->bln_terreno_zeis_ociosidade = $request->bln_terreno_zeis_ociosidade;
            $caracTerreno->txt_legislacao_zeis = $request->txt_legislacao_zeis;
        }else{
            $caracTerreno->bln_terreno_zeis_ociosidade = 0;
            $caracTerreno->txt_legislacao_zeis = null;
        }
       

        $caracTerreno->situacao_terreno_id = $request->situacao_terreno_id;
        $caracTerreno->txt_outra_situacao_terreno = $request->txt_outra_situacao_terreno;
        $caracTerreno->txt_legislacao_artigos = $request->txt_legislacao_artigos;

        $salvoCaracTerreno = $caracTerreno->update();

        if (!$salvouPrototipo || !$salvoCaracTerreno){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados de Caracterização do Terreno Parte 2 salvos com sucesso!"); 

            return redirect('prototipo/iniciar/caracterizacaoTerreno/parte3/'.$prototipo->id); 
            
        } 

    }   

    public function caracterizacaoTerrenoParte3($prototipo_id)
    {
         $usuario = Auth::user();
         $prototipo = Prototipo::where('id',$prototipo_id)->first();
         $caracTerreno = TabCaracterizacaoTerreno::where('prototipo_id', $prototipo_id)->first();

         $plantasTerreno = PlantaTerreno::where('caracterizacao_terreno_id',$caracTerreno->id)->get();
         if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
            flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
            return redirect('/prototipo');
        }

         if($prototipo->bln_caracterizacao_terreno){
            
            return redirect('prototipo/iniciar/infraestruturaBasica/'.$prototipo_id); 
         }else{
            
            if(!$prototipo->bln_carac_parte1){
                return view('views_prototipo.caracterizacao_terreno_parte1',compact('prototipo'));
            }elseif(!$prototipo->bln_carac_parte2){
                return view('views_prototipo.caracterizacao_terreno_parte2',compact('prototipo'));
            }else{
                return view('views_prototipo.caracterizacao_terreno_parte3',compact('prototipo','plantasTerreno'));
            }  
         }
       
    }

    public function adicionarPlanta(Request $request)
{
    
    

    $prototipo = Prototipo::where('id',$request->prototipoId)->first();
    $caracTerreno = TabCaracterizacaoTerreno::where('prototipo_id', $request->prototipoId)->first();

    DB::beginTransaction();

    if($request->txt_observacao2){
        $caracTerreno->txt_observacao = $request->txt_observacao2;
        $salvouCaracTerreno = $caracTerreno->save();    
    }

    $salvoplantaTerreno = '';

    if($request->file('txt_caminho_planta')){    
    
        
            $arquivo = $request->file('txt_caminho_planta');   
                    
                $salvoPlantas = false;
                 $nomeArqPlanta = 'arqPlanta-'.md5($arquivo->getClientOriginalName().Date("h:i:s")).'-'.$prototipo->id.'-'.'.'.$arquivo->extension();
                $path_arquivo = public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/planta_terreno';
                    
                if(!File::isDirectory($path_arquivo)){
                    File::makeDirectory($path_arquivo, 0777, true, true);
                }
                $caminho_Planta = $arquivo->storeAs('/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/planta_terreno', $nomeArqPlanta, 'arquivos');  
    
    
            
    
        }

        $plantaTerreno = new PlantaTerreno();
    
            $plantaTerreno->caracterizacao_terreno_id = $caracTerreno->id;
            $plantaTerreno->txt_caminho_planta = $caminho_Planta;
            $plantaTerreno->txt_nome_arquivo = $nomeArqPlanta;
            $salvoplantaTerreno = $plantaTerreno->save();

            
            //return $request->all();
         $plantasTerreno = PlantaTerreno::where('caracterizacao_terreno_id',$caracTerreno->id)->get();
            
            if (!$salvoplantaTerreno){            
                DB::rollBack();
                flash()->erro("Erro", "Não foi possível anexara o arquivo.");            
            } else {
                DB::commit();
                flash()->sucesso("Sucesso", "Arquivo anexado com sucesso!"); 

                if($request->acao == 'salvar'){
                    return view('views_prototipo.caracterizacao_terreno_parte3',compact('prototipo','plantasTerreno'));
                }else{
                    return redirect('/prototipo/caracterizacao_terreno/editar/'.$caracTerreno->id); 
                }
                
            } 
       

}
    

    public function caracterizacaoTerrenoSalvarParte3(Request $request)
    {
         //return $request->all();
       
        DB::beginTransaction();
        
        $prototipo = Prototipo::find($request->prototipo_id);
        $prototipo->situacao_prototipo_id = 2;
        $prototipo->bln_carac_parte3 = TRUE;
        $prototipo->bln_caracterizacao_terreno = TRUE;
        $prototipo->dte_conclusao_caracterizacao_terreno =  Date("Y-m-d h:i:s");
        $salvouPrototipo = $prototipo->save();

       
        $caracTerreno = TabCaracterizacaoTerreno::where('prototipo_id', $request->prototipo_id)->first();
        $caracTerreno->txt_observacao = $request->txt_observacao;
        $salvoCaracTerreno = $caracTerreno->save();
        
      
        if (!$salvouPrototipo || !$salvoCaracTerreno){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados de Caracterização do Terreno salvo com sucesso!"); 

            return redirect('prototipo/iniciar/infraestruturaBasica/'.$prototipo->id); 
            
        } 
    } 

    
   public function editarCaracTerreno ($caracterizacaoTerrenoId){
    
    
     $caracterizacaoTerreno = TabCaracterizacaoTerreno::find($caracterizacaoTerrenoId);
    $plantasTerreno = PlantaTerreno::where('caracterizacao_terreno_id',$caracterizacaoTerreno->id)->get();
    $prototipo = Prototipo::where('id',$caracterizacaoTerreno->prototipo_id)->first();
    $usuario = Auth::user();   
    if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
       flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
       return redirect('/prototipo');
   }
   
   return view('views_prototipo.editar_caracterizacao_terreno',compact('caracterizacaoTerreno','plantasTerreno','prototipo'));    

  }

  public function caracterizacaoTerrenoEditarParte1(Request $request)
  {
      $usuario = Auth::user();
      $prototipo = Prototipo::find($request->prototipo_id);

      if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
         flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
         return redirect('/prototipo');
     }

     $caracTerreno = TabCaracterizacaoTerreno::find($request->caracterizacaoTerrenoId);

     if($request->file('txt_caminho_doc_cartorio')){
         $tipoAquivo = $request->file('txt_caminho_doc_cartorio')->getMimeType();
         if(!verificaTipoArquivo($tipoAquivo)){
             return back();
         }

          $nomeArqCartorio = 'arqCartorio-'.$prototipo->municipio_id.'-'.$prototipo->id.'.'.$request->file('txt_caminho_doc_cartorio')->extension();
          $path_arquivo = public_path() . '/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_cartorio';
          
             if(!File::isDirectory($path_arquivo)){
                 
                 File::makeDirectory($path_arquivo, 0777, true, true);
             }
         
         $caminho_doc_cartorio = $request->file('txt_caminho_doc_cartorio')->storeAs('/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_cartorio', $nomeArqCartorio, 'arquivos');  
         $caracTerreno->txt_caminho_doc_cartorio = $caminho_doc_cartorio;
    }
        
      DB::beginTransaction();
      
      $caracTerreno->prototipo_id =   $prototipo->id;
      $caracTerreno->vlr_coordenadas_terreno = $request->vlr_coordenadas_terreno;
      $caracTerreno->vlr_area_terreno = $request->vlr_area_terreno;
      $caracTerreno->txt_proprietario_terreno = $request->txt_proprietario_terreno;
      
      $caracTerreno->titularidade_terreno_id = $request->titularidade_terreno;
      $caracTerreno->txt_terreno_terceiro = $request->txt_terreno_terceiro;

      $caracTerreno->bln_terreno_parcelado = $request->terreno_parcelado; 

      $salvoCaracTerreno = $caracTerreno->save();

      if (!$salvoCaracTerreno){            
          DB::rollBack();
          flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
      } else {
          DB::commit();
          flash()->sucesso("Sucesso", "Dados de Caracterização do Terreno Parte 1 salvos com sucesso!"); 

          return redirect('prototipo/caracterizacao_terreno/editar/'.$caracTerreno->id); 
      } 
  }

  public function caracterizacaoTerrenoEditarParte2(Request $request)
    {
        //return $request->all();

        $usuario = Auth::user();
        $prototipo = Prototipo::find($request->prototipo_id);

        if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
           flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
           return redirect('/prototipo');
       }

       DB::beginTransaction();



       $caracTerreno = TabCaracterizacaoTerreno::find($request->caracterizacaoTerrenoId);

        $caracTerreno->bln_terreno_ocupado = $request->terreno_ocupado;
        $caracTerreno->txt_ocupacao = $request->txt_ocupacao;

       

        if($request->file('txt_caminho_dec_reassent')){
            $tipoAquivo = $request->file('txt_caminho_dec_reassent')->getMimeType();
            if(!verificaTipoArquivo($tipoAquivo)){
                return back();
            }

            $nomeArqInteresse = 'arqReassent-'.$prototipo->municipio_id.'-'.$prototipo->id.'.'.$request->file('txt_caminho_dec_reassent')->extension();

            $path_arquivo_interesse = public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_reassent';
                
            if(!File::isDirectory($path_arquivo_interesse)){
                File::makeDirectory($path_arquivo_interesse, 0777, true, true);
            }
            $caminho_dec_reassent = $request->file('txt_caminho_dec_reassent')->storeAs('/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_reassent', $nomeArqInteresse, 'arquivos');  

            $caracTerreno->txt_caminho_dec_reassent = $caminho_dec_reassent;
        }  
      
        $caracTerreno->txt_terreno_area_risco = $request->terreno_area_risco;
        $caracTerreno->tipo_risco_id = $request->tipo_risco;

        
        if($request->bln_terreno_zeis_ociosidade == 1){
            $caracTerreno->bln_terreno_zeis_ociosidade = $request->bln_terreno_zeis_ociosidade;
            $caracTerreno->txt_legislacao_zeis = $request->txt_legislacao_zeis;
        }else{
            $caracTerreno->bln_terreno_zeis_ociosidade = 0;
            $caracTerreno->txt_legislacao_zeis = null;
        }
       

        $caracTerreno->situacao_terreno_id = $request->situacao_terreno_id;
        $caracTerreno->txt_outra_situacao_terreno = $request->txt_outra_situacao_terreno;
        $caracTerreno->txt_legislacao_artigos = $request->txt_legislacao_artigos;

        $salvoCaracTerreno = $caracTerreno->update();

        if (!$salvoCaracTerreno){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados de Caracterização do Terreno Parte 2 salvos com sucesso!"); 

            return redirect('prototipo/caracterizacao_terreno/editar/'.$caracTerreno->id); 
            
        } 

    }  

    public function caracterizacaoTerrenoEditarParte3(Request $request)
    {
         //return $request->all();
       
        DB::beginTransaction();
        
        $caracTerreno = TabCaracterizacaoTerreno::find($request->caracterizacaoTerrenoId);
        
        $caracTerreno->txt_observacao = $request->txt_observacao;
        $salvoCaracTerreno = $caracTerreno->save();
        
      
        if (!$salvoCaracTerreno){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar os dados.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados de Caracterização do Terreno salvo com sucesso!"); 

            return redirect('prototipo/caracterizacao_terreno/editar/'.$caracTerreno->id); 
            
        } 
    } 




  public function caracterizacaoTerrenoUpdate(Request $request){
      //dd($request->all());

           $caracTerreno = TabCaracterizacaoTerreno::find($request->caracterizacaoTerrenoId);
       $prototipo = Prototipo::find($caracTerreno->prototipo_id); 

       $usuario = Auth::user();   
       if($usuario->ente_publico_id != $prototipo->ente_publico_proponente_id){
          flash()->erro('Sem permissão', "Você não é o cadastrante dessa proposta");
          return redirect('/prototipo');
      }

       $caminho_doc_cartorio_edit = "";
       if($request->file('txt_caminho_doc_cartorio_edit')){
            $tipoAquivo = $request->file('txt_caminho_doc_cartorio_edit')->getMimeType();
      

           
           
             $nomeArqCartorio = 'arqCartorio-'.$prototipo->municipio_id.'-'.$prototipo->id.'.'.$request->file('txt_caminho_doc_cartorio_edit')->extension();
              $path_arquivo = public_path() . '/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_cartorio';
               
            
               if(!File::isDirectory($path_arquivo)){
                   
                   File::makeDirectory($path_arquivo, 0777, true, true);
               }

               //deletar arquivo
           unlink(public_path().'/'.$caracTerreno->txt_caminho_doc_cartorio);

               $caminho_doc_cartorio_edit = $request->file('txt_caminho_doc_cartorio_edit')->storeAs('/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_cartorio', $nomeArqCartorio, 'arquivos');  

          // return var_dump($caminho_doc_cartorio); 
          
          
       }
       //return $caminho_doc_cartorio_edit ;
       if($caminho_doc_cartorio_edit){
        $caracTerreno->txt_caminho_doc_cartorio = $caminho_doc_cartorio_edit;
        }
       $caminho_dec_interesse_edit = "";
/**
       $caminho_dec_interesse_edit = "";

       if($request->file('txt_caminho_dec_interesse_edit')){
           $tipoAquivo = $request->file('txt_caminho_dec_interesse_edit')->getMimeType();
      

           $nomeArqInteresse = 'arqInteresse-'.$prototipo->municipio_id.'-'.$prototipo->id.'.'.$request->file('txt_caminho_dec_interesse_edit')->extension();

           $path_arquivo_interesse = public_path(). '/uploads_arquivos/prototipo/prototipos/doc_interesse/'.$prototipo->id;
               
           if(!File::isDirectory($path_arquivo_interesse)){
               File::makeDirectory($path_arquivo_interesse, 0777, true, true);
           }
           $caminho_dec_interesse_edit = $request->file('txt_caminho_dec_interesse_edit')->storeAs('/uploads_arquivos/prototipo/prototipos/doc_interesse/'.$prototipo->id, $nomeArqInteresse, 'arquivos');  


           //$caminho_dec_interesse = $request->file('txt_caminho_dec_interesse')->storeAs('/uploads_arquivos/prototipo/prototipos/doc_interesse/'.$prototipo->id, $nomeArqInteresse, 'arquivos');
          
       }  

       
       if($caminho_dec_interesse_edit){
           $caracTerreno->txt_caminho_dec_interesse = $caminho_dec_interesse_edit;
       }
*/

$prototipo->dte_conclusao_caracterizacao_terreno =  Date("Y-m-d h:i:s");
$salvouPrototipo = $prototipo->save();


       DB::beginTransaction();



       //DADOS DO UPLOAD ARQUIVO      
       if($caminho_dec_interesse_edit){
       $caracTerreno->txt_caminho_dec_interesse = $caminho_dec_interesse_edit;
       }
       
       
       
       
       
       
       $caracTerreno->vlr_coordenadas_terreno = $request->vlr_coordenadas_terreno;
       $caracTerreno->vlr_area_terreno = $request->vlr_area_terreno;
       $caracTerreno->txt_proprietario_terreno = $request->txt_proprietario_terreno;
       $caracTerreno->titularidade_terreno_id = $request->titularidade_terreno;
       if($request->titularidade_terreno == 3){
           $caracTerreno->txt_terreno_terceiro = $request->txt_terreno_terceiro;
       }else{
           $caracTerreno->txt_terreno_terceiro = null;
       }
       
       $caracTerreno->bln_terreno_parcelado = $request->terreno_parcelado;
       $caracTerreno->bln_terreno_ocupado = $request->terreno_ocupado;
       if($request->terreno_ocupado == 1){
           $caracTerreno->txt_ocupacao = $request->txt_ocupacao;
       }else{
           $caracTerreno->txt_ocupacao = null;
       }
      
       $caminho_dec_reassent = "";

       if($request->file('txt_caminho_dec_reassent')){
            $tipoAquivo = $request->file('txt_caminho_dec_reassent')->getMimeType();
      

            $nomeArqInteresse = 'arqReassent-'.$prototipo->municipio_id.'-'.$prototipo->id.'.'.$request->file('txt_caminho_dec_reassent')->extension();

             $path_arquivo_interesse = public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_reassent';
               
           if(!File::isDirectory($path_arquivo_interesse)){
               File::makeDirectory($path_arquivo_interesse, 0777, true, true);
           }
           unlink(public_path().'/'.$caracTerreno->txt_caminho_dec_reassent);

           return $caminho_dec_reassent = $request->file('txt_caminho_dec_reassent')->storeAs('/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/doc_reassent', $nomeArqInteresse, 'arquivos');  

           
           //$caminho_dec_interesse = $request->file('txt_caminho_dec_reassent')->storeAs('/uploads_arquivos/prototipo/prototipos/doc_interesse/'.$prototipo->id, $nomeArqInteresse, 'arquivos');
          
       }  

       //return $caminho_dec_reassent;

       if($caminho_dec_reassent){
        $caracTerreno->txt_caminho_dec_reassent = $caminho_dec_reassent;
        }
       

       $caracTerreno->txt_terreno_area_risco = $request->terreno_area_risco;
       if($request->terreno_area_risco == 1){
           $caracTerreno->tipo_risco_id = $request->tipo_risco;
       }else{
           $caracTerreno->tipo_risco_id = null;
       }
       
       if($request->bln_terreno_zeis_ociosidade == 1){
            $caracTerreno->bln_terreno_zeis_ociosidade = $request->bln_terreno_zeis_ociosidade;
            $caracTerreno->txt_legislacao_zeis = $request->txt_legislacao_zeis;
        }else{
            $caracTerreno->bln_terreno_zeis_ociosidade = 0;
            $caracTerreno->txt_legislacao_zeis = null;
        }
       

      
       $caracTerreno->situacao_terreno_id = $request->situacao_terreno_id;
        $caracTerreno->txt_outra_situacao_terreno = $request->txt_outra_situacao_terreno;
        $caracTerreno->txt_legislacao_artigos = $request->txt_legislacao_artigos;

        $caracTerreno->txt_observacao = $request->txt_observacao;
       $salvoCaracTerreno = $caracTerreno->save();


       $caminho_planta_edit = "";
       if($request->file('txt_caminho_planta')){   
        if(count($request->allFiles()['txt_caminho_planta']) > 0){                
            for($i = 0; $i < count($request->allFiles()['txt_caminho_planta']);$i++){       
        
                $arquivo = $request->allFiles()['txt_caminho_planta'][$i];   
                        
                    $salvoPlantas = false;
                    $nomeArqPlanta = 'arqPlanta-'.md5($arquivo->getClientOriginalName().Date("Y-m-d")).'-'.$prototipo->id.'-'.$i.'.'.$arquivo->extension();
                    $path_arquivo = public_path(). '/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/planta_terreno';
                        
                    if(!File::isDirectory($path_arquivo)){
                        File::makeDirectory($path_arquivo, 0777, true, true);
                    }
                    $caminho_Planta = $arquivo->storeAs('/uploads_arquivos/prototipo/prototipos/'.$prototipo->id.'/planta_terreno', $nomeArqPlanta, 'arquivos');  
        
        
                $plantaTerreno = new PlantaTerreno();
        
                $plantaTerreno->caracterizacao_terreno_id = $caracTerreno->id;
                $plantaTerreno->txt_caminho_planta = $caminho_Planta;
                $plantaTerreno->txt_nome_arquivo = $nomeArqPlanta;
                $salvoplantaTerreno = $plantaTerreno->save();
                unset($plantaTerreno);
        
            }
        }
       }   

        $plantas = PlantaTerreno::where('caracterizacao_terreno_id', $caracTerreno->id)->count();
       if($plantas == 0){
           flash()->erro('Arquivo', "Deve ser anexado pelo menos um mapa no item 1.11.");
           return back(); 
       }
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

  public function excluirPlanta($plantaArquivoId){
    
        DB::beginTransaction();
        //return $plantaArquivoId;
         $plantaArquivo = PlantaTerreno::find($plantaArquivoId);
        $caracTerrenoId = $plantaArquivo->caracterizacao_terreno_id;
        $deletouRegistro = $plantaArquivo->delete();
        
         $caracTerreno = TabCaracterizacaoTerreno::find($caracTerrenoId);
        
        $path_arquivo = public_path().'/'.$plantaArquivo->txt_caminho_planta;
        $arquivoDeletado = File::delete($path_arquivo);

        if (!$deletouRegistro || !$arquivoDeletado){            
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível excluir o arquivo desejado.");            
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Arquivo excluído com sucesso!"); 

            return redirect('prototipo/iniciar/caracterizacaoTerreno/parte3/'.$caracTerreno->prototipo_id); 
            
        }    
    }  

}




