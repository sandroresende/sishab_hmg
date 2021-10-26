<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//acesso publico
Route::get('/home', 'HomeController@index');
Route::get('/', 'WelcomeController@index');
Route::get('/consultaRapida', 'HomeController@consultaRapida');




//SELEÇÃO
Route::get('/selecao', 'SelecaoController@index');
Route::post('/selecao/portaria', 'PropostasController@buscaPropostaPortaria');
Route::get('/selecao/resumo/filtro', 'PropostasController@buscaResumoSelecao');
Route::post('/selecao/resumo', 'PropostasController@resumoSelecao');
Route::get('/selecao/resumo-download/{estado}', 'PropostasController@selecaoResumoExport'); //Rota do Excel de Selecao Resumo (Selecao)
Route::get('/contratadas/resumo/filtro', 'PropostasController@buscaResumoContratadas');

//CONTRATADAS
Route::post('/contratadas', 'PropostasController@propostasContratadas');
Route::get('/contratadas-download/{regiao}/{estado}/{municipio}/{modalidade}/{ano}', 'PropostasController@export'); //Rota do Excel de Resumo Contratadas (Selecao)



//PROPOSTAS
Route::post('/propostas', 'PropostasController@propostasApresentadas');
Route::get('/propostas-apresentadas-download/{estado}/{municipio}/{modalidade}/{selecao}', 'PropostasController@propostasApresentadasExport'); //Rota do Excel e Resumo Seleção (Selecao)
Route::get('/proposta/{propostaID}/{numAPF}', 'PropostasController@proposta');
Route::post('/proposta/apf', 'PropostasController@buscaPropostaAPF');
Route::post('/proposta/proponente', 'PropostasController@buscaPropostaCNPJ');
Route::get('/proposta/{propostaID}', 'PropostasController@proposta');


//RETOMADA
Route::get('/retomadas/filtro', 'RetomadaController@index')->middleware('can:eMaster');

Route::post('/operacoes_retomadas', 'RetomadaController@operacoesRetomadas')->middleware('can:eMaster');
Route::get('/operacao_retomada/{operacaoRetomadaId}', 'RetomadaController@operacaoRetomada')->middleware('can:eMaster');
Route::get('/operacao_retomada/retomada/{RetomadaId}', 'RetomadaController@retomada')->middleware('can:eMaster');
Route::post('/observacao/nova', 'RetomadaController@cadastrarNovaObservacao')->middleware('can:eMaster');
Route::get('/retomada/observacao/delete/{observacaoId}', 'RetomadaController@deleteObservacao')->middleware('can:eMaster');


//acesso restrito

//EXECUTIVO
Route::get('/executivo/consulta/ibge', 'ResumoExecutivoController@consultaLimiteIBGE');
Route::post('/executivo/limite/ibge', 'ResumoExecutivoController@buscaLimiteIbge');
Route::get('/executivo/limite/filtro', 'ResumoExecutivoController@consultaLimite');
Route::get('/executivo/filtro', 'ResumoExecutivoController@consultaRelExecutivo');
Route::post('/executivo/relatorio', 'ResumoExecutivoController@buscaMilagroso');
Route::get('/executivo/relatorio-download/{regiao}/{estado}/{municipio}/{rm_ride}/{ano_de}/{ano_ate}', 'ResumoExecutivoController@resumoMilagrosoExport'); // Rota do Excel Resumo Milagrosos (Relatorio Executivo)
Route::post('/executivo/historico', 'ResumoExecutivoController@buscarExecutivoHistorico');
Route::get('/executivo/historico/filtro', 'ResumoExecutivoController@filtroRelExecutivoHistorico');

