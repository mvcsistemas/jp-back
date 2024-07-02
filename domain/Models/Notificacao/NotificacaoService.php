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

    public function notificacao(string $token, string $title, string $body): array
    {
        $factory   = (new Factory)->withServiceAccount(config('firebase.projects.app.credentials'));
        $messaging = $factory->createMessaging();
        $message   = CloudMessage::withTarget('token', $token)->withNotification(['title' => $title, 'body' => $body]);

        return $messaging->send($message);
    }

    public function periodoAbertoFeedback(): void
    {
        //todas as sextas 00:00 -> aberto o periodo de feedback
        $alunos = Aluno::select('notificacao_token')
            ->join('notificacao_token', 'aluno.id', 'notificacao_token.fk_id_usuario')
            ->where('ativo', 1)
            ->get();

        foreach ($alunos as $aluno) {
            $this->notificacao($aluno->notificacao_token, 'Feedback Semanal', 'O Feedback Semanal está aberto. Não deixe para depois, responda agora.');
        }
    }

    public function ultimoDiaParaResponderFeedback(): void
    {
        //todas as terças 00:00 -> ultimo dia para responder o feedback
        $alunos = Aluno::select('notificacao_token')
            ->join('notificacao_token', 'aluno.id', 'notificacao_token.fk_id_usuario')
            ->where('ativo', 1)
            ->get();

        foreach ($alunos as $aluno) {
            $this->notificacao($aluno->notificacao_token, 'Feedback Semanal', 'Hoje é o último dia para responder o feedback. Não perca, responda agora.');
        }
    }

    public function AlunosNecessitamResponderFeedback(): void
    {
        //de sexta até terça -> dias para responder o feedback fazer o select acima dos que ainda nao responderam
        $alunosQueResponderam = FeedbackSemanal::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->pluck('fk_id_aluno');

        $alunosNaoResponderam = Aluno::select('notificacao_token')
            ->join('notificacao_token', 'aluno.id', 'notificacao_token.fk_id_usuario')
            ->where('ativo', 1)
            ->whereNotIn('aluno.id', $alunosQueResponderam)
            ->get();

        foreach ($alunosNaoResponderam as $aluno) {
            $this->notificacao($aluno->notificacao_token, 'Feedback Semanal', 'Seu feedback semanal ainda está pendente.');
        }
    }

    public function alunosComTreinoFuturo(): void
    {
        //todo dia 00:00 -> ver se o aluno tem treino pendente
        $alunoscomtreino = Aluno::select('notificacao_token')
            ->join('evento', 'aluno.id', 'evento.fk_id_aluno')
            ->join('notificacao_token', 'aluno.id', 'notificacao_token.fk_id_usuario')
            ->where('fk_id_status', 3)
            ->whereDate('evento.data', date('Y-m-d'))
            ->get();

        foreach ($alunoscomtreino as $aluno) {
            $this->notificacao($aluno->notificacao_token, 'Lembrete', 'Há um treino te esperando hoje!');
        }
    }
}
