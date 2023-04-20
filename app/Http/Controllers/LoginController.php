<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request){

        $erro = '';

        if($request->erro == 1){
            $erro = 'Usuário e/ou senha não existe';
        }else if($request->erro == 2){
            $erro = 'Necessário realizar login para ter acesso a página';
        }

        return view('site.login', 
                    [
                            'titulo' => 'Login', 
                            'erro' => $erro
                           ]);
    }

    public function autenticar(Request $request){

        //regras de validação
        $regras = [
            'usuario' => 'email', 
            'senha' => 'required'
        ];

        $request->validate($regras);
        
        $email = $request->input('usuario');
        $password = $request->input('senha');

        $user = new User();
        $existe = $user->where('email', $email)->where('password', $password)->get();
        $existe = $existe->first();

        if(isset($existe)){
            session()->push('email', $email);
            session()->push('senha', $password);
        }else{
            return redirect()->route('site.login', ['erro' => 1]);
        }

        //echo "<pre>$existe</pre>";
    }
}
