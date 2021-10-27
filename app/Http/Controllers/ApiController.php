<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mod_sishab\PropostasMcmv\ResumoPropostas;

use App\IndicadoresHabitacionais\Regiao;
use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;
use App\IndicadoresHabitacionais\BrasilComRm;

use App\Tab_dominios\StatusEmpreendimento;
use App\Tab_dominios\TipoLiberacao;
use App\Tab_dominios\Modalidade;
use App\Tab_dominios\SituacaoObra;
use App\Tab_dominios\TipoContrapartida;
use App\Tab_dominios\SituacaoAdesao;

use App\Mod_sishab\MedicoesObras\ViewMedicoesObras;


use App\Mod_sishab\Operacoes\Operacao;
use App\Mod_sishab\Operacoes\ViewOperacoesContratadas;
use App\Mod_sishab\Operacoes\HistoricoEntregas;

use App\Mod_sishab\OfertaPublica\Instituicao;
use App\Mod_sishab\OfertaPublica\ResumoProtocolos;

use App\Mod_selecao_demanda\EntePublico;
use App\Mod_selecao_demanda\DemandaGerada;

use App\Mod_prototipo\TitularidadeTerreno;
use App\Mod_prototipo\TipoRisco;
use App\Mod_prototipo\InfraestrututaBasica;
use App\Mod_prototipo\FonteRecurso;
use App\Mod_prototipo\TipoOrganizacao;
use App\Mod_prototipo\TipoIndeferimento;
use App\Mod_prototipo\ModalidadeParticipacao;
use App\Mod_prototipo\SituacaoTerreno;



class ApiController extends Controller
{

/** APIS TAB DOMINIOS */
    public function listaModalidades(){

        return $modalidades = Modalidade::orderBy('txt_modalidade')->get();
    }

    public function buscarSituacaoObraExecutivo(){       
        return SituacaoObra::orderBy('txt_situacao_obra')->get();

    }

    public function buscarStatusEmpreendimento(){   

        return StatusEmpreendimento::orderBy('txt_status_empreendimento')->get(); 
    }

    public function buscarStatusEmpreendimentoVigente($vigente){   

        return StatusEmpreendimento::where('bln_vigente',$vigente)
                ->get(); 
    }
    /** APIS TAB DOMINIOS */

/**APIS PROPOSTAS_MCMV */    

