@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')

    <div class="conteudo-pagina-2">
        <div class="titulo-pagina">
            <p>LIstagem de Produtos</p>
        </div>

        <div class="menu">
            <ul>
                <li>
                    <a href="{{route('produto.create')}}">Novo</a> 
                    <a href="{{route('app.fornecedor') }}">Consulta</a> 
                </li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width:100%; margin-left:auto; margin-right: auto;">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>peso</th>
                            <th>Unidade Id</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{$produto->nome}}</td>
                                <td>{{$produto->descricao}}</td>
                                <td>{{$produto->peso}}</td>
                                <td>{{$produto->unidade_id}}</td>
                                <td><a href="">Excluir</a></td>
                                <td><a href="">Editar</a> </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{$produtos->appends($request)->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection