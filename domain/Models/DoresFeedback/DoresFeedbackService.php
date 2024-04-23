<?php

namespace MVC\Models\DoresFeedback;

use MVC\Base\MVCService;

class DoresFeedbackService extends MVCService
{
    protected DoresFeedback $model;

    public function __construct(DoresFeedback $model)
    {
        $this->model = $model;
    }
}
