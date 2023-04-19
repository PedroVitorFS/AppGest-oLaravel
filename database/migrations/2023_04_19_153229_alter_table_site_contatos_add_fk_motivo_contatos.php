<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //criando a coluna motivo_contatos_id
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->unsignedBigInteger('motivo_contatos_id');
        });

        //passando os dados da coluna motivo_contato para motivo_contatos_id
        DB::statement('update site_contatos set motivo_contatos_id = motivo_contato');

        //atribuindo motivo_contato para a nova coluna motivo_contatos_id
        Schema::table('site_contatos', function(Blueprint $table){
            $table->foreign('motivo_contatos_id')
                    ->references('id')
                    ->on('motivo_contatos');
            
            $table->dropColumn('motivo_contato');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Criar a coluna motivo_contato e removendo a fk
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->integer('motivo_contato');

            $table->dropForeign('site_contatos_motivo_contatos_id_foreign');
        });

        //passando os dados da coluna motivo_contato_id para motivo_contatos
        DB::statement('update site_contatos set motivo_contato = motivo_contatos_id');

        //removendo a coluna motivo_contatos_id
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->dropColumn('motivo_contatos_id');
        });
    }
};
