<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use MVC\Models\User\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'uuid'            => fake()->uuid(),
            'nome'            => fake()->name(),
            'email'           => fake()->unique()->safeEmail(),
            'password'        => 'password', //$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
            'sexo'            => 'M',
            'ativo'           => 1,
            'cpf'             => '12345678924',
            'data_nascimento' => now(),
            'telefone'        => '19997713000',
            'remember_token'  => Str::random(10),
        ];
    }
}
