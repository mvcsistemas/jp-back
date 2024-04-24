<?php

namespace MVC\Models\FeedbackSemanal;

use Carbon\Carbon;
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
            ->selectRaw('(alimentacao + frequencia_motivacao + ausencia_dor + autoestima + disposicao + doenca + ingestao_agua + ingestao_bebida_alcoolica + intensidade_treino + organizacao + sono_qualitativo + tabagismo) as count')
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

    public function graficoSonoQualitativo(string $fk_uuid_aluno, string $competencia, bool $media = false): array|string|null
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, sono_qualitativo")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            $quantidade = $data->pluck('sono_qualitativo')->sum();
            $feedbacks  = count($data->pluck('competencia'));
            return $feedbacks > 0 ? number_format($quantidade / $feedbacks, 2, ',', '.') : '0.00';
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('sono_qualitativo'),
        ];
    }

    public function graficoSonoQuantitativo(string $fk_uuid_aluno, string $competencia, bool $media = false): array|string|null
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, sono_quantitativo")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            $quantidade = $data->pluck('sono_quantitativo')->sum();
            $feedbacks  = count($data->pluck('competencia'));
            return $feedbacks > 0 ? number_format($quantidade / $feedbacks, 2, ',', '.') : '0.00';
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('sono_quantitativo'),
        ];
    }

    public function graficoAlimentacao(string $fk_uuid_aluno, string $competencia, bool $media = false): array|string|null
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, alimentacao")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            $quantidade = $data->pluck('alimentacao')->sum();
            $feedbacks  = count($data->pluck('competencia'));
            return $feedbacks > 0 ? number_format($quantidade / $feedbacks, 2, ',', '.') : '0.00';
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('alimentacao'),
        ];
    }

    public function graficoFrequenciaMotivacao(string $fk_uuid_aluno, string $competencia, bool $media = false): array|string|null
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, frequencia_motivacao")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            $quantidade = $data->pluck('frequencia_motivacao')->sum();
            $feedbacks  = count($data->pluck('competencia'));
            return $feedbacks > 0 ? number_format($quantidade / $feedbacks, 2, ',', '.') : '0.00';
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('frequencia_motivacao'),
        ];
    }

    public function graficoAutoestima(string $fk_uuid_aluno, string $competencia, bool $media = false): array|string|null
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, autoestima")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            $quantidade = $data->pluck('autoestima')->sum();
            $feedbacks  = count($data->pluck('competencia'));
            return $feedbacks > 0 ? number_format($quantidade / $feedbacks, 2, ',', '.') : '0.00';
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('autoestima'),
        ];
    }

    public function graficoDisposicao(string $fk_uuid_aluno, string $competencia, bool $media = false): array|string|null
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, disposicao")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            $quantidade = $data->pluck('disposicao')->sum();
            $feedbacks  = count($data->pluck('competencia'));
            return $feedbacks > 0 ? number_format($quantidade / $feedbacks, 2, ',', '.') : '0.00';
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('disposicao'),
        ];
    }

    public function graficoIngestaoAgua(string $fk_uuid_aluno, string $competencia, bool $media = false): array|string|null
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, ingestao_agua")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            $quantidade = $data->pluck('ingestao_agua')->sum();
            $feedbacks  = count($data->pluck('competencia'));
            return $feedbacks > 0 ? number_format($quantidade / $feedbacks, 2, ',', '.') : '0.00';
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('ingestao_agua'),
        ];
    }

    public function graficoIngestaoBebidaAlcoolica(string $fk_uuid_aluno, string $competencia, bool $media = false): array|string|null
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, ingestao_bebida_alcoolica")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            $quantidade = $data->pluck('ingestao_bebida_alcoolica')->sum();
            $feedbacks  = count($data->pluck('competencia'));
            return $feedbacks > 0 ? number_format($quantidade / $feedbacks, 2, ',', '.') : '0.00';
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('ingestao_bebida_alcoolica'),
        ];
    }

    public function graficoIntensidadeTreino(string $fk_uuid_aluno, string $competencia, bool $media = false): array|string|null
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, intensidade_treino")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            $quantidade = $data->pluck('intensidade_treino')->sum();
            $feedbacks  = count($data->pluck('competencia'));
            return $feedbacks > 0 ? number_format($quantidade / $feedbacks, 2, ',', '.') : '0.00';
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('intensidade_treino'),
        ];
    }

    public function graficoOrganizacao(string $fk_uuid_aluno, string $competencia, bool $media = false): array|string|null
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, organizacao")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            $quantidade = $data->pluck('organizacao')->sum();
            $feedbacks  = count($data->pluck('competencia'));
            return $feedbacks > 0 ? number_format($quantidade / $feedbacks, 2, ',', '.') : '0.00';
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('organizacao'),
        ];
    }

    public function graficoTabagismo(string $fk_uuid_aluno, string $competencia, bool $media = false): array|string|null
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, tabagismo")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            $quantidade = $data->pluck('tabagismo')->sum();
            $feedbacks  = count($data->pluck('competencia'));
            return $feedbacks > 0 ? number_format($quantidade / $feedbacks, 2, ',', '.') : '0.00';
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('tabagismo'),
        ];
    }

    public function graficoDores(string $fk_uuid_aluno, string $competencia, bool $media = false): array|string|null
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(feedback_semanal.created_at, '%d/%m/%Y') as competencia, ausencia_dor, dores.descricao as dores")
            ->join('dores_feedback', 'dores_feedback.fk_id_feedback', 'feedback_semanal.id')
            ->join('dores', 'dores.id', 'dores_feedback.fk_id_dor')
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('feedback_semanal.created_at', $ano)
            ->whereMonth('feedback_semanal.created_at', $mes)
            ->get();

        if ($media) {
            $quantidade = $data->pluck('ausencia_dor')->sum();
            $feedbacks  = count($data->pluck('competencia'));
            return $feedbacks > 0 ? number_format($quantidade / $feedbacks, 2, ',', '.') : '0.00';
        }

        return $grafico[] = [
            'label'     => $data->pluck('competencia'),
            'data'      => $data->pluck('ausencia_dor'),
            'descricao' => $data->pluck('dores'),
        ];
    }

    public function graficoDoencas(string $fk_uuid_aluno, string $competencia, bool $media = false): array|string|null
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(feedback_semanal.created_at, '%d/%m/%Y') as competencia, doenca, doencas.descricao as doencas")
            ->join('doencas', 'doencas.id', 'feedback_semanal.fk_id_doenca')
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('feedback_semanal.created_at', $ano)
            ->whereMonth('feedback_semanal.created_at', $mes)
            ->get();

        if ($media) {
            $quantidade = $data->pluck('doenca')->sum();
            $feedbacks  = count($data->pluck('competencia'));
            return $feedbacks > 0 ? number_format($quantidade / $feedbacks, 2, ',', '.') : '0.00';
        }

        return $grafico[] = [
            'label'     => $data->pluck('competencia'),
            'data'      => $data->pluck('doenca'),
            'descricao' => $data->pluck('doencas'),
        ];
    }

    public function medias(string $fk_uuid_aluno, string $competencia): array
    {
        return $media[] = [
            'alimentacao'             => $this->graficoAlimentacao($fk_uuid_aluno, $competencia, true),
            'frequencia_motivacao'    => $this->graficoFrequenciaMotivacao($fk_uuid_aluno, $competencia, true),
            'autoestima'              => $this->graficoAutoestima($fk_uuid_aluno, $competencia, true),
            'disposicao'              => $this->graficoDisposicao($fk_uuid_aluno, $competencia, true),
            'ingestaoAgua'            => $this->graficoIngestaoAgua($fk_uuid_aluno, $competencia, true),
            'ingestaoBebidaAlcoolica' => $this->graficoIngestaoBebidaAlcoolica($fk_uuid_aluno, $competencia, true),
            'intensidadeTreino'       => $this->graficoIntensidadeTreino($fk_uuid_aluno, $competencia, true),
            'organizacao'             => $this->graficoOrganizacao($fk_uuid_aluno, $competencia, true),
            'tabagismo'               => $this->graficoTabagismo($fk_uuid_aluno, $competencia, true),
            'dores'                   => $this->graficoDores($fk_uuid_aluno, $competencia, true),
            'doencas'                 => $this->graficoDoencas($fk_uuid_aluno, $competencia, true),
            'sono_qualitativo'        => $this->graficoSonoQualitativo($fk_uuid_aluno, $competencia, true),
            'sono_quantitativo'       => $this->graficoSonoQuantitativo($fk_uuid_aluno, $competencia, true),
        ];
    }

    public function retornaIdFeedback(string $uuid): int|null
    {
        return $this->model->findByuuid($uuid)->id;
    }
}
