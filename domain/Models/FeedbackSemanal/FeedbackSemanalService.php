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

    public function graficoSonoQualitativo(string $fk_uuid_aluno, string $competencia): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, sono_qualitativo")
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

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, sono_quantitativo")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('sono_quantitativo'),
        ];
    }

    public function graficoAlimentacao(string $fk_uuid_aluno, string $competencia, bool $media): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, alimentacao")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            return $grafico[] = [
                'media' => $data->pluck('alimentacao')->sum() / count($data->pluck('competencia')),
            ];
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('alimentacao'),
        ];
    }

    public function graficoFrequenciaMotivacao(string $fk_uuid_aluno, string $competencia, bool $media): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, frequencia_motivacao")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            return $grafico[] = [
                'media' => $data->pluck('frequencia_motivacao')->sum() / count($data->pluck('competencia')),
            ];
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('frequencia_motivacao'),
        ];
    }

    public function graficoAutoestima(string $fk_uuid_aluno, string $competencia, bool $media): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, autoestima")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            return $grafico[] = [
                'media' => $data->pluck('autoestima')->sum() / count($data->pluck('competencia')),
            ];
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('autoestima'),
        ];
    }

    public function graficoDisposicao(string $fk_uuid_aluno, string $competencia, bool $media): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, disposicao")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            return $grafico[] = [
                'media' => $data->pluck('disposicao')->sum() / count($data->pluck('competencia')),
            ];
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('disposicao'),
        ];
    }

    public function graficoIngestaoAgua(string $fk_uuid_aluno, string $competencia, bool $media): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, ingestao_agua")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            return $grafico[] = [
                'media' => $data->pluck('ingestao_agua')->sum() / count($data->pluck('competencia')),
            ];
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('ingestao_agua'),
        ];
    }

    public function graficoIngestaoBebidaAlcoolica(string $fk_uuid_aluno, string $competencia, bool $media): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, ingestao_bebida_alcoolica")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            return $grafico[] = [
                'media' => $data->pluck('ingestao_bebida_alcoolica')->sum() / count($data->pluck('competencia')),
            ];
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('ingestao_bebida_alcoolica'),
        ];
    }

    public function graficoIntensidadeTreino(string $fk_uuid_aluno, string $competencia, bool $media): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, intensidade_treino")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            return $grafico[] = [
                'media' => $data->pluck('intensidade_treino')->sum() / count($data->pluck('competencia')),
            ];
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('intensidade_treino'),
        ];
    }

    public function graficoOrganizacao(string $fk_uuid_aluno, string $competencia, bool $media): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, organizacao")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            return $grafico[] = [
                'media' => $data->pluck('organizacao')->sum() / count($data->pluck('competencia')),
            ];
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('organizacao'),
        ];
    }

    public function graficoTabagismo(string $fk_uuid_aluno, string $competencia, bool $media): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(created_at, '%d/%m/%Y') as competencia, tabagismo")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('created_at', $ano)
            ->whereMonth('created_at', $mes)
            ->get();

        if ($media) {
            return $grafico[] = [
                'media' => $data->pluck('tabagismo')->sum() / count($data->pluck('competencia')),
            ];
        }

        return $grafico[] = [
            'label' => $data->pluck('competencia'),
            'data' => $data->pluck('tabagismo'),
        ];
    }

    public function graficoDores(string $fk_uuid_aluno, string $competencia, bool $media): array
    {
        $aluno           = $this->getAluno($fk_uuid_aluno);
        list($ano, $mes) = explode('-', $competencia);

        $data = $this->model->selectRaw("DATE_FORMAT(feedback_semanal.created_at, '%d/%m/%Y') as competencia, ausencia_dor, dores.descricao as dores")
            ->join('dores', 'dores.id', 'feedback_semanal.fk_id_dor')
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('feedback_semanal.created_at', $ano)
            ->whereMonth('feedback_semanal.created_at', $mes)
            ->get();

        if ($media) {
            return $grafico[] = [
                'media' => $data->pluck('ausencia_dor')->sum() / count($data->pluck('competencia')),
            ];
        }

        return $grafico[] = [
            'label'     => $data->pluck('competencia'),
            'data'      => $data->pluck('ausencia_dor'),
            'descricao' => $data->pluck('dores'),
        ];
    }

    public function graficoDoencas(string $fk_uuid_aluno, string $competencia, bool $media): array
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
            return $grafico[] = [
                'media' => $data->pluck('doenca')->sum() / count($data->pluck('competencia')),
            ];
        }

        return $grafico[] = [
            'label'     => $data->pluck('competencia'),
            'data'      => $data->pluck('doenca'),
            'descricao' => $data->pluck('doencas'),
        ];
    }

    public function graficoMediaSonoQualitativo(string $fk_uuid_aluno, string $competencia): array
    {
        $aluno = $this->getAluno($fk_uuid_aluno);

        $data = $this->model->selectRaw("SUM(sono_qualitativo) as media")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('feedback_semanal.created_at', $competencia)
            ->first();

        $media = number_format($data->media / date('m'), 2, ',', '.');

        return $grafico[] = [
            'media' =>  $media,
            'mes_referencia' =>  Carbon::now()->isoFormat('MMMM'),
        ];
    }

    public function graficoMediaSonoQuantitativo(string $fk_uuid_aluno, string $competencia): array
    {
        $aluno          = $this->getAluno($fk_uuid_aluno);
        $data_inicio    = Carbon::now()->startOfYear();
        $data_atual     = Carbon::now();
        $diferenca_dias = $data_inicio->diffInDays($data_atual);

        $data = $this->model->selectRaw("SUM(sono_quantitativo) * 7 as qtd_horas")
            ->where('fk_id_aluno', $aluno->id)
            ->whereYear('feedback_semanal.created_at', $competencia)
            ->first();

        return $grafico[] = [
            'media' =>  $data->qtd_horas / $diferenca_dias
        ];
    }
}
