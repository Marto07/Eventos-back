<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 /**
     * @OA\Post(
     *     path="/api/home",
     *     summary="Home data",
     *     description="Get a greeting message",
     *     tags={"Home"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Provide the name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", example="John"),
     *             @OA\Property(property="message", type="string", example="Hello world")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
class HomeController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'name' => $request->input('name'),
            'message' => 'Hello world',
        ]);
    }
}
