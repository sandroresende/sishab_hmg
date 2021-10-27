<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/** GERAIS TAB DOMINIOS*/

Route::get('/modalidades', 'ApiController@listaModalidades');
Route::get('/municipios/{estado}', 'ApiController@buscarMunicipios');
Route::get('/situacaoObra', 'ApiController@buscarSituacaoObraExecutivo');
Route::get('/statusEmpreendimento', 'ApiController@buscarStatusEmpreendimento');


//prototipo
Route::get('/titularidadeTerreno', 'ApiController@titularidadeTerreno');
Route::get('/tipoRisco', 'ApiController@tipoRisco');
Route::get('/infraestrututaBasica', 'ApiController@infraestrututaBasica');
Route::get('/fonteRecurso', 'ApiController@fonteRecurso');
Route::get('/tipoOrganizacao', 'ApiController@tipoOrganizacao');
Route::get('/tipoIndeferimento', 'ApiController@tipoIndeferimento');
Route::get('/modalidade_participacao', 'ApiController@modalidadeParticipacao');
Route::get('/situacaoTerreno', 'ApiController@situacaoTerreno');

Route::get('/tipo_contrapartida', 'ApiController@tipoContrapartida');
Route::get('/situacao_adesao', 'ApiController@situacaoAdesao');

/** GERAIS TAB DOMINIOS*/

/** GERAIS INDICADORES HABITACIONAIS*/
Route::get('/municipios/{estado}', 'ApiController@buscarMunicipios');
Route::get('/municipio/estado/{municipio}', 'ApiController@buscarMunicipioEstado');
Route::get('/ufs', 'ApiController@buscarUfs');

/** GERAIS INDICADORES HABITACIONAIS*/


/**PROPOSTAS MCMV */

Route::get('/selecao', 'ApiController@buscarSelecoes');
Route::get('/selecao/ufs', 'ApiController@buscarUfsPropostas');
Route::get('/propostas/municipios/{estado}', 'ApiController@buscarMunicipiosPropostas');
Route::get('/modalidade/estado/{estado}', 'ApiController@buscarModalidadesUfPropostas');
Route::get('/selecao/estado/{estado}', 'ApiController@buscarSelecoesUfPropostas');

Route::get('/modalidade/municipio/{municipio}', 'ApiController@buscarModalidadesMunPropostas');
Route::get('/selecao/municipio/{municipio}', 'ApiController@buscarSelecoesMunPropostas');

Route::get('/selecao/modalidade/{modalidade}', 'ApiController@buscarSelecoesModPropostas');

//selecao contratadas
Route::get('/contratadas/regioes', 'ApiController@buscarRegioesContratadas');
Route::get('/contratadas/ufs', 'ApiController@buscarUfsContratadas');
Route::get('/contratadas/estados/{regiao}', 'ApiController@buscarEstadosContratadas');
Route::get('/contratadas/ano/regiao/{regiao}', 'ApiController@buscarAnosRegioesContratadas');
Route::get('/contratadas/ano/estado/{estado}', 'ApiController@buscarAnosEstadoContratadas');
Route::get('/contratadas/ano/municipio/{municipio}', 'ApiController@buscarAnosMunicipioContratadas');
Route::get('/contratadas/ano/modalidade/{modalidade}', 'ApiController@buscarAnosModalidadeContratadas');
Route::get('/contratadas/municipios/{estado}', 'ApiController@buscarMunicipiosContratadas');

Route::get('/contratadas/modalidades', 'ApiController@buscarModalidadesContratadas');
Route::get('/contratadas/anosSelecao', 'ApiController@buscarAnosSelecaoContratadas');

Route::get('/contratadas/modalidades/{regiao}', 'ApiController@buscarModalidadesRegiaoContratadas');

Route::get('/grafico/entregas/mes/{operacao_id}', 'ApiController@buscarDadosGraficoEntregasMes');
Route::get('/grafico/entregas/ano/{operacao_id}', 'ApiController@buscarDadosGraficoEntregasAno');









/**OPERACOES */

Route::get('/executivo/regioes', 'ApiController@buscarRegioes');
Route::get('/executivo/ufs', 'ApiController@buscarUfs');
Route::get('/executivo/rides/', 'ApiController@buscarRides');
Route::get('/executivo/anos', 'ApiController@buscarAnos');



Route::get('/executivo/rides/{estado}', 'ApiController@buscarUfsRides');

Route::get('/executivo/ufs/{regiao}', 'ApiController@buscarUfsRegiao');
Route::get('/executivo/rides/regiao/{regiao}', 'ApiController@buscarRegioesRides');

