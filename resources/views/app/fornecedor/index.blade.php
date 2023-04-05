<h3>Fornecedor</h3>

{{-- Fica o comentário que será descartado pelo interpretador do blade --}}

<?= 'texto de teste' ?>

@php 
    //Para comentários de uma linha

    /* 
        Para comentários de múltiplas linhas
    */

    echo 'texto teste'
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

@if(count($fornecedores) > 0 && count($fornecedores) < 10)
    <h3>Existem alguns fornecedores cadastrados</h3>
@elseif (count($fornecedores)> 10)
    <h3>Existem vários fornecedores cadastrados</h3> 
@else
    <h3>Ainda não existem fornecedores cadastrados</h3>
@endif