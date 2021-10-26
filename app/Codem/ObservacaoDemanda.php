<?php

namespace App\Codem;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ObservacaoDemanda extends Model
{

    protected $table = 'tab_observacao_demanda';

    protected $fillable = [
        'demanda_id', 
        'user_id',
        'dte_observacao',
        'txt_observacao',
        'created_at',
        'updated_at'
    ];

    public function users()
    {
       return $this->hasMany(User::class); //possui muitos
    }

    
}
