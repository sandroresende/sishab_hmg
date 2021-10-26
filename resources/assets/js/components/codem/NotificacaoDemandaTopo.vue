<template>
    <div>
         <!-- Messages dropdown-->
        <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"  title="Demandas Novas"><i class="fa fa-envelope"></i><span class="badge badge-info">{{this.qtd_novas}}</span></a>
            <ul aria-labelledby="notifications" class="dropdown-menu">
            <li v-for="demanda in demandas_novas.slice(0,4)"><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                <div class="msg-profile"> <i class="fa fa-envelope fa-3x"></i> <!-- <img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle">--></div>
                <div class="msg-body">                    
                    <h3 class="h5">{{demanda.txt_nome_interessado}}</h3><small>{{demanda.id}} - {{demanda.txt_descricao_demanda.substring(0, 40)}}...</small><small>{{demanda.dte_previsao_conclusao | formataData}}</small>
                </div></a>
                <div class="dropdown-divider"></div>
            </li>            
            <li>            
                <a rel="nofollow" v-bind:href="url + '/demanda/usuario/lista'" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-envelope"></i>Ver todas as demandas</strong></a>
            </li>
            </ul>
        </li>    
    </div>
</template>

<script>
    export default {
        props:['url','idusuario'],
        data(){
            return{
                qtd_novas:0,
                demandas_novas:''
                              
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
            axios.get(this.url + '/api/codem/demandas/novas/' + this.idusuario).then(resposta => {
                //console.log(resposta.data);
                this.demandas_novas = resposta.data;
                this.qtd_novas = this.demandas_novas.length;
            }).catch(erro => {
                console.log(erro);
            });
        }
    }
</script>
