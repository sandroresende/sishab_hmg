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
})->name('welcome');

Auth::routes();

Route::get('/', 'WelcomeController@index');

Route::get('/home', 'HomeController@index')->name('home');


//MENUS E SUBMENUS

Route::get('/dados_programa', 'HomeController@dadosPrograma');

//MENUS E SUBMENUS


//DADOS ABERTOS

Route::get('/dados_abertos/sistema_habitacao', 'Operacoes\OperacoesController@dadosAbertos');

//DADOS ABERTOS

//SELEÇÃO PROPOSTAS - Schema: propostas_mcmv
Route::get('/proposta/selecao', 'Propostas_mcmv\SelecaoController@index');
Route::get('/selecao/{selecaoId}', 'Propostas_mcmv\SelecaoController@dadosSelecao');

Route::get('/proposta/{propostaID}', 'Propostas_mcmv\PropostasController@proposta');
Route::post('/propostas', 'Propostas_mcmv\PropostasController@propostasApresentadas');
Route::get('/proposta/{propostaID}/{numAPF}', 'Propostas_mcmv\PropostasController@proposta');
Route::get('/propostas_apresentadas/{numAPF}', 'Propostas_mcmv\PropostasController@propostaApresentadasAPF');

Route::post('/proposta/apf', 'Propostas_mcmv\PropostasController@propostaAPF');
Route::get('/proposta/contratadas/resumo/filtro', 'Propostas_mcmv\PropostasController@buscaResumoContratadas');
Route::post('/proposta/contratadas', 'Propostas_mcmv\PropostasController@propostasContratadas');
Route::get('/proposta/{propostaID}/{numAPF}', 'Propostas_mcmv\PropostasController@proposta');

Route::get('/proposta/selecao/resumo/filtro', 'Propostas_mcmv\PropostasController@buscaResumoSelecao');
Route::post('/proposta/selecao/resumo', 'Propostas_mcmv\PropostasController@resumoSelecao');


//SELEÇÃO PROPOSTAS - Schema: propostas_mcmv


//NOVO RELATORIO EXECUTIVO
Route::get('/operacoes/filtro', 'Operacoes\OperacoesController@consultaRelExecutivoInt');
Route::post('/operacoes/relatorio', 'Operacoes\OperacoesController@dadosRelatorioExecutivo');


//NOVO RELATORIO EXECUTIVO

//SITUACAO PAGAMENTOS

Route::get('/medicoes/situacao/filtro', 'Medicoes\MedicoesController@consultaSituacaoPagMedicoes');
Route::post('/medicoes/situacao/pagamentos', 'Medicoes\MedicoesController@dadosSituacaoPagMedicoes');



//SITUACAO PAGAMENTOS

//EMPREENDIMENTOS
Route::get('/empreendimentos/filtro', 'Operacoes\EmpreendimentosController@consultaEmpreendimentos');
Route::post('/empreendimentos/consulta', 'Operacoes\EmpreendimentosController@consulta_empreendimentos');
Route::get('/empreendimento/{numApf}', 'Operacoes\EmpreendimentosController@dados_empreendimento');

//EMPREENDIMENTOS


//OFERTA PÚBLICA

Route::get('/oferta_publica/protocolos/filtro', 'OfertaPublica\ProtocolosController@filtro_protocolos');
Route::get('/oferta_publica/protocolos/instituicao/filtro', 'OfertaPublica\ProtocolosController@filtro_protocolos_if');
Route::post('/oferta_publica/protocolos', 'OfertaPublica\ProtocolosController@protocolos');
Route::post('/oferta_publica/protocolos/instituicao', 'OfertaPublica\ProtocolosController@protocolos_instituicao');
Route::get('/oferta_publica/protocolos/instituicao/{instituicao}', 'OfertaPublica\ProtocolosController@dados_protocolos_instituicao');
Route::get('/oferta_publica/protocolo/{instituicao}/{protocolo}', 'OfertaPublica\ProtocolosController@contratos_protocolo');
Route::post('/oferta_publica/protocolo', 'OfertaPublica\ProtocolosController@protocolo');
Route::get('/oferta_publica/contrato/{contrato}', 'OfertaPublica\ContratoController@dados_contrato');
Route::get('/oferta_publica/contratos/instituicao/filtro', 'OfertaPublica\ContratoController@filtro_contratos_if');
Route::post('/oferta_publica/contratos/instituicao', 'OfertaPublica\ContratoController@contratos_instituicao');

