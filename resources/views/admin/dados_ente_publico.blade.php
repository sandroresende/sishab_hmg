@extends('layouts.app')

@section('content')

<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
            <a href="{{ url('/admin/entePublicos') }}">Página Inicial</a>
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
            <span> Seleção de Demandas</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{url('/admin/entePublico/filtro')}}">Consulta de Entes Público</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Dados Ente Público</span>
    </span>
</div>

<div id="content">
  <div id="viewlet-above-content-title"></div>
 
  <h2  class="documentFirstHeading text-center">
    {{$entePublico->txt_ente_publico}}
</h2>
<span class="documentFirstHeadingSpan">
{{$entePublico->municipio->ds_municipio}} - {{$entePublico->municipio->uf->txt_sigla_uf}}
</span>  
  <div class="linha-separa"></div>

  <div id="viewlet-above-content-body">

  </div>
  <div id="content-core">
    <div class="titulo">
        <h5>Dados do Ente Público </h5>         
    </div>
    <div class="form-group">
        <div class="row">
            <div class="column col-xs-12 col-md-9">
                <label class="control-label">Nome do Ente Público</label>
                <input id="txt_ente_publico" type="text" class="form-control" name="txt_ente_publico" value="{{$entePublico->txt_ente_publico}}" disabled >

            </div>
            <div class="column col-xs-12 col-sm-3">
                <label for="txt_tipo_ente_publico">Tipo Ente Público</label>           
                <input id="txt_tipo_ente_publico" type="text" class="form-control" name="txt_tipo_ente_publico" value="{{$entePublico->tipoEntePublico->txt_tipo_ente_publico}}" disabled >                      
            </div>
        </div>  
    </div><!-- fechar primeiro form-group-->
    <div class="form-group">
        <div class="row">
            <div class="column col-xs-12 col-md-9">
                <label class="control-label ">Email</label>
                <input id="txt_email_ente_publico" type="email" class="form-control" name="txt_email_ente_publico" value="{{$entePublico->txt_email_ente_publico}}" disabled >

                @if ($errors->has('txt_email_ente_publico'))
                    <span class="erro_validacao">
                        <strong>{{ $errors->first('txt_email_ente_publico') }}</strong>
                    </span>
                @endif
            </div>   
            <div class="column col-xs-12 col-md-3">
                <label class="control-label ">CNPJ</label>
                <input id="txt_cnpj_ente_publico" type="text" class="form-control" name="txt_cnpj_ente_publico" value="{{$entePublico->id}}" disabled >

                @if ($errors->has('txt_cnpj_ente_publico'))
                    <span class="erro_validacao">
                        <strong>{{ $errors->first('txt_cnpj_ente_publico') }}</strong>
                    </span>
                @endif
            </div>                    
                            
        </div>
    </div><!-- fechar segundo form-group-->

    @if($dirigente)
    <div class="titulo">
        <h5>Dados do Dirigente </h5>         
    </div>

    <div class="form-group">
        <div class="row">        
            <div class="column col-xs-12 col-md-6">
                <label for="txt_nome_dirigente" class="control-label">Nome</label>
                <input id="txt_nome_dirigente" type="text" class="form-control" name="txt_nome_dirigente" value="{{$dirigente->txt_nome_dirigente}}" disabled >
            </div>
            <div class="column col-xs-12 col-md-4">
                <label for="txt_cargo_dirigente" class="control-label">Cargo</label>
                <input id="txt_cargo_dirigente" type="text" class="form-control" name="txt_cargo_dirigente" value="{{$dirigente->txt_cargo_dirigente}}"  disabled >
            </div>
            <div class="column col-xs-12 col-md-2">
                <label for="txt_cargo_dirigente" class="control-label">Status</label>
                <input id="bln_ativo" type="text" class="form-control" name="bln_ativo" value="{{ $dirigente->bln_ativo ? 'Ativo' : 'Inativo' }} "  disabled >
            </div>


            
        </div>
    </div><!-- fechar primeiro form-group-->  
    
    <div class="form-group">
        <div class="row">        
            <div class="column col-xs-12 col-md-4">
                <label for="txt_cpf_dirigente" class="control-label">CPF</label>
                <input id="txt_cpf_dirigente" type="text" maxlength="11" class="form-control" name="txt_cpf_dirigente" value="{{$dirigente->txt_cpf_dirigente}}"  disabled>
            </div>
   
            <div class="column col-xs-12 col-md-8">
                <label for="txt_email_dirigente" class="control-label">E-Mail</label>
                <input id="txt_email_dirigente" type="text" class="form-control" name="txt_email_dirigente" value="{{$dirigente->txt_email_dirigente}}"  disabled > 
            </div>
        </div>    
    </div><!-- fechar segundo form-group-->

    @endif
    <div class="titulo">
        <h5>Usuários Cadastrados </h5>         
    </div>
    <div class="form-group">
        <div class="row">  
            <table class="table table-hover">
                <thead>
                    <tr class="text-center" >                  
                        <th>Nome do Usuário</th>
                        <th>Email do Usuário</th>
                        <th>Cargo do Usuário</th>
                        <th>Tipo Usuário</th>    
                        <th>Status Usuário</th>    
                        <th>Data Aceite</th>                              
                    </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $usuario)
                        <tr class="text-center" >
                        <td>{{$usuario->name}}</td> 
                        <td>{{$usuario->email}}</td> 
                        <td>{{$usuario->txt_cargo}}</td> 
                        <td>{{$usuario->tipoUsuario->txt_tipo_usuario}}</td>
                        <td><span class="label label-danger">{{$usuario->statusUsuario->txt_status_usuario}}</span></td>
                        <td> @if($usuario->dte_aceite_termo) {{date('d/m/Y',strtotime($usuario->dte_aceite_termo))}} @endif </td>
                                 
                        </tr>                                         
                @endforeach
                </tbody>
            </table><!-- fechar table-->
        </div>    
    </div><!-- fechar segundo form-group-->            

    <button type="submit"  class="btn btn-danger btn-lg btn-block" onclick="javascript:window.history.go(-1)">Fechar</button>
              

        
  </div>
    <!-- content-core-->
</div>
<!-- content-->



@endsection