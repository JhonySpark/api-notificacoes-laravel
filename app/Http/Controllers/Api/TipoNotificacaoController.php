<?php

namespace App\Http\Controllers\Api;

use App\Models\TipoNotificacao;
use Illuminate\Http\Request;
use App\Http\Requests\TipoNotificacaoRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TipoNotificacaoResource;

class TipoNotificacaoController extends Controller
{
    public function index(Request $request)
    {
        $tiposNotificacao = TipoNotificacao::paginate();

        return TipoNotificacaoResource::collection($tiposNotificacao);
    }

    public function store(TipoNotificacaoRequest $request): TipoNotificacao
    {
        return TipoNotificacao::create($request->validated());
    }

    public function show(TipoNotificacao $tipoNotificacao): TipoNotificacao
    {
        return $tipoNotificacao;
    }

    public function update(TipoNotificacaoRequest $request, TipoNotificacao $tipoNotificacao): TipoNotificacao
    {
        $tipoNotificacao->update($request->validated());

        return $tipoNotificacao;
    }

    public function destroy(TipoNotificacao $tipoNotificacao): Response
    {
        $tipoNotificacao->delete();

        return response()->noContent();
    }
}
