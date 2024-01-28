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
            'arquivos'            => 'required|array',
            'arquivos.*'          => 'file',
            'fk_uuid_funcionario' => 'required',
            'fk_uuid_aluno'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'arquivos.required'            => 'O campo Arquivos é obrigatório.',
            'arquivos.array'               => 'O campo Arquivos deve ser um array.',
            'arquivos.file'                => 'Não contém um arquivo válido.',
            'fk_uuid_funcionario.required' => 'O campo Funcionário é obrigatório.',
            'fk_uuid_aluno.required'       => 'O campo Aluno é obrigatório.'
        ];
    }
}