Route::post('/oferta_publica/contrato', 'OfertaPublica\ContratoController@contrato');
Route::get('/oferta_publica/contrato/{oferta}/{nis}', 'OfertaPublica\ContratoController@contrato_oferta');
Route::get('/oferta_publica/filtro_execucao_obras', 'OfertaPublica\ContratoController@filtroExecucaoObras');
Route::post('/oferta_publica/execucao_obras', 'OfertaPublica\ContratoController@execucaoObras');

Route::get('/oferta_publica/filtro_relatorio_devolucao', 'OfertaPublica\RemessasDevolucaoController@index');
Route::post('/oferta_publica/remessa_devolucao', 'OfertaPublica\RemessasDevolucaoController@remessaDevolucao');
Route::get('/oferta_publica/remessa_devolucao/{remessaDevolucao}', 'OfertaPublica\RemessasDevolucaoController@dadosRemessaDevolucao');

Route::get('/oferta_publica/remessa_devolucao/download/{remessaDevolucaoId}', 'OfertaPublica\RemessasDevolucaoController@remessaDevolucaoExport'); // Rota do Excel Resumo Empreendimentos


//OFERTA PÚBLICA

/////SELEÇÃO DE DEMANDA///////
Route::get('/selecao_beneficiarios', 'Selecao_beneficiarios\EntePublicoController@index');
Route::get('/selecao_beneficiarios/dirigente', 'Selecao_beneficiarios\DirigenteController@dirigenteEntePublico');
Route::get('/selecao_beneficiarios/dirigente/cadastro','Selecao_beneficiarios\DirigenteController@cadastroDirigente');
Route::post('/selecao_beneficiarios/dirigente/cadastrar', 'Selecao_beneficiarios\DirigenteController@cadastrarDirigente');
Route::post('/selecao_beneficiarios/termo_aceite', 'Selecao_beneficiarios\EntePublicoController@aceiteTermo');
Route::get('/selecao_beneficiarios/termo', 'Selecao_beneficiarios\EntePublicoController@abrirTermo');
Route::post('/selecao_beneficiarios/termo_aceite', 'Selecao_beneficiarios\EntePublicoController@aceiteTermo');
Route::post('/selecao_beneficiarios/primeiro_acesso', 'Selecao_beneficiarios\EntePublicoController@atualizarSenhaEntePublico');
Route::get('/selecao_beneficiarios/documentos', 'Selecao_beneficiarios\AceiteLegislacaoController@index');
Route::get('/selecao_beneficiarios/usuarios', 'UsuariosController@usuariosEntePublico');
Route::post('/selecao_beneficiarios/dirigente/atualizar/{dirigente}', 'Selecao_beneficiarios\DirigenteController@atualizarDirigente');
Route::get('/selecao_beneficiarios/selecao/demanda', 'Selecao_beneficiarios\EntePublicoController@selecaoHome');

//arquivos
Route::get('/selecao_beneficiarios/arquivo/{demandaGeradaId}/{arquivosId}', 'Selecao_beneficiarios\DemandasController@dadosArquivo');

Route::get('/selecao_beneficiarios/arquivos', 'Selecao_beneficiarios\DemandasController@arquivosEnte');
Route::post('/selecao_beneficiarios/download/arquivo/{arquivosId}', 'Selecao_beneficiarios\DemandasController@downloadArquivo');

//demandas
Route::get('selecao_beneficiarios/demandas', 'Selecao_beneficiarios\DemandasController@index');

/////SELEÇÃO DE DEMANDA///////


