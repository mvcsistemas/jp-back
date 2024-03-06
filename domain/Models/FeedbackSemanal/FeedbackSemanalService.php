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

    public function statusSemanal(): array
    {
        $feedbackSemana = $this->model->where('fk_id_aluno', auth()->id())
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->exists();

        if ($feedbackSemana) {
            return [
                'status' => true,
                'mensagem' => 'Feedback enviado nesta semana.'
            ];
        }

        return [
            'status' => false,
            'mensagem' => 'Feedback não enviado nesta semana.'
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
