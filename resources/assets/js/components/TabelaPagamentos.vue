<template>
    <div class="form-group">
        <div class="form-inline">
            <div class="form-group pull-right">
                <input type="search" class="form-control" placeholder="Buscar" v-model="buscar">
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
                <thead  class="text-center">
                    <tr class="text-center ">
                        <th v-for="titulo in titulos">{{titulo}}</th>  
                        <th class="acao" v-if="show">Ação</th>
                    </tr>
                </thead>
                <tbody>                  
                    
                        <tr class="text-center conteudoTabela"  v-for="item in dados">                        
                            <td >
                                {{item.txt_modalidade}}
                            <!--    <a v-if="codibge > 0" rel="nofollow" v-bind:href="url + '/executivo/detalhar/modalidade/' 
                                                                                             + item.modalidade_id 
                                                                                             + '/' + item.faixa_renda_id
                                                                                             + '/' + codibge"><i class="fas fa-search"></i></a>
                            -->                                                                 
                            </td>
                            <td v-if="item.faixa_renda_id == 4" class="tabelaFaixa">{{item.dsc_faixa}}</td>
                            <td v-if="item.faixa_renda_id == 4" class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{formatarValor(item.num_vlr_total,2)}}</td>
                            <td v-if="item.faixa_renda_id == 4" class="tabelaNumero text-center">{{formatarValor(item.num_uh,0)}}</td>
                            <td v-if="item.faixa_renda_id == 4" class="tabelaNumero text-center">{{formatarValor(item.num_concluidas,0)}}</td>
                            <td v-if="item.faixa_renda_id == 4" class="tabelaNumero text-center">{{formatarValor(item.num_entregues,0)}}</td>                           
                        </tr>
                </tbody>
            </table> 
        </div>        
    </div>
</template>

<script>
    export default {
       props:['titulos','itens','show'],
       data: function(){
           return {
               buscar:'' 
           }
       },
       filters: {
        formataData: function(valor){
          if(!valor) return '';
          valor = valor.toString();
          if(valor.split('-').length == 3){
            valor = valor.split('-');
            return valor[2] + '/' + valor[1]+ '/' + valor[0];
          }

          return valor;
        }
      },
      computed:{
        lista:function(){
            //let lista = this.itens.data;
            if(this.buscar){
                return this.itens.filter(res => {
                     res = Object.values(res);
                    for(let k = 0;k < res.length; k++){
                        if((res[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0){
                            return true;
                        }
                    }
                    return false;
                });
            }

          return this.itens;
        }
      },
      mounted(){
          
      }
    }
</script>

