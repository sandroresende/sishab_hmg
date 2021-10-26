<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Uf;
use App\Regiao;
use App\Municipio;
use App\ResumoPropostas;
use App\BrasilComRm;
use App\RelatorioExecutivoResumo;
use App\ExecutivoPj;
use App\ResumoRetomadaObras;
use App\SituacaoObra;
use App\oferta\ResumoProtocolos;
use App\oferta\Protocolo;
use App\oferta\Contrato;
use App\Propostas;
use App\Proponente;
use App\oferta\Instituicao;
use App\RelatorioExecutivoAno;
use App\PosicaoArquivoExecutivo;
use App\Codem\TipoDemanda;
use App\Codem\TipoAtendimento;
use App\Codem\Tema;
use App\Codem\SubTema;
use App\Codem\Prioridade;
use App\Codem\TipoInteressado;
use App\Codem\ModalidadeDemanda;
use App\Codem\RelacaoDemanda;
use App\MunicipiosContrataramMcmv;
use App\SolicitacaoPagamento;
use App\TipoLiberacao;
use App\SolicitacaoLiberacao;
use App\Operacao;
use App\Modalidade;
use App\StatusSnh;
use App\Entregas;
use App\FaixaRenda;

use App\AcoesGoverno;
use App\Orcamento;

use App\pac\MunicipiosBeneficiados;

use App\OperacoesContratadas;
use App\StatusEmpreendimento;

use App\TipoUsuario;

use App\ModuloSistema;
use App\ente_publico\EntePublico;
use App\ente_publico\TipoEntePublico;

use App\prototipo\TitularidadeTerreno;
use App\prototipo\TipoRisco;
use App\prototipo\InfraestrututaBasica;
use App\prototipo\FonteRecurso;
use App\prototipo\TipoOrganizacao;
use App\prototipo\TipoIndeferimento;
use App\prototipo\ModalidadeParticipacao;


class ApiController extends Controller
{
    
    public function buscarRegioes(){        
        return Regiao::orderBy('txt_regiao')->get();
    }

    public function buscarRides(){        
        return BrasilComRm::select('txt_rm_ride')
                        ->orderBy('txt_rm_ride', 'asc')
                        ->where('txt_rm_ride','<>','' )
                        ->groupBy('txt_rm_ride')
                        ->get();
    }

    public function buscarUfsRides($estado){       
       
        $where = [];
        $where[] = ['uf_id',$estado]; 
        return BrasilComRm::select('txt_rm_ride')
                        ->orderBy('txt_rm_ride', 'asc')
                        ->where( $where )
                        ->where('txt_rm_ride','<>','')
                        ->groupBy('txt_rm_ride')
                        ->get();
    }

    public function buscarRegioesRides($regiao){       
       
        $where = [];
        $where[] = ['regiao_id',$regiao]; 
        return BrasilComRm::select('txt_rm_ride')
                        ->orderBy('txt_rm_ride', 'asc')
                        ->where( $where )
                        ->where('txt_rm_ride','<>','')
                        ->groupBy('txt_rm_ride')
                        ->get();
    }
    
    public function buscarUfs(){        
        return Uf::orderBy('txt_uf')->get();
    }
    
    public function buscarUfsRegiao($regiao){        
        return Uf::where('regiao_id',$regiao)->orderBy('txt_uf')->get();
    }

    public function buscarMunicipios($estado){
        
        return Municipio::where('uf_id', $estado)->orderBy('ds_municipio', 'asc')->get();
    }

    public function buscarInstituicoes(){
        
        return Instituicao::where('id','<>', 3)->orderBy('txt_nome_if', 'asc')->get();
    }

    public function buscarUfsPropostas(){        
        $estados =  ResumoPropostas::select('uf_id', 'txt_uf')
                                    ->orderBy('txt_uf', 'asc')
                                    ->groupBy('uf_id', 'txt_uf')
                                    ->get();

        return $estados;
    }

    public function buscarMunicipiosPropostas($estado){
        
        $where = [];
        $where[] = ['uf_id', $estado];
        

        $municipios =  ResumoPropostas::select('municipio_id', 'ds_municipio')
                                    ->orderBy('ds_municipio', 'asc')
                                    ->where($where)
                                    ->groupBy('municipio_id', 'ds_municipio')
                                    ->get();

        return $municipios;
    }

    


    public function buscarModalidadesUfPropostas($estado){
        
        $where = [];
        $where[] = ['uf_id', $estado];
        

        $modalidades =  ResumoPropostas::select('modalidade_id', 'txt_modalidade')
                                    ->orderBy('txt_modalidade', 'asc')
                                    ->where($where)
                                    ->groupBy('modalidade_id', 'txt_modalidade')
                                    ->get();

        return $modalidades;
    }

    public function buscarModalidadesMunPropostas($municipio){
        
        $where = [];
        $where[] = ['municipio_id', $municipio];
        

        $modalidades =  ResumoPropostas::select('modalidade_id', 'txt_modalidade')
                                    ->orderBy('txt_modalidade', 'asc')
                                    ->where($where)
                                    ->groupBy('modalidade_id', 'txt_modalidade')
                                    ->get();

        return $modalidades;
    }

    
    public function buscarSelecoesUfPropostas($estado){
        
        $where = [];
        $where[] = ['uf_id', $estado];
        

        $selecoes =  ResumoPropostas::select('selecao_id', 'num_selecao','num_ano_selecao','txt_modalidade')
                                    ->orderBy('num_selecao', 'asc')
                                    ->orderBy('num_ano_selecao', 'asc')
                                    ->where($where)
                                    ->groupBy('selecao_id', 'num_selecao','num_ano_selecao','txt_modalidade')
                                    ->get();

        return $selecoes;
    }

