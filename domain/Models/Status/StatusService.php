<?php

namespace MVC\Models\Status;

use MVC\Base\MVCService;

class StatusService extends MVCService {

    protected Status $model;

    public function __construct(Status $model)
    {
        $this->model = $model;
    }
}
