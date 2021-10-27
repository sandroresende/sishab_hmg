
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

/** GERAIS */
Vue.component('cabecalho-form', require('./components/gerais/CabecalhoForm.vue'));
Vue.component('historico-navegacao', require('./components/gerais/HistoricoNavegacao.vue'));
Vue.component('caixa-simples', require('./components/gerais/CaixaSimples.vue'));
Vue.component('tabela-relatorios', require('./components/gerais/TabelaRelatorios.vue'));
Vue.component('modal-form', require('./components/gerais/modal/Modal.vue'));
Vue.component('modal-link', require('./components/gerais/modal/ModalLink.vue'));
Vue.component('caixa-barra-progresso', require('./components/gerais/CaixaBarraProgresso.vue'));
Vue.component('select-uf-municipio', require('./components/gerais/SelectUfMunicipio.vue'));
Vue.component('select-mult-municipio', require('./components/gerais/SelectVariosMunicipio.vue'));
Vue.component('botao-acao-icone', require('./components/gerais/BotaoAcaoIcone.vue'));
Vue.component('botao-acao', require('./components/gerais/BotaoAcao.vue'));
Vue.component('grafico-linhas', require('./components/gerais/graficos/GraficoLinhas.vue'));



/** PROPOSTAS_MCMV */
Vue.component('select-propostas', require('./components/vue_sishab/propostas_mcmv/SelectPropostas.vue'));
Vue.component('select-propostas-contratadas', require('./components/vue_sishab/propostas_mcmv/SelectPropostasContratadas.vue'));
Vue.component('colunas-duas-situacao', require('./components/vue_sishab/propostas_mcmv/DuasColunasSituaProposta.vue'));


/** OPERACOES */
Vue.component('table-executivo-cvea', require('./components/vue_sishab/operacoes/TableExecutivoCVEA.vue'));
Vue.component('table-executivo', require('./components/vue_sishab/operacoes/TableExecutivo.vue'));
Vue.component('select-painel', require('./components/vue_sishab/operacoes/SelectPainel.vue'));

/**MEDICOES */
Vue.component('select-solicitacoes-pagamento', require('./components/vue_sishab/medicoes/SelectSolicitacoesPagamento.vue'));

/**EMPREENDIMENTOS */
Vue.component('consulta-empreendimentos', require('./components/vue_sishab/empreendimentos/ConsultaEmpreendimentos.vue'));

/**OFERTA PÚBLICA */
Vue.component('select-execucao-obras', require('./components/vue_sishab/oferta_publica/SelectExecucaoObras.vue'));
Vue.component('select-protocolos', require('./components/vue_sishab/oferta_publica/SelectProtocolos.vue'));


/**SELECAO DEMANDAS */
Vue.component('filtro-arquivos-gerados', require('./components/vue_selecao_demandas/FiltroArquivosGerados.vue'));

/**PROTOTIPO HIS */
Vue.component('registro-usuario', require('./components/vue_prototipo/RegistroUsuario.vue'));

Vue.component('caracterizacao-terreno-parte1', require('./components/vue_prototipo/CaracterizacaoTerreno_parte1.vue'));
Vue.component('caracterizacao-terreno-parte2', require('./components/vue_prototipo/CaracterizacaoTerreno_parte2.vue'));
Vue.component('caracterizacao-terreno-parte3', require('./components/vue_prototipo/CaracterizacaoTerreno_parte3.vue'));

Vue.component('infraestrutura-basica', require('./components/vue_prototipo/InfraestruturaBasica.vue'));


Vue.component('insercao-urbana-parte1', require('./components/vue_prototipo/InsercaoUrbana_parte1.vue'));
Vue.component('insercao-urbana-parte2', require('./components/vue_prototipo/InsercaoUrbana_parte2.vue'));

/**PCVA PARCERIAS */
Vue.component('solicitar-adesao', require('./components/vue_pcva_parcerias/SolicitarAdesao.vue'));
Vue.component('enviar-termo', require('./components/vue_pcva_parcerias/EnviarTermo.vue'));
Vue.component('consulta-termos-parceria', require('./components/vue_pcva_parcerias/ConsultaTermosParceria.vue'));
Vue.component('validar-termo', require('./components/vue_pcva_parcerias/ValidarTermo.vue'));


const app = new Vue({
    el: '#app'
});

    new ClipboardJS('.link-clipboard', {
        text: function(trigger) {
            return trigger.getAttribute('href');
        }
    });

