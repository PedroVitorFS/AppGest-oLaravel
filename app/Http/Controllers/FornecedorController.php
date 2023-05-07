<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index(){
        return view('app.fornecedor.index');
    }

    public function listar(Request $request){

        $fornecedores = Fornecedor::where('nome', 'like', "%" . $request->input('nome') ?? "". "%")
                                                 ->where('site', 'like',"%" . $request->input('site' ) ?? "" . "%")
                                                 ->where('uf', 'like',"%". $request->input('uf') ?? "" ."%")
                                                 ->where('email', 'like', "%" . $request->input('email') ?? "" . "%")
                                                 ->orderBy('nome', 'asc')
                                                 ->paginate(4);

        //dd( Fornecedor::all());
        
        return view('app.fornecedor.listar', 
        ['fornecedores' => $fornecedores, 'request' => $request->all()]
        );
    }

    public function adicionar(Request $request){


        $msg = '';

        //inclusão
        if($request->input('_token') != '' &&  $request->input('id') == ''){
            $regras  = [
                'nome' => 'required|min:3|max:40', 
                'site' => 'required' , 
                'uf' => 'required|min:2|max:2', 
                'email' => 'email'
            ];

            $request->validate($regras);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            $msg = 'Cadastro realizado com sucesso';
        //edição    
        }else if($request->input('_token') != '' &&  $request->input('id') != ''){
            $fornecedor = Fornecedor::find($request->input('id'));
            $fornecedor->update($request->all());

            $msg = 'Atualização realizada com sucesso';

            return redirect()
                        ->route(
                            'app.fornecedor.editar',
                            ['id' => $request->input('id'), 'msg' => $msg]
                         ); //retornar o request a paginação e atualiza o fornecedor atualizado
        }
        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = ''){
        $fornecedor = Fornecedor::find($id);

        return view(
                'app.fornecedor.adicionar', 
                ['fornecedor'=> $fornecedor, 'msg' => $msg]
            );
    }

    public function excluir($id){
        Fornecedor::find($id)->delete();//soft delete

        return redirect()->route('app.fornecedor');
    }
}
