<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TipoRequisito;

class TipoRequisitoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TipoRequisito::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'estado' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors'  => $validator->errors(),
                'status'  => 400
            ];
            return response()->json($data,400);
        }

        $tipoRequisito = TipoRequisito::create([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
        ]);

        if (!$tipoRequisito) {
            $data = [
                "message" => "Error al crear el tipo de requisito",
                "status" => 500,
            ];
            return response()->json($data,500);
        }

        $data = [
            "invitado" => $tipoRequisito,
            "status"  => 201,
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tipoRequisito = TipoRequisito::find($id);

        if(!$tipoRequisito) {
            $data = [
                "message"   => "tipo de requisito no encontrado",
                "status"    => 404,
            ];
            return response()->json($data, 404);
        }

        $data = [
            "invitado"   => $tipoRequisito,
            "status"    => 200,
        ];

        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tipoRequisito = TipoRequisito::find($id);

        if(!$tipoRequisito) {
            $data = [
                "message"   => "tipo de requisito no encontrado",
                "status"    => 404,
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'max:255',
            'estado' => 'max:255',
        ]);

        if ($validator->fails()) {
            $data = [
                "message"   => "Error en la validacion de los datos",
                "errors"    => $validator->errors(),
                "status"    => 400,
            ];

            return response()->json($data, 400);
        }

        $tipoRequisito->nombre            = $request->nombre;
        $tipoRequisito->estado            = $request->estado;

        $tipoRequisito->save();

        $data = [
            "message"   => "tipo de requisito actualizado",
            "invitado"    => $tipoRequisito,
            "status"    => 200,
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tipoRequisito = TipoRequisito::find($id);

        if(!$tipoRequisito) {
            $data = [
                "message"   => "tipo de requisito no encontrado",
                "status"    => 404,
            ];

            return response()->json($data, 404);
        }

        $tipoRequisito->delete();

        $data = [
            "message" => "tipo de requisito eliminado",
            "status"  => 200,
        ];

        return response()->json($data, 200);
    }

    public function partialUpdate(Request $request, $id) {
        $tipoRequisito = TipoRequisito::find($id);

        if(!$tipoRequisito) {
            $data = [
                "message" => "No se encontro el tipo de requisito",
                "status"  => 404,
            ];
            return response()->json($data, 404);
        }


        $validator = Validator::make($request->all(), [
            'nombre' => 'max:255',
            'estado' => 'max:255',
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
            $tipoRequisito->nombre = $request->nombre;
        }

        if ($request->has('estado')) {
            $tipoRequisito->estado = $request->estado;
        }

        $tipoRequisito->save();

        $data = [
            "message"   => "tipo de requisito actualizado",
            "tipo de requisito"   => $tipoRequisito,
            "status"    => 200,
        ];

        return response()->json($data, 200);
    }
}
