<template>
<div class="form-group">    
    <div class="row">
        <label for="tipo_tema">Tipo Tema</label>           
        <select 
            id="tipo_tema"
            class="form-control" 
            name="tipo_tema"    
            @change="onChangeTipoTema"   
            v-model="tipo_tema">
            <option value="">Escolha um Tipo de Tema:</option>
            <option v-for="tipoTema in tipoTemas" v-text="tipo_tema.tipoTema" :value="tipoTema.id" :key="tipoTema.id"></option>
        </select>     
    </div>                 
    <button type="submit" class="btn btn-primary btn-lg btn-block">{{tituloBtn}}</button>
</div>    
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                 tituloBtn:'Brasil',
                 buscando: false,
                 tipoTema:'',
                 tipoTemas:''
                              
            }        
        },
        computed:{
            
        },
        methods:{
            onChangeTipoTema(){
                this.buscando = true;
                this.tituloBtn = "Pesquisar";
            },
            
        },
        mounted() {
           
            //retorna os temas
            axios.get(this.url + '/api/tipoTema').then(resposta => {
                //console.log(resposta.data);
                this.tipoTemas = resposta.data;

            }).catch(erro => {
                console.log(erro);
            });            
        }
    }
</script>
