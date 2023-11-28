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
        Schema::create('aluno', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary()->index();
            $table->uuid()->index();
            $table->string('endereco', 255);
            $table->decimal('altura', 13, 2);
            $table->string('profissao', 100);
            $table->string('local_trabalho', 255);
            $table->string('plano_saude', 100);
            $table->string('contato_emergencia', 11);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aluno');
    }
};
