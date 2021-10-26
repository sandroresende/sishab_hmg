<?php

namespace App\Http\Controllers\codem;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ResponsavelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function store(Request $request)
    {  
        return $request->all();  
    }
}    