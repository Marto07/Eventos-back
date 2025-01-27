<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Ticket::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fondo_color'   => 'required|max:255',
            'letras_color'  => 'required|max:255',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors'  => $validator->errors(),
                'status'  => 400
            ];
            return response()->json($data,400);
        }

        $ticket = Ticket::create([
            'fondo_color'   => $request->fondo_color,
            'letras_color'  => $request->letras_color,
        ]);

        if (!$ticket) {
            $data = [
                "message" => "Error al crear el ticket",
                "status" => 500,
            ];
            return response()->json($data,500);
        }

        $data = [
            "ticket" => $ticket,
            "status"  => 201,
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);

        if(!$ticket) {
            $data = [
                "message"   => "Ticket no encontrado",
                "status"    => 404,
            ];
            return response()->json($data, 404);
        }

        $data = [
            "ticket"   => $ticket,
            "status"    => 200,
        ];

        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if(!$ticket) {
            $data = [
                "message"   => "ticket no encontrado",
                "status"    => 404,
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'fondo_color'   => 'required|max:255',
            'letras_color'  => 'required|max:255',
        ]);

        if ($validator->fails()) {
            $data = [
                "message"   => "Error en la validacion de los datos",
                "errors"    => $validator->errors(),
                "status"    => 400,
            ];

            return response()->json($data, 400);
        }

        $ticket->fondo_color      = $request->fondo_color;
        $ticket->letras_color     = $request->letras_color;

        $ticket->save();

        $data = [
            "message"   => "ticket actualizado",
            "ticket"    => $ticket,
            "status"    => 200,
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        if(!$ticket) {
            $data = [
                "message"   => "ticket no encontrado",
                "status"    => 404,
            ];

            return response()->json($data, 404);
        }

        $ticket->delete();

        $data = [
            "message" => "ticket eliminado",
            "status"  => 200,
        ];

        return response()->json($data, 200);
    }

    public function partialUpdate(Request $request, $id) {
        $ticket = Ticket::find($id);

        if(!$ticket) {
            $data = [
                "message" => "No se encontro al ticket",
                "status"  => 404,
            ];
            return response()->json($data, 404);
        }


        $validator = Validator::make($request->all(), [
            'fondo_color'   => 'max:255',
            'letras_color'  => 'max:255',
        ]);

        if($validator->fails()) {
            $data = [
                "message"   => "error en la validacion de los datos",
                "errors"    => $validator->errors(),
                "status"    => 400,
            ];
            return response()->json($data,400);
        }

        if ($request->has('fondo_color')) {
            $ticket->fondo_color = $request->fondo_color;
        }

        if ($request->has('letras_color')) {
            $ticket->letras_color = $request->letras_color;
        }

        $ticket->save();

        $data = [
            "message"   => "Ticket actualizado",
            "ticket"   => $ticket,
            "status"    => 200,
        ];

        return response()->json($data, 200);
    }
}