Route::get('/executivo/empreendimentos/filtro', 'ResumoExecutivoController@consultaEmpreendimento');
Route::post('/executivo/empreendimentos', 'ResumoExecutivoController@buscaEmpreendimento');
Route::get('/executivo/empreendimento/{operacaoId}', 'ResumoExecutivoController@dados_empreendimento');
Route::get('/executivo/empreendimentos-download/{regiao}/{estado}/{municipio}/{modalidade}/{empreendimento}/{faixa}', 'ResumoExecutivoController@empreendimentosExport'); // Rota do Excel Resumo Empreendimentos
Route::post('/executivo/historico', 'ResumoExecutivoController@buscarExecutivoHistorico');

Route::get('/executivo/contratacao/filtro', 'ResumoExecutivoController@filtroSitucaoContratacao');
Route::post('/executivo/contratacao', 'ResumoExecutivoController@dadosSitucaoContratacao');

Route::get('/executivo/detalhar/modalidade/{modalidadeID}/{faixaID}/{municipioID}', 'ResumoExecutivoController@buscaEmpreendimentoModalidadeMilagro');
Route::get('/executivo/download/{regiao}/{estado}/{municipio}/{rm_ride}/{ano_de}/{ano_ate}', 'ResumoExecutivoController@relatorioExecutivoExport'); // Rota do Excel Resumo Milagrosos (Relatorio Executivo)
Route::get('/executivo/download/base', 'ResumoExecutivoController@baseExecutivoExport'); // Rota do Excel Resumo Milagrosos (Relatorio Executivo)


//NOVO RELATORIO EXECUTIVO
Route::get('/novo_executivo/filtro', 'ResumoExecutivoController@consultaRelExecutivoInt');
Route::post('/novo_executivo/relatorio', 'ResumoExecutivoController@novoRelatorioExecutivo');
Route::get('/novo_executivo/detalhar/modalidade/{modalidadeID}/{faixaID}/{municipioID}', 'EmpreendimentoController@buscaEmpreendimentoModalidadeExecutivo');


Route::post('/entregas', 'ResumoExecutivoController@quantidadeEntregas');
Route::get('/entregas/filtro', 'ResumoExecutivoController@filtroEntregas');

Route::get('/orcamentos/filtro', 'FinanceiroController@filtroOrcamentos');
Route::post('/orcamentos', 'FinanceiroController@dadosOrcamentos');

//BENEFICIARIOS
Route::get('/beneficiarios/filtro', 'BeneficiarioController@filtro_beneficiarios');
Route::post('/beneficiarios/consulta', 'BeneficiarioController@consulta_beneficiarios');

// DETALHES DADOS CONTRATACAO
Route::get('/executivo/relatorio/detalhesContratacao', 'ResumoExecutivoController@detalhesContratacao');
Route::get('/novo_executivo/relatorio/detalhesContratacao', 'ResumoExecutivoController@detalhesContratacaoInt');


// DETALHES DADOS PROPOSTAS
Route::get('/executivo/relatorio/detalhesPropostas', 'ResumoExecutivoController@detalhesPropostas');

//FINANCEIRO
Route::get('/pagamento/quadro_resumo/filtro', 'FinanceiroController@consultaSolicitacoes');
Route::post('/pagamento/quadroResumo', 'FinanceiroController@QuadroResumoSolicitacoes');
Route::get('/pagamento/situacao/filtro', 'FinanceiroController@consultaSituacaoPagamento');
Route::post('/pagamento/situacao', 'FinanceiroController@situacaoPagamento');
Route::get('/pagamento/solicitacao/{apf}', 'FinanceiroController@solicitacoesAPF');

Route::get('/externo/pagamento/situacao/filtro', 'ResumoExecutivoController@consultaSituacaoPagamento');
Route::post('/externo/pagamento/situacao', 'ResumoExecutivoController@situacaoPagamento');


