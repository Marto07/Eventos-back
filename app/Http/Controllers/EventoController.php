<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Validator;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Evento::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'            => 'required|max:255',
            'descripcion'       => 'required|max:255',
            'lugar'             => 'required|max:255',
            'fecha_y_hora'      => 'required|date',
            'estado_evento'     => 'required|max:255',
            'privacidad_evento' => 'required|max:255',
            'usuario_fk'        => 'required|exists:usuarios,id',
            'ticket_fk'         => 'required|exists:tickets,id',
        ], [
            'usuario_fk.exists' => 'El usuario no existe',
            'ticket_fk.exists'  => 'El ticket no existe',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors'  => $validator->errors(),
                'status'  => 400
            ];
            return response()->json($data,400);
        }

        $evento = Evento::create([
            'nombre'            => $request->nombre,
            'descripcion'       => $request->descripcion,
            'lugar'             => $request->lugar,
            'fecha_y_hora'      => $request->fecha_y_hora,
            'estado_evento'     => $request->estado_evento,
            'privacidad_evento' => $request->privacidad_evento,
            'usuario_fk'        => $request->usuario_fk,
            'ticket_fk'         => $request->ticket_fk,
        ]);

        if (!$evento) {
            $data = [
                "message" => "Error al crear el evento",
                "status" => 500,
            ];
            return response()->json($data,500);
        }

        $data = [
            "evento" => $evento,
            "status"  => 201,
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $evento = Evento::find($id);

        if(!$evento) {
            $data = [
                "message"   => "evento no encontrado",
                "status"    => 404,
            ];
            return response()->json($data, 404);
        }

        $data = [
            "evento"   => $evento,
            "status"    => 200,
        ];

        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $evento = Evento::find($id);

        if(!$evento) {
            $data = [
                "message"   => "evento no encontrado",
                "status"    => 404,
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre'            => 'required|max:255',
            'descripcion'       => 'required|max:255',
            'lugar'             => 'required|max:255',
            'fecha_y_hora'      => 'required|date',
            'estado_evento'     => 'required|max:255',
            'privacidad_evento' => 'required|max:255',
            'usuario_fk'        => 'required|exists:usuarios,id',
            'ticket_fk'         => 'required|exists:tickets,id',
        ], [
            'usuario_fk.exists' => 'El usuario no existe',
            'ticket_fk.exists'  => 'El ticket no existe',
        ]);

        if ($validator->fails()) {
            $data = [
                "message"   => "Error en la validacion de los datos",
                "errors"    => $validator->errors(),
                "status"    => 400,
            ];

            return response()->json($data, 400);
        }

        $evento->nombre            = $request->nombre;
        $evento->descripcion       = $request->descripcion;
        $evento->lugar             = $request->lugar;
        $evento->fecha_y_hora      = $request->fecha_y_hora;
        $evento->estado_evento     = $request->estado_evento;
        $evento->privacidad_evento = $request->privacidad_evento;
        $evento->usuario_fk        = $request->usuario_fk;
        $evento->ticket_fk         = $request->ticket_fk;

        $evento->save();

        $data = [
            "message"   => "evento actualizado",
            "evento"    => $evento,
            "status"    => 200,
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $evento = Evento::find($id);

        if(!$evento) {
            $data = [
                "message"   => "evento no encontrado",
                "status"    => 404,
            ];

            return response()->json($data, 404);
        }

        $evento->delete();

        $data = [
            "message" => "evento eliminado",
            "status"  => 200,
        ];

        return response()->json($data, 200);
    }

    public function partialUpdate(Request $request, $id) {
        $evento = Evento::find($id);

        if(!$evento) {
            $data = [
                "message" => "No se encontro al evento",
                "status"  => 404,
            ];
            return response()->json($data, 404);
        }


        $validator = Validator::make($request->all(), [
            'nombre'            => 'max:255',
            'descripcion'       => 'max:255',
            'lugar'             => 'max:255',
            'fecha_y_hora'      => 'date',
            'estado_evento'     => 'max:255',
            'privacidad_evento' => 'max:255',
            'usuario_fk'        => 'exists:usuarios,id',
            'ticket_fk'         => 'exists:tickets,id',
        ], [
            'usuario_fk.exists' => 'El usuario no existe',
            'ticket_fk.exists'  => 'El ticket no existe',
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
            $evento->nombre = $request->nombre;
        }

        if ($request->has('descripcion')) {
            $evento->descripcion = $request->descripcion;
        }

        if ($request->has('lugar')) {
            $evento->lugar = $request->lugar;
        }

        if ($request->has('fecha_y_hora')) {
            $evento->fecha_y_hora = $request->fecha_y_hora;
        }

        if ($request->has('estado_evento')) {
            $evento->estado_evento = $request->estado_evento;
        }

        if ($request->has('privacidad_evento')) {
            $evento->privacidad_evento = $request->privacidad_evento;
        }

        if ($request->has('usuario_fk')) {
            $evento->usuario_fk = $request->usuario_fk;
        }

        if ($request->has('ticket_fk')) {
            $evento->ticket_fk = $request->ticket_fk;
        }

        $evento->save();

        $data = [
            "message"   => "Evento actualizado",
            "evento"   => $evento,
            "status"    => 200,
        ];

        return response()->json($data, 200);
    }
}
