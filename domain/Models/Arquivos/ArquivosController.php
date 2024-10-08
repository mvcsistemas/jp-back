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

        foreach ($data['arquivos'] as $arquivo) {
            $payload = [];

            $payload['fk_id_funcionario'] = $data['fk_id_funcionario'];
            $payload['fk_id_aluno']       = $data['fk_id_aluno'];
            $payload['nome_arquivo']      = $arquivo->getClientOriginalName();
            $payload['caminho_arquivo']   = Storage::put('arquivos/' . $data['fk_uuid_funcionario'] . '/' . $data['fk_uuid_aluno'], $arquivo);

            $this->service->create($payload);
        }

        return $this->responseBuilderRow(['Arquivos salvos com sucesso!'], false, 201);
    }

    public function destroy($uuid): JsonResponse
    {
        $caminho_arquivo = $this->service->retornaCaminhoArquivo($uuid);

        $this->service->deleteByUuid($uuid);

        Storage::delete($caminho_arquivo);

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
            ['tabela' => 'funcionario', 'chave_atribuir' => 'fk_id_funcionario', 'campo_pesquisar' => 'id', 'uuid' => $data['fk_uuid_funcionario']],
            ['tabela' => 'aluno', 'chave_atribuir' => 'fk_id_aluno', 'campo_pesquisar' => 'id', 'uuid' => $data['fk_uuid_aluno']],
        ]);
    }
}