    public function buscarSelecoes(){
            
        $selecoes =  ResumoPropostas::select('selecao_id', 'num_selecao','num_ano_selecao','txt_modalidade')
                                    ->orderBy('num_selecao', 'asc')
                                    ->orderBy('num_ano_selecao', 'asc')
                                    ->groupBy('selecao_id', 'num_selecao','num_ano_selecao','txt_modalidade')
                                    ->get();

        return $selecoes;
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

    /**APIS PROPOSTAS_MCMV */    


    /**APIS INDICADORES HABITACIONAIS */    
    public function buscarRegioes(){        
        return Regiao::orderBy('txt_regiao')->get();
    }

    public function buscarUfs(){        
        return Uf::orderBy('txt_uf')->get();
    }

    public function buscarRides(){        
        return BrasilComRm::select('txt_rm_ride')
                        ->orderBy('txt_rm_ride', 'asc')
                        ->where('txt_rm_ride','<>','' )
                        ->groupBy('txt_rm_ride')
                        ->get();
    }

    public function buscarMunicipios($estado){
        
        return Municipio::where('uf_id', $estado)->orderBy('ds_municipio', 'asc')->get();
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

    public function buscarUfsRegiao($regiao){        
        return Uf::where('regiao_id',$regiao)->orderBy('txt_uf')->get();
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

    



    /**APIS INDICADORES HABITACIONAIS */    


    /**APIS TAB OPERACOES */    

    public function buscarAnos(){
        
        return [['num_ano_assinatura' => '2009'], 
                ['num_ano_assinatura' => '2010'], 
                ['num_ano_assinatura' => '2011'], 
                ['num_ano_assinatura' => '2012'], 
                ['num_ano_assinatura' => '2013'], 
                ['num_ano_assinatura' => '2014'], 
                ['num_ano_assinatura' => '2015'], 
                ['num_ano_assinatura' => '2016'], 
                ['num_ano_assinatura' => '2017'], 
                ['num_ano_assinatura' => '2018'], 
                ['num_ano_assinatura' => '2019'], 
                ['num_ano_assinatura' => '2020'], 
                ['num_ano_assinatura' => '2021']];
        
    }

    

    public function buscarAnosAte($ano){
        $where = [];
        $where[] = ['num_ano_assinatura','>=',$ano];
        
       
        $anos =  ViewOperacoesContratadas::select('num_ano_assinatura')
                    ->where($where)
                    ->groupBy('num_ano_assinatura')
                    ->orderBy('num_ano_assinatura', 'asc')
                    ->get();

        return $anos;
    }  

    public function buscarModalidadesEstado($estado){
        
        $where = [];
        $where[] = ['uf_id', $estado];
        

        $modalidades =  ViewOperacoesContratadas::selectRaw('txt_modalidade, modalidade_id as id')
                                    ->where($where)
                                    ->groupBy('txt_modalidade', 'modalidade_id')
                                    ->orderBy('txt_modalidade', 'asc')
                                    ->get();
        return $modalidades;
    }

    public function buscarEmpreendimentosEstado($estado){    
        
        
        $wherePropostas = [];
        $wherePropostas[] = ['uf_id', $estado];
        $wherePropostas[] = ['bln_contratada', false]; 
        $wherePropostas[] = ['txt_nome_empreendimento','<>', null];  

        $empreendimentosPropostas = ResumoPropostas::selectRaw('num_apf as txt_num_apf, max(txt_nome_empreendimento) as txt_nome_empreendimento')
                                        ->groupBy('num_apf', 'txt_nome_empreendimento')
                                        ->orderBy('txt_nome_empreendimento', 'asc')
                                        ->where($wherePropostas)->get();

        $where = [];
        $where[] = ['uf_id',$estado];
        $where[] = ['origem_id', 2];                    
        $where[] = ['txt_nome_empreendimento','<>', null];                    
       
          $empreendimentosContratados = ViewOperacoesContratadas::selectRaw('txt_apf as txt_num_apf,    txt_nome_empreendimento')
                                    ->groupBy('txt_num_apf', 'txt_nome_empreendimento')
                                    ->orderBy('txt_nome_empreendimento', 'asc')
                                    ->where($where)
                                    ->get();


         $empreendimentos = array_merge($empreendimentosPropostas->toArray(), $empreendimentosContratados->toArray());     
        
        
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
       
        $empreendimentosContratados = ViewOperacoesContratadas::selectRaw('txt_apf as txt_num_apf,    txt_nome_empreendimento')
                                    ->groupBy('txt_num_apf', 'txt_nome_empreendimento')
                                    ->orderBy('txt_nome_empreendimento', 'asc')
                                    ->where($where)
                                    ->get();

                                    $empreendimentos = array_merge($empreendimentosPropostas->toArray(), $empreendimentosContratados->toArray());     
        
        return $empreendimentos;        
    }

    public function buscarModalidadesMunicipio($municipio){
        
        $where = [];
        $where[] = ['municipio_id', $municipio];
        

        $modalidades =  ViewOperacoesContratadas::selectRaw('txt_modalidade, modalidade_id as id')
                                    ->where($where)
                                    ->groupBy('txt_modalidade', 'modalidade_id')
                                    ->orderBy('txt_modalidade', 'asc')
                                    ->get();
        
      

        return $modalidades;
    }

    /**APIS TAB OPERACOES */    

    /** APIS MEDICOES */

    public function buscarUfSolicitacoesPagamento(){       

        return ViewMedicoesObras::select('uf_id','txt_uf')
        ->groupBy('uf_id','txt_uf')
        ->orderBy('txt_uf')
        ->get();

    }    

    public function buscarMunSolicitacoesPagamento($estado){       
        
        $where = [];
        $where[] = ['uf_id', $estado];

        return ViewMedicoesObras::select('municipio_id','ds_municipio')
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
       
        return ViewMedicoesObras::select('tipo_liberacao_id as id','txt_tipo_liberacao')
        ->where($where)
        ->groupBy('tipo_liberacao_id','txt_tipo_liberacao')        
        ->orderBy('txt_tipo_liberacao')
        ->get();
        
    }   

    public function buscarMesUF($estado){       
        $where = [];
        $where[] = ['uf_id', $estado];
       
        return ViewMedicoesObras::select('num_mes_solicitacao','mes_solicitacao')
                                    ->where($where)
                                    ->groupBy('num_mes_solicitacao','mes_solicitacao')        
                                    ->orderBy('num_mes_solicitacao')
                                    ->get();
                                    
    } 

    public function buscarMesesSolicitacao(){       
        
        return ViewMedicoesObras::select('num_mes_solicitacao','mes_solicitacao','ano_solicitacao')
        ->groupBy('num_mes_solicitacao','mes_solicitacao','ano_solicitacao')        
        ->orderBy('ano_solicitacao','ASC')
        ->orderBy('num_mes_solicitacao')
        ->get();

    }

    public function buscarPosicoesDeSolicit(){      
        $posicoesDe =  ViewMedicoesObras::select('dte_solicitacao')
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

        $posicoesDe =  ViewMedicoesObras::select('dte_solicitacao')
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
        
        
        $posicoesAte =  ViewMedicoesObras::select('dte_solicitacao')
                                            ->groupBy('dte_solicitacao')  
                                            ->where($where)      
                                            ->orderBy('dte_solicitacao')
                                            ->get();
        
        foreach($posicoesAte as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_solicitacao));
        }
        return $posicoesAte;        
    } 

    public function buscarPosicoesAteLib($posicaoDeLib){    
        
        $where = [];

        if($posicaoDeLib){
            $where[] = ['dte_liberacao','>',$posicaoDeLib];
        }
        
        
        $posicoesAte =  ViewMedicoesObras::select('dte_liberacao')
                                            ->groupBy('dte_liberacao')  
                                            ->where($where)      
                                            ->orderBy('dte_liberacao')
                                            ->get();
        
        foreach($posicoesAte as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_liberacao));
        }
        return $posicoesAte;        
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
        


