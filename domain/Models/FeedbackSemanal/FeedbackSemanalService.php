<?php

namespace MVC\Models\FeedbackSemanal;

use MVC\Base\MVCService;

class FeedbackSemanalService extends MVCService
{

    protected FeedbackSemanal $model;

    public function __construct(FeedbackSemanal $model)
    {
        $this->model = $model;
    }

    public function statusSemanal(string $fk_uuid_aluno): array
    {
        $feedbackSemanal = $this->model
            ->join('aluno', 'aluno.id', 'feedback_semanal.fk_id_aluno')
            ->where('aluno.uuid', $fk_uuid_aluno)
            ->whereBetween('feedback_semanal.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->exists();

        return [
            'status' => $feedbackSemanal ? true : false,
            'mensagem' => $feedbackSemanal ? 'Feedback enviado nesta semana.' : 'Feedback não enviado nesta semana.'
        ];
    }

    public function scoreSemanal(string $fk_uuid_aluno): array
    {
        $score = $this->model
            ->selectRaw('(alimentacao + atividade_fisica + ausencia_dor + autoestima + disposicao + doenca + exercicio_fisico + ingestao_agua + ingestao_bebida_alcoolica + intensidade_treino + organizacao + sono_qualitativo + sono_quantitativo + tabagismo) as count')
            ->join('aluno', 'aluno.id', 'feedback_semanal.fk_id_aluno')
            ->where('aluno.uuid', $fk_uuid_aluno)
            ->whereBetween('feedback_semanal.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->first();

        return [
            'score' => $score->count ?? 0
        ];
    }

    public function grafico()
    {
        list($ano, $mes) = explode('-', '2024-03');

        $data = $this->model->select('created_at', 'sono_qualitativo')
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        return $grafico[] = [
            'label' => $data->pluck('created_at'),
            'data' => $data->pluck('sono_qualitativo'),
        ];
    }
}
