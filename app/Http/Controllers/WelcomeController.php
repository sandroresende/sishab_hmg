<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;

use App\Http\Requests\prototipo\RegistroUsuario;

use App\User;
use Config\App;

use Illuminate\Support\Facades\Mail;

use App\EstimativaPopulacao;
use App\DeficitHabitacional;
use App\Operacao;
use App\PainelContratacaoAno;
use App\Entregas;

use App\prototipo\EntePublicoProponente;
use App\prototipo\Permissoes;
use App\prototipo\ModalidadeParticipacao;
use App\TipoProponente;

use App\Mail\NovoUsuario;

use App\Municipio;
use App\Uf;
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
        
        $populacao = new EstimativaPopulacao;
        $populacaoTotal =  $populacao->qtdePopulacaoEstimada();

        $deficit = DeficitHabitacional::selectRaw('sum(vlr_deficit_habitacional_urbano) as vlr_deficit_habitacional_urbano, 
                                                  sum(vlr_deficit_habitacional_rural) as vlr_deficit_habitacional_rural')
                                                ->firstOrFail();
        
        $dataPosicao = Operacao::join('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
                                ->selectRaw('txt_modalidade, max(dte_movimento_arquivo) as dte_movimento')->where('modalidade_id','!=',99)
                                                ->groupBy('txt_modalidade')->get();
        $relatorioExecutivo1 = Operacao::join('opc_status_empreendimento','opc_status_empreendimento.id','=','tab_operacoes.status_empreendimento_id')
                                ->join('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
                                ->join('opc_faixa_renda','opc_faixa_renda.id','=','tab_operacoes.faixa_renda_id')
                                ->selectRaw('txt_modalidade, dsc_faixa, faixa_renda_id, max(dte_movimento_arquivo) as dte_movimento,
                                            sum(qtd_uh_financiadas) AS num_uh,
                                            sum(num_uh_distratadas) AS num_distratadas,
                                            sum(CASE
                                                    WHEN status_empreendimento_id = 7 THEN 0
                                                    WHEN opc_status_empreendimento.bln_vigente = true AND modalidade_id = 1 AND origem_id = 3 THEN qtd_uh_financiadas - num_uh_distratadas
                                                    ELSE qtd_uh_financiadas - qtd_uh_entregues - num_uh_distratadas
                                                END) AS num_vigentes,
                                            sum(CASE
                                                    WHEN status_empreendimento_id = 7 THEN qtd_uh_financiadas - qtd_uh_entregues - num_uh_distratadas
                                                    ELSE 0
                                                END) AS num_nao_entregues,
                                            sum(qtd_uh_entregues) as num_entregues,
                                            sum(vlr_liberado) as num_vlr_liberado, 
                                            sum(vlr_operacao) as num_vlr_total')
                                        ->groupBy('txt_modalidade','dsc_faixa', 'faixa_renda_id')
                                        ->where('programa_id',1)
                                        ->orderBy('dsc_faixa', 'txt_modalidade')
                                        ->get();


             $relatorioExecutivo2 = Operacao::join('opc_status_empreendimento','opc_status_empreendimento.id','=','tab_operacoes.status_empreendimento_id')
                                        ->join('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
                                        ->join('opc_faixa_renda','opc_faixa_renda.id','=','tab_operacoes.faixa_renda_id')
                                        ->selectRaw('txt_modalidade, dsc_faixa, faixa_renda_id, max(dte_movimento_arquivo) as dte_movimento,
                                                    sum(qtd_uh_financiadas) AS num_uh,
                                                    sum(num_uh_distratadas) AS num_distratadas,
                                                    sum(CASE
                                                            WHEN status_empreendimento_id = 7 THEN 0
                                                            WHEN opc_status_empreendimento.bln_vigente = true AND modalidade_id = 1 AND origem_id = 3 THEN qtd_uh_financiadas - num_uh_distratadas
                                                            ELSE qtd_uh_financiadas - qtd_uh_entregues - num_uh_distratadas
                                                        END) AS num_vigentes,
                                                    sum(CASE
                                                            WHEN status_empreendimento_id = 7 THEN qtd_uh_financiadas - qtd_uh_entregues - num_uh_distratadas
                                                            ELSE 0
                                                        END) AS num_nao_entregues,
                                                    sum(qtd_uh_entregues) as num_entregues,
                                                    sum(vlr_liberado) as num_vlr_liberado, 
                                                    sum(vlr_operacao) as num_vlr_total')
                                                ->groupBy('txt_modalidade','dsc_faixa', 'faixa_renda_id')
                                                ->where('programa_id',2)
                                                ->orderBy('dsc_faixa', 'txt_modalidade')
                                                ->get();
        
        


        $uh_contratadas = $relatorioExecutivo1->sum('num_uh');   
        
        $whereContAno = [];
        $whereContAno[] = ['num_ano_assinatura', '>=', 2019];
        $whereContAno[] = ['programa_id', 1];

        $contratacaoAno = PainelContratacaoAno::selectRaw('txt_regiao, num_ano_assinatura, sum(uh_faixa_1) as uh_faixa_1,sum(uh_faixa_15) as uh_faixa_15,
                                    sum(uh_faixa_2) as uh_faixa_2,sum(uh_faixa_3) as uh_faixa_3, 
                                    sum(uh_producao_estoque) as uh_producao_estoque,
                                    sum(vlr_contratado) as vlr_contratado,sum(qtd_uh_contratada) as qtd_uh_contratada ')
                                    ->where($whereContAno)
                                    ->groupBy('txt_regiao','num_ano_assinatura')
                                    ->orderBy('txt_regiao')
                                    ->get();                                        
        
        $valoresMCMV2019 = ['faixa1'=> 0, 'faixa15'=> 0, 'faixa2'=> 0,'faixa3'=> 0,'producao'=> 0, 'valor_contratado'=> 0, 'contratadas' => 0]; 
        $valoresMCMV2020 = ['faixa1'=> 0, 'faixa15'=> 0, 'faixa2'=> 0,'faixa3'=> 0,'producao'=> 0, 'valor_contratado'=> 0, 'contratadas' => 0]; 
        
        foreach($contratacaoAno as $dados){
            if($dados->num_ano_assinatura == 2019){
                $valoresMCMV2019['faixa1'] += empty($dados->uh_faixa_1) ? 0 : $dados->uh_faixa_1;  
                $valoresMCMV2019['faixa15'] += empty($dados->uh_faixa_15) ? 0 : $dados->uh_faixa_15;  
                $valoresMCMV2019['faixa2'] += empty($dados->uh_faixa_2) ? 0 : $dados->uh_faixa_2;  
                $valoresMCMV2019['faixa3'] += empty($dados->uh_faixa_3) ? 0 : $dados->uh_faixa_3;  
                $valoresMCMV2019['producao'] += empty($dados->uh_producao_estoque) ? 0 : $dados->uh_producao_estoque;  
                $valoresMCMV2019['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;  
                $valoresMCMV2019['contratadas'] += empty($dados->qtd_uh_contratada) ? 0 : $dados->qtd_uh_contratada;  
            }else{
                $valoresMCMV2020['faixa1'] += empty($dados->uh_faixa_1) ? 0 : $dados->uh_faixa_1;  
                $valoresMCMV2020['faixa15'] += empty($dados->uh_faixa_15) ? 0 : $dados->uh_faixa_15;  
                $valoresMCMV2020['faixa2'] += empty($dados->uh_faixa_2) ? 0 : $dados->uh_faixa_2;  
                $valoresMCMV2020['faixa3'] += empty($dados->uh_faixa_3) ? 0 : $dados->uh_faixa_3;  
                $valoresMCMV2020['producao'] += empty($dados->uh_producao_estoque) ? 0 : $dados->uh_producao_estoque;  
                $valoresMCMV2020['valor_contratado'] += empty($dados->vlr_contratado) ? 0 : $dados->vlr_contratado;  
                $valoresMCMV2020['contratadas'] += empty($dados->qtd_uh_contratada) ? 0 : $dados->qtd_uh_contratada;  
            }
            
        }


        $entregaAno = Entregas::join('tab_municipios','tab_entregas.municipio_id', '=','tab_municipios.id')
                                        ->join('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                        ->join('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id')            
                                        ->selectRaw('txt_regiao, num_ano_entrega,
                                        sum(
                                            CASE
                                                WHEN tab_entregas.faixa_renda_id = 1 THEN 1
                                                ELSE 0
                                            END) AS uh_faixa_1,
                                        sum(
                                            CASE
                                                WHEN tab_entregas.faixa_renda_id = 4 THEN 1
                                                ELSE 0
                                            END) AS uh_faixa_15,
                                        sum(
                                            CASE
                                                WHEN tab_entregas.faixa_renda_id = 2 THEN 1
                                                ELSE 0
                                            END) AS uh_faixa_2,
                                        sum(
                                            CASE
                                                WHEN tab_entregas.faixa_renda_id = 3 THEN 1
                                                ELSE 0
                                            END) AS uh_faixa_3,
                                        count(tab_entregas.txt_cpf_mutuario) AS qtd_uh_entregues,
                                        sum(
                                            CASE
                                                WHEN tab_entregas.faixa_renda_id = 1 THEN tab_entregas.vlr_unidade_habitacional
                                                ELSE 0
                                            END) AS vlr_uh_entregues_fx1,
                                            sum(
                                                CASE
                                                    WHEN tab_entregas.faixa_renda_id != 1 THEN 0
                                                    ELSE tab_entregas.vlr_unidade_habitacional
                                                END) AS vlr_uh_entregues_fgts')
                                        ->where('num_ano_entrega', '>=',2019)                                
                                        ->groupBy('txt_regiao','num_ano_entrega')                                                
                                        ->orderBy('txt_regiao', 'asc')
                                            ->get();


            $valoresEntregas2019 = ['faixa1'=> 0, 'faixa15'=> 0, 'faixa2'=> 0,'faixa3'=> 0,'entregues'=> 0, 'valor_uh_entregues'=> 0]; 
            $valoresEntregas2020 = ['faixa1'=> 0, 'faixa15'=> 0, 'faixa2'=> 0,'faixa3'=> 0,'entregues'=> 0, 'valor_uh_entregues'=> 0]; 
            
            foreach($entregaAno as $dados){
                if($dados->num_ano_entrega == 2019){
                    $valoresEntregas2019['faixa1'] += empty($dados->uh_faixa_1) ? 0 : $dados->uh_faixa_1;  
                    $valoresEntregas2019['faixa15'] += empty($dados->uh_faixa_15) ? 0 : $dados->uh_faixa_15;  
                    $valoresEntregas2019['faixa2'] += empty($dados->uh_faixa_2) ? 0 : $dados->uh_faixa_2;  
                    $valoresEntregas2019['faixa3'] += empty($dados->uh_faixa_3) ? 0 : $dados->uh_faixa_3;              
                    $valoresEntregas2019['entregues'] += $dados->qtd_uh_entregues;      
                    $valoresEntregas2019['valor_uh_entregues'] += $dados->vlr_uh_entregues_fx1+$dados->vlr_uh_entregues_fgts;      
                }else{
                    $valoresEntregas2020['faixa1'] += empty($dados->uh_faixa_1) ? 0 : $dados->uh_faixa_1;  
                    $valoresEntregas2020['faixa15'] += empty($dados->uh_faixa_15) ? 0 : $dados->uh_faixa_15;  
                    $valoresEntregas2020['faixa2'] += empty($dados->uh_faixa_2) ? 0 : $dados->uh_faixa_2;  
                    $valoresEntregas2020['faixa3'] += empty($dados->uh_faixa_3) ? 0 : $dados->uh_faixa_3;              
                    $valoresEntregas2020['entregues'] += $dados->qtd_uh_entregues;      
                    $valoresEntregas2020['valor_uh_entregues'] += $dados->vlr_uh_entregues_fx1+$dados->vlr_uh_entregues_fgts;                          
                }  
            }                                            
            
         return view('welcome',compact('populacaoTotal','deficit','uh_contratadas','relatorioExecutivo1','relatorioExecutivo2','dataPosicao',
                                        'valoresMCMV2019','valoresMCMV2020','contratacaoAno','valoresEntregas2019','valoresEntregas2020','entregaAno')); 
    }

    public function solicitarRegistro(){
         $tipos_proponente = TipoProponente::get();
          $modalidades_participacao = ModalidadeParticipacao::get();
         
        return view('registro_modulos', compact('tipos_proponente','modalidades_participacao'));
        }

    public function salvarRegistro(RegistroUsuario $request){
            //return  $request->all();
                
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
                $nomeArqOficio = 'arqOficio-'.$request->municipio.'-'.str_replace("-", "", Date("Y-m-d")).str_replace(":", "", Date("H:i:s")).'.'.$request->file('txt_caminho_oficio')->extension();
                $path_arquivo = public_path(). 'uploads_arquivos/prototipo/oficios/'.$request->municipio;
                
                if(!File::isDirectory($path_arquivo)){
                    File::makeDirectory($path_arquivo, 0777, true, true);
                }
                $caminho_oficio = $request->file('txt_caminho_oficio')->storeAs('uploads_arquivos/prototipo/oficios/'.$request->municipio, $nomeArqOficio, 'arquivos');            
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
                $nomeArqOficioCohab = 'arqOficioCohab-'.$request->municipio.'-'.str_replace("-", "", Date("Y-m-d")).str_replace(":", "", Date("H:i:s")).'.'.$request->file('txt_caminho_oficio_cohab')->extension();
                $path_arquivoCohab = public_path(). 'uploads_arquivos/prototipo/oficios/'.$request->municipio;
                
                if(!File::isDirectory($path_arquivoCohab)){
                    File::makeDirectory($path_arquivoCohab, 0777, true, true);
                }
                $caminho_oficioCohab = $request->file('txt_caminho_oficio_cohab')->storeAs('uploads_arquivos/prototipo/oficios/'.$request->municipio, $nomeArqOficioCohab, 'arquivos');            
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
            Mail::to($request->email)->send(new NovoUsuario($usuario, $permissoes));
            DB::commit();
            flash()->sucesso("Sucesso", "Usuário cadastrado com sucesso!"); 
            return view('prototipo.mensagem_solicitacao_registro',compact('entePublico','usuario','uh_contratadas','municipio','estado')); 
            
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Erro ao solicitar registro!"); 
            return back();
            
        }  

}    
 
}

