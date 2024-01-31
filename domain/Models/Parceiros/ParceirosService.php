<?php

namespace MVC\Models\Parceiros;

use MVC\Base\MVCService;

class ParceirosService extends MVCService {

    protected Parceiros $model;

    public function __construct(Parceiros $model)
    {
        $this->model = $model;
    }
}
