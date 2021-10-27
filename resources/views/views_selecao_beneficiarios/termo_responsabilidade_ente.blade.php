@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection

@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
            :url="'{{ url('/selecao_beneficiarios') }}'"
            :titulo1="'Seleção de Beneficiários'"
            :titulo2='"Termo de Compromisso"'
            >
            </historico-navegacao>  
            <cabecalho-form
            :titulo="'Termo de Compromisso de Manutenção de Sigilo'"
            subtitulo1="{{$ente->txt_ente_publico}}"
            subtitulo2="{{$municipio->ds_municipio}}-{{$municipio->txt_sigla_uf}}"
            @if($usuario->dte_aceite_termo)
                :dataatualizacao="'{{date('d/m/Y',strtotime($usuario->dte_aceite_termo))}}'"
            @else
                :dataatualizacao="'{{date('d/m/Y',strtotime($usuario->created_at))}}'"
            @endif
            :barracompartilhar="true"
                    >
                        
            </cabecalho-form> 

            <form class="form-horizontal" role="form" method="POST" action='{{ url("/selecao_beneficiarios/termo_aceite") }}'>
        
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
                        <a type="submit"  class="btn btn-danger btn-lg btn-block"  href='{{ url("/selecao_beneficiarios")}}'>Fechar</a>
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
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


