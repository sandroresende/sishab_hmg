<template>
    <div v-bind:class="colunasdiv">                        
        <div class="card card-stats text-center">
            <H2 class="card-header">{{titulo}}</h2>
            <div class="card-header card-header-warning card-header-icon text-center">                            

            <h3 class="h3-card-title-template"><strong>{{valorinicial}}</strong>/{{valorfinal}}</h3>            
            </div>
            <div class="progress">
                <div v-bind:class="corbarra" 
                     role="progressbar" 
                     v-bind:aria-valuenow="vlrpercentual" 
                     aria-valuemin="0" 
                     aria-valuemax="100" 
                     v-bind:style="{definePercBarra}">{{vlrpercentual}}%</div>
            </div>                        
        </div>
    </div>
</template>

<script>
    export default {
      props:['colunasdiv', 'titulo', 'valorinicial','valorfinal','url','corbarra','vlrpercentual'],
      computed:{
        definePercBarra:function(){
          return "width: "+this.vlrpercentual+"%;"
        }
      }

    }
</script>
