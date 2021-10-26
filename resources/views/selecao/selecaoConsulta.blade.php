@section('link')
    
@endsection

@extends('layouts.layouts')

@section('content')

<exemplo>

</exemplo>


<pagina tamanho="7">
    <div class="container-fluid">  
        <!-- TABELA-->
        <div class="row" style="margin-top:0;">
            <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-heading">Seleção de Propostas 2018 @{{ 2+2}}</div>
                    <div class="panel-body">                    
                        <table class="table table-hover">                    
                            <caption>Propostas habilitadas em 2018 para a contratação de empreendimentos no âmbito do Programa Nacional de Habitação Urbana - PNHU, integrante do Programa Minha Casa, Minha Vida - PMCMV.</caption>
                            <thead>
                                <tr>
                                    <th>Seleção</th>
                                    <th>Portaria nº</th>
                                    <th>Modalidade</th>
                                    <th>Enquadradas</th>
                                    <th>Selecionadas</th>
                                    <th>Contratadas</th>
                                    <th>UH Contratadas</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($selecoes as $selecao)
                                <tr>
                                    <td>{{$selecao->num_selecao}}/{{$selecao->num_ano_selecao}}</td>
                                    <td>{{$selecao->num_portaria_resultado}}, {{date('d/m/Y',strtotime($selecao->dte_portaria_resultado))}}</td>                                            
                                    <td>{{$selecao->modalidade->txt_modalidade}}</td>                                            
                                    <td>{{number_format( ($selecao->num_total_enquadradas), 0, ',' , '.')}}</td>                                            
                                    <td>{{number_format( ($selecao->num_total_selecionadas), 0, ',' , '.')}}</td>                                            
                                    <td>{{number_format( ($selecao->num_total_contratadas), 0, ',' , '.')}}</td>                                            
                                    <td>{{number_format( ($selecao->num_uh_contratadas), 0, ',' , '.')}}</td>                                            
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>    
        </div>
    <!-- TABELA-->
    </div>    
</pagina>

@endsection

@section('script')

@endsection
