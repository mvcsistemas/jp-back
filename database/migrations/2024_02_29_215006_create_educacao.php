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
        Schema::create('educacao', function (Blueprint $table) {
            $table->id()->index();
            $table->uuid()->index();
            $table->string('titulo');
            $table->string('descricao')->nullable();
            $table->string('link', 255);
            $table->foreignId('fk_id_categoria')->references('id')->on('categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educacao');
    }
};