/////ADMIN SELECAO DEMANDA///////
Route::get('/admin/selecao_demanda/arquivos/gerados/filtro', 'Selecao_beneficiarios\Admin\PainelDemandasController@filtroArquivosGerados');
Route::post('/admin/selecao_demanda/arquivos/gerados', 'Selecao_beneficiarios\Admin\PainelDemandasController@arquivosGerados');
Route::get('/admin/selecao_demanda/arquivo/{demandaGeradaId}/{arquivosId}', 'Selecao_beneficiarios\Admin\PainelDemandasController@dadosArquivo');
Route::get('/admin/selecao_demanda/filtro', 'Selecao_beneficiarios\Admin\PainelDemandasController@filtroEntePublico');
Route::post('/admin/selecao_demanda/entePublicos', 'Selecao_beneficiarios\Admin\PainelDemandasController@lista_entePublicos');
Route::get('/admin/selecao_demanda/ente_publico/{entePublico}', 'Selecao_beneficiarios\Admin\PainelDemandasController@dadosEntePublico');
Route::get('/admin/selecao_demanda/usuarios/entes/filtro', 'Selecao_beneficiarios\Admin\PainelDemandasController@filtroUsuariosEntePublico');
Route::post('/admin/selecao_demanda/usuarios/entes', 'Selecao_beneficiarios\Admin\PainelDemandasController@usuariosEntePublico');
Route::get('/admin/selecao_demanda/usuario/{usuario}', 'Selecao_beneficiarios\Admin\PainelDemandasController@dadosUsuario');

/////ADMIN SELECAO DEMANDA///////

/////ADMIN PROTOTIPO///////
Route::get('/admin/prototipo/permissoes', 'Prototipo\Admin\PainelPrototipoController@listaPermissoes');
Route::get('/admin/prototipo/permissoes/consulta', 'Prototipo\Admin\PainelPrototipoController@consultaPermissoes');
Route::post('/admin/prototipo/permissoes/situacao', 'Prototipo\Admin\PainelPrototipoController@situacaoPermissoes');
Route::get('/admin/prototipo/consulta', 'Prototipo\Admin\PainelPrototipoController@consultaPrototipos');
Route::post('/admin/prototipos', 'Prototipo\Admin\PainelPrototipoController@listaPrototipos');
Route::get('/admin/prototipo/show/levantamento/{prototipo}', 'Prototipo\Admin\PainelPrototipoController@dadosLevantamento');
Route::get('/admin/prototipo/enviada/{prototipoID}', 'Prototipo\Admin\PainelPrototipoController@habilitarProposta');
Route::post('/admin/prototipo/habilitar/', 'Prototipo\Admin\PainelPrototipoController@finalizarAnalise');
Route::get('/admin/prototipo/usuarios', 'Prototipo\Admin\PainelPrototipoController@usuariosPrototipo');
Route::get('/admin/prototipo/usuario/{usuario}', 'Prototipo\Admin\PainelPrototipoController@dadosUsuario');



/////ADMIN PROTOTIPO///////


///// PROTOTIPO///////
Route::get('/prototipo/mensagem', 'WelcomeController@verMensagem');
Route::get('/prototipo/registro', 'WelcomeController@solicitarRegistro');
Route::post('/prototipo/registro/salvar', 'WelcomeController@salvarRegistro');
Route::get('/prototipo/resultado', 'WelcomeController@resultadoAtas');

Route::get('/prototipo', 'Prototipo\PrototipoController@index');
Route::get('/prototipo/termo', 'Prototipo\PrototipoController@abrirTermo');
Route::post('/prototipo/termo_aceite', 'Prototipo\PrototipoController@aceiteTermo');
Route::get('/propostas', 'Prototipo\PrototipoController@listaPrototipos');
Route::get('/prototipo/excluir/{prototipo}', 'Prototipo\PrototipoController@excluirPrototipo');
Route::get('/prototipo/perguntas/{prototipo}', 'Prototipo\PrototipoController@responderPerguntas');
Route::get('/prototipo/levantamento/{prototipo}', 'Prototipo\PrototipoController@introducaoLevantamento');
Route::get('/prototipo/novo', 'Prototipo\PrototipoController@novoPrototipo');
Route::post('/prototipo/salvar', 'prototipo\PrototipoController@salvarPrototipo');
Route::get('/prototipo/iniciar/levantamento/{prototipo}', 'Prototipo\PrototipoController@iniciarLevantamento');
Route::get('/prototipo/show/levantamento/{prototipo}', 'Prototipo\PrototipoController@dadosLevantamento');
Route::get('/prototipo/enviar/{prototipo}', 'Prototipo\PrototipoController@concluirPreenchimento');


