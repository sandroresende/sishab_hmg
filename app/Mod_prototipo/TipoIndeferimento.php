<?php

namespace App\Mod_prototipo;

use Illuminate\Database\Eloquent\Model;

class TipoIndeferimento extends Model
{
    protected $table = 'opc_tipo_indeferimento';

    public function permissao()
    {
       return $this->belongsTo(Permissoes::class); //possui muitos
    }

       
    
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
