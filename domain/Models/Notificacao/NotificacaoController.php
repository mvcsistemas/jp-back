<?php

namespace MVC\Models\Notificacao;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MVC\Base\MVCController;

class NotificacaoController extends MVCController
{

    protected NotificacaoService $service;
    protected                    $resource;

    public function __construct(NotificacaoService $service)
    {
        $this->service  = $service;
        $this->resource = NotificacaoResource::class;
    }

    public function store(NotificacaoRequest $request): JsonResponse
    {
        $data = $this->transformData($request->validated());

        $row = $this->service->fisrtOrCreateToken($data);

        return $this->responseBuilderRow($row, true, 201);
    }

    public function transformData(array $data): array
    {
        return transformUuidToId($data, [
            ['tabela' => 'users', 'chave_atribuir' => 'fk_id_usuario', 'campo_pesquisar' => 'id', 'uuid' => $data['fk_uuid_usuario']],
        ]);
    }
}
