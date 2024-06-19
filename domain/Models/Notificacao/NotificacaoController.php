<?php

namespace MVC\Models\Notificacao;

use Illuminate\Http\JsonResponse;
use MVC\Base\MVCController;
use MVC\Models\Aluno\Aluno;
use MVC\Models\FeedbackSemanal\FeedbackSemanal;

class NotificacaoController extends MVCController
{

    public function notificacao(): JsonResponse
    {
        $alunosQueResponderam = FeedbackSemanal::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->pluck('fk_id_aluno');

        // Selecionar todos os alunos ativos que não responderam ao feedback nesta semana
        $alunosNaoResponderam = Aluno::join('users', 'aluno.id', 'users.id')
            ->where('ativo', 1)
            ->whereNotIn('aluno.id', $alunosQueResponderam)
            ->get();

        //todas as sextas 00:00 -> aberto o periodo de feedback
        //todas as terças 00:00 -> ultimo dia para responder o feedback
        //de sexta até terça -> dias para responder o feedback fazer o select acima dos que ainda nao responderam
        //todo dia 00:00 -> ver se o aluno tem treino pendente
        $alunoscomtreino = Aluno::join('evento', 'aluno.id', 'evento.fk_id_aluno')
            ->where('fk_id_status', 3)
            ->whereDate('evento.data', '=', date('Y-m-d'))
            ->get();
    }
}
