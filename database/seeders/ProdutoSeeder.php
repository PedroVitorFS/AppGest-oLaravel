<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produto = new Produto();
        $produto->nome = 'Geladeira';
        $produto->descricao = 'Geladeira/Refrigerador frost free 375';
        $produto->peso = 50;
        $produto->unidade_id = 1;
        $produto->save();
    }
}
