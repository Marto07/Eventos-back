<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Usuario::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'                => 'required|max:255',
            'apellido'              => 'required|max:255',
            'email'                 => 'required|email|unique:usuarios',
            'nombre_usuario'        => 'required|max:255',
            'contrasena'            => 'required|min:8|max:255',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors'  => $validator->errors(),
                'status'  => 400
            ];
            return response()->json($data,400);
        }

        $usuario = Usuario::create([
            'nombre'                => $request->nombre,
            'apellido'              => $request->apellido,
            'email'                 => $request->email,
            'nombre_usuario'        => $request->nombre_usuario,
            'contrasena'            => $request->contrasena,
        ]);

        if (!$usuario) {
            $data = [
                "message" => "Error al crear el usuario",
                "status" => 500,
            ];
            return response()->json($data,500);
        }

        $data = [
            "usuario" => $usuario,
            "status"  => 201,
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = Usuario::find($id);

        if(!$usuario) {
            $data = [
                "message"   => "Usuario no encontrado",
                "status"    => 404,
            ];
            return response()->json($data, 404);
        }

        $data = [
            "usuario"   => $usuario,
            "status"    => 200,
        ];

        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if(!$usuario) {
            $data = [
                "message"   => "usuario no encontrado",
                "status"    => 404,
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre'                => 'required|max:255',
            'apellido'              => 'required|max:255',
            'email'                 => 'required|email|unique:usuarios',
            'nombre_usuario'        => 'required|max:255',
            'contrasena'            => 'required|min:8|max:255',
        ]);

        if ($validator->fails()) {
            $data = [
                "message"   => "Error en la validacion de los datos",
                "errors"    => $validator->errors(),
                "status"    => 400,
            ];

            return response()->json($data, 400);
        }

        $usuario->nombre      = $request->nombre;
        $usuario->apellido     = $request->apellido;
        $usuario->email     = $request->email;
        $usuario->nombre_usuario  = $request->nombre_usuario;
        $usuario->contrasena  = $request->contrasena;

        $usuario->save();

        $data = [
            "message"   => "usuario actualizado",
            "usuario"   => $usuario,
            "status"    => 200,
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Usuario::find($id);

        if(!$usuario) {
            $data = [
                "message"   => "usuario no encontrado",
                "status"    => 404,
            ];

            return response()->json($data, 404);
        }

        $usuario->delete();

        $data = [
            "message" => "usuario eliminado",
            "status"  => 200,
        ];

        return response()->json($data, 200);
    }

    public function partialUpdate(Request $request, $id) {
        $usuario = Usuario::find($id);

        if(!$usuario) {
            $data = [
                "message" => "No se encontro al usuario",
                "status"  => 404,
            ];
            return response()->json($data, 404);
        }


        $validator = Validator::make($request->all(), [
            'nombre'                => 'max:255',
            'apellido'              => 'max:255',
            'email'                 => 'email|unique:usuarios',
            'nombre_usuario'        => 'max:255',
            'contrasena'            => 'min:8|max:255',
        ]);

        if($validator->fails()) {
            $data = [
                "message"   => "error en la validacion de los datos",
                "errors"    => $validator->errors(),
                "status"    => 400,
            ];
            return response()->json($data,400);
        }

        if ($request->has('nombre')) {
            $usuario->nombre = $request->nombre;
        }

        if ($request->has('apellido')) {
            $usuario->apellido = $request->apellido;
        }

        if ($request->has('email')) {
            $usuario->email = $request->email;
        }

        if ($request->has('nombre_usuario')) {
            $usuario->nombre_usuario = $request->nombre_usuario;
        }

        if ($request->has('contrasena')) {
            $usuario->contrasena = $request->contrasena;
        }

        $usuario->save();

        $data = [
            "message"   => "usuario actualizado",
            "ticket"   => $usuario,
            "status"    => 200,
        ];

        return response()->json($data, 200);
    }
}
