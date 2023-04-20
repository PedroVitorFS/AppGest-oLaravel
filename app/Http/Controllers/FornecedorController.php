<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index(){
        $fornecedores = Fornecedor::all();
        return view('app.fornecedor.index', compact('fornecedores'));
    }
}
