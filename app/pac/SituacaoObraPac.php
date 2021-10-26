<?php

namespace App\pac;

use Illuminate\Database\Eloquent\Model;

class SituacaoObraPac extends Model
{
    protected $table = 'opc_situacao_obra_pac';
    
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function dadosObras()
    {
       return $this->hasMany(DadosObras::class); //possui muitos
    }

}