        $posicoesDe =  ViewMedicoesObras::select('dte_solicitacao')
                                            ->where($where)
                                            ->groupBy('dte_solicitacao')        
                                            ->orderBy('dte_solicitacao')
                                            ->get();
        
        foreach($posicoesDe as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_solicitacao));
        }
        return $posicoesDe;        
    }  
    
    public function buscarTipoLiberacaoMun($municipio){       
        $where = [];
        $where[] = ['municipio_id', $municipio];
       
        return ViewMedicoesObras::select('tipo_liberacao_id as id','txt_tipo_liberacao')
        ->where($where)
        ->groupBy('tipo_liberacao_id','txt_tipo_liberacao')        
        ->orderBy('txt_tipo_liberacao')
        ->get();
        
    } 

    public function buscarMesMun($municipio){       
        $where = [];
        $where[] = ['municipio_id', $municipio];
       
        return ViewMedicoesObras::select('num_mes_solicitacao','mes_solicitacao')
                                    ->where($where)
                                    ->groupBy('num_mes_solicitacao','mes_solicitacao')        
                                    ->orderBy('num_mes_solicitacao')
                                    ->get();
                                    
    } 

    public function buscarPosicoesDeSolicitMun($municipio){  
        $where = [];
        $where[] = ['municipio_id', $municipio];

        $posicoesDe =  ViewMedicoesObras::select('dte_solicitacao')
                                            ->where($where)
                                            ->groupBy('dte_solicitacao')        
                                            ->orderBy('dte_solicitacao')
                                            ->get();
        
        foreach($posicoesDe as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_solicitacao));
        }
        return $posicoesDe;        
    } 

    public function buscarMesTipoMun($municipio,$tipoLiberacao){       
        $where = [];

        if($municipio){
            $where[] = ['municipio_id', $municipio];
        }
        
     
        if($tipoLiberacao){
            $where[] = ['tipo_liberacao_id',$tipoLiberacao];
        }

        return ViewMedicoesObras::select('num_mes_solicitacao','mes_solicitacao')
                                    ->where($where)
                                    ->groupBy('num_mes_solicitacao','mes_solicitacao')        
                                    ->orderBy('num_mes_solicitacao')
                                    ->get();
                                    
    }

    public function buscarMesTipoUf($estado,$tipoLiberacao){       
        $where = [];


        
        if($estado){
            $where[] = ['uf_id',$estado];
        }
        if($tipoLiberacao){
            $where[] = ['tipo_liberacao_id',$tipoLiberacao];
        }

        return ViewMedicoesObras::select('num_mes_solicitacao','mes_solicitacao')
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

        $posicoesDe =  ViewMedicoesObras::select('dte_solicitacao')
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

        return ViewMedicoesObras::select('num_mes_solicitacao','mes_solicitacao','ano_solicitacao')
                                    ->where($where)
                                    ->groupBy('num_mes_solicitacao','mes_solicitacao','ano_solicitacao')        
                                    ->orderBy('ano_solicitacao','ASC')
                                    ->orderBy('num_mes_solicitacao')
                                    ->get();
                                    
    }

    public function buscarPosicoesDeTipo($tipoLiberacao){  
        $where = [];
        
        
        if($tipoLiberacao){
            $where[] = ['tipo_liberacao_id',$tipoLiberacao];
        }

        $posicoesDe =  ViewMedicoesObras::select('dte_solicitacao')
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
        
        $posicoesAte =  ViewMedicoesObras::select('dte_solicitacao')
                                            ->groupBy('dte_solicitacao')  
                                            ->where($where)      
                                            ->orderBy('dte_solicitacao')
                                            ->get();
        
        foreach($posicoesAte as $posicao){
            $posicao['dte_posicao_formatada'] = date('d/m/Y',strtotime($posicao->dte_solicitacao));
        }
        return $posicoesAte;        
    }    

      /** APIS MEDICOES */


      /** APIS OFERTA PUBLICA */

      public function buscarInstituicoes(){
        
        return Instituicao::where('id','<>', 3)->orderBy('txt_nome_if', 'asc')->get();
    }


    public function buscarUfsInstProtocolos($instituicao){        
        $estados =  ResumoProtocolos::select('id_uf', 'sg_uf')
                                    ->orderBy('sg_uf', 'asc')
                                    ->where('instituicao_id',$instituicao)
                                    ->groupBy('id_uf', 'sg_uf')
                                    ->get();

        return $estados;
    } 

    public function buscarUfsProtocolos(){        
        $estados =  ResumoProtocolos::select('id_uf', 'sg_uf')
                                    ->orderBy('sg_uf', 'asc')
                                    ->groupBy('id_uf', 'sg_uf')
                                    ->get();

        return $estados;
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
    
        
    public function buscarMunicipiosProtocolos($estado){   

        $municipio =  ResumoProtocolos::select('id_municipio', 'ds_municipio')
                                    ->where('id_uf',$estado)
                                    ->orderBy('ds_municipio', 'asc')
                                    ->groupBy('id_municipio', 'ds_municipio')
                                    ->get();

        return $municipio;
    } 

    /** APIS OFERTA PUBLICA */

/** APIS SELECAO DEMANDAS */
    public function buscarUfsEntesPublicos(){  
        
        $estados = DemandaGerada ::join('tab_municipios','tab_municipios.id','=','tab_demanda_gerada.municipio_id')
                                 ->join('tab_uf','tab_uf.id','=','tab_municipios.uf_id')
                                 ->selectRaw('tab_uf.id,txt_uf')
                                 ->groupBy('tab_uf.id','txt_uf')
                                 ->orderBy('txt_sigla_uf')
                               ->get();
    return response()->json($estados);
    }  

    public function buscarMunicipioEstadoEntePublico($municipio){
        
        return DemandaGerada ::join('tab_municipios','tab_municipios.id','=','tab_demanda_gerada.municipio_id')
        ->join('tab_uf','tab_uf.id','=','tab_municipios.uf_id')
        ->where('id', $municipio)->value('uf_id');
      
    }

    public function buscarMunicipioEntePublico($estado){
        
        return DemandaGerada::join('tab_municipios','tab_municipios.id','=','tab_demanda_gerada.municipio_id')
                            ->selectRaw('tab_municipios.id, ds_municipio')
                            ->where('tab_municipios.uf_id', $estado)
                            ->groupBy('tab_municipios.id', 'ds_municipio')
                            ->orderBy('ds_municipio')
                        ->get();
      
    }


/** APIS SELECAO DEMANDAS */


/** APIS PROTÓTIPOS HIS */
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
        return ModalidadeParticipacao::where('bln_ativo',true)->orderBy('txt_modalidade_participacao')->get();
    }  

    public function situacaoTerreno(){
        return SituacaoTerreno::orderBy('id')->get();
        
    }  

