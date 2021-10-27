<template>

    <div class="form-group-border">      
        <div class="row" v-for="item in itens">
            <div class="col-sm-2 exec">
            
                <div :class="{
                        'status_nao_enquadrada' : !item.bln_enquadrada,
                        'status_contratada' : item.bln_contratada,                                
                        'status_enquadrada' : item.bln_enquadrada && !item.bln_selecionada && !item.bln_contratada && !item.bln_demanda_fechada,
                        'status_selecionada' : item.bln_enquadrada && item.bln_selecionada && !item.bln_contratada,
                    }">
                    
                    
                    <H1 v-if="!item.bln_enquadrada"><i class="fas fa-times"></i></H1>  
                    <H1 v-if="item.bln_contratada && !item.bln_demanda_fechada"><i class="fas fa-hand-holding-usd"></i></H1>  
                    <H1 v-if="item.bln_contratada && item.bln_demanda_fechada"><i class="fas fa-hand-holding-usd"></i></H1> 
                    <H1 v-if="item.bln_enquadrada && !item.bln_selecionada && !item.bln_contratada && !item.bln_demanda_fechada"><i class="fas fa-clipboard-check"></i></H1>                              
                    <H1 v-if="item.bln_enquadrada && item.bln_selecionada && !item.bln_contratada"><i class="fas fas fa-check"></i></H1>                            

                    <p v-if="!item.bln_enquadrada">Não Enquadrada</p>
                    <p v-if="item.bln_contratada && !item.bln_demanda_fechada">Contratada</p>
                    <p v-if="item.bln_contratada && item.bln_demanda_fechada">Contr Demanda</p>
                    <p v-if="item.bln_enquadrada && !item.bln_selecionada && !item.bln_contratada && !item.bln_demanda_fechada">Enquadrada</p>
                    <p v-if="item.bln_enquadrada && item.bln_selecionada && !item.bln_contratada">Selecionada</p>
                </div>
            </div>    
            <div class="col-sm-10">
                <div id="valores">
                    <H1><a :href="urlProposta + item.proposta_id + '/' + item.num_apf"> {{item.txt_nome_empreendimento}}</a> ({{item.num_selecao}}ª Seleção de {{item.num_ano_selecao}} - {{item.txt_modalidade}})</H1>
                    <p>{{item.ds_municipio}} / {{item.txt_sigla_uf}} </p>
                    </br>
                    <h5>
                        <i class="fas fa-home 2x icone_blue"></i> {{item.num_uh}} | 
                        <i class="fas fa-hand-holding-usd 2x"></i> Valor Previsto: {{item.vlr_investimento}}</h5>
                </div>
            </div>    
        </div>
    </div>    
   


</template>

<script>
    export default {
        props:['itens','url'],
        computed: {
            urlProposta() {
                
                return this.url + '/proposta/';
            },
        }
    }
</script>

