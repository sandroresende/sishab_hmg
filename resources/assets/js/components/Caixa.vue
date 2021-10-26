<template>
  <div class="small-box" v-bind:style="defineCor">
    <div class="inner">
      <h3>{{qtd}}</h3>

      <h5>{{titulo}}</h5>
    </div>
    <div class="icon">
      <i v-bind:class="icone"></i>
    </div>
    <a v-bind:href="url" class="small-box-footer">
      Ver mais <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
</template>

<script>
    export default {
      props:['qtd','titulo','url','cor','icone'],
      computed:{
        defineCor:function(){
          return "background-color: "+this.cor+" !important;"
        }
      }

    }
</script>
