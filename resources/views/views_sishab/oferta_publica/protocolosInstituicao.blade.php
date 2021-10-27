@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection


@section('content')

  
    <div id="content"> 
        <historico-navegacao
                :url="'{{ url('/home') }}'"
                :titulo1="'Oferta Pública'"
                :titulo2='"Filtro aos Protocolos das Instituições"'
                :link2="'{{ url('/oferta_publica/protocolos/instituicao/filtro') }}'"
                :titulo3='"Protocolos"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'PROTOCOLOS'"
                    subtitulo1="{{$instituicao->txt_nome_if}} "
                    :barracompartilhar="true"    
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/oferta_publica/protocolos/instituicao/$instituicao->id") }}'">
            </cabecalho-form> 
        <div id="content-core"> 
            <div class="form-group">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead  id="myHeader" class="text-center">
                            <tr  class="text-center">
                            <th>UF</th>  
                            <th>Município</th>  
                            <th>Protocolo</th>                          
                            <th>Cont.</th>  
                            <th>And.</th>  
                            <th>Conc.</th>           
                            <th>Ent.</th>         
                            <th>Dev.</th>         
                            <th>Inv.</th>
                            <th>A dev.</th>
                            <th>%</th>  
                            <th>Situação</th>       
                            </tr>
                        </thead>
                        <tbody>      
                        <?php $count = 0 ?>
                        @foreach($protocolos as $protocolo) 
                                <tr class="text-center conteudoTabela">          
                                    <td>{{$protocolo->sg_uf}}</td>                                    
                                    <td>{{$protocolo->ds_municipio}}</td>                                    
                                    <td>
                                        <a href='{{ url("oferta_publica/protocolo/$instituicao->id/$protocolo->protocolo_id") }}'>{{$protocolo->txt_protocolo}}</a>
                                    </td>                                  
                                    <td>{{$protocolo->total_uh}}</td>                                    
                                    <td>{{$protocolo->total_andamento}}</td>  
                                    <td>{{$protocolo->total_concluidas}}</td>                                    
                                    <td>{{$protocolo->total_entregues}}</td>                                                                                                  
                                    <td>{{$protocolo->total_devolvidas}}</td>      
                                    <td>{{$protocolo->total_obra_inviavel}}</td>      
                                    <td>
                                    
                                        @if(($protocolo->total_obra_inviavel>0) && ($protocolo->total_inviavies_devolvidas<$protocolo->total_obra_inviavel))
        
                                            {{$protocolo->total_obra_inviavel-$protocolo->total_inviavies_devolvidas}}
                                        @else
                                            0
                                        @endif
                                    </td>      
                                    
                                    <td>
                                        @if($protocolo->media_percentual <= 100)
                                            @if(($protocolo->total_entregues + $protocolo->total_devolvidas) == $protocolo->total_uh)
                                                100,00
                                            @else
                                                {{number_format($protocolo->media_percentual, 2, ',' , '.')}}
                                            @endif
                                        @else
                                            {{number_format($protocolo->media_percentual, 2, ',' , '.')}} 
                                        @endif    
                                    
                                    </td>     
                                    <td>
                                        @if($protocolo->media_percentual == 100)  
                                            @if($protocolo->total_entregues == $protocolo->total_uh)
                                                <span class="badge badge-success">Encerrada</span>
                                            @else
                                                <span class="badge badge-warning">Ativo P3</span> 
                                            @endif
                                        @elseif(($protocolo->total_devolvidas) == $protocolo->total_uh)
                                            <span class="badge badge-success">Encerrada</span>
                                        @elseif(($protocolo->total_entregues + $protocolo->total_devolvidas) == $protocolo->total_uh)
                                            <span class="badge badge-success">Encerrada</span>
                                        @else  
                                            @if($protocolo->total_devolvidas < $protocolo->total_inviavies_devolvidas)
                                                <span class="badge badge-warning">Ativo P2</span>    
                                            @elseif(($protocolo->total_obra_inviavel>0) && ($protocolo->total_inviavies_devolvidas<$protocolo->total_obra_inviavel))    
                                                <span class="badge badge-danger">Ativo P1</span>    
                                            @elseif(($protocolo->total_entregues + $protocolo->total_concluidas) == $protocolo->total_uh)
                                                <span class="badge badge-danger">Ativo P1</span>
                                            @elseif(($protocolo->total_entregues + $protocolo->total_concluidas + $protocolo->total_devolvidas) == $protocolo->total_uh)
                                                <span class="badge badge-danger">Ativo P1</span>
                                            @elseif(($protocolo->total_andamento + $protocolo->total_entregues) == $protocolo->total_uh)
                                                <span class="badge badge-indigo">Ativo P2</span>
                                            @elseif(($protocolo->total_andamento + $protocolo->total_entregues + $protocolo->total_devolvidas) == $protocolo->total_uh)
                                                <span class="badge badge-indigo">Ativo P2</span>                                        
                                            @else
                                                <span class="badge badge-warning">Ativo P3</span>                                       
                                            @endif                              
                                            
                                        @endif 
                                    <t/d>    
                                </tr>
                        @endforeach                           
                    
                            </tbody>
                        </table> 
                    </div>
    
            </div><!-- fechar form-group-->  
            
      
    

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



    </modal-form>    


</div>    
<!-- content -->
@endsection


