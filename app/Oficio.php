<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficio extends Model
{
    protected $table = 'tab_oficio';

    public function retomadas()
    {
       return $this->belongsToMany(Retomada::class,'tab_oficio_retomada'); //possui muitos
    }

    public function tipo_oficio()
    {
       return $this->belongsTo(TipoOficio::class); 
    }

    public function oficiosRetomadas()
    {
       return $this->belongsToMany(OficioRetomada::class,'oficio_id','id'); //possui muitos
    }
}
