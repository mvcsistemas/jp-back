<?php

namespace MVC\Models\Evento;

use MVC\Base\MVCService;

class EventoService extends MVCService {

    protected Evento $model;

    public function __construct(Evento $model)
    {
        $this->model = $model;
    }
}
