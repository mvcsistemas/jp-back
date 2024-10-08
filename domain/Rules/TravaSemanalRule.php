<?php

namespace MVC\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use MVC\Models\FeedbackSemanal\FeedbackSemanal;

class TravaSemanalRule implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Verifica se o dia atual está entre sexta-feira (5) e terça-feira (2)
        if (!(date('N') >= 5 || date('N') <= 2)) {
            $fail('A resposta está fora do período permitido (Sexta-feira à Terça-feira).');
        }

        // Verifica se já existe um feedback do aluno nesta semana
        $feedbackSemana = FeedbackSemanal::join('aluno', 'aluno.id', 'feedback_semanal.fk_id_aluno')
            ->where('aluno.uuid', request()->fk_uuid_aluno)
            ->whereBetween('feedback_semanal.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->exists();
        if ($feedbackSemana) {
            $fail('Feedback já enviado nesta semana.');
        }
    }
}