    public function buscarSelecoesMunPropostas($municipio){
        
        $where = [];
        $where[] = ['municipio_id', $municipio];
        

        $selecoes =  ResumoPropostas::select('selecao_id', 'num_selecao','num_ano_selecao','txt_modalidade')
                                    ->orderBy('num_selecao', 'asc')
                                    ->orderBy('num_ano_selecao', 'asc')
                                    ->where($where)
                                    ->groupBy('selecao_id', 'num_selecao','num_ano_selecao','txt_modalidade')
                                    ->get();

        return $selecoes;
    }

    public function buscarSelecoesModPropostas($modalidade){
        
        $where = [];
        $where[] = ['modalidade_id', $modalidade];
        

        $selecoes =  ResumoPropostas::select('selecao_id', 'num_selecao','num_ano_selecao','txt_modalidade')
                                    ->orderBy('num_selecao', 'asc')
                                    ->orderBy('num_ano_selecao', 'asc')
                                    ->where($where)
                                    ->groupBy('selecao_id', 'num_selecao','num_ano_selecao','txt_modalidade')
                                    ->get();

        return $selecoes;
    }

    public function buscarMunicipiosEmpreendimentos($estado){
        
        $where = [];
        $where[] = ['uf_id', $estado];
        

        $municipios =  ExecutivoPj::join('tab_municipios','tab_municipios.id','=','tab_executivo_pj.municipio_id')
                                    ->selectRaw('ds_municipio, municipio_id')
                                    ->where($where)
                                    ->groupBy('ds_municipio', 'municipio_id')
                                    ->orderBy('ds_municipio', 'asc')
                                    ->get();
        
      

        return $municipios;
    }

    public function buscarEmpreendimentos($municipio){
        
        $where = [];
        $where[] = ['municipio_id', $municipio];
        

        $empreendimentos =  ExecutivoPj::join('tab_empreendimentos','tab_empreendimentos.operacao_id','=','tab_executivo_pj.cod_operacao')
                                    ->selectRaw('txt_nome_empreendimento, empreendimento_id, cod_operacao')
                                    ->where($where)
                                    ->groupBy('txt_nome_empreendimento', 'empreendimento_id','cod_operacao')
                                    ->orderBy('txt_nome_empreendimento', 'asc')
                                    ->get();
        
      

        return $empreendimentos;
    }

    public function buscarEmpreendimentosModalidade($municipio, $modalidade){
        
        $where = [];
        $where[] = ['municipio_id', $municipio];
        $where[] = ['modalidade_id', $modalidade];
        

        $empreendimentos =  ExecutivoPj::join('tab_empreendimentos','tab_empreendimentos.operacao_id','=','tab_executivo_pj.cod_operacao')
                                    ->selectRaw('txt_nome_empreendimento, empreendimento_id, cod_operacao')
                                    ->where($where)
                                    ->groupBy('txt_nome_empreendimento', 'empreendimento_id','cod_operacao')
                                    ->orderBy('txt_nome_empreendimento', 'asc')
                                    ->get();
        
      

        return $empreendimentos;
    }

    public function buscarModalidades($municipio){
        
        $where = [];
        $where[] = ['municipio_id', $municipio];
        

        $Modalidades =  ExecutivoPj::join('opc_modalidade','opc_modalidade.id','=','tab_executivo_pj.modalidade_id')
                                    ->selectRaw('txt_modalidade, modalidade_id')
                                    ->where($where)
                                    ->groupBy('txt_modalidade', 'modalidade_id')
                                    ->orderBy('txt_modalidade', 'asc')
                                    ->get();
        
      

        return $Modalidades;
    }

    public function buscarAnos(){
        
        $anos =  Operacao::select('num_ano_assinatura')
                            ->groupBy('num_ano_assinatura')
                            ->orderBy('num_ano_assinatura', 'asc')
                            ->get();
        return $anos;
    }

    public function buscarAnosAte($ano){
        $where = [];
        $where[] = ['num_ano_assinatura','>=',$ano];

        $anos =  Operacao::select('num_ano_assinatura')
                            ->where($where)
                            ->groupBy('num_ano_assinatura')
                            ->orderBy('num_ano_assinatura', 'asc')
                            ->get();
        return $anos;
    }    

