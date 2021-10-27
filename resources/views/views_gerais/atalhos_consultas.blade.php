<div id="content">
    <div id="viewlet-above-content-title"></div>    
    <h1 class="documentFirstHeading text-center"></h1>    
    <div id="viewlet-below-content-title"><h2 class="text-center">PESQUISAS RÁPIDAS</h2></div>
    <div class="titulo-linha-cinza text-center">
        <h3>POR APF</h3>
    </div>
    <div class="container-fluid">
        <div class="form-group row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <form action="{{ url('empreendimentos/consulta') }}" method="POST">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons fas fa-home"></i>                
                            </div>
                            <p class="card-category">Empreendimento</p>                
                            @csrf               
                            <small>Digite o APF sem os zeros a esquerda e sem caracteres especiais</small>                
                        </div>
                        <div class="card-footer">
                            <div class="input-group mb-4">
                                <input type="text" class="form-control" placeholder="Ex.: 1254863" aria-label="Ex.: 1254863" aria-describedby="basic-addon2" id="num_apf" name="num_apf">
                                <div class="input-group-append">
                                <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <div class="stats">                    
                                
                            </div>
                        </div>            
                    </form> 
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <form action="{{ url('/medicoes/situacao/pagamentos') }}" method="POST">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons fas  fa-hand-holding-usd"></i>                
                            </div>
                            <p class="card-category">Medições Obras</p>                
                            @csrf               
                            <small>Digite o APF sem os zeros a esquerda e sem caracteres especiais</small>                
                        </div>
                        <div class="card-footer">
                            <div class="input-group mb-4">
                                <input type="text" class="form-control" placeholder="Ex.: 1254863" aria-label="Ex.: 1254863" aria-describedby="basic-addon2" id="num_apf" name="num_apf">
                                <div class="input-group-append">
                                <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <div class="stats">                    
                                
                            </div>
                        </div>            
                    </form> 
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <form action="{{ url('/proposta/apf') }}" method="POST">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                               <i class="material-icons fas fa-file-contract"></i>                
                            </div>
                            <p class="card-category">Propostas Apresentadas</p>                
                            @csrf               
                            <small>Digite o APF sem os zeros a esquerda e sem caracteres especiais</small>                
                        </div>
                        <div class="card-footer">
                            <div class="input-group mb-4">
                                <input type="text" class="form-control" placeholder="Ex.: 1254863" aria-label="Ex.: 1254863" aria-describedby="basic-addon2" id="num_apf" name="num_apf">
                                <div class="input-group-append">
                                <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <div class="stats">                    
                                
                            </div>
                        </div>            
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
