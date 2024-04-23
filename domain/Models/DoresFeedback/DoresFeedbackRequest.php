<?php

namespace MVC\Models\DoresFeedback;

use MVC\Base\MVCRequest;

class DoresFeedbackRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'             => '',
            'ausencia_dor'     => 'required',
            'fk_uuid_dor'      => 'required',
            'ausencia_dor_obs' => '',
        ];
    }

    public function messages()
    {
        return [
            'ausencia_dor.required' => 'O campo Ausência de dor é obrigatório.',
            'fk_uuid_dor.required'  => 'O campo Dor é obrigatório.'
        ];
    }
}
