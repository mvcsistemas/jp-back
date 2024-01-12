<?php

namespace MVC\Models\Arquivos;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use MVC\Base\MVCController;

class ArquivosController extends MVCController {

    protected ArquivosService $service;
    protected                   $resource;

    public function __construct(ArquivosService $service)
    {
        $this->service  = $service;
        $this->resource = ArquivosResource::class;
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

    public function store(ArquivosRequest $request): JsonResponse
    {
        $data = $this->transformData($request->validated());

        dd($data['arquivos']->getClientOriginalName());

        $teste = Storage::put('arquivos/' . $data['fk_uuid_funcionario'], $data['arquivos']);

        $row = $this->service->create($data);

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, ArquivosRequest $request): JsonResponse
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
            ['tabela' => 'funcionario', 'chave_atribuir' => 'fk_id_funcionario', 'campo_pesquisar' => 'id', 'uuid' => $data['fk_uuid_funcionario']]
        ]);
    }
}
