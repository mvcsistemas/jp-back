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
        Schema::create('calendario_atividade', function (Blueprint $table) {
            $table->id()->index();
            $table->uuid()->index();
            //$table->foreignId('fk_id_calendario')->references('id')->on('calendario')->onDelete('cascade');
            //$table->foreignId('fk_id_atividade')->references('id')->on('atividade')->onDelete('cascade');
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
