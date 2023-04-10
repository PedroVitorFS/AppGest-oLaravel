<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //relacionamento de 1 pra 1
        Schema::create('produto_detalhes', function (Blueprint $table) {
            //unsigned - aceita somente números positivos
            //signed - aceita tanto positivos quanto negativos
            $table->id();
            $table->unsignedBigInteger('produto_id'); //o tipo da chave estrangeira dever ser igual ao tipo da chave primária 
            $table->float('comprimento', 8,2);
            $table->float('largura', 8,2);
            $table->float('altura', 8,2);
            $table->timestamps();

            //constraint
            //referencia que a coluna produto_id faz referencia para a coluna id da tabela de produtos
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->unique('produto_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto_detalhes');
    }
};
