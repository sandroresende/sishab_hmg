@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
    
    
@endsection


@section('content')

<div id="content">
    <div id="content-core">
        
        <historico-navegacao
            :url="'{{ url('/home') }}'"
            :titulo1='"Seleção de Propostas"'
            :titulo2='"Filtro Seleção de Propostas Apresentadas"'
            :link2="'{{ url('/proposta/selecao') }}'"
            :titulo3="'Propostas Apresentadas'"
        >
        </historico-navegacao>

        <cabecalho-form
                :titulo="'Propostas Apresentadas'"
                :subtitulo1="'{{$titulo_niv1}}'"
                :subtitulo2="'{{$titulo_niv2}}'"
                :dataatualizacao="'{{date('d/m/Y',strtotime($selecao->dte_portaria_resultado))}}'"
                :barracompartilhar="true"
                >
        </cabecalho-form>    

        <div class="form-group">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                        <th>UF</th>  
                        <th>Município</th>  
                        <th>APF</th>  
                        <th>Seleção</th>  
                        <th>Empreendimento</th>  
                        <th>Modalidade</th>                                  
                        <th>UH</th>                                  
                        <th>Valor (R$)</th>            
                        <th>Situação</th>        
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($propostasApresentadas as $propostas) 
                            <tr class="text-center">          
                                <td>{{$propostas->txt_sigla_uf}}</td>                                    
                                <td>{{$propostas->ds_municipio}}</td>                                    
                                <td><a style="text-decoration:none" href='{{ url("proposta/$propostas->proposta_id/$propostas->num_apf") }}'>{{$propostas->num_apf}}</a></td>                                    
                                <td>{{$propostas->num_selecao}}/{{$propostas->num_ano_selecao}}</td>                               
                                <td>{{$propostas->txt_nome_empreendimento}}</td>                                    
                                <td>{{$propostas->txt_modalidade}}</td>                                                                       
                                <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($propostas->vlr_investimento), 2, ',' , '.')}}</td>
                                <td>
                                
                                @if($propostas->bln_enquadrada)                             
                                    @if($propostas->bln_selecionada)                             
                                        
                                        @if($propostas->bln_contratada)                             
                                        <i class="fas fa-hand-holding-usd fa-1x text-success"> Contratada </i>
                                        @else 
                                            @if($propostas->bln_ativo)                             
                                                <i class="fas fa-question fa-1x text-secondary"> Em prazo de Contratação </i>  
                                            @else
                                                <i  class="fas fas fa-check fa-1x text-info"> Selecionada</i>
                                            @endif    
                                        @endif
                                    @else 
                                        <i class="fas fa-times fa-1x text-warning"> Não Selecionada </i>  
                                    @endif
                                @else
                                    <i class="fa fa-thumbs-down text-danger"> Não Enquadrada</i>        
                                @endif
                                
                                </td>
                                                                                
                            </tr>
                    @endforeach                           
                
                        </tbody>
                    </table> 
                </div>  
                <!--table-responsive --> 
        </div>
     <!--form-group --> 
     <div class="form-group">
        <div class="row">
            <div class="column col-sm-6 col-xs-12">                                        
                <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">   
            </div>
            <div class="column col-sm-6 col-xs-12">
                <input class="btn btn-lg btn-danger btn-block" type="button-danger" onclick="javascript:window.history.go(-1)" value="Fechar">    
            </div>
        </div>        
    </div><!-- fechar primeiro form-group-->
     </div>
    <!--content-core --> 
</div>
<!--content-->     
@endsection


