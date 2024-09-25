<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoNotificacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TipoNotificacaoResource;

class TipoNotificacaoController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $tipoNotificacao = TipoNotificacao::create([
            'id_usuario' => Auth::id(),
            'nome_tipo' => $request->nome,
        ]);

        return TipoNotificacaoResource::toFormatted($tipoNotificacao);
    }

    public function update(Request $request, $id)
    {
        $tipoNotificacao = TipoNotificacao::where('id_usuario', Auth::id())->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $tipoNotificacao->update([
            'nome_tipo' => $request->nome,
        ]);

        return TipoNotificacaoResource::toFormatted($tipoNotificacao);
    }

    public function delete($id)
    {
        $tipoNotificacao = TipoNotificacao::where('id_usuario', Auth::id())->findOrFail($id);

        // Verificar se há notificações associadas a este tipo de notificação
        if ($tipoNotificacao->notificacoes()->exists()) {
            return response()->json(
                ['error' => 'Não é possível deletar um tipo de notificação que está sendo referenciado em notificações'],
                400
            );
        }

        $tipoNotificacao->delete();

        return response()->json(['message' => 'Tipo de notificação deletado com sucesso']);
    }

    public function me()
    {
        $tiposNotificacoes = TipoNotificacao::where('id_usuario', Auth::id())->get();
        return TipoNotificacaoResource::collection($tiposNotificacoes);

    }
}
