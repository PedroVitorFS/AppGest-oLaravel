@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')

    <div class="conteudo-pagina-2">
        <div class="titulo-pagina">
            <p>Adicionar Produto</p>
        </div>

        <div class="menu">
            <ul>
                <li>
                    <a href="">Novo</a> 
                    <a href="">Consulta</a> 
                </li>
            </ul>
        </div>

      
        <div class="informacao-pagina">
            <div style="width:30%; margin-left:auto; margin-right: auto;">
                {{$msg ?? ''}}
                <form method="post" action="{{route('produto.store')}}">
                    @csrf
                    {{$errors->has('nome') ? $errors->first('nome') : '' }}
                    <input type="text" value="{{old('nome')}}" name="nome" placeholder="Nome" class="bord-preta">
                    {{$errors->has('descricao') ? $errors->first('descricao') : '' }}
                    <input type="text" value="{{old('descricao')}}" name="descricao" placeholder="Descrição" class="bord-preta">
                    {{$errors->has('peso') ? $errors->first('peso') : '' }}
                    <input type="text" value="{{old('peso')}}" name="peso" placeholder="Peso" class="bord-preta">
                    {{$errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}
                    <select name="unidade_id" class="borda-preta">
                        <option>Selecione a Unidade de Medida</option>
                        @foreach ($unidades as $unidade)
                            <option value="{{$unidade->id}}" {{ old('unidade') == $unidade->id ? 'selected' : ''}}>{{$unidade->descricao}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="borda-preta">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>

@endsection