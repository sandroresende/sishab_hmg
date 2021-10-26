<template>
    <div class="row">
        <div class="col-md-3 col-6 mt-2">
                <button 
                    class="btn btn-block"
                    title="Visualizar Em Análise" 
                    :class="{'btn-primary' : em_analise_ativo, 'btn-outline-primary' : !em_analise_ativo}"
                    :disabled="permissoes_em_analise.length == 0"
                    @click="mudarFiltro(1)">
                    Em Análise ({{ permissoes_em_analise.length }})
                </button>
            </div>
             <div class="col-md-3 col-6 mt-2">
                <button 
                    class="btn btn-block"
                    title="Visualizar Deferidas" 
                    :class="{'btn-primary' : deferidas_ativo, 'btn-outline-primary' : !deferidas_ativo}"
                    :disabled="permissoes_deferidas.length == 0"
                    @click="mudarFiltro(2)">
                    Deferidas ({{ permissoes_deferidas.length }})
                </button>
            </div>
            <div class="col-md-3 col-6 mt-2">
                <button 
                    class="btn btn-block"
                    title="Visualizar Indeferidas" 
                    :class="{'btn-primary' : indeferidas_ativo, 'btn-outline-primary' : !indeferidas_ativo}"
                    :disabled="permissoes_indeferidas.length == 0"
                    @click="mudarFiltro(3)">
                    Indeferidas ({{ permissoes_indeferidas.length }})
                </button>
            </div>
            <div class="col-md-3 col-6 mt-2">
                <button 
                    class="btn btn-block"
                    title="Visualizar Desativadas" 
                    :class="{'btn-primary' : desativadas_ativo, 'btn-outline-primary' : !desativadas_ativo}"
                    :disabled="permissoes_desativadas.length == 0"
                    @click="mudarFiltro(4)">
                    Desativadas ({{ permissoes_desativadas.length }})
                </button>
            </div>
    </div>
</template>

<script>
     export default {
       
        props: {
            permissoes: {
               required: true
            },
        },
        data() {
            return {
                compartilhado: variaveis_globais,
                permissoesDisplay: this.permissoes,
                filtro_ativo: 1,
            }
        },
        computed: {
          permissoes_em_analise() {
              return this.permissoesDisplay.filter(permissao => {
                    return permissao.status_permissao_id == 1;
                });
          },
          em_analise_ativo() {
              return this.filtro_ativo == 1;
          },
          permissoes_deferidas() {
              return this.permissoesDisplay.filter(permissao => {
                    return permissao.status_permissao_id == 2;
                });
          },
          deferidas_ativo() {
              return this.filtro_ativo == 2;
          },
          permissoes_indeferidas() {
              return this.permissoesDisplay.filter(permissao => {
                    return permissao.status_permissao_id == 3;
                });
          },
          indeferidas_ativo() {
              return this.filtro_ativo == 3;
          },
          permissoes_desativadas() {
              return this.permissoesDisplay.filter(permissao => {
                    return permissao.status_permissao_id == 4;
                });
          },
          desativadas_ativo() {
              return this.filtro_ativo == 4;
          },
        },
        methods: {
            mudarFiltro(status) {
              this.filtro_ativo = status;
            },
        },
        mounted() {
            if(this.permissoes_em_analise.length == 0) {
                if(this.permissoes_deferidas.length >= 1) {
                    this.filtro_ativo = 2;
                } else {
                    if(this.permissoes_indeferidas.length >= 1) {
                        this.filtro_ativo = 3;
                    } else {
                        if(this.permissoes_desativadas.length >= 1) {
                            this.filtro_ativo = 4;
                        } else {
                            this.filtro_ativo = null;
                        }
                    }
                }
            }
        }
    }
</script>
