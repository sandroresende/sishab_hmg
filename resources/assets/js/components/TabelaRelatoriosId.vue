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
                    <tr  class="text-center conteudoTabela" v-for="(item,index) in lista">
                        <td v-for="(i, index2) in item" v-if="index2 != 'id' && index2 != 'regiao_id'" >{{i | formataData}}</td>    
                            <td class="acao" v-if="show"><a  v-bind:item="item" v-bind:href="show + '/'+ item.id"><i class="fas fa-search"></i></a></td>  
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

