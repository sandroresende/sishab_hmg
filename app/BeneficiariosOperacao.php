<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeneficiariosOperacao extends Model
{
    protected $table = 'view_beneficiarios';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function genero()
    {
       return $this->belongsTo(Genero::class); //possui muitos
    }    

}
