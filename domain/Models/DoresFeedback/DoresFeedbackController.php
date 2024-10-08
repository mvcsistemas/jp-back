<?php

namespace MVC\Models\DoresFeedback;

use Illuminate\Http\JsonResponse;
use MVC\Base\MVCController;

class DoresFeedbackController extends MVCController
{
    protected DoresFeedbackService $service;
    protected                      $resource;

    public function __construct(DoresFeedbackService $service)
    {
        $this->service  = $service;
        $this->resource = DoresFeedbackResource::class;
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

    public function store(DoresFeedbackRequest $request): JsonResponse
    {
        $row = $this->service->create($request->validated());

        return $this->responseBuilderRow($row, true, 201);
    }

    public function update($uuid, DoresFeedbackRequest $request): JsonResponse
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
