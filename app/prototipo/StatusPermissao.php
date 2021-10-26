<?php

namespace App\prototipo;

use Illuminate\Database\Eloquent\Model;

class StatusPermissao extends Model
{
    protected $table = 'opc_status_permissao';

    public function permissao()
    {
       return $this->belongsTo(Permissoes::class); //possui muitos
    }

       
    
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
