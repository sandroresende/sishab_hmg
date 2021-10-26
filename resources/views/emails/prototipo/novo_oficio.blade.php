@component('mail::message')
# Novo Ofício

<p>Prezados,</p>
<p>Um usuário acabou de enviar um novo ofício no <strong>SISHAB</strong> para representar o <b>{{ $usuario->entePublicoProponente->txt_ente_publico }}</b>. Por favor analise a permissão do usuário.</p>

<p>Dados do Usuário:</p>
<ul>
    <li><b>Nome:</b> {{ $usuario->nome }} {{ $usuario->sobrenome }}</li>
    <li><b>Email:</b> {{ $usuario->email }}</li>
    <li><b>CPF:</b> {{ $usuario->txt_cpf_usuario }}</li>
    <li><b>Cargo:</b> {{ $usuario->txt_cargo }}</li>
    <li><b>Telefone:</b> ({{ $usuario->txt_ddd_fixo }}) {{ $usuario->txt_telefone_fixo }}</li>
    <li><b>Celular:</b> ({{ $usuario->txt_ddd_movel }}) {{ $usuario->txt_telefone_movel }}</li>
    <li><b>Oficio:</b> <a href="{{ url('') . $permissao->caminho_oficio }}" download>Visualizar</a></li>
</ul>


@component('mail::button', ['url' => $url])
Analisar Permissão
@endcomponent


<hr>
<p><small>Se estiver com dificuldade para clicar no link, copie e cole esta url no seu browser: <a href="{{ $url }}">{{ $url }}</a></small></p>
@endcomponent
