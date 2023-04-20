<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
use App\Models\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato(Request $request){

    
        $motivo_contatos = MotivoContato::all();

        /*$contato = new SiteContato();
        $contato->nome = $request->input('nome');
        $contato->telefone = $request->input('telefone');
        $contato->motivo_contato = $request->input('motivo_contato');
        $contato->mensagem = $request->input('mensagem');*/

        //$contato->save();

        //$contato->fill($request->all());

        return view('site.contato', 
        [
                'motivo_contatos' => $motivo_contatos,
                'titulo' => 'Contato'
            ]);
    }

    public function salvar(Request $request){

        //realizar validação
        $request->validate([
            'nome' => 'required|min:3|max:40|unique:site_contatos,nome', //deve ter entre 3 a 40 caracteres e deve ser unico
            'telefone' => 'required', 
            'motivo_contatos_id' => 'required', 
            'email' => 'email',
            'mensagem' => 'required'
        ]);

        SiteContato::create($request->all());

        return redirect()->route('site.index');
    }
}
