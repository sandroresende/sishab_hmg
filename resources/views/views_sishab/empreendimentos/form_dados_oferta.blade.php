<div class="card" >
    <div class="card-body">
        <div class="row">
            <div class="column col-sm-6">
                <div class="titulo">
                    <h3>Unidades Habitacionais</h3> 
                </div>  
                <div class="row">                                                    
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Valor UH</label>
                        <input id="qtd_uh_financiadas" type="text" class="form-control input-relatorio" name="qtd_uh_financiadas" value="{{number_format($dadosEmpreendimento->vlr_uh, 2, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Contratadas</label>
                        <input id="qtd_uh_financiadas" type="text" class="form-control input-relatorio" name="qtd_uh_financiadas" value="{{number_format($operacao->qtd_uh_contratadas, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Concluídas</label>
                        <input id="qtd_uh_concluidas" type="text" class="form-control input-relatorio" name="qtd_uh_concluidas" value="{{number_format($operacao->qtd_uh_concluidas, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Entregues</label>
                        <input id="qtd_uh_entregues" type="text" class="form-control input-relatorio" name="qtd_uh_entregues" value="{{number_format($operacao->qtd_uh_entregues, 0, ',' , '.')}}" disabled >
                    </div>            
                </div>      
                <div class="row"> 
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio ">Início Obras</label>
                        <input id="dte_inicio_obras" type="text" class="form-control input-relatorio" name="dte_inicio_obras" value="@if($dadosEmpreendimento->dte_inicio_obra) {{date('d/m/Y',strtotime($dadosEmpreendimento->dte_inicio_obra))}}@endif" disabled >   
                    </div> 
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio ">Término Obras</label>
                        <input id="dte_termino_obras" type="text" class="form-control input-relatorio" name="dte_termino_obras" value="@if($dadosEmpreendimento->dte_termino_obra) {{date('d/m/Y',strtotime($dadosEmpreendimento->dte_termino_obra))}}@endif" disabled >
                    </div> 
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio ">1ª Entrega</label>
                        <input id="dte_primeira_entrega" type="text" class="form-control input-relatorio" name="dte_primeira_entrega" value="@if($dadosEmpreendimento->primeira_entrega) {{date('d/m/Y',strtotime($dadosEmpreendimento->primeira_entrega))}}@endif" disabled >
                    </div> 
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio ">Última Entrega</label>
                        <input id="dte_ultima_entrega" type="text" class="form-control input-relatorio" name="dte_ultima_entrega" value="@if($dadosEmpreendimento->ultima_entrega) {{date('d/m/Y',strtotime($dadosEmpreendimento->ultima_entrega))}}@endif" disabled >
                    </div> 
                </div><!--fim row-->
            </div><!--fim col-sm-6 -->                         
            <div class="column col-sm-6"> 
                <div class="titulo">
                    <h3>Financeiro (R$)</h3> 
                </div>  
                <div class="row">                                                    
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio"> Subvenção</label>
                        <input id="vlr_operacao" type="text" class="form-control input-relatorio" name="vlr_operacao" value="{{number_format($dadosEmpreendimento->vlr_subvencao, 2, ',' , '.')}}" disabled >
                    </div> 
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio"> Liberado Sub.</label>
                        <input id="vlr_liberado" type="text" class="form-control  input-relatorio" name="vlr_liberado" value="{{number_format($dadosEmpreendimento->total_liberado_sub, 2, ',' , '.')}}" disabled >
                    </div>  
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">A Liberar Sub.</label>
                        <input id="vlr_a_liberar" type="text" class="form-control input-relatorio" name="vlr_a_liberar" value="{{number_format($dadosEmpreendimento->total_liberado_sub-$dadosEmpreendimento->vlr_subvencao, 2, ',' , '.')}}" disabled >
                    </div>  
                </div>
                <div class="row">                             
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio "> Remuneração</label>
                        <input id="vlr_remuneracao" type="text" class="form-control input-relatorio" name="vlr_remuneracao" value="{{number_format($dadosEmpreendimento->vlr_remuneracao, 2, ',' , '.')}}" disabled >
                    </div>                            
                                                                    
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio"> Liberado Rem.</label>
                        <input id="vlr_liberado_remuneracao" type="text" class="form-control input-relatorio" name="vlr_liberado_remuneracao" value="{{number_format($dadosEmpreendimento->total_liberado_rem, 2, ',' , '.')}}" disabled >
                    </div>                                                     
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio"> A Liberar Rem.</label>
                        <input id="vlr_remuneracao" type="text" class="form-control input-relatorio" name="vlr_remuneracao" value="{{number_format($dadosEmpreendimento->vlr_remuneracao-$dadosEmpreendimento->total_liberado_rem, 2, ',' , '.')}}" disabled >
                    </div>                             
                </div>
                <!--fim row-->  
            </div>           <!--fim col-sm-6 -->                         
        </div>    <!--fim row -->   
    </div><!--fim card-body -->   
  </div><!--fim card -->   
  
 
<div class="card">
    <div class="card-body">
        <div class="titulo">
            <h3>Dados do Empreendimento</h3> 
        </div>
        <div class="row ">                                    
            <div class="column col-xs-12 col-md-2">
                <label class="control-label label-relatorio"> Protocolo  @can('eGestao') <a href='{{url("/oferta_publica/protocolo/$dadosEmpreendimento->instituicao_id/$dadosEmpreendimento->protocolo_id")}}'><i class="fas fa-search"></i></a>@endcan</label>
                <input id="txt_protocolo" type="text" class="form-control input-relatorio" name="txt_protocolo" value="{{$dadosEmpreendimento->txt_protocolo}}" disabled >
            </div>
            <div class="column col-xs-12 col-md-2">
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
                <label class="control-label label-relatorio">Modalidade Oferta</label>
                <input id="txt_modalidade_oferta" type="text" class="form-control input-relatorio" name="txt_modalidade_oferta" value="{{$dadosEmpreendimento->modalidade}}" disabled >
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
                <label class="control-label label-relatorio">Nome Construtora</label>
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
                    <input id="txt_uf" type="text" class="form-control input-relatorio" name="txt_uf" value="{{$operacao->txt_sigla_uf}}" disabled >
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
        <!--fim row--> 
    </div><!--fim card-body-->
</div><!--fim card-->

