<?php

namespace MVC\Models\FeedbackSemanal;

use Illuminate\Validation\ValidationException;
use MVC\Base\MVCService;
use MVC\Models\Aluno\Aluno;

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
            ->selectRaw('(alimentacao + frequencia_motivacao + ausencia_dor + autoestima + disposicao + doenca + ingestao_agua + ingestao_bebida_alcoolica + intensidade_treino + organizacao + sono_qualitativo + sono_quantitativo + tabagismo) as count')
            ->join('aluno', 'aluno.id', 'feedback_semanal.fk_id_aluno')
            ->where('aluno.uuid', $fk_uuid_aluno)
            ->whereBetween('feedback_semanal.created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->first();

        return [
            'score' => $score->count ?? 0
        ];
    }

    public function getAluno(string $fk_uuid_aluno): Aluno
    {
        $aluno = Aluno::where('uuid', $fk_uuid_aluno)->first();

        throw_if(!$aluno,  ValidationException::withMessages([
            'aluno' => 'Aluno não encontrado.',
        ]));

        return $aluno;
    }

    public function graficoSonoQualitativo(string $fk_uuid_aluno, string $competencia): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as competencia, sono_qualitativo")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('sono_qualitativo'),
        ];
    }

    public function graficoSonoQuantitativo(string $fk_uuid_aluno, string $competencia): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as competencia, sono_quantitativo")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('sono_quantitativo'),
        ];
    }

    public function graficoAlimentacao(string $fk_uuid_aluno, string $competencia): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as competencia, alimentacao")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('alimentacao'),
        ];
    }

    public function graficoFrequenciaMotivacao(string $fk_uuid_aluno, string $competencia): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as competencia, frequencia_motivacao")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('frequencia_motivacao'),
        ];
    }
}