    public function buscarPosicoesDe(){
        
        $posicoesDe =  PosicaoArquivoExecutivo::orderBy('dte_posicao_arquivo', 'asc')->get();
        
        foreach($posicoesDe as $posicao){

            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_posicao_arquivo));
        }
      

        return $posicoesDe;
    }

    public function buscarPosicoesAte($posicao){
        
        $posicao = date('Y-m-d',strtotime($posicao));

        $posicoesAte =  PosicaoArquivoExecutivo::where('dte_posicao_arquivo','>',$posicao)->orderBy('dte_posicao_arquivo', 'asc')->get();
        
        foreach($posicoesAte as $posicao){

            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_posicao_arquivo));
        }
      

        return $posicoesAte;
    }


    public function buscarUfsRetomada(){   

        return ResumoRetomadaObras::select('uf_id','txt_uf', 'txt_sigla_uf')
                            ->orderBy('txt_sigla_uf', 'asc')
                            ->groupBy('uf_id','txt_uf', 'txt_sigla_uf')
                            ->get();    
        
    }

    public function buscarMunicipiosRetomada($estado){   

        $ufs =  ResumoRetomadaObras::select('municipio_id', 'ds_municipio')
                            ->where('uf_id',$estado)
                            ->orderBy('ds_municipio', 'asc')
                            ->groupBy('municipio_id', 'ds_municipio')
                            ->get();    
        return $ufs;
    }

    public function buscarStatusSnh(){   

        return StatusSnh::orderBy('txt_status_snh', 'asc')->get();  
}

    public function buscarSituacaoObra(){   

            return ResumoRetomadaObras::select('situacao_obra_id', 'txt_situacao_obra')
                                            ->orderBy('txt_situacao_obra', 'asc')
                                            ->groupBy('situacao_obra_id', 'txt_situacao_obra')
                                            ->get();  
    }

    public function buscarStatusEmpreendimento(){   

        return StatusEmpreendimento::get(); 
}

public function buscarStatusEmpreendimentoVigente($vigente){   

    return StatusEmpreendimento::where('bln_vigente',$vigente)
            ->get(); 
}

    public function buscarStatusSnhEstados($estado){   

        return ResumoRetomadaObras::select('status_snh_id', 'txt_status_snh')
                                   ->where('uf_id',$estado)
                                   ->orderBy('txt_status_snh', 'asc')
                                   ->groupBy('status_snh_id', 'txt_status_snh')
                                 ->get();          
}

public function buscarStatusSnhMunicipio($municipio){   

    return ResumoRetomadaObras::select('status_snh_id', 'txt_status_snh')
                                ->where('municipio_id',$municipio)
                                ->orderBy('txt_status_snh', 'asc')
                                ->groupBy('status_snh_id', 'txt_status_snh')
                            ->get(); 
}

 
    public function buscarSituacaoObraEstados($estado){   

            return ResumoRetomadaObras::select('situacao_obra_id', 'txt_situacao_obra')
                                       ->where('uf_id',$estado)
                                       ->orderBy('txt_situacao_obra', 'asc')
                                       ->groupBy('situacao_obra_id', 'txt_situacao_obra')
                                     ->get();          
    }

    public function buscarSituacaoObraMunicipio($municipio){   

            return ResumoRetomadaObras::select('situacao_obra_id', 'txt_situacao_obra')
                                            ->where('municipio_id',$municipio)
                                            ->orderBy('txt_situacao_obra', 'asc')
                                            ->groupBy('situacao_obra_id', 'txt_situacao_obra')
                                            ->get();  
    }

    
    public function buscarUfsProtocolos(){        
        $estados =  ResumoProtocolos::select('id_uf', 'sg_uf')
                                    ->orderBy('sg_uf', 'asc')
                                    ->groupBy('id_uf', 'sg_uf')
                                    ->get();

        return $estados;
    }  
    
    public function buscarUfsInstProtocolos($instituicao){        
        $estados =  ResumoProtocolos::select('id_uf', 'sg_uf')
                                    ->orderBy('sg_uf', 'asc')
                                    ->where('instituicao_id',$instituicao)
                                    ->groupBy('id_uf', 'sg_uf')
                                    ->get();

        return $estados;
    } 
    

    
    
    public function buscarMunicipiosProtocolos($estado){   

        $municipio =  ResumoProtocolos::select('id_municipio', 'ds_municipio')
                                    ->where('id_uf',$estado)
                                    ->orderBy('ds_municipio', 'asc')
                                    ->groupBy('id_municipio', 'ds_municipio')
                                    ->get();

        return $municipio;
    } 

    public function buscarMunicipiosInstProtocolos($instituicao,$estado){   

        $municipio =  ResumoProtocolos::select('id_municipio', 'ds_municipio')
                                    ->where('instituicao_id',$instituicao)
                                    ->where('id_uf',$estado)
                                    ->orderBy('ds_municipio', 'asc')
                                    ->groupBy('id_municipio', 'ds_municipio')
                                    ->get();

        return $municipio;
    } 
    


    public function autocompleteProtocolos($query){  
       
        $protocolos = Protocolo::where('txt_protocolo','like','%'.$query.'%')
                                    ->orderBy('txt_protocolo')
                                    ->get();
       return response()->json($protocolos);
    }

    public function autocompleteNis($query){  
       
        $contratos = Contrato::where('txt_nis_titular','like','%'.$query.'%')
                                    ->orderBy('txt_nis_titular')
                                    ->get();
       return response()->json($contratos);
    }

    public function autocompleteAPF($query){  
       
        $propostas = Propostas::where('num_apf','like','%'.$query.'%')
                                    ->orderBy('num_apf')
                                    ->get();
       return response()->json($propostas);
    }  
    
    public function autocompleteCNPJ($query){  
       
        $proponentes = Proponente::where('txt_cnpj','like','%'.$query.'%')
                                    ->orderBy('txt_cnpj')
                                    ->get();
       return response()->json($proponentes);
    }
    
    public function autocompleteLimite($query){  
       
        $municipios = Municipio::join('tab_uf','tab_uf.id','=','tab_municipios.uf_id')
                                 ->where('ds_municipio','like','%'.$query.'%')
                                 ->orderBy('ds_municipio')
                                 ->get();
       return response()->json($municipios);
    }     

