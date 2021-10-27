<?php

namespace App\Http\Controllers\Selecao_beneficiarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Mod_selecao_demanda\EntePublico;
use App\Mod_selecao_demanda\DemandaConsolidada;
use App\Mod_selecao_demanda\DemandaGerada;
use App\Mod_selecao_demanda\DadosArquivoEntePublico;
use App\Mod_sishab\OperacoesContratadas;

class DemandasController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('entePublico');
    }

    public function index(){
        
        if(Auth::user()->isUserAtivo()){
            $usuario = Auth::user();
          $ente = EntePublico::where('id',$usuario->ente_publico_id)->firstOrFail();
           $demandas = DemandaConsolidada::where('municipio_id', $ente->municipio_id)->get();
           
            if($demandas->count() == 0){
                flash()->erro("Erro", "Ainda não existe demanda para esse ente.");    
                return back();
            } else {
                
                return view('views_selecao_beneficiarios.demandas_ente_publico',compact('usuario','ente', 'demandas'));
            }      
         
        }else{
            return redirect('/selecao_beneficiarios');
        }
    

         //return view('views_selecao_beneficiarios.dados_dirigente',compact('dirigente','statusUsuario'));
    }

    public function arquivosEnte(){
         $usuario = Auth::user();
        $ente = EntePublico::where('id',$usuario->ente_publico_id)->firstOrFail();
        $where = [];
        $where[] = ['municipio_id', $ente->municipio_id];
        $where[] = ['bln_arquivo_gerado', true];
        $where[] = ['tipo_arquivo_id','<=',2];
         $arquivosmunicipio = DadosArquivoEntePublico::where($where)->get();
          $arquivosmunicipio->load('tipoArquivo','user','entePublico');


         return view('views_selecao_beneficiarios.arquivos_gerados',compact('usuario','ente','arquivosmunicipio' ));
    }

    public function dadosArquivo($demandaGeradaId, $arquivoId){
        
           $demandaGerada = DemandaGerada::find($demandaGeradaId);
          $demandaConsolidada = DemandaConsolidada::where('municipio_id', $demandaGerada->municipio_id)->get();
         $demandaConsolidada->load('operacoesContratadas');

         $totalDemanda = ['num_empreendimento'=> 0,
                          'num_contratadas'=> 0,
                          'num_entregues'=> 0];

        foreach($demandaConsolidada as $dados){
            $totalDemanda['num_empreendimento'] += 1;
            $totalDemanda['num_contratadas'] += $dados->operacoesContratadas->qtd_uh_contratadas;
            $totalDemanda['num_entregues'] += $dados->operacoesContratadas->qtd_uh_entregues;
        }                          

        //return $totalDemanda;

         $where = [];
         $where[] = ['demanda_gerada_id', $demandaGeradaId];
         $where[] = ['tipo_arquivo_id', 1];
        $arquivosMunicipioPrincipal = DadosArquivoEntePublico::where($where)->get();
         $arquivosMunicipioPrincipal->load('tipoArquivo','user','entePublico');
        $where = [];
        $where[] = ['demanda_gerada_id', $demandaGeradaId];
        $where[] = ['tipo_arquivo_id', '>',1];
       $arquivosMunicipioComplemento = DadosArquivoEntePublico::where($where)->get();
       $arquivosMunicipioComplemento->load('tipoArquivo','user','entePublico');

     //   return $arquivosMunicipioPrincipal;
       if($demandaGerada->count() == 0){
            flash()->erro("Erro", "Ainda não existe demanda para esse ente.");    
            return redirect('selecao_beneficiarios');
        } else {
            
            return view('views_selecao_beneficiarios.demanda_gerada',compact('usuario','ente','demandaGerada', 'arquivosMunicipioPrincipal',
                            'arquivosMunicipioComplemento','demandaConsolidada','totalDemanda','demandaGeradaId', 'arquivoId'));
        }  
        
        
    }
    
    public function downloadArquivo( $arquivoId){
          $usuario = Auth::user();
//         $ente = EntePublico::where('id',$usuario->ente_publico_id)->firstOr();
          $ente = EntePublico::find($usuario->ente_publico_id);
           $arquivoEnte = DadosArquivoEntePublico::find($arquivoId);

          
            
            
            $path =  $arquivoEnte->txt_caminho_arquivo;
            $fileName = basename( $path );

   
            

            header("Content-Type: application/force-download");
            header("Content-type: application/octet-stream;");
            header("Content-Length: " . filesize( $path ) );
            header("Content-disposition: attachment; filename=" . $fileName );
            header("Pragma: no-cache");
            header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
            header("Expires: 0");
            readfile( $path );
            flush();  
            
            if($ente->municipio_id == $arquivoEnte->municipio_id){
            
                if($arquivoEnte->bln_download_arquivo == false){
                    
                    $arquivoEnte->user_id = $usuario->id;
                    $arquivoEnte->ente_publico_id = $ente->id;
                    $arquivoEnte->bln_download_arquivo = true;
                    $arquivoEnte->dte_download_ente = Date("Y-m-d h:i:s"); ;
                    $arquivoEnte->save();
    
                    $where = [];
                    $where[] = ['demanda_gerada_id', $arquivoEnte->demanda_gerada_id];
                    $where[] = ['tipo_arquivo_id','>',1];
                    
                     $arquivosCompEnte = DadosArquivoEntePublico::where($where)->get();
                    foreach($arquivosCompEnte as $dados){
                       // $obj = DadosArquivoEntePublico::find($dados['id']);
                       if(!$dados->ente_publico_id){
                           $dados->ente_publico_id = $ente->id;
                            $dados->save();
                       }     
                    }
                 }
            } else {

                
                flash()->erro("Erro", "Este usuário não tem permissão para acessar os dados deste arquivo");    
                return redirect('selecao_beneficiarios');
            } 
        
        flash()->erro("Success", "Download realizado com sucesso");    
        return back();

    }

    public function arquivosGerados(){

        return $usuario = Auth::user();

        if(($usuario->tipo_usuario_id == 1) && ($usuario->tipo_usuario_id == 10)){
            $arquivos = DadosArquivoEntePublico::get();
            return $arquivos->load('tipoArquivo','user','entePublico');
        }else{
            flash()->erro("Erro", "Este usuário não tem permissão para acessar os dados deste arquivo");    
            return redirect('selecao_beneficiarios');
        }

    }

}


