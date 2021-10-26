<template>
  <div class="small-box  text-white" v-bind:style="defineCor">
 
    <div class="inner">
     <span class="text-center small-box-footer">
      {{rodape}} 
    </span>
      <h3 class="text-white">{{qtd}}</h3>

      <p  class="text-white">{{titulo}}</p>
      <p class="text-white">{{subtitulo}}</p>
    </div>
    <div class="icon">
      <i v-bind:class="icone"></i>
    </div>
    
  </div>
</template>

<script>
    export default {
      props:['qtd','titulo','url','cor','icone','subtitulo','rodape'],
      computed:{
        defineCor:function(){
          return "background-color: "+this.cor+" !important;"
        }
      }

    }
</script>
