<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    public function register()
    {
        $validator = Validator::make(request()->all(), [
            'nome' => 'required',
            'email' => 'required|email|unique:usuarios',
            'senha' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        if (Usuario::where('email', request()->email)->exists()) {
            return response()->json(['error' => 'Este email já está cadastrado.'], 400);
        }

        $usuario = new Usuario;
        $usuario->nome = request()->nome;
        $usuario->sobrenome = request()->sobrenome;
        $usuario->email = request()->email;
        $usuario->senha = bcrypt(request()->senha);
        $usuario->save();

        $token = JWTAuth::fromUser($usuario);

        return response()->json(compact('usuario', 'token'), 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'senha');

        if (!$token = Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['senha']])) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        if (Auth::check()) {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Usuário deslogado com sucesso']);
        }
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
