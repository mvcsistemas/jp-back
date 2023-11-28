<?php

namespace MVC\Models\Calendario;

use MVC\Base\MVCService;

class CalendarioService extends MVCService {

    protected Calendario $model;

    public function __construct(Calendario $model)
    {
        $this->model = $model;
    }
}
