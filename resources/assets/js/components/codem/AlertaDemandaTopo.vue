<template>
    
        <li  >
            <a v-bind:href="url + '/demanda/atrasadas/lista/' + this.idusuario"  title="Demandas Atrasadas"><i class="fa fa-bell"></i><span class="badge badge-danger">{{this.qtd_atrasadas}}</span></a>
                   
        </li>
   
</template>

<script>
    export default {
        props:['url','idusuario'],
        data(){
            return{
                qtd_atrasadas:0,
                demandas_atrasadas:''
                              
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
        mounted() {
              //buscar rm e ride
            axios.get(this.url + '/api/codem/demandas/atrasadas/' + this.idusuario).then(resposta => {
                //console.log(resposta.data);
                this.demandas_atrasadas = resposta.data;
                this.qtd_atrasadas = this.demandas_atrasadas.length;
            }).catch(erro => {
                console.log(erro);
            });
        }
    }
</script>
