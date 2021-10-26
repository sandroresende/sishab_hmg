<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumoStatusSnh extends Model
{
    protected $table = 'view_resumo_status_snh';

    public function municipio()
    {
       return $this->belongsTo(Municipio::class); //possui muitos
    }
    
}
