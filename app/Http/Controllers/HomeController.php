<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function criarSorteio()
    {
        return view('create');
    }

    public function gerenciar()
    {
        return view('gerenciar');
    }

    public function sorteio(Request $nSorteio){
        return view('sorteio', $nSorteio);

    }
}
