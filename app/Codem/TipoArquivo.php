<?php

namespace App\Codem;

use Illuminate\Database\Eloquent\Model;

class TipoArquivo extends Model
{

    protected $table = 'opc_tipo_arquivos';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function arquivo_demandas()
    {
       return $this->hasMany(ArquivoDemanda::class,'tipo_arquivo_id','id'); //possui muitos
    }
    
}
