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
        Schema::create('feedback_semanal', function (Blueprint $table) {
            $table->id()->index();
            $table->uuid()->index();
            $table->smallInteger('sono');
            $table->string('sono_obs')->nullable();
            $table->smallInteger('ausencia_dor');
            $table->string('ausencia_dor_obs')->nullable();
            $table->smallInteger('alimentacao');
            $table->string('alimentacao_obs')->nullable();
            $table->smallInteger('doenca');
            $table->string('doenca_obs')->nullable();
            $table->smallInteger('disposicao');
            $table->string('disposicao_obs')->nullable();
            $table->smallInteger('ingestao_agua');
            $table->string('ingestao_agua_obs')->nullable();
            $table->smallInteger('organizacao');
            $table->string('organizacao_obs')->nullable();
            $table->smallInteger('intensidade_treino');
            $table->string('intensidade_treino_obs')->nullable();
            $table->smallInteger('autoestima');
            $table->string('autoestima_obs')->nullable();
            $table->smallInteger('tabagismo');
            $table->string('tabagismo_obs')->nullable();
            $table->smallInteger('exercicio_fisico');
            $table->string('exercicio_fisico_obs')->nullable();
            $table->smallInteger('ingestao_bebida_alcoolica');
            $table->string('ingestao_bebida_alcoolica_obs')->nullable();
            $table->smallInteger('atividade_fisica');
            $table->string('atividade_fisica_obs')->nullable();
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
        Schema::dropIfExists('feedback_semanal');
    }
};
