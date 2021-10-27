<template>
<div>    
    <input v-bind:class="cssbotao" v-bind:type="tipobotao" @click="onClickEnviar()" v-model="textobotao">    
</div>
</template>


<script>
    export default {
        props:['url','registro','classbotao','cssbotao','textobotao','tipobotao'],
        methods:{
            onClickEnviar() {   
                 window.location.href= this.url + '/'+ this.registro;               
            }        
        }
    }
</script>
