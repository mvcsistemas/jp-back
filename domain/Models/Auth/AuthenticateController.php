<?php

namespace MVC\Models\Auth;

use MVC\Base\MVCController;
use MVC\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class AuthenticateController extends MVCController
{
    public function login(AuthenticateRequest $request): JsonResponse
    {
        $credentials          = $request->only(['email', 'password']);
        $credentials['ativo'] = 1;
        $remember             = $request->remember;
        $user                 = $this->getUser($credentials['email']);

        if ($user && ($user->aluno || $user->funcionario) && Auth::attempt($credentials, $remember)) {
            $data = [
                'uuid'        => $user->uuid,
                'nome'        => $user->nome,
                'email'       => $user->email,
                'funcionario' => $this->isFuncionario($user)
            ];

            return response()->json(['data' => $data]);
        }

        throw ValidationException::withMessages(['email' => Lang::get('login_senha_invalidos')]);
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => Lang::get('desconectado_sucesso')]);
    }

    public function loginApi(AuthenticateRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);
        $user        = $this->getUser($credentials['email']);

        if ($user && $user->ativo && ($user->aluno || $user->funcionario) && Hash::check($credentials['password'], $user->password)) {
            $data = [
                'uuid'        => $user->uuid,
                'nome'        => $user->nome,
                'email'       => $user->email,
                'token'       => $user->createToken('token-api')->plainTextToken,
                'funcionario' => $this->isFuncionario($user)
            ];

            return response()->json(['data' => $data]);
        }

        throw ValidationException::withMessages(['email' => Lang::get('login_senha_invalidos')]);
    }

    public function logoutApi(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => Lang::get('desconectado_sucesso')]);
    }

    public function getUser(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function isFuncionario(User $user): Bool
    {
        return $user->funcionario ? true : false;
    }
}
