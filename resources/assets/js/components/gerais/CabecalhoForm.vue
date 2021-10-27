<template>
    <div>
        <div id="viewlet-above-content-title"></div>
        <h1 v-if='titulo' class="documentFirstHeading text-center">{{titulo}}</h1>  </br>
        <h1 class="documentFirstHeading text-center">
        <span v-if="subtitulo1" class="subtitulo-niv1-span documentFirstHeadingSpan">{{subtitulo1}}</span>
        <span v-if="subtitulo2" class="subtitulo-niv2-span documentFirstHeadingSpan">{{subtitulo2}}</span>
        <span v-if="subtitulo3" class="subtitulo-niv3-span documentFirstHeadingSpan">{{subtitulo3}}</span>
        <span v-if="subtitulo3" class="subtitulo-niv4-span documentFirstHeadingSpan">{{subtitulo4}}</span>
         </h1>
     
        <div id="viewlet-below-content-title text-center">  
        <slot>

        </slot>                 
        </div>
        <div id="viewlet-above-content-body" v-if="barracompartilhar">            
            <div v-if="linkcompartilhar" class="social-links">
                <label>Compartilhe: </label>
                <a class="link-clipboard" onclick="event.preventDefault()" title="Copiar para área de transferência" v-bind:href="linkcompartilhar">
                <span class="fas fa-link"></span>
                </a>
                <a v-if="linkcompartilhar" class="link-whatsapp" title="Compartilhar link pelo Whatsapp" v-bind:href="'https://api.whatsapp.com/send?text=' + linkcompartilhar" target="_blanck">
                    <span class="fab fa-whatsapp"></span>
                    <span class="sr-only">Compartilhe no Whatsapp</span>
                </a>
            </div>
            
            <div class="documentByLine" id="plone-document-byline" >            
                <span class="documentModified">
                <span ></span>
                <span class="value" v-if="dataatualizacao">Atualizado em {{dataatualizacao}}</span>
                <span class="value" v-if="!dataatualizacao"></span>
                </span>
            </div>
            <!-- div plone-document-byline -->    
        </div>
        <!-- div viewlet-above-content-body --> 
    </div>
    <!-- div content-->    
</template>

<script>
    export default {
        props:['url','linkcompartilhar','barracompartilhar','titulo','subtitulo1','subtitulo2','subtitulo3','subtitulo4','dataatualizacao'],
        data(){
            return{
                
            }        
        },
        methods:{

        },    
        mounted() {
 
        }
    }
</script>
