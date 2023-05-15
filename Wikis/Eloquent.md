# Utilizando o Eloquent
Para termos acesso utilizaremo o Tinker.

O Tinker é uma ferramenta nativa do framework Laravel. O Tinker é um console que possibilita o acesso as classes do projeto através de linhas de comando 

Para acessa-lo entre no terminal e digite `php artisan tinker`

Através do Tinker podemos manipular as classes relativas aos Models do projeto, podemos por exemplo, estanciar essas classes e executar os métodos dos objetos estanciados e claro os métodos estáticos também. Mas mais que isso, através do Tinker nós podemos testar o mapeamento objeto relacional entre as classes relativas aos models do nosso projeto e o banco de dados relacional.

Num ambiente sem o tinker seria necessário realizar os testes do Models e também entre os models e o banco de dados diretamente na aplicação através da construção prévia de uma interface web ou de um script para este propósito.

## Eloquent - Selecionando registros com find()
O método de busca find() espera como parâmetro a primary key

Exemplo: 

`$fornecedores = Fornecedores::find(1); `

`$fornecedores = Fornecedores::find([1,2]); `


## Eloquent - Selecionando registros com where()
O método de busca where() diferente dos métodos all() e find() é na verdade um construtor. Ele permite que diversos outros métodos sejam utilizados em conjunto para construir a query adequada para seleção dos registros no banco.

Neste métodos podemos usar vários métodos de comparação. Estes conjuntos de operação podem ser conectados por conjuntos lógicos. Dentre os operadores estão estes: 

* Maior >
* Maior ou igual =>
* Menor <
* Menor ou igual <=
* Like

Exemplo:

```
use \App\Models\SiteContato;
//fazendo a busca de id maior que 1
$contatos = SiteContato::where('id', '>', 1)->get();

//Trazendo todos os registros cujo nome seja diferente de Maria
$contatos = SiteContato::where('nome', '<>', 'Maria')->get();


//Trazendo os registros onde tenha a palavra detalhes em mensagens
//o % pode ser utilizado para verificar se pode ter algo a direita(no final) 
//a esquerda (no começo) ou entre os dois (no começo e no final)
$contatos = SiteContato::whre('mensagem', 'like', '%detalhes')->get();//no final 
$contatos = SiteContato::whre('mensagem', 'like', 'detalhes%')->get();//no começo
$contatos = SiteContato::whre('mensagem', 'like', '%detalhes%')->get();//em qualquer lugar
```

## Eloquent - Selecionando registros com whereIn() e whereNotIn()
O método de busca whereIn() realiza a busca em que os parâmetros seja um ou outro. Por exemplo realizar a busca de que o motivo_contato seja 1 ou 3:

```
use \App\Models\SiteContato;

$contatos = SiteContato::whereIn('motivo_contato', [1,3])->get(); //o IN e NotIn suportam comparações com valores numéricos, strings e datas
```

O método de busca whereNotIn() realiza a busca em que os parâmetros sejam diferentes. Por exemplo realizando uma busca onde os registros de motivo_contato seja diferente de 1 e 3:

```
use \App\Models\SiteContato;

$contatos = SiteContato::whereNotIn('motivo_contato', [1,3])->get(); //o IN e NotIn suportam comparações com valores numéricos, strings e datas
```

## Eloquent - Selecionamento registros com whereBetween() e whereNotBetween()
O método de busca whereBetween() realiza a busca em que os parâmetros seja um intervalo de valores. Por exemplo realziar a busca de que mutivo contato esteja entre 1 e 4:

```
use \App\Models\SiteContato;

$contatos = SiteContato::whereBetween('motivo_contato', [1,4])->get();
```

Já o metodo de busca whereNotBetween() retorna todos os valores que não estão entre aquele intervalo

## Eloquent - Selecionando registros com dois ou mais Wheres
Suponhamos que queiramos utilizar where com vários filtros. Por exemplo que site_contatos tem nomes diferentes de Fernando, motivo_contato seja 1 ou 3 e data criada esteja entre 08-01-2020 e 31-08-2020:

