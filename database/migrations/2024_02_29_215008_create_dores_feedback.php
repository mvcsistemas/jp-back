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
        Schema::create('dores_feedback', function (Blueprint $table) {
            $table->id()->index();
            $table->uuid()->index();
            $table->smallInteger('ausencia_dor');
            $table->foreignId('fk_id_dor')->references('id')->on('dores');
            $table->string('ausencia_dor_obs')->nullable();
            $table->foreignId('fk_id_feedback')->references('id')->on('feedback_semanal')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dores_feedback');
    }
};
