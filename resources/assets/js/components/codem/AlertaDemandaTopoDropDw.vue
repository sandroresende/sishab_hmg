<template>
    <div>
        <li class="nav-item dropdown"> 
                <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link" title="Demandas Atrasadas"><i class="fa fa-bell"></i><span class="badge badge-danger">{{this.qtd_atrasadas}}</span></a>
            <ul aria-labelledby="notifications" class="dropdown-menu">
            <li v-for="demanda in demandas_atrasadas.slice(0,4)"><a rel="nofollow" v-bind:href="url + '/demanda/' + demanda.id" class="dropdown-item"> 
                <div class="notification d-flex justify-content-between">
                    <div class="notification-content"><i class="fa fa-bell" style="color:red;"></i><small>{{demanda.id}}</small> - {{demanda.txt_descricao_demanda.substring(0, 40)}}...</div>
                    <div class="notification-time"><span></span><small>{{demanda.qtd_dias_atraso}} dias ({{demanda.dte_previsao_conclusao | formataData}})</small></div>
                    </br>
                    
                </div></a>
            </li>            
            <li><a rel="nofollow" v-bind:href="url + '/demanda/atrasadas/lista/' + this.idusuario" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>Ver todas as demandas atrasadas</strong></a></li>
            </ul>
        </li>
    </div>
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