Route::get('/prototipo/iniciar/caracterizacaoTerreno/{prototipo}', 'Prototipo\CaracterizacaoTerrenoController@caracterizacaoTerrenoParte1');
Route::get('/prototipo/iniciar/caracterizacaoTerreno/parte2/{prototipo}', 'Prototipo\CaracterizacaoTerrenoController@caracterizacaoTerrenoParte2');
Route::get('/prototipo/iniciar/caracterizacaoTerreno/parte3/{prototipo}', 'Prototipo\CaracterizacaoTerrenoController@caracterizacaoTerrenoParte3');
Route::post('/prototipo/iniciar/caracterizacaoTerreno/parte1/salvar', 'Prototipo\CaracterizacaoTerrenoController@caracterizacaoTerrenoSalvarParte1');
Route::post('/prototipo/iniciar/caracterizacaoTerreno/parte2/salvar', 'Prototipo\CaracterizacaoTerrenoController@caracterizacaoTerrenoSalvarParte2');
Route::post('/prototipo/iniciar/caracterizacaoTerreno/parte3/salvar', 'Prototipo\CaracterizacaoTerrenoController@caracterizacaoTerrenoSalvarParte3');


Route::post('/prototipo/editar/caracterizacaoTerreno/parte1', 'Prototipo\CaracterizacaoTerrenoController@caracterizacaoTerrenoEditarParte1');
Route::post('/prototipo/editar/caracterizacaoTerreno/parte2', 'Prototipo\CaracterizacaoTerrenoController@caracterizacaoTerrenoEditarParte2');
Route::post('/prototipo/editar/caracterizacaoTerreno/parte3', 'Prototipo\CaracterizacaoTerrenoController@caracterizacaoTerrenoEditarParte3');

Route::post('/prototipo/caracterizacaoTerreno/planta/adicionar', 'Prototipo\CaracterizacaoTerrenoController@adicionarPlanta');
Route::get('/prototipo/caracterizacao_terreno/editar/{tabCaracterizacaoTerreno}', 'Prototipo\CaracterizacaoTerrenoController@editarCaracTerreno');

Route::get('/prototipo/iniciar/infraestruturaBasica/{prototipo}', 'Prototipo\InfraestruturaBasicaController@infraestruturaBasica');
Route::post('/prototipo/iniciar/infraestruturaBasica/salvar', 'Prototipo\InfraestruturaBasicaController@infraestruturaBasicaSalvar');
Route::get('/prototipo/infraestruturaBasica/editar/{tabInfraestrututaBasica}', 'prototipo\InfraestruturaBasicaController@editarInfraBasica');
Route::post('/prototipo/editar/infraestruturaBasica/salvar', 'prototipo\InfraestruturaBasicaController@infraestrututaBasicaUpdate');

Route::get('/prototipo/iniciar/insercaoUrbana/{prototipo}', 'Prototipo\InsercaoUrbanaController@insercaoUrbanaParte1');
Route::get('/prototipo/iniciar/insercaoUrbana/{prototipo}', 'Prototipo\InsercaoUrbanaController@insercaoUrbanaParte1');
Route::get('/prototipo/iniciar/insercaoUrbana/parte2/{prototipo}', 'Prototipo\InsercaoUrbanaController@insercaoUrbanaParte2');
Route::post('/prototipo/iniciar/insercaoUrbana/parte1/salvar', 'Prototipo\InsercaoUrbanaController@insercaoUrbanaSalvarParte1');
Route::post('/prototipo/iniciar/insercaoUrbana/parte2/salvar', 'Prototipo\InsercaoUrbanaController@insercaoUrbanaSalvarParte2');
Route::post('/prototipo/insercaoUrbana/mapa/adicionar', 'Prototipo\InsercaoUrbanaController@adicionarMapa');
Route::post('/prototipo/insercaoUrbana/rota/adicionar', 'Prototipo\InsercaoUrbanaController@adicionarRota');

