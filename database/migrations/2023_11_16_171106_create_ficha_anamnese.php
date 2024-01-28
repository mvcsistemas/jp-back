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
        Schema::create('ficha_anamnese', function (Blueprint $table) {
            $table->id()->index();
            $table->uuid()->index();
            $table->date('data_realizacao_ultimo_backup');
            $table->string('data_realizacao_ultimo_backup_obs')->nullable();
            $table->string('suplementacao', 255);
            $table->string('patologias', 255);
            $table->decimal('peso', 13, 2);
            $table->smallInteger('idade');
            $table->string('limitacoes', 255);
            $table->string('limitacoes_obs')->nullable();
            $table->string('setor_atuacao', 255);
            $table->string('objetivos_iniciais', 255);
            $table->string('comprometimento_resultado', 10);
            $table->string('solucao_musculacao', 255);
            $table->string('dificuldade_rotina_saudavel', 255);
            $table->string('meio_conhecimento_jp', 100);
            $table->string('esforco_fisico_desejado', 100);
            $table->string('fisico_desejado', 100);
            $table->string('fisico_desejado_obs')->nullable();
            $table->string('estetica_corporal', 255);
            $table->string('predominanca_trabalho', 100);
            $table->string('tempo_musculacao', 100);
            $table->string('jornada_trabalho', 100);
            $table->smallInteger('alimentacao_diaria');
            $table->string('alimentacao_diaria_obs')->nullable();
            $table->string('drogas_ilicitas', 10);
            $table->string('drogas_ilicitas_obs')->nullable();
            $table->string('rotina_trabalho', 255);
            $table->string('consome_bebida_alcoolicas', 10);
            $table->string('consome_bebida_alcoolicas_obs')->nullable();
            $table->smallInteger('disposicao_diaria');
            $table->string('disposicao_diaria_obs')->nullable();
            $table->smallInteger('ingestao_agua');
            $table->string('historico_esportivo', 255);
            $table->string('compulsao_alimentar', 10);
            $table->string('compulsao_alimentar_obs')->nullable();
            $table->smallInteger('frequencia_exercicio_fisico');
            $table->smallInteger('frequencia_atividade_fisica');
            $table->string('classificacao_alimentacao', 100);
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
        Schema::dropIfExists('ficha_anamnese');
    }
};
