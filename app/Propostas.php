<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propostas extends Model
{
    protected $table = 'tab_propostas';

    public function selecao()
    {
       return $this->belongsTo(Selecao::class); //possui muitos
    }

    public function proponente()
    {
       return $this->belongsTo(Proponente::class); //possui muitos
    }
 


 }
