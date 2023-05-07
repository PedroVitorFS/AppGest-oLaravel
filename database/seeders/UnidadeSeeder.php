<?php

namespace Database\Seeders;

use App\Models\Unidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unidade = new Unidade();
        $unidade->unidade = 'UN';
        $unidade->descricao = 'Unidade';
        $unidade->save();
    }
}
