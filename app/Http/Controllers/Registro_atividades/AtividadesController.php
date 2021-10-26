<?php

namespace App\Http\Controllers\Registro_atividades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class Atividades extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    

    
    public function consultaAtividades(){
        
        return view('registro_atividades.consultaAtividadesRealizadas');
    }

    
    
}        