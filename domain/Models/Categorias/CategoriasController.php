<?php

namespace MVC\Models\Categorias;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MVC\Base\MVCController;

class CategoriasController extends MVCController
{

    protected CategoriasService $service;
    protected              $resource;

    public function __construct(CategoriasService $service)
    {
        $this->service  = $service;
        $this->resource = CategoriasResource::class;
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

    public function store(CategoriasRequest $request): JsonResponse
    {
        $row = $this->service->create($request->validated());

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, CategoriasRequest $request): JsonResponse
    {
        $this->service->updateByUuid($uuid, $request->validated());

        return $this->responseBuilderRow([], false, 204);
    }

    public function destroy($uuid): JsonResponse
    {
        $this->service->deleteByUuid($uuid);

        return $this->responseBuilderRow([], false, 204);
    }
}
