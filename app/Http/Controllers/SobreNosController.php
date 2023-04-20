<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LogAcessoMiddleware;
use Illuminate\Http\Request;

class SobreNosController extends Controller
{
    //Adicionando um middleware diretamente pelo construtor do controlador
    /*public function __construct(){
        $this->middleware(LogAcessoMiddleware::class);
    }*/
    public function sobrenos(){
        return view('site.sobrenos', ['titulo'=> 'Sobre Nós']);
    }
}
