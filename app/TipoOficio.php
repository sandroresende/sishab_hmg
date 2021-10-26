<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoOficio extends Model
{
    protected $table = 'opc_tipo_oficio';

    public function oficios()
    {
       return $this->hasMany(Oficio::class); //possui muitos
    }
}
