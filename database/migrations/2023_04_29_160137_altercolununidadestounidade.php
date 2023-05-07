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
        //atribuindo motivo_contato para a nova coluna motivo_contatos_id
        Schema::table('unidades', function(Blueprint $table){
            $table->dropColumn('unidades');

            $table->string('unidade', 3)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //atribuindo motivo_contato para a nova coluna motivo_contatos_id
        Schema::table('unidades', function(Blueprint $table){
            $table->dropColumn('unidade');

            $table->string('unidades', 3)->after('id');
        });
    }
};
