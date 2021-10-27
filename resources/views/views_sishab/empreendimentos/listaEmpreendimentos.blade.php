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
                :titulo1="'Empreendimentos'"
                :link2="'{{ url('/empreendimentos/filtro') }}'"
                :titulo2='"Filtro de Empreendimentos"'
                :titulo3='"Empreendimentos"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'Empreendimentos'"
                    @if($subtitulo1) subtitulo1="{{$subtitulo1}} " @endif
                    @if($subtitulo2) subtitulo2="{{$subtitulo2}} " @endif
                    @if($subtitulo3) subtitulo3="{{$subtitulo3}} " @endif
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :barracompartilhar="true"
                    >
            </cabecalho-form> 

            <div class="form-group">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                
                    @if(count($empreendimentosContratados)>0)
                        <a class="nav-item nav-link active" id="nav-contratados-tab" data-toggle="tab" href="#nav-contratados" role="tab" aria-controls="nav-contratados" aria-selected="true">Contratados</a>
                    @endif
        
                    @if(count($situacoes)==0)
                        @if(count($empreendimentosNaoContratados)>0)        
                            <a class="nav-item nav-link" id="nav-naocontratados-tab" data-toggle="tab" href="#nav-naocontratados" role="tab" aria-controls="nav-naocontratados" aria-selected="false">Não Contratados</a>
                        @endif
                    @endif    
                    </div>
                </nav>
                
                <div class="tab-content" id="nav-tabContent">
                @if(count($empreendimentosContratados)>0)
                    
                        <div class="tab-pane fade show active" id="nav-contratados" role="tabpanel" aria-labelledby="nav-contratados-tab">
                            <div class="titulo-linha-cinza text-center">
                                <h2>
                                    Lista de Empreendimentos Contratados
                                </h2>
                            </div>
                            <tabela-relatorios
                                    v-bind:titulos="{{$cabecalhoTabContratados}}"
                                    v-bind:itens="{{json_encode($empreendimentosContratados)}}"

                                    :show="'{{ url('/empreendimento/') }}'"
                                >           
                            </tabela-relatorios> 
                        </div><!--nav-contratados -->
                @endif

                @if(count($situacoes)==0)
                    @if(count($empreendimentosNaoContratados)>0)   
                    <div class="tab-pane fade show" id="nav-naocontratados" role="tabpanel" aria-labelledby="nav-naocontratados-tab">
                        <div class="titulo-linha-cinza text-center">
                            <h2>
                                Lista de Empreendimentos Não Contratados
                            </h2>
                        </div>                             
                                                
                        <tabela-relatorios
                                v-bind:titulos="{{$cabecalhoTabNaoContratados}}"
                                v-bind:itens="{{json_encode($empreendimentosNaoContratados)}}"

                                :show="'{{ url('/proposta/') }}'"
                            >           
                        </tabela-relatorios>     
                        
                        </div><!--nav-naocontratados -->
                   
                    @endif
                @endif
            </div>

            </div>    
            <!-- form-group -->
           

            <div class="form-group">
                <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">
                    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">     
            </div>    
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


