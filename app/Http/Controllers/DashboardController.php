<?php

namespace App\Http\Controllers;

use App\Models\Invitado;

class DashboardController extends Controller
{
    public function index()
    {
        $invitados = Invitado::select(
            'uuid_invitado', 'nombre_invitado', 'numero_invitados', 'acepto_invitacion',
            )
            ->orderBy('created_at', 'desc')
            ->get();

        $totalInvitados = $invitados->sum('numero_invitados');
        $invitacionesAceptadas = Invitado::where('acepto_invitacion', true)->count();

        return view('panel.index', [
            'invitados' => $invitados,
            'totalInvitados' => $totalInvitados,
            'invitacionesAceptadas' => $invitacionesAceptadas
        ]);
    }
}
