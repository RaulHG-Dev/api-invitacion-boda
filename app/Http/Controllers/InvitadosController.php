<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Invitado;
use App\Models\DynamicData;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\JWTokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\GenerateTokenRequest;
use App\Http\Requests\StoreInvitadoRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Requests\UpdateInvitadoRequest;
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
        try {
            return response()->json([
                'status' => true,
                'data' => $invitado->only('uuid_invitado', 'nombre_invitado', 'numero_invitados')
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
            ->first()
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

    public function confirmAttendance(Request $request)
    {
        try {
            $invitado = $this->getInvitadoFromToken($request);

            if (!$invitado->acepto_invitacion) {
                $invitado->acepto_invitacion = true;
                $invitado->aceptado_en = now();
                $invitado->save();
            }

            return response()->json([
                'status' => true,
                'data' => [
                    'acepto_invitacion' => $invitado->acepto_invitacion,
                    'aceptado_en' => $invitado->aceptado_en,
                ]
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => false,
                'errors' => 'Ocurrió un problema interno en servidor.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function validateAcceptance(Request $request)
    {
        try {
            $invitado = $this->getInvitadoFromToken($request);

            return response()->json([
                'status' => true,
                'data' => [
                    'acepto_invitacion' => (bool) $invitado->acepto_invitacion,
                    'aceptado_en' => $invitado->aceptado_en,
                ]
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => false,
                'errors' => 'Ocurrió un problema interno en servidor.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(Invitado $invitado)
    {
        try {
            DB::transaction(function () use($invitado) {
                $invitado->delete();
            });

            return response()->json([
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'errors' => 'Ocurrió un problema al eliminar registro.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function update(UpdateInvitadoRequest $request)
    {
        try {
            DB::transaction(function() use($request) {
                $isUpdated = Invitado::where('uuid_invitado', $request->uuid_invitado)
                    ->update([
                        'nombre_invitado' => $request->nombre_invitado,
                        'numero_invitados' => $request->cantidad_invitados
                    ]);

                if(!$isUpdated) {
                    throw new Exception('Ocurrió un problema al actualizar', 500);
                }
            });

            return response()->json([
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'errors' => 'Ocurrió un problema al actualizar registro.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function generateQR(Invitado $invitado)
    {
        try {
            $urlToQr = config('app.url_front') . $invitado->uuid_invitado;
            $qr = QrCode::backgroundColor(242, 241, 228)->color(109, 110, 96)
                ->size(150)->style('round')
                ->generate($urlToQr);

            // Datos dinámicos
            $dynamicData = DynamicData::select('key', 'value')->get()->toArray();
            $finalArray = [];
            foreach ($dynamicData as $value) {
                $finalArray[$value['key']] = $value['value'];
            }

            return response()->json([
                'status' => true,
                'data' => [
                    'qr' => (string)$qr,
                    'invitado' => $invitado->nombre_invitado,
                    'dynamicData' => $finalArray
                ]
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'errors' => 'Ocurrió un problema interno en servidor.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function getInvitadoFromToken(Request $request): Invitado
    {
        preg_match('/Bearer\s(\S+)/', $request->header('authorization'), $matches);
        $jwt = $matches[1] ?? '';
        $jwtInfo = $this->jwtService->decodeJWT($jwt);

        if (!$jwtInfo || empty($jwtInfo['data']->uuid_invitado)) {
            throw new Exception('No se pudo extraer información de token', Response::HTTP_UNAUTHORIZED);
        }

        $invitado = Invitado::where('uuid_invitado', $jwtInfo['data']->uuid_invitado)->first();

        if (!$invitado) {
            throw new Exception('No se encontró el invitado', Response::HTTP_NOT_FOUND);
        }

        return $invitado;
    }
}
