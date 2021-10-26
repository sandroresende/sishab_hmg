<?php

namespace App\Codem;

use Illuminate\Database\Eloquent\Model;

class DocumentosDemanda extends Model
{

    protected $table = 'tab_documento_demanda';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    protected $fillable = [
        'demanda_id', 
        'txt_documento', 
        'txt_descricao_documento', 
        'tipo_documento_id', 
        'num_sei', 
        'user_id'
    ];

    
}
