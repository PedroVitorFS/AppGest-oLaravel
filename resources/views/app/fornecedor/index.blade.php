<h3>Fornecedor</h3>

{{-- Fica o comentário que será descartado pelo interpretador do blade --}}

<?= '' ?>

@php 
    //Para comentários de uma linha

    /* 
        Para comentários de múltiplas linhas
    */

    //echo 'texto teste'
@endphp

{{-- 
    O php identifica uma variável sendo empty como:
    string = '' ou '0'
    int = 0
    float = 0.0
    null
    boolean = false
    array = []
--}}
@foreach ($fornecedores as $fornecedor)
   <a>{{$fornecedor}}</a>
@endforeach