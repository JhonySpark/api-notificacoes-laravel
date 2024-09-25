<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsuarioResource;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $usuarios = Usuario::paginate();

        return UsuarioResource::collection($usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioRequest $request): Usuario
    {
        return Usuario::create($request->validated());
    }

    public function show(Usuario $usuario): Usuario
    {
        return $usuario;
    }

    public function update(UsuarioRequest $request, Usuario $usuario): Usuario
    {
        $usuario->update($request->validated());

        return $usuario;
    }

    public function destroy(Usuario $usuario): Response
    {
        $usuario->delete();

        return response()->noContent();
    }
}
