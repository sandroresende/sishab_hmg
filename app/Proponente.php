<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proponente extends Model
{
    protected $table = 'tab_proponente';

    public function propostas()
    {
       return $this->hasMany(Propostas::class); //possui muitos
    }

 }
