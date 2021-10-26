<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    protected $connection	= 'pgsql_bv';
    
    protected $table = 'tab_beneficiarios';

    public function genero()
    {
       return $this->belongsTo(Genero::class); 
    }

    public function generoConjuge()
    {
       return $this->belongsTo(Genero::class,'genero_conjuge_id','id'); 
    }

    public function estadoCivil()
    {
       return $this->belongsTo(EstadoCivil::class); 
    }



    
		public function notasPagamentoRemessaDevolucao()
	    {
	       return $this->belongsTo(NotasPagamentoRemessaDevolucao::class, 'id','beneficiario_id'); //possui muitos
	    }
}
