<?php

namespace MVC\Models\Notificacao;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use MVC\Base\MVCService;
use MVC\Models\Aluno\Aluno;
use MVC\Models\FeedbackSemanal\FeedbackSemanal;

class NotificacaoService extends MVCService
{
    protected Notificacao $model;

    public function __construct(Notificacao $model)
    {
        $this->model = $model;
    }

    public function notificacao(array $tokens, string $title, string $body): void
    {
        $factory   = (new Factory)->withServiceAccount(config('firebase.projects.app.credentials'));
        $messaging = $factory->createMessaging();

        foreach ($tokens as $token) {
            $message = CloudMessage::withTarget('token', $token)->withNotification(['title' => $title, 'body' => $body]);
            $messaging->send($message);
        }
    }

    public function periodoAbertoFeedback(): void
    {
        $tokens = Aluno::select('token')
            ->join('notificacao_token', 'aluno.id', 'notificacao_token.fk_id_usuario')
            ->where('ativo', 1)
            ->pluck('token')
            ->toArray();

        $this->notificacao($tokens, 'Feedback Semanal', 'O Feedback Semanal está aberto. Não deixe para depois, responda agora.');
    }

    public function ultimoDiaParaResponderFeedback(): void
    {
        $tokens = Aluno::select('token')
            ->join('notificacao_token', 'aluno.id', 'notificacao_token.fk_id_usuario')
            ->where('ativo', 1)
            ->pluck('token')
            ->toArray();

        $this->notificacao($tokens, 'Feedback Semanal', 'Hoje é o último dia para responder o feedback. Não perca, responda agora.');
    }

    public function AlunosNecessitamResponderFeedback(): void
    {
        $alunosQueResponderam = FeedbackSemanal::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->pluck('fk_id_aluno');

        $tokens = Aluno::select('token')
            ->join('notificacao_token', 'aluno.id', 'notificacao_token.fk_id_usuario')
            ->where('ativo', 1)
            ->whereNotIn('aluno.id', $alunosQueResponderam)
            ->pluck('token')
            ->toArray();

        $this->notificacao($tokens, 'Feedback Semanal', 'Seu feedback semanal ainda está pendente.');
    }

    public function alunosComTreinoFuturo(): void
    {
        $tokens = Aluno::select('token')
            ->join('evento', 'aluno.id', 'evento.fk_id_aluno')
            ->join('notificacao_token', 'aluno.id', 'notificacao_token.fk_id_usuario')
            ->where('fk_id_status', 3)
            ->whereDate('evento.data', date('Y-m-d'))
            ->pluck('token')
            ->toArray();

        $this->notificacao($tokens, 'Lembrete', 'Há um treino te esperando hoje!');
    }
}
