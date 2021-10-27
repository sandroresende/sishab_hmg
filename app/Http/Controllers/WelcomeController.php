<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;

use App\User;
use Config\App;

use Illuminate\Support\Facades\Mail;

use App\Mod_Sishab\Operacoes\ViewOperacoesContratadas;
use App\Mod_Sishab\Operacoes\ViewOperacoesContratadasAno;

use App\Mod_sishab\Sishab\Configuracoes;

use App\Mod_prototipo\EntePublicoProponente;
use App\Mod_prototipo\Permissoes;
use App\Mod_prototipo\ModalidadeParticipacao;
use App\Tab_dominios\TipoProponente;

use App\Mod_pcva_parcerias\EntePublicoParcerias;
use App\Mod_pcva_parcerias\DadosParcerias;
use App\Mod_pcva_parcerias\MunicipiosBeneficiadosParcerias;
use App\Tab_dominios\SituacaoAdesao;

use App\Http\Requests\Mod_prototipo\RegistroUsuario;
use App\Http\Requests\Mod_pcva_parceria\AceitarAdesao;


use App\Mail\NovoUsuario;
use App\Mail\ArquivoTermoEnviado;
use App\Mail\AceiteAdesaoParceria;

use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;


class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $whereMcmv = [];
        $whereMcmv[]  = ['programa_id', 1];


         $operacoesContratadasMcmv = ViewOperacoesContratadas::dadosRelatorioExecutivo($whereMcmv);
        $resumoContratadasProgramaMcmv = ViewOperacoesContratadas::resumoContratadasPrograma($whereMcmv);
         $dadosRelatorioExecutivoPorAnoMcmv = ViewOperacoesContratadasAno::dadosRelatorioExecutivoPorAno($whereMcmv);
         $resumoRelatorioExecutivoPorAnoMcmv = ViewOperacoesContratadasAno::resumoRelatorioExecutivoPorAno($whereMcmv);
        //$resumoContratadasProgramaMcmv->sum('num_entregues');    

        $whereCvea = [];
        $whereCvea[]  = ['programa_id', 2];
        $operacoesContratadasCvea = ViewOperacoesContratadas::dadosRelatorioExecutivo($whereCvea);
         $resumoContratadasProgramaCvea = ViewOperacoesContratadas::resumoContratadasPrograma($whereCvea);
        $dadosRelatorioExecutivoPorAnoCvea = ViewOperacoesContratadasAno::dadosRelatorioExecutivoPorAno($whereCvea);
        $resumoRelatorioExecutivoPorAnoCvea = ViewOperacoesContratadasAno::resumoRelatorioExecutivoPorAno($whereCvea);

        //$resumoContratadasProgramaCvea->sum('num_entregues');   
        
        $where = [];
        $mostrarPeriodo = true;
        
        
         return view('welcome',compact('resumoContratadasProgramaCvea',
         'resumoContratadasProgramaMcmv','operacoesContratadasMcmv','operacoesContratadasCvea','mostrarPeriodo',
        'dadosRelatorioExecutivoPorAnoMcmv','dadosRelatorioExecutivoPorAnoCvea',
    'resumoRelatorioExecutivoPorAnoMcmv','resumoRelatorioExecutivoPorAnoCvea')); 
    }

    

    public function solicitarRegistro(){
        $where = [];
        $where[] = ['modulo_sistema_id', 3];
        $where[] = ['id', 1];
        
        $configuracoes = Configuracoes::where($where)->first();
        $dataInicial = $configuracoes->dte_inicio;
        $prazo = $configuracoes->num_prazo_dias;
        $dataAtual = Date("Y-m-d");

        $qtDias = diferenca_datas($dataInicial, $dataAtual) + 1;

        $solicitaRegistro = true;
        if ($qtDias > $prazo){            
            $solicitaRegistro = false; 
            flash()->erro("Prazo Encerrado", "O prazo para solicitação de registro se encerrou."); 
           // return redirect('/prototipo/resultado');
            
        } 
         $tipos_proponente = TipoProponente::orderBy('txt_tipo_proponente')->get();
          $modalidades_participacao = ModalidadeParticipacao::where('bln_ativo',true)->get();
         
        return view('views_prototipo.registro_modulos', compact('tipos_proponente','modalidades_participacao','solicitaRegistro'));
        }

    public function salvarRegistro(RegistroUsuario $request){
           // return  $request->all();
                
            $estado = Uf::where('id',$request->estado)->firstOrFail();
             $municipio = Municipio::where('id',$request->municipio)->firstOrFail();

            DB::beginTransaction();

            $usuario = new User;
            $usuario->name = $request->txt_nome . " " . $request->txt_sobrenome;
            $usuario->email = $request->email;
            $usuario->tipo_usuario_id = 9;
            $usuario->modulo_sistema_id = 3;
            $usuario->ente_publico_id = $request->txt_cnpj;
            $usuario->status_usuario_id = 2;
            $usuario->txt_cpf_usuario = $request->txt_cpf_usuario;
            $usuario->txt_cargo = $request->txt_cargo;
            $usuario->txt_ddd_fixo = $request->txt_ddd;
            $usuario->txt_telefone_fixo = $request->txt_telefone;
            $usuario->modalidade_participacao_id = $request->modalidade_participacao;  
            
            $usuario->password = bcrypt('123456');
           //return $usuario;
           
            $salvoComSucessoUsu = $usuario->save();

            $ente = EntePublicoProponente::find($request->txt_cnpj);
            
            if(!$ente){
                $entePublico = new EntePublicoProponente;
                $entePublico->id = $request->txt_cnpj;
                $entePublico->txt_ente_publico = $request->txt_nome_proponente;
                $entePublico->txt_email_ente_publico = $request->email;
                $entePublico->tipo_proponente_id = $request->tipo_proponente_id;
                $entePublico->municipio_id = $request->municipio;                
                $entePublico->txt_nome_chefe_executivo = $request->txt_nome_chefe_executivo;
                $entePublico->txt_cargo_executivo = $request->cargo_executivo;                
                $entePublico->txt_cnpj_orgao_rep = $request->txt_cnpj_orgao_rep;
                $entePublico->txt_orgao_responsavel = $request->txt_orgao_responsavel;
                $entePublico->txt_nome_representante = $request->txt_nome_representante;
                $entePublico->txt_sobrenome_representante = $request->txt_sobrenome_representante;
                $entePublico->txt_cargo_representante = $request->txt_cargo_representante;
                $entePublico->txt_cpf_representante = $request->txt_cpf_representante;
                $entePublico->bln_adm_indireta = $request->bln_adm_indireta;

                
                // return $entePublico;

                $salvoComSucessoEnte = $entePublico->save();
            }else{
                $entePublico = $ente;
                $salvoComSucessoEnte = $ente;
            }
                $usuario->load('entePublicoProponente');

                $nomeArqOficio = '';
                $caminho_oficio = '';
                $tipoAquivo = '';
                $path_arquivo = '';
            if($request->file('txt_caminho_oficio')){
                $nomeArqOficio = 'arqOficio-'.$request->municipio.'-'.str_replace("-", "", Date("Y-m-d")).str_replace(":", "", Date("H:i:s").'-'.$usuario->id).'.'.$request->file('txt_caminho_oficio')->extension();
                $path_arquivo = public_path(). '/uploads_arquivos/prototipo/oficios/'.$usuario->id;
                
                if(!File::isDirectory($path_arquivo)){
                    File::makeDirectory($path_arquivo, 0777, true, true);
                }
                $caminho_oficio = $request->file('txt_caminho_oficio')->storeAs('uploads_arquivos/prototipo/oficios/'.$usuario->id, $nomeArqOficio, 'arquivos');            
                $tipoAquivo = $request->file('txt_caminho_oficio')->getMimeType();
                if(!verificaTipoArquivo($tipoAquivo)){
                    DB::rollBack();
                    flash()->erro("Erro", "Tipo de arquivo inválido! Selecione um arquivo com a extensão correta (.jpeg, .png, .pdf)"); 
                    return 'back()';
                }
            }

            $nomeArqOficioCohab = '';
            $caminho_oficioCohab = '';
            $tipoAquivoCohab = '';
            $path_arquivoCohab = '';
            if($request->file('txt_caminho_oficio_cohab')){
                $nomeArqOficioCohab = 'arqOficioCohab-'.$request->municipio.'-'.str_replace("-", "", Date("Y-m-d")).str_replace(":", "", Date("H:i:s").'-'.$usuario->id).'.'.$request->file('txt_caminho_oficio_cohab')->extension();
                $path_arquivoCohab = public_path(). '/uploads_arquivos/prototipo/oficios/'.$usuario->id;
                
                if(!File::isDirectory($path_arquivoCohab)){
                    File::makeDirectory($path_arquivoCohab, 0777, true, true);
                }
                $caminho_oficioCohab = $request->file('txt_caminho_oficio_cohab')->storeAs('uploads_arquivos/prototipo/oficios/'.$usuario->id, $nomeArqOficioCohab, 'arquivos');            
                $tipoAquivoCohab = $request->file('txt_caminho_oficio_cohab')->getMimeType();
                if(!verificaTipoArquivo($tipoAquivoCohab)){
                    DB::rollBack();
                    flash()->erro("Erro", "Tipo de arquivo inválido! Selecione um arquivo com a extensão correta (.jpeg, .png, .pdf)"); 
                    return 'back()';
                }
            }

            

            $permissoes = new Permissoes;
            $permissoes->user_id = $usuario->id;   
            $permissoes->modulo_sistema_id = 3;   
            $permissoes->status_permissao_id = 1;   
            $permissoes->caminho_oficio = $caminho_oficio;   
            $permissoes->txt_nome_oficio = $nomeArqOficio;  
            $permissoes->caminho_oficio_cohab = $caminho_oficioCohab;   
            $permissoes->txt_nome_oficio_cohab = $nomeArqOficioCohab;   
            $permissoes->bln_analisada = false;   
            $permissoes->modalidade_participacao_id = $request->modalidade_participacao;   

            $salvoComSucessoPermissoes = $permissoes->save();


        if ($salvoComSucessoUsu && $salvoComSucessoEnte && $salvoComSucessoPermissoes){            
           
            $usuario->load('entePublicoProponente');
            Mail::to('cct-snh@mdr.gov.br')->send(new NovoUsuario($usuario, $permissoes));
            DB::commit();
            flash()->sucesso("Sucesso", "Usuário cadastrado com sucesso!"); 
            return view('views_prototipo.mensagem_solicitacao_registro',compact('entePublico','usuario','uh_contratadas','municipio','estado')); 
            
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Erro ao solicitar registro!"); 
            return back();
            
        }  

}    


    public function resultadoAtas(){
        return view('views_prototipo.atas_resultado'); 
    }


    public function solicitarAdesaoParcerias(){

        $tipos_proponente = TipoProponente::orderBy('txt_tipo_proponente')->get();
        $modalidades_participacao = ModalidadeParticipacao::where('bln_ativo',true)->get();

        return view('views_pcva_parcerias.solicitar_adesao', compact('tipos_proponente','modalidades_participacao','solicitaRegistro'));
    }

    public function aceitarAdesaoParcerias(AceitarAdesao $request){
   

        //return $request->all();
        DB::beginTransaction();
        
        $entePublicoParcerias = new EntePublicoParcerias;
        $entePublicoParcerias->txt_cnpj_ente_publico = $request->txt_cnpj;
        $entePublicoParcerias->modalidade_participacao_id = $request->modalidade_participacao;
        $entePublicoParcerias->tipo_proponente_id = $request->tipo_proponente_id;
        $entePublicoParcerias->txt_ente_publico = $request->txt_nome_proponente;
        $entePublicoParcerias->txt_email_ente_publico = $request->txt_email_ente_publico;
        
        $whereCapital = [];
        if($request->tipo_proponente_id != 2){
            if($request->tipo_proponente_id == 6){
                $estado = Uf::where('id',53)->firstOrFail();
                $whereCapital[] = ['uf_id', 53];              
            }else{
                $estado = Uf::where('id',$request->estado)->firstOrFail();
                $whereCapital[] = ['uf_id', $request->estado];
            }
            
            $whereCapital[] = ['bln_capital', true];
            $municipio = Municipio::where($whereCapital)->first();  
            $entePublicoParcerias->municipio_id = $municipio->id;
        }else{
            $entePublicoParcerias->municipio_id = $request->municipio;
            $estado = Uf::where('id',$request->estado)->firstOrFail();
            $municipio = Municipio::where('id', $request->municipio)->firstOrFail();              
        }

        $entePublicoParcerias->txt_nome_chefe_executivo = $request->txt_nome_chefe_executivo;
        $entePublicoParcerias->txt_cargo_executivo = $request->cargo_executivo;
        $entePublicoParcerias->txt_nome_usuario = $request->txt_nome . ' ' . $request->txt_sobrenome;
        $entePublicoParcerias->txt_cargo_usuario = $request->txt_cargo;
        $entePublicoParcerias->txt_cpf_usuario = $request->txt_cpf_usuario;
        $entePublicoParcerias->txt_ddd_usuario = $request->txt_ddd;
        $entePublicoParcerias->txt_telefone_usuario = $request->txt_telefone;
        $entePublicoParcerias->txt_ddd_celular_usuario = $request->txt_ddd_movel;
        $entePublicoParcerias->txt_celular_usuario = $request->txt_celular;
        $entePublicoParcerias->txt_email_usuario = $request->email;
        $entePublicoParcerias->bln_aceite_termo = true;

        $entePublicoParcerias->created_at = Date('Y-m-d');
        $salvoEnte = $entePublicoParcerias->save();

        $dadosParceria = new DadosParcerias;
        $dadosParceria->ente_publico_parceria_id = $entePublicoParcerias->id;        
        $dadosParceria->num_unidades = $request->num_unidades;
        $dadosParceria->vlr_contrapartida_uh = $request->vlr_contrapartida_uh;
        $dadosParceria->vlr_terreno_uh = $request->vlr_terreno_uh;
        $dadosParceria->vlr_contrapartida_financ_uh = $request->vlr_contrapartida_financ_uh;
        $dadosParceria->created_at = Date('Y-m-d');
        $dadosParceria->bln_contrapartida_adicional = $request->bln_contrapartida_adicional;
        
        if($request->bln_contrapartida_adicional){
            $dadosParceria->tipo_contrapartida_id = $request->tipo_contrapartida;
            $dadosParceria->vlr_contrapartida_adicional = $request->vlr_contrapartida_adicional;
        }    
        $dadosParceria->situacao_adesao_id = 1;
        
        $salvoDados = $dadosParceria->save();

        $dadosParceria->txt_protocolo_aceite = $dadosParceria->txt_protocolo_aceite =  Date("Ymd"). strval(($dadosParceria->id * intval(Date("Y"))) - intval(Date("d"))) .'-' . strval($dadosParceria->id);

        $salvoDados = $dadosParceria->update();
       
        $todosMunicipio = false;
        if($request->bln_todos_municipios){
            $todosMunicipio = true;
        }
        //return $estado->id;

        if($todosMunicipio){
             $municipios = Municipio::where('uf_id', $estado->id)->get();             
        }else{
            if($request->tipo_proponente_id == 1){
                $municipios = Municipio::whereIn('id', $request->municipiosbeneficiados)->get();             
            }else{
                $municipios = Municipio::where('id', $municipio->id)->get();           
            }
        }

        //return $municipios;
            foreach($municipios as $dados){

                $municipiosBeneficiados = new MunicipiosBeneficiadosParcerias;
                $municipiosBeneficiados->dados_parceria_id = $dadosParceria->id;
                $municipiosBeneficiados->municipio_id = $dados->id;
                $salvoMunicipios = $municipiosBeneficiados->save();
            }
        /*
             if($request->tipo_proponente_id == 1){
                $municipiosBeneficiados = new MunicipiosBeneficiadosParcerias;
                $municipiosBeneficiados->dados_parceria_id = $dadosParceria->id;
                $municipiosBeneficiados->municipio_id = $municipio->id;
                $salvoMunicipios = $municipiosBeneficiados->save();
            }
          */

            if ($salvoEnte && $salvoDados && $salvoMunicipios){   
              //  Mail::to($entePublicoParcerias->txt_email_usuario)->send(new AceiteAdesaoParceria($dadosParceria, $municipiosBeneficiados, $entePublicoParcerias,$municipio,$estado));
              //  Mail::to($entePublicoParcerias->txt_email_ente_publico)->send(new AceiteAdesaoParceria($dadosParceria, $municipiosBeneficiados, $entePublicoParcerias,$municipio,$estado));
                DB::commit();
                flash()->sucesso("Sucesso", "Usuário cadastrado com sucesso!"); 
                    return redirect('/pcva_parcerias/protocolo/termo/'.$dadosParceria->txt_protocolo_aceite);
                
            } else {
                DB::rollBack();
                flash()->erro("Erro", "Erro ao salvar dados do formulário!"); 
                return back();
                
            }  
        }

        public function visualizarTermoParceira($txtProtocoloAceite){

        //  return $txtProtocoloAceite;

            $dadosParceria = DadosParcerias::where('txt_protocolo_aceite',$txtProtocoloAceite)->first();
           

            if(!$dadosParceria){  
            flash()->erro("Erro", "Não existe Termo de Adesão para este protocolo!"); 
            return redirect('pcva_parcerias/termo/consultar');
                
            } else{
                $dadosParceria->load('situacaoAdesao','tipoContrapartida');
            $entePublicoParcerias = EntePublicoParcerias::where('id',$dadosParceria->ente_publico_parceria_id)->firstOrFail();

             $entePublicoParcerias->load('tipoProponente');

            $municipiosBeneficiados = MunicipiosBeneficiadosParcerias::join('tab_municipios','tab_municipios_beneficiados_parcerias.municipio_id', '=','tab_municipios.id')
                                                                                ->join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                                                                ->selectRaw('municipio_id,txt_sigla_uf, ds_municipio')
                                                                                ->where('dados_parceria_id',$dadosParceria->id)
                                                                                ->orderBy('ds_municipio')
                                                                                ->get();
            $municipio = Municipio::where('id', $entePublicoParcerias->municipio_id)->firstOrFail();       
            $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
        

            return view('views_pcva_parcerias.termo_parceria', compact('entePublicoParcerias','dadosParceria','municipiosBeneficiados','municipio','estado'));
        } 
    }

    public function consultarTermoParceira(){

        return  view('views_pcva_parcerias.consulta_termo_adesao');
    }
       

    public function filtroTermoParceira(Request $request){
        
        return redirect('/pcva_parcerias/protocolo/termo/'.$request->txtProtocoloAceite);
    }

    public function filtroValidacaoTermoParceira(){

        return  view('views_pcva_parcerias.validar_termo_adesao');
    }

    public function validarTermoParceira(Request $request){
        
        //return $request->all();
        $where = [];
        $where[] = ['tab_dados_parcerias.txt_protocolo_aceite', $request->txtProtocoloAceite];
        $where[] = ['tab_ente_publico_parcerias.txt_cpf_usuario', $request->txt_cpf_usuario];

         $dadosTermo = DadosParcerias::join('tab_ente_publico_parcerias','tab_dados_parcerias.ente_publico_parceria_id','=','tab_ente_publico_parcerias.id')
                                             ->join('tab_municipios','tab_ente_publico_parcerias.municipio_id', '=','tab_municipios.id')
                                             ->join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                    ->where($where)
                                    ->select('tab_dados_parcerias.id as DadosParceriasID', 'tab_dados_parcerias.txt_protocolo_aceite',
                                                'txt_nome_usuario','txt_sobrenome_usuario','txt_cpf_usuario','txt_cnpj_ente_publico','txt_ente_publico','municipio_id',
                                                'txt_sigla_uf','ds_municipio','tab_ente_publico_parcerias.txt_email_usuario','tab_ente_publico_parcerias.txt_email_ente_publico')
                                    ->first();

        
        if(!$dadosTermo){  
            flash()->erro("Erro", "Não existe Termo de Adesão para os parametros informados!"); 
            return redirect('pcva_parcerias/validacao/filtro');
            
        } else{
             $dadosParcerias = DadosParcerias::find($dadosTermo->DadosParceriasID);

             if($dadosParcerias->situacao_adesao_id != 1){  
                flash()->erro("Erro", "Esse termo já foi enviado."); 
                return redirect('pcva_parcerias/validacao/filtro');
             }else{  
                $nomeArq = '';
                $caminhoArq = '';
                $path_arquivo = '';
                if($request->file('txt_caminho_termo')){
                    $nomeArq = 'arqTermoAdesao-'.$dadosParcerias->txt_protocolo_aceite.'.'.$request->file('txt_caminho_termo')->extension();
                    $path_arquivo = public_path(). '/uploads_arquivos/pcva_parceria/termos/'.$dadosParcerias->txt_protocolo_aceite;
                    
                    if(!File::isDirectory($path_arquivo)){
                        File::makeDirectory($path_arquivo, 0777, true, true);
                    }
                    $caminhoArq = $request->file('txt_caminho_termo')->storeAs('uploads_arquivos/pcva_parceria/termos/'.$dadosParcerias->txt_protocolo_aceite, $nomeArq, 'arquivos');                            
                }        

                $dadosParcerias->situacao_adesao_id = 2;
                $dadosParcerias->dte_envio_termo = Date("Y-m-d");
                $dadosParcerias->txt_caminho_termo =  $caminhoArq;

                $salvouDados = $dadosParcerias->update();

                if ($salvouDados){  
                    Mail::to($dadosTermo->txt_email_usuario)->send(new ArquivoTermoEnviado($dadosTermo));
                    Mail::to($dadosTermo->txt_email_ente_publico)->send(new ArquivoTermoEnviado($dadosTermo));
                    DB::commit();
                    flash()->sucesso("Sucesso", "Termo enviado com sucesso!"); 
                        return redirect('/pcva_parcerias/protocolo/termo/'.$dadosParcerias->txt_protocolo_aceite);
                    
                } else {
                    DB::rollBack();
                    flash()->erro("Erro", "Erro ao enviar o arquivo!"); 
                    return back();
                    
                }  
                
                return redirect('/pcva_parcerias/protocolo/termo/'.$request->txtProtocoloAceite);
            }
        }    
    }
  
 
}

