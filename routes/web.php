<?php

use App\Http\Controllers\ContatoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;

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

Route::get('/', [PrincipalController::class, 'principal'])->name('site.index');
Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');
Route::get('/sobrenos', [SobreNosController::class, 'sobrenos'])->name('site.sobrenos');
Route::get('/login', function(){
    return 'Login';
})->name('site.login');


//agrupando rotas pelo prefixo route
Route::prefix('/app')->group(function(){
    
    
    Route::get('/clientes', function(){
        return 'Clientes';
    })->name('app.clientes');
    
    Route::get('/fornecedores', function(){
        return 'Fornecedores';
    })->name('app.fornecedores');
    
    Route::get('/produtos', function(){
        return 'Produtos';
    })->name('app.produtos');
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