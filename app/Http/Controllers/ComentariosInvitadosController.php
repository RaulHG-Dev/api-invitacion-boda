<?php

namespace App\Http\Controllers;

use App\Models\Invitado;
use Illuminate\Http\Request;
use App\Services\JWTokenService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreComentariosInvitadosRequest;
use App\Models\ComentariosInvitado;
use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ComentariosInvitadosController extends Controller
{
    private JWTokenService $jwtService;

    public function __construct()
    {
        $this->jwtService = new JWTokenService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComentariosInvitadosRequest $request)
    {
        // dd($request->all());
        try {
            preg_match('/Bearer\s(\S+)/', $request->header('authorization'), $matches);
            $jwt = $matches[1];
            $jwtInfo = $this->jwtService->decodeJWT($jwt);
            // dd($jwtInfo['data']->uuid_invitado);
            if($jwtInfo) {
                $invitado = Invitado::where('uuid_invitado', $jwtInfo['data']->uuid_invitado)
                    ->first();

                DB::transaction(function () use($invitado, $request) {
                    ComentariosInvitado::create([
                        'nombre' => $request->nombre,
                        'comentario' => $request->comentarios,
                        'id_invitado' => $invitado->id
                    ]);
                });

                return response()->json([
                    'status' => true
                ], Response::HTTP_OK);
            } else {
                throw new Exception('No se pudo extraer información de token', Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            // extract token
            //code...
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => false,
                'errors' => 'Ocurrió un problema interno en servidor.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
