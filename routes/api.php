<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NotificacaoController;
use App\Http\Controllers\Api\TipoNotificacaoController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');

    // Rotas adicionais
    // Rota para deslogar da aplicação
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    // Refresh para renovar o token, e ele tráz o tempo de expiração
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'news'
], function ($router) {
    Route::post('/create', [NotificacaoController::class, 'create'])->name('news.create');
    Route::post('/update/{news_id}', [NotificacaoController::class, 'update'])->name('news.update');
    Route::post('/delete/{news_id}', [NotificacaoController::class, 'delete'])->name('news.delete');
    Route::get('/me', [NotificacaoController::class, 'me'])->name('news.me');
    Route::get('/type/{type_id}', [NotificacaoController::class, 'byType'])->name('news.byType');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'type'
], function ($router) {
    Route::post('/create', [TipoNotificacaoController::class, 'create'])->name('type.create');
    Route::post('/update/{type_id}', [TipoNotificacaoController::class, 'update'])->name('type.update');
    Route::post('/delete/{type_id}', [TipoNotificacaoController::class, 'delete'])->name('type.delete');
    Route::get('/me', [TipoNotificacaoController::class, 'me'])->name('type.me');
});
