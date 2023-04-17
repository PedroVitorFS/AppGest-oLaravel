# Utilizando os Seeders
Seeder são responsáveis por semear dados da aplicação com os dados iniciais de configuração ou mesmo com dados de testes. Basicamente falando são classes conhecidas com sementes estas classes conterão as instruções para semear as tabelas no banco de dados. 
Para iniciar uma Seeder basta usar o código: 

`php artisan make:seeder NomeDaSeeder` 

para executar basta usar o comando, use --class se quiser executar uma seed específica 

`php artisan db:seed --class="NomeDaSeed"` 
