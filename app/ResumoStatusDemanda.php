<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumoStatusDemanda extends Model
{
    protected $table = 'view_resumo_status_demanda';

    public function municipio()
    {
       return $this->belongsTo(Municipio::class); //possui muitos
    }
    
}
