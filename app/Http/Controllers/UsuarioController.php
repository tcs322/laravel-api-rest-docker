<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Resources\UsuarioResource;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::paginate();

        return UsuarioResource::collection($usuarios);
    }

    public function store(UsuarioStoreRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $usuario = Usuario::create($data);

        return new UsuarioResource($usuario);
    }
}
