@extends('layouts.app')

@section('content')
<section>
  <div class="container-fluid">    
    </header>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header text-white text-center">
            <strong><h2>Limites Município</h2></strong> 
            <h5>Selecione os dados para realização do filtro.</h5>              
          </div>
          
          <div class="card-body section-padding">
          
           <!-- form-group-->              
               <div class="form-group">
               <form action="{{ url('executivo/limite/ibge') }}" method="POST">
                    @csrf
                    <div class="well">
                        <div class="box">                                                                                 
                            <select-uf-municipio :url="'{{ url('/') }}'"></select-uf-municipio>
                        </div>
                    </div>    
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Pesquisar</button>
                </form> 
              <!--form-group -->
          
          </div>
        </div>
      </div>   
    </div>
  </div>       
</section>
@endsection
