<?php

namespace MVC\Models\Arquivos;

use MVC\Base\MVCRequest;

class ArquivosRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'                => '',
            'caminho_arquivo'     => '',
            'arquivos'            => 'required',
            'arquivos.*'          => 'file',
            'fk_uuid_funcionario' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'arquivos.required'            => 'O campo Arquivos é obrigatório.',
            'arquivos.file'                => 'Não contém um arquivo válido.',
            'fk_uuid_funcionario.required' => 'O campo Funcionário é obrigatório.'
        ];
    }
}