//OFERTA
Route::get('/protocolos/filtro', 'oferta\ProtocolosController@filtro_protocolos')->middleware('can:eOferta');
Route::get('/protocolos/instituicao/filtro', 'oferta\ProtocolosController@filtro_protocolos_if')->middleware('can:eOferta');
Route::post('/protocolos', 'oferta\ProtocolosController@protocolos')->middleware('can:eOferta');
Route::post('/protocolos/instituicao', 'oferta\ProtocolosController@protocolos_instituicao')->middleware('can:eOferta');
Route::get('/protocolo/{protocolo}', 'oferta\ProtocolosController@contratos_protocolo')->middleware('can:eOferta');
Route::post('/protocolo', 'oferta\ProtocolosController@protocolo')->middleware('can:eOferta');
Route::get('/contrato/{contrato}', 'oferta\ContratoController@dados_contrato')->middleware('can:eOferta');
Route::get('/contratos/instituicao/filtro', 'oferta\ContratoController@filtro_contratos_if')->middleware('can:eOferta');
Route::post('/contratos/instituicao', 'oferta\ContratoController@contratos_instituicao')->middleware('can:eOferta');

Route::post('/contrato', 'oferta\ContratoController@contrato')->middleware('can:eOferta');
Route::get('/contrato/{oferta}/{nis}', 'oferta\ContratoController@contrato_oferta')->middleware('can:eOferta');
Route::get('/execucao/obras/filtro', 'oferta\ContratoController@filtroExecucaoObras')->middleware('can:eOferta');
Route::post('/execucao/obras', 'oferta\ContratoController@execucaoObras')->middleware('can:eOferta');

Route::get('/filtro_relatorio_devolucao', 'oferta\RemessasDevolucaoController@index');
Route::post('/remessa_devolucao', 'oferta\RemessasDevolucaoController@remessaDevolucao');
Route::get('/remessa_devolucao/download/{remessaDevolucaoId}', 'oferta\RemessasDevolucaoController@remessaDevolucaoExport'); // Rota do Excel Resumo Empreendimentos



//CODEM
Route::get('/codem/nova', 'codem\DemandaController@cadatrarDemanda')->middleware('can:eAdmin');
Route::post('/demanda/nova', 'codem\DemandaController@salvarDemanda')->middleware('can:eAdmin');
Route::get('/demanda/minhas', 'codem\DemandaController@minhasDemandas')->middleware('can:eAdmin');
Route::get('/demanda/atrasadas/lista/{usuarioID}', 'codem\DemandaController@retornarDemandasAtrasadas')->middleware('can:eAdmin');
Route::get('/demanda/usuario/lista', 'codem\DemandaController@retornarDemandasUsuario')->middleware('can:eAdmin');
Route::get('/demanda/responder/usuario/lista', 'codem\DemandaController@retornarDemandasRespUsuario')->middleware('can:eAdmin');


Route::get('/demanda/{demanda}', 'codem\DemandaController@abrirDemanda')->middleware('can:eAdmin');
Route::post('/demanda/update', 'codem\DemandaController@updateDemanda')->middleware('can:eAdmin');



Route::resource('responsavel', 'codem\ResponsavelController');

Route::post('/observacao/nova/demanda/{demanda}', 'codem\DemandaController@salvarObservacao')->middleware('can:eAdmin');
Route::get('/observacao/delete/{observacaoId}', 'codem\DemandaController@deleteObservacao')->middleware('can:eAdmin');

Route::post('/processo/novo/demanda/{demanda}', 'codem\DemandaController@salvarProcesso')->middleware('can:eAdmin');
Route::get('/processo/delete/{processoId}', 'codem\DemandaController@deleteProcesso')->middleware('can:eAdmin');

Route::post('/documento/novo/demanda/{demanda}', 'codem\DemandaController@salvarDocumento')->middleware('can:eAdmin');
Route::get('/documento/delete/{documentoId}', 'codem\DemandaController@deleteDocumento')->middleware('can:eAdmin');

Route::post('/arquivo/novo/demanda/{demanda}', 'codem\DemandaController@salvarArquivo')->middleware('can:eAdmin');
Route::get('/arquivo/delete/{arquivoId}', 'codem\DemandaController@deleteArquivo')->middleware('can:eAdmin');


