<template>
  <!--Tabela MCMV 1-->
            <div>
                
                <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                    <thead>
                        <tr class="text-center">
                        <th rowspan="2" >Modalidade</th>
                        <th rowspan="2">Faixa</th>
                        <th rowspan="2">Valor Contratado R$</th>
                        <th rowspan="2">Valor Liberado R$</th>
                        <th  rowspan="2">UH Contratadas</th>
                        <th colspan="4">Unidades</th>
                        
                        </tr>
                        <tr>                                         
                        <th class="text-center">Vigentes</th>
                        <th class="text-center">Concluídas Não Entregues</th>
                        <th class="text-center">Entregues</th>
                        <th class="text-center">Distratadas</th>
                        
                               
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in dados">                        
                            <td v-if="item.faixa_renda_id == 1" >
                            {{item.txt_modalidade}}
                            <a v-if="codibge > 0" rel="nofollow" v-bind:href="url + '/novo_executivo/detalhar/modalidade/' 
                                                                                             + item.modalidade_id 
                                                                                             + '/' + item.faixa_renda_id
                                                                                             + '/' + codibge"><i class="fas fa-search"></i></a>
                            </td>
                            <td v-if="item.faixa_renda_id == 1" class="tabelaFaixa">{{item.dsc_faixa}}</td>
                            <td v-if="item.faixa_renda_id == 1" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_total,2)}}</td>
                            <td v-if="item.faixa_renda_id == 1" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_liberado,2)}}</td>
                            <td v-if="item.faixa_renda_id == 1" class="tabelaNumero text-center">{{formatarValor(item.num_uh,0)}}</td>
                            <td v-if="item.faixa_renda_id == 1" class="tabelaNumero text-center">{{formatarValor(item.num_vigentes,0)}}</td>
                            <td v-if="item.faixa_renda_id == 1" class="tabelaNumero text-center">{{formatarValor(item.num_nao_entregues,0)}}</td>
                            <td v-if="item.faixa_renda_id == 1" class="tabelaNumero text-center">{{formatarValor(item.num_entregues,0)}}</td>
                            <td v-if="item.faixa_renda_id == 1" class="tabelaNumero text-center">{{formatarValor(item.num_distratadas,0)}}</td>
                        </tr>
                        <tr class="totalFaixa">
                            <td colspan="2" class="tabelaNumero">Total Faixa 1:</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa1.valor,2)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa1.valor_liberado,2)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa1.uh,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa1.vigentes,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa1.nao_entregues,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa1.entregues,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa1.distratadas,0)}}</td>
                        </tr>
                        
                        <tr v-for="item in dados">                        
                            <td v-if="item.faixa_renda_id == 4" >
                                {{item.txt_modalidade}} - PF
                            <!--    <a v-if="codibge > 0" rel="nofollow" v-bind:href="url + '/executivo/detalhar/modalidade/' 
                                                                                             + item.modalidade_id 
                                                                                             + '/' + item.faixa_renda_id
                                                                                             + '/' + codibge"><i class="fas fa-search"></i></a>
                            -->                                                                 
                            </td>
                            <td v-if="item.faixa_renda_id == 4" class="tabelaFaixa">{{item.dsc_faixa}}</td>
                            <td v-if="item.faixa_renda_id == 4" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_total,2)}}</td>
                            <td v-if="item.faixa_renda_id == 4" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_liberado,2)}}</td>
                            <td v-if="item.faixa_renda_id == 4" class="tabelaNumero text-center">{{formatarValor(item.num_uh,0)}}</td>
                            <td v-if="item.faixa_renda_id == 4" class="tabelaNumero text-center">{{formatarValor(item.num_vigentes,0)}}</td>
                            <td v-if="item.faixa_renda_id == 4" class="tabelaNumero text-center">{{formatarValor(item.num_nao_entregues,0)}}</td>
                            <td v-if="item.faixa_renda_id == 4" class="tabelaNumero text-center">{{formatarValor(item.num_entregues,0)}}</td>
                            <td v-if="item.faixa_renda_id == 4" class="tabelaNumero text-center">{{formatarValor(item.num_distratadas,0)}}</td>
                        </tr>
                        <tr v-for="item in dados">                        
                            <td v-if="item.faixa_renda_id == 2 || item.faixa_renda_id == 3" >
                            {{item.txt_modalidade}} - PF
                            
                            </td>
                            <td v-if="item.faixa_renda_id == 2 || item.faixa_renda_id == 3" class="tabelaFaixa">{{item.dsc_faixa}}</td>
                            <td v-if="item.faixa_renda_id == 2 || item.faixa_renda_id == 3" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_total,2)}}</td>
                            <td v-if="item.faixa_renda_id == 2 || item.faixa_renda_id == 3" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_liberado,2)}}</td>
                            <td v-if="item.faixa_renda_id == 2 || item.faixa_renda_id == 3" class="tabelaNumero text-center">{{formatarValor(item.num_uh,0)}}</td>         
                            <td v-if="item.faixa_renda_id == 2 || item.faixa_renda_id == 3" class="tabelaNumero text-center">{{formatarValor(item.num_vigentes,0)}}</td>
                            <td v-if="item.faixa_renda_id == 2 || item.faixa_renda_id == 3" class="tabelaNumero text-center">{{formatarValor(item.num_nao_entregues,0)}}</td>
                            <td v-if="item.faixa_renda_id == 2 || item.faixa_renda_id == 3" class="tabelaNumero text-center">{{formatarValor(item.num_entregues,0)}}</td>
                            <td v-if="item.faixa_renda_id == 2 || item.faixa_renda_id == 3" class="tabelaNumero text-center">{{formatarValor(item.num_distratadas,0)}}</td>                   
                        </tr>
                        <tr class="totalFaixa" >
                            <td colspan="2" class="tabelaNumero">Total Faixa 1,5, 2 e 3 :</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa23.valor + totalFaixa15.valor,2)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa23.valor_liberado + totalFaixa15.valor_liberado,2)}}</td>                            
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa23.uh + totalFaixa15.uh,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa23.vigentes + totalFaixa15.vigentes,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa23.nao_entregues + totalFaixa15.nao_entregues,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa23.entregues + totalFaixa15.entregues,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa23.distratadas + totalFaixa15.distratadas,0)}}</td>
                        </tr>
                        <tr v-for="item in dados">                        
                            <td v-if="item.faixa_renda_id == 0" >
                                {{item.txt_modalidade}} - Producão/Estoque
                            <!--    <a v-if="codibge > 0" rel="nofollow" v-bind:href="url + '/executivo/detalhar/modalidade/' 
                                                                                             + item.modalidade_id 
                                                                                             + '/' + item.faixa_renda_id
                                                                                             + '/' + codibge"><i class="fas fa-search"></i></a>
                            -->                                                                 
                            </td>
                            
                            <td v-if="item.faixa_renda_id == 0" class="tabelaFaixa">{{item.dsc_faixa}}</td>
                            <td v-if="item.faixa_renda_id == 0" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_total,2)}}</td>
                            <td v-if="item.faixa_renda_id == 0" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_liberado,2)}}</td>
                            <td v-if="item.faixa_renda_id == 0" class="tabelaNumero text-center">{{formatarValor(item.num_uh,0)}}</td>
                            <td v-if="item.faixa_renda_id == 0" class="tabelaNumero text-center">{{formatarValor(item.num_vigentes,0)}}</td>
                            <td v-if="item.faixa_renda_id == 0" class="tabelaNumero text-center">{{formatarValor(item.num_nao_entregues,0)}}</td>
                            <td v-if="item.faixa_renda_id == 0" class="tabelaNumero text-center">{{formatarValor(item.num_entregues,0)}}</td>
                            <td v-if="item.faixa_renda_id == 0" class="tabelaNumero text-center">{{formatarValor(item.num_distratadas,0)}}</td>
                        </tr>
                         <tr class="totalFaixa" v-if="(totalFaixa.valor) > 0">
                            <td colspan="2" class="tabelaNumero">Total Producão/Estoque:</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa.valor,2)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa.valor_liberado,2)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa.uh,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa.vigentes,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa.nao_entregues,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa.entregues,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa.distratadas,0)}}</td>
                        </tr>
                         <tr class="total">
                            <td colspan="2" class="tabelaNumero">TOTAL:</td>
                            <td class="tabelaNumero text-center">{{formatarValor(valoresMCMV.valor,2)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(valoresMCMV.valor_liberado,2)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(valoresMCMV.uh,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(valoresMCMV.vigentes,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(valoresMCMV.nao_entregues,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(valoresMCMV.entregues,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(valoresMCMV.distratadas,0)}}</td>
                        </tr>                        
                    </tbody>                                        
                </table>
                    <span class="text-nota">*Concluídas Não Entregues: Obras com situação de obras "Concluída" com 90% de unidades entregues.</span>
                    
                    
                    
                    
                
                      
                            
                                

                </div>
        </div>        
</template>

<script>
    export default {
      props:['dados','url','codibge','posicoes'],
      data() {
            return {
               totalFaixa: {uh: 0, vigentes: 0, valor: 0, nao_entregues: 0, entregues: 0, distratadas: 0, valor_liberado: 0},     
               totalFaixa1: {uh: 0, vigentes: 0, valor: 0, nao_entregues: 0, entregues: 0, distratadas: 0, valor_liberado: 0},     
               totalFaixa15: {uh: 0, vigentes: 0, valor: 0, nao_entregues: 0, entregues: 0, distratadas: 0, valor_liberado: 0},  
               totalFaixa23: {uh: 0, vigentes: 0, valor: 0, nao_entregues: 0, entregues: 0, distratadas: 0, valor_liberado: 0},               
               valoresMCMV: {uh: 0, vigentes: 0, valor: 0, nao_entregues: 0, entregues: 0, distratadas: 0, valor_liberado: 0}
            }

          

      }, 
      methods:{
           formatarValor(valor,casas) {
                if (valor) {
                    let val = (valor/1).toFixed(casas).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                } else {
                    return '0.00';
                }
            },
             formatarData(data) {
                if (data) {    
                    var dataFormatada = new Date(data)+1;                
                    var dia=dataFormatada.getDate();
                    if (dia < 10){
                        dia = "0" + dia
                    }

                    
                        
                    var mes=dataFormatada.getMonth();
                    mes = mes+1
                    if (mes < 10){
                        mes = "0" + mes
                    }
                    var ano=dataFormatada.getFullYear();
                   
                    return dia + '/' + (mes) + '/' + ano;
                    //return new Date(data).toLocaleString().substr(0, 10)
                } else {
                    return '';
                }
            } 
      },     
      mounted() {
            
             for(var i = 0; i < this.dados.length; i++){
                if(this.dados[i].faixa_renda_id == 0){
                    this.totalFaixa.uh += parseInt(this.dados[i].num_uh);
                    this.totalFaixa.valor += parseFloat(this.dados[i].num_vlr_total);
                    this.totalFaixa.vigentes += parseInt(this.dados[i].num_vigentes);
                    this.totalFaixa.entregues += parseInt(this.dados[i].num_entregues);                
                    this.totalFaixa.valor_liberado += parseFloat(this.dados[i].num_vlr_liberado); 
                    this.totalFaixa.nao_entregues += parseInt(this.dados[i].num_nao_entregues);
                    this.totalFaixa.distratadas += parseInt(this.dados[i].num_distratadas);
                }else if(this.dados[i].faixa_renda_id == 1){
                     this.totalFaixa1.uh += parseInt(this.dados[i].num_uh);
                    this.totalFaixa1.valor += parseFloat(this.dados[i].num_vlr_total);
                    this.totalFaixa1.vigentes += parseInt(this.dados[i].num_vigentes);
                    this.totalFaixa1.entregues += parseInt(this.dados[i].num_entregues);                
                    this.totalFaixa1.valor_liberado += parseFloat(this.dados[i].num_vlr_liberado);                    
                    this.totalFaixa1.nao_entregues += parseInt(this.dados[i].num_nao_entregues);
                    this.totalFaixa1.distratadas += parseInt(this.dados[i].num_distratadas);
                }else if(this.dados[i].faixa_renda_id == 4){
                     this.totalFaixa15.uh += parseInt(this.dados[i].num_uh);
                    this.totalFaixa15.valor += parseFloat(this.dados[i].num_vlr_total);
                    this.totalFaixa15.vigentes += parseInt(this.dados[i].num_vigentes);
                    this.totalFaixa15.entregues += parseInt(this.dados[i].num_entregues);                
                    this.totalFaixa15.valor_liberado += parseFloat(this.dados[i].num_vlr_liberado);                    
                    this.totalFaixa15.nao_entregues += parseInt(this.dados[i].num_nao_entregues);
                    this.totalFaixa15.distratadas += parseInt(this.dados[i].num_distratadas);
                }else{
                     this.totalFaixa23.uh += parseInt(this.dados[i].num_uh);
                    this.totalFaixa23.valor += parseFloat(this.dados[i].num_vlr_total);
                    this.totalFaixa23.vigentes += parseInt(this.dados[i].num_vigentes);
                    this.totalFaixa23.entregues += parseInt(this.dados[i].num_entregues);                
                    this.totalFaixa23.valor_liberado += parseFloat(this.dados[i].num_vlr_liberado);                    
                    this.totalFaixa23.nao_entregues += parseInt(this.dados[i].num_nao_entregues);
                    this.totalFaixa23.distratadas += parseInt(this.dados[i].num_distratadas);       
                }
                     this.valoresMCMV.uh += parseInt(this.dados[i].num_uh);
                    this.valoresMCMV.valor += parseFloat(this.dados[i].num_vlr_total);
                    this.valoresMCMV.vigentes += parseInt(this.dados[i].num_vigentes);
                    this.valoresMCMV.entregues += parseInt(this.dados[i].num_entregues);                
                    this.valoresMCMV.valor_liberado += parseFloat(this.dados[i].num_vlr_liberado);                    
                    this.valoresMCMV.nao_entregues += parseInt(this.dados[i].num_nao_entregues);
                    this.valoresMCMV.distratadas += parseInt(this.dados[i].num_distratadas);  
             }        
        }

    }
</script>
