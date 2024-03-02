<?php

namespace MVC\Models\Educacao;

use Illuminate\Http\JsonResponse;
use MVC\Base\MVCController;

class EducacaoController extends MVCController
{

    protected EducacaoService $service;
    protected                 $resource;

    public function __construct(EducacaoService $service)
    {
        $this->service  = $service;
        $this->resource = EducacaoResource::class;
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

    public function store(EducacaoRequest $request): JsonResponse
    {
        $data = $this->transformData($request->validated());

        $row = $this->service->create($data);

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, EducacaoRequest $request): JsonResponse
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

    public function educacaoCategoria(): JsonResponse
    {
        $query = $this->service->index();
        $query = $this->service->filter($query, request()->all())->get();
        $rows  = $this->resource::collection($query);

        return response()->json(['data' => $rows->groupBy('categoria')]);
    }

    public function transformData(array $data): array
    {
        return transformUuidToId($data, [
            ['tabela' => 'categorias', 'chave_atribuir' => 'fk_id_categoria', 'campo_pesquisar' => 'id', 'uuid' => $data['fk_uuid_categoria']]
        ]);
    }
}
