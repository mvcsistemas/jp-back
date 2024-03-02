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

    public function statusSemanal(): Array
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
}
