
<div class="form-group">               
    <div class="titulo">
        <h3>Dados do Usuário </h3> 
        
    </div>
    

           
                <div class="row">
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Status</label>
                        <input id="txt_status_usuario" type="text" class="form-control input-relatorio" name="txt_status_usuario" value="{{empty(old('txt_status_usuario')) ? $usuario->statusUsuario->txt_status_usuario : old('txt_status_usuario')}}" disabled>
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        
                    </div>
                    
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Tipo Usuário</label>
                        <input id="txt_tipo_usuario" type="text" class="form-control input-relatorio" name="txt_tipo_usuario" value="{{empty(old('txt_tipo_usuario')) ? $usuario->tipoUsuario->txt_tipo_usuario : old('txt_tipo_usuario')}}"  disabled>
                    </div>
                        
                </div>
         
           
                <div class="row">
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">CPF</label>
                        <input id="txt_cpf_usuario" type="text" class="form-control input-relatorio" name="txt_cpf_usuario" value="{{empty(old('txt_cpf_usuario')) ? $usuario->txt_cpf_usuario : old('txt_cpf_usuario')}}" disabled>
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <label class="control-label label-relatorio">Nome</label>
                        <input id="txt_nome" type="text" class="form-control input-relatorio" name="txt_nome" value="{{empty(old('txt_nome')) ? $usuario->name : old('txt_nome')}}"  disabled>
                    </div>
                    
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Cargo</label>
                        <input id="txt_cargo" type="text" class="form-control input-relatorio" name="txt_cargo" value="{{empty(old('txt_cargo')) ? $usuario->txt_cargo : old('txt_cargo')}}"  disabled>
                    </div>
                        
                </div>
            
                <div class="row">
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Email</label>
                        <input id="email" type="text" class="form-control input-relatorio" name="email" value="{{empty(old('email')) ? $usuario->email : old('email')}}"  disabled>
                    </div>
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">DDD</label>
                        <input id="txt_ddd_telefone" type="text" maxlength="2" class="form-control input-relatorio" name="txt_ddd_telefone" value="{{empty(old('txt_ddd_telefone')) ? $usuario->txt_ddd_telefone : old('txt_ddd_telefone')}}"  disabled>
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Telefone</label>
                        <input id="txt_telefone" type="text" maxlength="9" class="form-control input-relatorio" name="txt_telefone" value="{{empty($usuario->txt_telefone) ? old('txt_telefone'): $usuario->txt_telefone}}"  disabled>
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Atualizado em</label>
                        <input id="updated_at" type="text" maxlength="9" class="form-control input-relatorio" name="updated_at" value="{{empty($usuario->updated_at->format('d/m/Y')) ? old('updated_at'): $usuario->updated_at->format('d/m/Y')}}" disabled >
                    </div>  
                </div>
           
</div>   




