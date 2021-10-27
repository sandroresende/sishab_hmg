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
                :titulo2='"Consulta Remessas de Devolução"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'Remessas de Devolução '"
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/oferta_publica/filtro_relatorio_devolucao/") }}'"
                    :barracompartilhar="true">
            </cabecalho-form> 
            
            <b>Selecione os dados para realização da pesquisa.  </b>
            <form id="filtrarPropostas" method="post" action='{{url("/oferta_publica/remessa_devolucao")}}'>
            <div class="form-group">
               
                   
                    <div class="well">
                        <div class="box">                                                                                 
                            
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="codigo_devolucao">Código da Devolução</label>
                                    <select class="form-control  input-filtro" id="remessa_devolucao_id" name="remessa_devolucao_id" required>
                                        <option value="">Selecione uma Remessa</option>
                                        @foreach($remessas as $remessa)
                                            <option value="{{$remessa->id}}">{{$remessa->id}}</option>
                                        @endforeach
                                    </select>
                                     
                                </div>                                       
                        </div>                                       
                    </div>                                       
                                   
                           
               <!--form-group -->
    

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


