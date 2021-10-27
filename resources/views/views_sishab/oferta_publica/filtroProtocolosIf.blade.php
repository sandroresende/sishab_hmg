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
                :titulo1="'Oferta Pública'"
                :titulo2='"Consulta aos Protocolos das Instituições"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'Protocolos das Instituições '"
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/oferta_publica/protocolos/instituicao/filtro/") }}'"
                    :barracompartilhar="true">
            </cabecalho-form> 
            
            <b>Selecione os dados para realização da pesquisa.  </b>
            <form action="{{ url('oferta_publica/protocolos/instituicao') }}" method="POST">
            <div class="form-group">
               
                @csrf
                <div class="well">
                    <div class="box">                                                                                 
                        <div class="form-group">  
                            <label for="instituicao">Instituição</label>   
                            <select name="instituicao_id" id="instituicao_id" class="form-control input-filtro" >
                            <option value="">Escolha uma Instituição:</option>
                                @foreach($instituicoes as $instituicao)
                                    <option value="{{$instituicao->id}}">
                                    {{$instituicao->txt_nome_if}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>                                     
            </div>  <!--form-group -->
    

            <div class="form-group">
                <div class="row">                                                    
                    <div class="column col-xs-12 col-md-12">
                        <button type="submit" class="btn btn-primary btn-block">Pesquisar</button>  
                    </div>
                </div>    
            </div>    
        </form>
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