/** APIS PROTÓTIPOS HIS */


/** APIS PCVA PARCERIA */

    public function tipoContrapartida(){
        return TipoContrapartida::orderBy('id')->orderBy('txt_tipo_contrapartida')->get();
        
    } 

    public function situacaoAdesao(){
        return SituacaoAdesao::orderBy('txt_situacao_adesao')->get();
        
    } 

/** APIS PCVA PARCERIA */


public function buscarDadosGraficoEntregasMes($operacao_id){
    
     $entregas = HistoricoEntregas::selectRaw("operacao_id, 
                                                date_part('YEAR'::text, dte_entrega) AS num_ano_entrega,
                                                sum(qtd_uh_entregues) as total_uh_entregues,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 1 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_jan,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 2 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_fev,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 3 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_mar,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 4 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_abr,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 5 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_mai,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 6 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_jun,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 7 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_jul,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 8 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_ago,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 9 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_set,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 10 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_out,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 11 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_nov,
                                                sum(CASE WHEN date_part('MONTH'::text, dte_entrega) = 12 THEN  qtd_uh_entregues
                                                        else 0 
                                                        END) AS mes_dez")
                                                ->where('operacao_id', $operacao_id)
                                                ->groupby("operacao_id", "num_ano_entrega")
                                                ->orderby( "num_ano_entrega")
                                                ->get();

                                                $graficoEntrega = array();    
        $cores = [
            1 => "#3490dc",
            2 => "#f66D9b",
            3 => "#9561e2",
            4 => "#38c172",
            5 => "#e3342f",
            6 => "#f6993f",
            7 => "#ffed4a",
            8 => "#6574cd",
            9 => "#4dc0b5",
            10 => "#6cb2eb",
            11 => "#fff",
            12 => "#6c757d"
        ];

        $count = 1;
        
            foreach($entregas as $entrega){
                $dados['fillColor'] = $cores[$count];
                $dados['strokeColor'] = $cores[$count];
                $dados['pointColor'] = $cores[$count];
                $dados['pointStrokeColor'] = "fff";  
                $dados['data'] = "[". $entrega->mes_jan .', '. $entrega->mes_fev .', '.$entrega->mes_mar .', '.$entrega->mes_abr .', '.$entrega->mes_mai .', '.$entrega->mes_jun .', '.
                                            $entrega->mes_jul .', '.$entrega->mes_ago .', '.$entrega->mes_set .', '.$entrega->mes_out .', '.$entrega->mes_nov .', '.$entrega->mes_dez . "]";
                $dados['label'] = $entrega->num_ano_entrega; 
                array_push($graficoEntrega, $dados);
                $count++;
        }  

        return $graficoEntrega;

    }        
    
    public function buscarDadosGraficoEntregasAno($operacao_id){
    
        $entregas = HistoricoEntregas::selectRaw("operacao_id, 
                                                   sum(qtd_uh_entregues) as total_uh_entregues,
                                                   sum(CASE WHEN date_part('YEAR'::text, dte_entrega) = 2009 THEN  qtd_uh_entregues
                                                           else 0 
                                                           END) AS ano_2009,
                                                    sum(CASE WHEN date_part('YEAR'::text, dte_entrega) = 2010 THEN  qtd_uh_entregues
                                                           else 0 
                                                           END) AS ano_2010,
                                                    sum(CASE WHEN date_part('YEAR'::text, dte_entrega) = 2011 THEN  qtd_uh_entregues
                                                           else 0 
                                                           END) AS ano_2011,
                                                    sum(CASE WHEN date_part('YEAR'::text, dte_entrega) = 2012 THEN  qtd_uh_entregues
                                                           else 0 
                                                           END) AS ano_2012,
                                                    sum(CASE WHEN date_part('YEAR'::text, dte_entrega) = 2013 THEN  qtd_uh_entregues
                                                           else 0 
                                                           END) AS ano_2013,
                                                    sum(CASE WHEN date_part('YEAR'::text, dte_entrega) = 2014 THEN  qtd_uh_entregues
                                                           else 0 
                                                           END) AS ano_2014,
                                                    sum(CASE WHEN date_part('YEAR'::text, dte_entrega) = 2015 THEN  qtd_uh_entregues
                                                           else 0 
                                                           END) AS ano_2015,
                                                    sum(CASE WHEN date_part('YEAR'::text, dte_entrega) = 2016 THEN  qtd_uh_entregues
                                                           else 0 
                                                           END) AS ano_2016,
                                                    sum(CASE WHEN date_part('YEAR'::text, dte_entrega) = 2017 THEN  qtd_uh_entregues
                                                           else 0 
                                                           END) AS ano_2017,
                                                    sum(CASE WHEN date_part('YEAR'::text, dte_entrega) = 2018 THEN  qtd_uh_entregues
                                                           else 0 
                                                           END) AS ano_2018,
                                                    sum(CASE WHEN date_part('YEAR'::text, dte_entrega) = 2019 THEN  qtd_uh_entregues
                                                           else 0 
                                                           END) AS ano_2019,
                                                    sum(CASE WHEN date_part('YEAR'::text, dte_entrega) = 2020 THEN  qtd_uh_entregues
                                                           else 0 
                                                           END) AS ano_2020,
                                                    sum(CASE WHEN date_part('YEAR'::text, dte_entrega) = 2021 THEN  qtd_uh_entregues
                                                           else 0 
                                                           END) AS ano_2021
                                                                  ")
                                                   ->where('operacao_id', $operacao_id)
                                                   ->groupby("operacao_id")
                                                   ->get();
   
                                                   $graficoEntrega = array();    
   
           $count = 1;
           
               foreach($entregas as $entrega){
                   $dados['fillColor'] = '#6cb2eb';
                   $dados['strokeColor'] ="#6c757d";
                   $dados['pointColor'] = "#3490dc";
                   $dados['pointStrokeColor'] = "fff";  
                   $dados['data'] = "[". $entrega->ano_2009 .', '. $entrega->ano_2010 .', '.$entrega->ano_2011 .', '.$entrega->ano_2012 .', '.$entrega->ano_2013 .', '.$entrega->ano_2014 .', '.
                                               $entrega->ano_2015 .', '.$entrega->ano_2016 .', '.$entrega->ano_2017 .', '.$entrega->ano_2018 .', '.$entrega->ano_2019 .', '.$entrega->ano_2020 .', '.$entrega->ano_2021 . "]";
                   $dados['label'] = "Entregas de UH"; 
                   array_push($graficoEntrega, $dados);
                   $count++;
           }  
   
           return $graficoEntrega;
   
       }    
}