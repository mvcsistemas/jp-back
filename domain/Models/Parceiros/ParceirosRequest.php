<?php

namespace MVC\Models\Parceiros;

use MVC\Base\MVCRequest;

class ParceirosRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'         => '',
            'nome_empresa' => 'required',
            'descricao'    => '',
            'link'         => '',
            'telefone'     => ''
        ];
    }

    public function messages()
    {
        return [
            'nome_empresa.required' => 'O campo Nome da Empresa é obrigatório.'
        ];
    }
}
