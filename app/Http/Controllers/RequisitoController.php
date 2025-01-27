<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Requisito;

class RequisitoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Requisito::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion'        => 'required|max:255',
            'invitado_fk'        => 'required|exists:invitados,id',
            'tipo_requisito_fk'  => 'required|exists:tipo_requisitos,id',
        ], [
            'invitado_fk.exists' => 'El invitado no existe',
            'tipo_requisito_fk.exists' => 'El tipo de requisito no existe',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors'  => $validator->errors(),
                'status'  => 400
            ];
            return response()->json($data,400);
        }

        $requisito = Requisito::create([
            'descripcion'        => $request->descripcion,
            'invitado_fk'        => $request->invitado_fk,
            'tipo_requisito_fk'  => $request->tipo_requisito_fk,
        ]);

        if (!$requisito) {
            $data = [
                "message" => "Error al crear el requisito",
                "status" => 500,
            ];
            return response()->json($data,500);
        }

        $data = [
            "requisito" => $requisito,
            "status"  => 201,
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $requisito = Requisito::find($id);

        if(!$requisito) {
            $data = [
                "message"   => "requisito no encontrado",
                "status"    => 404,
            ];
            return response()->json($data, 404);
        }

        $data = [
            "requisito"   => $requisito,
            "status"    => 200,
        ];

        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requisito = Requisito::find($id);

        if(!$requisito) {
            $data = [
                "message"   => "requisito no encontrado",
                "status"    => 404,
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'descripcion'        => 'required|max:255',
            'invitado_fk'        => 'required|exists:invitados,id',
            'tipo_requisito_fk'  => 'required|exists:tipo_requisitos,id',
        ], [
            'invitado_fk.exists' => 'El invitado no existe',
            'tipo_requisito_fk.exists' => 'El tipo de requisito no existe',
        ]);

        if ($validator->fails()) {
            $data = [
                "message"   => "Error en la validacion de los datos",
                "errors"    => $validator->errors(),
                "status"    => 400,
            ];

            return response()->json($data, 400);
        }

        $requisito->descripcion         = $request->descripcion;
        $requisito->invitado_fk         = $request->invitado_fk;
        $requisito->tipo_requisito_fk   = $request->tipo_requisito_fk;

        $requisito->save();

        $data = [
            "message"   => "requisito actualizado",
            "requisito"    => $requisito,
            "status"    => 200,
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $requisito = Requisito::find($id);

        if(!$requisito) {
            $data = [
                "message"   => "requisito no encontrado",
                "status"    => 404,
            ];

            return response()->json($data, 404);
        }

        $requisito->delete();

        $data = [
            "message" => "requisito eliminado",
            "status"  => 200,
        ];

        return response()->json($data, 200);
    }

    public function partialUpdate(Request $request, $id) {
        $requisito = Requisito::find($id);

        if(!$requisito) {
            $data = [
                "message" => "No se encontro al requisito",
                "status"  => 404,
            ];
            return response()->json($data, 404);
        }


        $validator = Validator::make($request->all(), [
            'descripcion'        => 'max:255',
            'invitado_fk'        => 'exists:invitados,id',
            'tipo_requisito_fk'  => 'exists:tipo_requisitos,id',
        ], [
            'invitado_fk.exists' => 'El invitado no existe',
            'tipo_requisito_fk.exists' => 'El tipo de requisito no existe',
        ]);

        if($validator->fails()) {
            $data = [
                "message"   => "error en la validacion de los datos",
                "errors"    => $validator->errors(),
                "status"    => 400,
            ];
            return response()->json($data,400);
        }

        if($request->has('descripcion')) {
            $requisito->descripcion = $request->descripcion;
        }

        if($request->has('invitado_fk')) {
            $requisito->invitado_fk = $request->invitado_fk;
        }

        if($request->has('tipo_requisito_fk')) {
            $requisito->tipo_requisito_fk = $request->tipo_requisito_fk;
        }

        $requisito->save();

        $data = [
            "message"   => "requisito actualizado",
            "requisito"   => $requisito,
            "status"    => 200,
        ];

        return response()->json($data, 200);
    }
}
