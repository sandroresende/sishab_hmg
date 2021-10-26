<template>
   <div>                    
       <label for="periodos_ate">{{textolabel}}</label>
        <select 
            v-bind:id="nomecampo"
            class="form-control" 
            v-bind:name="nomecampo"
            required
            v-model="itemEscolhido">
            <option value="0" selected>{{textoescolha}}</option>
            <option v-for="dado in dados" v-text="dado.nome" :value="dado.id" :key="dado.id"></option>
        </select>
    </div>    
</template>

<script>
    export default {
        props:['url','dados','textolabel','nomecampo','selecionado','textoescolha'],
        data(){
            return{                
                buscando: false,
                itemEscolhido: 0,                         
            }        
        },
        mounted() { 
            if(this.selecionado){
                this.itemEscolhido = this.selecionado;
            }
             
                
        }
    }
</script>