///CONTRATADAS
public function buscarRegioesContratadas(){    
    $where = [];
    $where[] = ['bln_selecionada', true];
    $where[] = ['bln_contratada', true];    
    $regioes =  ResumoPropostas::select('regiao_id', 'txt_regiao')
                                ->orderBy('txt_regiao', 'asc')
                                ->where($where)
                                ->groupBy('regiao_id', 'txt_regiao')
                                ->get();

    return $regioes;
}

public function buscarUfsContratadas(){      
    $where = [];
    $where[] = ['bln_selecionada', true];
    $where[] = ['bln_contratada', true];

    $estados =  ResumoPropostas::select('uf_id', 'txt_uf')
                                ->orderBy('txt_uf', 'asc')
                                ->where($where)
                                ->groupBy('uf_id', 'txt_uf')
                                ->get();

    return $estados;
}

public function buscarEstadosContratadas($regiao){
    
    $where = [];
    $where[] = ['regiao_id', $regiao];
    $where[] = ['bln_selecionada', true];
    $where[] = ['bln_contratada', true];
    

    $estados =  ResumoPropostas::select('uf_id', 'txt_uf')
                                ->orderBy('txt_uf', 'asc')
                                ->where($where)
                                ->groupBy('uf_id', 'txt_uf')
                                ->get();

    return $estados;
}

public function buscarAnosRegioesContratadas($regiao){
    
    $where = [];
    $where[] = ['regiao_id', $regiao];
    $where[] = ['bln_selecionada', true];
    $where[] = ['bln_contratada', true];
    

    $anos =  ResumoPropostas::select('num_ano_selecao')
                                ->orderBy('num_ano_selecao', 'asc')
                                ->where($where)
                                ->groupBy('num_ano_selecao')
                                ->get();

    return $anos;
}

public function buscarAnosEstadoContratadas($estado){
    
    $where = [];
    $where[] = ['uf_id', $estado];
    $where[] = ['bln_selecionada', true];
    $where[] = ['bln_contratada', true];
    

    $anos =  ResumoPropostas::select('num_ano_selecao')
                                ->orderBy('num_ano_selecao', 'asc')
                                ->where($where)
                                ->groupBy('num_ano_selecao')
                                ->get();

    return $anos;
}

public function buscarAnosMunicipioContratadas($municipio){
    
    $where = [];
    $where[] = ['municipio_id', $municipio];
    $where[] = ['bln_selecionada', true];
    $where[] = ['bln_contratada', true];
    

    $anos =  ResumoPropostas::select('num_ano_selecao')
                                ->orderBy('num_ano_selecao', 'asc')
                                ->where($where)
                                ->groupBy('num_ano_selecao')
                                ->get();

    return $anos;
}

public function buscarAnosModalidadeContratadas($modalidade){
    
    $where = [];
    $where[] = ['modalidade_id', $modalidade];
    $where[] = ['bln_selecionada', true];
    $where[] = ['bln_contratada', true];
    

    $anos =  ResumoPropostas::select('num_ano_selecao')
                                ->orderBy('num_ano_selecao', 'asc')
                                ->where($where)
                                ->groupBy('num_ano_selecao')
                                ->get();

    return $anos;
}


public function buscarMunicipiosContratadas($estado){
        
    $where = [];
    $where[] = ['uf_id', $estado];    
    $where[] = ['bln_selecionada', true];
    $where[] = ['bln_contratada', true];
    

    $municipios =  ResumoPropostas::select('municipio_id', 'ds_municipio')
                                ->orderBy('ds_municipio', 'asc')
                                ->where($where)
                                ->groupBy('municipio_id', 'ds_municipio')
                                ->get();

    return $municipios;
}



public function buscarModalidadesContratadas(){
    $modalidades =  ResumoPropostas::select('modalidade_id', 'txt_modalidade')
                                ->orderBy('txt_modalidade', 'asc')
                                ->groupBy('modalidade_id', 'txt_modalidade')
                                ->get();

    return $modalidades;
}   

public function buscarAnosSelecaoContratadas(){
    $anos =  ResumoPropostas::select('num_ano_selecao')
                                ->orderBy('num_ano_selecao', 'asc')
                                ->groupBy('num_ano_selecao')
                                ->get();

    return $anos;
}   

public function buscarModalidadesRegiaoContratadas($regiao){
        
    $where = [];
    $where[] = ['regiao_id', $regiao];
    

    $modalidades =  ResumoPropostas::select('modalidade_id', 'txt_modalidade')
                                ->orderBy('txt_modalidade', 'asc')
                                ->where($where)
                                ->groupBy('modalidade_id', 'txt_modalidade')
                                ->get();

    return $modalidades;
}   



