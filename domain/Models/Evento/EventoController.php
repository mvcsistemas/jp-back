<?php

namespace MVC\Models\Evento;

use Illuminate\Http\JsonResponse;
use MVC\Base\MVCController;

class EventoController extends MVCController
{

    protected EventoService $service;
    protected               $resource;

    public function __construct(EventoService $service)
    {
        $this->service  = $service;
        $this->resource = EventoResource::class;
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

    public function store(EventoRequest $request): JsonResponse
    {
        $data = $this->transformData($request->validated());

        $row = $this->service->create($data);

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, EventoRequest $request): JsonResponse
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

    public function transformData(array $data): array
    {
        return transformUuidToId($data, [
            [
                'tabela' => 'aluno', 'chave_atribuir' => 'fk_id_aluno', 'campo_pesquisar' => 'id', 'uuid' => $data['fk_uuid_aluno']
            ],
            [
                'tabela' => 'status', 'chave_atribuir' => 'fk_id_status', 'campo_pesquisar' => 'id', 'uuid' => $data['fk_uuid_status']
            ],
            [
                'tabela' => 'atividades_fisicas', 'chave_atribuir' => 'fk_id_atividade_fisica', 'campo_pesquisar' => 'id', 'uuid' => $data['fk_uuid_atividade_fisica']
            ]
        ]);
    }
}
