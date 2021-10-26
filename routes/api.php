<?php

use Illuminate\Http\Request;
use App\oferta\Protocolo;



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

Route::get('/propostas/municipios/{estado}', 'ApiController@buscarMunicipiosPropostas');
Route::get('/selecao/ufs', 'ApiController@buscarUfsPropostas');


//selecao contratadas
Route::get('/contratadas/regioes', 'ApiController@buscarRegioesContratadas');
Route::get('/contratadas/ufs', 'ApiController@buscarUfsContratadas');
Route::get('/contratadas/modalidades', 'ApiController@buscarModalidadesContratadas');
Route::get('/contratadas/anosSelecao', 'ApiController@buscarAnosSelecaoContratadas');
Route::get('/contratadas/estados/{regiao}', 'ApiController@buscarEstadosContratadas');
Route::get('/contratadas/modalidades/{regiao}', 'ApiController@buscarModalidadesRegiaoContratadas');
Route::get('/contratadas/municipios/{estado}', 'ApiController@buscarMunicipiosContratadas');

Route::get('/contratadas/ano/regiao/{regiao}', 'ApiController@buscarAnosRegioesContratadas');
Route::get('/contratadas/ano/estado/{estado}', 'ApiController@buscarAnosEstadoContratadas');
Route::get('/contratadas/ano/municipio/{municipio}', 'ApiController@buscarAnosMunicipioContratadas');
Route::get('/contratadas/ano/modalidade/{modalidade}', 'ApiController@buscarAnosModalidadeContratadas');






Route::get('/municipios/{estado}', 'ApiController@buscarMunicipios');
Route::get('/municipio/estado/{municipio}', 'ApiController@buscarMunicipioEstado');
Route::get('/municipios/contratacao/{estado}', 'ApiController@buscarMunicipiosContratacao');
Route::get('/ufs', 'ApiController@buscarUfs');

Route::get('/executivo/municipios/{estado}', 'ApiController@buscarMunicipios');
Route::get('/executivo/rides/', 'ApiController@buscarRides');
Route::get('/executivo/rides/{estado}', 'ApiController@buscarUfsRides');
Route::get('/executivo/rides/regiao/{regiao}', 'ApiController@buscarRegioesRides');
Route::get('/executivo/ufs', 'ApiController@buscarUfs');
Route::get('/executivo/ufs/{regiao}', 'ApiController@buscarUfsRegiao');
Route::get('/executivo/regioes', 'ApiController@buscarRegioes');
Route::get('/executivo/anos', 'ApiController@buscarAnos');
Route::get('/executivo/anos/{ano}', 'ApiController@buscarAnosAte');
Route::get('/executivo/posicoes', 'ApiController@buscarPosicoesDe');
Route::get('/executivo/posicao/{posicao}', 'ApiController@buscarPosicoesAte');
Route::get('/executivo/situacaoObra', 'ApiController@buscarSituacaoObraExecutivo');
Route::get('/executivo/statusEmpreendimento', 'ApiController@buscarStatusEmpreendimento');
Route::get('/executivo/statusEmpreendimento/vigente/{vigente}', 'ApiController@buscarStatusEmpreendimentoVigente');

Route::get('/executivo/empreendimento/municipios/{estado}', 'ApiController@buscarMunicipiosEmpreendimentos');
Route::get('/executivo/empreendimento/{municipio}', 'ApiController@buscarEmpreendimentos');
Route::get('/executivo/empreendimento/{municipio}/{modalidade}', 'ApiController@buscarEmpreendimentosModalidade');

Route::get('/executivo/modalidade/{municipio}', 'ApiController@buscarModalidades');
Route::get('/executivo/modalidade/municipio/{municipio}', 'ApiController@buscarModalidadesMunicipio');
Route::get('/executivo/modalidade/estado/{estado}', 'ApiController@buscarModalidadesEstado');

Route::get('/modalidade/estado/{estado}', 'ApiController@buscarModalidadesUfPropostas');
Route::get('/modalidade/municipio/{municipio}', 'ApiController@buscarModalidadesMunPropostas');
Route::get('/selecao/estado/{estado}', 'ApiController@buscarSelecoesUfPropostas');
Route::get('/selecao/municipio/{municipio}', 'ApiController@buscarSelecoesMunPropostas');
Route::get('/selecao/modalidade/{modalidade}', 'ApiController@buscarSelecoesModPropostas');

Route::get('/retomada/municipios/{estado}', 'ApiController@buscarMunicipiosRetomada');
Route::get('/retomada/ufs', 'ApiController@buscarUfsRetomada');

Route::get('/situacaoObra', 'ApiController@buscarSituacaoObra');
Route::get('/situacaoObra/estado/{estado}', 'ApiController@buscarSituacaoObraEstados');
Route::get('/situacaoObra/municipio/{municipio}', 'ApiController@buscarSituacaoObraMunicipio');

Route::get('/statusSNH', 'ApiController@buscarStatusSnh');
Route::get('/statusSNH/estado/{estado}', 'ApiController@buscarStatusSnhEstados');
Route::get('/statusSNH/municipio/{municipio}', 'ApiController@buscarStatusSnhMunicipio');


Route::get('/protocolos/ufs', 'ApiController@buscarUfsProtocolos');
Route::get('/protocolos/municipios/{estado}', 'ApiController@buscarMunicipiosProtocolos');

Route::get('/instituicoes', 'ApiController@buscarInstituicoes');
Route::get('/protocolos/ufs/{instituicao}', 'ApiController@buscarUfsInstProtocolos');
Route::get('/protocolos/municipios/{instituicao}/{estado}', 'ApiController@buscarMunicipiosInstProtocolos');

//pesquisas com autocomplete

Route::get('/protocolo/search/{query}', 'ApiController@autocompleteProtocolos');
Route::get('/contrato/search/{query}', 'ApiController@autocompleteNis');
Route::get('/proposta/search/{query}', 'ApiController@autocompleteAPF');
Route::get('/proposta/proponente/search/{query}', 'ApiController@autocompleteCNPJ');
Route::get('/limite/search/{query}', 'ApiController@autocompleteLimite');

//codem
Route::get('/tipoDemanda', 'ApiController@listaTipoDemanda');
Route::get('/tipoAtendimento', 'ApiController@listaTipoAtendimento');
Route::get('/tema', 'ApiController@listaTema');
Route::get('/subTema/{tema}', 'ApiController@listaSubTema');
Route::get('/prioridade', 'ApiController@listaPrioridade');
Route::get('/prioridade/{qtd_dias}', 'ApiController@buscaPrioridade');
Route::get('/tipo_interessado', 'ApiController@listaTipoInteressado');
Route::get('/modalidade_demanda', 'ApiController@listaModalidadeDemanda');
Route::get('/tema/subTema/{subtema}', 'ApiController@buscaIdTema');

Route::get('/codem/demandas/novas/{usuarioID}', 'ApiController@retornarDemandasNovas');
Route::get('/codem/demandas/atrasadas/{usuarioID}', 'ApiController@retornarDemandasAtrasadas');

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



Route::get('/tipoLiberacao/municipio/{municipio}', 'ApiController@buscarTipoLiberacaoMun');
Route::get('/mes/municipio/{municipio}', 'ApiController@buscarMesMun');
Route::get('/posicoesDe/municipio/{municipio}', 'ApiController@buscarPosicoesDeSolicitMun');


Route::get('/mes_tipo/municipio/{municipio}/tipoLiberacao/{tipoLiberacao}', 'ApiController@buscarMesTipoMun');
Route::get('/mes_tipo/uf/{estado}/tipoLiberacao/{tipoLiberacao}', 'ApiController@buscarMesTipoUf');
Route::get('/posicoesDe_tipo/municipio/{municipio}/tipoLiberacao/{tipoLiberacao}', 'ApiController@buscarPosicoesDeTipoMun');
Route::get('/posicoesDe_tipo/uf/{estado}/tipoLiberacao/{tipoLiberacao}', 'ApiController@buscarPosicoesDeTipoUf');
Route::get('/mes_tipo/tipoLiberacao/{tipoLiberacao}', 'ApiController@buscarMesTipo');
Route::get('/posicoesDe_tipo/tipoLiberacao/{tipoLiberacao}', 'ApiController@buscarPosicoesDeTipo');

Route::get('/posicoesDe/mesSolicitacao/{mesSolicitacao}', 'ApiController@buscarPosicoesDeSolicitMes');
Route::get('/mesSolicitacao/{mesSolicitacao}/posicoesAte/{posicoesDe}', 'ApiController@buscarPosicoesAteSolicitMes');
Route::get('/mesLiberacao/{mesLiberacao}/posicoesAteLib/{posicoesDeLib}', 'ApiController@buscarPosicoesAteLibMes');

Route::get('/mesesLiberacao', 'ApiController@buscarMesesLiberacao');

Route::get('/posicoesDeLib/mesLiberacao/{mesLiberacao}', 'ApiController@buscarPosicoesDeLibMes');

Route::get('/uf/empreendimentos/{estado}', 'ApiController@buscarEmpreendimentosEstado');
Route::get('/municipio/empreendimentos/{municipio}', 'ApiController@buscarEmpreendimentosMuncipio');

Route::get('/vinculadas/municipios/{estado}', 'ApiController@buscarMunicipiosVinculadas');
Route::get('/modalidades', 'ApiController@listaModalidades');
Route::get('/entregas/anos', 'ApiController@anosEntregas');
Route::get('/faixas', 'ApiController@listaFaixas');

Route::get('/orcamento/acoesGoverno', 'ApiController@acoesGoverno');
Route::get('/orcamento/anos', 'ApiController@anosOrcamento');

Route::get('/tipoUsuario', 'ApiController@tipoUsuario');
Route::get('/tipoUsuario/{modulo_sistema}', 'ApiController@tipoUsuarioModulo');
Route::get('/moduloSistema', 'ApiController@moduloSistema');
Route::get('/entePublico', 'ApiController@entePublico');
Route::get('/tipoEntePublico', 'ApiController@tipoEntePublico');

//prototipo
Route::get('/titularidadeTerreno', 'ApiController@titularidadeTerreno');
Route::get('/tipoRisco', 'ApiController@tipoRisco');
Route::get('/infraestrututaBasica', 'ApiController@infraestrututaBasica');
Route::get('/fonteRecurso', 'ApiController@fonteRecurso');
Route::get('/tipoOrganizacao', 'ApiController@tipoOrganizacao');
Route::get('/tipoIndeferimento', 'ApiController@tipoIndeferimento');
Route::get('/modalidade_participacao', 'ApiController@modalidadeParticipacao');