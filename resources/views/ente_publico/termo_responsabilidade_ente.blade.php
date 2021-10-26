@extends('layouts.app')

@section('content')

<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
            <a href="{{ url('/entePublico') }}">Página Inicial</a>
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
            <span> Ente Público</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Termo de Responsabilidade</span>
    </span>
</div><!-- portal-breadcrumbs -->



<div id="content">
    <br/>
    <br/>
    <div class="text-center">
        <img class="center-block" width='70' src="{{URL::asset('img/brasao_brasil.png')}}"  >
    </div>
    
    <h3 class="text-center">{{$ente->txt_ente_publico}}</h3>   
    <h4 class="text-center">{{$municipio->ds_municipio}}-{{$municipio->txt_sigla_uf}}</h4>   
    
    <div class="linha-separa"></div>
    
    <div id="viewlet-above-content-title"></div>
    <br/>
    <br/>

    <h2 class="documentFirstHeading">
         TERMO DE COMPROMISSO DE MANUTENÇÃO DE SIGILO
    </h2>

    <br/>
    <br/>
    <br/>

  
    <div id="content-core">

        <form class="form-horizontal" role="form" method="POST" action='{{ url("/entePublico/termo_aceite") }}'>
        
        @csrf
            <div class="form-group">
                    <p>
                    Eu, <strong>{{$usuario->name}}, {{$usuario->txt_cargo}}, nº CPF {{$usuario->txt_cpf_usuario}},</strong> declaro estar ciente da habilitação
                que me foi conferida para manuseio de dados identificados do Cadastro Único para Programas
                Sociais do Governo Federal (Cadastro Único/Ministério da Cidadania).
                    </p>
                    <p>
                    No tocante às atribuições a mim conferidas, no âmbito do Termo de Responsabilidade acima
                referido, comprometo-me a:
                    </p>

                    <p>
                    a) manusear as bases de dados identificados do Cadastro Único apenas por necessidade de
                serviço, ou em caso de determinação expressa, desde que legal, de superior hierárquico;
                    </p>
                    
                    <p>
                    b) manter a absoluta cautela quando da exibição de dados em tela, impressora, ou, ainda, na
                gravação em meios eletrônicos, a fim de evitar que deles venham a tomar ciência pessoas não
                autorizadas; 
                    </p>

                    <p>
                    c) não me ausentar do terminal sem encerrar a sessão de uso das bases, garantindo assim a
                impossibilidade de acesso indevido por pessoas não autorizadas; e
                    </p>

                    
                    <p>
                    d) manter sigilo dos dados ou informações sigilosas obtidas por força de minhas atribuições,
                abstendo-me de revelá-los ou divulgá-los, sob pena de incorrer nas sanções civis e penais
                decorrentes de eventual divulgação. 
                    </p>
                    <br/>
                    <br/>
                    <p class="text-center"> {{$dataExtenso}}</p>
                 
                    <br/>
                    <br/>
                    <p class="text-center">{{$usuario->name}}</p> 
                    <p class="text-center"><small> Responsável</small> </p>  
                    <br/>
                    <br/><br/>
                    <br/>
        </div><!-- fechar primeiro form-group-->

  
    

    @if(Auth::user()->bln_aceite_termo)
    <div class="form-group">
                <a type="submit"  class="btn btn-danger btn-lg btn-block"  href='{{ url("/entePublico")}}'>Fechar</a>
            </div><!-- fechar quarto form-group--> 
    @else
   

            <div class="form-group">
            <div class="checkbox">
                <label>
                <input type="checkbox" name="termo" value="true" required>  Declaro que li e estou de acordo com o disposto nos normativos vigentes do Programa.
                </label>
            </div>   
        </div><!-- fechar segundo form-group-->

            <div class="form-group">
                <button type="submit"  class="btn btn-primary btn-lg btn-block">Aceitar</button>
            </div><!-- fechar quarto form-group-->
    @endif
        </form>

    </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection