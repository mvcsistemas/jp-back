<?php

namespace MVC\Models\Dores;

use MVC\Base\MVCService;

class DoresService extends MVCService
{

    protected Dores $model;

    public function __construct(Dores $model)
    {
        $this->model = $model;
    }
}
