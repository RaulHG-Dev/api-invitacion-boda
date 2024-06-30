<?php
namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class PdfService {
    public function generatePdfFromView($view = '', $data = [])
    {
        $pdf = Pdf::loadView($view, $data);
        $pdf->setPaper('A4');
        return $pdf->stream($data['nombreDoc']);
        // return $pdf->download($data['nombreDoc']);
    }
}
