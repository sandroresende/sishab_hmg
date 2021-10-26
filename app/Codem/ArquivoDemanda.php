<?php

namespace App\Codem;

use Illuminate\Database\Eloquent\Model;

class ArquivoDemanda extends Model
{

    protected $table = 'tab_arquivo_demandas';

    

    protected $fillable = [
        'demanda_id', 
        'txt_nome_arquivo', 
        'txt_caminho_arquivo', 
        'tipo_arquivo_id'
    ];

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function tipo_arquivo()
    {
       return $this->belongsTo(TipoArquivo::class); //possui muitos
    }
}
