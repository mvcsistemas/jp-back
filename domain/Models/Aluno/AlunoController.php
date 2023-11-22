<?php

namespace MVC\Models\Aluno;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MVC\Base\MVCController;

class AlunoController extends MVCController {

    protected AlunoService $service;
    protected                       $resource;

    public function __construct(AlunoService $service)
    {
        $this->service  = $service;
        $this->resource = AlunoResource::class;
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

    public function store(AlunoRequest $request): JsonResponse
    {
        $data = transformUuidToId($request->validated(), [
            ['tabela' => 'users', 'chave_atribuir' => 'id', 'campo_pesquisar' => 'id', 'uuid' => $request->uuid]
        ]);

        $row = $this->service->create($data);

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, AlunoRequest $request): JsonResponse
    {
        $this->service->updateByUuid($uuid, $request->validated());

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
}
