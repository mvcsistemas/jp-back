<?php

namespace MVC\Models\Evento;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
        $payload = $this->transformData($request->validated());

        if (isset($payload['evento_aluno']) && $payload['fk_uuid_atividade_fisica'] != '') {
            $payload['fk_id_status'] = '3';
        }

        if (!isset($payload['data_inicio']) || $payload['data_inicio'] == '') {
            $row = $this->service->create($payload);

            return $this->responseBuilderRow($row, true, 201);
        }

        $recorrentesDatas = $this->calcularRecorrencias($payload['data_inicio'], $payload['data_fim'], $payload['dias_semana']);
        $eventos          = [];

        foreach ($recorrentesDatas as $data) {
            $payload['data'] = $data;
            $eventos[]       = $this->service->create($payload);
        }

        return $this->responseBuilderRow($eventos, false, 201);
    }

    public static function calcularRecorrencias($dataInicio, $dataFim, array $diasDaSemana)
    {
        $periodo = new CarbonPeriod($dataInicio, '1 week', $dataFim);
        $datasRecorrentes = [];

        foreach ($periodo as $data) {
            foreach ($diasDaSemana as $diaDaSemana) {
                $dataEvento = new Carbon($data);

                // Ajustar para o dia correto na semana
                if ($dataEvento->dayOfWeek != $diaDaSemana) {
                    $dataEvento->next($diaDaSemana);
                }

                // Checar se a data do evento está dentro do intervalo permitido
                if ($dataEvento->between($dataInicio, $dataFim, true)) {
                    $datasRecorrentes[] = $dataEvento->format('Y-m-d');
                }
            }
        }

        // Ordenar e remover duplicatas
        $datasRecorrentes = array_unique($datasRecorrentes);
        sort($datasRecorrentes);

        return $datasRecorrentes;
    }

    public function update($uuid, EventoRequest $request): JsonResponse
    {
        $data = $this->transformData($request->validated());

        if (isset($data['evento_aluno']) && $data['fk_uuid_atividade_fisica'] != '') {
            $data['fk_id_status'] = '3';
        }

        $this->service->updateByUuid($uuid, $data);

        return $this->responseBuilderRow([], false, 204);
    }

    public function destroy($uuid): JsonResponse
    {
        $this->service->deleteByUuid($uuid);

        return $this->responseBuilderRow([], false, 204);
    }

    public function contador(string $fk_uuid_aluno, string $competencia): JsonResponse
    {
        $contador = $this->service->contador($fk_uuid_aluno, $competencia);

        return $this->responseBuilderRow($contador, false);
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
