@component('mail::message')
# Arquivo Enviado

<p>Prezado(a) {{ $dadosAdesao->txt_nome_usuario }} {{ $dadosAdesao->txt_sobrenome_usuario }},</p>
<p>A Manifestação de Interesse n° {{ $dadosAdesao->txt_protocolo_aceite }} foi enviado para análise.  Favor aguardar a validação dos dados. </p>

@component('mail::button', ['url' => $url])
Acessar SISHAB
@endcomponent

Atenciosamente,<br>
<strong>Secretaria Nacional de Habitação</strong>
<strong>Ministério do Desenvolvimento Regional - MDR</strong>

<hr>
<p><small>Se estiver com dificuldade para clicar no link, copie e cole esta url no seu browser: <a href="{{ $url }}">{{ $url }}</a></small></p>
@endcomponent
