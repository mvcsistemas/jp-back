<?php

namespace MVC\Models\Comunicados;

use Illuminate\Http\JsonResponse;
use MVC\Base\MVCController;

class ComunicadosController extends MVCController
{

    protected ComunicadosService $service;
    protected                    $resource;

    public function __construct(ComunicadosService $service)
    {
        $this->service  = $service;
        $this->resource = ComunicadosResource::class;
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

    public function store(ComunicadosRequest $request): JsonResponse
    {
        $data = $this->transformData($request->validated());

        $row = $this->service->create($data);

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, ComunicadosRequest $request): JsonResponse
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
            ['tabela' => 'users', 'chave_atribuir' => 'fk_id_remetente', 'campo_pesquisar' => 'id', 'uuid' => $data['fk_uuid_remetente']],
            ['tabela' => 'users', 'chave_atribuir' => 'fk_id_destinatario', 'campo_pesquisar' => 'id', 'uuid' => $data['fk_uuid_destinatario']]
        ]);
    }
}
