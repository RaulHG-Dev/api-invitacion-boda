<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateTokenRequest;
use App\Models\Invitado;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreInvitadoRequest;
use App\Services\JWTokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Database\Eloquent\MissingAttributeException;
use Illuminate\Database\LazyLoadingViolationException;
use LogicException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Symfony\Component\HttpFoundation\Response;

class InvitadosController extends Controller
{
    private JWTokenService $jwtService;

    public function __construct()
    {
        $this->jwtService = new JWTokenService();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvitadoRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Invitado::create([
                    'nombre_invitado'   => $request->nombre_invitado,
                    'numero_invitados'  => $request->cantidad_invitados,
                    'uuid_invitado'     => (string)Str::uuid()
                ]);
            });

            return response()->json([
                'status' => true
            ], Response::HTTP_OK);
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
    public function show(Invitado $invitado)
    {
        // dd($invitado);
        try {
            return response()->json([
                'status' => true,
                'data' => $invitado->only('nombre_invitado', 'numero_invitados')
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'errors' => 'Ocurrió un problema interno en servidor.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Generate token for auth user
     * @param Invitado $invitado Invitado object
     * @return JsonResponse
     */
    public function generateJWT(GenerateTokenRequest $request)
    {
        $data = Invitado::where('uuid_invitado', $request->uuid)
            ->get()
            ->only(['nombre_invitado', 'numero_invitados', 'uuid_invitado']);

        $token = $this->jwtService->encodeJWT($data);
        if($token) {
            return response()->json([
                'status' => true,
                'data' => [
                    'token' => $token
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => 'Ocurrió un problema al generar token.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function verifyToken($token = '')
    {
        dd($token);
    }
}
