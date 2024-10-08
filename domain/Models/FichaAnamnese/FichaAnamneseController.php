<?php

namespace MVC\Models\FichaAnamnese;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MVC\Base\MVCController;

class FichaAnamneseController extends MVCController {

    protected FichaAnamneseService $service;
    protected                      $resource;

    public function __construct(FichaAnamneseService $service)
    {
        $this->service  = $service;
        $this->resource = FichaAnamneseResource::class;
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

    public function store(FichaAnamneseRequest $request): JsonResponse
    {
        $data = $this->transformData($request->validated());

        $row = $this->service->create($data);

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, FichaAnamneseRequest $request): JsonResponse
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

    public function transformData (array $data): array
    {
        return transformUuidToId($data, [
            ['tabela' => 'users', 'chave_atribuir' => 'fk_id_aluno', 'campo_pesquisar' => 'id', 'uuid' => $data['fk_uuid_aluno']]
        ]);
    }
}
