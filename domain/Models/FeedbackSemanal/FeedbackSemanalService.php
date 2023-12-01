<?php

namespace MVC\Models\FeedbackSemanal;

use MVC\Base\MVCService;

class FeedbackSemanalService extends MVCService {

    protected FeedbackSemanal $model;

    public function __construct(FeedbackSemanal $model)
    {
        $this->model = $model;
    }
}