//  CODEM

    public function listaTipoDemanda(){
            
        return TipoDemanda::orderBy('txt_tipo_demanda', 'asc')->get();
    }

    public function listaTipoAtendimento(){
        
        return TipoAtendimento::orderBy('txt_tipo_atendimento', 'asc')->get();
    }
    
    public function listaTema(){
        
        return Tema::orderBy('txt_tema', 'asc')->get();
    }

    public function listaSubTema(Tema $tema){
        
        return SubTema::where('tema_id', $tema->id)->orderBy('txt_sub_tema', 'asc')->get();
    }

    public function listaPrioridade(){
        
        return Prioridade::orderBy('txt_prioridade', 'asc')->get();
    }  
    
    public function buscaPrioridade($qtd_dias){
        
        return Prioridade::where('id',$qtd_dias)->value('num_max_dias');
    } 

    public function listaTipoInteressado(){
        
        return TipoInteressado::orderBy('txt_tipo_interessado', 'asc')->get();
    }  

    public function listaModalidadeDemanda(){
        
        return ModalidadeDemanda::orderBy('txt_modalidade_demanda', 'asc')->get();
    } 

    public function buscaIdTema($subTema){
        
        return SubTema::where('id', $subTema)->value('tema_id');
    }

    public function buscarMunicipioEstado($municipio){
        
        return Municipio::where('id', $municipio)->value('uf_id');
    }

    public function retornarDemandasNovas($usuarioID){
        
        
        $where[] = ['user_id',$usuarioID];
        $where[] = ['bln_visualizada',false];
        $demandasNovas = RelacaoDemanda::where($where)
                                        ->orderBy('dte_solicitacao','desc')
                                       ->get();    
                                            
            return $demandasNovas;                                            
    }
    
    public function retornarDemandasAtrasadas($usuarioID){
        
        
        $where[] = ['user_id',$usuarioID];
        $where[] = ['qtd_dias_atraso','>',0];
        $demandasAtrasadas = RelacaoDemanda::where($where)
                                            ->orderBy('qtd_dias_atraso','desc')
                                            ->get();    
                                            
            return $demandasAtrasadas;                                            
    }

    public function buscarMunicipiosContratacao($estado){
        
        $where = [];
        $where[] = ['uf_id', $estado];
        

        $municipios =  MunicipiosContrataramMcmv::where($where)
                                    ->orderBy('ds_municipio', 'asc')
                                    ->get();

        return $municipios;
    }

    public function buscarUfSolicitacoesPagamento(){       

        return SolicitacaoPagamento::select('uf_id','txt_uf')
        ->groupBy('uf_id','txt_uf')
        ->orderBy('txt_uf')
        ->get();

    }    

    public function buscarMunSolicitacoesPagamento($estado){       
        
        $where = [];
        $where[] = ['uf_id', $estado];

        return SolicitacaoPagamento::select('municipio_id','ds_municipio')
        ->groupBy('municipio_id','ds_municipio')
        ->where($where)
        ->orderBy('ds_municipio')
        ->get();

    }    

    public function buscarTipoLiberacao(){       

        return TipoLiberacao::get();

    }    
    
    public function buscarTipoLiberacaoUF($estado){       
        $where = [];
        $where[] = ['uf_id', $estado];
       
        return SolicitacaoPagamento::select('tipo_liberacao_id as id','txt_tipo_liberacao')
        ->where($where)
        ->groupBy('tipo_liberacao_id','txt_tipo_liberacao')        
        ->orderBy('txt_tipo_liberacao')
        ->get();
        
    }    

    public function buscarMesesSolicitacao(){       
        
        return SolicitacaoPagamento::select('num_mes_solicitacao','mes_solicitacao','ano_solicitacao')
        ->groupBy('num_mes_solicitacao','mes_solicitacao','ano_solicitacao')        
        ->orderBy('ano_solicitacao','ASC')
        ->orderBy('num_mes_solicitacao')
        ->get();

    }
    
    public function buscarMesUF($estado){       
        $where = [];
        $where[] = ['uf_id', $estado];
       
        return SolicitacaoPagamento::select('num_mes_solicitacao','mes_solicitacao')
                                    ->where($where)
                                    ->groupBy('num_mes_solicitacao','mes_solicitacao')        
                                    ->orderBy('num_mes_solicitacao')
                                    ->get();
                                    
    } 
    
    public function buscarPosicoesDeSolicit(){      
        $posicoesDe =  SolicitacaoPagamento::select('dte_solicitacao')
                                            ->groupBy('dte_solicitacao')        
                                            ->orderBy('dte_solicitacao')
                                            ->get();
        
        foreach($posicoesDe as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_solicitacao));
        }
        return $posicoesDe;        
    } 

    public function buscarPosicoesDeSolicitUF($estado){  
        $where = [];
        $where[] = ['uf_id', $estado];

        $posicoesDe =  SolicitacaoPagamento::select('dte_solicitacao')
                                            ->where($where)
                                            ->groupBy('dte_solicitacao')        
                                            ->orderBy('dte_solicitacao')
                                            ->get();
        
        foreach($posicoesDe as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_solicitacao));
        }
        return $posicoesDe;        
    } 

    public function buscarPosicoesAteSolicit($posicaoDe){    
        
        $where = [];
        

        if($posicaoDe){
            $where[] = ['dte_solicitacao','>',$posicaoDe];
        }
        
        
        $posicoesAte =  SolicitacaoPagamento::select('dte_solicitacao')
                                            ->groupBy('dte_solicitacao')  
                                            ->where($where)      
                                            ->orderBy('dte_solicitacao')
                                            ->get();
        
        foreach($posicoesAte as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_solicitacao));
        }
        return $posicoesAte;        
    } 
    
    public function buscarTipoLiberacaoMun($municipio){       
        $where = [];
        $where[] = ['municipio_id', $municipio];
       
        return SolicitacaoPagamento::select('tipo_liberacao_id as id','txt_tipo_liberacao')
        ->where($where)
        ->groupBy('tipo_liberacao_id','txt_tipo_liberacao')        
        ->orderBy('txt_tipo_liberacao')
        ->get();
        
    } 

    
    public function buscarMesMun($municipio){       
        $where = [];
        $where[] = ['municipio_id', $municipio];
       
        return SolicitacaoPagamento::select('num_mes_solicitacao','mes_solicitacao')
                                    ->where($where)
                                    ->groupBy('num_mes_solicitacao','mes_solicitacao')        
                                    ->orderBy('num_mes_solicitacao')
                                    ->get();
                                    
    } 

    public function buscarPosicoesDeSolicitMun($municipio){  
        $where = [];
        $where[] = ['municipio_id', $municipio];

        $posicoesDe =  SolicitacaoPagamento::select('dte_solicitacao')
                                            ->where($where)
                                            ->groupBy('dte_solicitacao')        
                                            ->orderBy('dte_solicitacao')
                                            ->get();
        
        foreach($posicoesDe as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_solicitacao));
        }
        return $posicoesDe;        
    } 

    public function buscarMesTipoUf($estado,$tipoLiberacao){       
        $where = [];


        
        if($estado){
            $where[] = ['uf_id',$estado];
        }
        if($tipoLiberacao){
            $where[] = ['tipo_liberacao_id',$tipoLiberacao];
        }

        return SolicitacaoPagamento::select('num_mes_solicitacao','mes_solicitacao')
                                    ->where($where)
                                    ->groupBy('num_mes_solicitacao','mes_solicitacao')        
                                    ->orderBy('num_mes_solicitacao')
                                    ->get();
                                    
    } 

    public function buscarMesTipoMun($municipio,$tipoLiberacao){       
        $where = [];

        if($municipio){
            $where[] = ['municipio_id', $municipio];
        }
        
     
        if($tipoLiberacao){
            $where[] = ['tipo_liberacao_id',$tipoLiberacao];
        }

        return SolicitacaoPagamento::select('num_mes_solicitacao','mes_solicitacao')
                                    ->where($where)
                                    ->groupBy('num_mes_solicitacao','mes_solicitacao')        
                                    ->orderBy('num_mes_solicitacao')
                                    ->get();
                                    
    }

    public function buscarPosicoesDeTipoMun($municipio,$tipoLiberacao){  
        $where = [];
        
        if($municipio){
            $where[] = ['municipio_id', $municipio];
        }
        
        if($tipoLiberacao){
            $where[] = ['tipo_liberacao_id',$tipoLiberacao];
        }

        $posicoesDe =  SolicitacaoPagamento::select('dte_solicitacao')
                                            ->where($where)
                                            ->groupBy('dte_solicitacao')        
                                            ->orderBy('dte_solicitacao')
                                            ->get();
        
        foreach($posicoesDe as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_solicitacao));
        }
        return $posicoesDe;        
    } 

    public function buscarPosicoesDeTipoUf($estado,$tipoLiberacao){  
        $where = [];
        
        
        if($estado){
            $where[] = ['uf_id',$estado];
        }
        if($tipoLiberacao){
            $where[] = ['tipo_liberacao_id',$tipoLiberacao];
        }

        $posicoesDe =  SolicitacaoLiberacao::select('dte_solicitacao')
                                            ->where($where)
                                            ->groupBy('dte_solicitacao')        
                                            ->orderBy('dte_solicitacao')
                                            ->get();
        
        foreach($posicoesDe as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_solicitacao));
        }
        return $posicoesDe;        
    } 

    public function buscarMesTipo($tipoLiberacao){       
        $where = [];

     
        if($tipoLiberacao){
            $where[] = ['tipo_liberacao_id',$tipoLiberacao];
        }

        return SolicitacaoPagamento::select('num_mes_solicitacao','mes_solicitacao')
                                    ->where($where)
                                    ->groupBy('num_mes_solicitacao','mes_solicitacao')        
                                    ->orderBy('num_mes_solicitacao')
                                    ->get();
                                    
    }

    public function buscarPosicoesDeTipo($tipoLiberacao){  
        $where = [];
        
        
        if($tipoLiberacao){
            $where[] = ['tipo_liberacao_id',$tipoLiberacao];
        }

        $posicoesDe =  SolicitacaoLiberacao::select('dte_solicitacao')
                                            ->where($where)
                                            ->groupBy('dte_solicitacao')        
                                            ->orderBy('dte_solicitacao')
                                            ->get();
        
        foreach($posicoesDe as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_solicitacao));
        }
        return $posicoesDe;        
    } 

    public function buscarLiberacoes(){  
        

        $liberacoes =  SolicitacaoLiberacao::select('dte_liberacao')
                                            ->groupBy('dte_liberacao')
                                            ->where('dte_liberacao','<>',null)        
                                            ->orderBy('dte_liberacao','DESC')
                                            ->get();
        
        foreach($liberacoes as $liberacao){
            
            $liberacao['dte_posicao_formatada'] = date('d/m/Y',strtotime($liberacao->dte_liberacao));
        }
        return $liberacoes;        
    }

    public function buscarPosicoesDeSolicitMes($mesSolicitacao){  
        
     
        $where = [];
       $ano =  intval(substr($mesSolicitacao, -4));;
       $pos_espaco = strpos($mesSolicitacao, '-');// perceba que há um espaço aqui
       $mes = substr($mesSolicitacao, 0, $pos_espaco);

     

        if($mesSolicitacao){
            $where[] = ['num_mes_solicitacao', $mes];
            $where[] = ['ano_solicitacao', $ano];
        }
        


        $posicoesDe =  SolicitacaoPagamento::select('dte_solicitacao')
                                            ->where($where)
                                            ->groupBy('dte_solicitacao')        
                                            ->orderBy('dte_solicitacao')
                                            ->get();
        
        foreach($posicoesDe as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_solicitacao));
        }
        return $posicoesDe;        
    }  
    
    public function buscarPosicoesAteSolicitMes($mesSolicitacao,$posicaoDe){    
        
        $where = [];
        $ano =  intval(substr($mesSolicitacao, -4));;
        $pos_espaco = strpos($mesSolicitacao, '-');// perceba que há um espaço aqui
         $mes = substr($mesSolicitacao, 0, $pos_espaco);

        if($posicaoDe){
            $where[] = ['dte_solicitacao','>',$posicaoDe];
        }
        
        if($mesSolicitacao){
               $where[] = ['num_mes_solicitacao', $mes];
            $where[] = ['ano_solicitacao', $ano];
        }
        
        $posicoesAte =  SolicitacaoPagamento::select('dte_solicitacao')
                                            ->groupBy('dte_solicitacao')  
                                            ->where($where)      
                                            ->orderBy('dte_solicitacao')
                                            ->get();
        
        foreach($posicoesAte as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_solicitacao));
        }
        return $posicoesAte;        
    }     

    public function buscarMesesLiberacao(){       
        $where = [];
        $where[] = ['dte_liberacao','>=','2019-01-01'];
        return SolicitacaoPagamento::select('num_mes_liberacao','mes_liberacao','ano_liberacao')
        ->where($where)
        ->groupBy('num_mes_liberacao','mes_liberacao','ano_liberacao')                
        ->orderBy('ano_liberacao', 'asc')
        ->orderBy('num_mes_liberacao')
        ->get();

    }

    public function buscarPosicoesDeLibMes($mesLiberacao){  
        
     
        $where = [];
        $ano =  intval(substr($mesLiberacao, -4));;
        $pos_espaco = strpos($mesLiberacao, '-');// perceba que há um espaço aqui
         $mes = substr($mesLiberacao, 0, $pos_espaco);
     
        if($mesLiberacao){
            $where[] = ['num_mes_liberacao', $mes];
            $where[] = ['ano_liberacao', $ano];
        }
        


        $posicoesDe =  SolicitacaoPagamento::select('dte_liberacao')
                                            ->where($where)
                                            ->groupBy('dte_liberacao')        
                                            ->orderBy('dte_liberacao')
                                            ->get();
        
        foreach($posicoesDe as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_liberacao));
        }
        return $posicoesDe;        
    }  

    public function buscarPosicoesAteLib($posicaoDeLib){    
        
        $where = [];

        if($posicaoDeLib){
            $where[] = ['dte_liberacao','>',$posicaoDeLib];
        }
        
        
        $posicoesAte =  SolicitacaoPagamento::select('dte_liberacao')
                                            ->groupBy('dte_liberacao')  
                                            ->where($where)      
                                            ->orderBy('dte_liberacao')
                                            ->get();
        
        foreach($posicoesAte as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_liberacao));
        }
        return $posicoesAte;        
    } 

    public function buscarPosicoesAteLibMes($mesLiberacao,$posicaoDeLib){    
        
        $where = [];

        if($posicaoDeLib){
            $where[] = ['dte_liberacao','>',$posicaoDeLib];
        }
        
        if($mesLiberacao){
            $where[] = ['num_mes_liberacao',$mesLiberacao];
        }
        
        $posicoesAte =  SolicitacaoPagamento::select('dte_liberacao')
                                            ->groupBy('dte_liberacao')  
                                            ->where($where)      
                                            ->orderBy('dte_liberacao')
                                            ->get();
        
        foreach($posicoesAte as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_liberacao));
        }
        return $posicoesAte;        
    }   

    public function buscarEmpreendimentosEstado($estado){    
        
        
        $wherePropostas = [];
        $wherePropostas[] = ['uf_id', $estado];
        $wherePropostas[] = ['bln_contratada', false]; 

        $empreendimentosPropostas = ResumoPropostas::selectRaw('num_apf as txt_num_apf, max(txt_nome_empreendimento) as txt_nome_empreendimento')
                                        ->groupBy('num_apf', 'txt_nome_empreendimento')
                                        ->orderBy('txt_nome_empreendimento', 'asc')
                                        ->where($wherePropostas)->get();

        $where = [];
        $where[] = ['uf_id',$estado];
        $where[] = ['origem_id', 2];                    
        $where[] = ['txt_nome_empreendimento','<>', null];                    
       
         return $empreendimentosContratados = Operacao::leftjoin('tab_municipios','tab_operacoes.municipio_id', '=','tab_municipios.id')
         ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
         ->selectRaw('txt_num_apf,    txt_nome_empreendimento')
                                    ->groupBy('txt_num_apf', 'txt_nome_empreendimento')
                                    ->orderBy('txt_nome_empreendimento', 'asc')
                                    ->where($where)
                                    ->get();

         $empreendimentos = $empreendimentosPropostas->union($empreendimentosContratados);     
        
        
        return $empreendimentos;        
    } 

    public function buscarEmpreendimentosMuncipio($municipio){    
        
        
        $wherePropostas = [];
        $wherePropostas[] = ['municipio_id', $municipio];
        $wherePropostas[] = ['bln_contratada', false]; 

         $empreendimentosPropostas = ResumoPropostas::selectRaw('num_apf as txt_num_apf, max(txt_nome_empreendimento) as txt_nome_empreendimento')
                                        ->groupBy('num_apf', 'txt_nome_empreendimento')
                                        ->orderBy('txt_nome_empreendimento', 'asc')
                                        ->where($wherePropostas)->get();

        $where = [];
        $where[] = ['municipio_id',$municipio];
        $where[] = ['origem_id', 2];                    
        $where[] = ['txt_nome_empreendimento','<>', null];                    
       
        $empreendimentosContratados = Operacao::leftjoin('tab_municipios','tab_operacoes.municipio_id', '=','tab_municipios.id')
                                    ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                    ->selectRaw('tab_operacoes.id as txt_num_apf, txt_nome_empreendimento')
                                    ->groupBy('tab_operacoes.id','txt_nome_empreendimento')
                                    ->orderBy('txt_nome_empreendimento', 'asc')
                                    ->where($where)
                                    ->get();

         $empreendimentos = $empreendimentosPropostas->union($empreendimentosContratados);     
        
        
        return $empreendimentos;        
    }

    public function buscarSituacaoObraExecutivo(){       
        return SituacaoObra::orderBy('txt_situacao_obra')->get();

    }

    public function buscarMunicipiosVinculadas($estado){   

        $municipio =  MunicipiosBeneficiados::join('tab_municipios','tab_municipios.id','=','tab_municipios_beneficiados.municipio_id')
                                    ->select('municipio_id', 'ds_municipio')
                                    ->where('uf_id',$estado)
                                    ->orderBy('ds_municipio', 'asc')
                                    ->groupBy('municipio_id', 'ds_municipio')
                                    ->get();

        return $municipio;
    } 
    
    public function listaModalidades(){

        return $modalidades = Modalidade::orderBy('txt_modalidade')->get();
    }

    public function listaFaixas(){

        return $faixas = FaixaRenda::orderBy('dsc_faixa')->get();
    }


    public function anosEntregas(){

        return Entregas::selectRaw('num_ano_entrega')->groupBy('num_ano_entrega')->orderBy('num_ano_entrega')->get();
    }
    
    public function buscarModalidadesMunicipio($municipio){
        
        $where = [];
        $where[] = ['municipio_id', $municipio];
        

        $modalidades =  Operacao::leftjoin('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
                                    ->selectRaw('txt_modalidade, modalidade_id as id')
                                    ->where($where)
                                    ->groupBy('txt_modalidade', 'modalidade_id')
                                    ->orderBy('txt_modalidade', 'asc')
                                    ->get();
        
      

        return $modalidades;
    }
    
    public function buscarModalidadesEstado($estado){
        
        $where = [];
        $where[] = ['uf_id', $estado];
        

        $modalidades =  Operacao::leftjoin('tab_municipios','tab_operacoes.municipio_id', '=','tab_municipios.id')
                                    ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                    ->leftjoin('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
                                    ->selectRaw('txt_modalidade, modalidade_id as id')
                                    ->where($where)
                                    ->groupBy('txt_modalidade', 'modalidade_id')
                                    ->orderBy('txt_modalidade', 'asc')
                                    ->get();
        
      

        return $modalidades;
    }

    public function acoesGoverno(){

        return AcoesGoverno::get();
    }

    public function anosOrcamento(){

        return Orcamento::selectRaw('num_ano_exercicio')->groupBy('num_ano_exercicio')->orderBy('num_ano_exercicio')->get();
    }

    public function tipoUsuario(){

        return TipoUsuario::where('id','>',7)->get();
    }

    public function tipoUsuarioModulo($modulo_sistema){

          
        if($modulo_sistema == 1){
            return TipoUsuario::whereIn('id',[1,2,3,4,5,6,7,10])->get();
        }else {
            return TipoUsuario::whereIn('id',[8])->get();
        }
        
    }

    public function entePublico(){

        return EntePublico::where('bln_ativo',true)->orderBy('txt_ente_publico')->get();
    }

    public function tipoEntePublico(){

        return TipoEntePublico::get();
    }

    public function moduloSistema(){

        return ModuloSistema::get();
    }

    public function titularidadeTerreno(){
        return TitularidadeTerreno::get();
    }

    public function tipoRisco(){
        return TipoRisco::get();
    }    

    public function infraestrututaBasica(){
        return InfraestrututaBasica::get();
    }    

    public function fonteRecurso(){
        return FonteRecurso::get();
    }  
    
    public function tipoOrganizacao(){
        return TipoOrganizacao::get();
    }  
    
    public function tipoIndeferimento(){
        return TipoIndeferimento::orderBy('txt_tipo_indeferimento')->get();
    }  
    
    public function modalidadeParticipacao(){
        return ModalidadeParticipacao::orderBy('txt_modalidade_participacao')->get();
    }  

    
}
