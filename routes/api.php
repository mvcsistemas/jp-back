<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'as'        => 'auth.',
    'namespace' => 'Auth',
], function () {
    // Login WEB
    Route::post('login', 'AuthenticateController@login');
    Route::post('logout', 'AuthenticateController@logout');

    //Login API
    Route::post('login-api', 'AuthenticateController@loginApi');
    Route::post('logout-api', 'AuthenticateController@logoutApi')->middleware('auth:sanctum');
});

Route::group([
    'as'        => 'senha.',
    'namespace' => 'ResetPassword'
], function () {
    //Reset Password
    Route::post('esqueci-minha-senha', 'ResetPasswordController@forgotPassword')->name('forgot');
    Route::post('redefinir-senha', 'ResetPasswordController@resetPassword')->name('reset');
});

Route::group([
    'prefix'    => 'primeiro-acesso',
    'as'        => 'primeiro-acesso.',
    'namespace' => 'FirstAccess'
], function () {
    Route::post('gera-otp', 'FirstAccessController@generate')->name('generate-otp');
    Route::post('verifica-otp', 'FirstAccessController@checkCodeForNewPassword')->name('check-otp');
    Route::post('criar-senha', 'FirstAccessController@createPassword')->name('create-password');
});


Route::group([
    'as'         => 'portal.',
    'prefix'    => 'portal',
    'middleware' => 'auth:sanctum'
], function () {

    Route::group([
        'prefix'    => 'usuario',
        'as'        => 'usuario.',
        'namespace' => 'User'
    ], function () {
        Route::apiResource('', 'UserController')->parameters(['' => 'uuid']);
    });

    Route::group([
        'prefix'    => 'aluno',
        'as'        => 'aluno.',
        'namespace' => 'Aluno'
    ], function () {
        Route::apiResource('', 'AlunoController')->parameters(['' => 'uuid']);
    });

    Route::group([
        'prefix'    => 'funcionario',
        'as'        => 'funcionario.',
        'namespace' => 'Funcionario'
    ], function () {
        Route::apiResource('', 'FuncionarioController')->parameters(['' => 'uuid']);
    });

    Route::group([
        'prefix'    => 'evento',
        'as'        => 'evento.',
        'namespace' => 'Evento'
    ], function () {
        Route::apiResource('', 'EventoController')->parameters(['' => 'uuid']);
    });

    Route::group([
        'prefix'    => 'ficha-anamnese',
        'as'        => 'ficha-anamnese.',
        'namespace' => 'FichaAnamnese'
    ], function () {
        Route::apiResource('', 'FichaAnamneseController')->parameters(['' => 'uuid']);
    });

    Route::group([
        'prefix'    => 'feedback-semanal',
        'as'        => 'feedback-semanal.',
        'namespace' => 'FeedbackSemanal'
    ], function () {
        Route::apiResource('', 'FeedbackSemanalController')->parameters(['' => 'uuid']);
    });

    Route::group([
        'prefix'    => 'arquivos',
        'as'        => 'arquivos.',
        'namespace' => 'Arquivos'
    ], function () {
        Route::apiResource('', 'ArquivosController')->parameters(['' => 'uuid'])->except(['update']);
    });

    Route::group([
        'prefix'    => 'comunicados',
        'as'        => 'comunicados.',
        'namespace' => 'Comunicados'
    ], function () {
        Route::apiResource('', 'ComunicadosController')->parameters(['' => 'uuid']);
    });

    Route::group([
        'prefix'    => 'status',
        'as'        => 'status.',
        'namespace' => 'Status'
    ], function () {
        Route::apiResource('', 'StatusController')->parameters(['' => 'uuid']);
    });

    Route::group([
        'prefix'    => 'parceiros',
        'as'        => 'parceiros.',
        'namespace' => 'Parceiros'
    ], function () {
        Route::apiResource('', 'ParceirosController')->parameters(['' => 'uuid']);
    });

    Route::group([
        'prefix'    => 'dores',
        'as'        => 'dores.',
        'namespace' => 'Dores'
    ], function () {
        Route::apiResource('', 'DoresController')->parameters(['' => 'uuid']);
    });

    Route::group([
        'prefix'    => 'doencas',
        'as'        => 'doencas.',
        'namespace' => 'Doencas'
    ], function () {
        Route::apiResource('', 'DoencasController')->parameters(['' => 'uuid']);
    });

    Route::group([
        'prefix'    => 'atividades-fisicas',
        'as'        => 'atividades-fisicas.',
        'namespace' => 'AtividadesFisicas'
    ], function () {
        Route::apiResource('', 'AtividadesFisicasController')->parameters(['' => 'uuid']);
    });
});
