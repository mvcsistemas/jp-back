<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use MVC\Models\Dores\Dores;
use MVC\Models\User\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Dores::create(['descricao' => 'Nenhum']);
        Dores::create(['descricao' => 'Pé']);
        Dores::create(['descricao' => 'Tornozelo']);
        Dores::create(['descricao' => 'Canela']);
        Dores::create(['descricao' => 'Joelho']);
        Dores::create(['descricao' => 'Quadril']);
        Dores::create(['descricao' => 'Ombro']);
        Dores::create(['descricao' => 'Cervical']);
        Dores::create(['descricao' => 'Cotovelo']);
    }
}
