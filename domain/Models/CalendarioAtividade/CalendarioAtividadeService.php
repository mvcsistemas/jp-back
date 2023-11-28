<?php

namespace MVC\Models\CalendarioAtividade;

use MVC\Base\MVCService;

class CalendarioAtividadeService extends MVCService {

    protected CalendarioAtividade $model;

    public function __construct(CalendarioAtividade $model)
    {
        $this->model = $model;
    }
}
