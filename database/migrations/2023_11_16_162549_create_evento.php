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
        Schema::create('evento', function (Blueprint $table) {
            $table->id()->index();
            $table->uuid()->index();
            $table->date('data');
            $table->string('titulo');
            $table->unsignedInteger('fk_id_aluno')->nullable();
            $table->foreign('fk_id_aluno')->references('id')->on('aluno')->onDelete('cascade');
            $table->boolean('todos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendario_atividade');
    }
};
