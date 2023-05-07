@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')

    <div class="conteudo-pagina-2">
        <div class="titulo-pagina">
            <p>Fornecedor - Listar</p>
        </div>

        <div class="menu">
            <ul>
                <li>
                    <a href="{{route('app.fornecedor.adicionar')}}">Novo</a> 
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
                            <th>Site</th>
                            <th>UF</th>
                            <th>Email</th>
                            <th>Excluir</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <td>{{$fornecedor->nome}}</td>
                                <td>{{$fornecedor->site}}</td>
                                <td>{{$fornecedor->uf}}</td>
                                <td>{{$fornecedor->email}}</td>
                                <td><a href="{{route('app.fornecedor.excluir', $fornecedor->id)}}">Excluir</a></td>
                                <td><a href="{{route('app.fornecedor.editar', $fornecedor->id)}}">Editar</a> </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{$fornecedores->appends($request)->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection