<?php

namespace App\Http\Controllers;

use App\Models\DynamicData;
use App\Models\Invitado;
use App\Services\PdfService;
use Illuminate\Http\Request;

class PaseController extends Controller
{
    private $pdfService;

    public function __construct() {
        $this->pdfService = new PdfService();
    }
    public function generaPase(Invitado $invitado)
    {
        $dynamicData = DynamicData::select('key', 'value')->get()->toArray();
        $finalArray = [];
        foreach ($dynamicData as $value) {
            $finalArray[$value['key']] = $value['value'];
        }
        // dd($finalArray);
        return $this->pdfService->generatePdfFromView('pdf.pase', [
            'nombreDoc'         => 'Pase ' . $invitado->nombre_invitado . '.pdf',
            'dynamicData'       => $finalArray,
            'nombreInvitado'    => $invitado->nombre_invitado,
            'cantidadInvitados' => $invitado->numero_invitados,
        ]);
    }
}
