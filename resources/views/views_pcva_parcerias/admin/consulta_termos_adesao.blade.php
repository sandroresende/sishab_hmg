@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
                    :url="'{{ url('/') }}'"
                    :titulo1="'PCVA - Parcerias'"
                    :titulo2='"Consulta Manifestação de Interesse"'
                   
            >
            </historico-navegacao>

            <cabecalho-form
                    :titulo="'CONSULTA MANIFESTAÇÃO DE INTERESSE'"
                    :barracompartilhar="true"
                    :linkcompartilhar="'{{ url("/admin/pcva_parcerias/termo/filtro")}}'"
                    >
              
            </cabecalho-form> 
           <!-- form-group-->              
           <div class="form-group">
            
            <form action="{{ url('admin/pcva_parcerias/termo/pesquisar') }}" method="POST">
                @csrf
                <div class="well">
                    <div class="box">                                                                                 
                        <consulta-termos-parceria 
                        coluf="column col-xs-12 col-sm-6"
                        colmun="column col-xs-12 col-sm-6"
                        :url="'{{ url('/') }}'"
                        :blnpesquisaprot="'true'"
                        :blnpesquisasituac="'true'">
                    </consulta-termos-parceria>
                    </div>
                </div>    
            </form> 

        
             
        </div><!-- fechar primeiro form-group-->

        </div><!-- content-core -->
</div>    
<!-- content -->
@endsection


