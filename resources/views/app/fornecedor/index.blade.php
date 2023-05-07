@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')

    <div class="conteudo-pagina-2">
        <div class="titulo-pagina">
            <p>Fornecedor</p>
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
            <div style="width:30%; margin-left:auto; margin-right: auto;">
                <form method="post" action="{{route('app.fornecedor.listar')}}">
                    @csrf
                    <input type="text" name="nome" placeholder="Nome" class="bord-preta">
                    <input type="text" name="site" placeholder="Site" class="bord-preta">
                    <input type="text" name="uf" placeholder="UF" class="bord-preta">
                    <input type="text" name="email" placeholder="Email" class="bord-preta">
                    <button type="submit" class="borda-preta">Pesquisar</button>
                </form>
            </div>
        </div>
    </div>

@endsection