//empreendimentos
Route::get('/empreendimentos/filtro', 'EmpreendimentoController@filtro_empreendimentos');
Route::post('/empreendimentos/consulta', 'EmpreendimentoController@consulta_empreendimentos');
Route::get('/empreendimentos/{operacaoId}', 'EmpreendimentoController@dados_empreendimento');
Route::get('/empreendimento/download/{operacaoId}', 'EmpreendimentoController@downloadEmpreendimentoAPF'); //Rota do Excel e Resumo Seleção (Selecao)

Route::get('/empreendimentos/contratados/download/{estado}/{municipio}', 'EmpreendimentoController@donwloadEmpreendimentosContratados'); // Rota do Excel Resumo Empreendimentos


//empreendimentos
Route::get('/vinculadas/filtro', 'VinculadasController@filtro_pac');
Route::post('/vinculadas/consulta', 'VinculadasController@consulta_vinculadas');
Route::get('/vinculadas/projeto/{projetoId}', 'VinculadasController@dados_projeto');


//painel
Route::get('/resumo/contratacao/filtro', 'QuadrosResumosController@filtro_contratacao');
Route::post('/painel/contratacao', 'QuadrosResumosController@consulta_contratacao');

Route::get('/resumo/contratos_vigentes/filtro', 'QuadrosResumosController@filtro_contratos_vigentes');
Route::post('/painel/vigentes', 'QuadrosResumosController@consulta_vigentes');

Route::get('/resumo/contratacao/ano/filtro', 'QuadrosResumosController@filtro_contratacao_ano');
Route::post('/painel/contratacao/ano', 'QuadrosResumosController@consulta_contratacao_ano');

Route::get('/resumo/entrega/ano/filtro', 'QuadrosResumosController@filtro_entrega_ano');
Route::post('/painel/entrega/ano', 'QuadrosResumosController@consulta_entrega_ano');

Route::get('/resumo/paralisadas/filtro', 'QuadrosResumosController@filtro_paralisadas');
Route::post('/painel/paralisadas', 'QuadrosResumosController@consulta_paralisadas');

Route::get('/briefing/novo/filtro', 'BriefingController@consultaBriefingNovo');
Route::post('/briefing/novo/dados', 'BriefingController@briefingNovo');
Route::get('/briefing/novo/pergunta1', 'BriefingController@briefingNovoPergunta1');
Route::get('/briefing/novo/pergunta2', 'BriefingController@briefingNovoPergunta2');
Route::get('/briefing/novo/pergunta3', 'BriefingController@briefingNovoPergunta3');
Route::get('/briefing/novo/pergunta4', 'BriefingController@briefingNovoPergunta4');
Route::get('/briefing/novo/pergunta5', 'BriefingController@briefingNovoPergunta5');
Route::get('/briefing/novo/pergunta6', 'BriefingController@briefingNovoPergunta6');
Route::get('/briefing/novo/pergunta9', 'BriefingController@briefingNovoPergunta9');
Route::get('/briefing/novo/pergunta10', 'BriefingController@briefingNovoPergunta10');
Route::get('/briefing/novo/tabela', 'BriefingController@briefingNovoTabela');


Route::get('/briefing/antigo/filtro', 'BriefingController@consultaBriefingAntigo');
Route::get('/briefing/tabelao/filtro', 'BriefingController@consultaBriefingTabelao');


//acesso ente
Route::get('/entePublico', 'ente_publico\EntePublicoController@index');
Route::post('/entePublico/primeiro_acesso', 'ente_publico\EntePublicoController@atualizarSenhaEntePublico');
Route::post('/entePublico/termo_aceite', 'ente_publico\EntePublicoController@aceiteTermo');
Route::get('/entePublico/usuario/novo', 'UsuariosController@cadastroUsuarioEnte');
Route::post('/usuario/ente_publico/salvar', 'UsuariosController@salvarUsuarioEnte');
Route::get('/usuario/novo', 'UsuariosController@cadastroUsuario');



