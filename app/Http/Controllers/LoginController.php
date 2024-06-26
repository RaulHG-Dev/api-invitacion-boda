<?php

namespace App\Http\Controllers;

use Throwable;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function login(LoginRequest $request)
    {
        try {
            $hasAccess = Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ]);

            if ($hasAccess) {
                return redirect('panel');
            } else {
                return back()->withErrors(['bad_authentication' => 'Correo y/o contraseña incorrectos.']);
            }
        } catch (Throwable $th) {
            Log::error($th);
            return back(Response::HTTP_INTERNAL_SERVER_ERROR)
                ->withErrors([
                    'bad_authentication' => Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]
                ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
