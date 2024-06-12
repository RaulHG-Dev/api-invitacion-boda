<?php

namespace App\Http\Middleware;

use App\Services\JWTokenService;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class JwtVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (empty($request->header('authorization'))) {
                throw new Exception('JWT es requerido para autenticación', Response::HTTP_UNAUTHORIZED);
            }

            // check if bearer token exists
            if (!preg_match('/Bearer\s(\S+)/', $request->header('authorization'), $matches)) {
                throw new Exception('JWT es requerido para autenticación', Response::HTTP_UNAUTHORIZED);
            }

            // extract token
            $jwt = $matches[1];
            if (!$jwt) {
                throw new Exception('JWT es requerido para autenticación', Response::HTTP_UNAUTHORIZED);
            }

            $jwtService = new JWTokenService();
            $result = $jwtService->decodeJWT($jwt);

            if (!$result) {
                throw new Exception('No se pudo decodificar JWT', Response::HTTP_UNAUTHORIZED);
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => false,
                'errors' => 'No se pudo autorizar acceso a esta petición'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
