<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\TesteController;
use App\Http\Middleware\LogAcessoMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//o comando name permite utilizar o nome da rota por exemplo site.index sem precisar utilizar-se do prefixo absoluto de '/' por exemplo

Route::get('/', [PrincipalController::class, 'principal'])
       // ->middleware(LogAcessoMiddleware::class)
        ->name('site.index');
       
Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');
Route::post('/contato', [ContatoController::class, 'salvar'])->name('site.contato');
Route::get('/sobrenos', [SobreNosController::class, 'sobrenos'])->name('site.sobrenos');
Route::get('/login/{erro?}', [LoginController::class, 'index'])->name('site.login');
Route::post('/login', [LoginController::class, 'autenticar'])->name('site.login');


//agrupando rotas pelo prefixo route
Route::prefix('/app')->group(function(){   

    Route::get('/home',[HomeController::class, 'index'])
    ->name('app.home');

    Route::get('/sair', [LoginController::class, 'sair'])
    ->name('app.sair');

    Route::get('/cliente', [ClienteController::class, 'index'])
    ->name('app.cliente');
    
    Route::get('/fornecedor', [FornecedorController::class, 'index'])
    ->name('app.fornecedor');

    Route::get('/fornecedor/listar', [FornecedorController::class, 'listar'])
    ->name('app.fornecedor.listar');

    Route::get('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])
    ->name('app.fornecedor.adicionar');

    Route::post('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])
    ->name('app.fornecedor.adicionar');

    Route::get('/fornecedor/editar/{id}', [FornecedorController::class, 'editar'])
    ->name('app.fornecedor.editar');
    
    Route::get('/produto', [ProdutoController::class, 'index'])
    ->name('app.produto');
    
})->middleware('autenticacao:padrao,visitante');//passando um parâmetro para um respectivo middleware


//redirecionando rotas
Route::get('/rota1', function(){
    echo 'Rota 1';
})->name('site.rota1');
Route::get('/rota2', function(){
    return redirect()->route('site.rota1');
})->name('site.rota2');
//Route::redirect('/rota2', 'rota1');

//Encaminhando parâmetros para o controlador
Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('teste');

//Caso a página não seja encontrada, será redirecionado para a rota de contingência
Route::fallback(function(){
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">clique aqui</a> para ir para a página inicial';
});



/*
Route::get(
    '/contato/{nome}/{categoria_id}', 
    function(
        string $nome = 'Desconhecido',
        int $categoria_id = 1
    ){
        echo "Estamos aqui: $nome - $categoria_id";
    }
)
->where('categoria_id', '[0-9]+') //passar o parâmetro de categoria como sendo números entre 0 e 9
->where('nome', '[A-Za-z]+') ; //passar o parâmetro de nome que seja apenas letras */