Route::get('/documentos', 'ente_publico\AceiteLegislacaoController@index');

Route::get('/selecao/demanda', 'ente_publico\EntePublicoController@selecaoHome');
Route::get('/entePublico/termo', 'ente_publico\EntePublicoController@abrirTermo');





//usuarios
Route::get('/usuario/novo', 'UsuariosController@cadastroUsuario');

Route::post('/usuario/salvar', 'UsuariosController@salvarUsuario');
Route::post('/usuario/excluir/{usuario}', 'UsuariosController@excluirUsuario');
Route::get('/usuario/{usuario}', 'UsuariosController@dadosUsuario');


Route::get('/entePublico/usuarios', 'UsuariosController@usuariosEntePublico');

Route::get('/entePublico/dirigente', 'ente_publico\DirigenteController@dirigenteEntePublico');




//dirigente
Route::post('/dirigente/cadastrar', 'ente_publico\DirigenteController@cadastrarDirigente');
Route::post('/dirigente/atualizar/{dirigente}', 'ente_publico\DirigenteController@atualizarDirigente');

Route::get('dirigente/cadastro','ente_publico\DirigenteController@cadastroDirigente');


//legislacao
Route::post('/aceite/{legislacao}', 'ente_publico\AceiteLegislacaoController@visualizarLegislacao');

//demandas
Route::get('/demandas', 'ente_publico\DemandasController@index');


//arquivos
Route::get('/arquivo/{demandaGeradaId}/{arquivosId}', 'ente_publico\DemandasController@dadosArquivo');

Route::get('/arquivos', 'ente_publico\DemandasController@arquivosEnte');
Route::post('/download/arquivo/{arquivosId}', 'ente_publico\DemandasController@downloadArquivo');

Route::get('/admin/arquivo/{demandaGeradaId}/{arquivosId}', 'PainelDemandasController@dadosArquivo');
Route::get('/admin/arquivos/gerados', 'PainelDemandasController@arquivosGerados');

//admin
Route::get('/admin/usuarios/entes', 'PainelDemandasController@usuariosEntePublico')->middleware('can:eSNHDemanda');
Route::get('/admin/usuarios/prototipos', 'prototipo\PainelPrototipoController@usuariosPrototipo')->middleware('can:eSNHDemanda');
Route::get('/admin/usuario/{usuario}', 'PainelDemandasController@dadosUsuario')->middleware('can:eSNHDemanda');
Route::post('/admin/entePublicos', 'PainelDemandasController@lista_entePublicos')->middleware('can:eSNHDemanda');
Route::get('/admin/entes/{entePublico}', 'PainelDemandasController@dadosEntePublico')->middleware('can:eSNHDemanda');
Route::get('/admin/entePublico/filtro', 'PainelDemandasController@filtroEntePublico')->middleware('can:eSNHDemanda');

Route::get('/admin/permissoes/prototipos', 'prototipo\PermissoesController@listaPermissoes')->middleware('can:eSNHDemanda');

Route::get('/admin/permissao/deferir/{permissao}', 'prototipo\PermissoesController@deferirPermissao');
Route::get('/admin/permissao/bloquear/{permissao}', 'prototipo\PermissoesController@bloquearPermissao');
Route::get('/admin/permissao/desbloquear/{permissao}', 'prototipo\PermissoesController@desbloquearPermissao');
Route::get('/admin/permissao/indeferir/abrir/{permissao}', 'prototipo\PermissoesController@abrirIndeferirPermissao');
Route::post('/admin/permissao/indeferir/salvar', 'prototipo\PermissoesController@indeferirPermissao');

Route::get('/prototipo', 'prototipo\PrototipoController@index');
Route::get('/prototipo/registro', 'WelcomeController@solicitarRegistro');
Route::post('/prototipo/registro/salvar', 'WelcomeController@salvarRegistro');

Route::get('/prototipo/termo', 'prototipo\PrototipoController@abrirTermo');
Route::post('/prototipo/termo_aceite', 'prototipo\PrototipoController@aceiteTermo');


