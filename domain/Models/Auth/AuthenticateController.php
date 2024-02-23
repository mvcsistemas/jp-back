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
    public function login(AuthenticateRequest $request): mixed
    {
        $credentials          = $request->only(['email', 'password']);
        $credentials['ativo'] = 1;
        $remember             = $request->remember;
        $user                 = User::where('email', $credentials['email'])->first();
        $data                 = ['funcionario' => $user->funcionario ? true : false];

        if ($user && Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $data = array_merge($data, ['nome' => $user->nome, 'email' => $user->email]);

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

    public function loginApi(AuthenticateRequest $request): mixed
    {
        $credentials = $request->only(['email', 'password']);
        $user        = User::where('email', $credentials['email'])->first();
        $data        = ['funcionario' => $user->funcionario ? true : false];

        if ($user && $user->ativo && Hash::check($credentials['password'], $user->password)) {
            $data = array_merge($data, ['nome' => $user->nome, 'email' => $user->email, 'token' => $user->createToken('token-api')->plainTextToken]);

            return response()->json(['data' => $data]);
        }

        throw ValidationException::withMessages(['email' => Lang::get('login_senha_invalidos')]);
    }

    public function logoutApi(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => Lang::get('desconectado_sucesso')]);
    }
}