Route::get('/executivo/anos/{ano}', 'ApiController@buscarAnosAte');
Route::get('/executivo/statusEmpreendimento/vigente/{vigente}', 'ApiController@buscarStatusEmpreendimentoVigente');



/** MEDICOES */
Route::get('/solicitacoes/pagamento/ufs', 'ApiController@buscarUfSolicitacoesPagamento');
Route::get('/solicitacoes/pagamento/municipios/{estado}', 'ApiController@buscarMunSolicitacoesPagamento');
Route::get('/tipoLiberacao', 'ApiController@buscarTipoLiberacao');
Route::get('/tipoLiberacao/uf/{estado}', 'ApiController@buscarTipoLiberacaoUF');
Route::get('/mes/uf/{estado}', 'ApiController@buscarMesUF');
Route::get('/mesesSolicitacao', 'ApiController@buscarMesesSolicitacao');
Route::get('/posicoesDe', 'ApiController@buscarPosicoesDeSolicit');
Route::get('/posicoesDe/uf/{estado}', 'ApiController@buscarPosicoesDeSolicitUF');
Route::get('/posicoesAte/{posicoesDe}', 'ApiController@buscarPosicoesAteSolicit');
Route::get('/posicoesAteLib/{posicoesDeLib}', 'ApiController@buscarPosicoesAteLib');
Route::get('/posicoesDeLib', 'ApiController@buscarLiberacoes');

Route::get('/posicoesDe/mesSolicitacao/{mesSolicitacao}', 'ApiController@buscarPosicoesDeSolicitMes');

Route::get('/tipoLiberacao/municipio/{municipio}', 'ApiController@buscarTipoLiberacaoMun');
Route::get('/mes/municipio/{municipio}', 'ApiController@buscarMesMun');
Route::get('/posicoesDe/municipio/{municipio}', 'ApiController@buscarPosicoesDeSolicitMun');

Route::get('/mes_tipo/municipio/{municipio}/tipoLiberacao/{tipoLiberacao}', 'ApiController@buscarMesTipoMun');
Route::get('/mes_tipo/uf/{estado}/tipoLiberacao/{tipoLiberacao}', 'ApiController@buscarMesTipoUf');
Route::get('/posicoesDe_tipo/municipio/{municipio}/tipoLiberacao/{tipoLiberacao}', 'ApiController@buscarPosicoesDeTipoMun');
Route::get('/posicoesDe_tipo/uf/{estado}/tipoLiberacao/{tipoLiberacao}', 'ApiController@buscarPosicoesDeTipoUf');
Route::get('/mes_tipo/tipoLiberacao/{tipoLiberacao}', 'ApiController@buscarMesTipo');
Route::get('/posicoesDe_tipo/tipoLiberacao/{tipoLiberacao}', 'ApiController@buscarPosicoesDeTipo');

Route::get('/mesSolicitacao/{mesSolicitacao}/posicoesAte/{posicoesDe}', 'ApiController@buscarPosicoesAteSolicitMes');

/** EMPREENDIMENTOS */
Route::get('/executivo/modalidade/estado/{estado}', 'ApiController@buscarModalidadesEstado');
Route::get('/uf/empreendimentos/{estado}', 'ApiController@buscarEmpreendimentosEstado');
Route::get('/municipio/empreendimentos/{municipio}', 'ApiController@buscarEmpreendimentosMuncipio');
Route::get('/executivo/modalidade/municipio/{municipio}', 'ApiController@buscarModalidadesMunicipio');

/** OFERTA PÚBLICA */
Route::get('/instituicoes', 'ApiController@buscarInstituicoes');
Route::get('/protocolos/ufs', 'ApiController@buscarUfsProtocolos');
Route::get('/protocolos/ufs/{instituicao}', 'ApiController@buscarUfsInstProtocolos');
Route::get('/protocolos/municipios/{estado}', 'ApiController@buscarMunicipiosProtocolos');
Route::get('/protocolos/municipios/{instituicao}/{estado}', 'ApiController@buscarMunicipiosInstProtocolos');

/** SELEÇÃO DEMANDA */
Route::get('/entes_publicos/ufs', 'ApiController@buscarUfsEntesPublicos');
Route::get('/entes_publicos/municipio/estado/{municipio}', 'ApiController@buscarMunicipioEstadoEntePublico');
Route::get('/entes_publicos/municipios/{estado}', 'ApiController@buscarMunicipioEntePublico');

/** PCVA PARCERIA */

Route::get('/tipo_contrapartida', 'ApiController@tipoContrapartida');
Route::get('/situacao_adesao', 'ApiController@situacaoAdesao');

