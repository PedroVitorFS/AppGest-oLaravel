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
        //o método table, utiliza uma tabela que já foi criada no banco de dados
        //para aplicação das instruções
        Schema::table('fornecedores', function(Blueprint $table){
            $table->string('uf', 2);
            $table->string('email',150);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //para reverter o comando basta usar ph artisan migrate:rollback
        Schema::table('fornecedores', function(Blueprint $table){
            //para remover a coluna
            $table->dropColumn(['uf', 'email']);
        });
    }
};