``` 
use \App\Models\SiteContato;


$contatos = SiteContato::where('nome', '<>', 'Fernando')
                        ->whereIn('motivo_contato', [1,3])
                        ->whereBetween('created_at', ['2020-08-01 00:00:00', '2020-08-31 23:59:59'])->get();
```

O operador lógico que está sendo utilizando nestes wheres é o operador `and`

## Eloquent - Selecionando registros com orWhere()
Suponhamos que queiramos  utilizar uma busca no banco na tabela site_contatos onde o nome seja diferente de Fernando, ou motivo_contato seja 1 ou 3 ou a data criada esteja entre 08-01-2020 e 31-08-2020:

``` 
use \App\Models\SiteContato;


$contatos = SiteContato::where('nome', '<>', 'Fernando')
                        ->orWhereIn('motivo_contato', [1,3])
                        ->orWhereBetween('created_at', ['2020-08-01 00:00:00', '2020-08-31 23:59:59'])->get();
```

## Eloquent - Selecionando registros com whereNull() e whereNotNull()
Estes métodos de busca levam em consideração a existência do valor `null` dentro uma determinada coluna. Suponhamos que queiramos buscar o registro na tabela site_contatos onde a coluna update_at possua valor `null`:

``` 
use \App\Models\SiteContato;

$contatos = SiteContato::whereNull('updated_at')->get();
```

Para buscarmos registros na tabela onde retorne valores que não são nulos na coluna updated_at podemos utilizar o método WhereNotNull()

``` 
use \App\Models\SiteContato;

$contatos = SiteContato::whereNotNull('updated_at')->get();
```

## Eloquent - Selecionando registros com base em parâmetros do tipo data e hora
> O tipo de coluna deve ser do tipo date o timestamp

Digamos que queremos buscar registros onde a data seja na data 31-08-2020:

``` 
use \App\Models\SiteContato;

$contatos = SiteContato::whereDate('created_at', '31-08-2020')->get();
```

Também podemos realizar a busca através de dias, mês ou ano

``` 
use \App\Models\SiteContato;

$contatos = SiteContato::whereDay('created_at', '31')->get();
$contatos = SiteContato::whereMonth('created_at', '08')->get();
$contatos = SiteContato::whereYear('created_at', '2020')->get();
```

Podemos realizar buscas através das horas registradas

```
use \App\Models\SiteContato;

$contatos = SiteContato::whereTime('created_at','=','20:00:00')->get(); //Todos os operadores lógicos são suportados nesse método
```

## Eloquent - Selecionando registros com whereColumn()
Estes métodos de busca faz a comparação de registros entre duas colunas distintas. Por exemplo comparar se os valores entre o created_at e updated_at sejam iguais:
 
```
use \App\Models\SiteContato;

//O método whereColumn() desconsidera valores nulos
$contatos = SiteContato::whereColumn('created_at', '=','updated_at')->get();
```

## Eloquent - Selecionando registros aplicando precedência em operadores lógicos
Digamos que nosso objetivo seja buscar registros na tabela site_contatos onde nome seja igual a Jorge ou a Ana e em outro conjunto de condições onde motivo_contato seja 1 ou 2 ou id esteja entre 4 e 6:

```
use \App\Models\SiteContato;

//O método whereColumn() desconsidera valores nulos
$contatos = SiteContato::where(function($query){
    $query->where('nome', 'Jorge')->orWhere('nome', 'Ana');
})(function($query){
   $query->whereIn('motivo_contato', [1,2])->orWhereBetween('id', [4,6]); 
})->get();
```

## Eloquent - Ordenando registros
Podemos ordenar os registros através de uma determinada coluna de modo ascendente ou descendente
```
use \App\Models\SiteContato;

$contatos = SiteContato::orderBy('nome', 'asc')->get();//busca ascendente
$contatos = SiteContato::orderBy('nome', 'desc')->get();//busca descendente
```
Também é possível realizar ordenações de forma desencadeada

```
use \App\Models\SiteContato;

$contatos = SiteContato::orderBy('nome', 'asc')->orderBy('motivo_contato', 'desc')->get();//busca ascendente
```

