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
        Schema::create('arquivos', function (Blueprint $table) {
            $table->id()->index();
            $table->uuid()->index();
            $table->string('nome_arquivo', 255);
            $table->string('caminho_arquivo', 255);
            $table->unsignedInteger('fk_id_funcionario');
            $table->foreign('fk_id_funcionario')->references('id')->on('funcionario')->onDelete('cascade');
            $table->unsignedInteger('fk_id_aluno');
            $table->foreign('fk_id_aluno')->references('id')->on('aluno')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arquivos');
    }
};
