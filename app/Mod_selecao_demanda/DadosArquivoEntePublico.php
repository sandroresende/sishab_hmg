<?php

namespace App\Mod_selecao_demanda;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\IndicadoresHabitacionais\Municipio;

class DadosArquivoEntePublico extends Model
{
    protected $table = 'tab_dados_arquivo_ente_publico';

   
    public function tipoArquivo()
    {
       return $this->belongsTo(TipoArquivo::class); //possui muitos
    } 

    public function user()
    {
       return $this->belongsTo(User::class); //possui muitos
    }

    public function entePublico()
    {
       return $this->belongsTo(EntePublico::class); //possui muitos
    }
       
    public function municipio()
    {
       return $this->belongsTo(Municipio::class); //possui muitos
    }
    
   // public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
