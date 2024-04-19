<?php

namespace MVC\Models\Evento;

use MVC\Base\MVCService;
use MVC\Models\Aluno\Aluno;

class EventoService extends MVCService
{

    protected Evento $model;

    public function __construct(Evento $model)
    {
        $this->model = $model;
    }

    public function getAluno(string $fk_uuid_aluno): Aluno|null
    {
        return Aluno::findByUuid($fk_uuid_aluno);
    }

    public function contador(string $fk_uuid_aluno, string $competencia): array
    {
        $aluno = $this->getAluno($fk_uuid_aluno);

        if (!$aluno) {
            return [];
        }

        return $contador[] = [
            'presenca' => $this->getPresencas($aluno->id, $competencia),
            'falta'    => $this->getFaltas($aluno->id, $competencia),
            'treino'   => $this->getTreinos($aluno->id, $competencia),
        ];
    }

    public function getPresencas(int $fk_id_aluno, string $competencia): int
    {
        list($ano, $mes) = explode('-', $competencia);

        return $this->model->where('fk_id_aluno', $fk_id_aluno)
            ->whereMonth('data', $mes)
            ->whereYear('data', $ano)
            ->where('fk_id_status', '1')
            ->count();
    }

    public function getFaltas(int $fk_id_aluno, string $competencia): int
    {
        list($ano, $mes) = explode('-', $competencia);

        return $this->model->where('fk_id_aluno', $fk_id_aluno)
            ->whereMonth('data', $mes)
            ->whereYear('data', $ano)
            ->where('fk_id_status', '2')
            ->count();
    }

    public function getTreinos(int $fk_id_aluno, string $competencia): int
    {
        list($ano, $mes) = explode('-', $competencia);

        return $this->model->where('fk_id_aluno', $fk_id_aluno)
            ->whereMonth('data', $mes)
            ->whereYear('data', $ano)
            ->where('fk_id_status', '3')
            ->count();
    }
}
