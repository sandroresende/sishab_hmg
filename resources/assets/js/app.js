
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.jQueryCookie = require('jquery.cookie');
//window.chartjs = require('chartjs');
//window.chart = require('chart');
window.jQueryValidation = require('jquery-validation');
window.malihuCustomScrollbar = require('malihu-custom-scrollbar-plugin');
window.jQueryMouseWheel = require('jquery-mousewheel');
window.util = require('util');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('tabela-lista', require('./components/TabelaLista.vue'));
Vue.component('tabela-relatorios', require('./components/TabelaRelatorios.vue'));
Vue.component('tabela-relatorios-id', require('./components/TabelaRelatoriosId.vue'));



Vue.component('select-executivo', require('./components/SelectExecutivo.vue'));
Vue.component('select-executivo-int', require('./components/SelectExecutivoInt.vue'));
Vue.component('select-executivo-posicoes', require('./components/SelectExecutivoPosicoes.vue'));
Vue.component('select-empreendimento', require('./components/SelectEmpreendimento.vue'));
Vue.component('select-propostas', require('./components/SelectPropostas.vue'));
Vue.component('select-propostas-contratadas', require('./components/SelectPropostasContratadas.vue'));
Vue.component('select-protocolos', require('./components/SelectProtocolos.vue'));
Vue.component('select-execucao-obras', require('./components/SelectExecucaoObras.vue'));
Vue.component('select-retomada', require('./components/SelectRetomada.vue'));
Vue.component('select-uf-municipio', require('./components/SelectUfMunicipio.vue'));
Vue.component('select-mult-municipio', require('./components/SelectVariosMunicipio.vue'));
Vue.component('select-situacao-contratacao', require('./components/SelectSituacaoContratacao.vue'));
Vue.component('select-entregas', require('./components/SelectEntregas.vue'));
Vue.component('select-orcamento', require('./components/SelectOrcamento.vue'));

Vue.component('colunas-duas-situacao', require('./components/DuasColunasSituaProposta.vue'));

Vue.component('caixa-simples', require('./components/CaixaSimples.vue'));
Vue.component('caixa', require('./components/Caixa.vue'));

Vue.component('table-executivo', require('./components/TableExecutivo.vue'));
Vue.component('table-executivo-cvea', require('./components/TableExecutivoCVEA.vue'));
Vue.component('table-executivo-int', require('./components/TableExecutivoInt.vue'));
Vue.component('table-executivo-novo', require('./components/TableExecutivoNovo.vue'));

Vue.component('autocomplete-protocolo', require('./components/AutoCompleteProtocolo.vue'));
Vue.component('autocomplete-list', require('./components/AutoCompleteList.vue'));
Vue.component('autocomplete-nis', require('./components/AutoCompleteNis.vue'));
Vue.component('autocomplete-apf', require('./components/AutoCompleteAPF.vue'));
Vue.component('autocomplete-cnpj', require('./components/AutoCompleteCNPJ.vue'));
Vue.component('autocomplete-mun-limite', require('./components/AutoCompleteMunLimite.vue'));

//CODEM
Vue.component('cadastro-demanda', require('./components/codem/cadastroDemanda.vue'));
Vue.component('select-tema-subtema', require('./components/codem/SelectTemaSubTema.vue'));
Vue.component('alerta-demanda-topo', require('./components/codem/AlertaDemandaTopo.vue'));
Vue.component('notificacao-demanda-topo', require('./components/codem/NotificacaoDemandaTopo.vue'));

//componentes gerais
Vue.component('select-component', require('./components/gerais/SelectComponent.vue'));
Vue.component('formulario', require('./components/gerais/Formulario.vue'));
Vue.component('botao-excluir', require('./components/gerais/BotaoExcluir.vue'));
Vue.component('modallink', require('./components/modal/ModalLink.vue'));
Vue.component('modal', require('./components/modal/Modal.vue'));

//beneficiarios
Vue.component('consulta-beneficiario', require('./components/ConsultaBeneficiarios.vue'));

//empreendimentos
Vue.component('consulta-empreendimentos', require('./components/ConsultaEmpreendimentos.vue'));



//componentes financeiro
Vue.component('select-solicitacoes-pagamento', require('./components/financeiro/SelectSolicitacoesPagamento.vue'));


//painel
Vue.component('select-painel', require('./components/SelectPainel.vue'));

//pac
Vue.component('consulta-pac', require('./components/ConsultaPac.vue'));

//ente publico
Vue.component('cadastro_usu_ente', require('./components/ente_publico/CadastroUsuarioEnte.vue'));

//prototipo
Vue.component('prototipo', require('./components/prototipo/Prototipo.vue'));
Vue.component('caracterizacao-terreno', require('./components/prototipo/CaracterizacaoTerreno.vue'));
Vue.component('infraestrutura-basica', require('./components/prototipo/InfraestruturaBasica.vue'));
Vue.component('insercao-urbana', require('./components/prototipo/InsercaoUrbana.vue'));
Vue.component('concepcao-projeto', require('./components/prototipo/ConcepcaoProjeto.vue'));
Vue.component('formulario-registro', require('./components/prototipo/FormularioRegistro.vue'));
Vue.component('permissoes', require('./components/prototipo/Permissoes.vue'));
Vue.component('detalhamento-indeferimento', require('./components/prototipo/DetalhamentoIndeferimento.vue'));
Vue.component('registro-usuario', require('./components/prototipo/RegistroUsuario.vue'));

Vue.component('botao-acao-icone', require('./components/gerais/BotaoAcaoIcone.vue'));




const app = new Vue({
    el: '#app',
    mounted: function(){
        //alert('okj');
        document.getElementById('app').style.display = "block";
    }
});



     

           
            
        