//Route::get('/prototipos/usuario/{usuario}', 'prototipo\PrototipoController@responderPerguntas');

Route::get('/prototipo/perguntas/{prototipo}', 'prototipo\PrototipoController@responderPerguntas');
Route::get('/prototipos/usuario/{usuario}', 'prototipo\PrototipoController@listaPrototipos');

Route::get('/prototipo/iniciar/caracterizacaoTerreno/{prototipo}', 'prototipo\PrototipoController@caracterizacaoTerreno');
Route::post('/prototipo/iniciar/caracterizacaoTerreno/salvar', 'prototipo\PrototipoController@caracterizacaoTerrenoSalvar');
Route::get('/prototipo/iniciar/infraestruturaBasica/{prototipo}', 'prototipo\PrototipoController@infraestruturaBasica');
Route::post('/prototipo/iniciar/infraestruturaBasica/salvar', 'prototipo\PrototipoController@infraestruturaBasicaSalvar');
Route::get('/prototipo/iniciar/insercaoUrbana/{prototipo}', 'prototipo\PrototipoController@insercaoUrbana');
Route::post('/prototipo/iniciar/insercaoUrbana/salvar', 'prototipo\PrototipoController@insercaoUrbanaSalvar');
Route::get('/prototipo/iniciar/concepcaoProjeto/{prototipo}', 'prototipo\PrototipoController@concepcaoProjeto');
Route::post('/prototipo/iniciar/concepcaoProjeto/salvar', 'prototipo\PrototipoController@concepcaoProjetoSalvar');
Route::get('/prototipo/enviar/{prototipo}', 'prototipo\PrototipoController@concluirPreenchimento');

Route::get('/prototipo/levantamento/{prototipo}', 'prototipo\PrototipoController@introducaoLevantamento');
Route::get('/prototipo/iniciar/levantamento/{prototipo}', 'prototipo\PrototipoController@iniciarLevantamento');
Route::get('/prototipo/show/{prototipo}', 'prototipo\PrototipoController@dadosPrototipo');
Route::get('/prototipo/show/levantamento/{prototipo}', 'prototipo\PrototipoController@dadosLevantamento');
Route::get('/prototipo/novo', 'prototipo\PrototipoController@novoPrototipo');
Route::post('/prototipo/salvar', 'prototipo\PrototipoController@salvarPrototipo');
Route::get('/prototipo/permissoes', 'prototipo\PrototipoController@minhasPermissoes');
Route::get('/prototipo/permissao/nova', 'prototipo\PermissoesController@novaPermissao');
Route::post('/prototipo/oficio/novo', 'prototipo\PermissoesController@salvarNovoOficio');

Route::get('/prototipo/caracterizacao_terreno/editar/{tabCaracterizacaoTerreno}', 'prototipo\PrototipoController@editarCaracTerreno');
Route::post('/prototipo/editar/caracterizacaoTerreno/salvar', 'prototipo\PrototipoController@caracterizacaoTerrenoUpdate');

Route::get('/prototipo/infraestruturaBasica/editar/{tabInfraestrututaBasica}', 'prototipo\PrototipoController@editarInfraBasica');
Route::post('/prototipo/editar/infraestruturaBasica/salvar', 'prototipo\PrototipoController@infraestrututaBasicaUpdate');

Route::get('/prototipo/insercaoUrbana/editar/{tabInsercaoUrbana}', 'prototipo\PrototipoController@editarInsercaoUrbana');
Route::post('/prototipo/editar/insercaoUrbana/salvar', 'prototipo\PrototipoController@insercaoUrbanaUpdate');

Route::get('/prototipo/concepcaoProjeto/editar/{tabconcepcaoProjeto}', 'prototipo\PrototipoController@editarConcepcaoProjeto');
Route::post('/prototipo/editar/concepcaoProjeto/salvar', 'prototipo\PrototipoController@concepcaoProjetoUpdate');









