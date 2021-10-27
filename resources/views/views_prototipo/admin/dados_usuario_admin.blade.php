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
            :titulo1="'Protótipo de HIS'"
            :titulo2='"Usuários e Responsáveis"'
            :link2="'{{ url('/admin/prototipo/usuarios') }}'"
            :titulo3='"Dados Usuário"'
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'{{$usuario->name}}'"
                    :subtitulo1="'{{$usuario->tipoUsuario->txt_tipo_usuario}}'"
                    :dataatualizacao="'{{date('d/m/Y',strtotime($usuario->updated_at))}}'"
                    :linkcompartilhar="'{{ url("/admin/prototipo/usuario/$usuario->id") }}'"
                    :barracompartilhar="true">
                    
            </cabecalho-form> 
           
            @include('views_gerais.form_dados_usuario') 
        
            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">
                    </div>    
                </div>
            </div> 
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


