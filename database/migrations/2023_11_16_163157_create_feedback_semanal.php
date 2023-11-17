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
            $table->string('sono_obs');
            $table->smallInteger('ausencia_dor');
            $table->string('ausencia_dor_obs');
            $table->smallInteger('alimentacao');
            $table->string('alimentacao_obs');
            $table->smallInteger('doenca');
            $table->string('doenca_obs');
            $table->smallInteger('disposicao');
            $table->string('disposicao_obs');
            $table->smallInteger('ingestao_agua');
            $table->string('ingestao_agua_obs');
            $table->smallInteger('organizacao');
            $table->string('organizacao_obs');
            $table->smallInteger('intensidade_treino');
            $table->string('intensidade_treino_obs');
            $table->smallInteger('autoestima');
            $table->string('autoestima_obs');
            $table->smallInteger('tabagismo');
            $table->string('tabagismo_obs');
            $table->smallInteger('exercicio_fisico');
            $table->string('exercicio_fisico_obs');
            $table->smallInteger('ingestao_bebida_alcoolica');
            $table->string('ingestao_bebida_alcoolica_obs');
            $table->smallInteger('atividade_fisica');
            $table->string('atividade_fisica_obs');
            $table->foreignId('fk_id_aluno')->references('id')->on('aluno')->onDelete('cascade');
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
