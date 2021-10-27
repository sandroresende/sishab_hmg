<div class="card" >
    <div class="card-body">
        <div class="row">
            <div class="column col-sm-6">
                <div class="titulo">
                    <h3>Unidades Habitacionais</h3> 
                </div>  
                <div class="row ">                                                    
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio">Contratadas</label>
                        <input id="qtd_uh_contratadas" type="text" class="form-control input-relatorio text-center" name="qtd_uh_contratadas" value="{{number_format($operacao->qtd_uh_contratadas, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio">Distratadas</label>
                        <input id="qtd_uh_distratadas" type="text" class="form-control input-relatorio text-center" name="qtd_uh_distratadas" value="{{number_format($operacao->qtd_uh_distratadas, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio">Concluídas</label>
                        <input id="qtd_uh_concluidas" type="text" class="form-control input-relatorio text-center" name="qtd_uh_concluidas" value="{{number_format($operacao->qtd_uh_concluidas, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio">Entregues</label>
                        <input id="qtd_uh_entregues" type="text" class="form-control input-relatorio text-center" name="qtd_uh_entregues" value="{{number_format($operacao->qtd_uh_entregues, 0, ',' , '.')}}" disabled >
                    </div>            
                </div>
                <div class="row">                     
                    <div class="column col-xs-12 col-md-4 text-center">
                        <label class="control-label label-relatorio ">Efetiva de Conlusão</label>
                        <input id="dte_efetiva_conclusao" type="text" class="form-control input-relatorio text-center" name="dte_efetiva_conclusao" value="@if($dadosEmpreendimento->dte_efetiva_conclusao) {{date('d/m/Y',strtotime($dadosEmpreendimento->dte_efetiva_conclusao))}}@endif" disabled >
                    </div> 
                    <div class="column col-xs-12 col-md-4 text-center">
                        <label class="control-label label-relatorio  text-center">Primeira Entrega</label>
                        <input id="dte_primeira_entrega" type="text" class="form-control input-relatorio text-center" name="dte_primeira_entrega" value="@if($dadosEmpreendimento->dte_primeira_entrega) {{date('d/m/Y',strtotime($dadosEmpreendimento->dte_primeira_entrega))}}@endif" disabled >
                    </div> 
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio text-center">Última Entrega</label>
                        <input id="dte_ultima_entrega" type="text" class="form-control input-relatorio text-center" name="dte_ultima_entrega" value="@if($dadosEmpreendimento->dte_ultima_entrega) {{date('d/m/Y',strtotime($dadosEmpreendimento->dte_ultima_entrega))}}@endif" disabled >
                    </div> 
                </div><!--fim row-->
            </div><!--fim col-sm-6 -->                         
            <div class="column col-sm-6"> 
                <div class="titulo">
                    <h3>Financeiro (R$)</h3> 
                </div>  
                <div class="row">                                                    
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio"> Contratado</label>
                        <input id="vlr_operacao" type="text" class="form-control input-relatorio text-center" name="vlr_operacao" value="{{number_format($operacao->vlr_operacao, 2, ',' , '.')}}" disabled >
                    </div> 
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio"> Contrapartida</label>
                        <input id="vlr_contrapartida" type="text" class="form-control  input-relatorio text-center" name="vlr_contrapartida" value="{{number_format($operacao->vlr_contrapartida, 2, ',' , '.')}}" disabled >
                    </div> 
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio"> Liberado</label>
                        <input id="vlr_projeto" type="text" class="form-control input-relatorio text-center" name="vlr_projeto" value="{{number_format($operacao->vlr_liberado, 2, ',' , '.')}}" disabled >
                    </div> 
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio">A Liberar</label>
                        @if((($operacao->vlr_operacao+$operacao->vlr_projeto)-$operacao->vlr_liberado)<0)
                            <input id="vlr_a_liberar" type="text" class="form-control input-relatorio input-alerta text-center" name="vlr_a_liberar" value="{{number_format(($operacao->vlr_operacao+$operacao->vlr_projeto)-$operacao->vlr_liberado, 2, ',' , '.')}}" disabled >
                        @else
                            <input id="vlr_a_liberar" type="text" class="form-control input-relatorio text-center" name="vlr_a_liberar" value="{{number_format(($operacao->vlr_operacao+$operacao->vlr_projeto)-$operacao->vlr_liberado, 2, ',' , '.')}}" disabled >
                        @endif                                    
                    </div>
                </div>
                <div class="row">     
                    <div class="column col-xs-12 col-md-4 text-center">
                        <label class="control-label label-relatorio">% Financeiro Obra</label>
                        <input id="prc_execucao_financeira_obra" type="text" class="form-control input-relatorio text-center" name="prc_execucao_financeira_obra" value="{{number_format($dadosEmpreendimento->prc_execucao_financeira_obra, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-4 text-center">
                        <label class="control-label label-relatorio">% Financeiro Atec</label>
                        <input id="prc_execucao_financeira_atec" type="text" class="form-control input-relatorio text-center" name="prc_execucao_financeira_atec" value="{{number_format($dadosEmpreendimento->prc_execucao_financeira_atec, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-4 text-center">
                        <label class="control-label label-relatorio">% Financeiro TS</label>
                        <input id="prc_execucao_financeira_ts" type="text" class="form-control input-relatorio text-center" name="prc_execucao_financeira_ts" value="{{number_format($dadosEmpreendimento->prc_execucao_financeira_ts, 0, ',' , '.')}}" disabled >
                    </div>     
                </div>
                <!--fim row-->  
            </div>           <!--fim col-sm-6 -->                         
        </div>    <!--fim row -->   
    </div>
  </div>
  

   <div class="card">
       <div class="card-body">
           <div class="titulo">
               <h3>Dados do Empreendimento</h3> 
           </div>
           <div class="row ">                                    
               <div class="column col-xs-12 col-md-2">
                   <label class="control-label label-relatorio"> @if($operacao->modalidade_id==5) Propotocolo @else APF @endif</label>
                   <input id="operacao_id" type="text" class="form-control input-relatorio" name="operacao_id" value="{{$operacao->operacao_id}}" disabled >
               </div>
               <div class="column col-xs-12 col-md-2">
                       <label class="control-label label-relatorio">Situação Obra - GEFUS</label>
                       <input id="operacao_id" type="text" class="form-control input-relatorio" name="operacao_id" value=" {{$operacao->txt_situacao_obra}}" disabled >
                   </div>
               <div class="column col-xs-12 col-md-3">
               @if($operacao->dte_assinatura)    
                   <label class="control-label label-relatorio ">Data de Contratação</label>
                   <input id="dte_assinatura" type="text" class="form-control input-relatorio" name="dte_assinatura" value="@if($operacao->dte_assinatura) {{date('d/m/Y',strtotime($operacao->dte_assinatura))}}@endif" disabled >
               @else
                   <label class="control-label label-relatorio ">Ano Assinatura</label>
                   <input id="num_ano_assinatura" type="text" class="form-control input-relatorio" name="num_ano_assinatura" value="{{$operacao->num_ano_assinatura}}" disabled >
               @endif
               </div>
               
               <div class="column col-xs-12 col-md-2">
                   <label class="control-label label-relatorio"> % de Obras</label>
                   <input id="prc_obra_realizado" type="text" class="form-control input-relatorio" name="prc_obra_realizado" value="{{number_format($operacao->prc_obra_realizado, 0, ',' , '.')}}" disabled >
               </div>
               <div class="column col-xs-12 col-md-3">
                   <label class="control-label label-relatorio">Natureza Contrato</label>
                   <input id="txt_natureza_contrato" type="text" class="form-control input-relatorio" name="txt_natureza_contrato" value="{{$dadosEmpreendimento->txt_natureza_contrato}}" disabled >
               </div>  
           </div>
           <div class="row">
               <div class="column col-xs-12 col-md-3">
                   <label class="control-label label-relatorio ">Instituição</label>
                   <input id="txt_agente_financeiro" type="text" class="form-control input-relatorio" name="txt_agente_financeiro" value="{{$operacao->txt_agente_financeiro}}" disabled >
               </div>
               <div class="column col-xs-12 col-md-3">
                   <label class="control-label label-relatorio">CNPJ/CPF</label>
                   <input id="proponente_id" type="text" class="form-control input-relatorio" name="proponente_id" value="{{$operacao->proponente_id}}" disabled >
               </div>
               <div class="column col-xs-12 col-md-3">
                   <label class="control-label label-relatorio">Nome Entidade</label>
                   <input id="txt_proponente_operacao" type="text" class="form-control input-relatorio" name="txt_proponente_operacao" value="{{$operacao->txt_proponente_operacao}}" disabled >
               </div>
              
               <div class="column col-xs-12 col-md-3">
                   
               </div>
           </div>

           <div class="row">
               <div class="column col-xs-12 col-md-8">
                   <label class="control-label label-relatorio ">Logradouro</label>
                   <input id="txt_logradouro" type="text" class="form-control input-relatorio" name="txt_logradouro" value="{{$operacao->txt_logradouro}}" disabled >
               </div>
               <div class="column col-xs-12 col-md-4">
                   <label class="control-label label-relatorio">Localidade</label>
                   <input id="txt_localidade" type="text" class="form-control input-relatorio" name="txt_localidade" value="{{$operacao->txt_localidade}}" disabled >
               </div>
           </div>
           <!--fim row--> 
           <div class="row">
               <div class="column col-xs-12 col-md-3">
                   <label class="control-label label-relatorio ">UF</label>
                   <input id="txt_uf" type="text" class="form-control input-relatorio" name="txt_uf" value="{{$operacao->txt_uf}}" disabled >
               </div>
               <div class="column col-xs-12 col-md-6">
                   <label class="control-label label-relatorio">Município</label>
                   <input id="ds_municipio" type="text" class="form-control input-relatorio" name="ds_municipio" value="{{$operacao->ds_municipio}}" disabled >
               </div>
               <div class="column col-xs-12 col-md-3">
                   <label class="control-label label-relatorio">CEP</label>
                   <input id="txt_cep" type="text" class="form-control input-relatorio" name="txt_cep" value="{{$operacao->txt_cep}}" disabled >
               </div>
           </div>
           <!--fim row--> 
        </div>
    </div>   

    <div class="card">
        <div class="card-body">
            <div class="titulo">
                <h3>Dados Gerais</h3> 
            </div>
           <div class="row">
               <div class="column col-xs-12 col-md-3">
                   <label class="control-label label-relatorio">Assit Técnica</label>
                   <input id="vlr_atec" type="text" class="form-control  input-relatorio" name="vlr_atec" value="{{number_format($dadosEmpreendimento->vlr_atec, 2, ',' , '.')}}" disabled >
               </div>
               <div class="column col-xs-12 col-md-3">
                   <label class="control-label label-relatorio">Assit Técnica TS Cisterna</label>
                   <input id="vlr_atec_ts_cisterna" type="text" class="form-control  input-relatorio" name="vlr_atec_ts_cisterna" value="{{number_format($dadosEmpreendimento->vlr_atec_ts_cisterna, 2, ',' , '.')}}" disabled >
               </div>
               <div class="column col-xs-12 col-md-2">
                   <label class="control-label label-relatorio">Cisterna</label>
                   <input id="vlr_cisterna" type="text" class="form-control  input-relatorio" name="vlr_cisterna" value="{{number_format($dadosEmpreendimento->vlr_cisterna, 2, ',' , '.')}}" disabled >
               </div>
               <div class="column col-xs-12 col-md-2">
                   <label class="control-label label-relatorio">Efluentes</label>
                   <input id="vlr_diferenca_juros" type="text" class="form-control  input-relatorio" name="vlr_efluentes" value="{{number_format($dadosEmpreendimento->vlr_efluentes, 2, ',' , '.')}}" disabled >
               </div>
               <div class="column col-xs-12 col-md-2">
                   <label class="control-label label-relatorio">Trabalho Social</label>
                   <input id="vlr_trabalho_social" type="text" class="form-control  input-relatorio" name="vlr_trabalho_social" value="{{number_format($dadosEmpreendimento->vlr_trabalho_social, 2, ',' , '.')}}" disabled >
               </div>
           </div>
           <div class="row">
               <div class="column col-xs-12 col-md-3">
                   <label class="control-label label-relatorio">Tx Administração</label>
                   <input id="vlr_taxa_administracao" type="text" class="form-control  input-relatorio" name="vlr_taxa_administracao" value="{{number_format($dadosEmpreendimento->vlr_taxa_administracao, 2, ',' , '.')}}" disabled >
               </div>
               <div class="column col-xs-12 col-md-3">
                   <label class="control-label label-relatorio">Tx Adm Cisterna</label>
                   <input id="vlr_taxa_adm_cisterna" type="text" class="form-control  input-relatorio" name="vlr_taxa_adm_cisterna" value="{{number_format($dadosEmpreendimento->vlr_taxa_adm_cisterna, 2, ',' , '.')}}" disabled >
               </div>
               <div class="column col-xs-12 col-md-3">
                   <label class="control-label label-relatorio">Tx Risco Crédito</label>
                   <input id="vlr_taxa_risco_credito" type="text" class="form-control  input-relatorio" name="vlr_taxa_risco_credito" value="{{number_format($dadosEmpreendimento->vlr_taxa_risco_credito, 2, ',' , '.')}}" disabled >
               </div>
               <div class="column col-xs-12 col-md-3">
                   <label class="control-label label-relatorio">Diferença Juros</label>
                   <input id="vlr_diferenca_juros" type="text" class="form-control  input-relatorio" name="vlr_diferenca_juros" value="{{number_format($dadosEmpreendimento->vlr_diferenca_juros, 2, ',' , '.')}}" disabled >
               </div>               
           </div>           
       </div>        
   </div>