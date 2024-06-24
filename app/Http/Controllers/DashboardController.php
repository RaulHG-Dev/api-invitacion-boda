<?php

namespace App\Http\Controllers;

use App\Models\Invitado;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $invitados = Invitado::select('nombre_invitado', 'numero_invitados')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('panel.index', [
            'invitados' => $invitados
        ]);
    }
}
