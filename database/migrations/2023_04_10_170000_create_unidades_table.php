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
        //relacionamento de 1 pra muitos
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('unidades', 5); //cm, mm, kg
            $table->string('descricao', 30);
            $table->timestamps();
        });

        //Adicionar o relacionamento com a tabela de produtos 
        Schema::table('produtos', function(Blueprint $table){
            $table->unsignedBigInteger('unidade_id');
            //constraint
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });

        //adicionar o relacionamento com a tabela produto_detalhes
        Schema::table('produto_detalhes', function(Blueprint $table){
            $table->unsignedBigInteger('unidade_id');
            //constraint
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('produto_detalhes', function(Blueprint $table){
            $table->dropForeign('produto_detalhes_unidade_id_foreign'); //[table]_[coluna]_[foreign]
            $table->dropColumn('unidade_id');
        });

        Schema::table('produtos', function(Blueprint $table){
            $table->dropForeign('produtos_unidade_id_foreign'); //[table]_[coluna]_[foreign]
            $table->dropColumn('unidade_id');
        });

        Schema::dropIfExists('unidades');
    }
};
