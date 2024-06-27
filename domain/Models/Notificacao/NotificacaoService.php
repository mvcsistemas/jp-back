<?php

namespace MVC\Models\Notificacao;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use MVC\Base\MVCService;
use MVC\Models\Aluno\Aluno;
use MVC\Models\FeedbackSemanal\FeedbackSemanal;

class NotificacaoService extends MVCService
{
    public function notificacao(string $token, string $title, string $body): array
    {
        $factory   = (new Factory)->withServiceAccount(config('firebase.projects.app.credentials'));
        $messaging = $factory->createMessaging();
        $message   = CloudMessage::withTarget('token', $token)
            ->withNotification(['title' => $title, 'body' => $body]);

        return $messaging->send($message);
    }

    public function periodoAbertoFeedback(): void
    {
        //todas as sextas 00:00 -> aberto o periodo de feedback
    }

    public function ultimoDiaParaResponderFeedback(): void
    {
        //todas as terças 00:00 -> ultimo dia para responder o feedback
    }

    public function AlunosNecessitamResponderFeedback(): void
    {
        //de sexta até terça -> dias para responder o feedback fazer o select acima dos que ainda nao responderam
        $alunosQueResponderam = FeedbackSemanal::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->pluck('fk_id_aluno');

        $alunosNaoResponderam = Aluno::join('users', 'aluno.id', 'users.id')
            ->where('ativo', 1)
            ->whereNotIn('aluno.id', $alunosQueResponderam)
            ->get();
    }

    public function alunosComTreinoFuturo(): void
    {
        //todo dia 00:00 -> ver se o aluno tem treino pendente
        $alunoscomtreino = Aluno::join('evento', 'aluno.id', 'evento.fk_id_aluno')
            ->where('fk_id_status', 3)
            ->whereDate('evento.data', date('Y-m-d'))
            ->get();
    }
}
