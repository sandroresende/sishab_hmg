<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Selecao;
use App\Modalidade;
use App\User;

class SelecaoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $selecoes = Selecao::orderBy('dte_portaria_resultado')->get();
        $selecoes->load("modalidade");

        $tituloTopo = 'Propostas Apresentadas';
        $menuAtivo = 'selecao';
        

        return view('selecao.selecao',compact('selecoes','tituloTopo','menuAtivo','submenuSelecionado'));
    }

    public function selecaoConsulta()
    {
        $selecoes = Selecao::where('num_ano_selecao', 2018)->orderBy('dte_portaria_resultado')->get();
        $selecoes->load("modalidade");

        

        return view('selecao.selecaoConsulta',compact('selecoes'));
    }
}

