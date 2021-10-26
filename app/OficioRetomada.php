<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OficioRetomada extends Model
{
    protected $table = 'tab_oficio_retomada';

    public function oficios()
    {
       return $this->hasMany(Oficio::class,'id','oficio_id'); //possui muitos
    }
}
