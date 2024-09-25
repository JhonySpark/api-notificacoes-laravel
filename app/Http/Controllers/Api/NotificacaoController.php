<?php

namespace App\Http\Controllers\Api;

use App\Models\Notificacao;
use Illuminate\Http\Request;
use App\Http\Requests\NotificacaoRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificacaoResource;
use Illuminate\Support\Facades\Auth;
use App\Models\TipoNotificacao;

class NotificacaoController extends Controller
{

    public function create(NotificacaoRequest $request)
    {
        $tipoNotificacao = TipoNotificacao::find($request->idTipoNotificacao);
        if (!$tipoNotificacao) {
            return response()->json(['error' => 'Tipo de notificação inválido'], 400);
        }

        if ($request->validated()) {
            $notificacao = Notificacao::create([
                'id_usuario' => Auth::id(),
                'id_tipo_notificacao' => $request->idTipoNotificacao,
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'corpo' => $request->corpo,
                'imagem_destaque' => $request->imagem,
            ]);
        }
        return NotificacaoResource::toFormatted($notificacao);
    }

    public function byType($type_id)
    {
        $notificacoes = Notificacao::where('id_usuario', Auth::id())->where('id_tipo_notificacao', $type_id)->get();
        return NotificacaoResource::collection($notificacoes);
    }

    public function me()
    {
        $notificacoes = Notificacao::where('id_usuario', Auth::id())->get();
        return  NotificacaoResource::collection($notificacoes);
    }

    public function update(NotificacaoRequest $request, $id)
    {
        $notificacao = Notificacao::where('id_usuario', Auth::id())->findOrFail($id);

        $tipoNotificacao = TipoNotificacao::find($request->idTipoNotificacao);
        if (!$tipoNotificacao) {
            return response()->json(['error' => 'Tipo de notificação não existe'], 400);
        }

        if ($request->validated()) {
            $notificacao->update([
                'id_usuario' => Auth::id(),
                'id_tipo_notificacao' => $request->idTipoNotificacao,
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'corpo' => $request->corpo,
                'imagem_destaque' => $request->imagem,
            ]);
        }

        return new NotificacaoResource($notificacao);
    }

    public function delete($id)
    {
        $notificacao = Notificacao::where('id_usuario', Auth::id())->findOrFail($id);

        if (!$notificacao->exists()) {
            return response()->json(
                ['error' => 'A notificação informada não foi encontrada.'],
                400
            );
        }

        $notificacao->delete();

        return response()->json(['message' => 'Notificação deletado com sucesso']);
    }
}
