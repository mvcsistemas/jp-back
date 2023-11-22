<?php

namespace MVC\Models\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest {

    public function rules()
    {
        return [
            'uuid'            => '',
            'nome'            => 'required',
            'email'           => ['required', Rule::unique('users')->where(function ($query) {
                return $query->where('uuid', '<>', request()->uuid);
            })],
            'password'        => '',
            'sexo'            => 'required',
            'cpf'             => 'required',
            'data_nascimento' => 'required',
            'telefone'        => 'required',
            'ativo'           => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required'            => 'O campo Nome é obrigatório.',
            'email.required'           => 'O campo E-mail é obrigatório.',
            'email.unique'             => 'Este E-mail já está cadastrado.',
            'sexo.required'            => 'O campo Sexo é obrigatório.',
            'cpf.required'             => 'O campo CPF é obrigatório.',
            'data_nascimento.required' => 'O campo Data de Nascimento é obrigatório.',
            'telefone.required'        => 'O campo Telefone é obrigatório.',
            'ativo.required'           => 'O campo Ativo é obrigatório.'
        ];
    }
}
