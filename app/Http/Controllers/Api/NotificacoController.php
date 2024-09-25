<?php

namespace App\Http\Controllers\Api;

use App\Models\Notificacao;
use Illuminate\Http\Request;
use App\Http\Requests\NotificacaoRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificacaoResource;

class NotificacaoController extends Controller
{
    public function index(Request $request)
    {
        $notificacoes = Notificacao::paginate();

        return NotificacaoResource::collection($notificacoes);
    }

    public function store(NotificacaoRequest $request): Notificacao
    {
        return Notificacao::create($request->validated());
    }

    public function show(Notificacao $notificacoes): Notificacao
    {
        return $notificacoes;
    }

    public function update(Notificacao $request, Notificacao $notificacao): Notificacao
    {
        $notificacao->update($request->validated());

        return $notificacao;
    }

    public function destroy(Notificacao $notificacao): Response
    {
        $notificacao->delete();

        return response()->noContent();
    }
}
