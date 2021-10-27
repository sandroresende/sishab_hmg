<template>
          <div v-bind:class="colunasdiv">
            <div class="card card-stats">
              <div v-bind:class="corfundocaixa">
                <div class="card-icon">
                  <i v-bind:class="icone"></i>
                  
                </div>
                <p class="card-category">{{titulo}}</p>
                <h3 class="h3-card-title-template font_valor_cx_simples">{{valor}}
                  
                </h3>
                <small>{{unidademedida}}</small>
              </div>
              <div class="card-footer">
                <div v-if="url" class="stats">
                    <i v-bind:class="iconerodape"></i>
                  <a v-bind:href="url">{{titulorodape}}</a>
                </div>
              </div>
            </div>
          </div>

</template>

<script>
    export default {
      props:['valor','titulo','url','unidademedida','corfundocaixa','icone','subtitulo','titulorodape','iconerodape','colunasdiv'],
      computed:{
        defineCor:function(){
          return "background-color: "+this.cor+" !important;"
        }
      }

    }
</script>
