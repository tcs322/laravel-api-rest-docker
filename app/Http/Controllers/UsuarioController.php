<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Http\Resources\UsuarioResource;
use App\Models\Usuario;
use Illuminate\Http\Response;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::paginate();

        return UsuarioResource::collection($usuarios);
    }

    public function store(UsuarioStoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);

        $usuario = Usuario::create($data);

        return new UsuarioResource($usuario);
    }

    public function show(string $id)
    {
        $usuario = Usuario::where('id', $id)->firstOrFail();

        return new UsuarioResource($usuario);
    }

    public function update(string $id, UsuarioUpdateRequest $request)
    {
        $usuario = Usuario::where('id', $id)->firstOrFail();
        $data = $request->validated();

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $usuario->update($data);

        return new UsuarioResource($usuario);
    }

    public function delete(string $id)
    {
        $usuario = Usuario::where('id', $id)->firstOrFail();
        $usuario->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
