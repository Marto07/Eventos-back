<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitado;
use Illuminate\Support\Facades\Validator;

class InvitadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Invitado::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'            => 'required|max:255',
            'apellido'          => 'required|max:255',
            'email'             => 'required|email',
            'asistencia_estado' => 'required|max:255',
            'evento_fk'         => 'required|exists:eventos,id',
        ], [
            'evento_fk.exists' => 'El evento no existe',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors'  => $validator->errors(),
                'status'  => 400
            ];
            return response()->json($data,400);
        }

        $invitado = Invitado::create([
            'nombre'            => $request->nombre,
            'apellido'          => $request->apellido,
            'email'             => $request->email,
            'asistencia_estado' => $request->asistencia_estado,
            'evento_fk'         => $request->evento_fk,
        ]);

        if (!$invitado) {
            $data = [
                "message" => "Error al crear el invitado",
                "status" => 500,
            ];
            return response()->json($data,500);
        }

        $data = [
            "invitado" => $invitado,
            "status"  => 201,
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invitado = Invitado::find($id);

        if(!$invitado) {
            $data = [
                "message"   => "invitado no encontrado",
                "status"    => 404,
            ];
            return response()->json($data, 404);
        }

        $data = [
            "invitado"   => $invitado,
            "status"    => 200,
        ];

        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $invitado = Invitado::find($id);

        if(!$invitado) {
            $data = [
                "message"   => "invitado no encontrado",
                "status"    => 404,
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre'            => 'required|max:255',
            'apellido'          => 'required|max:255',
            'email'             => 'required|email',
            'asistencia_estado' => 'required|max:255',
            'evento_fk'         => 'required|exists:eventos,id',
        ], [
            'evento_fk.exists' => 'El evento no existe',
        ]);

        if ($validator->fails()) {
            $data = [
                "message"   => "Error en la validacion de los datos",
                "errors"    => $validator->errors(),
                "status"    => 400,
            ];

            return response()->json($data, 400);
        }

        $invitado->nombre            = $request->nombre;
        $invitado->apellido          = $request->apellido;
        $invitado->email             = $request->email;
        $invitado->asistencia_estado = $request->asistencia_estado;
        $invitado->evento_fk         = $request->evento_fk;

        $invitado->save();

        $data = [
            "message"   => "invitado actualizado",
            "invitado"    => $invitado,
            "status"    => 200,
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $invitado = Invitado::find($id);

        if(!$invitado) {
            $data = [
                "message"   => "invitado no encontrado",
                "status"    => 404,
            ];

            return response()->json($data, 404);
        }

        $invitado->delete();

        $data = [
            "message" => "invitado eliminado",
            "status"  => 200,
        ];

        return response()->json($data, 200);
    }

    public function partialUpdate(Request $request, $id) {
        $invitado = Invitado::find($id);

        if(!$invitado) {
            $data = [
                "message" => "No se encontro al invitado",
                "status"  => 404,
            ];
            return response()->json($data, 404);
        }


        $validator = Validator::make($request->all(), [
            'nombre'            => 'max:255',
            'apellido'          => 'max:255',
            'email'             => 'email',
            'asistencia_estado' => 'max:255',
            'evento_fk'         => 'exists:eventos,id',
        ], [
            'evento_fk.exists' => 'El evento no existe',
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
            $invitado->nombre = $request->nombre;
        }

        if ($request->has('apellido')) {
            $invitado->apellido = $request->apellido;
        }

        if ($request->has('email')) {
            $invitado->email = $request->email;
        }

        if ($request->has('asistencia_estado')) {
            $invitado->asistencia_estado = $request->asistencia_estado;
        }

        if ($request->has('evento_fk')) {
            $invitado->evento_fk = $request->evento_fk;
        }

        $invitado->save();

        $data = [
            "message"   => "invitado actualizado",
            "invitado"   => $invitado,
            "status"    => 200,
        ];

        return response()->json($data, 200);
    }
}
