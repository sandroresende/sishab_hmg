<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'tab_municipios';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function notasPagamentoRemessaDevolucao()
	    {
	       return $this->belongsTo(NotasPagamentoRemessaDevolucao::class,  'id', 'id_municipio'); //possui muitos
        }
        
    public function uf()
    {
       return $this->belongsTo(Uf::class); //possui muitos
    }   
    
    public function executivoPj()
    {
       return $this->belongsTo(ExecutivoPj::class); //possui muitos
    } 

    public function operacoes_retomadas()
    {
       return $this->hasMany(OperacaoRetomada::class); //possui muitos
    } 

    public function resumoOperacoes()
    {
       return $this->hasMany(ResumoOperacao::class); //possui muitos
    } 

    public function resumoStatusRetomadas()
    {
       return $this->hasMany(ResumoStatusRetomada::class); //possui muitos
    }

    public function resumoStatusSnhs()
    {
       return $this->hasMany(ResumoStatusSnh::class); //possui muitos
    }  

    public function dadosArquivoEntePublico()
    {
       return $this->hasMany(DadosArquivoEntePublico::class); //possui muitos
    } 

    public function entePublico()
    {
       return $this->belongsTo(EntePublico::class); //possui muitos
    }
 
}
