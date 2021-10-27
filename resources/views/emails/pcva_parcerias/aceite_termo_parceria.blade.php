@component('mail::message')
# Arquivo Enviado

<p>Prezado(a) {{$entePublicoParcerias->txt_nome_chefe_executivo}}, {{$entePublicoParcerias->txt_cargo_executivo}} do </p>
<p> {{$entePublicoParcerias->txt_ente_publico}}</p>

<p>Confirmamos que o formulário para participar do Programa Casa Verde e Amarela – Parcerias, preenchido por Vossa Senhoria sob o protocolo nº <a href="{{ $urlProtocolo }}"> {{ $dadosParceria->txt_protocolo_aceite }} </a>, 
    foi registrado com sucesso conforme dados constantes na Manifestação de Interesse.
</p>
<p>
Para continuidade do processo, solicitamos que o <a href="{{ $urlProtocolo }}">referido documento </a>seja assinado pelo chefe do poder Executivo, ou representante por ele designado, e enviado pela 
página <a href="{{ $url }}">{{ $url }}</a>, para validação.
</p>


@component('mail::button', ['url' => $url])
Acessar SISHAB
@endcomponent

Atenciosamente,<br>
<strong>Secretaria Nacional de Habitação (SNH)</strong>
<strong>Ministério do Desenvolvimento Regional - MDR</strong>

<hr>
<p><small>Se estiver com dificuldade para clicar no link, copie e cole esta url no seu browser: <a href="{{ $url }}">{{ $url }}</a></small></p>
@endcomponent