Route::get('/prototipo/insercaoUrbana/editar/{tabInsercaoUrbana}', 'Prototipo\InsercaoUrbanaController@editarInsercaoUrbana');
Route::post('/prototipo/editar/insercaoUrbana/salvar', 'Prototipo\InsercaoUrbanaController@insercaoUrbanaUpdate');

Route::post('/prototipo/editar/insercaoUrbana/parte1', 'Prototipo\InsercaoUrbanaController@insercaoUrbanaEditarParte1');
Route::post('/prototipo/editar/insercaoUrbana/parte2', 'Prototipo\InsercaoUrbanaController@insercaoUrbanaEditarParte2');

Route::get('/prototipo/insercaoUrbana/arquivoMapa/excluir/{arquivoMapaId}', 'Prototipo\InsercaoUrbanaController@excluirMapa');
Route::get('/prototipo/insercaoUrbana/arquivoRota/excluir/{arquivoMapaId}', 'Prototipo\InsercaoUrbanaController@excluirRota');
Route::get('/prototipo/caracTerreno/arquivo/excluir/{arquivoPlantaId}', 'Prototipo\CaracterizacaoTerrenoController@excluirPlanta');

///// PROTOTIPO///////


//////////////usuarios//////////////
Route::get('/usuario/novo', 'UsuariosController@cadastroUsuario');

Route::post('/usuario/salvar', 'UsuariosController@salvarUsuario');
Route::post('/usuario/excluir/{usuario}', 'UsuariosController@excluirUsuario');
Route::get('/usuario/{usuario}', 'UsuariosController@dadosUsuario');
Route::post('/usuario/atualizar/{usuario}', 'UsuariosController@updateUsuario');



//////////////usuarios//////////////

///// ADMIN PCVA PARCERIAS///////

Route::get('/admin/pcva_parcerias/termo/filtro', 'pcva_parcerias\DadosParceriasController@consultaTermoAdesao');
Route::post('admin/pcva_parcerias/termo/pesquisar', 'pcva_parcerias\DadosParceriasController@listaTermosAdesao');
Route::post('admin/pcva_parcerias/termo/validar', 'pcva_parcerias\DadosParceriasController@validarTermoAdesao');
Route::get('admin/pcva_parcerias/termo/protocolo/{numProtocolo}', 'pcva_parcerias\DadosParceriasController@visualizarTermoAdesao');
Route::get('admin/pcva_parcerias/termo/cancelar/{dadosParceria}', 'pcva_parcerias\DadosParceriasController@cancelarAnaliseTermo');
Route::get('/admin/pcva_parcerias/resumoSituacao/filtro', 'pcva_parcerias\DadosParceriasController@filtroSituacaoTermo');
Route::post('admin/pcva_parcerias/resumoSituacao/pesquisar', 'pcva_parcerias\DadosParceriasController@visualizarSituacaoTermo');

///// ADMIN PCVA PARCERIAS///////

///// PCVA PARCERIAS///////
Route::get('/pcva_parcerias/solicitar_adesao', 'WelcomeController@solicitarAdesaoParcerias');
Route::post('/pcva_parcerias/aceitar_adesao', 'WelcomeController@aceitarAdesaoParcerias');
Route::get('/pcva_parcerias/protocolo/termo/{txtProtocoloAceite}', 'WelcomeController@visualizarTermoParceira');
Route::post('/pcva_parcerias/termo/protocolo/', 'WelcomeController@filtroTermoParceira');
Route::get('/pcva_parcerias/termo/consultar', 'WelcomeController@consultarTermoParceira');
Route::get('/pcva_parcerias/validacao/filtro', 'WelcomeController@filtroValidacaoTermoParceira');
Route::post('/pcva_parcerias/termo/validar', 'WelcomeController@validarTermoParceira');
///// PCVA PARCERIAS///////
