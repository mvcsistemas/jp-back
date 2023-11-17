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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->index();
            $table->uuid()->index();
            $table->string('nome', 255);
            $table->string('email', 255)->unique()->index();
            $table->string('password');
            $table->string('sexo', 2);
            $table->string('cpf', 11);
            $table->date('data_nascimento');
            $table->string('telefone', 11);
            $table->boolean('ativo')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
