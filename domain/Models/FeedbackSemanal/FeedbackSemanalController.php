<?php

namespace MVC\Models\FeedbackSemanal;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MVC\Base\MVCController;

class FeedbackSemanalController extends MVCController
{

    protected FeedbackSemanalService $service;
    protected                        $resource;

    public function __construct(FeedbackSemanalService $service)
    {
        $this->service  = $service;
        $this->resource = FeedbackSemanalResource::class;
    }

    public function index(): JsonResponse
    {
        $rows = $this->service->index();

        return $this->responseBuilder($rows);
    }

    public function show($uuid): JsonResponse
    {
        $row = $this->service->showByUuid($uuid);

        return $this->responseBuilderRow($row);
    }

    public function store(FeedbackSemanalRequest $request): JsonResponse
    {
        $data = $this->transformData($request->validated());

        $row = $this->service->create($data);

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, FeedbackSemanalRequest $request): JsonResponse
    {
        $data = $this->transformData($request->validated());

        $this->service->updateByUuid($uuid, $data);

        return $this->responseBuilderRow([], false, 204);
    }

    public function destroy($uuid): JsonResponse
    {
        $this->service->deleteByUuid($uuid);

        return $this->responseBuilderRow([], false, 204);
    }

    public function lookup(Request $request): JsonResponse
    {
        $rows = $this->service->lookup($request->all());

        return $this->responseBuilderWithoutPagination($rows, false);
    }

    public function statusSemanal(string $fk_uuid_aluno): JsonResponse
    {
        $row = $this->service->statusSemanal($fk_uuid_aluno);

        return $this->responseBuilderRow($row, false);
    }

    public function graficoSonoQualitativo(string $fk_uuid_aluno, string $competencia): JsonResponse
    {
        $row = $this->service->graficoSonoQualitativo($fk_uuid_aluno, $competencia);

        return $this->responseBuilderRow($row, false);
    }

    public function graficoSonoQuantitativo(string $fk_uuid_aluno, string $competencia): JsonResponse
    {
        $row = $this->service->graficoSonoQuantitativo($fk_uuid_aluno, $competencia);

        return $this->responseBuilderRow($row, false);

    }

    public function graficoAlimentacao(string $fk_uuid_aluno, string $competencia): JsonResponse
    {
        $row = $this->service->graficoAlimentacao($fk_uuid_aluno, $competencia);

        return $this->responseBuilderRow($row, false);
    }

    public function graficoFrequenciaMotivacao(string $fk_uuid_aluno, string $competencia): JsonResponse
    {
        $row = $this->service->graficoFrequenciaMotivacao($fk_uuid_aluno, $competencia);

        return $this->responseBuilderRow($row, false);
    }
    public function scoreSemanal(string $fk_uuid_aluno): JsonResponse
    {
        $row = $this->service->scoreSemanal($fk_uuid_aluno);

        return $this->responseBuilderRow($row, false);
    }

    public function transformData(array $data): array
    {
        return transformUuidToId($data, [
            ['tabela' => 'users', 'chave_atribuir' => 'fk_id_aluno', 'campo_pesquisar' => 'id', 'uuid' => $data['fk_uuid_aluno']],
            ['tabela' => 'dores', 'chave_atribuir' => 'fk_id_dor', 'campo_pesquisar' => 'id', 'uuid' => $data['fk_uuid_dor']],
            ['tabela' => 'doencas', 'chave_atribuir' => 'fk_id_doenca', 'campo_pesquisar' => 'id', 'uuid' => $data['fk_uuid_doenca']]
        ]);
    }
}