## Eloquent - Introdução a Collections
Introdução a manipulação das Collections (Matriz de dados)

## Eloquent - Collection first, last e reverse
Podemos pegar o primeiro ou ultimo elemento de uma collection utilizando o método first() e last()
```
use \App\Models\SiteContato;

$contatos = SiteContato::orderBy('nome', 'asc')->orderBy('motivo_contato', 'desc');//busca ascendente
$primeiro = $contatos->first(); //pega o primeiro elemento
$ultimo = $contatos->last(); //pega o ultimo elemento 
$reverso = $contatos->reverse(); //inverte a ordem dos elementos
```

## Eloquent - Collection toArray e toJson
O Collection é convertido para Array e para Json. Portanto os métodos de collection não podem ser usado nessas notações
```
use \App\Models\SiteContato;

$contatos = SiteContato::all();
$array_contatos = $contatos->toArray();
$json_contatos = $contatos->toJson();
```

## Eloquent - Collection pluck
O método pluck permite obter todos os valores de uma determinada chave. Por exemplo se desejarmos obter todos os emails de cada um dos objetos contidos na collection:

```
use \App\Models\SiteContato;

$contatos = SiteContato::all()->pluck('email');

```

Para criar um array associativo contendo indices basta usar: 

```
use \App\Models\SiteContato;

$contatos = SiteContato::all()->pluck('email', 'nome); // Emails com indices do nome

```

## Eloquent - Atualizando Registros (save)
Para atualizar um dado no banco, basta buscar o elemento pelo id no banco de dados altera-lo e salva-lo. Exemplo:

```
use \App\Models\Fornecedor;

$fornecedor = Fornecedor::find(1);
$fornecedor->email = "email.alterador@gmail.com";
$fornecedor->site = 'fornecedor.com.br";
$fornecedor->save();

```

## Eloquent - Atualizando Registros (fill e save)
Com o método fill é possível atualizar um array associativo de forma mais enxuta. Digamos que queremos atualizar um fornecedor de id 2 para atualizar o nome email e site:

```
use \App\Models\Fornecedor;

$fornecedor = Fornecedor::find(2);
$fornecedor->fill(['nome'=> 'fornecedor', 'email' => 'fornecedor.fill@gmail.com', 'site' => fornecedorfill.com.br']);
$fornecedor->save();
```

## Eloquent - Atualizando Registros (where e update)
É possível utilizar filtro de registro com a cláusula update.

```
use \App\Models\Fornecedor;

$fornecedor = Fornecedor::whereIn('id' , [1,2])
                        ->update(['nome' => 'Fornecedor Teste', 'site' => 'teste.com.br']);

```


## Eloquent - Deletando Registros (delete e destroy)
Digamos que nosso objetivo é remover o contato do id 4.

```
use \App\Models\SiteContato;

$contato = SiteContato::find(4);
$contato->delete();

SiteContato::where('id', 7)->delete(4); //Retornará 1, dizendo que 1 elemento foi removido

SiteContato::destroy(4);
```

## Eloquent - Deletando registros com DeleteSoft
O DeleteSoft faz com que os registros não sejam efetivamente excluídos da tabela, na verdade ele apenas adiciona uma nova coluna a tabela chamada deleted_at. Este recurso é muito interessante quando precisamos inativar registros em uma tabela, mas precisamos mantê-los para fins de históricos. Para forçar que o registro seja realmente excluída deverá usar o método forceDelete


```
//contexto da migration
Schema::table('fornecedores', function(Blueprint $table){
            $table->softDeletes();//selecionando onde a coluna será inserida após outra
        });


use \App\Models\Fornecedor;

$fornecedor = Fornecedor::find(2)
                        ->forceDelete();

```

## Eloquent - Selecionando e restaurando registros deletados com SoftDelete
Para termos acesso a todos os registros incluindo os que foram deletados no softDelete, podemos usar o withTrashed: 

```
use \App\Models\Fornecedor;

$fornecedor = Fornecedor::withTrashed()->get();//podemos utilizar  filtros no messe método

$fornecedor[0]->restore();
```