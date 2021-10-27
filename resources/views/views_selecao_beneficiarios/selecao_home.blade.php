
@extends('layouts.app') 

@section('scripts')

<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet"> 
@endsection 

@section('content')
<div id="content">
    <div id="content-core">    
        <div class="row">
            <div class="row-content">
                <div class="column col-md-12" data-panel="">
                    <div class="tile tile-default" id="fbda622f-0009-4d19-99b0-87f2900529e9">
                        <div class="cover-banner-tile tile-content">
                            <img
                                src='{{ URL::asset("/img/selecao/folder_selecao_beneficiarios.png")}}'
                                width="1150"
                                height="200"
                                class="left"
                                alt=""
                            />
    
                            <div class="visualClear"><!-- --></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        
        
    </div><!-- content-core-->

</div><!-- content-->



@endsection